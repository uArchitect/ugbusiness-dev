 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ürün Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Ürün Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <div class="row">
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Ürün Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($urun)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('urun/save').'/'.$urun->urun_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('urun/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Ürün Adı</label>
        <input type="text" value="<?php echo  !empty($urun) ? $urun->urun_adi : '';?>" class="form-control" name="urun_adi" required="" placeholder="Ürün Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->urun_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Ürün Açıklama</label>
        <input type="text" value="<?php echo !empty($urun) ? $urun->urun_aciklama : '';?>" class="form-control" name="urun_aciklama" placeholder="Ürün Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->urun_aciklama ?? ''; ?></p>
      </div>
  
      <div class="form-group">
        <label for="formClient-Code"> Ürün Satış Fiyatı</label>
        <input type="text" value="<?php echo !empty($urun) ? $urun->urun_satis_fiyati : '';?>" class="form-control" name="urun_satis_fiyati" placeholder="Ürün Satış Fiyatını Giriniz..." autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Ürün Vade Farkı </label>
        <input type="text" value="<?php echo !empty($urun) ? $urun->urun_vade_farki : '';?>" class="form-control" name="urun_vade_farki" placeholder="Ürün Vade Farkını Giriniz..." autofocus="">
       </div>
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("urun")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>

<section class="col-md-8">
  <div class="card card-danger">
    <div class="card-header">
      Ürün Fiyat Listesi
    </div>
    <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 100px;">PEŞİNAT</th> 
                    <th>VADE</th>
                    <th>SENET</th>
                    <th >AYLIK TAKSİT TUTARI</th>
                    <th >TOPLAM DİP FİYAT</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($fiyat_listesi as $fiyat) : ?>

                      <tr>
                       <?php
                        if( $fiyat->vade == 20){
                          ?>
                          <td rowspan="11" style="vertical-align : middle;text-align:center;"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)." ₺"?></td>
                          <?php
                        }
                       ?>
                        
                        <td style="font-weight:bold"><?=$fiyat->vade?></td>
                        <td><?="₺ ".number_format($fiyat->senet,2)?></td>
                        <td><?="₺ ".number_format($fiyat->aylik_taksit_tutar,2)?></td>
                        <td><?="₺ ".number_format($fiyat->toplam_dip_fiyat,2)?></td> 
                    </tr>
                        
                      <?php $count++; endforeach; ?>
                  </tbody>
                   
                </table>
                </div>
  </div>
    </section>
    </div>

            </div>