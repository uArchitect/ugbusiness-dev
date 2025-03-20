<div class="content-wrapper pt-2">
<div class="row">
    <?php
    $sablonlar = ["Teknik Servis","Üretim","Eğitmenler","Satış","Muhasebe","Muhasebe"];
    foreach ($sablonlar as $sablon) :
    ?>
        <div class="col-md-2">
            <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"><?=$sablon?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" novalidate="novalidate">
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputEmail1"><i class="fa fa-user-circle"></i> Email address</label>
                <textarea class="form-control"></textarea>
                </div>
                
                <div class="form-group mb-0">
                <div class="custom-control custom-checkbox" style="
    padding: 0;
">
                <button type="submit" class="btn btn-default" style="
    width: -webkit-fill-available;
    background: white;
    border: 1px dashed;
    opacity: 0.5;
">Yeni Alan Ekle</button>
                </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>