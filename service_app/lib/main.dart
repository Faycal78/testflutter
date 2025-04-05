import 'package:flutter/material.dart';
import 'screens/login_screen.dart';
import 'screens/create_service_request_screen.dart';
import 'screens/service_requests_list_screen.dart';
import 'screens/submit_offer_screen.dart';
import 'screens/offer_list_screen.dart';

void main() {
  runApp(const MyApp());
}

/// Point d'entrée de l'application
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Service App',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.indigo,
        // Configuration du style des ElevatedButton pour un design moderne
        elevatedButtonTheme: ElevatedButtonThemeData(
          style: ElevatedButton.styleFrom(
            backgroundColor: Colors.indigo, // Utilisez backgroundColor (Flutter 3+)
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(12),
            ),
            padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
          ),
        ),
        // Style des champs de texte avec des coins arrondis
        inputDecorationTheme: const InputDecorationTheme(
          border: OutlineInputBorder(
            borderRadius: BorderRadius.all(Radius.circular(12)),
          ),
        ),
      ),
      // Définition de l'écran d'accueil (ici, la page de connexion)
      home: const LoginScreen(),
      // Définition des routes de l'application
      routes: {
        '/login': (context) => const LoginScreen(),
        '/createServiceRequest': (context) => const CreateServiceRequestScreen(),
        '/serviceRequestsList': (context) => const ServiceRequestsListScreen(),
        // Pour les écrans qui nécessitent un paramètre (ex: requestId), utilisez la navigation via MaterialPageRoute.
        // Par exemple :
        // Navigator.push(context, MaterialPageRoute(builder: (_) => SubmitOfferScreen(requestId: '123')));
        '/offerList': (context) => const OfferListScreen(requestId: ''),
      },
    );
  }
}
