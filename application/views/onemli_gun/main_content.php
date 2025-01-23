 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background:rgb(0 52 133)">
 <div class="row">
 <div class="col-md-12" style="height: 84px;background: #000951b3; z-index: 999;">
        <img src="https://www.umex.com.tr/assets/images/layouts/umex-logo-white.png" style="height: 60px;margin: auto;display: block;margin-top: 10px;" alt="">

         <!-- Buton -->
<button id="openPopupBtn" class="btn btn-primary" style="background: #003485;float:right; color: white; padding: 10px 20px; border: none; border-radius: 5px;margin-top:-50px;margin-right:20px">Yeni Önemli Gün Ekle</button>

      </div>





<style>
    /* Popup stilini ve animasyonunu ekleyelim */
.popup-form {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.popup-form .card {
    width: 70%;
    margin: 0;
    animation: slideIn 0.5s ease-in-out;
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

    </style>


<!-- Popup (Form) -->
<div id="popupForm" class="popup-form" style="display: none;z-index:9999;margin-left:250px;padding-top:250px;">
    <div class="col-12">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card" style="margin: 20px; padding: 20px; background: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-header" style="background: #003485; color: white; padding: 10px; border-radius: 10px 10px 0 0;">
                        <h5 style="margin: 0; text-align: center;">Yeni Önemli Gün Ekle</h5>
                    </div>
                    <form method="post" action="<?=base_url("onemli_gun/save")?>" style="padding: 20px;">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="onemli_gun_adi" style="font-weight: bold; color: #333;">Önemli Gün Adı</label>
                            <input type="text" id="onemli_gun_adi" name="onemli_gun_adi" class="form-control" placeholder="Örn: Öğretmenler Günü" required style="border-radius: 5px; padding: 10px; width: 100%;">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="onemli_gun_tarih" style="font-weight: bold; color: #333;">Tarih</label>
                            <input type="date" id="onemli_gun_tarih" name="onemli_gun_tarih" class="form-control" required style="border-radius: 5px; padding: 10px; width: 100%;">
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="onemli_gun_tarih_uzun" style="font-weight: bold; color: #333;">Tarih Uzun Format</label>
                            <textarea id="onemli_gun_tarih_uzun" name="onemli_gun_tarih_uzun" rows="3" class="form-control" required placeholder="Örn: 24 Kasım 2025" style="border-radius: 5px; padding: 10px; width: 100%;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background: #003485; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Kaydet</button>
                        <button type="button" class="btn btn-danger" id="cancelbtn" style="  color: white; padding: 10px 20px; border: none; border-radius: 5px;">İptal</button>
                    </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</div>



<!-- jQuery'yi CDN ile dahil et -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    // jQuery ile popup açma ve kapama işlemi
$(document).ready(function(){
    $("#openPopupBtn").click(function(){
        $("#popupForm").fadeIn(); // Popup'ı göster
    });

    // Popup'ı tıklayarak kapatma
    $("#popupForm").click(function(event){
        if (event.target === this) {
            $(this).fadeOut(); // Popup'ı gizle
        }
    });

    $("#cancelbtn").click(function(event){
        if (event.target === this) {
            $("#popupForm").fadeOut(); // Popup'ı gizle
        }
    });
});

    </script>


      
    <div class="col-6">
    <span style="text-align:center;color:white;font-size:25px;padding:10px;min-height:50px;display:block">YAKLAŞAN ÖNEMLİ GÜN VE HAFTALAR</span>
    <p style="color: white;text-align: center;font-size: 15px;margin-bottom: 20px;opacity: 0.5;font-weight: 300;margin-left: 50px;margin-right: 50px;">
        Bu bölümde yaklaşan önemli günleri görüntüleyebilirsiniz. Tarihler arasında kalan süreyi takip ederek planlamalarınızı kolayca yapabilirsiniz.
    </p>
    <?php foreach ($onemli_gunler as $gun) : ?>
    <?php if ($gun->onemli_gun_tamamlandi == 1) continue; ?>

    <div class="card" style="background: linear-gradient(135deg, #03175e, #062a8f); color: white; margin-bottom: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="card-header d-flex justify-content-between align-items-center" style="background: transparent; border-bottom: none; padding: 15px;">
           
        <div class="row" style="    width: -webkit-fill-available;">
            <div class="col">
 
                <i class="fa fa-info-circle text-warning" style="font-size: 24px; margin-right: 10px;"></i> 
                <span style="font-size: 20px; font-weight: bold;"><?= $gun->onemli_gun_adi ?></span>
                <small style="font-size: 14px; display: block; margin-top: 5px;"><?= $gun->onemli_gun_tarih_uzun ?></small>
           

            </div>
            <div class="col pt-3" style="max-width:450px;display: contents;">


            <div style="    margin-top: 12px;">
                <?php  
                $bugun = new DateTime(); 
                $onemliGun = new DateTime($gun->onemli_gun_tarih); 
                $fark = $bugun->diff($onemliGun); 
                $kalanGun = $fark->days; 
                $gelecekteMi = $onemliGun > $bugun;
                ?>
               <?php 
               if($kalanGun > 0 && $kalanGun < 8){
                ?>

                <button class="btn btn-sm mr-2" 
                        style="background: #ff1c1c33;
    color: #ff1c1c;
    border: 1px solid #ff1c1c;
    font-weight: bold;
    border-radius: 20px;
    padding: 5px 15px;">
                    <?= $gelecekteMi ? "$kalanGun GÜN KALDI" : "TARİH GEÇTİ" ?>
                </button>

                <?php
               }else{
                ?>
  <button class="btn btn-sm mr-2" 
                        style="background: <?= $gelecekteMi ? '#1c77ff33' : '#ff4c4c33' ?>; 
                               color: <?= $gelecekteMi ? '#1c77ff' : '#ff4c4c' ?>; 
                               border: 1px solid <?= $gelecekteMi ? '#1c77ff' : '#ff4c4c' ?>; 
                               font-weight: bold; border-radius: 20px; padding: 5px 15px;">
                    <?= $gelecekteMi ? "$kalanGun GÜN KALDI" : "TARİH GEÇTİ" ?>
                </button>
                <?php
               }
               ?>
          


        <a href="<?= base_url("onemli_gun/gun_tamamlandi/$gun->onemli_gun_id") ?>" 
               class="btn btn-sm" 
               style="background: #4caf50; color: white; font-weight: bold; border-radius: 20px; padding: 5px 15px;">
                <i class="fa fa-check"></i> TAMAMLANDI
            </a>
</div>


            </div>
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