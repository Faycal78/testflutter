# Projet Full-Stack : Backend Laravel & Application Flutter

Ce projet est une application full-stack qui combine un backend Laravel exposant une API REST et une application mobile Flutter consommant cette API.  
L'API gère l'authentification, la gestion des demandes de service et la soumission d'offres, tandis que l'application Flutter fournit une interface utilisateur moderne pour interagir avec ces fonctionnalités.

---

## Table des Matières

- [Architecture du Projet](#architecture-du-projet)
- [Backend Laravel](#backend-laravel)
  - [Installation et Configuration](#installation-et-configuration)
  - [Principales Fonctionnalités et Classes](#principales-fonctionnalités-et-classes)
- [Application Flutter](#application-flutter)
  - [Installation et Configuration](#installation-et-configuration-1)
  - [Principales Fonctionnalités et Classes](#principales-fonctionnalités-et-classes-1)
- [Communication entre Laravel et Flutter](#communication-entre-laravel-et-flutter)
- [Déploiement](#déploiement)
- [Contribution](#contribution)
- [Licence](#licence)
- [Contact](#contact)

---

## Architecture du Projet

Le projet est divisé en deux parties principales :

1. **Backend Laravel**  
   - Expose une API REST sécurisée (authentification, gestion des demandes, offres, etc.).
   - Utilise des migrations, des modèles Eloquent, et des contrôleurs pour gérer la logique métier.
   - Est exposé en développement via ngrok pour permettre son accès depuis l'application mobile.

2. **Application Flutter**  
   - Fournit une interface utilisateur moderne pour se connecter, consulter les demandes et soumettre des offres.
   - Utilise le package `http` pour consommer l'API du backend.
   - Gère le stockage local du token d'authentification via une classe utilitaire (SharedPrefs).

---

## Backend Laravel

### Installation et Configuration

1. **Cloner le dépôt et installer les dépendances**  
   ```bash
   git clone https://github.com/YourUsername/laravel-backend.git
   cd laravel-backend
   composer install
Configurer l'environnement
Copier le fichier .env.example en .env et mettre à jour les informations de connexion à la base de données.

bash
Copier
cp .env.example .env
php artisan key:generate
Migrer et semer la base de données

bash
Copier
php artisan migrate --seed
Lancer le serveur Laravel
Pour le développement, utilisez :

bash
Copier
php artisan serve --host=0.0.0.0 --port=8000
Puis, pour exposer l'API via ngrok :

bash
Copier
ngrok http 8000
Notez l'URL publique fournie par ngrok (par exemple, https://2258-105-235-132-79.ngrok-free.app).

Principales Fonctionnalités et Classes
Modèles Eloquent

User : Représente les utilisateurs de l'application.

ServiceRequest : Représente une demande de service créée par un client.

Offer : Représente une offre soumise par un fournisseur pour une demande.

Contrôleurs

AuthController ou les contrôleurs d'authentification (ex. LoginController, RegisteredUserController) gèrent l'inscription, la connexion et la gestion du token.

ServiceRequestController : Gère la création et la consultation des demandes.

OfferController : Gère la soumission et la récupération des offres.

Routes API
Le fichier routes/api.php définit les endpoints de l'API, par exemple :

POST /api/login pour la connexion.

POST /api/service-requests pour créer une demande.

GET /api/service-requests pour lister les demandes.

POST /api/service-requests/{id}/offers pour soumettre une offre.

GET /api/service-requests/{id}/offers pour lister les offres.

Application Flutter
Installation et Configuration
Cloner le dépôt Flutter

bash
Copier
git clone https://github.com/YourUsername/flutter-app.git
cd flutter-app
flutter pub get
Mettre à jour la configuration de l'API
Dans le fichier lib/services/api_service.dart, modifiez la variable baseUrl pour qu'elle pointe vers l'URL publique de ngrok :

dart
Copier
static const String baseUrl = 'https://2258-105-235-132-79.ngrok-free.app/api';
Lancer l'application
Lancez l'application sur un émulateur ou un appareil réel :

bash
Copier
flutter run
Principales Fonctionnalités et Classes
ApiService.dart

Gère les appels HTTP vers l'API Laravel.

Contient des fonctions comme login, createServiceRequest, fetchServiceRequests, submitOffer et fetchOffers.

Utilise un client HTTP personnalisé qui accepte tous les certificats (utile en développement avec ngrok).

LoginResponse.dart

Classe modèle qui décode la réponse de connexion et stocke le token d'authentification.

Exemple :

dart
Copier
class LoginResponse {
  final String token;

  LoginResponse({required this.token});

  factory LoginResponse.fromJson(Map<String, dynamic> json) {
    return LoginResponse(
      token: json['token'] ?? '',
    );
  }
}
LoginScreen.dart

Écran de connexion avec un design moderne (fond dégradé, carte de connexion, champs pour l'email et le mot de passe, bouton de connexion).

La fonction _login envoie la requête à l'API et redirige l'utilisateur en cas de succès ou affiche un message d'erreur avec un SnackBar en cas d'échec.

ServiceRequestsListScreen.dart

Écran de destination après une connexion réussie, où les demandes de service sont listées (à adapter selon votre logique).

Communication entre Laravel et Flutter
Authentification
Lors de la connexion, Flutter envoie une requête POST à https://2258-105-235-132-79.ngrok-free.app/api/login avec les identifiants. Le backend Laravel renvoie un token qui est stocké localement via SharedPrefs.

Utilisation du Token
Toutes les requêtes ultérieures vers l'API (création de demande, soumission d'offre, etc.) incluent le token dans l'en-tête Authorization: Bearer <token>.

Déploiement
Backend Laravel
Pour la production, déployez votre application Laravel sur un hébergeur compatible (Heroku, DigitalOcean, etc.) avec un domaine et un certificat SSL valide.
Mettez à jour la variable baseUrl dans Flutter pour pointer vers la nouvelle URL.

Application Flutter
Pour la production, générez les builds pour iOS et Android en suivant la documentation officielle de Flutter.


