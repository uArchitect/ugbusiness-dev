 
<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" dir="ltr" lang="en">
 <head><base href="../../">
  <title>
   UGAjans - Kurumsal ERP Sistemi  </title>
  <meta charset="utf-8"/>
  <meta content="follow, index" name="robots"/>
  <link href="https://127.0.0.1:8001/metronic-tailwind-html/demo1/index.html" rel="canonical"/>
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
  <meta content="" name="description"/>
  <meta content="@keenthemes" name="twitter:site"/>
  <meta content="@keenthemes" name="twitter:creator"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="Metronic - Tailwind CSS " name="twitter:title"/>
  <meta content="" name="twitter:description"/>
  <meta content="<?=base_url("ugajansassets")?>/assets/media/app/og-image.png" name="twitter:image"/>
  <meta content="https://127.0.0.1:8001/metronic-tailwind-html/demo1/index.html" property="og:url"/>
  <meta content="en_US" property="og:locale"/>
  <meta content="website" property="og:type"/>
  <meta content="@keenthemes" property="og:site_name"/>
  <meta content="Metronic - Tailwind CSS " property="og:title"/>
  <meta content="" property="og:description"/>
  <meta content="<?=base_url("ugajansassets")?>/assets/media/app/og-image.png" property="og:image"/>
  <link href="<?=base_url("ugajansassets")?>/assets/media/app/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180"/>
  <link href="<?=base_url("ugajansassets")?>/assets/media/app/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png"/>
  <link href="<?=base_url("ugajansassets")?>/assets/media/app/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png"/>
  <link href="<?=base_url("ugajansassets")?>/assets/media/app/favicon.ico" rel="shortcut icon"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link href="<?=base_url("ugajansassets")?>/assets/vendors/apexcharts/apexcharts.css" rel="stylesheet"/>
  <link href="<?=base_url("ugajansassets")?>/assets/vendors/keenicons/styles.bundle.css" rel="stylesheet"/>
  <link href="<?=base_url("ugajansassets")?>/assets/css/styles.css" rel="stylesheet"/>
  <style>
        .demo1.sidebar-fixed .wrapper {
        padding-inline-start: 0;
    }
    .swal2-title{
      font-size: 23px;
    }
    @media (min-width: 1280px) {
      .container-fixed {
        margin-inline-start: auto;
        margin-inline-end: auto;
        padding-inline-start: 1.875rem;
        padding-inline-end: 1.875rem;
        max-width: 70%;
    }
}
    
    </style>
 </head>
 <body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] [--tw-page-bg-dark:var(--tw-coal-500)] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">
  <!-- Theme Mode -->
  <script>
   const defaultThemeMode = 'light'; // light|dark|system
		let themeMode;

		if ( document.documentElement ) {
			if ( localStorage.getItem('theme')) {
					themeMode = localStorage.getItem('theme');
			} else if ( document.documentElement.hasAttribute('data-theme-mode')) {
				themeMode = document.documentElement.getAttribute('data-theme-mode');
			} else {
				themeMode = defaultThemeMode;
			}

			if (themeMode === 'system') {
				themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
			}

			document.documentElement.classList.add(themeMode);
		}
  </script>
  <!-- End of Theme Mode -->
  <!-- Page -->
  <!-- Main -->
  <div class="flex grow">
   <!-- Sidebar -->
   <div style="display:none" class="sidebar dark:bg-coal-600 bg-light border-e border-e-gray-200 dark:border-e-coal-100 fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0" data-drawer="true" data-drawer-class="drawer drawer-start top-0 bottom-0" data-drawer-enable="true|lg:false" id="sidebar">
    <div class="sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0" id="sidebar_header">
     <a class="dark:hidden" href="<?=base_url("ugajans_anasayfa")?>">
   <!--   <img class="default-logo min-h-[22px] max-w-none" src="<?=base_url("ugajansassets")?>/assets/media/app/default-logo.svg"/>
      <img class="small-logo min-h-[22px] max-w-none" src="<?=base_url("ugajansassets")?>/assets/media/app/mini-logo.svg"/> -->
     <span style="font-size:30px;font-weight:bold"> UGAJANS</span>
     </a>
     <a class="hidden dark:block" href="<?=base_url("ugajans_")?>">
    <!--  <img class="default-logo min-h-[22px] max-w-none" src="<?=base_url("ugajansassets")?>/assets/media/app/default-logo-dark.svg"/>
      <img class="small-logo min-h-[22px] max-w-none" src="<?=base_url("ugajansassets")?>/assets/media/app/mini-logo.svg"/>-->
     </a>
     <button class="btn btn-icon btn-icon-md size-[30px] rounded-lg border border-gray-200 dark:border-gray-300 bg-light text-gray-500 hover:text-gray-700 toggle absolute start-full top-2/4 -translate-x-2/4 -translate-y-2/4 rtl:translate-x-2/4" data-toggle="body" data-toggle-class="sidebar-collapse" id="sidebar_toggle">
      <i class="ki-filled ki-black-left-line toggle-active:rotate-180 transition-all duration-300 rtl:translate rtl:rotate-180 rtl:toggle-active:rotate-0">
      </i>
     </button>
    </div>
    <div class="sidebar-content flex grow shrink-0 py-5 pe-2" id="sidebar_content">
     <div class="scrollable-y-hover grow shrink-0 flex ps-2 lg:ps-5 pe-1 lg:pe-3" data-scrollable="true" data-scrollable-dependencies="#sidebar_header" data-scrollable-height="auto" data-scrollable-offset="0px" data-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
      <!-- Sidebar Menu -->
      <div class="menu flex flex-col grow gap-0.5" data-menu="true" data-menu-accordion-expand-all="false" id="sidebar_menu">
       <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
        <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" tabindex="0">
         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
          <i class="ki-filled ki-element-11 text-lg">
          </i>
         </span>
         <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
          Genel Bakış
         </span>
         <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ms-1 me-[-10px]">
          <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
          </i>
          <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
          </i>
         </span>
        </div>
        <div class="menu-accordion gap-0.5 ps-[10px] relative before:absolute before:start-[20px] before:top-0 before:bottom-0 before:border-s before:border-gray-200">
         <div class="menu-item">
          <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] ps-[10px] pe-[10px] py-[8px]" href="html/demo1.html" tabindex="0">
           <span class="menu-bullet flex w-[6px] -start-[3px] rtl:start-0 relative before:absolute before:top-0 before:size-[6px] before:rounded-full rtl:before:translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
           </span>
           <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
            Light Sidebar
           </span>
          </a>
         </div>
         <div class="menu-item">
          <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] ps-[10px] pe-[10px] py-[8px]" href="html/demo1/dashboards/dark-sidebar.html" tabindex="0">
           <span class="menu-bullet flex w-[6px] -start-[3px] rtl:start-0 relative before:absolute before:top-0 before:size-[6px] before:rounded-full rtl:before:translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
           </span>
           <span class="menu-title text-2sm font-normal text-gray-800 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
            Dark Sidebar
           </span>
          </a>
         </div>
        </div>
       </div>
         
       <div class="menu-item pt-2.25 pb-px">
        <span class="menu-heading uppercase text-2sm font-medium text-gray-500 ps-[10px] pe-[10px]">
         Müşterİ
        </span>
       </div>
       <div class="menu-item">
        <div class="menu-label border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" href="" tabindex="0">
         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
          <i class="ki-filled ki-users text-lg">
          </i>
         </span>
         <a href="<?=base_url("ugajans_musteri")?>"><span class="menu-title text-sm font-medium text-gray-800">
          Müşteri Yönetimi
         </span></a>
         
        </div>
       </div>
       <div class="menu-item">
        <div class="menu-label border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" href="" tabindex="0">
         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
          <i class="ki-filled ki-questionnaire-tablet text-lg">
          </i>
         </span>
         <span class="menu-title text-sm font-medium text-gray-800">
          Talepler
         </span>
         
        </div>
       </div>
       <div class="menu-item">
        <div class="menu-label border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" href="" tabindex="0">
         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
          <i class="ki-filled ki-handcart text-lg">
          </i>
         </span>
         <span class="menu-title text-sm font-medium text-gray-800">
          Teklif Yönetimi
         </span>
          
        </div>
       </div>




	   <div class="menu-item pt-2.25 pb-px">
        <span class="menu-heading uppercase text-2sm font-medium text-gray-500 ps-[10px] pe-[10px]">
         KULLANICI
        </span>
       </div>
       <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
        <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" tabindex="0">
         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
          <i class="ki-filled ki-profile-circle text-lg">
          </i>
         </span>
         <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
          Profili Görüntüle
         </span>
         
        </div>
     
       </div>



       <div class="menu-item pt-2.25 pb-px">
        <span class="menu-heading uppercase text-2sm font-medium text-gray-500 ps-[10px] pe-[10px]">
         HIZLI ERİŞİM
        </span>
       </div>
       <div class="menu-item">
        <div class="menu-label border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" href="" tabindex="0">
         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
          <i class="ki-filled ki-some-files text-lg">
          </i>
         </span>
         <span class="menu-title text-sm font-medium text-gray-800">
          Modals
         </span>
         <span class="menu-badge me-[-10px]">
          <span class="badge badge-xs">
           Soon
          </span>
         </span>
        </div>
       </div>
       <div class="menu-item">
        <div class="menu-label border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" href="" tabindex="0">
         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
          <i class="ki-filled ki-note-2 text-lg">
          </i>
         </span>
         <span class="menu-title text-sm font-medium text-gray-800">
          Wizards
         </span>
         <span class="menu-badge me-[-10px]">
          <span class="badge badge-xs">
           Soon
          </span>
         </span>
        </div>
       </div>
      </div>
      <!-- End of Sidebar Menu -->
     </div>
    </div>
   </div>
   <!-- End of Sidebar -->
   <!-- Wrapper -->
   <div class="wrapper flex grow flex-col">
    <!-- Header -->
    <header class="header fixed top-0 z-10 start-0 end-0 flex items-stretch shrink-0  dark:bg-[--tw-page-bg] bg-[--tw-page-bg-dark] " data-sticky="true" style="     background: #161619;   padding-top: 9px;
    inset-inline-start: 0;" data-sticky-class="shadow-sm" data-sticky-name="header" id="header">
     <!-- Container -->
     <div class="container-fixed flex justify-between items-stretch lg:gap-4" id="header_container">
      <!-- Mobile Logo -->
      <div class="flex gap-1 lg:hidden items-center -ms-1">
       
       <div class="flex items-center">
        <a class="btn  " style="    color: white;"  href="<?=base_url("ugajans_anasayfa")?>">
         <i class="ki-filled ki-menu">
         </i>
         Anasayfa
        </a>
        <a class="btn  " style="    color: white;"   href="<?=base_url("ugajans_musteri")?>" >
         <i class="ki-filled ki-burger-menu-2">
         </i>
         Müşteriler
        </a>
        <a class="btn  " style="    color: white;"   href="<?=base_url("ugajans_talep")?>" >
         <i class="ki-filled ki-burger-menu-2">
         </i>
         Talepler
        </a>
       </div>
      </div>
      <!-- End of Mobile Logo -->
      <!--Megamenu Contaoner-->
      <div class="flex items-stretch" id="mega_menu_container">
       <!--Megamenu Inner-->
       <div class="flex items-stretch" data-reparent="true" data-reparent-mode="prepend|lg:prepend" data-reparent-target="body|lg:#mega_menu_container">
        <!--Megamenu Wrapper-->
        <div class="  lg:flex lg:items-stretch" data-drawer="true" data-drawer-class="drawer drawer-start fixed z-10 top-0 bottom-0 w-full me-5 max-w-[250px] p-5 lg:p-0 overflow-auto" data-drawer-enable="true|lg:false" id="mega_menu_wrapper">
         <!--Megamenu-->






         <div class="flex items-center justify-end grow lg:grow-0 lg:pb-4 gap-2.5 mb-3 lg:mb-0">
        
         <a class=" text-2xl" href="<?=base_url("ugajans_anasayfa")?>" style="font-weight: 400; font-size: 30px;margin-right:50px; color:white">
               <b>UG</b>AJANS             </a>
        
         <a class="dropdown-toggle btn btn-sm <?=$page == "anasayfa" ? "btn-light" : "btn-dark"?> " href="<?=base_url("ugajans_anasayfa")?>">
         <i class="ki-filled ki-home">
         </i>
         Anasayfa
        </a>
        <a class="  btn   <?=$page == "musteri_liste" ? "btn-light" : "btn-dark"?> " href="<?=base_url("ugajans_musteri")?>">
        <i class="ki-filled ki-users">
        </i>
         Müşteriler
      </a>
      <a class=" btn  <?=$page == "talepler" ? "btn-light" : "btn-dark"?>   "   href="<?=base_url("ugajans_talep")?>">
         <i class="ki-filled ki-questionnaire-tablet">
        </i>
         Talepler
      </a>
      <a class=" btn  " >
      <i class="ki-filled ki-users">
        </i>
         UGAjans Ekip (Hazırlanıyor)
      </a>
       </div>
 
         <!--End of Megamenu-->
        </div>
        <!--End of Megamenu Wrapper-->
       </div>
       <!--End of Megamenu Inner-->
      </div>
      <!--End of Megamenu Contaoner-->
      <!-- Topbar -->
      <div class="flex items-center gap-2 lg:gap-3.5">
        
         
       <div class="menu" data-menu="true">
        <div class="menu-item" data-menu-item-offset="20px, 10px" data-menu-item-offset-rtl="-20px, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" style="    width: 100%;" data-menu-item-trigger="click|lg:click">
         <div style="  color:white;  width: 100%;" class="menu-toggle btn btn-icon rounded-full">
          <img style="margin-right:10px" alt="" class="size-9 rounded-full border-2 border-success shrink-0" src="<?=base_url(ugajans_aktif_kullanici()->ugajans_kullanici_gorsel)?>">
          </img>     <?=ugajans_aktif_kullanici()->ugajans_kullanici_ad_soyad?> <br> <span style="    color: #8f8f8f;
    margin-top: 5px;    display: contents;opacity:0.5"><?=ugajans_aktif_kullanici()->ugajans_kullanici_unvan?></span>
         </div>
         <div class="menu-dropdown menu-default light:border-gray-300 w-screen max-w-[250px]">
          <div class="flex items-center justify-between px-5 py-1.5 gap-1.5">
           <div class="flex items-center gap-2">
            <img alt="" class="size-9 rounded-full border-2 border-success" src="<?=base_url(ugajans_aktif_kullanici()->ugajans_kullanici_gorsel)?>">
             <div class="flex flex-col gap-1.5">
              <span class="text-sm text-gray-800 font-semibold leading-none">
               <?=ugajans_aktif_kullanici()->ugajans_kullanici_ad_soyad?>
              </span>
              <a class="text-xs text-gray-600 hover:text-primary font-medium leading-none" href="html/demo1/account/home/get-started.html">
              @<?=ugajans_aktif_kullanici()->ugajans_kullanici_adi?>
              </a>
             </div>
            </img>
           </div>
           
          </div>
          <div class="menu-separator">
          </div>
           
          <div class="menu-separator">
          </div>
          <div class="flex flex-col">
           <div class="menu-item mb-0.5">
            <div class="menu-link">
             <span class="menu-icon">
              <i class="ki-filled ki-moon">
              </i>
             </span>
             <span class="menu-title">
              Koyu Tema
             </span>
             <label class="switch switch-sm">
              <input data-theme-state="dark" data-theme-toggle="true" name="check" type="checkbox" value="1">
              </input>
             </label>
            </div>
           </div>
           <div class="menu-item px-4 py-1.5">
            <a class="btn btn-sm btn-light justify-center" href="<?=base_url("ugajans_logout")?>">
             Oturumu Sonlandır
            </a>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <!-- End of Topbar -->
     </div>
     <!-- End of Container -->
    </header>
    <!-- End of Header -->
    <!-- Content -->
    <main class="grow content pt-5" id="content" role="content">
     <?php $this->load->view($page); ?>
    </main>
    <!-- End of Content -->
    <!-- Footer -->
    <footer class="footer">
     <!-- Container -->
     <div class="container-fixed">
      <div class="flex flex-col md:flex-row justify-center md:justify-between items-center gap-3 py-5">
       <div class="flex order-2 md:order-1 gap-2 font-normal text-2sm">
        <span class="text-gray-500">
         2025©
        </span>
        <a class="text-gray-600 hover:text-primary" href="https://keenthemes.com">
        UG Yazılım tarafından geliştirilmiştir.      </a>
       </div>
       <nav class="flex order-1 md:order-2 gap-4 font-normal text-2sm text-gray-600">
        <a class="hover:text-primary" target="_blank" href="https://umex.com.tr">
         umex.com.tr
        </a>
        <a class="hover:text-primary" target="_blank" href="https://ugajans.com">
         ugajans.com
        </a>
         
       </nav>
      </div>
     </div>
     <!-- End of Container -->
    </footer>
    <!-- End of Footer -->
   </div>
   <!-- End of Wrapper -->
  </div>
  <!-- End of Main -->
  <div class="modal" data-modal="true" id="search_modal">
   <div class="modal-content max-w-[600px] top-[15%]">
    <div class="modal-header py-4 px-5">
     <i class="ki-filled ki-magnifier text-gray-700 text-xl">
     </i>
     <input class="input px-0 border-none bg-transparent shadow-none ms-2.5" name="query" placeholder="Tap to start search" type="text" value=""/>
     <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
      <i class="ki-filled ki-cross">
      </i>
     </button>
    </div>
    <div class="modal-body p-0 pb-5">
     <div class="tabs justify-between px-5 mb-2.5" data-tabs="true">
      <div class="flex items-center gap-5">
       <button class="tab py-5 active" data-tab-toggle="#search_modal_mixed">
        Mixed
       </button>
       <button class="tab py-5" data-tab-toggle="#search_modal_settings">
        Settings
       </button>
       <button class="tab py-5" data-tab-toggle="#search_modal_integrations">
        Integrations
       </button>
       <button class="tab py-5" data-tab-toggle="#search_modal_users">
        Users
       </button>
       <button class="tab py-5" data-tab-toggle="#search_modal_docs">
        Docs
       </button>
       <button class="tab py-5" data-tab-toggle="#search_modal_empty">
        Empty
       </button>
       <button class="tab py-5" data-tab-toggle="#search_modal_no-results">
        No Results
       </button>
      </div>
      <div class="menu -mt-px" data-menu="true">
       <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:hover">
        <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
         <i class="ki-filled ki-setting-2">
         </i>
        </button>
        <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
         <div class="menu-item">
          <a class="menu-link" href="#">
           <span class="menu-icon">
            <i class="ki-filled ki-document">
            </i>
           </span>
           <span class="menu-title">
            View
           </span>
          </a>
         </div>
         <div class="menu-item" data-menu-item-offset="-15px, 0" data-menu-item-placement="right-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:hover">
          <div class="menu-link">
           <span class="menu-icon">
            <i class="ki-filled ki-notification-status">
            </i>
           </span>
           <span class="menu-title">
            Export
           </span>
           <span class="menu-arrow">
            <i class="ki-filled ki-right text-3xs rtl:transform rtl:rotate-180">
            </i>
           </span>
          </div>
          <div class="menu-dropdown menu-default w-full max-w-[175px]">
           <div class="menu-item">
            <a class="menu-link" href="html/demo1/account/home/settings-sidebar.html">
             <span class="menu-icon">
              <i class="ki-filled ki-sms">
              </i>
             </span>
             <span class="menu-title">
              Email
             </span>
            </a>
           </div>
           <div class="menu-item">
            <a class="menu-link" href="html/demo1/account/home/settings-sidebar.html">
             <span class="menu-icon">
              <i class="ki-filled ki-message-notify">
              </i>
             </span>
             <span class="menu-title">
              SMS
             </span>
            </a>
           </div>
           <div class="menu-item">
            <a class="menu-link" href="html/demo1/account/home/settings-sidebar.html">
             <span class="menu-icon">
              <i class="ki-filled ki-notification-status">
              </i>
             </span>
             <span class="menu-title">
              Push
             </span>
            </a>
           </div>
          </div>
         </div>
         <div class="menu-item">
          <a class="menu-link" href="#">
           <span class="menu-icon">
            <i class="ki-filled ki-pencil">
            </i>
           </span>
           <span class="menu-title">
            Edit
           </span>
          </a>
         </div>
         <div class="menu-item">
          <a class="menu-link" href="#">
           <span class="menu-icon">
            <i class="ki-filled ki-trash">
            </i>
           </span>
           <span class="menu-title">
            Delete
           </span>
          </a>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="scrollable-y-auto" data-scrollable="true" data-scrollable-max-height="auto" data-scrollable-offset="300px">
      <div class="" id="search_modal_mixed">
       <div class="flex flex-col gap-2.5">
        <div>
         <div class="text-xs text-gray-600 font-medium pt-2.5 pb-1.5 ps-5">
          Settings
         </div>
         <div class="menu menu-default p-0 flex-col">
          <div class="menu-item">
           <a class="menu-link" href="#">
            <span class="menu-icon">
             <i class="ki-filled ki-badge">
             </i>
            </span>
            <span class="menu-title">
             Public Profile
            </span>
           </a>
          </div>
          <div class="menu-item">
           <a class="menu-link" href="#">
            <span class="menu-icon">
             <i class="ki-filled ki-setting-2">
             </i>
            </span>
            <span class="menu-title">
             My Account
            </span>
           </a>
          </div>
          <div class="menu-item">
           <a class="menu-link" href="#">
            <span class="menu-icon">
             <i class="ki-filled ki-message-programming">
             </i>
            </span>
            <span class="menu-title">
             Devs Forum
            </span>
           </a>
          </div>
         </div>
        </div>
        <div class="border-b border-b-gray-200">
        </div>
        <div>
         <div class="text-xs text-gray-600 font-medium pt-2.5 pb-1.5 ps-5">
          Integrations
         </div>
         <div class="menu menu-default p-0 flex-col">
          <div class="menu-item">
           <div class="menu-link flex items-center jistify-between gap-2">
            <div class="flex items-center grow gap-2">
             <div class="flex items-center justify-center size-10 shrink-0 rounded-full border border-gray-200 bg-gray-100">
              <img alt="" class="size-6 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/brand-logos/jira.svg"/>
             </div>
             <div class="flex flex-col gap-0.5">
              <a class="text-2sm font-semibold text-gray-900 hover:text-primary-active" href="#">
               Jira
              </a>
              <span class="text-2xs font-medium text-gray-600">
               Project management
              </span>
             </div>
            </div>
            <div class="flex justify-end shrink-0">
             <div class="flex -space-x-2">
              <div class="flex">
               <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-4.png"/>
              </div>
              <div class="flex">
               <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-1.png"/>
              </div>
              <div class="flex">
               <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-2.png"/>
              </div>
              <div class="flex">
               <span class="hover:z-5 relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-3xs size-6 text-success-inverse size-6 ring-success-light bg-success">
                +3
               </span>
              </div>
             </div>
            </div>
           </div>
          </div>
          <div class="menu-item">
           <div class="menu-link flex items-center jistify-between gap-2">
            <div class="flex items-center grow gap-2">
             <div class="flex items-center justify-center size-10 shrink-0 rounded-full border border-gray-200 bg-gray-100">
              <img alt="" class="size-6 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/brand-logos/inferno.svg"/>
             </div>
             <div class="flex flex-col gap-0.5">
              <a class="text-2sm font-semibold text-gray-900 hover:text-primary-active" href="#">
               Inferno
              </a>
              <span class="text-2xs font-medium text-gray-600">
               Real-time photo sharing app
              </span>
             </div>
            </div>
            <div class="flex justify-end shrink-0">
             <div class="flex -space-x-2">
              <div class="flex">
               <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-14.png"/>
              </div>
              <div class="flex">
               <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-12.png"/>
              </div>
              <div class="flex">
               <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-9.png"/>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="border-b border-b-gray-200">
        </div>
        <div>
         <div class="text-xs text-gray-600 font-medium pt-2.5 pb-1.5 ps-5">
          Users
         </div>
         <div class="menu menu-default p-0 flex-col">
          <div class="grid gap-1">
           <div class="menu-item">
            <div class="menu-link flex justify-between gap-2">
             <div class="flex items-center gap-2.5">
              <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-3.png"/>
              <div class="flex flex-col">
               <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
                Tyler Hero
               </a>
               <span class="text-2sm font-normal text-gray-500">
                tyler.hero@gmail.com connections
               </span>
              </div>
             </div>
             <div class="flex items-center gap-2.5">
              <div class="badge badge-pill badge-outline badge-success gap-1.5">
               <span class="badge badge-dot badge-success size-1.5">
               </span>
               In Office
              </div>
              <button class="btn btn-icon btn-light btn-clear btn-sm">
               <i class="ki-filled ki-dots-vertical">
               </i>
              </button>
             </div>
            </div>
           </div>
           <div class="menu-item">
            <div class="menu-link flex justify-between gap-2">
             <div class="flex items-center gap-2.5">
              <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-1.png"/>
              <div class="flex flex-col">
               <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
                Esther Howard
               </a>
               <span class="text-2sm font-normal text-gray-500">
                esther.howard@gmail.com connections
               </span>
              </div>
             </div>
             <div class="flex items-center gap-2.5">
              <div class="badge badge-pill badge-outline badge-danger gap-1.5">
               <span class="badge badge-dot badge-danger size-1.5">
               </span>
               On Leave
              </div>
              <button class="btn btn-icon btn-light btn-clear btn-sm">
               <i class="ki-filled ki-dots-vertical">
               </i>
              </button>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="hidden" id="search_modal_settings">
       <div class="menu menu-default p-0 flex-col">
        <div class="text-xs text-gray-600 font-medium pt-2.5 ps-5 pb-1.5">
         Shortcuts
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-home-2">
           </i>
          </span>
          <span class="menu-title">
           Go to Dashboard
          </span>
         </a>
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-badge">
           </i>
          </span>
          <span class="menu-title">
           Public Profile
          </span>
         </a>
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-profile-circle">
           </i>
          </span>
          <span class="menu-title">
           My Profile
          </span>
         </a>
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-setting-2">
           </i>
          </span>
          <span class="menu-title">
           My Account
          </span>
         </a>
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-message-programming">
           </i>
          </span>
          <span class="menu-title">
           Devs Forum
          </span>
         </a>
        </div>
        <div class="text-xs text-gray-600 font-medium pt-2.5 ps-5 pt-2.5 pb-1.5">
         Actions
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-user">
           </i>
          </span>
          <span class="menu-title">
           Create User
          </span>
         </a>
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-user-edit">
           </i>
          </span>
          <span class="menu-title">
           Create Team
          </span>
         </a>
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-subtitle">
           </i>
          </span>
          <span class="menu-title">
           Change Plan
          </span>
         </a>
        </div>
        <div class="menu-item">
         <a class="menu-link" href="#">
          <span class="menu-icon">
           <i class="ki-filled ki-setting">
           </i>
          </span>
          <span class="menu-title">
           Setup Branding
          </span>
         </a>
        </div>
       </div>
      </div>
      <div class="hidden" id="search_modal_integrations">
       <div class="menu menu-default p-0 flex-col">
        <div class="menu-item">
         <div class="menu-link flex items-center jistify-between gap-2">
          <div class="flex items-center grow gap-2">
           <div class="flex items-center justify-center size-10 shrink-0 rounded-full border border-gray-200 bg-gray-100">
            <img alt="" class="size-6 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/brand-logos/jira.svg"/>
           </div>
           <div class="flex flex-col gap-0.5">
            <a class="text-2sm font-semibold text-gray-900 hover:text-primary-active" href="#">
             Jira
            </a>
            <span class="text-2xs font-medium text-gray-600">
             Project management
            </span>
           </div>
          </div>
          <div class="flex justify-end shrink-0">
           <div class="flex -space-x-2">
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-4.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-1.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-2.png"/>
            </div>
            <div class="flex">
             <span class="hover:z-5 relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-3xs size-6 text-success-inverse size-6 ring-success-light bg-success">
              +3
             </span>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="menu-item">
         <div class="menu-link flex items-center jistify-between gap-2">
          <div class="flex items-center grow gap-2">
           <div class="flex items-center justify-center size-10 shrink-0 rounded-full border border-gray-200 bg-gray-100">
            <img alt="" class="size-6 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/brand-logos/inferno.svg"/>
           </div>
           <div class="flex flex-col gap-0.5">
            <a class="text-2sm font-semibold text-gray-900 hover:text-primary-active" href="#">
             Inferno
            </a>
            <span class="text-2xs font-medium text-gray-600">
             Real-time photo sharing app
            </span>
           </div>
          </div>
          <div class="flex justify-end shrink-0">
           <div class="flex -space-x-2">
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-14.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-12.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-9.png"/>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="menu-item">
         <div class="menu-link flex items-center jistify-between gap-2">
          <div class="flex items-center grow gap-2">
           <div class="flex items-center justify-center size-10 shrink-0 rounded-full border border-gray-200 bg-gray-100">
            <img alt="" class="size-6 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/brand-logos/evernote.svg"/>
           </div>
           <div class="flex flex-col gap-0.5">
            <a class="text-2sm font-semibold text-gray-900 hover:text-primary-active" href="#">
             Evernote
            </a>
            <span class="text-2xs font-medium text-gray-600">
             Notes management app
            </span>
           </div>
          </div>
          <div class="flex justify-end shrink-0">
           <div class="flex -space-x-2">
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-6.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-3.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-1.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-8.png"/>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="menu-item">
         <div class="menu-link flex items-center jistify-between gap-2">
          <div class="flex items-center grow gap-2">
           <div class="flex items-center justify-center size-10 shrink-0 rounded-full border border-gray-200 bg-gray-100">
            <img alt="" class="size-6 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/brand-logos/gitlab.svg"/>
           </div>
           <div class="flex flex-col gap-0.5">
            <a class="text-2sm font-semibold text-gray-900 hover:text-primary-active" href="#">
             Gitlab
            </a>
            <span class="text-2xs font-medium text-gray-600">
             Notes management app
            </span>
           </div>
          </div>
          <div class="flex justify-end shrink-0">
           <div class="flex -space-x-2">
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-18.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-17.png"/>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="menu-item">
         <div class="menu-link flex items-center jistify-between gap-2">
          <div class="flex items-center grow gap-2">
           <div class="flex items-center justify-center size-10 shrink-0 rounded-full border border-gray-200 bg-gray-100">
            <img alt="" class="size-6 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/brand-logos/google-webdev.svg"/>
           </div>
           <div class="flex flex-col gap-0.5">
            <a class="text-2sm font-semibold text-gray-900 hover:text-primary-active" href="#">
             Google webdev
            </a>
            <span class="text-2xs font-medium text-gray-600">
             Building web expierences
            </span>
           </div>
          </div>
          <div class="flex justify-end shrink-0">
           <div class="flex -space-x-2">
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-14.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-20.png"/>
            </div>
            <div class="flex">
             <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-21.png"/>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="menu-item px-4 pt-2">
         <a class="btn btn-sm btn-light justify-center" href="#">
          Go to Apps
         </a>
        </div>
       </div>
      </div>
      <div class="hidden" id="search_modal_users">
       <div class="menu menu-default p-0 flex-col">
        <div class="grid gap-1">
         <div class="menu-item">
          <div class="menu-link flex justify-between gap-2">
           <div class="flex items-center gap-2.5">
            <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-3.png"/>
            <div class="flex flex-col">
             <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
              Tyler Hero
             </a>
             <span class="text-2sm font-normal text-gray-500">
              tyler.hero@gmail.com connections
             </span>
            </div>
           </div>
           <div class="flex items-center gap-2.5">
            <div class="badge badge-pill badge-outline badge-success gap-1.5">
             <span class="badge badge-dot badge-success size-1.5">
             </span>
             In Office
            </div>
            <button class="btn btn-icon btn-light btn-clear btn-sm">
             <i class="ki-filled ki-dots-vertical">
             </i>
            </button>
           </div>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex justify-between gap-2">
           <div class="flex items-center gap-2.5">
            <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-1.png"/>
            <div class="flex flex-col">
             <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
              Esther Howard
             </a>
             <span class="text-2sm font-normal text-gray-500">
              esther.howard@gmail.com connections
             </span>
            </div>
           </div>
           <div class="flex items-center gap-2.5">
            <div class="badge badge-pill badge-outline badge-danger gap-1.5">
             <span class="badge badge-dot badge-danger size-1.5">
             </span>
             On Leave
            </div>
            <button class="btn btn-icon btn-light btn-clear btn-sm">
             <i class="ki-filled ki-dots-vertical">
             </i>
            </button>
           </div>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex justify-between gap-2">
           <div class="flex items-center gap-2.5">
            <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-11.png"/>
            <div class="flex flex-col">
             <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
              Jacob Jones
             </a>
             <span class="text-2sm font-normal text-gray-500">
              jacob.jones@gmail.com connections
             </span>
            </div>
           </div>
           <div class="flex items-center gap-2.5">
            <div class="badge badge-pill badge-outline badge-primary gap-1.5">
             <span class="badge badge-dot badge-primary size-1.5">
             </span>
             Remote
            </div>
            <button class="btn btn-icon btn-light btn-clear btn-sm">
             <i class="ki-filled ki-dots-vertical">
             </i>
            </button>
           </div>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex justify-between gap-2">
           <div class="flex items-center gap-2.5">
            <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-5.png"/>
            <div class="flex flex-col">
             <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
              TLeslie Alexander
             </a>
             <span class="text-2sm font-normal text-gray-500">
              leslie.alexander@gmail.com connections
             </span>
            </div>
           </div>
           <div class="flex items-center gap-2.5">
            <div class="badge badge-pill badge-outline badge-success gap-1.5">
             <span class="badge badge-dot badge-success size-1.5">
             </span>
             In Office
            </div>
            <button class="btn btn-icon btn-light btn-clear btn-sm">
             <i class="ki-filled ki-dots-vertical">
             </i>
            </button>
           </div>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex justify-between gap-2">
           <div class="flex items-center gap-2.5">
            <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-2.png"/>
            <div class="flex flex-col">
             <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
              Cody Fisher
             </a>
             <span class="text-2sm font-normal text-gray-500">
              cody.fisher@gmail.com connections
             </span>
            </div>
           </div>
           <div class="flex items-center gap-2.5">
            <div class="badge badge-pill badge-outline badge-primary gap-1.5">
             <span class="badge badge-dot badge-primary size-1.5">
             </span>
             Remote
            </div>
            <button class="btn btn-icon btn-light btn-clear btn-sm">
             <i class="ki-filled ki-dots-vertical">
             </i>
            </button>
           </div>
          </div>
         </div>
         <div class="menu-item px-4 pt-2">
          <a class="btn btn-sm btn-light justify-center" href="#">
           Go to Users
          </a>
         </div>
        </div>
       </div>
      </div>
      <div class="hidden" id="search_modal_docs">
       <div class="menu menu-default p-0 flex-col">
        <div class="grid">
         <div class="menu-item">
          <div class="menu-link flex items-center">
           <div class="flex items-center grow gap-2.5">
            <img src="<?=base_url("ugajansassets")?>/assets/media/file-types/pdf.svg"/>
            <div class="flex flex-col">
             <span class="text-sm font-semibold text-gray-900 cursor-pointer hover:text-primary mb-px">
              Project-pitch.pdf
             </span>
             <span class="text-xs font-medium text-gray-500">
              4.7 MB 26 Sep 2024 3:20 PM
             </span>
            </div>
           </div>
           <button class="btn btn-icon btn-light btn-clear btn-sm">
            <i class="ki-filled ki-dots-vertical">
            </i>
           </button>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex items-center">
           <div class="flex items-center grow gap-2.5">
            <img src="<?=base_url("ugajansassets")?>/assets/media/file-types/doc.svg"/>
            <div class="flex flex-col">
             <span class="text-sm font-semibold text-gray-900 cursor-pointer hover:text-primary mb-px">
              Report-v1.docx
             </span>
             <span class="text-xs font-medium text-gray-500">
              2.3 MB 1 Oct 2024 12:00 PM
             </span>
            </div>
           </div>
           <button class="btn btn-icon btn-light btn-clear btn-sm">
            <i class="ki-filled ki-dots-vertical">
            </i>
           </button>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex items-center">
           <div class="flex items-center grow gap-2.5">
            <img src="<?=base_url("ugajansassets")?>/assets/media/file-types/javascript.svg"/>
            <div class="flex flex-col">
             <span class="text-sm font-semibold text-gray-900 cursor-pointer hover:text-primary mb-px">
              Framework-App.js
             </span>
             <span class="text-xs font-medium text-gray-500">
              0.8 MB 17 Oct 2024 6:46 PM
             </span>
            </div>
           </div>
           <button class="btn btn-icon btn-light btn-clear btn-sm">
            <i class="ki-filled ki-dots-vertical">
            </i>
           </button>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex items-center">
           <div class="flex items-center grow gap-2.5">
            <img src="<?=base_url("ugajansassets")?>/assets/media/file-types/ai.svg"/>
            <div class="flex flex-col">
             <span class="text-sm font-semibold text-gray-900 cursor-pointer hover:text-primary mb-px">
              Framework-App.js
             </span>
             <span class="text-xs font-medium text-gray-500">
              0.8 MB 17 Oct 2024 6:46 PM
             </span>
            </div>
           </div>
           <button class="btn btn-icon btn-light btn-clear btn-sm">
            <i class="ki-filled ki-dots-vertical">
            </i>
           </button>
          </div>
         </div>
         <div class="menu-item">
          <div class="menu-link flex items-center">
           <div class="flex items-center grow gap-2.5">
            <img src="<?=base_url("ugajansassets")?>/assets/media/file-types/php.svg"/>
            <div class="flex flex-col">
             <span class="text-sm font-semibold text-gray-900 cursor-pointer hover:text-primary mb-px">
              appController.js
             </span>
             <span class="text-xs font-medium text-gray-500">
              0.1 MB 21 Nov 2024 3:20 PM
             </span>
            </div>
           </div>
           <button class="btn btn-icon btn-light btn-clear btn-sm">
            <i class="ki-filled ki-dots-vertical">
            </i>
           </button>
          </div>
         </div>
         <div class="menu-item px-4 pt-2.5">
          <a class="btn btn-sm btn-light justify-center" href="#">
           Go to Users
          </a>
         </div>
        </div>
       </div>
      </div>
      <div class="hidden" id="search_modal_empty">
       <div class="flex flex-col text-center py-9 gap-5">
        <div class="flex justify-center">
         <img alt="image" class="dark:hidden max-h-[113px]" src="<?=base_url("ugajansassets")?>/assets/media/illustrations/33.svg"/>
         <img alt="image" class="light:hidden max-h-[113px]" src="<?=base_url("ugajansassets")?>/assets/media/illustrations/33-dark.svg"/>
        </div>
        <div class="flex flex-col gap-1.5">
         <h3 class="text-base font-semibold text-gray-900 text-center">
          Looking for something..
         </h3>
         <span class="text-2sm font-medium text-center text-gray-600">
          Initiate your digital experience with
          <br/>
          our intuitive dashboard
         </span>
        </div>
        <div class="flex justify-center">
         <a class="btn btn-sm btn-light flex justify-center" href="#">
          View Projects
         </a>
        </div>
       </div>
      </div>
      <div class="hidden" id="search_modal_no-results">
       <div class="flex flex-col text-center py-9 gap-5">
        <div class="flex justify-center">
         <img alt="image" class="dark:hidden max-h-[113px]" src="<?=base_url("ugajansassets")?>/assets/media/illustrations/33.svg"/>
         <img alt="image" class="light:hidden max-h-[113px]" src="<?=base_url("ugajansassets")?>/assets/media/illustrations/33-dark.svg"/>
        </div>
        <div class="flex flex-col gap-1.5">
         <h3 class="text-base font-semibold text-gray-900 text-center">
          No Results Found
         </h3>
         <span class="text-2sm font-medium text-center text-gray-600">
          Refine your query to discover relevant items
         </span>
        </div>
        <div class="flex justify-center">
         <a class="btn btn-sm btn-light flex justify-center" href="#">
          View Projects
         </a>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <div class="modal" data-modal="true" data-modal-disable-scroll="false" id="share_profile_modal">
   <div class="modal-content max-w-[500px] top-5 lg:top-[15%]">
    <div class="modal-header pr-2.5">
     <h3 class="modal-title">
      Yeni Müşteri Kayıt
     </h3>
     <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
      <i class="ki-filled ki-cross">
      </i>
     </button>
    </div>
    <form action="<?=base_url("ugajans_musteri/musteri_kaydet")?>" method="post">
  
    <div class="modal-body grid gap-5 px-0 py-5">

    <div class="flex flex-col px-5 gap-2.5">
    <div class="text-2sm text-brand mt-0 " style="margin-top:-10px;margin-bottom:10px">
           Müşteri kaydı oluşturmak için Müşteri Ad Soyad ve İletişim Numarası alanları zorunludur. İşletme bilgileri müşteri profili oluşturulduktan sonra girilebilir.
              
            </div>

      <div class="flex flex-center gap-1">
        
       <label class="text-gray-900 font-semibold text-2sm">
        Müşteri Ad Soyad
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
      <label class="input">
       <input type="text" required placeholder="Müşteri adını soyadını giriniz" name="musteri_ad_soyad"  >
        
        </button>
       </input>
      </label>
     </div>
     <div class="flex flex-col px-5 gap-2.5">
      <div class="flex flex-center gap-1">
       <label class="text-gray-900 font-semibold text-2sm">
        İletişim Numarası
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
      <label class="input">
       <input type="text" required name="musteri_iletisim_numarasi" placeholder="İletişim numarası giriniz"   >
        
        </button>
       </input>
      </label>
     </div>
      
     <div class="flex flex-col px-5 gap-2.5">
      <div class="flex flex-center gap-1">
       <label class="text-gray-900 font-semibold text-2sm">
        Email Adresi
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
      <label class="input">
       <input type="text" name="musteri_email_adresi" placeholder="Email adresi giriniz"   >
        
        </button>
       </input>
      </label>
     </div>

     
      
      
     <div class="flex  justify-start   gap-4">
       
     <div class="flex  items-center gap-2.5 justify-end p-5" >
      <button type="submit" class="btn  btn-sm btn-success">
       Kaydet
      </button>
      <a class="btn btn-sm btn-light" data-modal-dismiss="true">
       İptal
      </a>
     </div>
     </div>
    </div>
    </form>
   </div>
  </div>


<div class="modal" data-modal="true" data-modal-disable-scroll="false" id="duyuru_modal">
   <div class="modal-content max-w-[500px] top-5 lg:top-[15%]">
    <div class="modal-header pr-2.5">
     <h3 class="modal-title">
     Duyuru Yönetimi
     </h3>
     <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
      <i class="ki-filled ki-cross">
      </i>
     </button>
    </div>
    <form action="<?=base_url("ugajans_anasayfa/duyuru_guncelle")?>" method="post">
  
    <div class="modal-body grid gap-5 px-0 py-5">
  <div class="flex flex-col px-5 gap-2.5">
 

      <div class="flex flex-center gap-1">
        
       <label class="text-gray-900 font-semibold text-2sm">
        Duyuru Detayları
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
        <textarea style="padding:10px;height:120px" placeholder="Duyuru detaylarını giriniz" class="input" name="ugajans_duyuru"><?=get_parameter()->ugajans_duyuru?></textarea>
        
        </button>
       
     </div>
      
     
      
      
     <div class="flex  justify-start   gap-4">
       
     <div class="flex  items-center gap-2.5 justify-end p-5"  >
      <button type="submit" class="btn  btn-sm btn-success">
       Kaydet
      </button>
      <a class="btn btn-sm btn-light" data-modal-dismiss="true">
       İptal
      </a>
     </div>
     </div>
    </div>
    </form>
   </div>
  </div>




  <div class="modal" data-modal="true" data-modal-disable-scroll="false" id="is_modal">
   <div class="modal-content max-w-[500px] top-5 lg:top-[15%]">
    <div class="modal-header pr-2.5">
     <h3 class="modal-title">
     Yapılacak İş Tanımla
     </h3>
     <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
      <i class="ki-filled ki-cross">
      </i>
     </button>
    </div>
    <form action="<?=base_url("ugajans_anasayfa/yapilacak_is_ekle")?>" method="post">
  
    <div class="modal-body grid gap-5 px-0 py-5">
  <div class="flex flex-col px-5 gap-2.5">
 

      <div class="flex flex-center gap-1">
        
       <label class="text-gray-900 font-semibold text-2sm">
        İş Detayları
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
        <textarea required style="padding:10px;height:120px" name="yapilacak_isler_detay" class="input" name="ugajans_duyuru"></textarea>
        
         
       
     </div>
      
     <div class="flex flex-col px-5 gap-2.5">
 

      <div class="flex flex-center gap-1">
        
       <label class="text-gray-900 font-semibold text-2sm">
        İş Tarihi
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
        <input type="date"  required class="input" name="yapilacak_isler_tarih"></input>
        
         
       
     </div>


 <div class="flex flex-col px-5 gap-2.5">
 

      <div class="flex flex-center gap-1">
        
       <label class="text-gray-900 font-semibold text-2sm">
        Atanan Kullanıcı
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
       
      <select name="atanan_kullanici_no"  class="input">
             <option  value="0">Bana Özel</option>

              <?php 
              $ugk = get_kullanicilar();
              foreach ($ugk as $uk) {
               ?>
               <option value="<?=$uk->ugajans_kullanici_id?>"><?=$uk->ugajans_kullanici_ad_soyad?></option>
               <?php
              }
              ?>
             </select>
         
       
     </div>




     
      
      
     <div class="flex  justify-start   gap-4">
       
     <div class="flex  items-center gap-2.5 justify-end p-5"  >
      <button type="submit" class="btn  btn-sm btn-success">
       Kaydet
      </button>
      <a class="btn btn-sm btn-light" data-modal-dismiss="true">
       İptal
      </a>
     </div>
     </div>
    </div>
    </form>
   </div>
  </div>






  <div class="modal" data-modal="true" id="give_award_modal">
   <div class="modal-content max-w-[500px] top-[15%]">
    <div class="modal-header pr-2.5">
     <h3 class="modal-title">
      Give Award
     </h3>
     <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
      <i class="ki-filled ki-black-left">
      </i>
     </button>
    </div>
    <div class="modal-body grid gap-5 px-0 py-5">
     <div class="flex flex-col px-5 gap-2.5">
      <div class="flex flex-center gap-1">
       <label class="text-gray-900 font-semibold text-2sm">
        Share read-only link
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
      <label class="input">
       <input type="text" value="https://metronic.com/profiles/x7g2vA3kZ5">
        <button class="btn btn-icon">
         <i class="ki-filled ki-copy">
         </i>
        </button>
       </input>
      </label>
     </div>
     <div class="border-b border-b-gray-200">
     </div>
     <div class="flex flex-col px-5 gap-2.5">
      <div class="flex flex-center gap-1">
       <label class="text-gray-900 font-semibold text-2sm">
        Share via email
       </label>
       <i class="ki-filled ki-information-2 text-gray-500 text-2sm">
       </i>
      </div>
      <div class="flex flex-center gap-2.5">
       <label class="input">
        <input type="text" value="miles.turner@gmail.com">
        </input>
       </label>
       <button class="btn btn-primary">
        Share
       </button>
      </div>
     </div>
     <div class="scrollable-y-auto" data-scrollable="true" data-scrollable-max-height="auto" data-scrollable-offset="1000px">
      <div class="flex flex-col px-5 gap-3">
       <div class="flex items-center flex-wrap gap-2">
        <div class="flex items-center grow gap-2.5">
         <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-3.png"/>
         <div class="flex flex-col">
          <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
           Tyler Hero
          </a>
          <a class="hover:text-primary-active text-2sm font-medium text-gray-600" href="#">
           tyler.hero@gmail.com
          </a>
         </div>
        </div>
        <select class="select select-sm max-w-24">
         <option selected="">
          Owner
         </option>
         <option>
          Editor
         </option>
         <option>
          Viewer
         </option>
        </select>
       </div>
       <div class="flex items-center flex-wrap gap-2">
        <div class="flex items-center grow gap-2.5">
         <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-1.png"/>
         <div class="flex flex-col">
          <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
           Esther Howard
          </a>
          <a class="hover:text-primary-active text-2sm font-medium text-gray-600" href="#">
           esther.howard@gmail.com
          </a>
         </div>
        </div>
        <select class="select select-sm max-w-24">
         <option>
          Owner
         </option>
         <option selected="">
          Editor
         </option>
         <option>
          Viewer
         </option>
        </select>
       </div>
       <div class="flex items-center flex-wrap gap-2">
        <div class="flex items-center grow gap-2.5">
         <img alt="" class="rounded-full size-9 shrink-0" src="<?=base_url("ugajansassets")?>/assets/media/avatars/300-11.png"/>
         <div class="flex flex-col">
          <a class="text-sm font-semibold text-gray-900 hover:text-primary-active mb-px" href="#">
           Jacob Jones
          </a>
          <a class="hover:text-primary-active text-2sm font-medium text-gray-600" href="#">
           jacob.jones@gmail.com
          </a>
         </div>
        </div>
        <select class="select select-sm max-w-24">
         <option>
          Owner
         </option>
         <option>
          Editor
         </option>
         <option selected="">
          Viewer
         </option>
        </select>
       </div>
      </div>
     </div>
     <div class="border-b border-b-gray-200">
     </div>
     <div class="flex flex-col px-5 gap-4">
      <label class="text-gray-900 font-semibold text-2sm">
       Settings
      </label>
      <div class="flex flex-center justify-between flex-wrap gap-2">
       <div class="flex flex-center gap-1.5">
        <i class="ki-filled ki-user text-gray-500">
        </i>
        <div class="flex flex-center text-gray-700 font-medium text-xs">
         Anyone at
         <a class="text-xs font-medium link mx-1" href="#">
          KeenThemes
         </a>
         can view
        </div>
       </div>
       <button class="btn btn-sm btn-link">
        Change Access
       </button>
      </div>
      <div class="flex flex-center justify-between flex-wrap gap-2 mb-1">
       <div class="flex flex-center gap-1.5">
        <i class="ki-filled ki-icon text-gray-500">
        </i>
        <div class="flex flex-center text-gray-700 font-medium text-xs">
         Anyone with link can edit
        </div>
       </div>
       <button class="btn btn-sm btn-link">
        Set Password
       </button>
      </div>
      <button class="btn btn-primary justify-center">
       Done
      </button>
     </div>
    </div>
   </div>
  </div>
  <div class="modal" data-modal="true" id="report_gorusme_modal">
   <div class="modal-content max-w-[500px] top-[15%]">
    <div class="modal-header pr-2.5">
     <h3 class="modal-title">
      Görüşme Kaydı Oluştur
     </h3>
     <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
      <i class="ki-filled ki-cross">
      </i>
     </button>
    </div>
  <form action="<?=base_url("ugajans_musteri/gorusme_kaydi_olustur/$musteri_data->musteri_id")?>" method="post"> 
    <div class="modal-body p-0">
     <div class="p-5">
      <div class="grid place-items-center gap-1">
       <div class="flex justify-center items-center rounded-full">
       <img alt="" class="rounded-full size-[100px] shrink-0" src="<?=base_url()?>/ugajansassets/assets/media/avatars/300-<?=$musteri_data->musteri_id?>.png"/>
       </div>
       <div class="flex items-center justify-center gap-1">
        <a class="hover:text-primary-active text-2sm leading-5 font-semibold text-gray-900" href="#">
         <?=$musteri_data->musteri_ad_soyad?>
        </a>
        <svg class="text-primary" fill="none" height="13" viewbox="0 0 15 16" width="13" xmlns="http://www.w3.org/2000/svg">
         <path d="M14.5425 6.89749L13.5 5.83999C13.4273 5.76877 13.3699 5.6835 13.3312 5.58937C13.2925 5.49525 13.2734 5.39424 13.275 5.29249V3.79249C13.274 3.58699 13.2324 3.38371 13.1527 3.19432C13.0729 3.00494 12.9565 2.83318 12.8101 2.68892C12.6638 2.54466 12.4904 2.43073 12.2998 2.35369C12.1093 2.27665 11.9055 2.23801 11.7 2.23999H10.2C10.0982 2.24159 9.99722 2.22247 9.9031 2.18378C9.80898 2.1451 9.72371 2.08767 9.65249 2.01499L8.60249 0.957487C8.30998 0.665289 7.91344 0.50116 7.49999 0.50116C7.08654 0.50116 6.68999 0.665289 6.39749 0.957487L5.33999 1.99999C5.26876 2.07267 5.1835 2.1301 5.08937 2.16879C4.99525 2.20747 4.89424 2.22659 4.79249 2.22499H3.29249C3.08699 2.22597 2.88371 2.26754 2.69432 2.34731C2.50494 2.42709 2.33318 2.54349 2.18892 2.68985C2.04466 2.8362 1.93073 3.00961 1.85369 3.20013C1.77665 3.39064 1.73801 3.5945 1.73999 3.79999V5.29999C1.74159 5.40174 1.72247 5.50275 1.68378 5.59687C1.6451 5.691 1.58767 5.77627 1.51499 5.84749L0.457487 6.89749C0.165289 7.19 0.00115967 7.58654 0.00115967 7.99999C0.00115967 8.41344 0.165289 8.80998 0.457487 9.10249L1.49999 10.16C1.57267 10.2312 1.6301 10.3165 1.66878 10.4106C1.70747 10.5047 1.72659 10.6057 1.72499 10.7075V12.2075C1.72597 12.413 1.76754 12.6163 1.84731 12.8056C1.92709 12.995 2.04349 13.1668 2.18985 13.3111C2.3362 13.4553 2.50961 13.5692 2.70013 13.6463C2.89064 13.7233 3.0945 13.762 3.29999 13.76H4.79999C4.90174 13.7584 5.00275 13.7775 5.09687 13.8162C5.191 13.8549 5.27627 13.9123 5.34749 13.985L6.40499 15.0425C6.69749 15.3347 7.09404 15.4988 7.50749 15.4988C7.92094 15.4988 8.31748 15.3347 8.60999 15.0425L9.65999 14C9.73121 13.9273 9.81647 13.8699 9.9106 13.8312C10.0047 13.7925 10.1057 13.7734 10.2075 13.775H11.7075C12.1212 13.775 12.518 13.6106 12.8106 13.3181C13.1031 13.0255 13.2675 12.6287 13.2675 12.215V10.715C13.2659 10.6132 13.285 10.5122 13.3237 10.4181C13.3624 10.324 13.4198 10.2387 13.4925 10.1675L14.55 9.10999C14.6953 8.96452 14.8104 8.79176 14.8887 8.60164C14.9671 8.41152 15.007 8.20779 15.0063 8.00218C15.0056 7.79656 14.9643 7.59311 14.8847 7.40353C14.8051 7.21394 14.6888 7.04197 14.5425 6.89749ZM10.635 6.64999L6.95249 10.25C6.90055 10.3026 6.83864 10.3443 6.77038 10.3726C6.70212 10.4009 6.62889 10.4153 6.55499 10.415C6.48062 10.4139 6.40719 10.3982 6.33896 10.3685C6.27073 10.3389 6.20905 10.2961 6.15749 10.2425L4.37999 8.44249C4.32532 8.39044 4.28169 8.32793 4.25169 8.25867C4.22169 8.18941 4.20593 8.11482 4.20536 8.03934C4.20479 7.96387 4.21941 7.88905 4.24836 7.81934C4.27731 7.74964 4.31999 7.68647 4.37387 7.63361C4.42774 7.58074 4.4917 7.53926 4.56194 7.51163C4.63218 7.484 4.70726 7.47079 4.78271 7.47278C4.85816 7.47478 4.93244 7.49194 5.00112 7.52324C5.0698 7.55454 5.13148 7.59935 5.18249 7.65499L6.56249 9.05749L9.84749 5.84749C9.95296 5.74215 10.0959 5.68298 10.245 5.68298C10.394 5.68298 10.537 5.74215 10.6425 5.84749C10.6953 5.90034 10.737 5.96318 10.7653 6.03234C10.7935 6.1015 10.8077 6.1756 10.807 6.25031C10.8063 6.32502 10.7908 6.39884 10.7612 6.46746C10.7317 6.53608 10.6888 6.59813 10.635 6.64999Z" fill="currentColor">
         </path>
        </svg>
       </div>
      </div>
     </div>
     <div class="border-b border-b-gray-200">
     </div>
     <div class="flex flex-col gap-5 p-5">
      
      <div class="flex flex-col gap-3.5">
       
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
        Tarih :
          </label>
          <div class="grow">
          <input class="input" required value="<?=date("Y-m-d")?>" type="date" name="gorusme_tarihi" id="">
           </div>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
        Detaylar :
          </label>
          <div class="grow">
          <textarea class="input" required placeholder="Bu bölüme görüşmeniz ile alakalı detayları girebilirsiniz." type="date" name="gorusme_detay" id="" style="height:225px;padding:10px;font-weight:300"></textarea>
           </div>
         </div>
       
      </div>
     </div>
     <div class="border-b border-b-gray-200">
     </div>
     
     <div class="border-b border-b-gray-200">
     </div>
     <div class="flex items-center gap-2.5 justify-end p-5" >
      <button class="btn btn-sm btn-primary">
       Bilgileri Kaydet
      </button>
      <button class="btn btn-sm btn-light" data-modal-dismiss="true">
       İptal
      </button>
     </div>
    </div>
  </form>
   </div>
  </div>
  <!-- End of Page -->
  <!-- Scripts -->
  <script src="<?=base_url("ugajansassets")?>/assets/js/core.bundle.js">
  </script>
  <script src="<?=base_url("ugajansassets")?>/assets/vendors/apexcharts/apexcharts.min.js">
  </script>
  <script src="<?=base_url("ugajansassets")?>/assets/js/widgets/general.js">
  </script>
  <script src="<?=base_url("ugajansassets")?>/assets/js/layouts/demo1.js">
  </script>
  <!-- End of Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
    

<?php if($this->session->flashdata('flashDanger')){ ?>
   Swal.fire({
      icon: 'error',
      confirmButtonColor: '#2c9501',
      confirmButtonText: 'Tamam',
      title: 'Sistem Uyarısı',
      text: '<?=$this->session->flashdata('flashDanger')?>'
      })

 <?php } ?>

    </script>

  <script>
      var options = {
          series: [44, 55, 13],
          chart: {
          width: 380,
          type: 'donut',
        },
        dataLabels: {
          enabled: true
        }, labels: [
          'Beklemede',
          'Tamamlandı',
          'Yapılmadı', 
        ],colors:['#ff6f1e', '#37ac01', '#f00'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              show: false
            }
          }
        }],
        legend: {
          position: 'right',
          offsetY: 0,
          height: 230,
        }
        };
 
       var chart = new ApexCharts(
            document.querySelector("#contributions_chart2"),
            options
        );
         
        chart.render();






        document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("input[placeholder='Müşteri Ara...']");
    const tableRows = document.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function () {
        const searchText = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const customerName = row.querySelector("td a").textContent.toLowerCase();
            const businessName = row.querySelector("td span").textContent.toLowerCase();
            
            if (customerName.includes(searchText) || businessName.includes(searchText)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("input[placeholder='Talep Ara...']");
    const tableRows = document.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function () {
        const searchText = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const customerName = row.querySelector("td").textContent.toLowerCase();
            const businessName = row.querySelector("td").textContent.toLowerCase();
            
            if (customerName.includes(searchText) || businessName.includes(searchText)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});
 
document.getElementById("searchInput").addEventListener("keyup", function() {
    var filter = this.value.toLowerCase();
    var items = document.querySelectorAll(".list-item"); // Her öğeye class ekledik

    items.forEach(function(item) {
        var text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? "" : "none";
    });
});


function confirm_action($text,$url){
  Swal.fire({
  title: $text,
  icon: "warning",
  showDenyButton: false,
  showCancelButton: true,
  confirmButtonText: "Onayla", 
  cancelButtonText: "İptal", 
  confirmButtonColor: '#14a000',
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    location.href=$url;
  }  
});
}

</script>

 
 </body>
</html>
