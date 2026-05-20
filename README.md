# CesiZen

![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.7-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![PHPUnit](https://img.shields.io/badge/PHPUnit-10.5-366488?style=for-the-badge)

**CesiZen** est une application web de sensibilisation au stress développée avec **CodeIgniter 4**. Elle permet aux visiteurs de consulter des contenus de prévention, de réaliser un diagnostic de stress inspiré de l'échelle de Holmes et Rahe, puis aux utilisateurs connectés de conserver l'historique de leurs résultats.

Le projet propose aussi une interface d'administration pour gérer les utilisateurs, les pages d'information et les événements utilisés dans le questionnaire.

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Aperçu technique](#aperçu-technique)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Lancement avec Docker](#lancement-avec-docker)
- [Comptes de démonstration](#comptes-de-démonstration)
- [Commandes utiles](#commandes-utiles)
- [Structure du projet](#structure-du-projet)
- [Base de données](#base-de-données)
- [PWA](#pwa)
- [Routes principales](#routes-principales)
- [Diagnostic de stress](#diagnostic-de-stress)
- [Tests](#tests)
- [Documentation](#documentation)
- [Licence](#licence)

## Fonctionnalités

### Côté visiteur

- Consultation de pages d'information sur le stress et la prévention.
- Installation de l'application sur mobile ou ordinateur grâce au mode PWA.
- Inscription et connexion sécurisées.
- Réinitialisation de mot de passe par jeton temporaire.
- Questionnaire de diagnostic accessible sans compte.
- Calcul d'un score de stress avec un niveau lisible :
  - `Stress faible`
  - `Stress modéré`
  - `Stress élevé`

### Côté utilisateur connecté

- Sauvegarde automatique des résultats de diagnostic.
- Consultation de l'historique personnel.
- Gestion du profil depuis l'espace compte.

### Côté administrateur

- Tableau de bord avec indicateurs clés.
- Gestion des utilisateurs : rôle, activation, désactivation et suppression.
- Gestion des pages éditoriales : création, modification, publication, brouillon et suppression.
- Gestion du questionnaire : ajout, modification, activation et désactivation des événements.

> CesiZen est un outil d'auto-évaluation et de sensibilisation. Il ne remplace pas un avis médical ou l'accompagnement d'un professionnel de santé.

## Aperçu technique

| Élément | Technologie |
| --- | --- |
| Framework | CodeIgniter 4.7 |
| Langage | PHP 8.2+ |
| Base de données | SQLite en local, MariaDB avec Docker |
| Tests | PHPUnit 10.5 |
| Architecture | MVC CodeIgniter |
| Authentification | Sessions PHP, mots de passe hachés |
| Styles | CSS applicatif dans `public/assets/css/app.css` |

## Prérequis

Avant de lancer le projet, installez :

- PHP `8.2` ou supérieur ;
- Composer ;
- l'extension PHP `sqlite3` ;
- l'extension PHP `intl` ;
- l'extension PHP `mbstring`.

Avec XAMPP, l'extension SQLite peut être chargée ponctuellement avec l'option `-d extension=sqlite3`.

## Installation

Cette installation lance l'application directement sur votre machine, avec SQLite.

Clonez le dépôt, installez les dépendances, préparez la base de données puis lancez le serveur local.

```bash
git clone <url-du-depot>
cd cesizen
composer install
```

Copiez le fichier d'environnement si nécessaire :

```bash
cp env .env
```

Lancez les migrations :

```bash
php -d extension=sqlite3 spark migrate
```

Ajoutez les données de démonstration :

```bash
php -d extension=sqlite3 spark db:seed InitialSeeder
```

Démarrez le serveur local :

```bash
php -d extension=sqlite3 -S localhost:8080 -t public vendor/codeigniter4/framework/system/rewrite.php
```

L'application est ensuite disponible à l'adresse :

```text
http://localhost:8080
```

Si l'extension `sqlite3` est activée directement dans `php.ini`, vous pouvez aussi utiliser la commande CodeIgniter classique :

```bash
php spark serve
```

## Lancement avec Docker

Le projet peut aussi être lancé avec Docker. Cette configuration démarre trois services :

- `app` : application PHP 8.2 avec Apache ;
- `db` : base de données MariaDB ;
- `phpmyadmin` : interface web pour visualiser et administrer les tables.

Lancez les conteneurs :

```bash
docker compose up -d --build
```

Créez les tables dans MariaDB :

```bash
docker compose exec app php spark migrate
```

Chargez les données de démonstration :

```bash
docker compose exec app php spark db:seed InitialSeeder
```

L'application est disponible ici :

```text
http://localhost:8080
```

phpMyAdmin est disponible ici :

```text
http://localhost:8081
```

Identifiants MariaDB/phpMyAdmin :

| Champ | Valeur |
| --- | --- |
| Serveur | `db` |
| Base | `cesizen` |
| Utilisateur | `cesizen` |
| Mot de passe | `cesizen` |
| Mot de passe root | `root` |

Pour arrêter les conteneurs :

```bash
docker compose down
```

Pour supprimer aussi les données MariaDB stockées dans le volume Docker :

```bash
docker compose down -v
```

## Comptes de démonstration

Après exécution du seeder, deux comptes sont disponibles.

| Rôle | Email | Mot de passe |
| --- | --- | --- |
| Administrateur | `admin@cesizen.test` | `Admin123!` |
| Utilisateur | `user@cesizen.test` | `User123!` |

## Commandes utiles

```bash
# Installer les dépendances PHP
composer install

# Exécuter les migrations
php -d extension=sqlite3 spark migrate

# Charger les données de démonstration
php -d extension=sqlite3 spark db:seed InitialSeeder

# Lancer le serveur de développement avec SQLite chargé ponctuellement
php -d extension=sqlite3 -S localhost:8080 -t public vendor/codeigniter4/framework/system/rewrite.php

# Lancer les tests
vendor/bin/phpunit

# Lancer l'environnement Docker
docker compose up -d --build

# Créer les tables dans MariaDB avec Docker
docker compose exec app php spark migrate

# Charger les données de démonstration avec Docker
docker compose exec app php spark db:seed InitialSeeder
```

## Structure du projet

```text
cesizen/
├── app/
│   ├── Config/              # Configuration CodeIgniter
│   ├── Controllers/         # Contrôleurs publics, compte, auth et admin
│   ├── Database/
│   │   ├── Migrations/      # Création des tables
│   │   └── Seeds/           # Données de démonstration
│   ├── Models/              # Modèles de données
│   ├── Services/Diagnostic/ # Calcul du diagnostic de stress
│   └── Views/               # Vues PHP
├── docs/                    # Documentation fonctionnelle et technique
├── public/                  # Point d'entrée web et assets publics
├── tests/                   # Tests automatisés
├── writable/                # Cache, logs, sessions et base SQLite
├── composer.json
└── README.md
```

## Base de données

Le prototype utilise SQLite afin de simplifier l'installation et la démonstration. Le fichier de base de données est stocké ici :

```text
writable/database/cesizen.sqlite
```

Tables principales :

| Table | Rôle |
| --- | --- |
| `users` | Comptes utilisateurs, rôles, statut, jetons de réinitialisation |
| `pages` | Pages d'information publiables côté public |
| `diagnostic_events` | Événements stressants et points associés |
| `diagnostic_results` | Résultats sauvegardés des utilisateurs connectés |

Le modèle logique détaillé est disponible dans [`docs/mld.md`](docs/mld.md).

Avec Docker, ces mêmes tables sont créées dans le conteneur MariaDB `cesizen_db`, dans la base `cesizen`. Les données sont persistées dans le volume Docker `cesizen_db_data`.

## PWA

CesiZen inclut une configuration Progressive Web App :

- manifest web dans [`public/manifest.webmanifest`](public/manifest.webmanifest) ;
- service worker dans [`public/service-worker.js`](public/service-worker.js) ;
- page hors ligne dans [`public/offline.html`](public/offline.html) ;
- icône applicative dans [`public/assets/icons/icon.svg`](public/assets/icons/icon.svg).

Le service worker met en cache les assets publics et la page hors ligne. Les pages personnelles et les formulaires restent chargés depuis le réseau afin d'éviter de conserver des données sensibles dans le cache du navigateur.

## Routes principales

| Méthode | Route | Description |
| --- | --- | --- |
| `GET` | `/` | Page d'accueil |
| `GET` | `/page/{slug}` | Consultation d'une page d'information |
| `GET`, `POST` | `/inscription` | Création de compte |
| `GET`, `POST` | `/connexion` | Connexion |
| `GET` | `/deconnexion` | Déconnexion |
| `GET`, `POST` | `/mot-de-passe-oublie` | Demande de réinitialisation |
| `GET`, `POST` | `/reinitialiser-mot-de-passe` | Nouveau mot de passe |
| `GET` | `/diagnostic` | Questionnaire de diagnostic |
| `POST` | `/diagnostic/calculer` | Calcul du résultat |
| `GET` | `/diagnostic/resultats` | Historique utilisateur connecté |
| `GET`, `POST` | `/compte` | Profil utilisateur |
| `GET` | `/admin` | Tableau de bord administrateur |
| `GET` | `/admin/utilisateurs` | Gestion des utilisateurs |
| `GET` | `/admin/pages` | Gestion des pages |
| `GET` | `/admin/diagnostic` | Gestion des événements du questionnaire |

## Diagnostic de stress

Le diagnostic repose sur une liste d'événements auxquels sont associés des points. Le service `HolmesRaheDiagnosticService` additionne les points sélectionnés puis attribue un niveau :

| Score | Niveau |
| --- | --- |
| Moins de `150` | Stress faible |
| De `150` à `299` | Stress modéré |
| `300` et plus | Stress élevé |

Les résultats sont affichés immédiatement. Ils sont aussi enregistrés dans l'historique lorsque l'utilisateur est connecté.

## Tests

Le projet contient des tests unitaires, notamment sur le service de calcul du diagnostic.

```bash
vendor/bin/phpunit
```

Un cahier de tests synthétique est aussi disponible dans [`docs/cahier-tests.md`](docs/cahier-tests.md).

## Documentation

- [`docs/installation.md`](docs/installation.md) : guide d'installation rapide ;
- [`docs/mld.md`](docs/mld.md) : modèle logique de données ;
- [`docs/cahier-tests.md`](docs/cahier-tests.md) : scénarios de test fonctionnels.

## Sécurité et bonnes pratiques

- Les mots de passe sont stockés avec `password_hash`.
- Les sessions sont régénérées à la connexion.
- Les accès utilisateur et administrateur sont protégés par filtres.
- Le dossier public du serveur doit pointer vers `public/`.
- La base SQLite, les logs et les sessions restent dans `writable/`.

## Licence

Ce projet est basé sur CodeIgniter 4 et conserve une licence MIT. Consultez le fichier [`LICENSE`](LICENSE) pour plus d'informations.
