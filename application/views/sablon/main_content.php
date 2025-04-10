<div class="content-wrapper pt-2">

<div class="content-header">
      
        <div class="row mb-2">
          <div class="col" style="display: flex
;
    justify-content: space-between;">
            <h1 class="m-0">UMEX GÖREV ŞABLONU</h1>
          
            <a href="<?=base_url("sablon/yeni_sablon_kategori_ekle")?>" class="btn btn-success"><i class="fa fa-plus"></i> Yeni Birim Ekle</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
 
    </div>

<div class="row">
<script>
    function toggleHeader1(header1,header2) {
           document.getElementById(header1).style.display = "none";
           document.getElementById(header2).style.display = "block";
           document.getElementById("btn"+header2).focus();
        
    } 
    </script>
    <?php
    foreach ($sablonlar as $sablon) :
    ?>
        <div class="col-md-2">
            <div class="card  <?=$sablon->sablon_kategori_adi == "**YENİ BİRİM**" ? "card-warning" : "card-dark "?>"">
            <div class="card-header" id="header1<?=$sablon->sablon_kategori_id?>" style="    padding: 8px 16px;">
            <h3 class="card-title" style=" font-size: 14px; font-weight: 700; margin-top: 5px;"> 
            <?=$sablon->sablon_kategori_adi?></h3>
            <div class="card-tools">
            <a href="<?=base_url("sablon/sablon_kategori_sil/$sablon->sablon_kategori_id")?>" type="button" class="btn btn-dark btn-sm  " onclick="return confirmDelete()">
    <i class="fa fa-trash text-danger" style="display: block;"></i>
</a>

<script type="text/javascript">
    function confirmDelete() {
        return confirm("Bu kategoriyi silmek istediğinize emin misiniz?");
    }
    function confirmDelete2() {
        return confirm("Bu alanı silmek istediğinize emin misiniz?");
    }
</script>
                  <button onclick="toggleHeader1('header1<?=$sablon->sablon_kategori_id?>','header2<?=$sablon->sablon_kategori_id?>')" type="button" class="btn btn-dark btn-sm  "  >
                    <i class="fa fa-pen text-warning" style="display: block;"></i>
                  </button> 
                </div>
            </div> 
            
            <div class="card-header" id="header2<?=$sablon->sablon_kategori_id?>" style=" display:none;       padding: 4px 3px;">
            <form action="<?=base_url("sablon/sablon_kategori_guncelle/$sablon->sablon_kategori_id")?>" method="post">
             <div class="input-group input-group-sm">
                  <input type="text" id="btnheader2<?=$sablon->sablon_kategori_id?>" onfocus="this.setSelectionRange(this.value.length, this.value.length);" name="sablon_kategori_adi" class="form-control" value="<?=$sablon->sablon_kategori_adi?> ">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-success btn-flat">Kaydet</button>
                    <button type="button"  onclick="toggleHeader1('header2<?=$sablon->sablon_kategori_id?>','header1<?=$sablon->sablon_kategori_id?>')" class="btn btn-danger btn-flat">İptal</button>
                  </span>
                </div>
            </form>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
             
            <div class="card-body" style="    padding-bottom: 0px;">


            <form action="<?=base_url("sablon/sablon_detay_guncelle/$sablon->sablon_kategori_id")?>" method="post">
<div class="form-group" style="
    margin-bottom: 10px;">
         
 

       
        <textarea placeholder="Veri Girilmedi" style="    height: 206px;" class="form-control" name="sablon_kategori_detay" oninput="toggleButton('saveButton<?=$sablon->sablon_kategori_id ?>')"><?=$sablon->sablon_kategori_detay?></textarea>
        <button type="submit" id="saveButton<?=$sablon->sablon_kategori_id ?>" style="margin-top: 5px; width: -webkit-fill-available; display: none;" class="btn btn-warning btn-xs"><i class="fa fa-save"></i> Değişiklikleri Kaydet</button>
    </div>
    </form>










            
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

                
                
                
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                
            </div>
        
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>

