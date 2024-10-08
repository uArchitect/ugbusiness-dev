 
 


<div class="row" style="max-height: 865px; overflow-y: auto;">
  <?php foreach ($tanimli_araclar as $arac){?>

    <div class="col-md-3">
      

    <div class="card d-flex flex-fill"  style="border-radius:0;">
                <div class="card-header text-muted border-bottom-0">
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                  <div class="col text-center">
                      <img src="<?=$arac->arac_resim?>" onclick='location.href="https://ugbusiness.com.tr/arac/index/<?=$arac->arac_id?>";' style="cursor:pointer;width: -webkit-fill-available;height:200px;object-fit: contain; border: 2px solid #1f62bf; background: #7ab2ff33; padding: 26px; border-radius: 20px 20px 0 0;" alt="user-avatar" class="img-fluid">
                   
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
 