<div class="content-wrapper pt-2">
    <div class="row mb-2">
        <div class="col">
            <div class="btn-group">
                <?php foreach ($sablonlar as $sablon) : ?>
                    <button type="button" class="btn <?=$secilen_kategori->sablon_kategori_id == $sablon->sablon_kategori_id ? "btn-success" : "btn-default"?>  "><?=$sablon->sablon_kategori_adi?></button>
                <?php endforeach; ?> 
                <button type="button" class="btn btn-default text-success  "><i class="fa fa-plus"></i></button> 
            </div>
        </div>
    </div>

    <div class="row gap-2">
        <?php 
        foreach ($veriler as $veri) {
            ?>
            <div class="col-md-3">
            <div class="card card-dark">
                <div class="card-header" >
                    <?=$veri->sablon_veri_adi?>
                </div>
                <div class="card-body">
                    <textarea name="" style="height:270px" class="form-control" id=""></textarea>
                    <button style="width: -webkit-fill-available; margin-top: 4px;" class="btn btn-success">Değişiklikleri Kaydet</button>
                </div>
            </div>
            </div>
           
            <?php
        }
        ?>                
    </div>
</div>
