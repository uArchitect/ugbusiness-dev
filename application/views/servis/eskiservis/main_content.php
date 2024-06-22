 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 


<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title">ESKİ SERVİSLER</h3>
                <a href="<?=base_url("servis/servis_cihaz_sorgula_view")?>" type="button" class="btn btn-success btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Servis Kaydı Oluştur</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1servisler" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="max-width: 100px; width: 100px; min-width: 100px;">Eski Servis Id</th>
                    <th>Eski Servis Merkez Adı</th>
                    <th>Eski Seri No</th>
                    <th>Ürün</th>
                    <th>Güncel Merkez Adı</th>
                    <th>Güncel Müşteri Adı</th>
                    <th>Güncel İletişim Numarası</th>
                    <th>GÜNCEL CİHAZ</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                    <?php  foreach ($servisler as $servis) : ?>
                      <?php  if(($servis->ekleme_durum == 1 )){
                        continue;
                      } ?>
                      
                    <tr <?=($servis->ekleme_durum == 1)?"style='background:green!important;color:white!important;'":""?>>
               
                      <td><?=$servis->eski_servis_id?></td>
                      <td>
                    MÜŞTERİ</a> 
                        
                        <a href="<?=base_url("servis/servis_cihaz_sorgula/".$servis->siparis_urun_id."/".$servis->eski_servis_id)?>">Git</a> 
                        
                        
                        
                        
                        <?=$servis->eski_servis_merkez_adi?></td>
                      <td><?=$servis->eski_servis_seri_numarasi?></td>
                      <td><?=$servis->eski_servis_urun_adi?></td>
                     
                     
                      <td>  <a href="<?=base_url("servis/eski_servis_musteri_cihaz_tanimla/".$servis->eski_servis_id)?>">TANIMLA</a><?=$servis->merkez_adi?></td>
                      <td><?=$servis->musteri_ad?></td>
                      <td><?=$servis->musteri_iletisim_numarasi?></td>
                      <td>


                    <a class="<?=$servis->musteri_iletisim_numarasi == "00" ? "d-none":""?>" href="<?=base_url("servis/servis_cihaz_tanimla_eski/".$servis->eski_servis_id."/".$servis->merkez_id)?>">CİHAZ TANIMLA</a>
  
                      <?=$servis->siparis_kodu?>
                    
                    
                    
                    
              
                    
                    
                    </td>
                   
                     
                     
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>

            <style>
              .table th {
    background: #ffffff !important;
    color: #0a0a0a!important;
    padding: 10px!important;
    padding-left: 10px !important;
}

.yanipsonenyazi {
      animation: blinker 1.3s linear infinite;
      color: #1c87c9;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }

      .custom-href:hover {
        text-decoration: underline;
      }

              </style>