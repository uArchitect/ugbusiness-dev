 <!-- Container -->
 <div class="container-fixed" id="content_container">
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
       <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">
         Yeni Talep Oluştur
        </h1>
        <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
         Yeni müşteri talebi oluşturmak için aşağıdaki formu doldurunuz.
        </div>
       </div>
       <div class="flex items-center gap-2.5">
        <a href="<?=base_url("ugajans_talep")?>" class="btn btn-light">
         <i class="ki-filled ki-arrow-left"></i>
         Taleplere Dön
        </a>
       </div>
      </div>
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="grid grid-cols-1 gap-5 lg:gap-7.5">
        <div class="col-span-1">
          <form action="<?=base_url("ugajans_talep/talep_ekle")?>" method="post">
            <div class="card pb-2.5">
              <div class="card-header">
                <h3 class="card-title text-primary">
                  Talep Bilgileri
                </h3>
              </div>
              <div class="card-body grid gap-5">
                <p class="text-2sm text-gray-600">
                  <i class="ki-filled ki-information-2 leading-none"></i> 
                  Yeni talep oluşturmak için belirtilen tüm alanları doldurunuz. Görüşme sonucunun detaylı girilmesi daha sonraki süreçler için faydalı olacaktır.
                </p>
                
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
                  <label class="form-label max-w-25" style="max-width:120px">
                   Ad Soyad <span class="text-danger">*</span> :
                  </label>
                  <div class="grow">
                   <input class="input" name="talep_ad_soyad" placeholder="Müşteri Adı Soyadı" type="text" required>
                  </div>
                </div>
                
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
                  <label class="form-label max-w-25" style="max-width:120px">
                  İletişim <span class="text-danger">*</span> :
                  </label>
                  <div class="grow">
                   <input class="input" name="talep_iletisim_numarasi" placeholder="İletişim Numarası" type="text" required>
                  </div>
                </div>
                
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
                  <label class="form-label max-w-25" style="max-width:120px">
                  Email :
                  </label>
                  <div class="grow">
                   <input class="input" name="talep_email_adresi" placeholder="Email Adresi" type="email">
                  </div>
                </div>
                
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
                  <label class="form-label" style="max-width:120px">
                   Kaynak <span class="text-danger">*</span> :
                  </label>
                  <div class="grow">
                   <select class="select" name="talep_kaynak_no" required>
                      <option value="">Kaynak Seçiniz</option>
                      <?php 
                      $tkaynaklar = get_talep_kaynaklar();
                      foreach ($tkaynaklar as $tk) {
                      ?>
                      <option value="<?=$tk->ugajans_talep_kaynak_id?>">
                          <?=$tk->ugajans_talep_kaynak_adi?>
                      </option>
                      <?php } ?>
                   </select>
                  </div>
                </div>
                
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
                  <label class="form-label" style="max-width:120px">
                   Durum <span class="text-danger">*</span> :
                  </label>
                  <div class="grow">
                  <select class="select" name="talep_kategori_no" required>
                      <option value="">Durum Seçiniz</option>
                      <?php 
                      $tkategoriler = get_talep_kategoriler();
                      foreach ($tkategoriler as $tk) {
                      ?>
                      <option value="<?=$tk->talep_kategori_id?>">
                          <?=$tk->talep_kategori_adi?>
                      </option>
                      <?php } ?>
                   </select>
                  </div>
                </div>
                
                <div class="flex items-start flex-wrap lg:flex-nowrap gap-2.5">
                  <label class="form-label" style="max-width:120px">
                   Görüşme Detayları :
                  </label>
                  <div class="grow">
                 <textarea class="input" name="talep_gorusme_detaylari" style="height:150px" placeholder="Görüşme detaylarını buraya yazabilirsiniz..."></textarea>
                  </div>
                </div>
                
                <div class="flex justify-end gap-2 pt-2">
                  <a href="<?=base_url("ugajans_talep")?>" class="btn btn-light">
                   İptal
                  </a>
                  <button type="submit" class="btn btn-success">
                   <i class="ki-filled ki-check"></i>
                   Talep Oluştur
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
     </div>
     <!-- End of Container -->

