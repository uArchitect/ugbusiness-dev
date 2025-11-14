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
                  <i class="fas fa-sms" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    SMS Metinleri
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">SMS şablonlarını yönetin ve düzenleyin</small>
                </div>
              </div>
              <button type="button" class="btn btn-light btn-sm shadow-sm" data-toggle="modal" data-target="#smsTemplateModal" onclick="openAddModal()" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus"></i> Yeni Şablon
              </button>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            
            <?php if (!empty($sms_templates)): ?>
              <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Şablon Adı</th>
                      <th style="font-weight: 600; padding: 15px 10px;">SMS Metni</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Durum</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Oluşturulma</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 140px;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($sms_templates as $template): ?>
                    <tr class="sms-template-row" style="cursor: pointer; transition: all 0.2s ease;" data-template-id="<?= $template->id ?>">
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <strong style="color: #495057; font-size: 15px;"><?= htmlspecialchars($template->title) ?></strong>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; color: #6c757d; font-size: 14px;">
                        <?php 
                          $message = htmlspecialchars($template->message);
                          echo strlen($message) > 100 ? substr($message, 0, 100) . '...' : $message;
                        ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php if ($template->is_active == 1): ?>
                          <span class="badge" style="font-size: 13px; padding: 8px 14px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;">Aktif</span>
                        <?php else: ?>
                          <span class="badge" style="font-size: 13px; padding: 8px 14px; background-color: #6c757d; color: #ffffff; border-radius: 6px; font-weight: 500;">Pasif</span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <?= date("d.m.Y H:i", strtotime($template->created_at)) ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <a href="<?= base_url('sms_templates/edit/'.$template->id) ?>" 
                           class="btn btn-sm shadow-sm" 
                           style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #ffc107; color: #856404; border: none;"
                           onclick="event.stopPropagation();">
                          <i class="fas fa-edit"></i> 
                        </a>
                        <a href="<?= base_url('sms_templates/delete/'.$template->id) ?>" 
                           class="btn btn-sm shadow-sm ml-1" 
                           style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border: none;"
                           onclick="event.stopPropagation(); return confirm('Bu şablonu silmek istediğinize emin misiniz?');">
                          <i class="fas fa-trash"></i> 
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-5">
                <div class="mb-3">
                  <i class="fas fa-sms" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz SMS şablonu bulunmamaktadır.</p>
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#smsTemplateModal" onclick="openAddModal()" style="border-radius: 8px;">
                  <i class="fas fa-plus"></i> İlk Şablonu Ekle
                </button>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- SMS Template Modal -->
<div class="modal fade" id="smsTemplateModal" tabindex="-1" role="dialog" aria-labelledby="smsTemplateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); color: white; border-radius: 12px 12px 0 0;">
        <h5 class="modal-title" id="smsTemplateModalLabel" style="font-weight: 700;">
          <i class="fas fa-sms mr-2"></i> SMS Şablonu
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="smsTemplateForm" action="<?= base_url('sms_templates/save') ?>" method="POST">
        <div class="modal-body" style="padding: 25px;">
          <input type="hidden" id="template_id" name="id" value="<?= isset($template) ? $template->id : '' ?>">
          
          <div class="form-group">
            <label for="template_title" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
              <i class="fas fa-heading mr-2"></i> Şablon Adı <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" id="template_title" name="title" value="<?= isset($template) ? htmlspecialchars($template->title) : '' ?>" placeholder="Örn: Doğum Günü Tebrik Mesajı" required style="border-radius: 8px; padding: 10px 15px; border: 1px solid #dee2e6;">
            <small class="form-text text-muted">Şablonu tanımlamak için bir isim verin</small>
          </div>

          <div class="form-group">
            <label for="template_message" style="font-weight: 600; color: #495057; margin-bottom: 8px;">
              <i class="fas fa-comment-alt mr-2"></i> SMS Metni <span class="text-danger">*</span>
            </label>
            <textarea class="form-control" id="template_message" name="message" rows="6" placeholder="SMS metnini buraya yazın..." required style="border-radius: 8px; padding: 10px 15px; border: 1px solid #dee2e6; resize: vertical;"><?= isset($template) ? htmlspecialchars($template->message) : '' ?></textarea>
            <small class="form-text text-muted">
              <span id="charCount">0</span> karakter (SMS limiti: 160 karakter)
            </small>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="template_is_active" name="is_active" value="1" <?= (isset($template) && $template->is_active == 1) || !isset($template) ? 'checked' : '' ?>>
              <label class="form-check-label" for="template_is_active" style="font-weight: 500; color: #495057;">
                <i class="fas fa-check-circle mr-2"></i> Aktif
              </label>
              <small class="form-text text-muted d-block">Aktif şablonlar SMS gönderiminde kullanılabilir</small>
            </div>
          </div>

          <div id="formErrors" class="alert alert-danger" style="display: none; border-radius: 8px;"></div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding: 15px 25px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 500;">
            <i class="fas fa-times mr-2"></i> İptal
          </button>
          <button type="submit" class="btn btn-primary" style="border-radius: 8px; font-weight: 500; background: linear-gradient(135deg, #001657 0%, #001657 100%); border: none;">
            <i class="fas fa-save mr-2"></i> Kaydet
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Karakter sayacı
document.getElementById('template_message').addEventListener('input', function() {
  const charCount = this.value.length;
  document.getElementById('charCount').textContent = charCount;
  
  if (charCount > 160) {
    document.getElementById('charCount').style.color = '#dc3545';
    document.getElementById('charCount').parentElement.style.color = '#dc3545';
  } else {
    document.getElementById('charCount').style.color = '#6c757d';
    document.getElementById('charCount').parentElement.style.color = '#6c757d';
  }
});

// Sayfa yüklendiğinde karakter sayısını güncelle
document.addEventListener('DOMContentLoaded', function() {
  const messageField = document.getElementById('template_message');
  if (messageField && messageField.value) {
    const charCount = messageField.value.length;
    document.getElementById('charCount').textContent = charCount;
    if (charCount > 160) {
      document.getElementById('charCount').style.color = '#dc3545';
    }
  }
});

// Modal açıldığında formu temizle
function openAddModal() {
  document.getElementById('smsTemplateForm').reset();
  document.getElementById('template_id').value = '';
  document.getElementById('template_is_active').checked = true;
  document.getElementById('smsTemplateModalLabel').innerHTML = '<i class="fas fa-plus mr-2"></i> Yeni SMS Şablonu';
  document.getElementById('charCount').textContent = '0';
  document.getElementById('formErrors').style.display = 'none';
}

// Düzenleme modunda modal aç
<?php if (isset($template)): ?>
$(document).ready(function() {
  setTimeout(function() {
    $('#smsTemplateModal').modal('show');
    document.getElementById('smsTemplateModalLabel').innerHTML = '<i class="fas fa-edit mr-2"></i> SMS Şablonu Düzenle';
  }, 100);
});
<?php endif; ?>

// Satır tıklama ile düzenleme sayfasına yönlendirme
document.addEventListener('DOMContentLoaded', function() {
  const rows = document.querySelectorAll('.sms-template-row');
  rows.forEach(row => {
    row.addEventListener('click', function(e) {
      // Buton tıklamalarını hariç tut
      if (e.target.closest('a, button')) {
        return;
      }
      const templateId = row.getAttribute('data-template-id');
      if (templateId) {
        window.location.href = '<?= base_url("sms_templates/edit/") ?>' + templateId;
      }
    });
  });
});

// Modal kapandığında formu temizle ve yönlendir
$('#smsTemplateModal').on('hidden.bs.modal', function () {
  <?php if (!isset($template)): ?>
  document.getElementById('smsTemplateForm').reset();
  document.getElementById('formErrors').style.display = 'none';
  <?php else: ?>
  window.location.href = '<?= base_url("sms_templates") ?>';
  <?php endif; ?>
});
</script>

<style>
  .sms-template-row {
    transition: all 0.2s ease;
  }

  .sms-template-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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

  .modal-content {
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
  }

  .form-control:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
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

