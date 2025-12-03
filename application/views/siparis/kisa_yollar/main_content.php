<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-shopping-cart" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Siparişler Kısa Yolları
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Sipariş yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Tab Navigation Bar -->
          <div class="siparis-tabs-container" style="background-color: #001657; overflow-x: auto; border-bottom: 2px solid rgba(255,255,255,0.1);">
            <div class="d-flex" style="min-width: max-content;">
              <a href="<?=base_url("tum-siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fas fa-list-alt" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Tüm Siparişler</span>
              </a>
              <a href="<?=base_url("onay-bekleyen-siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="far fa-check-circle" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Onay Bekleyenler</span>
              </a>
              <a href="<?=base_url("siparis/haftalik_kurulum_plan")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="far fa-calendar-alt" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Kurulum Planı</span>
              </a>
              <a href="<?=base_url("siparis/hizli_siparis_olustur_view")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fa fa-plus-circle" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Hızlı Sipariş</span>
              </a>
              <a href="<?=base_url("cihaz/iptal_edilen_siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fas fa-ban" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">İptal Edilenler</span>
              </a>
              <a href="<?=base_url("siparis/degerlendirme_rapor")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: none; transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fa fa-envelope" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">SMS Sonuçları</span>
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
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
                      <select name="sehir_id" id="sehir_id" class="form-control select2" style="width: 100%;">
                        <option value="">Tümü</option>
                        <?php if(!empty($sehirler)): foreach($sehirler as $sehir): ?>
                          <option value="<?=$sehir->sehir_id?>" <?=($selected_sehir_id == $sehir->sehir_id) ? 'selected' : ''?>><?=htmlspecialchars($sehir->sehir_adi)?></option>
                        <?php endforeach; endif; ?>
                      </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Siparişi Oluşturan</label>
                      <select name="kullanici_id" id="kullanici_id" class="form-control select2" style="width: 100%;">
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
                      <select name="teslim_durumu" id="teslim_durumu" class="form-control select2" style="width: 100%;">
                        <option value="">Tümü</option>
                        <option value="1" <?=($selected_teslim_durumu == '1') ? 'selected' : ''?>>Teslim Edildi</option>
                        <option value="0" <?=($selected_teslim_durumu == '0') ? 'selected' : ''?>>Teslim Edilmedi</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filtrele
                      </button>
                      <a href="<?=base_url('siparis/siparis_kisa_yollar')?>" class="btn btn-secondary" style="margin-left: 10px;">
                        <i class="fas fa-redo"></i> Sıfırla
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <?php endif; ?>

            <!-- Tüm Siparişler Tablosu -->
            <?php if(!empty($siparisler)) : ?>
            <div style="overflow-x: auto;">
              <table id="users_tablce" class="table table-bordered table-hover align-middle mb-0" style="width:100%">
                <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                  <tr>
                    <th style="width: 42px; font-weight: 600; padding: 15px 10px;">Sipariş Kodu</th> 
                    <th style="font-weight: 600; padding: 15px 10px;">Müşteri Adı</th> 
                    <th style="font-weight: 600; padding: 15px 10px;">Adres</th>
                    <th style="width: 130px; font-weight: 600; padding: 15px 10px;">Siparişi Oluşturan</th>
                    <th style="font-weight: 600; padding: 15px 10px;">İşlem</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $current_user_id = aktif_kullanici()->kullanici_id;
                  foreach($siparisler as $row): 
                    if($current_user_id == 2 && $row->siparis_id == 2687) continue;
                    $urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$row->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                    $musteri = '<a target="_blank" style="font-weight: 500;" href="'.base_url("musteri/profil/".$row->musteri_id).'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';
                    
                    if($row->merkez_ulke_id == 190){
                      $bilgi = "<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->sehir_adi." (".$row->ilce_adi.")"."</span><br>";
                    }else{
                      $bilgi = "<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->ulke_adi."<br>";
                    }
                  ?>
                  <tr>
                    <td>
                      <a href="#" onclick="showWindow('<?=$urlcustom?>');"><?=$row->siparis_kodu?></a><br>
                      <span style='font-weight:normal'><?=date('d.m.Y H:i',strtotime($row->kayit_tarihi))?></span>
                    </td>
                    <td>
                      <b><?=$musteri?></b><?=($row->adim_no>11 ? " <i class='fas fa-check-circle text-success'></i><span class='text-success'>Teslim Edildi</span>":'<span style="margin-left:10px;opacity:0.5">Teslim Edilmedi</span>')?><br>
                      <span style='font-weight:normal'>İletişim : <?=formatTelephoneNumber($row->musteri_iletisim_numarasi)?><?=(($row->musteri_sabit_numara != "" ? " / Sabit No : ".$row->musteri_sabit_numara : ""))?></span>
                    </td>
                    <td>
                      <?=$bilgi?>
                      <?=(($row->merkez_adresi == "" || $row->merkez_adresi == "." || $row->merkez_adresi == "0") ? '<span style="opacity:0.4;font-weight:normal">BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>' : "<span title='".$row->merkez_adresi."' style='font-weight:normal'>".substr($row->merkez_adresi,0,90).(strlen($row->merkez_adresi)>90 ? "...":"")."...</span>")?>
                    </td>
                    <td><?=$row->kullanici_ad_soyad?></td>
                    <td>
                      <a type="button" onclick="showWindow('<?=$urlcustom?>');" class="btn btn-warning btn-xs">
                        <i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php else: ?>
              <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Henüz sipariş bulunmamaktadır.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .siparis-tabs-container {
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
  }

  .siparis-tabs-container::-webkit-scrollbar {
    height: 5px;
  }

  .siparis-tabs-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .siparis-tabs-container::-webkit-scrollbar-thumb {
    background: #001657;
    border-radius: 10px;
  }

  .siparis-tabs-container::-webkit-scrollbar-thumb:hover {
    background: #002a7a;
  }

  .siparis-tab {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    user-select: none;
    position: relative;
  }

  .siparis-tab::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background-color: rgba(255, 255, 255, 0);
    transition: all 0.25s ease;
  }

  .siparis-tab:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
  }

  .siparis-tab:hover::before {
    background-color: rgba(255, 255, 255, 0.4);
  }

  .siparis-tab:active {
    transform: translateY(1px);
  }

  .siparis-tab:hover i {
    transform: scale(1.1);
    transition: transform 0.25s ease;
  }

  .siparis-tab:hover span {
    font-weight: 600;
    transition: font-weight 0.25s ease;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .siparis-tab {
      padding: 8px 14px !important;
      font-size: 12px !important;
    }
    
    .siparis-tab i {
      font-size: 12px !important;
    }
  }

  @media (max-width: 576px) {
    .siparis-tab {
      padding: 8px 12px !important;
      font-size: 11px !important;
    }
    
    .siparis-tab span {
      display: none;
    }
    
    .siparis-tab i {
      font-size: 14px !important;
    }
  }
</style>

<script type="text/javascript">
  // showWindow fonksiyonu
  function showWindow(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        location.reload();
      }
    }, 1000);
  }

  $(document).ready(function() {
    // Yönetim kontrolü
    var isYonetim = <?=isset($is_yonetim) && $is_yonetim ? 'true' : 'false'?>;
    
    // Select2 başlatma - Sadece yönetim departmanı görebilir
    if(isYonetim) {
      if($('#sehir_id').length) {
        $('#sehir_id').select2({
          placeholder: "Şehir seçin...",
          allowClear: true
        });
      }
      
      if($('#kullanici_id').length) {
        $('#kullanici_id').select2({
          placeholder: "Kullanıcı seçin...",
          allowClear: true
        });
      }
      
      if($('#teslim_durumu').length) {
        $('#teslim_durumu').select2({
          placeholder: "Durum seçin...",
          allowClear: true,
          minimumResultsForSearch: Infinity
        });
      }
    }
    
    // DataTables başlatma - Client-side
    if($('#users_tablce').length) {
      if($.fn.DataTable.isDataTable('#users_tablce')) {
        $('#users_tablce').DataTable().destroy();
      }
      
      $('#users_tablce').DataTable({
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tümü"]],
        "scrollX": true,
        "searching": true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
          "search": "Ara:",
          "lengthMenu": "Sayfa başına _MENU_ kayıt göster",
          "info": "Toplam _TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
          "infoEmpty": "Kayıt bulunamadı",
          "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
          "zeroRecords": "Eşleşen kayıt bulunamadı",
          "processing": "İşleniyor..."
        },
        "order": [[0, "desc"]],
        "columnDefs": [
          { "orderable": true, "targets": [0, 1, 2, 3] },
          { "orderable": false, "targets": [4] }
        ]
      });
    }
  });
</script>

