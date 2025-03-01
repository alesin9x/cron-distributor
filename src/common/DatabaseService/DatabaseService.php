<?php

namespace common\DatabaseService;

use mysqli;
use Throwable;

/**
 * @property mysqli $mysqli
 */
class DatabaseService
{
    public const STATUS_WAITING = 1;
    public const STATUS_IN_WORK = 2;
    public const STATUS_COMPLETE = 3;

    protected mysqli $mysqli;

    /**
     * Соединение с БД
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $db
     * @return void
     */
    public function connect(string $host, string $user, string $pass, string $db): void
    {
        $this->mysqli = new mysqli($host, $user, $pass, $db);
        $this->mysqli->set_charset("utf8mb4");
    }

    /**
     * Закрытие соединения базой
     * @return void
     */
    public function close()
    {
        try {
            $this->mysqli->close();
        } catch (Throwable $_) {
        }

    }

    /**
     * Запрос
     * @param string $query
     * @return array
     */
    public function query_exec(string $query): array
    {
        return (array)$this->mysqli->query($query);
    }

    /**
     * Запрос & возврат результата как ассоциативного массива
     * @param string $query
     * @return array
     */
    public function query_assoc(string $query): array
    {
        if ($result = $this->mysqli->query($query)) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return array();
    }

    /**
     * Экранирование строки
     * @param ?string $string
     * @return ?string
     */
    public function escape_string(?string $string): ?string
    {
        if (is_null($string)) {
            return null;
        }
        return $this->mysqli->real_escape_string($string);
    }

    /**
     * Получаем уникальную задачу дя каждого процесса php
     * @param ?string $string
     * @return ?string
     */
    public function getTask(): ?array
    {
        $this->query_exec("START TRANSACTION");

        $tasks = $this->query_assoc(
            'SELECT id FROM tasks WHERE status_id = ' . self::STATUS_WAITING . ' LIMIT 1 FOR UPDATE SKIP LOCKED'
        );

        if (count($tasks) == 0) {
            $this->query_exec("ROLLBACK");
            return null;
        }

        $task = $tasks[array_key_first($tasks)];

        $this->updateTaskStatus($task['id'], self::STATUS_IN_WORK);

        $this->query_exec("COMMIT");
        return $task;
    }

    /**
     * Меняем статус задачи
     * @param int $taskId
     * @param int $status_id
     * @return void
     */
    public function updateTaskStatus(int $taskId, int $status_id): void
    {
        $this->query_exec(
            "UPDATE tasks SET status_id = $status_id WHERE id = $taskId"
        );
    }
}