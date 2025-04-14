<div class="content-wrapper pt-2">
    <div class="row mb-2">
        <div class="col">
            <div class="btn-group">
            <?php foreach ($sablonlar as $sablon) : ?>
    <a href="<?=base_url("sablon/index/$sablon->sablon_kategori_id")?>" 
       type="button" 
       class="btn <?=$secilen_kategori->sablon_kategori_id == $sablon->sablon_kategori_id ? "btn-success" : "btn-default"?>">
        <?=$sablon->sablon_kategori_adi?>
    </a>
    <button 
        class="btn btn-warning btn-sm editKategoriBtn" 
        data-id="<?=$sablon->sablon_kategori_id?>" 
        data-ad="<?=$sablon->sablon_kategori_adi?>">
        <i class="fa fa-edit"></i>
    </button>
<?php endforeach; ?>

                <button type="button" class="btn btn-default text-success  " name="addKategori"><i class="fa fa-plus"></i></button> 
            </div>
        </div>
    </div>

    <div class="row gap-2">
        <?php 
        foreach ($veriler as $veri) {
            ?>
            <div class="col-md-3">
            <div class="card card-dark">
                <div class="card-header" >
                    <?=$veri->sablon_veri_adi?>
                </div>
                <div class="card-body">
                    <textarea name="" style="height:270px" class="form-control" id=""></textarea>
                    <button style="width: -webkit-fill-available; margin-top: 4px;" class="btn btn-success">Değişiklikleri Kaydet</button>
                </div>
            </div>
            </div>
           
            <?php
        }
        ?>                
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelector("[name='addKategori']").addEventListener("click", function () {
    Swal.fire({
      title: 'Yeni Kategori Ekle',
      input: 'text', 
      inputPlaceholder: 'Kategori adını giriniz',
      showCancelButton: true,
      confirmButtonText: 'Ekle',
      cancelButtonText: 'İptal',
      inputValidator: (value) => {
        if (!value) {
          return 'Kategori adı boş olamaz!';
        }
      }
    }).then((result) => {
      if (result.isConfirmed) {
        // AJAX ile kategori ekleme
        fetch("<?= base_url('sablon/yeni_sablon_kategori_ekle') ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "sablon_kategori_adi=" + encodeURIComponent(result.value)
        })
        .then(response => {
          if (response.ok) {
            Swal.fire({
              icon: 'success',
              title: 'Eklendi!',
              text: 'Kategori başarıyla eklendi.',
              timer: 1500,
              showConfirmButton: false
            }).then(() => {
              location.reload(); // Sayfayı yenile
            });
          } else {
            Swal.fire("Hata", "Kategori eklenemedi!", "error");
          }
        });
      }
    });
  });
</script>


<script>
document.querySelectorAll('.editKategoriBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const kategoriId = this.getAttribute('data-id');
        const mevcutAd = this.getAttribute('data-ad');

        Swal.fire({
            title: 'Kategori Adını Güncelle',
            input: 'text',
            inputValue: mevcutAd,
            showCancelButton: true,
            confirmButtonText: 'Güncelle',
            cancelButtonText: 'İptal',
            inputValidator: (value) => {
                if (!value) return 'Kategori adı boş olamaz!';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("<?=base_url('sablon/sablon_kategori_guncelle/')?>"+kategoriId, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "sablon_kategori_adi=" + encodeURIComponent(result.value)
                }).then(res => {
                    if(res.ok){
                        Swal.fire({
                            icon: 'success',
                            title: 'Güncellendi',
                            text: 'Kategori adı başarıyla güncellendi.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Hata", "Kategori güncellenemedi!", "error");
                    }
                });
            }
        });
    });
});
</script>
