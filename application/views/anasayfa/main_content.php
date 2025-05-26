  
<div class="content-wrapper pr-2 mobil-genislik" style="padding-top:15px">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <h3 style="font-size: xxx-large; color: red; text-align: center; padding: 10px; font-weight: 600;">ŞİRKET KURALLARI</h3>
      </div>
      <div class="col-12">
        <?php 
        foreach ($kurallar as $kural) :
        ?>
        <div class="card card-danger" style="font-weight:800;background-color:#df0015;">
          <div class="card-header">
            <?=$kural->sablon_kategori_adi?>  /   <?=$kural->sablon_veri_adi?>   
          </div>
          <div class="card-body">
 <?=$kural->sablon_veri_detay?>
          </div>
        </div>
        <?php 
        endforeach;
        ?>
      </div>
    </div>     
  </section> 
</div> 