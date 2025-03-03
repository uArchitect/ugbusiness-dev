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

    <div class="row" id="sortable-list">
      <?php foreach ($kullanicilar as $kullanici) : ?>
        <div class="card2" data-id="<?= $kullanici->kullanici_id ?>">
          <div class="content">
            <div class="img">
              <img style="border: 3px solid #ffffff; outline: 2px solid #393c3721;width:70px;height:70px;border-radius:50%; object-fit:cover" src="<?= $kullanici->kullanici_resim != "" ? base_url("uploads/$kullanici->kullanici_resim") : "https://ugbusiness.com.tr/uploads/1710857373145.jpg" ?>">
            </div>
            <div class="details">
              <div class="name text-bold"><?= $kullanici->kullanici_ad_soyad ?></div>
              <div class="job"><?= $kullanici->kullanici_unvan ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </section>
</div>

<script>
  var el = document.getElementById('sortable-list');
  new Sortable(el, {
    animation: 150,
    ghostClass: 'sortable-ghost',
    onEnd: function(evt) {
      var order = [];
      document.querySelectorAll("#sortable-list .card2").forEach(function(card) {
        order.push(card.getAttribute("data-id"));
      });
      console.log("Yeni Sıralama:", order);
    }
  });
</script>
