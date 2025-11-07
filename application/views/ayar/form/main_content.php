 
 <div class="content-wrapper pt-2">
  <div class="row">
    <form action="<?=base_url("ayar/save/$ayar->ayar_id")?>" style="    display: contents;" method="post">
    <section class="content col-md-6"> 
    <div class="col">
            <div class="card card-dark card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" style="border-bottom:0" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Sistem Parametreleri</h3></li>
                   
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false"><i class="fas fa-sms nav-icon text-default" style="font-size:13px"></i> SMS Şablonları</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fas fa-link nav-icon text-default" style="font-size:13px"></i> NetGSM Entegrasyonu</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false"><i class="fas fa-envelope nav-icon text-default" style="font-size:13px"></i> Mail Parametreleri</a>
                  </li>
                
 
                </ul>
              </div>
              <div class="card-body p-0">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  
                  <div class="tab-pane fade " id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                  <img src="<?=base_url("assets/dist/img/mailicon.png")?>" style="border-bottom: 10px solid #00283d;margin:auto;width:100%;display:block;height: 250px;object-fit: cover;">
               
                  <div class="row mt-2 m-2">
                  <div class="col-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mail Gönderici Adı :</label>
                        <input type="text" name="mail_gonderici_adi" class="form-control" id="exampleInputEmail1" value="<?=$ayar->mail_gonderici_adi?>" placeholder="Mail Gönderici Bilgisini Giriniz">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mail Server (Smtp Host) :</label>
                        <input type="text" name="mail_host" class="form-control" id="exampleInputEmail1" value="<?=$ayar->mail_host?>" placeholder="Mail Server Bilgisini Giriniz">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kullanıcı Adı (Email Adresi / Smtp User) :</label>
                        <input type="text" name="mail_kullanici_adi" class="form-control" id="exampleInputEmail1" value="<?=$ayar->mail_kullanici_adi?>" placeholder="Mail Adresinizi Giriniz">
                      </div>
                    </div>
                  </div>
                  <div class="row m-2">
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Şifre (Email Şifresi / Smtp Pass) :</label>
                        <input type="text" name="mail_sifre" class="form-control" id="exampleInputEmail1" value="<?=$ayar->mail_sifre?>" placeholder="Mail Kullanıcı Şifresini Giriniz">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Port Numarası (Smtp Port) :</label>
                        <input type="text" name="mail_port" class="form-control" id="exampleInputEmail1" value="<?=$ayar->mail_port?>" placeholder="Mail Smtp Portunu Giriniz">
                      </div>
                    </div>
                  </div>

                  <div class="row m-2">
                    <div class="col">
                    <div class="callout callout-warning" style="border-left-color:#5588dd !important;">
                      <h5><img src="<?=base_url("assets/dist/img/google-logo.png")?>" height="20"> Smtp Bilgileri</h5>
                      <p><b>Host :</b> smtp.gmail.com <b style="margin-left:10px">Port :</b> 587/465 </p>
                    </div>
                    </div>
                  </div>
                  
                  
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                     
                  <img src="<?=base_url("assets/dist/img/netgsm.jpg")?>" style="border-bottom: 10px solid #00283d;margin:auto;width:100%;display:block;height: 250px;object-fit: cover;">
               
                  <div class="row mt-2 m-2">
                  <div class="col">
                    <div class="form-group">
                      <label for="exampleInputEmail1">NetGSM Kullanıcı Adı :</label>
                      <input type="text" name="netgsm_kullanici_ad" value="<?=$ayar->netgsm_kullanici_ad?>" class="form-control" id="exampleInputEmail1" placeholder="NetGSM Kullanıcı Adını Giriniz">
                    </div>
                  </div>
                  <div class="col">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NetGSM Kullanıcı Şifresi :</label>
                    <input type="text" name="netgsm_kullanici_sifre" class="form-control" id="exampleInputEmail1" value="<?=base64_decode($ayar->netgsm_kullanici_sifre)?>" placeholder="NetGSM Kullanıcı Şifresini Giriniz">
                  </div>
                  </div>
                </div>
                
                 <div class="row m-2">
                  <div class="col">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NetGSM SMS Başlığı :</label>
                    <input type="text"  name="netgsm_sms_baslik" value="<?=$ayar->netgsm_sms_baslik?>" class="form-control" id="exampleInputEmail1" placeholder="NetGSM SMS Başlığını Giriniz">
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    </p>

                    
                    <div class="callout callout-danger"  >
                    Bu sistemde sms entegrasyonu için NetGSM firması tercih edilmiş ve NetGSM'nin yayınlamış olduğu dökümantasyona göre geliştirme sağlanmıştır. SMS başlıklarınızı NetGSM yönetim paneli üzerinden görüntüleyebilirsiniz. NetGSM dökümanlarını görüntülemek için <a href="https://www.netgsm.com.tr/dokuman/#api-dok%C3%BCman%C4%B1" target="_blank">tıklayınız.</a>
                       </div>
                  
                  </div>
                  </div>
                 </div>

                  </div>
                  <div class="tab-pane fade active show" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                 
                  <img src="<?=base_url("assets/dist/img/smstemplate.jpg")?>" style="border-bottom: 10px solid #00283d;margin:auto;width:100%;display:block;height: 250px;object-fit: cover;">
               
                  <div class="form-group  m-3">
                    <label for="exampleInputEmail1">Sorumluya Onaya Giden İstek Bildirim SMS Şablonu :</label>
                    <textarea id="summernotesms" name="istek_onay_bekleniyor_sms" id="istek_onay_bekleniyor_sms" class="form-control" placeholder="Sorumluya Onaya Giden İstek Bildirim SMS Şablonunu giriniz."><?=$ayar->istek_onay_bekleniyor_sms?></textarea>
                     
                    <div class="btn-group" style="width: 100%;">
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms').summernote('pasteHTML', '[kullanici_ad]');"> [kullanici_ad_soyad]</button> 
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms').summernote('pasteHTML', '[istek_kodu]');"> [istek_kodu]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms').summernote('pasteHTML', '[istek_tarihi]');"> [istek_tarihi]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms').summernote('pasteHTML', '[guncel_tarih]');"> [guncel_tarih]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms').summernote('pasteHTML', '[sorumlu_ad]');"> [sorumlu_ad_soyad]</button> 
                     </div>
               
               
                  </div>   

                  <div class="form-group m-3">
                    <label for="exampleInputEmail1">İstek Onaylandıktan Sonra Kullanıcıya Gönderilecek SMS Şablonu :</label>
                    <textarea id="summernotesms2" name="istek_onaylandi_sms" id="istek_onaylandi_sms" class="form-control" placeholder="Sorumluya Onaya Giden İstek Bildirim SMS Şablonunu giriniz."><?=$ayar->istek_onaylandi_sms?></textarea>
                    <div class="btn-group" style="width: 100%;">
                    <button type="button" class="btn btn-default" onclick="$('#summernotesms2').summernote('pasteHTML', '[kullanici_ad]');"> [kullanici_ad_soyad]</button> 
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms2').summernote('pasteHTML', '[istek_kodu]');"> [istek_kodu]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms2').summernote('pasteHTML', '[istek_tarihi]');"> [istek_tarihi]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms2').summernote('pasteHTML', '[guncel_tarih]');"> [guncel_tarih]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms2').summernote('pasteHTML', '[sorumlu_ad]');"> [sorumlu_ad_soyad]</button>      </div>
               
                  </div>   


                  <div class="form-group m-3">
                    <label for="exampleInputEmail1">İstek Onaylandıktan Sonra Birim Sorumlusuna Gönderilecek SMS Şablonu :</label>
                    <textarea id="summernotebirimsms" name="istek_onaylandi_yonetici_sms" id="istek_onaylandi_yonetici_sms" class="form-control" placeholder="İstek Onaylandıktan Sonra Birim Sorumlusuna Gönderilecek SMS Şablonunu Giriniz."><?=$ayar->istek_onaylandi_yonetici_sms?></textarea>
                    <div class="btn-group" style="width: 100%;">
                    <button type="button" class="btn btn-default" onclick="$('#summernotebirimsms').summernote('pasteHTML', '[kullanici_ad]');"> [kullanici_ad_soyad]</button> 
                      <button type="button" class="btn btn-default" onclick="$('#summernotebirimsms').summernote('pasteHTML', '[istek_kodu]');"> [istek_kodu]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotebirimsms').summernote('pasteHTML', '[istek_tarihi]');"> [istek_tarihi]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotebirimsms').summernote('pasteHTML', '[guncel_tarih]');"> [guncel_tarih]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotebirimsms').summernote('pasteHTML', '[sorumlu_ad]');"> [sorumlu_ad_soyad]</button>       </div>
               
                  </div>   


                  <div class="form-group m-3">
                    <label for="exampleInputEmail1">İstek Reddedildikten Sonra Kullanıcıya Gönderilecek SMS Şablonu :</label>
                    <textarea id="summernotesms3" name="istek_reddedildi_sms" id="istek_reddedildi_sms" class="form-control" placeholder="Sorumluya Onaya Giden İstek Bildirim SMS Şablonunu giriniz."><?=$ayar->istek_reddedildi_sms?></textarea>
                    <div class="btn-group" style="width: 100%;">
                    <button type="button" class="btn btn-default" onclick="$('#summernotesms3').summernote('pasteHTML', '[kullanici_ad]');"> [kullanici_ad_soyad]</button> 
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms3').summernote('pasteHTML', '[istek_kodu]');"> [istek_kodu]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms3').summernote('pasteHTML', '[istek_tarihi]');"> [istek_tarihi]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms3').summernote('pasteHTML', '[guncel_tarih]');"> [guncel_tarih]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms3').summernote('pasteHTML', '[sorumlu_ad]');"> [sorumlu_ad_soyad]</button>                      </div>
                  </div>   

                  <div class="form-group m-3">
                    <label for="exampleInputEmail1">İstek İşleme Alındıktan Sonra Kullanıcıya Gönderilecek SMS Şablonu :</label>
                    <textarea id="summernotesms4" name="istek_isleme_alindi_sms" id="istek_isleme_alindi_sms" class="form-control" placeholder="Sorumluya Onaya Giden İstek Bildirim SMS Şablonunu giriniz."><?=$ayar->istek_isleme_alindi_sms?></textarea>
                    <div class="btn-group" style="width: 100%;">
                    <button type="button" class="btn btn-default" onclick="$('#summernotesms4').summernote('pasteHTML', '[kullanici_ad]');"> [kullanici_ad_soyad]</button> 
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms4').summernote('pasteHTML', '[istek_kodu]');"> [istek_kodu]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms4').summernote('pasteHTML', '[istek_tarihi]');"> [istek_tarihi]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms4').summernote('pasteHTML', '[guncel_tarih]');"> [guncel_tarih]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms4').summernote('pasteHTML', '[sorumlu_ad]');"> [sorumlu_ad_soyad]</button>                      </div>
                  </div>   
                  <div class="form-group m-3">
                    <label for="exampleInputEmail1">İstek Tamamlandıktan Sonra Kullanıcıya Gönderilecek SMS Şablonu :</label>
                    <textarea id="summernotesms5"  name="istek_tamamlandi_sms" id="istek_tamamlandi_sms" class="form-control" placeholder="Sorumluya Onaya Giden İstek Bildirim SMS Şablonunu giriniz."><?=$ayar->istek_tamamlandi_sms?></textarea>
                    <div class="btn-group" style="width: 100%;">
                    <button type="button" class="btn btn-default" onclick="$('#summernotesms5').summernote('pasteHTML', '[kullanici_ad]');"> [kullanici_ad_soyad]</button> 
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms5').summernote('pasteHTML', '[istek_kodu]');"> [istek_kodu]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms5').summernote('pasteHTML', '[istek_tarihi]');"> [istek_tarihi]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms5').summernote('pasteHTML', '[guncel_tarih]');"> [guncel_tarih]</button>
                      <button type="button" class="btn btn-default" onclick="$('#summernotesms5').summernote('pasteHTML', '[sorumlu_ad]');"> [sorumlu_ad_soyad]</button>                      </div>
                  </div>   



                  </div>
                </div>
              </div>
               
              <div class="card-footer">
              <button type="submit" class="btn btn-success">Değişiklikleri Kaydet</button>
              <button type="submit" class="btn btn-danger">İptal</button>
              </div>


            </div>
          </div>
    </section>
</form>
  </div>
</div>

 

<style>
  .card-dark:not(.card-outline)>.card-header a.active {
    color: #000000;
}
</style>