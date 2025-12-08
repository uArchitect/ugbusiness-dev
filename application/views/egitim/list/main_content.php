<?php $this->load->view('egitim/includes/styles'); ?>
<?php $this->load->view('egitim/includes/tabs'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-egitim">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-egitim">
          <div class="card-header-egitim">
            <div class="d-flex align-items-center">
              <div class="card-header-icon-wrapper d-flex align-items-center justify-content-center rounded-circle mr-3">
                <i class="fas fa-award card-header-icon"></i>
              </div>
              <div>
                <h3 class="card-header-title mb-0">
                  <?php
                  $baslik = "Eğitimler";
                  if($filtre == "onay_sertifika") $baslik = "Onaylanacak Sertifikalar";
                  elseif($filtre == "uretim_sertifika") $baslik = "Üretilecek Sertifikalar";
                  elseif($filtre == "uretim_kalem") $baslik = "Üretilecek Kalemler";
                  elseif($filtre == "kargo") $baslik = "Kargo Bekleyen Sertifikalar";
                  echo $baslik;
                  ?>
                </h3>
                <span class="card-header-subtitle">Sertifika ve eğitim yönetim sistemi</span>
              </div>
            </div>
          </div>
          <div class="card-body-egitim">
            <div class="table-responsive">
              <table id="exampleeg" class="table table-egitim table-bordered nowrap text-sm" style="width:100%;">
                  <thead>
                  <tr>

                    <th style="">İşlem</th> 

                    <th style="">Müşteri - Merkez Adı</th>
                    <th style="">Ürün</th>
                    
                    <th style="">Kayıt Bilgileri</th> 
                    <?php if($filtre == "uretim_sertifika"){?>
                      <th style="">İşleme Al</th> 
                    <?php }?>
                    
                    <?php if($filtre == "onay_sertifika"){?>
                    <th style="">Onay</th>
                    <?php }?>
                    <?php if($filtre == "uretim_sertifika"){?>
                      <th style="">Sertifika Üretim</th>
                    <?php }?>
                    <?php if($filtre == "uretim_kalem"){?>
                      <th style="">Kalem Üretim</th>
                    <?php }?>
                    <?php if($filtre == "kargo"){?>
                      <th style="">Kargo</th>
                     <?php }?>
                    
                    
                     <?php if($filtre == "tum"){?>
                      <th style="">Onay</th>
                      <th style="">Sertifika Üretim</th>
                      <th style="">Kalem Üretim</th>
                      <th style="">Kargo</th>
                  
                      
                    
                      <?php }?>

                   
                  </tr>
                  </thead>
                  <tbody>



                    <?php $count=0; foreach ($egitimler as $egitim) : ?>
                      <?php $count++?>
                    <tr>
                    
                      <td style="padding:2px !important;">
                      <?php 
                       if($egitim->sertifika_onay_durumu == 1){
                        ?>

                          <button disabled style="padding: 9px 10px 9px 10px;width:67%;" type="button" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</button>
                        
                          <?php 
                      }else{
                        ?>
                          <a href="<?=site_url("egitim/duzenle/$egitim->egitim_id")?>"  style="padding: 9px 10px 9px 10px;width:67%;" type="button" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                        
                        
                        
                        <?php
                      }
                        ?>

                        
                        
                        
                          <a href="<?=site_url("egitim/delete/$egitim->egitim_id")?>"  style="padding: 9px 10px 9px 10px;width:30%;" type="button" class="btn btn-danger btn-flat btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Sil</a>
                     <br>
                      <a style="padding: 9px 10px 9px 10px;width:100%;margin-top:2px;" href="<?=base_url("merkez/kargo_yazdir/$egitim->merkez_id")?>" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Kargo Etiketi</button>
                        
                        </td>
                      <td><i class="fa fa-user-circle" style="margin-right:1px;opacity:1"></i> 
                      
                      <?php echo "<a href='".base_url("musteri/profil/$egitim->musteri_id")."'>".sonKelimeBuyuk($egitim->musteri_ad)."</a>"; ?>
            
                        / 
                       <?php 
                        echo $egitim->merkez_adi;
 

                       ?><br>
                    <span style="font-weight:normal">
                      <?=$egitim->merkez_adresi?>  <?=$egitim->ilce_adi?> / <?=$egitim->sehir_adi?>
                    </span>

                   <br>
                       <span style="opacity:0.5;font-weight:normal">
                      
                      <?php
                      
                      $kursiyerler = json_decode($egitim->kursiyerler);
$count = 0;
$totalKursiyerler = count($kursiyerler);

foreach ($kursiyerler as $key => $kursiyer) {
    echo $kursiyer;
    $count++;

   
    if ($count % 3 == 0 && $key != $totalKursiyerler - 1) {
        echo "<br>";
    } elseif ($key != $totalKursiyerler - 1) {
        echo ", ";
    }
}
                      
                      
                      ?>
                      </span>
                      
                       <td><i class="fas fa-layer-group" style="margin-right:1px;opacity:1"></i> 
                       <?=$egitim->urun_adi?> <br><span style="opacity:0.5;font-weight:normal"><?=$egitim->seri_numarasi?> </span>
                    </td>
                    <td><i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i> 
                       <span style="opacity:0.5;font-weight:normal">Eğitim :</span><?=date("d.m.Y H:i",strtotime($egitim->egitim_tarihi))?><br>
                       <i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i>
                       <span style="opacity:0.5;font-weight:normal">Kayıt :</span><?=date("d.m.Y H:i",strtotime($egitim->egitim_kayit_tarihi))?><br>
                      
                       
                       <span style="opacity:0.5;font-weight:normal">
                       <?php echo "<a href='".base_url("kullanici/profil_new/$egitim->kullanici_id")."?subpage=ozluk-dosyasi'>".$egitim->kullanici_ad_soyad."</a>"; ?>
            
                        </span>
                      
                        
                    </td>
                    <?php if($filtre == "uretim_sertifika"){?>
                      <td>
                        <?php 
                        if($egitim->sertifika_isleme_alindi == 0){
                              ?>
                                  <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="asfasf<?=$egitim->egitim_id?>" onclick="confirm_action('Eğitim İşleme Al','Seçilen bu eğitim kaydına ait sertifika işleme alınacaktır. Bu işlemi onaylıyor musunuz ?','Onayla','<?=base_url('egitim/egitim_islem_durumu_guncelle/').$egitim->egitim_id?>');this.checked=false;">
                                      <label for="asfasf<?=$egitim->egitim_id?>" style="font-weight:normal">
                                      Beklemede
                                      </label>
                                  </div>
                              <?php
                        }else{
                          ?>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox"  id="asfasf<?=$egitim->egitim_id?>" checked="true" onclick="confirm_action('Eğitim İşleme Al','Seçilen bu eğitim kaydına ait sertifika işlemden çıkarılacaktır. Bu işlemi onaylıyor musunuz ?','Onayla','<?=base_url('egitim/egitim_islem_durumu_guncelle/').$egitim->egitim_id?>');this.checked=true;">
                                    <label class="text-danger" for="asfasf<?=$egitim->egitim_id?>">
                                    İşleme Alındı
                                    </label>
                                </div>
                      <?php
                        }
                        ?>
                   


</td>      <?php }?>
                    

<?php 
                     if($filtre == "onay_sertifika" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;">
                     <?php 
                       if($egitim->sertifika_onay_durumu == 0){
                        ?>
                          <a onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikayı onaylıyor musunuz ?','Onayla','<?=base_url('egitim/egitim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</a>
                         <?php
                       }else{
                        ?>
                           <a  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın onay durumunu iptal etmek istediğinize emin misiniz ?','Onayla','<?=base_url('egitim/egitim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success">
                           <i class='fas fa-check mr-2'></i>Onaylandı 
                          
                          </a>
                   
                        <?php
                       }
                     ?>
                    </td>
                    <?php
                       }
                     ?>
                    <?php 
                     if($filtre == "uretim_sertifika" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;" >
                    <?php 
                       if($egitim->sertifika_uretim_durumu == 0){
                        ?>
                          <button <?=($egitim->sertifika_onay_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın üretimini onaylıyor musunuz ?','Onayla','<?=base_url('egitim/uretim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</button>
                   
                        <?php
                       }else{
                        ?>
                         <button <?=($egitim->sertifika_onay_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın üretimi onaydan çıkarılacaktır.Devam etmek istiyor musunuz ?','Onayla','<?=base_url('egitim/uretim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success"><i class='fas fa-check mr-2'></i>Baskıya Verildi</button>
                   
                        <?php
                       }
                     ?>
                    </td>

                    <?php
                       }
                     ?>
                    <?php 
                     if($filtre == "uretim_kalem" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;">
                    <?php 
                       if($egitim->sertifika_kalem_uretim_durumu == 0){
                        ?>
                          <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kalem üretimini onaylıyor musunuz ?','Onayla','<?=base_url('egitim/kalem_onay/'.$egitim->egitim_id)?>');" type="button" style="padding: 9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</button>
                   
                        <?php
                       }else{
                        ?>
                        <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kalem üretimi onaydan çıkarılacaktır.Devam etmek istiyor musunuz ?','Onayla','<?=base_url('egitim/kalem_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success"><i class='fas fa-check mr-2'></i>Üretildi</button>
                   <br><?=date("d.m.Y H:i",strtotime($egitim->sertifika_kalem_uretim_tarihi))?>
                        <?php
                       }
                     ?>
                     </td>

                     <?php
                       }
                     ?>


                     <?php 
                     if($filtre == "kargo" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;">
                    <?php 
                       if($egitim->sertifika_kargo_durumu == 0){
                        ?>
                         <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kargo durumunu onaylıyor musunuz ?','Onayla','<?=base_url('egitim/kargo_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</button>
                   
                        <?php
                       }else{
                        ?>
                        <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kargo durumu onaydan çıkarılacaktır.Devam etmek istiyor musunuz ?','Onayla','<?=base_url('egitim/kargo_onay/'.$egitim->egitim_id)?>');" type="button" style="padding: 9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success"><i class='fas fa-check mr-2'></i>Kargoya Verildi</button>
                   
                        <?php
                       }
                     ?>
                    </td>
                   <?php
                  }
                  ?>
                       
                    </tr>
                  <?php  endforeach; ?>

               
                  </tbody>
                  <tfoot>
          
                  </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  </section>
</div>

<!-- Sertifika Oluşturma Bölümü -->
<div class="content-wrapper content-wrapper-egitim <?=($filtre != "uretim_sertifika") ? "d-none":""?>">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-egitim">
          <div class="card-header-egitim">
            <div class="d-flex align-items-center">
              <div class="card-header-icon-wrapper d-flex align-items-center justify-content-center rounded-circle mr-3">
                <i class="far fa-folder-open card-header-icon"></i>
              </div>
              <div>
                <h3 class="card-header-title mb-0">İşleme Alınan Eğitimlere Göre Sertifika Oluştur</h3>
                <span class="card-header-subtitle">Seçilen eğitimler için toplu sertifika oluşturma</span>
              </div>
            </div>
          </div>
          <div class="card-body-egitim">
            <div class="row">
<?php 

                       foreach (get_urunler() as $urun) {
                        if($urun->harici_cihaz == 1){
                          continue;
                        }
                        ?>
              <div class="col-md-3 mb-4">
                <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                  <div class="card-header" style="background: var(--primary-gradient); text-align: center; padding: 15px;">
                    <img src="<?=$urun->urun_logo?>" height="<?=$urun->urun_logo_height+5?>" alt="<?=$urun->urun_adi?>">
                  </div>
                  <div class="card-body p-3">
                    <textarea name="" class="form-control" id="" style="border: 1px solid #ced4da; border-radius: 6px; min-height: 120px; font-size: 13px;" readonly><?php
                      foreach ($egitimler as $egitim) {
                        if($egitim->sertifika_isleme_alindi == 1 && $egitim->urun_id == $urun->urun_id){
                          $kursiyerler = json_decode($egitim->kursiyerler, true);
                          foreach ($kursiyerler as $ad) {
                            echo $ad . "\n";
                          }
                        }
                      }
                    ?></textarea>
                  </div>
                  <div class="card-footer p-2" style="border-top: 1px solid #e5e7eb;">
                    <a href="<?=base_url("egitim/hizli_sertifika_olustur/".$urun->urun_id)?>" class="btn btn-block btn-success" style="background: var(--primary-gradient); border: none; border-radius: 6px;">
                      <i class="far fa-folder-open mr-2"></i> Sertifika Oluştur
                    </a>
                  </div>
                </div>
              </div>
                                
                        <?php
                       }

?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Özel Sertifika Oluşturma Bölümü -->
<?php if(goruntuleme_kontrol("sertifika_uretim_onayla")): ?>
<div class="content-wrapper content-wrapper-egitim">
  <section class="content pr-0">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-egitim">
          <div class="card-header-egitim">
            <div class="d-flex align-items-center">
              <div class="card-header-icon-wrapper d-flex align-items-center justify-content-center rounded-circle mr-3">
                <i class="fas fa-certificate card-header-icon"></i>
              </div>
              <div>
                <h3 class="card-header-title mb-0">Özel Sertifika Oluştur</h3>
                <span class="card-header-subtitle">Manuel olarak sertifika oluştur</span>
              </div>
            </div>
          </div>
          <div class="card-body-egitim">
            <form action="<?=base_url("egitim/ozel_sertifika_olustur")?>" method="POST">
              <div class="form-group">
                <label class="filter-label">Kursiyer Adları (Her satıra bir isim)</label>
                <textarea name="kursiyer_adlari" class="form-control" style="border-radius: 6px; min-height: 150px;" rows="10" placeholder="Her satıra bir kursiyer adı yazın"></textarea>
              </div>
              <div class="form-group">
                <label class="filter-label">Ürün Seçimi</label>
                <select name="urun_id" class="select2 form-control" style="width:100%">
                  <option value="1">UMEX LAZER</option>
                  <option value="2">UMEX DIODE</option>
                  <option value="3">UMEX EMS</option>
                  <option value="4">UMEX GOLD</option>
                  <option value="5">UMEX SLIM</option>
                  <option value="6">UMEX S</option>
                  <option value="7">UMEX Q</option>
                  <option value="8">UMEX PLUS</option>
                </select>
              </div>
              <button class="btn btn-block filter-btn" type="submit">
                <i class="fas fa-certificate mr-2"></i>ÖZEL SERTİFİKA OLUŞTUR
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-egitim">
          <div class="card-header-egitim">
            <div class="d-flex align-items-center">
              <div class="card-header-icon-wrapper d-flex align-items-center justify-content-center rounded-circle mr-3">
                <i class="fas fa-layer-group card-header-icon"></i>
              </div>
              <div>
                <h3 class="card-header-title mb-0">Çoklu Sertifika Oluştur</h3>
                <span class="card-header-subtitle">Birden fazla ürün için sertifika oluştur</span>
              </div>
            </div>
          </div>
          <div class="card-body-egitim">
            <form action="<?=base_url("egitim/coklu_sertifika_olustur")?>" method="POST">
              <div class="form-group">
                <label class="filter-label">Kursiyer Adları (Her satıra bir isim)</label>
                <textarea name="kursiyer_adlari" class="form-control" style="border-radius: 6px; min-height: 150px;" rows="10" placeholder="Her satıra bir kursiyer adı yazın"></textarea>
              </div>
              <div class="form-group">
                <label class="filter-label">Ürün Seçimi</label>
                <div class="row">
                  <div class="col-6">
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-lazer" class="form-check-input" id="umex-lazer">
                      <label class="form-check-label" for="umex-lazer">UMEX LAZER</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-plus" class="form-check-input" id="umex-plus">
                      <label class="form-check-label" for="umex-plus">UMEX PLUS</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-ems" class="form-check-input" id="umex-ems">
                      <label class="form-check-label" for="umex-ems">UMEX EMS</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-diode" class="form-check-input" id="umex-diode">
                      <label class="form-check-label" for="umex-diode">UMEX DIODE</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-gold" class="form-check-input" id="umex-gold">
                      <label class="form-check-label" for="umex-gold">UMEX GOLD</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-q" class="form-check-input" id="umex-q">
                      <label class="form-check-label" for="umex-q">UMEX Q</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-s" class="form-check-input" id="umex-s">
                      <label class="form-check-label" for="umex-s">UMEX S</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" name="umex-slim" class="form-check-input" id="umex-slim">
                      <label class="form-check-label" for="umex-slim">UMEX SLIM</label>
                    </div>
                  </div>
                </div>
              </div>
              <button class="btn btn-block filter-btn" type="submit">
                <i class="fas fa-layer-group mr-2"></i>ÇOKLU SERTİFİKA OLUŞTUR
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php endif; ?>



            </div>


            <style>
              #exampleeg_paginate{
                margin-top:12px;
              }     </style>

              <script>
                  $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#secilen_cihazlar').on('select2:opening', function(e) {
       
    });

    // Türkçe karakter desteği için DataTable özelleştirmesi
    $(document).ready(function() {
        // Mevcut DataTable'ı yok et ve yeniden oluştur
        if ($.fn.DataTable.isDataTable('#exampleeg')) {
            $('#exampleeg').DataTable().destroy();
        }

        // Türkçe karakter normalizasyon fonksiyonu
        function turkceKarakterNormalize(text) {
            if (!text) return '';
            return text.toString()
                .replace(/İ/g, 'İ')
                .replace(/ı/g, 'ı')
                .replace(/I/g, 'I')
                .replace(/i/g, 'i')
                .replace(/Ğ/g, 'Ğ')
                .replace(/ğ/g, 'ğ')
                .replace(/Ü/g, 'Ü')
                .replace(/ü/g, 'ü')
                .replace(/Ş/g, 'Ş')
                .replace(/ş/g, 'ş')
                .replace(/Ö/g, 'Ö')
                .replace(/ö/g, 'ö')
                .replace(/Ç/g, 'Ç')
                .replace(/ç/g, 'ç');
        }

        // DataTable'ı Türkçe karakter desteği ile başlat
        var table = $('#exampleeg').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "pageLength": 19,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
            }
        });

        // Arama kutusuna Türkçe karakter desteği ekle
        var searchInput = $('input[type="search"]', table.table().container());
        if (searchInput.length > 0) {
            searchInput.on('keyup', function() {
                var searchValue = $(this).val();
                // Türkçe karakterleri normalize et
                var normalizedValue = turkceKarakterNormalize(searchValue);
                table.search(normalizedValue).draw();
            });
        }

        // Tüm hücrelerde Türkçe karakter desteği
        table.columns().every(function() {
            var column = this;
            var header = $(column.header());
            
            // Hücre içeriğini normalize et
            table.cells(null, column.index()).every(function() {
                var cell = this.node();
                if (cell) {
                    var originalText = $(cell).text();
                    var normalizedText = turkceKarakterNormalize(originalText);
                    if (originalText !== normalizedText) {
                        $(cell).attr('data-search', normalizedText);
                    }
                }
            });
        });

        // Sayfa yüklendiğinde tüm metinleri normalize et
        table.on('draw', function() {
            $('#exampleeg tbody tr').each(function() {
                $(this).find('td').each(function() {
                    var text = $(this).text();
                    var normalized = turkceKarakterNormalize(text);
                    $(this).attr('data-search', normalized);
                });
            });
        });
    });
                </script>