<div class="content-wrapper pt-2">
<div class="row">
    <?php
    $sablonlar = ["Teknik Servis","Üretim","Eğitmenler","Satış","Muhasebe"];
    foreach ($sablonlar as $sablon) :
    ?>
        <div class="col">
            <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"><?=$sablon?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" novalidate="novalidate">
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <textarea class="form-control"></textarea>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group mb-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                    <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
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