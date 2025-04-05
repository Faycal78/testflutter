import 'package:flutter/material.dart';
import '../models/offer.dart';
import '../services/api_service.dart';

class SubmitOfferScreen extends StatefulWidget {
  final String requestId;
  const SubmitOfferScreen({Key? key, required this.requestId}) : super(key: key);
  @override
  _SubmitOfferScreenState createState() => _SubmitOfferScreenState();
}

class _SubmitOfferScreenState extends State<SubmitOfferScreen> {
  final _priceController = TextEditingController();
  final _descriptionController = TextEditingController();
  bool _loading = false;

  void _submitOffer() async {
    setState(() => _loading = true);
    Offer offer = Offer(
      providerName: '', // Peut être défini par le backend selon l'utilisateur connecté
      price: double.tryParse(_priceController.text) ?? 0,
      description: _descriptionController.text,
    );
    final success = await ApiService.submitOffer(widget.requestId, offer);
    setState(() => _loading = false);
    if (success) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Offre soumise')),
      );
      Navigator.pop(context);
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Erreur lors de la soumission')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Soumettre une offre')),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Card(
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
          elevation: 6,
          child: Padding(
            padding: const EdgeInsets.all(20),
            child: Column(
              children: [
                TextField(
                  controller: _priceController,
                  decoration: const InputDecoration(
                    labelText: 'Prix',
                    prefixIcon: Icon(Icons.attach_money),
                  ),
                  keyboardType: TextInputType.number,
                ),
                const SizedBox(height: 16),
                TextField(
                  controller: _descriptionController,
                  decoration: const InputDecoration(
                    labelText: 'Description de l\'offre',
                    prefixIcon: Icon(Icons.description),
                  ),
                  maxLines: 3,
                ),
                const SizedBox(height: 24),
                _loading
                    ? const CircularProgressIndicator()
                    : ElevatedButton(
                        onPressed: _submitOffer,
                        child: const Text('Envoyer l\'offre'),
                      ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
