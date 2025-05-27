<div class="content-wrapper pt-2">
  <section>
 
  <div class="row">
    <div class="col-md-7">
      <div class="card card-dark">

  <div class="card-header text-center" style="font-size: 31px; font-weight: 500;">

  CİHAZ KONTROL FORMU

  </div>

  <div class="card-body">




 <table border="2" style=" height:40px; margin-bottom:15px;  width: -webkit-fill-available;">
        <tr>
            <td style="width:120px;border:2px solid black; text-align:center;font-weight:900">
            Cihaz Seri No :
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <input type="text" style="  height:20px;  border: 0;" name="" class="form-control" id=""></input>
          </td>
          <td style="width:100px;border:2px solid black; text-align:center;font-weight:900">
            Versiyon :
          </td>
          <td style="width:195px;padding-left:5px;border:2px solid black;">
            <input type="text" style="  height:20px;  border: 0;" name="" class="form-control" id=""></input>
          </td>
        </tr>
      </table>


  
 <div class="row mb-3">
  <div class="col pl-0">
     <table border="2" style="    width: -webkit-fill-available;">
      <?php 
        for ($i=0; $i < 10 ; $i++) { 
      ?>
        <tr>
          <td style="border:2px solid black;padding:5px;text-align:center;font-weight:900">
            <?=$i+1?>
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <?=$checklist[$i]->kontrol_form_checklist_label?>
          </td>
          <td style="border:2px solid black;padding:10px;text-align:center">
            <input type="checkbox" name="" id="">
          </td>
        </tr>
      <?php
        }
      ?>
      </table>
  </div>
<div class="col pr-2 pl-2">
     <table border="2" style="    width: -webkit-fill-available;">
      <?php 
        for ($i=10; $i < 20 ; $i++) { 
      ?>
        <tr>
            <td style="border:2px solid black;padding:5px;text-align:center;font-weight:900">
            <?=$i+1?>
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <?=$checklist[$i]->kontrol_form_checklist_label?>
          </td>
            <td style="border:2px solid black;padding:10px;text-align:center">
            <input type="checkbox" name="" id="">
          </td>
        </tr>
      <?php
        }
      ?>
      </table>
  </div>
  <div class="col pr-0">
     <table border="2" style="    width: -webkit-fill-available;">
      <?php 
        for ($i=20; $i < 30 ; $i++) { 
      ?>
        <tr>
              <td style="border:2px solid black;padding:5px;text-align:center;font-weight:900">
            <?=$i+1?>
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <?=$checklist[$i]->kontrol_form_checklist_label?>
          </td>
            <td style="border:2px solid black;padding:10px;text-align:center">
            <input type="checkbox" name="" id="">
          </td>
        </tr>
      <?php
        }
      ?>
      </table>
  </div>


 </div>


<table border="2" style="width: -webkit-fill-available;" id="olcumTablosu">
    <tr>
        <th style="width:120px;border:2px solid black;padding:10px;text-align:center">Atış Sayısı</th>
        <?php foreach ($headers as $h): ?>
            <th style="border:2px solid black;padding:10px;text-align:center;">
                <?= htmlspecialchars($h['kontrol_form_baslik_adi']) ?>
            </th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($rows as $r): ?>
        <tr style="height:50px">
            <td style="font-weight:600;border:2px solid black;padding:20px;text-align:center">
                <?= htmlspecialchars($r['kontrol_form_data_row_label']) ?>
            </td>

            <?php foreach ($headers as $h): ?>
                <?php
                    $currentValue = isset($data[$r['kontrol_form_data_row_id']][$h['kontrol_form_baslik_id']])
                        ? htmlspecialchars($data[$r['kontrol_form_data_row_id']][$h['kontrol_form_baslik_id']])
                        : '';
                ?>
                <td style="padding:10px;text-align:center; cursor:pointer;"
                    class="olcum-cell"
                    data-form-id="<?= $form_id ?>"
                    data-row-id="<?= $r['kontrol_form_data_row_id'] ?>"
                    data-col-id="<?= $h['kontrol_form_baslik_id'] ?>"
                    data-current-value="<?= $currentValue ?>"
                >
                    <?= $currentValue !== '' ? $currentValue : '-' ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>









 <table border="2" style="  margin-top:15px;  width: -webkit-fill-available;">
        <tr>
            <td style="width:120px;border:2px solid black;padding:5px;text-align:center;font-weight:900">
            NOT:
          </td>
          <td style="padding-left:5px;border:2px solid black;">
            <textarea style="    border: 0;" name="" class="form-control" id=""></textarea>
          </td>
         
        </tr>
      </table>




  </div>
</div>
    </div>
  </div>


   
  </section>
</div>
 
            


<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.olcum-cell').forEach(function(cell) {
        cell.addEventListener('click', function() {
            const form_id = this.dataset.formId;
            const row_id = this.dataset.rowId;
            const col_id = this.dataset.colId;
            const current_value = this.dataset.currentValue;

            Swal.fire({
                title: 'Ölçüm Değeri Girin',
                input: 'text',
                inputLabel: 'Yeni Değer',
                inputValue: current_value,
                showCancelButton: true,
                confirmButtonText: 'Kaydet',
                cancelButtonText: 'İptal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Değer boş olamaz!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX ile güncelle
                    fetch(`<?= base_url('cihaz_kontrol/olcum_update/') ?>${form_id}/${row_id}/${col_id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({
                            olcum_value: result.value
                        })
                    })
                    .then(res => res.text())
                    .then(() => {
                        Swal.fire('Başarılı!', 'Ölçüm verisi güncellendi.', 'success')
                        .then(() => location.reload());
                    })
                    .catch(err => {
                        Swal.fire('Hata!', 'Güncelleme sırasında sorun oluştu.', 'error');
                    });
                }
            });
        });
    });
});
</script>
