<?php

namespace App\Http\Controllers;

use App\Repositories\Todo\UserTask;
use App\Requests\CreateTodoRequest;
use App\Requests\UpdateTodoRequest;
use Illuminate\Support\Facades\Log;
use App\Requests\CompleteTodoRequest;
use App\Repositories\Todo\TodoRepositoryInterface;

class TodoController extends Controller
{
    /** @var TodoRepositoryInterface */
    private $todoRepository;

    /**
     * TodoController constructor.
     *
     * @param TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Todo list
     *
     * @return void
     */
    public function index()
    {
        $tasks = $this->todoRepository->list();
        return view('app.todo.index')
            ->with('hasTask', $tasks->isNotEmpty())
            ->with('tasks', $tasks);
    }

    /**
     * Todo 閲覧ページ
     *
     * @param integer $todo_id
     * @return void
     */
    public function show(int $todo_id)
    {
        return view('app.todo.show')
            ->with('task', $this->todoRepository->get($todo_id));
    }

    /**
     * Todo 作成ページ
     *
     * @return void
     */
    public function create()
    {
        return view('app.todo.create');
    }

    /**
     * Todo 作成リクエスト
     *
     * @param CreateTodoRequest $request
     * @return void
     */
    public function store(CreateTodoRequest $request)
    {
        $userTask = $this->todoRepository->create($request->input('title'), $request->input('description'));
        Log::info('todo create. title = ' . $userTask->getTitle());
        return redirect()
            ->route('todos.index')
            ->with('flash_message', 'Todoを作成しました');
    }

    /**
     * Todo 編集ページ
     *
     * @param integer $todo_id
     * @return void
     */
    public function edit(int $todo_id)
    {
        return view('app.todo.edit')
            ->with('task', $this->todoRepository->get($todo_id));
    }

    /**
     * Todo 更新リクエスト
     *
     * @param UpdateTodoRequest $request
     * @return void
     */
    public function update(UpdateTodoRequest $request, int $todo_id)
    {
        $userTask = new UserTask($todo_id, $request->input('title'), $request->input('description'));
        $newUserTask = $this->todoRepository->update($todo_id, $userTask);
        Log::info('todo update. title = ' . $newUserTask->getTitle());
        return redirect()
            ->route('todos.index')
            ->with('flash_message', 'Todoを更新しました');
    }

    /**
     * Todo 完了リクエスト
     *
     * @param CompleteTodoRequest $request
     * @return void
     */
    public function complete(CompleteTodoRequest $request)
    {
        $completeTodo = $this->todoRepository->complete($request->input('todo_id'));
        Log::info('todo complete. title = ' . $completeTodo->title);
        return redirect()
            ->route('app.todo.index')
            ->with('flash_message', 'Todoを完了にしました');
    }

    /**
     * Todo 削除リクエスト
     *
     * @param integer $todo_id
     * @return void
     */
    public function destroy(int $todo_id)
    {
        $deleteTask = $this->todoRepository->delete($todo_id);
        Log::info('todo destroy: title = ' . $deleteTask->getTitle());
        return redirect()
            ->route('app.todo.index')
            ->with('flash_message', 'Todoを削除しました');
    }
}
