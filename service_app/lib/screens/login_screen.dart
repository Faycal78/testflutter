import 'package:flutter/material.dart';
import '../services/api_service.dart';
import 'service_requests_list_screen.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({Key? key}) : super(key: key);
  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();
  bool _loading = false;

  void _login() async {
    print("Tentative de connexion avec email: ${_emailController.text}");
    setState(() => _loading = true);
    final loginResponse = await ApiService.login(
      _emailController.text,
      _passwordController.text,
    );
    print("loginResponse: $loginResponse");
    setState(() => _loading = false);
    if (loginResponse != null) {
      print("Connexion réussie, redirection...");
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (_) => const ServiceRequestsListScreen()),
      );
    } else {
      print("Erreur de connexion, loginResponse est null");
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Erreur de connexion : vérifiez vos identifiants'),
          duration: Duration(seconds: 3),
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // Fond en dégradé pour un look moderne
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            colors: [Colors.deepPurple, Colors.indigo],
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
          ),
        ),
        padding: const EdgeInsets.symmetric(horizontal: 24.0),
        child: Center(
          child: SingleChildScrollView(
            child: Column(
              children: [
                // Titre ou logo
                Text(
                  "Bienvenue",
                  style: TextStyle(
                    fontSize: 32,
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                    shadows: [
                      const Shadow(
                        blurRadius: 10.0,
                        color: Colors.black45,
                        offset: Offset(2, 2),
                      )
                    ],
                  ),
                ),
                const SizedBox(height: 32),
                // Carte de connexion
                Card(
                  elevation: 12,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(16),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.symmetric(
                        horizontal: 24.0, vertical: 36),
                    child: Column(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        // Titre de la carte
                        Text(
                          "Connexion",
                          style: TextStyle(
                            fontSize: 28,
                            fontWeight: FontWeight.bold,
                            color: Colors.deepPurple[700],
                          ),
                        ),
                        const SizedBox(height: 24),
                        // Champ email
                        TextField(
                          controller: _emailController,
                          keyboardType: TextInputType.emailAddress,
                          decoration: InputDecoration(
                            prefixIcon: const Icon(Icons.email, color: Colors.deepPurple),
                            labelText: "Email",
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                          ),
                        ),
                        const SizedBox(height: 16),
                        // Champ mot de passe
                        TextField(
                          controller: _passwordController,
                          obscureText: true,
                          decoration: InputDecoration(
                            prefixIcon: const Icon(Icons.lock, color: Colors.deepPurple),
                            labelText: "Mot de passe",
                            border: OutlineInputBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                          ),
                        ),
                        const SizedBox(height: 24),
                        // Bouton de connexion ou indicateur de chargement
                        _loading
                            ? const CircularProgressIndicator()
                            : SizedBox(
                                width: double.infinity,
                                child: ElevatedButton(
                                  onPressed: _login,
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Colors.deepPurple,
                                    padding: const EdgeInsets.symmetric(vertical: 16),
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(12),
                                    ),
                                  ),
                                  child: const Text(
                                    "Se connecter",
                                    style: TextStyle(fontSize: 18),
                                  ),
                                ),
                              ),
                        const SizedBox(height: 16),
                        // Liens supplémentaires
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            TextButton(
                              onPressed: () {
                                // Naviguer vers l'écran de réinitialisation du mot de passe
                              },
                              child: const Text("Mot de passe oublié ?"),
                            ),
                            TextButton(
                              onPressed: () {
                                // Naviguer vers l'écran d'inscription
                              },
                              child: const Text("Créer un compte"),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
