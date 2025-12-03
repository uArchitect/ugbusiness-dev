<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-shopping-cart" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Siparişler Kısa Yolları
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Sipariş yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Tab Navigation Bar -->
          <div class="siparis-tabs-container" style="background-color: #001657; overflow-x: auto; border-bottom: 2px solid rgba(255,255,255,0.1);">
            <div class="d-flex" style="min-width: max-content;">
              <a href="<?=base_url("tum-siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fas fa-list-alt" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Tüm Siparişler</span>
              </a>
              <a href="<?=base_url("onay-bekleyen-siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="far fa-check-circle" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Onay Bekleyenler</span>
              </a>
              <a href="<?=base_url("siparis/haftalik_kurulum_plan")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="far fa-calendar-alt" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Kurulum Planı</span>
              </a>
              <a href="<?=base_url("siparis/hizli_siparis_olustur_view")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fa fa-plus-circle" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">Hızlı Sipariş</span>
              </a>
              <a href="<?=base_url("cihaz/iptal_edilen_siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fas fa-ban" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">İptal Edilenler</span>
              </a>
              <a href="<?=base_url("siparis/degerlendirme_rapor")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 12px 20px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: none; transition: all 0.25s ease; display: flex; align-items: center; gap: 8px; position: relative;">
                <i class="fa fa-envelope" style="font-size: 15px; opacity: 0.95;"></i>
                <span style="letter-spacing: 0.3px;">SMS Sonuçları</span>
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if(!empty($onay_bekleyen_siparisler)) : ?>
              <div style="overflow-x: auto;">
                <table id="onaybekleyensiparisler" class="table table-bordered table-striped nowrap" style="width: 100%;">
                  <thead>
                    <tr>
                      <th style="width: 42px;">Kayıt No</th> 
                      <th>Müşteri Adı</th>
                      <th>Merkez Detayları</th>
                      <th style="width: 130px;">Sipariş Oluşturan</th>   
                      <th style="width: 130px;min-width: 260px;">Son Durum</th>
                      <th style="width: 120px;">Sipariş İşlemleri</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $ak = aktif_kullanici()->kullanici_id;
                    $i_kul = aktif_kullanici()->kullanici_id;
                    $count=0; 
                    foreach ($onay_bekleyen_siparisler as $siparis) : 
                      $data = get_son_adim($siparis->siparis_id);
                      if(!$data || empty($data)) { continue; }
                      $count++; 
                      $link = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                    ?>
                    <tr style="cursor:pointer;">
                      <td>
                        <span style="display: block;">
                          <b>#</b><?=$siparis->siparis_id?>
                          <?php 
                          if(hatali_fiyat_kontrol($siparis->siparis_id) == 1){
                            ?><br><a class="btn btn-danger btn-xs yanipsonenyazinew" style="font-size: 10px !important;color:white"><i class="fas fa-exclamation-circle"></i> HATALI FİYAT</a><?php
                          }else{
                            ?><br><a class="btn btn-success btn-xs" style="font-size: 10px !important;color:white"><i class="fas fa-check"></i> FİYAT GEÇERLİ</a><?php
                          }
                          ?>
                        </span>
                      </td> 
                      <td>
                        <i class="far fa-user-circle" style="margin-right:1px;opacity:1"></i> 
                        <b><?php echo "<a href='".base_url("musteri/profil/$siparis->musteri_id")."'>".$siparis->musteri_ad."</a>"; ?></b> 
                        <br>İletişim : <?=$siparis->musteri_iletisim_numarasi?> <?=$siparis->musteri_sabit_numara ? "<br>".$siparis->musteri_sabit_numara : ""?> 
                      </td>
                      <td>
                        <b><?=($siparis->merkez_adi == "#NULL#") ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;'><i class='nav-icon fas fa-exclamation-circle'></i> Merkez Adı Girilmedi</span>":'<i class="far fa-building" style="color: green;"></i> '.$siparis->merkez_adi?> - </b> 
                        <span style="color:#1461c3;"><?=$siparis->sehir_adi?> / <?=$siparis->ilce_adi?></span>  
                        <br><span style="font-size:14px"><?=($siparis->merkez_adresi == "" || $siparis->merkez_adresi == "0" || $siparis->merkez_adresi == ".") ? "ADRES GİRİLMEDİ" : $siparis->merkez_adresi?> </span>
                      </td>           
                      <td>
                        <b>
                          <i class="far fa-user-circle" style="color:green;margin-right:1px;opacity:1"></i>  
                          <?php echo "<a href='".base_url("kullanici/profil_new/$siparis->kullanici_id")."?subpage=ozluk-dosyasi'>".$siparis->kullanici_ad_soyad."</a>"; ?>
                        </b>
                        <br><?=date('d.m.Y H:i',strtotime($siparis->kayit_tarihi));?>
                      </td>
                      <td>
                        <?php echo "<b>".$data[0]->adim_adi."</b> Bekleniyor..."; ?>
                        <br>
                        <div>
                          <div class="row">
                            <?php for($i=1; $i<=12; $i++): ?>
                            <div class="mr-1" style="border: 1px solid #178018;border-radius:50%;background:<?=$siparis->adim_no+1 >= $i ? (($siparis->adim_no+1 == $i) ? "green" : "#b4d7b4") : "#e5e3e3"?>;width:17px;height:17px;display: inline-flex;">
                              <i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?=($siparis->adim_no+1 <= $i) ? "display:none;" : ""?>"></i>
                            </div>
                            <?php endfor; ?>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php 
                        if($data[0]->adim_sira_numarasi == 4 && $siparis->siparis_ust_satis_onayi == 0 && (aktif_kullanici()->kullanici_id == 37 || aktif_kullanici()->kullanici_id == 8)){
                          ?><button type="button" style="height: 47px;padding-top: 13px;border: 1px solid #5b4002;font-weight: 400!important;opacity:0.5" class="btn btn-danger btn-xs"><b>ONAY BEKLENİYOR</b></button><?php
                        }else{
                          ?><a type="button" style="height: 47px;padding-top: 13px;border: 1px solid #5b4002;font-weight: 400!important;" onclick="showWindow2('<?=$link?>');" class="btn btn-warning btn-xs"><i class="fas fa-search" style="font-size:14px" aria-hidden="true"></i> <b>GÖRÜNTÜLE</b></a><?php
                        }
                        ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Henüz sipariş bulunmamaktadır.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .siparis-tabs-container {
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
  }

  .siparis-tabs-container::-webkit-scrollbar {
    height: 5px;
  }

  .siparis-tabs-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .siparis-tabs-container::-webkit-scrollbar-thumb {
    background: #001657;
    border-radius: 10px;
  }

  .siparis-tabs-container::-webkit-scrollbar-thumb:hover {
    background: #002a7a;
  }

  .siparis-tab {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    user-select: none;
    position: relative;
  }

  .siparis-tab::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background-color: rgba(255, 255, 255, 0);
    transition: all 0.25s ease;
  }

  .siparis-tab:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
  }

  .siparis-tab:hover::before {
    background-color: rgba(255, 255, 255, 0.4);
  }

  .siparis-tab:active {
    transform: translateY(1px);
  }

  .siparis-tab:hover i {
    transform: scale(1.1);
    transition: transform 0.25s ease;
  }

  .siparis-tab:hover span {
    font-weight: 600;
    transition: font-weight 0.25s ease;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .siparis-tab {
      padding: 8px 14px !important;
      font-size: 12px !important;
    }
    
    .siparis-tab i {
      font-size: 12px !important;
    }
  }

  @media (max-width: 576px) {
    .siparis-tab {
      padding: 8px 12px !important;
      font-size: 11px !important;
    }
    
    .siparis-tab span {
      display: none;
    }
    
    .siparis-tab i {
      font-size: 14px !important;
    }
  }
</style>

<script type="text/javascript">
  $(document).ready(function() {
    // DataTables başlatma
    if($('#onaybekleyensiparisler').length) {
      if($.fn.DataTable.isDataTable('#onaybekleyensiparisler')) {
        $('#onaybekleyensiparisler').DataTable().destroy();
      }
      
      $('#onaybekleyensiparisler').DataTable({
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tümü"]],
        "scrollX": true,
        "searching": true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
          "search": "Ara:",
          "lengthMenu": "Sayfa başına _MENU_ kayıt göster",
          "info": "Toplam _TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
          "infoEmpty": "Kayıt bulunamadı",
          "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
          "zeroRecords": "Eşleşen kayıt bulunamadı",
          "processing": "İşleniyor..."
        },
        "order": [[0, "desc"]],
        "columnDefs": [
          { "orderable": true, "targets": [0, 1, 2, 3, 4] },
          { "orderable": false, "targets": [5] }
        ]
      });
    }
  });
</script>

