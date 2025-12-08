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
    height: 6px;
  }

  .modern-tabs-container::-webkit-scrollbar-track {
    background: transparent;
  }

  .modern-tabs-container::-webkit-scrollbar-thumb {
    background-color: var(--tab-separator-color);
    border-radius: 3px;
  }

  .modern-tab {
    display: flex;
    align-items: center;
    padding: var(--tab-padding-y) var(--tab-padding-x);
    color: var(--tab-color-default);
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    white-space: nowrap;
    transition: all 0.2s ease;
    border-bottom: 2px solid transparent;
    position: relative;
    background: transparent;
    cursor: pointer;
    border: none;
    border-radius: 0;
    box-shadow: none;
  }

  .modern-tab:hover {
    color: var(--tab-color-hover);
    background-color: var(--tab-bg-hover);
  }

  .modern-tab.active {
    color: var(--tab-color-active);
    background-color: var(--tab-bg-active);
    border-bottom-color: var(--tab-color-active);
    font-weight: 600;
  }

  .modern-tab-icon {
    margin-right: 8px;
    font-size: 16px;
    display: flex;
    align-items: center;
  }

  .modern-tab-label {
    line-height: 1.5;
  }

  .modern-tab-separator {
    color: var(--tab-separator-color);
    padding: 0 8px;
    user-select: none;
    display: flex;
    align-items: center;
  }

  /* ============================================
     Content Wrapper & Card Styles
     ============================================ */
  .content-wrapper-egitim {
    padding-top: 25px;
    background-color: #f8f9fa;
  }

  .card-egitim {
    border: 0;
    border-radius: var(--card-border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    padding: 0;
    margin: 0;
  }

  .card-header-egitim {
    background: var(--primary-gradient);
    color: #ffffff;
    padding: 20px var(--container-padding);
    border-bottom: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .card-header-icon-wrapper {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.2);
    margin-right: 15px;
  }

  .card-header-icon {
    font-size: 24px;
    color: #ffffff;
  }

  .card-header-title {
    color: #ffffff;
    font-size: 20px;
    font-weight: 600;
    margin: 0;
  }

  .card-header-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px;
    margin-top: 2px;
  }

  .card-body-egitim {
    padding: 0;
    background-color: #ffffff;
    box-sizing: border-box;
    margin: 0;
  }

  .card-body-egitim .card-body-content {
    padding: var(--container-padding);
  }

  .table-egitim {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
  }

  .table-egitim thead {
    background: var(--primary-gradient);
  }

  .table-egitim thead th {
    color: #ffffff;
    font-weight: 600;
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
    font-size: 14px;
    border: none;
    white-space: nowrap;
  }

  .table-egitim tbody tr {
    border-left: 3px solid transparent;
    transition: all 0.2s ease;
    background: #ffffff;
  }

  .table-egitim tbody tr:hover {
    background: #f8f9fa;
    border-left-color: var(--primary-color);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  .table-egitim tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    color: #495057;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
    line-height: 1.5;
  }

  .table-egitim tbody tr:last-child td {
    border-bottom: none;
  }

  /* ============================================
     Responsive Design
     ============================================ */
  @media (max-width: 768px) {
    :root {
      --tab-height: 48px;
      --tab-padding-x: 15px;
      --tab-padding-y: 12px;
      --container-padding: 15px;
    }

    .card-header-egitim {
      padding: 15px var(--container-padding);
    }

    .card-header-title {
      font-size: 18px;
    }

    .card-header-subtitle {
      font-size: 12px;
    }

    .modern-tab {
      font-size: 13px;
    }

    .modern-tab-icon {
      font-size: 14px;
      margin-right: 6px;
    }
  }

  @media (max-width: 576px) {
    :root {
      --tab-padding-x: 12px;
      --tab-padding-y: 10px;
      --container-padding: 12px;
    }

    .card-header-title {
      font-size: 16px;
    }

    .modern-tab {
      font-size: 12px;
      padding: 10px 12px;
    }
  }
</style>

