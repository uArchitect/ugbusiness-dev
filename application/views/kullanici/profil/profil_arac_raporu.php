
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
                      <img src="<?=$arac->arac_resim?>" style="height:200px;object-fit: cover; border: 2px solid #1f62bf; background: #7ab2ff33; padding: 26px; border-radius: 20px 20px 0 0;" alt="user-avatar" class="img-fluid">
                   
                      <form id="myform59" style="background: #1461c3; padding: 5px; color: white;" action="https://ugbusiness.com.tr/talep/yonlendirmeler" method="post">
                        
                        <a style="cursor:pointer;font-size:22px"><b><?=$arac->arac_marka." ".$arac->arac_model?></b></a>
                      </form>
                     
                     
                      <p class="text-muted text-sm" style="margin-top: -5px; background: #e5f0fe; color: #1f62bf !important; padding: 5px; border-radius: 0 0 20px 20px; border: 2px solid #1f62bf;">
                      
                      Güncel KM :   <?=get_arac_km_son_kayit($arac->arac_id)->arac_km_deger?>                    </p>
                       
                    </div>
                  
                  </div>
                </div>
                
              </div>


    </div>


    <?php } ?>
</div>
 