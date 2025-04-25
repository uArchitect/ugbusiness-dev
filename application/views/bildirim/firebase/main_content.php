 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Öneri, Şikayet ve Talep Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Öneri, Şikayet ve Talep Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Form Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($bildirim)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('bildirim/save').'/'.$bildirim->bildirim_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('bildirim/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Bildirim Konusu</label>
        <input type="text" value="<?php echo  !empty($bildirim) ? $bildirim->bildirim_konusu : '';?>" class="form-control" name="bildirim_konusu" required="" placeholder="Bildirim Konusu Giriniz..." autofocus="">
           </div>

      <div class="form-group">
        <label for="formClient-Code"> Bildirim Açıklama</label>
        <input type="text" value="<?php echo !empty($bildirim) ? $bildirim->bildirim_detay : '';?>" class="form-control" name="bildirim_detay" placeholder="Bildirim Açıklamasını Giriniz..." autofocus="">
         </div>
  
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("bildirim")?>"  class="btn btn-flat btn-danger"> İptal</a></div>

        <?php 
          switch ($bildirim->kalite_durum) {
            case 'value':
              # code...
              break;
            
            default:
              # code...
              break;
          }
        ?>
        
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>




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
