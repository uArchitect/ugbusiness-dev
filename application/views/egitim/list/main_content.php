<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card" style="border-radius:0px !important;">
              <div class="card-header" style="background: #002357 !important;color:white">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Eğitimler</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="border: 1px solid #002357;">

              <div class="col-12 table-responsive pl-0 pr-0 " style="margin-top:-6px" >

                <table id="exampleeg" class="table table-striped table-bordered nowrap text-sm" style="min-height: 288px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight:500;height: 100%; width: 100%;">
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
                      <a style="padding: 9px 10px 9px 10px;width:100%;margin-top:2px;" target="_blank" href="<?=base_url("merkez/kargo_yazdir/$egitim->merkez_id")?>" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Kargo Etiketi</button>
                        
                        </td>
                      <td><i class="fa fa-user-circle" style="margin-right:1px;opacity:1"></i> 
                      
                      <?php 
                      $musteri_ad = mb_convert_encoding($egitim->musteri_ad, 'UTF-8', 'UTF-8');
                      $musteri_ad = html_entity_decode($musteri_ad, ENT_QUOTES, 'UTF-8');
                      $musteri_ad = preg_replace('/\x{0307}/u', '', $musteri_ad);
                      if (function_exists('normalizer_normalize')) {
                          $musteri_ad = normalizer_normalize($musteri_ad, Normalizer::FORM_C);
                      }
                      $musteri_ad = str_replace(['̇', 'i̇', 'İ̇', 'İ'], ['', 'i', 'İ', 'İ'], $musteri_ad);
                      $musteri_ad = preg_replace('/(^|\s)([i])/u', '$1İ', $musteri_ad);
                      echo "<a target='_blank' href='".base_url("musteri/profil/$egitim->musteri_id")."'>".htmlspecialchars(sonKelimeBuyuk($musteri_ad), ENT_QUOTES, 'UTF-8')."</a>"; 
                      ?>
            
                        / 
                       <?php 
                       $merkez_adi = mb_convert_encoding($egitim->merkez_adi, 'UTF-8', 'UTF-8');
                       $merkez_adi = html_entity_decode($merkez_adi, ENT_QUOTES, 'UTF-8');
                       $merkez_adi = preg_replace('/\x{0307}/u', '', $merkez_adi);
                       if (function_exists('normalizer_normalize')) {
                           $merkez_adi = normalizer_normalize($merkez_adi, Normalizer::FORM_C);
                       }
                       $merkez_adi = str_replace(['̇', 'i̇', 'İ̇', 'İ'], ['', 'i', 'İ', 'İ'], $merkez_adi);
                       $merkez_adi = preg_replace('/(^|\s)([i])/u', '$1İ', $merkez_adi);
                       echo htmlspecialchars($merkez_adi, ENT_QUOTES, 'UTF-8');
 

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
    // Türkçe karakter encoding düzeltmesi
    $kursiyer = mb_convert_encoding($kursiyer, 'UTF-8', 'UTF-8');
    $kursiyer = html_entity_decode($kursiyer, ENT_QUOTES, 'UTF-8');
    // Combining dot above (U+0307) karakterini kaldır
    $kursiyer = preg_replace('/\x{0307}/u', '', $kursiyer);
    // Unicode normalize (NFD -> NFC)
    if (function_exists('normalizer_normalize')) {
        $kursiyer = normalizer_normalize($kursiyer, Normalizer::FORM_C);
    }
    // Bozuk karakter kombinasyonlarını düzelt
    $kursiyer = str_replace(['̇', 'i̇', 'İ̇', 'İ'], ['', 'i', 'İ', 'İ'], $kursiyer);
    // Kelime başlarındaki küçük i'leri büyük İ yap
    $kursiyer = preg_replace('/(^|\s)([i])/u', '$1İ', $kursiyer);
    echo htmlspecialchars($kursiyer, ENT_QUOTES, 'UTF-8');
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
                       <?php echo "<a target='_blank' href='".base_url("kullanici/profil_new/$egitim->kullanici_id")."?subpage=ozluk-dosyasi'>".$egitim->kullanici_ad_soyad."</a>"; ?>
            
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
<div class="row <?=($filtre != "uretim_sertifika") ? "d-none":""?>">
<span class="col-12 mb-2" style="cursor:pointer;font-size:22px"><b>İşleme Alınan Eğitimlere Göre Sertifika Oluştur</b></span><br>
<?php 

                       foreach (get_urunler() as $urun) {
                        if($urun->harici_cihaz == 1){
                          continue;
                        }
                        ?>
                           <div class="col"><div class="card"><div class="card-header bg-dark" style=" background: #002357 !important;   text-align: center; height:55px;">
                           <img src="<?=$urun->urun_logo?>" height="<?=$urun->urun_logo_height+5?>">
                            </div>
                         
                           <textarea name="" class="form-control" id="" style="border: 1px solid #07357a;
    border-radius: 0px;" cols="30" rows="5"><?php
                            foreach ($egitimler as $egitim) {
                              if($egitim->sertifika_isleme_alindi == 1 && $egitim->urun_id == $urun->urun_id){
                                
                                $kursiyerler = json_decode($egitim->kursiyerler, true);

                                foreach ($kursiyerler as $ad) {
                                   echo $ad . "\n";
                                }
                              }
                             
                                }?></textarea>
                          </div>
                        <a href="<?=base_url("egitim/hizli_sertifika_olustur/".$urun->urun_id)?>" class="btn btn-flat btn-success" style=" margin-top: -17px; width: 100%; background-color: #00891f; border: 2px solid #053e02;">
<i class="far fa-folder-open"></i> Sertifika Oluştur
                              </a>
                        </div>
                                
                        <?php
                       }

?>

 </div>
 <div class="col-md-6 <?=goruntuleme_kontrol("sertifika_uretim_onayla") ? "" : "d-none"?>">
 <br>
<form action="<?=base_url("egitim/ozel_sertifika_olustur")?>" method="POST">
<span class="col-12 mb-2" style="cursor:pointer;font-size:22px"><b>Özel Sertifika Oluştur</b></span><br>
<textarea name="kursiyer_adlari" class="form-control" id="" style="border: 1px solid #07357a;
    border-radius: 0px;" cols="30" rows="10"></textarea><br>
    <select name="urun_id" class="select2 mt-3 mb-3" style="width:100%">
      <option value="1">UMEX LAZER</option>
      <option value="2">UMEX DIODE</option>
      <option value="3">UMEX EMS</option>
      <option value="4">UMEX GOLD</option>
      <option value="5">UMEX SLIM</option>
      <option value="6">UMEX S</option>
      <option value="7">UMEX Q</option>
      <option value="8">UMEX PLUS</option>
    </select><br>

   
    <button class="btn btn-flat btn-success" style=" margin-top: 0px; width: 100%; background-color: #00891f; border: 2px solid #053e02;">ÖZEL SERTİFİKA OLUŞTUR</button>
    </form>
    
    <br><br>
    
    <form action="<?=base_url("egitim/coklu_sertifika_olustur")?>" method="POST">
<span class="col-12 mb-2" style="cursor:pointer;font-size:22px"><b>Özel Sertifika Oluştur</b></span><br>
<textarea name="kursiyer_adlari" class="form-control" id="" style="border: 1px solid #07357a;
    border-radius: 0px;" cols="30" rows="10"></textarea><br>
  <input type="checkbox" name="umex-lazer">UMEX LAZER &nbsp;&nbsp;
    <input type="checkbox" name="umex-plus">UMEX PLUS &nbsp;&nbsp;
    <input type="checkbox" name="umex-ems">UMEX EMS &nbsp;&nbsp;
    <input type="checkbox" name="umex-diode">UMEX DIODE &nbsp;&nbsp;
    <input type="checkbox" name="umex-gold">UMEX GOLD &nbsp;&nbsp;
    <input type="checkbox" name="umex-q">UMEX Q &nbsp;&nbsp;
    <input type="checkbox" name="umex-s">UMEX S &nbsp;&nbsp;
    <input type="checkbox" name="umex-slim">UMEX SLIM
    <br><br>

   
    <button class="btn btn-flat btn-success" style=" margin-top: 0px; width: 100%; background-color: #00891f; border: 2px solid #053e02;">TEKLİ ÖZEL SERTİFİKA OLUŞTUR</button>
    </form>
 </div>
</section>



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

    // Türkçe karakter desteği - Sayfa yüklendiğinde çalışır
    $(document).ready(function() {
        // Bozuk İ karakterlerini düzelt (combining dot above karakterini kaldır)
        function fixBrokenTurkishChars(text) {
            if (!text) return text;
            
            // Önce tüm combining dot above karakterlerini kaldır
            text = text.replace(/\u0307/g, '');
            
            // Bozuk İ kombinasyonlarını düzelt (kelime başlarındaki i'leri İ yap)
            text = text.replace(/(^|\s)([i])/g, function(match, space, letter) {
                return space + 'İ';
            });
            
            // HTML entity'leri düzelt
            text = text.replace(/&#304;/g, 'İ');
            text = text.replace(/&#305;/g, 'ı');
            text = text.replace(/&#73;/g, 'I');
            text = text.replace(/&#105;/g, 'i');
            
            // Unicode normalize (NFD -> NFC)
            if (typeof text.normalize === 'function') {
                try {
                    text = text.normalize('NFC');
                } catch(e) {}
            }
            
            return text;
        }

        // Sayfadaki tüm metinleri normalize et (Türkçe karakterleri düzelt)
        function normalizeTurkceKarakterler() {
            $('#exampleeg tbody tr').each(function() {
                $(this).find('td').each(function() {
                    var $cell = $(this);
                    
                    // Tüm text node'ları ve element içeriklerini düzelt
                    $cell.find('*').addBack().contents().each(function() {
                        if (this.nodeType === 3) { // Text node
                            var text = this.textContent || this.nodeValue;
                            if (text && text.trim()) {
                                var fixed = fixBrokenTurkishChars(text);
                                if (text !== fixed) {
                                    this.textContent = fixed;
                                    this.nodeValue = fixed;
                                }
                            }
                        }
                    });
                    
                    // Özel olarak link ve span içeriklerini düzelt
                    $cell.find('a, span').each(function() {
                        var $elem = $(this);
                        var elemText = $elem.text();
                        if (elemText) {
                            var fixed = fixBrokenTurkishChars(elemText);
                            if (elemText !== fixed) {
                                $elem.text(fixed);
                            }
                        }
                    });
                });
            });
        }

        // DataTable'ın Türkçe karakter arama desteği
        jQuery.fn.DataTable.ext.type.search.string = function (data) {
            if (!data) return '';
            var str = data.toString();
            return str
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
        };

        // Mevcut DataTable'ı yeniden başlat
        if ($.fn.DataTable.isDataTable('#exampleeg')) {
            $('#exampleeg').DataTable().destroy();
        }

        // DataTable'ı başlat
        var table = $('#exampleeg').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "pageLength": 19,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": false
        });

        // Sayfa çizildiğinde Türkçe karakterleri normalize et
        table.on('draw', function() {
            normalizeTurkceKarakterler();
        });

        // İlk yüklemede normalize et (birkaç kez çalıştır çünkü DataTable async çalışabilir)
        setTimeout(function() {
            normalizeTurkceKarakterler();
        }, 100);
        
        setTimeout(function() {
            normalizeTurkceKarakterler();
        }, 500);
        
        setTimeout(function() {
            normalizeTurkceKarakterler();
        }, 1000);

        // MutationObserver ile dinamik değişiklikleri yakala
        if (window.MutationObserver) {
            var observer = new MutationObserver(function(mutations) {
                normalizeTurkceKarakterler();
            });
            
            var tableContainer = document.getElementById('exampleeg');
            if (tableContainer) {
                observer.observe(tableContainer, {
                    childList: true,
                    subtree: true,
                    characterData: true
                });
            }
        }
    });
                </script>