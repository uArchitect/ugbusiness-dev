 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
<div class="row"> 


</div>


<section class="content text-md">


<div class="row">
  <div class="col-4">


  
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>Filtrelemek İçin İşlem Seçiniz</strong> </h3>
               
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <div class="input-group" data-widget="sidebar-search1">

    <input class="form-control form-control-sidebar"   name="aranan_deger" type="search" placeholder="Hızlı Kayıt Ara..." aria-label="Search">
    <div class="input-group-append">
      <button class="btn btn-sidebar" type="submit" style="background:#1d2125;border: 1px solid #4d4d4d;color: white;">
        <i class="fas fa-search fa-fw"></i>
      </button>
    </div>


  </div>
  <div>
               <?php foreach ($kategori_data as $k): ?>
  <a href="#" 
     style="margin-top:1px;margin-bottom:1px;width: -webkit-fill-available;text-align:left;justify-content: space-between;
    display: flex
;"  
     class="btn btn-default kategori-btn" 
     data-kategori-id="<?= $k->servis_islem_kategori_id ?>">
    <?= $k->servis_islem_kategori_adi ?>

    <span style="font-weight: 400; color: #ffffff; background: #001fe5; padding: 1px; border-radius: 24%; height: 23px; width: 27px; text-align: center;"><?=$k->toplam_kayit_sayisi?></span>
  </a>
<?php endforeach; ?>
</div>
                  </div> 

  </div>
  </div>
  <div class="col-8">


  
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Servis Kayıtları</h3>
               
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 






                <table id="users_table"  class="table table-bordered table-striped nowrap" style="width:100%">
                  <thead>
                  <tr> 
                    <th >Servis Kodu</th>
                    <th >Servis Bilgileri</th>  
                    <th >Cihaz Bilgileri</th>
                   
                   
                   
                  </tr>
                  </thead>

                  </table>








              </div>
              <!-- /.card-body -->
            </div>

  </div>
</div>



            <!-- /.card -->
</section>
            </div>

            <style>
              
.yanipsonenyazifast {
      animation: blinker2 0.4s linear infinite;
   
      }
      @keyframes blinker2 {  
      50% { opacity: 0; }
      }


.yanipsonenyazi {
      animation: blinker 1.3s linear infinite;
      color: #1c87c9;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }

      .custom-href:hover {
        text-decoration: underline;
      }

     
    .anim-rotate {
        animation: rotate 1s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
 
      

      .custom-href:hover {
            text-decoration: underline;
          }
    
          .users_table_processing{
            margin-top:50px;
          }
       
         
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 8px 10px  ;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgb(177 176 176 / 18%);
}
     </style>
    

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 



    <script type="text/javascript">$(document).ready(function () {
  let selectedKategoriler = [];

  const table = $('#users_table').DataTable({
    "processing": true,
    "serverSide": true,
    "pageLength": 10,
    "scrollX": true,
    "ajax": {
      "url": "<?= site_url('servis/filter_ajax') ?>",
      "type": "GET",
      "data": function (d) {
        d.kategoriler = selectedKategoriler; // Sunucuya gönder
      }
    },
    "language": {
      "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
    },
    "columns": [
      { "data": 0 },
      { "data": 1 },
      { "data": 2 }
    ]
  });

  // Kategori butonlarına tıklanınca
  $('.kategori-btn').on('click', function (e) {
    e.preventDefault();
    const $btn = $(this);
    const kategori = $btn.data('kategori-id');

    if ($btn.hasClass('btn-primary')) {
      // Zaten seçiliyse kaldır
      $btn.removeClass('btn-primary').addClass('btn-default');
      selectedKategoriler = selectedKategoriler.filter(k => k !== kategori);
    } else {
      // Seçili değilse ekle
      $btn.removeClass('btn-default').addClass('btn-primary');
      selectedKategoriler.push(kategori);
    }

    // Seçili butonları en üste taşı
    const $parent = $btn.parent();
    const $selectedButtons = $parent.find('.btn-primary');
    $selectedButtons.each(function () {
      $(this).prependTo($parent);
    });

    table.ajax.reload(); // Tabloyu yeniden yükle
  });

  // Arama inputu ile kategori filtreleme
  $('input[name="aranan_deger"]').on('input', function () {
    const searchVal = $(this).val().toLowerCase();
    const $parent = $('.kategori-btn').parent();

    $('.kategori-btn').each(function () {
      const text = $(this).text().toLowerCase();
      // Arama kriterine uyan butonları göster, uymayanları gizle
      if (text.indexOf(searchVal) > -1) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });

    // Gözüken seçili butonları yine en üste taşı
    const $selectedButtons = $parent.find('.btn-primary:visible');
    $selectedButtons.each(function () {
      $(this).prependTo($parent);
    });
  });
});

    </script>