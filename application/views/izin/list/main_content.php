<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
  <section class="content text-md">
    <div class="row">
      <div class="col-md-9">
        
    <div class="card card-default" style="border-radius:0px !important;">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><strong>Business</strong> - İzin Yönetimi</h3>
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
              <th style="width: 42px;">Kod</th>
              <th>Talep Eden Kullanıcı</th>
              <th>İzin Nedeni</th>
              <th style="width: 160px;">İzin Başlangıç</th>
              <th style="width: 130px;">İzin Bitiş</th> 
              <th style="width: 190px;">İşlem</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($istekler as $istek): ?>

              <?php if ($istek->izin_durumu == 0){continue;} ?>

              <?php if (!empty($_GET['filter']) && $istek->insan_kaynaklari_onay_durumu != $_GET['filter']) continue; ?>
              <tr>
                <td>T<?=str_pad($istek->izin_talep_id, 5, '0', STR_PAD_LEFT);?></td>
                <td><b><i class="far fa-file-alt mr-1"></i><?=$istek->kullanici_ad_soyad?></b> / <?=$istek->departman_adi?></td>
                <td><b><i class="far fa-building mr-1"></i><?=$istek->izin_neden_detay?><br><span style="font-weight:300;font-size:13px"><?=$istek->izin_notu?></span></b></td>
                <td><i class="fa fa-user-circle mr-1 opacity-75"></i><b><?=date('d.m.Y H:i', strtotime($istek->izin_baslangic_tarihi));?></b></td>
                <td><i class="fa fa-user-circle mr-1 opacity-75"></i><b><?=date('d.m.Y H:i', strtotime($istek->izin_bitis_tarihi));?></b></td>
                 
               

                <td>
                  <?php if ($istek->izin_durumu == 0): ?>
                    <span class="text-danger"><i class="fas fa-exclamation-circle"></i> İptal edildi.</span>
                  <?php else: ?> 
                     <a href="<?=site_url('izin/iptal_et/'.$istek->izin_talep_id)?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> İptal Et</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
      </div>
<div class="col-md-3">
   
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
                <input type="datetime-local" id="izin_baslangic_tarihi" name="izin_baslangic_tarihi" required>
            </div>

            <div class="form-group">
                <label for="izinBitis">İzin Bitiş Tarihi:</label>
                <input type="datetime-local" id="izin_bitis_tarihi" name="izin_bitis_tarihi" required>
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

    </div>
  </section>
</div>
 