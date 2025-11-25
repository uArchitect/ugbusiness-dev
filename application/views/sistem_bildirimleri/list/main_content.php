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
                  <i class="fas fa-bell" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Sistem Bildirimleri
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Size gönderilen bildirimler ve onay durumları</small>
                </div>
              </div>
              <button type="button" 
                      id="tumunu-okudum-btn" 
                      class="btn btn-light btn-sm shadow-sm" 
                      style="border-radius: 8px; font-weight: 600; padding: 8px 16px;"
                      onclick="tumunuOkudumIsaretle()">
                <i class="fas fa-check-double mr-2"></i>
                Tümünü Okudum
              </button>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($bildirimler)): ?>
              <div class="table-responsive">
                <table id="bildirimTable" class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Tip</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Başlık</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Mesaj</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Gönderen</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Tarih</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Onay Durumu</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Okundu</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 150px;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($bildirimler as $bildirim): 
                      // Onay durumuna göre renk
                      if ($bildirim->onay_durumu == 'approved') {
                        $onay_class = 'success';
                        $onay_text = 'Onaylandı';
                      } elseif ($bildirim->onay_durumu == 'rejected') {
                        $onay_class = 'danger';
                        $onay_text = 'Reddedildi';
                      } else {
                        $onay_class = 'warning';
                        $onay_text = 'Beklemede';
                      }
                      
                      // Okunma durumu
                      $okundu_class = isset($bildirim->kullanici_okundu) && $bildirim->kullanici_okundu == 1 ? 'success' : 'secondary';
                      $okundu_text = isset($bildirim->kullanici_okundu) && $bildirim->kullanici_okundu == 1 ? 'Okundu' : 'Okunmadı';
                    ?>
                    <tr class="bildirim-row <?php echo isset($bildirim->kullanici_okundu) && $bildirim->kullanici_okundu == 0 ? 'unread' : ''; ?>" style="transition: all 0.2s ease;">
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <span class="badge badge-info" style="font-size: 12px; padding: 6px 12px;">
                          <i class="fas fa-tag mr-1"></i><?=htmlspecialchars($bildirim->tip_adi)?>
                        </span>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <strong style="color: #495057; font-size: 15px;"><?=htmlspecialchars($bildirim->baslik)?></strong>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; color: #6c757d; font-size: 14px;">
                        <?php 
                        $mesaj = htmlspecialchars($bildirim->mesaj);
                        echo strlen($mesaj) > 100 ? substr($mesaj, 0, 100) . '...' : $mesaj;
                        ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <?php if(!empty($bildirim->gonderen_ad_soyad)): ?>
                          <div style="color: #495057; font-size: 14px;">
                            <i class="fa fa-user mr-1"></i><?=htmlspecialchars($bildirim->gonderen_ad_soyad)?>
                          </div>
                        <?php else: ?>
                          <span style="color: #6c757d; font-size: 13px; font-style: italic;">Sistem</span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <i class="far fa-calendar mr-1"></i>
                        <?=date('d.m.Y H:i', strtotime($bildirim->created_at))?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <span class="badge badge-<?=$onay_class?>" style="font-size: 12px; padding: 6px 12px;">
                          <?php if($bildirim->onay_durumu == 'approved'): ?>
                            <i class="fa fa-check mr-1"></i>
                          <?php elseif($bildirim->onay_durumu == 'rejected'): ?>
                            <i class="fa fa-times mr-1"></i>
                          <?php else: ?>
                            <i class="fa fa-clock mr-1"></i>
                          <?php endif; ?>
                          <?=$onay_text?>
                        </span>
                        <?php if(!empty($bildirim->onaylayan_ad_soyad) && $bildirim->onay_durumu != 'pending'): ?>
                          <br><small style="color: #6c757d; font-size: 11px;">
                            <i class="fa fa-user-check mr-1"></i><?=htmlspecialchars($bildirim->onaylayan_ad_soyad)?>
                          </small>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php if(isset($bildirim->kullanici_okundu) && $bildirim->kullanici_okundu == 1): ?>
                          <span class="badge badge-<?=$okundu_class?>" style="font-size: 12px; padding: 6px 12px;">
                            <i class="fa fa-check-circle mr-1"></i>
                            <?=$okundu_text?>
                          </span>
                        <?php else: ?>
                          <button type="button" 
                                  class="btn badge badge-<?=$okundu_class?> okundu-isaretle-btn" 
                                  style="font-size: 12px; padding: 6px 12px; border: none; cursor: pointer;"
                                  data-bildirim-id="<?=$bildirim->id?>"
                                  onclick="okunduIsaretle(<?=$bildirim->id?>, this)">
                            <i class="fa fa-circle mr-1"></i>
                            <?=$okundu_text?>
                          </button>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div class="btn-group" role="group" style="gap: 4px;">
                          <a href="<?=site_url("sistem_bildirimleri/detay/".$bildirim->id)?>" 
                             class="btn shadow-sm" 
                             style="border-radius: 5px; font-weight: 500; font-size: 11px; padding: 4px 10px; background-color: #007bff; color: #ffffff; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-eye" style="font-size: 10px;"></i> Detay
                          </a>
                          <?php if($bildirim->onay_durumu == 'pending' && $bildirim->gereken_onay_seviyesi > 0): ?>
                            <?php 
                            // Sipariş bildirimi kontrolü
                            $is_siparis_bildirimi = (!empty($bildirim->tip_adi) && $bildirim->tip_adi == 'Satış Bildirimi');
                            // Eski Parça Verilmedi Bildirimi kontrolü
                            $is_eski_parca_bildirimi = (!empty($bildirim->tip_adi) && $bildirim->tip_adi == 'Eski Parça Verilmedi Bildirimi');
                            
                            if (!$is_siparis_bildirimi && !$is_eski_parca_bildirimi): ?>
                              <!-- Normal Bildirim - Onayla/Reddet (Sipariş ve Eski Parça bildirimleri için buton gösterme, sadece Detay butonu yeterli) -->
                              <a href="<?=site_url("sistem_bildirimleri/onayla/".$bildirim->id)?>" 
                                 class="btn shadow-sm" 
                                 style="border-radius: 5px; font-weight: 500; font-size: 11px; padding: 4px 10px; background-color: #28a745; color: #ffffff; border: none;"
                                 onclick="event.stopPropagation(); return confirm('Bu bildirimi onaylamak istediğinize emin misiniz?');">
                                <i class="fas fa-check" style="font-size: 10px;"></i> Onayla
                              </a>
                              <a href="<?=site_url("sistem_bildirimleri/reddet/".$bildirim->id)?>" 
                                 class="btn shadow-sm" 
                                 style="border-radius: 5px; font-weight: 500; font-size: 11px; padding: 4px 10px; background-color: #dc3545; color: #ffffff; border: none;"
                                 onclick="event.stopPropagation(); return confirm('Bu bildirimi reddetmek istediğinize emin misiniz?');">
                                <i class="fas fa-times" style="font-size: 10px;"></i> Reddet
                              </a>
                            <?php endif; ?>
                          <?php endif; ?>
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
                  <i class="fas fa-bell" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz bildirim bulunmamaktadır.</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .bildirim-row {
    transition: all 0.2s ease;
  }

  .bildirim-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transform: translateY(-1px);
  }

  /* Okunmamış bildirimler için vurgu */
  .bildirim-row.unread {
    background-color: #e3f2fd;
    border-left: 4px solid #2196F3;
  }

  /* Tablo hover efekti */
  .table tbody tr {
    border-left: 3px solid transparent;
  }

  .table tbody tr:hover {
    border-left-color: #001657;
  }

  /* Buton hover efektleri */
  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
  }

  .btn-group .btn:hover {
    z-index: 1;
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

    .btn-group {
      display: flex;
      flex-direction: column;
    }

    .btn-group .btn {
      border-radius: 6px !important;
      margin-bottom: 5px;
      margin-left: 0 !important;
    }
  }
</style>

<script>
  // jQuery yüklendiğinden emin ol
  (function() {
    function initDataTable() {
      // jQuery ve DataTable yüklü mü kontrol et
      if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
        // DataTable initialization
        var table = $('#bildirimTable').DataTable({
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
          "order": [[4, "desc"]], // Tarih sütununa göre sıralama (en yeni önce)
          "columnDefs": [
            {
              "orderable": false,
              "targets": [7] // İşlem sütunu sıralanamaz
            }
          ]
        });

        // Satır tıklama ile detay sayfasına yönlendirme KALDIRILDI
        // Artık sadece "Detay" butonuna tıklayınca detaya gidilecek
      } else {
        // jQuery henüz yüklenmediyse, biraz bekle ve tekrar dene
        setTimeout(initDataTable, 100);
      }
    }

    // DOM yüklendiğinde başlat
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initDataTable);
    } else {
      // DOM zaten yüklenmişse
      initDataTable();
    }
  })();
  
  // Okundu işaretleme fonksiyonu
  function okunduIsaretle(bildirimId, btnElement) {
    // Butonu devre dışı bırak
    var $btn = $(btnElement);
    $btn.prop('disabled', true);
    
    $.ajax({
      url: '<?=site_url("sistem_bildirimleri/okundu_isaretle/")?>' + bildirimId,
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(response) {
        if(response && response.success) {
          // Butonu badge'e dönüştür
          $btn.replaceWith(
            '<span class="badge badge-success" style="font-size: 12px; padding: 6px 12px;">' +
            '<i class="fa fa-check-circle mr-1"></i>Okundu</span>'
          );
          
          // Satırın unread class'ını kaldır
          $btn.closest('tr').removeClass('unread');
        } else {
          // Sayfa yenileme durumunda (JSON değil HTML dönüyor olabilir)
          location.reload();
        }
      },
      error: function(xhr, status, error) {
        // Eğer HTML dönüyorsa (redirect olmuşsa) sayfayı yenile
        if(xhr.responseText && xhr.responseText.indexOf('<!DOCTYPE') !== -1) {
          location.reload();
        } else {
          alert('Bir hata oluştu. Lütfen tekrar deneyin.');
          $btn.prop('disabled', false);
        }
      }
    });
  }
  
  // Tümünü okudum işaretleme fonksiyonu
  function tumunuOkudumIsaretle() {
    if (!confirm('Tüm bildirimleri okundu olarak işaretlemek istediğinize emin misiniz?')) {
      return;
    }
    
    var $btn = $('#tumunu-okudum-btn');
    var originalHtml = $btn.html();
    $btn.prop('disabled', true);
    $btn.html('<i class="fas fa-spinner fa-spin mr-2"></i>İşleniyor...');
    
    $.ajax({
      url: '<?=site_url("sistem_bildirimleri/tumunu_okundu_isaretle")?>',
      type: 'POST',
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(response) {
        if(response && response.success) {
          // Başarı mesajı göster
          alert(response.message || (response.count + ' bildirim okundu olarak işaretlendi.'));
          
          // Sayfayı yenile
          location.reload();
        } else {
          alert('Bir hata oluştu. Lütfen tekrar deneyin.');
          $btn.prop('disabled', false);
          $btn.html(originalHtml);
        }
      },
      error: function(xhr, status, error) {
        // Eğer HTML dönüyorsa (redirect olmuşsa) sayfayı yenile
        if(xhr.responseText && xhr.responseText.indexOf('<!DOCTYPE') !== -1) {
          location.reload();
        } else {
          alert('Bir hata oluştu. Lütfen tekrar deneyin.');
          $btn.prop('disabled', false);
          $btn.html(originalHtml);
        }
      }
    });
  }
</script>

