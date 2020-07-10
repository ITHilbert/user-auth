# User Auth
Benutzerverwaltung mit Rollen und Rechten.

## Vorraussetzungen
```
composer require ithilbert/laravel-kit
https://github.com/yajra/laravel-datatables
```

## Install
```
composer require ithilbert/laravel-kit
php artisan vendor:publish --provider="ITHilbert\LaravelKit\LaravelKitServiceProvider"

composer require laravel/ui

php artisan ui:auth

composer require ithilbert/user-auth

//Daten kopieren
php artisan vendor:publish --provider="ITHilbert\UserAuth\UserAuthServiceProvider"

//Tabellen erstellen
php artisan migrate

//Daten einspielen
php artisan db:seed --class="ITHilbert\UserAuth\Database\Seeders\DatabaseSeeder"

```

## Benutzer
User: admin@admin.com
Password: password


## ToDo
- Passwort vergessen
- Register new User
