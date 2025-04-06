# TestFlutter

TestFlutter est une application Flutter de démonstration qui illustre l'intégration d'un backend Laravel via une API REST. Ce projet comprend une interface utilisateur moderne pour la connexion, la gestion des demandes de service, la soumission d'offres et bien plus encore.

## Table des matières

- [Description](#description)
- [Fonctionnalités](#fonctionnalités)
- [Architecture](#architecture)
- [Installation](#installation)
  - [Prérequis](#prérequis)
  - [Configuration du Backend Laravel](#configuration-du-backend-laravel)
  - [Configuration de l'Application Flutter](#configuration-de-lapplication-flutter)
- [Utilisation](#utilisation)
- [Déploiement](#déploiement)
- [Contribuer](#contribuer)
- [Licence](#licence)
- [Contact](#contact)

## Description

TestFlutter est un exemple d'application mobile développée avec Flutter qui se connecte à un backend Laravel exposé via une API REST. L'application permet aux utilisateurs de :
- Se connecter et obtenir un token d'authentification
- Créer et consulter des demandes de service
- Soumettre des offres pour des demandes de service

Le backend Laravel est exposé publiquement via un tunnel ngrok, ce qui facilite les tests depuis n'importe quel appareil connecté.

## Fonctionnalités

- **Authentification** : Connexion sécurisée avec gestion du token.
- **Gestion des demandes** : Création et affichage de demandes de service.
- **Soumission d'offres** : Permet aux fournisseurs de soumettre des offres pour une demande.
- **Interface moderne** : UI responsive et design moderne avec Flutter.
- **Intégration backend** : Communication avec un backend Laravel via API REST.

## Architecture

Le projet se compose de deux parties principales :

1. **Backend Laravel**  
   - Fournit une API REST sécurisée (routes d'authentification, gestion des demandes et offres).


2. **Application Flutter**  
   - Interface utilisateur développée avec Flutter.
   - Utilise le package [http](https://pub.dev/packages/http) pour communiquer avec l'API.
   - Gère l'authentification, les requêtes de création et de consultation des demandes, ainsi que la soumission d'offres.

## Installation

### Prérequis

- [Flutter SDK](https://flutter.dev/docs/get-started/install)
- [Dart SDK](https://dart.dev/get-dart)
- [Laravel](https://laravel.com/docs) (pour le backend)

- Git

### Configuration du Backend Laravel

1. **Cloner le dépôt Laravel** (ou créer votre application Laravel) et naviguer dans le dossier du projet.

2. **Installer les dépendances** :
   ```bash
   composer install
Configurer le fichier .env (copiez .env.example en .env) et mettez à jour vos paramètres de base de données.

Générer la clé de l'application :

bash
Copier
php artisan key:generate
Migrer la base de données et semer les tables :

bash
Copier
php artisan migrate --seed
Lancer Laravel sur toutes les interfaces :

bash
Copier
php artisan serve --host=0.0.0.0 --port=8000


Copiez l'URL fournie par ngrok et mettez-la à jour dans le code Flutter (dans ApiService.baseUrl).

Configuration de l'Application Flutter
Cloner ce dépôt ou placez-vous dans le dossier du projet Flutter.

Installer les dépendances Flutter :

bash
Copier
flutter pub get
Mettre à jour l'URL de base dans lib/services/api_service.dart :

dart
Copier

Lancer l'application sur un émulateur ou un appareil réel :

bash
Copier
flutter run
Utilisation
Écran de connexion
Saisissez votre adresse e-mail et votre mot de passe pour vous connecter. Si la connexion est réussie, vous serez redirigé vers l'écran de gestion des demandes de service.

Gestion des demandes de service
Vous pouvez créer, consulter et gérer vos demandes de service.

Soumission d'offres
Les fournisseurs peuvent consulter les demandes et soumettre leurs offres.

Déploiement
Pour déployer votre backend en production, vous pouvez utiliser un hébergeur compatible avec Laravel et configurer un domaine sécurisé (HTTPS). Mettez à jour l'URL dans l'application Flutter en conséquence.
