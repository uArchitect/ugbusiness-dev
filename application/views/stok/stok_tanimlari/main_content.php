<style>
    .select2-container--open {
    z-index: 99999999999999;
    }
  .table th {
    background: #ffffff !important;
    color: black;
    padding: 6px;
    padding-left: 10px;
}
.text-custom-warning{
  background: #fff792;
    padding: 5px;
    width: -webkit-fill-available;
    display: block;
    color: #6b4b00 !important;
    text-align: center;
}

.text-custom-success{
  background: #008000;
    padding: 5px;
    width: -webkit-fill-available;
    display: block;
    color: #ffffff !important;
    text-align: center;
}

  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>

 


<section class="content text-md">


<div class="row">

<div class="col-md-2">

 
 

  <div class="card" style="border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="    background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Stok Menü</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <ul class="nav nav-pills flex-column">
       
        <li class="nav-item">
            <a href="<?=base_url("stok/giris_stok_kayitlari")?>" style="cursor:pointer" class="nav-link">
            <i class="fas fa-folder-open text-orange"></i> Tüm Stok Kayıtları
        </a>
        </li>

        <li class="nav-item">
            <a id="filterButton" style="cursor:pointer" class="nav-link">
            <i class="fas fa-arrow-circle-up text-primary"></i> Stok Çıkışları
        </a>
        </li>

 
        

        <li class="nav-item">
            <a href="<?=base_url("stok/giris_stok_kayitlari")."?filter=cop-kutusu"?>" class="nav-link">
            <i class="fas fa-trash-restore text-danger"></i> Çöp Kutusu
        </a>
        </li>


      </ul>
    </div>
  </div>





  <div class="card" style="border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Stok Giriş</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-2">
        <form id="stokForm"   action="<?=base_url("stok/stok_kaydet")?>" method="POST">
            <ul class="nav nav-pills flex-column">
              

                <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
                <select id="stok_tanim_kayit_id" required name="stok_tanim_kayit_id" onchange="toggleSeriKodGirisi()" style="max-width: 100%;" class="select2 swal2-input">
                <option value="">Seçilmedi</option>
                <?php 
                  foreach ($stok_tanim_list as $stanim) { 
                  
                    echo '<option value="'.$stanim->stok_tanim_id.'">'.$stanim->stok_tanim_grup_kod." / ".$stanim->stok_tanim_prefix." / ".$stanim->stok_tanim_ad.'</option>';
                  } 
                ?>  




                  </select>
                </li>
                <li id="seri_kod_div"  class="nav-item active" style="display:none;border-bottom: 0px;margin-top: 5px;">
                
                <div>
                <input id="seri_kod" name="seri_kod" type="text" placeholder="Seri Kodunu Giriniz" style="margin-top:0px!important;max-width:100%;" class="form-control"></div>
                </li>
                <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
                <div class="input-group mb-0">
<div class="input-group-prepend">
<span class="input-group-text">Miktar :</span>
</div>
<input type="number" style="background:#fff0a2" required class="form-control" min="1" value="1" id="stok_miktar" name="stok_miktar" placeholder="Stok Miktar Giriniz...">
               
</div>
                
                </li>

 <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
               
 <input id="eski_tarih" name="eski_tarih" type="text" placeholder="Eski Tarih Örn: 010124" style="margin-top:0px!important;max-width:100%;" class="form-control">
             
                  </li>
                  <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
                    <select id="cikma_parca_mi" required name="cikma_parca_mi" onchange="document.getElementById('eski_cihaz_seri_no').style.display = this.value==1 ? 'block' : 'none';" style="max-width: 100%;" class="select2 swal2-input">
                      <option value="0" selected>SIFIR PARÇA</option>
                      <option value="1">2.EL PARÇA</option>
                    </select>
                  </li>
                  
 <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
               
               <input id="eski_cihaz_seri_no" name="eski_cihaz_seri_no" type="text" placeholder="Seri No Örn: UG00000000UX01" style="display:none;margin-top:0px!important;max-width:100%;" class="form-control">
                           
                                </li>

                <li class="nav-item" style=" border-bottom: 0px;   margin-top: 5px;">
                <button type="submit" class="btn btn-block btn-success btn-md"><i class="fas fa-arrow-circle-right"></i> Stok Giriş Yap</button>
                </li>

            </ul>
      </form>
    </div>
  </div>




  <div class="card <?=($_GET["filter"] == "stok-cikis") ? "" : "collapsed-card"?>" style="border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Stok Çıkış</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-2">
   
        <form id="stokCikisForm" action="<?=base_url("stok/stok_cikis_yap")?>" method="POST">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item active" style="border-bottom: 0px;">
                <input type="text" style="background:#fff0a2" required class="form-control" id="cikis_yapilacak_seri_kod" name="cikis_yapilacak_seri_kod" placeholder="Barkod okutunuz...">
                </li>


                <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
                    <select name="stok_cikis_birim_fg_id" required id="stok_cikis_birim_fg_id" class="select2 form-control rounded-0" style="width: 100%;">
                    <option  value="">Çıkış Birimi Seçiniz</option>
                    
                    <?php 
                      $cikis_birimleri = get_cikis_birimleri() ; 
                      
                    foreach($cikis_birimleri as $birim1) : ?> 
                                    <option  value="<?=$birim1->stok_cikis_birim_id ?>"><?=$birim1->stok_cikis_birim_adi?></option>
                    
                        <?php endforeach; ?>  
                    </select>
                </li>


                <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
                <div class="input-group mb-0">
<div class="input-group-prepend">
<span class="input-group-text">Çıkış Miktar :</span>
</div>
<input type="number" style="background:#fff0a2" required class="form-control" min="1" value="1" id="stok_cikis_miktar" name="stok_cikis_miktar" placeholder="Stok Çıkış Miktar Giriniz...">
               
</div>
                
                </li>
                <li class="nav-item"  style="border-bottom: 0px;    margin-top: 5px;">
                <button type="submit" class="btn btn-block btn-danger btn-md"><i class="fas fa-arrow-circle-up"></i> Stok Çıkış Yap</button>
                </li>

            </ul>
      </form>
    </div>
  </div>







  <div class="card  <?=($_GET["filter"] == "stok-eslestir") ? "" : "collapsed-card"?>" style="border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Konnektör - Lamba Eşleştir</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-2">
        <form  onkeypress="preventFormSubmitOnEnter(event)" action="<?=base_url("stok/update_power_stok")?>" method="POST">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item active" style="border-bottom: 0px;margin-bottom:5px;">
                <input type="text" style="background:#fff0a2" required class="form-control" name="birinci_stok_seri_kod" placeholder="Konnektör kodunu okutunuz...">
                </li>
                <li class="nav-item active" style="border-bottom: 0px;">
                <input type="text" style="background:#fff0a2" required class="form-control" name="ikinci_stok_seri_kod" placeholder="Lamba kodunu giriniz...">
                </li>
                <li class="nav-item" style=" border-bottom: 0px;   margin-top: 5px;">
                <button type="submit" class="btn btn-block btn-primary btn-md"><i class="fas fa-random"></i> Stok Eşleştir</button>
                </li>

            </ul>
      </form>
    </div>
  </div>








  <div class="card  <?=($_GET["filter"] == "stok-degisim") ? "" : "collapsed-card"?>" style="border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Stok Değişim</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-2">
        <form  onkeypress="preventFormSubmitOnEnter(event)" action="<?=base_url("stok/stok_degisim")?>" method="POST">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item active" style="border-bottom: 0px;">
                <input type="text" style="background:#fff0a2" required class="form-control" name="degisim_yapilacak_seri_kod" placeholder="Barkod okutunuz...">
                </li>
                <li class="nav-item active" style="border-bottom: 0px;margin-top: 5px;">
                    <select name="degisim_stok_tanim_kayit_id" required id="degisim_stok_tanim_kayit_id" class="select2 form-control rounded-0" style="width: 100%;">
                    <option  value="">Seçim Yapılmadı</option>
                    
                    <?php 
                      $degisim_stoklari = get_degisim_stok_tanimlari() ; 
                      
                    foreach($degisim_stoklari as $degisim_stok) : ?> 
                                    <option  value="<?=$degisim_stok->stok_tanim_id?>"><?=$degisim_stok->stok_tanim_ad?></option>
                    
                        <?php endforeach; ?>  
                    </select>
                </li>
                <li class="nav-item" style=" border-bottom: 0px;   margin-top: 5px;">
                <button type="submit" class="btn btn-block btn-warning btn-md"><i class="fas fa-random"></i> Stok Değiştir</button>
                </li>

            </ul>
      </form>
    </div>
  </div>


  






  <div class="card collapsed-card" style="border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Parametreler</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a href="<?=base_url("stok/stok_genel_bakis")?>" class="nav-link">
          <i class="fas fa-tachometer-alt text-orange"></i> Stok Kategorileri
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url("stok/cihaz_stok_tanimlari")?>" class="nav-link">
          <i class="fas fa-hdd text-primary"></i> Cihaz Parça Tanımları
          </a>
        </li> 
 
      </ul>
    </div>
  </div>
  


 




  

  <div class="card <?=($_GET["filter"] == "stok-lamba-giris") ? "" : ""?>" style="border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Lamba Stok Giriş</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-2">
   
        <form   action="<?=base_url("stok/stok_ozellambagiris")?>" method="POST">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item active" style="border-bottom: 0px;">
                <input maxlength="5" type="text" style="background:#fff0a2"
required class="form-control" id="lambaozelkod" name="lambaozelkod"
placeholder="Barkod okutunuz veya kod giriniz..."
oninput="this.value = this.value.toUpperCase();">
 </li>


                 
 
                <li class="nav-item"  style="border-bottom: 0px;    margin-top: 5px;">
                <button type="submit" class="btn btn-block btn-primary btn-md"><i class="fas fa-arrow-circle-up"></i> Giriş Yap</button>
                </li>

            </ul>
      </form>
    </div>
  </div>




  <div class="card   <?=($_GET["filter"] == "stok-lamba-giris") ? "" : ""?>" id="kayitform" style="display:none;border-radius:0px;margin-bottom: 5px !important;">
    <div class="card-header" style="background: #181818;color:white;padding-top: 8px;padding-bottom: 4px;">
      <h3 class="card-title" style="font-weight: 700;">Stok Seri Kodu Güncelle</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-2">
   
        <form   action="<?=base_url("stok/stok_ozellambaupdate")?>" method="POST">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item active" style="border-bottom: 0px;">
               
               <input  readonly type="text"  
required class="form-control"  id="kayitid" name="kayitid">


                <input   type="text" style="background:#fff0a2"
required class="form-control" id="kayitkod" name="lambaozelkod"
placeholder="Barkod okutunuz veya kod giriniz..."
oninput="this.value = this.value.toUpperCase();">


 </li>


                 
 
                <li class="nav-item"  style="border-bottom: 0px;    margin-top: 5px;">
                <button type="submit" class="btn btn-block btn-success btn-md"><i class="fas fa-arrow-circle-up"></i> Kodu Güncelle</button>
                </li>

            </ul>
      </form>
    </div>
  </div>




</div>











 








<div class="col card card-danger d-none">
 
 <div class="card-body">
 <form action="https://ugbusiness.com.tr/cihaz/stok_tanimla" method="POST">
 <div class="row">
 
 <div class="col-md-4">
 <label for="exampleInputEmail1">ürün</label>
  
 <select name="urun_fg_id"   style="max-width: 100%;" class="select2 swal2-input">
                <option value="">Seçilmedi</option>
                <?php 
                  foreach ($cihazlardata as $stanim) { 
                    echo '<option value="'.$stanim->urun_id.'">'.$stanim->urun_adi.'</option>';
                  } 
                ?>  




                  </select>
</div>
 <div class="col-md-5">
 <label for="exampleInputEmail1">stok</label>
   <select id="stok_fg_id" name="stok_fg_id" onchange="toggleSeriKodGirisi()" style="max-width: 100%;" class="select2 swal2-input">
                <option value="">Seçilmedi</option>
                <?php 
                  foreach ($stok_tanim_list as $stanim) { 
                    echo '<option value="'.$stanim->stok_tanim_id.'">'.$stanim->stok_tanim_grup_kod." / ".$stanim->stok_tanim_prefix." / ".$stanim->stok_tanim_ad.'</option>';
                  } 
                ?>  




                  </select>
</div>
 <div class="col-md-3">
 <label for="exampleInputEmasil1">&nbsp;</label>
 <button type="submit" id="exampleInputEmasil1" class="btn btn-block btn-success btn-lg">Kaydet</button>
 </div>
 </div>
 
 </form>
 
 
 </div>
 
 </div>

<?php if(!empty($cihaz_stok_tanimlari)) : ?>


  




  



<div class="col card card-dark p-0">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Cihaz Stok Tanımları</h3>
                
              </div>
              <div class="btn-group" style="padding: 0px;">
                  <button type="button" style="border-radius: 0px; margin-left: -1px;background: #000000; color: #ffc107;" onclick="filterwrite(this,'');" class="btn btn-default">Tümünü Görüntüle</button> 
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex Plus');" class="btn btn-default">Umex Plus</button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex Lazer');" class="btn btn-default">Umex Lazer</button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex Slim');" class="btn btn-default">Umex Slim</button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex Gold');" class="btn btn-default">Umex Gold</button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex S');" class="btn btn-default">Umex S</button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex Q');" class="btn btn-default">Umex Q</button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex Diode');" class="btn btn-default">Umex Diode</button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'Umex EMS');" class="btn btn-default">Umex EMS</button>
                 </div>
             
              <!-- /.card-header --> 
              <div class="card-body" style="border: 1px solid black; max-height: 810px;  min-height: 810px;">
             
                <table id="example1cihazstoktanim" class="table text-sm table-bordered table-striped"    >
                  <thead style="width: 100% !important;">
                  <tr>
                    <th style="width:24px">No</th> 
                    <th style="width:84px">Ürün Adı</th>
                    
                    <th style="width:74px">Grup Kodu</th>
                    <th style="width:74px">Prefix</th>
                    
                    <th>Stok Tanımı</th> 
                    <th style="width:84px">İşlem</th>
                  </tr>
                  </thead>
                  <tbody style="width: 100% !important;">
                   <?php foreach ($cihaz_stok_tanimlari as $stok_tanim){?>
                    <tr>
                      <td>
                         <?=$stok_tanim->cihaz_stok_id?> 
                      </td>
                      <td style="font-weight:bold">
                         <?=$stok_tanim->urun_adi?> 
                      </td>
                      <td>
                         <?=$stok_tanim->stok_tanim_grup_kod?> 
                      </td>
                      <td>
                         <?=($stok_tanim->stok_tanim_prefix != "" && $stok_tanim->stok_tanim_prefix != null) ? $stok_tanim->stok_tanim_prefix :"<span style='opacity:0.5;font-weight:normal'><i class='fas fa-info-circle'></i> NoPrefix</span>"?> 
                      </td>
                      <td>
                         <?=$stok_tanim->stok_tanim_ad?> 
                      </td>
                     
                      <td style="padding-top: 0px !important; padding-left: 4px !important; padding-right: 4px !important; padding-bottom: 4px !important;">
                        <button type="button" style=" " class="btn btn-dark btn-xs">Düzenle</button>
                        <a href="<?=base_url("cihaz/stok_tanim_sil/".$stok_tanim->cihaz_stok_id)?>" type="button" style=" " class="btn btn-danger btn-xs">Kayıt Sil</a>
                      
                      </td>
                    </tr>
                  <?php  } ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
            <?php endif; ?>



<?php if(!empty($stok_tanimlari)) : ?>



<div class="col card card-dark p-0">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Stok Kategorileri</h3>
                
              </div>
             
              <!-- /.card-header --> 
              <div class="card-body" style="border: 1px solid black;    min-height: 810px;">
             
                <table id="example1stok_tanim2" style="display: inline-table;" class="table text-sm table-bordered table-responsive table-striped"    >
                  <thead style="width: 100% !important;">
                  <tr>
                    <th style="width:24px">No</th> 
                    <th style="width:84px">Grup Kodu</th>
                    <th style="width:74px">Prefix</th>
                    <th>Stok Tanımı</th>
                    <th style="width:84px">Stok Açıklama</th>
                    <th style="width:84px">Stok Giriş</th>
                    <th style="width:74px">Stok Çıkış</th>
                    <th style="width:84px">Güncel Stok</th>
                
                  </tr>
                  </thead>
                  <tbody style="width: 100% !important;">
                   <?php foreach ($stok_tanimlari as $stok_tanim){?>
                    
                    <tr style="<?=($stok_tanim->uyari_ver == "stok_uyarisi") ? "background:red;color:white!important;" : ""?>">
                      <td>
                         <?=$stok_tanim->stok_tanim_id?> 
                      </td>
                      <td style="font-weight:500">
                         <?=$stok_tanim->stok_tanim_grup_kod?> 
                      </td>
                      <td>
                         <?=($stok_tanim->stok_tanim_prefix != "" && $stok_tanim->stok_tanim_prefix != null) ? $stok_tanim->stok_tanim_prefix :"<span style='opacity:0.5;font-weight:normal'>NoPrefix</span>"?> 
                      </td>
                      <td style="font-weight:500">
                      <a href="https://ugbusiness.com.tr/stok_tanim/index/0/<?=$stok_tanim->stok_tanim_id?>" target="_blank" style="<?=($stok_tanim->uyari_ver == "stok_uyarisi") ? "color:white!important":""?>">
                         <?=$stok_tanim->stok_tanim_ad?> 
                   </a>

                       

                      </td>
                      <td>
                         <?=($stok_tanim->stok_tanim_aciklama != "" && $stok_tanim->stok_tanim_aciklama != null) ? $stok_tanim->stok_tanim_aciklama :"<span style='opacity:".($stok_tanim->uyari_ver == "stok_uyarisi" ? "1" : "0.5").";font-weight:normal'><i class='fas fa-info-circle'></i> Açıklama Girilmedi</span>"?> 
                      </td>
                      <td style="background: #47ff6f0d;">
                         <?=$stok_tanim->giris_stok?> <span style="opacity:<?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "1" : "0.5")?>"><?=$stok_tanim->stok_birim_adi?></span>  <i class="fas fa-arrow-circle-down <?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "text-white" : "text-success")?>"></i>
                      </td>
                      <td style="background: #ff00000d;">
                         <?=$stok_tanim->cikis_stok?> <span style="opacity:<?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "1" : "0.5")?>"><?=$stok_tanim->stok_birim_adi?></span> <i class="fas fa-arrow-circle-up <?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "text-white" : "text-danger")?>"></i>
                      </td>
                      <td style="background: #ffff001f;">
                         <?=$stok_tanim->toplam_stok?> <span style="opacity:<?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "1" : "0.5")?>"><?=$stok_tanim->stok_birim_adi?></span> <i class="fas fa-check-circle <?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "text-white" : "text-warning")?>"></i>
                      </td>
                     
                    </tr>
                  <?php  } ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
            <?php endif; ?>
            <?php if(!empty($stoklar)) : ?>
                  <!-- /.card -->
                  <div class="col card  <?=($_GET["filter"] == "stok-cikis") ? "card-danger": "card-dark"?>  p-0">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - <?=($_GET["filter"] == "stok-cikis") ? "Çıkış Yapılmış Stok Kayıtları": "Stok Kayıtları"?> </h3>
                
              </div>
            
              <!-- /.card-header --> 
              <div class="card-body" style="border: 1px solid black;    min-height: 810px;">
             
 

                <table id="examp2" class="table text-sm table-bordered table-responsive table-striped" style="display: inline-table;" >
                <thead style="width: 100% !important;">
                  <tr>
                    <th style="width:54px">No</th> 
                    <th>Stok Tanımı</th>
                    <th style="width:84px">Parça Seri Numarası</th>
             
                 
                    <th style="width:84px">Stok Giriş Tarihi</th>
                    <th style="width:94px">Stok Çıkış Tarihi</th>
                    <th style="width:84px">QR Baskı</th>
                    <th style="width:84px">Stok Durumu</th> 
                  </tr>
                  </thead>
</table>







              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
              <?php endif; ?>
          
          </div>
</section>








 



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
                  <table id="example1stok_tanim2" style="display: inline-table;" class="table text-sm table-bordered table-responsive table-striped"    >
                  <thead style="width: 100% !important;">
                  <tr>
                    <th style="width:24px">No</th> 
                    <th style="width:84px">Grup Kodu</th>
                    <th style="width:74px">Prefix</th>
                    <th>Stok Tanımı</th>
                    <th style="width:84px">Stok Açıklama</th>
                    <th style="width:84px">Stok Giriş</th>
                    <th style="width:74px">Stok Çıkış</th>
                    <th style="width:84px">Güncel Stok</th>
                    <th style="width:70px">İşlem</th>
                  </tr>
                  </thead>
                  <tbody style="width: 100% !important;">
                   <?php foreach ($stok_tanimlari as $stok_tanim){?>
                    <tr>
                      <td>
                         <?=$stok_tanim->stok_tanim_id?> 
                      </td>
                      <td style="font-weight:500">
                         <?=$stok_tanim->stok_tanim_grup_kod?> 
                      </td>
                      <td>
                         <?=($stok_tanim->stok_tanim_prefix != "" && $stok_tanim->stok_tanim_prefix != null) ? $stok_tanim->stok_tanim_prefix :"<span style='opacity:0.5;font-weight:normal'>NoPrefix</span>"?> 
                      </td>
                      <td style="font-weight:500">
                         <?=$stok_tanim->stok_tanim_ad?> 
                      </td>
                      <td>
                         <?=($stok_tanim->stok_tanim_aciklama != "" && $stok_tanim->stok_tanim_aciklama != null) ? $stok_tanim->stok_tanim_aciklama :"<span style='opacity:0.5;font-weight:normal'><i class='fas fa-info-circle'></i> Açıklama Girilmedi</span>"?> 
                      </td>
                      
                      <td style="background: #ffff001f;">
                         <?=$stok_tanim->toplam_stok?> <span style="opacity:0.5"><?=$stok_tanim->stok_birim_adi?></span> <i class="fas fa-check-circle text-warning"></i>
                      </td>
                      <td style="padding-top: 0px !important; padding-left: 4px !important; padding-right: 4px !important; padding-bottom: 4px !important;">
                        <button type="button" class="btn btn-dark btn-xs" style="width: -webkit-fill-available;"><i class="fa fa-pen text-warning" style="font-size:12px" aria-hidden="true"></i> Görüntüle</button>
                       
                      </td>
                    </tr>
                  <?php  } ?>
                  </tbody>
 
                </table>
                </div>
              <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->













 




            </div>





            <script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>









            <script>
function toggleSeriKodGirisi() {
    var selectedValue = document.getElementById('stok_tanim_kayit_id').value;
    var seriKodDiv = document.getElementById('seri_kod_div');
    if (selectedValue == 34) {
        seriKodDiv.style.display = 'block';
       document.getElementById('seri_kod').setAttribute("required", "");
      document.getElementById('stok_miktar').value="1";

      document.getElementById('stok_miktar').setAttribute("readonly", "");

       
    } else {
        seriKodDiv.style.display = 'none';
        document.getElementById('seri_kod').value = "";
       document.getElementById('seri_kod').removeAttribute("required");
       document.getElementById('stok_miktar').removeAttribute("readonly");

    }
}


function preventFormSubmitOnEnter(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                return false;
            }
        }


        function qrchange(idd)
{
  
 /* Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Qr Yazdırma Durumu Güncelleniyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });
*/


          // Save the clicked button element
            var recordId = idd;
            // AJAX request to update QR status
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('stok/update_qr_durum/'); ?>"+recordId, // Replace 'controller' with your actual controller name
                data: { /* Any additional data you need to send */ },
                success: function(response){
                    // Update the UI based on the response
                    
                    if(response == '{"qr_durum":1}') {
                    //  this.addClass('text-custom-success').html('<i class="fas fa-check-circle"></i> QR Yazdırıldı');
                    } else {
                    //  this.addClass('text-custom-warning').html('<i class="fas fa-hourglass-half"></i> QR Yazdırılmadı');
                    }
                  //  Swal.close();
                    $("#examp2").DataTable().ajax.reload();
                },
                error: function(xhr, status, error){
                    // Handle errors if any
                    console.error(error);
                }
            });
}


    $(document).ready(function(){









      
        // Button click event
       $(".toggle_qr_status").click(function(){

        Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Qr Yazdırma Durumu Güncelleniyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });



        var event = $(this); // Save the clicked button element
            var recordId = event.data('record-id');
            // AJAX request to update QR status
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('stok/update_qr_durum/'); ?>"+recordId, // Replace 'controller' with your actual controller name
                data: { /* Any additional data you need to send */ },
                success: function(response){
                    // Update the UI based on the response
                    
                    if(response == '{"qr_durum":1}') {
                      event.removeClass('text-custom-warning').addClass('text-custom-success').html('<i class="fas fa-check-circle"></i> QR Yazdırıldı');
                    } else {
                      event.removeClass('text-custom-success').addClass('text-custom-warning').html('<i class="fas fa-hourglass-half"></i> QR Yazdırılmadı');
                    }
                    Swal.close()
                },
                error: function(xhr, status, error){
                    // Handle errors if any
                    console.error(error);
                }
            });
        });
    });
</script>









            <script>
document.addEventListener('DOMContentLoaded', function() {




  
  $("#example1cihazstoktanim").DataTable({ "ordering": false, "pageLength": 20 });









  
  const rows = document.querySelectorAll('.stok-item');

  rows.forEach(row => {
    const parentId = row.getAttribute('data-parent-id');
    if (parentId == "0") {
      // Ana ürün satırı
      const hasChildren = Array.from(rows).some(subRow => subRow.getAttribute('data-parent-id') === row.getAttribute('data-id'));
      if (hasChildren) {
        // Alt ürün varsa ok ekle
        const arrow = document.createElement('i');
        arrow.classList.add('fas', 'fa-angle-down', 'toggle-arrow');

        arrow.style.opacity = '1';
        arrow.style.cursor = 'pointer';
        const secondCell = row.querySelector('td:nth-child(2)');
        secondCell.style.fontWeight = 'bold'; // İkinci sütünun font ağırlığını bold yap
        secondCell.appendChild(arrow); // İkinci sütüna ekle
        row.style.cursor = 'pointer'; // Satırı tıklanabilir yap
        row.style.backgroundColor = '#dbdbdb'; // Satırı tıklanabilir yap

        row.addEventListener('click', function() {
          const isExpanded = row.classList.contains('expanded');
          rows.forEach(subRow => {
            if (subRow.getAttribute('data-parent-id') === row.getAttribute('data-id')) {
             subRow.style.display = isExpanded ? 'none' : '';
              subRow.style.backgroundColor = '#f4fff0'; // Satırı tıklanabilir yap

            }
          });
          row.classList.toggle('expanded');
          arrow.classList.toggle('fa-angle-down');
          arrow.classList.toggle('fa-angle-up');
        });
      }
    } else {
      // Alt ürün satırı
   //   row.style.display = 'none';
    row.style.backgroundColor = '#f4fff0'
    }
  });
});
</script>

<style>
.toggle-arrow {
  transition: transform 0.2s;
}
.toggle-arrow.fa-caret-up {
  transform: rotate(180deg);
}
 
</style>


            <style>

              .table-striped tbody tr:nth-of-type(odd) {
    
}
              </style>
              <script>
                
                

function filterwrite(currentbutton,text){

var buttons = document.querySelectorAll('.btn-group button');
buttons.forEach(function(button) {
button.style.background = '#000000';
button.style.color = 'white';
});

currentbutton.style.background = '#ffc107!important';
currentbutton.style.color = '#ffc107';
var inputElement = document.querySelector('#example1cihazstoktanim_filter input[type="search"]');


inputElement.value = text;
var event = new Event('input', {
bubbles: true,
cancelable: true,
});
inputElement.dispatchEvent(event);
}

function serikoddegistir(id, kod) {
  document.getElementById("kayitform").style.display = "block";
  document.getElementById("kayitid").value = id;
    
  document.getElementById("kayitkod").value = kod;
}


    </script>
   












   <script type="text/javascript">
    $(document).ready(function() {

//01.063/SD240724.001

      $('#stokForm').on('submit', function(e) {
        e.preventDefault();  
        Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Başlık Kaydı Sorgulanıyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });
    
         
        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),  
            type: $(this).attr('method'),  
            data: formData,
            success: function(response) {
              Swal.close();
              var responseObj = JSON.parse(response);
              if (responseObj.success) {
                $('#examp2').DataTable().ajax.reload();
                document.getElementById("seri_kod").value="";
        } else {
           
          Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: responseObj.message
                      });
          document.getElementById("seri_kod").value="";
        }

               // alert('Stok başarıyla eklendi!');
               
            },
            error: function(xhr, status, error) {
              Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: error
                      });
                
                document.getElementById("seri_kod").value="";
            }
        });
    });








    $('#stokCikisForm').submit(function(e) {
                e.preventDefault();  
                Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Stok Çıkışı Yapılıyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });
                var formData = $(this).serialize(); //  

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                      Swal.close();
                      var responseObj = JSON.parse(response);
                      if(responseObj.status === 'success') {
                        var responseObj = JSON.parse(response);

                        if(responseObj.status === 'success') {

                        $("#filterButton").data('filter', '5');
                    
                          $('#examp2').DataTable().ajax.reload();
                          document.getElementById("cikis_yapilacak_seri_kod").value="";
                          document.getElementById("stok_cikis_miktar").value="1";
                        }

                    }else{
                      Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: responseObj.message
                      });
                    }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Form submission failed: ", textStatus, errorThrown);
                    }
                });
            });














        var table = $('#examp2').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "ajax": {
                "url": "<?php echo base_url('stok/get_stok_kayitlari_ajax?filter='.(!empty($_GET["filter"]) ? "cop-kutusu" : "none")) ?>",
                "type": "GET",
                "data": function(d) {
                 
                d.extra_filter = $('#filterButton').data('filter');
            },
            "beforeSend": function() {
                        $('#examp2').css('opacity', '0.5');
                    },
                    "complete": function() {
                        $('#examp2').css('opacity', '1');
                    }
            },
            "columns": [
                { "data": "stok_id" },
                { "data": "stok_tanim_ad" },
                { "data": "stok_seri_kod" },
                { "data": "stok_kayit_tarihi" },
                { "data": "stok_cikis_tarihi" },
                { "data": "qr_durum" },
                { "data": "stok_durumu" }
            ],
            "rowCallback": function(row, data) {
            if (data.rowClass) {
                $(row).addClass(data.rowClass);
            }
            // Or use inline style: $(row).css('background-color', 'green');
        },
            "createdRow": function( row, data, dataIndex ) {
                $(row).addClass('stok-item');
                $('td', row).addClass('p-0 pt-1 pl-2'); 
                $('td:eq(5)', row).removeClass('pt-1 pl-2').addClass('qr-status'); // Adds a different class to the 6th column (index 5)
                $('td:eq(6)', row).removeClass('pt-1 pl-2').addClass('stok-status');
            }
        });


        $('#filterButtonAll').on('click', function() {
         
         $("#filterButton").data('filter', '0');
 
        
         table.ajax.reload();
     });


        $('#filterButton').on('click', function() {
         
        $(this).data('filter', '1');

       
        table.ajax.reload();
    });
    });
</script>

<style>
  .bg-success-custom {
    background-color: #eefff2 !important;
    color: black !important;
}


.top-bg-success-custom {
  background: #004710 !important;
    color: white !important;
   
}

              
              .yanipsonenyazifast {
                    animation: blinker2 0.4s linear infinite;
                 
                    }
                    @keyframes blinker2 {  
                    50% { opacity: 0; }
                    }


</style>