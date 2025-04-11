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



    <div class="row">
       

        <?php foreach ($sablonlar as $sablon) : ?>
            <div class="col-md-2">
                <div class="card <?= $sablon->sablon_kategori_adi == "**YENİ BİRİM**" ? "card-warning" : "card-dark " ?>">
                    <div class="card-header" id="header1<?=$sablon->sablon_kategori_id?>" style="padding: 8px 16px;">
                        <h3 class="card-title" style="font-size: 14px; font-weight: 700; margin-top: 5px;"> 
                            <?=$sablon->sablon_kategori_adi?>
                        </h3>
                        <div class="card-tools">
                            <a href="<?= base_url("sablon/sablon_kategori_sil/$sablon->sablon_kategori_id") ?>" type="button" class="btn btn-dark btn-sm" onclick="return confirmDelete()">
                                <i class="fa fa-trash text-danger" style="display: block;"></i>
                            </a>
                            <button onclick="toggleHeader1('header1<?=$sablon->sablon_kategori_id?>','header2<?=$sablon->sablon_kategori_id?>')" type="button" class="btn btn-dark btn-sm">
                                <i class="fa fa-pen text-warning" style="display: block;"></i>
                            </button> 
                        </div>
                    </div> 

                    

                     
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
