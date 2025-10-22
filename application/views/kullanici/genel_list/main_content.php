 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Sistem Kullanıcıları</h3>
                <a href="<?=base_url("kullanici/ekle")?>" type="button" class="btn btn-success btn-xs" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1yonlendirilentablo" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
               
                    <th>Ad Soyad</th> 
                    <th style="width: 130px;">Departman</th>
                    <th>İletişim Numarası</th>
                    <th>Mesai Başlama Saati</th>
                    <th style="width: 100px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($kullanicilar as $kullanici) : ?>
                      <?php $count++?>
                    <tr>
                  
                      <td>
                        <?php
                          if($kullanici->kullanici_resim != ""){
                                ?>
                                   <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                                <?php
                          }else{
                            ?>
                                 <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> 
                              
                            <?php
                          }
                        ?>
                      
                      
                      
                      <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=$kullanici->kullanici_ad_soyad?></a></b>   
                    </td>
                      
                         <td><i class="fa fa-building" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->departman_adi?></td>
                      <td><i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?></td>
                      <td><i class="fa fa-envelope" style="margin-right:5px;opacity:0.8"></i> <?=date("H:i",strtotime($kullanici->mesai_baslangic_saati))?></td>
                   
                      
                      <td>
                     
                     
                        
                          <a href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                       
                        
                       
                       <?php
                          if($kullanici->kullanici_id != 1){
?>
<a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('kullanici/sil/').$kullanici->kullanici_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
<?php
                          }else{
                            ?>
                            <a type="button" style="opacity:0.2" class="btn disabled btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                                                    
                            <?php
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