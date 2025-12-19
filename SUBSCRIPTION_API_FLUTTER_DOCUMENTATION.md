# Subscription API Documentation for Flutter Developers

## Overview

This document provides comprehensive API documentation for the Subscription (Abonelik) module endpoints. These endpoints allow you to manage subscriptions including listing, creating, updating, and deleting subscription records.

**Base URL:** `https://ugbusiness.com.tr/api2/`

---

## Table of Contents

1. [Get Subscriptions List](#1-get-subscriptions-list)
2. [Create Subscription](#2-create-subscription)
3. [Update Subscription](#3-update-subscription)
4. [Delete Subscription](#4-delete-subscription)
5. [Data Models](#data-models)
6. [Error Handling](#error-handling)
7. [Flutter Implementation Examples](#flutter-implementation-examples)

---

## 1. Get Subscriptions List

Retrieves a list of all subscriptions ordered by end date (ascending).

### Endpoint
```
GET /api2/abonelikler
POST /api2/abonelikler
```

### Request

**Method:** `GET` or `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Query Parameters (GET):** None

**Request Body (POST):** Empty object `{}` or no body

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Abonelikler başarıyla getirildi.",
  "data": [
    {
      "abonelik_id": 1,
      "abonelik_baslik": "Premium Subscription",
      "abonelik_aciklama": "Premium subscription package",
      "abonelik_baslangic_tarihi": "2024-01-01",
      "abonelik_bitis_tarihi": "2024-12-31",
      "abonelik_aktif": 1
    },
    {
      "abonelik_id": 2,
      "abonelik_baslik": "Basic Subscription",
      "abonelik_aciklama": "Basic subscription package",
      "abonelik_baslangic_tarihi": "2024-06-01",
      "abonelik_bitis_tarihi": "2024-12-31",
      "abonelik_aktif": 1
    }
  ],
  "toplam_kayit": 2,
  "timestamp": "2024-12-18 20:00:00"
}
```

### Flutter Example

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;

Future<List<Subscription>> getSubscriptions() async {
  try {
    final response = await http.get(
      Uri.parse('https://ugbusiness.com.tr/api2/abonelikler'),
      headers: {'Content-Type': 'application/json'},
    );

    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      if (jsonData['status'] == 'success') {
        List<dynamic> data = jsonData['data'];
        return data.map((item) => Subscription.fromJson(item)).toList();
      } else {
        throw Exception('Failed to load subscriptions: ${jsonData['message']}');
      }
    } else {
      throw Exception('Failed to load subscriptions: ${response.statusCode}');
    }
  } catch (e) {
    throw Exception('Error fetching subscriptions: $e');
  }
}
```

---

## 2. Create Subscription

Creates a new subscription record.

### Endpoint
```
POST /api2/abonelik_ekle
```

### Request

**Method:** `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Request Body:**
```json
{
  "baslik": "Premium Subscription",
  "aciklama": "Premium subscription package with all features",
  "baslangic_tarihi": "2024-01-01",
  "bitis_tarihi": "2024-12-31"
}
```

**Required Fields:**
- `baslik` (string): Subscription title
- `baslangic_tarihi` (string): Start date in format `Y-m-d` (e.g., "2024-01-15")
- `bitis_tarihi` (string): End date in format `Y-m-d` (e.g., "2024-12-31")

**Optional Fields:**
- `aciklama` (string): Subscription description

**Validation Rules:**
- `baslangic_tarihi` must be a valid date in `Y-m-d` format
- `bitis_tarihi` must be a valid date in `Y-m-d` format
- `baslangic_tarihi` must be before or equal to `bitis_tarihi`

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Abonelik başarıyla oluşturuldu.",
  "data": {
    "abonelik_id": 3,
    "abonelik_baslik": "Premium Subscription",
    "abonelik_aciklama": "Premium subscription package with all features",
    "abonelik_baslangic_tarihi": "2024-01-01",
    "abonelik_bitis_tarihi": "2024-12-31"
  },
  "timestamp": "2024-12-18 20:00:00"
}
```

**Error Response (400 Bad Request):**
```json
{
  "status": "error",
  "message": "baslik alanı zorunludur."
}
```

**Error Response (400 Bad Request - Invalid Date):**
```json
{
  "status": "error",
  "message": "Geçersiz baslangic_tarihi formatı. Tarih formatı: Y-m-d (örn: 2024-01-15)"
}
```

**Error Response (400 Bad Request - Date Validation):**
```json
{
  "status": "error",
  "message": "baslangic_tarihi, bitis_tarihi'nden sonra olamaz."
}
```

### Flutter Example

```dart
Future<Subscription> createSubscription({
  required String baslik,
  required String baslangicTarihi,
  required String bitisTarihi,
  String? aciklama,
}) async {
  try {
    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/abonelik_ekle'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode({
        'baslik': baslik,
        'aciklama': aciklama ?? '',
        'baslangic_tarihi': baslangicTarihi,
        'bitis_tarihi': bitisTarihi,
      }),
    );

    final jsonData = json.decode(response.body);

    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return Subscription.fromJson(jsonData['data']);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to create subscription');
    }
  } catch (e) {
    throw Exception('Error creating subscription: $e');
  }
}
```

---

## 3. Update Subscription

Updates an existing subscription record. You can update any field individually or multiple fields at once.

### Endpoint
```
POST /api2/abonelik_guncelle
```

### Request

**Method:** `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Request Body:**
```json
{
  "abonelik_id": 1,
  "baslik": "Updated Premium Subscription",
  "aciklama": "Updated description",
  "baslangic_tarihi": "2024-02-01",
  "bitis_tarihi": "2024-12-31"
}
```

**Required Fields:**
- `abonelik_id` (integer): ID of the subscription to update

**Optional Fields (at least one must be provided):**
- `baslik` (string): Subscription title
- `aciklama` (string): Subscription description
- `baslangic_tarihi` (string): Start date in format `Y-m-d`
- `bitis_tarihi` (string): End date in format `Y-m-d`

**Validation Rules:**
- If both `baslangic_tarihi` and `bitis_tarihi` are provided, start date must be before or equal to end date
- If only one date is updated, it must be validated against the existing date in the database
- Date format must be `Y-m-d` (e.g., "2024-01-15")
- `baslik` cannot be empty if provided

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Abonelik başarıyla güncellendi.",
  "data": {
    "abonelik_id": 1,
    "abonelik_baslik": "Updated Premium Subscription",
    "abonelik_aciklama": "Updated description",
    "abonelik_baslangic_tarihi": "2024-02-01",
    "abonelik_bitis_tarihi": "2024-12-31"
  },
  "timestamp": "2024-12-18 20:00:00"
}
```

**Error Response (400 Bad Request):**
```json
{
  "status": "error",
  "message": "abonelik_id gereklidir."
}
```

**Error Response (404 Not Found):**
```json
{
  "status": "error",
  "message": "Geçersiz abonelik ID."
}
```

**Error Response (400 Bad Request - No Fields):**
```json
{
  "status": "error",
  "message": "Güncellenecek alan belirtilmedi."
}
```

### Flutter Example

```dart
Future<Subscription> updateSubscription({
  required int abonelikId,
  String? baslik,
  String? aciklama,
  String? baslangicTarihi,
  String? bitisTarihi,
}) async {
  try {
    Map<String, dynamic> body = {'abonelik_id': abonelikId};
    
    if (baslik != null) body['baslik'] = baslik;
    if (aciklama != null) body['aciklama'] = aciklama;
    if (baslangicTarihi != null) body['baslangic_tarihi'] = baslangicTarihi;
    if (bitisTarihi != null) body['bitis_tarihi'] = bitisTarihi;

    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/abonelik_guncelle'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode(body),
    );

    final jsonData = json.decode(response.body);

    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return Subscription.fromJson(jsonData['data']);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to update subscription');
    }
  } catch (e) {
    throw Exception('Error updating subscription: $e');
  }
}
```

---

## 4. Delete Subscription

Deletes a subscription record by ID.

### Endpoint
```
POST /api2/abonelik_sil
```

### Request

**Method:** `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Request Body:**
```json
{
  "abonelik_id": 1
}
```

**Required Fields:**
- `abonelik_id` (integer): ID of the subscription to delete

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Abonelik başarıyla silindi.",
  "abonelik_id": 1,
  "timestamp": "2024-12-18 20:00:00"
}
```

**Error Response (400 Bad Request):**
```json
{
  "status": "error",
  "message": "abonelik_id gereklidir."
}
```

**Error Response (404 Not Found):**
```json
{
  "status": "error",
  "message": "Geçersiz abonelik ID."
}
```

### Flutter Example

```dart
Future<bool> deleteSubscription(int abonelikId) async {
  try {
    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/abonelik_sil'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode({'abonelik_id': abonelikId}),
    );

    final jsonData = json.decode(response.body);

    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return true;
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to delete subscription');
    }
  } catch (e) {
    throw Exception('Error deleting subscription: $e');
  }
}
```

---

## Data Models

### Subscription Model

```dart
class Subscription {
  final int abonelikId;
  final String abonelikBaslik;
  final String? abonelikAciklama;
  final String abonelikBaslangicTarihi;
  final String abonelikBitisTarihi;
  final int abonelikAktif;

  Subscription({
    required this.abonelikId,
    required this.abonelikBaslik,
    this.abonelikAciklama,
    required this.abonelikBaslangicTarihi,
    required this.abonelikBitisTarihi,
    required this.abonelikAktif,
  });

  factory Subscription.fromJson(Map<String, dynamic> json) {
    return Subscription(
      abonelikId: json['abonelik_id'] as int,
      abonelikBaslik: json['abonelik_baslik'] as String,
      abonelikAciklama: json['abonelik_aciklama'] as String?,
      abonelikBaslangicTarihi: json['abonelik_baslangic_tarihi'] as String,
      abonelikBitisTarihi: json['abonelik_bitis_tarihi'] as String,
      abonelikAktif: json['abonelik_aktif'] as int? ?? 1,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'abonelik_id': abonelikId,
      'abonelik_baslik': abonelikBaslik,
      'abonelik_aciklama': abonelikAciklama,
      'abonelik_baslangic_tarihi': abonelikBaslangicTarihi,
      'abonelik_bitis_tarihi': abonelikBitisTarihi,
      'abonelik_aktif': abonelikAktif,
    };
  }

  // Helper method to check if subscription is active
  bool get isActive => abonelikAktif == 1;

  // Helper method to check if subscription is expired
  bool get isExpired {
    final endDate = DateTime.parse(abonelikBitisTarihi);
    return endDate.isBefore(DateTime.now());
  }

  // Helper method to get remaining days
  int get remainingDays {
    final endDate = DateTime.parse(abonelikBitisTarihi);
    final now = DateTime.now();
    if (endDate.isBefore(now)) return 0;
    return endDate.difference(now).inDays;
  }
}
```

---

## Error Handling

### Common Error Codes

| Status Code | Description |
|-------------|-------------|
| 200 | Success |
| 400 | Bad Request (validation errors, missing required fields) |
| 404 | Not Found (subscription ID not found) |
| 405 | Method Not Allowed (wrong HTTP method) |
| 500 | Internal Server Error |

### Error Response Format

All error responses follow this format:

```json
{
  "status": "error",
  "message": "Error message description"
}
```

### Flutter Error Handling Example

```dart
class SubscriptionService {
  static Future<T> handleResponse<T>(http.Response response, T Function(Map<String, dynamic>) parser) async {
    final jsonData = json.decode(response.body);

    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return parser(jsonData);
    } else {
      final errorMessage = jsonData['message'] ?? 'Unknown error occurred';
      
      switch (response.statusCode) {
        case 400:
          throw ValidationException(errorMessage);
        case 404:
          throw NotFoundException(errorMessage);
        case 405:
          throw MethodNotAllowedException(errorMessage);
        case 500:
          throw ServerException(errorMessage);
        default:
          throw Exception(errorMessage);
      }
    }
  }
}

// Custom Exception Classes
class ValidationException implements Exception {
  final String message;
  ValidationException(this.message);
}

class NotFoundException implements Exception {
  final String message;
  NotFoundException(this.message);
}

class MethodNotAllowedException implements Exception {
  final String message;
  MethodNotAllowedException(this.message);
}

class ServerException implements Exception {
  final String message;
  ServerException(this.message);
}
```

---

## Flutter Implementation Examples

### Complete Service Class

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;

class SubscriptionApiService {
  static const String baseUrl = 'https://ugbusiness.com.tr/api2';

  // Get all subscriptions
  Future<List<Subscription>> getSubscriptions() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/abonelikler'),
        headers: {'Content-Type': 'application/json'},
      );

      return _handleListResponse(response);
    } catch (e) {
      throw Exception('Error fetching subscriptions: $e');
    }
  }

  // Create subscription
  Future<Subscription> createSubscription({
    required String baslik,
    required String baslangicTarihi,
    required String bitisTarihi,
    String? aciklama,
  }) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/abonelik_ekle'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'baslik': baslik,
          'aciklama': aciklama ?? '',
          'baslangic_tarihi': baslangicTarihi,
          'bitis_tarihi': bitisTarihi,
        }),
      );

      return _handleSingleResponse(response);
    } catch (e) {
      throw Exception('Error creating subscription: $e');
    }
  }

  // Update subscription
  Future<Subscription> updateSubscription({
    required int abonelikId,
    String? baslik,
    String? aciklama,
    String? baslangicTarihi,
    String? bitisTarihi,
  }) async {
    try {
      Map<String, dynamic> body = {'abonelik_id': abonelikId};
      if (baslik != null) body['baslik'] = baslik;
      if (aciklama != null) body['aciklama'] = aciklama;
      if (baslangicTarihi != null) body['baslangic_tarihi'] = baslangicTarihi;
      if (bitisTarihi != null) body['bitis_tarihi'] = bitisTarihi;

      final response = await http.post(
        Uri.parse('$baseUrl/abonelik_guncelle'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(body),
      );

      return _handleSingleResponse(response);
    } catch (e) {
      throw Exception('Error updating subscription: $e');
    }
  }

  // Delete subscription
  Future<bool> deleteSubscription(int abonelikId) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/abonelik_sil'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({'abonelik_id': abonelikId}),
      );

      final jsonData = json.decode(response.body);
      if (response.statusCode == 200 && jsonData['status'] == 'success') {
        return true;
      } else {
        throw Exception(jsonData['message'] ?? 'Failed to delete subscription');
      }
    } catch (e) {
      throw Exception('Error deleting subscription: $e');
    }
  }

  // Helper methods
  List<Subscription> _handleListResponse(http.Response response) {
    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      List<dynamic> data = jsonData['data'];
      return data.map((item) => Subscription.fromJson(item)).toList();
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to process response');
    }
  }

  Subscription _handleSingleResponse(http.Response response) {
    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return Subscription.fromJson(jsonData['data']);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to process response');
    }
  }
}
```

### Usage in Flutter Widget

```dart
import 'package:flutter/material.dart';

class SubscriptionListScreen extends StatefulWidget {
  @override
  _SubscriptionListScreenState createState() => _SubscriptionListScreenState();
}

class _SubscriptionListScreenState extends State<SubscriptionListScreen> {
  final SubscriptionApiService _apiService = SubscriptionApiService();
  List<Subscription> _subscriptions = [];
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _loadSubscriptions();
  }

  Future<void> _loadSubscriptions() async {
    setState(() => _isLoading = true);
    try {
      final subscriptions = await _apiService.getSubscriptions();
      setState(() {
        _subscriptions = subscriptions;
        _isLoading = false;
      });
    } catch (e) {
      setState(() => _isLoading = false);
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error: $e')),
      );
    }
  }

  Future<void> _deleteSubscription(int id) async {
    try {
      await _apiService.deleteSubscription(id);
      _loadSubscriptions(); // Refresh list
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Subscription deleted successfully')),
      );
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error deleting: $e')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Subscriptions')),
      body: _isLoading
          ? Center(child: CircularProgressIndicator())
          : ListView.builder(
              itemCount: _subscriptions.length,
              itemBuilder: (context, index) {
                final subscription = _subscriptions[index];
                return ListTile(
                  title: Text(subscription.abonelikBaslik),
                  subtitle: Text(
                    '${subscription.abonelikBaslangicTarihi} - ${subscription.abonelikBitisTarihi}',
                  ),
                  trailing: IconButton(
                    icon: Icon(Icons.delete),
                    onPressed: () => _deleteSubscription(subscription.abonelikId),
                  ),
                );
              },
            ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          // Navigate to create subscription screen
        },
        child: Icon(Icons.add),
      ),
    );
  }
}
```

---

## Date Format

All dates must be in the format: **`Y-m-d`** (e.g., "2024-01-15", "2024-12-31")

### Date Formatting Helper (Flutter)

```dart
extension DateTimeExtension on DateTime {
  String toApiFormat() {
    return '${year.toString().padLeft(4, '0')}-${month.toString().padLeft(2, '0')}-${day.toString().padLeft(2, '0')}';
  }
}

// Usage
final startDate = DateTime.now().toApiFormat(); // "2024-12-18"
```

---

## Notes

1. **Authentication:** Currently, these endpoints do not require authentication tokens. However, this may change in the future.

2. **Date Validation:** The API validates that the start date is not after the end date. Make sure to validate dates on the client side before sending requests.

3. **Error Messages:** All error messages are in Turkish. You may want to create a translation map for better user experience.

4. **Pagination:** The list endpoint currently returns all subscriptions. If you expect a large number of records, consider implementing pagination on the client side.

5. **Caching:** Consider implementing caching for the subscription list to reduce API calls and improve performance.

---

## Support

For issues or questions regarding the Subscription API, please contact the development team.

---

*Last Updated: 2024-12-18*
*API Version: 2.0*
