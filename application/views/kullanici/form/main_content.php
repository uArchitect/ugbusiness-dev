 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
     
<?php if(!empty($kullanici)){?>
            <form class="form-horizontal" id="form-custom" method="POST" action="<?php echo site_url('Kullanici/save').'/'.$kullanici->kullanici_id;?>">
    <?php }else{?>
            <form class="form-horizontal" id="form-custom" method="POST" action="<?php echo site_url('Kullanici/save');?>">
    <?php } ?>
<section class="content">
<div class="row">
  <div class="col-md-7">

  <div class="first-div card text-sm">
    <div class="card-header with-border">
      <h3 class="card-title"><strong><?php echo  !empty($kullanici) ? strtoupper($kullanici->kullanici_ad_soyad) : '';?></strong> Kullanıcı Bilgileri</h3>
     
     
    </div>

    <div class="card-body">

   

    <!-- /.row -->
    <div class="row" style="background: whitesmoke;border: 2px dashed #495057ab;padding:5px;padding-top:28px;margin:1px;margin-bottom:20px !important">
        <div class="col-md-12 mt-2">
          <div class="row">
            <img width="70px" src="<?=base_url("assets/dist/img/upload-image.jpg")?>" style="opacity:0.7;margin:auto" alt="">
          </div>
          <div class="row pl-2 pr-2 text-center" >
            <b class="text-center" style="margin:auto">Kullanıcı Görsel Yükle</b>
          </div>
          <div class="row pl-2 pb-2">
          <span style="margin:auto">
            Yüklemek istediğiniz görseli seçin. İzin verilen formatlar :<strong>*.pdf, *.jpeg, *.jpg, *.png</strong>, Dosya Boyutu : <strong>2 MB</strong>
          </span>  
        </div>
        <div id="actions" class="row pb-4">
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


      <div class="row">
        <div class="col-md-6">

        <div class="form-group">
          <label for="formClient-Name"> Ad Soyad</label> 
          <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
           
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_ad_soyad : '';?>" name="kullanici_ad_soyad" class="form-control rounded-2" placeholder="Kullanıcı Ad Soyad Giriniz">
            </div>
          </div>
       
          <div class="form-group">
        <label for="formClient-Name"> Departman</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="kullanici_departman_id" class="select2 form-control rounded-2" style="width: 100%;">
          <?php foreach($departmanlar as $departman) : ?>
                    <option  data-icon="fa fa-building"  value="<?=$departman->departman_id?>" <?php echo  (!empty($kullanici) && $kullanici->kullanici_departman_id == $departman->departman_id) ? 'selected="selected"'  : '';?>><?=$departman->departman_adi?></option>
          <?php endforeach; ?>         
        </select>
        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
        Sisteme tanımlanmış <strong>şirket departman</strong> listesine yeni kayıt eklemek için  Menü / Parametreler / Departmanlar / <a href="">+ Yeni Departman Ekle</a> sekmesini kullanabilirsiniz.
        </p>
      </div>

         

    
  

        </div>
        <div class="col-md-6">



        <div class="form-group">
            <label for="formClient-Name"> Email Adresi</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-envelope"></i></span>
              </div>
              <input name="kullanici_email_adresi" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_email_adresi : '';?>" type="email" class="form-control rounded-2" placeholder="Email Adresini Giriniz">
            </div>
          </div>


      <div class="form-group">
        <label for="formClient-Code"> Kullanıcı Grup</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="kullanici_grup_no" class="select2 form-control rounded-2" style="width: 100%;">
        <?php foreach($kullanici_gruplari as $kullanici_grup) : ?> 
                    <option  data-icon="fa fa-users " value="<?=$kullanici_grup->kullanici_grup_id?>" <?php echo  (!empty($kullanici) && $kullanici->kullanici_grup_no == $kullanici_grup->kullanici_grup_id) ? 'selected="selected"'  : '';?>><?=$kullanici_grup->kullanici_grup_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
        Sisteme tanımlanmış <strong>kullanıcı grup</strong> bilgilerine yeni kayıt eklemek için  Menü / Parametreler / Kullanıcı Grupları / <a href="">+ Yeni Grup Ekle</a> sekmesini kullanabilirsiniz.
        </p>
      </div>
      
 
 


        </div>
      </div>



      <div class="row">
         
        <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name"> Kullanıcı Adı</label>
            
          <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_adi : '';?>" required name="kullanici_adi" class="form-control rounded-2" placeholder="Kullanıcı Adını Giriniz">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <div class="row">
              <div class="col"><label for="formClient-Name">Kullanıcı Şifresi</label>  <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label></div>
              <div class="col text-right"><label for="formClient-Name" style="font-weight:normal;"><a href="#" style="color:#018f07" onclick="document.getElementById('kullanici_sifre').value = Math.random().toString(36).substr(2, 18);"> + Rastgele Şifre Oluştur </a></label></div>
           <a href="<?=base_url("kullanici/smssifre/".(!empty($kullanici) ? $kullanici->kullanici_id : ''))?>">Şifreyi Sms Olarak Gönder</a>
            </div>

            
            
        
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-key"></i></span>
              </div>
              <input name="kullanici_sifre" id="kullanici_sifre" required value="<?php echo  !empty($kullanici) ? base64_decode($kullanici->kullanici_sifre) : '';?>" type="text" class="form-control rounded-2" placeholder="Kullanıcı Şifresini Giriniz">
            </div>
          </div>
        </div>
      </div>

 

      <div class="row">
         
        <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name">Dahili İletişim No</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" name="kullanici_dahili_iletisim_no" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_dahili_iletisim_no : '';?>" class="form-control rounded-2" placeholder="Dahili İletişim Numarasını Giriniz" data-inputmask="&quot;mask&quot;: &quot;9999&quot;" data-mask="" inputmode="text">
              <p class="text-muted well well-sm shadow-none col-md-12" style="margin-top: 10px;">
                Dahili iletişim numarası 4 haneli olacak şekilde girilmelidir. Örneğin : 0000
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name">Bireysel İletişim No</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" name="kullanici_bireysel_iletisim_no" class="form-control rounded-2" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_bireysel_iletisim_no : '';?>" placeholder="Bireysel İletişim Numarasını Giriniz" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="" inputmode="text">
              <p class="text-muted well well-sm shadow-none col-md-12" style="margin-top: 10px;">
                Bireysel iletişim numarası başında <strong>0(Sıfır)</strong> olmadan 10 haneli olacak şekilde girilmelidir. Örneğin : (555) 444-33-22
              </p>
            </div>
          </div>
        </div>
      </div>









      <div class="row">

      <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name">Kullanıcı API PC KEY</label>
            <div class="input-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ribbon"></i></span>
              </div>
              <input type="text" name="kullanici_api_pc_key" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_api_pc_key : '';?>" class="form-control rounded-2" placeholder="Kullanıcı Api Key Giriniz" inputmode="text">
           
            </div>
               
            </div>
          </div>
        </div>



      <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name">Kullanıcı Ünvan</label>
            <div class="input-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ribbon"></i></span>
              </div>
              <input type="text" name="kullanici_unvan" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_unvan : '';?>" class="form-control rounded-2" placeholder="Kullanıcı Ünvanını Giriniz" inputmode="text">
           
            </div>
               
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="formClient-Name">Kullanıcı Yönetici/Sorumlu</label>
            <div class="input-group">
            
              <select class="select2" name="kullanici_yonetici_kullanici_id" class="form-control rounded-2" style="width: 100%;border: 1px solid #ced4da;">
              <option data-icon="fa fa-times"  value="0" <?php echo  (!empty($kullanici) && $kullanici->kullanici_yonetici_kullanici_id === 0) ? 'selected="selected"'  : '';?>>Sorumlu / Yönetici Seçilmedi</option>
      
        <?php foreach($sorumlu_kullanicilar as $d_kullanici) : ?> 

                    <option data-icon="fa fa-user" value="<?=$d_kullanici->kullanici_id?>" <?php echo  (!empty($kullanici) && $kullanici->kullanici_yonetici_kullanici_id == $d_kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$d_kullanici->kullanici_ad_soyad?> / <?=$d_kullanici->kullanici_grup_adi?> / <?=$d_kullanici->departman_adi?> Departmanı</option>
      
          <?php endforeach; ?>  
                  </select>   
            </div>
          </div>
        </div>



        <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name">Kullanıcı Doğum Tarihi</label>
            <div class="input-group">
            
            <input type="date" name="kullanici_dogum_tarihi" value="<?php echo  !empty($kullanici) ? date("Y-m-d",strtotime($kullanici->kullanici_dogum_tarihi)) : '';?>" class="form-control rounded-2">
           
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name">Kullanıcı İşe Giriş Tarihi</label>
            <div class="input-group">
            
            <input type="date" name="kullanici_ise_giris_tarihi" value="<?php echo  !empty($kullanici) ? date("Y-m-d",strtotime($kullanici->kullanici_ise_giris_tarihi)) : '';?>" class="form-control rounded-2">
           
            </div>
          </div>
        </div>




        <div class="col-md-6">
          <div class="form-group">
            <label for="formClient-Name">Kullanıcı Kapı Kart Numarası</label>
            <div class="input-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ribbon"></i></span>
              </div>
              <input type="text" name="kullanici_kart" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_kart : '';?>" class="form-control rounded-2" placeholder="Kullanıcı Kartını Giriniz" inputmode="text">
           
            </div>
               
            </div>
          </div>
        </div>

          <div class="col-md-12">
          <div class="form-group">
            <label for="formClient-Name">adres</label>
            <div class="input-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ribbon"></i></span>
              </div>
              <input type="text" name="kullanici_adres" value="<?php echo  !empty($kullanici) ? $kullanici->kullanici_adres : '';?>" class="form-control rounded-2" placeholder="Kullanıcı Adresini Giriniz" inputmode="text">
           
            </div>
               
            </div>
          </div>
        </div>
      </div>







    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("kullanici")?>" class="btn btn-flat btn-default"><i class="fas fa-users" style="margin-right:5px"></i> Tüm Kullanıcıları Görüntüle</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-success">
          <i class="fa fa-save" style="margin-right:5px"></i>
        <?php if(!empty($kullanici)){ echo "Değişiklikleri Kaydet";} else {echo "Kaydet";}?>
        </button></div>
      </div>
    </div>
    <!-- /.card-footer-->

  </div>
            <!-- /.card -->

  </div>

<div class=" col-md-5">
<div class="card  " style="height:957px">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fa fa-users" style="margin-right:5px;opacity:1;margin-right:20px"></i>  
                Kullanıcı Yetkileri</h3>
                <div class="col text-right"> 
                    <label for="formClient-Name" style="margin:0px;font-weight:normal;  opacity:0.5; ">
                    <i class="fa fa-info-circle" style="margin-right:5px;opacity:1"></i>
                    Toplam <?=count($kullanici_yetkileri)?> adet yetki bulunmaktadır.
                     
                  
                  </label>
                </div>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table  table-striped">
              
                  <tbody>
                    <?php
                    $count = 1;
                    $temp=0;
                      foreach ($kullanici_yetkileri as $kullanici_yetki) {
                        ?> 
                        <?php
                        if($temp != $kullanici_yetki->yetki_grup_id){
                         ?>

                        <tr style="font-weight:bolder;background: #495057;color: white;">
                          <td><i class="fa fa-key" style="margin-right:5px;opacity:1"></i></td>
                          <td><?=$kullanici_yetki->kullanici_yetki_grup_adi?></td>
                          <td></td>
                          <td></td>
                        </tr>  
                          <tr>
                            <th style="padding: 0.30em !important;padding-left:25px !important;width: 10px">#</th>
                            <th style="padding: 0.30em !important;padding-left:10px !important;">Yetki Tanımı</th>
                            <th style="padding: 0.30em !important;padding-left:10px !important;">Yetki Kodu</th>
                            <th style="padding: 0.30em !important;padding-left:10px !important;min-width: 70px">Yetki</th>
                          </tr> 
                        <?php
                          }
                        ?>


                         <tr>
                          <td><?=$count++?>.</td>
                          <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i><?=$kullanici_yetki->kullanici_yetki_adi?></td>
                          <td><i class="fa fa-code" style="margin-right:5px;opacity:0.8"></i><?=$kullanici_yetki->kullanici_yetki_kodu?></td>
                          <td><input style="padding-right:-1px" type="checkbox" id="my-checkboxaa" value="<?=$kullanici_yetki->kullanici_yetki_kodu?>" name="yetki[]" <?php if(!empty($kullanici) && !empty($kullanici_yetki_tanimlari) && in_array($kullanici_yetki->kullanici_yetki_kodu, array_column($kullanici_yetki_tanimlari, 'yetki_kodu')) ){ echo "checked";} ?>  data-bootstrap-switch>
                        
                        
                        </td>
                        </tr> 
                        <?php
                    $temp=$kullanici_yetki->yetki_grup_id;  }
                    ?>
                   
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
    </div>

        </div>


        
    
</section>


<input type="hidden" name="fileNames" id="fileNames">



<?php

      if(!empty($kullanici)){
        
        ?>


<div class="row">
  <div class="col">


  <section class="content text-md">
  <div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Log</h3>
                <a href="<?=base_url("kullanici-yetkileri/ekle")?>" type="button" class="btn btn-success btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="examplelog" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   
                    <th>Kullanıcı Adı</th>
                    <th>İşlem Tipi</th>
                    <th>İşlem Detayı</th>
                    <th>İşlem Tarihi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php  foreach ($logs as $log) : ?>
                  
                    <tr>
                      
                      <td><i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$log->kullanici_ad_soyad?></td>
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$log->log_tipi?> 
                    </td>
                      <td style="display: flex;">
                        <i class="fa fa-code" style="margin-right:5px;opacity:0.8"></i>
                        <?=$log->log_detay?>
                        
                      </td>
                      <td> <?=date("d.m.Y H:i:s",strtotime($log->log_kayit_tarihi))?></td>
                 
                       
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  
                    <th>Kullanıcı Adı</th>
                    <th>İşlem Tipi</th>
                    <th>İşlem Detayı</th>
                    <th>İşlem Tarihi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>

  </div>
</div>




        <?php
      }
?>












</form>




 










            </div>




            <script>
        var div1 = document.querySelector('.first-div');
        var div2 = document.querySelector('.secondary-div');
        
        var maxHeight = div1.clientHeight;
         
        div2.style.height = maxHeight + 'px';
    </script>