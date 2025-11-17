<div class="content-wrapper">
<section class="content col-lg-10 mt-2">
<div class="card card-dark">
<div class="card-header with-border"><h3 class="card-title">Sipariş Bilgileri</h3></div>

<form method="POST" action="<?= site_url('siparis/save_kurulum_rapor/'.$siparis->siparis_id) ?>">
<div class="card-body">

<?php
$kurulum_fotograflari = $this->db->where("siparis_id", $siparis->siparis_id)->get("kurulum_fotograflari")->result();
?>
<script>var mevcutKurulumFotograflari = <?= json_encode($kurulum_fotograflari) ?>;</script>

<!-- Müşteri Bilgileri -->
<div class="info-box">
    <span class="info-title">Müşteri / Merkez Bilgileri</span>
    <address class="m-2">
        <div class="row">
            <span class="badge info-badge">
                <i class="fa fa-user-circle icon"></i>
                <b><?= mb_strtoupper($merkez->musteri_ad) ?></b>
                <span class="sub-info">
                    <i class="far fa-address-card"></i> <?= $merkez->musteri_kod ?>
                    <i class="fa fa-mobile-alt"></i> <?= $merkez->musteri_iletisim_numarasi ?>
                </span>
            </span>

            <span class="badge info-badge">
                <i class="fa fa-building icon"></i>
                <b><?= mb_strtoupper($merkez->merkez_adi) ?></b>
                <span class="sub-info">
                    <i class="far fa-map"></i> <?= $merkez->merkez_adresi ?> <?= $merkez->ilce_adi ?>/<?= $merkez->sehir_adi ?>
                </span>
            </span>
        </div>
    </address>
</div>

<!-- Kurulum Programlama -->
<div class="parametre-box">
    <div class="timeline">
        <div>
            <i class="fas fa-envelope bg-blue"></i>
            <div class="timeline-item">
                <h3 class="timeline-header bg-dark"><a href="#">Kurulum Programlama</a></h3>
                <div class="timeline-body">

                <?php 
                $i = 0;
                foreach ($siparis_degerlendirme_parametreleri as $feature):
                $i++;
                $value = $degerlendirme_data ? json_decode($degerlendirme_data)[$i-1]->value : "";
                ?>

                <div class="card param-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <input type="hidden" name="feature_title_<?= $i ?>" value="<?= $feature->siparis_parametre_adi ?>">
                            <i class="fas fa-question-circle text-primary"></i> <?= $feature->siparis_parametre_adi ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" name="i_feature_name_<?= $i ?>" id="i_feature_name_<?= $i ?>" class="form-control"
                                   placeholder="Hızlı seçim yapınız veya değerlendirme sonucu giriniz..." value="<?= $value ?>">

                            <div class="input-group-append">
                                <button onclick="setValue(<?= $i ?>, 'Evet');return false;" class="btn btn-default text-success">
                                    <i class="fas fa-check text-success"></i> Evet
                                </button>
                                <button onclick="setValue(<?= $i ?>, 'Hayır');return false;" class="btn btn-default text-danger">
                                    <i class="fas fa-times text-danger"></i> Hayır
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOTOĞRAF YÜKLEME ALANLARI -->
<div class="parametre-box mt-3">

<h5><b>Kurulum Belge Fotoğrafları</b></h5>
<input type="file" multiple accept="image/*" onchange="kurulumFotoYukle(this,'belge')" class="form-control mb-2">
<div class="row" id="belge_fotograf_preview"></div>

<h5 class="mt-3"><b>Kurulum Cihaz Fotoğrafları</b></h5>
<input type="file" multiple accept="image/*" onchange="kurulumFotoYukle(this,'cihaz')" class="form-control mb-2">
<div class="row" id="cihaz_fotograf_preview"></div>

</div>

</div>

<!-- FOOTER -->
<div class="card-footer">
    <div class="row">
        <div class="col"><a href="<?= base_url("egitim") ?>" class="btn btn-danger">İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-primary">Kaydet</button></div>
    </div>
</div>

</form>
</div>
</section>
</div>

<script>
  function setValue(i,text){
    document.getElementById("i_feature_name_"+i).value=text;
}

function kurulumFotoYukle(input,tip){
    [...input.files].forEach(file=>{
        if(!file.type.match("image.*"))return alert("Geçerli resim değil!");
        if(file.size>5*1024*1024)return alert("Maksimum 5MB olabilir!");

        const reader=new FileReader();
        reader.onload=e=>{
            fetch("<?= base_url('siparis/kurulum_fotograf_yukle') ?>",{
                method:"POST",
                headers:{"Content-Type":"application/json"},
                body:JSON.stringify({
                    image:e.target.result,
                    siparis_id:<?= $siparis->siparis_id ?>,
                    foto_tipi:tip
                })
            })
            .then(r=>r.json())
            .then(d=>{
                if(d.status!=="success")return alert("Yükleme hatası!");
                fotoPreviewEkle(d.foto_url,tip);
            });
        };
        reader.readAsDataURL(file);
    });
    input.value="";
}

function fotoPreviewEkle(url,tip){
    const box=document.getElementById(tip+"_fotograf_preview");
    const div=document.createElement("div");
    div.className="col-md-3 mb-2";
    div.innerHTML=`
        <div class="preview-box">
            <img src="${url}">
            <button class="btn btn-danger btn-xs preview-del" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>`;
    box.appendChild(div);
}

function kurulumFotoSil(id){
    if(!confirm("Silinsin mi?"))return;
    fetch("<?= base_url('siparis/kurulum_fotograf_sil') ?>",{
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({foto_id:id})
    })
    .then(r=>r.json())
    .then(d=>d.status==="success"?location.reload():alert("Silme hatası!"));
}

</script>