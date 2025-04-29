 
 
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">
<div class="card card-dark">
            <div class="card-header">
              <h3 class="card-title">Kampanya Paylaşım Kayıtları</h3>

              <div class="card-tools">
                <button type="button" onclick="yeni_kayit_olustur();" class="btn btn-tool"  >
                  Yeni Kayıt Oluştur
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Kampanya / Paylaşım Başlık</th>
                    <th>Paylaşım Tarihi</th>
                    <th><img style="width:20px" src="https://ugbusiness.com.tr/assets/dist/img/icon_instagram.png"> Instagram</th>
                    <th><img style="width:20px" src="https://ugbusiness.com.tr/assets/dist/img/icon_facebook.png"> Facebook</th>
                    <th><img style="width:20px" src="https://cdn.iconscout.com/icon/free/png-256/free-youtube-logo-icon-download-in-svg-png-gif-file-formats--social-media-70-flat-icons-color-pack-logos-432560.png"> Youtube</th>
                    <th><img style="width:20px" src="https://cdn0.iconfinder.com/data/icons/social-network-flat-4/512/whatsapp_icon-512.png"> Whatsapp</th>
                    <th>Website</th>
                    <th>SMS</th> 
                  </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($paylasim_data as $data) {
                 ?>
                  <tr>
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
      title: "Km Kaydı Oluştur",
      html: 'Yeni Km Bilgisi<br><input id="km1" type="number" placeholder="Km" style="max-width: 100%;" class="swal2-input">' +
          '<br>Açıklama (Opsiyonel)<br><textarea id="aciklama1" placeholder="Açıklama" class="swal2-textarea"></textarea>',
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#098f23",
      confirmButtonText: "Tamam",
      cancelButtonText: "İptal",
      allowOutsideClick: false,
      showConfirmButton: true,
      preConfirm: () => {
       var km = document.getElementById('km1').value;
       var aciklama = document.getElementById('aciklama1').value;

          if (!km) {
            Swal.showValidationMessage("Lütfen tüm zorunlu alanları doldurun");
              return false;
          } else {

          
              $.ajax({
                  type: "POST",
                  data: {
                      'arac_km_deger': km,
                      'arac_km_aciklama': aciklama,
                  },
                  url: 'https://ugbusiness.com.tr/arac/arac_km_kaydet/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
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

              </script>