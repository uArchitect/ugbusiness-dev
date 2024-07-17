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
  background-color: #2196F3;
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
<div class="card col-8 card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Satış Temsilci Taban Fiyat Limitleri</h3>
                <a href="<?=base_url("baslik/baslik_havuz_tanimla_view")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Kullanıcı Ad Soyad</th>
                    <th>Ürün Adı</th>
                    <th>Satış Fiyatı Alt Limit</th>
                    <th>Kapora Fiyatı Alt Limit</th>
                    <th>Peşinat Fiyatı Alt Limit</th>
                    <th style="width: 42px;">Kontrol</th>
                    <th>İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($limitler as $limit) : ?>
                  
                    <tr>
                      <td>    <?=$limit->satis_fiyat_limit_id?> </td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$limit->kullanici_ad_soyad?> 
                    </td>
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$limit->urun_adi?>
                      </td>
                      <td style="<?=($limit->satis_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                       
                       <?=number_format($limit->satis_fiyat_alt_limit,2)?> ₺ 
                    </td>
                      <td style="<?=($limit->kapora_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->kapora_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td style="<?=($limit->pesinat_fiyat_alt_limit<=0)?"    border: 1px solid #ff9696; border-left:0px;border-bottom:0px;background:#ffe2e2;color: #c10404;":""?>">
                        <?=number_format($limit->pesinat_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td>
                      <label class="switch" style="margin-bottom:0;">
  <input type="checkbox" <?=$limit->limit_kontrol == 1 ? "checked" : ""?> data-id="<?=$limit->satis_fiyat_limit_id?>" onchange='handleChange(this);'>
  <span class="slider round"></span>
</label>
                      </td>
                      <td>
                          <a target="_blank" type="button" data-id="<?=$limit->satis_fiyat_limit_id?>" class="btn btn-primary btn-xs  edit-limit-btn"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Limitleri Düzenle</a>
                        
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
        var top = (screen.height / 2) - (400 / 2);
       
         const editWindow = window.open('<?=base_url("kullanici/fiyat_guncelle_view/")?>' + limitId, 'Edit Price', 'width=600,height=400,'+',top=' + top + ',left=' + left);
         
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