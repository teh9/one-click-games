Local setup after git clone:

1. composer install
2. cp .env.example .env
3. php artisan cache:clear
4. composer dump-autoload
5. php artisan key:generate
6. php artisan serve
7. php artisan migrate

DB - MySQL;
