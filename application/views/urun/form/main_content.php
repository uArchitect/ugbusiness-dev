 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->
     <div class="row">
<section class="content col-md-3">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Ürün Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($urun)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('urun/save').'/'.$urun->urun_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('urun/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Ürün Adı</label>
        <input type="text"  readonly value="<?php echo  !empty($urun) ? $urun->urun_adi : '';?>" class="form-control" name="urun_adi" required="" placeholder="Ürün Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->urun_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Ürün Açıklama</label>
        <input type="text" readonly value="<?php echo !empty($urun) ? $urun->urun_aciklama : '';?>" class="form-control" name="urun_aciklama" placeholder="Ürün Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->urun_aciklama ?? ''; ?></p>
      </div>
  
      <div class="form-group">
        <label for="formClient-Code"> Ürün Satış Fiyatı</label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_satis_fiyati,0,",",".") : '';?>" class="money form-control" name="urun_satis_fiyati" placeholder="Ürün Satış Fiyatını Giriniz..." autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Ürün Vade Farkı </label>
        <input type="text" value="<?php echo !empty($urun) ? $urun->urun_vade_farki : '';?>" class="form-control" name="urun_vade_farki" placeholder="Ürün Vade Farkını Giriniz..." autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Ürün Peşinat Fiyatı </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_pesinat_fiyati,0,",",".") : '';?>" class="money form-control" name="urun_pesinat_fiyati" placeholder="Ürün Peşinat Fiyatını Giriniz..." autofocus="">
       </div>


       <div class="form-group">
        <label for="formClient-Code"> Satış Pazarlık Payı </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->satis_pazarlik_payi,0,",",".") : '';?>" class="money form-control" name="satis_pazarlik_payi" placeholder="Satış Pazarlık Payını Giriniz..." autofocus="">
       </div>
 

       <div class="form-group" style="<?=(aktif_kullanici()->kullanici_id == 1) ? "" : "opacity:0;height:0"?>">
        <label for="formClient-Code"> Peşinat Artış Aralığı (Sadece Gösterim) </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->pesinat_artis_aralik,0,",",".") : '';?>" class="money form-control" name="pesinat_artis_aralik" placeholder="Peşinat Artış Aralığını Giriniz..." autofocus="">
       </div>

       <div class="form-group" style="<?=(aktif_kullanici()->kullanici_id == 1) ? "" : "opacity:0;height:0"?>">
        <label for="formClient-Code"> Artış Üst Limit (Sadece Gösterim) </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_pesinat_artis_ust_fiyati,0,",",".") : '';?>" class="money form-control" name="urun_pesinat_artis_ust_fiyati" placeholder="Peşinat Üst Fiyat Giriniz..." autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Nakit Umex Takas Fiyat </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_nakit_umex_takas_fiyat,0,",",".") : '';?>" class="money form-control" name="nakit_umex_takas_fiyat" autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Vadeli Umex Takas Fiyat </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_vadeli_umex_takas_fiyat,0,",",".") : '';?>" class="money form-control" name="vadeli_umex_takas_fiyat" autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Nakit Robotx Takas Fiyat </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_nakit_robotix_takas_fiyat,0,",",".") : '';?>" class="money form-control" name="nakit_robotix_takas_fiyat" autofocus="">
       </div>
       <div class="form-group">
        <label for="formClient-Code"> Vadeli Robotx Takas Fiyat </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_vadeli_robotix_takas_fiyat,0,",",".") : '';?>" class="money form-control" name="vadeli_robotix_takas_fiyat" autofocus="">
       </div>



       <div class="form-group">
        <label for="formClient-Code"> Nakit Diğer Cihaz Takas Fiyat </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_nakit_diger_takas_fiyat,0,",",".") : '';?>" class="money form-control" name="nakit_diger_takas_fiyat" autofocus="">
       </div>
       <div class="form-group">
        <label for="formClient-Code"> Vadeli Diğer Cihaz Takas Fiyat </label>
        <input type="text" value="<?php echo !empty($urun) ? "₺" .number_format($urun->urun_vadeli_diger_takas_fiyat,0,",",".") : '';?>" class="money form-control" name="vadeli_diger_takas_fiyat" autofocus="">
       </div>


      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("urun")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>

<section class="col-md-9" style="margin-top:-5px;">
  
<table id="example1" style="border:2px solid red; border-top:0px" class="table table-bordered table-striped text-md">
                  <thead>
                  <tr>
                    <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK TAKSİT TUTARI</th>
                    <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >TOPLAM DİP FİYAT</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >SATIŞ KONTROL FİYAT</th>
                 
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
                 <td class="text-danger" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis_satisci,2, ',', '.')." ₺"?></td> 
                
                 
                      </tr>
                    
                      <?php $count++; endforeach; ?>
                  </tbody>
                   
                </table>
                 
    </section>
    </div>

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