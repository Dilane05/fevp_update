# Installation et Configuration de l'Application Web FEVP

Ce projet est L'application FEVP : Fiche d'écaluation des employés developé en laravel 11 intégrant Livewire 3 et d'autres packages essentiels comme Laravel Breeze, Livewire Volt, et bien d'autres. Suivez les étapes ci-dessous pour installer et configurer l'application sur votre environnement local.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- PHP 8.2 ou supérieur
- Composer
- Node.js et NPM (pour la compilation des assets front-end)
- MySQL ou un autre système de gestion de base de données compatible

## Étapes d'installation

### 1. Cloner le projet

Clonez le projet à partir du dépôt Git :

```bash
git clone https://github.com/DilaneDevCadyst/fevp
cd fevp
```

### 2. Installation des dépendances backend
Installez les dépendances PHP via Composer :

```bash
composer install
```

### 3. Configuration de l'environnement
Copiez le fichier .env.example pour créer un fichier .env :

```bash
cp .env.example .env
```
Générez la clé de l'application :

```bash
php artisan key:generate
```
Configurez la base de données dans le fichier .env :

``` bash 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=nom_utilisateur
DB_PASSWORD=mot_de_passe
```

### 4. Installation des dépendances frontend
Installez les dépendances JavaScript et compilez les assets front-end :

```bash
npm install
npm run dev
```

### 5. Migration et seeding de la base de données
Exécutez les migrations pour créer les tables dans la base de données :

```bash
php artisan migrate
```
executez les seeds :

```bash
php artisan db:seed
```

### 6. Serveur de développement
Lancez le serveur local pour tester l'application :

```bash
php artisan serve
```

Accédez à l'application via : http://localhost:8000


## Packages utilisés
Voici quelques-uns des principaux packages inclus dans ce projet :

- Livewire : ^3.4
- Laravel Breeze : ^2.0 (Pour l'authentification)
- Livewire Volt : ^1.6 (Pour une intégration Livewire fluide)
- Maatwebsite Excel : ^3.1 (Pour l'import/export Excel des employes)
- Spatie Laravel Permission : ^6.7 (Gestion des rôles et permissions)
- Spatie Laravel PDF : ^1.5 (Génération de PDFs)
- Barryvdh Laravel DomPDF : (Pour générer des PDFs à partir de vues)
- laravel-livewire-wizard : Pour gerer les evaluations

Pour plus de détails, consultez le fichier composer.json.

