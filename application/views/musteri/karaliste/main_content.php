 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
<div class="card card-danger col-md-6">
 
 <div class="card-body">
 <form action="<?=base_url("musteri/karaliste_view")?>" method="POST" onsubmit="return validateInput()">
    <div class="row">
        <div class="col-md-9">
            <label for="karaListeNumarasi">Tekrar Aranmak İstemeyen Müşteri Numarası</label>
            <input type="text" required name="kara_liste_iletisim_numarasi" id="karaListeNumarasi" class="form-control" maxlength="11" oninput="maskNumber(this)">
            <small id="error-message" style="color: red; display: none;">Numara "05" ile başlamalı ve 11 karakter olmalıdır.</small>
        </div>
        <div class="col-md-3">
            <label for="exampleInputEmasil1">&nbsp;</label>
            <button type="submit" id="exampleInputEmasil1" class="btn btn-block btn-success btn-lg">Kaydet</button>
        </div>
    </div>
</form>

<script>
function maskNumber(input) {
    // Eğer 0 ile başlıyorsa ve kullanıcı "5" ekliyorsa, "05" olacak şekilde ayarla
    if (input.value.length === 0) {
        input.value = '05'; // İlk iki karakter "05" yap
    } else if (input.value.length === 1 && input.value !== '0') {
        input.value = '0' + input.value; // İlk karakter "0" yap
    }

    // Sadece rakamları al ve 11 karaktere kadar sınırlı tut
    const value = input.value.replace(/\D/g, '').substring(0, 11);
    input.value = value;
    
    // "05" ile başlamıyorsa hata mesajını göster
    const errorMessage = document.getElementById('error-message');
    if (!value.startsWith('05') || value.length < 11) {
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none';
    }
}

function validateInput() {
    const input = document.getElementById('karaListeNumarasi').value;
    if (!input.startsWith('05') || input.length !== 11) {
        document.getElementById('error-message').style.display = 'block';
        return false; // Formu göndermeyi engelle
    }
    return true; // Formu göndermeye izin ver
}
</script>


 
 </div>
 
 </div>
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - TEKRAR ARANMAK İSTEMEYEN MÜŞTERİ LİSTESİ</h3>
                   </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Müşteri İletişim Numarası</th>
                    <th>Kaydeden Kullanıcı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($numaralar as $numara) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      <td> 
                       <?=$numara->kara_liste_iletisim_numarasi?> 
                    </td>
                      
                    <td> 
                       <?=$numara->kullanici_ad_soyad?> 
                    </td>
                    <td> 
                       <?=date("d.m.Y H:i",strtotime($numara->kara_liste_kayit_tarihi))?> 
                    </td>
                        
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Müşteri İletişim Numarası</th>
                    <th>Kaydeden Kullanıcı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>