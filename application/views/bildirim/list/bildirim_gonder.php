<?php

require 'vendor/autoload.php';

use Google\Auth\OAuth2;

function sendFirebaseNotification($deviceToken, $title, $body)
{
    $projectId = 'umexcomtr'; // Firebase projenin ID'si
    $credentialsPath = __DIR__ . '/service-account.json'; // İndirdiğin hizmet hesabı JSON dosyası
echo  $credentialsPath;
    // Access Token al
    $oauth = new OAuth2([
        'audience' => 'https://oauth2.googleapis.com/token',
        'issuer' => json_decode(file_get_contents($credentialsPath))->client_email,
        'signingAlgorithm' => 'RS256',
        'signingKey' => json_decode(file_get_contents($credentialsPath))->private_key,
        'tokenCredentialUri' => 'https://oauth2.googleapis.com/token',
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
    ]);

    $authToken = $oauth->fetchAuthToken();
    $accessToken = $authToken['access_token'];

    $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

    $message = [
        "message" => [
            "token" => $deviceToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            "android" => [
                "priority" => "high"
            ],
            "apns" => [
                "headers" => [
                    "apns-priority" => "10"
                ]
            ]
        ]
    ];

    $headers = [
        "Authorization: Bearer " . $accessToken,
        "Content-Type: application/json"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

// Kullanım
$token = "ey_PMPjK8FnC1iVyUIFfRl:APA91bG5jni_5ik8MIEMeW5BrX7aEutHJdDias4-YmNVpElG4I-pMgAklimQqJXq1RIdOr0sE_TrCDCCpLd6jnSmAAz1Iv2ol4XLVYiQOkzzwVoF8mFMKOQ";
$title = "Yeni Mesaj!";
$body = "Bu güncel v1 API ile gönderildi.";

$response = sendFirebaseNotification($token, $title, $body);
echo $response;

?>
