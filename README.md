<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


```markdown
# Nom du projet

Projet LPRS. Création d'un site internet qui permet un gestion utilisateur ainsi qu'une communication entre utilisateur. De plus, il permet aussi a d'ancien élèves de créer des évenements ainsi que de poster des images. Des entreprises peuvent aussi y appliquer des offres de stage/alternance. 

## Table des matières

1. [Technologies utilisées](#technologies-utilisées)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Utilisation](#utilisation)
5. [Fonctionnalités](#fonctionnalités)
6. [Tests](#tests)
7. [Contribuer](#contribuer)
8. [Auteurs](#auteurs)
9. [Licence](#licence)

## Technologies utilisées

- **Laravel** : Framework PHP.
- **Jetstream** : Interface d'authentification et d'application.
- **Livewire** (ou **Inertia.js**) : Pour une expérience utilisateur réactive.
- **PHP** : Version 8.x ou supérieure.
- **Composer** : Gestionnaire de dépendances pour PHP.
- **NPM** : Gestionnaire de paquets pour JavaScript.
```
## Installation

1. Clone le dépôt :

   ```bash
    git clone https://github.com/Rwano93/LPRS_Projet
   ```

2. Accède au répertoire du projet :

   ```bash
   cd nom-du-projet
   ```

3. Installe les dépendances PHP :

   ```bash
   composer install
   ```

4. Installe les dépendances JavaScript :

   ```bash
   npm install
   ```

5. Copie le fichier `.env.example` en `.env` :

   ```bash
   cp .env.example .env
   ```

6. Génére la clé d'application :

   ```bash
   php artisan key:generate
   ```

7. Configure la base de données et d'autres paramètres dans le fichier `.env`.

8. Exécute les migrations :

   ```bash
   php artisan migrate
   ```

9. (Facultatif) Si tu utilises Jetstream avec des fonctionnalités supplémentaires (comme la gestion des équipes), n'oublie pas de publier les fichiers de configuration :

   ```bash
   php artisan jetstream:install livewire
   ```

## Configuration

- Configure les paramètres de la base de données dans le fichier `.env`.
- Pour les fonctionnalités de Jetstream, assure-toi que les routes et les contrôleurs sont correctement configurés.

## Utilisation


- Pour lancer le serveur de développement :

  ```bash
  php artisan serve
  ```

- Accède à l'application via `http://localhost:8000`.

- **Inscription et connexion** : Jetstream fournit des interfaces d'inscription et de connexion par défaut. Utilise-les pour créer un compte ou te connecter.

## Fonctionnalités

Liste les fonctionnalités principales de ton application, par exemple :

- Authentification des utilisateurs (inscription, connexion, réinitialisation du mot de passe).
- Gestion du profil utilisateur (modification des informations et de la photo de profil).
- Tableau de bord réactif grâce à Livewire ou Inertia.js.
- (Si applicable) Gestion des équipes, si tu as activé cette fonctionnalité dans Jetstream.

## Tests

Instructions pour exécuter des tests :

```bash
php artisan test
```


## Auteurs

- Erwan.
- Nathan.
- Ilyes.


<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

