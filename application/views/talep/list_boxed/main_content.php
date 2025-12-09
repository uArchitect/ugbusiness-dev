<?php 
// Tüm Taleplerim sayfası için özel görünüm (filter == 999 veya "999")
if(isset($filter) && ($filter == 999 || $filter == "999")): 
  $this->load->view('talep/includes/styles');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis" id="content-wrapper">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-list-alt card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Tüm Taleplerim Restore
                  </h3>
                  <small class="card-header-subtitle">Talep yönetim modülleri</small>
                </div>
              </div>
              <a href="<?=base_url("talep/ekle")?>" type="button" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Yeni Kayıt Ekle
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('talep/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <div class="table-responsive" id="talep-tablo-container">
                <table id="talep-tablo" class="table table-bordered table-striped" style="font-size: small;">
                  <thead>
                  <tr>
                    <th style="width:130px">Sonuç</th>   
                    <th>Müşteri Adı Soyadı</th>
                    <th style="width:120px">İletişim Numarası</th>
                    <th style="width:120px">Şehir / Ülke</th>
                    <th style="width:120px">Yönlendirme Tarihi</th>
                    <th>Görüşme Detay</th> 
                    <th style="width:230px">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($talepler as $talep) : ?>
                      <?php
                      $count++;
                      ?>
                    <tr>
                      <td>  
                        <button type="button" class="btn btn-xs bg-<?=$talep->talep_sonuc_renk?>" style="width: -webkit-fill-available;">
                          <i class="<?=$talep->talep_sonuc_ikon?>"></i> <?=$talep->talep_sonuc_adi?>
                        </button>
                      </td>
                      <td>
                        <i class="fa fa-user" style="font-size:13px"></i> <b><?=$talep->talep_musteri_ad_soyad?></b> (<?=$talep->urun_adlari?>)
                        <div class="text-danger mb-2 <?=($talep->talep_uyari_notu == null || $talep->talep_uyari_notu == "")?"d-none":""?>">
                          <?=$talep->talep_uyari_notu?>
                        </div>
                      </td>
                      <td>
                        <?php 
                        if($talep->kullaniciya_aktarildi == 1){
                          echo "05** *** ** **";
                        }else{
                        ?>
                          <i class="fa fa-mobile-alt" style="font-size:13px"></i>  
                          <?=($talep->talep_yurtdisi_telefon) ? $talep->talep_yurtdisi_telefon : formatTelephoneNumber($talep->talep_cep_telefon)?>
                          <span style="display:none"><?=$talep->talep_cep_telefon?></span>
                        <?php
                        }
                        ?>
                      </td>
                      <td style="<?=($talep->talep_ulke_id == 190)?"":"background:#fdfba7"?>">
                        <?php 
                        if($talep->talep_ulke_id == 190){
                          echo $talep->sehir_adi;
                        }else{
                          echo strtoupper($talep->ulke_adi);
                        }
                        ?>
                      </td>
                      <td style="opacity:0.7"><?=date('d.m.Y H:i',strtotime($talep->yonlendirme_tarihi));?></td>
                      <td style="font-size: small;"><?=$talep->gorusme_detay?></td>
                      <td>
                        <div class="btn-group <?=($talep->gorusme_sonuc_no == 2) ? "d-none":""?> <?=($talep->yonlendiren_kullanici_id == 60) ? "d-none":""?> <?=(aktif_kullanici()->kullanici_id != 60) ? "d-none":""?>">
                          <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-user-circle"></i> Yönlendir</button>
                          <button type="button" class="btn btn-xs btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu" style="left: -141px !important;">
                            <?php 
                            foreach ($kullanicilar as $kullanici) {
                              if($kullanici->kullanici_departman_id == 17 && $kullanici->kullanici_aktif == 1){
                                $url = base_url("talep/yonlendir/$talep->talep_id/$kullanici->kullanici_id");
                            ?>
                            <a class="dropdown-item" onclick="confirm_talep_redirect('Yönlendir / <?=$kullanici->kullanici_ad_soyad?>','Seçilen bu talebi [<?=$kullanici->kullanici_ad_soyad?>] adlı kullanıcıya yönlendirmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Yönlendir','<?= $url ?>');">
                              <b><i class="fa fa-user-circle"></i> <?=$kullanici->kullanici_ad_soyad?> - </b><span style="font-size:13px"><?=$kullanici->kullanici_unvan?></span>
                            </a>
                            <?php
                              } 
                            }
                            ?>
                          </div>
                        </div>
                        <?php 
                        if($talep->kullaniciya_aktarildi == 1){
                          echo "AKTARILDI";
                        }else if($talep->gorusme_sonuc_no != 0){
                        ?>
                          <a href="<?=base_url("talep/yonlendirme-duzenle/$talep->talep_yonlendirme_id")?>" type="button" class="btn btn-danger btn-xs">
                            <i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Talep Düzenle
                          </a>
                        <?php
                        }else{
                          echo "Talep Sonlandırıldı.";
                        }
                        ?>
                      </td>   
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
$(document).ready(function() {
    if ($.fn.DataTable) {
        var table = $("#talep-tablo").DataTable({
            "ordering": false,
            "pageLength": 20,
            "responsive": true,
            "autoWidth": false,
            "scrollX": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
            }
        });

        $('#talep-tablo_filter input').keyup(function () {
            table
                .search(
                    jQuery.fn.DataTable.ext.type.search.string(this.value)
                )
                .draw();
        });
    }
});
</script>

<?php else: ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="content-wrapper" style="background:white;background-size: cover;">


<div class="row p-0  d-lg-none d-xl-none" >


<div class="col-12 mt-1" style="margin-left:-2px;">
        <ol class="breadcrumb float-sm-right mb-0 pl-2" style="width: -webkit-fill-available;border:1px solid lightgray;margin-right:-3px">
          <li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?=base_url()?>">Anasayfa</a></li>
          <li class="breadcrumb-item">Talepler</li>
          <li class="breadcrumb-item active">Bekleyen Talepler ( <?=count($talepler)?> )</li>
        </ol>
      </div>


<!-- /.col -->
<div class="col-12 p-1">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user   mt-0" style="margin-bottom: 0px;margin-right:2px;">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white"
                   style="border-radius:5px;background: url('<?=base_url("assets")?>/dist/img/banner-umex.png') center center; background-size: cover;">
                <h3 class="widget-user-username text-right"><?=aktif_kullanici()->kullanici_ad_soyad?></h3>
                <h5 class="widget-user-desc text-right"><?=aktif_kullanici()->kullanici_unvan?></h5>
              </div>
              <div class="widget-user-image" style="top:10px; left:0; margin-left:16px;">
                <img class="img-circle" src="<?=base_url("uploads/".aktif_kullanici()->kullanici_resim)?>" style="object-fit:cover;width:70px;height:70px" alt="User Avatar">
              </div>
               
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->

</div>
  



<div class="row mt-0 pt-0  ">
 



<div class="timeline pl-1 pt-1 " style="    width: 100%;">
 


<?php
        $count=0;
      
          
        foreach ($talepler as $talep) {
          if($filter != "" && $talep->gorusme_sonuc_no != $filter ){continue;} 
 
            $count++;
            
            ?>


<div style="margin-bottom: 10px;" class="  d-none">
<i class="fas fa-envelope bg-blue"></i>
<div class="timeline-item" style="border: 1px solid;margin-right: -4px;">
<span class="time text-white"><i class="fas fa-calendar-alt"></i> <?=date("d.m.Y H:i",strtotime($talep->talep_kayit_tarihi))?></span>
<h3 class="timeline-header bg-dark text-dark" ><i class="fas fa-user-circle"></i> <b><?=$talep->talep_musteri_ad_soyad?></b></h3>
<div class="timeline-body p-2">
    


<div class="alert alert-danger alert-dismissible  mb-2 <?=($talep->talep_uyari_notu == null || $talep->talep_uyari_notu == "")?"d-none":""?>">
 
<h5><i class="icon fas fa-exclamation-triangle"></i> Talep Uyarı Notu!</h5>
    <?=$talep->talep_uyari_notu?>
</div>
<div class=" bg-default m-0" style="background: #343a4012;
    border-radius: 7px;
    padding: 13px;">
<b>İletişim :</b> 
<?=formatTelephoneNumber($talep->talep_cep_telefon??"")?>
<?=($talep->talep_sabit_telefon) ? " / ".formatTelephoneNumber($talep->talep_sabit_telefon??"") :""?>

<b class="ml-2">Cihaz:</b> <?=$talep->urun_adlari?>
</div>




</div>
<div class="timeline-footer d-flex pt-0">
<a href="tel:<?=$talep->talep_cep_telefon ?? $talep->talep_sabit_telefon?>" class="btn btn-warning text-dark btn-sm mr-1" style="flex: 1;"><i class="fa fa-phone"></i><br>Ara</a>
<a href="https://wa.me/9<?=$talep->talep_cep_telefon?>" class="btn btn-success btn-sm mr-1" style="flex: 2;"><i class="fab fa-whatsapp"></i><br>Whatsapp</a>
 

<a href="<?=base_url("talep/yonlendirme-duzenle/$talep->talep_yonlendirme_id")?>" class="btn btn-danger btn-sm" style="flex: 1;"><i class="fas fa-times"></i><br>Bitir</a>



</div>
</div>
</div>

 <?php
        
        }
                    ?>


<div class="col pl-0 d-none">

<?php 

if($count == 0){
  echo "<span class='d-lg-none d-xl-none' style='display: block;text-align:center;color:#000000'><b><br><br><i class='fas fa-exclamation-circle text-warning text-lg'></i> <br>Sistem Uyarısı</b><br> Sisteme tanımlanmış bekleyen müşteri talep kaydı bulunamamıştır.<br><br></span>";
}

?>

 

</div>

<div class=" p-2 mr-0 mb-0 pb-0 " style="padding-bottom: 0px !important;">





<div class="row">
  <?php 
  
  $talep_toplam = count(array_filter($talepler, function($talep) {
    return $talep->gorusme_sonuc_no == 1;
}));
  
  ?>
          <div class="col pb-0 p-0" >
            <!-- small box -->
            <div class="small-box bg-warning mb-2 <?=($talep_toplam > 0) ? "yanipsonenyazi":""?>">
              <div class="inner">
                <h3>
                 

                <?php
               
              echo $talep_toplam;
                ?>



                </h3>

                <p>Bekleyen Talepler</p>
              </div>
              <div class="icon">
                <i class="ion ion-clock"></i>
              </div>
              <a href="<?=base_url("bekleyen-talepler")?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        
          <!-- ./col -->
          <div class="col pb-0 p-0 ml-2">
            <!-- small box -->
            <div class="small-box bg-dark mb-2">
              <div class="inner">
                <h3>

                <?php
                $talep_toplam = count(array_filter($talepler, function($talep) {
                  return $talep->gorusme_sonuc_no == 8;
              }));
              echo $talep_toplam;
                ?>

                </h3>

                <p>Tekrar Aranacak</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?=base_url("tekrar-aranacak-talepler")?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
       
          <!-- ./col -->
          <div class="col pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-danger mb-2">
              <div class="inner">
                <h3>
               
                <?php
                $talep_toplam = count(array_filter($talepler, function($talep) {
                  return $talep->gorusme_sonuc_no == 6;
              }));
              echo $talep_toplam;
                ?>

                </h3>

                <p>Olumsuz Talepler</p>
              </div>
              <div class="icon">
                <i class="ion ion-close"></i>
              </div>
              <a href="<?=base_url("olumsuz-talepler")?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


       
          <!-- ./col -->
          <div class="col pb-0 pr-0 ">
            <!-- small box -->
            <div class="small-box bg-success mb-2">
              <div class="inner">
                <h3>
                  <?php
                  $talep_toplam = get_kullanici_toplam_satis($this->session->userdata('aktif_kullanici_id'));
                echo $talep_toplam;
                  ?>
                </h3>

                <p>Satış Yapılanlar</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?=base_url("tum-siparisler")?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->






        </div>
        <!-- /.row -->


        </div>









<div class="col ">


<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Talepler - Yönlendirmeler</h3>
                <a href="<?=base_url("talep/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table style="font-size: small;" id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
              
                    <th style="width:130px">Sonuç</th>   
                       <th >Müşteri Adı Soyadı</th>
              
                    <th style="width:120px">İletişim Numarası</th>
              
                 <th style="width:120px">Şehir / Ülke</th>
              
                    
               
                    <th style="width:120px">Yönlendirme Tarihi</th>
                    <th>Görüşme Detay</th> 
                    <th style="width:230px">İşlem</th> 
           
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0;    foreach ($talepler as $talep) : ?>
                      <?php
                       
                      if($filter != "" && $talep->gorusme_sonuc_no != $filter ){
                       if($filter != 999 && $filter != "999"){
                        continue;
                      
                       } 
                       
                      } 

                      $count++;
                      
                      
                      
                      ?>
                    <tr>
                     
                      <td>  
                      <button type="button" class="btn btn-xs bg-<?=$talep->talep_sonuc_renk?>" style="width: -webkit-fill-available;"><i class="<?=$talep->talep_sonuc_ikon
                      ?>"></i> <?=$talep->talep_sonuc_adi?></button>
                       
                    </td>
                     
                      <td><i class="fa fa-user" style="font-size:13px"></i> <b><?=$talep->talep_musteri_ad_soyad?></b> (<?=$talep->urun_adlari?>)
                    
                      
<div class="text-danger  mb-2 <?=($talep->talep_uyari_notu == null || $talep->talep_uyari_notu == "")?"d-none":""?>">
 
     <?=$talep->talep_uyari_notu?>
 </div>
                    
                    </td>
                      
                      <td>
                        
                      <?php 
                      
                      if($talep->kullaniciya_aktarildi == 1){
                        ?>
                        05** *** ** **                   
                       <?php
                      }else{
?>
 <i class="fa fa-mobile-alt " style="font-size:13px"></i>  
 
 <?=($talep->talep_yurtdisi_telefon) ? $talep->talep_yurtdisi_telefon : formatTelephoneNumber($talep->talep_cep_telefon)?>
                    <span style="display:none"><?=$talep->talep_cep_telefon?></span>
<?php
                      }
                      ?>

                     
                    
                    
                    </td>
                   
                <td style="<?=($talep->talep_ulke_id == 190)?"":"background:#fdfba7"?>">
                      <?php 
                      if($talep->talep_ulke_id == 190){
                        echo $talep->sehir_adi;
                      }else{
                        echo strtoupper($talep->ulke_adi);
                      }
                      ?>
                    </td>
                     
                      <td style="opacity:0.7"> <?=date('d.m.Y H:i',strtotime($talep->yonlendirme_tarihi));?></td>
                      <td style="font-size: small;"><?=$talep->gorusme_detay?></td>
                    
                      <td>



                      <div class="btn-group <?=($talep->gorusme_sonuc_no == 2) ? "d-none":""?> <?=($talep->yonlendiren_kullanici_id == 60) ? "d-none":""?> <?=(aktif_kullanici()->kullanici_id != 60) ? "d-none":""?>">
                        <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-user-circle"></i> Yönlendir</button>
                        <button type="button" class="btn btn-xs btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="left: -141px !important;">
                          
                        <?php 
                          foreach ($kullanicilar as $kullanici) {
                            if($kullanici->kullanici_departman_id == 17 && $kullanici->kullanici_aktif == 1){

                           
                            $url = base_url("talep/yonlendir/$talep->talep_id/$kullanici->kullanici_id");
                            ?>
                          
                          <a class="dropdown-item"  onclick="confirm_talep_redirect('Yönlendir / <?=$kullanici->kullanici_ad_soyad?>','Seçilen bu talebi [<?=$kullanici->kullanici_ad_soyad?>] adlı kullanıcıya yönlendirmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Yönlendir','<?= $url ?>');">
                            <b><i class="fa fa-user-circle"></i> <?=$kullanici->kullanici_ad_soyad?> - </b><span style="font-size:13px"><?=$kullanici->kullanici_unvan?></span>
                          </a>

                            <?php
                          } }
                        
                        ?>
                         
                         
                          
                        </div>
                      </div>
                     <?php 
                     

                     if($talep->kullaniciya_aktarildi == 1){
                      echo "AKTARILDI";
                     }else if($talep->gorusme_sonuc_no != 0){
                      ?>
                      
                      <a href="<?=base_url("talep/yonlendirme-duzenle/$talep->talep_yonlendirme_id")?>" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Talep Düzenle</a>
                      
                      <?php
                     }else{
                        echo "Talep Sonlandırıldı.";
                     }
                     
                     ?>
                        

                       
                      

                      
                      </td>   
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
</div>











</div>


<style>


.yanipsonenyazi {
      animation: blinker 0.9s linear infinite;
      color: #1c87c9;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }


  </style>

<?php endif; ?>