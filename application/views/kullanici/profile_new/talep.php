 

<div class="header" style="margin: 13px;">
                <h2 style="font-size: 1.3rem;margin-bottom:-2px">Satış Bilgileri</h2>
                <p>Kullanıcıya tanımlı olan satış/sipariş bilgileri aşağıda listelenmiştir.Detayları görüntülemek için sipariş koduna tıklayabilirsiniz. </p>


                <select class="select2" name="talep_durum" class="form-control rounded-2" style="width: 100%;border: 1px solid #ced4da;" onchange="submitFilter()">
    <option data-icon="fa fa-times" value="">Seçim Yapılmadı</option>
    <option value="1" <?php echo (!empty($talep_durum) && $talep_durum == 1) ? 'selected="selected"' : '';?>>Beklemede</option>
    <option value="2" <?php echo (!empty($talep_durum) && $talep_durum == 2) ? 'selected="selected"' : '';?>>Satış</option>
    <option value="3" <?php echo (!empty($talep_durum) && $talep_durum == 3) ? 'selected="selected"' : '';?>>Bilgi Verildi</option>
    <option value="4" <?php echo (!empty($talep_durum) && $talep_durum == 4) ? 'selected="selected"' : '';?>>Müşteri Memnuniyeti</option>
    <option value="5" <?php echo (!empty($talep_durum) && $talep_durum == 5) ? 'selected="selected"' : '';?>>Dönüş Yapılacak</option>
    <option value="6" <?php echo (!empty($talep_durum) && $talep_durum == 6) ? 'selected="selected"' : '';?>>Olumsuz</option>
    <option value="7" <?php echo (!empty($talep_durum) && $talep_durum == 7) ? 'selected="selected"' : '';?>>Numara Hatalı</option>
    <option value="8" <?php echo (!empty($talep_durum) && $talep_durum == 8) ? 'selected="selected"' : '';?>>Ulaşılamadı / Tekrar Aranacak</option>
</select>

<script>
    function submitFilter() {
        var selectedValue = document.querySelector('select[name="talep_durum"]').value;
        var currentUrl = window.location.href.split('?') ; // Mevcut URL'yi al
        var newUrl = currentUrl[0] + "/" + currentUrl[1] + '&subfilter=' + selectedValue; // subfilter parametresi ile yeni URL oluştur
        window.location.href = newUrl; // Sayfayı yeni URL ile yükle
    }
</script>
  




            </div>
            <table id="example1muhasebe" style="    display: inline-table;" class="table text-xs table-bordered table-responsive table-striped nowrap">
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
                        <?=formatTelephoneNumber($talep->talep_cep_telefon)?>
                        
                      
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
                      echo $talep->yonlenen_ad_soyad;
                    
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