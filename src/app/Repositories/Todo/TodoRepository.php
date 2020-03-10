<?php

namespace App\Repositories\Todo;

use Exception;
use App\Models\Todo;
use App\Models\CompleteTodo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TodoRepository implements TodoRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(int $todo_id): UserTask
    {
        $todo = Todo::findOrFail($todo_id);
        return new UserTask($todo_id, $todo->title, $todo->description);
    }

    /**
     * @inheritDoc
     */
    public function list(): Collection
    {
        $todos = Todo::query()
            ->orderBy('created_at', 'desc')
            ->get();
        $tasks = collect();
        $todos->each(function($item, $key) use ($tasks){
            $tasks->push(new UserTask($item->id, $item->title, $item->description));
        });
        return $tasks;
    }

    /**
     * @inheritDoc
     */
    public function create(string $title, ?string $description): UserTask
    {
        $todo = Todo::create([
            'title' => $title,
            'description' => $description,
        ]);
        return new UserTask($todo->id, $todo->title, $todo->description);
    }

    /**
     * @inheritDoc
     */
    public function update(int $todo_id, UserTask $task): UserTask
    {
        $todo = Todo::findOrFail($todo_id);
        $todo->title = $task->getTitle();
        $todo->description = $task->getDescription();
        $todo->save();
        return new UserTask($todo->id, $todo->title, $todo->description);
    }

    /**
     * @inheritDoc
     */
    public function complete(int $todo_id): CompleteTodo
    {
        $todo = Todo::findOrFail($todo_id);
        return DB::transaction(function () use ($todo) {
            $todo->delete();
            $completeTodo = CompleteTodo::create([
                'title' => $todo->title,
                'description' => $todo->description,
            ]);
            DB::commit();
            Log::info('complete task: title = ' . $completeTodo->title);
            return $completeTodo;
        });
    }

    /**
     * @inheritDoc
     */
    public function delete(int $todo_id): UserTask
    {
        $todo = Todo::findOrFail($todo_id);
        $result = new UserTask($todo_id, $todo->title, $todo->description);
        $todo->delete();
        Log::info('delete todo: title = ' . $result->getTitle());
        return $result;
    }
}
