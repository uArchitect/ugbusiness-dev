<div class="content-wrapper" style=" padding-top:5px; background-color: #f8f9fa;">
  <section class="content">
    <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden; max-width: 600px; margin: auto;">
      <div class="card-header bg-danger text-white text-center py-2" style="border-bottom: none;display:flex">
        <h3 class="card-title m-0 text-center" style="    margin: auto !important;font-size: 22px; font-weight: 600; letter-spacing: 1.5px; text-align:center">ATIŞ YÜKLEME ONAYI</h3>
      </div>
      <div class="card-body text-center p-2">
       <?php if (!empty($cihaz->musteri_ad)): ?> 
      <div class="mb-4 border border-light" style="width: -webkit-fill-available; margin-top: -9px; margin-left: -51px; margin-right: -51px;">
          <img class="img-fluid   p-2" src="<?=$cihaz->urun_png_gorsel?>" style="width: -webkit-fill-available; height: 220px; object-fit: contain; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);" alt="Cihaz Görseli">
        </div>
 <?php endif; ?>
        <h2 class="mb-1" style="font-size: 30px; font-weight: 700; color: #343a40; letter-spacing: 1px;"><?=$serino?></h2>
        <p class="lead mb-4" style="font-size: 22px; color: #6c757d;"><?=$cihaz->musteri_ad?></p>

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
        <div class="info-box bg-light border-left <?=$garantiDurumuClass?> mb-3" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
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
        <div class="info-box bg-light border-left border-warning text-warning mb-4" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
          <h4 class="m-0" style="font-size: 18px; font-weight: 600;">BORÇ UYARI NOTU</h4>
          <p class="m-0" style="font-size: 18px; line-height: 1.5;"><?=$cihaz->borclu_aciklama?></p>
        </div>
        <?php endif; ?>

        <?php if (empty($cihaz->musteri_ad)): ?>
        <div class="info-box bg-light border-left border-warning text-warning mb-4" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
          <h4 class="m-0" style="font-size: 18px; font-weight: 600;">SİSTEMDE KAYITLI DEĞİL</h4> 
           <p class="m-0" style="font-size: 18px; line-height: 1.5;">Müşteri ve merkez bilgileri sisteme kaydedilmemiştir.</p>
        </div>
        <?php endif; ?>
          <?php if (!empty($cihaz->musteri_ad)): ?>
        <div class="info-box bg-light border-left border-warning text-warning mb-4" style="display: block; text-align: left;padding: 15px; border-radius: 8px; border-width: 4px !important;">
          <h4 class="m-0" style="font-size: 18px; font-weight: 600;"><?=$cihaz->merkez_adi?></h4> 
           <p class="m-0" style="font-size: 18px; line-height: 1.5;"><?=$cihaz->merkez_adresi?></p>
        </div>
        <?php endif; ?>

        <div class="mt-0">
         <button class="btn btn-success btn-lg py-3  shadow-sm" style="width: -webkit-fill-available;font-size: 22px; font-weight: 600; letter-spacing: 1px; transition: all 0.3s ease; background-color: #28a745; border-color: #28a745;">
            ATIŞ YÜKLEME ONAYI VER
          </button>
        </div>
      </div>
    </div>
  </section>
</div>