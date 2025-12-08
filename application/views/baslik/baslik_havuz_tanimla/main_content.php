 
<?php $this->load->view('uretim/includes/styles'); ?>

<div class="content-wrapper content-wrapper-uretim">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-uretim">
          <!-- Card Header -->
          <div class="card-header card-header-uretim">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-qrcode card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Yeni Başlık Tanımlama
                  </h3>
                  <small class="card-header-subtitle">Başlık havuzu için yeni kayıt oluştur</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('uretim/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-uretim">
            <div class="card-body-content" style="padding: 15px;">
              <div class="row">
                <div class="col-md-6 col-lg-5">
                  <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px;">
                    <div class="card-header" style="background: #001657; color: white; padding: 12px 15px;">
                      <h3 class="card-title mb-0" style="color: white; font-weight: 600; font-size: 16px;">
                        <i class="fas fa-qrcode mr-2"></i> Başlık Bilgileri
                      </h3>
                    </div>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('baslik/baslik_havuz_tanimla_save');?>">

    <div class="card-body">

      <div class="form-group">
        <label for="formClient-Code"> Cihaz</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="cihaz_id" id="cihaz_id" required class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Cihaz Seçimi Yapınız</option>
        <?php foreach($cihazlar as $cihaz) : ?> 
                    <option  value="<?=$cihaz->urun_id?>"><?=$cihaz->urun_adi?></option>
          <?php endforeach; ?>  
                  </select>      
      </div>

  <div class="form-group">
        <label for="formClient-Code"> Başlık Türü</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div id="urun_renk_div">
        <select name="renkc" id="renkc" disabled class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Başlık Seçmek İçin Önce Cihaz Seçimi Yapınız</option>
         
                  </select>  
                </div>    
      </div>
      <div class="form-group">
        <label for="formClient-Name">Başlık Seri Kodunu Giriniz (QR)</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="baslik_seri_numarasi" required="" placeholder="Başlık Kodunu Giriniz..." autofocus="">
       </div>

      <div class="form-group">
        <label for="formClient-Name">Cihaz Seri Numarası (UG00000000UX00)</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="cihaz_seri_numarasi" required="" placeholder="Seri No Giriniz..." autofocus="">
       </div>

 

    </div>








 

                    <div class="card-footer" style="background: #f8f9fa; padding: 15px;">
                      <div class="row">
                        <div class="col">
                          <a href="<?=base_url("baslik/baslik_havuz_liste_view")?>" class="btn btn-flat btn-danger">
                            <i class="fas fa-times mr-1"></i> İptal
                          </a>
                        </div>
                        <div class="col text-right">
                          <button type="submit" class="btn btn-flat btn-primary">
                            <i class="fas fa-save mr-1"></i> Kaydet
                          </button>
                        </div>
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

            <script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

            <script>


$(document).ready(function(){
			$('#cihaz_id').on('change', function(e){
				var urun_id = $(this).val();
      
				$.post('<?=base_url("urun/get_basliklar/")?>'+urun_id, {}, function(result){
    
 
					if ( result && result.status != 'error' )
					{
          
						var renkler = result.data;
						var select = '<select name="baslik_kayit_no" id="ekle_renk" class="select2 form-control rounded-0">';
						for( var i = 0; i < renkler.length; i++)
						{
							select += '<option value="'+ renkler[i].id +'">'+ renkler[i].renk +'</option>';
						}
						select += '</select>';
						$('#urun_renk_div').empty().html(select);
             
            $('#ekle_renk').select2();
					}
					else
					{
						alert('Hata : ' + result.message );
					}					
				});

			});
 

		});



              </script>