## Postup instalacie package user_management

- doplnit do suboru composer.json
`
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/peterkacinec/user-management"
    }
],
`
- nasledne spustit `composer update`

V cistej instalaci noveho projektu laravel treba dodrzat tento postup:

- composer install
- npm install
- composer require laravel/ui
- php artisan ui vue --auth
- v .env subore nastavit connect na db
- pustit migracie a seeds:  php artisan migrate:refresh && php artisan db:seed --class=KornerBI\\UserManagement\\Database\\Seeds\\DatabaseSeeder
- do app/User.php modelu doplnit manualne trait HasPermissionsTrait
- publishnut config file z package: php artisan vendor:publish --provider="KornerBI\UserManagement\UserManagementServiceProvider" --tag="config"
- publishnut vue componenty z package: php artisan vendor:publish --provider="KornerBI\UserManagement\UserManagementServiceProvider" --tag="vue-components"
- publishnute vue componenty treba manualne nalinkovat do suboru resources/js/app.js
- npm run dev
