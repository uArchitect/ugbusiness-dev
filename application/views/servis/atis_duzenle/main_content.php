 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Yeni Servis Kaydı Oluştur</h3>
     
     
    </div>
  
            <form class="form-horizontal" method="POST" action="<?php echo base_url("servis/update_atis_kayit/$atis->servis_atis_yukleme_id") ;?>">
    
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Atış Yükleme Sayısı</label>
        <input type="number" class="form-control" value="<?=$atis->atis_yukleme_sayisi?>" name="atis_yukleme_sayisi" required>
      </div>

      <div class="form-group">
        <label for="formClient-Name"> Atış Yükleme Tarihi</label>
        <input type="date" class="form-control" value="<?=date("Y-m-d",strtotime($atis->servis_atis_yukleme_tarihi))?>" name="servis_atis_yukleme_tarihi" required>
      </div>

    
<div class="form-group">
        <label for="formClient-Name"> Atış Kategorisi</label>
        <select name="servis_atis_kategori_no" class="form-control select2" style="margin-right: 5px;">
  <option value="2" <?=$atis->servis_atis_kategori_no == 2 ? "selected" : ""?>>SOĞUK HAVA</option>
  <option value="1" <?=$atis->servis_atis_kategori_no == 1 ? "selected" : ""?>>BUZLANAN</option>
            </select>
      </div>
       <div class="form-group">
       <button type="submit" class="btn btn-block btn-success btn-lg"><i class="fas fa-search"></i> Değişiklikleri Kaydet</button>
      </div>
       
    </div>
    <!-- /.card-body -->

    
    <!-- /.card-footer-->

    </form>

    <button type="button" class="btn btn-block btn-danger btn-lg"><i class="fas fa-search"></i> Bu atış kaydını sil</button>
  </div>
            <!-- /.card -->
</section>
            </div>