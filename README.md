# Projet SAE Web - Restaurant

## Description

Ce projet est une application web permettant aux utilisateurs de rechercher des restaurants, donner des avis et gérer leurs préférences culinaires. Il inclut un système d'authentification, de gestion des avis et de préférences des utilisateurs.

## Fonctionnalités

### Fonctionnalités Obligatoires :
- 🔍 **Module de recherche** : Trouvez facilement un restaurant selon son nom, sa localisation ou son type de cuisine.
- 🔑 **Inscription/Connexion** : Création et connexion des utilisateurs via un système sécurisé avec gestion des sessions.
- 🏪 **Visualisation des caractéristiques des restaurants** : Consultez les détails d’un restaurant (nom, type de cuisine, adresse, etc.).
- ⭐ **Avis et critiques** : Laissez des avis et notes sur les restaurants.
- ✍️ **Administrer ses critiques** : Modifiez ou supprimez vos avis.
- 🏠 **Accéder à son profil** : Visualisez et gérez vos informations personnelles.
- ✅ **Tests & couverture** : Assurer un pourcentage de couverture des tests.
- 📐 **Architecture MVC** : Organisation claire et pratique du code avec MVC, PDO, Sessions et un Autoloader.

### Fonctionnalités Souhaitées :
- 👨‍💼 **Partie Administrateur & Modérateur** : Gestion des utilisateurs, modération des avis et validation des ajouts.
- 🏡 **Écran d’accueil** : Présentation attrayante de l’application avec les fonctionnalités principales.
- 🎠 **Carrousel d’images** : Mise en avant des restaurants via un slider dynamique.
- 🍽️ **Types de cuisine préférés** : Possibilité de sauvegarder ses préférences culinaires.
- ❤️ **Restaurants favoris** : Ajout et gestion d’une liste de restaurants préférés.

### Fonctionnalités Optionnelles :
- 🗺️ **Carte des restaurants** : Visualisation des restaurants sur une carte interactive.
- ✏️ **Modification du profil** : Changer ses informations personnelles (nom, email, mot de passe...).
- ℹ️ **Page "À Propos"** : Informations sur le site Taste&Tell.

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
