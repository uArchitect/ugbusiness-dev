<div class="container mt-5" style="background:white">
        <h2>Abonelikler</h2>
        
        

<!-- 
 
        <h1>Fotoğraf Çek ve Gönder</h1>

 
<video id="video" width="320" height="240" autoplay></video>
<br>
 
<button id="snap">Fotoğraf Çek</button>
 
<canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
<br>
 
<form id="photoForm" action="your-server-endpoint" method="POST">
  <input type="hidden" name="photo" id="photoData">
  <button type="submit">Gönder</button>
</form> --> 
<!-- 
<script>
  // Video elementi ve canvas
  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const context = canvas.getContext('2d');
  const photoDataInput = document.getElementById('photoData');

  // Kamera izni iste ve video akışını başlat
  navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((error) => {
      alert('Kamera açılırken bir hata oluştu!');
    });

  // Fotoğraf çekme işlemi
  document.getElementById('snap').addEventListener('click', () => {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Fotoğrafı base64 formatında al
    const photoData = canvas.toDataURL('image/png');
    
    // Fotoğrafı formda gizli inputa ekle
    photoDataInput.value = photoData;
  });

  // Form gönderme işlemi
  document.getElementById('photoForm').addEventListener('submit', (e) => {
    e.preventDefault(); // Sayfanın yenilenmesini engelle
    alert('Fotoğraf gönderildi!');
    // Burada formu AJAX ile gönderebilirsiniz
    // Örneğin, fetch API veya XMLHttpRequest ile
    // form.submit();
  });
</script>
-->









        <a href="<?php echo site_url('abonelik/ekle'); ?>" class="btn btn-success mb-3">Yeni Abonelik Ekle</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abonelikler as $abonelik): 
                    $bitis_tarihi = strtotime($abonelik->abonelik_bitis_tarihi);
                    $current_date = strtotime(date('Y-m-d'));
                    $days_remaining = ($bitis_tarihi - $current_date) / (60 * 60 * 24);
                    $row_class = $days_remaining <= 15 ? 'alert-danger blink' : '';
                ?>
                <tr class="<?php echo $row_class; ?>">
                    <td><?php echo $abonelik->abonelik_id; ?></td>
                    <td><?php echo $abonelik->abonelik_baslik; ?></td>
                    <td><?php echo $abonelik->abonelik_aciklama; ?></td>
                    <td><?php echo $abonelik->abonelik_baslangic_tarihi; ?></td>
                    <td><?php echo $abonelik->abonelik_bitis_tarihi; ?></td>
                    <td>
            <a href="<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>" class="btn btn-warning">Düzenle</a>
        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <style>
        .wrapper{
            background:white!important;
        }
        </style>