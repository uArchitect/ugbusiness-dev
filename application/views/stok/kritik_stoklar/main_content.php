<style>
    .select2-container--open {
    z-index: 99999999999999;
    }
  .table th {
    background: #ffffff !important;
    color: black;
    padding: 6px;
    padding-left: 10px;
}
.text-custom-warning{
  background: #fff792;
    padding: 5px;
    width: -webkit-fill-available;
    display: block;
    color: #6b4b00 !important;
    text-align: center;
}

.text-custom-success{
  background: #008000;
    padding: 5px;
    width: -webkit-fill-available;
    display: block;
    color: #ffffff !important;
    text-align: center;
}

  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
  

<section class="content text-md">


<div class="row">

 

  
<div class="col card card-dark p-0">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Stok Kategorileri</h3>
                
              </div>
             
              <!-- /.card-header --> 
              <div class="card-body" style="border: 1px solid black;    min-height: 810px;">
             
                <table id="example1stok_tanim2" style="display: inline-table;" class="table text-sm table-bordered table-responsive table-striped"    >
                  <thead style="width: 100% !important;">
                  <tr>
                    <th style="width:24px">No</th> 
                    <th style="width:84px">Grup Kodu</th>
                    <th style="width:74px">Prefix</th>
                    <th>Stok Tanımı</th>
                    <th>Stok Açıklama</th> 
                    <th>Güncel Stok</th>
                    <th>Kritik Stok Seviyesi</th>
                  </tr>
                  </thead>
                  <tbody style="width: 100% !important;">
                   <?php foreach ($kritik_stoklar as $stok_tanim){?>
                    
                    <tr style="<?=($stok_tanim->uyari_ver == "stok_uyarisi") ? "background:red;color:white!important;" : ""?>">
                      <td>
                         <?=$stok_tanim->stok_tanim_id?> 
                      </td>
                      <td style="font-weight:500">
                         <?=$stok_tanim->stok_tanim_grup_kod?> 
                      </td>
                      <td>
                         <?=($stok_tanim->stok_tanim_prefix != "" && $stok_tanim->stok_tanim_prefix != null) ? $stok_tanim->stok_tanim_prefix :"<span style='opacity:0.5;font-weight:normal'>NoPrefix</span>"?> 
                      </td>
                      <td style="font-weight:500">
                      <a href="https://ugbusiness.com.tr/stok_tanim/index/0/<?=$stok_tanim->stok_tanim_id?>" target="_blank" style="<?=($stok_tanim->uyari_ver == "stok_uyarisi") ? "color:white!important":""?>">
                         <?=$stok_tanim->stok_tanim_ad?> 
                   </a>

                       

                      </td>
                      <td>
                         <?=($stok_tanim->stok_tanim_aciklama != "" && $stok_tanim->stok_tanim_aciklama != null) ? $stok_tanim->stok_tanim_aciklama :"<span style='opacity:".($stok_tanim->uyari_ver == "stok_uyarisi" ? "1" : "0.5").";font-weight:normal'><i class='fas fa-info-circle'></i> Açıklama Girilmedi</span>"?> 
                      </td>
                      
                      <td style="background: #ffff001f;">
                         <?=$stok_tanim->toplam_stok?> <span style="opacity:<?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "1" : "0.5")?>"><?=$stok_tanim->stok_birim_adi?></span> <i class="fas fa-check-circle <?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "text-white" : "text-warning")?>"></i>
                      </td>
                      <td style="background: #ffff001f;">
                         <?=$stok_tanim->stok_kritik_sayi?> <span style="opacity:<?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "1" : "0.5")?>"><?=$stok_tanim->stok_birim_adi?></span> <i class="fas fa-check-circle <?=($stok_tanim->uyari_ver == "stok_uyarisi" ? "text-white" : "text-warning")?>"></i>
                      </td>
                    </tr>
                  <?php  } ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
           
 
  </div>
</section> </div>