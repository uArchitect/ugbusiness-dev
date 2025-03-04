<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md" style="    margin-top: -5px;">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header" style="background:#00264f!important">
              <h3 class="card-title"><strong>UG Business</strong> - Müşteri Bilgileri</h3>
                <a href="<?=base_url("musteri/ekle")?>" onclick="waiting('Yeni Müşteri Ekle');" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="    min-height: 790px !important;">
              <table id="example1yonlendirilentablo"   class="table table-bordered table-striped nowrap" style="width:100%;">
        <thead>
            <tr>
                 <th>Cihaz</th>
                <th>Müşteri Adı</th>
                <th>Merkez Bilgisi</th> 
                <th>Adres</th>
                <th>İletişim Numarası</th> 
              
                
            </tr>
        </thead>
        <tbody>
     <?php 
     foreach ($data as $musteri) {
       ?>
       <tr>
        <td><?=$musteri->urun_adi?></td>
        <td><?=$musteri->musteri_ad?></td>
        <td><?=$musteri->merkez_adi?></td>
        <td><?=$musteri->merkez_adresi?></td>
        <td><?=$musteri->musteri_iletisim_numarasi?></td>
     </tr>
       <?php
     }
     ?>
    </tbody>
    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>















            </div>


