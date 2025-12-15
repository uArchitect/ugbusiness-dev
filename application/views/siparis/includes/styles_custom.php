<?php
/**
 * Özel CSS stilleri partial
 * 
 * @return void
 */
?>

<style>
  .sel {
    background-color: green!important;
  }

  .swal2-content iframe {
    width: 90%;
    height: 100%;
    border: none;
  }

  .swal2-html-container {
    height: 690px;
    display: block;
    padding: 0px !important;
    margin: 0px!important;
  }
  
  .swal2-title {
    display: none!important;
    padding: 0!important;
  }
  
  .swal2-close {
    background: red!important;
    color: white!important;
  }

  /* Onay Bekleyen Siparişler Tablosu Özel Stiller */
  #onaybekleyensiparisler_new, #onaybekleyensiparisler {
    width: 100% !important;
    margin: 0;
    min-width: 970px; /* Minimum genişlik - tüm sütunların görünmesi için */
  }

  /* Tablo container - responsive scroll */
  .table-responsive-siparis {
    overflow-x: auto !important;
    overflow-y: visible !important;
    -webkit-overflow-scrolling: touch;
    position: relative;
  }

  /* Büyük ekranlarda scroll gizle */
  @media (min-width: 1400px) {
    .table-responsive-siparis {
      overflow-x: visible !important;
    }
    #onaybekleyensiparisler_new, #onaybekleyensiparisler {
      min-width: 100%;
    }
  }

  /* DataTables wrapper scroll kontrolü */
  #onaybekleyensiparisler_new_wrapper, #onaybekleyensiparisler_wrapper {
    width: 100% !important;
  }

  /* Küçük ekranlarda scroll aktif */
  @media (max-width: 1399px) {
    #onaybekleyensiparisler_new_wrapper, #onaybekleyensiparisler_wrapper {
      overflow-x: auto !important;
    }
    
    #onaybekleyensiparisler_new_wrapper .dataTables_scrollHead,
    #onaybekleyensiparisler_new_wrapper .dataTables_scrollBody,
    #onaybekleyensiparisler_wrapper .dataTables_scrollHead,
    #onaybekleyensiparisler_wrapper .dataTables_scrollBody {
      overflow-x: auto !important;
    }

    #onaybekleyensiparisler_new_wrapper .dataTables_scroll,
    #onaybekleyensiparisler_wrapper .dataTables_scroll {
      overflow-x: auto !important;
    }
  }

  /* Tüm tablo hücreleri sola yaslı */
  #onaybekleyensiparisler_new thead th, #onaybekleyensiparisler thead th,
  #onaybekleyensiparisler_new tbody td, #onaybekleyensiparisler tbody td {
    text-align: left !important;
  }

  #onaybekleyensiparisler_new tbody td, #onaybekleyensiparisler tbody td {
    word-wrap: break-word;
    overflow-wrap: break-word;
    vertical-align: top;
    padding: 10px 12px;
  }

  /* Merkez Detayları Sütunu */
  #onaybekleyensiparisler_new tbody td:nth-child(3), #onaybekleyensiparisler tbody td:nth-child(3) {
    font-size: 12px;
    line-height: 1.4;
  }

  /* Son Durum Sütunu - Adım Göstergeleri */
  #onaybekleyensiparisler_new tbody td:nth-child(5), #onaybekleyensiparisler tbody td:nth-child(5) {
    font-size: 12px;
  }

  #onaybekleyensiparisler_new tbody td:nth-child(5) .row,
  #onaybekleyensiparisler tbody td:nth-child(5) .row {
    margin: 0;
    flex-wrap: nowrap;
    justify-content: flex-start;
  }

  #onaybekleyensiparisler_new tbody td:nth-child(5) .mr-1,
  #onaybekleyensiparisler tbody td:nth-child(5) .mr-1 {
    margin-right: 3px !important;
    flex-shrink: 0;
  }

  /* İşlemler Sütunu */
  #onaybekleyensiparisler_new tbody td:nth-child(6), #onaybekleyensiparisler tbody td:nth-child(6) {
    padding: 8px 10px;
    vertical-align: middle;
  }

  /* Buton Stilleri */
  #onaybekleyensiparisler_new .btn-xs, #onaybekleyensiparisler .btn-xs {
    padding: 7px 10px;
    font-size: 10px;
    line-height: 1.3;
    white-space: nowrap;
    border-radius: 4px;
    transition: all 0.2s ease;
  }

  #onaybekleyensiparisler_new .btn-xs:hover, #onaybekleyensiparisler .btn-xs:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  #onaybekleyensiparisler_new .btn-xs:active, #onaybekleyensiparisler .btn-xs:active {
    transform: translateY(0);
  }

  /* Form içindeki butonlar */
  #onaybekleyensiparisler_new form, #onaybekleyensiparisler form {
    width: 100%;
    margin: 0;
  }

  /* Müşteri Adı Sütunu */
  #onaybekleyensiparisler_new tbody td:nth-child(2), #onaybekleyensiparisler tbody td:nth-child(2) {
    font-size: 13px;
    line-height: 1.4;
  }

  /* Kayıt No Sütunu */
  #onaybekleyensiparisler_new thead th:nth-child(1), #onaybekleyensiparisler thead th:nth-child(1),
  #onaybekleyensiparisler_new tbody td:nth-child(1), #onaybekleyensiparisler tbody td:nth-child(1) {
    font-size: 12px;
    text-align: left;
  }

  /* Sipariş Oluşturan Sütunu */
  #onaybekleyensiparisler_new tbody td:nth-child(4), #onaybekleyensiparisler tbody td:nth-child(4) {
    font-size: 12px;
    line-height: 1.4;
  }

  /* Responsive Düzenlemeler */
  @media (max-width: 1399px) {
    /* İşlemler sütununu her zaman görünür tut (sticky column) */
    #onaybekleyensiparisler_new thead th:nth-child(6),
    #onaybekleyensiparisler thead th:nth-child(6) {
      position: sticky;
      right: 0;
      background: linear-gradient(135deg, #001657 0%, #0033a0 100%) !important;
      z-index: 12;
      box-shadow: -2px 0 4px rgba(0, 0, 0, 0.15);
    }
    
    #onaybekleyensiparisler_new tbody td:nth-child(6),
    #onaybekleyensiparisler tbody td:nth-child(6) {
      position: sticky;
      right: 0;
      background-color: #ffffff;
      z-index: 11;
      box-shadow: -2px 0 4px rgba(0, 0, 0, 0.1);
    }
    
    /* Hover durumunda sticky column arka planını koru */
    #onaybekleyensiparisler_new tbody tr:hover td:nth-child(6),
    #onaybekleyensiparisler tbody tr:hover td:nth-child(6) {
      background-color: #f8f9fa !important;
    }
    
    /* Scroll bar görünürlüğü için */
    .table-responsive-siparis::-webkit-scrollbar {
      height: 8px;
    }
    
    .table-responsive-siparis::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 4px;
    }
    
    .table-responsive-siparis::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }
    
    .table-responsive-siparis::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
  }

  @media (max-width: 1200px) {
    #onaybekleyensiparisler_new, #onaybekleyensiparisler {
      font-size: 11px;
    }
    
    #onaybekleyensiparisler_new tbody td, #onaybekleyensiparisler tbody td {
      padding: 8px 10px;
    }
    
    /* İşlemler sütunu butonlarını küçült */
    #onaybekleyensiparisler_new .btn-xs, #onaybekleyensiparisler .btn-xs {
      padding: 6px 8px;
      font-size: 9px;
    }
  }

  @media (max-width: 992px) {
    /* Daha küçük ekranlarda sütun genişliklerini ayarla */
    #onaybekleyensiparisler_new th:nth-child(1),
    #onaybekleyensiparisler th:nth-child(1) {
      width: 70px !important;
      min-width: 70px;
    }
    
    #onaybekleyensiparisler_new th:nth-child(2),
    #onaybekleyensiparisler th:nth-child(2) {
      width: 150px !important;
      min-width: 150px;
    }
    
    #onaybekleyensiparisler_new th:nth-child(3),
    #onaybekleyensiparisler th:nth-child(3) {
      width: 180px !important;
      min-width: 180px;
    }
    
    #onaybekleyensiparisler_new th:nth-child(4),
    #onaybekleyensiparisler th:nth-child(4) {
      width: 130px !important;
      min-width: 130px;
    }
    
    #onaybekleyensiparisler_new th:nth-child(5),
    #onaybekleyensiparisler th:nth-child(5) {
      width: 200px !important;
      min-width: 200px;
    }
    
    #onaybekleyensiparisler_new th:nth-child(6),
    #onaybekleyensiparisler th:nth-child(6) {
      width: 120px !important;
      min-width: 120px;
    }
  }
</style>

