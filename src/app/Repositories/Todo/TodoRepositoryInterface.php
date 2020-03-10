<?php

namespace App\Repositories\Todo;

use App\Models\CompleteTodo;
use Illuminate\Support\Collection;

interface TodoRepositoryInterface
{
    /**
     * Todoを取得
     *
     * @param integer $todo_id
     * @return UserTask
     */
    public function get(int $todo_id): UserTask;

    /**
     * Todoリストを取得
     *
     * @return Collection|UserTask[]
     */
    public function list(): Collection;

    /**
     * Todoを作成
     *
     * @param string $title
     * @param string|null $description
     * @return UserTask
     */
    public function create(string $title, ?string $description): UserTask;

    /**
     * Todoを更新
     *
     * @param integer $todo_id
     * @param UserTask $task
     * @return UserTask
     */
    public function update(int $todo_id, UserTask $task): UserTask;

    /**
     * Todoを完了にする
     *
     * @param integer $todo_id
     * @return CompleteTodo
     */
    public function complete(int $todo_id): CompleteTodo;

    /**
     * Todoを削除する
     *
     * @param integer $todo_id
     * @return UserTask
     */
    public function delete(int $todo_id): UserTask;
}
