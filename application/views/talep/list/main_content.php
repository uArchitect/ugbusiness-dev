
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">



<div class="row">
  
          <div class="col pb-0 p-0">
            <!-- small box -->
            <div class="small-box bg-warning mb-2">
              <div class="inner">
                <h3>

             <?=count($talepler)?>

                </h3>

                <p>Bekleyen Talepler (Havuz)</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-alert"></i>
              </div>
              <a href="?filter=1" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col col-xs-12 pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-dark mb-2">
              <div class="inner">
                <h3>
             
                <?=$devam_eden_toplam?>

                </h3>

                <p>Devam Eden Talepler</p>
              </div>
              <div class="icon">
                <i class="ion ion-load-d"></i>
              </div>
              <a href="?filter=2" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
       
       



       
          <!-- ./col -->
          <div class="col pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-success mb-2">
              <div class="inner">
                <h3>
                <?=$tamamlanan_toplam?>
                </h3>

                <p>Tamamlanan Talepler</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="?filter=4" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->






        </div>
        <!-- /.row -->











        <div style="margin:5px;padding:5px;background: #ffe2e2;color: #ab0000;margin-top: 0px;margin-bottom: 5px;border: 2px solid #ff00007d;border-radius: 5px;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f50000;
"></i> 
<b>İSTANBUL BÖLGESİ (ÖZKAN ŞENOL)</b>
Afyonkarahisar, Aydın, Balıkesir, Bilecik, Bursa, Çanakkale, Denizli, Edirne, İstanbul, İzmir, Kırklareli, Kocaeli, Kütahya, Manisa, Muğla, Sakarya, Tekirdağ, Uşak, Yalova</span>
 </div>



 <div style="margin:5px;padding:5px;background: #2196f33d;color: #001aa1;margin-top: 0px;margin-bottom: 5px;border: 2px solid #3F51B5;border-radius: 5px;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #2196F3;
"></i> 
<b>GÜNEYDOĞU ANADOLU BÖLGE (SERTAÇ BAYBURE)</b>
Adıyaman, Batman, Diyarbakır, Gaziantep, Kilis, Mardin, Siirt, Şanlıurfa, Şırnak</span>
 </div>





<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Talep Yönetimi</h3>
                <a href="<?=base_url("talep/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">Talep Kodu</th> 
                    <th>Müşteri Adı Soyadı</th>
                    <th>İletişim Numarası</th>
                    <th>Sabit / Yurtdışı Numara</th>
      
                    <th>Talep Kaynağı</th>
                    <th>Cihaz</th>
                  
                    <th style="width: 130px;">Kayıt Tarihi</th>
                
                    <th style="width: 240px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($talepler as $talep) : ?>
                      <?php $count++?>
                    <tr style="<?=(!empty($tekrar_kontrol) && controlTekrarlayanTalep($talep->talep_cep_telefon)) ? 'background:#fff1f1':'' ?>" >
                      <td>T0000<?=$talep->talep_id?>  </td> 
                      <td><i class="fa fa-user" style="<?=(!empty($tekrar_kontrol) && controlTekrarlayanTalep($talep->talep_cep_telefon)) ? 'color:red;':'' ?> font-size:13px"></i> <?=$talep->talep_musteri_ad_soyad?></td>
                      <td >
                        <i class="fa fa-mobile-alt"></i>
                        <?php
                          // Telefon numarasını temizle (sadece rakamlar)
                          $clean_phone = preg_replace('/[^0-9]/', '', $talep->talep_cep_telefon);
                          // Sadece 0'lardan oluşuyor mu kontrol et
                          $is_only_zeros = (trim($clean_phone) === '' || preg_match('/^0+$/', $clean_phone));
                          
                          // Eğer sadece 0'lardan oluşuyorsa ve yurtdışı telefon varsa onu göster
                          if($is_only_zeros && !empty($talep->talep_yurtdisi_telefon)) {
                            echo $talep->talep_yurtdisi_telefon;
                          } else {
                            echo formatTelephoneNumber($talep->talep_cep_telefon);
                          }
                        ?>
                        <?php 
                          if((!empty($tekrar_kontrol)) && (controlTekrarlayanTalep($talep->talep_cep_telefon))){
                            ?>
                             <i class="ion ion-android-alert text-danger"></i> <span class=" text-danger" style="font-size: smaller;font-weight: 500;font-style: italic;">Tekrar</span>
                            <?php
                          }
                        ?>
                      
                      </td>
                      <td>
                        <?=$talep->talep_sabit_telefon != "" ? $talep->talep_sabit_telefon :"<span style='opacity:0.5'>Sabit Telefon Girilmedi</span>"?>
                    
                        
                    </td>
                       <td><i class="<?=$talep->talep_kaynak_resim?>"></i> <?=$talep->talep_kaynak_adi?></td>
                      <td><?=$talep->urun_adlari?></td>

                     
                      <td><?=date('d.m.Y H:i',strtotime($talep->talep_kayit_tarihi));?></td>
                  
                    
                      <td>

                        

                      <?php

                          if($talep->talep_yonlendirildi_mi){
                            ?>




<button type="button" class="btn btn-xs btn-default" data-toggle="dropdown" aria-expanded="false">
                          <span ><i class="fa fa-check"></i> Yönlendirildi</span>
                        </button>


                            <?php
                          }
                          else{


                            ?>

<div class="btn-group">
                       <button type="button" class="btn btn-xs btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                          <span style="margin-right:8px"><i class="fa fa-arrow-circle-right"></i> Yönlendir </span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="left: -141px !important;">
                          
                        <?php 
                          foreach ($kullanicilar as $kullanici) {
                            $url = base_url("talep/yonlendir/$talep->talep_id/$kullanici->kullanici_id");
                            $kulid = 0;
                            switch ($talep->talep_sehir_no) {
                              case '3':
                              case '11':
                              case '12':
                              case '16':  
                              case '21':
                              case '22':
                              case '25':  
                              case '28':
                              case '40':
                              case '41':  
                              case '49':
                              case '52':
                              case '54':                                 
                              case '56':
                              case '59':
                              case '66':  
                              case '73':
                              case '77':
                              case '79':                               
                                $kulid = 60; 
                                break;

                              case '2':
                              case '14':
                              case '26':                                 
                              case '33':
                              case '51':
                              case '57':  
                              case '68':
                              case '71':
                              case '72':                               
                                  $kulid = 19; 
                                  break;

                              default:
                                break;
                            }

                            ?>
                          
 



                          <a class="dropdown-item <?=($kulid == $kullanici->kullanici_id)?"yanipsonenyazi":""?>"  style="cursor:pointer"  onclick="confirm_talep_redirect('Yönlendir / <?=$kullanici->kullanici_ad_soyad?>','Seçilen bu talebi [<?=$kullanici->kullanici_ad_soyad?>] adlı kullanıcıya yönlendirmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Yönlendir','<?= $url ?>');">
                            <b><i class="fa fa-user-circle"></i> <?=$kullanici->kullanici_ad_soyad?> - </b><span style="font-size:13px"><?=$kullanici->kullanici_unvan?></span>
                          </a>

                            <?php
                          }
                        
                        ?>
                         
                         
                          
                        </div>
                      </div>



                            <?php
                          }
                    ?>

                     













                          <a href="<?=site_url("talep/duzenle/$talep->talep_id")?>" onsubmit="waiting('Talep Bilgilerini Düzenle');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('talep/delete/'.$talep->talep_id)?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                          
                        </td>   
                    </tr>

                  

                    
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">Talep Kodu</th> 
                    <th>Müşteri Adı Soyadı</th>
                    <th>İletişim Numarası</th>
                    <th>Sabit / Yurtdışı Numara</th>
      
                    <th>Talep Kaynağı</th>
                    <th>Cihaz</th>
                    <th style="width: 130px;">Kayıt Tarihi</th>
                    <th style="width: 130px;">İşlem</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>












            

            <style> 


.yanipsonenyazi {
      animation: blinker 1.2s linear infinite;
      color: red;
    
      font-weight: bold; 
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }


  </style>