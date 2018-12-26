# erp_basic
Public Erp Basic Backend

Branch Develop is Backend Laravel

Branch Front-dev is FrontEnd Angular5+


# run backend
- clone repo branch Develop
- composer install
- create database
- `cp .env.example .env`
- modify vars
`
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
`
- `php artisan migrate --seed`
- `php artisan jwt:secret`
- `php artisan serve`

## for see routes
- `php artisan route:list`