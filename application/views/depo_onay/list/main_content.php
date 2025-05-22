 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Depo Malzeme Çıkış Talepleri</h3>
                <a href="<?=base_url("depo_onay/talep_olustur")?>" type="button" class="btn btn-primary " style="float: right!important;padding: 5px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Talep Oluştur</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Talep Oluşturan</th>
                    
                    <th>Talep Tarihi</th>
                        <th>Ön Onay</th>
                    <th>Depo Çıkış Onayı</th>
                    <th>Teslim Alındı Onayı</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php   foreach ($talepler as $d) : ?>
                   
                    <tr>
                      <td><?=$d->stok_onay_id ?></td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                        <?=$d->kayit_kullanici_ad_soyad?> <br>
                       <span class="text-success"><b><?=$d->teslim_kullanici_ad_soyad?></b>  Teslim Alacak </span><br>
 <button class="btn btn-dark goster" data-id="<?=$d->stok_onay_id?>"  >
 <i class="fa fa-eye"></i> 
  Ürünleri Göster</button>
                    </td>
                      
                      <td>
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=date("d.m.Y H:i",strtotime($d->talep_olusturulma_tarihi))?>
                      </td>






                      <td>
                        <?php 
                        if($d->kayit_durum == 0){
                          echo "<span class='text-danger'>İPTAL EDİLDİ</span>";
                        }else{
                           if($d->on_onay_durumu == 0){
                          ?>
                             <a onclick="confirm_action('Aktifleştirme İşlemini Onayla','Seçilen bu talebe ön onay vermek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/on_onay/').$d->stok_onay_id ?>');"    class="btn btn-warning">Onayla</a>
                          <?php
                        }else{
                          ?>
                          <a class="btn btn-success"><i class="fa fa-check"></i>Ön Onay Verildi</a>
                          <?php
                        }
                        }
                       
                        ?>
                      </td>



                      <td>
                        <?php 
                        if($d->kayit_durum == 0){
                          echo "<span class='text-danger'>İPTAL EDİLDİ</span>";
                        }else{

                          if($d->on_onay_durumu == 0){
                                ?>
                                <span class="text-danger">Ön Onay Bekleniyor.</span>
                                <?php
                               }else{

                           if($d->birinci_onay_durumu == 0){
                          ?>
                             <a href="<?=base_url('depo_onay/update/').$d->stok_onay_id ?>"    class="btn btn-warning">Onayla</a>
                          <?php
                        }else{
                          ?>
                          <a href="<?=base_url('depo_onay/birinci_onay_iptal/').$d->stok_onay_id ?>" class="btn btn-success"><i class="fa fa-check"></i> Onay Verildi</a>
                          <?php
                        }
                      }
                        }
                       
                        ?>
                      </td>
                     

                      <td style="display: flex;">
                        <?php 

if($d->kayit_durum == 0){
  echo "<span class='text-danger'>İPTAL EDİLDİ</span>";
}else{
    if($d->birinci_onay_durumu == 0){
                                ?>
                                <span class="text-danger">Çıkış Onayı Bekleniyor.</span>
                                <?php
                               }else{
                                if($d->teslim_alma_onayi == 0){
                                  ?>
                                  <a onclick="confirm_action('Aktifleştirme İşlemini Onayla','Seçilen bu talebe (teslim aldım) onayı vermek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/teslim_onay/').$d->stok_onay_id ?>');"    class="btn btn-warning">Onayla</a>
                                  <?php
                                }else{
                                  ?>
                                  <a class="btn btn-success"><i class="fa fa-check"></i> Teslim Alındı</a>
                                  <?php
                                }
                               }
}

                             
                        
                        ?>
                      </td>

                      <td>
                      <?php 
                      
                      if($d->kayit_durum == 0){
                       
                        ?>
                          <a type="button" onclick="confirm_action('Aktifleştirme İşlemini Onayla','Seçilen bu talebi aktif etmek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/aktif/').$d->stok_onay_id ?>');" class="btn btn-dark btn-xs"><i class="fa fa-eye" style="font-size:12px" aria-hidden="true"></i> Tekrar Aktifleştir</a>
                        <?php
                      }else{
                        ?>
                          <a type="button" onclick="confirm_action('İptal İşlemini Onayla','Seçilen bu talebi iptal etmek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/sil/').$d->stok_onay_id ?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> İptal Et</a>
                        <?php
                      }
                      ?>
                          
                        
                        
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
  .swal2-popup{
    width:auto;!important;
  }
  </style>





<script src="<?=base_url("assets/")?>plugins/jquery/jquery.min.js"></script>
            
<script>
$(document).ready(function(){
    $('.goster').on('click', function(){
        var numara = $(this).data('id');

        $.ajax({
            url: '<?= base_url("depo_onay/get_detaylar") ?>',
            method: 'POST',
            data: { numara: numara },
            dataType: 'json',
            success: function(response){
    if(response.status === 'success'){
        let html = `<div style="display: flex; flex-direction: column; gap: 20px;">`;

        response.data.forEach(function(item){
            html += `
            <div style="
                background: linear-gradient(90deg, #f1f3f5, #ffffff);
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.05);
                padding: 20px;
                width: 100%;
                font-family: 'Segoe UI', sans-serif;
                border-left: 5px solid #007bff;
            ">
                <div style="font-size: 18px; font-weight: bold; color:#343a40; margin-bottom:10px;">
                    ${item.stok_tanim_ad} → ${item.stok_talep_edilen_malzeme_miktar} Adet
                </div>
                
            </div>`;
        });

        html += `</div>`;

        Swal.fire({
            title: 'Malzeme Detayları',
            html: html,
            width: 'auto',
            confirmButtonText: 'Kapat',
            customClass: {
                popup: 'scrollable-popup'
            }
        });
    } else {
        Swal.fire('Hata', 'Veri bulunamadı.', 'error');
    }
}


        });
    });
});
</script>