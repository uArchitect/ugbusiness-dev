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
  border:1px solid #767676;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
<style>
  .btn-success{
    border:0px solid!important;
  }
  </style>
<section class="content text-md">
 <div class="m-2" style="font-size:16px!important;display:flex">
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/2")?>?k=2"   class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "2") ? "success" : (empty($_GET["k"]) ? "success" : "default")?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Muhittin Çoban</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/19")?>?k=19" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "19") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Sertaç Baybure</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/18")?>?k=18" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "18") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Önder Berkyez</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/79")?>?k=79" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "79") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Mustafa Dündar</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/5")?>?k=5"   class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "5") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Seyhan Özdemir</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/76")?>?k=76" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "76") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Tülay Özdemir</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/69")?>?k=69" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "69") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Serdar Akbıyık</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/60")?>?k=60" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "60") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Özkan Şenol</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/62")?>?k=62" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "62") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Selçuk Akdağ</a>
 <a  style="    border: 2px dotted #c4c4c4;flex:1;font-weight:500;font-size:16px!important" href="<?=base_url("fiyat_limit/index/80")?>?k=80" class="mr-1 btn btn-<?=(!empty($_GET["k"]) && $_GET["k"] == "80") ? "success" : "default"?>"><img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"><br> Hakan Hamza</a>
 
 </div>



<div class="card-dark col-12" style="border-radius:0px !important;">
              <div class="card-header" style="text-align:center;display: flex;">
              <h3 class="card-title text-center" style="margin:auto;text-align:center;" >
              <span style="text-align:center;
    margin: auto;
    text-align: center;
    width: 100%;
    display: block;  
    font-size: xx-large;
    font-weight: 700; 
"><?=$kullanici_ad_soyad?></span></h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body" style="background:white;">

            


                <table id="example1limitler" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                  
                 
                    <th>Ürün Adı</th>
                    <th>Nakit Takassız<br>Satış</th>
                    <th>Vadeli Takassız<br>Satış</th>
                    <th>Umex Takaslı<br>Vadeli Satış</th>
                    <th>Umex Takaslı<br>Nakit Satış</th>
                    <th>Robotx Takaslı<br>Vadeli Satış</th>
                    <th>Robotx Takaslı<br>Nakit Satış</th>
                    <th>Diğer Takaslı<br>Vadeli Satış</th>
                    <th>Diğer Takaslı<br>Nakit Satış</th>
                    <th>Vadeli<br>Peşinat</th>
             
                   
                    
                    <th style="width: 42px;">Kontrol</th>
                    <th>İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($limitler as $limit) : ?>
                  
                    <tr style="height: 65px;">
                     
                      <td style="  border: 1px solid #000045;border-bottom:0px;color:white;  background: #02469e;text-align: center;padding-top: 20px !important;">
                       
                        <?=$limit->urun_adi?>
                      </td>

                      <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->nakit_takassiz_satis_fiyat<=0)?" border-color: #ff9696;background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->nakit_takassiz_satis_fiyat,2)?> ₺ 
                    </td>

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->vadeli_takassiz_satis_fiyat<=0)?"    border-color: #ff9696;background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->vadeli_takassiz_satis_fiyat,2)?> ₺ 
                    </td>

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->vadeli_pesinat_fiyat <=0)?"    border-color: #ff9696;background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->vadeli_pesinat_fiyat,2)?> ₺ 
                    </td>

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->nakit_umex_takas_fiyat <=0)?"    border-color: #ff9696;background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->nakit_umex_takas_fiyat,2)?> ₺ 
                    </td>

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->vadeli_umex_takas_fiyat <=0)?"   border-color: #ff9696; background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->vadeli_umex_takas_fiyat,2)?> ₺ 
                    </td>

                

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->nakit_robotix_takas_fiyat <=0)?"    border-color: #ff9696;background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->nakit_robotix_takas_fiyat,2)?> ₺ 
                    </td>

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->vadeli_robotix_takas_fiyat <=0)?"    border-color: #ff9696;background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->vadeli_robotix_takas_fiyat,2)?> ₺ 
                    </td>

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;<?=($limit->nakit_diger_takas_fiyat <=0)?"   border-color: #ff9696; background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->nakit_diger_takas_fiyat,2)?> ₺ 
                    </td>

                    <td style="text-align: center;padding-top: 20px !important;border-bottom:0px;border-right:0px;<?=($limit->vadeli_diger_takas_fiyat <=0)?"   border-color: #ff9696; background:#ffe2e28a;color: #c10404;":"background:#65e16538;border-color:green;"?>">
                       <?=number_format($limit->vadeli_diger_takas_fiyat,2)?> ₺ 
                    </td>

                   
                      <td style="border: 1px solid #777777;border-bottom:0px;background:#dadada;text-align: center;padding-top: 20px !important;">
                      <label class="switch" style="margin-bottom:0;">
  <input type="checkbox" <?=$limit->limit_kontrol == 1 ? "checked" : ""?> data-id="<?=$limit->satis_fiyat_limit_id?>" onchange='handleChange(this);'>
  <span class="slider round"></span>
</label>
                      </td>
                      <td style="text-align: center;padding-top: 20px !important;">
                          <a target="_blank" type="button" data-id="<?=$limit->satis_fiyat_limit_id?>" class="btn btn-warning btn-xs  edit-limit-btn"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                        
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
         var left = (screen.width / 2) - (890 / 2);
        var top = (screen.height / 2) - (800 / 2 + 50);
       
         const editWindow = window.open('<?=base_url("kullanici/fiyat_guncelle_view/")?>' + limitId, 'Edit Price', 'width=890,height=850,'+',top=' + top + ',left=' + left);
         
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