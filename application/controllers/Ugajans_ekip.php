<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_ekip extends CI_Controller {

	function __construct(){
        parent::__construct();
        ugajans_sess_control();
        date_default_timezone_set('Europe/Istanbul');
    }

	public function index()
	{
		// Tekrarlanan görevleri kontrol et ve oluştur
		$this->olustur_tekrarlanan_gorevler();
		
		// Aktif kullanıcı ID'sini al
		$aktif_kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');
		
		// Tüm kullanıcıları al
		$tum_kullanicilar = get_kullanicilar();
		
		// Kullanıcı ID 1 veya 2 ise tüm kullanıcıları göster, değilse sadece kendi ID'sini göster
		if ($aktif_kullanici_id == 1 || $aktif_kullanici_id == 2) {
			// Admin kullanıcılar - tüm kullanıcıları göster
			$viewData["kullanicilar_data"] = $tum_kullanicilar;
			$viewData["is_planlamasi_data"] = get_is_planlamasi();
		} else {
			// Normal kullanıcılar - sadece kendi takvimini göster
			$viewData["kullanicilar_data"] = array_values(array_filter($tum_kullanicilar, function($kullanici) use ($aktif_kullanici_id) {
				return $kullanici->ugajans_kullanici_id == $aktif_kullanici_id;
			}));
			
			// Sadece kendi event'lerini göster
			$where = ['ip.kullanici_no' => $aktif_kullanici_id];
			$viewData["is_planlamasi_data"] = get_is_planlamasi($where);
		}
		
		$viewData["musteriler_data"] = get_musteriler();
		$viewData["page"] = "ugajansviews/ekip_is_planlamasi";
		$this->load->view('ugajansviews/base_view',$viewData);
	}
	
	// Tekrarlanan görevleri otomatik oluştur
	private function olustur_tekrarlanan_gorevler()
	{
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		if(!in_array('tekrar_tipi', $columns)) {
			return; // Tekrarlama özelliği yoksa çık
		}
		
		// Tekrarlama tipi olan aktif görevleri al (ana görevler)
		// ana_gorev_id NULL veya 0 olanlar ana görevlerdir
		$this->db->where('aktif', 1);
		$this->db->where('tekrar_tipi !=', 'tek_seferlik');
		$this->db->where('tekrar_tipi IS NOT NULL');
		$this->db->group_start();
		$this->db->where('ana_gorev_id IS NULL', NULL, FALSE);
		$this->db->or_where('ana_gorev_id', 0);
		$this->db->or_where('ana_gorev_id', '');
		$this->db->group_end();
		$tekrarlanan_gorevler = $this->db->get('ugajans_is_planlamasi')->result();
		
		$bugun = date('Y-m-d');
		$bugun_timestamp = strtotime($bugun);
		
		// Debug: Kaç tane tekrarlanan görev bulundu
		// error_log("Tekrarlanan görev sayısı: " . count($tekrarlanan_gorevler));
		
		foreach($tekrarlanan_gorevler as $gorev) {
			// Debug: Görev bilgilerini logla
			// error_log("Tekrarlanan görev ID: " . $gorev->is_planlamasi_id . ", Tip: " . $gorev->tekrar_tipi);
			// Bitiş tarihi kontrolü
			if($gorev->tekrar_bitis_tarihi && $gorev->tekrar_bitis_tarihi < $bugun) {
				continue; // Bitiş tarihi geçmişse atla
			}
			
			// Başlangıç tarihi kontrolü
			$baslangic_tarihi = $gorev->tekrar_baslangic_tarihi ? $gorev->tekrar_baslangic_tarihi : $gorev->planlama_tarihi;
			
			if($baslangic_tarihi > $bugun) {
				continue; // Henüz başlamamışsa atla
			}
			
			// Son tekrar tarihi kontrolü
			$son_tekrar = $gorev->son_tekrar_tarihi ? $gorev->son_tekrar_tarihi : $baslangic_tarihi;
			
			if($gorev->tekrar_tipi === 'haftalik') {
				// Haftalık tekrar
				if(empty($gorev->tekrar_gunleri)) {
					continue; // Gün seçilmemişse atla
				}
				
				$gunler = explode(',', $gorev->tekrar_gunleri);
				$gunler = array_map('trim', $gunler);
				$gunler = array_filter($gunler); // Boş değerleri temizle
				$gunler = array_map('intval', $gunler); // Integer'a çevir
				
				if(empty($gunler)) {
					continue; // Gün yoksa atla
				}
				
				// Başlangıç tarihinden itibaren kontrol et
				$baslangic_tarihi = $gorev->tekrar_baslangic_tarihi ? $gorev->tekrar_baslangic_tarihi : $gorev->planlama_tarihi;
				$baslangic_timestamp = strtotime($baslangic_tarihi);
				
				// Bitiş tarihi - eğer yoksa 90 gün sonrası
				$bitis_tarihi = $gorev->tekrar_bitis_tarihi;
				if(!$bitis_tarihi) {
					$bitis_tarihi = date('Y-m-d', strtotime('+90 days'));
				}
				
				// Başlangıç tarihinden bitiş tarihine kadar tüm günleri kontrol et
				// Sadece seçilen günlerde görev oluştur (daha verimli)
				$current_timestamp = $baslangic_timestamp;
				$bitis_timestamp = strtotime($bitis_tarihi);
				$max_iterations = 365; // Maksimum 1 yıl (güvenlik için)
				$iteration = 0;
				
				while($current_timestamp <= $bitis_timestamp && $iteration < $max_iterations) {
					$current_date = date('Y-m-d', $current_timestamp);
					$current_gun = (int)date('N', $current_timestamp);
					
					// Bu gün tekrar günü mü?
					if(in_array($current_gun, $gunler)) {
						// Bu tarih için görev var mı kontrol et
						$mevcut_gorev = $this->db
							->where('ana_gorev_id', $gorev->is_planlamasi_id)
							->where('planlama_tarihi', $current_date)
							->where('aktif', 1)
							->get('ugajans_is_planlamasi')
							->row();
						
						if(!$mevcut_gorev) {
							// Görev yok, oluştur
							$this->tekrar_gorev_olustur($gorev, $current_date);
						}
					}
					
					// Bir sonraki güne geç
					$current_timestamp = strtotime($current_date . ' +1 day');
					$iteration++;
				}
			} elseif($gorev->tekrar_tipi === 'aylik') {
				// Aylık tekrar - ayın belirli bir günü
				if($gorev->tekrar_ay_gunu) {
					$ay_gunu = (int)$gorev->tekrar_ay_gunu;
					$bugun_gun = (int)date('d');
					
					if($bugun_gun == $ay_gunu) {
						// Bugün ayın belirtilen günü
						$mevcut_gorev = $this->db
							->where('ana_gorev_id', $gorev->is_planlamasi_id)
							->where('planlama_tarihi', $bugun)
							->where('aktif', 1)
							->get('ugajans_is_planlamasi')
							->row();
						
						if(!$mevcut_gorev) {
							$this->tekrar_gorev_olustur($gorev, $bugun);
						}
					}
					
					// Gelecek 3 ay için kontrol et
					for($i = 1; $i <= 3; $i++) {
						$tarih = date('Y-m-d', strtotime("+$i months"));
						$tarih_gun = (int)date('d', strtotime($tarih));
						
						if($tarih_gun == $ay_gunu) {
							if($gorev->tekrar_bitis_tarihi && $tarih > $gorev->tekrar_bitis_tarihi) {
								continue;
							}
							
							$mevcut_gorev = $this->db
								->where('ana_gorev_id', $gorev->is_planlamasi_id)
								->where('planlama_tarihi', $tarih)
								->where('aktif', 1)
								->get('ugajans_is_planlamasi')
								->row();
							
							if(!$mevcut_gorev) {
								$this->tekrar_gorev_olustur($gorev, $tarih);
							}
						}
					}
				}
			} elseif($gorev->tekrar_tipi === 'yillik') {
				// Yıllık tekrar
				if($gorev->tekrar_yil_ay && $gorev->tekrar_yil_gun) {
					$bugun_ay = (int)date('m');
					$bugun_gun = (int)date('d');
					
					if($bugun_ay == $gorev->tekrar_yil_ay && $bugun_gun == $gorev->tekrar_yil_gun) {
						// Bugün yıllık tekrar günü
						$mevcut_gorev = $this->db
							->where('ana_gorev_id', $gorev->is_planlamasi_id)
							->where('planlama_tarihi', $bugun)
							->where('aktif', 1)
							->get('ugajans_is_planlamasi')
							->row();
						
						if(!$mevcut_gorev) {
							$this->tekrar_gorev_olustur($gorev, $bugun);
						}
					}
				}
			}
		}
	}
	
	// Tekrar görev oluştur
	private function tekrar_gorev_olustur($ana_gorev, $tarih)
	{
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		
		$yeni_gorev = array(
			'kullanici_no' => $ana_gorev->kullanici_no,
			'planlama_tarihi' => $tarih,
			'baslangic_saati' => $ana_gorev->baslangic_saati ? $ana_gorev->baslangic_saati : '09:00',
			'bitis_saati' => $ana_gorev->bitis_saati ? $ana_gorev->bitis_saati : '17:00',
			'is_notu' => $ana_gorev->is_notu,
			'oncelik' => $ana_gorev->oncelik ? $ana_gorev->oncelik : 'Normal',
			'planlama_durumu' => 0,
			'aktif' => 1,
			'olusturan_kullanici_no' => $ana_gorev->olusturan_kullanici_no ? $ana_gorev->olusturan_kullanici_no : $ana_gorev->kullanici_no,
			'olusturma_tarihi' => date('Y-m-d H:i:s'),
			'ana_gorev_id' => $ana_gorev->is_planlamasi_id,
			'tekrar_tipi' => 'tek_seferlik' // Tekrar görevleri tek seferlik olarak işaretle
		);
		
		if(in_array('musteri_no', $columns) && isset($ana_gorev->musteri_no) && $ana_gorev->musteri_no) {
			$yeni_gorev['musteri_no'] = $ana_gorev->musteri_no;
		}
		
		if(in_array('yapilacak_is', $columns) && isset($ana_gorev->yapilacak_is) && $ana_gorev->yapilacak_is) {
			$yeni_gorev['yapilacak_is'] = $ana_gorev->yapilacak_is;
		}
		
		// Görevi oluştur
		$insert_result = $this->db->insert('ugajans_is_planlamasi', $yeni_gorev);
		
		// Debug: Görev oluşturuldu mu?
		// if($insert_result) {
		//     error_log("Tekrar görev oluşturuldu - Tarih: $tarih, Ana Görev ID: " . $ana_gorev->is_planlamasi_id);
		// } else {
		//     error_log("Tekrar görev oluşturulamadı - Hata: " . $this->db->error()['message']);
		// }
		
		// Ana görevin son_tekrar_tarihi'ni güncelle
		if(in_array('son_tekrar_tarihi', $columns)) {
			$this->db->where('is_planlamasi_id', $ana_gorev->is_planlamasi_id)
				->update('ugajans_is_planlamasi', array('son_tekrar_tarihi' => $tarih));
		}
	}

	public function potansiyel_musteri()
	{
		$viewData["page"] = "ugajansviews/potansiyel_musteri";
		$this->load->view('ugajansviews/base_view',$viewData);
	}
	
	// AJAX: Potansiyel müşteri kaydet
	public function potansiyel_musteri_kaydet()
	{
		$json = json_decode(file_get_contents('php://input'), true);
		$isletmeler = isset($json['isletmeler']) ? $json['isletmeler'] : [];
		
		if(empty($isletmeler)) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error',
					'message' => 'İşletme bilgisi bulunamadı.'
				]));
			return;
		}
		
		$kaydedilen = 0;
		$aktif_kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');
		
		foreach($isletmeler as $isletme) {
			// Duplicate kontrolü (place_id ile)
			if(!empty($isletme['place_id'])) {
				$existing = $this->db->where('google_place_id', $isletme['place_id'])
					->where('aktif', 1)
					->get('ugajans_potansiyel_musteri')
					->row();
				
				if($existing) {
					continue; // Zaten kayıtlı, atla
				}
			}
			
			// Adres'ten şehir ve ilçe çıkar (basit parsing)
			$adres = isset($isletme['address']) ? $isletme['address'] : '';
			$sehir = isset($isletme['sehir']) ? $isletme['sehir'] : '';
			$ilce = '';
			
			// Adres parsing (basit)
			if($adres && !$sehir) {
				// Türkiye şehirleri listesi (basit kontrol)
				$turk_sehirler = ['Ankara', 'İstanbul', 'İzmir', 'Bursa', 'Antalya', 'Adana', 'Konya', 'Gaziantep', 'Mersin', 'Diyarbakır', 'Kayseri', 'Eskişehir', 'Urfa', 'Malatya', 'Erzurum', 'Van', 'Batman', 'Elazığ', 'Denizli', 'Samsun', 'Kahramanmaraş', 'Mardin', 'Manisa', 'Aydın', 'Tekirdağ', 'Sakarya', 'Balıkesir', 'Trabzon', 'Ordu', 'Afyon', 'Muğla', 'Ağrı', 'Kastamonu', 'Uşak', 'Çorum', 'Isparta', 'Edirne', 'Kırklareli', 'Kırıkkale', 'Yozgat', 'Tokat', 'Nevşehir', 'Kütahya', 'Giresun', 'Sinop', 'Çanakkale', 'Aksaray', 'Bolu', 'Burdur', 'Çankırı', 'Karaman', 'Kırşehir', 'Niğde', 'Osmaniye', 'Rize', 'Yalova', 'Ardahan', 'Bartın', 'Iğdır', 'Karabük', 'Kilis', 'Düzce'];
				
				foreach($turk_sehirler as $turk_sehir) {
					if(stripos($adres, $turk_sehir) !== false) {
						$sehir = $turk_sehir;
						break;
					}
				}
			}
			
			$insertData = [
				'isletme_adi' => isset($isletme['name']) ? $isletme['name'] : '',
				'telefon_numarasi' => isset($isletme['phone']) ? $isletme['phone'] : null,
				'web_sitesi' => isset($isletme['website']) ? $isletme['website'] : null,
				'adres' => $adres,
				'sehir' => $sehir,
				'ilce' => $ilce,
				'is_kolu' => isset($isletme['is_kolu']) ? $isletme['is_kolu'] : null,
				'rating' => isset($isletme['rating']) && is_numeric($isletme['rating']) ? $isletme['rating'] : null,
				'user_ratings_total' => isset($isletme['user_ratings_total']) ? intval($isletme['user_ratings_total']) : 0,
				'google_place_id' => isset($isletme['place_id']) ? $isletme['place_id'] : null,
				'google_maps_url' => isset($isletme['maps_url']) ? $isletme['maps_url'] : null,
				'durum' => 'yeni',
				'olusturan_kullanici_id' => $aktif_kullanici_id,
				'olusturma_tarihi' => date('Y-m-d H:i:s'),
				'aktif' => 1
			];
			
			$this->db->insert('ugajans_potansiyel_musteri', $insertData);
			$kaydedilen++;
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'success',
				'message' => $kaydedilen . ' işletme başarıyla kaydedildi.',
				'kaydedilen' => $kaydedilen
			], JSON_UNESCAPED_UNICODE));
	}
	
	// AJAX: Potansiyel müşteri listesi
	public function potansiyel_musteri_liste()
	{
		$musteriler = $this->db->select('*')
			->from('ugajans_potansiyel_musteri')
			->where('aktif', 1)
			->order_by('olusturma_tarihi', 'DESC')
			->limit(100) // Son 100 kayıt
			->get()
			->result();
		
		$formatted = [];
		foreach($musteriler as $musteri) {
			$formatted[] = [
				'potansiyel_musteri_id' => $musteri->potansiyel_musteri_id,
				'isletme_adi' => $musteri->isletme_adi,
				'telefon_numarasi' => $musteri->telefon_numarasi,
				'adres' => $musteri->adres,
				'is_kolu' => $musteri->is_kolu,
				'durum' => $musteri->durum,
				'olusturma_tarihi' => date('d.m.Y H:i', strtotime($musteri->olusturma_tarihi))
			];
		}
		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'success',
				'musteriler' => $formatted
			], JSON_UNESCAPED_UNICODE));
	}

	public function is_planlamasi_ekle()
	{
		// Tabloda hangi alanların olduğunu kontrol et
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_musteri_no = in_array('musteri_no', $columns);
		$has_yapilacak_is = in_array('yapilacak_is', $columns);
		$has_baslangic_saati = in_array('baslangic_saati', $columns);
		$has_bitis_saati = in_array('bitis_saati', $columns);
		$has_oncelik = in_array('oncelik', $columns);
		
		$kullanici_no = $this->input->post("kullanici_no");
		
		// Explicit validation: check if value exists and is not empty string
		// Use isset() check - CodeIgniter input->post() returns FALSE if key doesn't exist
		// Then check if it's not an empty string
		// This ensures person_id "1" is properly handled (empty("1") returns false, so it passes)
		if ($kullanici_no === false || $kullanici_no === '' || $kullanici_no === null) {
			$this->session->set_flashdata('flashDanger', "Personel seçimi zorunludur.");
			redirect(base_url("ugajans_ekip"));
			return;
		}
		
		// Convert to integer and validate it's a positive number
		// intval() will convert "1" to 1, "0" to 0, etc.
		$kullanici_no_int = intval($kullanici_no);
		
		// Validate: must be a positive integer (greater than 0)
		// This ensures we have a valid user ID
		if ($kullanici_no_int <= 0) {
			$this->session->set_flashdata('flashDanger', "Geçersiz personel seçimi.");
			redirect(base_url("ugajans_ekip"));
			return;
		}
		
		$insertData["kullanici_no"] = $kullanici_no_int;
		$insertData["planlama_tarihi"] = $this->input->post("planlama_tarihi");
		$insertData["is_notu"] = $this->input->post("is_notu");
		
		if($has_musteri_no) {
			$insertData["musteri_no"] = $this->input->post("musteri_no") ? $this->input->post("musteri_no") : null;
		}
		
		if($has_yapilacak_is) {
			$insertData["yapilacak_is"] = $this->input->post("yapilacak_is") ? $this->input->post("yapilacak_is") : null;
		}
		
		if($has_baslangic_saati) {
			$insertData["baslangic_saati"] = $this->input->post("baslangic_saati") ? $this->input->post("baslangic_saati") : '09:00';
		}
		
		if($has_bitis_saati) {
			$insertData["bitis_saati"] = $this->input->post("bitis_saati") ? $this->input->post("bitis_saati") : '17:00';
		}
		
		if($has_oncelik) {
			$insertData["oncelik"] = $this->input->post("oncelik") ? $this->input->post("oncelik") : 'normal';
		}
		
		// Tekrarlama (Recurrence) alanları
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_tekrar_tipi = in_array('tekrar_tipi', $columns);
		
		if($has_tekrar_tipi) {
			$tekrar_tipi = $this->input->post("tekrar_tipi") ? $this->input->post("tekrar_tipi") : 'tek_seferlik';
			$insertData["tekrar_tipi"] = $tekrar_tipi;
			
			if($tekrar_tipi === 'haftalik') {
				// Haftalık tekrar - günleri virgülle ayrılmış string olarak kaydet
				$tekrar_gunleri = $this->input->post("tekrar_gunleri");
				if($tekrar_gunleri) {
					$insertData["tekrar_gunleri"] = is_array($tekrar_gunleri) ? implode(',', $tekrar_gunleri) : $tekrar_gunleri;
				}
			} elseif($tekrar_tipi === 'aylik') {
				// Aylık tekrar - Basitleştirilmiş (sadece ayın günü)
				$insertData["tekrar_ay_gunu"] = $this->input->post("tekrar_ay_gunu") ? (int)$this->input->post("tekrar_ay_gunu") : null;
			} elseif($tekrar_tipi === 'yillik') {
				// Yıllık tekrar
				$insertData["tekrar_yil_ay"] = $this->input->post("tekrar_yil_ay") ? (int)$this->input->post("tekrar_yil_ay") : null;
				$insertData["tekrar_yil_gun"] = $this->input->post("tekrar_yil_gun") ? (int)$this->input->post("tekrar_yil_gun") : null;
			}
			
			// Tekrarlama tarih aralığı - Basitleştirilmiş
			$insertData["tekrar_baslangic_tarihi"] = $this->input->post("planlama_tarihi") ? $this->input->post("planlama_tarihi") : null;
			$insertData["tekrar_bitis_tarihi"] = $this->input->post("tekrar_bitis_tarihi") ? $this->input->post("tekrar_bitis_tarihi") : null;
			$insertData["tekrar_sayisi"] = null; // Basitleştirildi - sadece bitiş tarihi kullanılıyor
			
			// Ana görev ID - ilk oluşturulan görev için kendi ID'si olacak
			// (Insert'ten sonra güncellenecek)
		}
		
		$insertData["planlama_durumu"] = 0;
		$insertData["olusturan_kullanici_no"] = $this->session->userdata('ugajans_aktif_kullanici_id');
		$insertData["olusturma_tarihi"] = date('Y-m-d H:i:s');
		
		// Check for conflicts before inserting
		$conflicts = $this->check_time_conflicts(
			$insertData["kullanici_no"],
			$insertData["planlama_tarihi"],
			$has_baslangic_saati ? $insertData["baslangic_saati"] : '09:00',
			$has_bitis_saati ? $insertData["bitis_saati"] : '17:00'
		);
		
		if ($conflicts['has_conflict']) {
			$this->session->set_flashdata('flashDanger', $conflicts['message']);
			redirect(base_url("ugajans_ekip"));
			return;
		}
		
		$this->db->insert("ugajans_is_planlamasi", $insertData);
		$inserted_id = $this->db->insert_id();
		
		// Eğer tekrarlama varsa, ana_gorev_id'yi güncelle (kendi ID'sini ana görev ID olarak kaydet)
		if($has_tekrar_tipi && isset($insertData["tekrar_tipi"]) && $insertData["tekrar_tipi"] !== 'tek_seferlik') {
			$this->db->where("is_planlamasi_id", $inserted_id)
				->update("ugajans_is_planlamasi", ["ana_gorev_id" => $inserted_id]);
			
			// Hemen tekrarlanan görevleri oluştur
			$this->olustur_tekrarlanan_gorevler();
		}
		
		// Öncelik "yüksek" veya "acil" ise SMS gönder
		if($has_oncelik && isset($insertData["oncelik"])) {
			$oncelik_lower = strtolower(trim($insertData["oncelik"]));
			if($oncelik_lower === 'yüksek' || $oncelik_lower === 'yuksek' || $oncelik_lower === 'high') {
				$this->send_priority_sms($kullanici_no_int, $insertData, 'yüksek');
			} elseif($oncelik_lower === 'acil' || $oncelik_lower === 'urgent') {
				$this->send_priority_sms($kullanici_no_int, $insertData, 'acil');
			}
		}
		
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla eklendi.");
		redirect(base_url("ugajans_ekip"));
	}

	public function is_planlamasi_guncelle($is_planlamasi_id)
	{
		// Tabloda hangi alanların olduğunu kontrol et
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_musteri_no = in_array('musteri_no', $columns);
		$has_yapilacak_is = in_array('yapilacak_is', $columns);
		$has_baslangic_saati = in_array('baslangic_saati', $columns);
		$has_bitis_saati = in_array('bitis_saati', $columns);
		$has_oncelik = in_array('oncelik', $columns);
		
		$kullanici_no = $this->input->post("kullanici_no");
		
		// Explicit validation: check if value exists and is not empty string
		// Use isset() check - CodeIgniter input->post() returns FALSE if key doesn't exist
		// Then check if it's not an empty string
		// This ensures person_id "1" is properly handled (empty("1") returns false, so it passes)
		if ($kullanici_no === false || $kullanici_no === '' || $kullanici_no === null) {
			$this->session->set_flashdata('flashDanger', "Personel seçimi zorunludur.");
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		// Convert to integer and validate it's a positive number
		// intval() will convert "1" to 1, "0" to 0, etc.
		$kullanici_no_int = intval($kullanici_no);
		
		// Validate: must be a positive integer (greater than 0)
		// This ensures we have a valid user ID
		if ($kullanici_no_int <= 0) {
			$this->session->set_flashdata('flashDanger', "Geçersiz personel seçimi.");
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		$updateData["planlama_tarihi"] = $this->input->post("planlama_tarihi");
		$updateData["is_notu"] = $this->input->post("is_notu");
		$updateData["kullanici_no"] = $kullanici_no_int;
		
		if($has_musteri_no) {
			$updateData["musteri_no"] = $this->input->post("musteri_no") ? $this->input->post("musteri_no") : null;
		}
		
		if($has_yapilacak_is) {
			$updateData["yapilacak_is"] = $this->input->post("yapilacak_is") ? $this->input->post("yapilacak_is") : null;
		}
		
		if($has_baslangic_saati) {
			$updateData["baslangic_saati"] = $this->input->post("baslangic_saati") ? $this->input->post("baslangic_saati") : '09:00';
		}
		
		if($has_bitis_saati) {
			$updateData["bitis_saati"] = $this->input->post("bitis_saati") ? $this->input->post("bitis_saati") : '17:00';
		}
		
		if($has_oncelik) {
			$oncelik_post = $this->input->post("oncelik");
			// Eğer post edilen değer varsa ve boş değilse kullan
			if ($oncelik_post !== false && $oncelik_post !== null && $oncelik_post !== '') {
				$updateData["oncelik"] = trim($oncelik_post);
			}
		}
		
		// Tekrarlama (Recurrence) alanları - Güncelleme
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_tekrar_tipi = in_array('tekrar_tipi', $columns);
		
		if($has_tekrar_tipi) {
			$tekrar_tipi = $this->input->post("tekrar_tipi") ? $this->input->post("tekrar_tipi") : 'tek_seferlik';
			$updateData["tekrar_tipi"] = $tekrar_tipi;
			
			if($tekrar_tipi === 'haftalik') {
				$tekrar_gunleri = $this->input->post("tekrar_gunleri");
				if($tekrar_gunleri) {
					$updateData["tekrar_gunleri"] = is_array($tekrar_gunleri) ? implode(',', $tekrar_gunleri) : $tekrar_gunleri;
				}
				// Aylık ve yıllık alanlarını temizle
				$updateData["tekrar_ay_gunu"] = null;
				$updateData["tekrar_yil_ay"] = null;
				$updateData["tekrar_yil_gun"] = null;
			} elseif($tekrar_tipi === 'aylik') {
				// Aylık tekrar - Basitleştirilmiş (sadece ayın günü)
				$updateData["tekrar_ay_gunu"] = $this->input->post("tekrar_ay_gunu") ? (int)$this->input->post("tekrar_ay_gunu") : null;
				// Haftalık ve yıllık alanlarını temizle
				$updateData["tekrar_gunleri"] = null;
				$updateData["tekrar_yil_ay"] = null;
				$updateData["tekrar_yil_gun"] = null;
			} elseif($tekrar_tipi === 'yillik') {
				$updateData["tekrar_yil_ay"] = $this->input->post("tekrar_yil_ay") ? (int)$this->input->post("tekrar_yil_ay") : null;
				$updateData["tekrar_yil_gun"] = $this->input->post("tekrar_yil_gun") ? (int)$this->input->post("tekrar_yil_gun") : null;
				// Haftalık ve aylık alanlarını temizle
				$updateData["tekrar_gunleri"] = null;
				$updateData["tekrar_ay_gunu"] = null;
			} else {
				// Tek seferlik - tüm tekrar alanlarını temizle
				$updateData["tekrar_gunleri"] = null;
				$updateData["tekrar_ay_gunu"] = null;
				$updateData["tekrar_yil_ay"] = null;
				$updateData["tekrar_yil_gun"] = null;
				$updateData["tekrar_baslangic_tarihi"] = null;
				$updateData["tekrar_bitis_tarihi"] = null;
			}
			
			// Tekrarlama tarih aralığı - Basitleştirilmiş
			if($tekrar_tipi !== 'tek_seferlik') {
				$updateData["tekrar_baslangic_tarihi"] = $this->input->post("planlama_tarihi") ? $this->input->post("planlama_tarihi") : null;
				$updateData["tekrar_bitis_tarihi"] = $this->input->post("tekrar_bitis_tarihi") ? $this->input->post("tekrar_bitis_tarihi") : null;
				$updateData["tekrar_sayisi"] = null; // Basitleştirildi
			}
		}
		
		$updateData["planlama_durumu"] = $this->input->post("planlama_durumu");
		$updateData["guncelleme_tarihi"] = date('Y-m-d H:i:s');
		
		// Check for conflicts before updating
		$conflicts = $this->check_time_conflicts(
			$updateData["kullanici_no"],
			$updateData["planlama_tarihi"],
			$has_baslangic_saati ? $updateData["baslangic_saati"] : '09:00',
			$has_bitis_saati ? $updateData["bitis_saati"] : '17:00',
			$is_planlamasi_id
		);
		
		if ($conflicts['has_conflict']) {
			$this->session->set_flashdata('flashDanger', $conflicts['message']);
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		// Öncelik değiştiyse ve "yüksek" veya "acil" ise SMS gönder
		if($has_oncelik && isset($updateData["oncelik"])) {
			$oncelik_lower = strtolower(trim($updateData["oncelik"]));
			if($oncelik_lower === 'yüksek' || $oncelik_lower === 'yuksek' || $oncelik_lower === 'high') {
				// Eski kaydı kontrol et
				$old_event = $this->db->where("is_planlamasi_id", $is_planlamasi_id)->get("ugajans_is_planlamasi")->row();
				if($old_event) {
					$old_oncelik = isset($old_event->oncelik) ? strtolower(trim($old_event->oncelik)) : '';
					// Öncelik değiştiyse veya yeni yüksek öncelikli ise SMS gönder
					if($old_oncelik !== $oncelik_lower) {
						$this->send_priority_sms($kullanici_no_int, $updateData, 'yüksek');
					}
				}
			} elseif($oncelik_lower === 'acil' || $oncelik_lower === 'urgent') {
				// Eski kaydı kontrol et
				$old_event = $this->db->where("is_planlamasi_id", $is_planlamasi_id)->get("ugajans_is_planlamasi")->row();
				if($old_event) {
					$old_oncelik = isset($old_event->oncelik) ? strtolower(trim($old_event->oncelik)) : '';
					// Öncelik değiştiyse veya yeni acil öncelikli ise SMS gönder
					if($old_oncelik !== $oncelik_lower) {
						$this->send_priority_sms($kullanici_no_int, $updateData, 'acil');
					}
				}
			}
		}
		
		$this->db->where("is_planlamasi_id", $is_planlamasi_id)->update("ugajans_is_planlamasi", $updateData);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla güncellendi.");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function is_planlamasi_sil($is_planlamasi_id)
	{
		$this->db->where("is_planlamasi_id", $is_planlamasi_id)->update("ugajans_is_planlamasi", ["aktif" => 0]);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla silindi.");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function is_planlamasi_tamamla($is_planlamasi_id)
	{
		$this->db->where("is_planlamasi_id", $is_planlamasi_id)->update("ugajans_is_planlamasi", ["aktif" => 2]);
		$this->session->set_flashdata('flashSuccess', "İş planlaması tamamlandı olarak işaretlendi.");
		redirect($_SERVER['HTTP_REFERER']);
	}

	// Öncelikli iş planlaması için SMS gönderme
	private function send_priority_sms($kullanici_no, $plan_data, $oncelik_tipi = 'yüksek')
	{
		try {
			// Kullanıcı bilgilerini al
			$kullanici = $this->db->where("ugajans_kullanici_id", $kullanici_no)->get("ugajans_kullanicilar")->row();
			
			if(!$kullanici) {
				log_message('error', 'SMS gönderilemedi: Kullanıcı bulunamadı (ID: ' . $kullanici_no . ')');
				return;
			}
			
			// Telefon numarasını kontrol et
			$columns = $this->db->list_fields('ugajans_kullanicilar');
			$telefon_no = null;
			
			// Önce telefon_numarasi alanını kontrol et
			if(in_array('telefon_numarasi', $columns) && isset($kullanici->telefon_numarasi) && !empty($kullanici->telefon_numarasi)) {
				$telefon_no = $kullanici->telefon_numarasi;
			}
			// Sonra ugajans_kullanici_telefon alanını kontrol et
			elseif(in_array('ugajans_kullanici_telefon', $columns) && isset($kullanici->ugajans_kullanici_telefon) && !empty($kullanici->ugajans_kullanici_telefon)) {
				$telefon_no = $kullanici->ugajans_kullanici_telefon;
			}
			
			if(!$telefon_no || empty(trim($telefon_no))) {
				log_message('error', 'SMS gönderilemedi: Kullanıcının telefon numarası yok (ID: ' . $kullanici_no . ')');
				return;
			}
			
			// Telefon numarasını temizle (sadece rakamlar)
			$telefon_no_temiz = preg_replace('/[^0-9]/', '', $telefon_no);
			
			// Telefon numarası format kontrolü (10 veya 11 haneli olmalı)
			if (strlen($telefon_no_temiz) >= 10) {
				// 0 ile başlıyorsa kaldır, 90 ile başlamıyorsa ekle
				if (substr($telefon_no_temiz, 0, 1) == '0') {
					$telefon_no_temiz = substr($telefon_no_temiz, 1);
				}
				if (substr($telefon_no_temiz, 0, 2) != '90') {
					$telefon_no_temiz = '90' . $telefon_no_temiz;
				}
			} else {
				log_message('error', 'SMS gönderilemedi: Geçersiz telefon numarası formatı (ID: ' . $kullanici_no . ', Numara: ' . $telefon_no . ')');
				return;
			}
			
			// SMS mesajı hazırla
			$tarih = isset($plan_data["planlama_tarihi"]) ? date("d.m.Y", strtotime($plan_data["planlama_tarihi"])) : date("d.m.Y");
			$baslangic = isset($plan_data["baslangic_saati"]) ? $plan_data["baslangic_saati"] : '09:00';
			$bitis = isset($plan_data["bitis_saati"]) ? $plan_data["bitis_saati"] : '17:00';
			$is_notu = isset($plan_data["is_notu"]) && !empty($plan_data["is_notu"]) ? $plan_data["is_notu"] : 'İş planlaması';
			
			// Öncelik tipine göre mesaj oluştur
			if($oncelik_tipi === 'acil') {
				$sms_mesaji = "ACİL GÖREV EKLENİLMİŞTİR\n";
				$sms_mesaji .= "Sn. " . (isset($kullanici->ugajans_kullanici_ad_soyad) ? $kullanici->ugajans_kullanici_ad_soyad : 'Kullanıcı') . ",\n";
				$sms_mesaji .= "Tarih: " . $tarih . "\n";
				$sms_mesaji .= "Saat: " . $baslangic . " - " . $bitis . "\n";
				$sms_mesaji .= "İş: " . mb_substr($is_notu, 0, 100) . (mb_strlen($is_notu) > 100 ? '...' : '');
			} else {
				// Yüksek öncelik için eski mesaj formatı
				$sms_mesaji = "YÜKSEK ÖNCELİKLİ İŞ PLANLAMASI\n";
				$sms_mesaji .= "Sn. " . (isset($kullanici->ugajans_kullanici_ad_soyad) ? $kullanici->ugajans_kullanici_ad_soyad : 'Kullanıcı') . ",\n";
				$sms_mesaji .= "Tarih: " . $tarih . "\n";
				$sms_mesaji .= "Saat: " . $baslangic . " - " . $bitis . "\n";
				$sms_mesaji .= "İş: " . mb_substr($is_notu, 0, 100) . (mb_strlen($is_notu) > 100 ? '...' : '');
			}
			
			// SMS gönder
			sendSmsData($telefon_no_temiz, $sms_mesaji);
			
		} catch (Exception $e) {
			log_message('error', 'Öncelikli iş planlaması SMS gönderme hatası (Kullanıcı ID: ' . $kullanici_no . ', Öncelik: ' . $oncelik_tipi . '): ' . $e->getMessage());
		}
	}

	// AJAX: Event position update (drag and drop)
	public function ajax_event_move()
	{
		// AJAX kontrolünü kaldır - fetch API ile gelen isteklerde sorun çıkabiliyor
		// if (!$this->input->is_ajax_request()) {
		// 	show_404();
		// }

		// Aktif kullanıcı ID'sini al
		$aktif_kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');
		
		$event_id = $this->input->post('event_id');
		$person_id = $this->input->post('person_id');
		$date = $this->input->post('date');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');

		// Validate parameters - check for null/empty explicitly
		// This ensures person_id "1" is not treated as empty
		if ($event_id === null || $event_id === '' || 
		    $person_id === null || $person_id === '' || 
		    $date === null || $date === '') {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error', 
					'message' => 'Eksik parametreler: event_id=' . $event_id . ', person_id=' . $person_id . ', date=' . $date
				]));
			return;
		}
		
		// Saat formatını normalize et (eğer gönderilmişse)
		if ($start_time && strlen($start_time) > 5) {
			$start_time = substr($start_time, 0, 5);
		}
		if ($end_time && strlen($end_time) > 5) {
			$end_time = substr($end_time, 0, 5);
		}

		// Convert to integers after validation
		$event_id = intval($event_id);
		$person_id = intval($person_id);
		
		// Additional validation: ensure IDs are positive integers
		if ($event_id <= 0 || $person_id <= 0) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error', 
					'message' => 'Geçersiz ID değerleri: event_id=' . $event_id . ', person_id=' . $person_id
				]));
			return;
		}

		// Verify event exists
		$event = $this->db->where("is_planlamasi_id", $event_id)->get("ugajans_is_planlamasi")->row();
		if (!$event) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Etkinlik bulunamadı']));
			return;
		}
		
		// Yetki kontrolü: Kullanıcı ID 1 veya 2 değilse, sadece kendi event'lerini düzenleyebilir
		if ($aktif_kullanici_id != 1 && $aktif_kullanici_id != 2) {
			if ($event->kullanici_no != $aktif_kullanici_id) {
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(['status' => 'error', 'message' => 'Bu görevi düzenleme yetkiniz yok']));
				return;
			}
			// Normal kullanıcılar sadece kendi event'lerini başka kullanıcılara taşıyamaz
			if ($person_id != $aktif_kullanici_id) {
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(['status' => 'error', 'message' => 'Görevi başka kullanıcıya atama yetkiniz yok']));
				return;
			}
		}

		// Get event's time fields for conflict check
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_time_fields = in_array('baslangic_saati', $columns) && in_array('bitis_saati', $columns);
		
		// Eğer yeni saat bilgisi gönderilmişse onu kullan, yoksa mevcut saatleri kullan
		$check_start_time = $start_time ? $start_time : (isset($event->baslangic_saati) ? $event->baslangic_saati : null);
		$check_end_time = $end_time ? $end_time : (isset($event->bitis_saati) ? $event->bitis_saati : null);

		// Check for conflicts using time-based check if times are available
		if ($check_start_time && $check_end_time && $has_time_fields) {
			$conflicts = $this->check_time_conflicts($person_id, $date, $check_start_time, $check_end_time, $event_id);
		} else {
			// Fallback to event-based check if no time fields
			$conflicts = $this->check_event_conflicts($person_id, $date, $event_id);
		}
		
		if ($conflicts['has_conflict']) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error',
					'message' => $conflicts['message']
				]));
			return;
		}

		// Update event
		$updateData = [
			'kullanici_no' => $person_id,
			'planlama_tarihi' => $date,
			'guncelleme_tarihi' => date('Y-m-d H:i:s')
		];
		
		// Eğer saat bilgisi gönderilmişse, onu da ekle
		if ($has_time_fields) {
			if ($start_time) {
				$updateData['baslangic_saati'] = $start_time;
			}
			if ($end_time) {
				$updateData['bitis_saati'] = $end_time;
			}
		}

		// Önce mevcut kaydı kontrol et
		$currentEvent = $this->db->where("is_planlamasi_id", $event_id)->get("ugajans_is_planlamasi")->row();
		if (!$currentEvent) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Event bulunamadı']));
			return;
		}
		
		// Eğer tüm değerler aynıysa, güncelleme yapmaya gerek yok
		$isSame = ($currentEvent->kullanici_no == $person_id && $currentEvent->planlama_tarihi == $date);
		if ($has_time_fields) {
			$currentStart = isset($currentEvent->baslangic_saati) ? substr($currentEvent->baslangic_saati, 0, 5) : '';
			$currentEnd = isset($currentEvent->bitis_saati) ? substr($currentEvent->bitis_saati, 0, 5) : '';
			$isSame = $isSame && 
			          (!$start_time || $currentStart == $start_time) && 
			          (!$end_time || $currentEnd == $end_time);
		}
		
		if ($isSame) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'success', 'message' => 'Görev zaten bu konumda']));
			return;
		}

		$this->db->where("is_planlamasi_id", $event_id)->update("ugajans_is_planlamasi", $updateData);

		// Veritabanı hatası kontrolü
		if ($this->db->error()['code'] != 0) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error', 
					'message' => 'Veritabanı hatası: ' . $this->db->error()['message']
				]));
			return;
		}

		// Güncelleme başarılı (affected_rows 0 olsa bile, eğer değerler aynıysa bu normal)
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['status' => 'success', 'message' => 'Görev başarıyla taşındı']));
	}

	// AJAX: Get events for calendar refresh
	public function ajax_get_events()
	{
		// AJAX kontrolünü kaldır - fetch API ile gelen isteklerde sorun çıkabiliyor
		// if (!$this->input->is_ajax_request()) {
		// 	show_404();
		// }

		// Aktif kullanıcı ID'sini al
		$aktif_kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');

		// Tarih aralığı parametrelerini al (optimizasyon için)
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		// Tarih filtresi oluştur
		$where = [];
		if ($start_date && $end_date) {
			// Tarih aralığı filtresi ekle
			$where['planlama_tarihi >='] = $start_date;
			$where['planlama_tarihi <='] = $end_date;
		}
		
		// Kullanıcı ID 1 veya 2 değilse, sadece kendi event'lerini göster
		if ($aktif_kullanici_id != 1 && $aktif_kullanici_id != 2) {
			$where['ip.kullanici_no'] = $aktif_kullanici_id;
		}
		
		// Eğer where boşsa null yap (get_is_planlamasi fonksiyonu null bekliyor)
		if (empty($where)) {
			$where = null;
		}

		$events = get_is_planlamasi($where);
		
		// Format events for JavaScript
		$formattedEvents = [];
		foreach ($events as $event) {
			// Öncelik değerini normalize et (veritabanından gelen değeri olduğu gibi gönder)
			$oncelik = isset($event->oncelik) ? trim($event->oncelik) : 'Normal';
			if (empty($oncelik)) {
				$oncelik = 'Normal';
			}
			
			// Müşteri no - null kontrolü yap ama 0 değerini de kabul et
			$musteri_no = null;
			if (isset($event->musteri_no)) {
				$musteri_no_val = $event->musteri_no;
				// 0, null, boş string kontrolü
				if ($musteri_no_val !== null && $musteri_no_val !== '' && $musteri_no_val !== '0') {
					$musteri_no = (int)$musteri_no_val;
				}
			}
			
			// Müşteri adını al
			$musteri_adi = '';
			if (isset($event->musteri_ad_soyad) && !empty($event->musteri_ad_soyad)) {
				$musteri_adi = $event->musteri_ad_soyad;
			}
			
			$formattedEvents[] = [
				'is_planlamasi_id' => $event->is_planlamasi_id,
				'kullanici_no' => $event->kullanici_no,
				'planlama_tarihi' => $event->planlama_tarihi,
				'baslangic_saati' => isset($event->baslangic_saati) && !empty($event->baslangic_saati) ? $event->baslangic_saati : '09:00',
				'bitis_saati' => isset($event->bitis_saati) && !empty($event->bitis_saati) ? $event->bitis_saati : '17:00',
				'oncelik' => $oncelik,
				'planlama_durumu' => $event->planlama_durumu,
				'aktif' => isset($event->aktif) ? (int)$event->aktif : 1,
				'is_notu' => isset($event->is_notu) ? $event->is_notu : '',
				'yapilacak_is' => isset($event->yapilacak_is) ? $event->yapilacak_is : '',
				'musteri_no' => $musteri_no,
				'musteri_ad_soyad' => $musteri_adi
			];
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'success',
				'events' => $formattedEvents
			], JSON_UNESCAPED_UNICODE));
	}

	// AJAX: Event resize (time change)
	public function ajax_event_resize()
	{
		// AJAX kontrolünü kaldır - fetch API ile gelen isteklerde sorun çıkabiliyor
		// if (!$this->input->is_ajax_request()) {
		// 	show_404();
		// }

		$event_id = $this->input->post('event_id');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');

		if (empty($event_id) || empty($start_time) || empty($end_time)) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Eksik parametreler']));
			return;
		}
		
		// Saat formatını normalize et (HH:mm:ss -> HH:mm)
		if (strlen($start_time) > 5) {
			$start_time = substr($start_time, 0, 5);
		}
		if (strlen($end_time) > 5) {
			$end_time = substr($end_time, 0, 5);
		}

		// Aktif kullanıcı ID'sini al
		$aktif_kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');
		
		// Get current event to check conflicts
		$event = $this->db->where("is_planlamasi_id", $event_id)->get("ugajans_is_planlamasi")->row();
		if (!$event) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Etkinlik bulunamadı']));
			return;
		}
		
		// Yetki kontrolü: Kullanıcı ID 1 veya 2 değilse, sadece kendi event'lerini düzenleyebilir
		if ($aktif_kullanici_id != 1 && $aktif_kullanici_id != 2) {
			if ($event->kullanici_no != $aktif_kullanici_id) {
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(['status' => 'error', 'message' => 'Bu görevi düzenleme yetkiniz yok']));
				return;
			}
		}

		// Check for conflicts with new time
		$conflicts = $this->check_time_conflicts($event->kullanici_no, $event->planlama_tarihi, $start_time, $end_time, $event_id);
		if ($conflicts['has_conflict']) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error',
					'message' => $conflicts['message']
				]));
			return;
		}

		// Check if baslangic_saati and bitis_saati columns exist
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$updateData = [];

		if (in_array('baslangic_saati', $columns)) {
			$updateData['baslangic_saati'] = $start_time;
		}
		if (in_array('bitis_saati', $columns)) {
			$updateData['bitis_saati'] = $end_time;
		}

		if (!empty($updateData)) {
			// Güncelleme tarihini ekle
			$updateData['guncelleme_tarihi'] = date('Y-m-d H:i:s');
			
			$this->db->where("is_planlamasi_id", $event_id)->update("ugajans_is_planlamasi", $updateData);
			
			// Veritabanı hatası kontrolü
			if ($this->db->error()['code'] != 0) {
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode([
						'status' => 'error', 
						'message' => 'Veritabanı hatası: ' . $this->db->error()['message']
					]));
				return;
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['status' => 'success', 'message' => 'Güncelleme başarılı']));
	}

	// AJAX: Check for conflicts
	public function ajax_check_conflict()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$person_id = $this->input->post('person_id');
		$date = $this->input->post('date');
		$exclude_event_id = $this->input->post('exclude_event_id');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');

		// If time fields are provided, use time-based conflict check
		if ($start_time && $end_time) {
			$conflicts = $this->check_time_conflicts($person_id, $date, $start_time, $end_time, $exclude_event_id);
		} else {
			// Otherwise use event-based check
			$conflicts = $this->check_event_conflicts($person_id, $date, $exclude_event_id);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($conflicts));
	}

	// Helper: Check for event conflicts
	private function check_event_conflicts($person_id, $date, $exclude_event_id = null, $check_start_time = null, $check_end_time = null)
	{
		$this->db->select('*');
		$this->db->from('ugajans_is_planlamasi');
		$this->db->where('kullanici_no', $person_id);
		$this->db->where('planlama_tarihi', $date);
		$this->db->where('aktif', 1);

		if ($exclude_event_id) {
			$this->db->where('is_planlamasi_id !=', $exclude_event_id);
		}

		$events = $this->db->get()->result();

		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_time_fields = in_array('baslangic_saati', $columns) && in_array('bitis_saati', $columns);

		// If time fields are provided, check for time overlaps
		if ($has_time_fields && $check_start_time && $check_end_time) {
			$newStart = strtotime($check_start_time);
			$newEnd = strtotime($check_end_time);

			foreach ($events as $event) {
				if ($event->baslangic_saati && $event->bitis_saati) {
					$eventStart = strtotime($event->baslangic_saati);
					$eventEnd = strtotime($event->bitis_saati);

					// Check for overlap
					if (($newStart < $eventEnd && $newEnd > $eventStart)) {
						return [
							'has_conflict' => true,
							'message' => 'Seçilen zaman dilimi başka bir iş planı ile çakışıyor.'
						];
					}
				}
			}
		}

		// Check workload limit (max 8 hours per day)
		$totalHours = 0;
		foreach ($events as $event) {
			if ($has_time_fields && $event->baslangic_saati && $event->bitis_saati) {
				$start = strtotime($event->baslangic_saati);
				$end = strtotime($event->bitis_saati);
				$hours = ($end - $start) / 3600;
				$totalHours += $hours;
			} else {
				// Default 8 hours if no time specified
				$totalHours += 8;
			}
		}

		// Add the new event's hours if provided
		if ($has_time_fields && $check_start_time && $check_end_time) {
			$newStart = strtotime($check_start_time);
			$newEnd = strtotime($check_end_time);
			$newHours = ($newEnd - $newStart) / 3600;
			$totalHours += $newHours;
		} else if (!$has_time_fields || !$check_start_time || !$check_end_time) {
			// Default 8 hours if no time specified
			$totalHours += 8;
		}

		if ($totalHours > 8) {
			return [
				'has_conflict' => true,
				'message' => 'Bu personel için günlük iş yükü limiti (8 saat) aşıldı.'
			];
		}

		return [
			'has_conflict' => false,
			'message' => ''
		];
	}

	// Helper: Check for time conflicts
	private function check_time_conflicts($person_id, $date, $start_time, $end_time, $exclude_event_id = null)
	{
		$this->db->select('*');
		$this->db->from('ugajans_is_planlamasi');
		$this->db->where('kullanici_no', $person_id);
		$this->db->where('planlama_tarihi', $date);
		$this->db->where('aktif', 1);

		if ($exclude_event_id) {
			$this->db->where('is_planlamasi_id !=', $exclude_event_id);
		}

		$events = $this->db->get()->result();
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_time_fields = in_array('baslangic_saati', $columns) && in_array('bitis_saati', $columns);

		if (!$has_time_fields) {
			return ['has_conflict' => false, 'message' => ''];
		}

		$newStart = strtotime($start_time);
		$newEnd = strtotime($end_time);

		foreach ($events as $event) {
			if ($event->baslangic_saati && $event->bitis_saati) {
				$eventStart = strtotime($event->baslangic_saati);
				$eventEnd = strtotime($event->bitis_saati);

				// Check for overlap
				if (($newStart < $eventEnd && $newEnd > $eventStart)) {
					return [
						'has_conflict' => true,
						'message' => 'Seçilen zaman dilimi başka bir iş planı ile çakışıyor.'
					];
				}
			}
		}

		return ['has_conflict' => false, 'message' => ''];
	}
}

