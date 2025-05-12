 <div class="content-wrapper" style="padding-top:8px">
  <section class="content text-md"> 
    <div class="row">
      <div class="col">
        <div class="card card-success">
          <div class="card-header">
            YAPILACAK İŞLER
            <div class="card-tools">
            <button class="btn btn-default" onclick="yeniIsEkle()">
  <i class="fas fa-plus-circle"></i> Yeni İş Ekle
</button>

            </div>
          </div>
         <div class="card-body">
         <div id="yapilacaklar">
<?php $sirano=0; foreach ($data as $d) :?>
  <?php $sirano++;?>
  <?php if($d->tamamlandi_mi == 1){continue;}?>
  <div class="card is-item" data-id="<?= $d->yazilim_id ?>" style="box-shadow: none;border: 0px!important;   margin-bottom: 5px;">
    <div class="card-header" style="border: 0;background: #f6f6f6;">
      <h5 class="card-title" style="width: 477px;">
      <?php 
        
        $metin = str_replace("I","ı",$d->yazilim_detay);
$duzenlenmisMetin = mb_convert_case($metin, MB_CASE_TITLE, "UTF-8");

echo $duzenlenmisMetin;
        
        ?>
      </h5>
      <div class="card-tools">
  <button class="btn btn-tool text-orange" onclick="duzenle(<?= $d->yazilim_id ?>, '<?= htmlspecialchars($d->yazilim_detay, ENT_QUOTES) ?>', '<?= htmlspecialchars($d->kullanici_ad_soyad, ENT_QUOTES) ?>')">
    <i class="fas fa-pen"></i> Düzenle
  </button>
  <button class="btn btn-tool text-success" onclick="tamamla(<?= $d->yazilim_id ?>)">
    <i class="	fas fa-check"></i> Tamamlandı
  </button>
  <button class="btn btn-tool text-danger" onclick="sil(<?= $d->yazilim_id ?>)">
    <i class="fas fa-trash"></i> Sil
  </button>
</div>
    </div>
  </div>
<?php endforeach; ?>
</div>
         </div>
        </div>
      </div>
      <div class="col">
          <div class="card card-dark">
            <div class="card-header">
              TAMAMLANAN İŞLER
            </div>
            <div class="card-body">


            
<?php foreach ($data as $d) :?>
  <?php if($d->tamamlandi_mi == 0){continue;}?>
  <div class="card is-item" data-id="<?= $d->yazilim_id ?>" style="box-shadow: none;border: 0px!important;    margin-bottom: 5px;">
    <div class="card-header" style="border: 0;background: #f6f6f6;">
      <h5 class="card-title" style="width: 477px;">
        <?php 
        
        $metin = str_replace("I","ı",$d->yazilim_detay);
$duzenlenmisMetin = mb_convert_case($metin, MB_CASE_TITLE, "UTF-8");

echo $duzenlenmisMetin;
        
        ?>
     </h5>
      <div class="card-tools">
  <button class="btn btn-tool text-orange" onclick="duzenle(<?= $d->yazilim_id ?>, '<?= htmlspecialchars($d->yazilim_detay, ENT_QUOTES) ?>', '<?= htmlspecialchars($d->kullanici_ad_soyad, ENT_QUOTES) ?>')">
    <i class="fas fa-pen"></i> Düzenle
  </button>
  <button class="btn btn-tool text-success" onclick="bekleme(<?= $d->yazilim_id ?>)">
    <i class="	fas fa-clock"></i> Beklemeye Al
  </button>
  <button class="btn btn-tool text-danger" onclick="sil(<?= $d->yazilim_id ?>)">
    <i class="fas fa-trash"></i> Sil
  </button>
</div>
    </div>
  </div>
<?php endforeach; ?>
 



         
         </div>
          </div>
      </div>
    </div>
  </section>
</div>



<script>
function sil(id) {
  Swal.fire({
    title: 'Emin misiniz?',
    text: "Bu işi silmek istiyor musunuz?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Evet, sil!',
    cancelButtonText: 'İptal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?= base_url('yazilim/sil/') ?>" + id;
    }
  });
}
function bekleme(id) {
  Swal.fire({
    title: 'Tamamlandı olarak işaretlensin mi?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Evet',
    cancelButtonText: 'İptal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?= base_url('yazilim/bekleme/') ?>" + id;
    }
  });
}

function tamamla(id) {
  Swal.fire({
    title: 'Tamamlandı olarak işaretlensin mi?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Evet',
    cancelButtonText: 'İptal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?= base_url('yazilim/tamamla/') ?>" + id;
    }
  });
}

function duzenle(id, detay, kullanici) {
  Swal.fire({
    title: 'İşi Düzenle',
    html:
      `<textarea id="detay" class="swal2-input"  placeholder="Detay">${detay}</textarea>`,
    showCancelButton: true,
    confirmButtonText: 'Kaydet',
    cancelButtonText: 'İptal',
    preConfirm: () => {
      const detay = document.getElementById('detay').value;
      if (!detay) {
        Swal.showValidationMessage('Tüm alanları doldurun');
      }
      return { detay }
    }
  }).then((result) => {
    if (result.isConfirmed) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = "<?= base_url('yazilim/guncelle/') ?>" + id;

      const detayInput = document.createElement('input');
      detayInput.type = 'hidden';
      detayInput.name = 'yazilim_detay';
      detayInput.value = result.value.detay;
 

      form.appendChild(detayInput); 

      document.body.appendChild(form);
      form.submit();
    }
  });
}
</script>




<script>
function yeniIsEkle() {
  Swal.fire({
    title: 'Yeni İş Ekle',
    html:
      `<textarea id="detay" class="swal2-input" placeholder="İş Detayı"></textarea>` ,
    showCancelButton: true,
    confirmButtonText: 'Ekle',
    cancelButtonText: 'İptal',
    preConfirm: () => {
      const detay = document.getElementById('detay').value;
      if (!detay) {
        Swal.showValidationMessage('Tüm alanları doldurun');
      }
      return { detay };
    }
  }).then((result) => {
    if (result.isConfirmed) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = "<?= base_url('yazilim/ekle') ?>";

      const detayInput = document.createElement('input');
      detayInput.type = 'hidden';
      detayInput.name = 'yazilim_detay';
      detayInput.value = result.value.detay;

      
      form.appendChild(detayInput); 

      document.body.appendChild(form);
      form.submit();
    }
  });
}
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(function() {
  $("#yapilacaklar").sortable({
    handle: ".card-header", // sadece başlıktan tutularak sürüklensin
    update: function(event, ui) {
      let order = [];
      $(".is-item").each(function(index, element){
        order.push($(this).data("id"));
      });

      $.ajax({
        url: "<?= base_url('yazilim/sirala') ?>",
        method: "POST",
        data: { order: order },
        success: function(response) {
          Swal.fire('Sıralama Kaydedildi!', '', 'success');
        },
        error: function() {
          Swal.fire('Hata!', 'Sıralama kaydedilemedi.', 'error');
        }
      });
    }
  });
});
</script>


  
