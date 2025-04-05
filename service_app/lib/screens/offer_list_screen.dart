import 'package:flutter/material.dart';
import '../models/offer.dart';
import '../services/api_service.dart';

class OfferListScreen extends StatefulWidget {
  final String requestId;
  const OfferListScreen({Key? key, required this.requestId}) : super(key: key);

  @override
  _OfferListScreenState createState() => _OfferListScreenState();
}

class _OfferListScreenState extends State<OfferListScreen> {
  late Future<List<Offer>> _futureOffers;

  @override
  void initState() {
    super.initState();
    _futureOffers = _fetchOffers();
  }

  Future<List<Offer>> _fetchOffers() async {
    // Vous pouvez ajouter une méthode dans ApiService pour récupérer les offres d'une demande.
    // Ici, nous simulons une réponse vide.
    // Remplacez cette ligne par: return ApiService.fetchOffers(widget.requestId);
    return [];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Offres pour la demande')),
      body: FutureBuilder<List<Offer>>(
        future: _futureOffers,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return const Center(child: Text('Erreur lors du chargement des offres'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('Aucune offre trouvée'));
          }
          final offers = snapshot.data!;
          return ListView.builder(
            itemCount: offers.length,
            itemBuilder: (context, index) {
              final offer = offers[index];
              return Card(
                margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                ),
                elevation: 4,
                child: ListTile(
                  leading: const Icon(Icons.local_offer, color: Colors.green),
                  title: Text(
                    'Prix: ${offer.price}€',
                    style: const TextStyle(fontWeight: FontWeight.bold),
                  ),
                  subtitle: Text(offer.description),
                ),
              );
            },
          );
        },
      ),
    );
  }
}
