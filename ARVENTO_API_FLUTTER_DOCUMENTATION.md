# Arvento API - Comprehensive Documentation for Flutter Developers

## Overview

This document provides comprehensive API documentation for the Arvento vehicle tracking module. The Arvento module integrates with Arvento's SOAP web services to provide real-time vehicle tracking, fuel monitoring, speed alarm management, and location services.

**Base URL:** `https://ugbusiness.com.tr/api2/`

**External Service:** All endpoints connect to Arvento's SOAP service at `https://ws.arvento.com/v1/report.asmx`

**Authentication:** Arvento service credentials are handled server-side (Username: `ugteknoloji1`, PIN: `Umexapi.2425`)

---

## Table of Contents

1. [Get Driver-Node Mappings](#1-get-driver-node-mappings)
2. [Get Fuel Information](#2-get-fuel-information)
3. [Get Speed Alarms](#3-get-speed-alarms)
4. [Get Vehicle Locations (Map)](#4-get-vehicle-locations-map)
5. [Get License Plate Information](#5-get-license-plate-information)
6. [Get Driver Information](#6-get-driver-information)

---

## 1. Get Driver-Node Mappings

Retrieves driver-to-device node mappings from Arvento service. This endpoint is used to get a list of all drivers and their associated device nodes.

**Controller Reference:** `Arvento.php::index()` (lines 12-99)  
**View Reference:** `arvento/main_content.php` (lines 24-44)

### Endpoint
```
GET /api2/arvento_surucu_node_eslestirmeleri
POST /api2/arvento_surucu_node_eslestirmeleri
```

### Request

**Method:** `GET` or `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Query Parameters (GET):**
- `kullanici_id` (optional, integer): User ID to get associated vehicle information

**Request Body (POST):**
```json
{
  "kullanici_id": 5
}
```

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Sürücü-node eşleştirmeleri başarıyla getirildi.",
  "data": [
    {
      "driver": "Ahmet Yılmaz",
      "node": "K1200007333"
    },
    {
      "driver": "Mehmet Demir",
      "node": "K1200007334"
    }
  ],
  "arac_bilgisi": {
    "arac_id": 1,
    "arac_plaka": "34ABC123",
    "arac_arvento_key": "K1200007333"
  },
  "toplam_kayit": 2,
  "timestamp": "2024-12-18 20:00:00"
}
```

**Field Descriptions:**
- `data`: Array of driver-node mappings
  - `driver` (string): Driver name
  - `node` (string): Device node ID (unique identifier for Arvento device)
- `arac_bilgisi` (object, nullable): Vehicle information for the user if `kullanici_id` is provided
  - `arac_id` (integer): Vehicle ID
  - `arac_plaka` (string, nullable): License plate
  - `arac_arvento_key` (string, nullable): Arvento device key

### Flutter Example

```dart
Future<ArventoDriverNodeResponse> getArventoDriverNodeMappings({int? kullaniciId}) async {
  try {
    Map<String, dynamic> body = {};
    if (kullaniciId != null) body['kullanici_id'] = kullaniciId;

    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/arvento_surucu_node_eslestirmeleri'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode(body),
    );

    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return ArventoDriverNodeResponse.fromJson(jsonData);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to load driver-node mappings');
    }
  } catch (e) {
    throw Exception('Error fetching driver-node mappings: $e');
  }
}
```

---

## 2. Get Fuel Information

Retrieves fuel consumption information for a specific device node from Arvento service. This endpoint provides CANBUS fuel level data including fuel level changes, odometer readings, and timestamps.

**Controller Reference:** `Arvento.php::get_yakit()` (lines 102-165)  
**View Reference:** `arvento_rapor/main_content.php` (lines 73-101)

### Endpoint
```
GET /api2/arvento_yakit_bilgileri
POST /api2/arvento_yakit_bilgileri
```

### Request

**Method:** `GET` or `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Query Parameters (GET):**
- `node` (required, string): Device node ID (e.g., "K1200007333")
- `baslangic_tarihi` (optional, string): Start date in format `Y-m-d` or `Y-m-d H:i:s` (default: 7 days ago)
- `bitis_tarihi` (optional, string): End date in format `Y-m-d` or `Y-m-d H:i:s` (default: current date)

**Request Body (POST):**
```json
{
  "node": "K1200007333",
  "baslangic_tarihi": "2024-12-11 00:00:00",
  "bitis_tarihi": "2024-12-18 23:59:59"
}
```

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Yakıt bilgileri başarıyla getirildi.",
  "data": [
    {
      "kayit_no": "12345",
      "cihaz": "Device123",
      "plaka": "34ABC123",
      "surucu": "Ahmet Yılmaz",
      "tarih_saat": "2024-12-18 10:30:00",
      "durum": "Normal",
      "deger": "45.5",
      "odometre": "125000"
    }
  ],
  "araclar": [
    {
      "arac_id": 1,
      "arac_plaka": "34ABC123",
      "arac_arvento_key": "K1200007333"
    }
  ],
  "filtreler": {
    "node": "K1200007333",
    "baslangic_tarihi": "12112024000000",
    "bitis_tarihi": "12182024000000"
  },
  "toplam_kayit": 1,
  "timestamp": "2024-12-18 20:00:00"
}
```

**Field Descriptions:**
- `data`: Array of fuel records
  - `kayit_no` (string, nullable): Record number
  - `cihaz` (string, nullable): Device name
  - `plaka` (string, nullable): License plate
  - `surucu` (string): Driver name (default: "N/A" if not available)
  - `tarih_saat` (string, nullable): Date and time in format from Arvento service
  - `durum` (string, nullable): Status (e.g., "Normal", "Düşük", etc.)
  - `deger` (string, nullable): Fuel level value (percentage or liters)
  - `odometre` (string, nullable): Odometer reading
- `araclar`: Array of all vehicles with Arvento keys
- `filtreler`: Applied filters (dates are in Arvento format: `mdYHis`)

**Note:** The view displays `tarih_saat` formatted as `d.m.Y H:i:s` using PHP's `date()` function. In Flutter, you should parse the date string and format it accordingly.

### Flutter Example

```dart
Future<ArventoYakitResponse> getArventoYakitBilgileri({
  required String node,
  String? baslangicTarihi,
  String? bitisTarihi,
}) async {
  try {
    Map<String, dynamic> body = {'node': node};
    if (baslangicTarihi != null) body['baslangic_tarihi'] = baslangicTarihi;
    if (bitisTarihi != null) body['bitis_tarihi'] = bitisTarihi;

    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/arvento_yakit_bilgileri'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode(body),
    );

    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return ArventoYakitResponse.fromJson(jsonData);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to load fuel information');
    }
  } catch (e) {
    throw Exception('Error fetching fuel information: $e');
  }
}
```

---

## 3. Get Speed Alarms

Retrieves speed violation alarms from Arvento service. This endpoint provides real-time speed limit violations with location, speed, and duration information.

**Controller Reference:** `Arvento.php::get_speed_alarm_data()` (lines 167-249)  
**View Reference:** `arvento/main_content.php` (lines 152-181)

### Endpoint
```
GET /api2/arvento_hiz_uyarilari
POST /api2/arvento_hiz_uyarilari
```

### Request

**Method:** `GET` or `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Query Parameters (GET):**
- `node` (optional, string): Device node ID (default: "K1200007333")
- `baslangic_tarihi` (optional, string): Start date in format `Y-m-d` or `Y-m-d H:i:s` (default: 15 minutes ago)
- `bitis_tarihi` (optional, string): End date in format `Y-m-d` or `Y-m-d H:i:s` (default: current date)
- `group` (optional, integer): Group ID (default: 0)

**Request Body (POST):**
```json
{
  "node": "K1200007333",
  "baslangic_tarihi": "2024-12-18 10:00:00",
  "bitis_tarihi": "2024-12-18 11:00:00",
  "group": 0
}
```

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Hız uyarıları başarıyla getirildi.",
  "data": [
    {
      "device_no": "K1200007333",
      "license_plate": "34ABC123",
      "driver": "Ahmet Yılmaz",
      "date": "2024-12-18 10:30:00",
      "limit": "80",
      "speed": "95",
      "duration": "120",
      "address": "İstanbul, Kadıköy"
    }
  ],
  "filtreler": {
    "node": "K1200007333",
    "baslangic_tarihi": "12182024100000",
    "bitis_tarihi": "12182024110000",
    "group": 0
  },
  "toplam_kayit": 1,
  "timestamp": "2024-12-18 20:00:00"
}
```

**Field Descriptions:**
- `data`: Array of speed alarm records
  - `device_no` (string, nullable): Device node ID
  - `license_plate` (string, nullable): License plate
  - `driver` (string, nullable): Driver name
  - `date` (string, nullable): Date and time of violation
  - `limit` (string, nullable): Speed limit (km/h)
  - `speed` (string, nullable): Actual speed (km/h)
  - `duration` (string, nullable): Violation duration in seconds
  - `address` (string, nullable): Location/address of violation

**Note:** The view displays alarms sorted by date (newest first) and formats the date using `new Date(alarm.Date).toLocaleString('tr-TR')`. In Flutter, parse and format the date accordingly.

### Flutter Example

```dart
Future<ArventoSpeedAlarmResponse> getArventoHizUyarilari({
  String? node,
  String? baslangicTarihi,
  String? bitisTarihi,
  int? group,
}) async {
  try {
    Map<String, dynamic> body = {};
    if (node != null) body['node'] = node;
    if (baslangicTarihi != null) body['baslangic_tarihi'] = baslangicTarihi;
    if (bitisTarihi != null) body['bitis_tarihi'] = bitisTarihi;
    if (group != null) body['group'] = group;

    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/arvento_hiz_uyarilari'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode(body),
    );

    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return ArventoSpeedAlarmResponse.fromJson(jsonData);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to load speed alarms');
    }
  } catch (e) {
    throw Exception('Error fetching speed alarms: $e');
  }
}
```

---

## 4. Get Vehicle Locations (Map)

Retrieves real-time vehicle locations from Arvento service for map display. This endpoint provides latitude, longitude, node ID, and current speed for all active vehicles.

**Controller Reference:** `Anasayfa.php::get_vehicles()` (lines 84-217)  
**View Reference:** `arvento/main_content.php` (lines 283-374)

### Endpoint
```
GET /api2/arvento_arac_konumlari
POST /api2/arvento_arac_konumlari
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

**Request Body (POST):**
```json
{}
```

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Araç konumları başarıyla getirildi.",
  "data": [
    {
      "lat": 41.0082,
      "lng": 28.9784,
      "node": "K1200007333",
      "speed": 65.5
    },
    {
      "lat": 39.9334,
      "lng": 32.8597,
      "node": "K1200007334",
      "speed": 0
    }
  ],
  "toplam_kayit": 2,
  "timestamp": "2024-12-18 20:00:00"
}
```

**Field Descriptions:**
- `data`: Array of vehicle location pins
  - `lat` (float): Latitude coordinate
  - `lng` (float): Longitude coordinate
  - `node` (string, nullable): Device node ID
  - `speed` (float): Current speed in km/h (0 if stationary)

**Important Notes:**
- Only valid coordinates (non-zero lat/lng) are returned
- The view updates markers every 10 seconds using `setInterval(updateMarkers, 10000)`
- Speed > 0 indicates a moving vehicle (view uses `movingIcon`), speed = 0 indicates stationary (view uses `customIcon`)
- The view displays vehicle information (plaka, surucu) by fetching from separate endpoints (`get_plaka`, `get_surucu`) using the node ID

### Flutter Example

```dart
Future<ArventoAracKonumlariResponse> getArventoAracKonumlari() async {
  try {
    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/arvento_arac_konumlari'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode({}),
    );

    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return ArventoAracKonumlariResponse.fromJson(jsonData);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to load vehicle locations');
    }
  } catch (e) {
    throw Exception('Error fetching vehicle locations: $e');
  }
}
```

---

## 5. Get License Plate Information

Retrieves license plate information for a specific device node from the local database.

**Controller Reference:** `Anasayfa.php::get_plaka()` (lines 58-69)  
**View Reference:** `arvento/main_content.php` (lines 210-228)

### Endpoint
```
GET /api2/arvento_plaka_bilgisi
POST /api2/arvento_plaka_bilgisi
```

### Request

**Method:** `GET` or `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Query Parameters (GET):**
- `node` (required, string): Device node ID

**Request Body (POST):**
```json
{
  "node": "K1200007333"
}
```

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Plaka bilgisi getirildi.",
  "data": {
    "node": "K1200007333",
    "plaka": "34ABC123"
  },
  "timestamp": "2024-12-18 20:00:00"
}
```

**Not Found Response (200 OK):**
```json
{
  "status": "success",
  "message": "Plaka bilgisi bulunamadı.",
  "data": {
    "node": "K1200007333",
    "plaka": "-"
  },
  "timestamp": "2024-12-18 20:00:00"
}
```

**Field Descriptions:**
- `data`:
  - `node` (string): Device node ID
  - `plaka` (string): License plate (returns "-" if not found)

**Database Table:** `arvento`  
**Query:** `SELECT arvento_plaka FROM arvento WHERE arvento_cihaz_no = ?`

### Flutter Example

```dart
Future<ArventoPlakaResponse> getArventoPlakaBilgisi(String node) async {
  try {
    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/arvento_plaka_bilgisi'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode({'node': node}),
    );

    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return ArventoPlakaResponse.fromJson(jsonData);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to load license plate');
    }
  } catch (e) {
    throw Exception('Error fetching license plate: $e');
  }
}
```

---

## 6. Get Driver Information

Retrieves driver information for a specific device node from the local database.

**Controller Reference:** `Anasayfa.php::get_surucu()` (lines 71-82)  
**View Reference:** `arvento/main_content.php` (lines 231-246)

### Endpoint
```
GET /api2/arvento_surucu_bilgisi
POST /api2/arvento_surucu_bilgisi
```

### Request

**Method:** `GET` or `POST`

**Headers:**
```dart
{
  'Content-Type': 'application/json',
}
```

**Query Parameters (GET):**
- `node` (required, string): Device node ID

**Request Body (POST):**
```json
{
  "node": "K1200007333"
}
```

### Response

**Success Response (200 OK):**
```json
{
  "status": "success",
  "message": "Sürücü bilgisi getirildi.",
  "data": {
    "node": "K1200007333",
    "surucu": "Ahmet Yılmaz"
  },
  "timestamp": "2024-12-18 20:00:00"
}
```

**Not Found Response (200 OK):**
```json
{
  "status": "success",
  "message": "Sürücü bilgisi bulunamadı.",
  "data": {
    "node": "K1200007333",
    "surucu": "-"
  },
  "timestamp": "2024-12-18 20:00:00"
}
```

**Field Descriptions:**
- `data`:
  - `node` (string): Device node ID
  - `surucu` (string): Driver name (returns "-" if not found)

**Database Table:** `arvento`  
**Query:** `SELECT arvento_surucu FROM arvento WHERE arvento_cihaz_no = ?`

### Flutter Example

```dart
Future<ArventoSurucuResponse> getArventoSurucuBilgisi(String node) async {
  try {
    final response = await http.post(
      Uri.parse('https://ugbusiness.com.tr/api2/arvento_surucu_bilgisi'),
      headers: {'Content-Type': 'application/json'},
      body: json.encode({'node': node}),
    );

    final jsonData = json.decode(response.body);
    if (response.statusCode == 200 && jsonData['status'] == 'success') {
      return ArventoSurucuResponse.fromJson(jsonData);
    } else {
      throw Exception(jsonData['message'] ?? 'Failed to load driver information');
    }
  } catch (e) {
    throw Exception('Error fetching driver information: $e');
  }
}
```

---

## Data Models

### ArventoDriverNodeResponse Model

```dart
class ArventoDriverNodeResponse {
  final String status;
  final String message;
  final List<DriverNodeMapping> data;
  final AracBilgisi? aracBilgisi;
  final int toplamKayit;
  final String timestamp;

  ArventoDriverNodeResponse({
    required this.status,
    required this.message,
    required this.data,
    this.aracBilgisi,
    required this.toplamKayit,
    required this.timestamp,
  });

  factory ArventoDriverNodeResponse.fromJson(Map<String, dynamic> json) {
    return ArventoDriverNodeResponse(
      status: json['status'] as String,
      message: json['message'] as String,
      data: (json['data'] as List<dynamic>)
          .map((item) => DriverNodeMapping.fromJson(item))
          .toList(),
      aracBilgisi: json['arac_bilgisi'] != null
          ? AracBilgisi.fromJson(json['arac_bilgisi'] as Map<String, dynamic>)
          : null,
      toplamKayit: json['toplam_kayit'] as int,
      timestamp: json['timestamp'] as String,
    );
  }
}

class DriverNodeMapping {
  final String driver;
  final String node;

  DriverNodeMapping({
    required this.driver,
    required this.node,
  });

  factory DriverNodeMapping.fromJson(Map<String, dynamic> json) {
    return DriverNodeMapping(
      driver: json['driver'] as String,
      node: json['node'] as String,
    );
  }
}

class AracBilgisi {
  final int aracId;
  final String? aracPlaka;
  final String? aracArventoKey;

  AracBilgisi({
    required this.aracId,
    this.aracPlaka,
    this.aracArventoKey,
  });

  factory AracBilgisi.fromJson(Map<String, dynamic> json) {
    return AracBilgisi(
      aracId: json['arac_id'] as int,
      aracPlaka: json['arac_plaka'] as String?,
      aracArventoKey: json['arac_arvento_key'] as String?,
    );
  }
}
```

### ArventoYakitResponse Model

```dart
class ArventoYakitResponse {
  final String status;
  final String message;
  final List<YakitBilgisi> data;
  final List<Arac> araclar;
  final Filtreler filtreler;
  final int toplamKayit;
  final String timestamp;

  ArventoYakitResponse({
    required this.status,
    required this.message,
    required this.data,
    required this.araclar,
    required this.filtreler,
    required this.toplamKayit,
    required this.timestamp,
  });

  factory ArventoYakitResponse.fromJson(Map<String, dynamic> json) {
    return ArventoYakitResponse(
      status: json['status'] as String,
      message: json['message'] as String,
      data: (json['data'] as List<dynamic>)
          .map((item) => YakitBilgisi.fromJson(item))
          .toList(),
      araclar: (json['araclar'] as List<dynamic>)
          .map((item) => Arac.fromJson(item))
          .toList(),
      filtreler: Filtreler.fromJson(json['filtreler'] as Map<String, dynamic>),
      toplamKayit: json['toplam_kayit'] as int,
      timestamp: json['timestamp'] as String,
    );
  }
}

class YakitBilgisi {
  final String? kayitNo;
  final String? cihaz;
  final String? plaka;
  final String? surucu;
  final String? tarihSaat;
  final String? durum;
  final String? deger;
  final String? odometre;

  YakitBilgisi({
    this.kayitNo,
    this.cihaz,
    this.plaka,
    this.surucu,
    this.tarihSaat,
    this.durum,
    this.deger,
    this.odometre,
  });

  factory YakitBilgisi.fromJson(Map<String, dynamic> json) {
    return YakitBilgisi(
      kayitNo: json['kayit_no'] as String?,
      cihaz: json['cihaz'] as String?,
      plaka: json['plaka'] as String?,
      surucu: json['surucu'] as String?,
      tarihSaat: json['tarih_saat'] as String?,
      durum: json['durum'] as String?,
      deger: json['deger'] as String?,
      odometre: json['odometre'] as String?,
    );
  }

  // Helper method to format date
  String? get formattedTarihSaat {
    if (tarihSaat == null) return null;
    try {
      final date = DateTime.parse(tarihSaat!);
      return '${date.day.toString().padLeft(2, '0')}.${date.month.toString().padLeft(2, '0')}.${date.year} ${date.hour.toString().padLeft(2, '0')}:${date.minute.toString().padLeft(2, '0')}:${date.second.toString().padLeft(2, '0')}';
    } catch (e) {
      return tarihSaat;
    }
  }
}

class Arac {
  final int aracId;
  final String? aracPlaka;
  final String? aracArventoKey;

  Arac({
    required this.aracId,
    this.aracPlaka,
    this.aracArventoKey,
  });

  factory Arac.fromJson(Map<String, dynamic> json) {
    return Arac(
      aracId: json['arac_id'] as int,
      aracPlaka: json['arac_plaka'] as String?,
      aracArventoKey: json['arac_arvento_key'] as String?,
    );
  }
}

class Filtreler {
  final String node;
  final String baslangicTarihi;
  final String bitisTarihi;

  Filtreler({
    required this.node,
    required this.baslangicTarihi,
    required this.bitisTarihi,
  });

  factory Filtreler.fromJson(Map<String, dynamic> json) {
    return Filtreler(
      node: json['node'] as String,
      baslangicTarihi: json['baslangic_tarihi'] as String,
      bitisTarihi: json['bitis_tarihi'] as String,
    );
  }
}
```

### ArventoSpeedAlarmResponse Model

```dart
class ArventoSpeedAlarmResponse {
  final String status;
  final String message;
  final List<SpeedAlarm> data;
  final SpeedAlarmFiltreler filtreler;
  final int toplamKayit;
  final String timestamp;

  ArventoSpeedAlarmResponse({
    required this.status,
    required this.message,
    required this.data,
    required this.filtreler,
    required this.toplamKayit,
    required this.timestamp,
  });

  factory ArventoSpeedAlarmResponse.fromJson(Map<String, dynamic> json) {
    return ArventoSpeedAlarmResponse(
      status: json['status'] as String,
      message: json['message'] as String,
      data: (json['data'] as List<dynamic>)
          .map((item) => SpeedAlarm.fromJson(item))
          .toList(),
      filtreler: SpeedAlarmFiltreler.fromJson(json['filtreler'] as Map<String, dynamic>),
      toplamKayit: json['toplam_kayit'] as int,
      timestamp: json['timestamp'] as String,
    );
  }
}

class SpeedAlarm {
  final String? deviceNo;
  final String? licensePlate;
  final String? driver;
  final String? date;
  final String? limit;
  final String? speed;
  final String? duration;
  final String? address;

  SpeedAlarm({
    this.deviceNo,
    this.licensePlate,
    this.driver,
    this.date,
    this.limit,
    this.speed,
    this.duration,
    this.address,
  });

  factory SpeedAlarm.fromJson(Map<String, dynamic> json) {
    return SpeedAlarm(
      deviceNo: json['device_no'] as String?,
      licensePlate: json['license_plate'] as String?,
      driver: json['driver'] as String?,
      date: json['date'] as String?,
      limit: json['limit'] as String?,
      speed: json['speed'] as String?,
      duration: json['duration'] as String?,
      address: json['address'] as String?,
    );
  }

  // Helper method to format date
  String? get formattedDate {
    if (date == null) return null;
    try {
      final dateTime = DateTime.parse(date!);
      return dateTime.toLocal().toString();
    } catch (e) {
      return date;
    }
  }
}

class SpeedAlarmFiltreler {
  final String node;
  final String baslangicTarihi;
  final String bitisTarihi;
  final int group;

  SpeedAlarmFiltreler({
    required this.node,
    required this.baslangicTarihi,
    required this.bitisTarihi,
    required this.group,
  });

  factory SpeedAlarmFiltreler.fromJson(Map<String, dynamic> json) {
    return SpeedAlarmFiltreler(
      node: json['node'] as String,
      baslangicTarihi: json['baslangic_tarihi'] as String,
      bitisTarihi: json['bitis_tarihi'] as String,
      group: json['group'] as int,
    );
  }
}
```

### ArventoAracKonumlariResponse Model

```dart
class ArventoAracKonumlariResponse {
  final String status;
  final String message;
  final List<AracKonumu> data;
  final int toplamKayit;
  final String timestamp;

  ArventoAracKonumlariResponse({
    required this.status,
    required this.message,
    required this.data,
    required this.toplamKayit,
    required this.timestamp,
  });

  factory ArventoAracKonumlariResponse.fromJson(Map<String, dynamic> json) {
    return ArventoAracKonumlariResponse(
      status: json['status'] as String,
      message: json['message'] as String,
      data: (json['data'] as List<dynamic>)
          .map((item) => AracKonumu.fromJson(item))
          .toList(),
      toplamKayit: json['toplam_kayit'] as int,
      timestamp: json['timestamp'] as String,
    );
  }
}

class AracKonumu {
  final double lat;
  final double lng;
  final String? node;
  final double speed;

  AracKonumu({
    required this.lat,
    required this.lng,
    this.node,
    required this.speed,
  });

  factory AracKonumu.fromJson(Map<String, dynamic> json) {
    return AracKonumu(
      lat: (json['lat'] as num).toDouble(),
      lng: (json['lng'] as num).toDouble(),
      node: json['node'] as String?,
      speed: (json['speed'] as num).toDouble(),
    );
  }

  bool get isMoving => speed > 0;
}
```

### ArventoPlakaResponse Model

```dart
class ArventoPlakaResponse {
  final String status;
  final String message;
  final PlakaData data;
  final String timestamp;

  ArventoPlakaResponse({
    required this.status,
    required this.message,
    required this.data,
    required this.timestamp,
  });

  factory ArventoPlakaResponse.fromJson(Map<String, dynamic> json) {
    return ArventoPlakaResponse(
      status: json['status'] as String,
      message: json['message'] as String,
      data: PlakaData.fromJson(json['data'] as Map<String, dynamic>),
      timestamp: json['timestamp'] as String,
    );
  }
}

class PlakaData {
  final String node;
  final String plaka;

  PlakaData({
    required this.node,
    required this.plaka,
  });

  factory PlakaData.fromJson(Map<String, dynamic> json) {
    return PlakaData(
      node: json['node'] as String,
      plaka: json['plaka'] as String,
    );
  }
}
```

### ArventoSurucuResponse Model

```dart
class ArventoSurucuResponse {
  final String status;
  final String message;
  final SurucuData data;
  final String timestamp;

  ArventoSurucuResponse({
    required this.status,
    required this.message,
    required this.data,
    required this.timestamp,
  });

  factory ArventoSurucuResponse.fromJson(Map<String, dynamic> json) {
    return ArventoSurucuResponse(
      status: json['status'] as String,
      message: json['message'] as String,
      data: SurucuData.fromJson(json['data'] as Map<String, dynamic>),
      timestamp: json['timestamp'] as String,
    );
  }
}

class SurucuData {
  final String node;
  final String surucu;

  SurucuData({
    required this.node,
    required this.surucu,
  });

  factory SurucuData.fromJson(Map<String, dynamic> json) {
    return SurucuData(
      node: json['node'] as String,
      surucu: json['surucu'] as String,
    );
  }
}
```

---

## Complete Service Class Example

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;

class ArventoApiService {
  static const String baseUrl = 'https://ugbusiness.com.tr/api2';

  // Get driver-node mappings
  Future<ArventoDriverNodeResponse> getArventoDriverNodeMappings({int? kullaniciId}) async {
    try {
      Map<String, dynamic> body = {};
      if (kullaniciId != null) body['kullanici_id'] = kullaniciId;

      final response = await http.post(
        Uri.parse('$baseUrl/arvento_surucu_node_eslestirmeleri'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(body),
      );

      final jsonData = json.decode(response.body);
      if (response.statusCode == 200 && jsonData['status'] == 'success') {
        return ArventoDriverNodeResponse.fromJson(jsonData);
      } else {
        throw Exception(jsonData['message'] ?? 'Failed to load driver-node mappings');
      }
    } catch (e) {
      throw Exception('Error fetching driver-node mappings: $e');
    }
  }

  // Get fuel information
  Future<ArventoYakitResponse> getArventoYakitBilgileri({
    required String node,
    String? baslangicTarihi,
    String? bitisTarihi,
  }) async {
    try {
      Map<String, dynamic> body = {'node': node};
      if (baslangicTarihi != null) body['baslangic_tarihi'] = baslangicTarihi;
      if (bitisTarihi != null) body['bitis_tarihi'] = bitisTarihi;

      final response = await http.post(
        Uri.parse('$baseUrl/arvento_yakit_bilgileri'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(body),
      );

      final jsonData = json.decode(response.body);
      if (response.statusCode == 200 && jsonData['status'] == 'success') {
        return ArventoYakitResponse.fromJson(jsonData);
      } else {
        throw Exception(jsonData['message'] ?? 'Failed to load fuel information');
      }
    } catch (e) {
      throw Exception('Error fetching fuel information: $e');
    }
  }

  // Get speed alarms
  Future<ArventoSpeedAlarmResponse> getArventoHizUyarilari({
    String? node,
    String? baslangicTarihi,
    String? bitisTarihi,
    int? group,
  }) async {
    try {
      Map<String, dynamic> body = {};
      if (node != null) body['node'] = node;
      if (baslangicTarihi != null) body['baslangic_tarihi'] = baslangicTarihi;
      if (bitisTarihi != null) body['bitis_tarihi'] = bitisTarihi;
      if (group != null) body['group'] = group;

      final response = await http.post(
        Uri.parse('$baseUrl/arvento_hiz_uyarilari'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(body),
      );

      final jsonData = json.decode(response.body);
      if (response.statusCode == 200 && jsonData['status'] == 'success') {
        return ArventoSpeedAlarmResponse.fromJson(jsonData);
      } else {
        throw Exception(jsonData['message'] ?? 'Failed to load speed alarms');
      }
    } catch (e) {
      throw Exception('Error fetching speed alarms: $e');
    }
  }

  // Get vehicle locations
  Future<ArventoAracKonumlariResponse> getArventoAracKonumlari() async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/arvento_arac_konumlari'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({}),
      );

      final jsonData = json.decode(response.body);
      if (response.statusCode == 200 && jsonData['status'] == 'success') {
        return ArventoAracKonumlariResponse.fromJson(jsonData);
      } else {
        throw Exception(jsonData['message'] ?? 'Failed to load vehicle locations');
      }
    } catch (e) {
      throw Exception('Error fetching vehicle locations: $e');
    }
  }

  // Get license plate
  Future<ArventoPlakaResponse> getArventoPlakaBilgisi(String node) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/arvento_plaka_bilgisi'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({'node': node}),
      );

      final jsonData = json.decode(response.body);
      if (response.statusCode == 200 && jsonData['status'] == 'success') {
        return ArventoPlakaResponse.fromJson(jsonData);
      } else {
        throw Exception(jsonData['message'] ?? 'Failed to load license plate');
      }
    } catch (e) {
      throw Exception('Error fetching license plate: $e');
    }
  }

  // Get driver information
  Future<ArventoSurucuResponse> getArventoSurucuBilgisi(String node) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/arvento_surucu_bilgisi'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({'node': node}),
      );

      final jsonData = json.decode(response.body);
      if (response.statusCode == 200 && jsonData['status'] == 'success') {
        return ArventoSurucuResponse.fromJson(jsonData);
      } else {
        throw Exception(jsonData['message'] ?? 'Failed to load driver information');
      }
    } catch (e) {
      throw Exception('Error fetching driver information: $e');
    }
  }
}
```

---

## Usage Examples

### Example 1: Display Driver-Node Mappings with User Vehicle

```dart
final response = await ArventoApiService().getArventoDriverNodeMappings(
  kullaniciId: 5,
);

print('Driver-Node Mappings: ${response.data.length}');
for (var mapping in response.data) {
  print('Driver: ${mapping.driver} - Node: ${mapping.node}');
}

if (response.aracBilgisi != null) {
  print('User Vehicle: ${response.aracBilgisi!.aracPlaka}');
  print('Arvento Key: ${response.aracBilgisi!.aracArventoKey}');
}
```

### Example 2: Get Fuel Information and Display in Table

```dart
final response = await ArventoApiService().getArventoYakitBilgileri(
  node: 'K1200007333',
  baslangicTarihi: '2024-12-11 00:00:00',
  bitisTarihi: '2024-12-18 23:59:59',
);

print('Fuel Records: ${response.toplamKayit}');
for (var yakit in response.data) {
  print('Date: ${yakit.formattedTarihSaat}');
  print('Fuel Level: ${yakit.deger}');
  print('Odometer: ${yakit.odometre}');
  print('Driver: ${yakit.surucu}');
  print('Status: ${yakit.durum}');
}
```

### Example 3: Display Speed Alarms in Real-Time

```dart
// Poll every 10 seconds (matching web view behavior)
Timer.periodic(Duration(seconds: 10), (timer) async {
  final now = DateTime.now();
  final oneHourAgo = now.subtract(Duration(hours: 1));

  final response = await ArventoApiService().getArventoHizUyarilari(
    node: 'K1200007333',
    baslangicTarihi: oneHourAgo.toIso8601String(),
    bitisTarihi: now.toIso8601String(),
  );

  // Sort by date (newest first)
  final sortedAlarms = response.data..sort((a, b) {
    if (a.date == null || b.date == null) return 0;
    return DateTime.parse(b.date!).compareTo(DateTime.parse(a.date!));
  });

  for (var alarm in sortedAlarms) {
    print('Vehicle: ${alarm.licensePlate} - ${alarm.driver}');
    print('Speed: ${alarm.speed} km/h (Limit: ${alarm.limit} km/h)');
    print('Duration: ${alarm.duration} seconds');
    print('Location: ${alarm.address}');
    print('Time: ${alarm.formattedDate}');
  }
});
```

### Example 4: Display Vehicle Locations on Map

```dart
// Update every 10 seconds (matching web view behavior)
Timer.periodic(Duration(seconds: 10), (timer) async {
  final response = await ArventoApiService().getArventoAracKonumlari();

  for (var konum in response.data) {
    // Add marker to map
    final marker = Marker(
      markerId: MarkerId(konum.node ?? 'unknown'),
      position: LatLng(konum.lat, konum.lng),
      icon: konum.isMoving ? movingIcon : stationaryIcon,
      infoWindow: InfoWindow(
        title: 'Vehicle ${konum.node}',
        snippet: 'Speed: ${konum.speed} km/h',
      ),
    );

    // Fetch additional info
    final plakaResponse = await ArventoApiService().getArventoPlakaBilgisi(konum.node ?? '');
    final surucuResponse = await ArventoApiService().getArventoSurucuBilgisi(konum.node ?? '');

    // Update marker info with plaka and surucu
    marker.infoWindow = InfoWindow(
      title: plakaResponse.data.plaka,
      snippet: '${surucuResponse.data.surucu}\nSpeed: ${konum.speed} km/h',
    );
  }
});
```

---

## Important Notes

### 1. External SOAP Service
All endpoints (except plaka and surucu) connect to Arvento's external SOAP service at `https://ws.arvento.com/v1/report.asmx`. Network errors or service unavailability will result in appropriate error responses.

### 2. Date Format Conversion
- **Input dates** should be in format `Y-m-d` or `Y-m-d H:i:s` (e.g., "2024-12-18" or "2024-12-18 10:30:00")
- **Arvento format** is `mdYHis` (e.g., "12182024100000" = December 18, 2024, 10:00:00)
- The API automatically converts input dates to Arvento format
- **Response dates** from Arvento may be in various formats; parse them carefully in Flutter

### 3. Node ID
Device node IDs are unique identifiers for Arvento devices (e.g., "K1200007333"). These are used to:
- Query specific vehicle information
- Filter fuel data
- Filter speed alarms
- Match locations with vehicle information

### 4. Default Date Ranges
- **Fuel Information**: Defaults to last 7 days if not specified
- **Speed Alarms**: Defaults to last 15 minutes if not specified

### 5. Real-Time Updates
The web view updates vehicle locations and speed alarms every 10 seconds using `setInterval`. In Flutter, use `Timer.periodic(Duration(seconds: 10))` to achieve similar behavior.

### 6. Vehicle Status Indicators
- **Speed > 0**: Vehicle is moving (use moving icon)
- **Speed = 0**: Vehicle is stationary (use stationary icon)

### 7. Database Tables
- **`arvento`**: Stores local vehicle information (plaka, surucu) mapped by `arvento_cihaz_no` (node)
- **`araclar`**: Stores vehicle information with `arac_arvento_key` field

### 8. Read-Only Operations
All endpoints are read-only. No create, update, or delete operations are available through the API.

### 9. Error Handling
- **400 Bad Request**: Missing required parameters (e.g., `node`)
- **405 Method Not Allowed**: Wrong HTTP method
- **500 Internal Server Error**: Arvento service error, connection issues, or XML parsing errors

### 10. Response Format Consistency
All endpoints return a consistent response structure:
```json
{
  "status": "success" | "error",
  "message": "Description",
  "data": {...},
  "timestamp": "Y-m-d H:i:s"
}
```

---

## Date Format Helper (Flutter)

```dart
extension DateTimeExtension on DateTime {
  // Convert to Arvento format (mdYHis)
  String toArventoFormat() {
    return '${month.toString().padLeft(2, '0')}${day.toString().padLeft(2, '0')}${year}${hour.toString().padLeft(2, '0')}${minute.toString().padLeft(2, '0')}${second.toString().padLeft(2, '0')}';
  }
}

// Usage
final date = DateTime.now();
final arventoFormat = date.toArventoFormat(); // "12182024100000"
```

---

## Error Handling

### Common Error Codes

| Status Code | Description |
|-------------|-------------|
| 200 | Success |
| 400 | Bad Request (missing required fields) |
| 405 | Method Not Allowed (wrong HTTP method) |
| 500 | Internal Server Error (Arvento service error, connection issues) |

### Error Response Format

```json
{
  "status": "error",
  "message": "Error message description"
}
```

### Example Error Handling

```dart
try {
  final response = await ArventoApiService().getArventoAracKonumlari();
  // Handle success
} on SocketException {
  // Network error
  print('Network error: Unable to connect to Arvento service');
} on HttpException catch (e) {
  // HTTP error
  print('HTTP error: ${e.message}');
} catch (e) {
  // Other errors
  print('Error: $e');
}
```

---

*Last Updated: 2024-12-18*  
*API Version: 2.0*  
*Controller References: Arvento.php, Anasayfa.php*  
*View References: arvento/main_content.php, arvento_rapor/main_content.php*
