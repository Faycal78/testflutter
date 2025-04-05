import 'package:flutter/material.dart';
import '../models/service_request.dart';
import '../services/api_service.dart';

class CreateServiceRequestScreen extends StatefulWidget {
  const CreateServiceRequestScreen({Key? key}) : super(key: key);

  @override
  _CreateServiceRequestScreenState createState() => _CreateServiceRequestScreenState();
}

class _CreateServiceRequestScreenState extends State<CreateServiceRequestScreen> {
  final _descriptionController = TextEditingController();
  String _selectedCategory = 'plumbing';
  bool _isUrgent = false;
  bool _loading = false;

  Future<void> _submitRequest() async {
    setState(() => _loading = true);
    ServiceRequest request = ServiceRequest(
      id: '',
      category: _selectedCategory,
      description: _descriptionController.text,
      isUrgent: _isUrgent,
    );
    final success = await ApiService.createServiceRequest(request);
    setState(() => _loading = false);
    if (success) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Demande envoyée avec succès')),
      );
      // Par exemple, revenir ou réinitialiser le formulaire
      _descriptionController.clear();
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Erreur lors de l\'envoi')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Nouvelle Demande')),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Card(
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
          elevation: 6,
          child: Padding(
            padding: const EdgeInsets.all(20),
            child: Column(
              children: [
                DropdownButtonFormField<String>(
                  value: _selectedCategory,
                  decoration: const InputDecoration(
                    labelText: 'Catégorie',
                    prefixIcon: Icon(Icons.category),
                  ),
                  items: const [
                    DropdownMenuItem(child: Text('Plomberie'), value: 'plumbing'),
                    DropdownMenuItem(child: Text('Électricité'), value: 'electricity'),
                    DropdownMenuItem(child: Text('Nettoyage'), value: 'cleaning'),
                  ],
                  onChanged: (value) {
                    if (value != null) setState(() => _selectedCategory = value);
                  },
                ),
                const SizedBox(height: 16),
                TextField(
                  controller: _descriptionController,
                  decoration: const InputDecoration(
                    labelText: 'Description',
                    prefixIcon: Icon(Icons.description),
                  ),
                  maxLines: 3,
                ),
                const SizedBox(height: 16),
                Row(
                  children: [
                    const Text('Urgent'),
                    Checkbox(
                      value: _isUrgent,
                      onChanged: (value) => setState(() => _isUrgent = value ?? false),
                    ),
                  ],
                ),
                const SizedBox(height: 24),
                _loading
                    ? const CircularProgressIndicator()
                    : ElevatedButton(
                        onPressed: _submitRequest,
                        child: const Text('Envoyer la demande'),
                      ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
