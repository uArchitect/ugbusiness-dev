<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
  <section class="content text-md">
    <div class="card card-dark" style="border-radius:0px !important;">
      <div class="card-header">
        <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Demirbaş Yönetimi</h3>
        <a href="<?=base_url("demirbas/ekle/1")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
        <?php if(!empty($kategori_kontrol)) { ?>
          <a href="<?=base_url("demirbas")?>" type="button" class="btn btn-danger btn-sm mr-2" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-times text-white" style="font-size:12px" aria-hidden="true"></i> Filtrelemeyi kaldır, tüm kayıtları göster</a>
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
            <?php $count=0; foreach ($demirbaslar as $demirbas) : ?>
              <tr>
                <td>
                  <?php
                    // Your image logic here for different categories
                  ?>
                </td> 
                <td> 
                  <?=$demirbas->demirbas_adi?> 
                  <span style="margin-top:9px" class="d-block"><?=$demirbas->demirbas_marka?></span>
                </td>
                <td>
                  <span style="margin-top:9px;display:block">
                    <i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$demirbas->kullanici_ad_soyad?>
                  </span>
                </td>
                <td>
                  <span style="margin-top:9px;display:block">
                    <i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i>
                    <?=date('d.m.Y H:i',strtotime($demirbas->demirbas_kayit_tarihi));?>
                  </span>
                </td>
                <td>
                  <a href="<?=site_url("demirbas/duzenle/$demirbas->demirbas_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                  <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('demirbas/sil/').$demirbas->demirbas_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                  <!-- Add button to toggle inventory list visibility -->
                  <button class="btn btn-info btn-xs" onclick="toggleInventory(<?=$demirbas->demirbas_id?>)">
                    <i class="fa fa-plus"></i> Envanteri Göster
                  </button>
                </td>
              </tr>
              <!-- Expandable row to show the inventory -->
              <tr id="inventory-row-<?=$demirbas->demirbas_id?>" style="display:none;">
                <td colspan="5">
                  <!-- Here, display the inventory details related to the user -->
                  <ul>
                    <!-- Loop through inventory items assigned to this user -->
                    <?php foreach ($demirbas->inventory as $item) : ?>
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
  // Function to toggle inventory visibility
  function toggleInventory(demirbasId) {
    var row = document.getElementById('inventory-row-' + demirbasId);
    if (row.style.display === "none") {
      row.style.display = "table-row";
    } else {
      row.style.display = "none";
    }
  }
</script>
