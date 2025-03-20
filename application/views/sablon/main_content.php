<div class="content-wrapper pt-2">
<div class="row">
    <?php
    foreach ($sablonlar as $sablon) :
    ?>
        <div class="col-md-2">
            <div class="card card-dark">
            <div class="card-header">
            <h3 class="card-title"><i class="far fa-folder-open nav-icon text-orange"  ></i>
            <?=$sablon->sablon_kategori_adi?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
            <div class="card-body">
            <?php foreach ($veriler as $veri) { 
    if ($veri->sablon_veri_kategori_id != $sablon->sablon_kategori_id) {
        continue;
    }
?>
    <div class="form-group">
         
        <i class="fa fa-user-circle"></i><input type="text" class="form-control" value="<?=$veri->sablon_veri_adi?>">
        <textarea class="form-control" oninput="toggleButton(this)"><?=$veri->sablon_veri_detay?></textarea>
        <button type="submit" style="margin-top: 5px; width: -webkit-fill-available; display: none;" class="btn btn-warning btn-xs"><i class="fa fa-save"></i> Değişiklikleri Kaydet</button>
    </div>
<?php } ?>

<script>
    function toggleButton(textarea) {
        let button = textarea.nextElementSibling;
        if (textarea.value.trim() !== textarea.defaultValue.trim()) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    }
</script>

                
                
                <div class="form-group mb-0">
                <div class="custom-control custom-checkbox" style="
    padding: 0;
">

        <form action="<?=base_url("sablon/sablon_veri_ekle/$sablon->sablon_kategori_id")?>" method="post">
            <div class="form-group">
                 
                <input type="text" name="sablon_veri_adi" class="form-control" id="exampleInputEmail1" placeholder="Başlık Giriniz">
                
                <button type="submit" style="margin-top: 5px; width: -webkit-fill-available;" class="btn btn-success" ><i class="fa fa-check"></i> KAYDET</button>
            </div>

        </form>


                <button type="submit" class="btn btn-default" style="
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