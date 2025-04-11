<div class="content-wrapper pt-2">
    <div class="content-header">
        <div class="row mb-2">
            <div class="col" style="display: flex; justify-content: space-between;">
                <h1 class="m-0">UMEX GÖREV ŞABLONU</h1>
             <div class="d-flex">
            
             <a href="<?=base_url("sablon/yeni_sablon_kategori_ekle")?>" class="btn btn-success"><i class="fa fa-plus"></i> Yeni Birim Ekle</a>
             </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <div class="row">
        <div class="col">
        <div class="btn-group">
        <?php foreach ($sablonlar as $sablon) : ?>
                        <button type="button" class="btn btn-default"><?=$sablon->sablon_kategori_adi?></button>
                        <?php endforeach; ?> 
                        <button type="button" class="btn btn-default">Middle</button>
                        <button type="button" class="btn btn-default">Right</button>
                      </div>
        </div>
    </div>



    <div class="row">
        <script>
            function toggleEditableArea(id) {
                var textarea = document.getElementById("stextarea" + id);
                var editButton = document.getElementById("editButton" + id);
                var saveButton = document.getElementById("saveButton" + id);
                var cancelButton = document.getElementById("cancelButton" + id);

                // Toggle editability
                textarea.disabled = !textarea.disabled;
                
                // Show/hide buttons
                if (textarea.disabled) {
                    editButton.style.display = "block";
                    saveButton.style.display = "none";
                    cancelButton.style.display = "none";
                } else {
                    editButton.style.display = "none";
                    saveButton.style.display = "block";
                    cancelButton.style.display = "block";
                    textarea.focus();

                }
            }

            function cancelEdit(id) {
                var textarea = document.getElementById("stextarea" + id);
                var editButton = document.getElementById("editButton" + id);
                var saveButton = document.getElementById("saveButton" + id);
                var cancelButton = document.getElementById("cancelButton" + id);

                // Cancel edit and reset the textarea
                textarea.disabled = true;
                textarea.value = textarea.defaultValue;

                // Show/hide buttons
                editButton.style.display = "block";
                saveButton.style.display = "none";
                cancelButton.style.display = "none";
            }
        </script>

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

                    <div class="card-header" id="header2<?=$sablon->sablon_kategori_id?>" style="display:none; padding: 4px 3px;">
                        <form action="<?=base_url("sablon/sablon_kategori_guncelle/$sablon->sablon_kategori_id")?>" method="post">
                            <div class="input-group input-group-sm">
                                <input type="text" id="btnheader2<?=$sablon->sablon_kategori_id?>" onfocus="this.setSelectionRange(this.value.length, this.value.length);" name="sablon_kategori_adi" class="form-control" value="<?=$sablon->sablon_kategori_adi?>">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-success btn-flat">Kaydet</button>
                                    <button type="button" onclick="toggleHeader1('header2<?=$sablon->sablon_kategori_id?>','header1<?=$sablon->sablon_kategori_id?>')" class="btn btn-danger btn-flat">İptal</button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="card-body" style="padding-bottom: 0px;">
                        <form action="<?=base_url("sablon/sablon_detay_guncelle/$sablon->sablon_kategori_id")?>" method="post">
                            <div class="form-group" style="margin-bottom: 10px;">
                                <!-- Düzenle butonu ve textarea alanı -->
                                <button style="width: -webkit-fill-available; background: white; color: #005aff; border: 0; text-align: end;" type="button" id="editButton<?=$sablon->sablon_kategori_id?>" onclick="toggleEditableArea(<?=$sablon->sablon_kategori_id?>)" class="btn btn-primary btn-xs" style="margin-bottom: 5px;">
                                    Düzenle
                                </button>

                                <textarea id="stextarea<?=$sablon->sablon_kategori_id ?>" placeholder="Veri Girilmedi" style="height: 206px;" class="form-control" name="sablon_kategori_detay" disabled><?=$sablon->sablon_kategori_detay?></textarea>

                                <button type="submit" id="saveButton<?=$sablon->sablon_kategori_id ?>" style="margin-top: 5px; width: -webkit-fill-available; display: none;" class="btn btn-warning btn-xs">
                                    <i class="fa fa-save"></i> Değişiklikleri Kaydet
                                </button>

                                <button type="button" id="cancelButton<?=$sablon->sablon_kategori_id ?>" onclick="cancelEdit(<?=$sablon->sablon_kategori_id ?>)" style="margin-top: 5px; width: -webkit-fill-available; display: none;" class="btn btn-danger btn-xs">
                                    İptal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
