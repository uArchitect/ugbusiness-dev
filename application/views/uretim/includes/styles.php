<style>
  /* ============================================
     CSS Variables - Design System (UMEX Colors)
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
  .content-wrapper-uretim {
    padding-top: 15px;
    background-color: #f8f9fa;
  }

  .card-uretim {
    border: 0;
    border-radius: var(--card-border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    padding: 0;
    margin: 0;
  }

  .card-header-uretim {
    border: 0;
    background: var(--primary-gradient);
    padding: 15px var(--container-padding);
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

  .card-body-uretim {
    padding: 0;
    background-color: #ffffff;
    box-sizing: border-box;
    margin: 0;
  }

  .card-body-uretim .card-body-content {
    padding: 15px;
  }

  .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
    outline: none;
  }

  .input-group-text {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
  }

  .input-group:focus-within .input-group-text {
    background-color: #002a7a;
    border-color: #002a7a;
  }

  .btn-primary {
    background: var(--primary-gradient);
    border-color: var(--primary-color);
  }

  .btn-primary:hover {
    background: #002a7a;
    border-color: #002a7a;
  }

  /* Table Styles */
  .table-uretim {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
  }

  .table-uretim thead {
    background: var(--primary-gradient);
  }

  .table-uretim thead th {
    color: #ffffff;
    font-weight: 600;
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
    font-size: 14px;
    border: none;
    white-space: nowrap;
  }

  .table-uretim tbody tr {
    border-left: 3px solid transparent;
    transition: all 0.2s ease;
    background: #ffffff;
  }

  .table-uretim tbody tr:hover {
    background: #f8f9fa;
    border-left-color: var(--primary-color);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  .table-uretim tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    color: #495057;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
    line-height: 1.5;
  }

  .table-uretim tbody tr:last-child td {
    border-bottom: none;
  }

  /* Filter Styles */
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

