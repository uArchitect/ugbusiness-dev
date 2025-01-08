 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background:#131720">
 <div class="row">
    
    <div class="col-6">
    <span style="text-align:center;color:white;font-size:25px;padding:10px;min-height:50px;display:block">YAKLAŞAN GÜNLER</span>
          
        <?php foreach ($onemli_gunler as $gun) :?>
        <?php if( $gun->onemli_gun_tamamlandi == 1) continue; ?>

        <div class="card" style="background: #222222; color: white;">
    <div class="card-header" style="background: #222222; color: white;">
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
                    <button class="btn btn-xs" style="background: rgb(187 31 31 / 8%);color: rgb(173 173 173); border: 1px solid #8d8d8d;">
                        <?= $gelecekteMi ? "$kalanGun GÜN KALDI" : "TARİH GEÇTİ" ?>
                    </button>
                <?php
            }

            ?>
           
          
            <a href="<?=base_url("onemli_gun/gun_tamamlandi/$gun->onemli_gun_id")?>" 
               class="btn btn-xs" 
               style="background: rgb(34 197 94 / 0.2); color: #00e500;">
                <i class="fa fa-check"></i> TAMAMLANDI OLARAK İŞARETLE
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
    <div class="card" style="background: #131720cf; color: white;">
            <div class="card-header" style="background: #222222; color: white;">
            <i class="fa fa-check text-success" style="font-size:20px;opacity: 0.3;"></i> <b style="font-size:20px;opacity: 0.3;"><?=$gun->onemli_gun_adi?></b> <span style="opacity: 0.3;">/ <?=$gun->onemli_gun_tarih_uzun?> </span>
            
                <div class="card-tools">
                    <a href="<?=base_url("onemli_gun/gun_beklemede/$gun->onemli_gun_id")?>" class="btn btn-success btn-xs" style="background: rgb(205 140 0 / 28%); border: 1px solid #bb7900; color: #f5ffeb;">LİSTEDEN ÇIKAR</a>
                </div>
            </div>  
        </div>
        <?php endforeach; ?>
    </div>
 </div>
</div>