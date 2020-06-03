# UserManagement for Laravel

## Installation

- doplnit do suboru composer.json
```
"require": {
    ...,
    "peterkacinec/user-management": "@dev"
},
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/peterkacinec/user-management"
    }
],
```

- nasledne spustit prikaz `composer update`

## Nastavenie package

Obrazovky / routy v package funguju po autorizacii. Su urcene pre 
administratorov do admin rozhrania. Package pre spravne fungovanie
vyuziva autorizacny midleware laravelu, preto je nevyhnutne mat nainstalovane
v projekte `composer require laravel/ui` a `php artisan ui vue --auth`

V cistej instalaci noveho projektu Laravel treba dodrzat tento postup:

- `laravel new NazovProjektu`
- `npm install`
- v `.env` subore nastavit connect na databazu, zadat nazov db, meno, heslo
- `composer require laravel/ui`
- `php artisan ui vue --auth`
- `npm run dev` pre vybuildovanie view z larave/ui package
- pustit migracie a seeds:  `php artisan migrate:refresh && php artisan db:seed --class=KornerBI\\UserManagement\\Database\\Seeds\\DatabaseSeeder`
- do `app/User.php` modelu doplnit manualne `use KornerBI\UserManagement\Permissions\HasPermissionsTrait;` 
a v class User tiez `use HasPermissionsTrait;` a do pola `$fillable` doplnit atribut `surname`
a este doplnit `const ENTITY_ROUTE_PREFIX = '/users/';`
- publishnut config file z package `user-management`: `php artisan vendor:publish --provider="KornerBI\UserManagement\UserManagementServiceProvider" --tag="config"`
- publishnut config file z package `simple-table`: `php artisan vendor:publish --provider="KornerBI\SimpleTable\SimpleTableServiceProvider" --tag="config"`
- publishnut assety z package `simple-table` (ikonky buttonov z material icons) `php artisan vendor:publish --tag=public --force`
- spolu s user-management package sa nainstaluju aj zavislosti/package: `simple-table` a `modal`. Su to vue komponenty pre zobrazovanie zoznamu udajov a zobrazovanie confirm modal pri DELETE action
- Komponenty je potrebne manualne nalinkovat v subore `resources/js/app.js`: 
`Vue.component('simple-table-component', require('../../vendor/peterkacinec/simple-table/src/resources/js/components/SimpleTableComponent').default);` 
a `Vue.component('modal-component', require('../../vendor/peterkacinec/modal/src/ModalComponent').default);`
- spustit prikaz `npm run dev` alebo `npm run watch`
- `php artisan user:create` prikaz pre vytvorenie testovacieho usera

Po nainstalovani packagu sa spristupnia nasledovne routy:
- /users - zoznam pouzivatelov
- /users/1 - detail pouzivatela s ID=1
- /users/1/edit - uprava pouzivatela s ID=1
- /users/create - vytvorenie pouzivatela
- /users/1/delete - vymazanie pouzivatela s ID=1

To iste plati aj pre routy: `roles` a `permissions`

V menu projektu ak pouzivate linky s routami, je potrebne doplnit `config('user-management.route-name-prefix')`
Priklad: `<a class="nav-link" href="{{ route(config('user-management.route-name-prefix').'users.index') }}">{{ __('user-management::menu-item.Users') }}</a>`

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
