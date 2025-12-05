
<?php $giris_yapan_k = aktif_kullanici();?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" id="main-sidebar">
    <!-- Brand Logo -->
    <a href="<?=($giris_yapan_k->baslangic_ekrani) ? base_url($giris_yapan_k->baslangic_ekrani) : base_url("anasayfa")?>" class="brand-link" style="text-align: center;border: 9px double #003a79;border-style: revert-layer;background:#0060c7;padding:4px">
      <span style="font-size:26px;color:white;">
        <strong>UG</strong> 
      BUSINESS 
  
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 d-flex">
        <div class="image" style="margin-top: 10px;">
          <img src="<?=$giris_yapan_k->kullanici_resim ? base_url("uploads/").$giris_yapan_k->kullanici_resim : base_url("uploads/default.png")?>" class="img-circle elevation-2" alt="User Image" style="BACKGROUND: #001cab;border: 2px solid white !important;">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="text-transform: uppercase;"><?=$giris_yapan_k->kullanici_ad_soyad?></a>
          <a href="#" class="d-block text-sm"><?=$giris_yapan_k->kullanici_unvan?></a>
        </div>
      </div>


    




<div class="row" style="
    padding-top: 5px;
">
    <div class="col-5" style="
    padding-right: 0;
    padding-left: 0;
">
<a class="btn btn-warning btn-sm" style="     color: white !important;
    background: #2b2b2b57;
    width: 100%;
    font-size: 11px !important;
    font-weight: 700;
    border: 1px solid #5b5b5b;
    padding-left: 4px !important;" href="https://ugbusiness.com.tr/istek/ekle">
                <i class="fas fa-user-cog"></i>
                YENİ DESTEK</a>
        
</div><div class="col" style="padding-left: 3px;
    padding-right: 0;
">
        <a class="btn btn-success btn-sm mb-1" style="background:#2b2b2b57;color:white!important;width: 100%;font-size: 11px!important;padding: 0;padding-top: 4px;padding-bottom: 4px;font-weight: 700;border:1px solid #d1d1d161 !important" href="https://ugbusiness.com.tr/istek">
            
                <i class="fa fa-list"></i> DESTEK TALEPLERİ

                <?php
                $s = get_istek_sayi();
                if($s>0)
                {
?>
 <span class="badge bg-danger"><?=$s?></span>
<?php
                }
                ?>
</a>
        </div></div>





     


<a class="btn btn-success btn-sm mb-1" style="background: #0049a7ad;color:white!important;width: 100%;border: 1px solid #2474ff;" href="<?=base_url("dokuman")?>">
            
                <i class="fa fa-folder"></i> UG - UMEX ARŞİV</a>
              <?php 
              if(aktif_kullanici()->kullanici_id == 7){
                ?>
                 <a class="btn btn-danger btn-sm mb-1" onclick="confirm_stop_system();" style="color:white!important; width:100%;">
            
            <i class="fas fa-exclamation-circle"></i> SİSTEMİ TAMAMEN DURDUR
            <br><span style="opacity:0.5">Yetkili : Uğur ÖLMEZ</span>
          
          </a>
          
                <?php
              }
              ?>
                 <br>

                 <form action="<?=base_url("anasayfa/genel_arama")?>" method="POST">
  <div class="input-group" data-widget="sidebar-search1">

    <input class="form-control form-control-sidebar" style="background:#1d2125;border: 1px solid #4d4d4d;" name="aranan_deger" type="search" placeholder="Hızlı Kayıt Ara..." aria-label="Search">
    <div class="input-group-append">
      <button class="btn btn-sidebar" type="submit" style="background:#1d2125;border: 1px solid #4d4d4d;color: white;">
        <i class="fas fa-search fa-fw"></i>
      </button>
    </div>


  </div>
  </form>
      <!-- SidebarSearch Form -->
     
      <?php // Eğer aktif kullanıcı id'si 1 veya 9 ise aşağıdaki alanı göster ?>
      <?php if(aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 9): ?>
      <div class="input-group mt-2" style="margin-bottom: 10px;">
        <input id="sidebar-menu-filter" class="form-control form-control-sidebar" style="background:#1d2125;border: 1px solid #4d4d4d;color: white;" type="text" placeholder="Menü Ara..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar" type="button" style="background:#1d2125;border: 1px solid #4d4d4d;color: white;">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
      <?php endif; ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false" id="sidebar-menu-list">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
  

               <li class="nav-header">HIZLI ERİŞİM</li>
            
            


               <li class="nav-item">
                <a href="<?=base_url("anasayfa")?>" class="nav-link">
                <i class="nav-icon 	fas fa-home text-primary" style="font-size:13px"></i>
                <p style="font-size:15px">
                    ANASAYFA
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("izin/talebi_olustur")?>" class="nav-link">
                <i class="nav-icon fas fa-calendar-plus text-success" style="font-size:13px"></i>
                <p style="font-size:15px">
                    İZİN TALEBİ OLUŞTUR
                </p>
                </a>
            </li>
         

 <?php 
 
 if($giris_yapan_k->kullanici_id == 1 || $giris_yapan_k->kullanici_id == 4 || $giris_yapan_k->kullanici_id == 6)
 {
   ?>
   <li class="nav-item">
     <a href="<?=base_url("abonelik")?>" class="nav-link">
     <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      ABONELİKLER
     </p>
     </a>
 </li>
   <?php
 }
 
 ?>


<li class="nav-item">
     <a href="<?=base_url("anasayfa/rehber")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      <?php 
      if($this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 7 || $this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 4){
        echo "PERSONEL";
      }else{
        echo "KURUMSAL İLETİŞİM";
      }
      ?>
     
     </p>
     </a>
 </li>
          



<?php
  if($this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 7 || $this->session->userdata('aktif_kullanici_id') == 1){
      

?>
 <li class="nav-item">
     <a href="<?=base_url("sablon/index/26")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      <?php 
      echo "ŞİRKET İÇİ KURALLAR";
         
      ?>
     
     </p>
     </a>
 </li>
     <li class="nav-item">
            <a href="<?=base_url("zimmet/fabrika_zimmet")?>" class="nav-link">
            <i class="nav-icon fas fa-charging-station text-danger" style="font-size:13px"></i>
              <p style="font-size:15px">
                FABRİKA ZİMMET
              </p>
            </a>
  </li>

<?php } ?>



<?php
  if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 37|| $this->session->userdata('aktif_kullanici_id') == 8){
      

?>
 <li class="nav-item">
     <a href="<?=base_url("uretim_planlama")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      <?php 
      echo "ÜRETİM PLANLAMA";
        
      ?>
     
     </p>
     </a>
 </li>
          
<?php } ?>

<?php
  if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 4){
      

?>
 <li class="nav-item">
     <a href="<?=base_url("yazilim")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      <?php 
      echo "YAPILACAK İŞLER";
        
      ?>
     
     </p>
     </a>
 </li>
          
<?php } ?>


<?php
  if(goruntuleme_kontrol("depo_birinci_onay") || goruntuleme_kontrol("depo_giris_cikis") || $this->session->userdata('aktif_kullanici_id') == 1305 || $this->session->userdata('aktif_kullanici_id') == 11 || $this->session->userdata('aktif_kullanici_id') == 8 || $this->session->userdata('aktif_kullanici_id') == 9){


?>
 <li class="nav-item">
     <a href="<?=base_url("depo_onay")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      <?php 
      echo "DEPO GİRİŞ ÇIKIŞ";
        
      ?>
     
     </p>
     </a>
 </li>
          
<?php } ?>



<?php
  if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 4 ||   $this->session->userdata('aktif_kullanici_id') == 9||   $this->session->userdata('aktif_kullanici_id') == 7 ||   $this->session->userdata('aktif_kullanici_id') == 8){


?>
 <li class="nav-item">
     <a href="<?=base_url("cihaz/showrooms")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px;color:orange">
      <?php 
      echo "SHOWROOM CİHAZLAR";
        
      ?>
     
     </p>
     </a>
 </li>
          
 <li class="nav-item">
     <a href="<?=base_url("api/kart_okutmayan_personeller_view")?>"   class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px;font-weight:600;color:orange">
      <?php 
      echo "MESAİ GENEL BAKIŞ";
        
      ?>
     
     </p>
     </a>
 </li>
<?php } ?>

  <?php if(goruntuleme_kontrol("izinleri_yonet")) : ?>
           
 <li class="nav-item">
     <a href="<?=base_url("izin")?>"  class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px;font-weight:600;color:red">
      <?php 
      echo "İZİN / MESAİ YÖNETİMİ";
        
      ?>
     
     </p>
     </a>
 </li>

  <?php endif; ?>
   



<?php
  if($this->session->userdata('aktif_kullanici_id') == 1338 ||   $this->session->userdata('aktif_kullanici_id') == 9){


?>
 <li class="nav-item">
     <a href="<?=base_url("cihaz/tumcihazlar")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px;color:#00fb00">
      <?php 
      echo "TÜM CİHAZLAR";
        
      ?>
     
     </p>
     </a>
 </li>
          
<?php } ?>
            <li class="nav-header">MODÜLLER</li>
         <?php if($giris_yapan_k->kullanici_id == 40 || $giris_yapan_k->kullanici_id == 11 || $giris_yapan_k->kullanici_id == 12): ?>
    
 <li class="nav-item">
     <a href="<?=base_url("zimmet/kullanici_envanter_liste")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      <?php 
      echo "STOK ENVANTER";
        
      ?>
     
     </p>
     </a>
 </li>
  <li class="nav-item">
                <a href="<?=base_url("siparis/haftalik_kurulum_plan")?>" onclick="waiting('Haftalık Kurulum Planı');" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Haftalık Kurulum Planı
                </p>
                </a>
            </li>
 
  <?php endif; ?>

            <li class="nav-item d-none">
                <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon fas fa-users text-orange" style="font-size:13px"></i>
                <p style="font-size:15px">
                    İzin
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>


                <ul class="nav nav-treeview" style="border-left: 0;">
               
                <li class="nav-item">
                    <a href="<?=base_url("izin/onay_bekleyenler")?>" onclick="waiting('İzin Taleplerim');" style="border-left: 0;" class="nav-link">
                    <i class="far fa-list-alt nav-icon text-default" style="font-size:13px"></i>
                     
                    <p style="font-size:15px">İzin Taleplerim</p>
                    </a>
                    
                  </li> 
             
                 
                  <li class="nav-item">
                    <a href="<?=base_url("izin/add")?>"  onclick="waiting('Yeni İzin Talebi');" style="border-left: 0;" class="nav-link">
                      <i class="fa fa-plus nav-icon text-default" style="font-size:13px"></i>
                      
                      <p style="font-size:15px">Yeni İzin Talebi</p>
                    </a>
                    
                  </li> 

                  <li class="nav-item">
                    <a href="<?=base_url("izin/onay_bekleyenler")?>"  onclick="waiting('Onay Bekleyen İzinler');" style="border-left: 0;" class="nav-link">
                      <i class="far fa-list-alt nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Onay Bekleyenler</p>
                    </a>
                    
                  </li> 
                  
                </ul>
               
            </li>




            

            <li class="nav-item d-none">
                <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon fas fa-file text-red" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Bordro
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>


                <ul class="nav nav-treeview" style="border-left: 0;">
               
                <li class="nav-item">
                    <a href="<?=base_url("bordro")?>" onclick="waiting('Bordrolar');" style="border-left: 0;" class="nav-link">
                    <i class="far fa-list-alt nav-icon text-default" style="font-size:13px"></i>
                     
                      <p style="font-size:15px">Bordrolar</p>
                    </a>
                    
                  </li> 
             
                 
                  <li class="nav-item">
                    <a href="<?=base_url("bordro/add")?>"  onclick="waiting('Yeni Bordro Yükle');" style="border-left: 0;" class="nav-link">
                      <i class="fa fa-plus nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Yeni Bordro Yükle</p>
                    </a>
                    
                  </li> 
 
                  
                </ul>
               
            </li>








            <?php if(goruntuleme_kontrol("cihazlari_goruntule") && ($giris_yapan_k->kullanici_id != 14)) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-charging-station text-danger" style="font-size:13px"></i>
              <p style="font-size:15px">
                MÜŞTERİ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
<?php
  if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 1330 || $this->session->userdata('aktif_kullanici_id') == 8){


?>
 <li class="nav-item">
     <a href="<?=base_url("cihaz/rgmedikalindex")?>" style="background: #004e0f;" class="nav-link">
    
     <i class="far fa-circle nav-icon " style="font-size:13px"></i>
    
     <p style="font-size:15px">
      <?php 
      echo "RG MEDİKAL";
        
      ?>
     
     </p>
     </a>
 </li>
 
          
<?php } ?>

            <li class="nav-item">
                <a href="<?=base_url("cihaz/cihaz_tanimlama_view")?>" onclick="waiting('Yeni Cihaz Tanımla');" class="nav-link">
                <i class="fas fa-plus-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Yeni Cihaz Tanımla
                </p>
                </a>
            </li>

            <?php 
            
            if($giris_yapan_k->kullanici_id == 11)
            {
              ?>
              <li class="nav-item">
                <a href="<?=base_url("musteri")?>" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Tüm Müşteriler
                </p>
                </a>
            </li>
              <?php
            }
            
            ?>

            <li class="nav-item">
                <a href="<?=base_url("cihaz/tum-cihazlar")?>" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Tüm Cihazları Görüntüle
                </p>
                </a>
            </li>

<li class="nav-item">
                <a href="<?=base_url("cihaz/tum-cihazlar?durum=iade")?>" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                İade Cihazları Görüntüle
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("cihaz/tum-cihazlar?durum=takas")?>" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Takas Cihazları Görüntüle
                </p>
                </a>
            </li>

            <?php if(goruntuleme_kontrol("borclu_cihazlari_goruntule")) : ?>
            <li class="nav-item">
                <a href="<?=base_url("cihaz/borclu_cihazlar")?>" class="nav-link">
                
                <i class="far fa-circle nav-icon text-danger" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Borçlu Müşteriler
                </p>
                </a>
            </li>

           

            <?php endif; ?>
          

         
          

            </ul>
          </li>
<?php endif; ?>















            <?php if(goruntuleme_kontrol("stok_yonetim")):?>
          
          <li class="nav-item">
              <a href="<?=base_url("stok/giris_stok_kayitlari")?>"  class="nav-link">
              <i class="fa fa-list nav-icon text-danger" style="font-size:13px"></i>
             
              <p style="font-size:15px">
                STOK
              </p>
              
              </a>
          </li>
          
          <?php endif; ?>

            <?php if(goruntuleme_kontrol("arac_duzenle") || goruntuleme_kontrol("sadece_kendi_aracini_yonet")):?>
          
          <li class="nav-item">
              <a href="<?=base_url("arac")?>"  class="nav-link">
              <i class="nav-icon 	fas fa-car text-success" style="font-size:13px"></i>
             
              <p style="font-size:15px">
                ŞİRKET ARAÇLARI
              </p>
           
              </a>
          </li>
          
          <?php endif; ?>




        



          <?php 
                  if($giris_yapan_k->kullanici_id == 7 || $giris_yapan_k->kullanici_id == 9)
{
?>
 <li class="nav-item d-none">
                    <a href="<?=base_url("musteri")?>"  style="border-left: 0;" class="nav-link">
                    <i class="nav-icon fas fa-users text-orange" style="font-size:13px"></i>
                      <p style="font-size:15px">Müşteriler</p>
                    </a>
                    
                  </li>
<?php
}else{
?>
<?php 
if(!goruntuleme_kontrol("musteri_ekle") && goruntuleme_kontrol("merkezleri_goruntule")){
?>
 <li class="nav-item">
                    <a href="<?=base_url("merkez")?>" onclick="waiting('Merkezleri Görüntüle');" style="border-left: 0;" class="nav-link">
                    <i class="far fa-building nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Kargo Etiketi</p>
                    </a>
                    
                  </li> 
                

                  <li class="nav-item">
                    <a href="<?=base_url("servis/servis_cihaz_sorgula_view")?>"   style="border-left: 0;" class="nav-link">
                    <i class="far fa-building nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Atış Yükleme</p>
                    </a>
                    
                  </li> 


                  
<?php
}
?>
  <?php 
                  if(goruntuleme_kontrol("ilbazli_tum_cihazlari_goruntule")){
                    ?>
                       <li class="nav-item">
                    <a href="<?=base_url("cihaz/tumcihazlarilbazli")?>"   style="border-left: 0;" class="nav-link">
                    <i class="far fa-building nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">İL BAZLI CİHAZLAR</p>
                    </a>
                    
                  </li> 

                    <?php
                  }
                  
                  ?>
                  

<?php if(goruntuleme_kontrol("musteri_ekle") && goruntuleme_kontrol("musterileri_goruntule") || goruntuleme_kontrol("merkezleri_goruntule")) : ?>
            <li class="nav-item <?=($giris_yapan_k->kullanici_id == 1 || $giris_yapan_k->kullanici_id == 14 || $giris_yapan_k->kullanici_id == 12) ? "" : "d-none" ?>">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users text-orange" style="font-size:13px"></i>
                <p style="font-size:15px">
                    MÜŞTERİ
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>


                <ul class="nav nav-treeview <?=($giris_yapan_k->kullanici_id == 1 || $giris_yapan_k->kullanici_id == 14 || $giris_yapan_k->kullanici_id == 12) ? "" : "d-none" ?>" style="border-left: 0;">
          
                <li class="nav-item">
                    <a href="<?=base_url("cihaz")?>"  style="border-left: 0;" class="nav-link">
                      <i class="far fa-list-alt nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Cihazlari Görüntüle</p>
                    </a>
                    
                  </li>

                  <li class="nav-item">
                    <a href="<?=base_url("musteri")?>"  style="border-left: 0;" class="nav-link">
                      <i class="far fa-list-alt nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Müşterileri Görüntüle</p>
                    </a>
                    
                  </li>
                  
                  <?php 
                  if($giris_yapan_k->kullanici_id != 7 && $giris_yapan_k->kullanici_id != 9)
{
  ?>
  <li class="nav-item">
                    <a href="<?=base_url("merkez")?>" onclick="waiting('Merkezleri Görüntüle');" style="border-left: 0;" class="nav-link">
                    <i class="far fa-building nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Merkezleri Görüntüle</p>
                    </a>
                    
                  </li> 

             
            <li class="nav-item d-none">
                    <a href="<?=base_url("merkez/index/0/1")?>" onclick="waiting('Merkezleri Görüntüle');" style="border-left: 0;" class="nav-link">
                    <i class="far fa-list-alt nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Merkezler (Eksik Bilgi)</p>
                    </a>
                    
                  </li> 

 

  <?php
}
                  ?>
                
                  



                
                </ul>
               
            </li>
 <?php endif; ?>
 
<?php
}
  ?>




            

  
            <?php if(goruntuleme_kontrol("talep_havuzu_goruntule")) : ?>
            <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-people-arrows text-red" style="font-size:13px"></i>
              <p style="font-size:15px">
                TALEP (ADMİN)
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           <?php 
           if($giris_yapan_k->kullanici_id == 1 || $giris_yapan_k->kullanici_id == 4){
?>
 <li class="nav-item">
                <a href="<?=base_url("talep")?>" onclick="waiting('Talep Havuzu');" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Talep Havuzu
                </p>
                </a>
            </li>
          
<?php
           }

           
           ?>
              <li class="nav-item">
                <a href="<?=base_url("rut")?>" onclick="waiting('Rut Planlama');" class="nav-link">
                <i class="fas fa-map-signs nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Rut Planlama
                </p>
                </a>
            </li>
            <li class="nav-item d-none">
                <a href="<?=base_url("talep/tum-kayitlar")?>" onclick="waiting('Talep Tüm Kayıtlar');" class="nav-link">
                <i class="far fa-file-archive nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Talep Tüm Kayıtlar
                </p>
                </a>
            </li>

            

 <li class="nav-item">
                <a href="<?=base_url("talep/yonlendirmeler/1")?>" onclick="waiting('Yönlendirilen Talepler');" class="nav-link">
                <i class="far fa-file-archive nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                 Yönlendirilen Talepler
                </p>
                </a>
            </li>

           

            <li class="nav-item">
                <a href="<?=base_url("talep/bekleyen_rapor")?>"  class="nav-link">
                <i class="nav-icon 	fas fa-user-clock text-warning" style="font-size:13px"></i>
               
                <p style="font-size:15px">
                  Talep Uyarı Sms Gönder
                </p>
                </a>
            </li>
 

            
          

            </ul>
          </li>

          <?php endif; ?>


        






          <?php if(goruntuleme_kontrol("siparis_onay_1")) : ?>
        
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-people-arrows text-primary" style="font-size:13px"></i>
              <p style="font-size:15px">
                TALEP
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <?php if($giris_yapan_k->kullanici_id != 1341) : ?>
        
            <li class="nav-item">
                <a href="<?=base_url("urun/satici_limit/1")?>" onclick="waiting('Fiyat Limitleri');" class="nav-link text-warning">
                <i class="far fa-circle nav-icon text-warning" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Fiyat Limitleri
                </p>
                </a>
            </li>
<?php endif; ?>
            <li class="nav-item">
                <a href="<?=base_url("talep/ekle")?>" onclick="waiting('Yeni Talep Ekle');" class="nav-link">
                <i class="fas fa-plus nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Yeni Talep Ekle
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("rut/rut_tanimlari")?>" class="nav-link">
                <i class="far fa-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Rut Listesi
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("tum-taleplerim")?>" onclick="waiting('Bekleyen Talepler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Tüm Taleplerim
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("bekleyen-talepler")?>" onclick="waiting('Bekleyen Talepler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Bekleyen Talepler
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("satis-talepler")?>" onclick="waiting('Satış Yapılan Talepler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
              Satış
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("bilgi-verildi-talepler")?>" onclick="waiting('Bilgi Verilen Talepler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Bilgi Verildi
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("musteri-memnuniyeti-talepler")?>" onclick="waiting('Müşteri Memnuniyet Talepler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Müşteri Memnuniyeti
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("donus-yapilacak-talepler")?>" onclick="waiting('Dönüş Yapılacak Talepler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Dönüş Yapılacak
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("olumsuz-talepler")?>" onclick="waiting('Olumsuz Talepler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Olumsuz
                </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?=base_url("numara-hatali-talepler")?>" onclick="waiting('Numara Hatalı');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
               Numara Hatalı
                </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?=base_url("tekrar-aranacak-talepler")?>" onclick="waiting('Tekrar Aranacak');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Tekrar Aranacak
                </p>
                </a>
            </li>
   <li class="nav-item <?=($giris_yapan_k->kullanici_id != 60) ? "d-none":""?>">
                <a href="<?=base_url("talep/yonlendirilen_talepler")?>" onclick="waiting('Tekrar Aranacak');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Yönlendirilen Talepler
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("musteri/karaliste_view")?>" onclick="waiting('Kara Liste');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                KARA LİSTE                </p>
                </a>
            </li>
            </ul>
          </li>
       

          
          <?php endif; ?>



<?php if($giris_yapan_k->kullanici_id != 11): ?>

<?php if($giris_yapan_k->kullanici_id != 40): ?>
          <!-- Eski SİPARİŞ Dropdown - Gizlendi -->
          <li class="nav-item" style="display:none;">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-cart-arrow-down text-warning" style="font-size:13px"></i>
              <p style="font-size:15px">
                SİPARİŞ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <?php if(goruntuleme_kontrol("satis_limitlerini_yonet")) : ?>
           

            <li class="nav-item">
                <a href="<?=base_url("fiyat_limit")?>" class="nav-link">
                <i class="far fa-check-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Satış Limitleri 
                </p>
                </a>
            </li>

            <?php endif; ?>
            <li class="nav-item d-none">
                <a href="<?=base_url("siparis/merkez")?>" onclick="waiting('Yeni Sipariş Ekle');" class="nav-link">
                <i class="fa fa-plus nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Yeni Sipariş Ekle
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("siparis/hizli_siparis_olustur_view")?>" onclick="waiting('Hızlı Sipariş Oluştur');" class="nav-link">
                <i class="fa fa-plus nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Hızlı Sipariş Oluştur
                </p>
                </a>
            </li>
         


            <?php if(goruntuleme_kontrol("siparis_beklemeye_al")) : ?>
           

            <li class="nav-item">
                <a href="<?=base_url("onay-bekleyen-siparisler?filter=2")?>" onclick="waiting('Onay Bekleyen Siparişler');" class="nav-link">
                <i class="far fa-check-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Onay Bekleyen Siparişler
                </p>
                </a>
            </li>

            <?php endif; ?>

            <?php if(!goruntuleme_kontrol("siparis_beklemeye_al")) : ?>
           

           <li class="nav-item">
               <a href="<?=base_url("onay-bekleyen-siparisler")?>" onclick="waiting('Onay Bekleyen Siparişler');" class="nav-link">
               <i class="far fa-check-circle nav-icon" style="font-size:13px"></i>
               <p style="font-size:15px">
               Onay Bekleyen Siparişler
               </p>
               </a>
           </li>

           <?php endif; ?>


            <li class="nav-item">
                <a href="<?=base_url("tum-siparisler")?>" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Tüm Siparişler
                </p>
                </a>
            </li>

            <!-- SATIŞLAR Linki -->
            <li class="nav-item">
                <a href="<?=base_url("siparis/siparisler_restore")?>" onclick="waiting('Siparişler Restore');" class="nav-link">
                <i class="nav-icon 	fas fa-cart-arrow-down text-warning" style="font-size:13px"></i>
                <p style="font-size:15px">
                SATIŞLAR
                </p>
                </a>
            </li>
            <?php if($this->session->userdata('aktif_kullanici_id') == 1) : ?>
            <li class="nav-item">
                <a href="<?=base_url("siparis/demo_on_izleme")?>" onclick="waiting('Demo Ön İzleme');" class="nav-link">
                <i class="fas fa-th-large nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Demo Ön İzleme
                </p>
                </a>
            </li>
            <?php endif; ?>
          
            <li class="nav-item">
                <a href="<?=base_url("siparis/haftalik_kurulum_plan")?>" onclick="waiting('Haftalık Kurulum Planı');" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Haftalık Kurulum Planı
                </p>
                </a>
            </li>


            <?php if(goruntuleme_kontrol("iptal_edilen_siparisleri_goruntule")) : ?>
        
        <li class="nav-item">
     <a href="<?=base_url("cihaz/iptal_edilen_siparisler")?>" style="border-left: 0;" class="nav-link">
       <i class="fa fa-list nav-icon" style="font-size:13px"></i>
       <p style="font-size:15px;">İptal Edilenler</p>
       
     </a>
     
   </li> 

        <?php endif; ?>
 <?php endif; ?>

 <?php if(goruntuleme_kontrol("sms_degerlendirme_raporunu_goruntule")) : ?>
        
        <li class="nav-item">
     <a href="<?=base_url("siparis/degerlendirme_rapor")?>" style="border-left: 0;" class="nav-link">
       <i class="fa fa-envelope nav-icon" style="font-size:13px"></i>
       <p style="font-size:15px;">SMS Sonuçları</p>
       
     </a>
     
   </li> 

        <?php endif; ?>





        


        
            </ul>
          </li>




          <?php endif; ?>



          
          


          


<?php if(goruntuleme_kontrol("trendyol_siparislerini_goruntule")) : ?>
        

   


        <li class="nav-item">
     <a href="<?=base_url("trendyol")?>" style="border-left: 0;" class="nav-link">
    <img style="margin-left: 14px; margin-right: 7px;" src="https://developers.trendyol.com/img/favicon.ico"></img>
       <p style="font-size:15px;">TRENDYOL YÖNETİM</p>
       
     </a>
     
   </li> 

        <?php endif; ?>


         


 











          <?php if(goruntuleme_kontrol("egitim_bilgilerini_goruntule") || goruntuleme_kontrol("sertifika_kontrol_onayla")) : ?>
            <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-award text-warning" style="font-size:13px"></i>
              <p style="font-size:15px">
                SERTİFİKA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="<?=base_url("cihaz")?>" onclick="waiting('Yeni Eğitim Ekle');" class="nav-link">
                <i class="fa fa-plus nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Yeni Eğitim Ekle
                </p>
                </a>
            </li>



            <li class="nav-item">
                <a href="<?=base_url("sertifika/onay-bekleyen-sertifikalar")?>" onclick="waiting('Onaylanacak Sertifikalar');" class="nav-link">
                <i class="far fa-check-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Onaylanacak Sertifikalar
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("sertifika/uretilecek-sertifikalar")?>" onclick="waiting('Üretilecek Sertifikalar');" class="nav-link">
                <i class="far fa-id-card nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Üretilecek Sertifikalar
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("sertifika/uretilecek-kalemler")?>" onclick="waiting('Üretilecek Kalemler');" class="nav-link">
                <i class="fas fa-pen-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Kalemler
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("sertifika/kargo-bekleyen-sertifikalar")?>" onclick="waiting('Kargo Bekleyen Sertifikalar');" class="nav-link">
                <i class="fas fa-truck-loading nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Kargo Bekleyenler
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("egitim")?>" onclick="waiting('Tüm Eğitimler');" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Tüm Eğitimler
                </p>
                </a>
            </li>

            </ul>
          </li>



          <?php endif; ?>





          <?php if($giris_yapan_k->kullanici_id == 14) : ?>
        
        <li class="nav-item">
     <a href="<?=base_url("servis")?>" style="border-left: 0;" class="nav-link">
       <i class="fa fa-list nav-icon text-success" style="font-size:13px"></i>
       <p style="font-size:15px">Cihaz Teknik Servis</p>
     </a>
     
   </li> 

        <?php endif; ?>
        


        



          <?php if(goruntuleme_kontrol("isleme_alinan_basliklari_goruntule")) : ?>
        


          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-users-cog text-success" style="font-size:13px"></i>
              <p style="font-size:15px">
                TEKNİK SERVİS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">


            <?php if(goruntuleme_kontrol("servis_goruntule")) : ?>
        
        <li class="nav-item">
     <a href="<?=base_url("servis")?>" style="border-left: 0;" class="nav-link">
       <i class="fa fa-list nav-icon text-success" style="font-size:13px"></i>
       <p style="font-size:15px">Cihaz Teknik Servis</p>
     </a>
     
   </li> 

        <?php endif; ?>


            <li class="nav-item">
                <a href="<?=base_url("baslik/isleme_alinan_basliklar")?>" onclick="waiting('İşleme Alınan Başlıklar');" class="nav-link">
                <i class="fa fas fa-retweet nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                İşleme Alınan Başlıklar
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("baslik/tamamlanan_basliklar")?>" onclick="waiting('İşleme Alınan Başlıklar');" class="nav-link">
                <i class="fa fas fa-check nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Tamamlanan Başlıklar
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("cihaz/tum-basliklar")?>" onclick="waiting('Başlıkları Görüntüle');" class="nav-link">
                <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Başlık Tanımları
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("baslik/baslik_havuz_tanimla_view")?>" onclick="waiting('Yeni Başlık QR (Üretim)');" class="nav-link">
                <i class="fa fa-plus-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                  Yeni Başlık QR (Üretim)
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("baslik/baslik_havuz_liste_view")?>" onclick="waiting('Başlık Havuzu (Yeniler)');" class="nav-link">
                <i class="fa fa-list nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                  Başlık Havuzu (Yeniler)
                </p>
                </a>
            </li>

 <li class="nav-item">
                <a href="<?=base_url("stok/urungonderim")?>"   class="nav-link">
                <i class="fa fa-list nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px;color:orange">
                 HAVA HORT. GÖNDERİM
                </p>
                </a>
            </li>
              <li class="nav-item">
                <a href="<?=base_url("baslik/iade_etiket")?>" class="nav-link">
                <i class="fa fa-list nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                  İADE ETİKETİ YAZDIR
                </p>
                </a>
            </li>
            </ul>
          </li>





          <?php endif; ?>


          <?php if(goruntuleme_kontrol("cihaz_havuz_duzenle")) : ?>
        




          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-users-cog text-success" style="font-size:13px"></i>
              <p style="font-size:15px">
                ÜRETİM
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            
            <li class="nav-item">
                <a href="<?=base_url("cihaz/cihaz_havuz_tanimla_view")?>" onclick="waiting('Yeni Başlık QR (Üretim)');" class="nav-link">
                <i class="fa fa-plus-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                  Yeni Cihaz Kayıt
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("cihaz/cihaz_havuz_liste_view")?>" onclick="waiting('Başlık Havuzu (Yeniler)');" class="nav-link">
                <i class="fa fa-list nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                  Cihaz Havuzu (Stok)
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?=base_url("baslik/baslik_havuz_tanimla_view")?>" onclick="waiting('Yeni Başlık QR (Üretim)');" class="nav-link">
                <i class="fa fa-plus-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                  Yeni Başlık QR (Üretim)
                </p>
                </a>
            </li>
            
            </ul>
          </li>

          <?php endif; ?>






          <?php if(goruntuleme_kontrol("demirbas_goruntule")) : ?>
        




           

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box text-primary" style="font-size:13px"></i>
              <p style="font-size:15px">
              ENVANTER
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
            
            <li class="nav-item">
         <a href="<?=base_url("demirbas/ekle/1")?>" style="border-left: 0;" class="nav-link">
           <i class="fa fa-plus nav-icon text-success" style="font-size:13px"></i>
           <p style="font-size:15px">Yeni Envanter Ekle</p>
         </a>
         
       </li> 
            
                <li class="nav-item">
                    <a  style="border-left: 0;" href="<?=base_url("demirbas")?>" class="nav-link">
                      <i class="far fa-file-alt nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Tüm Envanterler</p>
                    </a>
                    
                  </li> 
         
            



               
              
            </ul>
          </li>



 <?php endif; ?>







          
          <?php if(goruntuleme_kontrol("muhasebe_rapor_goruntule")) : ?>
            <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-people-arrows text-red" style="font-size:13px"></i>
              <p style="font-size:15px">
                RAPORLAR
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

               
              <li class="nav-item">
                <a href="<?=base_url("kullanici/muhasebe_rapor/".date("m"))?>"  class="nav-link">
                <i class="far fa-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Muhasebe Rapor
                </p>
                </a>
            </li>
           
            

              <li class="nav-item d-none">
                <a href="<?=base_url("kullanici/kullanici_detay_rapor")?>" onclick="waiting('Talep Raporu');" class="nav-link">
                <i class="far fa-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Kullanıcı Analiz
                </p>
                </a>
            </li>
           
            <li class="nav-item">
                <a href="<?=base_url("talep/rapor")?>" onclick="waiting('Talep Raporu');" class="nav-link">
                <i class="far fa-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Talep Analiz
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("talep/yogunluk_haritasi")?>" onclick="waiting('Talep Raporu');" class="nav-link">
                <i class="far fa-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Talep Yoğunluk Haritası
                </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?=base_url("talep/bekleyen_rapor_list")?>" onclick="waiting('Yönlendirilen Talepler');" class="nav-link">
                <i class="far fa-circle nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                 Bekleyen Talepler
                </p>
                </a>
            </li>

            <?php if(goruntuleme_kontrol("garanti_sorgulayanlari_goruntule")) : ?>
          
          <li class="nav-item">
              <a href="<?=base_url("cihaz/garanti_sorgulayanlar")?>"  class="nav-link">
            
              <i class="far fa-circle nav-icon" style="font-size:13px"></i>
              <p style="font-size:15px">
             Garanti Sorgulayanlar
              </p>
              </a>
          </li>
          
          <?php endif; ?>
            <li class="nav-item d-none">
                <a href="<?=base_url("cihaz/rapor")?>" onclick="waiting('Cihaz Raporu');" class="nav-link">
                <i class="far fa-id-card nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Cihaz Raporu
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("cihaz/cihaz_harita")?>" onclick="waiting('Cihaz Raporu');" class="nav-link">
                <i class="far fa-id-card nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Cihaz Raporu (Harita)
                </p>
                </a>
            </li>
          <li class="nav-item">
                <a href="<?=base_url("cihaz/rg_medikal_cihaz_harita")?>" onclick="waiting('Cihaz Raporu');" class="nav-link">
                <i class="far fa-id-card nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                RG Cihaz Raporu (Harita)
                </p>
                </a>
            </li>
           


          <li class="nav-item">
     <a href="<?=base_url("siparis/degerlendirme_rapor")?>" style="border-left: 0;" class="nav-link">
       <i class="fa fa-list nav-icon " style="font-size:13px"></i>
       <p style="font-size:15px;"> SMS Sonuçları</p>
        
     </a>
     
   </li> 


<?php 

if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 7 || $this->session->userdata('aktif_kullanici_id') == 9){
?>
 <li class="nav-item">
     <a href="<?=base_url("atis")?>" style="border-left: 0;" class="nav-link">
       <i class="fa fa-list nav-icon " style="font-size:13px"></i>
       <p style="font-size:15px;"> Atış Raporu</p>
        
     </a>
     
   </li> 

<?php

}
?>
 


  </ul>
  </li>

  <?php endif; ?>




<style>
    .yanipsonenyazimodul2 {
      animation: blinker2 1s linear infinite;
       
  
      } @keyframes blinker2 {  
      50% { opacity: 0; }
      }
  </style>




<?php if($giris_yapan_k->kullanici_id != 40): ?>
          <li class="nav-header">ENTEGRASYON</li>
  <?php endif; ?>
<?php if(goruntuleme_kontrol("arvento_goruntuless")) : ?>
  <li class="nav-item">
    <a href="https://web.arvento.com/ui/shareVehiclesLink/ShareVehiclesLink.aspx?g=8fb0d168d591452eIB6zmbsR5u2EXLKmYgtgEg==9e0fa12eeeb2c989&ed=20250306093044&sd=20250106093055&lc=tr&ln=0" target="_blank" class="nav-link">
    <i class="nav-icon 	fas fa-car text-primary" style="font-size:13px"></i>
    <p style="font-size:15px">
        ARVENTO
    </p>
    </a>
</li>
  <?php endif; ?>

 

         




          
             



        


 
            <?php if(goruntuleme_kontrol("calisma_plani_goruntule")) : ?>
            <li class="nav-item">
                <a href="<?=base_url("calisma_plan")?>" class="nav-link">
                <i class="nav-icon 	fas fa-clock text-success" style="font-size:13px"></i>
                <p style="font-size:15px">
                    ÇALIŞMA PLANLAMA
                </p>
                </a>
            </li>
 

            <?php endif; ?>
          


         


            <?php if(goruntuleme_kontrol("sadece_kendi_teklif_formlarini_goruntule") || goruntuleme_kontrol("tum_teklif_formlarini_goruntule")) : ?>
          
            <li class="nav-item">
                <a href="<?=base_url("teklif_form")?>"  class="nav-link">
                 <i class="far fa-circle nav-icon text-success" style="font-size:13px"></i>
                <p style="font-size:15px">
                  TEKLİF FORMLARI
                </p>
                </a>
            </li>
            
            <?php endif; ?>



            
            <?php if(goruntuleme_kontrol("kapi_yonetim")) : ?>
          
          <li class="nav-item">
              <a href="<?=base_url("kapi")?>"  class="nav-link">
               <i class="fas fa-door-open nav-icon text-danger" style="font-size:13px"></i>
              <p style="font-size:15px">
                KAPI
              </p>
              </a>
          </li>
          
          <?php endif; ?>

          <?php if(goruntuleme_kontrol("arvento_goruntule")) : ?>
          
          <li class="nav-item">
              <a href="<?=base_url("arvento")?>"  class="nav-link">
               <i class="fas fa-truck nav-icon text-warning" style="font-size:13px"></i>
              <p style="font-size:15px">
                ARVENTO
            
              </p>
              </a>
          </li>
          
          <?php endif; ?>

<?php if(goruntuleme_kontrol("onemli_gun_yonetimi")) : ?>
          
          <li class="nav-item">
              <a href="<?=base_url("onemli_gun")?>"  class="nav-link">
               <i class="fas fa-calendar nav-icon text-primary" style="font-size:13px"></i>
              <p style="font-size:15px">
                ÖNEMLİ GÜNLER
              </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="<?=base_url("onemli_gun/index_etkinlik")?>"  class="nav-link">
               <i class="fas fa-calendar nav-icon text-primary" style="font-size:13px"></i>
              <p style="font-size:15px">
                YAKLAŞAN ETKİNLİKLER
                
              </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="<?=base_url("paylasim")?>"  class="nav-link">
               <i class="fas fa-calendar nav-icon text-primary" style="font-size:13px"></i>
              <p style="font-size:15px">
                KAMPANYALAR
                
              </p>
              </a>
          </li>
          <?php endif; ?>

          <li class="nav-item d-none">
                <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon fas fa-user text-orange" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Personel
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>


                <ul class="nav nav-treeview" style="border-left: 0;">
                  <li class="nav-item">
                    <a href="<?=base_url("kullanici/list_boxed")?>" style="border-left: 0;" class="nav-link">
                      <i class="fa fa-users nav-icon text-default" style="font-size:13px"></i>
                      <p style="font-size:15px">Personelleri Görüntüle</p>
                    </a>
                    
                  </li> 

                 

                   
                </ul>
            </li>






            <li class="nav-item d-none">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-bullhorn text-success" style="font-size:13px"></i>
              <p style="font-size:15px">
                Duyuru
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=base_url("duyuru/ekle")?>" class="nav-link">
                <i class="fas fa-plus nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Yeni Duyuru Ekle
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("duyuru")?>" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Duyuruları Görüntüle
                </p>
                </a>
            </li>
     
             
            </ul>
          </li>
 


          <li class="nav-item d-none">
            <a href="#" class="nav-link">
            <i class="nav-icon 	fa fa-ticket-alt text-warning" style="font-size:13px"></i>
              <p style="font-size:15px">
                Banner
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=base_url("banner/ekle")?>" class="nav-link">
                <i class="fas fa-plus nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Yeni Banner Ekle
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("banner")?>" class="nav-link">
                <i class="fa fa-list-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                Bannerları Görüntüle
                </p>
                </a>
            </li>
     
             
            </ul>
          </li>

 








 <li class="nav-item d-none">
                <a href="<?=base_url("netgsm/santral")?>" class="nav-link">
                <i class="fa fa-phone nav-icon text-primary" style="font-size:13px"></i>
                <p style="font-size:15px">
                NetGSM Santral
                </p>
                </a>
            </li>











          

            <?php if(goruntuleme_kontrol("sistem_ayar_duzenle")) : ?>

          <li class="nav-header">SİSTEM</li>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog text-warning"></i>
              <p style="font-size:15px">
                SİSTEM YÖNETİMİ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?=base_url("kullanici")?>" class="nav-link">
                <i class="fa fa-users nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Kullanıcılar
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("dogum_gunu")?>" class="nav-link">
                <i class="fa fa-calendar-check nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Doğum Günü Bildirimleri
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("sms_templates")?>" class="nav-link">
                <i class="fas fa-sms nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    SMS Metinleri
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("kullanici-yetkileri")?>" class="nav-link">
                <i class="fa fa-lock nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Kullanıcı Yetkileri
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("urun")?>" class="nav-link">
                  <i class="fa fa-building nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">Ürün</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="<?=base_url("departman")?>" class="nav-link">
                  <i class="fa fa-building nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">Departmanlar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("duyuru-kategori")?>" class="nav-link">
                  <i class="	fas fa-bullhorn nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">Duyuru Kategorileri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("istek_birim")?>" class="nav-link">
                  <i class="	far fa-life-ring nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">İstek Birimleri</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url("istek_kategori")?>" class="nav-link">
                  <i class="	far fa-life-ring nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">İstek Kategorileri</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url("is_tip")?>" class="nav-link">
                  <i class="	far fa-list-alt nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">İş Tipleri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("istek_durum")?>" class="nav-link">
                  <i class="	far fa-life-ring nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">İstek Durumları</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("dokuman_kategori")?>" class="nav-link">
                  <i class="far fa-folder nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">Döküman Kategorileri</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url("demirbas_kategori")?>" class="nav-link">
                  <i class="far fa-folder nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">Envanter Kategorileri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("demirbas_birim")?>" class="nav-link">
                  <i class="	far fa-life-ring nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">Envanter Birimleri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("kullanici_grup")?>" class="nav-link">
                  <i class="fa fa-users nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">Kullanıcı Grupları</p>
                </a>
              </li>
             
             
              <li class="nav-item">
                <a href="<?=base_url("sehir")?>" class="nav-link">
                  <i class="fa fa-map-pin nav-icon" style="font-size:13px"></i>
                  <p style="font-size:15px">İl - İlçe Bilgileri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("yemek")?>" class="nav-link">
                <i class="fa fa-envelope nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Yemek Listesi
                </p>
                </a>
            </li>
              <li class="nav-item">
                <a href="<?=base_url("ayar")?>" class="nav-link">
                <i class="fa fa-envelope nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Parametreler
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("ayar/arac_kilometre_ortalamalari")?>" class="nav-link">
                <i class="fas fa-tachometer-alt nav-icon" style="font-size:13px"></i>
                <p style="font-size:12px">
                    Araç Kilometre Ortalamaları
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("ariza")?>" class="nav-link">
                <i class="fa fa-envelope nav-icon" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Başlık Arıza Tanımları
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url("logs")?>" class="nav-link">
                <i class="nav-icon 	fas fa-power-off text-success" style="font-size:13px"></i>
                <p style="font-size:15px">
                    Log
                </p>
                </a>
            </li>
            </ul>
          </li>
          <?php endif; ?>

        
 


        
            <li class="nav-item">
                <a class="nav-link">
                
                <p style="font-size:15px">
                    
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link">
                
                <p style="font-size:15px">
                    
                </p>
                </a>
            </li> <li class="nav-item">
                <a class="nav-link">
                
                <p style="font-size:15px">
                    
                </p>
                </a>
            </li> <li class="nav-item">
                <a class="nav-link">
                
                <p style="font-size:15px">
                    
                </p>
                </a>
            </li>
              
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <script>
  document.addEventListener("DOMContentLoaded", function() {
    var sidebar = document.getElementById("main-sidebar");
    var contentWrappers = document.querySelectorAll(".content-wrapper");
 var headerWrappers = document.querySelectorAll(".main-header");

    if (window.opener && window.innerWidth < 1366) {
      sidebar.style.display = "none";
      contentWrappers.forEach(function(contentWrapper) {
        contentWrapper.style.marginLeft = "0";
      });
      headerWrappers.forEach(function(headerWrapper) {
      
        headerWrapper.style.display = "none";
      });
    }

    // Sidebar menü filtreleme (sadece ID 1 için)
    var sidebarFilter = document.getElementById("sidebar-menu-filter");
    if (sidebarFilter) {
      sidebarFilter.addEventListener("keyup", function() {
        var filterValue = this.value.toLowerCase();
        var menuItems = document.querySelectorAll("#sidebar-menu-list > li");
        
        menuItems.forEach(function(item) {
          var text = item.textContent.toLowerCase();
          var navLink = item.querySelector("a.nav-link");
          var navHeader = item.querySelector(".nav-header");
          
          // Nav header'ları her zaman göster
          if (navHeader) {
            item.style.display = "";
            return;
          }
          
          // Eğer menü elemanı alt menü içeriyorsa, alt menü elemanlarını da kontrol et
          var treeview = item.querySelector(".nav-treeview");
          if (treeview) {
            var subItems = treeview.querySelectorAll("li");
            var hasMatch = false;
            
            // Ana menü metnini kontrol et
            if (text.includes(filterValue)) {
              hasMatch = true;
            }
            
            // Alt menü elemanlarını kontrol et
            subItems.forEach(function(subItem) {
              var subText = subItem.textContent.toLowerCase();
              if (subText.includes(filterValue)) {
                hasMatch = true;
                subItem.style.display = "";
              } else {
                subItem.style.display = filterValue === "" ? "" : "none";
              }
            });
            
            // Ana menü elemanını göster/gizle
            item.style.display = hasMatch || filterValue === "" ? "" : "none";
          } else {
            // Alt menü içermeyen normal menü elemanları
            if (text.includes(filterValue) || filterValue === "") {
              item.style.display = "";
            } else {
              item.style.display = "none";
            }
          }
        });
      });
    }
  });
</script>