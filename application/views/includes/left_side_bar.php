<?php 
$giris_yapan_k = aktif_kullanici();
$user_id = $giris_yapan_k->kullanici_id;
$aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');

// Helper fonksiyon: Nav item oluştur
function nav_item($url, $text, $icon = '', $icon_class = '', $extra_class = '', $onclick = '', $link_style = '') {
    $onclick_attr = $onclick ? ' onclick="' . htmlspecialchars($onclick, ENT_QUOTES, 'UTF-8') . '"' : '';
    $style_attr = $link_style ? ' style="' . htmlspecialchars($link_style, ENT_QUOTES, 'UTF-8') . '"' : '';
    $icon_class_attr = $icon_class ? ' ' . htmlspecialchars($icon_class, ENT_QUOTES, 'UTF-8') : '';
    $icon_html = $icon ? '<i class="nav-icon ' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . $icon_class_attr . '"></i>' : '';
    $extra_class_attr = $extra_class ? ' ' . htmlspecialchars($extra_class, ENT_QUOTES, 'UTF-8') : '';
    return '<li class="nav-item' . $extra_class_attr . '">
        <a href="' . htmlspecialchars(base_url($url), ENT_QUOTES, 'UTF-8') . '" class="nav-link"' . $onclick_attr . $style_attr . '>
            ' . $icon_html . '
            <p>' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</p>
        </a>
    </li>';
}

// Helper fonksiyon: Nav header oluştur
function nav_header($text) {
    return '<li class="nav-header">' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</li>';
}

// Helper fonksiyon: Kullanıcı ID kontrolü
function user_in($user_id, $ids) {
    if (empty($ids)) return false;
    return in_array($user_id, is_array($ids) ? $ids : [$ids]);
}
?>

<style>
/* Modern Sidebar Styles - UMEX Color Theme (#001657) - Scoped to #main-sidebar only */
#main-sidebar {
  background: linear-gradient(180deg, #001657 0%, #002a5f 50%, #001657 100%) !important;
  box-shadow: 2px 0 15px rgba(0, 0, 0, 0.3);
}

#main-sidebar .nav-icon { 
  font-size: 16px; 
  line-height: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

#main-sidebar .nav-link p { 
  font-size: 13px; 
  margin: 0;
  line-height: 1.4;
  flex: 1;
  display: flex;
  align-items: center;
}

#main-sidebar .sidebar-input { 
  background: rgba(255, 255, 255, 0.95) !important; 
  border: 2px solid rgba(255, 255, 255, 0.8) !important; 
  color: #001657 !important; 
  border-radius: 8px; 
  font-weight: 500;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

#main-sidebar .sidebar-input::placeholder { 
  color: rgba(0, 22, 87, 0.6) !important; 
  font-weight: 500;
}

#main-sidebar .sidebar-input:focus { 
  background: #ffffff !important; 
  border-color: rgba(255, 255, 255, 1) !important; 
  color: #001657 !important; 
  box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3), 0 4px 12px rgba(0, 0, 0, 0.3) !important; 
  outline: none;
}

#main-sidebar .sidebar-btn { 
  background: rgba(255, 255, 255, 0.9) !important; 
  border: 2px solid rgba(255, 255, 255, 0.8) !important; 
  color: #001657 !important; 
  border-radius: 8px; 
  transition: all 0.3s ease; 
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

#main-sidebar .sidebar-btn:hover { 
  background: #ffffff !important; 
  border-color: rgba(255, 255, 255, 1) !important; 
  color: #001657 !important;
  transform: translateY(-1px); 
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

#main-sidebar .support-btn { 
  background: rgba(0, 22, 87, 0.25); 
  color: white !important; 
  width: 100%; 
  font-size: 11px !important; 
  font-weight: 600; 
  border: 1px solid rgba(255, 255, 255, 0.2); 
  padding: 8px 10px !important; 
  border-radius: 8px; 
  transition: all 0.3s ease; 
  margin-bottom: 8px;
}

#main-sidebar .support-btn:hover { 
  background: rgba(0, 22, 87, 0.35); 
  transform: translateY(-1px); 
  box-shadow: 0 2px 8px rgba(0, 22, 87, 0.3); 
}

#main-sidebar .support-btn-success { 
  background: rgba(0, 22, 87, 0.25); 
  color: white !important; 
  width: 100%; 
  font-size: 11px !important; 
  padding: 8px 10px !important; 
  font-weight: 600; 
  border: 1px solid rgba(255, 255, 255, 0.2) !important; 
  border-radius: 8px; 
  transition: all 0.3s ease; 
  margin-bottom: 12px;
}

#main-sidebar .support-btn-success:hover { 
  background: rgba(0, 22, 87, 0.35); 
  transform: translateY(-1px); 
  box-shadow: 0 2px 8px rgba(0, 22, 87, 0.3); 
}

#main-sidebar .yanipsonenyazimodul2 { 
  animation: blinker2 1s linear infinite; 
}

@keyframes blinker2 { 
  50% { opacity: 0; } 
}

#main-sidebar .brand-link {
  background: linear-gradient(135deg, #001657 0%, #002a5f 100%) !important;
  border: 2px solid rgba(255, 255, 255, 0.2) !important;
  border-radius: 12px !important;
  /* margin: 12px 8px !important; */
  /* padding: 12px 10px !important; */
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

#main-sidebar .brand-link span {
  font-size: 18px !important;
  letter-spacing: 0.5px;
  line-height: 1.2;
}

#main-sidebar .brand-link:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
  border-color: rgba(255, 255, 255, 0.3) !important;
}

#main-sidebar .sidebar {
  padding: 15px 12px;
}

#main-sidebar .user-panel {
  background: rgba(0, 22, 87, 0.2);
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 15px;
  border: 1px solid rgba(255, 255, 255, 0.15);
  transition: all 0.3s ease;
}

#main-sidebar .user-panel .info {
  display: inline-block;
  padding: 13px 5px 5px 10px;
}

#main-sidebar .user-panel .info a {
  font-size: 12px !important;
}

#main-sidebar .user-panel .info a.d-block {
  font-size: 11px !important;
}

#main-sidebar .user-panel:hover {
  background: rgba(0, 22, 87, 0.3);
  transform: translateX(3px);
}

#main-sidebar .user-panel .info a {
  color: #ffffff !important;
  font-weight: 600;
  transition: color 0.3s ease;
}

#main-sidebar .user-panel .info a:hover {
  color: rgba(255, 255, 255, 0.9) !important;
}

#main-sidebar .user-panel .image img {
  border: 4px solid rgba(255, 255, 255, 0.6) !important;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4), 0 0 0 2px rgba(255, 255, 255, 0.2) !important;
  transition: all 0.3s ease;
  background: #ffffff !important;
}

#main-sidebar .user-panel:hover .image img {
  border-color: rgba(255, 255, 255, 0.9) !important;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.5), 0 0 0 3px rgba(255, 255, 255, 0.3) !important;
  transform: scale(1.05);
}

/* Modern Nav Items */
#main-sidebar .nav-sidebar .nav-item > .nav-link {
  border-radius: 10px;
  margin-bottom: 6px;
  padding: 10px 15px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  min-height: 40px;
}

#main-sidebar .nav-sidebar .nav-item > .nav-link::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 4px;
  background: rgba(255, 255, 255, 0.5);
  transform: scaleY(0);
  transition: transform 0.3s ease;
}

#main-sidebar .nav-sidebar .nav-item > .nav-link:hover {
  background: rgba(255, 255, 255, 0.1) !important;
  transform: translateX(3px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

body.sidebar-collapse #main-sidebar .nav-sidebar .nav-item > .nav-link:hover {
  transform: none;
}

#main-sidebar .nav-sidebar .nav-item > .nav-link:hover::before {
  transform: scaleY(1);
}

#main-sidebar .nav-sidebar .nav-item.active > .nav-link,
#main-sidebar .nav-sidebar .nav-item.menu-open > .nav-link {
  background: rgba(255, 255, 255, 0.15) !important;
  color: #ffffff !important;
  font-weight: 600;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}

#main-sidebar .nav-sidebar .nav-item.active > .nav-link::before,
#main-sidebar .nav-sidebar .nav-item.menu-open > .nav-link::before {
  transform: scaleY(1);
  background: #ffffff;
}

#main-sidebar .nav-sidebar .nav-link .nav-icon {
  margin-right: 12px;
  width: 20px;
  min-width: 20px;
  text-align: center;
  transition: transform 0.3s ease;
  font-size: 16px;
  line-height: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

#main-sidebar .nav-sidebar .nav-item > .nav-link:hover .nav-icon {
  transform: scale(1.1);
}

/* Ensure all icons are properly aligned and sized */
#main-sidebar .nav-sidebar .nav-link i.nav-icon,
#main-sidebar .nav-sidebar .nav-link .nav-icon i,
#main-sidebar .nav-sidebar .nav-link i.fas,
#main-sidebar .nav-sidebar .nav-link i.far,
#main-sidebar .nav-sidebar .nav-link i.fa,
#main-sidebar .nav-sidebar .nav-link i.fab {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  width: 20px !important;
  min-width: 20px !important;
  height: 20px !important;
  font-size: 16px !important;
  line-height: 1 !important;
  vertical-align: middle !important;
}

/* Fix icon alignment in all states */
#main-sidebar .nav-sidebar .nav-link {
  gap: 0;
}

#main-sidebar .nav-sidebar .nav-link > * {
  display: flex;
  align-items: center;
}

/* Treeview icons */
#main-sidebar .nav-treeview .nav-link i.nav-icon,
#main-sidebar .nav-treeview .nav-link i.fas,
#main-sidebar .nav-treeview .nav-link i.far,
#main-sidebar .nav-treeview .nav-link i.fa {
  width: 16px !important;
  min-width: 16px !important;
  height: 16px !important;
  font-size: 14px !important;
}

/* Nav Headers */
#main-sidebar .nav-header {
  color: rgba(255, 255, 255, 0.8) !important;
  font-size: 10px !important;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  margin-top: 20px;
  margin-bottom: 10px;
  padding: 10px 15px;
  border-bottom: 2px solid rgba(255, 255, 255, 0.15);
}

/* Treeview Submenu */
#main-sidebar .nav-treeview {
  background: rgba(0, 0, 0, 0.15);
  border-radius: 8px;
  margin-top: 5px;
  padding: 5px 0;
  border-left: 2px solid rgba(255, 255, 255, 0.2);
  margin-left: 10px;
}

#main-sidebar .nav-treeview .nav-item > .nav-link {
  /* padding-left: 45px; */
  font-size: 12px;
  border-radius: 6px;
  margin: 2px 6px;
  display: flex;
  align-items: center;
  min-height: 36px;
}

#main-sidebar .nav-treeview .nav-item > .nav-link .nav-icon {
  width: 16px;
  min-width: 16px;
  font-size: 14px;
  margin-right: 10px;
}

#main-sidebar .nav-treeview .nav-item > .nav-link:hover {
  background: rgba(255, 255, 255, 0.1) !important;
  /* padding-left: 48px; */
}

/* Input Group Modern Style - Scoped to sidebar */
#main-sidebar .input-group {
  margin-bottom: 15px;
  margin-top: 15px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  border-radius: 8px;
  overflow: hidden;
}

/* Spacing between UMEX Archive button and first search input */
#main-sidebar form:first-of-type .input-group {
  margin-top: 15px;
}

#main-sidebar .input-group .form-control-sidebar {
  font-size: 13px;
  padding: 10px 12px;
  border-right: none;
}

#main-sidebar .input-group .input-group-append {
  border-left: 2px solid rgba(255, 255, 255, 0.3);
}

#main-sidebar .input-group .form-control-sidebar {
  border-radius: 8px 0 0 8px;
}

#main-sidebar .input-group .input-group-append .btn {
  border-radius: 0 8px 8px 0;
  padding: 6px 14px;
}

/* Smooth Scrollbar */
#main-sidebar .sidebar::-webkit-scrollbar {
  width: 6px;
}

#main-sidebar .sidebar::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.2);
  border-radius: 10px;
}

#main-sidebar .sidebar::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.3);
  border-radius: 10px;
  transition: background 0.3s ease;
}

#main-sidebar .sidebar::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.5);
}

/* Button Modern Styles - Scoped to sidebar */
#main-sidebar .btn-sm {
  border-radius: 8px;
  transition: all 0.3s ease;
  font-weight: 500;
}

#main-sidebar .btn-sm:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Badge Modern Styles - Scoped to sidebar */
#main-sidebar .badge {
  border-radius: 6px;
  padding: 4px 8px;
  font-weight: 600;
  font-size: 10px;
}

/* Sidebar Collapsed State Fixes */
body.sidebar-collapse #main-sidebar .brand-link {
  padding: 8px 4px !important;
  margin: 6px !important;
}

body.sidebar-collapse #main-sidebar .brand-link span {
  font-size: 14px !important;
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

body.sidebar-collapse #main-sidebar .user-panel .info {
  display: none !important;
}

body.sidebar-collapse #main-sidebar .user-panel {
  padding: 8px 4px !important;
  text-align: center;
  margin-bottom: 8px !important;
}

body.sidebar-collapse #main-sidebar .user-panel .image {
  margin: 0 auto !important;
  margin-top: 0 !important;
}

body.sidebar-collapse #main-sidebar .input-group,
body.sidebar-collapse #main-sidebar .support-btn,
body.sidebar-collapse #main-sidebar .support-btn-success,
body.sidebar-collapse #main-sidebar .row {
  display: none !important;
}

body.sidebar-collapse #main-sidebar .nav-sidebar .nav-item > .nav-link {
  padding: 12px !important;
  justify-content: center;
  align-items: center;
  margin-bottom: 4px !important;
  min-height: 44px;
}

body.sidebar-collapse #main-sidebar .nav-sidebar .nav-link p {
  display: none !important;
}

body.sidebar-collapse #main-sidebar .nav-sidebar .nav-link .nav-icon {
  margin-right: 0 !important;
  margin-left: 0 !important;
  width: 22px !important;
  min-width: 22px !important;
  font-size: 18px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}

body.sidebar-collapse #main-sidebar .nav-header {
  display: none !important;
}

body.sidebar-collapse #main-sidebar .nav-treeview {
  display: none !important;
}

body.sidebar-collapse #main-sidebar .sidebar {
  padding: 8px 4px !important;
}

/* Responsive Improvements */
/* Tablet and below (max-width: 991.98px) */
@media (max-width: 991.98px) {
  #main-sidebar {
    box-shadow: 2px 0 20px rgba(0, 0, 0, 0.4);
    z-index: 1040;
  }
  
  #main-sidebar .sidebar {
    padding: 12px 10px;
  }
  
  #main-sidebar .brand-link {
    padding: 10px 8px !important;
    margin: 8px 6px !important;
  }
  
  #main-sidebar .brand-link span {
    font-size: 16px !important;
  }
  
  #main-sidebar .user-panel {
    padding: 12px;
    margin-bottom: 12px;
  }
  
  #main-sidebar .nav-sidebar .nav-item > .nav-link {
    padding: 9px 12px;
    min-height: 38px;
  }
  
  #main-sidebar .nav-sidebar .nav-link .nav-icon {
    font-size: 15px;
    width: 18px;
    min-width: 18px;
  }
  
  #main-sidebar .nav-link p {
    font-size: 12px;
  }
  
  #main-sidebar .input-group {
    margin-bottom: 12px;
  }
  
  #main-sidebar .support-btn,
  #main-sidebar .support-btn-success {
    font-size: 10px !important;
    padding: 7px 8px !important;
  }
}

/* Desktop - Hide close button */
#main-sidebar .sidebar-close-button {
  display: none !important;
}

/* Mobile devices (max-width: 767.98px) - Compatible with AdminLTE */
@media (max-width: 767.98px) {
  #main-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100% !important; /* Full screen on mobile */
    max-width: 100% !important;
    z-index: 1040;
    box-shadow: 4px 0 25px rgba(0, 0, 0, 0.5);
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    /* Completely hide sidebar by default on mobile using transform */
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
    will-change: transform;
  }
  
  /* Show sidebar when sidebar-open class is present - Full screen */
  body.sidebar-open #main-sidebar {
    transform: translateX(0) !important;
    width: 100% !important;
    max-width: 100% !important;
    box-shadow: 4px 0 25px rgba(0, 0, 0, 0.6);
  }
  
  /* Ensure sidebar is completely hidden when not open */
  body:not(.sidebar-open) #main-sidebar {
    transform: translateX(-100%) !important;
  }
  
  /* Mobile Close Button - Visible on mobile */
  #main-sidebar .sidebar-close-button {
    display: flex !important;
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 1050;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.4);
    color: white;
    font-size: 20px;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
  }
  
  #main-sidebar .sidebar-close-button:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.6);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
  }
  
  #main-sidebar .sidebar-close-button:active {
    transform: scale(0.95);
  }
  
  /* Optimized for full screen mobile - Better spacing and sizing */
  #main-sidebar .sidebar {
    padding: 20px 16px !important; /* Increased padding for full screen */
    height: 100%;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    position: relative; /* For absolute positioned close button */
  }
  
  /* Brand link - Larger for full screen */
  #main-sidebar .brand-link {
    padding: 16px 20px !important; /* Increased padding */
    margin: 12px 8px 16px 8px !important; /* Better margins */
    border-radius: 12px !important;
  }
  
  #main-sidebar .brand-link span {
    font-size: 20px !important; /* Larger font for full screen */
    font-weight: 700 !important;
  }
  
  /* User panel - Larger for full screen */
  #main-sidebar .user-panel {
    padding: 16px !important; /* Increased padding */
    margin-bottom: 16px !important;
    border-radius: 12px !important;
  }
  
  #main-sidebar .user-panel .image img {
    width: 60px !important; /* Larger profile image */
    height: 60px !important;
    border: 4px solid rgba(255, 255, 255, 0.6) !important;
  }
  
  #main-sidebar .user-panel .info {
    padding: 16px 8px 8px 12px !important; /* Better padding */
  }
  
  #main-sidebar .user-panel .info a {
    font-size: 15px !important; /* Larger font */
    font-weight: 600 !important;
  }
  
  #main-sidebar .user-panel .info a.d-block {
    font-size: 13px !important; /* Larger font */
  }
  
  /* Nav links - Larger for full screen */
  #main-sidebar .nav-sidebar .nav-item > .nav-link {
    padding: 14px 18px !important; /* Increased padding */
    min-height: 52px !important; /* Larger touch target */
    margin-bottom: 6px !important;
    border-radius: 10px !important;
    touch-action: manipulation;
    -webkit-tap-highlight-color: rgba(255, 255, 255, 0.1);
  }
  
  #main-sidebar .nav-sidebar .nav-link .nav-icon {
    font-size: 20px !important; /* Larger icons */
    width: 28px !important;
    min-width: 28px !important;
    height: 28px !important;
    margin-right: 14px !important;
  }
  
  #main-sidebar .nav-link p {
    font-size: 16px !important; /* Larger font */
    font-weight: 500 !important;
  }
  
  /* Nav headers - More visible */
  #main-sidebar .nav-header {
    font-size: 12px !important; /* Larger font */
    padding: 12px 16px !important; /* Increased padding */
    margin-top: 20px !important;
    margin-bottom: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
  }
  
  /* Input groups - Larger for full screen */
  #main-sidebar .input-group {
    margin-bottom: 16px !important;
    margin-top: 16px !important;
  }
  
  #main-sidebar .sidebar-input {
    font-size: 15px !important; /* Larger font */
    padding: 12px 16px !important; /* Increased padding */
    border-radius: 10px !important;
  }
  
  #main-sidebar .sidebar-btn {
    padding: 12px 18px !important; /* Increased padding */
    font-size: 15px !important; /* Larger font */
    border-radius: 10px !important;
  }
  
  /* Support buttons - Larger */
  #main-sidebar .support-btn,
  #main-sidebar .support-btn-success {
    font-size: 13px !important; /* Larger font */
    padding: 12px 16px !important; /* Increased padding */
    margin-bottom: 12px !important;
    border-radius: 10px !important;
    min-height: 48px !important;
  }
  
  /* Treeview items - Larger */
  #main-sidebar .nav-treeview .nav-item > .nav-link {
    padding: 12px 16px !important; /* Increased padding */
    min-height: 44px !important; /* Larger touch target */
    font-size: 15px !important; /* Larger font */
    margin: 3px 8px !important;
    border-radius: 8px !important;
  }
  
  #main-sidebar .nav-treeview .nav-link .nav-icon {
    font-size: 18px !important; /* Larger icons */
    width: 24px !important;
    min-width: 24px !important;
    height: 24px !important;
  }
  
  /* Better touch targets for mobile - Full screen optimized */
  #main-sidebar .btn-sm {
    min-height: 48px !important; /* Larger touch target */
    padding: 12px 18px !important; /* Increased padding */
    font-size: 14px !important; /* Larger font */
  }
  
  /* UMEX Archive button - Larger for full screen */
  #main-sidebar .btn-success.btn-sm.mb-1 {
    padding: 14px 20px !important;
    font-size: 15px !important;
    min-height: 52px !important;
  }
  
  /* Hide hover effects on mobile */
  #main-sidebar .nav-sidebar .nav-item > .nav-link:hover {
    transform: none;
  }
  
  #main-sidebar .user-panel:hover {
    transform: none;
  }
  
  #main-sidebar .brand-link:hover {
    transform: none;
  }
}

/* Small mobile devices (max-width: 576px) */
@media (max-width: 576px) {
  #main-sidebar {
    width: 100% !important;
    max-width: 100% !important; /* Full screen on small mobile too */
  }
  
  #main-sidebar .sidebar {
    padding: 16px 12px !important; /* Slightly less padding on very small screens */
  }
  
  #main-sidebar .brand-link {
    padding: 14px 16px !important;
    margin: 10px 6px 14px 6px !important;
  }
  
  #main-sidebar .brand-link span {
    font-size: 18px !important; /* Slightly smaller on very small screens */
  }
  
  #main-sidebar .user-panel {
    padding: 14px !important;
    margin-bottom: 14px !important;
  }
  
  #main-sidebar .user-panel .image img {
    width: 55px !important; /* Slightly smaller on very small screens */
    height: 55px !important;
  }
  
  #main-sidebar .user-panel .info a {
    font-size: 14px !important;
  }
  
  #main-sidebar .user-panel .info a.d-block {
    font-size: 12px !important;
  }
  
  #main-sidebar .nav-sidebar .nav-item > .nav-link {
    padding: 12px 16px !important;
    min-height: 48px !important;
  }
  
  #main-sidebar .nav-sidebar .nav-link .nav-icon {
    font-size: 18px !important;
    width: 26px !important;
    min-width: 26px !important;
    height: 26px !important;
    margin-right: 12px !important;
  }
  
  #main-sidebar .nav-link p {
    font-size: 15px !important;
  }
  
  #main-sidebar .input-group {
    margin-bottom: 14px !important;
    margin-top: 14px !important;
  }
  
  #main-sidebar .sidebar-input {
    font-size: 14px !important;
    padding: 11px 14px !important;
  }
  
  #main-sidebar .sidebar-btn {
    padding: 11px 16px !important;
    font-size: 14px !important;
  }
}

/* Landscape mobile orientation */
@media (max-width: 991.98px) and (orientation: landscape) {
  #main-sidebar .sidebar {
    padding: 8px 6px;
  }
  
  #main-sidebar .user-panel {
    padding: 8px;
    margin-bottom: 8px;
  }
  
  #main-sidebar .nav-sidebar .nav-item > .nav-link {
    padding: 8px 10px;
    min-height: 36px;
  }
}

/* High DPI displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  #main-sidebar .nav-sidebar .nav-link .nav-icon {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
}
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4" id="main-sidebar">
    <!-- Mobile Close Button - Only visible on mobile -->
    <button type="button" id="sidebar-close-btn" class="sidebar-close-button" onclick="closeSidebarMobile()" aria-label="Close Sidebar" style="display: none;">
        <i class="fas fa-times"></i>
    </button>
    
    <a href="<?=($giris_yapan_k->baslangic_ekrani) ? base_url($giris_yapan_k->baslangic_ekrani) : base_url("anasayfa")?>" class="brand-link" style="text-align: center;border: 2px solid rgba(255,255,255,0.2);border-radius: 12px;background: linear-gradient(135deg, #001657 0%, #002a5f 100%);padding: 12px 8px;box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
        <span style="font-size:26px;color:white;font-weight:700;letter-spacing:1px;"><strong>UG</strong> BUSINESS</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-2 d-flex">
            <div class="image" style="margin-top: 10px;">
                <img src="<?=$giris_yapan_k->kullanici_resim ? base_url("uploads/").$giris_yapan_k->kullanici_resim : base_url("uploads/default.png")?>" class="img-circle elevation-2" alt="User Image" style="background: rgba(0, 22, 87, 0.3);border: 3px solid rgba(255,255,255,0.3) !important;box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="text-transform: uppercase;"><?=$giris_yapan_k->kullanici_ad_soyad?></a>
                <a href="#" class="d-block text-sm"><?=$giris_yapan_k->kullanici_unvan?></a>
            </div>
        </div>

        <div class="row" style="padding-top: 5px;">
            <div class="col-5" style="padding-right: 0; padding-left: 0;">
                <a class="btn btn-warning btn-sm support-btn" href="https://ugbusiness.com.tr/istek/ekle">
                    <i class="fas fa-user-cog"></i> YENİ DESTEK
                </a>
            </div>
            <div class="col" style="padding-left: 3px; padding-right: 0;">
                <a class="btn btn-success btn-sm mb-1 support-btn-success" href="https://ugbusiness.com.tr/istek">
                    <i class="fa fa-list"></i> DESTEK TALEPLERİ
                    <?php if(($s = get_istek_sayi()) > 0): ?>
                        <span class="badge bg-danger"><?=$s?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <a class="btn btn-success btn-sm mb-1" style="background: linear-gradient(135deg, #001657 0%, #002a5f 100%);color:white!important;width: 100%;border: 1px solid rgba(255,255,255,0.2);border-radius: 8px;font-weight: 600;padding: 10px;transition: all 0.3s ease;box-shadow: 0 2px 8px rgba(0,0,0,0.2);margin-bottom: 15px !important;" href="<?=base_url("dokuman")?>" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(0,0,0,0.2)';">
            <i class="fa fa-folder"></i> UG - UMEX ARŞİV
        </a>

        <?php if($user_id == 7): ?>
            <a class="btn btn-danger btn-sm mb-1" onclick="confirm_stop_system();" style="color:white!important; width:100%;">
                <i class="fas fa-exclamation-circle"></i> SİSTEMİ TAMAMEN DURDUR
                <br><span style="opacity:0.5">Yetkili : Uğur ÖLMEZ</span>
            </a>
        <?php endif; ?>

        <br>

        <form action="<?=base_url("anasayfa/genel_arama")?>" method="POST">
            <div class="input-group" data-widget="sidebar-search1">
                <input class="form-control form-control-sidebar sidebar-input" name="aranan_deger" type="search" placeholder="Hızlı Kayıt Ara..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar sidebar-btn" type="submit">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </form>

        <?php if(user_in($aktif_kullanici_id, [1, 9])): ?>
            <div class="input-group mt-2" style="margin-bottom: 10px;">
                <input id="sidebar-menu-filter" class="form-control form-control-sidebar sidebar-input" type="text" placeholder="Menü Ara..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar sidebar-btn" type="button">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false" id="sidebar-menu-list">
                
                <?= nav_header("HIZLI ERİŞİM") ?>
                
                <?= nav_item("anasayfa", "ANASAYFA", "fas fa-home", "text-primary") ?>
                <?= nav_item("izin/talebi_olustur", "İZİN TALEBİ OLUŞTUR", "fas fa-calendar-plus", "text-success") ?>

                <?php if(user_in($user_id, [1, 4, 6])): ?>
                    <?= nav_item("abonelik", "ABONELİKLER", "far fa-folder-open") ?>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?=base_url("anasayfa/rehber")?>" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p><?=user_in($aktif_kullanici_id, [9, 7, 1, 4]) ? "PERSONEL" : "KURUMSAL İLETİŞİM"?></p>
                    </a>
                </li>

                <?php if(user_in($aktif_kullanici_id, [9, 7, 1])): ?>
                    <?= nav_item("sablon/index/26", "ŞİRKET İÇİ KURALLAR", "fas fa-gavel") ?>
                    <li class="nav-item">
                        <a href="<?=base_url("zimmet/fabrika_zimmet")?>" class="nav-link">
                            <i class="nav-icon fas fa-industry text-danger"></i>
                            <p>FABRİKA ZİMMET</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1, 9, 37, 8])): ?>
                    <?= nav_item("uretim_planlama", "ÜRETİM PLANLAMA", "fas fa-industry") ?>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1, 9, 4])): ?>
                    <?= nav_item("yazilim", "YAPILACAK İŞLER", "fas fa-tasks") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("depo_birinci_onay") || goruntuleme_kontrol("depo_giris_cikis") || user_in($aktif_kullanici_id, [1305, 11, 8, 9])): ?>
                    <?= nav_item("depo_onay", "DEPO GİRİŞ ÇIKIŞ", "fas fa-warehouse") ?>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1, 4, 9, 7, 8])): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("cihaz/showrooms")?>" class="nav-link">
                            <i class="fas fa-store nav-icon"></i>
                            <p style="color:orange">SHOWROOM CİHAZLAR</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url("api/kart_okutmayan_personeller_view")?>" class="nav-link">
                            <i class="fas fa-clock nav-icon"></i>
                            <p style="font-weight:600;color:orange">MESAİ GENEL BAKIŞ</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("izinleri_yonet")): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("izin")?>" class="nav-link">
                            <i class="fas fa-calendar-alt nav-icon"></i>
                            <p style="font-weight:600;color:red">İZİN / MESAİ YÖNETİMİ</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1338, 9])): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("cihaz/tumcihazlar")?>" class="nav-link">
                            <i class="fas fa-server nav-icon"></i>
                            <p style="color:#00fb00">TÜM CİHAZLAR</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [9])): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("ayar/arac_kilometre_ortalamalari")?>" class="nav-link">
                            <i class="fas fa-tachometer-alt nav-icon"></i>
                            <p>ARAÇ KM ORT.</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?= nav_header("MODÜLLER") ?>

                <?php if(user_in($user_id, [40, 11, 12])): ?>
                    <?= nav_item("zimmet/kullanici_envanter_liste", "STOK ENVANTER", "fas fa-boxes") ?>
                    <?= nav_item("siparis/haftalik_kurulum_plan", "Haftalık Kurulum Planı", "fas fa-calendar-week", "", "", "waiting('Haftalık Kurulum Planı')") ?>
                <?php endif; ?>

                <?php if($user_id == 40): ?>
                    <?= nav_item("zimmet/dagitim/2", "Zimmet Dağıtım", "fas fa-box", "text-info", "", "waiting('Zimmet Dağıtım')") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("cihazlari_goruntule") && $user_id != 14): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-charging-station text-danger"></i>
                            <p>MÜŞTERİ <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(user_in($aktif_kullanici_id, [1, 9, 1330, 8])): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("cihaz/rgmedikalindex")?>" style="background: #004e0f;" class="nav-link">
                                        <i class="fas fa-heartbeat nav-icon"></i>
                                        <p>RG MEDİKAL</p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?= nav_item("cihaz/cihaz_tanimlama_view", "Yeni Cihaz Tanımla", "fas fa-plus-circle", "", "", "waiting('Yeni Cihaz Tanımla')") ?>

                            <?php if($user_id == 11): ?>
                                <?= nav_item("musteri", "Tüm Müşteriler", "far fa-folder-open") ?>
                            <?php endif; ?>

                            <?= nav_item("cihaz/tum-cihazlar", "Tüm Cihazları Görüntüle", "far fa-folder-open") ?>
                            <?= nav_item("cihaz/tum-cihazlar?durum=iade", "İade Cihazları Görüntüle", "far fa-folder-open") ?>
                            <?= nav_item("cihaz/tum-cihazlar?durum=takas", "Takas Cihazları Görüntüle", "far fa-folder-open") ?>

                            <?php if(goruntuleme_kontrol("borclu_cihazlari_goruntule")): ?>
                                <?= nav_item("cihaz/borclu_cihazlar", "Borçlu Müşteriler", "fas fa-exclamation-triangle", "text-danger") ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php if(goruntuleme_kontrol("musterileri_goruntule") || goruntuleme_kontrol("cihazlari_goruntule") || goruntuleme_kontrol("merkezleri_goruntule")): ?>
                        <li class="nav-item">
                            <a href="<?=base_url("musteri")?>" onclick="waiting('Müşteriler');" class="nav-link">
                                <i class="nav-icon fas fa-users text-danger"></i>
                                <p>MÜŞTERİ</p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("stok_yonetim")): ?>
                    <?= nav_item("stok/giris_stok_kayitlari", "STOK", "fa fa-list", "text-danger") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("arac_duzenle") || goruntuleme_kontrol("sadece_kendi_aracini_yonet")): ?>
                    <?= nav_item("arac", "ŞİRKET ARAÇLARI", "fas fa-car", "text-success") ?>
                <?php endif; ?>

                <?php if(!user_in($user_id, [7, 9])): ?>
                    <?php if(!goruntuleme_kontrol("musteri_ekle") && goruntuleme_kontrol("merkezleri_goruntule")): ?>
                        <?= nav_item("merkez", "Kargo Etiketi", "fas fa-shipping-fast", "text-default", "", "waiting('Merkezleri Görüntüle')") ?>
                        <?= nav_item("servis/servis_cihaz_sorgula_view", "Atış Yükleme", "fas fa-upload", "text-default") ?>
                    <?php endif; ?>

                    <?php if(goruntuleme_kontrol("ilbazli_tum_cihazlari_goruntule")): ?>
                        <?= nav_item("cihaz/tumcihazlarilbazli", "İL BAZLI CİHAZLAR", "fas fa-map-marked-alt", "text-default") ?>
                    <?php endif; ?>

                    <?php if((goruntuleme_kontrol("musteri_ekle") && goruntuleme_kontrol("musterileri_goruntule")) || goruntuleme_kontrol("merkezleri_goruntule")): ?>
                        <?php if(user_in($user_id, [1, 14, 12])): ?>
                            <li class="nav-item" style="display: none;">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users text-orange"></i>
                                    <p>MÜŞTERİ <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview" style="border-left: 0;">
                                    <?= nav_item("cihaz", "Cihazlari Görüntüle", "far fa-list-alt", "text-default", "", "", "border-left: 0;") ?>
                                    <?= nav_item("musteri", "Müşterileri Görüntüle", "far fa-list-alt", "text-default", "", "", "border-left: 0;") ?>
                                    <?php if(!user_in($user_id, [7, 9])): ?>
                                        <?= nav_item("merkez", "Merkezleri Görüntüle", "far fa-building", "text-default", "", "waiting('Merkezleri Görüntüle')", "border-left: 0;") ?>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("talep_havuzu_goruntule")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-people-arrows text-red"></i>
                            <p>TALEP (ADMİN) <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(user_in($user_id, [1, 4])): ?>
                                <?= nav_item("talep", "Talep Havuzu", "far fa-folder-open", "", "", "waiting('Talep Havuzu')") ?>
                            <?php endif; ?>
                            <?= nav_item("rut", "Rut Planlama", "fas fa-map-signs", "", "", "waiting('Rut Planlama')") ?>
                            <?= nav_item("talep/yonlendirmeler/1", "Yönlendirilen Talepler", "far fa-file-archive", "", "", "waiting('Yönlendirilen Talepler')") ?>
                            <?= nav_item("talep/bekleyen_rapor", "Talep Uyarı Sms Gönder", "fas fa-user-clock", "text-warning") ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("siparis_onay_1")): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("tum-taleplerim")?>" onclick="waiting('TALEP')" class="nav-link">
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>TALEP</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($user_id != 11 && $user_id != 40): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down text-warning"></i>
                            <p>SİPARİŞ <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(goruntuleme_kontrol("satis_limitlerini_yonet")): ?>
                                <?= nav_item("fiyat_limit", "Satış Limitleri", "fas fa-dollar-sign") ?>
                            <?php endif; ?>

                            <?= nav_item("siparis/hizli_siparis_olustur_view", "Hızlı Sipariş Oluştur", "fas fa-plus-circle", "", "", "waiting('Hızlı Sipariş Oluştur')") ?>

                            <?php if(goruntuleme_kontrol("siparis_beklemeye_al")): ?>
                                <?= nav_item("onay-bekleyen-siparisler?filter=2", "Onay Bekleyen Siparişler", "fas fa-hourglass-half", "", "", "waiting('Onay Bekleyen Siparişler')") ?>
                            <?php else: ?>
                                <?= nav_item("onay-bekleyen-siparisler", "Onay Bekleyen Siparişler", "fas fa-hourglass-half", "", "", "waiting('Onay Bekleyen Siparişler')") ?>
                            <?php endif; ?>

                            <?php if($aktif_kullanici_id == 1): ?>
                                <?= nav_item("onay-bekleyen-siparisler-copy", "O.B.S", "fas fa-hourglass-half", "", "", "waiting('O.B.S')") ?>
                            <?php endif; ?>

                            <?= nav_item("tum-siparisler", "Tüm Siparişler", "fas fa-shopping-cart") ?>

                            <?php if($aktif_kullanici_id == 1): ?>
                                <?= nav_item("siparis/siparis_kisa_yollar", "Siparişler Kısa Yolları", "fas fa-bolt", "", "", "waiting('Siparişler Kısa Yolları')") ?>
                                <?= nav_item("siparis/demo_on_izleme", "Demo Ön İzleme", "fas fa-th-large", "", "", "waiting('Demo Ön İzleme')") ?>
                            <?php endif; ?>

                            <?= nav_item("siparis/haftalik_kurulum_plan", "Haftalık Kurulum Planı", "fas fa-calendar-week", "", "", "waiting('Haftalık Kurulum Planı')") ?>

                            <?php if(goruntuleme_kontrol("iptal_edilen_siparisleri_goruntule")): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("cihaz/iptal_edilen_siparisler")?>" style="border-left: 0;" class="nav-link">
                                        <i class="fas fa-ban nav-icon"></i>
                                        <p>İptal Edilenler</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <?php 
                    // Departman ID'si 15 olan kullanıcılar satışlara girebilir
                    $is_departman_15 = isset($giris_yapan_k->kullanici_departman_id) && $giris_yapan_k->kullanici_departman_id == 15;
                    // Satış yetkilisi kontrolü (departman_id: 12, 17, 18, 15 veya kullanici_id: 2, 9, 1)
                    $is_satis_yetkilisi = false;
                    if(isset($giris_yapan_k->kullanici_departman_id) && in_array($giris_yapan_k->kullanici_departman_id, [12, 17, 18, 15])) {
                        $is_satis_yetkilisi = true;
                    }
                    if(in_array($aktif_kullanici_id, [2, 9, 1])) {
                        $is_satis_yetkilisi = true;
                    }
                    if(goruntuleme_kontrol("tum_siparisleri_goruntule")) {
                        $is_satis_yetkilisi = true;
                    }
                    if($is_satis_yetkilisi || $is_departman_15):
                    ?>
                    <li class="nav-item">
                        <a href="<?=base_url("siparis/siparisler_restore")?>" onclick="waiting('Siparişler');" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down text-warning"></i>
                            <p>SİPARİŞ</p>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(goruntuleme_kontrol("sms_degerlendirme_raporunu_goruntule")): ?>
                        <li class="nav-item">
                            <a href="<?=base_url("siparis/degerlendirme_rapor")?>" style="border-left: 0;" class="nav-link">
                                <i class="fas fa-sms nav-icon"></i>
                                <p>SMS Sonuçları</p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("trendyol_siparislerini_goruntule")): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("trendyol")?>" style="border-left: 0;" class="nav-link">
                            <img style="margin-left: 14px; margin-right: 7px;" src="https://developers.trendyol.com/img/favicon.ico" alt="">
                            <p>TRENDYOL YÖNETİM</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php 
                // Departman ID'si 15 olan kullanıcılar sertifikalardaki her şeye erişebilir
                $is_departman_15 = isset($giris_yapan_k->kullanici_departman_id) && $giris_yapan_k->kullanici_departman_id == 15;
                if(goruntuleme_kontrol("egitim_bilgilerini_goruntule") || goruntuleme_kontrol("sertifika_kontrol_onayla") || $is_departman_15): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("egitim")?>" onclick="waiting('Sertifikalar');" class="nav-link">
                            <i class="nav-icon fas fa-award text-warning"></i>
                            <p>SERTİFİKA</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($user_id == 14): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("servis")?>" style="border-left: 0;" class="nav-link">
                            <i class="fa fa-list nav-icon text-success"></i>
                            <p>Cihaz Teknik Servis</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("isleme_alinan_basliklari_goruntule")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog text-success"></i>
                            <p>TEKNİK SERVİS <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(goruntuleme_kontrol("servis_goruntule")): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("servis")?>" style="border-left: 0;" class="nav-link">
                                        <i class="fas fa-tools nav-icon text-success"></i>
                                        <p>Cihaz Teknik Servis</p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?= nav_item("baslik/isleme_alinan_basliklar", "İşleme Alınan Başlıklar", "fas fa-retweet", "", "", "waiting('İşleme Alınan Başlıklar')") ?>
                            <?= nav_item("baslik/tamamlanan_basliklar", "Tamamlanan Başlıklar", "fas fa-check", "", "", "waiting('İşleme Alınan Başlıklar')") ?>
                            <?= nav_item("cihaz/tum-basliklar", "Başlık Tanımları", "fas fa-tags", "", "", "waiting('Başlıkları Görüntüle')") ?>
                            <?= nav_item("baslik/baslik_havuz_tanimla_view", "Yeni Başlık QR (Üretim)", "fas fa-qrcode", "", "", "waiting('Yeni Başlık QR (Üretim)')") ?>
                            <?= nav_item("baslik/baslik_havuz_liste_view", "Başlık Havuzu (Yeniler)", "fas fa-layer-group", "", "", "waiting('Başlık Havuzu (Yeniler)')") ?>
                            
                            <li class="nav-item">
                                <a href="<?=base_url("stok/urungonderim")?>" class="nav-link">
                                    <i class="fas fa-truck nav-icon"></i>
                                    <p style="color:orange">HAVA HORT. GÖNDERİM</p>
                                </a>
                            </li>
                            <?= nav_item("baslik/iade_etiket", "İADE ETİKETİ YAZDIR", "fas fa-print") ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php 
                // Üretim modülü erişim kontrolü - daha esnek
                $uretim_erisim = false;
                
                // Yetki kontrolü
                if(goruntuleme_kontrol("cihaz_havuz_duzenle") || goruntuleme_kontrol("uretim_plan_yonetimi")) {
                    $uretim_erisim = true;
                }
                
                // Üretim departmanı kontrolü - departman adına göre (case-insensitive)
                if(isset($giris_yapan_k->departman_adi) && !empty($giris_yapan_k->departman_adi)) {
                    $departman_adi = mb_strtolower(trim($giris_yapan_k->departman_adi), 'UTF-8');
                    // "Üretim", "Uretim", "ÜRETİM" gibi varyasyonları kontrol et
                    if(strpos($departman_adi, 'üretim') !== false || 
                       strpos($departman_adi, 'uretim') !== false ||
                       strpos($departman_adi, 'üret') !== false ||
                       strpos($departman_adi, 'uret') !== false) {
                        $uretim_erisim = true;
                    }
                }
                
                // Departman ID kontrolü (yedek - daha geniş aralık)
                if(isset($giris_yapan_k->kullanici_departman_id)) {
                    // Üretim departmanı ID'leri (37, 8 ve diğer olası ID'ler)
                    // Not: Eğer hala çalışmıyorsa, bu ID'leri genişletmek gerekebilir
                    if(in_array($giris_yapan_k->kullanici_departman_id, [37, 8, 7, 9])) {
                        $uretim_erisim = true;
                    }
                }
                
                // Belirli kullanıcı ID'leri (yedek kontrol)
                if(user_in($aktif_kullanici_id, [1, 9, 37, 8, 7])) {
                    $uretim_erisim = true;
                }
                
                // DEBUG: Eğer hala giremiyorsa, tüm kullanıcılara geçici olarak açılabilir
                // Bu satırı kaldırmadan önce üretim departmanı ID'sini doğrulayın
                // if(true) { $uretim_erisim = true; } // GEÇİCİ - TÜM KULLANICILARA AÇIK
                
                if($uretim_erisim): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog text-success"></i>
                            <p>ÜRETİM <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?= nav_item("cihaz/cihaz_havuz_tanimla_view", "Yeni Cihaz Kayıt", "fas fa-plus-circle", "", "", "waiting('Yeni Başlık QR (Üretim)')") ?>
                            <?= nav_item("cihaz/cihaz_havuz_liste_view", "Cihaz Havuzu (Stok)", "fas fa-database", "", "", "waiting('Başlık Havuzu (Yeniler)')") ?>
                            <?= nav_item("baslik/baslik_havuz_tanimla_view", "Yeni Başlık QR (Üretim)", "fas fa-qrcode", "", "", "waiting('Yeni Başlık QR (Üretim)')") ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url("uretim_planlama")?>" onclick="waiting('Üretim Planlama');" class="nav-link">
                            <i class="nav-icon fas fa-users-cog text-success"></i>
                            <p>ÜRETİM</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("demirbas_goruntule")): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box text-primary"></i>
                            <p>ENVANTER <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("demirbas/ekle/1")?>" style="border-left: 0;" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon text-success"></i>
                                    <p>Yeni Envanter Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="border-left: 0;" href="<?=base_url("demirbas")?>" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon text-default"></i>
                                    <p>Tüm Envanterler</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url("demirbas")?>" onclick="waiting('Envanter');" class="nav-link">
                            <i class="nav-icon fas fa-box text-primary"></i>
                            <p>ENVANTER</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("muhasebe_rapor_goruntule")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-people-arrows text-red"></i>
                            <p>RAPORLAR <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?= nav_item("kullanici/muhasebe_rapor/".date("m"), "Muhasebe Rapor", "fas fa-chart-line") ?>
                            <?= nav_item("talep/rapor", "Talep Analiz", "fas fa-chart-bar", "", "", "waiting('Talep Raporu')") ?>
                            <?= nav_item("talep/yogunluk_haritasi", "Talep Yoğunluk Haritası", "fas fa-map", "", "", "waiting('Talep Raporu')") ?>
                            <?= nav_item("talep/bekleyen_rapor_list", "Bekleyen Talepler", "fas fa-hourglass-half", "", "", "waiting('Yönlendirilen Talepler')") ?>

                            <?php if(goruntuleme_kontrol("garanti_sorgulayanlari_goruntule")): ?>
                                <?= nav_item("cihaz/garanti_sorgulayanlar", "Garanti Sorgulayanlar", "fas fa-shield-alt") ?>
                            <?php endif; ?>

                            <?= nav_item("cihaz/cihaz_harita", "Cihaz Raporu (Harita)", "fas fa-map-marked-alt", "", "", "waiting('Cihaz Raporu')") ?>
                            <?= nav_item("cihaz/rg_medikal_cihaz_harita", "RG Cihaz Raporu (Harita)", "fas fa-map-marked-alt", "", "", "waiting('Cihaz Raporu')") ?>
                            
                            <li class="nav-item">
                                <a href="<?=base_url("siparis/degerlendirme_rapor")?>" style="border-left: 0;" class="nav-link">
                                    <i class="fas fa-sms nav-icon"></i>
                                    <p>SMS Sonuçları</p>
                                </a>
                            </li>

                            <?php if(user_in($aktif_kullanici_id, [1, 7, 9])): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("atis")?>" style="border-left: 0;" class="nav-link">
                                        <i class="fas fa-bullseye nav-icon"></i>
                                        <p>Atış Raporu</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if($user_id != 40): ?>
                    <?= nav_header("ENTEGRASYON") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("arvento_goruntuless")): ?>
                    <li class="nav-item">
                        <a href="https://web.arvento.com/ui/shareVehiclesLink/ShareVehiclesLink.aspx?g=8fb0d168d591452eIB6zmbsR5u2EXLKmYgtgEg==9e0fa12eeeb2c989&ed=20250306093044&sd=20250106093055&lc=tr&ln=0" target="_blank" class="nav-link">
                            <i class="nav-icon fas fa-car text-primary"></i>
                            <p>ARVENTO</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("calisma_plani_goruntule")): ?>
                    <?= nav_item("calisma_plan", "ÇALIŞMA PLANLAMA", "fas fa-clock", "text-success") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("sadece_kendi_teklif_formlarini_goruntule") || goruntuleme_kontrol("tum_teklif_formlarini_goruntule")): ?>
                    <?= nav_item("teklif_form", "TEKLİF FORMLARI", "fas fa-file-invoice", "text-success") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("kapi_yonetim")): ?>
                    <?= nav_item("kapi", "KAPI", "fas fa-door-open", "text-danger") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("arvento_goruntule")): ?>
                    <?= nav_item("arvento", "ARVENTO", "fas fa-truck", "text-warning") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("onemli_gun_yonetimi")): ?>
                    <?= nav_item("onemli_gun", "ÖNEMLİ GÜNLER", "fas fa-calendar", "text-primary") ?>
                    <?= nav_item("onemli_gun/index_etkinlik", "YAKLAŞAN ETKİNLİKLER", "fas fa-calendar", "text-primary") ?>
                    <?= nav_item("paylasim", "KAMPANYALAR", "fas fa-calendar", "text-primary") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("sistem_ayar_duzenle")): ?>
                    <?= nav_header("SİSTEM") ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog text-warning"></i>
                            <p>SİSTEM YÖNETİMİ <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?= nav_item("kullanici", "Kullanıcılar", "fas fa-users") ?>
                            <?= nav_item("dogum_gunu", "Doğum Günü Bildirimleri", "fas fa-birthday-cake") ?>
                            <?= nav_item("sms_templates", "SMS Metinleri", "fas fa-sms") ?>
                            <?= nav_item("kullanici-yetkileri", "Kullanıcı Yetkileri", "fas fa-user-shield") ?>
                            <?= nav_item("urun", "Ürün", "fas fa-cube") ?>
                            <?= nav_item("departman", "Departmanlar", "fas fa-sitemap") ?>
                            <?= nav_item("duyuru-kategori", "Duyuru Kategorileri", "fas fa-bullhorn") ?>
                            <?= nav_item("istek_birim", "İstek Birimleri", "fas fa-building") ?>
                            <?= nav_item("istek_kategori", "İstek Kategorileri", "fas fa-tags") ?>
                            <?= nav_item("is_tip", "İş Tipleri", "fas fa-tasks") ?>
                            <?= nav_item("istek_durum", "İstek Durumları", "fas fa-info-circle") ?>
                            <?= nav_item("dokuman_kategori", "Döküman Kategorileri", "fas fa-folder") ?>
                            <?= nav_item("demirbas_kategori", "Envanter Kategorileri", "fas fa-folder") ?>
                            <?= nav_item("demirbas_birim", "Envanter Birimleri", "fas fa-ruler") ?>
                            <?= nav_item("kullanici_grup", "Kullanıcı Grupları", "fas fa-users") ?>
                            <?= nav_item("sehir", "İl - İlçe Bilgileri", "fas fa-map-marker-alt") ?>
                            <?= nav_item("yemek", "Yemek Listesi", "fas fa-utensils") ?>
                            <?= nav_item("ayar", "Parametreler", "fas fa-sliders-h") ?>
                            <li class="nav-item">
                                <a href="<?=base_url("ayar/arac_kilometre_ortalamalari")?>" class="nav-link">
                                    <i class="fas fa-tachometer-alt nav-icon"></i>
                                    <p style="font-size:12px">Araç Km Ort.</p>
                                </a>
                            </li>
                            <?= nav_item("ariza", "Başlık Arıza Tanımları", "fas fa-exclamation-triangle") ?>
                            <?= nav_item("logs", "Log", "fas fa-file-alt", "text-success") ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var sidebar = document.getElementById("main-sidebar");
    var contentWrappers = document.querySelectorAll(".content-wrapper");
    var headerWrappers = document.querySelectorAll(".main-header");

    if (window.opener && window.innerWidth < 1366) {
        sidebar.style.display = "none";
        contentWrappers.forEach(function(contentWrapper) {
            contentWrapper.style.marginLeft = "0";
        });
        headerWrappers.forEach(function(headerWrapper) {
            headerWrapper.style.display = "none";
        });
    }

    // Mobile responsive handling - Fixed to work with AdminLTE
    // Ensure sidebar is completely hidden by default on mobile using transform
    function handleMobileSidebar() {
        var isMobile = window.innerWidth <= 767.98;
        var body = document.body;
        
        if (isMobile && sidebar) {
            // On mobile, use transform to completely hide sidebar and make it full screen when open
            if (!body.classList.contains('sidebar-open')) {
                sidebar.style.transform = 'translateX(-100%)';
                sidebar.style.marginLeft = '';
                sidebar.style.width = '';
                sidebar.style.maxWidth = '';
            } else {
                sidebar.style.transform = 'translateX(0)';
                sidebar.style.marginLeft = '';
                sidebar.style.width = '100%';
                sidebar.style.maxWidth = '100%';
            }
        } else if (!isMobile && sidebar) {
            // On desktop, remove mobile-specific styles
            sidebar.style.transform = '';
            sidebar.style.marginLeft = '';
        }
    }
    
    // Initial check - ensure sidebar is hidden on mobile load
    handleMobileSidebar();
    
    // Show/hide close button based on screen size
    function toggleCloseButton() {
        var closeBtn = document.getElementById('sidebar-close-btn');
        if (closeBtn) {
            if (window.innerWidth <= 767.98) {
                closeBtn.style.display = 'flex';
            } else {
                closeBtn.style.display = 'none';
            }
        }
    }
    
    // Initial check
    toggleCloseButton();
    
    // Update on resize
    window.addEventListener('resize', function() {
        toggleCloseButton();
    });
    
    // Close sidebar function for mobile
    window.closeSidebarMobile = function() {
        if (window.innerWidth <= 767.98) {
            if (typeof $ !== 'undefined' && $.fn.pushmenu) {
                // Use AdminLTE's pushmenu to close
                $('[data-widget="pushmenu"]').pushmenu('toggle');
            } else {
                // Fallback: manually remove sidebar-open class
                document.body.classList.remove('sidebar-open');
            }
        }
    };
    
    // Handle resize - debounced
    var resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            handleMobileSidebar();
        }, 150);
    });
    
    // Also listen for AdminLTE's sidebar toggle events to sync state
    if (typeof $ !== 'undefined') {
        $(document).on('collapsed.lte.pushmenu', function() {
            if (window.innerWidth <= 767.98 && sidebar) {
                sidebar.style.transform = 'translateX(-100%)';
                sidebar.style.marginLeft = '';
                sidebar.style.width = '';
                sidebar.style.maxWidth = '';
            }
        });
        
        $(document).on('shown.lte.pushmenu', function() {
            if (window.innerWidth <= 767.98 && sidebar) {
                sidebar.style.transform = 'translateX(0)';
                sidebar.style.marginLeft = '';
                sidebar.style.width = '100%';
                sidebar.style.maxWidth = '100%';
            }
        });
    }
    
    // Close sidebar when clicking outside on mobile - Fixed to work with AdminLTE
    // AdminLTE already handles overlay clicks, we just ensure proper behavior
    var mobileClickHandlerAdded = false;
    if (window.innerWidth <= 767.98 && !mobileClickHandlerAdded) {
        mobileClickHandlerAdded = true;
        document.addEventListener('click', function(e) {
            var body = document.body;
            var isMobile = window.innerWidth <= 767.98;
            
            if (isMobile && body.classList.contains('sidebar-open')) {
                var pushMenuBtn = e.target.closest('[data-widget="pushmenu"]');
                var sidebarOverlay = e.target.closest('#sidebar-overlay');
                
                // AdminLTE handles overlay clicks, we don't interfere
                // Only handle edge cases if needed
                if (!sidebar.contains(e.target) && !pushMenuBtn && !sidebarOverlay) {
                    // Let AdminLTE's PushMenu handle this
                }
            }
        }, true);
    }

    // Smooth scroll for sidebar
    var sidebarElement = document.querySelector('.sidebar');
    if (sidebarElement) {
        sidebarElement.style.scrollBehavior = 'smooth';
    }

    // Optimized menu filter - only shows visible items, ignores hidden ones
    var sidebarFilter = document.getElementById("sidebar-menu-filter");
    if (sidebarFilter) {
        var filterTimeout;
        sidebarFilter.addEventListener("keyup", function() {
            clearTimeout(filterTimeout);
            var self = this;
            filterTimeout = setTimeout(function() {
                var filterValue = self.value.toLowerCase().trim();
            var menuItems = document.querySelectorAll("#sidebar-menu-list > li");
            
            menuItems.forEach(function(item) {
                    // Skip if item is hidden by inline style
                    var itemStyle = item.getAttribute("style");
                    var isHiddenByStyle = itemStyle && itemStyle.includes("display: none");
                
                    // Skip nav headers - always show them
                    var navHeader = item.querySelector(".nav-header");
                if (navHeader) {
                        if (filterValue === "") {
                    item.style.display = "";
                            item.style.opacity = "1";
                        } else {
                            // Hide headers when filtering
                            item.style.display = "none";
                        }
                    return;
                }
                    
                    // Skip items that are hidden by default (style="display: none")
                    if (isHiddenByStyle && filterValue === "") {
                        return; // Keep them hidden
                    }
                    
                    // Get visible text from nav-link (not from hidden elements)
                    var navLink = item.querySelector(".nav-link");
                    if (!navLink) {
                        if (filterValue === "") {
                            item.style.display = isHiddenByStyle ? "none" : "";
                        } else {
                            item.style.display = "none";
                        }
                        return;
                    }
                    
                    var linkText = navLink.textContent.toLowerCase().trim();
                    // Remove arrow icons and other UI elements from text
                    linkText = linkText.replace(/\s+/g, ' ').trim();
                
                var treeview = item.querySelector(".nav-treeview");
                    var hasMatch = false;
                    
                    // Check if main link matches
                    if (linkText.includes(filterValue)) {
                        hasMatch = true;
                    }
                    
                    // Check treeview subitems if exists
                    if (treeview) {
                        var subItems = treeview.querySelectorAll("li");
                        var visibleSubItems = 0;
                    
                    subItems.forEach(function(subItem) {
                            var subLink = subItem.querySelector(".nav-link");
                            if (!subLink) {
                                subItem.style.display = "none";
                                return;
                            }
                            
                            var subText = subLink.textContent.toLowerCase().trim();
                            subText = subText.replace(/\s+/g, ' ').trim();
                            
                            if (filterValue === "") {
                                // Show all subitems when no filter
                                subItem.style.display = "";
                                subItem.style.opacity = "1";
                                visibleSubItems++;
                            } else if (subText.includes(filterValue)) {
                            hasMatch = true;
                            subItem.style.display = "";
                                subItem.style.opacity = "1";
                                visibleSubItems++;
                        } else {
                                subItem.style.display = "none";
                                subItem.style.opacity = "0";
                            }
                        });
                        
                        // Auto-expand treeview if there's a match
                        if (hasMatch && filterValue !== "") {
                            item.classList.add("menu-open");
                            treeview.style.display = "block";
                        } else if (filterValue === "") {
                            // Restore original state when filter is cleared
                            if (!item.classList.contains("menu-open")) {
                                treeview.style.display = "";
                            }
                        }
                    }
                    
                    // Show/hide main item based on match
                    if (filterValue === "") {
                        // Restore original visibility
                        if (isHiddenByStyle) {
                            item.style.display = "none";
                } else {
                        item.style.display = "";
                            item.style.opacity = "1";
                        }
                    } else if (hasMatch) {
                        // Show item if it matches
                        if (!isHiddenByStyle) {
                            item.style.display = "";
                            item.style.opacity = "1";
                        }
                    } else {
                        // Hide item if no match
                        item.style.display = "none";
                        item.style.opacity = "0";
                    }
                });
            }, 150); // Debounce for better performance
        });
        
        // Clear filter on escape key
        sidebarFilter.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                this.value = "";
                this.dispatchEvent(new Event("keyup"));
            }
        });
    }

    // Enhanced active menu highlighting
    var currentPath = window.location.pathname.toLowerCase();
    if (currentPath !== "/") {
        var navLinks = document.querySelectorAll(".nav-sidebar .nav-link");
        navLinks.forEach(function(link) {
            var href = link.getAttribute("href");
            if (href && href !== "#") {
                var linkPath = href.toLowerCase();
                if (currentPath.indexOf(linkPath) > -1 || linkPath.indexOf(currentPath) > -1) {
                    var navItem = link.closest(".nav-item");
                    if (navItem) {
                        navItem.classList.add("active", "menu-open");
                        link.style.background = "rgba(255, 255, 255, 0.15)";
                        link.style.fontWeight = "600";
                        
                        // Expand parent treeview if exists
                        var parentTreeview = navItem.closest(".nav-treeview");
                        if (parentTreeview) {
                            var parentNavItem = parentTreeview.closest(".nav-item");
                            if (parentNavItem) {
                                parentNavItem.classList.add("menu-open");
                                parentTreeview.style.display = "block";
                            }
                        }
                    }
                }
            }
        });
    }

    // Add ripple effect to nav links
    var navLinks = document.querySelectorAll(".nav-sidebar .nav-link");
    navLinks.forEach(function(link) {
        link.addEventListener("click", function(e) {
            var ripple = document.createElement("span");
            ripple.style.position = "absolute";
            ripple.style.borderRadius = "50%";
            ripple.style.background = "rgba(255, 255, 255, 0.3)";
            ripple.style.width = "0";
            ripple.style.height = "0";
            ripple.style.left = e.offsetX + "px";
            ripple.style.top = e.offsetY + "px";
            ripple.style.transform = "translate(-50%, -50%)";
            ripple.style.animation = "ripple 0.6s ease-out";
            this.style.position = "relative";
            this.style.overflow = "hidden";
            this.appendChild(ripple);
            
            setTimeout(function() {
                ripple.remove();
            }, 600);
        });
    });
});

// Add ripple animation
var style = document.createElement("style");
style.textContent = `
    @keyframes ripple {
        to {
            width: 200px;
            height: 200px;
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>