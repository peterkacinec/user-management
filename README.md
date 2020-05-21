# UserManagement for Laravel

## Installation

- doplnit do suboru composer.json
```
"require": {
    ...
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

V cistej instalaci noveho projektu Laravel treba dodrzat tento postup:

- `laravel new NazovProjektu`
- `composer install`
- `npm install`
- `composer require laravel/ui`
- `php artisan ui vue --auth`
- v `.env` subore nastavit connect na databazu, zadat nazov db, meno, heslo
- pustit migracie a seeds:  `php artisan migrate:refresh && php artisan db:seed --class=KornerBI\\UserManagement\\Database\\Seeds\\DatabaseSeeder`
- do `app/User.php` modelu doplnit manualne `HasPermissionsTrait`
- publishnut config file z package: `php artisan vendor:publish --provider="KornerBI\UserManagement\UserManagementServiceProvider" --tag="config"`
- publishnut vue componenty z package: `php artisan vendor:publish --provider="KornerBI\UserManagement\UserManagementServiceProvider" --tag="vue-components"`
- publishnute vue componenty treba manualne nalinkovat v subore `resources/js/app.js`
- spustit prikaz `npm run dev`

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
