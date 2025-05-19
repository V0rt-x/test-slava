# Тестовое задание для Slava

## Запуск проекта

Поднятие контейнеров

    docker compose up -d 

Копирование env

    cp .env.example .env

Генерация ключа приложения

    php artisan key:generate


## Использование

Страница для загрузки файла, max размер файла - 200 МБ

    http://localhost:8032/persons/upload

Получение импортированных записей

    curl --location 'localhost:8032/api/persons/byDate/?date_from=01.01.1970&date_to=01.01.1986' --header 'Accept: application/json'

| Параметр  | Тип  | Описание                                                                                                                    |
|-----------|------|-----------------------------------------------------------------------------------------------------------------------------|
| date_from | date | Формат (d.m.Y). Если не передано и date_to не передано, то 01.01.1970. Если передано date_to, то date_to - 6 месяцев.       |
| date_to   | date | Формат (d.m.Y). Если не передано и date_from не передано, то 01.07.1970. Если передано date_from, то date_from + 6 месяцев. |

Запуск команды для импорта

    php artisan import:run person
