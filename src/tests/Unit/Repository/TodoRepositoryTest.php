<?php

namespace Tests\Unit\Repository;

use Tests\TestCase;
use App\Repositories\Todo\UserTask;
use App\Repositories\Todo\TodoRepositoryInterface;

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
        $this->assertNull($resultTask->getDescription());
    }
}
