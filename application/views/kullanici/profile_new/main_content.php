<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
 
  <script>
    window.onload = function () {
        window.scrollTo(0, 0);
    };
</script>
<div class="content-wrapper " style="    padding-top: 5px;" >
    <!-- Content Header (Page header) -->
     
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="padding:0px!important;">
        <div class="row">
          <div class="col-md-3 p-0">

            <!-- Profile Image -->
            <div class="card card-dark card-outline" style="position: sticky;height: 858px;">
              <div class="card-body box-profile">

              <a class="nav-link btn btn-danger text-white" href="<?=base_url("anasayfa/rehber")?>" style="
    top: 10px;
    position: absolute;
">
                 <i class="fas fa-arrow-circle-left"></i>
                  Kullanıcılar</a>


                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" style="<?=$_GET["subpage"] && $_GET["subpage"] == "ozluk-dosyasi" ? "    filter: grayscale(100%);opacity: 0.5;" : ""?>" src=" <?=base_url("uploads/".$data_kullanici->kullanici_resim)?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$data_kullanici->kullanici_ad_soyad?></h3>

                <p class="text-muted text-center" style="margin-top:-5px!important;display:block"><?=$data_kullanici->kullanici_unvan?></p>

                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>TC Kimlik Numarası</b> <a class="float-right"><?=$data_kullanici->kullanici_tc_kimlik_no?></a>
                  </li>
                  <li class="list-group-item">
    <b>Doğum Tarihi</b> 
    <a class="float-right">
        <?=date("d.m.Y",strtotime($data_kullanici->kullanici_dogum_tarihi))?> (<?=date_diff(date_create($data_kullanici->kullanici_dogum_tarihi), date_create('today'))->y?> yaş)
    </a>
</li>

                  <li class="list-group-item">
                    <b>Mail Adresi</b> <a class="float-right"><?=$data_kullanici->kullanici_email_adresi?></a>
                  </li>
                  <li class="list-group-item">
                    <b>İletişim Numarası</b> <a class="float-right"><?=$data_kullanici->kullanici_bireysel_iletisim_no?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Departman</b> <a class="float-right"><?=$data_kullanici->departman_adi?> Departmanı</a>
                  </li>
                  <li class="list-group-item">
                    <b>İşe Başlama Tarihi</b> <a class="float-right"><?= date("d.m.Y", strtotime($data_kullanici->kullanici_ise_giris_tarihi)) ?></a>
                  </li>

                  <?php
    $ise_giris_tarihi = new DateTime($data_kullanici->kullanici_ise_giris_tarihi);
    $bugun = new DateTime(); // Şu anki tarih
    $fark = $ise_giris_tarihi->diff($bugun);
?>
  <li class="list-group-item">
                    <b>Görev Bölgesi</b> <a class="float-right">UMEX FABRİKA (ADANA)</a>
                  </li>
                  <li class="list-group-item">
                    <b>Çalışma Süresi</b> <a class="float-right"><?= $fark->y ?> yıl, <?= $fark->m ?> ay, <?= $fark->d ?> gün</a>
                  </li>
                  <li class="list-group-item">
                    <b>Şirket Araç Bilgisi</b> <a class="float-right"> -</a>
                  </li>
                  <li class="list-group-item">
                    <b>Whatsapp Hızlı İletişim</b> <a class="float-right text-success" target="_blank" href="https://wa.me/9<?=str_replace(" ","",$data_kullanici->kullanici_bireysel_iletisim_no)?>" > Mesaj Gönder</a> 
                  </li>
                  <li class="list-group-item">
                    <b>SMS Hızlı İletişim</b> <a class="float-right text-success" href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=iletisim")?>" > SMS Gönder</a> 
                  </li>
                </ul>

                <a href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=parameter")?>" class="btn btn-primary btn-block p-3"><b><i class="fa fa-pen"></i> Menü Parametrelerini Düzenle</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary d-none">
              <div class="card-header">
                <h3 class="card-title">Kullanıcı Hakkında Genel Bilgiler </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Çalışma Hayatı</strong>

                <p class="text-muted">
                  İşe Giriş :<?=date("d.m.Y",strtotime($data_kullanici->kullanici_ise_giris_tarihi))?>
                  İşten Ayrılma: (*Devam Ediyor)
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Adres</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9 pr-0">
            <div class="card">
              <div class="card-header p-2"  >
                <ul class="nav nav-pills">

                <?php
                if($data_kullanici->ozluk_menu_gorunum == 1){
                  ?>
<li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "ozluk-dosyasi" ? "btn-primary text-white" : "btn-default"?>"  href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=ozluk-dosyasi")?>"  >
                  <i class="nav-icon fas fa-folder" style="font-size:13px"></i>  
                  Özlük Dosyası</a></li>
                  <?php
                }
                ?>
 <?php
                if($data_kullanici->arac_menu_gorunum == 1){
                  ?>
                   <li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "arac-bilgisi" ? "btn-primary text-white" : "btn-default"?>" style="margin-left: 6px;"  href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=arac-bilgisi")?>"  >
                  <i class="nav-icon fas fa-car" style="font-size:13px"></i>  
                  Araç Bilgisi</a></li>
                  <?php
                }
                ?>

<?php
                if($data_kullanici->satis_menu_gorunum == 1){
                  ?>
                   
                   <li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "satis" ? "btn-primary text-white" : "btn-default"?>" style="margin-left: 6px;" href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=satis&selected_month=0&selected_year=2025")?>" >
                  <i class="nav-icon 	fas fa-people-arrows " style="font-size:13px"></i>  
                  Satış Rapor</a></li>
                  <?php
                }
                ?>

<?php
                if($data_kullanici->egitim_menu_gorunum == 1){
                  ?>
                     <li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "egitim" ? "btn-primary text-white" : "btn-default"?>" style="margin-left: 6px;" href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=egitim")?>">
                  <i class="nav-icon 	fas fa-people-arrows " style="font-size:13px"></i>  
                  Eğitim Rapor</a></li>
                  <?php
                }
                ?>

<?php
                if($data_kullanici->talep_menu_gorunum == 1){
                  ?>
                  
                  <li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "talep" ? "btn-primary text-white" : "btn-default"?>" style="margin-left: 6px;"  href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=talep")?>">
                  <i class="nav-icon 	fas fa-phone " style="font-size:13px"></i>  
                  Talep Rapor</a></li>
                  <?php
                }
                ?>

<?php
                if($data_kullanici->mesai_menu_gorunum == 1){
                  ?>
                   
                   <li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "mesai-bilgileri" ? "btn-primary text-white" : "btn-default"?>"  style="margin-left: 6px;" href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=mesai-bilgileri")?>"  >
                  <i class="nav-icon 	fas fa-calendar " style="font-size:13px"></i>  
                  Mesai Bilgileri</a></li>
                  <?php
                }
                ?>

<?php
                if($data_kullanici->envanter_menu_gorunum == 1){
                  ?>
                   <li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "envanter" ? "btn-primary text-white" : "btn-default"?>" style="margin-left: 6px;"  href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=envanter")?>"  >
                  <i class="nav-icon 	fas fa-award " style="font-size:13px"></i>  
                  Envanter</a></li>
                  <?php
                }
                ?>
<?php
                if($data_kullanici->iletisim_menu_gorunum == 1){
                  ?>
                   <li class="nav-item" style="flex: 1;"><a class="nav-link btn <?=$_GET["subpage"] == "iletisim" ? "btn-primary text-white" : "btn-default"?>" style="margin-left: 6px;" href="<?=base_url("kullanici/profil_new/$data_kullanici->kullanici_id?subpage=iletisim")?>"  >
                  <i class="nav-icon 	fas fa-envelope " style="font-size:13px"></i>  
                  İletişim</a></li>
                  <?php
                }
                ?>




                
                
              
                 
                 
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body" style="  overflow-y: auto;    height: 782px;   padding: 0px;!important">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">

                  <?php
                  $this->load->view($subpage);
                  ?>

                  </div>
                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>