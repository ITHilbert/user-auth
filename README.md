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
php artisan install::all

//Daten kopieren
php artisan vendor:publish --provider="ITHilbert\UserAuth\UserAuthServiceProvider" --force

//Tabellen erstellen
php artisan migrate

//Daten einspielen
php artisan db:seed --class="ITHilbert\UserAuth\Database\Seeders\DatabaseSeeder" 

// Menü Filter registieren
// Datei /config/adminlte.php öffnen und beim Punkt filters folgendes ergänzen:
    App\Menu\Filters\hasRole::class,
    App\Menu\Filters\hasPermission::class,
    App\Menu\Filters\hasPermissionOr::class,
    App\Menu\Filters\hasPermissionAnd::class,
```

### App\User
```
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use ITHilbert\UserAuth\Traits\UserAuth;

class User extends Authenticatable
{
    use Notifiable;
    use UserAuth;

    ...
```


## Routes
- admin/permissions
- admin/roles
- admin/users
- password/edit
- password/update
- login
- logout

## Benutzer
User: admin@admin.com
Password: password


## Blade Directiven
- Role - elseRole - endRole
- hasRole - endhasRole
- hasanyrole - endhasanyrole
- hasallroles - endhasallroles
- unlessrole - endunlessrole
- hasPermission - endhasPermission


## ToDo
- Login Fehlversuche -> Login sperren für einen größer werdenden Zeitraum
- Zeit bis zum nächsten Login reset
- Register new User
- 2 Faktor Login (z.B. Mail und Google 2 Faktor)
