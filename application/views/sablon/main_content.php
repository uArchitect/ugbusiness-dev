<div class="content-wrapper pt-2">
<div class="row">
    <?php
    foreach ($sablonlar as $sablon) :
    ?>
        <div class="col-md-2">
            <div class="card card-dark">
            <div class="card-header" style="    padding: 8px 16px;">
            <h3 class="card-title" style="    margin-top: 3px;"> 
            <?=$sablon->sablon_kategori_adi?></h3>
            <div class="card-tools">
                  <button type="button" class="btn btn-danger btn-sm daterange"  >
                    <i class="fa fa-trash" style="display: block;"></i>
                  </button> 
                  <button type="button" class="btn btn-warning btn-sm daterange"  >
                    <i class="fa fa-pen" style="display: block;"></i>
                  </button> 
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
             
            <div class="card-body">
            <?php foreach ($veriler as $veri) { 
    if ($veri->sablon_veri_kategori_id != $sablon->sablon_kategori_id) {
        continue;
    }
?>
     <form action="<?=base_url("sablon/sablon_veri_guncelle/$veri->sablon_veri_id")?>" method="post">
<div class="form-group">
         

    <div class="d-flex" style="margin-bottom: 5px;     ">

            <i class="fa fa-user-circle"></i>
            <input type="text" class="form-control" oninput="toggleButton('saveButton<?=$veri->sablon_veri_id?>')"   name="sablon_veri_adi" value="<?=$veri->sablon_veri_adi?>" style="border: 0;padding: 0;height: 16px;padding-left: 4px;font-weight: 500;">
          
      </div>

       
        <textarea class="form-control" name="sablon_veri_detay" oninput="toggleButton('saveButton<?=$veri->sablon_veri_id?>')"><?=$veri->sablon_veri_detay?></textarea>
        <button type="submit" id="saveButton<?=$veri->sablon_veri_id?>" style="margin-top: 5px; width: -webkit-fill-available; display: none;" class="btn btn-warning btn-xs"><i class="fa fa-save"></i> Değişiklikleri Kaydet</button>
    </div>
    </form>
<?php } ?>

<script>
    function toggleButton(btn) {
           document.getElementById(btn).style.display = "block";
        
    } 
    function showForm(e,form) {
        e.style.display = "none";
        
           document.getElementById(form).style.display = "block";
        
    } 
    function hideForm(e,form) {
        document.getElementById(e).style.display = "block";
        
           document.getElementById(form).style.display = "none";
        
    } 
</script>

                
                
                <div class="form-group mb-0">
                <div class="custom-control custom-checkbox" style="
    padding: 0;
">

        <form action="<?=base_url("sablon/sablon_veri_ekle/$sablon->sablon_kategori_id")?>" style="display:none;" id="form<?=$sablon->sablon_kategori_id?>" method="post">
            <div class="form-group">
                 
                <input type="text" name="sablon_veri_adi" class="form-control" id="exampleInputEmail1" placeholder="Ünvan Giriniz">
                
               <div class="d-flex" style="    gap: 5px;">
               <button type="submit" style="margin-top: 5px; width: -webkit-fill-available;" class="btn btn-success" ><i class="fa fa-check"></i> KAYDET</button>
               <a onclick="hideForm('btn<?=$sablon->sablon_kategori_id?>','form<?=$sablon->sablon_kategori_id?>')"  style="margin-top: 5px; width: -webkit-fill-available;" class="btn btn-danger" ><i class="fa fa-times"></i> İPTAL</a>
               </div>
            </div>

        </form>


                <button type="submit" id="btn<?=$sablon->sablon_kategori_id?>" onclick="showForm(this,'form<?=$sablon->sablon_kategori_id?>')" class="btn btn-default" style="
    width: -webkit-fill-available;
    background: white;
    border: 1px dashed;
    opacity: 0.5;
"><i class="fa fa-plus"></i> Yeni Alan Ekle</button>
                </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                
            </div>
        
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>