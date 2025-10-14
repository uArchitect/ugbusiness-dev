<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
  <section class="content text-md">
    <div class="card card-default" style="border-radius:0px !important;">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><strong>Business</strong> - İzin Yönetimi</h3>
        <div>
          <a href="<?=base_url('izin/add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus" style="font-size:12px"></i> Yeni Kayıt Ekle</a>
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
              <?php if (!empty($_GET['filter']) && $istek->insan_kaynaklari_onay_durumu != $_GET['filter']) continue; ?>
              <tr>
                <td>T<?=str_pad($istek->izin_talep_id, 5, '0', STR_PAD_LEFT);?></td>
                <td><b><i class="far fa-file-alt mr-1"></i><?=$istek->kullanici_ad_soyad?></b> / <?=$istek->departman_adi?></td>
                <td><b><i class="far fa-building mr-1"></i><?=$istek->izin_neden_detay?></b></td>
                <td><i class="fa fa-user-circle mr-1 opacity-75"></i><b><?=date('d.m.Y H:i', strtotime($istek->izin_baslangic_tarihi));?></b></td>
                <td><i class="fa fa-user-circle mr-1 opacity-75"></i><b><?=date('d.m.Y H:i', strtotime($istek->izin_bitis_tarihi));?></b></td>
                 
               

                <td>
                  <?php if ($istek->izin_durumu == 0): ?>
                    <span class="text-danger"><i class="fas fa-exclamation-circle"></i> İptal edildi.</span>
                  <?php else: ?>
                    <a href="<?=site_url('izin/edit/'.$istek->izin_talep_id)?>" class="btn btn-warning btn-xs"><i class="fa fa-pen"></i> Bilgileri Görüntüle</a>
                     <a href="<?=site_url('izin/iptal_et/'.$istek->izin_talep_id)?>" class="btn btn-warning btn-xs"><i class="fa fa-pen"></i> İptal Et</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
 