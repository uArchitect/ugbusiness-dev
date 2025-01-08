 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background:rgb(0 52 133)">
 <div class="row">
 <div class="col-md-12" style="height: 84px;background: #000951b3; z-index: 999;">
        <img src="https://www.umex.com.tr/assets/images/layouts/umex-logo-white.png" style="height: 60px;margin: auto;display: block;margin-top: 10px;" alt="">
      </div>
    <div class="col-6">
    <span style="text-align:center;color:white;font-size:25px;padding:10px;min-height:50px;display:block">YAKLAŞAN ÖNEMLİ GÜN VE HAFTALAR</span>
    <p style="color: white;text-align: center;font-size: 15px;margin-bottom: 20px;opacity: 0.5;font-weight: 300;margin-left: 50px;margin-right: 50px;">
        Bu bölümde yaklaşan önemli günleri görüntüleyebilirsiniz. Tarihler arasında kalan süreyi takip ederek planlamalarınızı kolayca yapabilirsiniz.
    </p>
    <?php foreach ($onemli_gunler as $gun) : ?>
    <?php if ($gun->onemli_gun_tamamlandi == 1) continue; ?>

    <div class="card" style="background: linear-gradient(135deg, #03175e, #062a8f); color: white; margin-bottom: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="card-header d-flex justify-content-between align-items-center" style="background: transparent; border-bottom: none; padding: 15px;">
            <div>
                <i class="fa fa-info-circle text-warning" style="font-size: 24px; margin-right: 10px;"></i> 
                <span style="font-size: 20px; font-weight: bold;"><?= $gun->onemli_gun_adi ?></span>
                <small style="font-size: 14px; display: block; margin-top: 5px;"><?= $gun->onemli_gun_tarih_uzun ?></small>
            </div>
            <div>
                <?php  
                $bugun = new DateTime(); 
                $onemliGun = new DateTime($gun->onemli_gun_tarih); 
                $fark = $bugun->diff($onemliGun); 
                $kalanGun = $fark->days; 
                $gelecekteMi = $onemliGun > $bugun;
                ?>
               
            </div>

<div class="card-tools">
<button class="btn btn-sm mr-2" 
                        style="background: <?= $gelecekteMi ? '#1c77ff33' : '#ff4c4c33' ?>; 
                               color: <?= $gelecekteMi ? '#1c77ff' : '#ff4c4c' ?>; 
                               border: 1px solid <?= $gelecekteMi ? '#1c77ff' : '#ff4c4c' ?>; 
                               font-weight: bold; border-radius: 20px; padding: 5px 15px;">
                    <?= $gelecekteMi ? "$kalanGun GÜN KALDI" : "TARİH GEÇTİ" ?>
                </button>

        <a href="<?= base_url("onemli_gun/gun_tamamlandi/$gun->onemli_gun_id") ?>" 
               class="btn btn-sm" 
               style="background: #4caf50; color: white; font-weight: bold; border-radius: 20px; padding: 5px 15px;">
                <i class="fa fa-check"></i> TAMAMLANDI
            </a>
</div>

        </div>
    
       
    </div>

<?php endforeach; ?>

    </div>
    <div class="col-6">
    <span  style="text-align:center;color:white;font-size:25px;padding:10px;min-height:50px;display:block">GEÇMİŞTEKİ ÖNEMLİ GÜN VE HAFTALAR</span>
    <p style="color: white;text-align: center;font-size: 15px;margin-bottom: 20px;opacity: 0.5;font-weight: 300;margin-left: 50px;margin-right: 50px;">
    Tamamlanmış önemli günlerin listesini aşağıda bulabilirsiniz. Bu bölüm, geçmişte tamamlanan etkinliklerin ve önemli tarihlerinizin kaydını tutmanıza yardımcı olur. 
    </p>
    <?php foreach ($onemli_gunler as $gun) :?>
        <?php if( $gun->onemli_gun_tamamlandi == 0) continue; ?>
    <div class="card" style="background: #ffffffcf; color: white;opacity: 0.3;">
            <div class="card-header" style="background: #03175e; color: white;">
            <i class="fa fa-check text-success" style="font-size:20px;"></i> <b style="font-size:20px; "><?=$gun->onemli_gun_adi?></b> <span style="opacity: 0.3;">/ <?=$gun->onemli_gun_tarih_uzun?> </span>
            
                <div class="card-tools">
                    <a href="<?=base_url("onemli_gun/gun_beklemede/$gun->onemli_gun_id")?>" class="btn btn-success btn-xs" style="background: red; border: 1px solid #bb7900; color: #f5ffeb;">LİSTEDEN ÇIKAR</a>
                </div>
            </div>  
        </div>
        <?php endforeach; ?>
    </div>
 </div>
</div>