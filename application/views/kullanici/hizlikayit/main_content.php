 
<div class="content-wrapper">
    <section class="content-header">
        <h1><?=$kullanici->kullanici_ad_soyad?> - <?=$kullanici->kullanici_unvan?></h1>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <form method="post" id="form-hizliduzenle">
            <div class="row">
                <div class="col-md-6">
            <!-- Fotoğraf Yükleme Bölümü -->
            <div class="card card-primary card-outline mb-3">
                <div class="card-header">
                    <h3 class="card-title">Kullanıcı Fotoğrafı</h3>
                </div>
                <div class="card-body">
                    <div class="row" style="background: whitesmoke;border: 2px dashed #495057ab;padding:5px;padding-top:28px;margin:1px;margin-bottom:20px !important">
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <?php if(!empty($kullanici->kullanici_resim)): ?>
                                    <img width="100px" src="<?=base_url("uploads/".$kullanici->kullanici_resim)?>" style="margin:auto;border-radius:50%;border:2px solid #007bff;" alt="Kullanıcı Fotoğrafı">
                                <?php else: ?>
                                    <img width="70px" src="<?=base_url("assets/dist/img/upload-image.jpg")?>" style="opacity:0.7;margin:auto" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="row pl-2 pr-2 text-center mt-2">
                                <b class="text-center" style="margin:auto">Kullanıcı Görsel Yükle</b>
                            </div>
                            <div class="row pl-2 pb-2">
                                <span style="margin:auto">
                                    Yüklemek istediğiniz görseli seçin. İzin verilen formatlar :<strong>*.jpeg, *.jpg, *.png</strong>, Dosya Boyutu : <strong>2 MB</strong>
                                </span>  
                            </div>
                            <div id="actions" class="row pb-4">
                                <div class="col-lg-12">
                                    <div class="btn-group w-100">
                                        <span class="btn btn-success col fileinput-button">
                                            <i class="fas fa-plus"></i>
                                            <span>Dosya Ekle</span>
                                        </span>
                                        <button type="button" class="btn btn-primary col start">
                                            <i class="fas fa-upload"></i>
                                            <span>Yüklemeyi Başlat</span>
                                        </button>
                                        <button type="button" class="btn btn-warning col cancel">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Yüklemeyi İptal Et</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="table table-striped files" id="previews-hizli">
                                <div id="template-hizli" class="row mt-2">
                                    <div class="col-4 d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="lead" data-dz-name></span>
                                            (<span data-dz-size></span>)
                                        </p>
                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="progress progress-striped active w-100" style="height:0.3rem" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="background-color:#01711a;width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex pl-0 align-items-center">
                                        <div class="btn-group" style="display: contents;">
                                            <button type="button" class="btn btn-dark start">
                                                <i class="fas fa-upload"></i>
                                                <span>Yükle</span>
                                            </button>
                                            <button type="button" data-dz-remove class="btn btn-dark cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>İptal</span>
                                            </button>
                                            <button type="button" data-dz-remove class="btn btn-danger delete">
                                                <i class="fas fa-trash"></i>
                                                <span>Sil</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="fileNames" id="fileNames">
                </div>
            </div>
            
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#genel">Genel</a></li> 
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">

                        <!-- GENEL -->
                        <div class="tab-pane fade show active" id="genel">
                              
                            
                        
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>İşe Giriş Tarihi</label>
                                    <input type="date" name="kullanici_ise_giris_tarihi" class="form-control" value="<?= $kullanici->kullanici_ise_giris_tarihi ?>">
                                </div>
                              
                                <div class="form-group col-md-4">
                                    <label>Doğum Tarihi</label>
                                    <input type="date" name="kullanici_dogum_tarihi" class="form-control" value="<?= $kullanici->kullanici_dogum_tarihi ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>T.C. Kimlik No</label>
                                    <input type="text" name="kullanici_tc_kimlik_no" class="form-control" value="<?= $kullanici->kullanici_tc_kimlik_no ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Uyruk</label>
                                    <input type="text" name="kullanici_uyruk" class="form-control" value="<?= $kullanici->kullanici_uyruk ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Medeni Durum</label>
                                   <select name="kullanici_medeni_durum" class="form-control">
                                    <option <?=$kullanici->kullanici_medeni_durum == "BİLİNMİYOR" ? "selected" : ""?> value="BİLİNMİYOR">BİLİNMİYOR</option>    
                                <option <?=$kullanici->kullanici_medeni_durum == "EVLİ" ? "selected" : ""?> value="EVLİ">EVLİ</option>
                                <option <?=$kullanici->kullanici_medeni_durum == "BEKAR" ? "selected" : ""?> value="BEKAR">BEKAR</option>    
                                </select>
                                       </div>
                                <div class="form-group col-md-12">
                                    <label>Çocuk Bilgileri</label>
                                    <textarea name="kullanici_cocuk_bilgileri" class="form-control"><?= $kullanici->kullanici_cocuk_bilgileri ?></textarea>
                                </div>
                            </div>
                     
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Kan Grubu</label>
                                    <input type="text" name="kullanici_kan_grubu" class="form-control" value="<?= $kullanici->kullanici_kan_grubu ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sürekli Kullandığı İlaç</label>
                                    <input type="text" name="kullanici_surekli_kullandigi_ilac" class="form-control" value="<?= $kullanici->kullanici_surekli_kullandigi_ilac ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Kronik Hastalık</label>
                                    <textarea name="kullanici_kronik_hastalik_bilgisi" class="form-control"><?= $kullanici->kullanici_kronik_hastalik_bilgisi ?></textarea>
                                </div>
                            </div>
                      
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Okul Adı</label>
                                    <input type="text" name="kullanici_okul_adi" class="form-control" value="<?= $kullanici->kullanici_okul_adi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Öğrenim Derecesi</label>
                                    <input type="text" name="kullanici_ogrenim_derecesi" class="form-control" value="<?= $kullanici->kullanici_ogrenim_derecesi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mezuniyet Tarihi</label>
                                    <input type="text" name="kullanici_mezuniyet_tarihi" class="form-control" value="<?= $kullanici->kullanici_mezuniyet_tarihi ?>">
                                </div>
                                 <div class="form-group col-md-12">
                                    <label>Sertifika</label>
                                    <textarea name="kullanici_sertifika" class="form-control"><?= $kullanici->kullanici_sertifika ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Yabancı Dil Bilgisi</label>
                                    <textarea name="kullanici_dil_bilgisi" class="form-control"><?= $kullanici->kullanici_dil_bilgisi ?></textarea>
                                </div>
                               
                            </div>
                      
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Acil İletişim</label>
                                    <input type="text" name="kullanici_acil_durum_iletisim" class="form-control" value="<?= $kullanici->kullanici_acil_durum_iletisim ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Yakınlık</label>
                                    <input type="text" name="kullanici_acil_durum_yakinlik" class="form-control" value="<?= $kullanici->kullanici_acil_durum_yakinlik ?>">
                                </div>
                            </div>
                       
                           <div class="row">
                             <div class="form-group col-md-6">
                                    <label>Ehliyet</label>
                                    <input type="text" name="kullanici_ehliyet_bilgileri" class="form-control" value="<?= $kullanici->kullanici_ehliyet_bilgileri ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>SRC Belgesi Var Mı?</label>
                                    <input type="text" name="kullanici_src_var_mi" class="form-control" value="<?= $kullanici->kullanici_src_var_mi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Askerlik </label>
                                    <input type="text" name="kullanici_askerlik_durum" class="form-control" value="<?= $kullanici->kullanici_askerlik_durum ?>">
                                </div>
                                  <div class="form-group col-md-12">
                                    <label>adres </label>
                                    <input type="text" name="kullanici_adres" class="form-control" value="<?= $kullanici->kullanici_adres ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </div>

            </div>
            </div>

        </form>
    </section>
</div>

<script>
$(document).ready(function() {
    // Dropzone yapılandırması sadece bu sayfa için
    Dropzone.autoDiscover = false;

    // Template'i al ve kaldır
    var previewNodeHizli = document.querySelector("#template-hizli");
    if(previewNodeHizli) {
        previewNodeHizli.id = "";
        var previewTemplateHizli = previewNodeHizli.parentNode.innerHTML;
        previewNodeHizli.parentNode.removeChild(previewNodeHizli);

        // Sadece fotoğraf yükleme bölümü için Dropzone oluştur
        var fotoYuklemeDiv = document.querySelector(".card-body .row");
        if(fotoYuklemeDiv) {
            var myDropzoneHizli = new Dropzone(fotoYuklemeDiv, {
                url: "<?=base_url('dokuman/dragDropUpload')?>",
                thumbnailWidth: 80,
                maxFiles: 1,
                thumbnailHeight: 80,
                parallelUploads: 1,
                renameFile: function (file) {
                    return file.renameFilename = new Date().getTime() + "." + file.name.split('.').pop();
                },
                acceptedFiles: ".png,.jpg,.jpeg",
                previewTemplate: previewTemplateHizli,
                autoQueue: false,
                previewsContainer: "#previews-hizli",
                clickable: ".fileinput-button"
            });

            var fileNamesHizli = "";

            myDropzoneHizli.on("addedfile", function(file) {
                // Eğer zaten bir dosya varsa, öncekini kaldır
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
                file.previewElement.querySelector(".start").onclick = function() { 
                    myDropzoneHizli.enqueueFile(file);
                };
            });

            myDropzoneHizli.on("sending", function(file, xhr, formData) {
                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                fileNamesHizli = file.renameFilename;
            });

            myDropzoneHizli.on("success", function(file, response) {
                file.previewElement.querySelector(".start").removeAttribute("disabled");
                document.getElementById("fileNames").value = fileNamesHizli;
                // Başarılı yükleme sonrası sayfayı yenile
                setTimeout(function() {
                    location.reload();
                }, 1000);
            });

            myDropzoneHizli.on("error", function(file, message) {
                alert("Yükleme hatası: " + message);
                file.previewElement.querySelector(".start").removeAttribute("disabled");
            });

            // Form submit edildiğinde fileNames'i gönder
            if (document.getElementById('form-hizliduzenle')) {
                document.getElementById("form-hizliduzenle").addEventListener("submit", function(event) {
                    if(fileNamesHizli != ""){
                        document.getElementById("fileNames").value = fileNamesHizli;
                    }
                });
            }
        }
    }
});
</script>
 
