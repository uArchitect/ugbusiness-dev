 
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
<section class="content col-md-3">
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

       <div class="form-group">
        <label for="formClient-Code"> Ürün Peşinat Fiyatı </label>
        <input type="text" value="<?php echo !empty($urun) ? $urun->urun_pesinat_fiyati : '';?>" class="form-control" name="urun_pesinat_fiyati" placeholder="Ürün Peşinat Fiyatını Giriniz..." autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Peşinat Artış Aralığı (Sadece Gösterim) </label>
        <input type="text" value="<?php echo !empty($urun) ? $urun->pesinat_artis_aralik : '';?>" class="form-control" name="pesinat_artis_aralik" placeholder="Peşinat Artış Aralığını Giriniz..." autofocus="">
       </div>

       <div class="form-group">
        <label for="formClient-Code"> Artış Üst Limit (Sadece Gösterim) </label>
        <input type="text" value="<?php echo !empty($urun) ? $urun->urun_pesinat_artis_ust_fiyati : '';?>" class="form-control" name="urun_pesinat_artis_ust_fiyati" placeholder="Peşinat Üst Fiyat Giriniz..." autofocus="">
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

<section class="col-md-9">
  <div class="card card-dark">
    <div class="card-header">
      Ürün Fiyat Listesi
    </div>
    <div class="card-body p-0">
<table id="example1" style="border:2px solid red;" class="table table-bordered table-striped text-md">
                  <thead>
                  <tr>
                    <th style="width:25%;font-size:15px;padding:5px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                    <th style="width:15%;font-size:15px;padding:5px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                    <th style="width:15%;font-size:15px;padding:5px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                    <th style="width:15%;font-size:15px;padding:5px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK TAKSİT TUTARI</th>
                    <th style="width:15%;font-size:15px;padding:5px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >TOPLAM DİP FİYAT</th>
                 <th style="width:15%;font-size:15px;padding:5px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
                 <th style="width:15%;font-size:15px;padding:5px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >SATIŞ KONTROL FİYAT</th>
                 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($fiyat_listesi as $fiyat) : ?>

                      <tr>
                       <?php
                        if( $fiyat->vade == 20){
                          ?>
                          <td rowspan="11" style="border-bottom:2px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                          <?php
                        }
                       ?>
                        
                        <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:2px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                        <td style="<?=( $fiyat->vade == 1) ? "border-bottom:2px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                        <td style="<?=( $fiyat->vade == 1) ? "border-bottom:2px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                        <td style="<?=( $fiyat->vade == 1) ? "border-bottom:2px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
                <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:2px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
                 <td class="text-danger" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:2px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis_satisci,2, ',', '.')." ₺"?></td> 
                
                 
                      </tr>
                    
                      <?php $count++; endforeach; ?>
                  </tbody>
                   
                </table>
                </div>
  </div>
    </section>
    </div>

            </div>
 