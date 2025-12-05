<?php $this->load->view('musteri/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-musteri">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-musteri">
          <!-- Card Header -->
          <div class="card-header card-header-musteri">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-plus-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Cihaz Tanımlama Formu
                  </h3>
                  <small class="card-header-subtitle">Yeni cihaz tanımlama ve kayıt işlemleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('musteri/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-musteri">
            <div class="card-body-content">
              <div class="row">
                <div class="col-md-4">
                  <div class="card card-primary">
                    <div class="card-header with-border">
                      <h3 class="card-title">Cihaz Bilgileri</h3>
                    </div>

                    <form class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/cihaz_tanimla_save'.((!empty($_GET["filter"])) ? "/1" : ""));?>">
                      <div class="card-body">
                        <div style="background: #ffffe2; padding: 10px; color: #ab6800; margin-top: 0px; margin-bottom: 15px; border: 2px solid #ffbc007d; border-radius: 5px;">
                          <span><i class="fas fa-exclamation-circle" style="margin-right: 4px; color: #f5a100;"></i> Sipariş kaydı seçilmezse sistem otomatik olarak yeni sipariş oluşturup, bilgileri girilen cihazı o siparişe tanımlar.</span>
                        </div>

                        <div class="form-group">
                          <label for="formClient-Code">Müşteri</label>
                          <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                          <a href="<?=((!empty($_GET["filter"])) ? base_url("musteri/add/0/0/1") : base_url("musteri/add"))?>" class="text-success" style="float: right;"><i class="fas fa-user-plus"></i> Yeni Müşteri Kayıt</a>     
                          <select name="musteri_id" id="musteri_id" required class="select2 form-control rounded-0" style="width: 100%;">
                            <option value="">Müşteri Seçimi Yapınız</option>
                            <?php foreach($musteriler as $musteri) : ?> 
                              <option <?=($secilen_musteri == $musteri->merkez_id)?"selected":""?> value="<?=$musteri->merkez_id?>"><?=$musteri->musteri_ad?>(<?=$musteri->merkez_adi?>) <?=$musteri->ilce_adi?> / <?=$musteri->sehir_adi?> / <?=$musteri->musteri_iletisim_numarasi?></option>
                            <?php endforeach; ?>  
                          </select> 
                        </div>

                        <div class="form-group" style="height: 0px; opacity: 0;">
                          <label for="formClient-Code">Sipariş</label>
                          <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                          <div id="urun_siparis_div">
                            <select name="renkc" id="renkc" disabled class="select2 form-control rounded-0" style="width: 100%;">
                              <option value="0">Yeni Sipariş Oluştur</option>
                            </select>  
                          </div>    
                        </div>

                        <div class="form-group" style="margin-top: -20px;">
                          <label for="formClient-Code">Cihaz</label>
                          <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                          <select name="cihaz_id" id="cihaz_id" required class="select2 form-control rounded-0" style="width: 100%;">
                            <option value="">Cihaz Seçimi Yapınız</option>
                            <?php foreach($cihazlar as $cihaz) : ?> 
                              <option value="<?=$cihaz->urun_id?>"><?=$cihaz->urun_adi?></option>
                            <?php endforeach; ?>  
                          </select>      
                        </div>

                        <div class="form-group">
                          <label for="formClient-Code">Renk</label>
                          <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                          <div id="urun_renk_div">
                            <select name="renkc" id="renkc" disabled class="select2 form-control rounded-0" style="width: 100%;">
                              <option value="">Renk Seçmek İçin Önce Cihaz Seçimi Yapınız</option>
                            </select>  
                          </div>    
                        </div>

                        <div class="form-group">
                          <label for="formClient-Name">Seri Numarası</label>
                          <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                          <input type="text" class="form-control" name="seri_numarasi" required="" placeholder="Seri No Giriniz..." autofocus="">
                        </div>

                        <div class="form-group">
                          <label for="formClient-Name">Garanti Başlangıç Tarihi</label>
                          <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                          <input type="date" required class="form-control" value="<?=date("Y-m-d")?>" name="garanti_baslangic" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                        </div>

                        <div class="form-group">
                          <label for="formClient-Name">Garanti Bitiş Tarihi</label>
                          <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                          <input type="date" required class="form-control" value="<?=date("Y-m-d", strtotime('+2 years'))?>" name="garanti_bitis" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                        </div>
                      </div>

                      <div class="card-footer">
                        <div class="row">
                          <div class="col"><a href="<?=base_url("servis/servis_cihaz_sorgula_view")?>" class="btn btn-flat btn-danger">İptal</a></div>
                          <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary">Kaydet</button></div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function(){
    $('#cihaz_id').on('change', function(e){
      var urun_id = $(this).val();
      
      $.post('<?=base_url("urun/get_renkler/")?>'+urun_id, {}, function(result){
        if ( result && result.status != 'error' ) {
          var renkler = result.data;
          var select = '<select name="renk" id="ekle_renk" class="select2 form-control rounded-0">';
          for( var i = 0; i < renkler.length; i++) {
            select += '<option value="'+ renkler[i].id +'">'+ renkler[i].renk +'</option>';
          }
          select += '</select>';
          $('#urun_renk_div').empty().html(select);
          $('#ekle_renk').select2();
        } else {
          alert('Hata : ' + result.message );
        }					
      });
    });

    $('#musteri_id').on('change', function(e){
      var urun_id = $(this).val();
      
      $.post('<?=base_url("siparis/get_siparisler/")?>'+urun_id, {}, function(result){
        if ( result && result.status != 'error' ) {
          var siparisler = result.data;
          var select = '<select name="siparis_id" id="ekle_siparis" class="select2 form-control rounded-0">';
          select += '<option value="0">Yeni Sipariş Oluştur</option>';
          for( var i = 0; i < siparisler.length; i++) {
            select += '<option value="'+ siparisler[i].id +'"><b>'+ siparisler[i].siparis_kodu +'</b> / '+ siparisler[i].siparis_kayit_tarihi +'</option>';
          }
          select += '</select>';
          $('#urun_siparis_div').empty().html(select);
          $('#ekle_siparis').select2();
        } else {
          var select = '<select name="siparis_id" id="ekle_siparis" class="select2 form-control rounded-0">';
          select += '<option value="0">Yeni Sipariş Oluştur</option>';
          select += '</select>';
          $('#urun_siparis_div').empty().html(select);
          $('#ekle_siparis').select2();
        }					
      });
    });
  });
</script>