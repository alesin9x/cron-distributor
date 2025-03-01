DROP DATABASE cron;
CREATE DATABASE cron;
USE cron;

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE tasks
(
    id        INT AUTO_INCREMENT PRIMARY KEY, -- Уникальный идентификатор задачи
    status_id INT NOT NULL,                   -- Статус задачи (1 - ожидание, 2 - в работе и т.д.)
    data      TEXT                            -- Данные задачи (может быть JSON, текст и т.д.)
);

INSERT INTO tasks (status_id, data)
VALUES (1, '{"task": "Task 1", "description": "Description for task 1"}'),
       (1, '{"task": "Task 2", "description": "Description for task 2"}'),
       (1, '{"task": "Task 3", "description": "Description for task 3"}'),
       (1, '{"task": "Task 4", "description": "Description for task 4"}'),
       (1, '{"task": "Task 5", "description": "Description for task 5"}'),
       (1, '{"task": "Task 6", "description": "Description for task 6"}'),
       (1, '{"task": "Task 7", "description": "Description for task 7"}'),
       (1, '{"task": "Task 8", "description": "Description for task 8"}'),
       (1, '{"task": "Task 9", "description": "Description for task 9"}'),
       (1, '{"task": "Task 10", "description": "Description for task 10"}');