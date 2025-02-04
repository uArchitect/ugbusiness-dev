<div class="content-wrapper" style="margin-top:-1px;background:#ffffff;padding-top:10px">
  <section class="content text-md">
    <div class="row">
      <?php 
      $days = [
        'Pazartesi' => $day1, 
        'Salı' => $day2, 
        'Çarşamba' => $day3, 
        'Perşembe' => $day4, 
        'Cuma' => $day5,
        'Cuma' => $day6,
        'Cuma' => $day7
      ];
      foreach ($days as $dayName => $dayData): ?>
        <div class="col">
          <div class="card card-dark">
            <div class="card-header">
              <?= $dayName ?>
            </div>
            <div class="card-body">
              <div class="timeline" style="margin-bottom:0px">
                <div style="margin-right: 0px;">
                  <?php if (!empty($dayData)) foreach ($dayData as $value): ?>
                    <div class="timeline-item mb-2">
                      <h3 class="timeline-header" style="background:#e3e3e3a6">
                        <a href="<?= base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))) ?>">
                          <?= ($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>" : $value->merkez_adi ?>
                        </a>
                      </h3>
                      <div class="timeline-body text-xs">
                        <span style="font-weight:bold">Kurulum : <?= date("d.m.Y", strtotime($value->kurulum_tarihi)) ?></span><br>
                        <?= ($value->merkez_adresi == "0" || $value->merkez_adresi == "") 
                          ? "<span class='badge bg-warning'>Merkez Adresi Girilmedi</span><br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>"
                          : $value->merkez_adresi."<br><span style='opacity:0.6'>".$value->ilce_adi." / ".$value->sehir_adi."</span>" 
                        ?>
                        <br><br>
                        <?php foreach (get_siparis_urunleri($value->siparis_id) as $ur): ?>
                          <b><?= $ur->urun_adi ?></b><br><?= $ur->seri_numarasi ?><br>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</div>
