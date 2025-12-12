<?php $this->load->view('musteri/includes/styles'); ?>

<div class="content-wrapper content-wrapper-musteri">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-musteri">
          <!-- Card Header -->
          <div class="card-header card-header-musteri">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-exclamation-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Muhasebe - Borçlu Müşteri Kayıtları
                  </h3>
                  <small class="card-header-subtitle">Borçlu müşteri ve cihaz kayıtlarını görüntüle</small>
                </div>
              </div>
              <div class="d-flex align-items-center gap-2">
                <a href="<?=base_url("cihaz/borclu_cihazlar_excel_export")?>" onclick="exportToExcel(event, '<?=base_url("cihaz/borclu_cihazlar_excel_export")?>');" type="button" class="btn btn-success btn-sm">
                  <i class="fa fa-file-excel"></i> Excel'e Aktar
                </a>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('musteri/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-musteri">
            <div class="card-body-content">
              <div class="row d-none">
                <div class="col">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Başlatılmamış Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-clock text-warning"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col p-0">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Devam Eden Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-checkmark text-success"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Sona Eren Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-alert text-danger"></i>
                    </div>
                    <a href="<?=base_url("cihaz/garanti-suresi-biten-cihazlar")?>" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col p-0 pr-2">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Tüm Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-folder text-primary"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
              
              <!-- Borçlu Kayıt Ekleme Formu -->
              <div class="card card-danger col-12 mb-3">
                <div class="card-body">
                  <form action="<?=base_url("cihaz/borclu_kayit_ekle")?>" method="POST">
                    <div class="row">
                      <div class="col-md-4">
                        <label for="exampleInputEmail1">Yeni Borçlu Cihaz Kaydı Oluştur</label>
                        <input type="text" required name="borclu_seri_numarasi" id="exampleInputEmail1" class="form-control" placeholder="UG00000000UX01">
                      </div>
                      <div class="col-md-5">
                        <label for="exampleInputEmail1">Borç Detay / Açıklama</label>
                        <input type="text" required name="borclu_aciklama" id="exampleInputEmail1" class="form-control" placeholder="Açıklama giriniz">
                      </div>
                      <div class="col-md-3">
                        <label for="exampleInputEmasil1">&nbsp;</label>
                        <button type="submit" id="exampleInputEmasil1" class="btn btn-block btn-success btn-lg">Borçlu Olarak Kaydet</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              
              <div class="table-responsive">
                <table id="example1" class="table table-musteri table-responsive table-bordered table-striped nowrap" style="font-weight: 600;">
                  <thead>
                    <tr>
                      <th style="width:40px">İşlem</th> 
                      <th>Seri Numarası</th>
                      <th>Müşteri / Merkez Bilgisi</th>
                      <th>Açıklama</th>
                      <th>Son Güncelleme</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($urunler as $urun) : ?>
                      <?php 
                      if($urun->cihaz_borc_uyarisi == 0 ){
                        continue;
                      }
                      ?>
                      <tr>
                        <td>
                          <?php 
                          if($urun->cihaz_borc_uyarisi == 0 ){
                            ?>
                            <a type="button" href="<?=base_url("cihaz/borc_uyarisi_ekle/".$urun->borclu_id)?>" class="btn btn-success btn-xs" style="font-size: 12px!important;"><i class="fas fa-check-circle"></i> Borcu Yok</a>
                            <?php
                          }else{
                            ?>
                            <a type="button" href="<?=base_url("cihaz/borc_uyarisi_kaldir/".$urun->borclu_id)?>" class="btn btn-danger btn-xs" style="font-size: 12px!important;"><i class="fas fa-exclamation-circle"></i> Borcu Var</a>
                            <?php
                          }
                          ?>
                        </td>
                        <td><i class="fas fa-qrcode" style="margin-right:5px;opacity:1"></i> 
                          <?=$urun->borclu_seri_numarasi ?? "<span style='opacity:0.3'>UG00000000UX00</span>"?> 
                        </td>
                        <td><i class="far fa-user-circle" style="margin-right:5px;opacity:1"></i> 
                          <?php 
                          if($urun->musteri_ad){
                            ?>
                            <a href="<?=base_url("musteri/profil/$urun->musteri_id")?>">
                              <?=$urun->musteri_ad?> / <?=$urun->merkez_adi?>  / <span style="font-weight:normal"><?=$urun->musteri_iletisim_numarasi?></span>
                            </a>          
                            <?php
                          }else{
                            echo "<span style='opacity:0.5'>Cihaz seri numarası sistemde bulunamadı. </span>";
                          }
                          ?>
                        </td>
                        <td> 
                          <?php 
                          if($urun->borclu_aciklama){
                            echo $urun->borclu_aciklama;
                          }else{
                            echo "<span style='opacity:0.5'>Borçlu hakkında detay girilmedi. </span>";
                          }
                          ?> 
                        </td>
                        <td>
                          <?=date("d.m.Y H:i",strtotime($urun->borc_durum_guncelleme_tarihi))?> 
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('a[href*="borc_uyarisi_ekle"], a[href*="borc_uyarisi_kaldir"]').forEach(function(btn) {
      btn.addEventListener("click", function(e) {
        e.preventDefault();
        const url = this.href;
        const text = this.classList.contains('btn-danger') 
          ? "Borç uyarısı kaldırılacak!" 
          : "Borç uyarısı eklenecek!";

        Swal.fire({
          title: 'Emin misiniz?',
          text: text,
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Evet',
          cancelButtonText: 'İptal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
      });
    });
  });

  // Excel export için özel fonksiyon
  function exportToExcel(event, url) {
    event.preventDefault();
    
    // Loading göster
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        title: 'Excel\'e Aktarılıyor...',
        text: 'Lütfen bekleyiniz',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
    }
    
    // Gizli bir iframe oluştur ve dosyayı indir
    var iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.src = url;
    document.body.appendChild(iframe);
    
    // 3 saniye sonra loading'i kapat (dosya indirme genellikle bu sürede tamamlanır)
    setTimeout(function() {
      if (typeof Swal !== 'undefined') {
        Swal.close();
      }
      // Iframe'i temizle
      setTimeout(function() {
        if (iframe.parentNode) {
          document.body.removeChild(iframe);
        }
      }, 1000);
    }, 3000);
  }
</script>