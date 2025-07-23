<div class="content-wrapper" style=" padding-top:5px; background-color: #f8f9fa;">
  <section class="content">
    <div class="card shadow-lg  border-danger border" style="border-radius: 15px; overflow: hidden; max-width: 600px; margin: auto;">
      <div class="card-header bg-danger text-white text-center py-2" style="border-bottom: none;display:flex">
        <h3 class="card-title m-0 text-center" style="    margin: auto !important;font-size: 22px; font-weight: 600; letter-spacing: 1.5px; text-align:center">ATIŞ YÜKLEME ONAYI</h3>
      </div>
      <div class="card-body text-center p-2">
       <?php if (!empty($cihaz->musteri_ad)): ?> 
      <div class="mb-4 border border-light" style="width: -webkit-fill-available; margin-top: -9px; margin-left: -51px; margin-right: -51px;">
          <img class="img-fluid   p-2" src="<?=$cihaz->urun_png_gorsel?>" style="width: -webkit-fill-available; height: 190px; object-fit: contain; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);" alt="Cihaz Görseli">
        </div>
 <?php endif; ?>
        <h2 class="mb-1" style="font-size: 30px; margin-top:-6px; font-weight: 700; color: #343a40; letter-spacing: 1px;"><?=$serino?></h2>
        <p class="lead" style="font-size: 22px; color: #6c757d;"><?=$cihaz->musteri_ad?></p>
  <?php if (!empty($cihaz->musteri_ad)): ?>
        <div class="info-box bg-light   border-primary text-warning  mb-3" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
          <h4 class="m-0" style="font-size: 18px; font-weight: 600;"><?=$cihaz->merkez_adi?></h4> 
           <p class="m-0" style="font-size: 18px; line-height: 1.5;"><?=$cihaz->merkez_adresi?></p>
           <div class="row">
            <div class="col p-0">
              <a class="btn btn-default btn-md mr-2  " style="width: -webkit-fill-available;" href="tel:<?=$cihaz->musteri_iletisim_numarasi?>">
                
              <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15 3C16.5315 3.17014 17.9097 3.91107 19 5C20.0903 6.08893 20.8279 7.46869 21 9M14.5 6.5C15.2372 6.64382 15.9689 6.96892 16.5 7.5C17.0311 8.03108 17.3562 8.76284 17.5 9.5M8.20049 15.799C1.3025 8.90022 2.28338 5.74115 3.01055 4.72316C3.10396 4.55862 5.40647 1.11188 7.87459 3.13407C14.0008 8.17945 6.5 8 11.3894 12.6113C16.2788 17.2226 15.8214 9.99995 20.8659 16.1249C22.8882 18.594 19.4413 20.8964 19.2778 20.9888C18.2598 21.717 15.0995 22.6978 8.20049 15.799Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
              
              
              TELEFON ARA </a>
            </div>
             <div class="col p-0">
              <a class="btn btn-default btn-md  " style="width: -webkit-fill-available;" href="https://wa.me/9<?=$cihaz->musteri_iletisim_numarasi?>"><i class="fab fa-whatsapp"></i> WHATSAPP </a>
            </div>
           </div>
        </div>
        <?php endif; ?>
        <?php
          $garantiBitisTarihi = new DateTime($cihaz->garanti_bitis_tarihi);
          $bugun = new DateTime();
          $garantiBaslangicTarihi = new DateTime($cihaz->garanti_baslangic_tarihi);  

          $kalanGun = $bugun->diff($garantiBitisTarihi);
          $gecenGun = $garantiBaslangicTarihi->diff($bugun);

          $garantiDurumuClass = 'border-danger text-danger';
          $garantiDurumuText = 'GARANTİ BİTİŞ';
          $kalanGunText = $kalanGun->days . ' gün kaldı';
          $gecenGunText = $gecenGun->days . ' gün geçti';

          if ($garantiBitisTarihi  <  $bugun) {
              $garantiDurumuClass = 'border-danger text-secondary';
                     $garantiDurumuTextClass = 'text-danger';
              $garantiDurumuText = 'GARANTİ SONA ERDİ';
              $kalanGunText = 'Garanti <b>'.$kalanGun->days.'</b> gün önce sonlanmıştır.';
          } else { 
              $garantiDurumuClass = 'border-success text-success';
                 $garantiDurumuTextClass = 'text-success';
              $garantiDurumuText = 'GARANTİ DEVAM EDİYOR';
          }
        ?>
   <?php if (!empty($cihaz->musteri_ad)): ?>
        <div class="info-box bg-light    <?=$garantiDurumuClass?> mb-3" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
          <h4 class="m-0 <?=$garantiDurumuTextClass?>" style="font-size: 17px; font-weight: 600;display:block"><?=$garantiDurumuText?></h4>
          <span style="font-size: 22px; font-weight: 700; display: block; margin-top: 5px;"><?=date("d.m.Y",strtotime($cihaz->garanti_bitis_tarihi))?></span>
          <p style="font-size: 17px; margin-bottom:0;  ">
            <?php if ($garantiBitisTarihi > $bugun): ?>
              <strong>Kalan Gün:</strong> <?=$kalanGun->days?> gün<br> 
            <?php else: ?>
              <?=$kalanGunText?>
            <?php endif; ?>
          </p>
        </div>
  <?php endif; ?>
        <?php if (!empty($cihaz->borclu_aciklama)): ?>
        <div class="info-box bg-light    border-danger text-warning mb-3" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
          <h4 class="m-0 text-danger" style="font-size: 18px; font-weight: 600;">BORÇ UYARI NOTU</h4>
          <p class="m-0" style="font-size: 18px; line-height: 1.5;"><?=$cihaz->borclu_aciklama?></p>
        </div>
        <?php endif; ?>

        <?php if (empty($cihaz->musteri_ad)): ?>
        <div class="info-box bg-light    border-warning text-warning mb-3" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
          <h4 class="m-0" style="font-size: 18px; font-weight: 600;">SİSTEMDE KAYITLI DEĞİL</h4> 
           <p class="m-0" style="font-size: 18px; line-height: 1.5;">Müşteri ve merkez bilgileri sisteme kaydedilmemiştir.</p>
        </div>
        <?php endif; ?>
        

        <div class="mt-0">
         <?php 
         if($onaylandi == true){
          ?>
          <a href="<?=base_url()?>" class="btn btn-warning btn-lg py-3  shadow-sm" style="width: -webkit-fill-available;font-size: 22px; font-weight: 600; letter-spacing: 1px; transition: all 0.3s ease; background-color: #28a745; border-color: #28a745; border-radius: 5px 5px 10px 10px;">
            GEÇİCİ ONAY VER
          </a>
          <?php
         }else{
?>
    <a href="<?=base_url()?>" class="btn btn-success btn-lg py-3  shadow-sm" style="width: -webkit-fill-available;font-size: 22px; font-weight: 600; letter-spacing: 1px; transition: all 0.3s ease; background-color: #28a745; border-color: #28a745; border-radius: 5px 5px 10px 10px;">
                ATIŞ YÜKLEME ONAYI VERİLDİ
              </a>
<?php
         }
         
         ?>
        </div>
      </div>
    </div>
  </section>
</div>