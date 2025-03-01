# Распределитель крон задач

### Этот проект представляет собой систему для управления и распределения задач через cron. Проект использует Docker для удобства развертывания и управления зависимостями.

### Заполнение environments

1. Создать .env от .env.example
2. Заполнить данными

## Запуск проекта
```bash
  run.bat
```

# Остановка проекта
```bash
  stop.bat
```

## Использование Docker Compose

### Устанавливаем зависимости php

```bash
docker compose exec php bash

composer install
```

### Накатывание тестовой таблицы в MySQL

Для накатывания тестовой таблицы в контейнере MySQL выполните следующие команды:
```bash
docker compose exec mysql bash
cd /var/backups/mysql
mysql -u root -pcrondstrb

SOURCE data.sql;
```

Все готово для работы.