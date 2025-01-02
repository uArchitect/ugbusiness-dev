<div class="content-wrapper mt-2">
    <section class="content col-md-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-danger text-white">
                <h3 class="card-title">
                    <i class="fas fa-exchange-alt"></i> UMEX Takaslı Sipariş
                </h3>  
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="takasSeriNumarasi" class="font-weight-bold">Takas Alınacak Umex Cihaz Seri Numarası</label>
                    <p class="text-muted ">Müşteriden takas olarak alınacak Umex cihaz seri numarasını giriniz.</p>
                    
                    <input type="text" class="form-control rounded-pill px-3 py-2"  style="font-size: 22px;"
                           id="takasSeriNumarasi" name="takas_seri_numarasi" maxlength="50" 
                           >
                    
                    <div class="border rounded p-3 mt-3 bg-light" style="font-size: 17px;">
                        <small class="d-block">
                            <span id="rule1" class="text-gray"><i id="icon1" class="fa fa-info-circle text-gray"></i> UG ile başlamalıdır.</span>
                        </small>
                        <small class="d-block">
                            <span id="rule2" class="text-gray"><i id="icon2" class="fa fa-info-circle text-gray"></i> UX01 ile bitmelidir.</span>
                        </small>
                        <small class="d-block">
                            <span id="rule3" class="text-gray"><i id="icon3" class="fa fa-info-circle text-gray"></i> 14 karakter uzunluğunda olmalıdır.</span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-left">
                <a href="<?=base_url('teklif_form')?>" class="btn btn-danger rounded-pill px-4">
                    <i class="fa fa-search"></i> Cihaz Sorgula
                </a>
            </div>
        </div>
    </section>



 <section class="content col-md-12">
        <div class="card shadow-lg" style="border:1px solid greed;">
            
            <div class="card-body">
              <div class="row">
<div class="col-md-12">
<span class="text-danger" style="font-weight: 600;margin-bottom:10px;display:block"><i class="fa fa-info-circle text-danger"></i> TAKAS ALINACAK CİHAZ BİLGİLERİ</span>
            
</div>
              
                    <div class="col-md-4">
                        <div class="btn-group mb-2" style="display: flow;">
                            <button style="     padding-right: 0px;width: 100%;     border: 1px dashed #002355;padding-left:0px;" type="button" class="btn btn-default text-left pb-2">   
                                <div class="row">
                                    <div class="col" style="max-width: 87px;">
                                        <img src="https://www.umex.com.tr/uploads/products/umex-lazer.png" alt="..." style="width: 83px;" class="rounded img-thumbnail">
                                    </div>
                                    <div class="col" style="padding-left: 0px;">
                                        <span style="display: block;background: #dbdbdb;padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                                            <span style="min-width: 230px; width: 230px; display: inline-block; margin-left:5px">
                                                <b style="color:#0f3979">Umex Lazer / </b>
                                                <span style="color:black">UG22032201UX01</span>
                                            </span> 
                                        </span>
                                        <span style="height: 11px;"></span>
                                        <div style="padding-left:10px;background:white;border:1px solid;border-top:0px;border: 1px solid #dbdbdb; border-top: 0px; border-radius: 0px 0px 3px 3px;">
                                            <b>Garanti Bitiş : </b>
                                            22.03.2024     
                                            <br>
                                            Sipariş Kodu : 
                                            <a class="text-primary" style="cursor:pointer">
                                                <span style="opacity:0.5;color:black!important">Sistem Öncesi Kayıt</span>
                                            </a>
                                        </div>
                                    </div>
                                </div> 
                            </button>  
                            </div>
                        </div>

                        <div class="col-md-12">
<span class="text-success" style="font-weight: 600;margin-bottom:10px;margin-top:20px;display:block">YENİ SİPARİŞ BİLGİLERİNİ GİRİNİZ</span>
            
</div>
                </div>

            </div>
            <div class="card-footer text-left">
                <a href="<?=base_url('teklif_form')?>" class="btn btn-success rounded-pill px-4" style="border: 2px solid #037903;">
                    <i class="fa fa-check"></i> Takaslı Sipariş Oluştur
                </a>
            </div>
        </div>
    </section>










    
</div>


<style>
    .card {
    border-radius: 10px;
    overflow: hidden;
}
.card-header {
    border-bottom: none; 
}
.card-footer {
    background: #f9f9f9;
}
.form-control { 
    border: 1px solid #ddd;
}
.form-control:focus {
    border-color: #dc3545;
    box-shadow: 0 0 2px rgba(220, 53, 69, 0.5);
}
.text-gray {
    color: #6c757d;
}
.text-success {
    color: #28a745;
}
.text-danger {
    color: #dc3545;
}
.bg-gradient-danger {
    background: linear-gradient(90deg, #e3342f, #dc3545);
}
.shadow-lg {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

    </style>

<script>
    document.getElementById('takasSeriNumarasi').focus();
    document.getElementById('takasSeriNumarasi').addEventListener('input', function() {
        const value = this.value.toLocaleUpperCase();  
        // Kurallar
        const startsWithUG = value.startsWith('UG');
        const endsWithUX01 = value.endsWith('UX01');
        const isFourteenChars = value.length === 14;

        // Kural 1: UG ile başlamalıdır
        const rule1 = document.getElementById('rule1');
        const icon1 = document.getElementById('icon1');
        rule1.className = startsWithUG ? 'text-success' : value ? 'text-danger' : 'text-gray';
        icon1.className = startsWithUG ? 'fa fa-check-circle text-success' : value ? 'fa fa-times-circle text-danger' : 'fa fa-info-circle text-gray';

        // Kural 2: UX01 ile bitmelidir
        const rule2 = document.getElementById('rule2');
        const icon2 = document.getElementById('icon2');
        rule2.className = endsWithUX01 ? 'text-success' : value ? 'text-danger' : 'text-gray';
        icon2.className = endsWithUX01 ? 'fa fa-check-circle text-success' : value ? 'fa fa-times-circle text-danger' : 'fa fa-info-circle text-gray';

        // Kural 3: 14 karakter uzunluğunda olmalıdır
        const rule3 = document.getElementById('rule3');
        const icon3 = document.getElementById('icon3');
        rule3.className = isFourteenChars ? 'text-success' : value ? 'text-danger' : 'text-gray';
        icon3.className = isFourteenChars ? 'fa fa-check-circle text-success' : value ? 'fa fa-times-circle text-danger' : 'fa fa-info-circle text-gray';
    });
</script>