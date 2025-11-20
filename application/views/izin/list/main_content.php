<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
  <section class="content text-md">
    <div class="row">
      <div class="col-md-12">
        
    <div class="card border-0 shadow-sm" style="border-radius:12px; overflow: hidden;">
      <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 15px 20px;">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0" style="color: #ffffff; font-weight: 700; font-size: 18px;">
            <i class="fas fa-calendar-alt mr-2"></i><strong>Business</strong> - İzin Yönetimi
          </h3>
          <button type="button" class="btn btn-light ml-auto" data-toggle="modal" data-target="#izinTalepModal" style="font-weight: 600;">
            <i class="fas fa-plus-circle"></i> İzin Talebi Ekle
          </button>
        </div>
      </div>
      <div class="card-body" style="padding: 25px; background-color: #ffffff;">
        <!-- Tab Navigation -->
        <?php 
        // Durum sayılarını hesapla
        $sayac_tumu = 0;
        $sayac_bekleyen = 0;
        $sayac_onaylanan = 0;
        $sayac_reddedilen = 0;
        $sayac_iptal = 0;
        
        foreach ($istekler as $istek) {
          $amir_d = isset($istek->amir_onay_durumu) ? (int)$istek->amir_onay_durumu : 0;
          $mudur_d = isset($istek->mudur_onay_durumu) ? (int)$istek->mudur_onay_durumu : 0;
          
          $sayac_tumu++;
          
          if ($istek->izin_durumu == 0) {
            $sayac_iptal++;
          } elseif ($mudur_d == 1) {
            $sayac_onaylanan++;
          } elseif ($mudur_d == 2 || $amir_d == 2) {
            $sayac_reddedilen++;
          } else {
            $sayac_bekleyen++;
          }
        }
        ?>
        
        <ul class="nav nav-tabs mb-3" id="izinTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="tab-tumu" data-toggle="tab" href="#tumu" role="tab">
              <i class="fa fa-list"></i> Tümü <span class="badge badge-secondary"><?=$sayac_tumu?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab-bekleyen" data-toggle="tab" href="#bekleyen" role="tab">
              <i class="fa fa-clock"></i> Onay Bekleyenler <span class="badge badge-warning"><?=$sayac_bekleyen?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab-onaylanan" data-toggle="tab" href="#onaylanan" role="tab">
              <i class="fa fa-check-circle"></i> Onaylananlar <span class="badge badge-success"><?=$sayac_onaylanan?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab-reddedilen" data-toggle="tab" href="#reddedilen" role="tab">
              <i class="fa fa-times-circle"></i> Reddedilenler <span class="badge badge-danger"><?=$sayac_reddedilen?></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tab-iptal" data-toggle="tab" href="#iptal" role="tab">
              <i class="fa fa-ban"></i> İptal Edilenler <span class="badge badge-dark"><?=$sayac_iptal?></span>
            </a>
          </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
          <div class="tab-pane fade show active" id="tumu" role="tabpanel">
            <div class="table-responsive">
            <table id="example1" class="table table-hover align-middle mb-0 text-sm izin-table" style="min-width: 800px;">
          <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
            <tr>
              <th style="width: 42px; font-weight: 600; padding: 12px 10px;">Kod</th>
              <th style="font-weight: 600; padding: 12px 10px;">Talep Eden Kullanıcı</th>
              <th style="font-weight: 600; padding: 12px 10px;">İzin Nedeni</th>
              <th style="width: 160px; font-weight: 600; padding: 12px 10px;">İzin Başlangıç</th>
              <th style="width: 130px; font-weight: 600; padding: 12px 10px;">İzin Bitiş</th>
              <th style="width: 140px; font-weight: 600; padding: 12px 10px;">Amir Onay</th>
              <th style="width: 140px; font-weight: 600; padding: 12px 10px;">Müdür Onay</th>
              <th style="width: 140px; font-weight: 600; padding: 12px 10px;">Durum</th>
              <th style="width: 120px; font-weight: 600; padding: 12px 10px;">İşlem</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($istekler as $istek): 
              $amir_durum = isset($istek->amir_onay_durumu) ? (int)$istek->amir_onay_durumu : 0;
              $mudur_durum = isset($istek->mudur_onay_durumu) ? (int)$istek->mudur_onay_durumu : 0;
              
              // Durumu belirle
              if ($istek->izin_durumu == 0) {
                $row_status = 'iptal';
              } elseif ($mudur_durum == 1) {
                $row_status = 'onaylanan';
              } elseif ($mudur_durum == 2 || $amir_durum == 2) {
                $row_status = 'reddedilen';
              } else {
                $row_status = 'bekleyen';
              }
            ?>
               <tr data-status="<?=$row_status?>">
                 <td>T<?=str_pad($istek->izin_talep_id, 5, '0', STR_PAD_LEFT);?></td>
                 <td><b><i class="far fa-file-alt mr-1"></i><?=$istek->kullanici_ad_soyad?></b> / <?=$istek->departman_adi?></td>
                <td><b><i class="far fa-building mr-1"></i><?=$istek->izin_neden_detay?><br><span style="font-weight:300;font-size:13px"><?=$istek->izin_notu?></span></b></td>
                <td><i class="fa fa-user-circle mr-1 opacity-75"></i><b><?=date('d.m.Y H:i', strtotime($istek->izin_baslangic_tarihi));?></b></td>
                <td><i class="fa fa-user-circle mr-1 opacity-75"></i><b><?=date('d.m.Y H:i', strtotime($istek->izin_bitis_tarihi));?></b></td>
                <td>
                  <?php 
                  if ($amir_durum == 0): ?>
                    <span class="badge badge-warning"><i class="fa fa-clock"></i> Beklemede</span>
                    <?php if (!empty($istek->amir_ad_soyad)): ?>
                      <br><small style="color: #6c757d;"><i class="fa fa-user"></i> <?=$istek->amir_ad_soyad?></small>
                    <?php endif; ?>
                  <?php elseif ($amir_durum == 1): ?>
                    <span class="badge badge-success"><i class="fa fa-check"></i> Onaylandı</span>
                    <?php if (!empty($istek->amir_ad_soyad)): ?>
                      <br><small style="color: #6c757d;"><i class="fa fa-user"></i> <?=$istek->amir_ad_soyad?></small>
                    <?php endif; ?>
                    <?php if (!empty($istek->amir_onay_tarihi)): ?>
                      <br><small style="color: #6c757d; font-size: 11px;"><?=date('d.m.Y H:i', strtotime($istek->amir_onay_tarihi))?></small>
                    <?php endif; ?>
                  <?php else: ?>
                    <span class="badge badge-danger"><i class="fa fa-times"></i> Reddedildi</span>
                    <?php if (!empty($istek->amir_ad_soyad)): ?>
                      <br><small style="color: #6c757d;"><i class="fa fa-user"></i> <?=$istek->amir_ad_soyad?></small>
                    <?php endif; ?>
                    <?php if (!empty($istek->amir_onay_tarihi)): ?>
                      <br><small style="color: #6c757d; font-size: 11px;"><?=date('d.m.Y H:i', strtotime($istek->amir_onay_tarihi))?></small>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
                <td>
                  <?php 
                  // Müdür onay durumu
                  if ($mudur_durum == 0): ?>
                    <span class="badge badge-warning"><i class="fa fa-clock"></i> Beklemede</span>
                  <?php elseif ($mudur_durum == 1): ?>
                    <span class="badge badge-success"><i class="fa fa-check"></i> Onaylandı</span>
                    <?php if (!empty($istek->mudur_onay_tarihi)): ?>
                      <br><small style="color: #6c757d; font-size: 11px;"><?=date('d.m.Y H:i', strtotime($istek->mudur_onay_tarihi))?></small>
                    <?php endif; ?>
                  <?php else: ?>
                    <span class="badge badge-danger"><i class="fa fa-times"></i> Reddedildi</span>
                    <?php if (!empty($istek->mudur_onay_tarihi)): ?>
                      <br><small style="color: #6c757d; font-size: 11px;"><?=date('d.m.Y H:i', strtotime($istek->mudur_onay_tarihi))?></small>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
                <td>
                  <?php 
                  // Genel durum: Amir ve Müdür onay sistemi
                  if ($istek->izin_durumu == 0): ?>
                    <span class="badge badge-secondary"><i class="fa fa-ban"></i> İptal</span>
                  <?php elseif ($mudur_durum == 1): ?>
                    <span class="badge badge-success"><i class="fa fa-check-circle"></i> Tamamlandı</span>
                  <?php elseif ($amir_durum == 1 && $mudur_durum == 0): ?>
                    <span class="badge badge-info"><i class="fa fa-hourglass-half"></i> Müdür Onayı Bekliyor</span>
                  <?php elseif ($mudur_durum == 2 || $amir_durum == 2): ?>
                    <span class="badge badge-danger"><i class="fa fa-times-circle"></i> Reddedildi</span>
                  <?php else: ?>
                    <span class="badge badge-warning"><i class="fa fa-hourglass-half"></i> Amir Onayı Bekliyor</span>
                  <?php endif; ?>
                </td>
                 <td>
                   <?php if ($istek->izin_durumu == 0): ?>
                     <span class="text-danger"><i class="fas fa-exclamation-circle"></i> İptal edildi.</span>
                   <?php else: ?> 
                      <a href="<?=site_url('izin/iptal_et/'.$istek->izin_talep_id)?>" class="btn btn-danger btn-xs" onclick="return confirm('İptal etmek istediğinize emin misiniz?');"><i class="fa fa-times"></i> İptal Et</a>
                   <?php endif; ?>
                 </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
            </div>
          </div>
        </div>

        <!-- JavaScript for Tab Filtering -->
        <style>
        .nav-tabs .nav-link {
          color: #495057;
          font-weight: 500;
        }
        .nav-tabs .nav-link.active {
          font-weight: 600;
        }
        .nav-tabs .nav-link .badge {
          margin-left: 5px;
          font-size: 11px;
          padding: 3px 7px;
        }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
          const table = document.getElementById('example1');
          if (!table) return;
          
          const allRows = table.querySelectorAll('tbody tr');
          const tabs = document.querySelectorAll('#izinTabs .nav-link');
          
          function filterTable(status) {
            allRows.forEach(function(row) {
              const rowStatus = row.getAttribute('data-status');
              
              if (status === 'tumu') {
                row.style.display = '';
              } else {
                if (rowStatus === status) {
                  row.style.display = '';
                } else {
                  row.style.display = 'none';
                }
              }
            });
          }
          
          // Tab'lara click event ekle
          tabs.forEach(function(tab) {
            tab.addEventListener('click', function(e) {
              const href = this.getAttribute('href');
              const status = href.substring(1); // # karakterini kaldır
              
              console.log('Tab değişti:', status);
              
              // Filtreyi uygula
              setTimeout(function() {
                filterTable(status);
              }, 100);
            });
          });
          
          // İlk yükleme - tümünü göster
          filterTable('tumu');
        });
        </script>
      </div>
    </div>
      </div>

<!-- İzin Talebi Modal -->
<div class="modal fade" id="izinTalepModal" tabindex="-1" role="dialog" aria-labelledby="izinTalepModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 12px; border: none; overflow: hidden;">
      <div class="modal-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 20px 25px;">
        <h5 class="modal-title" id="izinTalepModalLabel" style="color: #ffffff; font-weight: 700; font-size: 18px;">
          <i class="fas fa-plus-circle mr-2"></i>Yeni İzin Talebi Oluştur2
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff; opacity: 1;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url("izin/save")?>" method="POST">
        <div class="modal-body" style="padding: 30px; background-color: #f8f9fa;">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_personel" style="font-weight: 600; color: #001657; font-size: 14px;">
                  <i class="fas fa-user mr-1"></i>Personel Seçiniz <span class="text-danger">*</span>
                </label>
                <select class="form-control" id="modal_personel" name="izin_talep_eden_kullanici_id" required style="border-radius: 8px; border: 1px solid #ddd;">
                  <option value="">Personel Seçiniz</option>
                  <?php foreach ($kullanicilar as $kullanici): ?>
                    <option value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="modal_baslangic" style="font-weight: 600; color: #001657; font-size: 14px;">
                  <i class="fas fa-calendar-day mr-1"></i>İzin Başlangıç Tarihi <span class="text-danger">*</span>
                </label>
                <input type="datetime-local" class="form-control" id="modal_baslangic" name="izin_baslangic_tarihi" value="<?=date("Y-m-d\T08:00")?>" required style="border-radius: 8px; padding: 10px; border: 1px solid #ddd;">
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="modal_bitis" style="font-weight: 600; color: #001657; font-size: 14px;">
                  <i class="fas fa-calendar-check mr-1"></i>İzin Bitiş Tarihi <span class="text-danger">*</span>
                </label>
                <input type="datetime-local" class="form-control" id="modal_bitis" name="izin_bitis_tarihi" value="<?=date("Y-m-d\T17:00")?>" required style="border-radius: 8px; padding: 10px; border: 1px solid #ddd;">
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_neden" style="font-weight: 600; color: #001657; font-size: 14px;">
                  <i class="fas fa-clipboard-list mr-1"></i>İzin Nedeni <span class="text-danger">*</span>
                </label>
                <select class="form-control" id="modal_neden" name="izin_neden_no" required style="border-radius: 8px; border: 1px solid #ddd;">
                  <option value="">Seçim Yapınız</option>
                  <?php foreach ($nedenler as $neden): ?>
                    <option value="<?=$neden->izin_neden_id?>"><?=$neden->izin_neden_detay?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_not" style="font-weight: 600; color: #001657; font-size: 14px;">
                  <i class="fas fa-comment mr-1"></i>İzin Notu
                </label>
                <textarea class="form-control" id="modal_not" name="izin_notu" rows="4" placeholder="İzin ile ilgili diğer detayları girebilirsiniz..." style="border-radius: 8px; padding: 10px; border: 1px solid #ddd;"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0" style="background-color: #f8f9fa; padding: 15px 30px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px 20px; border-radius: 8px; font-weight: 600;">
            <i class="fas fa-times mr-1"></i>İptal
          </button>
          <button type="submit" class="btn btn-success" style="padding: 10px 20px; border-radius: 8px; font-weight: 600; background: #001657; border-color: #001657;">
            <i class="fas fa-paper-plane mr-1"></i>Gönder
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-3" style="display: none;">
   
  <div class="izin-form" style="background:white;padding:10px">
        <h2>İzin Talep Formu</h2>
        <form action="<?=base_url("izin/save")?>" method="POST">

          <div class="form-group">
                <label for="izinBaslangic">İzin Başlangıç Tarihi:</label>
                <select class="select2 form-control" name="izin_talep_eden_kullanici_id" required>
<option value="">Personel Seçiniz</option>
                         <?php 
              foreach ($kullanicilar as $kullanici) {
                ?>
                <option value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?></option>
                <?php
              }
              ?>
            </select>
            </div>


            <div class="form-group">
                <label for="izinBaslangic">İzin Başlangıç Tarihi:</label>
                <input type="datetime-local"  value="<?=date("Y-m-d 00:00:00")?>" id="izin_baslangic_tarihi" name="izin_baslangic_tarihi" required>
            </div>

            <div class="form-group">
                <label for="izinBitis">İzin Bitiş Tarihi:</label>
                <input type="datetime-local"  value="<?=date("Y-m-d 00:00:00")?>" id="izin_bitis_tarihi" name="izin_bitis_tarihi" required>
            </div>

            <div class="form-group">
                <label for="izinNedeni">İzin Nedeni:</label>
                <select id="izinNedeni" name="izin_neden_no" required>
                   <option value="">Seçim Yapınız</option>
               
                    <?php 
              foreach ($nedenler as $neden) {
                ?>
                <option value="<?=$neden->izin_neden_id?>"><?=$neden->izin_neden_detay?></option>
                <?php
              }
              ?>
                </select>
            </div>

            <div class="form-group">
                <label for="izinNotu">İzin Notu:</label>
                <textarea id="izinNotu" name="izin_notu" rows="4" placeholder="İzin ile ilgili diğer detayları girebilirsiniz."  ></textarea>
            </div>

            <div class="form-group">
                <button type="submit">Gönder</button>
            </div>
        </form>
        </div> 

    <style scoped>
        /* Scoped CSS */
        

        .izin-form h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .izin-form .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .izin-form label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        .izin-form input, .izin-form select, .izin-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fafafa;
        }

        .izin-form input:focus, .izin-form select:focus, .izin-form textarea:focus {
            border-color: #4caf50;
            outline: none;
        }

        .izin-form button {
            width: 100%;
            padding: 12px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .izin-form button:hover {
            background-color: #45a049;
        }

        .izin-form textarea {
            resize: vertical;
        }
    </style>
</div>






<div class="col-md-9">
        
    <div class="card card-default" style="border-radius:0px !important;">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><strong>Business</strong> - STAJYER GÜNLERİ YÖNET</h3>
        <div>
            <?php if (!empty($_GET['filter'])): ?>
            <a href="<?=base_url('izin/onay_bekleyenler') ?>" class="btn btn-danger btn-sm"><i class="fa fa-times text-white" style="font-size:12px"></i> Filtrelemeyi kaldır</a>
          <?php endif; ?>
        </div>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered nowrap table-striped text-sm">
          <thead>
            <tr>
              <th>STAJYER</th>
              <th style="width:170px">PAZARTESİ</th>
              <th style="width:170px">SALI</th>
              <th style="width:170px">ÇARŞAMBA</th>
              <th style="width:170px">PERŞEMBE</th>
              <th style="width:170px">CUMA</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($stajyerler as $stajyer): ?>
 
              <tr> 
                <td><b><i class="far fa-file-alt mr-1"></i><?=$stajyer->kullanici_ad_soyad?></b></td>
             
                <td style="padding:0px!important">
                  <?php if ($stajyer->pazartesi == 1): ?>
                    <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/pazartesi/0")?>" class="btn btn-success" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-check"></i> STAJ VAR</a>
                  <?php else: ?> 
                      <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/pazartesi/1")?>" class="btn btn-danger" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-times"></i> STAJ YOK</a>
                  <?php endif; ?>
                </td>
                <td style="padding:0px!important">
                  <?php if ($stajyer->sali == 1): ?>
                    <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/sali/0")?>" class="btn btn-success" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-check"></i> STAJ VAR</a>
                  <?php else: ?> 
                      <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/sali/1")?>" class="btn btn-danger" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-times"></i> STAJ YOK</a>
                  <?php endif; ?>
                </td>
                <td  style="padding:0px!important">
                  <?php if ($stajyer->carsamba == 1): ?>
                    <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/carsamba/0")?>" class="btn btn-success" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-check"></i> STAJ VAR</a>
                  <?php else: ?> 
                      <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/carsamba/1")?>" class="btn btn-danger" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-times"></i> STAJ YOK</a>
                  <?php endif; ?>
                </td>
                <td  style="padding:0px!important">
                  <?php if ($stajyer->persembe == 1): ?>
                    <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/persembe/0")?>" class="btn btn-success" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-check"></i> STAJ VAR</a>
                  <?php else: ?> 
                      <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/persembe/1")?>" class="btn btn-danger" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-times"></i> STAJ YOK</a>
                  <?php endif; ?>
                </td>
                <td  style="padding:0px!important">
                  <?php if ($stajyer->cuma == 1): ?>
                    <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/cuma/0")?>" class="btn btn-success" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-check"></i> STAJ VAR</a>
                  <?php else: ?> 
                      <a href="<?=base_url("izin/staj_durum_degistir/$stajyer->stajyer_id/cuma/1")?>" class="btn btn-danger" style="border-radius:0;width: -webkit-fill-available;height:40px;font-size:15px!important"><i class="fa fa-times"></i> STAJ YOK</a>
                  <?php endif; ?>
                </td>


              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
      </div>











      
  <div class="col-md-9">
   
<div class="card card-dark">
       <div class="card-header">
        <h3 class="card-title"><strong>UG Business</strong> - Mesai Yönetimi</h3>
         </div>
              <div class="card-body">
        <table id="example1yonlendirilentablo" class="table table-bordered table-striped"   >
         <thead>
         <tr>
          <th>Ad Soyad</th>  
          <th>İletişim Numarası</th>
          <th>Mesai Başlama Saati</th>
          <th style="width: 100px;">İşlem</th> 
         </tr>
         </thead>
         <tbody>
          <?php $count=0; foreach ($kullanicilar as $kullanici) : ?>
           <?php $count++?>
                        
                                  <tr data-id="<?=$kullanici->kullanici_id?>"> 
         
           <td>
            <?php
             if($kullanici->kullanici_resim != ""){
                ?>
                  <img style="width:50px;border-radius:50%; height:50px;object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                <?php
             }else{
              ?>
                 <img style="width:50px;border-radius:50%; height:50px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> 
               
              <?php
             }
     ?>
           
           
           
           <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=$kullanici->kullanici_ad_soyad?></a></b>  
          </td>
            
           <td><i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?></td>
           
                        <td class="mesai-saati-hucre">
                            <span class="mesai-gosterim">
                                <i class="fa fa-clock" style="margin-right:5px;opacity:0.8"></i> 
                                <?=date("H:i",strtotime($kullanici->mesai_baslangic_saati))?>
                            </span>
                            <span class="mesai-input" style="display:none;">
                                <input type="time" class="form-control form-control-sm" style="width:100px;" value="<?=date("H:i",strtotime($kullanici->mesai_baslangic_saati))?>">
                            </span>
                        </td>
          
           
           <td>
                            <button type="button" class="btn btn-warning btn-xs btn-duzenle">
                                <i class="fa fa-pen" style="font-size:12px"></i> Düzenle
                            </button>
                            <button type="button" class="btn btn-success btn-xs btn-kaydet" style="display:none;">
                                <i class="fa fa-save" style="font-size:12px"></i> Kaydet
                            </button>
           </td>
            
          </tr>
         <?php  endforeach; ?>
         </tbody>
 
        </table>
       </div>
             </div>
        </div> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Ajax isteği için CI site URL'sini alalım
    var ajax_url = "<?php echo site_url('kullanici/guncelle_mesai'); ?>";
    
    // Tabloyu seçelim (event delegation için)
    var table = $('#example1yonlendirilentablo');

    // 1. "Düzenle" butonuna tıklanınca...
    table.on('click', '.btn-duzenle', function() {
        var tr = $(this).closest('tr');
        
        // O satırdaki metni gizle, inputu göster
        tr.find('.mesai-gosterim').hide();
        tr.find('.mesai-input').show();
        
        // "Düzenle" butonunu gizle, "Kaydet" butonunu göster
        $(this).hide();
        tr.find('.btn-kaydet').show();
    });

    // 2. "Kaydet" butonuna tıklanınca...
    table.on('click', '.btn-kaydet', function() {
        var tr = $(this).closest('tr');
        var btnKaydet = $(this); // Kaydet butonunu değişkene ata
        var btnDuzenle = tr.find('.btn-duzenle');
        
        // Verileri al
        var kullanici_id = tr.data('id');
        var yeni_mesai_saati = tr.find('.mesai-input input[type="time"]').val();

        // Basit doğrulama
        if (!yeni_mesai_saati) {
            alert('Lütfen geçerli bir saat girin.');
            return;
        }

        // Ajax isteğini başlat
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                kullanici_id: kullanici_id,
                mesai_saati: yeni_mesai_saati
            },
            dataType: 'json',
            beforeSend: function() {
                // İstek sırasında butonu pasif yap ve spinner göster
                btnKaydet.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(response) {
                if (response.success) {
                    // Başarılıysa:
                    // 1. Gösterim metnini güncelle
                    tr.find('.mesai-gosterim').html('<i class="fa fa-clock" style="margin-right:5px;opacity:0.8"></i> ' + response.new_time);
                    
                    // 2. Input'u gizle, metni göster
                    tr.find('.mesai-input').hide();
                    tr.find('.mesai-gosterim').show();
                    
                    // 3. Butonları eski haline getir
                    btnKaydet.hide();
                    btnDuzenle.show();
                } else {
                    // Hata varsa uyar
                    alert('Güncelleme hatası: ' + response.message);
                }
            },
            error: function() {
                alert('Sunucuya bağlanırken bir hata oluştu.');
            },
            complete: function() {
                // İstek bitince butonu tekrar aktif et ve ikonunu düzelt
                btnKaydet.prop('disabled', false).html('<i class="fa fa-save" style="font-size:12px"></i> Kaydet');
            }
        });
    });
});
</script>


    </div>
  </section>
</div>
 