class Offer {
  final String providerName; // nom du provider (si renvoyé par le backend)
  final double price;
  final String description;

  Offer({
    required this.providerName,
    required this.price,
    required this.description,
  });

  factory Offer.fromJson(Map<String, dynamic> json) {
    return Offer(
      providerName: json['provider_name'] ?? 'Inconnu',
      price: double.tryParse(json['price'].toString()) ?? 0,
      description: json['description'] ?? '',
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'price': price,
      'description': description,
    };
  }
}
