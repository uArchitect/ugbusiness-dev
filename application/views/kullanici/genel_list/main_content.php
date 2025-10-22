<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">
  <div class="row">
    <div class="col-md-8">
      
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Mesai Yönetimi</h3>
                 </div>
                            <div class="card-body">
                <table id="example1yonlendirilentablo" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
                    <th>Ad Soyad</th> 
                    <th style="width: 130px;">Departman</th>
                    <th>İletişim Numarası</th>
                    <th>Mesai Başlama Saati</th>
                    <th style="width: 100px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($kullanicilar as $kullanici) : ?>
                      <?php $count++?>
                        
                                            <tr data-id="<?=$kullanici->kullanici_id?>"> 
                  
                      <td>
                        <?php
                          if($kullanici->kullanici_resim != ""){
                                ?>
                                   <img style="width:50px;border-radius:50%; height:50px;object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                                <?php
                          }else{
                            ?>
                                 <img style="width:50px;border-radius:50%; height:50px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> 
                              
                            <?php
                          }
          _B..._           ?>
                      
                      
                      
                      <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=$kullanici->kullanici_ad_soyad?></a></b>   
                    </td>
                      
                         <td><i class="fa fa-building" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->departman_adi?></td>
                      <td><i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?></td>
                      
                        <td class="mesai-saati-hucre">
                            <span class="mesai-gosterim">
                                <i class="fa fa-clock" style="margin-right:5px;opacity:0.8"></i> 
                                <?=date("H:i",strtotime($kullanici->mesai_baslangic_saati))?>
                            </span>
                            <span class="mesai-input" style="display:none;">
                                <input type="time" class="form-control form-control-sm" style="width:100px;" value="<?=date("H:i",strtotime($kullanici->mesai_baslangic_saati))?>">
                            </span>
                        </td>
                   
                      
                      <td>
                            <button type="button" class="btn btn-warning btn-xs btn-duzenle">
                                <i class="fa fa-pen" style="font-size:12px"></i> Düzenle
                            </button>
                            <button type="button" class="btn btn-success btn-xs btn-kaydet" style="display:none;">
                                <i class="fa fa-save" style="font-size:12px"></i> Kaydet
                            </button>
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
 
                </table>
              </div>
                          </div>
                </div>
  </div>
</section>
            </div>

<script>
$(document).ready(function() {
    // Ajax isteği için CI site URL'sini alalım
    var ajax_url = "<?php echo site_url('kullanici/guncelle_mesai'); ?>";
    
    // Tabloyu seçelim (event delegation için)
    var table = $('#example1yonlendirilentablo');

    // 1. "Düzenle" butonuna tıklanınca...
    table.on('click', '.btn-duzenle', function() {
        var tr = $(this).closest('tr');
        
        // O satırdaki metni gizle, inputu göster
        tr.find('.mesai-gosterim').hide();
        tr.find('.mesai-input').show();
        
        // "Düzenle" butonunu gizle, "Kaydet" butonunu göster
        $(this).hide();
        tr.find('.btn-kaydet').show();
    });

    // 2. "Kaydet" butonuna tıklanınca...
    table.on('click', '.btn-kaydet', function() {
        var tr = $(this).closest('tr');
        var btnKaydet = $(this); // Kaydet butonunu değişkene ata
        var btnDuzenle = tr.find('.btn-duzenle');
        
        // Verileri al
        var kullanici_id = tr.data('id');
        var yeni_mesai_saati = tr.find('.mesai-input input[type="time"]').val();

        // Basit doğrulama
        if (!yeni_mesai_saati) {
            alert('Lütfen geçerli bir saat girin.');
            return;
        }

        // Ajax isteğini başlat
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                kullanici_id: kullanici_id,
                mesai_saati: yeni_mesai_saati
            },
            dataType: 'json',
            beforeSend: function() {
                // İstek sırasında butonu pasif yap ve spinner göster
                btnKaydet.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(response) {
                if (response.success) {
                    // Başarılıysa:
                    // 1. Gösterim metnini güncelle
                    tr.find('.mesai-gosterim').html('<i class="fa fa-clock" style="margin-right:5px;opacity:0.8"></i> ' + response.new_time);
                    
                    // 2. Input'u gizle, metni göster
                    tr.find('.mesai-input').hide();
                    tr.find('.mesai-gosterim').show();
                    
                    // 3. Butonları eski haline getir
                    btnKaydet.hide();
                    btnDuzenle.show();
                } else {
                    // Hata varsa uyar
                    alert('Güncelleme hatası: ' + response.message);
                }
            },
            error: function() {
                alert('Sunucuya bağlanırken bir hata oluştu.');
            },
            complete: function() {
                // İstek bitince butonu tekrar aktif et ve ikonunu düzelt
                btnKaydet.prop('disabled', false).html('<i class="fa fa-save" style="font-size:12px"></i> Kaydet');
            }
        });
    });
});
</script>