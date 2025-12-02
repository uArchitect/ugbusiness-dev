 
<style>
  .sel {
    background-color: green!important;
}
  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top:-1px;background:#ffffff;padding-top:0">
 
<section class="content text-md" style="padding:0">

<?php 
    if(empty($onay_bekleyen_siparisler) && empty($siparisler)){
?>
<div class="alert alert-dismissible" style="border: 1px solid #e3e3e1;padding-right:10px;max-width:450px;margin:auto;margin-top:20%;   
">

<h5 style="text-align:center;"><i class="icon fas fa-info-circle mb-2" style="font-size:50px;color:black"></i> <br>Sistem Bilgilendirme
<br><span style="text-align:center;font-weight:normal;font-size:16px"  >Onayda bekleyen sipariş kaydı bulunamadı.Onaya düşen sipariş bilgileri burada görüntülenecektir.</span>

 
</h5>


</div>
<?php
    }

?>



<?php if(!empty($onay_bekleyen_siparisler)) : ?>

<div class="card card-warning" style="border-radius:0px !important;">
  <div class="card-header">
    <h3 class="card-title"><strong>UG Business</strong> - Onay Bekleyen Siparişler</h3>
   
  </div>


  
  <!-- /.card-header -->
  <div class="card-body" style="margin-top: -12px;margin-left: -12px;">
    <div class="btn-group d-flex">
      <a type="button" href="?filter=2" class="btn btn-success" style="font-size: x-large !important;">İşlemde Olan Siparişler</a>
      <a type="button" href="?filter=1" class="btn btn-dark" style="font-size: x-large !important;">Beklemede Olan Siparişler</a>
    </div>
    <table id="onaybekleyensiparisler" class="table table-bordered table-striped nowrap">
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
 
      $count=0; foreach ($onay_bekleyen_siparisler as $siparis) : ?>

<?php 
 $data = get_son_adim($siparis->siparis_id);
?>
        <?php 
           if($ak == 2){
            if($siparis->siparisi_olusturan_kullanici != 2 && $siparis->siparisi_olusturan_kullanici != 5 && $siparis->siparisi_olusturan_kullanici != 18 && $siparis->siparisi_olusturan_kullanici != 94 ){
             
             
              continue;
            }
          }
          ?>


        <?php 
 
      
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
    }}


        ?>
        
        <?php 
          if(!empty($_GET["filter"])){
            if($_GET["filter"] == "1" && $siparis->beklemede == 0){
              continue;
            }
            if($_GET["filter"] == "2" && $siparis->beklemede == 1){
              continue;
            }
          }
        ?>
        <?php $count++; $link = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));?>
        <tr  style="cursor:pointer;
         
        ">
          <td ><span style=" display: block;">
<b>#</b>
            <?=$siparis->siparis_id?>
            <?php 
            if(hatali_fiyat_kontrol($siparis->siparis_id) == 1){
              ?><br>
               <a  class="btn btn-danger btn-xs yanipsonenyazinew" style="font-size: 10px !important;color:white" >
 <i class="fas fa-exclamation-circle"></i> HATALI FİYAT
                    </a>
              <?php
            }else{
              ?><br>
               <a  class="btn btn-success btn-xs" style="font-size: 10px !important;color:white" >
 <i class="fas fa-check"></i> FİYAT GEÇERLİ
                    </a>
              <?php
            }
            ?>
          </span>
          </td> 
          <td>
            <i class="far fa-user-circle" style="margin-right:1px;opacity:1"></i> 
            <b>
            <?php echo "<a href='".base_url("musteri/profil/$siparis->musteri_id")."'>".$siparis->musteri_ad."</a>"; ?>
            
          
          
          </b> <br>İletişim : <?=$siparis->musteri_iletisim_numarasi?> <?=$siparis->musteri_sabit_numara ? "<br>".$siparis->musteri_sabit_numara : ""?> 
          </td>
          <td>
            <b> <?=($siparis->merkez_adi == "#NULL#") ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;'><i class='nav-icon 	fas fa-exclamation-circle'></i> Merkez Adı Girilmedi</span>":'<i class="far fa-building" style="color: green;"></i> '.$siparis->merkez_adi?> -  </b> <span style="color:#1461c3;"> <?=$siparis->sehir_adi?> / <?=$siparis->ilce_adi?></span>  <br> <span style="font-size:14px"><?=($siparis->merkez_adresi == "" || $siparis->merkez_adresi == "0" || $siparis->merkez_adresi == ".") ? "ADRES GİRİLMEDİ" : $siparis->merkez_adresi?> </span>
          </td>           
          <td>
            <b>
            <i class="far fa-user-circle" style="color:green;margin-right:1px;opacity:1"></i>  

            <?php echo "<a href='".base_url("kullanici/profil_new/$siparis->kullanici_id")."?subpage=ozluk-dosyasi'>".$siparis->kullanici_ad_soyad."</a>"; ?>
                    

            </b>
            <br>
            <?=date('d.m.Y H:i',strtotime($siparis->kayit_tarihi));?>
          </td>
          <td>
            <?php
             
              echo "<b>".$data[0]->adim_adi."</b> Bekleniyor...";
            ?>
            <br>
            <div>
              <div class="row">
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 1  ? (($siparis->adim_no+1 == 1 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 1 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 2  ? (($siparis->adim_no+1 == 2 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 2 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 3  ? (($siparis->adim_no+1 == 3 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 3 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 4  ? (($siparis->adim_no+1 == 4 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 4 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 5  ? (($siparis->adim_no+1 == 5 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 5 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 6  ? (($siparis->adim_no+1 == 6 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 6 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 7  ? (($siparis->adim_no+1 == 7 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 7 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 8  ? (($siparis->adim_no+1 == 8 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 8 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 9  ? (($siparis->adim_no+1 == 9 ) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 9 ) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 10 ? (($siparis->adim_no+1 == 10) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 10) ? "display:none;" : ""?>"></i> </div>
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 11 ? (($siparis->adim_no+1 == 11) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 11) ? "display:none;" : ""?>"></i> </div>                            
                <div class="mr-1" style="    border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= 12 ? (($siparis->adim_no+1 == 12) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;    display: inline-flex;"><i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= 12) ? "display:none;" : ""?>"></i> </div>                            
              </div>
            </div>
          </td>
          <td>

          <?php 
          
          if($data[0]->adim_sira_numarasi == 4 && $siparis->siparis_ust_satis_onayi == 0 && (aktif_kullanici()->kullanici_id == 37 || aktif_kullanici()->kullanici_id == 8)){
            
            ?>
                   <button type="button" style="height: 47px;
    padding-top: 13px;border: 1px solid #5b4002;    font-weight: 400!important;opacity:0.5" class="btn btn-danger btn-xs"><b>ONAY BEKLENİYOR</b></button>
     
            <?php
          
        }else{
          ?>
       <a type="button" style="height: 47px;
    padding-top: 13px;border: 1px solid #5b4002;    font-weight: 400!important;" onclick="showWindow2('<?=$link?>');"   class="btn btn-warning btn-xs"><i class="fas fa-search" style="font-size:14px" aria-hidden="true"></i> <b>GÖRÜNTÜLE</b></a>
     
          <?php
        }

          ?>

          </td>
        </tr>
        <?php  endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endif; ?>




            <?php if(!empty($siparisler)) : ?>

<div class="card card-dark" style="border-radius: 8px !important; margin-top: -8px; padding: 10px;">
              <div class="card-header" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 8px 8px 0 0;">
              <h3 class="card-title" style="color: #ffffff; font-weight: 700;"><strong>UG Business</strong> - Tüm Siparişler</h3>
                <a href="<?=base_url("siparis/merkez")?>" type="button" class="btn btn-light btn-sm shadow-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px; border-radius: 6px; font-weight: 600;"><i class="fa fa-plus" style="font-size:12px; color: #001657;" aria-hidden="true"></i> <span style="color: #001657;">Yeni Kayıt Ekle</span></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding: 10px;">
                
                <!-- Filtreler - Sadece Yönetim Departmanı Görebilir -->
                <?php if(isset($is_yonetim) && $is_yonetim): ?>
                <div class="row mb-3" style="background-color: #f8f9fa; padding: 15px; border-radius: 4px; margin-bottom: 15px;">
                  <div class="col-12">
                    <h5 style="color: #495057; font-weight: 600; margin-bottom: 15px; font-size: 16px;">
                      <i class="fas fa-filter"></i> Filtreler
                    </h5>
                    <form id="filterForm" method="GET">
                      <div class="row">
                        <div class="col-md-3 mb-3">
                          <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Şehir</label>
                          <select name="sehir_id" id="sehir_id" class="form-control">
                            <option value="">Tümü</option>
                            <?php if(!empty($sehirler)): foreach($sehirler as $sehir): ?>
                              <option value="<?=$sehir->sehir_id?>" <?=($selected_sehir_id == $sehir->sehir_id) ? 'selected' : ''?>><?=htmlspecialchars($sehir->sehir_adi)?></option>
                            <?php endforeach; endif; ?>
                          </select>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                          <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Siparişi Oluşturan</label>
                          <select name="kullanici_id" id="kullanici_id" class="form-control">
                            <option value="">Tümü</option>
                            <?php if(!empty($kullanicilar)): foreach($kullanicilar as $kullanici): ?>
                              <option value="<?=$kullanici->kullanici_id?>" <?=($selected_kullanici_id == $kullanici->kullanici_id) ? 'selected' : ''?>><?=htmlspecialchars($kullanici->kullanici_ad_soyad)?></option>
                            <?php endforeach; endif; ?>
                          </select>
                        </div>
                        
                        <div class="col-md-2 mb-3">
                          <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Başlangıç Tarihi</label>
                          <input type="date" name="tarih_baslangic" id="tarih_baslangic" value="<?=$selected_tarih_baslangic?>" class="form-control">
                        </div>
                        
                        <div class="col-md-2 mb-3">
                          <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Bitiş Tarihi</label>
                          <input type="date" name="tarih_bitis" id="tarih_bitis" value="<?=$selected_tarih_bitis?>" class="form-control">
                        </div>
                        
                        <div class="col-md-2 mb-3">
                          <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Teslim Durumu</label>
                          <select name="teslim_durumu" id="teslim_durumu" class="form-control">
                            <option value="">Tümü</option>
                            <option value="1" <?=($selected_teslim_durumu == '1') ? 'selected' : ''?>>Teslim Edildi</option>
                            <option value="0" <?=($selected_teslim_durumu == '0') ? 'selected' : ''?>>Teslim Edilmedi</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <button type="button" id="filterBtn" class="btn btn-primary">
                            <i class="fas fa-search"></i> Filtrele
                          </button>
                          <button type="button" id="resetBtn" class="btn btn-secondary" style="margin-left: 10px;">
                            <i class="fas fa-redo"></i> Sıfırla
                          </button>
                          <?php 
                            $i_kul = aktif_kullanici()->kullanici_id;
                            if($i_kul == 1 || $i_kul == 9 || $i_kul == 7 || $i_kul == 37 || $i_kul == 8 ){
                          ?>
                          <a href="<?=base_url("siparis/tamamlanmayanlar_view")?>" class="btn btn-info" style="margin-left: 10px;">
                            <i class="fas fa-exclamation-triangle"></i> Tamamlanmayan Tüm Siparişler
                          </a>
                          <?php } ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <?php endif; ?>
 
                <table id="users_tablce" class="table table-bordered table-hover align-middle mb-0" style="width:100%">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                  <tr >
                
                    <th style="width: 42px; font-weight: 600; padding: 15px 10px;">Sipariş Kodu</th> 
                
                    <th style="font-weight: 600; padding: 15px 10px;">Müşteri Adı</th> 
                    <th style="font-weight: 600; padding: 15px 10px;">Adres</th>
                     <th style="width: 130px; font-weight: 600; padding: 15px 10px;">Siparişi Oluşturan</th>
                 
                    <th style="font-weight: 600; padding: 15px 10px;">İşlem</th> 
                  </tr>
                  </thead>
                  </table>




              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

<?php endif; ?>



 
<style>
  /* Tablo satır hover efekti */
  .table tbody tr {
    border-left: 3px solid transparent;
    transition: all 0.2s ease;
  }

  .table tbody tr:hover {
    background-color: #f8f9fa !important;
    border-left-color: #0066ff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Buton hover efektleri */
  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .table {
      font-size: 13px;
    }
    
    .table th,
    .table td {
      padding: 10px 5px !important;
    }
  }
       
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
        };
      
  </script>








<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 



    <script type="text/javascript">
        $(document).ready(function() {
            // Filtrelerin görünür olup olmadığını kontrol et
            var isYonetim = <?php echo (isset($is_yonetim) && $is_yonetim) ? 'true' : 'false'; ?>;
            
            var table = $('#users_tablce').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 11,
                "scrollX": true,
                "ajax": {
                    "url": "<?php echo site_url('siparis/siparisler_ajax'); ?>",
                    "type": "GET",
                    "data": function(d) {
                        // Sadece yönetim departmanı filtreleri gönderebilir
                        if(isYonetim) {
                            d.sehir_id = $('#sehir_id').val();
                            d.kullanici_id = $('#kullanici_id').val();
                            d.tarih_baslangic = $('#tarih_baslangic').val();
                            d.tarih_bitis = $('#tarih_bitis').val();
                            d.teslim_durumu = $('#teslim_durumu').val();
                        } else {
                            // Yönetim değilse filtre parametrelerini gönderme
                            d.sehir_id = '';
                            d.kullanici_id = '';
                            d.tarih_baslangic = '';
                            d.tarih_bitis = '';
                            d.teslim_durumu = '';
                        }
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
                    "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
                },
                "columns": [
                    { "data": 0 },
                    { "data": 1 },
                    { "data": 2 },
                    { "data": 3 },
                    { "data": 4, "orderable": false }
                ],
                "order": [[0, "desc"]]
            });
            
            // Filtre butonu - Sadece yönetim departmanı görebilir
            if(isYonetim) {
                $('#filterBtn').on('click', function() {
                    table.ajax.reload();
                });
                
                // Sıfırla butonu
                $('#resetBtn').on('click', function() {
                    $('#sehir_id').val('');
                    $('#kullanici_id').val('');
                    $('#tarih_baslangic').val('');
                    $('#tarih_bitis').val('');
                    $('#teslim_durumu').val('');
                    table.ajax.reload();
                });
            }
        });







      
    </script>







<script>
  
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