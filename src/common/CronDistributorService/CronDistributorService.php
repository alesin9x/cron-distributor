<?php

namespace common\CronDistributorService;

use common\DatabaseService\DatabaseService;

/**
 * @property DatabaseService $databaseService
 */
class CronDistributorService
{

    private readonly DatabaseService $databaseService;

    public function __construct(DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    /**
     * Входная точка в распределитель (Получаем задачу, обрабатываем, завершаем задачу)
     * @return string
     */
    public function run(): string
    {
        if(!$task = $this->databaseService->getTask()){
            return "Нет задач";
        }

        // Код для работы с задачей

        $this->databaseService->updateTaskStatus($task['id'], DatabaseService::STATUS_COMPLETE);
        return "Завершена задача - {$task['id']}";
    }
}