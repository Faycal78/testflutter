import 'dart:convert';
import 'dart:io';

import 'package:http/http.dart' as http;
import 'package:http/io_client.dart';
import '../models/login_response.dart';
import '../models/service_request.dart';
import '../models/offer.dart';
import '../utils/shared_prefs.dart';

class ApiService {
  // L'URL de votre backend Laravel exposé via ngrok
  static const String baseUrl = 'https://2258-105-235-132-79.ngrok-free.app/api';

  // Client HTTP personnalisé qui accepte tous les certificats (à utiliser uniquement en dev)
  static final http.Client _client = _createHttpClient();

  static http.Client _createHttpClient() {
    final HttpClient httpClient = HttpClient();
    // Accepter tous les certificats (développement seulement)
    httpClient.badCertificateCallback =
        (X509Certificate cert, String host, int port) => true;
    return IOClient(httpClient);
  }

  // Login
  static Future<LoginResponse?> login(String email, String password) async {
    final url = Uri.parse('$baseUrl/login');
    print("POST $url");
    try {
      final response = await _client.post(
        url,
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({'email': email, 'password': password}),
      );
      print("Response status: ${response.statusCode}");
      print("Response body: ${response.body}");
      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        await SharedPrefs.saveToken(data['token']);
        return LoginResponse.fromJson(data);
      } else {
        print("Erreur lors de la connexion: ${response.body}");
      }
    } catch (e) {
      print("Exception lors de la connexion: $e");
    }
    return null;
  }

  // Création d'une demande de service (client)
  static Future<bool> createServiceRequest(ServiceRequest request) async {
    final token = await SharedPrefs.getToken();
    final url = Uri.parse('$baseUrl/service-requests');
    print("POST $url");
    try {
      final response = await _client.post(
        url,
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: jsonEncode(request.toJson()),
      );
      print("Response status (createServiceRequest): ${response.statusCode}");
      return response.statusCode == 201;
    } catch (e) {
      print("Exception dans createServiceRequest: $e");
    }
    return false;
  }

  // Récupération de la liste des demandes (provider)
  static Future<List<ServiceRequest>> fetchServiceRequests() async {
    final token = await SharedPrefs.getToken();
    final url = Uri.parse('$baseUrl/service-requests');
    print("GET $url");
    try {
      final response = await _client.get(
        url,
        headers: {'Authorization': 'Bearer $token'},
      );
      print("Response status (fetchServiceRequests): ${response.statusCode}");
      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        final List list = data['data'] ?? [];
        return list.map((json) => ServiceRequest.fromJson(json)).toList();
      } else {
        print("Erreur lors de la récupération des demandes: ${response.body}");
      }
    } catch (e) {
      print("Exception dans fetchServiceRequests: $e");
    }
    return [];
  }

  // Soumission d'une offre pour une demande (provider)
  static Future<bool> submitOffer(String requestId, Offer offer) async {
    final token = await SharedPrefs.getToken();
    final url = Uri.parse('$baseUrl/service-requests/$requestId/offers');
    print("POST $url");
    try {
      final response = await _client.post(
        url,
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: jsonEncode(offer.toJson()),
      );
      print("Response status (submitOffer): ${response.statusCode}");
      return response.statusCode == 201;
    } catch (e) {
      print("Exception dans submitOffer: $e");
    }
    return false;
  }

  // Récupération de la liste des offres pour une demande (client)
  static Future<List<Offer>> fetchOffers(String requestId) async {
    final token = await SharedPrefs.getToken();
    final url = Uri.parse('$baseUrl/service-requests/$requestId/offers');
    print("GET $url");
    try {
      final response = await _client.get(
        url,
        headers: {'Authorization': 'Bearer $token'},
      );
      print("Response status (fetchOffers): ${response.statusCode}");
      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        final List list = data['data'] ?? [];
        return list.map((json) => Offer.fromJson(json)).toList();
      } else {
        print("Erreur lors de la récupération des offres: ${response.body}");
      }
    } catch (e) {
      print("Exception dans fetchOffers: $e");
    }
    return [];
  }
}
