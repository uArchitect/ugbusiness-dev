<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px; 
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">

<section class="content text-md">
 <div class="m-2" style="font-size:16px!important;display:flex">
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/2")?>?k=2"   class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "2") ? "success" : (empty($_GET["k"]) ? "success" : "default")?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Muhittin Çoban</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/19")?>?k=19" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "19") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Sertaç Baybure</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/18")?>?k=18" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "18") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Önder Berkyez</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/79")?>?k=79" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "79") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Mustafa Dündar</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/5")?>?k=5"   class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "5") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Seyhan Özdemir</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/76")?>?k=76" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "76") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Tülay Özdemir</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/69")?>?k=69" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "69") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Serdar Akbıyık</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/60")?>?k=60" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "60") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Özkan Şenol</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/62")?>?k=62" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "62") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Selçuk Akdağ</a>
 <a  style="    border: 1px solid green;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/80")?>?k=80" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "80") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> Hakan Hamza</a>
 
 </div>



<div class="card col-12 card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong><?=$kullanici_ad_soyad?></strong> - Satış Temsilci Taban Fiyat Limitleri</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <span style="
    margin: auto;
    text-align: center;
    width: 100%;
    display: block;
    font-size: xx-large;
    font-weight: 700;
    margin-bottom: -40px;
"><?=$kullanici_ad_soyad?></span>


                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                 
                    <th>Ürün Adı</th>
                    <th>Nakit Limit</th>
                    <th>Takasli Nakit Limit</th>
                    <th>Vadeli Limit</th>
                    <th>Takasli Vadeli Limit</th>
                    <th>Peşinat Limit</th>
                    <th>Umex Takas Limit</th>
                    <th>Robotix Takas Limit</th>
                    <th>Diğer Takas Limit</th>
                    <th style="width: 42px;">Kontrol</th>
                    <th>İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($limitler as $limit) : ?>
                  
                    <tr>
                      <td>    <?=$limit->satis_fiyat_limit_id?> </td> 
                     
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$limit->urun_adi?>
                      </td>
                      <td style="<?=($limit->nakit_satis_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                       
                       <?=number_format($limit->nakit_satis_fiyat_alt_limit,2)?> ₺ 
                    </td>
                    <td style="<?=($limit->takasli_nakit_satis_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                       
                       <?=number_format($limit->takasli_nakit_satis_fiyat_alt_limit,2)?> ₺ 
                    </td>
                      <td style="<?=($limit->vadeli_satis_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->vadeli_satis_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td style="<?=($limit->takasli_vadeli_satis_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->takasli_vadeli_satis_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td style="<?=($limit->pesinat_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->pesinat_fiyat_alt_limit,2)?> ₺
                      </td>
                    
                      <td style="<?=($limit->umex_takas_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->umex_takas_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td style="<?=($limit->robotix_takas_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->robotix_takas_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td style="<?=($limit->diger_takas_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->diger_takas_fiyat_alt_limit,2)?> ₺
                      </td>


                      <td>
                      <label class="switch" style="margin-bottom:0;">
  <input type="checkbox" <?=$limit->limit_kontrol == 1 ? "checked" : ""?> data-id="<?=$limit->satis_fiyat_limit_id?>" onchange='handleChange(this);'>
  <span class="slider round"></span>
</label>
                      </td>
                      <td>
                          <a target="_blank" type="button" data-id="<?=$limit->satis_fiyat_limit_id?>" class="btn btn-primary btn-xs  edit-limit-btn"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                        
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

            <script>

function handleChange(checkbox) {
    if(checkbox.checked == true){ 
     
        fetch("<?=base_url("kullanici/kontrol_guncelle/")?>"+checkbox.getAttribute('data-id')+"/1");
    }else{   
      fetch("<?=base_url("kullanici/kontrol_guncelle/")?>"+checkbox.getAttribute('data-id')+"/0");
   }
}


              document.addEventListener('DOMContentLoaded', function () {




   const editButtons = document.querySelectorAll('.edit-limit-btn');
   editButtons.forEach(button => {
      button.addEventListener('click', function (e) {
         e.preventDefault();
         const limitId = this.getAttribute('data-id');
         var left = (screen.width / 2) - (600 / 2);
        var top = (screen.height / 2) - (460 / 2);
       
         const editWindow = window.open('<?=base_url("kullanici/fiyat_guncelle_view/")?>' + limitId, 'Edit Price', 'width=600,height=460,'+',top=' + top + ',left=' + left);
         
         const timer = setInterval(function () {
            if (editWindow.closed) {
               clearInterval(timer);
               location.reload();
            }
         }, 500);
      });
   });
});
              </script>