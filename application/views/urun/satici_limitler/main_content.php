<?php $this->load->view('talep/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis pt-2">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-dollar-sign card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Fiyat Limitleri Restore
                  </h3>
                  <small class="card-header-subtitle">Satıcı fiyat limitleri yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('talep/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <!-- Ürün Seçim Butonları -->
              <div class="row mb-3">
                <div class="col-6 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/1")?>" class="btn btn-<?=$secilen_urun == 1 ? "success" : "dark" ?> p-4 pt-0" style="height:65px;width:100%;padding-top:5px!important;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-logo-white.png" class="text-center" alt=""> </a> </div>
                <div class="col-6 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/8")?>" class="btn btn-<?=$secilen_urun == 8 ? "success" : "dark" ?>" style="height:65px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umexplus-logo.png" class="text-center" alt="">  </a> </div>
                <div class="col-4 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/5")?>" class="btn btn-<?=$secilen_urun == 5 ? "success" : "dark" ?>" style="height:65px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-slim.svg" class="text-center" alt=""> </a>  </div>
                <div class="col-4 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/3")?>" class="btn btn-<?=$secilen_urun == 3 ? "success" : "dark" ?>" style="height:65px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-ems.svg" class="text-center" alt=""> </a> </div>
                <div class="col-4 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/6")?>" class="btn btn-<?=$secilen_urun == 6 ? "success" : "dark" ?>" style="height:65px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-s.svg" class="text-center" alt=""> </a> </div>
                <div class="col-4 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/2")?>" class="btn btn-<?=$secilen_urun == 2 ? "success" : "dark" ?>" style="height:65px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-diode.svg" class="text-center" alt=""> </a> </div>
                <div class="col-4 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/4")?>" class="btn btn-<?=$secilen_urun == 4 ? "success" : "dark" ?>" style="height:65px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-gold.svg" class="text-center" alt=""> </a>  </div>
                <div class="col-4 col-md mt-1 p-1"><a onclick="document.getElementById('showDivBtn').style.opacity ='0.3';" href="<?=base_url("urun/satici_limit/7")?>" class="btn btn-<?=$secilen_urun == 7 ? "success" : "dark" ?>" style="height:65px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-q.svg" class="text-center" alt=""> </a> </div>
              </div>

              <div class="row" id="showDivBtn">
                <section class="col">
  
<table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
                  <thead>
                  <tr>
                    <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
                
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($fiyat_listesi as $fiyat) : ?>

                      <tr>
                       <?php
                        if( $fiyat->vade == 20){
                          ?>
                          <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                          <?php
                        }
                       ?>
                        
                        <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                        <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                        <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                        <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
                <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
                
                 
                      </tr>
                    
                      <?php $count++; endforeach; ?>
                  </tbody>
                   
                </table>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
            <script>
        // Tüm money classlı inputları seç
        const moneyInputs = document.querySelectorAll('.money');

        moneyInputs.forEach(input => {
            // Input'un içine her yazıldığında çalışacak event
            input.addEventListener('input', function () {
                // Input'un değerini al ve sayıya çevir
                let value = this.value.replace(/\D/g, '');

                // Eğer değer varsa, formatla
                if (value) {
                    value = parseInt(value).toLocaleString('tr-TR', { minimumFractionDigits: 0 });
                }

                // Input değerini güncelle
                this.value = "₺" + value;
            });

            

            // Input'tan çıkıldığında yeniden formatla
            input.addEventListener('blur', function () {
                let value = this.value.replace(/\D/g, '');
                if (value) {
                    this.value = "₺" + parseInt(value).toLocaleString('tr-TR', { minimumFractionDigits: 0 });
                }
            });
        });
    </script>



