 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
  <div class="row">
<section class="content col-md-7">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Demirbaş Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($demirbas)){?>
            <form class="form-horizontal" id="form-demirbas" enctype="multipart/form-data" method="POST" action="<?php echo site_url('demirbas/save').'/'.$demirbas->demirbas_id;?>">
    <?php }else{?>
            <form class="form-horizontal" id="form-demirbas" enctype="multipart/form-data" method="POST" action="<?php echo site_url('demirbas/save');?>">
    <?php } ?>
    <div class="card-body">







<!-- /.row -->
<div class="row" style="background: whitesmoke;border: 2px dashed #495057ab;padding:5px;padding-top:18px;margin:1px;margin-bottom:10px !important">
        <div class="col-md-12 mt-2">
         
         
        <div id="actions" class="row">
          <div class="col-lg-12">
            <div class="btn-group w-100">
              <span class="btn btn-success col fileinput-button">
                <i class="fas fa-plus"></i>
                <span>Dosya Ekle</span>
              </span>
              <button type="submit" class="btn btn-primary col start">
                <i class="fas fa-upload"></i>
                <span>Yüklemeyi Başlat</span>
              </button>
              <button type="reset" class="btn btn-warning col cancel">
                <i class="fas fa-times-circle"></i>
                <span>Yüklemeyi İptal Et</span>
              </button>
            </div>
          </div>
          <div class="col-lg-6 d-none align-items-center">
            <div class="fileupload-process w-100">
              <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
              </div>
            </div>
          </div>
        </div>
        <div class="table table-striped files" id="previews">
          <div id="template" class="row mt-2">
            <div class="col-4 d-flex align-items-center">
              <p class="mb-0">
           
              <span class="lead" data-dz-name></span>
                (<span data-dz-size></span>)
              </p>
              <strong class="error text-danger" data-dz-errormessage></strong>
            </div>
            <div class="col-4 d-flex align-items-center">
              <div class="progress progress-striped active w-100" style="height:0.3rem" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="background-color:#01711a;width:0%;" data-dz-uploadprogress></div>
              </div>
            </div>
            <div class="col-4 d-flex pl-0 align-items-center">
              <div class="btn-group" style="display: contents;">
                <button type="button" class="btn btn-dark start">
                  <i class="fas fa-upload"></i>
                  <span>Yükle</span>
                </button>
                <button type="button" data-dz-remove class="btn btn-dark cancel">
                  <i class="fas fa-times-circle"></i>
                  <span>İptal</span>
                </button>
                <button type="button" data-dz-remove class="btn btn-danger delete">
                  <i class="fas fa-trash"></i>
                  <span>Sil</span>
                </button>
              </div>
            </div>
          </div>    
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->



 




    <div class="row mb-3">
        

 


        <div class="col-md-6">
        <label for="formClient-Code"> Demirbaş Kategorisi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-filter"></i></span>
              </div>
             
              <select name="kategori_id" class="select2 form-control rounded-0" style="width: 100%;">
              <?php foreach($demirbas_kategorileri as $kategori) : ?> 
                          <option  value="<?=$kategori->demirbas_kategori_id?>" <?php echo  (!empty($demirbas) && $demirbas->kategori_id == $kategori->demirbas_kategori_id) ? 'selected="selected"'  : '';?>><?=$kategori->demirbas_kategori_adi?></option>
            
                <?php endforeach; ?>  
                        </select>
        </div>  
      </div>







      <div class="col-md-6">
        <label for="formClient-Name"> Cihaz Adı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
         <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" value="<?php echo  !empty($demirbas) ? $demirbas->demirbas_adi : '';?>" class="form-control" name="demirbas_adi" required="" placeholder="Demirbaş Adını Giriniz..." autofocus="">
          </div>
      </div>


    </div>
    <div class="row mb-3 mt-2">

      <div class="col-md-6">
        <label for="formClient-Code"> Marka</label>
      
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Demirbaş Markasını Giriniz..." autofocus="">
       </div> 
    
      </div>

      <div class="col-md-6">
        <label for="formClient-Code"> Model</label>
       
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-pen"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_model : '';?>" class="form-control" name="demirbas_model" placeholder="Demirbaş Modelini Giriniz..." autofocus="">
     </div> 
 
      </div>
    </div>
    <div class="row  mb-3 mt-2">




      <div class="col-md-6">
        <label for="formClient-Code"> Seri Numarası</label>
        
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_seri_numarasi : '';?>" class="form-control" name="demirbas_seri_numarasi" placeholder="Demirbaş Seri Numarası Giriniz..." autofocus="">
         </div> 
      
      </div>




     


      <div class="col-md-6">
        <label for="formClient-Code"> Birim</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="demirbas_birim_no" class="select2 form-control rounded-0" style="width: 100%;">
                  <?php foreach($demirbas_birimleri as $demirbas_birim) : ?> 
                              <option  value="<?=$demirbas_birim->demirbas_birim_id?>" <?php echo  (!empty($demirbas) && $demirbas->demirbas_birim_no == $demirbas_birim->demirbas_birim_id) ? 'selected="selected"'  : '';?>><?=$demirbas_birim->demirbas_birim_adi?></option>
                
                    <?php endforeach; ?>  
              </select> 
        </div> 

        </div>

    </div>

 
    <div class="row  mb-3 mt-2">

      <div class="col-md-6">
        <label for="formClient-Code"> İşlemci CPU</label>
       
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-microchip"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_islemci : '';?>" class="form-control" name="demirbas_islemci" placeholder="Demirbaş İşlemci Bilgisi Giriniz..." autofocus="">
        </div> 
      
      </div>

      <div class="col-md-6">
        <label for="formClient-Code"> Ram</label>
       
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-memory"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_ram : '';?>" class="form-control" name="demirbas_ram" placeholder="Demirbaş Ram Bilgisini Giriniz..." autofocus="">
       </div> 
      
      </div>
    </div>



    <div class="row  mb-3 mt-2">

<div class="col-md-6">
  <label for="formClient-Code"> Garanti Süresi</label>
 
  <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text rounded-2"><i class="fas fa-microchip"></i></span>
        </div>
        <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_garanti_tarihi)) : '';?>" class="form-control" name="demirbas_garanti_tarihi" placeholder="Demirbaş Garanti Bilgisi Giriniz..." autofocus="">
  </div> 

</div>

<div class="col-md-6">
<label for="formClient-Code"> Telefon Numarası</label>
 
 <div class="input-group">
       <div class="input-group-prepend">
         <span class="input-group-text rounded-2"><i class="fas fa-microchip"></i></span>
       </div>
       <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_telefon_numarasi : '';?>" class="form-control" name="demirbas_telefon_numarasi" placeholder="Demirbaş Telefon Bilgisi Giriniz..." autofocus="">
 </div> 

 

</div>
</div>



<div class="row  mb-3 mt-2">

<div class="col-md-6">
<label for="formClient-Code"> Pin Kodu</label>
 
 <div class="input-group">
       <div class="input-group-prepend">
         <span class="input-group-text rounded-2"><i class="fas fa-memory"></i></span>
       </div>
       <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_pin_kodu : '';?>" class="form-control" name="demirbas_pin_kodu" placeholder="Demirbaş Pin Bilgisini Giriniz..." autofocus="">
</div> 

</div>

<div class="col-md-6">
  <label for="formClient-Code"> Puk Kodu</label>
 
  <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text rounded-2"><i class="fas fa-memory"></i></span>
        </div>
        <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_puk_kodu : '';?>" class="form-control" name="demirbas_puk_kodu" placeholder="Demirbaş Puk Bilgisini Giriniz..." autofocus="">
 </div> 

</div>
</div>


    <div class="row  mb-3 mt-2">

      <div class="col-md-6">
        <label for="formClient-Code"> Disk</label>
       <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-hdd"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_disk : '';?>" class="form-control" name="demirbas_disk" placeholder="Demirbaş Disk Bilgisini Giriniz..." autofocus="">
          </div>   
      
      </div>

      <div class="col-md-6">
        <label for="formClient-Code"> Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="demirbas_kullanici_id" class="select2 form-control rounded-0" style="width: 100%;">
                  <?php foreach($kullanicilar as $kullanici) : ?> 
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>

      </div>

    <div class="row mt-2">
       
      
    <div class="col-md-12">
        <label for="formClient-Code"> Cihaz Açıklama</label>
        <div>
         <textarea name="demirbas_aciklama" id="summernote5"><?php echo !empty($demirbas) ? $demirbas->demirbas_aciklama : '';?></textarea>
        </div>     
      </div>

      </div>

      <input type="hidden" name="fileNames" id="fileNames">
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("demirbas")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>









<section class="content col-md-5 <?=(empty($demirbas))?"d-none":""?>">
  <div class="card card-dark">
      <div class="card-header with-border">
        <h3 class="card-title"> Demirbaş Bilgileri</h3>
      </div>
      <div class="card-body" style="display:flex" id="hedefDiv">
        <div class="row" style="width:100%">
          <div class="col" style="flex-basis: 0;max-width: 65px;">
          <div id="qrcode"></div> 
          </div>
          <div class="col p-0" style="margin-top:-8px;line-height: initial;">
            <span style="font-size:32px;font-weight:bolder">UG TEKNOLOJİ</span><br>
            <span style="font-size:16px;font-weight:lighter">Demirbaş Kodu : <b><?=$demirbas->demirbas_kodu?></b></span>
            <span style="font-size:16px;font-weight:lighter;margin-left:10px">Kayıt Tarihi : <b><?=date("d.m.Y",strtotime($demirbas->demirbas_kayit_tarihi))?></b></span>
          </div>
          <button class="btn btn-success btn-md no-print" style="height:40px" onclick="yazdir()">
          <i class="fa fa-print"></i>
          Yazdır</button>
        </div>
     
    
      </div>


  </div>







  <div class="card card-dark <?=(empty($demirbas))?"d-none":""?>">
      <div class="card-header with-border">
        <h3 class="card-title"> Demirbaş İşlem Ekle</h3>
      </div>
      <div class="card-body p-2" id="hedefDiv">
     <form action="<?=base_url("demirbas/save_action/$demirbas->demirbas_id")?>" method="POST">
    
     <textarea id="summernote4" required name="islem_aciklama"></textarea>
      <button type="submit" class="btn btn-success mb-2"><i class="fa fa-save"></i> İşlemi Kaydet</button>
      <button type="button" onclick="$('#summernote4').summernote('code', '');" class="btn btn-default mb-2"><i class="fa fa-eraser"></i> Giriş Alanı Temizle</button>
    </form>
     
      </div>
      
      </div>

















  <div class="card card-dark <?=(empty($demirbas))?"d-none":""?>">
      <div class="card-header with-border">
        <h3 class="card-title"> Demirbaş İşlemleri</h3>
      </div>
      <div class="card-body p-2" id="hedefDiv">
      <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>İşlem Detayı</th>
                    <th>Kullanıcı</th>
                    <th style="width: 120px;">İşlem Tarihi</th>
                    <th style="max-width: 50px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php   $count=0; foreach ($demirbas_islemleri as $demirbas_islem) : ?>
                     
                    <tr>
              
                     
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=($demirbas_islem->islem_aciklama) ? $demirbas_islem->islem_aciklama : "<span style='opacity:0.4'>Açıklama Girilmedi</span>"?>
 
                      </td>
                      <td><i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$demirbas_islem->kullanici_ad_soyad?></td>
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($demirbas_islem->islem_kayit_tarihi));?></td>
                     
                      <td>
                    
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('demirbas/islem/sil/').$demirbas->demirbas_id.'/'.$demirbas_islem->islem_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>
                       
                    </tr>
                  <?php
                       
                        endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>İşlem Detayı</th>
                    <th>Kullanıcı</th>
                    <th style="width: 130px;">İşlem Tarihi</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
     
    
      </div>


  </div>
</section>





</div>




            </div>


  <script src="<?=base_url("assets")?>/dist/js/qrcode.min.js"></script>
  <script>
 
    var qrcode = new QRCode("qrcode", {
    text: "<?=($demirbas!=null ? $demirbas->demirbas_kodu : 0)?>",
    width: 50,
    height: 50,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.L
});

	</script>

<script>
        function yazdir() {
            // Div öğesini seç
            var hedefDiv = document.getElementById("hedefDiv");

            // Yazdırma işlemini başlat
            var yazdirWindow = window.open('', '_blank');
            yazdirWindow.document.write('<html><head><title>Div İçeriği</title><link rel="stylesheet" type="text/css" href="<?=base_url("assets")?>/dist/css/adminlte.min.css"></head><body style="padding:10px">');
            yazdirWindow.document.write(hedefDiv.innerHTML);
            yazdirWindow.document.write('</body></html>');

            // Yazdırma penceresini kapat
            yazdirWindow.document.close();
            yazdirWindow.addEventListener("load", function (){
 
      yazdirWindow.print();
   
}); 
           
        }
    </script>
    <style>
      @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
      </style>
