<style>
  /* ============================================
     CSS Variables - Design System
     ============================================ */
  :root {
    --tab-height: 56px;
    --tab-padding-x: 20px;
    --tab-padding-y: 16px;
    --tab-color-default: #6b7280;
    --tab-color-hover: #374151;
    --tab-color-active: #001657;
    --tab-bg-hover: #f9fafb;
    --tab-bg-active: #f0f4ff;
    --tab-border-color: #e5e7eb;
    --tab-separator-color: #d1d5db;
    --container-padding: 24px;
    --card-border-radius: 12px;
    --card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --primary-color: #001657;
    --primary-gradient: linear-gradient(135deg, #001657 0%, #001657 100%);
  }

  /* ============================================
     Modern Tab Navigation
     ============================================ */
  .modern-tabs-nav {
    background-color: #ffffff;
    border-bottom: 1px solid var(--tab-border-color);
    position: relative;
    overflow: hidden;
    margin: 0;
    padding: 0;
  }

  .modern-tabs-container {
    display: flex;
    align-items: stretch;
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: var(--tab-separator-color) transparent;
    padding: 0 var(--container-padding);
    margin: 0;
    min-height: var(--tab-height);
    width: 100%;
    box-sizing: border-box;
  }

  .modern-tabs-container::-webkit-scrollbar {
    height: 4px;
  }

  .modern-tabs-container::-webkit-scrollbar-track {
    background: transparent;
  }

  .modern-tabs-container::-webkit-scrollbar-thumb {
    background-color: var(--tab-separator-color);
    border-radius: 2px;
  }

  .modern-tabs-container::-webkit-scrollbar-thumb:hover {
    background-color: #9ca3af;
  }

  .modern-tab {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
    padding: var(--tab-padding-y) var(--tab-padding-x);
    margin: 0;
    text-decoration: none;
    color: var(--tab-color-default);
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
    position: relative;
    border-bottom: 3px solid transparent;
    background-color: transparent;
    cursor: pointer;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    border-radius: 0;
    flex-shrink: 0;
    box-sizing: border-box;
    min-height: var(--tab-height);
    height: 100%;
    line-height: 1.5;
  }

  .modern-tab:first-child {
    margin-left: 0;
    padding-left: 0;
  }

  .modern-tab:last-child {
    margin-right: 0;
    padding-right: 0;
  }

  .modern-tab-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    font-size: 16px;
    color: var(--tab-color-default);
  }

  .modern-tab-icon i {
    display: block;
    line-height: 1;
  }

  .modern-tab-label {
    letter-spacing: 0.01em;
    color: var(--tab-color-default);
  }

  .modern-tab-separator {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--tab-separator-color);
    font-size: 14px;
    font-weight: 300;
    padding: 0 4px;
    user-select: none;
    flex-shrink: 0;
    height: var(--tab-height);
    line-height: var(--tab-height);
  }

  .modern-tab:not(.active):hover {
    color: var(--tab-color-hover);
    background-color: var(--tab-bg-hover);
  }

  .modern-tab:not(.active):hover .modern-tab-icon {
    color: var(--tab-color-hover);
  }

  .modern-tab.active {
    color: var(--tab-color-active);
    background-color: var(--tab-bg-active);
    border-bottom-color: var(--tab-color-active);
    font-weight: 600;
    margin-bottom: -1px;
    position: relative;
    z-index: 1;
  }

  .modern-tab.active::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--tab-bg-active);
    z-index: -1;
  }

  .modern-tab.active .modern-tab-icon {
    color: var(--tab-color-active);
  }

  .modern-tab.active .modern-tab-label {
    color: var(--tab-color-active);
  }

  .modern-tab:focus {
    outline: 2px solid var(--tab-color-active);
    outline-offset: -2px;
    border-radius: 4px 4px 0 0;
  }

  .modern-tab:focus:not(:focus-visible) {
    outline: none;
  }

  /* ============================================
     Content Wrapper & Card Styles
     ============================================ */
  .content-wrapper-siparis {
    padding-top: 25px;
    background-color: #f8f9fa;
  }

  .card-siparis {
    border: 0;
    border-radius: var(--card-border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    padding: 0;
    margin: 0;
  }

  .card-header-siparis {
    border: 0;
    background: var(--primary-gradient);
    padding: 20px var(--container-padding);
    box-sizing: border-box;
    margin: 0;
  }

  .card-header-icon-wrapper {
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
  }

  .card-header-icon {
    color: #ffffff;
    font-size: 18px;
  }

  .card-header-title {
    color: #ffffff;
    font-weight: 700;
    font-size: 20px;
    letter-spacing: 0.5px;
    line-height: 1.2;
    margin: 0;
  }

  .card-header-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px;
    line-height: 1.4;
    display: block;
    margin-top: 2px;
  }

  .card-body-siparis {
    padding: 0;
    background-color: #ffffff;
    box-sizing: border-box;
    margin: 0;
  }

  /* ============================================
     Filter Styles
     ============================================ */
  .filter-row {
    background-color: #f8f9fa;
    padding: 15px 15px 15px 0;
    border-radius: 5px;
    margin-bottom: 15px;
    margin-left: 0;
    margin-right: 0;
  }

  .filter-form {
    width: 100%;
  }

  .filter-row-inner {
    margin-left: 0;
    margin-right: 0;
  }

  .filter-col {
    padding-left: 15px;
    padding-right: 15px;
  }

  .filter-label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
    color: var(--primary-color);
  }

  .filter-input-group-text {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
  }

  .filter-form-control {
    border-color: var(--primary-color);
  }

  .filter-buttons-wrapper {
    display: flex;
    align-items: flex-end;
    gap: 5px;
  }

  .filter-btn-primary {
    background: var(--primary-gradient);
    color: white;
    border-color: var(--primary-color);
    flex: 1;
  }

  .filter-btn-secondary {
    flex: 1;
  }

  .input-group:focus-within .input-group-text {
    background-color: #002a7a;
    border-color: #002a7a;
  }

  .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
    outline: none;
  }

  /* ============================================
     Table Styles
     ============================================ */
  #siparis-tablo-container {
    border-radius: 8px;
    overflow: hidden;
    background: #ffffff;
    margin-left: 0;
    margin-right: 0;
    padding-left: 0;
    padding-right: 0;
  }

  /* DataTables Responsive Control Butonu (+/-) - Tüm Ekranlar */
  #siparis-tablo tbody td.dtr-control,
  #siparis-tablo tbody th.dtr-control {
    position: relative;
    cursor: pointer;
    padding-left: 45px !important;
  }

  #siparis-tablo tbody td.dtr-control:before,
  #siparis-tablo tbody th.dtr-control:before {
    content: "+";
    position: absolute;
    left: 8px;
    top: 50%;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--primary-color);
    color: white;
    border-radius: 50%;
    font-size: 20px;
    font-weight: bold;
    line-height: 1;
    box-shadow: 0 2px 4px rgba(0, 22, 87, 0.2);
    transition: all 0.3s ease;
    font-family: Arial, sans-serif;
  }

  #siparis-tablo tbody tr.parent td.dtr-control:before,
  #siparis-tablo tbody tr.parent th.dtr-control:before {
    content: "−";
    background-color: #dc3545;
  }

  #siparis-tablo tbody td.dtr-control:hover:before,
  #siparis-tablo tbody th.dtr-control:hover:before {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 3px 8px rgba(0, 22, 87, 0.3);
  }

  /* Child row (detay satırı) - Tüm Ekranlar */
  #siparis-tablo tbody tr.child {
    background-color: #f8f9fa;
    padding: 15px;
  }

  #siparis-tablo tbody tr.child:hover {
    background-color: #f8f9fa !important;
  }

  #siparis-tablo tbody tr.child ul.dtr-details {
    list-style: none;
    padding: 0;
    margin: 0;
    display: block;
  }

  #siparis-tablo tbody tr.child ul.dtr-details li {
    border-bottom: 1px solid #e5e7eb;
    padding: 10px 0;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
  }

  #siparis-tablo tbody tr.child ul.dtr-details li:first-child {
    padding-top: 0;
  }

  #siparis-tablo tbody tr.child ul.dtr-details li:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }

  #siparis-tablo tbody tr.child span.dtr-title {
    font-weight: 600;
    color: var(--primary-color);
    padding-right: 10px;
    min-width: 140px;
    flex-shrink: 0;
    display: inline-block;
  }

  #siparis-tablo tbody tr.child span.dtr-data {
    flex: 1;
    color: #495057;
    word-wrap: break-word;
    display: inline-block;
  }

  /* DataTables Wrapper - Sola hizalı */
  #siparis-tablo_wrapper {
    margin-left: 0;
    margin-right: 0;
    padding-left: 0;
    padding-right: 0;
  }

  #siparis-tablo_wrapper .dataTables_wrapper {
    margin-left: 0;
    margin-right: 0;
    padding-left: 0;
    padding-right: 0;
  }

  #siparis-tablo_wrapper .row {
    margin-left: 0;
    margin-right: 0;
  }

  #siparis-tablo_wrapper .row > div {
    padding-left: 0;
    padding-right: 0;
  }

  #siparis-tablo {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
  }

  #siparis-tablo-header.siparis-tablo-thead {
    background: var(--primary-gradient);
  }

  #siparis-tablo-header .siparis-th {
    color: #ffffff;
    font-weight: 600;
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
    font-size: 14px;
    border: none;
    white-space: nowrap;
  }

  #siparis-tablo-header .siparis-th-action {
    width: 120px;
    text-align: center;
  }

  /* Column Widths */
  #siparis-tablo-body.siparis-tablo-tbody td:nth-child(1) {
    max-width: 180px;
  }

  #siparis-tablo-body.siparis-tablo-tbody td:nth-child(2) {
    max-width: 200px;
  }

  #siparis-tablo-body.siparis-tablo-tbody td:nth-child(3) {
    max-width: 300px;
  }

  #siparis-tablo-body.siparis-tablo-tbody td:nth-child(4) {
    max-width: 200px;
  }

  #siparis-tablo-body.siparis-tablo-tbody td:nth-child(5) {
    max-width: 120px;
    text-align: center;
  }

  #siparis-tablo-body.siparis-tablo-tbody tr {
    border-left: 3px solid transparent;
    transition: all 0.2s ease;
    background: #ffffff;
  }

  #siparis-tablo-body.siparis-tablo-tbody tr:hover {
    background: #f8f9fa;
    border-left-color: var(--primary-color);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  #siparis-tablo-body.siparis-tablo-tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    color: #495057;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
    line-height: 1.5;
    max-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  #siparis-tablo-body.siparis-tablo-tbody tr:last-child td {
    border-bottom: none;
  }

  /* Table Cell Content Styles */
  .table-cell-content {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
  }

  .table-cell-icon {
    color: var(--primary-color);
    font-size: 14px;
    flex-shrink: 0;
    opacity: 0.7;
  }

  .table-cell-text {
    flex: 1;
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .table-cell-multiline {
    display: flex;
    flex-direction: column;
    gap: 4px;
    min-width: 0;
  }

  .table-cell-multiline .table-cell-content {
    width: 100%;
  }

  .table-cell-multiline .table-cell-text {
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.4;
  }

  #siparis-tablo_wrapper .dataTables_processing {
    background: var(--primary-gradient);
    color: #ffffff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 22, 87, 0.3);
  }

  #siparis-tablo_wrapper .dataTables_filter input,
  #siparis-tablo_wrapper .dataTables_length select {
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 6px 12px;
  }

  #siparis-tablo_wrapper .dataTables_filter input:focus,
  #siparis-tablo_wrapper .dataTables_length select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
    outline: none;
  }

  .datatables-processing {
    text-align: center;
    padding: 20px;
  }

  .datatables-processing-icon {
    color: var(--primary-color);
  }

  .datatables-processing-text {
    margin-top: 10px;
    display: block;
  }

  /* ============================================
     Responsive Design
     ============================================ */
  @media (max-width: 1024px) {
    :root {
      --tab-height: 52px;
      --tab-padding-x: 18px;
      --tab-padding-y: 14px;
      --container-padding: 20px;
    }

    .filter-col {
      margin-bottom: 10px;
    }

    .filter-buttons-wrapper {
      margin-top: 10px;
    }
  }

  @media (max-width: 768px) {
    :root {
      --tab-height: 48px;
      --tab-padding-x: 16px;
      --tab-padding-y: 12px;
      --container-padding: 15px;
    }

    .modern-tab {
      gap: 6px;
      font-size: 13px;
    }

    .modern-tab-separator {
      font-size: 12px;
      padding: 0 3px;
    }

    /* Card Header - Mobil */
    .card-header-siparis {
      padding: 15px var(--container-padding);
    }

    .card-header-title {
      font-size: 18px;
    }

    .card-header-subtitle {
      font-size: 12px;
    }

    .card-header-icon-wrapper {
      width: 35px;
      height: 35px;
    }

    .card-header-icon {
      font-size: 16px;
    }

    /* Filtreler - Mobil */
    .filter-row {
      padding: 12px 12px 12px 0;
    }

    .filter-col {
      padding-left: 12px;
      padding-right: 12px;
      margin-bottom: 12px;
    }

    .filter-label {
      font-size: 13px;
      margin-bottom: 4px;
    }

    .filter-buttons-wrapper {
      flex-direction: column;
      gap: 8px;
      margin-top: 0;
    }

    .filter-btn-primary,
    .filter-btn-secondary {
      width: 100%;
    }

    /* Tablo - Mobil */
    #siparis-tablo-header .siparis-th {
      padding: 10px 8px;
      font-size: 12px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td {
      padding: 10px 8px;
      font-size: 13px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(1) {
      max-width: 150px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(2) {
      max-width: 180px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(3) {
      max-width: 250px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(4) {
      max-width: 150px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(5) {
      max-width: 100px;
    }

    .table-cell-icon {
      font-size: 12px;
    }

    .table-cell-text {
      font-size: 12px;
    }

    /* DataTables Kontrolleri - Mobil */
    #siparis-tablo_wrapper .dataTables_wrapper .row {
      margin-left: 0;
      margin-right: 0;
    }

    #siparis-tablo_wrapper .dataTables_length,
    #siparis-tablo_wrapper .dataTables_filter {
      margin-bottom: 10px;
      text-align: left;
    }

    #siparis-tablo_wrapper .dataTables_length {
      float: none;
      width: 100%;
    }

    #siparis-tablo_wrapper .dataTables_filter {
      float: none;
      width: 100%;
      margin-top: 10px;
    }

    #siparis-tablo_wrapper .dataTables_filter input {
      width: 100%;
      margin-left: 0;
    }

    #siparis-tablo_wrapper .dataTables_info {
      font-size: 12px;
      padding: 10px 0;
      text-align: center;
    }

    #siparis-tablo_wrapper .dataTables_paginate {
      text-align: center;
      margin-top: 10px;
    }

    #siparis-tablo_wrapper .dataTables_paginate .paginate_button {
      padding: 6px 10px;
      font-size: 12px;
      min-width: 32px;
      height: 32px;
    }
  }

  @media (max-width: 640px) {
    :root {
      --tab-padding-x: 12px;
      --tab-padding-y: 10px;
      --container-padding: 12px;
    }

    .modern-tab {
      gap: 4px;
      font-size: 12px;
      padding: var(--tab-padding-y) var(--tab-padding-x);
    }

    .modern-tab-label {
      display: none;
    }

    .modern-tab-icon {
      width: 16px;
      height: 16px;
      font-size: 14px;
    }

    .modern-tab-separator {
      font-size: 10px;
      padding: 0 2px;
    }

    /* Card Header - Küçük Mobil */
    .card-header-siparis {
      padding: 12px var(--container-padding);
    }

    .card-header-title {
      font-size: 16px;
    }

    .card-header-subtitle {
      font-size: 11px;
    }

    .card-header-icon-wrapper {
      width: 30px;
      height: 30px;
      margin-right: 10px !important;
    }

    .card-header-icon {
      font-size: 14px;
    }

    /* Filtreler - Küçük Mobil */
    .filter-row {
      padding: 10px 10px 10px 0;
    }

    .filter-col {
      padding-left: 10px;
      padding-right: 10px;
      margin-bottom: 10px;
    }

    .filter-label {
      font-size: 12px;
    }

    .input-group-sm .form-control,
    .input-group-sm .input-group-text {
      font-size: 13px;
      padding: 4px 8px;
    }

    /* Tablo - Küçük Mobil */
    #siparis-tablo-header .siparis-th {
      padding: 8px 6px;
      font-size: 11px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td {
      padding: 8px 6px;
      font-size: 12px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(1) {
      max-width: 120px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(2) {
      max-width: 150px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(3) {
      max-width: 200px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(4) {
      max-width: 120px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td:nth-child(5) {
      max-width: 80px;
    }

    .table-cell-content {
      gap: 4px;
    }

    .table-cell-icon {
      font-size: 11px;
      width: 14px;
      height: 14px;
    }

    .table-cell-text {
      font-size: 11px;
    }

    /* Kullanıcı fotoğrafı - Küçük Mobil */
    .table-cell-content img {
      width: 24px !important;
      height: 24px !important;
      margin-right: 6px !important;
    }

    /* Badge'ler - Küçük Mobil */
    .badge {
      font-size: 10px;
      padding: 2px 5px;
    }

    /* Butonlar - Küçük Mobil */
    .btn-sm {
      font-size: 11px;
      padding: 4px 8px;
    }

    /* DataTables - Küçük Mobil */
    #siparis-tablo_wrapper .dataTables_length select {
      font-size: 12px;
      padding: 4px 8px;
    }

    #siparis-tablo_wrapper .dataTables_filter input {
      font-size: 12px;
      padding: 4px 8px;
    }

    #siparis-tablo_wrapper .dataTables_info {
      font-size: 11px;
    }

    #siparis-tablo_wrapper .dataTables_paginate .paginate_button {
      padding: 4px 8px;
      font-size: 11px;
      min-width: 28px;
      height: 28px;
    }
  }

  @media (max-width: 480px) {
    :root {
      --container-padding: 10px;
    }

    .content-wrapper-siparis {
      padding-top: 15px;
    }

    .card-header-siparis {
      padding: 10px var(--container-padding);
    }

    .card-header-title {
      font-size: 14px;
    }

    .filter-row {
      padding: 8px 8px 8px 0;
    }

    .filter-col {
      padding-left: 8px;
      padding-right: 8px;
    }

    #siparis-tablo-header .siparis-th {
      padding: 6px 4px;
      font-size: 10px;
    }

    #siparis-tablo-body.siparis-tablo-tbody td {
      padding: 6px 4px;
      font-size: 11px;
    }

    .table-cell-multiline {
      gap: 2px;
    }

    small {
      font-size: 10px;
    }

    /* DataTables Responsive - Mobil Detay Görünümü */
    #siparis-tablo_wrapper .dtr-details {
      font-size: 12px;
      list-style: none;
      padding: 0;
      margin: 10px 0;
      background-color: #f8f9fa;
      border-radius: 6px;
      padding: 12px;
    }

    #siparis-tablo_wrapper .dtr-details li {
      border-bottom: 1px solid #e5e7eb;
      padding: 8px 0;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
    }

    #siparis-tablo_wrapper .dtr-details li:last-child {
      border-bottom: none;
    }

    #siparis-tablo_wrapper .dtr-title {
      font-weight: 600;
      color: var(--primary-color);
      padding-right: 8px;
      min-width: 120px;
      flex-shrink: 0;
    }

    #siparis-tablo_wrapper .dtr-data {
      flex: 1;
      color: #495057;
      word-wrap: break-word;
    }

    /* Child row (detay satırı) */
    #siparis-tablo tbody tr.child {
      background-color: #f8f9fa;
      padding: 10px;
    }

    #siparis-tablo tbody tr.child:hover {
      background-color: #f8f9fa !important;
    }
  }

  /* Yatay Scroll için */
  @media (max-width: 768px) {
    .table-responsive {
      -webkit-overflow-scrolling: touch;
      overflow-x: auto;
    }

    #siparis-tablo {
      min-width: 600px;
    }
  }

  /* Tab Navigation - Mobil Scroll İyileştirmesi */
  @media (max-width: 768px) {
    .modern-tabs-container {
      padding: 0 10px;
      -webkit-overflow-scrolling: touch;
    }

    .modern-tab {
      min-width: auto;
    }
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-shopping-cart card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Siparişler Kısa Yolları
                  </h3>
                  <small class="card-header-subtitle">Sipariş yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php
            $current_url = current_url();
            $current_path = parse_url($current_url, PHP_URL_PATH);
            $base_path = parse_url(base_url(), PHP_URL_PATH);
            $relative_path = str_replace($base_path, '', $current_path);
            $relative_path = trim($relative_path, '/');
            
            $tabs = [
              [
                'url' => base_url("tum-siparisler"),
                'icon' => 'fas fa-list',
                'label' => 'Tüm Siparişler',
                'active' => ($relative_path == 'tum-siparisler' || $relative_path == 'siparis/siparis_kisa_yollar' || empty($relative_path) && strpos($current_url, 'siparis_kisa_yollar') !== false)
              ],
              [
                'url' => base_url("onay-bekleyen-siparisler"),
                'icon' => 'far fa-check-circle',
                'label' => 'Onay Bekleyenler',
                'active' => ($relative_path == 'onay-bekleyen-siparisler' || strpos($relative_path, 'onay-bekleyen-siparisler') !== false)
              ],
              [
                'url' => base_url("siparis/haftalik_kurulum_plan"),
                'icon' => 'far fa-calendar-alt',
                'label' => 'Kurulum Planı',
                'active' => (strpos($relative_path, 'haftalik_kurulum_plan') !== false)
              ],
              [
                'url' => base_url("siparis/hizli_siparis_olustur_view"),
                'icon' => 'fas fa-plus-circle',
                'label' => 'Hızlı Sipariş',
                'active' => (strpos($relative_path, 'hizli_siparis_olustur') !== false)
              ],
              [
                'url' => base_url("cihaz/iptal_edilen_siparisler"),
                'icon' => 'fas fa-ban',
                'label' => 'İptal Edilenler',
                'active' => (strpos($relative_path, 'iptal_edilen_siparisler') !== false)
              ],
              [
                'url' => base_url("siparis/degerlendirme_rapor"),
                'icon' => 'far fa-envelope',
                'label' => 'SMS Sonuçları',
                'active' => (strpos($relative_path, 'degerlendirme_rapor') !== false)
              ]
            ];
          ?>
          <nav class="modern-tabs-nav" role="tablist">
            <div class="modern-tabs-container">
              <?php 
              $tab_count = count($tabs);
              $index = 0;
              foreach($tabs as $tab): 
                $index++;
              ?>
                <a href="<?=$tab['url']?>" 
                   class="modern-tab <?=$tab['active'] ? 'active' : ''?>" 
                   role="tab"
                   aria-selected="<?=$tab['active'] ? 'true' : 'false'?>">
                  <span class="modern-tab-icon">
                    <i class="<?=$tab['icon']?>"></i>
                  </span>
                  <span class="modern-tab-label"><?=$tab['label']?></span>
                </a>
                <?php if($index < $tab_count): ?>
                  <span class="modern-tab-separator">|</span>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </nav>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <!-- Filtreler -->
            <div class="row mb-3 filter-row">
              <form method="GET" action="<?=base_url('siparis/siparis_kisa_yollar')?>" id="filterForm" class="filter-form">
                <div class="row filter-row-inner">
                  <?php if(!isset($is_satis_yetkilisi) || !$is_satis_yetkilisi): ?>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Şehir</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-map-marker-alt"></i>
                        </span>
                      </div>
                      <select name="sehir_id" class="form-control filter-form-control">
                        <option value="">Tümü</option>
                        <?php if(!empty($sehirler)): ?>
                          <?php foreach($sehirler as $sehir): ?>
                            <option value="<?=$sehir->sehir_id?>" <?=isset($selected_sehir_id) && $selected_sehir_id == $sehir->sehir_id ? 'selected' : ''?>>
                              <?=$sehir->sehir_adi?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if(!isset($is_satis_yetkilisi) || !$is_satis_yetkilisi): ?>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Kullanıcı</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <select name="kullanici_id" class="form-control filter-form-control">
                        <option value="">Tümü</option>
                        <?php if(!empty($kullanicilar)): ?>
                          <?php foreach($kullanicilar as $kullanici): ?>
                            <option value="<?=$kullanici->kullanici_id?>" <?=isset($selected_kullanici_id) && $selected_kullanici_id == $kullanici->kullanici_id ? 'selected' : ''?>>
                              <?=$kullanici->kullanici_ad_soyad?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Başlangıç Tarihi</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="date" name="tarih_baslangic" class="form-control filter-form-control" value="<?=isset($selected_tarih_baslangic) ? $selected_tarih_baslangic : ''?>">
                    </div>
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Bitiş Tarihi</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-calendar-check"></i>
                        </span>
                      </div>
                      <input type="date" name="tarih_bitis" class="form-control filter-form-control" value="<?=isset($selected_tarih_bitis) ? $selected_tarih_bitis : ''?>">
                    </div>
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Teslim Durumu</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-truck"></i>
                        </span>
                      </div>
                      <select name="teslim_durumu" class="form-control filter-form-control">
                        <option value="">Tümü</option>
                        <option value="1" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '1' ? 'selected' : ''?>>Teslim Edildi</option>
                        <option value="0" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '0' ? 'selected' : ''?>>Teslim Edilmedi</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2 filter-buttons-wrapper">
                    <button type="submit" class="btn btn-sm filter-btn-primary">
                      <i class="fa fa-filter"></i> Filtrele
                    </button>
                    <a href="<?=base_url('siparis/siparis_kisa_yollar')?>" class="btn btn-secondary btn-sm filter-btn-secondary">
                      <i class="fa fa-times"></i> Temizle
                    </a>
                    <?php if(isset($satis_limitleri_yetki) && $satis_limitleri_yetki): ?>
                    <a href="<?=base_url('fiyat_limit')?>" class="btn btn-sm filter-btn-secondary" style="background:#28a745;color:#fff;margin-top:5px;display:block;">
                      <i class="far fa-check-circle"></i> Satış Limitleri
                    </a>
                    <?php endif; ?>
                  </div>
                </div>
              </form>
            </div>

            <!-- Tüm Siparişler Tablosu -->
            <div class="table-responsive" id="siparis-tablo-container">
              <table id="siparis-tablo" class="siparis-data-table">
                <thead id="siparis-tablo-header" class="siparis-tablo-thead">
                  <tr>
                    <th class="siparis-th">Sipariş Kodu</th> 
                    <th class="siparis-th">Müşteri Adı</th> 
                    <th class="siparis-th">Adres</th>
                    <th class="siparis-th">Siparişi Oluşturan</th>
                    <th class="siparis-th siparis-th-action">İşlem</th> 
                  </tr>
                </thead>
                <tbody id="siparis-tablo-body" class="siparis-tablo-tbody">
                  <!-- DataTable tarafından doldurulacak -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  // Modern Tabs Component - Vanilla JS
  (function() {
    'use strict';
    
    function initModernTabs() {
      const tabsContainer = document.querySelector('.modern-tabs-container');
      if (!tabsContainer) return;
      
      // Scroll kontrolü
      function checkScrollable() {
        const isScrollable = tabsContainer.scrollWidth > tabsContainer.clientWidth;
        tabsContainer.classList.toggle('scrollable', isScrollable);
      }
      
      // Aktif tab'ı görünür alana getir
      function scrollToActiveTab() {
        const activeTab = tabsContainer.querySelector('.modern-tab.active');
        if (activeTab) {
          const containerRect = tabsContainer.getBoundingClientRect();
          const tabRect = activeTab.getBoundingClientRect();
          
          if (tabRect.left < containerRect.left) {
            tabsContainer.scrollLeft = tabsContainer.scrollLeft + (tabRect.left - containerRect.left) - 16;
          } else if (tabRect.right > containerRect.right) {
            tabsContainer.scrollLeft = tabsContainer.scrollLeft + (tabRect.right - containerRect.right) + 16;
          }
        }
      }
      
      // Event listeners
      window.addEventListener('resize', checkScrollable);
      checkScrollable();
      scrollToActiveTab();
      
      // Tab click tracking
      tabsContainer.addEventListener('click', function(e) {
        const tab = e.target.closest('.modern-tab');
        if (tab && !tab.classList.contains('active')) {
          console.log('Tab switched to:', tab.querySelector('.modern-tab-label')?.textContent);
        }
      });
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initModernTabs);
    } else {
      initModernTabs();
    }
  })();
</script>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  // showWindow fonksiyonu - Global scope
  function showWindow(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        if($.fn.DataTable.isDataTable('#siparis-tablo')) {
          var currentPage = $('#siparis-tablo').DataTable().page();
          $('#siparis-tablo').DataTable().ajax.reload(function() {
            $('#siparis-tablo').DataTable().page(currentPage).draw(false);
          });
        } else {
          location.reload();
        }
      }
    }, 1000);
  }

  $(document).ready(function() {
    // DataTables başlatma - Abonelik sayfası gibi temiz yapı
    $('#siparis-tablo').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 25,
      "order": [[0, "desc"]],
      "ajax": {
        "url": "<?php echo site_url('siparis/siparisler_ajax_kisa_yollar'); ?>",
        "type": "GET",
        "data": function(d) {
          d.sehir_id = $('select[name="sehir_id"]').val();
          d.kullanici_id = $('select[name="kullanici_id"]').val();
          d.tarih_baslangic = $('input[name="tarih_baslangic"]').val();
          d.tarih_bitis = $('input[name="tarih_bitis"]').val();
          d.teslim_durumu = $('select[name="teslim_durumu"]').val();
        },
        "error": function(xhr, error, thrown) {
          console.error('DataTable AJAX Error:', error);
          console.error('Error Type:', thrown);
          console.error('Status:', xhr.status);
          console.error('Response:', xhr.responseText);
          alert('Veri yüklenirken bir hata oluştu. Lütfen sayfayı yenileyin veya konsolu kontrol edin.');
        }
      },
      "language": {
        "processing": '<div class="datatables-processing"><i class="fa fa-spinner fa-spin fa-3x datatables-processing-icon"></i><br><span class="datatables-processing-text">Veriler yükleniyor...</span></div>',
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
      },
      "columns": [
        { "data": 0, "orderable": true },
        { "data": 1, "orderable": true },
        { "data": 2, "orderable": true },
        { "data": 3, "orderable": true },
        { "data": 4, "orderable": false }
      ],
      "responsive": {
        "details": {
          "type": "column",
          "target": 0
        },
        "breakpoints": [
          { "name": "desktop", "width": Infinity },
          { "name": "tablet", "width": 1024 },
          { "name": "mobile", "width": 768 }
        ]
      },
      "autoWidth": false,
      "scrollX": true,
      "scrollCollapse": true
    });
    
    // Filtre formu submit
    $('#filterForm').on('submit', function(e) {
      e.preventDefault();
      $('#siparis-tablo').DataTable().ajax.reload();
    });
  });
</script>
