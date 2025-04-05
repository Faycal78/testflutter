class ServiceRequest {
  final String id;
  final String category;
  final String description;
  final bool isUrgent;

  ServiceRequest({
    required this.id,
    required this.category,
    required this.description,
    required this.isUrgent,
  });

  factory ServiceRequest.fromJson(Map<String, dynamic> json) {
    return ServiceRequest(
      id: json['id'].toString(),
      category: json['category'],
      description: json['description'] ?? '',
      isUrgent: json['is_urgent'] ?? false,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'category': category,
      'description': description,
      'is_urgent': isUrgent,
    };
  }
}
