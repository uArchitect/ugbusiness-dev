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
    table-layout: fixed;
    margin: 0;
  }

  /* Tablo container - scroll'u engelle */
  .table-responsive {
    overflow-x: visible !important;
    overflow-y: visible !important;
  }

  /* DataTables wrapper scroll kontrolü */
  #onaybekleyensiparisler_new_wrapper, #onaybekleyensiparisler_wrapper {
    overflow-x: hidden !important;
    width: 100% !important;
  }

  #onaybekleyensiparisler_new_wrapper .dataTables_scrollHead,
  #onaybekleyensiparisler_new_wrapper .dataTables_scrollBody,
  #onaybekleyensiparisler_wrapper .dataTables_scrollHead,
  #onaybekleyensiparisler_wrapper .dataTables_scrollBody {
    overflow-x: hidden !important;
  }

  /* Tablo genişliği kontrolü */
  #onaybekleyensiparisler_new_wrapper .dataTables_scroll,
  #onaybekleyensiparisler_wrapper .dataTables_scroll {
    overflow-x: hidden !important;
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
  #onaybekleyensiparisler_new tbody td:nth-child(1), #onaybekleyensiparisler tbody td:nth-child(1) {
    font-size: 12px;
    text-align: center;
  }

  /* Sipariş Oluşturan Sütunu */
  #onaybekleyensiparisler_new tbody td:nth-child(4), #onaybekleyensiparisler tbody td:nth-child(4) {
    font-size: 12px;
    line-height: 1.4;
  }

  /* Responsive Düzenlemeler */
  @media (max-width: 1200px) {
    #onaybekleyensiparisler_new, #onaybekleyensiparisler {
      font-size: 11px;
    }
    
    #onaybekleyensiparisler_new tbody td, #onaybekleyensiparisler tbody td {
      padding: 8px 10px;
    }
  }
</style>

