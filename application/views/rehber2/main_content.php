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
        width: calc(100% / 5 - 10px);
        background: #fff;
        border-radius: 5px;
        border: 1px solid #073773;
        padding: 10px 5px;
        margin: 5px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
        cursor: grab;
      }

      @media (max-width: 768px) {
        .card2 {
          width: calc(100% / 2 - 10px);
        }
      }

      @media (max-width: 480px) {
        .card2 {
          width: calc(100% / 2 - 10px);
        }
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

    <div class="search-container" style="padding: 6px; margin-bottom: -2px;">
      <input type="text" id="searchInput" class="search-input" placeholder="Kullanıcı ara...">
    </div>

    <div class="row" id="sortable-list">
      <?php foreach ($kullanicilar as $kullanici) : ?>
        <div class="card2" data-id="<?= $kullanici->kullanici_id ?>" data-name="<?= mb_strtolower(str_replace("İ","i",$kullanici->kullanici_ad_soyad), 'UTF-8') ?>">
          <div class="content">
            <div class="img">
              <img style="border: 3px solid #ffffff; outline: 2px solid #393c3721;width:70px;height:70px;border-radius:50%; object-fit:cover" src="<?= $kullanici->kullanici_resim != "" ? base_url("uploads/$kullanici->kullanici_resim") : "https://ugbusiness.com.tr/uploads/1710857373145.jpg" ?>">
            </div>
            <div class="details">
              <div class="name text-bold"><?= $kullanici->kullanici_ad_soyad ?></div>
              <div class="job"><?= $kullanici->kullanici_unvan ?? "-" ?></div>
              <a href="<?=base_url("kullanici/profil_new/$kullanici->kullanici_id?subpage=ozluk-dosyasi")?>" class="btn btn-primary">Profili Görüntüle</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</div>

<script>
  function normalizeText(text) {
    return text
         // Türkçe dil desteği ile küçük harfe çevirme
        .replace(/ğ/g, 'g')
        .replace(/ü/g, 'u')
        .replace(/ş/g, 's')
        .replace(/ı/g, 'i')
        .replace(/ö/g, 'o')
        .replace(/ç/g, 'c')
        .replace(/İ/g, 'i').toLocaleLowerCase('tr-TR'); // Büyük İ harfini küçük i yap
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
  });
  var el = document.getElementById('sortable-list');
  new Sortable(el, {
    animation: 150,
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
</script>