 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Depo Malzeme Çıkış Talep Formu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Depo Malzeme Çıkış Talep Formu</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-6">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Talep Detayları</h3>
     
     
    </div>
  
   
            <form class="form-horizontal" method="POST" action="<?php echo site_url('depo_onay/talep_guncelle_save').'/'.$talepid;?>">
   
    <div class="card-body">


    <div class="row">
      <div class="col">

      <div class="form-group" >
        <label for="formClient-Name"> Talep Oluşturan Kullanıcı</label>
        <select disabled   required id="formDepartman12" class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Kişi Seçimi Yapınız</option>
                        
                          <?php foreach($kullanicilar as $kul2) : ?> 
                                      <option <?=$kul2->kullanici_id==$kayitolusturanid ? "selected" : ""?> value="<?=$kul2->kullanici_id?>"><?=$kul2->kullanici_ad_soyad?></option>
                        
                            <?php endforeach; ?>  
                       </select>
      </div>


      </div>
      <div class="col">


      <div class="form-group" >
        <label for="formClient-Name" class="text-danger"> Teslim Alacak Kişi</label>
        <select disabled name="teslim_alacak_kullanici_no" required id="formDepartman1" class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Kişi Seçimi Yapınız</option>
                        
                          <?php foreach($kullanicilar as $kul) : ?> 
                                      <option <?=$kul->kullanici_id==$teslimalacakid ? "selected" : ""?> value="<?=$kul->kullanici_id?>"><?=$kul->kullanici_ad_soyad?></option>
                        
                            <?php endforeach; ?>  
                       </select>
      </div>


      </div>
    </div>

     
    


      
      <div id="malzeme-container">
        <?php 
        foreach ($veriler as $veri) :
        ?>
        <div class="malzeme-row row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Talep Edilen Malzeme</label>
              <select name="stok_kayit_no[]" required class="select2 form-control rounded-0" style="width: 100%;">
                <option value="">Malzeme Seçimi Yapınız</option>
                <?php foreach($stok_tanimlari as $malzeme): ?> 
                  <option <?=$veri->stok_talep_edilen_malzeme_stok_no==$malzeme->stok_tanim_id ? "selected" : ""?> value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
                <?php endforeach; ?>  
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Talep Edilen Miktar</label>
              <input type="number" value="<?=$veri->stok_talep_edilen_malzeme_miktar?>" required class="form-control" min="1" name="talep_miktar[]">
            </div>
          </div>
        </div>
         <?php 
        endforeach;
        ?>
      </div>

      <button type="button"  id="as" class="btn btn-success d-block p-2" style=" border: 2px dotted #6cbd6b;   color: #126503;background: #dfffde;width:100%"  ><i class="fa fa-plus-circle"></i> Yeni Malzeme Ekle  </button>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("depo_onay")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-success"> Kaydet & Depo Çıkış Onayı Ver</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const malzemeOptions = `<?php foreach($stok_tanimlari as $malzeme): ?> 
    <option value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
  <?php endforeach; ?>`;

  document.getElementById('as').addEventListener('click', function(e) {
    e.preventDefault();

    const container = document.getElementById('malzeme-container');

    const newRow = document.createElement('div');
    newRow.classList.add('malzeme-row', 'row', 'align-items-end');
    newRow.innerHTML = `
      <div class="col-md-8">
        <div class="form-group">
          <label>Talep Edilen Malzeme</label>
          <select name="stok_kayit_no[]" required class="select2 form-control rounded-0" style="width: 100%;">
            <option value="">Malzeme Seçimi Yapınız</option>
            ${malzemeOptions}
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Talep Edilen Miktar</label>
          <input type="number" required class="form-control" min="1" name="talep_miktar[]">
        </div>
      </div>
      <div class="col-md-1 text-right">
        <button type="button" style="margin:22px" class="btn btn-danger btn-sm remove-row" title="Satırı Sil">×</button>
      </div>
    `;

    container.appendChild(newRow);
    $(newRow).find('select').select2();

    // Silme butonu olayını ata
    newRow.querySelector('.remove-row').addEventListener('click', function () {
      newRow.remove();
    });
  });

  // Sayfa ilk yüklendiğinde var olan select2'leri başlat
  $('.select2').select2();
});
</script>

