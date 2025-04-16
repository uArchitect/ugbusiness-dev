
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-12">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  DEPARTMAN BAZLI STOK TANIMLA
                </h3>
              </div>
              <div class="card-body" style="height: 800px;">
                <div class="row">
                  <div class="col-12 col-lg-6">
                    <h4 class="text-primary">Üretim Departmanı  </h4>
                    <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Yeni Stok Tanımla
                <br>
<small>
  Sisteme tanımlı <?=count($stoklar)?> adet stok listelenmiştir. Yeni stok kaydı açmak için <a href="javascript:void(0);" class="stokEkleBtn">tıklayınız</a>
</small>
                </h3>
              </div>
              <div class="card-body">
               <form action="<?=base_url("zimmet/departmana_stok_tanimla/1")?>" method="post">
               <div class="row">
                  <div class="col-5">
                  <select required name="zimmet_stok_no" class="select2 form-control" id="">

<option value="">Stok Seçimi Yapınız</option>

                     
                     <?php 
                      foreach ($stoklar as $s) {
                       ?>
                       <option value="<?= $s->zimmet_stok_id?>"><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-5">
                    <input type="number" name="zimmet_hareket_giris_miktar" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>


            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 22px; font-weight: 600; margin-top: 2px;">Üretim Departmanı <small>(Tanımlanan Stoklar)</small></h3>
                <div class="card-tools">
                <div class="btn-group">
                        <button type="button" onclick="table_show1('table_1_kategori');" class="btn btn-default btn-sm"><i class="far fa-folder-open nav-icon mr-1" aria-hidden="true"></i>Kategori</button>
                        <button type="button" onclick="table_show1('table_1_detay');" class="btn btn-default btn-sm"><i class="fa fa-list mr-1" aria-hidden="true"></i> Detay</button> 
                      </div>
                </div>
              </div>
              <div class="card-body">
              <table id="table_1_kategori" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Toplam Verilen</th>
                      <th>Toplam Dağıtılan</th>
                      <th>Kalan</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketler as $h) {
                      if($h->zimmet_departman_no != 1){
                        continue;
                      }
                      $flag1 = ($this->session->flashdata('departmanID')==1&&$this->session->flashdata('insertedID')==$h->zimmet_stok_no);
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?>(<?=$h->zimmet_departman_adi?>)</td>
                      <td><?=$h->toplam_giris?>
                    <?php 
                    if($flag1){
                      ?>
                      <img src="https://i.pinimg.com/originals/49/02/54/4902548424a02117b7913c17d2e379ff.gif" style=" width: 18px; margin: 0; scale: 1.9; margin-top: -2px; ">
                      <span class="text-success">+<?=$this->session->flashdata('count')?> Eklendi</span>
                      <?php
                    }
                    ?>
                    </td>
                      <td><?=$h->toplam_cikis?></td>
                      <td><?=$h->kalan?></td>
                       
                    </tr>
                     <?php
                    }
                    ?>
                     
                  </tbody>
                </table>







                <table id="table_1_detay" style="display:none;" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Verilen</th>
                      <th>İşlem Tarihi</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketlerdetay as $h) {
                      if($h->zimmet_departman_no != 1){
                        continue;
                      }
                     
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?>(<?=$h->zimmet_departman_adi?>)</td>
                      <td><?=$h->zimmet_hareket_giris_miktar?>
                     
                      <td><?=date("d.m.Y h:i",strtotime($h->zimmet_hareket_tarihi))?></td>
                       
                    </tr>
                     <?php
                    }
                    ?>
                     
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>


                  </div>
                  <div class="col-12 col-lg-6">
                    <h4 class="text-danger">Servis Departmanı  </h4>
                    <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Yeni Stok Tanımla
<br>
<small>
  Sisteme tanımlı <?=count($stoklar)?> adet stok listelenmiştir. Yeni stok kaydı açmak için <a href="javascript:void(0);" class="stokEkleBtn">tıklayınız</a>
</small>

                </h3>
             
              </div>
              <div class="card-body">
              <form action="<?=base_url("zimmet/departmana_stok_tanimla/2")?>" method="post">
               <div class="row">
                  <div class="col-5">
                    <select required name="zimmet_stok_no" class="select2 form-control" id="">

                    <option value="">Stok Seçimi Yapınız</option>

                      <?php 
                      foreach ($stoklar as $s) {
                       ?>
                       <option value="<?= $s->zimmet_stok_id?>"><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-5">
                    <input type="number" required name="zimmet_hareket_giris_miktar" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-danger" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>



<div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 22px; font-weight: 600; margin-top: 2px;">Servis Departmanı <small>(Tanımlanan Stoklar)</small></h3>
                <div class="card-tools">
                <div class="btn-group">
                        <button type="button" onclick="table_show2('table_2_kategori');" class="btn btn-default btn-sm"><i class="far fa-folder-open nav-icon mr-1" aria-hidden="true"></i>Kategori</button>

                        <button type="button" onclick="table_show2('table_2_detay');" class="btn btn-default btn-sm"><i class="fa fa-list mr-1" aria-hidden="true"></i> Detay</button> 
                      </div>
                </div>
              </div>
              <div class="card-body">
              <table id="table_2_kategori" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Toplam Verilen</th>
                      <th>Toplam Dağıtılan</th>
                      <th>Kalan</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketler as $h) {
                      if($h->zimmet_departman_no != 2){
                        continue;
                      }
                      $flag1 = ($this->session->flashdata('departmanID')==2&&$this->session->flashdata('insertedID')==$h->zimmet_stok_no);
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?>(<?=$h->zimmet_departman_adi?>)</td>
                      <td><?=$h->toplam_giris?>
                    <?php 
                    if($flag1){
                      ?>
                      <img src="https://i.pinimg.com/originals/49/02/54/4902548424a02117b7913c17d2e379ff.gif" style=" width: 18px; margin: 0; scale: 1.9; margin-top: -2px; ">
                      <span class="text-success">+<?=$this->session->flashdata('count')?> Eklendi</span>
                      <?php
                    }
                    ?>
                    </td>
                      <td><?=$h->toplam_cikis?></td>
                      <td><?=$h->kalan?></td>
                       
                    </tr>
                     <?php
                    }
                    ?>
                     
                  </tbody>
                </table>


                <table id="table_2_detay" style="display:none;" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Verilen</th>
                      <th>İşlem Tarihi</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketlerdetay as $h) {
                      if($h->zimmet_departman_no != 2){
                        continue;
                      }
                     
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?>(<?=$h->zimmet_departman_adi?>)</td>
                      <td><?=$h->zimmet_hareket_giris_miktar?>
                     
                      <td><?=date("d.m.Y H:i",strtotime($h->zimmet_hareket_tarihi))?></td>
                       
                    </tr>
                     <?php
                    }
                    ?>
                     
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>






            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Kullanıcıya Envanter Tanımla
 
                </h3>
             
              </div>
              <div class="card-body">
              <form action="<?=base_url("zimmet/kullaniciya_stok_tanimla/2")?>" method="post">
               <div class="row">
               <div class="col-3">
                    <select required name="zimmet_kullanici_no" class="select2 form-control" id="">

                    <option value="">Kullanıcı Seçiniz</option>

                      <?php 
                      foreach ($kullanicilar as $s) {
                       ?>
                       <option value="<?= $s->kullanici_id?>"><?=$s->kullanici_ad_soyad?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3">
                    <select required name="zimmet_stok_no" class="select2 form-control" id="">

                    <option value="">Stok Seçiniz</option>

                      <?php 
                      foreach ($stoklar as $s) {
                       ?>
                       <option value="<?= $s->zimmet_stok_id?>"><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3">
                    <input type="number" required name="zimmet_hareket_giris_miktar" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-3">
                    <button type="submit" class="btn btn-danger" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>






                  </div>
                </div>
            
                
              </div>
              <!-- /.card -->
            </div>
          </div>
</div>




<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function table_show1($id){
  document.getElementById("table_1_detay").style.display="none";
  document.getElementById("table_1_kategori").style.display="none"; 
  document.getElementById($id).style.display="table";
}
function table_show2($id){ 
  document.getElementById("table_2_detay").style.display="none";
  document.getElementById("table_2_kategori").style.display="none";
  document.getElementById($id).style.display="table";
}


document.getElementsByClassName("stokEkleBtn").addEventListener("click", function () {
    Swal.fire({
        title: 'Yeni Stok Ekle',
        input: 'text',
        inputLabel: 'Stok Adı',
        inputPlaceholder: 'Stok adını giriniz...',
        showCancelButton: true,
        confirmButtonText: 'Ekle',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed && result.value.trim() !== "") {
            // AJAX ile veriyi gönder
            fetch("<?= base_url('zimmet/yeni_stok_ekle') ?>", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: "zimmet_stok_adi=" + encodeURIComponent(result.value)
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "ok") {
                  Swal.fire('Başarılı', 'Stok başarıyla eklendi!', 'success').then(() => {
    location.reload();
});
                } else {
                    Swal.fire('Hata', 'Bir sorun oluştu.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Hata', 'Sunucuya bağlanılamadı.', 'error');
            });
        }
    });
});
</script>
