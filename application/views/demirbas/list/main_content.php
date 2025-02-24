<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
  <section class="content text-md">
    <div class="card card-dark" style="border-radius:0px !important;">
      <div class="card-header">
        <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Demirbaş Yönetimi</h3>
        <a href="<?=base_url("demirbas/ekle/1")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;">
          <i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle
        </a>
        <?php if(!empty($kategori_kontrol)) { ?>
          <a href="<?=base_url("demirbas")?>" type="button" class="btn btn-danger btn-sm mr-2" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;">
            <i class="fa fa-times text-white" style="font-size:12px" aria-hidden="true"></i> Filtrelemeyi kaldır, tüm kayıtları göster
          </a>
        <?php } ?>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped text-sm">
          <thead>
            <tr>
              <th style="width: 42px;">Kod</th>
              <th>Envanter Bilgisi</th>
              <th>Envanter Kullanıcısı</th>
              <th style="width: 130px;">Kayıt Tarihi</th>
              <th style="width: 170px;">İşlem</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($demirbaslar as $demirbas): ?>
              <tr>
                <td>
                  <?php
                    // Kategoriye göre resim gösterimi
                    if($demirbas->kategori_id == 1) {
                        echo '<img style="width:40px" src="https://m.media-amazon.com/images/I/71s72QE+voL.jpg">';
                    } elseif($demirbas->kategori_id == 2) {
                        echo '<img style="width:40px" src="https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg">';
                    } elseif($demirbas->kategori_id == 3) {
                        echo '<img style="width:40px" src="https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png">';
                    } elseif($demirbas->kategori_id == 4) {
                        echo '<img style="width:40px" src="https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp">';
                    }
                  ?>
                </td>
                <td>
                  <?=$demirbas->demirbas_adi?>
                  <?php if($demirbas->kategori_id == 3): ?>
                    <span style="margin-top:9px" class="d-block">Multinet Kart</span>
                  <?php else: ?>
                    <span style="margin-top:9px" class="d-block"><?=$demirbas->demirbas_marka?></span>
                  <?php endif; ?>
                </td>
                <td>
                  <span style="margin-top:9px;display:block">
                    <i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$demirbas->kullanici_ad_soyad?>
                  </span>
                </td>
                <td>
                  <span style="margin-top:9px;display:block">
                    <i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i>
                    <?=date('d.m.Y H:i', strtotime($demirbas->demirbas_kayit_tarihi));?>
                  </span>
                </td>
                <td>
                  <a href="<?=site_url("demirbas/duzenle/$demirbas->demirbas_id")?>" type="button" class="btn btn-warning btn-xs">
                    <i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle
                  </a>
                  <a type="button" onclick="confirm_action('Silme İşlemini Onayla', 'Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.', 'Onayla', '<?=base_url('demirbas/sil/').$demirbas->demirbas_id?>');" class="btn btn-danger btn-xs">
                    <i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil
                  </a>
                  <!-- Buton ile envanter detaylarını göster/gizle -->
                  <button class="btn btn-info btn-xs" onclick="toggleInventory(<?=$demirbas->demirbas_id?>)">
                    <i class="fa fa-plus"></i> Envanteri Göster
                  </button>
                </td>
              </tr>
              <!-- Kullanıcıya ait envanterleri filtreleyerek listeleme -->
              <tr id="inventory-row-<?=$demirbas->demirbas_id?>" style="display:none;">
                <td colspan="5">
                  <?php 
                    // Eğer her $demirbas için doğrudan ilgili envanterler gelmiyorsa,
                    // tüm envanter listesinden kullanıcıya ait olanları filtreleyin.
                    // Aşağıdaki örnekte $allInventories dizisinden filtreleme yapılmaktadır.
                    // Eğer zaten $demirbas->inventory mevcutsa, bunu kullanın.
                    if(isset($demirbas->inventory)) {
                      $userInventories = $demirbas->inventory;
                    } else {
                      // Örnek filtreleme: $allInventories tüm envanterleri içeriyor
                      $userInventories = array_filter($allInventories, function($item) use ($demirbas) {
                          return $item->kullanici_id == $demirbas->kullanici_id;
                      });
                    }
                  ?>
                  <ul>
                    <?php foreach ($userInventories as $item): ?>
                      <li><?=$item->item_name?> - <?=$item->quantity?></li>
                    <?php endforeach; ?>
                  </ul>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
</div>

<script>
  // JavaScript fonksiyonu: Envanter satırını göster/gizle
  function toggleInventory(demirbasId) {
    var row = document.getElementById('inventory-row-' + demirbasId);
    if (row.style.display === "none" || row.style.display === "") {
      row.style.display = "table-row";
    } else {
      row.style.display = "none";
    }
  }
</script>
