# Тестовое задание: PHP-программист Junior

Проект выполняет загрузку записей и комментариев из JSONPlaceholder в базу данных MySQL и позволяет искать записи по тексту комментариев.

---

## Установка и запуск

1. Клонировать репозиторий:

```bash
git clone https://github.com/username/test_task.git
cd test_task
```
2. Настроить подключение к БД в файле db.php:
```php 
$host = '127.0.0.1';
$db = 'blog_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
```
3. Запустить скрипт load_data.php для загрузки записей и комментариев:
```bash
php load_data.php
```
4. Запустить локальный веб-сервер и открыть страницу index.php.