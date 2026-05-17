# Guide d'installation CESIZen

## Prérequis

- PHP 8.2
- Composer
- Extension PHP `sqlite3`

Avec XAMPP, l'extension peut être chargée ponctuellement avec `php -d extension=sqlite3`.

## Installation

```bash
composer install
php -d extension=sqlite3 spark migrate
php -d extension=sqlite3 spark db:seed InitialSeeder
php -d extension=sqlite3 -S localhost:8080 -t public vendor/codeigniter4/framework/system/rewrite.php
```

L'application est disponible sur `http://localhost:8080`.

Si l'extension `sqlite3` est activée directement dans `php.ini`, la commande classique `php spark serve` peut aussi être utilisée.

## Comptes de démonstration

- Administrateur : `admin@cesizen.test` / `Admin123!`
- Utilisateur : `user@cesizen.test` / `User123!`

## Base de données

Le prototype utilise SQLite pour simplifier la démonstration. Le fichier est stocké dans `writable/database/cesizen.sqlite`.

Tables principales :

- `users`
- `pages`
- `diagnostic_events`
- `diagnostic_results`

## Tests

```bash
vendor/bin/phpunit
```
