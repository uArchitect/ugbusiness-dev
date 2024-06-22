 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top:10px">
  <div class="row mt-2">

  


  <section class="content col-md-6 pr-0">


<?php  if(!empty($dokuman)) : ?>

  <div class="row pb-0 ">
          <div class="col-lg-4 col-6 p-0">
            <!-- small box -->
            <div class="small-box bg-primary mb-1">
              <div class="inner">
                <h3 style="font-size:22px">
                <?php 
                if(count($incelemeler) > 0){
                  $inceleme_tarihi = date_format(date_create($incelemeler[count($incelemeler)-1]->inceleme_kayit_tarihi),"d.m.Y H:i"); 
                  echo $inceleme_tarihi;
                }else{
                  echo "<span style='font-size:18px'>İnceleme Yapılmadı</span>";
                }
              ?></h3>
                <p><i class="fa fa-eye" style="opacity:0.2;margin-right:2px"></i> <span style="opacity:0.8;">
                
                <?php
              if(count($incelemeler) > 0){
                $tarih1= new DateTime(date('d.m.Y H:i'));
            $tarih2= new DateTime(date('d.m.Y H:i', strtotime($inceleme_tarihi)));
            $interval= $tarih1->diff($tarih2);
            echo $interval->format('%a gün önce.');

              }else{
                echo "<span style='font-size:18px'>İnceleme Yapılmadı</span>";
              }
           
            ?> </span></p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fa fa-calendar-alt"></i> Son Gözden Geçirilme Tarihi </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6 pl-1 pr-1 pb-0">
            <!-- small box -->
            <div class="small-box bg-warning mb-1">
              <div class="inner">
              <h3 style="font-size:22px"><?php
              if(count($incelemeler) > 0){
                $date = $incelemeler[count($incelemeler)-1]->inceleme_kayit_tarihi;
              $date = strtotime($date);
              $new_date = strtotime('+ 1 year', $date);
              echo date('d.m.Y H:i', $new_date);
              }else{
                echo "<span style='font-size:18px'>İnceleme Yapılmadı</span>";
              }
             
              
              
              
              ?></h3>


              <p><i class="fa fa-arrow-up" style="opacity:0.2;margin-right:2px"></i> <span style="opacity:0.8;">
              
              <?php
              if(count($incelemeler) > 0){
                $tarih1= new DateTime(date('d.m.Y H:i'));
            $tarih2= new DateTime(date('d.m.Y H:i', $new_date));
            $interval= $tarih1->diff($tarih2);
            echo $interval->format('%a gün kaldı.');

              }else{
                echo "<span style='font-size:18px'>İnceleme Yapılmadı</span>";
              }
           
            ?> 
            
          
          
          </span></p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fa fa-calendar-alt"></i> Sonraki Gözden Geçirme Tarihi</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6 p-0 pb-0">
            <!-- small box -->
            <div class="small-box bg-success mb-1">
              <div class="inner">
              <h3 style="font-size:22px">
              <?php
              if(count($revizyonlar) > 0){
                $rdate = strtotime($revizyonlar[count($revizyonlar)-1]->revizyon_kayit_tarihi);
                echo date('d.m.Y H:i', $rdate);
                
              }else{
                echo "<span style='font-size:18px'>Revizyon Eklenmedi</span>";
              }
            
              
              
              ?>
            </h3>
              <p><i class="fa fa-file-alt" style="opacity:0.2;margin-right:2px"></i> <span style="opacity:0.8;">
            
              <?php
              if(count($revizyonlar) > 0){
                $rdate = strtotime($revizyonlar[count($revizyonlar)-1]->revizyon_kayit_tarihi);
              $tarih1= new DateTime(date('d.m.Y H:i'));
              $tarih2= new DateTime(date('d.m.Y H:i', $rdate));
              $interval= $tarih1->diff($tarih2);
              if($interval->format('%a') != "0"){
                echo $interval->format('%a gün önce.'); 
              
              }else{

                echo "Bugün eklendi."; 
              
              }
              
              }else{
                echo "<span style='font-size:18px'>Revizyon Eklenmedi</span>";
              }


            
              
              ?>
            </span></p>
             </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fa fa-calendar-alt"></i> Son Eklenen Revizyon Tarihi</a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->



        <?php  endif; ?>








    <div class="card card-dark">
      <div class="card-header with-border">
        <h3 class="card-title"> Dokuman Bilgileri</h3>
      </div>
      
    <?php if(!empty($dokuman)){?>
        <form class="form-horizontal" id="form-dokuman" enctype="multipart/form-data"  method="POST" action="<?php echo site_url('dokuman/save').'/'.$dokuman->dokuman_id;?>">
    <?php }else{?>
        <form class="form-horizontal" id="form-dokuman"  enctype="multipart/form-data" method="POST" action="<?php echo site_url('dokuman/save');?>">
    <?php } ?>
      <div class="card-body">





      <?php if(empty($dokuman)) :?>
<!-- /.row -->
    <div class="row" style="background: whitesmoke;border: 2px dashed #495057ab;padding:5px;padding-top:18px;margin:1px;margin-bottom:10px !important">
        <div class="col-md-12 mt-2">
          <div class="row">
            <img width="70px" src="<?=base_url("assets/dist/img/upload-image.jpg")?>" style="opacity:0.7;margin:auto" alt="">
          </div>
          <div class="row pl-2 pr-2 text-center" >
            <b class="text-center" style="margin:auto">Döküman Belge Yükle</b>
          </div>
          <div class="row pl-2 pb-2">
          <span style="margin:auto">
            Yüklemek istediğiniz görseli seçin. İzin verilen formatlar :<strong>*.pdf, *.jpeg, *.jpg, *.png</strong>, Dosya Boyutu : <strong>2 MB</strong>
          </span>  
        </div>
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
    <?php endif; ?>






        <div class="row">
          <div class="form-group col-md-3 p-0 mb-0">
          <label for="formClient-Name"> Dokuman No</label>
            <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-database"></i></span>
              </div>
            <input type="text" value="<?php echo  !empty($dokuman) ? $dokuman->dokuman_belge_no : '';?>" class="form-control" name="dokuman_belge_no" required="" placeholder="Dokuman No Giriniz..." autofocus="">
            <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->dokuman_belge_no ?? ''; ?></p>
            </div>  </div>
          <div class="form-group col-md-9 pr-0 mb-0">
          <label for="formClient-Name"> Dokuman Adı</label>
            <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-pen"></i></span>
              </div>
            <input type="text" value="<?php echo  !empty($dokuman) ? $dokuman->dokuman_adi : '';?>" class="form-control" name="dokuman_adi" required="" placeholder="Dokuman Adını Giriniz..." autofocus="">
            <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->dokuman_adi ?? ''; ?></p>
            </div>  </div>
        </div>
         <div class="form-group pt-0 mt-2">
            <label for="formClient-Name"> Dokuman Kategorisi</label>
            <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-filter"></i></span>
              </div>
             
              <select name="dokuman_kategori_no" class="select2 form-control rounded-0" style="width: 100%;">
              <?php foreach($dokuman_kategorileri as $kategori) : ?> 
                <?php if($kategori->dokuman_kategori_id == "1"){continue;} ?>
                          <option  value="<?=$kategori->dokuman_kategori_id?>" <?php echo  (!empty($dokuman) && $dokuman->dokuman_kategori_no == $kategori->dokuman_kategori_id) ? 'selected="selected"'  : '';?>><?=$kategori->dokuman_kategori_adi?> / <?=$kategori->dokuman_kategori_aciklama?></option>
            
                <?php endforeach; ?>  
              </select>
            </div>
          </div>

          <div class="form-group p-0">
            <label for="formClient-Name"> Geçerlilik Tarihi</label>
            <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-calendar"></i></span>
              </div>
            <input type="date" value="<?php echo  !empty($dokuman) ? date("Y-m-d",strtotime($dokuman->dokuman_yururluk_tarihi)) :date("Y-m-d");?>" class="form-control" name="dokuman_yururluk_tarihi" required="" placeholder="Dokuman Geçerlilik Tarihi Giriniz..." autofocus="">
            </div>
          </div>





        
        <div class="form-group mb-5">
          <label for="formClient-Code"> Dokuman Açıklama</label>
          <textarea name="dokuman_aciklama" id="summernote3" style="display: none;"><?php echo !empty($dokuman) ? $dokuman->dokuman_aciklama : '';?></textarea>
          <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->dokuman_aciklama ?? ''; ?></p>
        </div>
      <input type="hidden" name="fileNames" id="fileNames">
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="row">
          <div class="col"><a href="<?=base_url("dokuman")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
          <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
        </div>
      </div>
      <!-- /.card-footer-->
    </form>
  </div>
  <!-- /.card --> 
  
  












  </section>



  
  <?php if(!empty($dokuman)) :?>
  <!--reviz-->
  <section class="content col-md-6">



 
        





        <div class="card card-dark " style="height:405px">
      <div class="card-header with-border"  >
        <h3 class="card-title"> Revizyon Geçmişi</h3>
        <button onclick="document.getElementById('revizyon_upload').style.display = 'block';this.style.display='none';" type="button" class="btn btn-success btn-xs" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Revizyon Ekle</button>
      </div>
      <!-- /.row -->
      <div class="card-body text-center <?php if(count($revizyonlar)>0){echo "d-none"; }?>">
          <img width="160" style="margin:auto" src="<?=base_url("assets/dist/img/empty-place-holder.png")?>">      
          <h4 style="font-size:17px;color:#e78301;font-weight:bolder" >Revizyon Kaydı Bulunamadı</h4>
          <h5 style="margin:auto;margin-bottom:30px;max-width:450px;font-size:15px;color:#edaf56" >Bu dökümana tanımlı revizyon kayıtları bulunamadı. Yeni revizyon kaydı eklemek için Yeni Revizyon Ekle seçeneğine tıklayınız.</h5>
        </div>
   
      <div class="card-body  table-responsive p-0 <?php if(count($revizyonlar)==0){echo "d-none"; }?>">
      <table class="table  table-bordered table-striped text-sm">
                  <thead>
                  <tr>
              
                    <th style="width: 170px;" >Revizyon No</th>
                   
                    <th>Revizyon Detayı</th>
                   
                    <th>Kayıt / Revizyon Tarihi</th>
                    <th style="width: 170px;">Revizyon İşlemleri</th> 
                
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($revizyonlar as $revizyon) : ?>
        
                    <tr>

                  


                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$revizyon->revizyon_kodu?> 
                    </td>

                      
                     
                      <td>         <?=($revizyon->revizyon_aciklama == "" || $revizyon->revizyon_aciklama == null) ?"<span style='opacity:0.5'>Bu revizyon için detay girilmedi...</span>": $revizyon->revizyon_aciklama  ?> </td>
                     
                      <td><?=$revizyon->kullanici_ad_soyad?> - <?=date('d.m.Y H:i',strtotime($revizyon->revizyon_kayit_tarihi));?></td>
                       
                    
                      <td style="vertical-align:middle !important">
                          <a href="<?=base_url('uploads/').$revizyon->revizyon_dosya_adi?>" target="_blank" type="button" class="btn btn-dark btn-xs"><i class="fa fa-eye " style="font-size:12px" aria-hidden="true"></i> Görüntüle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('dokuman_revizyon/delete/').$dokuman->dokuman_id.'/'.$revizyon->revizyon_id?>');" class="btn btn-dark btn-xs"><i class="fa fa-times text-danger" style="font-size:12px" aria-hidden="true"></i> Sil</a>
                        
                      </td>
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                
                  <th style="width: 170px;" >Revizyon No</th>
                   
                   <th>Revizyon Detayı</th>
                  
                   <th>Kayıt / Revizyon Tarihi</th>
                   <th style="width: 170px;">Revizyon İşlemleri</th> 
                  </tr>
                  </tfoot>
                </table>
      </div>
      <!-- /.card-body --> 
    
  </div>
  <!-- /.card -->   














        <div class="card card-dark" style="display:none" id="revizyon_upload">
          <div class="card-header with-border">
            <h3 class="card-title"> Revizyon Yükle</h3>
            
          </div>
          <form class="form-horizontal" id="form-revizyon"  enctype="multipart/form-data" method="POST" action="<?php echo site_url('dokuman/revizyon_ekle/').$dokuman->dokuman_id;?>">

          <div class="card-body">

                      <!-- /.row -->
    <div class="row" style="background: whitesmoke;border: 2px dashed #495057ab;padding:5px;padding-top:18px;margin:1px;margin-bottom:10px !important">
        <div class="col-md-12 mt-2">
          <div class="row pl-2 pr-2 text-center" >
            <b class="text-center" style="margin:auto">Döküman Revizyonu Yükle</b>
          </div>
          <div class="row pl-2 pb-2">
          <span style="margin:auto">
            Yüklemek istediğiniz görseli seçin. İzin verilen formatlar :<strong>*.pdf, *.jpeg, *.jpg, *.png</strong>, Dosya Boyutu : <strong>2 MB</strong>
          </span>  
        </div>
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


                    <div class="row">
          <div class="form-group col-md-3">
            <label for="formClient-Name"> Revizyon No</label>
            <input type="text" class="form-control" name="revizyon_kodu" required="" placeholder="Revizyon No Giriniz..." autofocus="">
          
          </div>
          <div class="form-group col-md-9">
            <label for="formClient-Name"> Revizyon Detay</label>
            <input type="text" class="form-control" name="revizyon_aciklama" placeholder="Revizyon Açıklamasını Giriniz..." autofocus="">
       
          </div>
        </div>



        

              </div>


              <input type="hidden" name="revizyonFileNames" id="revizyonFileNames">
                    

              <div class="card-footer">
        <div class="row">
          <div class="col text-right"><button type="submit" class="btn btn-primary"> Revizyon Yükle</button></div>
        </div>
      </div>
      </form>
      <!-- /.card-footer-->
        </div>
















        <div class="card card-dark" style="margin-top:-8px ; height:450px">
      <div class="card-header with-border"  >
        <h3 class="card-title">İncelenme / Gözden Geçirme Geçmişi</h3>
        <a onclick="confirm_incelenme_action('İşlemi Onayla','Seçilen bu döküman için gözden geçirilme / incelenme kaydı oluşturmak istediğinize emin misiniz ?','Onayla','<?=base_url('dokuman/inceleme/ekle/').$dokuman->dokuman_id?>');" type="button" class="btn btn-success btn-xs" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Gözden Geçirme Ekle</a>
      </div>
      <!-- /.row -->


      <div class="card-body p-0 text-center <?php if(count($incelemeler)>0){echo "d-none"; }?>">
          <img width="170" style="margin:auto" src="<?=base_url("assets/dist/img/empty-place-holder.png")?>">      
          <h4 style="font-size:17px;color:#e78301;font-weight:bolder" >İnceleme Kaydı Bulunamadı</h4>
          <h5 style="margin:auto;margin-bottom:30px;max-width:450px;font-size:15px;color:#edaf56" >Bu dökümana tanımlı inceleme / gözden geçirme kayıtları bulunamadı. Yeni inceleme kaydı eklemek için Yeni Gözden Geçirme Ekle seçeneğine tıklayınız.</h5>
        </div>


 
      <div class="card-body p-0 <?php if(count($incelemeler)==0){echo "d-none"; }?>">
      <table class="table table-bordered table-striped text-sm">
                  <thead>
                  <tr>
              
                    
                   
                    <th>İşlem Detayı</th>
                    <th>İnceleme Tarihi</th>
                    <th style="width: 190px;">İşlem</th> 
                
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($incelemeler as $inceleme) : ?>
        
                    <tr>

                   

                      
                     
                      <td> <?=$inceleme->kullanici_ad_soyad?> tarafından gözden geçirildi / incelendi.</td>
                      <td> <?=date('d.m.Y H:i',strtotime($inceleme->inceleme_kayit_tarihi));?></td>
                       
                    
                      <td style="vertical-align:middle !important">
                           <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('dokuman_inceleme/delete/').$dokuman->dokuman_id.'/'.$inceleme->inceleme_id?>');" class="btn btn-dark btn-xs"><i class="fa fa-times text-danger" style="font-size:12px" aria-hidden="true"></i> İnceleme Bilgisini Sil</a>
                      </td>
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                 
                     <th>İşlem Detayı</th>
                    <th style="width: 130px;">İnceleme Tarihi</th>
                   
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
      </div>
      <!-- /.card-body --> 
     
  </div>
  <!-- /.card -->   















       
  </section>





  <section class="content col-md-12 <?php if(count($revizyonlar) == 0) {echo "d-none";}?>">
 <div class="card card-dark" >
      <div class="card-header with-border">
        <h3 class="card-title"> Geçerli Belge (SON REVİZYON)</h3>
      </div>
      <div class="card-body p-0">
      <embed src="<?=base_url("uploads/").$revizyonlar[count($revizyonlar)-1]->revizyon_dosya_adi?>" style="width:100%;height:850px;object-fit: contain;"  />
      </div>
</div>

              </section>



<?php  endif; ?>


  </div>
</div>