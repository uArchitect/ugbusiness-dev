 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top:-1px;background:#ffffff;padding-top:10px">
 

<section class="content text-md">
<form method="GET" action="">
        <label for="tarih">&nbsp;&nbsp;Tarihe Göre Filtrele : </label>
        <input value="<?=!empty($_GET["tarih"]) ? date("Y-m-d",strtotime($_GET["tarih"])) : ""?>" type="date" id="tarih" name="tarih" required>
        <button type="submit" class="btn btn-success">Seçilen Tarihe Göre Listele</button>
        <a href="<?=base_url("siparis/haftalik_kurulum_plan")?>" class="btn btn-danger">Güncel Tarihe Göre Listele</a>



        <?php 
        
        if(!empty($_GET["tarih"])){
          $given_date = strtotime($_GET["tarih"]);
        }else{
          $given_date = strtotime(date("Y-m-d"));
        }
          // Verilen tarihin Pazartesi günü
    $current_monday = strtotime('monday this week', $given_date);
    // Sonraki Pazartesi günü
    $next_monday = strtotime('next monday', $current_monday);
  

    $previous_monday = strtotime('previous monday', $current_monday); 
        ?>


        <a href="<?=base_url("siparis/haftalik_kurulum_plan?tarih=".date("Y-m-d",$previous_monday))?>" class="btn btn-default"><i class="fas fa-angle-left"></i> Önceki Hafta</a>
        <a href="<?=base_url("siparis/haftalik_kurulum_plan?tarih=".date("Y-m-d",$next_monday))?>" class="btn btn-default">Sonraki Hafta <i class="fas fa-angle-right"></i></a>


    </form>
</section>

<section class="content text-md">

<div class="row">
  <div class="col">
    <div class="card card-dark">
      <div class="card-header">
        PAZARTESİ
      </div>
      <div class="card-body">
      <div class="timeline" style="margin-bottom:0px">
        <div style="margin-right: 0px;">
       <?php 
       if(!empty($day1))
        foreach ($day1 as $value) {
          ?>
          <div class="timeline-item mb-2">
 
          <h3 class="timeline-header" style="background:#e3e3e3a6">
          
          
          
          <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>">
          <?=($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$value->merkez_adi?> 
          </a> <br>
          <span style="
    font-size: 13px;
"><?=$value->musteri_ad?><br><?=$value->musteri_iletisim_numarasi?></span>
        </h3>
          <div class="timeline-body text-xs">
          <span style="font-weight:bold"> Kurulum : <?=date("d.m.Y",strtotime($value->kurulum_tarihi))?></span><br>
          <?=($value->merkez_adresi == "0" || $value->merkez_adresi == "") ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span>"."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>":$value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"?> 
          <br><br>
          <?php 
          
          $urunlerdata = get_siparis_urunleri($value->siparis_id);
          foreach ($urunlerdata as $ur) {
            echo "<b>".$ur->urun_adi." (".$ur->renk_adi.")</b>".($ur->yenilenmis_cihaz_mi == 1 ? "<span class='bg-success  ' style='display: block; padding: 15px; text-align:center;  border-radius: 7px;'>Yenilenmiş Cihaz</span>" : "")."<br>".$ur->seri_numarasi."<br>";
         echo "<br><span class='btn btn-warning'>$takas_alinan_seri_kod</span>";
          }
          ?>
          </div>



          <div class="timeline-footer" style="padding: 0px; padding-left: 7px; padding-right: 7px; padding-bottom: 7px;">
          <a  target="_blank"  href="<?=base_url("kullanici/profil_new/$value->kullanici_id"."?subpage=ozluk-dosyasi")?>" class="btn btn-outline-primary btn-sm mb-2" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fa fa-user"></i> <?=$value->kullanici_ad_soyad?></a>
 <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" class="btn btn-outline-primary btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-eye"></i> Sipariş Detayı</a>
 <a href="<?=base_url('siparis/save_kurulum_programlama_view/'.$value->siparis_id)?>" class="btn mt-1 btn-outline-warning btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-pen"></i> Tarih Düzenle</a>
</div>










 
</div>
          <?php
        }

       ?></div>
       </div>
      </div>
     
    </div>
  </div>
  <div class="col">
    <div class="card card-dark">
      <div class="card-header">
        SALI
      </div>
      <div class="card-body">
      <div class="timeline" style="margin-bottom:0px">
        <div style="margin-right: 0px;">
       <?php 
       if(!empty($day2))
        foreach ($day2 as $value) {
          ?>
          <div class="timeline-item mb-2">
 
          <h3 class="timeline-header" style="background:#e3e3e3a6">
          <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>">
            
          <?=($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$value->merkez_adi?> </a>  <br> <span style="
    font-size: 13px;
"><?=$value->musteri_ad?><br><?=$value->musteri_iletisim_numarasi?></span></h3>
          <div class="timeline-body text-xs">
          <span style="font-weight:bold">Kurulum : <?=date("d.m.Y",strtotime($value->kurulum_tarihi))?></span><br>
          <?=($value->merkez_adresi == "0" || $value->merkez_adresi == "") ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span>"."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>":$value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"?> 
          <br><br>
          <?php 
          
          $urunlerdata = get_siparis_urunleri($value->siparis_id);
          foreach ($urunlerdata as $ur) {
            echo "<b>".$ur->urun_adi." (".$ur->renk_adi.")</b>".($ur->yenilenmis_cihaz_mi == 1 ? "<span class='bg-success  ' style='display: block; padding: 15px; text-align:center; border-radius: 7px;'>Yenilenmiş Cihaz</span>" : "")."<br>".$ur->seri_numarasi."<br>";
          }
          ?>
          </div>
 


          <div class="timeline-footer" style="padding: 0px; padding-left: 7px; padding-right: 7px; padding-bottom: 7px;">
          <a  target="_blank"  href="<?=base_url("kullanici/profil_new/$value->kullanici_id"."?subpage=ozluk-dosyasi")?>" class="btn btn-outline-primary btn-sm mb-2" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fa fa-user"></i> <?=$value->kullanici_ad_soyad?></a>
 <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" class="btn btn-outline-primary btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-eye"></i> Sipariş Detayı</a>

<a href="<?=base_url('siparis/save_kurulum_programlama_view/'.$value->siparis_id)?>" class="btn mt-1 btn-outline-warning btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-pen"></i> Tarih Düzenle</a>

</div>



</div>
          <?php
        }

       ?></div>
       </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card card-dark">
      <div class="card-header">
        ÇARŞAMBA
      </div>
      <div class="card-body">
        <div class="timeline" style="margin-bottom:0px">
        <div style="margin-right: 0px;">
       <?php 
       if(!empty($day3))
        foreach ($day3 as $value) {
          ?>
          <div class="timeline-item mb-2">
 
          <h3 class="timeline-header" style="background:#e3e3e3a6">  <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>">
                   <?=($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$value->merkez_adi?> </a>  <br> <span style="
    font-size: 13px;
"><?=$value->musteri_ad?><br><?=$value->musteri_iletisim_numarasi?></span></h3>
          <div class="timeline-body text-xs">
          <span style="font-weight:bold">Kurulum : <?=date("d.m.Y",strtotime($value->kurulum_tarihi))?></span><br>
          <?=($value->merkez_adresi == "0" || $value->merkez_adresi == "") ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span>"."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>":$value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"?> 
         
          <br><br>
          <?php 
          
          $urunlerdata = get_siparis_urunleri($value->siparis_id);
          foreach ($urunlerdata as $ur) {
            echo "<b>".$ur->urun_adi." (".$ur->renk_adi.")</b>".($ur->yenilenmis_cihaz_mi == 1 ? "<span class='bg-success  ' style='display: block; padding: 15px; text-align:center; border-radius: 7px;'>Yenilenmiş Cihaz</span>" : "")."<br>".$ur->seri_numarasi."<br>";
          }
          ?>
          </div>


          
          <div class="timeline-footer" style="padding: 0px; padding-left: 7px; padding-right: 7px; padding-bottom: 7px;">
          <a  target="_blank"  href="<?=base_url("kullanici/profil_new/$value->kullanici_id"."?subpage=ozluk-dosyasi")?>" class="btn btn-outline-primary btn-sm mb-2" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fa fa-user"></i> <?=$value->kullanici_ad_soyad?></a>
 <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" class="btn btn-outline-primary btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-eye"></i> Sipariş Detayı</a>

<a href="<?=base_url('siparis/save_kurulum_programlama_view/'.$value->siparis_id)?>" class="btn mt-1 btn-outline-warning btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-pen"></i> Tarih Düzenle</a>

</div>



 
</div>
          <?php
        }

       ?></div>
       </div>
      </div>
    </div>
  </div>
  <div class="col">
  <div class="card card-dark">
      <div class="card-header">
        PERŞEMBE
      </div>
      <div class="card-body">
      <div class="timeline" style="margin-bottom:0px">
        <div style="margin-right: 0px;">
       <?php 
       if(!empty($day4))
        foreach ($day4 as $value) {
          ?>
          <div class="timeline-item mb-2">
 
          <h3 class="timeline-header" style="background:#e3e3e3a6">  <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>">
                   <?=($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$value->merkez_adi?> </a> <br>  <span style="
    font-size: 13px;
"><?=$value->musteri_ad?><br><?=$value->musteri_iletisim_numarasi?></span></h3>
          <div class="timeline-body text-xs">
          <span style="font-weight:bold">Kurulum : <?=date("d.m.Y",strtotime($value->kurulum_tarihi))?></span><br>
          <?=($value->merkez_adresi == "0" || $value->merkez_adresi == "") ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span>"."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>":$value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"?> 
         
          <br><br>
          <?php 
          
          $urunlerdata = get_siparis_urunleri($value->siparis_id);
          foreach ($urunlerdata as $ur) {
            echo "<b>".$ur->urun_adi." (".$ur->renk_adi.")</b>".($ur->yenilenmis_cihaz_mi == 1 ? "<span class='bg-success  ' style='display: block; padding: 15px; text-align:center; border-radius: 7px;'>Yenilenmiş Cihaz</span>" : "")."<br>".$ur->seri_numarasi."<br>";
          }
          ?>
          </div>



          
          <div class="timeline-footer" style="padding: 0px; padding-left: 7px; padding-right: 7px; padding-bottom: 7px;">
          <a  target="_blank"  href="<?=base_url("kullanici/profil_new/$value->kullanici_id"."?subpage=ozluk-dosyasi")?>" class="btn btn-outline-primary btn-sm mb-2" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fa fa-user"></i> <?=$value->kullanici_ad_soyad?></a>
 <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" class="btn btn-outline-primary btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-eye"></i> Sipariş Detayı</a>

<a  href="<?=base_url('siparis/save_kurulum_programlama_view/'.$value->siparis_id)?>" class="btn mt-1 btn-outline-warning btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-pen"></i> Tarih Düzenle</a>

</div>



 
</div>
          <?php
        }

       ?></div>
       </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card card-dark">
      <div class="card-header">
        CUMA
      </div>
      <div class="card-body">
      <div class="timeline" style="margin-bottom:0px">
        <div style="margin-right: 0px;">
       <?php 
       if(!empty($day5))
        foreach ($day5 as $value) {
          ?>
          <div class="timeline-item mb-2">
 
          <h3 class="timeline-header" style="background:#e3e3e3a6">  <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>">
                  <?=($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$value->merkez_adi?> </a>  <br><span style="
    font-size: 13px;
"><?=$value->musteri_ad?><br><?=$value->musteri_iletisim_numarasi?></span> </h3>
          <div class="timeline-body text-xs">
          <span style="font-weight:bold">Kurulum : <?=date("d.m.Y",strtotime($value->kurulum_tarihi))?></span><br>
          <?=($value->merkez_adresi == "0" || $value->merkez_adresi == "") ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span>"."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>":$value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"?> 
         
          <br><br>
          <?php 
          
          $urunlerdata = get_siparis_urunleri($value->siparis_id);
          foreach ($urunlerdata as $ur) {
            echo "<b>".$ur->urun_adi." (".$ur->renk_adi.")</b>".($ur->yenilenmis_cihaz_mi == 1 ? "<span class='bg-success  ' style='display: block; padding: 15px; text-align:center;  border-radius: 7px;'>Yenilenmiş Cihaz</span>" : "")."<br>".$ur->seri_numarasi."<br>";
          }
          ?>
          </div>



          
          <div class="timeline-footer" style="padding: 0px; padding-left: 7px; padding-right: 7px; padding-bottom: 7px;">
          <a  target="_blank"  href="<?=base_url("kullanici/profil_new/$value->kullanici_id"."?subpage=ozluk-dosyasi")?>" class="btn btn-outline-primary btn-sm mb-2" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fa fa-user"></i> <?=$value->kullanici_ad_soyad?></a>
 <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" class="btn btn-outline-primary btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-eye"></i> Sipariş Detayı</a>


<a href="<?=base_url('siparis/save_kurulum_programlama_view/'.$value->siparis_id)?>" class="btn mt-1 btn-outline-warning btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-pen"></i> Tarih Düzenle</a>

</div>



 
</div>
          <?php
        }

       ?></div>
       </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card card-dark">
      <div class="card-header">
        CUMARTESİ
      </div>
      <div class="card-body">
      <div class="timeline" style="margin-bottom:0px">
        <div style="margin-right: 0px;">
       <?php 
       if(!empty($day6))
        foreach ($day6 as $value) {
          ?>
          <div class="timeline-item mb-2">
 
          <h3 class="timeline-header" style="background:#e3e3e3a6">  <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>">
                   <?=($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$value->merkez_adi?> </a>  <br><span style="
    font-size: 13px;
"><?=$value->musteri_ad?><br><?=$value->musteri_iletisim_numarasi?></span> </h3>
          <div class="timeline-body text-xs">
          <span style="font-weight:bold">Kurulum : <?=date("d.m.Y",strtotime($value->kurulum_tarihi))?></span><br>
          <?=($value->merkez_adresi == "0" || $value->merkez_adresi == "") ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span>"."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>":$value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"?> 
          <br><br>
          <?php 
          
          $urunlerdata = get_siparis_urunleri($value->siparis_id);
          foreach ($urunlerdata as $ur) {
            echo "<b>".$ur->urun_adi." (".$ur->renk_adi.")</b>".($ur->yenilenmis_cihaz_mi == 1 ? "<span class='bg-success  ' style='display: block; padding: 15px; text-align:center; border-radius: 7px;'>Yenilenmiş Cihaz</span>" : "")."<br>".$ur->seri_numarasi."<br>";
          }
          ?>
           
          </div>



          
          <div class="timeline-footer" style="padding: 0px; padding-left: 7px; padding-right: 7px; padding-bottom: 7px;">
          <a  target="_blank"  href="<?=base_url("kullanici/profil_new/$value->kullanici_id"."?subpage=ozluk-dosyasi")?>" class="btn btn-outline-primary btn-sm mb-2" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fa fa-user"></i> <?=$value->kullanici_ad_soyad?></a>
 <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" class="btn btn-outline-primary btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-eye"></i> Sipariş Detayı</a>


<a href="<?=base_url('siparis/save_kurulum_programlama_view/'.$value->siparis_id)?>" class="btn mt-1 btn-outline-warning btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-pen"></i> Tarih Düzenle</a>
</div>



 
</div>
          <?php
        }

       ?></div>
       </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card card-dark">
      <div class="card-header">
        PAZAR
      </div>
      <div class="card-body">
      <div class="timeline" style="margin-bottom:0px">
        <div style="margin-right: 0px;">
       <?php 
       if(!empty($day7))
        foreach ($day7 as $value) {
          ?>
          <div class="timeline-item mb-2">
 
          <h3 class="timeline-header" style="background:#e3e3e3a6">  <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>">
               <?=($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$value->merkez_adi?> </a>  <br> <span style="
    font-size: 13px;
"><?=$value->musteri_ad?></span></h3>
          <div class="timeline-body text-xs">
          <span style="font-weight:bold">Kurulum : <?=date("d.m.Y",strtotime($value->kurulum_tarihi))?></span><br>
          <?=($value->merkez_adresi == "0" || $value->merkez_adresi == "") ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span>"."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>":$value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"?> 
         
          <br><br>
          <?php 
          
          $urunlerdata = get_siparis_urunleri($value->siparis_id);
          foreach ($urunlerdata as $ur) {
            echo "<b>".$ur->urun_adi." (".$ur->renk_adi.")</b>".($ur->yenilenmis_cihaz_mi == 1 ? "<span class='bg-success  ' style='display: block; padding: 15px; text-align:center;  border-radius: 7px;'>Yenilenmiş Cihaz</span>" : "")."<br>".$ur->seri_numarasi."<br>";
          }
          ?>
          
          </div>


          <div class="timeline-footer" style="padding: 0px; padding-left: 7px; padding-right: 7px; padding-bottom: 7px;">
          <a  target="_blank" href="<?=base_url("kullanici/profil_new/$value->kullanici_id"."?subpage=ozluk-dosyasi")?>" class="btn btn-outline-primary btn-sm mb-2" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fa fa-user"></i> <?=$value->kullanici_ad_soyad?></a>
 <a href="<?=base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" class="btn btn-outline-primary btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-eye"></i> Sipariş Detayı</a>


<a href="<?=base_url('siparis/save_kurulum_programlama_view/'.$value->siparis_id)?>" class="btn mt-1 btn-outline-warning btn-sm" style="
width: -webkit-fill-available;width: -webkit-fill-available; color: #3b3e41; }
"><i class="fas fa-pen"></i> Tarih Düzenle</a>
</div>



 
</div>
          <?php
        }

       ?></div>
       </div>
      </div>
    </div>
  </div>
</div>
</section>
            </div>

 