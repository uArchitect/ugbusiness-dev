<div class="content-wrapper pt-2">
<div class="row">
    <?php
    foreach ($sablonlar as $sablon) :
    ?>
        <div class="col-md-2">
            <div class="card card-dark">
            <div class="card-header">
            <h3 class="card-title"><?=$sablon->sablon_kategori_adi?></h3>
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

        <form action="" method="post">
            <div class="form-group">
                 
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Başlık Giriniz">
                
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
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>