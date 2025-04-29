 
 
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">
<div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Kampanya Paylaşım Kayıtları</h3>

              <div class="card-tools">
                <button type="button" onclick="yeni_kayit_olustur();" class="btn btn-tool btn-success"  >
                  Yeni Kayıt Oluştur
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr> <th>İşlemler </th>
                    <th style="width:200px">Detay</th>
                    <th>Paylaşım Tarihi</th>
                    <th><img style="width:20px" src="https://ugbusiness.com.tr/assets/dist/img/icon_instagram.png"> Instagram</th>
                    <th><img style="width:20px" src="https://ugbusiness.com.tr/assets/dist/img/icon_facebook.png"> Facebook</th>
                    <th><img style="width:20px" src="https://cdn.iconscout.com/icon/free/png-256/free-youtube-logo-icon-download-in-svg-png-gif-file-formats--social-media-70-flat-icons-color-pack-logos-432560.png"> Youtube</th>
                    <th><img style="width:20px" src="https://cdn0.iconfinder.com/data/icons/social-network-flat-4/512/whatsapp_icon-512.png"> Whatsapp</th>
                    <th><i class="fa fa-globe nav-icon" style="font-size:13px;font-size: 19px; color:rgb(38, 0, 255);"></i> Website</th>
                    <th><i class="fa fa-envelope nav-icon" style="font-size:13px;font-size: 19px; color: #ff7800;"></i> SMS</th> 
                  </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($paylasim_data as $data) {
                 ?>
                  <tr>
                    <td>
                    <button class="btn btn-warning btn-sm" onclick="paylasim_guncelle(
    '<?=$data->paylasim_takip_id?>',
    '<?=htmlspecialchars($data->paylasim_adi, ENT_QUOTES)?>',
    '<?=date('Y-m-d', strtotime($data->paylasim_tarihi))?>'
  )">
    Düzenle
  </button>

  <button class="btn btn-danger btn-sm" onclick="paylasimSil(<?=$data->paylasim_takip_id?>)">Sil</button>
                    </td>
                    <td><?=$data->paylasim_adi?></td>
                    <td><?=date("d.m.Y H:i",strtotime($data->paylasim_tarihi))?></td>
                    <td>
                         
                          <?php 
                          if($data->instagram == 0){
                            ?>

                  <a href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/instagram/1")?>" type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Beklemede</a>


                           
                                                
                            <?php
                          }else{
                            ?>
                           <a href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/instagram/0")?>" type="button" class="btn btn-success btn-block btn-sm"><i class="fa fa-check"></i> Yayınlandı</a>
                            <?php
                          }
                          ?>
                          
                      </td>
                    <td>
                    <?php 
                          if($data->facebook == 0){
                            ?>

                  <a href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/facebook/1")?>" type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Beklemede</a>


                           
                                                
                            <?php
                          }else{
                            ?>
                           <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/facebook/0")?>" type="button" class="btn btn-success btn-block btn-sm"><i class="fa fa-check"></i> Yayınlandı</a>
                            <?php
                          }
                          ?>
                      </td>
                    <td>
                    <?php 
                          if($data->youtube == 0){
                            ?>

                  <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/youtube/1")?>" type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Beklemede</a>


                           
                                                
                            <?php
                          }else{
                            ?>
                           <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/youtube/0")?>" type="button" class="btn btn-success btn-block btn-sm"><i class="fa fa-check"></i> Yayınlandı</a>
                            <?php
                          }
                          ?>
                      </td>
                    <td>
                    <?php 
                          if($data->whatsapp == 0){
                            ?>

                  <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/whatsapp/1")?>" type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Beklemede</a>


                           
                                                
                            <?php
                          }else{
                            ?>
                           <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/whatsapp/0")?>" type="button" class="btn btn-success btn-block btn-sm"><i class="fa fa-check"></i> Yayınlandı</a>
                            <?php
                          }
                          ?>
                      </td>
                    <td>
                    <?php 
                          if($data->website == 0){
                            ?>

                  <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/website/1")?>" type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Beklemede</a>


                           
                                                
                            <?php
                          }else{
                            ?>
                           <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/website/0")?>" type="button" class="btn btn-success btn-block btn-sm"><i class="fa fa-check"></i> Yayınlandı</a>
                            <?php
                          }
                          ?>
                      </td>
                    <td>
                    <?php 
                          if($data->sms == 0){
                            ?>

                  <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/sms/1")?>" type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Beklemede</a>


                           
                                                
                            <?php
                          }else{
                            ?>
                           <a  href="<?=base_url("paylasim/update_state/$data->paylasim_takip_id/sms/0")?>" type="button" class="btn btn-success btn-block btn-sm"><i class="fa fa-check"></i> Yayınlandı</a>
                            <?php
                          }
                          ?>
                      </td>
                  </tr>
                 <?php
                }
                ?>
                     </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
</section>
            </div>









            <script>
              

function yeni_kayit_olustur() {




Swal.fire({
      title: "Paylaşım Kaydı Oluştur",
      html: 'Paylaşım Başlık<br><input id="paylasim_adi" type="text" placeholder="Paylaşım Başlık Bilgisini Giriniz" style="max-width: 100%;" class="swal2-input">' +
          '<br>Paylaşım Tarihi <br><input type="date" id="paylasim_tarihi"   class="swal2-input"></input>',
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#098f23",
      confirmButtonText: "Tamam",
      cancelButtonText: "İptal",
      allowOutsideClick: false,
      showConfirmButton: true,
      preConfirm: () => {
       var paylasim_adi = document.getElementById('paylasim_adi').value;
       var paylasim_tarihi = document.getElementById('paylasim_tarihi').value;

          if (!paylasim_adi || !paylasim_tarihi) {
            Swal.showValidationMessage("Lütfen tüm zorunlu alanları doldurun");
              return false;
          } else {

          
              $.ajax({
                  type: "POST",
                  data: {
                      'paylasim_adi': paylasim_adi,
                      'paylasim_tarihi': paylasim_tarihi,
                  },
                  url: 'https://ugbusiness.com.tr/paylasim/paylasim_kaydet',
                  success: function (data) {
                      location.reload();
                  },
                  error: function (data) {
                      Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                  }
              });
            

          }

      }
  });
}



function paylasim_guncelle(id, mevcutAdi, mevcutTarih) {
  Swal.fire({
    title: "Paylaşım Kaydı Güncelle",
    html: 'Paylaşım Başlık<br><input id="paylasim_adi" type="text" value="'+mevcutAdi+'" class="swal2-input">' +
          '<br>Paylaşım Tarihi<br><input id="paylasim_tarihi" type="date" value="'+mevcutTarih+'" class="swal2-input">',
    showCancelButton: true,
    confirmButtonText: 'Güncelle',
    cancelButtonText: 'İptal',
    preConfirm: () => {
      var paylasim_adi = document.getElementById('paylasim_adi').value;
      var paylasim_tarihi = document.getElementById('paylasim_tarihi').value;

      if (!paylasim_adi || !paylasim_tarihi) {
        Swal.showValidationMessage("Tüm alanları doldurun");
        return false;
      }

      return $.ajax({
        type: "POST",
        url: "https://ugbusiness.com.tr/paylasim/paylasim_guncelle/" + id,
        data: {
          paylasim_adi: paylasim_adi,
          paylasim_tarihi: paylasim_tarihi
        },
        success: function () {
          Swal.fire("Başarılı", "Paylaşım güncellendi", "success").then(() => {
            location.reload();
          });
        },
        error: function () {
          Swal.fire("Hata", "Güncelleme sırasında bir hata oluştu", "error");
        }
      });
    }
  });
}
function paylasimSil(id) {
    Swal.fire({
        title: "Emin misiniz?",
        text: "Bu paylaşım kalıcı olarak silinecek!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Evet, sil!",
        cancelButtonText: "Vazgeç"
    }).then((result) => {
        if (result.isConfirmed) {
            $.get('<?=base_url("paylasim/paylasim_sil/")?>' + id, function() {
                location.reload();
            });
        }
    });
}

              </script>