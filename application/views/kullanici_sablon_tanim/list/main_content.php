 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
 <div class="row">
 <div class="col col-md-3">
  
 <div class="card card-warning" style="border-radius:0px !important;">
              <div class="card-header" style="display: flex
;"><button id="" class="btn btn-danger" onclick=" window.history.back();" style="
    margin: -9px;
    margin-right: 10px;
    margin-left: -17px;
"><i class="fa fa-arrow-left"></i>  
              Geri</button>
              <h3 class="card-title"><strong> <?=$veri->sablon_veri_adi?></strong> (<?=$kategori->sablon_kategori_adi?>)</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                          <?=$veri->sablon_veri_detay?>
              </div>
              <!-- /.card-body -->
            </div>
</div>
  <div class="col col-md-5">
    <div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>Kullanıcı Ataması Yap</strong> </h3>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           <table id="examplekullanicilar3" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Ad Soyad</th>
      <th>İşlem</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($kullanicilar as $kullanici) : ?>

      <?php 
          $flag = false;
        foreach ($tanimlar as $t) {
          if($t->kullanici_id == $kullanici->kullanici_id){
            $flag = true;
            break;
          }
        }
        if($flag == true){
          continue;
        }
        
        ?>
      <tr data-id="<?=$kullanici->kullanici_id?>">
        <td>
          <?php if($kullanici->kullanici_resim != ""): ?>
            <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>">
          <?php else: ?>
            <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>">
          <?php endif; ?>
          <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=$kullanici->kullanici_ad_soyad?></a></b> - <?=$kullanici->kullanici_unvan?>
        </td>
        <td>
          <button class="btn btn-sm btn-success listeye-ekle-btn"><i class="fa fa-plus"></i> Listeye Ekle</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Kaydet Butonu -->
<button id="secili-kullanicilari-kaydet" class="btn btn-primary mt-3"><i class="fa fa-save"></i> Seçilen Kullanıcıları Listeye Ekle</button>

<script>
  let secilenKullanicilar = [];

document.querySelectorAll('.listeye-ekle-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    const row = this.closest('tr');
    const kullaniciId = row.getAttribute('data-id');

    const index = secilenKullanicilar.indexOf(kullaniciId);

    if (index === -1) {
      // Seçili değilse: ekle ve yeşil yap
      secilenKullanicilar.push(kullaniciId);
      row.classList.add('table-success');
    } else {
      // Zaten seçilmişse: kaldır ve rengi geri al
      secilenKullanicilar.splice(index, 1);
      row.classList.remove('table-success');
    }
  });
});


  document.getElementById('secili-kullanicilari-kaydet').addEventListener('click', function () {
    if (secilenKullanicilar.length === 0) {
      alert("Lütfen en az bir kullanıcı seçin.");
      return;
    }

    // Ajax ile gönderim
    fetch("<?=site_url('kullanici_sablon_tanim/toplu_ekle')?>", {
      method: "POST",
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '<?= $this->security->get_csrf_hash() ?>'
      },
      body: JSON.stringify({
        kullanici_ids: secilenKullanicilar,
        sablon_veri_id: <?=$veri->sablon_veri_id?>
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert("Seçilen kullanıcılar başarıyla eklendi.");
        location.reload();
      } else {
        alert("Bir hata oluştu.");
      }
    })
    .catch(err => {
      console.error(err);
      alert("Sunucu hatası.");
    });
  });
</script>

              </div>
              <!-- /.card-body -->
            </div>
  </div>

  <div class="col col-md-4">



    <div class="card card-success" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>Kuralı Görüntüleyecek Kullanıcılar</strong> </h3>
                 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="examplekullanicilar2" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
               
                  <th>Ad Soyad</th>   <th>İşlem</th>  
                   </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($tanimlar as $kullanici) : ?>
                      <?php $count++?>
                    <tr>
                  
                      <td>
                        <?php
                          if($kullanici->kullanici_resim != ""){
                                ?>
                                   <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                                <?php
                          }else{
                            ?>
                                 <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> 
                              
                            <?php
                          }
                        ?>
                      
                      
                      
                      <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=$kullanici->kullanici_ad_soyad?></a></b> - <?=$kullanici->kullanici_unvan?> 
                    </td>
                     
                       
                    <td>
                      <?php 
                      $kurl = base_url("kullanici_sablon_tanim/cikar_tanim/$kullanici->kullanici_sablon_tanim_id/$veri->sablon_veri_id");
                      ?>
                        <a onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kullanıcıyı listeden çıkarmak istediğinize emin misiniz ?','Onayla','<?=$kurl?>');"   class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Kaldır</a>
                        </td>
                    
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
  </div>
 </div>
</section>
            </div>