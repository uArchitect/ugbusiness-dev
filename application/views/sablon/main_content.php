<div class="content-wrapper pt-2">
    <div class="row mb-2">
        <div class="col">
            <div class="btn-group">
                <?php foreach ($sablonlar as $sablon) : ?>
                    <button type="button" class="btn btn-default  "><?=$sablon->sablon_kategori_adi?></button>
                <?php endforeach; ?>  
            </div>
        </div>
    </div>

    <div class="row gap-2">
        <?php 
        foreach ($veriler as $veri) {
            ?>
            <div class="card card-dark col-md-3">
                <div class="card-header">
                    <?=$veri->sablon_veri_adi?>
                </div>
                <div class="card-body">
                    <textarea name="" class="form-control" id=""></textarea>
                </div>
            </div>
            <?php
        }
        ?>                
    </div>
</div>
