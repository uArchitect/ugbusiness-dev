 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:0px">
  <?php 
  if($kullanici_data){
    $this->load->view("kullanici/profil/kullanici_top_bar"); 
  }
  ?>

<section class="content text-md p-3">



  <form action="<?=base_url("talep/yonlendirmeler")?>" method="post"><div class="row" style="display: flex;">
<div class="col">
          <div class="form-group">
            <label for="formClient-Name">Yönlendiren Kullanıcı</label>
            <div class="input-group">
            
              <select class="select2" name="yonlendiren_kullanici_id" class="form-control rounded-2" style="width: 100%;border: 1px solid #ced4da;">
              <option data-icon="fa fa-times"  value="">Kullanıcı Seçilmedi</option>
      
        <?php foreach($tum_kullanicilar_yonlendiren as $d_kullanici) : ?> 

                    <option data-icon="fa fa-user" value="<?=$d_kullanici->kullanici_id?>" <?php echo  (!empty($yonlendiren_kullanici_id) && $yonlendiren_kullanici_id == $d_kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=($d_kullanici->kullanici_ad_soyad == "Ergül Kızılkaya" ? "Admin" : $d_kullanici->kullanici_ad_soyad) ?></option>
      
          <?php endforeach; ?>  
                  </select>   
            </div>
          </div>
        </div>


        <div class="col">
          <div class="form-group">
            <label for="formClient-Name">Yönlendirilen Kullanıcı</label>
            <div class="input-group">
            
              <select class="select2" name="yonlenen_kullanici_id" class="form-control rounded-2" style="width: 100%;border: 1px solid #ced4da;">
              <option data-icon="fa fa-times"  value="">Kullanıcı Seçilmedi</option>
      
        <?php foreach($tum_kullanicilar_yonlenen as $d_kullanici) : ?> 

          <option data-icon="fa fa-user" value="<?=$d_kullanici->kullanici_id?>" <?php echo  (!empty($yonlenen_kullanici_id) && $yonlenen_kullanici_id == $d_kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$d_kullanici->kullanici_ad_soyad?></option>
      
          <?php endforeach; ?>  
                  </select>   
            </div>
          </div>
        </div>






        <div class="col">
          <div class="form-group">
            <label for="formClient-Name">Yönlendirme Başl. Tarihi</label>
            <div class="input-group">
            
           
            <input type="date" class="form-control" name="baslangic_tarihi" value="<?=(isset($baslangic_tarihi)) ? date("Y-m-d",strtotime($baslangic_tarihi)) : ""?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">

            </div>
          </div>
        </div>



        <div class="col">
          <div class="form-group">
            <label for="formClient-Name">Yönlendirme Bit. Tarihi</label>
            <div class="input-group">
            
            <input type="date" class="form-control" name="bitis_tarihi" value="<?=(isset($bitis_tarihi)) ? date("Y-m-d",strtotime($bitis_tarihi)) : ""?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
 
            </div>
          </div>
        </div>



        <div class="col">
          <div class="form-group">
            <label for="formClient-Name">Talep Durumu</label>
            <div class="input-group">
            
              <select class="select2" name="talep_durum" class="form-control rounded-2" style="width: 100%;border: 1px solid #ced4da;">
              <option data-icon="fa fa-times"  value="">Seçim Yapılmadı</option>
      
        
          <option value="1" <?php echo  (!empty($talep_durum) && $talep_durum == 1) ? 'selected="selected"'  : '';?>>Beklemede</option>
          <option value="2" <?php echo  (!empty($talep_durum) && $talep_durum == 2) ? 'selected="selected"'  : '';?>>Satış</option>
          <option value="3" <?php echo  (!empty($talep_durum) && $talep_durum == 3) ? 'selected="selected"'  : '';?>>Bilgi Verildi</option>
          <option value="4" <?php echo  (!empty($talep_durum) && $talep_durum == 4) ? 'selected="selected"'  : '';?>>Müşteri Memnuniyeti</option>
          <option value="5" <?php echo  (!empty($talep_durum) && $talep_durum == 5) ? 'selected="selected"'  : '';?>>Dönüş Yapılacak</option>
          <option value="6" <?php echo  (!empty($talep_durum) && $talep_durum == 6) ? 'selected="selected"'  : '';?>>Olumsuz</option>
          <option value="7" <?php echo  (!empty($talep_durum) && $talep_durum == 7) ? 'selected="selected"'  : '';?>>Numara Hatalı</option>
          <option value="8" <?php echo  (!empty($talep_durum) && $talep_durum == 8) ? 'selected="selected"'  : '';?>>Ulaşılamadı / Tekrar Aranacak</option>
      
          
                  </select>   
            </div>
          </div>
        </div>




        <div class="col">
          <div class="form-group">
            <label for="formClient-Name">Şehir</label>
            <div class="input-group">
            
              <select class="select2" name="sehir_no" class="form-control rounded-2" style="width: 100%;border: 1px solid #ced4da;">
              <option data-icon="fa fa-times"  value="">Seçim Yapılmadı</option>
      
                <?php 
                $sehirler = get_sehirler_salt();
                foreach ($sehirler as $sehir) {
                 ?>
                 <option value="<?=$sehir->sehir_id?>" <?php echo  (!empty($secilen_sehir) && $secilen_sehir == $sehir->sehir_id) ? 'selected="selected"'  : '';?>><?=$sehir->sehir_adi?></option>
      
                 <?php   
                }
                ?>        
              </select>   
            </div>
          </div>
        </div>




        <div class="col">
          <div class="form-group">
            <label for="formClient-Name">Reklam Filtresi</label>
            <div class="input-group">
            
              <select class="select2" name="reklam_mi" class="form-control rounded-2" style="width: 100%;border: 1px solid #ced4da;">
              <option data-icon="fa fa-times"  value="">Seçim Yapılmadı</option>
      
              <option value="1" <?php echo  (!empty($secilen_reklam) && $secilen_reklam == 1) ? 'selected="selected"'  : '';?>>REKLAM TALEPLERİ</option>
              
              </select>   
            </div>
          </div>
        </div>




        <button type="submit" class="btn btn-success" style="height: 40px; margin-top: 30px; padding: 20px; padding-top: 10px;">Filtrele</button>
      </div>  </form>







<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Talep Yönetimi</h3>
                <a href="<?=base_url("talep/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="zoom: 0.9;">
                <table id="example1yonlendirilentablo" style="    display: inline-table;" class="table text-xs table-bordered table-responsive table-striped nowrap">
                  <thead>
                  <tr>
                    <th>Talep Durum</th> 
                    <th>Bilgi</th> 
                    <th>Müşteri Adı Soyadı</th> 
                    <th>Merkez</th> 
                    <th>İletişim Numarası</th>
                    <th>Cihaz</th>
                    <th>Yönlendiren Kullanıcı</th>
                    <th>Yönlendirilen Kullanıcı</th>
                    <th style="width: 130px;">Yönlendirme Tarihi</th>
                    <th style="width: 130px;">Şehir</th>
                    <th style="width: 42px;">Görüşme Detay</th>  
                  
                
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($talepler as $talep) : ?>
                      <?php 
                        if(!empty($secilen_sehir) && $secilen_sehir != $talep->talep_sehir_no ){continue;}
                        if(!empty($secilen_reklam) && $talep->talep_reklamlardan_gelen_mi != 1 ){continue;}

                       
                        $count++?>   
                      
                    <tr>
                      <td style="display:grid;"><button type="button" class="btn btn-xs bg-<?=$talep->talep_sonuc_renk?>" style="font-size: 11px !important;width: -webkit-fill-available;">
                        <i class="<?=$talep->talep_sonuc_ikon
                      ?>"></i> <?=$talep->talep_sonuc_adi?></button>
                      </td><td>
                      <?php 
                      $durum = "";
                      if($talep->eski_gorusme_sonuc_no != 0){

                        switch ($talep->eski_gorusme_sonuc_no) {
                          case '1':
                            $durum = "Beklemede";
                            break;
                          case '2':
                            $durum = "Satış";
                            break;
                          case '3':
                            $durum = "Bilgi Verildi";
                            break;
                          case '4':
                            $durum = "Müşteri Memnuniyeti";
                            break;
                          case '5':
                            $durum = "Dönüş Yapılacak";
                            break;
                          case '6':
                            $durum = "Olumsuz";
                            break;
                          case '7':
                            $durum = "Numara Hatalı";
                            break;
                          case '8':
                            $durum = "Ulaşılmadı / Tekrar Aranacak";
                            break;
                          default:
                            $durum = "";
                            break;
                        }
                        ?>
                        <span class="<?=($talep->eski_gorusme_sonuc_no != 0) ? "text-danger" : ""?>" style="font-size:13px;opacity:1;"><i class="far fa-arrow-alt-circle-left"></i>  <?=($talep->eski_gorusme_sonuc_no != 0) ? "Önceki : ".$durum  : ""?></span>
                      <?php }
                        
                      
                      ?>
                      
                    
                    </td> 
                      <td>
                        <i class="fa fa-user" style="font-size:13px"></i> <?=$talep->talep_musteri_ad_soyad?> <span class="<?=($talep->marka_id != 1) ? "text-success" : ""?>" style="font-size:13px;opacity:0.6;">(<i class="far fa-question-circle"></i> Mevcut Cihaz : <?=($talep->marka_id != 2) ? $talep->marka_adi : $talep->talep_kullanilan_cihaz_aciklama?>)</span>
                      
   
                  </td>
                  <td>
                       <?=($talep->talep_isletme_adi == "" || $talep->talep_isletme_adi == "#NULL#") ? "<span style='opacity:0.5'>Girilmedi</span>" :$talep->talep_isletme_adi." (".$talep->sehir_adi.")" ?>
                      
   
                  </td>
                  
                      <td >
                        <i class="fa fa-mobile-alt"></i>
                        <?php
                        if($talep->talep_yurtdisi_telefon != ""){
                          echo $talep->talep_yurtdisi_telefon;
                        }else{
                          ?>
                           <a href="<?=base_url("anasayfa/talep_profil?telefon=$talep->talep_cep_telefon")?>"><?=formatTelephoneNumber($talep->talep_cep_telefon)?></a>
                          <?php
                        }
                        ?>
                        
                       
                        
                      
                      </td>
                    
                    
                      <td><?=$talep->urun_adlari?></td>
                      <td><i class="fas fa-arrow-circle-right text-orange"></i> <?=($talep->yonlendiren_ad_soyad == "Ergül Kızılkaya" ? "Admin" : $talep->yonlendiren_ad_soyad)?></td>
                      <td>
                    <?php
                      if($talep->aktarma_notu != "" && $talep->aktarma_notu != null){
                        echo "<span style='color:red'>".$talep->aktarma_notu."</span>";
                      }
                    else if($talep->yonlendiren_ad_soyad == $talep->yonlenen_ad_soyad){
                      ?>
                      <a type="button" class="btn btn-success btn-xs"><i class="fa fa-user-circle" style="font-size:12px" aria-hidden="true"></i> Kullanıcı Girişi</a>
                      <?php
                    }else{
                      echo "<a target='_blank' href='".base_url("kullanici/profil_new/$talep->yonlenen_kullanici_id")."?subpage=ozluk-dosyasi'>".$talep->yonlenen_ad_soyad."</a>";
                    
                    }
                    
                    ?>
                    
                    </td>

                      <td><?=date('d.m.Y',strtotime($talep->yonlendirme_tarihi));?></td>
                  
                    
                      <td>
<?=$talep->sehir_adi?>
                           
                        </td>   

                        <td  >
                          <?php 
                          if(($talep->gorusme_detay == "")){
                         
                            ?>
                             <button disabled style="width: -webkit-fill-available;opacity:0.5;" class="btn btn-default" >
                               X
                              </button>
                            <?php
                          }else{
?>
 <button style="width: -webkit-fill-available;" class="btn btn-default showAlertButton custombutton" data-message="<?=$talep->gorusme_detay?>">
 <i class="fas fa-comment-dots"></i> Detay
 </button>
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













<style>
  .custombutton.clicked {
    background-color: #ebf377;
}
  </style>



 

            
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
 var buttons = document.querySelectorAll(".custombutton");

buttons.forEach(function(button) {
    button.addEventListener("click", function() {
        this.classList.toggle("clicked");
    });
});

var buttons = document.getElementsByClassName('showAlertButton');

 
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
      
        var message = this.getAttribute('data-message');
       
        if (message.trim() !== '') {
          Swal.fire({
                title: "Görüşme Detayı",
                html: message,
                
                icon:"info",
              
                showCancelButton: false,
                showConfirmButton: true
              });
        } else {
            swal("Hata", "Lütfen bir metin girin!", "error");
        }
    });
}
  </script>