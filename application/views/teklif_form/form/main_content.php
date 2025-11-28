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
                  <i class="fas fa-file-invoice-dollar" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    <?php echo !empty($teklif_form) ? 'Teklif Formu Düzenle' : 'Yeni Teklif Formu'; ?>
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Teklif formu bilgilerini giriniz</small>
                </div>
              </div>
              <a href="<?=base_url("teklif_form")?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-arrow-left"></i> Geri Dön
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if(!empty($teklif_form)){?>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('teklif_form/save').'/'.$teklif_form->teklif_form_id;?>">
            <?php }else{?>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('teklif_form/save');?>">
            <?php } ?>

            <!-- Temel Bilgiler -->
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="teklif_form_musteri_ad" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                    <i class="fas fa-user-tie text-primary"></i> Müşteri Adı <span class="text-danger">*</span>
                  </label>
                  <input type="text" 
                         value="<?php echo !empty($teklif_form) ? $teklif_form->teklif_form_musteri_ad : '';?>" 
                         class="form-control" 
                         name="teklif_form_musteri_ad" 
                         required 
                         placeholder="Müşteri Adını Giriniz..." 
                         style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 15px;">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="teklif_form_tarihi" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                    <i class="far fa-calendar-alt text-primary"></i> Teklif Form Tarihi <span class="text-danger">*</span>
                  </label>
                  <input type="date" 
                         required 
                         class="form-control" 
                         value="<?php echo !empty($teklif_form) ? date("Y-m-d",strtotime($teklif_form->teklif_form_tarihi)) : date("Y-m-d")?>" 
                         name="teklif_form_tarihi" 
                         style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 15px;">
                </div>
              </div>
            </div>

            <!-- Notlar -->
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="teklif_form_birinci_not" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                    <i class="fas fa-sticky-note text-info"></i> Birinci Not
                  </label>
                  <input type="text" 
                         value="<?php echo !empty($teklif_form) ? $teklif_form->teklif_form_birinci_not : 'Vadeli satışlarda maksimum 20 ay sıralı senet şeklinde ( kefilli ) vadeye bölünecektir.';?>" 
                         class="form-control" 
                         name="teklif_form_birinci_not" 
                         placeholder="Birinci Not Giriniz..." 
                         style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 15px;">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="teklif_form_ucuncu_not" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                    <i class="fas fa-sticky-note text-info"></i> İkinci Not
                  </label>
                  <input type="text" 
                         value="<?php echo !empty($teklif_form) ? $teklif_form->teklif_form_ucuncu_not : '';?>" 
                         class="form-control" 
                         name="teklif_form_ucuncu_not" 
                         placeholder="İkinci Not Giriniz..." 
                         style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 15px;">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="teklif_form_ikinci_not" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
                    <i class="fas fa-exclamation-triangle text-warning"></i> Uyarı Notu
                  </label>
                  <input type="text" 
                         value="<?php echo !empty($teklif_form) ? $teklif_form->teklif_form_ikinci_not : 'Not: Peşinat ve vade sayısına göre cihaz fiyatlarında artış yada indirim gerçekleşebilir.';?>" 
                         class="form-control" 
                         name="teklif_form_ikinci_not" 
                         placeholder="Uyarı Notu Giriniz..." 
                         style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 15px;">
                </div>
              </div>
            </div>

            <!-- Ürün Bilgileri -->
            <div class="mb-4">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <label style="font-weight: 700; color: #495057; font-size: 18px; margin: 0;">
                  <i class="fas fa-tools text-danger"></i> Ürün Bilgileri
                </label>
                <button id="satirEkleBtn" 
                        type="button" 
                        onclick="ekle();" 
                        class="btn shadow-sm" 
                        style="border-radius: 8px; font-weight: 600; padding: 8px 16px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #ffffff; border: none;">
                  <i class="fas fa-plus-circle"></i> Yeni Satır Ekle
                </button>
              </div>

              <div class="table-responsive" style="border-radius: 8px; overflow: hidden; border: 1px solid #dee2e6;">
                <table id="servisDetaylariTable" class="table table-bordered table-hover mb-0" style="margin: 0;">
                  <thead style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr class="text-white text-center">
                      <th style="font-weight: 600; padding: 12px 10px; width:20%;">Ürün</th>
                      <th style="font-weight: 600; padding: 12px 10px; width:13%;">Adet</th>
                      <th style="font-weight: 600; padding: 12px 10px; width:13%;">Peşin</th>
                      <th style="font-weight: 600; padding: 12px 10px; width:13%;">Vadeli</th>
                      <th style="font-weight: 600; padding: 12px 10px; width:13%;">Peşinat</th>
                      <th style="font-weight: 600; padding: 12px 10px; width:13%;">Takas Bedeli</th>
                      <th style="font-weight: 600; padding: 12px 10px; width:13%;">Yenilenmiş Mi?</th>
                      <th style="font-weight: 600; padding: 12px 10px; width:15%;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($teklif_form)){
                      $urun_liste = json_decode($teklif_form->teklif_form_urunler, true); 
                      $adet_liste = json_decode($teklif_form->teklif_form_adetler, true); 
                      $pesin_liste = json_decode($teklif_form->teklif_form_pesinler, true); 
                      $vade_liste = json_decode($teklif_form->teklif_form_vadeliler, true); 
                      $pesinat_liste = json_decode($teklif_form->teklif_form_pesinatlar, true); 
                      $takas_liste = json_decode($teklif_form->teklif_form_takas_bedelleri, true); 
                      $yenilenmis_liste = json_decode($teklif_form->teklif_form_yenilenmisler, true); 
                      $count = 0;
                      foreach ($urun_liste as $urun) {
                    ?>
                    <tr>
                      <td>
                        <select class="form-control select2" required name="teklif_form_urunler[]" style="border-radius: 6px;">
                          <option value="">Ürün Seçiniz</option>
                          <?php foreach ($urunler as $urun_item): ?>
                            <option value="<?=$urun_item->urun_id?>" <?=($urun_liste[$count] == $urun_item->urun_id) ? "selected":""?>><?=$urun_item->urun_adi?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <input type="number" 
                               value="<?=$adet_liste[$count]?>" 
                               name="teklif_form_adetler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: center;">
                      </td>
                      <td>
                        <input type="text" 
                               value="<?=$pesin_liste[$count]?>" 
                               name="teklif_form_pesinler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               value="<?=$vade_liste[$count]?>" 
                               name="teklif_form_vadeliler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               value="<?=$pesinat_liste[$count]?>" 
                               name="teklif_form_pesinatlar[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               value="<?=$takas_liste[$count]?>" 
                               name="teklif_form_takaslar[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               value="<?=$yenilenmis_liste[$count] ?? ''?>" 
                               name="teklif_form_yenilenmisler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: center;">
                      </td>
                      <td style="text-align: center;">
                        <button type="button" 
                                class="btn btn-sm btn-danger satirSilBtn" 
                                style="border-radius: 6px; padding: 6px 12px;"
                                onclick="if(confirm('Bu satırı silmek istediğinize emin misiniz?')) { this.closest('tr').remove(); }">
                          <i class="fas fa-trash"></i> Sil
                        </button>
                      </td>
                    </tr>
                    <?php
                      $count++;
                      }
                    } else {
                    ?>
                    <tr>
                      <td>
                        <select class="form-control select2" required name="teklif_form_urunler[]" style="border-radius: 6px;">
                          <option value="">Ürün Seçiniz</option>
                          <?php foreach ($urunler as $urun): ?>
                            <option value="<?=$urun->urun_id?>"><?=$urun->urun_adi?></option>
                          <?php endforeach; ?>
                        </select>
                      </td>
                      <td>
                        <input type="number" 
                               name="teklif_form_adetler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: center;">
                      </td>
                      <td>
                        <input type="text" 
                               name="teklif_form_pesinler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               name="teklif_form_vadeliler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               name="teklif_form_pesinatlar[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               name="teklif_form_takaslar[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: right;">
                      </td>
                      <td>
                        <input type="text" 
                               name="teklif_form_yenilenmisler[]" 
                               class="form-control" 
                               style="border-radius: 6px; text-align: center;">
                      </td>
                      <td style="text-align: center;">
                        <button type="button" 
                                class="btn btn-sm btn-danger satirSilBtn" 
                                style="border-radius: 6px; padding: 6px 12px;"
                                onclick="if(confirm('Bu satırı silmek istediğinize emin misiniz?')) { this.closest('tr').remove(); }">
                          <i class="fas fa-trash"></i> Sil
                        </button>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Footer Butonları -->
            <div class="card-footer border-0" style="background-color: #f8f9fa; padding: 20px 25px; border-radius: 0 0 12px 12px;">
              <div class="row">
                <div class="col-md-6">
                  <a href="<?=base_url("teklif_form")?>" 
                     class="btn shadow-sm" 
                     style="border-radius: 8px; font-weight: 600; padding: 10px 20px; background-color: #dc3545; color: #ffffff; border: none;">
                    <i class="fas fa-times"></i> İptal
                  </a>
                </div>
                <div class="col-md-6 text-right">
                  <button type="submit" 
                          class="btn shadow-sm" 
                          style="border-radius: 8px; font-weight: 600; padding: 10px 20px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: #ffffff; border: none;">
                    <i class="fas fa-save"></i> Kaydet
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }

  .table tbody tr:hover {
    background-color: #f8f9fa;
  }

  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
  }

  .btn:active {
    transform: translateY(0);
  }

  #satirEkleBtn:hover {
    background: linear-gradient(135deg, #20c997 0%, #28a745 100%) !important;
  }

  @media (max-width: 768px) {
    .table {
      font-size: 12px;
    }
    
    .table th,
    .table td {
      padding: 8px 5px !important;
    }
  }
</style>

<script>
function ekle(){
  var table = document.getElementById("servisDetaylariTable").getElementsByTagName('tbody')[0]; 
  var row = table.insertRow(table.rows.length);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  var cell7 = row.insertCell(6);
  var cell8 = row.insertCell(7);

  var select2 = document.createElement("select");
  var textbox = document.createElement("input");
  var textbox2 = document.createElement("input");
  var textbox3 = document.createElement("input");
  var textbox4 = document.createElement("input");
  var textbox5 = document.createElement("input");
  var textbox6 = document.createElement("input");
  var deleteButton = document.createElement("button");

  select2.className = "form-control select2";
  select2.name = "teklif_form_urunler[]";
  select2.required = true;
  select2.style.borderRadius = "6px";
  select2.innerHTML = '<option value="">Ürün Seçiniz</option><?php foreach ($urunler as $urun): ?><option value="<?= $urun->urun_id ?>"><?= $urun->urun_adi ?></option><?php endforeach; ?>';
  
  textbox.type = "number";
  textbox.name = "teklif_form_adetler[]";
  textbox.className = "form-control";
  textbox.style.borderRadius = "6px";
  textbox.style.textAlign = "center";
  
  textbox2.type = "text";
  textbox2.name = "teklif_form_pesinler[]";
  textbox2.className = "form-control";
  textbox2.style.borderRadius = "6px";
  textbox2.style.textAlign = "right";

  textbox3.type = "text";
  textbox3.name = "teklif_form_vadeliler[]";
  textbox3.className = "form-control";
  textbox3.style.borderRadius = "6px";
  textbox3.style.textAlign = "right";

  textbox4.type = "text";
  textbox4.name = "teklif_form_pesinatlar[]";
  textbox4.className = "form-control";
  textbox4.style.borderRadius = "6px";
  textbox4.style.textAlign = "right";

  textbox5.type = "text";
  textbox5.name = "teklif_form_takaslar[]";
  textbox5.className = "form-control";
  textbox5.style.borderRadius = "6px";
  textbox5.style.textAlign = "right";

  textbox6.type = "text";
  textbox6.name = "teklif_form_yenilenmisler[]";
  textbox6.className = "form-control";
  textbox6.style.borderRadius = "6px";
  textbox6.style.textAlign = "center";

  deleteButton.type = "button";
  deleteButton.className = "btn btn-sm btn-danger satirSilBtn";
  deleteButton.style.borderRadius = "6px";
  deleteButton.style.padding = "6px 12px";
  deleteButton.innerHTML = '<i class="fas fa-trash"></i> Sil';
  deleteButton.addEventListener("click", function() {
    if(confirm('Bu satırı silmek istediğinize emin misiniz?')) {
      row.remove();
    }
  });
  
  cell1.appendChild(select2);
  cell2.appendChild(textbox);
  cell3.appendChild(textbox2);
  cell4.appendChild(textbox3);
  cell5.appendChild(textbox4);
  cell6.appendChild(textbox5);
  cell7.appendChild(textbox6);
  cell8.appendChild(deleteButton);

  // Yeni eklenen select2'yi initialize et
  if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
    $(select2).select2();
  }
}

document.addEventListener("DOMContentLoaded", function() {
  // Mevcut select2'leri initialize et
  if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
    $('.select2').select2({
      theme: 'bootstrap4',
      width: '100%'
    });
  }
});
</script>
