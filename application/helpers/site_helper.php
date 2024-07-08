<?php

function session_control()
{
    $CI = &get_instance();
    $combine = $CI->input->ip_address() . $CI->session->userdata('username');
    $crypto = sha1(md5($combine));
    if ($CI->session->userdata('user_session') != $crypto) {
        redirect(base_url("giris-yap"));
    }
}
function session_login_control()
{
    $CI = &get_instance();
    $combine = $CI->input->ip_address() . $CI->session->userdata('username');
    $crypto = sha1(md5($combine));
    if ($CI->session->userdata('user_session') == $crypto) {
        redirect(base_url("anasayfa"));
    }
}
function log_data($log_tipi,$log_detay)
{
    $CI = &get_instance();
    $CI->db->flush_cache();
    $log = [];
    $log["log_kullanici_no"] = aktif_kullanici()->kullanici_id;
    $log["log_tipi"] = $log_tipi;
    $log["log_detay"] = $log_detay;  
    $CI->db->insert('logs', $log);
}





function escape($string) { 
    if(!empty($string) && is_string($string)) { 
		$string = trim($string);
        $string = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $string);

        return strip_tags($string);
    }else{
      return $string;
    }
} 


function create_slug($str) {
  // Türkçe karakterleri İngilizce'ye çevir
  $tr = array('ç', 'ğ', 'ı', 'i', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'Ö', 'Ş', 'Ü');
  $en = array('c', 'g', 'i', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'O', 'S', 'U');
  $str = str_replace($tr, $en, $str);

  // Diğer karakterleri temizle ve küçük harfe çevir
  $slug = url_title($str, 'dash', TRUE);

  return $slug;
}


function yetki_kontrol($yetki_kodu) { 
  $CI = get_instance();
  $CI->load->model('Kullanici_yetkileri_model'); 
  $data = $CI->Kullanici_yetkileri_model->check_permission($yetki_kodu);
  if(!$data){
    $CI->session->set_flashdata('flashDanger', 'Yetkisiz Erişim. Bu modüle erişim yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz');   
  
    redirect($_SERVER['HTTP_REFERER']);
  }

} 

function goruntuleme_kontrol($yetki_kodu) { 
  $CI = get_instance();
  $CI->load->model('Kullanici_yetkileri_model'); 
  $data = $CI->Kullanici_yetkileri_model->check_permission($yetki_kodu);
  if(!$data){
   return false;
  }
  return true;

} 
function gunSayisiHesapla($tarih1, $tarih2) {
  $tarih1 = new DateTime($tarih1);
  $tarih2 = new DateTime($tarih2);

  $fark = $tarih1->diff($tarih2);

  return $fark->days;
}
function zamanFarkiHesapla($tarih1, $tarih2) {
  $tarih1 = new DateTime($tarih1);
  $tarih2 = new DateTime($tarih2);

  $fark = $tarih1->diff($tarih2);

  $gun = $fark->days;
  $saat = $fark->h + $gun * 24; // Saat olarak hesaplama
  $dakika = $fark->i + $saat * 60; // Dakika olarak hesaplama

  return array('gun' => $gun, 'saat' => $saat, 'dakika' => $dakika);
}

function get_son_adim($siparis_id) { 
  $CI =get_instance();  
  $CI->db->select('*');
  $CI->db->from('siparis_onay_hareketleri');
  $CI->db->where('siparis_no', $siparis_id);
  $CI->db->order_by('onay_tarih', 'DESC');
  $CI->db->limit(1);
  $query = $CI->db->get();
  $result = $query->row();

  if ($result) {
      $guncel_adim = $result->adim_no + 1;
      $CI->db->select('*');
      $CI->db->from('siparis_onay_adimlari');
      $CI->db->where('adim_id', $guncel_adim);
      $query2 = $CI->db->get();
      return $query2->result();
  } else {
      return false; 
  }
} 
function sonKelimeBuyuk($metin) {
   
  $kelimeler = explode(" ", $metin);
  
   
  $sonKelimeIndex = count($kelimeler) - 1;
  
  
  $sonKelime = mb_strtoupper($kelimeler[$sonKelimeIndex], 'UTF-8');
  
  
  for ($i = 0; $i < $sonKelimeIndex; $i++) {
      $kelimeler[$i] = mb_convert_case(mb_strtolower($kelimeler[$i], 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
      
  }
  
  // Son kelimeyi yeni metinle birleştir ve döndür
  return implode(" ", $kelimeler);
}

function get_arac_km_son_kayit($aracid) { 
  $CI = get_instance();
  $CI->load->model('Arac_model');
  $data = $CI->Arac_model->get_all_km($aracid);
  return $data != null ? $data[0] : null;
} 
function get_degisim_stok_tanimlari() { 
  $CI = get_instance();
  $CI->load->model('Stok_model');
  $data = $CI->Stok_model->get_stok_tanimlari(["st.stok_aktarma"=>1]);
  return $data != null ? $data : null;
} 
function get_istek_sayi() { 
  $CI = get_instance();
  $data = count($CI->db->where("istek_durum_no",1)->get('istekler')->result());
  return $data;
} 


function get_cikis_birimleri() { 
  $CI = get_instance();
  $data = $CI->db
  ->select('*')
  ->from('stok_cikis_birimleri')->get()->result();
  return $data != null ? $data : null;
} 


function get_egitim($siparis) { 
  $CI = get_instance();
  $CI->load->model('Egitim_model');
  $data = $CI->Egitim_model->get_all(["siparis_urun_no" => $siparis]);
  return $data != null ? $data[0] : null;
} 

function get_merkez($siparis_urun_seri_no) { 
  $CI = get_instance();
  $CI->load->model('Cihaz_model');
  $data = $CI->Cihaz_model->get_all(["siparis_urunleri.seri_numarasi" => $siparis_urun_seri_no]);
  return $data != null ? $data[0] : null;
} 


function get_havuz($cihaz_no,$renk_no) { 
  $CI = get_instance();
  $data = $CI->db->where(["cihaz_havuz_durum"=>1])->get_where("cihaz_havuzu",["cihaz_kayit_no"=>$cihaz_no,"cihaz_renk_no"=>$renk_no])->result();
  return $data;
}


function get_arac_bildirim() { 
  $CI = get_instance();
  $sql = "SELECT 
		a.*, 
		k.*, 
		s.*, 
		DATEDIFF(k.arac_kasko_bitis_tarihi, CURDATE()) AS kasko_kalan_gun,
		DATEDIFF(s.arac_sigorta_bitis_tarihi, CURDATE()) AS sigorta_kalan_gun
	FROM 
		araclar a
	LEFT JOIN 
		(SELECT arac_tanim_id, MAX(arac_kasko_bitis_tarihi) AS arac_kasko_bitis_tarihi FROM arac_kaskolar GROUP BY arac_tanim_id) AS k_max ON a.arac_id = k_max.arac_tanim_id
	LEFT JOIN 
		arac_kaskolar k ON k_max.arac_tanim_id = k.arac_tanim_id AND k_max.arac_kasko_bitis_tarihi = k.arac_kasko_bitis_tarihi
	LEFT JOIN 
		(SELECT arac_tanim_id, MAX(arac_sigorta_bitis_tarihi) AS arac_sigorta_bitis_tarihi FROM arac_sigortalar GROUP BY arac_tanim_id) AS s_max ON a.arac_id = s_max.arac_tanim_id
	LEFT JOIN 
		arac_sigortalar s ON s_max.arac_tanim_id = s.arac_tanim_id AND s_max.arac_sigorta_bitis_tarihi = s.arac_sigorta_bitis_tarihi
";

	$query = $CI->db->query($sql);
	$adata = $query->result(); 
  foreach ($adata as $arac) {
    if(($arac->kasko_kalan_gun != "" && $arac->kasko_kalan_gun <= 7) || ($arac->sigorta_kalan_gun != "" &&$arac->sigorta_kalan_gun <= 7)){
      return true;
      break;
    }
  }
return false;

}




function get_talep_uyari() { 
  $CI = get_instance();
 if( $CI->session->userdata('aktif_kullanici_id') == 9){
  $sql = "SELECT kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_id, kullanicilar.kullanici_bireysel_iletisim_no, COUNT(*) AS toplam_satir_sayisi
  FROM talep_yonlendirmeler
  INNER JOIN kullanicilar ON talep_yonlendirmeler.yonlenen_kullanici_id = kullanicilar.kullanici_id
  INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
  WHERE talep_yonlendirmeler.gorusme_sonuc_no = 1 AND talep_yonlendirmeler.yonlenen_kullanici_id <> 60
  GROUP BY kullanicilar.kullanici_ad_soyad;
  ";

  $query = $CI->db->query($sql)->result();
  foreach ($query as $talep) {
    $tarih1 = new DateTime(date("Y-m-d H:i:s"));
    $tarih2 = new DateTime(date("Y-m-d H:i:s",strtotime($talep->yonlendirme_tarihi))); 
    $fark = $tarih1->diff($tarih2);
    $gun = $fark->days;
    $saat = $fark->h;
    $dakika = $fark->i;
    if($gun>0){
      return true;
      break;
    }
  } 
 }
 return false;
}

function son_ariza($primary_id,$id)
	{$CI = get_instance();
  
 
       $CI ->db->select('*');
       $CI ->db->where(["urun_baslik_ariza_tanim_id !="=>$primary_id]);
       $CI ->db->where(["siparis_urun_baslik_no"=>$id]);
       $CI ->db->from('urun_baslik_ariza_tanimlari');
       $CI ->db->order_by('urun_baslik_ariza_tanim_id', 'desc'); 
       $CI ->db->limit(2);  
        
        $query = $CI ->db->get();
        
        
        return $query->result();;
    }



    function get_cihaz_basliklar($cihaz_urun_no) { 
      $CI = get_instance();
      $basliklar = $CI->db->where('urun_no', $cihaz_urun_no)->get("urun_basliklari")->result();;
      return $basliklar;
    } 
    

function get_basliklar($baslik_ids) { 
  $CI = get_instance();
  
 
  $basliklar = $CI->db->where_in('baslik_id', json_decode($baslik_ids))->get("urun_basliklari")->result();;
   
  return $basliklar;
} 

function get_arizalar($ariza_ids) { 
  $CI = get_instance();
  
 
  $basliklar = $CI->db->where_in('urun_baslik_ariza_id', json_decode($ariza_ids))->get("urun_baslik_arizalar")->result();;
   
  return $basliklar;
} 

function get_yonlendiren_kullanici($id) { 
  $CI = get_instance();
  $CI->load->model('Kullanici_model');
  $data = $CI->Kullanici_model->get_by_id($id);
  return $data[0];
} 


function aktif_kullanici() { 
  $CI = get_instance();
  $CI->load->model('Kullanici_model');
  $data = $CI->Kullanici_model->get_by_id($CI->session->userdata('aktif_kullanici_id'));
  return $data[0];
} 

function kategoriler() { 
  $CI = get_instance();
  $CI->load->model('Dokuman_kategori_model');
  $data = $CI->Dokuman_kategori_model->get_all();
  return $data;
} 


function yetkiler() { 
  $CI = get_instance();
  $CI->load->model('Kullanici_yetkileri_model'); 
  $data = $CI->Kullanici_yetkileri_model->get_permissions_by_user_id();
  return $data;
} 
function araclar() { 
  $CI = get_instance();
  $CI->load->model('Arac_model'); 
  $data = $CI->Arac_model->get_all();
  return $data;
} 
function toplam_ariza($urun_id) { 
  $CI = get_instance(); 
  $data = $CI->db->get_where('urun_baslik_ariza_tanimlari', array('siparis_urun_baslik_no' => $urun_id))->num_rows();
  return $data;
} 
 















function get_urunler() { 
  $CI = get_instance(); 
  $data = $CI->db->get_where('urunler', array())->result();
  return $data;
} 
 
function get_renkler($urun_id) { 
  $CI = get_instance(); 
  $data = $CI->db->get_where('urun_renkleri', array('urun_no' => $urun_id))->result();
  return $data;
} 


function get_siparis_urunleri_by_musteri_id($musteri_id) { 
  $CI = get_instance();
  $CI->load->model('Cihaz_model');
  $data = $CI->Cihaz_model->get_all(["musteriler.musteri_id"=>$musteri_id]);
  return count($data);
} 

function get_siparis_urunleri($siparis_id) { 
  $CI = get_instance();
  $CI->load->model('Siparis_model');
  $data = $CI->Siparis_model->get_all_products_by_order_id($siparis_id);
  return $data;
} 


function ana_kategoriler() { 
  $CI = get_instance();
  $CI->load->model('Dokuman_kategori_model');
  $data = $CI->Dokuman_kategori_model->anaKategorileriGetir();
  return $data;
} 

function get_demirbas_birimleri() { 
  $CI = get_instance();
  $CI->load->model('Demirbas_birim_model');
  $data = $CI->Demirbas_birim_model->get_all();
  return $data;
} 


function get_sehirler_salt() { 
  $CI = get_instance();
  $CI->load->model('Sehir_model');
  $data = $CI->Sehir_model->get_all();
  return $data;
} 

function get_sehirler() { 
  $CI = get_instance();
  $sql = "SELECT s.*, r.*, k.kullanici_ad_soyad FROM sehirler s LEFT JOIN ( SELECT rt.* FROM rut_tanimlari rt JOIN ( SELECT MAX(rut_tanim_id) AS max_id, rut_sehir_id FROM rut_tanimlari GROUP BY rut_sehir_id ) max_r ON rt.rut_sehir_id = max_r.rut_sehir_id AND rt.rut_tanim_id = max_r.max_id ) r ON s.sehir_id = r.rut_sehir_id LEFT JOIN kullanicilar k ON r.rut_kullanici_id = k.kullanici_id;";
  $data = $CI->db->query($sql)->result();
  return $data;
} 
function get_sehirler_talep() { 
  $CI = get_instance();
  $sql = "SELECT sehirler.*, total_talep, max_talep, CASE WHEN total_talep >= max_talep * 0.8 THEN '#0747a1' WHEN total_talep >= max_talep * 0.7 THEN '#1065c0' WHEN total_talep >= max_talep * 0.6 THEN '#1477d2' WHEN total_talep >= max_talep * 0.5 THEN '#1a8ae5' WHEN total_talep >= max_talep * 0.4 THEN '#1e97f3' WHEN total_talep >= max_talep * 0.3 THEN '#41a7f5' ELSE '#4ba5e9' END AS renk FROM sehirler LEFT JOIN ( SELECT talep_sehir_no, COUNT(talep_id) AS total_talep FROM talepler GROUP BY talep_sehir_no ) AS talep_sayilari ON sehirler.sehir_id = talep_sayilari.talep_sehir_no CROSS JOIN ( SELECT MAX(total_talep) AS max_talep FROM ( SELECT talep_sehir_no, COUNT(talep_id) AS total_talep FROM talepler where talep_sehir_no != 0 GROUP BY talep_sehir_no ) AS sehir_talepleri ) AS max_talep_tablosu;";
  $data = $CI->db->query($sql)->result();
  return $data;
} 
function get_sehirler_cihaz() { 
  $CI = get_instance();
  $sql = "SELECT sehirler.sehir_id, sehirler.sehir_adi, COUNT(*) as toplam_kayit_sayisi FROM siparis_urunleri LEFT JOIN siparisler ON siparis_urunleri.siparis_kodu = siparisler.siparis_id LEFT JOIN urunler ON urunler.urun_id = siparis_urunleri.urun_no LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no LEFT JOIN sehirler ON sehirler.sehir_id = merkezler.merkez_il_id GROUP BY sehirler.sehir_id, sehirler.sehir_adi ORDER BY sehirler.sehir_id;";
  $data = $CI->db->query($sql)->result();
  return $data;
} 



function alt_kategoriler($id) { 
  $CI = get_instance();
  $CI->load->model('Dokuman_kategori_model');
  $data = $CI->Dokuman_kategori_model->altKategorileriGetir($id);
  return $data;
} 
function istek_bildirim_birimleri() { 
  $CI = get_instance();
  $CI->load->model('Istek_birim_model');
  $data = $CI->Istek_birim_model->get_all();
  return $data;
} 


function formatSMS($sms,$istek_kodu,$istek_tarihi,$kullanici,$sorumlu){

  $sms = str_replace("[kullanici_ad_soyad]", $kullanici->kullanici_ad_soyad, $sms);
  $sms = str_replace("[istek_kodu]", $istek_kodu, $sms);
  $sms = str_replace("[istek_tarihi]", $istek_tarihi, $sms);
  $sms = str_replace("[guncel_tarih]", date("d.m.Y H:i"), $sms);
  $sms = str_replace("[sorumlu_ad_soyad]", $sorumlu->kullanici_ad_soyad, $sms);
  return $sms;
}

function sendSMS($istek){
  $CI = get_instance();
  $CI->load->model('Ayar_model');
  $CI->load->model('Kullanici_model');
  $ayar = $CI->Ayar_model->get_by_id(1);

  $sms_template = "";
  switch ($istek->istek_durum_no) {
    case 1: // İstek Onaya Düştü
      $sms_template = $ayar[0]->istek_onay_bekleniyor_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_sorumlu[0]->kullanici_bireysel_iletisim_no,$send_sms);

        $viewData=[];
        $viewData["istek"]=$istek;
        $mail_data = $CI->load->view("istek/mail_report/main_content",$viewData,TRUE);
        sendEmail($sms_sorumlu[0]->kullanici_email_adresi,"İSTEK BİLDİRİM",$mail_data);
      }
      break;   
    case 2: // İstek Onaylandı
      $sms_template1 = $ayar[0]->istek_onaylandi_sms;
      $sms_template2 = $ayar[0]->istek_onaylandi_yonetici_sms;
      if($sms_template1 != null || $sms_template1 != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template1,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
        if($sms_template2 != null || $sms_template2 != ""){
          $sms_istek_kodu     =  $istek->istek_kodu;
          $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
          $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
          $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
          $send_sms           =  formatSMS($sms_template2,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
          sendSmsData($sms_sorumlu[0]->kullanici_bireysel_iletisim_no,$send_sms);
        }
      }
      break;  
    case 3: // İstek İşleme Alındı
      $sms_template = $ayar[0]->istek_isleme_alindi_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
      }
      break;  
    case 4: // İstek Tamamlandı
      $sms_template = $ayar[0]->istek_tamamlandi_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
      }
      break;
    case 5: // İstek Reddedildi
      $sms_template = $ayar[0]->istek_reddedildi_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
      }
      break;
    default:
      # code...
      break;
  }

}



function sendSmsData($phonenumber,$message){
  $CI = get_instance();
  $CI->load->model('Ayar_model');
  $ayar = $CI->Ayar_model->get_by_id(1);
 
 

  $curl = curl_init();

 

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '<?xml version="1.0"?>
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                 xmlns:xsd="http://www.w3.org/2001/XMLSchema"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <SOAP-ENV:Body>
            <ns3:smsGonder1NV2 xmlns:ns3="http://sms/">
                <username>'. $ayar[0]->netgsm_kullanici_ad.'</username>
                  <password>'.base64_decode($ayar[0]->netgsm_kullanici_sifre).'</password>
                  <header>'.$ayar[0]->netgsm_sms_baslik.'</header>
                  <msg>'.$message.'</msg>
                  <gsm>'.trim(str_replace(" ", "", $phonenumber)).'</gsm>
                <filter>0</filter>
                <encoding>TR</encoding>
              
            </ns3:smsGonder1NV2>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: text/xml'
    ),
));
 
  
  $response = curl_exec($curl);
  curl_close($curl); 
  print($response);
  return;
}





function formatTelephoneNumber($phoneNumber) {
  
  $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
 
  $formattedNumber = preg_replace('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', '0$2 $3 $4 $5', $phoneNumber);

  return $formattedNumber;
}

function talep_var_mi($phoneNumber) {
  $CI = get_instance();
  $CI->load->model('Talep_model');
  $talep_data = $CI->Talep_model->get_all(["talep_sorumlu_kullanici_id"=>1,"talep_cep_telefon"=>str_replace(" ", "", $phoneNumber)]);
  return (count($talep_data) > 0);
}

 
function controlTekrarlayanTalep($phoneNumber) {
  $CI = get_instance();
  $CI->load->model('Talep_model');
  $talep_data = $CI->Talep_model->get_all(["talep_cep_telefon"=>str_replace(" ", "", $phoneNumber)]);
  return (count($talep_data) > 1);
}






public function get_musteri_urun_bilgileri($musteri_id) {
  $sql = "
      SELECT 
          musteri_ad,
          GROUP_CONCAT(urun_bilgisi SEPARATOR ', ') AS urun_bilgisi
      FROM (
          SELECT 
              musteriler.musteri_id,
              musteriler.musteri_ad,
              CONCAT(COUNT(siparis_urunleri.urun_no), ' ', urunler.urun_adi) AS urun_bilgisi
          FROM 
              ugbusine_erpdatabase.siparis_urunleri
          INNER JOIN 
              urunler ON urunler.urun_id = siparis_urunleri.urun_no
          INNER JOIN 
              siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
          INNER JOIN 
              merkezler ON merkezler.merkez_id = siparisler.merkez_no
          INNER JOIN 
              musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id
          WHERE 
              musteriler.musteri_id = ".$musteri_id."
          GROUP BY 
              musteriler.musteri_id, urunler.urun_id
          ORDER BY 
              urunler.urun_id DESC
      ) AS urun_bilgileri
      GROUP BY 
          musteri_ad;
  ";

  // Sorguyu çalıştırın
  $query = $this->db->query($sql);
  // Sonuçları döndürün
  return $query->result();
}


















function sendEmail($sTo, $sSubject, $sMessage){
  $CI = get_instance();
  $CI->load->model('Ayar_model');
  $CI->load->library('email');
  $config_data = $CI->Ayar_model->get_by_id(1);




  $config['protocol']  = 'smtp';
  $config['smtp_host'] = $config_data[0]->mail_host;
  $config['smtp_user'] = $config_data[0]->mail_kullanici_adi;
  $config['smtp_pass'] = $config_data[0]->mail_sifre;
  $config['smtp_port'] = $config_data[0]->mail_port;
  $config['mailtype']  = 'html';
  $CI->email->initialize($config);      
  $CI->email->from($config_data[0]->mail_kullanici_adi, $config_data[0]->mail_gonderici_adi);
  $CI->email->to($sTo);
  $CI->email->subject($sSubject);
  $CI->email->message($sMessage);
  if( !$CI->email->send())
  {
    show_error($CI->email->print_debugger());
  }
  else
  {
    return 1;
  } 









}

?>