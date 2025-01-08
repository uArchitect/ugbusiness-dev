 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background:rgb(0 52 133)">
 <div class="row">
 <div class="col-md-12" style="height: 84px;background: #000951b3; z-index: 999;">
        <img src="https://www.umex.com.tr/assets/images/layouts/umex-logo-white.png" style="height: 60px;margin: auto;display: block;margin-top: 10px;" alt="">
      </div>
    <div class="col-6">
    <span style="text-align:center;color:white;font-size:25px;padding:10px;min-height:50px;display:block">ÖNEMLİ GÜNLER</span>
          
        <?php foreach ($onemli_gunler as $gun) :?>
        <?php if( $gun->onemli_gun_tamamlandi == 1) continue; ?>

        <div class="card" style="background: #ffffff; color: white;">
    <div class="card-header" style="background: #ffffff; color: blue;">
        <i class="fa fa-info-circle text-danger" style="font-size:20px"></i> 
        <b style="font-size:20px"><?=$gun->onemli_gun_adi?></b> / <?=$gun->onemli_gun_tarih_uzun?>
        <div class="card-tools">
            <?php  
            $bugun = new DateTime(); 
            $onemliGun = new DateTime($gun->onemli_gun_tarih); 
            $fark = $bugun->diff($onemliGun); 
            $kalanGun = $fark->days; 
            $gelecekteMi = $onemliGun > $bugun;

            if($kalanGun < 20) {
                ?>
                    <button class="btn btn-xs" style="background: rgb(187 31 31 / 8%);color: #e50000;border: 1px solid red;">
                        <?= $gelecekteMi ? "$kalanGun GÜN KALDI" : "TARİH GEÇTİ" ?>
                    </button>
                <?php
            }else{
                ?>
                    <button class="btn btn-xs" style="background: rgb(0 17 227 / 8%); color: rgb(0 73 197); border: 1px solid #0423ff;">
                        <?= $gelecekteMi ? "$kalanGun GÜN KALDI" : "TARİH GEÇTİ" ?>
                    </button>
                <?php
            }

            ?>
           
          
            <a href="<?=base_url("onemli_gun/gun_tamamlandi/$gun->onemli_gun_id")?>" 
               class="btn btn-xs" 
               style="background: #668eff33; color: blue;">
                <i class="fa fa-check"></i> TAMAMLANDI
            </a>
        </div>
    </div>
</div>


<?php endforeach; ?>
    </div>
    <div class="col-6">
    <span  style="text-align:center;color:white;font-size:25px;padding:10px;min-height:50px;display:block">TAMAMLANAN GÜNLER</span>
        
    <?php foreach ($onemli_gunler as $gun) :?>
        <?php if( $gun->onemli_gun_tamamlandi == 0) continue; ?>
    <div class="card" style="background: #ffffffcf; color: white;">
            <div class="card-header" style="background: #ffffff; color: blue;">
            <i class="fa fa-check text-success" style="font-size:20px;opacity: 0.3;"></i> <b style="font-size:20px;opacity: 0.3;"><?=$gun->onemli_gun_adi?></b> <span style="opacity: 0.3;">/ <?=$gun->onemli_gun_tarih_uzun?> </span>
            
                <div class="card-tools">
                    <a href="<?=base_url("onemli_gun/gun_beklemede/$gun->onemli_gun_id")?>" class="btn btn-success btn-xs" style="background: red; border: 1px solid #bb7900; color: #f5ffeb;">LİSTEDEN ÇIKAR</a>
                </div>
            </div>  
        </div>
        <?php endforeach; ?>
    </div>
 </div>
</div>