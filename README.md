## Laravel excel app

### Приложение для импорта excel файлов используя Laravel-excel библиотеку.

Приложение работакт как со статичными так и с динамичными импортами. Записи, которые по некоторым причинам не попали в таблицу импорта переносятся в таблицу Failed rows.
Тестовые файлы находястся в tests/Fixtures. Project - for static import. Project2 - for dynamic import

### Для запуска приложения необходимо заранить следующие команды

    - php artisan migrate
    - php artisan storage:link
    - vite
