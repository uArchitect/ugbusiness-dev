
<div class="p-2 m-2" style="background:#f1f1f1">
<span class=" text-black text-bold"><i class="fa fa-tag"></i> KULLANICI BAZLI ARAÇ RAPORU <span style="font-weight:400">(TARİH FİLTRELEMESİ YAPILMADI, TÜM KAYITLAR LİSTELENDİ)</span></span>
<span class="d-block pl-2 ml-2" style="margin-top:0px;opacity:0.6">Seçilen kullanıcıya tanımlanmış olan şirket araçları listelenmiştir. Detay görüntülemek için Araç Plakası'na tıklayabilirsiniz.</span>

</div>
 


<div class="row" style="max-height: 865px; overflow-y: auto;">
  <?php foreach ($tanimli_araclar as $arac){?>

    <div class="col-md-4">
      

    <div class="card d-flex flex-fill" style="border-radius:0">
                <div class="card-header text-muted border-bottom-0">
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                  <div class="col text-center">
                      <img src="<?=$arac->arac_resim?>" style="object-fit:cover; border: 2px solid #272829c7;" alt="user-avatar" class="img-fluid">
                   
                      <form id="myform59" action="https://ugbusiness.com.tr/talep/yonlendirmeler" method="post">
                        
                        <a style="cursor:pointer;font-size:22px"><b><?=$arac->arac_marka." ".$arac->arac_model?></b></a>
                      </form>
                     
                     
                      <p class="text-muted text-sm" style="margin-top:-5px">
                      
                        <?=get_arac_km_son_kayit($arac->arac_id)->arac_km_deger?> KM                   </p>
                       
                    </div>
                  
                  </div>
                </div>
                
              </div>


    </div>


    <?php } ?>
</div>
 