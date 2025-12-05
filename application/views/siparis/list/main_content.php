<?php $this->load->view('siparis/includes/styles'); ?>

<style>
  .sel {
    background-color: green!important;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        
        <?php if(empty($onay_bekleyen_siparisler) && empty($siparisler)): ?>
        <div class="alert alert-dismissible" style="border: 1px solid #e3e3e1;padding-right:10px;max-width:450px;margin:auto;margin-top:20%;">
          <h5 style="text-align:center;">
            <i class="icon fas fa-info-circle mb-2" style="font-size:50px;color:black"></i> <br>Sistem Bilgilendirme
            <br><span style="text-align:center;font-weight:normal;font-size:16px">Onayda bekleyen sipariş kaydı bulunamadı.Onaya düşen sipariş bilgileri burada görüntülenecektir.</span>
          </h5>
        </div>
        <?php endif; ?>

        <?php if(!empty($onay_bekleyen_siparisler)) : ?>
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="far fa-check-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Onay Bekleyen Siparişler
                  </h3>
                  <small class="card-header-subtitle">Onay bekleyen siparişleri görüntüle ve yönet</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('siparis/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <div class="btn-group d-flex mb-3">
                <a type="button" href="?filter=3" class="btn <?=isset($_GET['filter']) && $_GET['filter'] == '3' ? 'btn-primary' : 'btn-outline-primary'?>" style="font-size: x-large !important;">Tüm Siparişler</a>
                <a type="button" href="?filter=2" class="btn <?=empty($_GET['filter']) || $_GET['filter'] == '2' ? 'btn-success' : 'btn-outline-success'?>" style="font-size: x-large !important;">Onay Bekleyen Siparişler</a>
                <a type="button" href="?filter=1" class="btn <?=isset($_GET['filter']) && $_GET['filter'] == '1' ? 'btn-dark' : 'btn-outline-dark'?>" style="font-size: x-large !important;">Beklemede Olan Siparişler</a>
              </div>
              <div class="table-responsive">
                <table id="onaybekleyensiparisler" class="table table-siparis table-bordered table-striped nowrap">
                  <thead>
                    <tr>
                      <th style="width: 42px;">Kayıt No</th> 
                      <th>Müşteri Adı</th>
                      <th>Merkez Detayları</th>
                      <th style="width: 130px;">Sipariş Oluşturan</th>   
                      <th style="width: 130px;min-width: 260px;">Son Durum</th>
                      <th style="width: 120px;">Sipariş İşlemleri</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $ak = aktif_kullanici()->kullanici_id;
                    $count=0; 
                    foreach ($onay_bekleyen_siparisler as $siparis): 
                      $data = get_son_adim($siparis->siparis_id);
                      $tum_siparisler_tabi = (!empty($_GET["filter"]) && $_GET["filter"] == "3");
                      
                      // Tüm Siparişler tabında (filter=3) özel kontrolleri atla
                      if(!$tum_siparisler_tabi) {
                        if($ak == 2){
                          if($siparis->siparisi_olusturan_kullanici != 2 && $siparis->siparisi_olusturan_kullanici != 5 && $siparis->siparisi_olusturan_kullanici != 18 && $siparis->siparisi_olusturan_kullanici != 94 ){
                            continue;
                          }
                        }
                        
                        if($siparis->siparis_ust_satis_onayi == 1 && ($i_kul== 7 || $i_kul == 9 || $i_kul == 1)){
                          if($data[0]->adim_id == 4){
                            continue;
                          }
                        }
                        if($siparis->siparis_ust_satis_onayi == 0 && ($i_kul== 37 || $i_kul== 8)){
                          continue;
                        }
                        
                        if($ak != 37){
                          if($data[0]->adim_id >= 11){
                            if(strpos($siparis->egitim_ekip, "\"$ak\"") == false){
                              continue;
                            }
                          }
                        }
                      }
                      
                      if(!empty($_GET["filter"])){
                        if($_GET["filter"] == "1" && $siparis->beklemede == 0){
                          if($ak != 9){
                            continue;
                          }
                        }
                        if($_GET["filter"] == "2" && $siparis->beklemede == 1){
                          continue;
                        }
                      }
                      
                      $count++; 
                      $link = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                    ?>
                    <tr style="cursor:pointer;">
                      <td>
                        <span style="display: block;">
                          <b>#<?=$siparis->siparis_id?></b>
                          <?php 
                          if(hatali_fiyat_kontrol($siparis->siparis_id) == 1):
                          ?>
                            <br>
                            <a class="btn btn-danger btn-xs yanipsonenyazinew" style="font-size: 10px !important;color:white">
                              <i class="fas fa-exclamation-circle"></i> HATALI FİYAT
                            </a>
                          <?php else: ?>
                            <br>
                            <a class="btn btn-success btn-xs" style="font-size: 10px !important;color:white">
                              <i class="fas fa-check"></i> FİYAT GEÇERLİ
                            </a>
                          <?php endif; ?>
                        </span>
                      </td> 
                      <td>
                        <i class="far fa-user-circle" style="margin-right:1px;opacity:1"></i> 
                        <b><?php echo "<a target='_blank' href='".base_url("musteri/profil/$siparis->musteri_id")."'>".$siparis->musteri_ad."</a>"; ?></b> 
                        <br>İletişim : <?=$siparis->musteri_iletisim_numarasi?> <?=$siparis->musteri_sabit_numara ? "<br>".$siparis->musteri_sabit_numara : ""?> 
                      </td>
                      <td>
                        <b><?=($siparis->merkez_adi == "#NULL#") ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;'><i class='nav-icon fas fa-exclamation-circle'></i> Merkez Adı Girilmedi</span>":'<i class="far fa-building" style="color: green;"></i> '.$siparis->merkez_adi?> - </b> 
                        <span style="color:#1461c3;"><?=$siparis->sehir_adi?> / <?=$siparis->ilce_adi?></span>  
                        <br><span style="font-size:14px"><?=($siparis->merkez_adresi == "" || $siparis->merkez_adresi == "0" || $siparis->merkez_adresi == ".") ? "ADRES GİRİLMEDİ" : $siparis->merkez_adresi?></span>
                      </td>           
                      <td>
                        <b>
                          <i class="far fa-user-circle" style="color:green;margin-right:1px;opacity:1"></i>  
                          <?php echo "<a target='_blank' href='".base_url("kullanici/profil_new/$siparis->kullanici_id")."?subpage=ozluk-dosyasi'>".$siparis->kullanici_ad_soyad."</a>"; ?>
                        </b>
                        <br><?=date('d.m.Y H:i',strtotime($siparis->kayit_tarihi));?>
                      </td>
                      <td>
                        <?php echo "<b>".$data[0]->adim_adi."</b> Bekleniyor..."; ?>
                        <br>
                        <div>
                          <div class="row">
                            <?php for($i=1; $i<=12; $i++): ?>
                            <div class="mr-1" style="border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= $i ? (($siparis->adim_no+1 == $i) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;display: inline-flex;">
                              <i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= $i) ? "display:none;" : ""?>"></i>
                            </div>
                            <?php endfor; ?>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php 
                        if($data[0]->adim_sira_numarasi == 4 && $siparis->siparis_ust_satis_onayi == 0 && (aktif_kullanici()->kullanici_id == 37 || aktif_kullanici()->kullanici_id == 8)):
                        ?>
                          <button type="button" style="height: 47px;padding-top: 13px;border: 1px solid #5b4002;font-weight: 400!important;opacity:0.5" class="btn btn-danger btn-xs">
                            <b>ONAY BEKLENİYOR</b>
                          </button>
                        <?php else: ?>
                          <a type="button" style="height: 47px;padding-top: 13px;border: 1px solid #5b4002;font-weight: 400!important;" onclick="showWindow2('<?=$link?>');" class="btn btn-warning btn-xs">
                            <i class="fas fa-search" style="font-size:14px" aria-hidden="true"></i> <b>GÖRÜNTÜLE</b>
                          </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <?php if(!empty($siparisler)) : ?>
        <div class="card card-siparis" style="margin-top: <?=!empty($onay_bekleyen_siparisler) ? '20px' : '0'?>;">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-list card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Tüm Siparişler
                  </h3>
                  <small class="card-header-subtitle">Tüm siparişleri görüntüle ve yönet</small>
                </div>
              </div>
              <a href="<?=base_url("siparis/merkez")?>" type="button" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Yeni Kayıt Ekle
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('siparis/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <!-- Filtreler -->
            <div class="row mb-3 filter-row">
              <form method="GET" action="<?=base_url('tum-siparisler')?>" id="filterForm" class="filter-form">
                <div class="row filter-row-inner">
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Şehir</label>
                    <select name="sehir_id" class="form-control filter-form-control">
                      <option value="">Tümü</option>
                      <?php if(!empty($sehirler)): ?>
                        <?php foreach($sehirler as $sehir): ?>
                          <option value="<?=$sehir->sehir_id?>" <?=isset($selected_sehir_id) && $selected_sehir_id == $sehir->sehir_id ? 'selected' : ''?>>
                            <?=$sehir->sehir_adi?>
                          </option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Kullanıcı</label>
                    <select name="kullanici_id" class="form-control filter-form-control">
                      <option value="">Tümü</option>
                      <?php if(!empty($kullanicilar)): ?>
                        <?php foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?=isset($selected_kullanici_id) && $selected_kullanici_id == $kullanici->kullanici_id ? 'selected' : ''?>>
                            <?=$kullanici->kullanici_ad_soyad?>
                          </option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Başlangıç Tarihi</label>
                    <input type="date" name="tarih_baslangic" class="form-control filter-form-control" value="<?=isset($selected_tarih_baslangic) ? $selected_tarih_baslangic : ''?>">
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Bitiş Tarihi</label>
                    <input type="date" name="tarih_bitis" class="form-control filter-form-control" value="<?=isset($selected_tarih_bitis) ? $selected_tarih_bitis : ''?>">
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Teslim Durumu</label>
                    <select name="teslim_durumu" class="form-control filter-form-control">
                      <option value="">Tümü</option>
                      <option value="1" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '1' ? 'selected' : ''?>>Teslim Edildi</option>
                      <option value="0" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '0' ? 'selected' : ''?>>Teslim Edilmedi</option>
                    </select>
                  </div>
                  <div class="col-md-2 filter-col filter-buttons-wrapper">
                    <button type="submit" class="btn btn-primary filter-btn-primary">
                      <i class="fa fa-filter"></i> Filtrele
                    </button>
                    <a href="<?=base_url('tum-siparisler')?>" class="btn btn-secondary filter-btn-secondary">
                      <i class="fa fa-times"></i> Temizle
                    </a>
                  </div>
                </div>
              </form>
            </div>

            <div class="card-body-content">
              <div class="table-responsive">
                <table id="users_tablce" class="table table-siparis table-bordered table-striped nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th style="width: 42px;">Sipariş Kodu</th> 
                      <th>Müşteri Adı</th> 
                      <th>Adres</th>
                      <th style="width: 130px;">Siparişi Oluşturan</th>
                      <th>İşlem</th> 
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </section>
</div>

<style>
  .swal2-content iframe {
    width: 90%;
    height: 100%;
    border: none;
  }

  .swal2-html-container{
    height: 690px;
    display: block;
    padding: 0px !important;
    margin: 0px!important;
  }
  
  .swal2-title{
    display: none!important;
    padding: 0!important;
  }
  
  .swal2-close{
    background: red!important;
    color: white!important;
  }
</style>

<script>
  function showdetail(e,param){
    Swal.fire({
      html: '<iframe src="'+param+'" width="100%" height="100%" frameborder="0"></iframe>',
      showCloseButton: true,
      showConfirmButton: false,
      focusConfirm: false,
      width: '80%',
      height: '80%',
    });
    e.classList.add('sel');
  }
  
  function showWindow($url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        var currentPage = $('#users_tablce').DataTable().page();
        $('#users_tablce').DataTable().ajax.reload(function() {
          $('#users_tablce').DataTable().page(currentPage).draw(false);
        });
      }
    }, 1000);
  };
  
  function showWindow2($url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        location.reload();
      }
    }, 1000);
  };
</script>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Filtre formu submit edildiğinde DataTable'ı yenile
    $('#filterForm').on('submit', function(e) {
      e.preventDefault();
      if($('#users_tablce').length && $('#users_tablce').DataTable().length){
        $('#users_tablce').DataTable().ajax.reload();
      }
    });

    $('#users_tablce').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 11,
      scrollX: true,
      "order": [[0, "desc"]],
      "ajax": {
        "url": "<?php echo site_url('siparis/siparisler_ajax'); ?>",
        "type": "GET",
        "data": function(d) {
          d.sehir_id = $('select[name="sehir_id"]').val();
          d.kullanici_id = $('select[name="kullanici_id"]').val();
          d.tarih_baslangic = $('input[name="tarih_baslangic"]').val();
          d.tarih_bitis = $('input[name="tarih_bitis"]').val();
          d.teslim_durumu = $('select[name="teslim_durumu"]').val();
        }
      },
      "language": {
        "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
      },
      "columns": [
        { "data": 0 },
        { "data": 1 },
        { "data": 2 },
        { "data": 3 },
        { "data": 4 }
      ]
    });
  });
</script>