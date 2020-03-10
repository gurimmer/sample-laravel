<?php

namespace Tests\Unit\Repository;

use Tests\TestCase;
use App\Models\Todo;
use App\Repositories\Todo\UserTask;
use App\Repositories\Todo\TodoRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoRepositoryTest extends TestCase
{
    /** @var TodoRepositoryInterface $todoRepository */
    private $todoRepository;

    /**
     * @param TodoRepositoryInterface $todoRepository
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->todoRepository = app()->make(TodoRepositoryInterface::class);
    }

    /**
     * @test
     */
    public function get_UserTaskが取得できること()
    {
        $todo = factory(Todo::class)->create();
        $resultTask = $this->todoRepository->get($todo->id);
        $this->assertSame($todo->id, $resultTask->getId());
        $this->assertSame($todo->title, $resultTask->getTitle());
        $this->assertSame($todo->description, $resultTask->getDescription());
    }

    /**
     * @test
     */
    public function get_存在しないIDの場合Exceptionが発生すること()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->todoRepository->get(999);
    }

    /**
     * @test
     */
    public function get_UserTaskのdescriptionが空の場合()
    {
        $todo = factory(Todo::class)->create([
            'description' => '',
        ]);
        $resultTask = $this->todoRepository->get($todo->id);
        $this->assertSame($todo->id, $resultTask->getId());
        $this->assertSame($todo->title, $resultTask->getTitle());
        $this->assertEmpty($resultTask->getDescription());
    }

    /**
     * @test
     */
    public function list_Todoリストが1件取得できること()
    {
        $todo = factory(Todo::class)->create();
        $results = $this->todoRepository->list();
        $this->assertSame(1, $results->count());
        foreach ($results as $result) {
            $this->assertSame($todo->id, $result->getId());
            $this->assertSame($todo->title, $result->getTitle());
            $this->assertSame($todo->description, $result->getDescription());
        }

    }

    /**
     * @test
     */
    public function list_Todoリストが2件取得できること()
    {
        $todos = factory(Todo::class, 2)->create();
        $results = $this->todoRepository->list();
        $this->assertSame(2, $results->count());

        $todo1 = $todos[0];
        $result1 = $results[0];
        $this->assertSame($todo1->id, $result1->getId());
        $this->assertSame($todo1->title, $result1->getTitle());
        $this->assertSame($todo1->description, $result1->getDescription());

        $todo2 = $todos[1];
        $result2 = $results[1];
        $this->assertSame($todo2->id, $result2->getId());
        $this->assertSame($todo2->title, $result2->getTitle());
        $this->assertSame($todo2->description, $result2->getDescription());
    }

    /**
     * @test
     */
    public function list_Todoリストが0件の場合空であること()
    {
        $results = $this->todoRepository->list();
        $this->assertSame(0, $results->count());
    }

    /**
     * @test
     */
    public function create_Todoが作成されること()
    {
        $title = 'test';
        $description = 'description';
        $resultTask = $this->todoRepository->create($title, $description);
        $this->assertIsInt($resultTask->getId());
        $this->assertSame($title, $resultTask->getTitle());
        $this->assertSame($description, $resultTask->getDescription());
    }

    /**
     * @test
     */
    public function create_Todoの備考が空でも作成されること()
    {
        $title = 'test';
        $resultTask = $this->todoRepository->create($title, null);
        $this->assertIsInt($resultTask->getId());
        $this->assertSame($title, $resultTask->getTitle());
        $this->assertEmpty($resultTask->getDescription());
    }

    /**
     * @test
     */
    public function update_Todoが更新されること()
    {
        $todo = factory(Todo::class)->create([
            'title' => 'test',
            'description' => 'desc',
        ]);
        $updateTitle = 'test test';
        $updateDescription = 'desc desc';
        $userTask = new UserTask($todo->id, $updateTitle, $updateDescription);
        $resultTask = $this->todoRepository->update($todo->id, $userTask);
        $this->assertSame($updateTitle, $resultTask->getTitle());
        $this->assertSame($updateDescription, $resultTask->getDescription());
    }

    /**
     * @test
     */
    public function update_Todoのdescriptionが空で更新されること()
    {
        $todo = factory(Todo::class)->create([
            'title' => 'test',
            'description' => 'desc',
        ]);
        $updateTitle = 'test test';
        $userTask = new UserTask($todo->id, $updateTitle, null);
        $resultTask = $this->todoRepository->update($todo->id, $userTask);
        $this->assertSame($updateTitle, $resultTask->getTitle());
        $this->assertEmpty($resultTask->getDescription());
    }

    /**
     * @test
     */
    public function update_IDが存在しない場合Exceptionが発生すること()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->todoRepository->update(999, new UserTask(1, 'test', 'test'));
    }

    /**
     * @test
     */
    public function complete_Todoが完了してCompleteTodoになること()
    {
        $todo = factory(Todo::class)->create([
            'title' => 'test',
            'description' => 'desc',
        ]);
        $completeTodo = $this->todoRepository->complete($todo->id);
        $this->assertSame($todo->title, $completeTodo->title);
        $this->assertSame($todo->description, $completeTodo->description);
    }

    /**
     * @test
     */
    public function complete_Todoが完了するとTodoがなくなること()
    {
        $todo = factory(Todo::class)->create([
            'title' => 'test',
            'description' => 'desc',
        ]);
        $this->todoRepository->complete($todo->id);
        $resultTodo = Todo::find($todo->id);
        $this->assertNull($resultTodo);
    }

    /**
     * @test
     */
    public function complete_IDが存在しない場合Exceptionが発生すること()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->todoRepository->complete(999);
    }

    /**
     * @test
     */
    public function delete_Todoが削除されること()
    {
        $todo = factory(Todo::class)->create([
            'title' => 'test',
            'description' => 'desc',
        ]);
        $this->todoRepository->delete($todo->id);
        $resultTodo = Todo::find($todo->id);
        $this->assertNull($resultTodo);
    }

    /**
     * @test
     */
    public function delete_IDが存在しない場合Exceptionが発生すること()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->todoRepository->delete(999);
    }
}
