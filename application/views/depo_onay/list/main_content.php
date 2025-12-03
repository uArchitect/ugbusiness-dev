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
                  <i class="fas fa-warehouse" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Depo Malzeme Çıkış Talepleri
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Depo onay süreçleri ve takibi</small>
                </div>
              </div>
              <a href="<?=base_url("depo_onay/talep_olustur")?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus"></i> Yeni Talep Oluştur
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($talepler)): ?>
              <div class="table-responsive">
                <table id="depoOnayTable" class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Talep Oluşturan</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Talep Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Ön Onay</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Depo Çıkış Onayı</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Teslim Alındı Onayı</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 130px;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($talepler as $d): 
                      // Durum belirleme
                      $row_class = '';
                      if($d->kayit_durum == 0) {
                        $row_class = 'cancelled';
                      } elseif($d->teslim_alma_onayi == 1) {
                        $row_class = 'completed';
                      } elseif($d->birinci_onay_durumu == 1) {
                        $row_class = 'approved';
                      } elseif($d->on_onay_durumu == 1) {
                        $row_class = 'pending';
                      } else {
                        $row_class = 'waiting';
                      }
                      
                      // İade bekleniyor kontrolü
                      $iade_bekleniyor = isset($d->iade_bekleniyor) && $d->iade_bekleniyor === true;
                      if($iade_bekleniyor) {
                        $row_class .= ' iade-bekleniyor-row';
                      }
                    ?>
                    <tr class="depo-row <?php echo $row_class; ?>" style="cursor: pointer; transition: all 0.2s ease; <?php echo $iade_bekleniyor ? 'background-color: #fff5f5 !important; border-left: 4px solid #dc3545 !important;' : ''; ?>">
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <?php if($iade_bekleniyor): ?>
                        <div style="margin-bottom: 10px;">
                          <span class="badge" style="
                            font-size: 12px; 
                            padding: 8px 16px; 
                            background-color: #dc3545 !important; 
                            color: #ffffff !important; 
                            border-radius: 6px; 
                            font-weight: 700;
                            display: inline-flex;
                            align-items: center;
                            gap: 6px;
                          ">
                            <i class="fas fa-exclamation-triangle"></i>
                            İADE BEKLENİYOR (<?=isset($d->iade_bekleyen_sayisi) ? $d->iade_bekleyen_sayisi : 0?> ürün)
                          </span>
                        </div>
                        <?php endif; ?>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                          <i class="fas fa-user" style="color: #6c757d; font-size: 14px;"></i>
                          <strong style="color: #495057; font-size: 14px;"><?=$d->kayit_kullanici_ad_soyad?></strong>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
                          <i class="fas fa-hand-holding" style="color: #28a745; font-size: 12px;"></i>
                          <span style="color: #28a745; font-size: 13px; font-weight: 600;"><?=$d->teslim_kullanici_ad_soyad?> - Teslim Alacak</span>
                        </div>
                        <button class="btn goster" data-id="<?=$d->stok_onay_id?>" style="
                          background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                          color: #ffffff;
                          border: none;
                          border-radius: 8px;
                          font-size: 14px;
                          font-weight: 600;
                          padding: 8px 16px;
                          margin-top: 5px;
                          box-shadow: 0 3px 8px rgba(0, 123, 255, 0.3);
                          transition: all 0.3s ease;
                          display: inline-flex;
                          align-items: center;
                          gap: 8px;
                        " onclick="event.stopPropagation();">
                          <i class="fas fa-eye" style="font-size: 16px;"></i> Ürünleri Göster
                        </button>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                          <i class="far fa-calendar-alt" style="color: #6c757d; font-size: 14px;"></i>
                          <span style="color: #495057; font-size: 14px;"><?=date("d.m.Y H:i",strtotime($d->talep_olusturulma_tarihi))?></span>
                        </div>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php 
                        if($d->kayit_durum == 0){
                          echo '<span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">İPTAL EDİLDİ</span>';
                        } else {
                          if($d->on_onay_durumu == 0){
                        ?>
                          <a onclick="confirm_action('Ön Onay İşlemi','Seçilen bu talebe ön onay vermek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/on_onay/').$d->stok_onay_id ?>');" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #ffc107; color: #856404; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-check-circle"></i> Onayla
                          </a>
                        <?php
                          } else {
                        ?>
                          <span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;">
                            <i class="fas fa-check"></i> Ön Onay Verildi
                          </span>
                        <?php
                          }
                        }
                        ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php 
                        if($d->kayit_durum == 0){
                          echo '<span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">İPTAL EDİLDİ</span>';
                        } else {
                          if($d->on_onay_durumu == 0){
                        ?>
                          <span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">Ön Onay Bekleniyor</span>
                        <?php
                          } else {
                            if($d->birinci_onay_durumu == 0){
                        ?>
                          <a href="<?=base_url('depo_onay/update/').$d->stok_onay_id ?>" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #ffc107; color: #856404; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-check-circle"></i> Onayla
                          </a>
                        <?php
                            } else {
                        ?>
                          <a href="<?=base_url('depo_onay/birinci_onay_iptal/').$d->stok_onay_id ?>" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #28a745; color: #ffffff; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-check"></i> Onay Verildi
                          </a>
                        <?php
                            }
                          }
                        }
                        ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php 
                        if($d->kayit_durum == 0){
                          echo '<span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">İPTAL EDİLDİ</span>';
                        } else {
                          if($d->birinci_onay_durumu == 0){
                        ?>
                          <span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">Çıkış Onayı Bekleniyor</span>
                        <?php
                          } else {
                            if($d->teslim_alma_onayi == 0){
                        ?>
                          <a onclick="confirm_action('Teslim Onayı','Seçilen bu talebe (teslim aldım) onayı vermek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/teslim_onay/').$d->stok_onay_id ?>');" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #ffc107; color: #856404; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-check-circle"></i> Onayla
                          </a>
                        <?php
                            } else {
                        ?>
                          <span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;">
                            <i class="fas fa-check"></i> Teslim Alındı
                          </span>
                        <?php
                            }
                          }
                        }
                        ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                          <?php 
                          if($d->kayit_durum == 0){
                          ?>
                            <a type="button" 
                               onclick="confirm_action('Aktifleştirme İşlemi','Seçilen bu talebi aktif etmek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/aktif/').$d->stok_onay_id ?>');" 
                               class="btn btn-sm btn-dark shadow-sm" 
                               style="border-radius: 6px; font-weight: 500; padding: 6px 12px; width: 100%;"
                               onclick="event.stopPropagation();">
                              <i class="fas fa-eye"></i> Aktifleştir
                            </a>
                          <?php
                          } else {
                          ?>
                            <a type="button" 
                               onclick="confirm_action('İptal İşlemi','Seçilen bu talebi iptal etmek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/sil/').$d->stok_onay_id ?>');" 
                               class="btn btn-sm btn-danger shadow-sm" 
                               style="border-radius: 6px; font-weight: 500; padding: 6px 12px; width: 100%; margin-bottom: 5px;"
                               onclick="event.stopPropagation();">
                              <i class="fas fa-times"></i> İptal Et
                            </a>
                            <a href="<?=base_url('depo_onay/update/').$d->stok_onay_id?>" 
                               class="btn btn-sm btn-primary shadow-sm" 
                               style="border-radius: 6px; font-weight: 500; padding: 6px 12px; width: 100%;"
                               onclick="event.stopPropagation();">
                              <i class="fas fa-edit"></i> Düzenle
                            </a>
                          <?php
                          }
                          ?>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-5">
                <div class="mb-3">
                  <i class="fas fa-warehouse" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz depo talep kaydı bulunmamaktadır.</p>
                <a href="<?=base_url("depo_onay/talep_olustur")?>" class="btn btn-primary mt-3" style="border-radius: 8px;">
                  <i class="fas fa-plus"></i> İlk Talebi Oluştur
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .depo-row {
    transition: all 0.2s ease;
  }

  .depo-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Duruma göre arka plan renkleri */
  .depo-row.waiting {
    background-color: #fff7e6;
  }
  
  .depo-row.pending {
    background-color: #e6f3ff;
  }
  
  .depo-row.approved {
    background-color: #e6ffe6;
  }
  
  .depo-row.completed {
    background-color: #f0fff0;
  }
  
  .depo-row.cancelled {
    background-color: #ffeaea;
  }

  /* İade bekleniyor satırı - Kırmızı vurgu */
  .depo-row.iade-bekleniyor-row {
    background-color: #fff5f5 !important;
    border-left: 4px solid #dc3545 !important;
    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2) !important;
  }

  .depo-row.iade-bekleniyor-row:hover {
    background-color: #ffeaea !important;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3) !important;
  }

  /* Tablo hover efekti */
  .table tbody tr {
    border-left: 3px solid transparent;
  }

  .table tbody tr:hover {
    border-left-color: #0066ff;
  }

  .table tbody tr.iade-bekleniyor-row:hover {
    border-left-color: #dc3545 !important;
  }

  /* Buton hover efektleri */
  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
  }

  /* Ürünleri Göster butonu özel stilleri */
  .goster {
    position: relative;
    overflow: hidden;
  }

  .goster:hover {
    background: linear-gradient(135deg, #0056b3 0%, #004085 100%) !important;
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 6px 16px rgba(0, 123, 255, 0.4) !important;
  }

  .goster:active {
    transform: translateY(0) scale(0.98);
    box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3) !important;
  }

  .goster i {
    transition: transform 0.3s ease;
  }

  .goster:hover i {
    transform: scale(1.2);
  }

  /* Swal popup genişliği */
  .swal2-popup {
    width: auto !important;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .table {
      font-size: 13px;
    }
    
    .table th,
    .table td {
      padding: 10px 5px !important;
    }
  }
</style>

<script src="<?=base_url("assets/")?>plugins/jquery/jquery.min.js"></script>
            
<script>
$(document).ready(function(){
    $('.goster').on('click', function(e){
        e.stopPropagation();
        var numara = $(this).data('id');

        $.ajax({
            url: '<?= base_url("depo_onay/get_detaylar") ?>',
            method: 'POST',
            data: { numara: numara },
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    let html = `<div style="display: flex; flex-direction: column; gap: 20px;">`;

                    response.data.forEach(function(item, index){
                        // İade durumu belirleme
                        let iadeDurum = '';
                        let iadeDurumClass = '';
                        let iadeDurumIcon = '';
                        
                        if(item.eski_parca_alınacak == 1) {
                            if(item.eski_parca_alindi == 1) {
                                iadeDurum = 'İade Alındı';
                                iadeDurumClass = 'badge-success';
                                iadeDurumIcon = 'fa-check-circle';
                            } else {
                                iadeDurum = 'İade Bekleniyor';
                                iadeDurumClass = 'badge-danger';
                                iadeDurumIcon = 'fa-exclamation-circle';
                            }
                        }
                        
                        html += `
                        <div style="
                            background: linear-gradient(90deg, #f1f3f5, #ffffff);
                            border-radius: 10px;
                            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
                            padding: 20px;
                            width: 100%;
                            font-family: 'Segoe UI', sans-serif;
                            border-left: 5px solid ${item.eski_parca_alınacak == 1 && item.eski_parca_alindi == 0 ? '#dc3545' : '#007bff'};
                        ">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div style="font-size: 18px; font-weight: bold; color:#343a40;">
                                    ${item.stok_tanim_ad} → ${item.stok_talep_edilen_malzeme_miktar} Adet
                                </div>
                                ${iadeDurum ? `
                                <span class="badge ${iadeDurumClass}" style="
                                    font-size: 12px; 
                                    padding: 8px 16px; 
                                    border-radius: 6px; 
                                    font-weight: 600;
                                    ${iadeDurumClass == 'badge-danger' ? 'background-color: #dc3545 !important; color: #ffffff !important;' : 'background-color: #28a745 !important; color: #ffffff !important;'}
                                ">
                                    <i class="fas ${iadeDurumIcon} mr-1"></i>${iadeDurum}
                                </span>
                                ` : ''}
                            </div>
                            ${item.eski_parca_alınacak == 1 ? `
                            <div style="margin-top: 10px; padding: 10px; background-color: ${item.eski_parca_alindi == 0 ? '#fff5f5' : '#f0fff0'}; border-radius: 6px; border-left: 3px solid ${item.eski_parca_alindi == 0 ? '#dc3545' : '#28a745'};">
                                <div style="font-size: 13px; color: #495057;">
                                    <strong>Eski Parça:</strong> ${item.eski_parca_alindi == 1 ? 'Alındı' : 'Bekleniyor'}
                                    ${item.eski_parca_alindi_tarih ? `<br><small style="color: #6c757d;">Alındı Tarihi: ${new Date(item.eski_parca_alindi_tarih).toLocaleString('tr-TR')}</small>` : ''}
                                </div>
                            </div>
                            ` : ''}
                            ${item.urun_ariza_aciklama ? `
                            <div style="margin-top: 10px; padding: 10px; background-color: #fff9e6; border-radius: 6px;">
                                <div style="font-size: 13px; color: #856404;">
                                    <strong><i class="fas fa-exclamation-triangle mr-1"></i>Arıza Açıklaması:</strong><br>
                                    ${item.urun_ariza_aciklama}
                                </div>
                            </div>
                            ` : ''}
                        </div>`;
                    });

                    html += `</div>`;

                    Swal.fire({
                        title: 'Malzeme Detayları',
                        html: html,
                        width: '800px',
                        confirmButtonText: 'Kapat',
                        showCancelButton: true,
                        cancelButtonText: 'Düzenle',
                        cancelButtonColor: '#007bff',
                        customClass: {
                            popup: 'scrollable-popup'
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                            window.location.href = '<?= base_url("depo_onay/update/") ?>' + numara;
                        }
                    });
                } else {
                    Swal.fire('Hata', 'Veri bulunamadı.', 'error');
                }
            }
        });
    });

    // DataTable initialization
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
        $('#depoOnayTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 25,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
            },
            "order": [], // Controller'dan gelen sıralamayı koru (son eklenen en başta)
            "columnDefs": [
                {
                    "orderable": false,
                    "targets": [5] // İşlem sütunu sıralanamaz
                },
                {
                    "type": "date",
                    "targets": [1] // Talep Tarihi sütunu tarih tipinde
                }
            ]
        });
    }
});
</script>
