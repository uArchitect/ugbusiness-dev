 
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
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Talep Detayları</h3>
     
     
    </div>
  
   
            <form class="form-horizontal" method="POST" action="<?php echo site_url('depo_onay/talep_olustur_save').'/'.$this->session->userdata('aktif_kullanici_id');?>">
   
    <div class="card-body">

    

    <div class="form-group">
        <label for="formClient-Name"> Teslim Alacak Kişi</label>
        <select name="teslim_alacak_kullanici_no" required id="formDepartman1" class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Kişi Seçimi Yapınız</option>
                        
                          <?php foreach($kullanicilar as $kul) : ?> 
                                      <option  value="<?=$kul->kullanici_id?>"><?=$kul->kullanici_ad_soyad?></option>
                        
                            <?php endforeach; ?>  
                       </select>
      </div>

      <div class="row">
      <div class="col-md-4">

      <div class="form-group">
        <label for="formClient-Name"> Talep Edilen Malzeme</label>
        <select name="stok_kayit_no" required id="formDepartman" class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Malzeme Seçimi Yapınız</option>             
        <?php foreach($stok_tanimlari as $malzeme) : ?> 
                                      <option  value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
                        
                            <?php endforeach; ?>  
                       </select>
      </div>
</div>
     <div class="col-md-8">
      <div class="form-group">
        <label for="formClient-Code"> Talep Edilen Miktar</label>
        <input type="number" required class="form-control" min="1" name="talep_miktar">
        
      </div>
  
      </div>

      </div>

      <a class="btn btn-success d-block p-2" style=" border: 2px dotted #6cbd6b;   color: #126503;background: #dfffde;width:100%" onclick="addNewInput('Umex S','2477')"><i class="fa fa-plus-circle"></i> Yeni Kişi Ekle (Umex S Eğitimi)</a>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("depo_onay")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>