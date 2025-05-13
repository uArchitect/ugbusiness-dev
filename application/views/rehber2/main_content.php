<head>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>

<div class="content-wrapper pr-2 mobil-genislik" style="padding-top:15px">
  <section class="col-lg-12 connectedSortable pl-0">
    <style>
      .content-wrapper>.content {
        padding: 0 0rem;
      }

      .bg-dark {
        background: #003675 !important;
        border-radius: 0px !important;
      }

      .content-wrapper {
        padding: 0px !important;
      }

      .search-container {
        margin-bottom: 15px;
      }

      .search-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #073773;
        border-radius: 5px;
        outline: none;
      }

      .card2 {
        width: calc(100% / 7 - 10px);
        background: #fff;
        border-radius: 5px;
        border: 1px solid #073773;
        padding: 10px 5px;
        margin: 5px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
         position: relative;
      }
   
      @media (max-width: 768px) {
        .card2 {
          width: calc(100% / 2 - 10px) !important;
        }
      }

      @media (max-width: 480px) {
        .card2 {asf
          width: calc(100% / 2 - 10px) !important;
        }
      }
       
.card2::after {
  /* content: '⠿'; */ /* Taşıma simgesi */
  position: absolute;
  top: 5px;
  right: 5px;
  font-size: 16px;
  color:rgb(151, 5, 5);
  opacity: 0; /* Varsayılan olarak görünmez */
  transition: opacity 0.3s ease;
}
.card2:hover {  
  background: #0069ef;
  color: white !important;
}

.card2:hover * {  
  color: white !important;  
}

.card2:hover img {  
  scale:0.8 !important;  
}

.card2:hover::after,
.card2:hover .action-buttons {
  opacity: 1;  
  
}

.action-buttons {
  position: absolute;
  top: 5px;
  left: 5px;
  display: flex;
  gap: 5px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.action-buttons button {
  background-color: #1d7dfa;
  color: white;
  padding:0px;
  border: none;
  width: 17px;
  height: 17px;
  border-radius: 50%;
  font-size: 12px; 
}

.action-buttons button:hover {
  background-color: #0552aa;
}
      .card2 .content {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
      }
    </style>

    <div class="row">
      <div class="col pl-0">
        <div class="search-container" style="padding: 6px; margin-bottom: -2px;">
      <input type="text" id="searchInput" class="search-input" placeholder="Kullanıcı ara...">
    </div>
      </div>
       <div class="col" style="max-width:200px;display: flex;padding: 0;height: 39px;margin-top: 6px;margin-left: -7px;">
        <a href="<?=base_url("anasayfa/rehber")?>" class="btn btn-<?=!isset($_GET["filter"]) ? 'success' : 'default' ?>" style="width: -webkit-fill-available;">Aktif Kullanıcılar</a> 
      </div>
         <div class="col" style="max-width:200px;max-width: 200px;display: flex;padding: 0;height: 39px;margin-top: 6px;margin-left: 10px;margin-right: 5px;"> 
        <a href="<?=base_url("anasayfa/rehber?filter=hide")?>" class="btn btn-<?=isset($_GET["filter"]) ? 'success' : 'default' ?>" style="width: -webkit-fill-available;">Gizli Kullanıcılar</a>
      </div>
    </div>

    <div class="row" id="sortable-list">
      <?php foreach ($kullanicilar as $kullanici) : ?>
        <div class="card2" style="<?=$kullanici->kullanici_aktif == 0 ? "border:4px solid red;  " : ""?>width: calc(100% / <?=$kullanici->kullanici_liste_boyut?> - 10px);" data-id="<?= $kullanici->kullanici_id ?>" data-name="<?= mb_strtolower(str_replace("İ","i",$kullanici->kullanici_ad_soyad), 'UTF-8') ?>">
          <div class="content">
            <div class="img">
            <a href="<?=base_url("kullanici/profil_new/$kullanici->kullanici_id?subpage=ozluk-dosyasi")?>"><img style="border: 3px solid #ffffff; outline: 2px solid #393c3721;width:70px;height:70px;border-radius:50%; object-fit:cover" src="<?= $kullanici->kullanici_resim != "" ? base_url("uploads/$kullanici->kullanici_resim") : "https://ugbusiness.com.tr/uploads/1710857373145.jpg" ?>"></a>
            </div>
            <div class="details">
              <a href="<?=base_url("kullanici/profil_new/$kullanici->kullanici_id?subpage=ozluk-dosyasi")?>"><div class="name text-bold"><?= $kullanici->kullanici_ad_soyad ?></div></a>
              <a href="<?=base_url("kullanici/profil_new/$kullanici->kullanici_id?subpage=ozluk-dosyasi")?>"><div class="job"><?= $kullanici->kullanici_unvan != "" ? $kullanici->kullanici_unvan : "-" ?></div>
              </a>
            
              <?php 
              if($kullanici->kullanici_tc_kimlik_no == "BİLİNMİYOR"  || $kullanici->kullanici_tc_kimlik_no == ""){
                if($this->session->userdata('aktif_kullanici_id') == 1){
                ?>
                <span class="text-danger"> TCKN Eksik</span>
                <?php
              } }
              ?>

              <?php 
              if($kullanici->kullanici_liste_gorunum == "0"){
                if($this->session->userdata('aktif_kullanici_id') == 1){
                ?>
                <br><span class="text-danger"> Listede Gizli</span>
                <?php
              } }
              ?>


 <?php 
              if($kullanici->kullanici_aktif == "0"){
                if($this->session->userdata('aktif_kullanici_id') == 1){
                ?>
                <br><span class="btn btn-danger"> İşten Ayrıldı</span>
                <?php
              } }
              ?>

            </div>
          </div>
          <div class="action-buttons">
            <?php
            $sizehrefup = base_url("kullanici/kullanici_list_boyut_guncelle/$kullanici->kullanici_id/").($kullanici->kullanici_liste_boyut-2);
            $sizehrefdown = base_url("kullanici/kullanici_list_boyut_guncelle/$kullanici->kullanici_id/").($kullanici->kullanici_liste_boyut+2);
            $hideinlist = base_url("kullanici/kullanici_list_gizle/$kullanici->kullanici_id/");
            ?>
             <?php 
   // if($kullanici->kullanici_liste_boyut < 6){
?>

<button style="display:none"  onclick="location.href='<?= $sizehrefdown ?>';">-</button>
<?php
  //  }
    ?>
    
    <?php 
   // if($kullanici->kullanici_liste_boyut > 0){
?>
 <button style="display:none" onclick="location.href='<?= $sizehrefup ?>';">+</button>
<?php
   // }
    ?>
   <button style="background:red" onclick="confirm_action('Gizleme İşlemini Onayla','Seçilen bu kullanıcıyı personel listesinde gizlemek istediğinize emin misiniz?','Onayla','<?=$hideinlist?>');">x</button>
  </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</div>

<script>
  function normalizeText(text) {
    return text
 
        .replace(/ğ/g, 'g')
        .replace(/ü/g, 'u')
        .replace(/ş/g, 's')
        .replace(/ı/g, 'i')
        .replace(/ö/g, 'o')
        .replace(/ç/g, 'c')
        .replace(/İ/g, 'i').toLocaleLowerCase('tr-TR');  
}


  document.getElementById('searchInput').addEventListener('input', function() {
    let searchValue = normalizeText(this.value);
    document.querySelectorAll('#sortable-list .card2').forEach(function(card) {
      let name = normalizeText(card.getAttribute('data-name'));
      card.style.display = name.includes(searchValue) ? 'block' : 'none';
    });
  });

  
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("searchInput").focus();
    if (window.innerWidth > 768) {
  var el = document.getElementById('sortable-list');
  new Sortable(el, {
    animation: 550,swapClass: 'highlight',
    ghostClass: 'sortable-ghost',
    onEnd: function(evt) {
      var order = [];
      document.querySelectorAll("#sortable-list .card2").forEach(function(card, index) {
        order.push({ id: card.getAttribute("data-id"), siralama: index + 1 });
      });
      console.log(order);
      fetch("<?= base_url('kullanici/siralama_guncelle') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ order: order })
      })
      .then(response => response.json())
      .then(data => console.log("Güncelleme Sonucu:", data))
      .catch(error => console.error("Hata:", error));
    }
  }); 
 
  
  }});
</script>