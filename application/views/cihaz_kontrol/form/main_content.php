<div class="content-wrapper pt-2">
  <section>
 
  <div class="row">

     <div class="col-md-3">


     <div class="card card-dark card-outline">
              <div class="card-body box-profile">

              <div class="text-center">
                  <img class="profile-user-img img-fluid " src="<?=$urun_detay->urun_png_gorsel?>" style="border: 0px;width: 300px;margin-bottom: -166px;" alt="User profile picture">
                </div>
 <div style="background: #ebebebf5; z-index: 9999; position: relative; height: 72px; padding-top: 5px; border-radius: 30px 30px 0 0;
"> <h3 class="profile-username text-center"><?=$urun_detay->urun_adi?></h3>

                <p class="text-muted text-center" style="margin-top:-5px"><?=$urun_detay->urun_aciklama?></p>

</div>

               
                <ul class="list-group list-group-unbordered  ">
                  
 <?php 
             $sayi = $urun_detay->cihaz_test_sayisi;
           
             ?> 
              <?php $testcounter = 0;
                foreach ($test_planlari as $plan) :
                ?>
            <div style="margin-top:10px;border:1px solid rgb(204, 204, 204)"> <div class="card-body">
                  <li class="list-group-item" style="border-radius: 10px 10px 0 0;">
                    <b><i class="far fa-file-alt mr-1"></i> <?=$plan->cihaz_kontrol_form_test_sira_no?>. Cihaz Testi</b>  
<?php 

                  if($plan->cihaz_kontrol_form_test_tamamlandi == 0){
                    $testcounter ++;
                   
                      ?>
                       
                      <?php    if( $testcounter != 1){  ?>
                      <a class="btn btn-success btn-sm mb-1 float-right" style=" background:rgba(167, 0, 0, 0.68);color:white!important;margin-top:-5px; margin-right:-10px; border-radius:5px; border: 1px solid rgb(255, 36, 36);"  >
              <i class=" 	fas fa-clock  " style="font-size:13px"></i> Beklemede</a>
                    <?php 
                      }
                    if( $testcounter == 1){
                      ?>
                       <a class="btn btn-success btn-sm mb-1  float-right" style=" background:rgb(255, 230, 0);color:black!important;margin-top:-5px;margin-right:-10px;border-radius:5px; border: 1px solid rgb(211, 207, 0);"  >
              Test Sürecinde <i class="fas fa-arrow-circle-right"></i></a> 
                      <?php
                    }
                    ?>
              
                   
                     <?php
                  } else{
                    ?>
  <a class="btn btn-success btn-sm mb-1 float-right" style=" background:rgba(0, 167, 8, 0.85);color:white!important;margin-top:-5px;margin-right:-10px;border-radius:5px; border: 1px solid rgb(0, 168, 8);"  >
             <i class="fa fa-check"></i> Tamamlandı</a>

                    <?php
                  }
                     ?>
                  </li> 
 
                  <?php 
                  if($plan->cihaz_kontrol_form_test_tamamlandi == 0){
                      ?>
                         <a class="btn btn-success btn-sm mb-1 text-left" style="margin-top: -1px; background: #edededad; color: #666666 !important; border-radius: 0 0  ; border: 1px solid #d8d8d8; width: -webkit-fill-available;"  >
              Planlanan Test Tarihi : <span style="color: #c12734;"><?=date("d.m.Y",strtotime($plan->cihaz_kontrol_form_test_baslangic_tarihi))?> (- Gün Kaldı)</span></a>

                      <?php
                  }else{
                     ?>
                         <a class="btn btn-success btn-sm mb-1 text-left" style="margin-top: -1px; background: #edededad; color: #666666 !important; border-radius: 0 0  ; border: 1px solid #d8d8d8; width: -webkit-fill-available;"  >
              Test Tamamlanma Tarihi : <span style="color:rgb(37, 187, 0);"><?=date("d.m.Y",strtotime($plan->cihaz_kontrol_form_test_bitis_tarihi))?></span></a>

                      <?php
                  }
                  ?>
           


                        <a class="btn btn-success btn-sm mb-1 text-left" style="margin-top: -2px; background: #edededad; color: #666666 !important; border-radius:0 0 10px 10px ; border: 1px solid #d8d8d8; width: -webkit-fill-available;"  >
              Test Edecek Kullanıcı : <span style="color:rgb(0, 94, 201);">Ergül Kızılkaya</span></a>
              </div>    </div> 
            <?php endforeach; ?>

                  
                </ul>
 
              </div>
              <!-- /.card-body -->
            </div>

   
  </div>

    <div class="col-md-9">
      <div class="card card-dark">

  <div class="card-header text-center" style="font-size: 31px; font-weight: 500;">

  CİHAZ KONTROL FORMU / <?=$dataform->cihaz_kontrol_form_test_sira_no?>. CİHAZ TESTİ

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
                <td style=" <?=$currentValue==='' ? "color:rgb(161, 15, 4);  background:rgba(184, 0, 0, 0.13);    " : ""?>padding:10px;text-align:center; cursor:pointer;"
                    class="olcum-cell"
                    data-form-id="<?= $form_id ?>"
                    data-row-id="<?= $r['kontrol_form_data_row_id'] ?>"
                    data-col-id="<?= $h['kontrol_form_baslik_id'] ?>"
                    data-current-value="<?= $currentValue ?>"
                >
                    <?= $currentValue !== '' ?  $currentValue : '<span style="opacity:1">Kayıt Gir</span>' ?>
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
    // Hücre içeriğini yeni değerle güncelle
    cell.textContent = result.value;

    // Yeşil onay işareti ekle
    const checkIcon = document.createElement('span');
    checkIcon.textContent = '✅';
    checkIcon.style.color = 'green';
    checkIcon.style.fontSize = '16px';
    checkIcon.style.marginLeft = '5px';
    cell.appendChild(checkIcon);

    // Hücreye yeni değeri data-current-value olarak ayarla
    cell.dataset.currentValue = result.value;

    // 2 saniye sonra check işaretini kaldır
    setTimeout(() => {
        checkIcon.remove();
        location.reload();
    }, 2000);
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
