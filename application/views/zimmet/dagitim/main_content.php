
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-12">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  KULLANICI BAZLI STOK TANIMLA
                </h3>
              </div>
              <div class="card-body"  >
               
            

 <?php 
 $aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');
 $is_user_40 = ($aktif_kullanici_id == 40);
 ?>
 
 <div class="row">
  <div class="col-lg-5">



  <div class="card card-dark card-outline">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 22px; font-weight: 600; margin-top: 2px;"><?=$secilen_departman == 1 ? "Üretim" : "Servis"?> Departmanı <small>(Tanımlanan Stoklar)</small></h3>
               
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
                      if($h->zimmet_departman_no != $secilen_departman){
                        continue;
                      }
                      $flag1 = ($this->session->flashdata('departmanID')==$secilen_departman&&$this->session->flashdata('insertedID')==$h->zimmet_stok_no);
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?> </td>
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
 
              </div>
              <!-- /.card-body -->
            </div>













  </div>


  <?php if(!$is_user_40): ?>
  <div class="col-lg-7">
    <div class="row">
                  <div class="col-12">
                



<div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">Kullanıcılar Verilen Envanter Bilgileri
 
                </h3>
             
              </div>
              <div class="card-body">
              <?php 
$gruplar = [];
foreach ($kullanicihareketlerdetay as $h) {
    if($h->zimmet_departman_no != $secilen_departman || $h->zimmet_hareket_cikis_miktar == 0){
        continue;
    }
    $gruplar[$h->kullanici_id]['adsoyad'] = $h->kullanici_ad_soyad;
    $gruplar[$h->kullanici_id]['veriler'][] = $h;
}
?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Kullanıcı</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($gruplar as $kullanici_id => $kullanici): ?>
            <tr class="kullanici-row" data-target="detay-<?=$kullanici_id?>">
                <td><i class="fa fa-chevron-down"></i></td>
                <td><a href="<?=base_url("kullanici/profil_new/$kullanici_id?subpage=envanter")?>" target="_blank"><?=($kullanici['adsoyad'] == "YASİN AYDIN" ? "<span style='color:red'>STOK ÇANTA</span>":$kullanici['adsoyad'])?></a></td>
                <td></td>
            </tr>

            <tr class="detay-row detay-<?=$kullanici_id?>" style="display: none;">
                <td colspan="3">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Stok Adı</th>
                                <th>Miktar</th>
                                <th>İşlem Tarihi</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($kullanici['veriler'] as $veri): ?>
                              <?php 
                                $urrr = base_url("zimmet/hareket_sil/$veri->zimmet_hareket_id");
                                ?>
                                <tr>
                                    <td><?=$veri->zimmet_stok_adi?></td>
                                    <td><?=$veri->zimmet_hareket_cikis_miktar?></td>
                                    <td><?=date("d.m.Y H:i", strtotime($veri->zimmet_hareket_tarihi))?></td>
                                    <td>
                                        <a href="<?=base_url("zimmet/dagitim/$secilen_departman/$veri->zimmet_hareket_id")?>" class="btn btn-default btn-sm"><i class="fa fa-pen"></i></a>
                                        <a  onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=$urrr?>');"   class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

              </div>
              <!-- /.card-body -->
            </div>


                

            <?php 
            
            if(!empty($secilen_hareket)){
              ?>
 <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Hareket Bilgilerini Düzenle
 
                </h3>
             
              </div>
              <div class="card-body">
              <form action="<?=base_url("zimmet/kullaniciya_stok_tanim_guncelle/$secilen_departman/$secilen_hareket->zimmet_hareket_id ")?>" method="post">
               <div class="row">
               <div class="col-3">
                    <select required name="zimmet_kullanici_no" class="select2 form-control" id="">

                    <option value="">Kullanıcı Seçiniz</option>

                      <?php 
                      foreach ($kullanicilar as $s) {
                        if($s->zimmet_departman_kullanici_tanim_departman_no != $secilen_departman){
                          continue;
                        }
                       ?>
                       <option value="<?= $s->kullanici_id?>" <?=($secilen_hareket->zimmet_kullanici_no == $s->kullanici_id ? "selected" : "")?>><?=$s->kullanici_ad_soyad?></option>
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
                       <option value="<?= $s->zimmet_stok_id?>" <?=($secilen_hareket->zimmet_stok_no == $s->zimmet_stok_id ? "selected" : "")?>><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3">
                  <input type="hidden"   name="temp_miktar" class="form-control" min="1"  value="<?=$secilen_hareket->zimmet_hareket_cikis_miktar?>">
                    <input type="number" required name="zimmet_hareket_giris_miktar" value="<?=$secilen_hareket->zimmet_hareket_cikis_miktar?>" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-3">
                    <button type="submit" class="btn btn-success" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>
              <?php
            }
            ?>

           


<div class="card card-danger ">
              <div class="card-header">
                <h3 class="card-title">Kullanıcıya Stok Tanımlama 
 
                </h3>
             
              </div>
              <div class="card-body">


              <form action="<?=base_url("zimmet/toplu_stok_kaydet/$secilen_departman")?>" method="post">

              <h4>Kullanıcı Seçimi Yapınız</h4>


              <select  name="zimmet_kullanici_no" class="select2 form-control  " style="margin-bottom:10px!important" required>

                    <option value="">Kullanıcı Seçiniz</option>

                      <?php 
                      foreach ($kullanicilar as $s) {
                        if($s->zimmet_departman_kullanici_tanim_departman_no != $secilen_departman){
                          continue;
                        }
                       ?>
                       <option value="<?= $s->kullanici_id?>"><?=$s->kullanici_ad_soyad?></option>
                       <?php
                      }
                      ?>
                    </select>
<br>
              <div style="height:500px;overflow: auto;">
              <table id="table_2_toplustok" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 250px">Stok Adı</th> 
                      <th style="width: 120px" >Verilecek Miktar</th> 
                      <th>Güncel Stok</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketler as $h) {
                      if($h->zimmet_departman_no != $secilen_departman){
                        continue;
                      }
                      $flag1 = ($this->session->flashdata('departmanID')==$secilen_departman&&$this->session->flashdata('insertedID')==$h->zimmet_stok_no);
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?> </td>
                      <td>
                        <input type="hidden" name="id[]" class="form-control"  value="<?=$h->zimmet_stok_id?>"> 
                        <input type="number" name="miktar[]" class="form-control" min="1" max="<?=$h->kalan?>">
                      </td>
                      <td><?=$h->kalan?></td>
                    
                      
                    </tr>
                     <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
                <button type="submit" class="btn btn-success" style="width: -webkit-fill-available; padding: 11px; margin-top: 10px;font-size:16px!important">Bilgileri Kaydet</button>

</form>
              </div>
              <!-- /.card-body -->
            </div>





                  </div>
                </div>

  </div>

 </div>








                
              </div>
              <!-- /.card -->
            </div>
          </div>
</div>
 


<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 



 <script type="text/javascript">
     $(document).ready(function() {
      var table245 = $("#table_2_toplustok").DataTable({ "ordering": false, "pageLength": 999 });
        var table246 = $("#table_2_verilenler").DataTable({ "ordering": false, "pageLength": 10 });
     
  var table246 = $("#table_2_kategori").DataTable({ "ordering": false, "pageLength": 41 });
     
   $(".kullanici-row").click(function(){
        var target = $(this).data("target");
        $("." + target).toggle();
        $(this).find("i").toggleClass("fa-chevron-down fa-chevron-up");
    });
     });
 </script>