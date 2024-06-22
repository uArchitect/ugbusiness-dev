<div class="content-wrapper">
  <section class="content col">
     <div class="card card-dark" style=" ">
       <div class="card-header with-border" style="background:#061f3a">
          <h3 class="card-title text-center">
            UG Business - Servis Detayları - <?=$servis->servis_kod?>
          </h3>
       
        <div class="card-tools">
          <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>" class="btn btn-success <?=((!empty($_GET["filter"]))?"":"d-none")?>"><i class="fas fa-arrow-circle-left"></i> SERVİS İŞLEM SAYFASINA GİT</a>
          <a href="?filter=duzenle" class="btn btn-warning <?=((!empty($_GET["filter"]))?"d-none":"")?>" style="color: white;background: #0a376b;border: 0px;"><i class="far fa-edit"></i> SERVİS BİLGİLERİNİ DÜZENLE</a>
        </div>
        </div>
        <div class="card-body">
        
        </div>
      </div>
   




<div class="row">
  <div class="col-3">




  <div class="card card-dark <?=(!empty($_GET["filter"]) ? "d-none":"")?>" style=" ">
          <div class="card-header with-border" style="background:#061f3a">
          <h3 class="card-title text-center">
            CİHAZ ESKİ SERVİS KAYITLARI
          </h3>
          </div>
          <div class="card-body">

          

             





          </div>
        </div>
     





  </div>
  <div class="col">




      <div class="card card-dark <?=(!empty($_GET["filter"]) ? "d-none":"")?>" style=" ">
          <div class="card-header with-border" style="background:#061f3a">
          <h3 class="card-title text-center">
            SERVİS İŞLEMLER
          </h3>
          </div>
          <div class="card-body">

          

            <table class="table text-md table-bordered table-striped nowrap">
              <thead>
                <tr>
                  <th style="width:30%"><i class="far fa-user"></i> İşlem Detayı</th>
                  <th style="width:220px"><i class="far fa-calendar-alt"></i> İşlem Tarihi</th>
                  <th><i class="far fa-comment-dots"></i> İşlem Açıklaması</th>
                  <th style="width:275px"><i class="fas fa-tasks"></i> İşlem</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach ($servis_islemleri as $islem) {
                  ?>

                    <tr>   
                      <td>
                        <?=$islem->servis_islem_kategori_adi?>
                      </td>

                  
                      <td>
                      <?=date("d.m.Y H:i:s",strtotime($islem->servis_islem_kayit_tarihi))?>
                      </td>
                      <td> <?=($islem->servis_islem_aciklama != "") ? $islem->servis_islem_aciklama : "<span style='opacity:0.6'>İşlem Açıklaması Girilmedi.</span>"?></td>
                      <td>
                      <button class="btn btn-dark"><i class="fas fa-edit"></i> Bilgileri Düzenle</button>
                        <button class="btn btn-danger" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu işlem kaydını silmek istediğinize emin misiniz? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_islem_sil/'.$servis->servis_id.'/'.$islem->servis_islem_id )?>');"><i class="fas fa-user-times"></i> İşlemi Sil</button>
                      </td>
                  
                    </tr>

                  <?php
                }
                ?>
                
              </tbody>
            </table>






          </div>
        </div>
     











        <div class="card card-dark <?=(!empty($_GET["filter"]) ? "d-none":"")?>" style=" ">
          <div class="card-header with-border" style="background:#007317">
          <h3 class="card-title text-center">
            YENİ SERVİS İŞLEMİ TANIMLA
          </h3>
          </div>
          <div class="card-body">

          <form action="<?=base_url("servis/servis_islem_tanimla/".$servis->servis_id)?>" method="POST">
              <div class="form-group">
                <label for="formClient-Code"> Servis İşlem </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
                <select name="servis_islem_tanim_id" id="servis_islem_tanim_id" required class="select2 form-control rounded-0" style="width: 100%;">
                  <option value="">İşlem Seçiniz</option>
                  <?php 
                    foreach ($servis_islem_kategorileri as $islem_kategori) {
                  ?>
                    <option value="<?=$islem_kategori->servis_islem_kategori_id ?>"><?=$islem_kategori->servis_islem_kategori_adi?></option>
                  <?php
                    }
                  ?>
                </select>   
              </div>
              <div class="form-group">
                <label for="formClient-Code"> Servis İşlem Açıklama </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*İsteğe Bağlı)</label>
                <textarea type="text" class="form-control mb-2" name="servis_islem_aciklama" placeholder="İşlem açıklamasını giriniz..."></textarea>
              
              </div>
              <button class="btn btn-success" type="submit"><i class="far fa-save"></i> İşlemi Kaydet</button>
            </form>


          </div>
        </div>
     




  </div>
</div>












        <div class="card card-dark <?=(empty($_GET["filter"]) ? "d-none":"")?>" style=" ">
          <div class="card-header with-border" style="background:#061f3a">
          <h3 class="card-title text-center">
            SERVİS KULLANICI
          </h3>
          </div>
          <div class="card-body">

          

          <table id="servisDetaylariTable" class="table text-md table-bordered table-striped nowrap">
      <thead>
        <tr>
          <th style="width:20%"><i class="far fa-user"></i> Teknisyen Ad Soyad</th>
          <th style="width:20%"><i class="far fa-calendar-alt"></i> Tanımlanma Tarihi</th>
          <th><i class="far fa-comment-dots"></i> Görev Açıklaması</th>
          <th style="width:275px"><i class="fas fa-tasks"></i> İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($servis_gorevleri as $gorev) {
          ?>

            <tr>
              <td>
                <?=$gorev->kullanici_ad_soyad?>
              </td>
              <td>
              <?=date("d.m.Y H:i:s",strtotime($gorev->servis_gorev_kayit_tarihi))?>
              </td>
              <td> <?=($gorev->servis_gorev_aciklama != "") ? $gorev->servis_gorev_aciklama : "<span style='opacity:0.6'>Görev Açıklaması Girilmedi.</span>"?></td>
              <td>
              <button class="btn btn-dark"><i class="fas fa-edit"></i> Bilgileri Düzenle</button>
                <button class="btn btn-danger" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu görev kaydını silmek istediğinize emin misiniz? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_gorev_sil/'.$servis->servis_id.'/'.$gorev->servis_gorev_id)?>');"><i class="fas fa-user-times"></i> Teknisyeni Sil</button>
              </td>
          
            </tr>

          <?php
        }
        ?>
        
      </tbody>
    </table>







          </div>
        </div>


















        <div class="card card-dark <?=(empty($_GET["filter"]) ? "d-none":"")?>" style=" ">
          <div class="card-header with-border" style="background:#bd0520">
          <h3 class="card-title text-center">
            YENİ SERVİS TEKNİSYENİ TANIMLA
          </h3>
          </div>
          <div class="card-body">

          
<form action="<?=base_url("servis/servis_gorev_tanimla/".$servis->servis_id)?>" method="POST">
<div class="row">
<div class="col-3">
<select class="select2 form-control" name="servis_gorev_kullanici_id" required>
<option value="">Teknisyen Seçiniz</option>
                         <?php 
              foreach ($kullanicilar as $kullanici) {
                ?>
                <option value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?></option>
                <?php
              }
              ?>
            </select>
</div>
<div class="col-7">
<input type="text" class="form-control" name="servis_gorev_aciklama" placeholder="Görev açıklamasını giriniz...">
</div>
<div class="col-2">
<button class="btn btn-success" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> Teknisyeni Kaydet</button>
</div>
</div>
</form>


          </div>
        </div>







  </section>
</div>




 <style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #104cbd;
    border-color: #dee2e6 #dee2e6 #fff;
}
.table th {
    background: #ffffff !important;
    color: #174b85;
    padding: 12px;
    padding-left: 10px;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}
  </style>