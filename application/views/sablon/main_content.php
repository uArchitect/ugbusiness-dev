<div class="content-wrapper pt-2">
    <div class="row mb-2">
        <div class="col">
            <div class="btn-group" style="    gap: 5px;">
            <?php foreach ($sablonlar as $sablon) : ?>
                <?php 
                    if($sablon->ust_kategori != 0){
                        continue;
                    }
                    ?>
    




    <div class="btn-group">
                    <button type="button" style="     font-weight:500;    font-size: 11px !important;   width: 200px;" data-toggle="dropdown" class="btn <?=($secilen_kategori->sablon_kategori_id == $sablon->sablon_kategori_id || $secilen_kategori->ust_kategori == $sablon->sablon_kategori_id) ? "btn-success" : "btn-default"?> btn-flat"><?=$sablon->sablon_kategori_adi?></button>

                   





                  
                    
                    <div class="dropdown-menu" style="        width: 201px;
    padding: 5px;" role="menu">
                    <?php 
                    $flag = 0;
                    foreach ($sablonlar as $altsablon) : ?>
                        <?php
                             if($sablon->sablon_kategori_id  != $altsablon->ust_kategori){
                                continue;
                            }
                            $flag = 1;
                            ?>



<div class="btn-group">
                    <a style="   width: 111px;" href="<?=base_url("sablon/index/$altsablon->sablon_kategori_id")?>" type="button" class="btn btn-default"><?=$altsablon->sablon_kategori_adi?></a>
                    
                    <button type="button" class="btn btn-default editKategoriBtn" aria-expanded="false"  data-id="<?=$altsablon->sablon_kategori_id?>"          data-ad="<?=$altsablon->sablon_kategori_adi?>">
                    <i class="fas fa-pen"></i>
                    </button>

                    <button type="button" class="btn btn-default deleteKategoriBtn" data-id="<?=$altsablon->sablon_kategori_id?>"  aria-expanded="false">
                    <i class="fa fa-trash"></i>
                    </button>

                    
                  </div>



 

                      <?php endforeach; 
                      
                       
                      ?>
                    

                   
                     



                    <div class="btn-group mt-2">
                    <button type="button"  class="btn btn-default addKategori2" style="    width: 111px;color: green;" aria-expanded="false"   data-bid="<?=$sablon->sablon_kategori_id?>"  >
                    <i class="fas fa-plus" style="    font-size: 10px; "></i>
                    </button>
                    <button type="button" style="width: 40px;"  class="btn btn-default editKategoriBtn" aria-expanded="false"  data-id="<?=$sablon->sablon_kategori_id?>"          data-ad="<?=$sablon->sablon_kategori_adi?>">
                    <i class="fas fa-pen" style="    font-size: 10px; "></i>
                    </button>

                    <button type="button"  style="width: 38px;"   class="btn btn-default deleteKategoriBtn" data-id="<?=$sablon->sablon_kategori_id?>"  aria-expanded="false">
                    <i class="fa fa-trash" style="    font-size: 10px; "></i>
                    </button>
                      </div>
                       
                  
                    </div>
                  </div>
   
<?php endforeach; ?>

                <button type="button" class="btn btn-default text-success " style="margin-top:5px" data-bid="0" name="addKategori">
                    
                <i class="fa fa-plus"></i>
            
            </button> 
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        <a type="button"  style="    width: 201px;"
   class="btn btn-primary mb-2" 
   id="yeniAlanEkleBtn" 
   data-kategori-id="<?=$secilen_kategori->sablon_kategori_id?>">
   <i class="fa fa-plus"></i> <b><?=$secilen_kategori->sablon_kategori_adi?></b> İçin Yeni Alan Ekle
</a>

        </div>
    </div>


    <div class="row gap-2">
    <?php foreach ($veriler as $veri): ?>
    <div class="col-md-6">
        <div class="card card-dark">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title" style="width: -webkit-fill-available;">
                    <span class="veri-adi"><?=$veri->sablon_veri_adi?></span>
                </div>
                <div class="card-tools" style="display: flex;">
                    <button class="btn btn-sm text-white editVeriBtn"
                            data-id="<?=$veri->sablon_veri_id?>"
                            data-ad="<?=$veri->sablon_veri_adi?>">
                        <i class="fa fa-edit"></i>
                    </button>

                    <button class="btn btn-sm text-white deleteVeriBtn"
                            data-id="<?=$veri->sablon_veri_id?>">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="<?=base_url("sablon/sablon_veri_detay_guncelle/$veri->sablon_veri_id")?>" method="post">
                    
                 <button style="width: -webkit-fill-available;
    margin-bottom: 10px;" class="toolbar-toggle btn btn-sm btn-default" type="button" onclick="toggleToolbar(this)" >Toolbar Göster</button>
   
                <textarea name="sablon_veri_detay"
                              style="height:270px" 
                              class="summernotees form-control"
                              data-id="<?=$veri->sablon_veri_id?>"
                    ><?=$veri->sablon_veri_detay?></textarea>

                    <button type="submit"
                            class="btn btn-success kaydet-btn"
                            data-id="<?=$veri->sablon_veri_id?>"
                            style="width: 100%; margin-top: 4px;  display:none;">
                        Değişiklikleri Kaydet
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function toggleToolbar(button) {
    const form = button.closest('form');
    const toolbar = form.querySelector('.note-toolbar');

    if (toolbar) {
      const currentlyVisible = toolbar.style.display === 'block';

      toolbar.style.display = currentlyVisible ? 'none' : 'block';
      button.textContent = currentlyVisible ? 'Toolbar Göster' : 'Toolbar Gizle';
    }
  }
</script>


<style>
    .note-toolbar {
  display: none;  
}
</style>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".editKategoriBtn").forEach(function(btn) {
            btn.addEventListener("click", function(event) {
                event.stopPropagation();  // Tıklamanın üst elemente gitmesini engeller
                event.preventDefault();  // <a> linkine gitmeyi engeller

                const id = this.dataset.id;
                const ad = this.dataset.ad;
                
                // Burada kendi edit işlemini başlat
                console.log("Edit tıklandı", id, ad);
            });
        });
    });

 
</script>
<script>
  
  document.querySelectorAll(".addKategori2").forEach(function(btn) {
            btn.addEventListener("click", function(event) { 


                
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
        fetch("<?= base_url('sablon/yeni_sablon_kategori_ekle') ?>/"+ this.getAttribute('data-bid'), {
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
        });


</script>

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
        fetch("<?= base_url('sablon/yeni_sablon_kategori_ekle') ?>/"+ this.getAttribute('data-bid'), {
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


<script>
document.querySelectorAll('.editVeriBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const veriId = this.getAttribute('data-id');
        const mevcutAd = this.getAttribute('data-ad');

        Swal.fire({
            title: 'Şablon Adını Güncelle',
            input: 'text',
            inputValue: mevcutAd,
            showCancelButton: true,
            confirmButtonText: 'Güncelle',
            cancelButtonText: 'İptal',
            inputValidator: (value) => {
                if (!value) return 'Ad boş bırakılamaz';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("<?=base_url('sablon/sablon_veri_guncelle/')?>"+veriId, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "sablon_veri_adi=" + encodeURIComponent(result.value)
                }).then(res => {
                    if(res.ok){
                        Swal.fire({
                            icon: 'success',
                            title: 'Güncellendi',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Hata", "Güncelleme başarısız!", "error");
                    }
                });
            }
        });
    });
});
</script>


<script>
document.getElementById("yeniAlanEkleBtn").addEventListener("click", function () {
    const kategoriId = this.getAttribute("data-kategori-id");

    Swal.fire({
        title: 'Yeni Alan Ekle',
        input: 'text',
        inputLabel: 'Alan adı girin:',
        inputPlaceholder: 'örneğin: Adı, Soyadı...',
        showCancelButton: true,
        confirmButtonText: 'Ekle',
        cancelButtonText: 'İptal',
        inputValidator: (value) => {
            if (!value) {
                return 'Alan adı boş bırakılamaz!';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Formu programlı olarak oluştur ve gönder
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `<?= base_url('sablon/sablon_veri_ekle/') ?>${kategoriId}`;

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'sablon_veri_adi';
            input.value = result.value;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
});
</script>



<script>
document.querySelectorAll('.deleteVeriBtn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault(); // Butonun varsayılan davranışını engelle

        const veriId = this.getAttribute('data-id');

        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu alan kalıcı olarak silinecek!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Evet, sil',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Form oluşturup gönder
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `<?=base_url('sablon/sablon_veri_sil/')?>${veriId}`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>



<script>
document.querySelectorAll('.deleteKategoriBtn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        const kategoriId = this.getAttribute('data-id');

        Swal.fire({
            title: 'Kategori silinsin mi?',
            text: "Bu kategori ve içindeki tüm alanlar silinecek.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Evet, sil',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `<?=base_url('sablon/sablon_kategori_sil/')?>${kategoriId}`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script> 

<script>
document.addEventListener("DOMContentLoaded", function () {
    $('.summernotees').each(function () {
        const textarea = $(this);
        const veriId = textarea.data("id");

        textarea.summernote({
            height: 270,
            callbacks: {
                onChange: function(contents, $editable) {
                    const button = $(`.kaydet-btn[data-id="${veriId}"]`);
                    button.show(); // Kaydet butonunu göster
                }
            }
        });
    });
});
</script>


