 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 









<section class="content">

      <!-- Default box -->
      <div class="card card-dark">
      <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Sistem Kullanıcıları</h3>
                <a href="<?=base_url("kullanici/ekle")?>" type="button" class="btn btn-success btn-xs" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
        <div class="card-body pb-0">
          <div class="row">
            
          
          
          <?php $count=0; foreach ($kullanicilar as $kullanici) : ?>
                      <?php $count++?>
          
          
          
          
          
          
          
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card d-flex flex-fill" style="border-radius:0">
                <div class="card-header text-muted border-bottom-0">
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                  <div class="col-5 text-center">
                      <img src="<?=base_url("uploads/$kullanici->kullanici_resim")?>" style="object-fit:cover;max-width:150px;max-height:150px;min-width:150px;min-height:150px;border: 5px solid #272829c7;outline: 5px solid #393c3721;" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                    <div class="col-7">
                      <h2 style="font-size:22px" ><b><?=$kullanici->kullanici_ad_soyad?></b></h2>
                      <p class="text-muted text-sm" style="margin-top:-5px"><i class="fas fa-info-circle" style="opacity:0.5"></i>
                       <?=$kullanici->kullanici_unvan ? $kullanici->kullanici_unvan." / " : ""?> <?=$kullanici->departman_adi?> Departmanı 
                    </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class=" mb-1"><span class="fa-li"><i class="fas fa-envelope"></i></span> Email: <?=$kullanici->kullanici_email_adresi ?? "<span style='opacity:0.5'>Email Adresi Belirtilmedi</span>"?></li>
                        <li class=" mb-1"><span class="fa-li"><i class="fas  fa-phone"></i></span> İletişim No :  <?php echo $kullanici->kullanici_bireysel_iletisim_no != "" ? $kullanici->kullanici_bireysel_iletisim_no : "<span style='opacity:0.5'>İletişim No Belirtilmedi</span>"?></li>
                        <li class=""><span class="fa-li"><i class="fa  fa-phone-square"></i></span> Dahili No :  <?php echo $kullanici->kullanici_dahili_iletisim_no != "" ? $kullanici->kullanici_dahili_iletisim_no : "<span style='opacity:0.5'>Dahili No Belirtilmedi</span>"?></li>
                      </ul>
                    </div>
                  
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-center">
                  <a href="mailto:<?=$kullanici->kullanici_email_adresi?>" class="col-md-4 btn btn-sm bg-warning">
                      <i class="fas fa-envelope"></i> Email
                    </a> 
                    <a href="https://wa.me/+9<?=str_replace(" ","",$kullanici->kullanici_bireysel_iletisim_no)?>" target="_blank" class="col-md-3 btn btn-sm bg-dark" style="background:#14b34f !important;">
                      <i class="fas fa-comments"></i> Whatsapp
                    </a>
                    <a href="<?=base_url("kullanici/duzenle/$kullanici->kullanici_id")?>" class="col-md-4 btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> Detaylı Görünüm
                    </a>
                  </div>
                </div>
              </div>
            </div>





            <?php  endforeach; ?>
            
          </div>
        </div>
        <!-- /.card-body -->
    
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->











 
            </div>