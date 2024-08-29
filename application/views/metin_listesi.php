<!DOCTYPE html>
<html>
<head>
    <title>Metin Listesi</title>

</head>
<body style="font-family:arial;">
 
    <table border="1" style="border-color:black">
        <tr>
            <th style="padding:5px;width:8%;background:black;color:white;">İşlem</th>
            <th style="padding:5px;width:19%;background:black;color:white;">Türkçe</th>
            <th style="padding:5px;width:19%;background:black;color:white;">Almanca</th>
            <th style="padding:5px;width:19%;background:black;color:white;">Arapça</th>
            <th style="padding:5px;width:19%;background:black;color:white;">İngilizce</th>
            <th style="padding:5px;width:19%;background:black;color:white;">Rusça</th>
        </tr>
        <?php foreach ($metinler as $metin): ?>
        <tr>
            <td><a style="padding:10px;padding-right:0px;padding-left:0px;cursor:pointer;background:orange;min-width:100%;height:100%;display:block;text-align:Center;font-weight:bold;" href="<?= site_url('metinler/guncelle/' . $metin->metin_id); ?>">GÜNCELLE</a></td>
            <td style="padding:5px;"><?= $metin->metin_turkce; ?></td>
            <td style="padding:10px;padding-left:15px;"><?= $metin->metin_almanca != "" ? $metin->metin_almanca : "<span style='color:red;'># Tanımlanmadı</span>" ?></td>
            <td style="padding:10px;padding-left:15px;direction: rtl;"><?= $metin->metin_arapca != "" ? $metin->metin_arapca : "<span style='color:red;'># Tanımlanmadı</span>" ?></td>
            <td style="padding:10px;padding-left:15px;"><?= $metin->metin_ingilizce != "" ? $metin->metin_ingilizce : "<span style='color:red;'># Tanımlanmadı</span>" ?></td>
            <td style="padding:10px;padding-left:15px;"><?= $metin->metin_rusca != "" ? $metin->metin_rusca : "<span style='color:red;'># Tanımlanmadı</span>" ?></td>
            
         
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
         function showWindow($url) {
        
        var width = 790;
      var height = 770;

    
      var left = (screen.width / 2) - (width / 2);
      var top = (screen.height / 2) - (height / 2);
      var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

     
      var interval = setInterval(function() {
          if (newWindow.closed) {
              clearInterval(interval);
              window.location.reload();
            
          }
      }, 500);

    }
        </script>
</body>
</html>
