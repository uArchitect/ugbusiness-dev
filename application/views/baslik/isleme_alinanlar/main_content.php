
<style>

.form-control:disabled, .form-control[readonly] {
    background-color: #f9f9f9;
    opacity: 1;
}


  .select2-selection__choice {
    color: white!important;
    background: #1d7dfa!important;
    border: 1px solid white!important;
} .select2-selection__choice__remove {
    color: white!important; 
} .modal-header {
  padding: 2px 15px!important; 
  background: #100f0f!important;
    color: white!important;
    font-size: 20px!important;
}

.close, .mailbox-attachment-close {
    
    color: #fff; 
    opacity: 1;
}

.select2-selection__rendered {
    line-height: 25px !important;
}
.select2-container .select2-selection--single {
    height: 30px !important;
}
.select2-selection__arrow {
    height: 32px !important;
}

 
[class*=icheck-]>input:first-child+input[type=hidden]+label::before, [class*=icheck-]>input:first-child+label::before {
  width: 25px;
    height: 25px;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid #ddd;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;margin-top: -2px;
}
[class*=icheck-]>input:first-child:checked+input[type=hidden]+label::after, [class*=icheck-]>input:first-child:checked+label::after {
    content: "";
    display: inline-block;
    position: absolute;
    top: 0;
    left: 0;
    width: 10px;
    height: 17px; 
    border: 2px solid #fff;
    border-left: none;
    border-top: none;
    margin-top: -5px;
    transform: translate(7.75px,4.5px) rotate(45deg);
    -ms-transform: translate(7.75px,4.5px) rotate(45deg);
}

.custom-container{
  background: #e7e7e745;
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #c7c7c7;
}

@media (min-width: 768px) {
table{
  display:inline-table!important;
}
}




  </style>

<?php
function qrCode($s, $w = 250, $h = 250){
	$u = 'https://chart.googleapis.com/chart?chs=%dx%d&cht=qr&chl=%s';
	$url = sprintf($u, $w, $h, $s);
  	return $url;
}
$qr = qrCode('FZcEhMDim1iMNVz8m/3YuZr8vyu5EIP+tgResxd6fN0C6f92T+CsPiMRGnKvy7R9 ', 200, 200);  
?>
<img style="display:none;margin-left:260px;" src="<?=$qr?>">



 
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Yönetimi - İşleme Alınan Başlıklar</h3>
              </div>
               
              <div class="card-body p-1 pt-2">
               
               






              <div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3><?=$islemde_bekleyen_count?></h3>
<p>İşlemde Bekleyen Başlıklar</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="#" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3><?=$tamamlanan_count?></h3>
<p>Tamamlanan Başlıklar</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="#" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-dark">
<div class="inner">
<h3><?=$tum_basliklar_count?></h3>
<p>Tüm Başlıklar (Arıza)</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="#" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-danger">
<div class="inner">
<h3><?=$garanti_bitenler_count?></h3>
<p>Garanti Süresi Bitenler</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>
<a href="#" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

</div>












              <div style="margin:5px;padding:5px;background: #ffffe2; color: #ab6800; margin-top: 0px; margin-bottom: 5px; border: 2px solid #ffbc007d; border-radius: 5px;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f5a100;
"></i>  Bu ekranda müşterinin göndermiş olduğu başlıklardan işleme alınmış olanlar listelenmektedir. Arızası tamamlanmış başlıkları görüntülemek için <a href="">tıklayınız.</a></span>
 </div>

 <h3 class="card-title pl-2 pt-2 pr-2 pb-0">
 <i class="fas fa-qrcode"></i>
Başlık Seri No:
</h3>
              <div class="input-group input-group-sm p-2">
         
<input type="text" class="form-control" id="barcode" placeholder="Başlık'a tanımlanmış olan QR kodunu okutunuz veya giriniz...">
<span class="input-group-append">
<button type="button" class="btn btn-primary btn-flat">Kontrol Et & İşleme Al</button>
</span>
</div>
                <table id="example1islemealinanlar" class="table table-bordered table-striped table-responsive nowrap text-xs" style="max-width:100%;min-width:100%font-weight: 600;">
                  <thead>
                  <tr>
                    <th style="width: 85px;">ID</th> 
                    <th style="min-width: 160px;max-width: 160px;">İşlem</th> 
                    <th style="width: 160px;">Sipariş Durumu</th> 
                    <th style=" ">Müşteri / Merkez Bilgisi</th>
                    <th>Başlık / Cihaz Bilgileri</th> 
                    <th style="width: 90px;">Garanti Bilgileri</th>
                   
                    <th style="width: 130px;">Yeni Arıza</th> 
                 
                   
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php foreach ($basliklar as $urun) : ?>
                    <?php 
                      $bcolor="#e4ffe6";
                      $fcolor = "";
                      $rowbg = "";
                      if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) < date("Y-m-d")){
                        $bcolor = "#bd0606";
                        $fcolor = "#ffffff";
                        $rowbg = "#bd0606";
                      }else if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) == date("Y-m-d")){
                        $bcolor = "#fef7ea";
                        $fcolor = "#616161";
                        $rowbg = "#fef7ea";
                      }
                      ?>

                    <tr>
                      <td style="padding:0;width:42px;">
                      
                     
                      <div class="row p-0" style="    margin-top: -8px;">
                          <div class="col col-md-6 p-0 pr-1" style="height: 25px;  display: flex;">
                            <a type="button" style="border-color: #35a74c;padding-top:3px;font-size: 12px!important;flex:1" onclick="baslik_kontrol('<?=$urun->baslik_seri_no?>');" class="btn btn-default btn-xs"><i class="fas fa-folder-open text-success"  aria-hidden="true"></i> Detay</a>
                          </div>
                          <div class="col col-md-6 p-0 pr-1" style="height: 25px;  display: flex;">
                            <a type="button" style="    border-color: #1d7dfa;padding-top:3px;font-size: 12px!important;flex:1" href="<?=base_url("baslik/print_kargo/".$urun->urun_baslik_tanim_id)?>" class="btn btn-default btn-xs"><i class="fas fa-print text-primary"  aria-hidden="true"></i> Adres</a>
                          </div>
                          <div class="col col-md-12 p-0 pr-1 mt-1" style="height: 25px;  display: flex;">
                            <a type="button" style="    border-color: #d83049;padding-top:3px;font-size: 12px!important;flex:1"  onclick="showLamba('<?=$urun->baslik_seri_no?>','<?=$urun->seri_numarasi?>')" class="btn btn-default btn-xs"><i class="far fa-lightbulb text-danger" aria-hidden="true"></i> Lamba Değişim</a>
                          </div>
                      </div>
               


                    </td>


                    
                      <td style="vertical-align: top!important;padding:9px!important;">
                        <div class="row p-0">
                          <div class="col col-md-6 p-0 pr-1" style="height: 25px;  display: flex;">
                            <a type="button" style="padding-top:3px;font-size: 12px!important;flex:1" onclick="showGecmis('<?=$urun->siparis_urun_baslik_no?>','<?=$urun->urun_baslik_ariza_tanim_id?>');" class="btn btn-dark btn-xs"><i class="fas fa-history" style="font-size:12px" aria-hidden="true"></i> Geçmiş</a>
                          </div>
                          <div class="col col-md-6 p-0" style="height: 25px; display: flex;">
                            <a type="button" style="padding-top:3px;font-size: 12px!important;flex:1" target="_blank" href="<?=base_url("baslik/print/".$urun->siparis_urun_baslik_no)?>" class="btn btn-primary btn-xs"><i class="fas fa-qrcode" style="font-size:12px" aria-hidden="true"></i> QR Yazdır</a> 
                          </div>
                          <div class="col col-md-6 p-0 mt-1 pr-1" style="height: 25px; display: flex;">
                            <a type="button" style="padding-top:3px;font-size: 12px!important;flex:1  " onclick="showSweetAlert('<?=$urun->baslik_id?>','<?=$urun->urun_baslik_ariza_tanim_id?>','<?php if($urun->urun_baslik_ariza){echo base64_encode($urun->urun_baslik_ariza);}?>','<?=$urun->urun_baslik_ariza_aciklama?>')" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          </div>
                          <div class="col col-md-6 p-0 mt-1" style="height: 25px; display: flex;">
                           <?php 
                            switch ($urun->urun_baslik_ariza_durum_no) {
                              case 1:
                              case 2:
                              case 3:
                               ?>
                               <button type="button" onclick='Swal.fire({icon: "error",title: "Arıza Kaydı Sonlandırılamadı",text: "Arıza kaydını sonlandırmak için sipariş durumunu (Garanti Süresi Bitmiş, İade Edildi, Kargoya Verildi) olarak güncelleyiniz.!"});' style="opacity:0.6!important;padding-top:3px;font-size: 12px!important;flex:1" class="btn btn-danger btn-xs"><i class="fas fa-check-circle" style="font-size:12px" aria-hidden="true"></i> Sonlandır</button>
                              <?php
                                break;
                              
                              default:
                                ?>
                                <button type="button"  onclick="ariza_sonlandir('<?=$urun->urun_baslik_ariza_tanim_id?>')" style="padding-top:3px;font-size: 12px!important;flex:1" class="btn btn-danger btn-xs"><i class="fas fa-check-circle" style="font-size:12px" aria-hidden="true"></i> Sonlandır</button>  
                                <?php break;
                            }
                                      
                                      
                           ?>
                           </div>
                        </div>
                        
                      </td>



                      <td style="vertical-align:top!important;padding:8px!important;font-weight:normal;color:#072676;">
                    <span style="color:#000095;
    background: #07267626;
    padding: 2px;border-radius:3px;
    padding-left: 5px; 
    padding-right: 10px;
    width: 100%;
    display: block; font-weight: 500;
">
  Son Güncelleme : <?=date("d.m.Y",strtotime($urun->ariza_siparis_durum_guncelleme_tarihi))?>
                                   
</span>
                    
                 <div style="height:5px"></div>
                    <select name="" style="height:30px;margin-top:5px;border-radius:0 0 3px 3px;width:100%" data-kayit-id="<?=$urun->urun_baslik_ariza_tanim_id?>" onchange="siparis_durum_degistir(this)"   class="select2">
                      <option value="1" <?=($urun->urun_baslik_ariza_durum_no == 1) ? "selected":""?>>Beklemede</option>
                      <option value="2" <?=($urun->urun_baslik_ariza_durum_no == 2) ? "selected":""?>>İşleme Alındı</option>
                      <option value="3" <?=($urun->urun_baslik_ariza_durum_no == 3) ? "selected":""?>>Ödeme Bekleniyor</option>
                      <option value="4" <?=($urun->urun_baslik_ariza_durum_no == 4) ? "selected":""?>>Garanti Süresi Bitmiş</option>
                      <option value="5" <?=($urun->urun_baslik_ariza_durum_no == 5) ? "selected":""?>>İade Edildi</option>
                      <option value="6" <?=($urun->urun_baslik_ariza_durum_no == 6) ? "selected":""?>>Kargoya Verildi</option>
                      <option value="6" <?=($urun->urun_baslik_ariza_durum_no == 9) ? "selected":""?>>YANLIŞ İŞLEM / İPTAL</option>
                    </select>
                    
                </td>




                      <td style="vertical-align: top!important;padding:7px!important;">
                      <span style="
    background: #d5d9e4;
    padding: 2px;
    padding-left: 5px; font-weight: 700;
    padding-right: 10px;
    width: 100%;
    display: block; 
">

<?php 
if($urun->cihaz_borc_uyarisi == 1){
  ?>
  <a  onclick='showcihaz(<?=$urun->siparis_urun_id?>);' style="padding-top:3px;font-size: 12px!important;" class="btn btn-danger yanipsonenyazi btn-xs">Borç Uyarısı</a>
  <?php
}
?>


  <?=$urun->musteri_ad?> / <?php echo mb_substr($urun->merkez_adi,0,20); ?>... <span class="text-danger"><?=$urun->urun_baslik_kargo_adi?></span><br>  
                                       
</span>

                       <span style="font-weight:normal">
                       <b>Konum : </b><span style="font-weight:normal"> <?=$urun->ilce_adi?> - <?=$urun->sehir_adi?> </span>
                      
                       <b style="margin-left:5px;">İletişim : </b> <?=$urun->musteri_iletisim_numarasi?> 
                     
                      
                      </span><br> 
                       <span style="    border-radius: 3px;max-width: 240px!important;min-width: 240px!important;font-weight:normal;opacity: 0.6; ">
                     
                       <?php echo mb_substr($urun->merkez_adresi,0,40); ?>... </span>
                    </td>
                     
                      
                    <td style="background:#ebf5ff;vertical-align: top!important;padding:10px!important;">

                    <span style="font-weight: 700;background: #cce5ff;padding: 2px;padding-left: 5px; padding-right: 10px;width: 100%;  display: block;margin-top: -3px!important;">  <?=preg_replace('/\([^)]+\)/', '',$urun->baslik_adi);?></span>
               
                   <span style="
    background: #ebf5ff;
    
    padding-left: 5px; 
    padding-right: 10px;
    width: 100%;
    display: inline-block;
">
                       <?=$urun->urun_adi?>
                       <br><span style="font-weight:normal">
                       <a onclick='showcihaz(<?=$urun->siparis_urun_id?>);' style="cursor:pointer;color:black!important">
                        <?=$urun->seri_numarasi?> 
                        </a>
                       
                       </span>
                    </td>
            
                      
                     
                   
                    <td style="vertical-align: top!important;padding:8px!important;background:<?=$bcolor?>; color:<?=$fcolor?>">
                    <span style="
    background: #125b001c;
    padding: 2px;font-weight: 700;
    padding-left: 5px; 
    padding-right: 10px;
    width: 100%;
    display: block; 
">
<?=($urun->dahili_baslik==0) ? "Ekstra Başlık" : "Dahili Başlık"?>
</span> 

<span style="padding:5px;margin-top:2px;">
Başlangıç : 
                    <?php 
                    
                    if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->baslik_garanti_baslangic_tarihi))){
                      echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                
                    }else{
                      echo date("d.m.Y",strtotime($urun->baslik_garanti_baslangic_tarihi));
                    }
                    
                    
                    ?> <br>
                    <span style="padding:5px;font-weight:normal">
                       Bitiş : 
                       <?php 
                        if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) < date("Y-m-d")){
                          echo '<i class="fas fa-exclamation-triangle" style="padding:4px;border-radius:7px;color:white;background:#ea4e2c;margin-right:5px;opacity:1"></i> '.date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi))." / (".gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi)))." gün önce)";
                        }else if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->baslik_garanti_baslangic_tarihi))){
                          echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                    
                        }else{
                          echo date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi))." (".gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi)))." gün kaldı)";
                        }
                     
                       ?></span>


                      </span>
                    </td>




<!--
                    <td style="vertical-align: top!important;padding:7px!important;font-weight:normal;color:#072676; ">
                    <span style="
    background: #dbdfea;
    padding: 2px;
    padding-left: 5px; 
    padding-right: 10px;
    width: 100%;font-weight: 500;
    display: block; 
"><?php $gdata = son_ariza($urun->urun_baslik_ariza_tanim_id,$urun->siparis_urun_baslik_no); ?>
  Tarih : <?=$gdata != null ? date("d.m.Y H:i",strtotime($gdata[0]->ariza_siparis_durum_guncelleme_tarihi)) : "<span style='opacity:0.5'>Kayıt Bulunamadı</span>"?>
                    
</span>

  
 
 <?php
if($gdata != null ){

                   $jsonData = json_encode(get_arizalar($gdata[0]->urun_baslik_ariza), true);
                  
                   $data = json_decode($jsonData, true);

                    
                   $basliklar = array_map(function($item) use($urun) {
                     
                       return preg_replace('/\([^)]+\)/', '', $item['urun_baslik_ariza_adi']);
                   }, $data);

                   if($gdata[0]->urun_baslik_ariza != null && $gdata[0]->urun_baslik_ariza != "" && $gdata[0]->urun_baslik_ariza != "null")
                   { 
                     echo '<i class="fas fa-check-circle"></i> '.implode('<br><i class="fas fa-check-circle"></i> ', $basliklar);

                   }
                   else{
                     echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Arıza Bulunamadı</span>";

                   }
                   if($gdata[0]->urun_baslik_ariza_aciklama != ""  && $gdata[0]->urun_baslik_ariza_aciklama != null){
                    echo '<br><div style="height:5px">.</div><span style=" max-width: 150px!important; padding: 5px; background: #ffe2e2; color: #d00000; margin-top: 5px; margin-bottom: 5px; border: 2px solid #ff00007d; border-radius: 5px;"><i class="fas fa-exclamation-circle"></i> '.mb_substr($gdata[0]->urun_baslik_ariza_aciklama,0,30).(strlen($urun->urun_baslik_ariza_aciklama)>29?'...':'')."</span>";
                  echo '<div style="height:5px">.</div>';
                  }
             
} else{
  echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Eski Arıza Kaydı Bulunamadı</span>";

}     ?>
  <br>
  Toplam Arıza Kaydı : <?=toplam_ariza($urun->siparis_urun_baslik_no)?>
</td>






-->




                    <td style="padding-top:8px!important;vertical-align:top!important;font-weight:normal;color:#0c6b00;">
                    <span style="
    background: #125b001c;
    padding: 2px;
    padding-left: 5px; 
    padding-right: 10px;
    width: 100%;font-weight: 500;
    display: block; 
">
 Kayıt Tarih : <?=date("d.m.Y H:i",strtotime($urun->urun_baslik_ariza_kayit_tarihi))?>
                    
</span>

                    <?php
if($urun->urun_baslik_ariza){
                                      $jsonData = json_encode(get_arizalar($urun->urun_baslik_ariza), true);
                                     
                                      $data = json_decode($jsonData, true);

                                       
                                      $basliklar = array_map(function($item) use($urun) {
                                        
                                          return preg_replace('/\([^)]+\)/', '', $item['urun_baslik_ariza_adi']);
                                      }, $data);
                                    }
                                      if($urun->urun_baslik_ariza != null && $urun->urun_baslik_ariza != "" && $urun->urun_baslik_ariza != "null")
                                      { 
                                        echo '<i class="fas fa-check-circle"></i> '.implode('<br><i class="fas fa-check-circle"></i> ', $basliklar);
                                        
                                     
                                      }
                                     
                                      else{
                                        echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i>  Arıza Seçilmedi</span>";

                                      }
                                      if($urun->urun_baslik_ariza_aciklama != ""  && $urun->urun_baslik_ariza_aciklama != null){
                                        echo '<br><div style="height:5px">.</div><span style=" max-width: 150px!important; padding: 5px; background: #ffe2e2; color: #d00000; margin-top: 5px; margin-bottom: 5px; border: 2px solid #ff00007d; border-radius: 5px;"><i class="fas fa-exclamation-circle"></i> '.mb_substr($urun->urun_baslik_ariza_aciklama,0,60).(strlen($urun->urun_baslik_ariza_aciklama)>59?'...':'')."</span>";
                                      echo '<div style="height:5px">.</div>';
                                      }
                                    
                                      ?>
                     
                   </td>
                    
                       
                    </tr>
                  <?php  endforeach; ?>
              
                  </tbody>
            
                </table>
              </div> 
            </div> 
</section>
            </div>





            <div class="modal fade" id="modal-default"  data-backdrop="static">
              <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Arıza Kaydı Oluştur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form action="<?=base_url("baslik/ariza_kaydet")?>" method="post">
                    <input type="hidden" id="ariza_siparis_id" name="urun_baslik_ariza_tanim_id" value="">
                    <label>Arıza Seçimi Yapınız</label> 
                    <br>
                    <div id="checkboxContainer"></div>
                      <label class="mt-2">Arıza / Tamir Açıklaması</label>
                      <textarea name="ariza_aciklama" id="summernotearizaaciklama"></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                      <button type="submit" class="btn btn-success" onclick="save_ariza()">Bilgileri Kaydet</button>
                    </div>
                  </form>
                </div> 
              </div> 
            </div> 







            <div class="modal fade" id="modal-lamba"  data-backdrop="static">
              <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" style="font-size: medium;"><i class="fas fa-random"></i> Lamba Değişimi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form action="<?=base_url("baslik/lamba_tanimla")?>" id="myForm" method="post"> 
                  
                  <div class="row" style="margin-top: 6px !important;">
                    <div class="col p-0" style="    padding-right: 8px !important;">
                    <label for="cihaz_seri_no" style="margin-bottom: 2px !important;"><i class="fas fa-qrcode text-primary" ></i> Cihaz Seri Numarası</label> 
                    <input type="text" readonly style="background:#fffae7!important;" id="cihaz_seri_no" name="cihaz_seri_no" class="form-control" value="">

                    </div>
                    <div class="col p-0">
                    <label for="lamba_seri_kod" style="margin-bottom: 2px !important;"><i class="fas fa-qrcode text-primary" ></i> Başlık Seri Kodu</label> 
                    <input type="hidden" name="lamba_takilacak_baslik_seri_kod" id="lamba_takilacak_baslik_seri_kod" class="form-control" value="">
                    <input type="text" readonly style="background:#fffae7!important;" id="lamba_takilacak_baslik_seri_kod2" class="form-control" value="">


                    </div>
                  </div>

                  <label for="lamba_seri_kod_eski_show" class="mt-3" style="margin-bottom: 2px !important;"><i class="far fa-lightbulb text-orange" aria-hidden="true"></i> Takılı Lamba Stok Kodu</label> 
                    <input id="lamba_seri_kod_eski_show"  class="form-control" readonly="" value="">
                   
                    <label for="lamba_seri_kod"  class="mt-3" style="margin-bottom: 0px !important;"><i class="far fa-lightbulb text-success" aria-hidden="true"></i> Yeni Lamba Seri Kodunu Giriniz</label> 
                    <input id="lamba_seri_kod" required class="form-control" placeholder="Yeni Lambanın Qr Kodunu Okutunuz" name="lamba_seri_kod" value="">
                    <span id="stok_uyari" style="display: none;background: #c10000;color: white;padding: 5px;border-radius: 3px;margin-top: 3px;"><i class="fas fa-exclamation-circle"></i>Sisteme kaydedilmiş ve stok çıkışı yapılmış kayıt bulunamadı.</span>
                   
                   
                    </div>
                    <div class="modal-footer justify-content-between">
                     
                      <button type="submit" style="width: 100%;" class="btn btn-success" >Değişim Bilgilerini Kaydet</button>
                    </div>
                  </form>
                </div> 
              </div> 
            </div> 















            <div class="modal fade" id="modal-gecmis"  data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered" style="    max-width: 617px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" style="font-size: 17px;
    padding: 5px;">Arıza Geçmişi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="    padding-bottom: 0px;">

            <div class="timeline" id="custom_timeline" style="margin-bottom:0px;">


  
  
 

</div>
 

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" style="width: 100%;" class="btn btn-danger" data-dismiss="modal">Kapat</button> 
            </div>


             

          </div> 
        </div> 
      </div> 


            <div class="modal fade" id="modal-lg" data-backdrop="static">
              <div class="modal-dialog modal-dialog-centered" style="max-width:700px!important">
                <div class="modal-content">
                  <div class="modal-header bg-success" style="background:#02243d !important;padding: 0.5rem;">
                    <h4 class="modal-title text-md pl-2"><i class="fas fa-file-invoice" style="color:#b9b9b9"></i> Başlık Bilgileri</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="opacity:1;color:white !important;">&times;</span>
                    </button>
                  </div>
                <div class="modal-header bg-success" style="margin-top:-2px;background:#fff6b3 !important;padding: 0.5rem;">
                <h5 class="modal-title text-sm pl-2" style="color:#6b5e00;font-weight:normal"><i class="fas fa-exclamation-circle"></i> Girilen seri numarasına tanımlı 1 adet başlık kaydı bulundu. Bilgileri kontrol ettikten sonra işleme alabilirsiniz.</h5>
              </div>
              <form id="add_form" action="#" name="add_form">
                <div class="modal-body pt-0 pl-0 pr-0">
                  <div class="row p-1 " style="display: block;">
                       <span id="result"></span>
                       <div class="row p-2" style="background: #008cff0d;display: flex;margin: 0px;border-radius: 15px;margin-bottom: 15px;border: 1px solid #08243b38;">
                        <div class="col" style="max-width: 93px;">
                          <img id="baslik_resim" alt="" style="width: 82px;height: 82px;object-fit: scale-down;/* margin: 5px; *//* margin: auto; */display: block;background: #05243c;border-radius: 15px 15px;/* border: 3px dashed #d5bd00ab; */margin-left: -8px;"  >
                        </div>
                        <div class="col" style="text-align: center;padding-top: 5px;">
                        <span id="baslik_adi" style="font-size: 25px;text-align: center;justify-content: center;margin: auto;font-weight: 600;color: #043b65;vertical-align: text-top;margin-top: 5px;"></span><br>
                        <span id="bsdf" style="font-size: 15px;text-align: center;justify-content: center;margin: auto;color: #043b65;vertical-align: text-top;
                        ">Başlık Kayıt Tarihi : <span id="baslik_kayit_tarihi"></span>
                        </span>
                        </div>
                        <div class="col" style="max-width: 93px;">
                        <img id="cihaz_resim" alt="" style="width: 82px;height: 82px;object-fit: scale-down;/* margin: 5px; *//* margin: auto; */display: block;background: #05243c;border-radius: 15px 15px;/* border: 3px dashed #d5bd00ab; */margin-left: 4px;">
                        </div>
                        </div>
                  <div class="p-2">
                                      
                  <div class="row mb-1">   
                    <div class="form-group col-md-6 pr-0 pl-0 mb-1">
                      <label for="formClient-Name"><i class="fas fa-building text-danger"></i> Merkez Bilgisi</label>
                      <span id="merkez_adi" class="form-control"> </span>  
                    </div>    
                    <div class="form-group col-md-6 pr-0 mb-1">
                      <label for="formClient-Name"><i class="fa fa-user-circle text-success"></i> Yetkili Bilgisi</label>
                   
                      <span id="yetkili_adi" class="form-control"> </span> 
                    </div>   
                  </div>




                  <div class="row mb-1">   
                    <div class="form-group col-md-6 pr-0 pl-0 mb-1">
                      <label for="formClient-Name"><i class="fas fa-box text-primary"></i> Cihaz Bilgisi</label>
                       <span id="cihaz_adi" class="form-control"> </span> 
                    </div>    
                    <div class="form-group col-md-6 pr-0 mb-1">
                      <label for="formClient-Name"><i class="fa fa-qrcode text-orange"></i> Cihaz Seri No</label>
                       <span id="cihaz_seri_no2" class="form-control"> </span> 
                    </div>   
                  </div>

                  
                        
                  <div class="row mb-1">   
                    <div class="form-group col-md-6 pr-0 pl-0 mb-1">
                      <label for="formClient-Name"><i class="fas fa-calendar-check text-success"></i> Garanti Başlangıç Tarihi</label>
                       <span id="garanti_baslangic" class="form-control"> </span> 
                    </div>    
                    <div class="form-group col-md-6 pr-0 mb-1">
                      <label for="formClient-Name"><i class="fas fa-calendar-times text-danger"></i> Garanti Bitiş Tarihi</label>
                       <span id="garanti_bitis" class="form-control"> </span> 
                    </div>   
                  </div> 
                      
                        
                  

                  <div class="form-group col pr-0 pl-0">
                  <label for="formClient-Name"><i class="fa fa-map-marker-alt text-orange"></i> Merkez Adresi</label>
                                
                     <span id="adres_input" class="form-control"></span>
                  </div>

                  <label for="formClient-Name" style="    width: 100%;
    background: #fef6b8;
    padding: 5px;
    border-radius: 5px;"><i class="fas fa-history"></i> Eski Arıza / Tamir Kayıtları</label>
                    

                  <div class="timeline" id="custom_timeline2" style="margin-bottom:0px;">


                                      
  
 

</div>

                   

                                </div>

                              </div>
                        </form>
                        <div>
                          
                  <div class="modal-footer ">


                  <span>Hangi Kargodan Geldi ? </span>
<select id="kargoGelen" name="kargoGelen" required onchange="kargoGelenFunc()"  class="form-control">
        <option value="">SEÇİM YAPINIZ</option>
        <option value="1">BİLİNMİYOR</option>
        <option value="8">OTOBÜS</option>
        <option value="2">YURTİÇİ KARGO</option>
        <option value="3">ARAS AKRGO</option>
        <option value="4">PTT KARGO</option>
        <option value="5">MNG KARGO</option>
        <option value="6">SÜRAT KARGO</option>
        <option value="7">UPS KARGO</option>

        <option value="9">TEKNİK SERVİS</option>
    </select>


                    <button style="flex:1" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Ekranı Kapat</button>
                      <a style="flex:1" type="submit" onclick="close_modal()" class="btn btn-success" id="isleme_al"><i class="fa fa-plus-circle"></i> İşleme Al</a>
                  </div></div>
                
                </div> 
              </div> 
            </div>




  




<script> 
    function showcihaz(param){
            Swal.fire({
               
                html: '<iframe src="https://ugbusiness.com.tr/cihaz/edit/'+param+'/1" width="100%" height="100%" frameborder="0"></iframe>',
                showCloseButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                width: '80%',
                height: '80%',
            });
        };

var input = document.getElementById("barcode");
var isFocused = true; 
input.focus();
 
document.addEventListener("click", function(event) {
 
  if (event.target.tagName.toLowerCase() != 'select' && event.target.tagName.toLowerCase() != 'span' && event.target.className != 'select2-selection__rendered' && event.target.className != 'note-placeholder' && event.target.tagName.toLowerCase() !== 'a' && event.target.tagName.toLowerCase() !== 'input') {
    input.focus();
  }
});
 


function ariza_sonlandir(id){
  Swal.fire({
                title: "İşlem Durumunu Güncelle",
                html: "Seçilen başlığın arıza işlem durumu sonlandırılacaktır. İşlemi onaylıyor musunuz?",
                icon:"question",
                showCancelButton: true,
                confirmButtonColor: "#098f23",
                confirmButtonText: "Tamam", 
                cancelButtonText: "İptal",
                allowOutsideClick: false,
                showConfirmButton: true
              }).then((result) => {
                if (result.isConfirmed) {
                fetch('<?=base_url("baslik/ariza_siparis_sonlandir/")?>'+id)
  .then(response =>  {
    
    location.reload();
  })
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
}
              });
}





function siparis_durum_degistir(e){
  var select = e;
  var url = '<?=base_url("baslik/ariza_siparis_durum_guncelle/")?>'+select.getAttribute("data-kayit-id")+'/'+select.value;

  Swal.fire({
                title: "Sipariş Güncelle",
                html: "Seçilen başlığın sipariş durumu <span style='color: #df0000; background: #ffeded; /* padding: 5px; */ /* padding-top: 10px; */ padding-left: 5px; padding-right: 5px; border-radius: 10px; /* font-size: large; */ font-weight: 500;'>"+select.options[select.selectedIndex].text+"</span> olarak güncellenecektir. İşlemi onaylıyor musunuz?",
                icon:"question",
                showCancelButton: true,
                confirmButtonColor: "#098f23",
                confirmButtonText: "Tamam", 
                cancelButtonText: "İptal",
                allowOutsideClick: false,
                showConfirmButton: true
              }).then((result) => {
 
  if (result.isConfirmed) {
    Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Sipariş Durumu Güncelleniyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });

    fetch(url)
  .then(response =>  {
    
    location.reload();
  })
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
 
  }  
});
}


function close_modal(){
  $('#modal-lg').modal('hide');
  Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Arıza kaydı oluşturuluyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });
}
function myGreeting() {
  var value = document.getElementById("barcode").value;
  if(value.trim() != ""){
    baslik_kontrol(value.trim());
  }
 
}


let str = '';
let timer = null;
  document.querySelector("#barcode").onkeydown=function(event){
    str += event.key;
    if (timer) {
        clearTimeout(timer);
    }
    timer = setTimeout(() => {
      myGreeting()
        str = '';   
    }, 500);


     

  }

  function formatTarih(tarih) {
    var myDate = new Date(tarih);
    var gun = myDate.getDate();
    var ay = myDate.getMonth() + 1;
    var yil = myDate.getFullYear();

    
    if (gun < 10) {
        gun = '0' + gun;
    }
    if (ay < 10) {
        ay = '0' + ay;
    }

    return gun + '.' + ay + '.' + yil;
}
function kargoGelenFunc(){
    var x = document.getElementById("kargoGelen").value; 
    document.getElementById("isleme_al").href = '<?=base_url("baslik/baslik_isleme_al/")?>'+document.getElementById("isleme_al").getAttribute('data-baslik-id')+"/"+x;
                
}

function baslik_kontrol(serino_data){
   
  Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Başlık Kaydı Sorgulanıyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });
    
        var barcodeData = serino_data;
        var baslikId = 0;
        $.ajax({
                url: '<?=base_url("baslik/baslik_sorgula")?>',
                method: "POST",
                dataType: "json",
                data: { barcode: barcodeData },
                success: function(response) {
                  Swal.close();
                  console.log(response);
                  if(response == false){
            
                    document.getElementById("barcode").value = "";
                   Swal.fire({icon: "error",timer: 1500,timerProgressBar: true,confirmButtonColor: "#c72000",confirmButtonText: "Tamam",title: "Sistem Uyarısı...",text: "Girilen seri no'ya tanımlı başlık bilgisi bulunamadı. Bilgileri kontrol edip tekrar deneyiniz."});
                  } else{
                    if(response[0].baslik_adi == undefined){
                      Swal.fire({
            title: 'Eski Sistemden Veri Bulundu',
            html:  ` <div style="background: #ffffe2; padding: 10px; color: #ab6800; margin-top: 0px; margin-bottom: 15px; border: 2px solid #ffbc007d; border-radius: 5px;">
     <span style="font-size: 14px;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f5a100;
"></i>Okutulan qr kod yeni sistemde tanımlı değildir. Eski sistemden bulunan sonuçlar aşağıda yer almaktadır. <b>Merkez Kaydı Oluştur</b> butonunu kullanarak başlık tanımlaması yapmanız gerekmektedir.</span>
 </div>`+`<p><b>Salon Adı:</b> ${response[0].SalonAdi}</p>
              
                   <p><b>Cihaz Seri No:</b> ${response[0].CihazSerino}</p>
                   <p><b>Garanti Başlangıç:</b> ${response[0].GarantiBas}</p>
                   <p><b>Garanti Son:</b> ${response[0].GarantiSon}</p>
                   <p><b>İletişim No:</b> ${response[0].Telefon}</p>
                   <p><b>Cihaz Adı:</b> ${response[0].CihazAdi}</p> `   
                  ,


              

            icon: 'info',
            confirmButtonText:'<i class="fa fa-plus-circle"></i> Merkez Kaydı Oluştur',
            confirmButtonColor:'green',  cancelButtonText: "CANCEL", showCancelButton: true,
  closeOnConfirm: false,
  closeOnCancel: false
}).then((result) => {
             
            if (result.isConfirmed){
              
              location.href = '<?=base_url("baslik/eski_baslik_kayit_olustur/")?>'+response[0].Logicalref;
      
    } else {
      document.getElementById("barcode").value = "";
         e.preventDefault();
    }
       
    });
                    }else{

                      
                 
                  document.getElementById("baslik_adi").innerText = response[0].baslik_adi;
                  document.getElementById("cihaz_adi").innerHTML = response[0].urun_adi;
                  document.getElementById("merkez_adi").innerHTML = response[0].merkez_adi;
                  document.getElementById("yetkili_adi").innerHTML = response[0].musteri_ad;
               
                  document.getElementById("kargoGelen").value = "";
               

                  document.getElementById("baslik_resim").src = '<?=base_url("uploads/")?>'+response[0].baslik_resim;
                  document.getElementById("cihaz_resim").src = '<?=base_url("assets/dist/img//")?>'+response[0].urun_slug+".png";
                  document.getElementById("isleme_al").href = '<?=base_url("baslik/baslik_isleme_al/")?>'+response[0].urun_baslik_tanim_id;
                  document.getElementById("isleme_al").setAttribute('data-baslik-id', response[0].urun_baslik_tanim_id); 
                  
                                 document.getElementById("cihaz_seri_no2").innerHTML = response[0].seri_numarasi;
                  document.getElementById("cihaz_seri_no").innerHTML = response[0].seri_numarasi;
                  document.getElementById("garanti_baslangic").innerHTML = formatTarih(response[0].baslik_garanti_baslangic_tarihi);
                  document.getElementById("garanti_bitis").innerHTML = formatTarih(response[0].baslik_garanti_bitis_tarihi);
                  document.getElementById("baslik_kayit_tarihi").innerHTML = formatTarih(response[0].baslik_tanim_kayit_tarihi);
                 
                  document.getElementById("adres_input").innerHTML = response[0].merkez_adresi+" "+response[0].ilce_adi+" "+response[0].sehir_adi;
                 
             
                 
                  $('#summernotesiparisnot').summernote('code', response[0].merkez_adresi);
                  document.getElementById("barcode").value = "";
                  baslikId = response[0].urun_baslik_tanim_id;

                  $.ajax({
                url: '<?=base_url("baslik/gecmis_arizalar")?>',
                method: "POST",
                dataType: "json",
                data: { siparis_urun_baslik_no: baslikId },
                success: function(response) {
                  Swal.close();  
                  
                  var container = document.getElementById("custom_timeline2");
                 
                  container.innerHTML = '';
                  response.forEach(function(state) {
             

                    var timelineDiv = document.createElement("div");
timelineDiv.style.marginRight = "0px";
                    
    timelineDiv.innerHTML = `
        <i class="fas fa-envelope bg-blue"></i>
        <div class="timeline-item">
            <span class="time" style="text-align: right;">
                <i class="fas fa-clock text-primary"></i> <b>Kayıt Tarihi</b> <br>${state.urun_baslik_ariza_kayit_tarihi}
            </span>
            <h3 class="timeline-header" style="background: #f3f3f3;font-weight:normal">
                <span style="color: #000000;"><b>${state.merkez_adi}</b></span> <br><div style="height:5px"></div><i class="far fa-user-circle"></i>
                ${state.musteri_ad}
            </h3>
            <div class="timeline-body"> 
                <b><i class="fas fa-question-circle text-success"></i> Arıza Bilgileri :</b> ${state.ariza_detaylari}
                <br>
                <b><i class="fas fa-comment text-warning"></i> Açıklama :</b> `+ (state.urun_baslik_ariza_aciklama != "" ? state.urun_baslik_ariza_aciklama : "<span style='opacity:0.5'>*Açıklama Girilmedi</span>") +`
                <br>
                <b><i class="fas fa-folder-open text-primary"></i> Sipariş Son Durumu :</b> ${state.urun_baslik_ariza_siparis_durum_adi} (${state.ariza_siparis_durum_guncelleme_tarihi})
           
                <br>
                <b><i class="fas fa-users-cog text-danger"></i> İşlem Durumu :</b> `+((state.ariza_tamamlandi == 1) ? "Tamamlandı" : "Devam Ediyor") + `
           
                </div>
        </div>
    `;

                  container.appendChild(timelineDiv);

              });
              $('#modal-lg').modal('show');

              
            }});

          }

       
                }
                }}); 
                
                



}









function showLamba(serikod,cihaz_serino){

  document.getElementById("lamba_seri_kod_eski_show").value = "";
  $.ajax({
                url: '<?=base_url("baslik/eski_lamba_kodu")?>',
                method: "POST",
                dataType: "json",
                data: { baslik_seri_no: serikod },
                success: function(response) {
                  console.log(response);
                  if(response.eski_lamba_durum != "false"){
                    document.getElementById("lamba_seri_kod_eski_show").value = response.eski_lamba_durum;
                  }
                
                }
                });



  document.getElementById("stok_uyari").style.display = "none";
  var inpt = document.querySelector('#lamba_takilacak_baslik_seri_kod');
                  inpt.value = serikod;












                  
  var inpt2 = document.querySelector('#lamba_takilacak_baslik_seri_kod2');
  inpt2.value = serikod;
  inpt2.focus();


  var inpt3 = document.querySelector('#cihaz_seri_no');
                  inpt3.value = cihaz_serino;


  $('#modal-lamba').modal('show');
 
}



function save_ariza(){

 
Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Başlık Arıza Bilgileri Kaydediliyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });
 
                
}
function showGecmis(id,ariza_kayit_id) {
  Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Başlık Geçmiş Arıza Bilgileri Sorgulanıyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });  
              
              
              $.ajax({
                url: '<?=base_url("baslik/gecmis_arizalar")?>',
                method: "POST",
                dataType: "json",
                data: { siparis_urun_baslik_no: id,ariza_tanim_id: ariza_kayit_id },
                success: function(response) {
                  Swal.close();  
                  
                  var container = document.getElementById("custom_timeline");
                 
                  container.innerHTML = '';
                  response.forEach(function(state) {
             

                    var timelineDiv = document.createElement("div");
timelineDiv.style.marginRight = "0px";
                    
    timelineDiv.innerHTML = `
        <i class="fas fa-envelope bg-blue"></i>
        <div class="timeline-item">
            <span class="time" style="text-align: right;">
                <i class="fas fa-clock text-primary"></i> <b>Kayıt Tarihi</b> <br>${state.urun_baslik_ariza_kayit_tarihi}
            </span>
            <h3 class="timeline-header" style="background: #f3f3f3;font-weight:normal">
                <span style="color: #000000;"><b>${state.merkez_adi}</b></span> <br><div style="height:5px"></div><i class="far fa-user-circle"></i>
                ${state.musteri_ad}
            </h3>
            <div class="timeline-body"> 
                <b><i class="fas fa-question-circle text-success"></i> Arıza Bilgileri :</b> ${state.ariza_detaylari}
                <br>
                <b><i class="fas fa-comment text-warning"></i> Açıklama :</b> `+ ((state.urun_baslik_ariza_aciklama == null || state.urun_baslik_ariza_aciklama == "") ? "<span style='opacity:0.5'>*Açıklama Girilmedi</span>" :state.urun_baslik_ariza_aciklama) +`
                <br>
                <b><i class="fas fa-folder-open text-primary"></i> Sipariş Son Durumu :</b> ${state.urun_baslik_ariza_siparis_durum_adi} (${state.ariza_siparis_durum_guncelleme_tarihi})
           
                <br>
                <b><i class="fas fa-users-cog text-danger"></i> İşlem Durumu :</b> `+((state.ariza_tamamlandi == 1) ? `Tamamlandı  (${state.urun_baslik_ariza_sonlandirma_tarihi})` : "Devam Ediyor") + `
           
                </div>
        </div>
    `;

                  container.appendChild(timelineDiv);

              });
                 
              $('#modal-gecmis').modal('show');
                
                }}); 
                


}


  function showSweetAlert(id,ariza_siparis_id,arizalar,aciklama) {
       
    Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Başlık Arıza Bilgileri Sorgulanıyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });
            
 
    $.ajax({
                url: '<?=base_url("baslik/arizalar")?>',
                method: "POST",
                dataType: "json",
                data: { urun_baslik_tanim_no: id },
                success: function(response) {
                  Swal.close();  
                  var inpt = document.querySelector('#ariza_siparis_id');
                  inpt.value = ariza_siparis_id;
               
                  var container = document.getElementById("checkboxContainer");
                  var dizi = atob(arizalar);
                  container.innerHTML = '';
                  response.forEach(function(state) {
             

             
                  var checkboxDiv = document.createElement("div");
                  checkboxDiv.className = "icheck-primary custom-container";
                  checkboxDiv.setAttribute("for", "checkboxPrimary" + state.urun_baslik_ariza_id);
                  
                  
                  var checkboxInput = document.createElement("input");
                  checkboxInput.type = "checkbox";
                  checkboxInput.name = "ariza_select[]";
                  checkboxInput.value = state.urun_baslik_ariza_id;
                  checkboxInput.id = "checkboxPrimary" + state.urun_baslik_ariza_id;
                  if (dizi.includes("\""+state.urun_baslik_ariza_id+"\"")) {
                    checkboxInput.checked = "checked";
                 
                    }

                    
                  var checkboxLabel = document.createElement("label");
                  checkboxLabel.setAttribute("for", "checkboxPrimary" + state.urun_baslik_ariza_id);
                  checkboxLabel.style.width = "100%";checkboxLabel.style.fontWeight = "400";
                  checkboxLabel.textContent = state.urun_baslik_ariza_adi;
                  
                  checkboxDiv.appendChild(checkboxInput);
                  checkboxDiv.appendChild(checkboxLabel);
                  
                  container.appendChild(checkboxDiv);
                  console.log(state);
                  $('#summernotearizaaciklama').summernote('code', aciklama);
                    
             
              });
              
              
              $('#modal-default').modal('show');
                
                }}); 
                



    }



    $("#ariza_select").select2({
            closeOnSelect: false
    });



</script>


<style>
  .select2-selection__rendered{
    font-weight: bold!important;
  }
  
  .yanipsonenyazi {
      animation: blinker 0.3s linear infinite;
    
     
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }
      .select2-container--open {
    z-index: 99999999999999;
    }
 
         
    </style>

<style>
        
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none; 
            z-index: 1000; 
        }
    </style>


 
 

<script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var baslikKod    = document.getElementById('lamba_takilacak_baslik_seri_kod2').value;
            var yeniLambaKod = document.getElementById('lamba_seri_kod').value;
         
            $.ajax({
                type: "POST",data: {
                  'lamba_seri_kod': yeniLambaKod,
                  'baslik_kod': baslikKod
                },
                url: 'https://ugbusiness.com.tr/stok/stok_sorgula',
                success: function (data) {
                   console.log(data);

                    var res = JSON.parse(data);
                    
                    if(res.lamba_durum == "false"){
                        document.getElementById('stok_uyari').style.display = "block";
                    } else{
                      document.getElementById('stok_uyari').style.display = "none";
                    }
                    if(res.lamba_durum == "true" ){
                      var form = document.getElementById('myForm');
                        form.removeEventListener('submit', arguments.callee);
                        form.submit();
                    }
                   
                },
                error: function () {Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");}
            });
        });




        
    </script>




<script>
        function ensurePrefix() {
            var input = document.getElementById("lamba_seri_kod_eski");
            var prefix = "01.034/LM";

            if (!input.value.startsWith(prefix)) {
                input.value = prefix + input.value.slice(prefix.length);
            }
        }

        function updateValue() {
            var input = document.getElementById("lamba_seri_kod_eski");
            var prefix = "01.034/LM";

            if (input.value.length < prefix.length || !input.value.startsWith(prefix)) {
                input.value = prefix + input.value.slice(prefix.length);
            }
        }
    </script>