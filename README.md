# Projet SAE Web - Restaurant

## Description

Ce projet est une application web permettant aux utilisateurs de rechercher des restaurants, donner des avis et gérer leurs préférences culinaires. Il inclut un système d'authentification, de gestion des avis et de préférences des utilisateurs.

## Fonctionnalités

- 🔍 **Recherche de restaurants** : Trouvez des restaurants selon différents critères (nom, type de cuisine, localisation...).
- ⭐ **Avis et notes** : Les utilisateurs peuvent laisser des avis et noter les restaurants.
- 🧑‍💻 **Système d'authentification** : Inscription, connexion et gestion de profil.
- ❤️ **Favoris et préférences** : Les utilisateurs peuvent aimer des restaurants et des types de cuisine.
- 🏪 **Gestion des restaurants** : Ajout et modification des informations des restaurants (pour les administrateurs).
- 📊 **Interface administrateur** : Modération des avis et gestion des utilisateurs.
- 📸 **Carrousel d’images** : Affichage des images des restaurants sur la page d’accueil.
- 🗺️ **Intégration de cartes** : Visualisation des restaurants sur une carte interactive.

## Structure du Projet

Le projet est organisé comme suit :
- `src/` : Contient le code source de l'application.
  - `Controllers/` : Gère la logique métier et les requêtes utilisateur.
  - `Database/` : Gestion des interactions avec la base de données.
  - `Views/` : Gère l'affichage des pages.
  - `Config/` : Fichiers de configuration.
  - `static/` : Contient les fichiers CSS, JS et images.
- `templates/` : Fichiers PHP pour les vues.
- `tests/` : Contient les tests unitaires.
- `composer.json` : Fichier de configuration des dépendances PHP.

## Installation

1. Cloner le dépôt :
   ```
   git clone https://github.com/alexisnisol/SAE-Web-Restaurant.git
   cd SAE-Web-Restaurant
   ```

2. Installer les dépendances : 

    ```
    composer install
    ```

3. Configurer la base de données : 

Si besoin modifier src/Config/ConfigBD.php.  

4. Lancer le serveur local : 

    ```
    cd src
    php -S localhost:8000
    ```

## Test

Pour exécuter les tests unitaires, utilisez :

    ```
    vendor/bin/phpunit
    ```

## Auteurs

- Alexis NISOL
- Niksan NAGARAJAH
- Alexy WICIAK
- Mouâd ZOUADI

