<?php

namespace App\Repositories\Todo;

class UserTask
{
    /** @var int $id */
    private $id;

    /** @var string $title */
    private $title;

    /** @var string $description */
    private $description;

    /**
     * UserTask class constructor
     *
     * @param int $id
     * @param string $title
     * @param string $description
     */
    public function __construct(int $id, string $title, string $description = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * タスクのIDを返す
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * タスクのタイトルを返す
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * タスクの備考を返す
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
