<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("includes/head"); ?>
<body>
 

<div class="container" style="min-width: 95% !important;">
<div class="row" style="  margin-top:30px;  display: flex;">
  <div class="col-4" style="border:1px solid #dbdada;max-width: 33%;min-width: 33%;">
    <img src="https://ugbusiness.com.tr/assets/dist/img/ug-logo-kargo.png" style="width: 240px;margin: auto;align-items: center;display: block;margin-top: 19px;">
  </div>
  <div class="col-4 text-center" style="font-family:arial;text-align: center;border:1px solid #dbdada;max-width: 33%;min-width: 33%;">
    <b style="
    font-size: 15px;
">UG TEKNOLOJİ MAKİNE TASARIM</b>
    <br>
    <b style="
    font-size: 15px;
">SANAYİ VE TİCARET LİMİTED</b>
    <br>
    <b style="
    font-size: 15px;
">ŞİRKETİ</b>
    <br>
    <br>
    <b style="font-style: italic;">Mithatpaşa Mah. Kıyı Boyu Cad. <br> 58130 Sok. Şanlı2 Apt No : 47/A <br>Seyhan / ADANA <br>
      <br>www.ugteknoloji.com </b>
    <br>
  </div>
  <div class="col-4 text-center" style="font-size: 30px;font-family:arial;text-align: center;border:1px solid #dbdada;max-width: 33%;min-width: 33%;padding-top: 35px;">
    <u style="
    margin-bottom: 10px !important;
">TEKNİK SERVİS</u>
    <br>
    <div style="height:10px"></div>
    <b>0546 831 10 11</b>
  </div>
</div>
<div class="row" style="font-size: 25px; margin-bottom: 10px; margin-top: 10px;">
    SERVİS FORMU
</div>

<div class="row">
    <div class="col col-md-2" style="border:1px solid #dbdada;">Firma Adı: </div>
    <div class="col col-md-6" style="border:1px solid #dbdada;"><?=$servis->merkez_adi?> </div>
    <div class="col col-md-4" style="border:1px solid #dbdada;">Servis Tarihi: <?=date("d.m.Y H:i",strtotime($servis->servis_kayit_tarihi))?> </div>
    <div class="col col-md-2" style="border:1px solid #dbdada;">Adres: </div>
    <div class="col col-md-6" style="border:1px solid #dbdada;"><?=$servis->merkez_adresi?></div>
    <div class="col col-md-4" style="border:1px solid #dbdada;">Çözüm Süresi:</div>
    <div class="col col-md-2" style="border:1px solid #dbdada;">Tel:</div>
    <div class="col col-md-10" style="border:1px solid #dbdada;"><?=$servis->musteri_iletisim_numarasi?></div> 
    <div class="col col-md-2" style="border:1px solid #dbdada;">Şikayet:</div>
    <div class="col col-md-10" style="border:1px solid #dbdada;">
    <table id="example1" class="table text-xs table-bordered table-striped nowrap" style="margin-top: 10px;">
                  <thead>
                  <tr>
                    <th style="background: #ececec !important;color:black">Sorun</th>
                    <th style="background: #ececec !important;color:black">Açıklama</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
                  foreach ($bildirimler as $bildirim) {
                    ?>
                    <tr>
                      <td><?=$bildirim->servis_sorun_kategori_adi?></td>
                      <td><?=$bildirim->servis_bildirim_aciklama?></td>
                    </tr>
                    <?php
                  }
                  ?>
                 
</tbody>  

</table>



            <tbody>
</tbody>
        </table>
    </div> 


    <div class="col col-md-2" style="border:1px solid #dbdada;">Cihaz Markası:</div>
    <div class="col col-md-10" style="border:1px solid #dbdada;"><?=$servis->urun_adi?></div> 

    <div class="col col-md-2" style="border:1px solid #dbdada;">Cihaz Seri No:</div>
    <div class="col col-md-10" style="border:1px solid #dbdada;"><?=$cihaz->seri_numarasi?></div> 

</div>



<div class="row" style="font-size: 25px; margin-bottom: 10px; margin-top: 10px;">
    YAPILAN İŞLEMLER
</div>


<div class="row" style="font-size: 25px; margin-bottom: 10px; margin-top: 10px;">
<table id="example1" class="table text-xs table-bordered table-striped nowrap" style="margin-top: 10px;">
                  <thead>
                  <tr>
                    <th style="background: #ececec !important;color:black">İşlem</th>
                    <th style="background: #ececec !important;color:black">Açıklama</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  foreach ($servis_islemleri as $islem) {
                    ?>
                    <tr>
                      <td><?=$islem->servis_islem_kategori_adi?></td>
                      <td><?=$islem->servis_islem_aciklama?></td>
                    </tr>
                    <?php
                  }
                  ?>
</tbody>  

</table>



            <tbody>
</tbody>
        </table>
</div>




<div class="row text-center">
<div class="col col-md-12" style="border:1px solid #dbdada;opacity:0.6;">Cihazı Hasarsız ve
Çalışır Durumda Teslim Ettiğine Dair Belgedir. 
</div>
    <div class="col col-md-4" style="border:1px solid #dbdada;"><b>Servis Müdürü </b>
</div>
    <div class="col col-md-4" style="border:1px solid #dbdada;"><b>Servis Teknisyeni</b>  </div>
    <div class="col col-md-4" style="border:1px solid #dbdada;"><b>Teslim Alan Müşteri Onayı</b>   </div>

    <div class="col col-md-4" style="border:1px solid #dbdada;">
     <?=get_yonlendiren_kullanici($servis->servis_kayit_olusturan_kullanici_id)->kullanici_ad_soyad?>
  </div>
    <div class="col col-md-4" style="border:1px solid #dbdada;">
        <?php 
        foreach ($gorevler as $gorev) {
          echo $gorev->kullanici_ad_soyad."<br>";
        }
        ?>          
    </div>

    <div class="col col-md-4" style="border:1px solid #dbdada;"><?=$servis->merkez_adi?> </div>
</div>






</div>

<script type="text/javascript">
   // window.onload = function() { window.print(); }
</script>
</body>
</html>
