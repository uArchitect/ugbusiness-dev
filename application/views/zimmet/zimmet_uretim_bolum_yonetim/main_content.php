 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">

 <div class="row p-2">
  <a href="<?=base_url("zimmet/uretimdagitim/1")?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Üretim Dağıtım Ekranına Geri Dön</a>
</div>
 <div class="row">
  
    
<?php  $veric = 0;
foreach ($bolumler as $bolum) :
?>

<?php $veric++; ?>
  <div class="col">
    <div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong><?=$bolum->zimmet_alt_bolum_adi?></strong> </h3>
               <div class="card-tools">


                 <button class="btn btn-sm text-white deleteVeriBtn"
                            data-id="<?=$bolum->zimmet_alt_bolum_id?>">
                        <i class="fa fa-trash"></i>
                    </button>

                  <button class="btn btn-sm text-white editVeriBtn"
                            data-id="<?=$bolum->zimmet_alt_bolum_id?>"
                            data-ad="<?=$bolum->zimmet_alt_bolum_adi?>">
                        <i class="fa fa-edit"></i>
                    </button>



                    <?php 
                     if($veric == count($bolumler)){
                        ?>
                          <a type="button"  style="       margin-bottom: -3px !important;"
   class="btn btn-sm text-white " 
   id="yeniAlanEkleBtn" 
  >
   <i class="fa fa-plus"></i>  
</a>
                        <?php
                    }
                    ?>
               </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">



<ul class="products-list product-list-in-card pl-2 pr-2">

                  <?php 
                    $kullanicilar = get_uretime_tanimli_kullanicilar($bolum->zimmet_alt_bolum_id);
                    ?>
                    <?php foreach ($kullanicilar as $kullanici) : ?>

                  <li class="item">
                    <div class="product-img">

                      <?php
                          if($kullanici->kullanici_resim != ""){
                                ?>
                                   <img class="img-size-80" style="width: auto; height: 68px; margin-right: 5px;" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                                <?php
                          }else{
                            ?>
                                 <img class="img-size-50" style="width: auto; height: 68px; margin-right: 5px;" src="<?=base_url("uploads/user-default.jpg")?>"> 
                              
                            <?php
                          }
                        ?>


                      
                    </div>
                    <div class="product-info" style="margin-top:-5px">
                      <a href="javascript:void(0)" class="product-title"><?=$kullanici->kullanici_ad_soyad?>
                       
                      </a>

                        
                      <span class="product-description">
                      <?=$kullanici->kullanici_unvan?>
                      </span>

<span class="product-description mt-2">
                      <a href="<?=base_url('zimmet/uretimbolumtanimsil/'.$kullanici->zimmet_alt_bolum_kullanici_tanim_id)?>"><span class="btn btn-xs btn-danger float-left mr-1"><i class="fa fa-times"></i> Listeden Kaldır </span>
                        </a>
                        <?php 
                        if($kullanici->zimmet_alt_bolum_sorumlu_mu == 1){
                          ?>
                            <a href="<?=base_url('zimmet/uretimbolumsorumlutanimla/'.$bolum->zimmet_alt_bolum_id.'/'.$kullanici->zimmet_alt_bolum_kullanici_tanim_id)?>"> <span class="btn btn-xs btn-success float-left"><i class="fa fa-check"></i> Sorumlu</span>
                          </a>
                          <?php
                        }else{
?>
                            <a href="<?=base_url('zimmet/uretimbolumsorumlutanimla/'.$bolum->zimmet_alt_bolum_id.'/'.$kullanici->zimmet_alt_bolum_kullanici_tanim_id)?>"> <span class="btn btn-xs btn-default float-left"><i class="fa fa-user"></i> Sorumlu Seç</span>
                          </a>
                          <?php
                        }
                        ?>
                      
                      </span>

                      
                    </div>
                  </li><?php endforeach; ?>
                  <!-- /.item -->
                   
                </ul>
 
              </div>

              <div class="card-footer">
                 <form action="<?=base_url("zimmet/bolum_kullanici_tanimla/$bolum->zimmet_alt_bolum_id")?>" method="post">

            <div class="input-group input-group-sm">
                  <select  name="kullanici_no" class="select2 form-control  " style="margin-bottom:10px!important" required>

                    <option value="">Kullanıcı Seçiniz</option>

                      <?php 
                      foreach ($listkullanicilar as $s) {
                        if($s->zimmet_departman_kullanici_tanim_departman_no != $secilen_departman){
                          continue;
                        }
                       ?>
                       <option value="<?= $s->kullanici_id?>"><?=$s->kullanici_ad_soyad?></option>
                       <?php
                      }
                      ?>
                    </select>
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-success btn-flat">Ekle</button>
                  </span>
                </div>

             
                    </form>
              </div>
              <!-- /.card-body -->
            </div>
  </div>
 
<?php 
endforeach;
?>
 </div>
</section>
            </div>



            
<script>
document.querySelectorAll('.editVeriBtn').forEach(btn => {
    btn.addEventListener('click', function() {
        const veriId = this.getAttribute('data-id');
        const mevcutAd = this.getAttribute('data-ad');

        Swal.fire({
            title: 'Bölüm Adını Güncelle',
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
                fetch("<?=base_url('zimmet/uretim_bolum_adi_guncelle/')?>"+veriId, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "zimmet_alt_bolum_adi=" + encodeURIComponent(result.value)
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
     
    Swal.fire({
        title: 'Yeni Üretim Bölümü Ekle',
        input: 'text',
        inputLabel: ' ',
        inputPlaceholder: 'Bölüm adını giriniz...',
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
            form.action = `<?= base_url('zimmet/uretim_bolum_ekle') ?>`;

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'zimmet_alt_bolum_adi';
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
            text: "Bu bölüm kalıcı olarak silinecek!",
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
                form.action = `<?=base_url('zimmet/uretim_bolum_sil/')?>${veriId}`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>