import 'package:flutter/material.dart';
import '../models/service_request.dart';
import '../services/api_service.dart';
import 'submit_offer_screen.dart';

class ServiceRequestsListScreen extends StatefulWidget {
  const ServiceRequestsListScreen({Key? key}) : super(key: key);

  @override
  _ServiceRequestsListScreenState createState() => _ServiceRequestsListScreenState();
}

class _ServiceRequestsListScreenState extends State<ServiceRequestsListScreen> {
  late Future<List<ServiceRequest>> _futureRequests;

  @override
  void initState() {
    super.initState();
    _futureRequests = ApiService.fetchServiceRequests();
  }

  Future<void> _refreshRequests() async {
    setState(() {
      _futureRequests = ApiService.fetchServiceRequests();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Demandes de service'),
      ),
      body: FutureBuilder<List<ServiceRequest>>(
        future: _futureRequests,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return const Center(child: Text('Erreur lors du chargement'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('Aucune demande trouvée'));
          }
          final requests = snapshot.data!;
          return RefreshIndicator(
            onRefresh: _refreshRequests,
            child: ListView.builder(
              itemCount: requests.length,
              itemBuilder: (context, index) {
                final req = requests[index];
                return Card(
                  margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  elevation: 4,
                  child: ListTile(
                    leading: req.isUrgent
                        ? const Icon(Icons.warning, color: Colors.red)
                        : const Icon(Icons.work_outline, color: Colors.indigo),
                    title: Text(
                      req.category,
                      style: const TextStyle(fontWeight: FontWeight.bold),
                    ),
                    subtitle: Text(req.description),
                    onTap: () {
                      // Ouvre l'écran de soumission d'offre pour cette demande
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (_) => SubmitOfferScreen(requestId: req.id),
                        ),
                      );
                    },
                  ),
                );
              },
            ),
          );
        },
      ),
    );
  }
}
