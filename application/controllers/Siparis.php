<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siparis extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
		$this->load->model('Siparis_model'); 
		$this->load->model('Siparis_urun_model'); 
		$this->load->model('Siparis_onay_hareket_model'); 
		$this->load->model('Urun_model'); 
		$this->load->model('Kullanici_model'); 
		$this->load->model('Kullanici_yetkileri_model'); 
		$this->load->model('Merkez_model');
		$this->load->model('Sehir_model');
        date_default_timezone_set('Europe/Istanbul');
    }
 
	

	public function siparis_urun_degistir($siparis_urun_id,$secilen_urun_id){

		echo "Eski : ".$siparis_urun_id;
		echo "<br>";
		echo "Yeni : ".$secilen_urun_id;
		
	}


	public function gorusme_detay_update($siparis_id){

		if($this->session->userdata("aktif_kullanici_id") == 37 || $this->session->userdata("aktif_kullanici_id") == 8 || $this->session->userdata("aktif_kullanici_id") == 1 || $this->session->userdata("aktif_kullanici_id") == 9){
			
		$this->db->where("siparis_id",$siparis_id)->update("siparisler",["siparis_gorusme_aciklama"=>$this->input->post("siparis_gorusme_aciklama"),"siparis_gorusme_aciklama_guncelleme_tarihi"=>date("Y-m-d H:i")]);
		$this->session->set_flashdata('flashSuccess', "Bu siparişin görüşme / detay / açıklama bilgisi güncellenmiştir.");
		redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
		 
		
	}else{
		$this->session->set_flashdata('flashDanger', "Bu işlem için yetkiniz bulunmamaktadır.");
		redirect(site_url('siparis'));
		
	}
	}

	public function siparis_iptal_et($siparis_id = 0)
	{  if($this->session->userdata("aktif_kullanici_id") == 1 || $this->session->userdata("aktif_kullanici_id") == 9){
		if($siparis_id != 0){
			$siparis = $this->db->where(["siparis_id"=>$siparis_id])->get("siparisler")->result()[0];
			$this->db->where("siparis_id",$siparis_id)->update("siparisler",["siparis_aktif"=>0,"siparis_iptal_nedeni"=>"İbrahim Bircan talebi üzerine ".date("d.m.Y")." tarihinde ".$this->input->post("siparis_iptal_nedeni")." gerekçesiyle iptal edilmiştir."]);
			$this->db->where("siparis_kodu",$siparis_id)->update("siparis_urunleri",["siparis_urun_aktif"=>0]);

			// Sipariş ile ilgili otomatik oluşturulan izin kayıtlarını iptal et
			// İzin notunda sipariş kodu geçen kayıtları bul ve iptal et
			$siparis_kodu = $siparis->siparis_kodu;
			$this->db->where("izin_durumu", 1) // Sadece aktif izinleri iptal et
				->like("izin_notu", "Sipariş: " . $siparis_kodu, "both")
				->update("izin_talepleri", [
					"izin_durumu" => 0
				]);

			//sendSmsData("05382197344","$siparis->siparis_kodu nolu sipariş ve bu siparişe tanımlı ürünler ".$this->input->post("siparis_iptal_nedeni")." gerekçesiyle iptal edilmiştir.".$datastokad);
			sendSmsData("05468311015","$siparis->siparis_kodu nolu sipariş ve bu siparişe tanımlı ürünler ".$this->input->post("siparis_iptal_nedeni")." gerekçesiyle iptal edilmiştir.".$datastokad);
		  

  
			
			$this->session->set_flashdata('flashSuccess', "$siparis->siparis_kodu nolu sipariş ve bu siparişe tanımlı ürünler iptal edilmiştir.");
			redirect("https://ugbusiness.com.tr/tum-siparisler");
			
		}else{
			$this->session->set_flashdata('flashDanger', "Sipariş bulunamadığı için iptal işlemi gerçekleştirilemedi.");
			
			redirect("https://ugbusiness.com.tr/tum-siparisler");
		}
	}else{
		$this->session->set_flashdata('flashDanger', "Bu işlem için yetkiniz bulunmamaktadır.");
			
			redirect("https://ugbusiness.com.tr/tum-siparisler");
	}
	}
	
		
	public function siparis_ayir($siparis_id = 0,$siparis_urun_id = 0)
	{ 
		if($siparis_urun_id != 0 && $siparis_id != 0){

		
		$yeni_siparis = $this->db->where(["siparis_id"=>$siparis_id])->get("siparisler")->result();
		$siparis_data = (array) $yeni_siparis[0];
		unset($siparis_data['siparis_id']);
		$this->db->insert('siparisler', $siparis_data);   
		$yeni_siparis_id = $this->db->insert_id();
		$siparis_kod_format = "SPR".date("dmY").str_pad($yeni_siparis_id, 5, '0', STR_PAD_LEFT);
		$this->db->where('siparis_id', $yeni_siparis_id)->update('siparisler', ["siparis_kodu"=>$siparis_kod_format]);
		

		 $eskihareketler = $this->db->where(["siparis_no"=>$siparis_id])->get("siparis_onay_hareketleri")->result();
		foreach ($eskihareketler as $hareket) {
			$hareket->siparis_no = $yeni_siparis_id;
			$h_data = (array) $hareket;
			unset($h_data['siparis_onay_hareket_id']);
 
			$this->db->insert('siparis_onay_hareketleri', $h_data);    
		}


		$this->db->where('siparis_urun_id', $siparis_urun_id)->update('siparis_urunleri', ["siparis_kodu"=>$yeni_siparis_id]);
		echo "Aktarım İşlemi Başarılı. Bu pencereyi kapatabilirsiniz.";
	}else{
		echo "Yetkisiz Erişim";
	}
	}
	
	public function index($onay_bekleyenler = false)
	{ 
		if(goruntuleme_kontrol("tum_siparisleri_goruntule")){
			
			$data = $this->Siparis_model->get_all(); 
		}else{
		
			$data = $this->Siparis_model->get_all(["siparisi_olusturan_kullanici"=>$this->session->userdata('aktif_kullanici_id')]); 
		}
       
		// Aktif kullanıcının departmanını kontrol et
		$aktif_kullanici = aktif_kullanici();
		$is_yonetim = false;
		if(isset($aktif_kullanici->departman_adi)){
			$departman_adi = strtolower(trim($aktif_kullanici->departman_adi));
			// "Yönetim" veya "Yönetim Departmanı" gibi varyasyonları kontrol et
			if($departman_adi == 'yönetim' || strpos($departman_adi, 'yönetim') !== false){
				$is_yonetim = true;
			}
		}
		$viewData["is_yonetim"] = $is_yonetim;
		
		// Filtreler için veriler
		$viewData["sehirler"] = $this->Sehir_model->get_all();
		// Sadece satıcıları getir (departman_id: 12, 17, 18 veya kullanici_id: 2, 9)
		$viewData["kullanicilar"] = $this->db
			->where("kullanici_aktif", 1)
			->group_start()
				->where_in("kullanici_departman_id", [12, 17, 18])
				->or_where_in("kullanici_id", [2, 9])
			->group_end()
			->order_by("kullanici_ad_soyad", "ASC")
			->get("kullanicilar")
			->result();
		
		// Seçili filtreler
		$viewData["selected_sehir_id"] = $this->input->get('sehir_id');
		$viewData["selected_kullanici_id"] = $this->input->get('kullanici_id');
		$viewData["selected_tarih_baslangic"] = $this->input->get('tarih_baslangic');
		$viewData["selected_tarih_bitis"] = $this->input->get('tarih_bitis');
		$viewData["selected_teslim_durumu"] = $this->input->get('teslim_durumu');
		
		$viewData["siparisler"] = $data;
		$viewData["page"] = "siparis/list";
		$this->load->view('base_view',$viewData);
	}

	public function siparis_onay_hareket_guncelle()
	{
		yetki_kontrol("tum_siparisleri_goruntule");
		if( $this->input->post("kayit_id")){
			$this->db->limit(1)->where('siparis_onay_hareket_id', $this->input->post("kayit_id"))
			->update("siparis_onay_hareketleri",["onay_aciklama"=>$this->input->post("onay_aciklama")] );
		   
		}
        return true;
	}



	public function haftalik_kurulum_plan()
	{
		date_default_timezone_set('Europe/Istanbul');

		
		

		yetki_kontrol("haftalik_kurulum_plan_goruntule");
	
			$weeklyOrders = $this->Siparis_model->get_all(["adim_no >"=>3,"kurulum_tarihi >=" => date('Y-m-d 00:00:00', (!empty($_GET["tarih"])) ? strtotime('monday this week',strtotime($_GET["tarih"])) : strtotime('monday this week'))],["kurulum_tarihi <=" => date('Y-m-d 23:59:59',(!empty($_GET["tarih"])) ? strtotime('sunday this week',strtotime($_GET["tarih"])) : strtotime('sunday this week'))]);

			foreach ($weeklyOrders as $order) {
			$dayOfWeek = date('N', strtotime($order->kurulum_tarihi));  
			$viewData["day{$dayOfWeek}"][] = $order;
			}

			$viewData["page"] = "siparis/haftalik_kurulum_plan";
			$this->load->view('base_view', $viewData);
	}




	public function tamamlanmayan_siparisler()
	{
		yetki_kontrol("tum_siparisleri_goruntule");
		$current_user_id =  $this->session->userdata('aktif_kullanici_id');
		$viewData["onay_bekleyen_siparisler"] = $this->Siparis_model->get_all_waiting([1,2,3,4,5,6,7,8,9,10,11]);
		$viewData["page"] = "siparis/list";

	$islemdekiler_sayi = $this->db->query('SELECT * FROM siparisler where beklemede = 0 and siparisi_olusturan_kullanici != 12 and siparisi_olusturan_kullanici != 1');
	$viewData["islemdekiler_sayi"] = $islemdekiler_sayi->num_rows();

	$bekleyenler_sayi = $this->db->query('SELECT * FROM siparisler where beklemede = 1');
	$viewData["bekleyenler_sayi"] = $bekleyenler_sayi->num_rows();


		
		$this->load->view('base_view',$viewData);
	}



	public function onay_bekleyenler($onay_bekleyenler = false)
	{
		$current_user_id = $this->session->userdata('aktif_kullanici_id');
		
		// Tüm Siparişler tabı için (filter=3) tüm adımları getir
		$tum_siparisler_tabi = ($this->input->get('filter') == '3');
		
		if($tum_siparisler_tabi) {
			// Tüm adımları getir (1-11)
			$filter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
		} else {
			// Kullanıcı yetkilerini çekiyoruz
			$yetkiler = $this->db
				->select("yetki_kodu")
				->get_where("kullanici_yetki_tanimlari", ['kullanici_id' => $current_user_id])
				->result_array();

			// siparis_onay_[N] şeklinde olan yetkilerden N-1 değerlerini filtreye ekle
			$filter = [];
			foreach ($yetkiler as $yetki) {
				if (preg_match('/^siparis_onay_(\d+)$/', $yetki['yetki_kodu'], $matches)) {
					$adimNo = intval($matches[1]);
					if ($adimNo > 1) {
						// Özel durum: Kullanıcı ID 9 için adım 4'teki siparişleri gösterme (siparis_onay_5 yetkisi var ama adım 4'ü göstermesin)
						if($current_user_id == 9 && $adimNo == 5) {
							// Adım 4'ü filtreye ekleme
							continue;
						}
						$filter[] = $adimNo - 1;
					}
				}
			}
		}

		$viewData = [];
		$viewData["onay_bekleyen_siparisler"] = $this->Siparis_model->get_all_waiting($filter);
		$viewData["page"] = "siparis/list";

		$viewData["islemdekiler_sayi"] = $this->db
			->where("beklemede", 0)
			->where_not_in("siparisi_olusturan_kullanici", [12, 1])
			->count_all_results("siparisler");

		$viewData["bekleyenler_sayi"] = $this->db
			->where("beklemede", 1)
			->count_all_results("siparisler");

		$this->load->view('base_view', $viewData);
	}


	

	public function siparise_urun_ekle($siparis_id,$urun_id)
	{   if($this->session->userdata("aktif_kullanici_id") == 1 || $this->session->userdata("aktif_kullanici_id") == 9){
		$siparis_urun_data = [];
		$siparis_urun_data["siparis_kodu"] = $siparis_id;
		$siparis_urun_data["urun_no"] = $urun_id;
		$this->db->insert("siparis_urunleri",$siparis_urun_data);
		$this->session->set_flashdata('flashSuccess', "Seçilen ürün kaydı, ilgili siparişe eklenmiştir. Ürün satış fiyat ve diğer bilgileri güncellemeyi unutmayınız.");
	}else{
		$this->session->set_flashdata('flashDanger', "Bu işlemi sadece yetkili kişiler yapabilir.");
	}

	
		redirect("https://ugbusiness.com.tr/siparis/save_merkez_bilgi_dogrulama_view/$siparis_id");
	}

	public function add($merkez_id)
	{   




		$check_id = $this->Merkez_model->get_by_id($merkez_id); 
        if($check_id){  
            $viewData["page"] = "siparis/form";
			$viewData["urunler"] = $this->Urun_model->get_all(["harici_cihaz"=>0]);
			$viewData["merkez"] = $check_id;
			 


			$viewData["umexlazerfiyat"] = getFiyatListe(1);
			$viewData["umexplusfiyat"] = getFiyatListe(8);
			$viewData["umexslimfiyat"] = getFiyatListe(5);
			$viewData["umexemsfiyat"] = getFiyatListe(3);
			$viewData["umexsfiyat"] = getFiyatListe(6);
			$viewData["umexdiodefiyat"] = getFiyatListe(2);
			$viewData["umexgoldfiyat"] = getFiyatListe(4);
			$viewData["umexqfiyat"] = getFiyatListe(7);
			

$viewData['hediyeler'] = $this->db->get("siparis_hediyeler")->result();








			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url());
        }




		
	}

	public function edit($id = '')
	{  
		$check_id = $this->Siparis_model->get_by_id($id); 
        if($check_id){  
            $viewData['siparis'] = $check_id[0];
			$viewData["page"] = "siparis/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('siparis'));
        }
 
	}


	public function report($id = '',$modal_format = 0)
	{ 	
		$id = urldecode(str_replace("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE","",base64_decode(str_replace("%3D","=",$id))));
		$check_id = $this->Siparis_model->get_by_id($id); 
		//echo json_encode($id);return;
        if($check_id){  

			



			$current_user_id =  $this->session->userdata('aktif_kullanici_id');
			$query = $this->db->select("yetki_kodu")->get_where("kullanici_yetki_tanimlari",array('kullanici_id' => $current_user_id));
			 
			$filter = array();
			for ($i=3; $i < 12  ; $i++) { 
				if(array_search("siparis_onay_".$i, array_column($query->result(), 'yetki_kodu')) !== false){
					$filter[] = $i-1;
				}
			}
			$hareketler =  $this->Siparis_model->get_all_actions_by_order_id($id);
			$ara = $hareketler[count($hareketler)-1]->adim_no+1;
			if(array_search("siparis_onay_".$ara, array_column($query->result(), 'yetki_kodu')) !== false){
				$viewData['onay_durum'] = true;
				
			}else{
				$viewData['onay_durum'] = false;
			}
	 

		
		 
			if(goruntuleme_kontrol("tum_siparisleri_goruntule") == false){
				
				
			
				 	if($viewData['onay_durum'] == false){
						if($check_id[0]->siparisi_olusturan_kullanici != $this->session->userdata('aktif_kullanici_id')){
				 
							redirect(site_url('siparis'));
							
						}
						
					}
					 
				 
	
			}





			
            $viewData['siparis'] = $check_id[0];
			$viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id); 
			$viewData['hareketler'] =  $hareketler;
			if(goruntuleme_kontrol("sadece_sorumlu_fiyat_goruntule")){
				$kdata = $this->Kullanici_model->get_by_id($check_id[0]->siparisi_olusturan_kullanici);  
				if($kdata[0]->kullanici_yonetici_kullanici_id == aktif_kullanici()->kullanici_id){		 
					$viewData['siparis_fiyat_goruntule'] = true;
				}else{
					$viewData['siparis_fiyat_goruntule'] = false;
				}
			
			}else{
				$viewData['siparis_fiyat_goruntule'] = goruntuleme_kontrol("siparis_fiyat_goruntule");
			}
			 
			$viewData['adimlar'] =  $this->Siparis_model->get_all_steps();
			$viewData['kullanicilar'] =  $this->Kullanici_model->get_all();
			$viewData['egitmenler'] =  $this->Kullanici_model->get_egitmen(["kullanici_departman_id"=>15,"kullanici_aktif",1]);
			$viewData['kurulum_kullanicilari'] =  $this->Kullanici_model->get_all(["kurulum_ekip_durumu"=>1]);
			$viewData['basliklar_data'] =  $this->Urun_model->get_basliklar();
			$viewData['guncel_adim'] = $hareketler[count($hareketler)-1]->adim_no+1;
			$viewData['ara_odemeler'] = $this->db->where("siparis_ara_odeme_siparis_no",$id)->get("siparis_ara_odemeler")->result();
			$takas_fotograflari_query = $this->db->where("siparis_id",$id)->get("takas_urun_fotograflari");
			$viewData['takas_fotograflari'] = $takas_fotograflari_query ? $takas_fotograflari_query->result() : [];
			$kurulum_ekip = $this->Kullanici_model->get_all(null,$check_id[0]->kurulum_ekip);
			$viewData['kurulum_ekip'] = $check_id[0]->kurulum_ekip ? $kurulum_ekip : [];
			$egitim_ekip = $this->Kullanici_model->get_all(null,$check_id[0]->egitim_ekip);
			$viewData['egitim_ekip'] = $check_id[0]->egitim_ekip ? $egitim_ekip : [];
 

			$viewData['siparisi_olusturan_kullanici'] =  $this->Kullanici_model->get_by_id($check_id[0]->siparisi_olusturan_kullanici);

			 
			$viewData["page"] = "siparis/report"; 

			if($modal_format == 1){
				$viewData["pageformat"] = "1";
				$this->load->view('base_view_modal',$viewData);
			}else{
				$viewData["pageformat"] = "0";
				$this->load->view('base_view',$viewData);
			}
			 
        }else{
            redirect(site_url('siparis'));
        }
 
	}


    public function delete()
	{     
		 
		//$this->Siparis_model->delete($id);  
        $viewData["page"] = "siparis/list";
		$this->load->view('base_view',$viewData);
	}
	public function degerlendirme_rapor()
	{	
		if(aktif_kullanici()->kullanici_id == 14){
			$viewData["products"] = $this->db->where("musteri_degerlendirme_sms",1)->where("degerlendirme_soru_1",0)->get("siparisler")->result();
			$viewData["page"] = "siparis/degerlendirme_rapor";
			$this->load->view('base_view',$viewData);
		}  else{
			yetki_kontrol("sms_degerlendirme_raporunu_goruntule");
			$viewData["products"] = $this->db->where("musteri_degerlendirme_sms",1)->get("siparisler")->result();
			$viewData["page"] = "siparis/degerlendirme_rapor";
			$this->load->view('base_view',$viewData);
		}
	
	}
	




 	public function siparis_onayla($id)
	{  
			
		



		$hareketler =  $this->Siparis_model->get_all_actions_by_order_id($id);
		$guncel_adim = $hareketler[count($hareketler)-1]->adim_no+1;
		$urunler =  $this->Siparis_model->get_all_products_by_order_id($id);
		$siparis =  $this->Siparis_model->get_by_id($id);
		$currentuser = aktif_kullanici();

		if($guncel_adim == 3){
			
			if($currentuser->kullanici_id != 1 && $currentuser->kullanici_id != $siparis[0]->siparisi_olusturan_kullanici){
				$kullanici_data_siparis = $this->Kullanici_model->get_by_id($siparis[0]->siparisi_olusturan_kullanici); 
				if($kullanici_data_siparis[0]->kullanici_yonetici_kullanici_id != $currentuser->kullanici_id){
					$this->session->set_flashdata('flashDanger', "Bu siparişin satış onayını verme yetkiniz bulunmamaktadır.");
					redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				}
			}
		}

		if($guncel_adim == 4){
			//HARUN KISA - SOSYAL SORUMLULUK İÇİN SMS
			//sendSmsData("05461393309","Sn. Harun Kısa ".date("d.m.Y H:i")." tarihinde satış onayı verilen sipariş bilgileri aşağıda yer almaktadır.\n\nSipariş : ".$siparis[0]->siparis_kodu."\nMüşteri : ".$siparis[0]->musteri_ad."\nMerkez : ".$siparis[0]->merkez_adi."\nAdres : ".$siparis[0]->ilce_adi."/".$siparis[0]->sehir_adi);
		}



		if($guncel_adim == 11){
			if($siparis[0]->musteri_tckn == "" || $siparis[0]->musteri_tckn == null){
				$this->session->set_flashdata('flashDanger', "Kurulum Onayı verebilmeniz için TCKN zorunludur.");
				redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
			
			}

		if(!tckn_dogrula($siparis[0]->musteri_tckn)){
			$this->session->set_flashdata('flashDanger', "Müşteri TCKN geçersizdir. Bilgileri kontrol edip tekrar deneyiniz.");
				redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				
		}

			

			if($siparis[0]->instagram_url == "" && $siparis[0]->facebook_url == "" ){
				$this->session->set_flashdata('flashDanger', "Kurulum Onayı verebilmeniz için sosyal medya bilgileri zorunludur.");
				redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
			
			}


			if($siparis[0]->musteri_cinsiyet == "B"){
				$this->session->set_flashdata('flashDanger', "Kurulum Onayı verebilmeniz için müşteri cinsiyet bilgisi zorunludur.");
				redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
			
			}
		}

	   
		if($guncel_adim == 12){
			 
			$aktifk = aktif_kullanici()->kullanici_id;
			if($aktifk != 1){
				if(json_decode($siparis[0]->egitim_ekip)[0] != $aktifk){
					$this->session->set_flashdata('flashDanger', "Bu sipariş eğitim onayını sadece eğitime giden kişi verebilir. Eğitime giden kişi ile iletişime geçiniz.");
					redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
			
				}
			}

			$kursiyer_data = [];
			foreach ($urunler as $urun) {
				$d = json_encode($this->input->post("urun_".$urun->siparis_urun_id."_sertifika_kisi"));
				
					if($this->input->post("urun_".$urun->siparis_urun_id."_sertifika_kisi") != null){
						$dataegitim = array(
							'siparis_urun_no'=>$urun->siparis_urun_id,
							'kursiyerler'=>json_encode($this->input->post("urun_".$urun->siparis_urun_id."_sertifika_kisi")),
							'egitim_kayit_sorumlu_kullanici_id' =>$this->session->userdata('aktif_kullanici_id'),
							"egitim_tarihi" => date("Y.m.d",strtotime($siparis[0]->belirlenen_egitim_tarihi)),
						);
						$this->db->insert('cihaz_egitimleri',$dataegitim);
					}
			}


			degerlendirme_sms_gonder($siparis[0]->siparis_id);

		}
		 

		if($guncel_adim == 4){
		
			if($siparis[0]->merkez_adresi == "" || $siparis[0]->merkez_adresi == null){
				$this->session->set_flashdata('flashDanger', "Sipariş oluşturmak istenen merkezin adres bilgisi eksik olduğu için sipariş onaylama işlemi başarısız. Lütfen bilgileri kontrol ediniz.");
				redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				return;
			}
			if($siparis[0]->merkez_adi == "" || $siparis[0]->merkez_adi == null || $siparis[0]->merkez_adi == "#NULL#"){
			//	$this->session->set_flashdata('flashDanger', "Sipariş oluşturmak istenen merkez adı eksik olduğu için sipariş onaylama işlemi başarısız. Lütfen bilgileri kontrol ediniz.");
			//	redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
			//	return;
			}
			foreach ($urunler as $urun) {	
				$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
				$this->db->update('siparis_urunleri',
					[
						"damla_etiket" => $this->input->post("urun_damla_etiket".$urun->siparis_urun_id), 
						"acilis_ekrani" => $this->input->post("urun_acilis_ekran".$urun->siparis_urun_id),
						"yurtdisi_mi" => $this->input->post("yurtdisi_mi".$urun->siparis_urun_id)
					]);
					$this->db->where('siparis_id', $id);
					$this->db->update('siparisler',
					[
						"musteri_talep_teslim_tarihi" => date("Y.m.d",strtotime($this->input->post("musteri_talep_teslim_tarihi"))),
						
						"kurulum_tarihi" =>date("Y.m.d",strtotime($this->input->post("musteri_talep_teslim_tarihi"))),
						"egitim_var_mi" => $this->input->post("egitim_var_mi")
					]);
			}
		
		}


		if($guncel_adim == 7){
			
			  

			foreach ($urunler as $urun) {	
				$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
				$this->db->update('siparis_urunleri',
					[
					"seri_numarasi" => $this->input->post("urun_seri_no".$urun->siparis_urun_id),
					"uretim_tarihi" => date("Y.m.d",strtotime($this->input->post("uretim_tarih".$urun->siparis_urun_id)))
					]);


					$this->db->where(["cihaz_havuz_seri_numarasi"=>$this->input->post("urun_seri_no".$urun->siparis_urun_id)])
					->update('cihaz_havuzu',
					[
					"cihaz_havuz_durum" => 0
					]);


				
			}
		
		}



		if($guncel_adim == 8){


			$baslik_kontrol = true;
			foreach ($urunler as $urun) {	
				foreach (json_decode($urun->basliklar) as $baslik) {
					
					if($urun->urun_id != 3 && $urun->urun_id != 4 && $urun->urun_id != 5 && $urun->urun_id != 7  ){
						
						$query = $this->db
					->where(['cihaz_seri_numarasi' => $urun->seri_numarasi])
					->where(['baslik_kayit_no' =>$baslik])
					->where(['cihaz_kayit_no' =>$urun->urun_id])
					->get('baslik_havuzu')->result();;

						if($query){

						}else{
							$baslik_kontrol = false;
						}
					}

				}
					
			}

			if($baslik_kontrol == false){
				 
				$this->session->set_flashdata('flashDanger', "Başlık havuzunda kayıt bulunamadı. Sistem yöneticiniz ile iletişime geçiniz.");
				redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				
			}



			foreach ($urunler as $urun) {	
				foreach (json_decode($urun->basliklar) as $baslik) {



					$baslik_data["siparis_urun_id"] = $urun->siparis_urun_id;
					$baslik_data["urun_baslik_no"] = $baslik;
					$baslik_data["baslik_garanti_baslangic_tarihi"] = date('Y-m-d H:i:s', strtotime($siparis[0]->musteri_talep_teslim_tarihi));
					$baslik_data["baslik_garanti_bitis_tarihi"] = date('Y-m-d H:i:s', strtotime('+2 years', strtotime($siparis[0]->musteri_talep_teslim_tarihi)));
			

					if($urun->urun_id != 3 && $urun->urun_id != 4 && $urun->urun_id != 5 && $urun->urun_id != 7  ){
						
						$query = $this->db
						->where(['cihaz_seri_numarasi' => $urun->seri_numarasi])
						->where(['baslik_kayit_no' =>$baslik])
						->where(['cihaz_kayit_no' =>$urun->urun_id])
						->get('baslik_havuzu')->result();

						if($query){
							$baslik_data["baslik_seri_no"] = $query[0]->baslik_seri_numarasi;
						}else{
							$baslik_data["baslik_seri_no"] = "B".date('dmYHis')."UG01";
						}
					}else{
						$baslik_data["baslik_seri_no"] = "B".date('dmYHis')."UG01";
					}



					
					$this->db->insert('urun_baslik_tanimlari',$baslik_data);
				}
					
			}
			 
		}
	



		if($guncel_adim == 9){
		
				$this->db->where('siparis_id', $id);
				$this->db->update('siparisler',
					[
					"kurulum_tarihi" =>date("Y.m.d",strtotime($this->input->post("kurulum_tarih"))),
					"kurulum_arac_plaka" => $this->input->post("kurulum_arac_plaka"),
					"kurulum_ekip" => json_encode($this->input->post("kurulum_ekip"))
					]);

						sendSmsData("05468311011","Kurulum Planında Değişiklikler Yapıldı");
						sendSmsData("05468311012","Kurulum Planında Değişiklikler Yapıldı");

		}

		if($guncel_adim == 10){	
			if($this->input->post("egitim_var_mi2") == 1){
				$this->db->where('siparis_id',$id);
				$this->db->update('siparisler',
					[
					"belirlenen_egitim_tarihi" => date("Y.m.d",strtotime($this->input->post("egitim_tarih"))),
					"egitim_ekip" => json_encode($this->input->post("egitim_ekip")),
					"egitim_var_mi" => $this->input->post("egitim_var_mi2")
					]);
			}else{
				$this->db->where('siparis_id',$id);
			$this->db->update('siparisler',
				[
				"belirlenen_egitim_tarihi" => date("Y.m.d"),
				"egitim_ekip" => null,
				"egitim_var_mi" => $this->input->post("egitim_var_mi2")
				]);
			}
			
		}
			if($guncel_adim == 11){	
				foreach ($urunler as $urun) {	
					$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
					$this->db->update('siparis_urunleri',
						[
							"garanti_baslangic_tarihi" => date('Y-m-d H:i:s', strtotime($siparis[0]->musteri_talep_teslim_tarihi)),
							"garanti_bitis_tarihi" => date('Y-m-d H:i:s', strtotime('+2 years', strtotime($siparis[0]->musteri_talep_teslim_tarihi)))
						]);
						
	
						
				}
		}

		$this->db->where('siparis_no', $id); 
		$this->db->order_by('siparis_onay_hareket_id', 'DESC');  
        $query = $this->db->get('siparis_onay_hareketleri');  
		$last_data = $query->row();  
        
		$siparis_onay_hareket["siparis_no"] =  $id;
		$siparis_onay_hareket["adim_no"] =  $last_data->adim_no+1;
		$siparis_onay_hareket["onay_durum"] =  1;
		$siparis_onay_hareket["onay_aciklama"] =  strip_tags($this->input->post("onay_aciklama"));
		$siparis_onay_hareket["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');
		
		$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
		
		$this->db->select('*');
		$this->db->from('siparis_onay_adimlari');
		$this->db->where('adim_id', $last_data->adim_no+2);
		$query2a = $this->db->get();
		$a_data = $query2a->result();
		$adim_ad = "";
		if($a_data){
			$adim_ad = "(".$a_data[0]->adim_adi.")";
		}
		 

		$queryq = $this->db->where("yetki_kodu","siparis_onay_".($last_data->adim_no+2))
		->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
		->get("kullanici_yetki_tanimlari");
		$dkul = $queryq->result();
		if($dkul){
			foreach ($dkul as $kullanici_data) {

				if($guncel_adim == 11){
					$url = site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")));
						if(strpos($siparis[0]->egitim_ekip, "\"$kullanici_data->kullanici_id\"") == false){
						  
					   }else{
						sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no,"Sn. ".$kullanici_data->kullanici_ad_soyad." ".date("d.m.Y H:i")." tarihinde işlem yapılan ".$siparis[0]->siparis_kodu." no'lu sipariş ".$adim_ad." aşaması için sizden onay beklemektedir. Siparişi onaylamak için : $url");
		
					   }
					
				}else{

					$url = site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")));
					sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no,"Sn. ".$kullanici_data->kullanici_ad_soyad." ".date("d.m.Y H:i")." tarihinde işlem yapılan ".$siparis[0]->siparis_kodu." no'lu sipariş ".$adim_ad." aşaması için sizden onay beklemektedir. Siparişi onaylamak için : $url");
		
				}
					}
		}
	 

		if($guncel_adim == 7 && $siparis->ulke_id == 190){
			$siparis_onay_hareket["siparis_no"] =  $id;
			$siparis_onay_hareket["adim_no"] =  8;
			$siparis_onay_hareket["onay_durum"] =  1;
			$siparis_onay_hareket["onay_aciklama"] =  "Sistem tarafından otomatik onaylanmıştır.";
			$siparis_onay_hareket["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');
			$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
		}
		

		if($siparis[0]->egitim_var_mi == 0){
			/*if($guncel_adim == 9){
				$siparis_onay_hareket["siparis_no"] =  $id;
				$siparis_onay_hareket["adim_no"] =  10;
				$siparis_onay_hareket["onay_durum"] =  1;
				$siparis_onay_hareket["onay_aciklama"] =  "Eğitim olmadığı için sistem tarafından otomatik onaylanmıştır.";
				$siparis_onay_hareket["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');
				$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
			}*/
			if($guncel_adim == 11){
				$siparis_onay_hareket["siparis_no"] =  $id;
				$siparis_onay_hareket["adim_no"] =  12;
				$siparis_onay_hareket["onay_durum"] =  1;
				$siparis_onay_hareket["onay_aciklama"] =  "Eğitim olmadığı için sistem tarafından otomatik onaylanmıştır.";
				$siparis_onay_hareket["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');
				$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);





				degerlendirme_sms_gonder($siparis[0]->siparis_id);







			}
		}








redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
			
		//redirect(site_url('onay-bekleyen-siparisler?filter=2'));
	}

	public function hizli_siparis_olustur_view()
	{ 
		yetki_kontrol("hizli_siparis_ekle");
	

		
		$viewData["page"] = "siparis/hizli_siparis";
		$this->load->view('base_view',$viewData);

	}
	public function hizli_siparis_olustur()
	{ 
		yetki_kontrol("hizli_siparis_ekle");
	
		$check_id = $this->Merkez_model->get_all(["musteri_iletisim_numarasi"=>str_replace(" ", "", $this->input->post("talep_cep_telefon"))]); 	
		if($check_id){
			redirect(base_url("siparis/ekle/".$check_id[0]->merkez_id));	 
		}else{
			$this->session->set_flashdata('flashDanger','Girilen iletişim numarasına tanımlı müşteri kaydı bulunamamıştır.Sipariş oluşturma işlemi başarısız.');
            redirect(base_url('siparis/hizli_siparis_olustur_view'));
		}

	}
	
	public function save()
	{   $data = json_decode(json_encode($this->input->post()));

		if(empty($data->urun)){
			redirect(site_url('siparis/ekle/'. $this->input->post("merkez_id")));
		}
		
		$siparis["merkez_no"] =  $this->input->post("merkez_id");
		$siparis["siparisi_olusturan_kullanici"] =  $this->session->userdata('aktif_kullanici_id');
		$this->Siparis_model->insert($siparis);
		$siparis_kodu = $this->db->insert_id();
		
		$siparis_kod_format = "SPR".date("dmY").str_pad($siparis_kodu, 5, '0', STR_PAD_LEFT);
		$this->db->where('siparis_id', $siparis_kodu);
		$this->db->update('siparisler', ["siparis_kodu"=>$siparis_kod_format]);

		$siparis_onay_hareket_adim_1["siparis_no"] =  $siparis_kodu;
		$siparis_onay_hareket_adim_1["adim_no"] =  1;
		$siparis_onay_hareket_adim_1["onay_durum"] =  1;
		$siparis_onay_hareket_adim_1["onay_aciklama"] =   "Görüşme kaydı otomatik oluşturuldu.";
		$siparis_onay_hareket_adim_1["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');
		
		$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket_adim_1);
	 

 


		$siparis_notu = "";
		for ($i=0; $i < count($data->urun) ; $i++) { 
		
	 
			$siparis_notu = $siparis_notu." ".$data->siparis_notu[$i];
			
		}









		$siparis_onay_hareket_adim_2["siparis_no"] =  $siparis_kodu;
		$siparis_onay_hareket_adim_2["adim_no"] =  2;
		$siparis_onay_hareket_adim_2["onay_durum"] =  1;
		$siparis_onay_hareket_adim_2["onay_aciklama"] =  ($siparis_notu=="")? "Sipariş kaydı otomatik oluşturuldu." : $siparis_notu;
		$siparis_onay_hareket_adim_2["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');
		
		$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket_adim_2);
		

	$url = site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis_kodu."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")));

		//sendSmsData("05382197344","SİPARİŞ BİLDİRİMİ\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından yeni sipariş kaydı oluşturulmuştur. $url");
		sendSmsData("05468311015","SİPARİŞ BİLDİRİMİ\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından yeni sipariş kaydı oluşturulmuştur. $url");
		sendSmsData("05453950049","SİPARİŞ BİLDİRİMİ\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından yeni sipariş kaydı oluşturulmuştur. $url");
		 

		$queryq = $this->db->where("yetki_kodu","siparis_onay_3")
		->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
		->get("kullanici_yetki_tanimlari");
		$dkul = $queryq->result();
		if($dkul){
			foreach ($dkul as $kullanici_data) {

			if(aktif_kullanici()->kullanici_yonetici_kullanici_id == $kullanici_data->kullanici_id){
				sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no,"Sn. ".$kullanici_data->kullanici_ad_soyad." ".date("d.m.Y H:i")." tarihinde işlem yapılan ".$siparis_kod_format." no'lu sipariş sizden satış onayı beklemektedir. Siparişi onaylamak için : $url");
				
				// Bildirim sistemi entegrasyonu
				$this->siparis_bildirimi_gonder($siparis_kodu, $siparis_kod_format, $url, $kullanici_data->kullanici_id);
			}
					 
		}
		}
		
		// Müdüre bildirim gönder (ID 9 - müdür)
		$this->siparis_bildirimi_gonder($siparis_kodu, $siparis_kod_format, $url, 9);


		for ($i=0; $i < count($data->urun) ; $i++) { 
			$siparis_urun["siparis_kodu"] 		= $siparis_kodu;
			$siparis_urun["urun_no"] 			= $data->urun[$i];
			$siparis_urun["satis_fiyati"] 		= str_replace(',','', str_replace('₺', '', $data->satis_fiyati[$i]));
			$siparis_urun["pesinat_fiyati"] 	= str_replace(',','', str_replace('₺', '', $data->pesinat_fiyati[$i]));
			$siparis_urun["kapora_fiyati"] 		= str_replace(',','', str_replace('₺', '', $data->kapora_fiyati[$i]));
			$siparis_urun["fatura_tutari"] 		= str_replace(',','', str_replace('₺', '', $data->fatura_tutari[$i]));
			$siparis_urun["takas_bedeli"] 		= str_replace(',','', str_replace('₺', '', $data->takas_bedeli[$i]));
			
			$siparis_urun["takas_alinan_seri_kod"] 		= $data->takas_alinan_seri_kod[$i];
			$siparis_urun["takas_alinan_model"] 		= $data->takas_alinan_model[$i];
			$siparis_urun["takas_alinan_renk"] 		= $data->takas_alinan_renk[$i];
			


			$siparis_urun["renk"] 				= $data->renk[$i];
			$siparis_urun["odeme_secenek"]		= $data->odeme_secenegi[$i];
			$siparis_urun["vade_sayisi"]		= $data->vade_sayisi[$i];
			
			$siparis_urun["damla_etiket"]		= $data->damla_etiket[$i];
			$siparis_urun["acilis_ekrani"]		= $data->acilis_ekrani[$i];
			$siparis_urun["yenilenmis_cihaz_mi"]		= $data->yenilenmis_cihaz_mi[$i];

			$siparis_urun["para_birimi"]		= $data->para_birimi[$i];

			$siparis_urun["hediye_no"]		= $data->hediye_no[$i];


			$siparis_urun["basliklar"]		= base64_decode($data->baslik[$i]);
			
			$siparis_urun["siparis_urun_notu"] 	= $data->siparis_notu[$i];
			$this->Siparis_urun_model->insert($siparis_urun);
			$siparis_urun_id = $this->db->insert_id();

			if($data->takas_alinan_model[$i] == "UMEX"){

				$this->db->where('seri_numarasi', $data->takas_alinan_seri_kod[$i])->update('siparis_urunleri', ["takas_cihaz_mi"=>1,"takas_alinan_merkez_id"=>$this->input->post("merkez_id"),"takas_siparis_islem_detay"=>"$siparis_kodu nolu sipariş kayıt sırasında takas olarak işaretlendi."]);
			}

			// Takas fotoğraflarını kaydet
			if(isset($_POST['takas_fotograflari'][$i]) && !empty($_POST['takas_fotograflari'][$i])){
				$fotograflar_json = $_POST['takas_fotograflari'][$i];
				$fotograflar = json_decode($fotograflar_json, true);
				
				// JSON decode başarılı mı ve array mi kontrol et
				if($fotograflar !== null && is_array($fotograflar) && !empty($fotograflar)){
					foreach($fotograflar as $foto_path){
						if(!empty($foto_path) && is_string($foto_path) && file_exists(FCPATH . $foto_path)){
							$foto_data = [
								'urun_id' => $siparis_urun_id,
								'siparis_id' => $siparis_kodu,
								'foto_url' => $foto_path
							];
							$this->db->insert('takas_urun_fotograflari', $foto_data);
						}
					}
				}
			}
			
		}	 

		 
			redirect(site_url('siparis/report/'.$siparis_kodu));


		redirect(site_url('siparisler'));
	}




	public function takaslikontrol()
    {

		$json = json_decode(file_get_contents("php://input"), true);
        $seri_no = isset($json['seri_no']) ? $json['seri_no'] : '';
        $telefon = isset($json['telefon']) ? preg_replace('/\s+/', '', $json['telefon']) : '';


		$iddata = $this->db->where("seri_numarasi",$seri_no)->get("siparis_urunleri")->result();
		if($iddata){
			$check_id = $this->Siparis_model->get_by_id($iddata[0]->siparis_kodu); 
			if($check_id[0]->musteri_iletisim_numarasi != $telefon){
				echo json_encode(['durum' => false]);
				return;
			} 
		}
		echo json_encode(['durum' => true]);

    }

	public function takas_fotograf_yukle()
    {
		$json = json_decode(file_get_contents("php://input"), true);
        $base64 = isset($json['image']) ? $json['image'] : '';
		$urun_index = isset($json['urun_index']) ? $json['urun_index'] : 0;

        if (!$base64) {
            echo json_encode(['status' => 'error', 'message' => 'Görsel yok']);
            return;
        }

        $image_parts = explode(";base64,", $base64);
        if (count($image_parts) !== 2) {
            echo json_encode(['status' => 'error', 'message' => 'Base64 hatalı']);
            return;
        }

        $image_base64 = base64_decode($image_parts[1]);
        $filename = 'takas_' . uniqid('', true) . '_' . time() . '.jpg';
        $upload_dir = FCPATH . 'uploads/takas_fotograflari/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_path = $upload_dir . $filename;
        file_put_contents($file_path, $image_base64);
        
        $foto_url = 'uploads/takas_fotograflari/' . $filename;
        
        echo json_encode([
            'status' => 'success', 
            'foto_url' => base_url($foto_url),
            'foto_path' => $foto_url,
            'urun_index' => $urun_index
        ]);
    }






	public function siparis_genel_duzenleme_view($id){
		yetki_kontrol("siparis_detaylarini_duzenle");

		


		$siparis = $this->Siparis_model->get_by_id($id); 
			

		$data = get_son_adim($siparis[0]->siparis_id);
		if($data){
			if(aktif_kullanici()->kullanici_id != 1){
				if($data[0]->adim_sira_numarasi == 9){
					echo "Kalite Kontrol Onayı Verilen Siparişlerin Bilgileri Güncellenemez. Sistem yöneticiniz ile iletişime geçiniz."; return;
					}
			} 
			
		}else{
			echo "Kalite Kontrol Onayı Verilen Siparişlerin Bilgileri Güncellenemez. Sistem yöneticiniz ile iletişime geçiniz."; return;
				
		}
		 

		$kullanicilar = $this->Kullanici_model->get_all(); 
		$viewData["kullanicilar"] = $kullanicilar;

		$viewData['siparis'] = $siparis[0];
		$viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id);
		$takas_fotograflari_query = $this->db->where("siparis_id",$id)->get("takas_urun_fotograflari");
		$viewData['takas_fotograflari'] = $takas_fotograflari_query ? $takas_fotograflari_query->result() : [];
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
			$viewData['hediyeler'] = $this->db->get("siparis_hediyeler")->result();

		$viewData["page"] = "siparis/siparis_detay_duzenle";
		$this->load->view('base_view',$viewData);
	}
	
	public function ust_satis_onayini_ver($siparis_id)
	{   
        yetki_kontrol("siparis_ikinci_onay");
        $siparis = $this->Siparis_model->get_by_id($siparis_id); 
		
        if($siparis != null){
            $data['siparis_ust_satis_onayi'] = 1;
			$data['siparis_ust_satis_onay_tarihi'] = date("Y-m-d H:i");
			$this->db->where('siparis_id', $siparis_id);
			$this->db->update('siparisler', $data);
            redirect(base_url("onay-bekleyen-siparisler"));
        }
    }  

	public function bekleme_islem($siparis_id)
	{   
        yetki_kontrol("siparis_beklemeye_al");
        $siparis = $this->Siparis_model->get_by_id($siparis_id); 
		
        if($siparis != null){
            $data['beklemede'] = ($siparis[0]->beklemede == 0) ? 1 : 0;
			$this->db->where('siparis_id', $siparis_id);
			$this->db->update('siparisler', $data);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }  
 

	public function save_siparis_genel_duzenleme($id){
		yetki_kontrol("siparis_detaylarini_duzenle");
		$urunler =  $this->Siparis_model->get_all_products_by_order_id($id);
		$c = -1;
		foreach ($urunler as $urun) {	
			$c++;
			$hediye_no = $this->input->post("urun_hediye_no".$urun->siparis_urun_id);
			$hediye_no = ($hediye_no == "0" || $hediye_no == "") ? null : intval($hediye_no);
			
			$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
			$this->db->update('siparis_urunleri',
				[
					"damla_etiket" => $this->input->post("urun_damla_etiket".$urun->siparis_urun_id),
					"acilis_ekrani" => $this->input->post("urun_acilis_ekran".$urun->siparis_urun_id),
					"basliklar"   => json_encode($this->input->post("baslik_select".$c)),
					"renk" => $this->input->post("urun_renk".$urun->siparis_urun_id),
					"hediye_no" => $hediye_no
					
				]);
				$this->db->where('siparis_id', $id);
				$this->db->update('siparisler',
				[
					"musteri_talep_teslim_tarihi" => date("Y.m.d",strtotime($this->input->post("musteri_talep_teslim_tarihi"))),
					"egitim_var_mi" => $this->input->post("egitim_var_mi"),
					"yonlendiren_kisi" => $this->input->post("yonlendiren_kisi"),
				]);
		}
		redirect(site_url('siparis/report/'.$id));
	}




















	public function save_merkez_bilgi_dogrulama_view($id){
		yetki_kontrol("siparis_detaylarini_duzenle");
		$siparis = $this->Siparis_model->get_by_id($id); 

		if(goruntuleme_kontrol("sadece_kendi_siparis_fiyati_duzenle")){
			if($siparis[0]->siparisi_olusturan_kullanici != aktif_kullanici()->kullanici_id){
				echo "Sadece kendi ouşturduğunuz siparişin fiyat bilgilerini düzenleyebilirsiniz."; return;
			}else{
		
				$data = get_son_adim($siparis[0]->siparis_id);
			 
				  if($data[0]->adim_sira_numarasi == 4){
					echo "Satış Onayı Verilen Siparişlerin Fiyat Bilgisi Güncellenemez. Sistem yöneticiniz ile iletişime geçiniz."; return;
				  }
		
			
		}
			
		}else{
			if(!goruntuleme_kontrol("tum_siparis_fiyatlarini_duzenle")){
				echo "sipariş fiyatını düzenleme yetkiniz yoktur"; return;
			}
		}

		$viewData['siparis'] = $siparis[0];
		$viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id);
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
		$viewData['hediyeler'] = $this->db->get("siparis_hediyeler")->result();
		
		$viewData["page"] = "siparis/merkez_bilgi_form";
		$this->load->view('base_view',$viewData);
	}



 

	public function save_merkez_bilgi_dogrulama($id){
		yetki_kontrol("siparis_detaylarini_duzenle");


		$siparis_db_data = $this->Siparis_model->get_by_id($id); 
		
		
		$urunler =  $this->Siparis_model->get_all_products_by_order_id($id);$c = -1;
		log_data("Sipariş Fiyat Düzenleme","[".$id."] nolu Siparişin Fiyat Bilgileri Düzenlendi. Eski Bilgiler : ".json_encode($siparis_db_data)."#####".json_encode($urunler));
		foreach ($urunler as $urun) {	
			$c++;
			if(goruntuleme_kontrol("sadece_kendi_siparis_fiyati_duzenle")){
				if($urun->siparisi_olusturan_kullanici != aktif_kullanici()->kullanici_id){
					echo "Sadece kendi oluşturduğunuz siparişin fiyat bilgilerini düzenleyebilirsiniz."; return;
				}else{
				
						$data = get_son_adim($id);
						  if($data[0]->adim_sira_numarasi == 4){
							echo "Satış Onayı Verilen Siparişlerin Fiyat Bilgisi Güncellenemez. Sistem yöneticiniz ile iletişime geçiniz."; return;
						  }
				
					
				}
				
			}else{
				if(!goruntuleme_kontrol("tum_siparis_fiyatlarini_duzenle")){
					echo "sipariş fiyatını düzenleme yetkiniz yoktur"; return;
				}
			}
		
			$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
			
		
			$hediye_no = $this->input->post("urun_hediye_no".$urun->siparis_urun_id);
			$hediye_no = ($hediye_no == "0" || $hediye_no == "") ? null : intval($hediye_no);
		
			$this->db->update('siparis_urunleri',
				[
					"urun_no" => $this->input->post("urun_no".$urun->siparis_urun_id),
					"damla_etiket" => $this->input->post("urun_damla_etiket".$urun->siparis_urun_id),
					"acilis_ekrani" => $this->input->post("urun_acilis_ekran".$urun->siparis_urun_id),
					"odeme_secenek" 	 => $this->input->post("odeme_secenegi_".$urun->siparis_urun_id),
					"vade_sayisi" 	 => $this->input->post("vade_sayisi_".$urun->siparis_urun_id),
					
					"satis_fiyati" 	 => str_replace(',','', str_replace('₺', '', $this->input->post("urun_satis_fiyati_".$urun->siparis_urun_id))),
					"pesinat_fiyati" => str_replace(',','', str_replace('₺', '', $this->input->post("urun_pesinat_fiyati_".$urun->siparis_urun_id))),
					"kapora_fiyati"  => str_replace(',','', str_replace('₺', '', $this->input->post("urun_kapora_fiyati_".$urun->siparis_urun_id))),
					"fatura_tutari"  => str_replace(',','', str_replace('₺', '', $this->input->post("urun_fatura_tutari_".$urun->siparis_urun_id))),
					"takas_bedeli"   => str_replace(',','', str_replace('₺', '', $this->input->post("urun_takas_bedeli_".$urun->siparis_urun_id))),
					"takas_alinan_seri_kod"   => str_replace(',','', str_replace('₺', '', $this->input->post("takas_alinan_seri_kod_".$urun->siparis_urun_id))),
					"takas_alinan_model"   => str_replace(',','', str_replace('₺', '', $this->input->post("takas_alinan_model_".$urun->siparis_urun_id))),
					"takas_alinan_renk"   => str_replace(',','', str_replace('₺', '', $this->input->post("takas_alinan_renk_".$urun->siparis_urun_id))),
					"basliklar"   => json_encode($this->input->post("baslik_select".$c)),
					
					"yenilenmis_cihaz_mi" => $this->input->post("yenilenmis_cihaz_mi".$urun->siparis_urun_id),
					"yurtdisi_mi" => $this->input->post("yurtdisi_mi".$urun->siparis_urun_id),
					"para_birimi" => $this->input->post("para_birimi".$urun->siparis_urun_id),
					
					"renk" => $this->input->post("urun_renk".$urun->siparis_urun_id),
					"hediye_no" => $hediye_no
					
				]);





				$this->db->where('siparis_id', $id);
				$this->db->update('siparisler',
				[
					"musteri_talep_teslim_tarihi" => date("Y.m.d",strtotime($this->input->post("musteri_talep_teslim_tarihi"))),
					"egitim_var_mi" => $this->input->post("egitim_var_mi")
				]);

				log_data("Fiyat Güncelleme",json_encode($this->input->post()));

		}
		
		$this->session->set_flashdata('flashSuccess', "Ürün bilgileri başarıyla güncellenmiştir. Başlık ve renk kontrollerini yapmayı unutmayınız.");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function save_uretim_sureci_view($id){
		yetki_kontrol("uretim_surecini_duzenle");
		$siparis = $this->Siparis_model->get_by_id($id); 
		$viewData['siparis'] = $siparis[0];
		$viewData['basliklar'] =  $this->Urun_model->get_basliklar();
		$viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id);
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
		
		$viewData["page"] = "siparis/uretim_sureci_form";
		$this->load->view('base_view',$viewData);
	}
	public function save_uretim_sureci($id){
		yetki_kontrol("uretim_surecini_duzenle");
		$urunler =  $this->Siparis_model->get_all_products_by_order_id($id);
		foreach ($urunler as $urun) {	
			$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
			$this->db->update('siparis_urunleri',
				[
				"seri_numarasi" => $this->input->post("urun_seri_no".$urun->siparis_urun_id),
				"uretim_tarihi" => date("Y.m.d",strtotime($this->input->post("uretim_tarih".$urun->siparis_urun_id)))
				]);
		}	
		 
		redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				 
	}




	public function pdf_kurulum_rapor($id){

		$siparis = $this->Siparis_model->get_by_id($id); 
		$kurulum_ekip = $this->Kullanici_model->get_all(null,$siparis[0]->kurulum_ekip);
		$viewData['kurulum_ekip'] = $siparis[0]->kurulum_ekip ? $kurulum_ekip : [];
		$viewData['data'] = $siparis[0];
		$egitim_ekip = $this->Kullanici_model->get_all(null,$siparis[0]->egitim_ekip);
		$viewData['egitim_ekip'] = $siparis[0]->egitim_ekip ? $egitim_ekip : [];
		
		$viewData['cihazlar'] = $this->Siparis_model->get_all_products_by_order_id($id);
		 $this->load->view('siparis/kurulum_rapor/teslimat_rapor.php',$viewData);
	}


	public function save_kurulum_rapor_view($id){

		yetki_kontrol("kurulum_surecini_duzenle");
		$siparis = $this->Siparis_model->get_by_id($id); 

		$viewData['siparis_degerlendirme_parametreleri'] =$this->db->get("siparis_degerlendirme_parametreleri")->result();
		
		$viewData['egitmenler'] =  $this->Kullanici_model->get_egitmen(["kullanici_departman_id"=>15,"kullanici_aktif",1]);
		$viewData['siparis'] = $siparis[0];
		$viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id);
		$viewData['kullanicilar'] =  $this->Kullanici_model->get_all(["kurulum_ekip_durumu"=>1]);
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
		
		
		$viewData['degerlendirme_data'] =  $siparis[0]->degerlendirme_formu;
	
		$viewData["page"] = "siparis/kurulum_rapor";
		$this->load->view('base_view',$viewData);
	}


	public function kurulum_fotograf_yukle()
	{
		$json = json_decode(file_get_contents("php://input"), true);
		$base64 = isset($json['image']) ? $json['image'] : '';
		$siparis_id = isset($json['siparis_id']) ? $json['siparis_id'] : 0;
		$foto_tipi = isset($json['foto_tipi']) ? $json['foto_tipi'] : 'belge';

		// Geçerli fotoğraf tiplerini kontrol et
		$gecerli_tipler = ['belge', 'on', 'arka', 'sag_yan', 'sol_yan', 'su_seviyesi', 'ic_izolasyon', 'rulop', 'olcu_aleti'];
		if (!in_array($foto_tipi, $gecerli_tipler)) {
			$foto_tipi = 'belge'; // Varsayılan olarak belge
		}

		if (!$base64 || !$siparis_id) {
			echo json_encode(['status' => 'error', 'message' => 'Eksik parametre']);
			return;
		}

		// Aynı türden fotoğraf zaten var mı kontrol et (SADECE CİHAZ FOTOĞRAFLARI İÇİN - BELGE İÇİN DEĞİL)
		// Belge fotoğrafları için birden fazla fotoğraf yüklenebilir
		if ($foto_tipi !== 'belge') {
			$existing_photo = $this->db->where(['siparis_id' => $siparis_id, 'foto_tipi' => $foto_tipi])->get('kurulum_fotograflari')->row();
			if ($existing_photo) {
				echo json_encode(['status' => 'error', 'message' => 'Bu fotoğraf türü için zaten bir kayıt mevcut']);
				return;
			}
		}

		$image_parts = explode(";base64,", $base64);
		if (count($image_parts) !== 2) {
			echo json_encode(['status' => 'error', 'message' => 'Base64 hatalı']);
			return;
		}

		$image_base64 = base64_decode($image_parts[1]);

		// Dosya uzantısını belirle (video için mp4, resim için jpg)
		$uzanti = ($foto_tipi === 'olcu_aleti') ? 'mp4' : 'jpg';
		$filename = 'kurulum_' . $foto_tipi . '_' . uniqid('', true) . '_' . time() . '.' . $uzanti;
		$upload_dir = FCPATH . 'uploads/kurulum_fotograflari/';

		if (!is_dir($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}

		$file_path = $upload_dir . $filename;
		if (file_put_contents($file_path, $image_base64) === false) {
			echo json_encode(['status' => 'error', 'message' => 'Dosya yazma hatası']);
			return;
		}

		$foto_url = 'uploads/kurulum_fotograflari/' . $filename;

		// Veritabanına kaydet
		$data = [
			'siparis_id' => $siparis_id,
			'foto_tipi' => $foto_tipi,
			'foto_url' => $foto_url,
			'yukleme_tarihi' => date('Y-m-d H:i:s')
		];
		$this->db->insert('kurulum_fotograflari', $data);

		if ($this->db->affected_rows() > 0) {
			echo json_encode([
				'status' => 'success',
				'foto_url' => base_url($foto_url),
				'foto_path' => $foto_url,
				'foto_id' => $this->db->insert_id()
			]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Veritabanı hatası']);
		}
	}

	public function kurulum_fotograf_sil()
	{
		$json = json_decode(file_get_contents("php://input"), true);
		$foto_id = isset($json['foto_id']) ? $json['foto_id'] : 0;

		if (!$foto_id) {
			echo json_encode(['status' => 'error', 'message' => 'Fotoğraf ID eksik']);
			return;
		}

		// Fotoğraf bilgilerini al
		$foto = $this->db->where('id', $foto_id)->get('kurulum_fotograflari')->row();
		if (!$foto) {
			echo json_encode(['status' => 'error', 'message' => 'Fotoğraf bulunamadı']);
			return;
		}

		// Silinen fotoğrafın tipini kaydet
		$foto_tipi = $foto->foto_tipi;

		// Dosyayı sil
		$file_path = FCPATH . $foto->foto_url;
		if (file_exists($file_path)) {
			unlink($file_path);
		}

		// Veritabanından sil
		$this->db->where('id', $foto_id)->delete('kurulum_fotograflari');

		if ($this->db->affected_rows() > 0) {
			echo json_encode([
				'status' => 'success',
				'foto_tipi' => $foto_tipi
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Veritabanından silme işlemi başarısız oldu'
			]);
		}
	}

	public function save_kurulum_rapor($id){

		$info = [];
		foreach ($_POST as $attribute_name => $attribute_value) {
			if (strpos($attribute_name, 'feature_title_') === 0) {
				$info[substr($attribute_name, 14)]['name'] = strip_tags($attribute_value);
			}elseif (strpos($attribute_name, 'i_feature_name_') === 0) {
				$info[substr($attribute_name, 15)]['value'] = strip_tags($attribute_value);
			}
		}
		$informations = json_encode(array_values($info), JSON_UNESCAPED_UNICODE);

		$query = $this->db->where("siparis_id",$id)
        ->update("siparisler",[
            "degerlendirme_formu"=>(($informations != "[]") ? $informations : "")
        ]);
		redirect(base_url("siparis/pdf_kurulum_rapor/".$id));
	}






	public function save_kurulum_programlama_view($id){

		yetki_kontrol("kurulum_surecini_duzenle");
		$siparis = $this->Siparis_model->get_by_id($id); 
		$viewData['egitmenler'] =  $this->Kullanici_model->get_egitmen(["kullanici_departman_id"=>15,"kullanici_aktif",1]);
		$viewData['siparis'] = $siparis[0];
		$viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id);
		$viewData['kullanicilar'] =  $this->Kullanici_model->get_all(["kurulum_ekip_durumu"=>1]);
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
		
		$viewData["page"] = "siparis/kurulum_programlama_form";
		$this->load->view('base_view',$viewData);
	}
	public function save_kurulum_programlama($id,$sms_gonder = 0){

		yetki_kontrol("kurulum_surecini_duzenle");


		 $kontrolsiparisdata = $this->Siparis_model->get_by_id($id)[0]; 


		$this->db->where('siparis_id', $id);
		$this->db->update('siparisler',
			[
			"kurulum_tarihi" =>date("Y.m.d",strtotime($this->input->post("kurulum_tarih"))),
			"kurulum_arac_plaka" => $this->input->post("kurulum_arac_plaka"),
			"kurulum_ekip" => json_encode($this->input->post("kurulum_ekip") ?? '[""]') 
			 
			]);


			$urunler =  $this->Siparis_model->get_all_products_by_order_id($id);
			foreach ($urunler as $urun) {	
				$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
				$this->db->update('siparis_urunleri',
					[
						"garanti_baslangic_tarihi" => date('Y-m-d H:i:s', strtotime($this->input->post("kurulum_tarih"))),
			"garanti_bitis_tarihi" => date('Y-m-d H:i:s', strtotime('+2 years', strtotime($this->input->post("kurulum_tarih"))))
		]);
					

		 


					
			}

			$siparis = $this->Siparis_model->get_by_id($id)[0]; 
			$egitmenlerd =  $this->Kullanici_model->get_egitmen(["kullanici_departman_id"=>15]);
			$kurulumd 	 =  $this->Kullanici_model->get_all(["kurulum_ekip_durumu"=>1]);

			// Kurulum ekibine ertesi gün izin tipi 6 ile otomatik izin kaydı oluştur
			$kurulum_tarihi = $this->input->post("kurulum_tarih");
			$kurulum_ekip = $this->input->post("kurulum_ekip") ?? [];
			if(!empty($kurulum_tarihi) && !empty($kurulum_ekip) && is_array($kurulum_ekip)){
				// Tarihi parse et (format: Y-m-d veya Y.m.d)
				$kurulum_tarihi_parsed = str_replace('.', '-', $kurulum_tarihi);
				$ertesi_gun = date('Y-m-d', strtotime($kurulum_tarihi_parsed . ' +1 day'));
				$aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');
			 
				foreach($kurulum_ekip as $kullanici_id){
					if(!empty($kullanici_id)){
						// Aynı tarih ve kullanıcı için zaten izin kaydı var mı kontrol et
						$mevcut_izin = $this->db->where('izin_talep_eden_kullanici_id', $kullanici_id)
							->where('DATE(izin_baslangic_tarihi)', $ertesi_gun)
							->where('izin_neden_no', 6)
							->get('izin_talepleri')
							->row();
						
						if(!$mevcut_izin){
							// İzin kaydı oluştur
							$izin_data = [
								'izin_talep_eden_kullanici_id' => $kullanici_id,
								'izin_baslangic_tarihi' => $ertesi_gun . ' 08:00:00',
								'izin_bitis_tarihi' => $ertesi_gun . ' 17:00:00',
								'izin_neden_no' => 6,
								'amir_onay_durumu' => 1,
								'mudur_onay_durumu' => 1,
								'amir_onay_tarihi' => date('Y-m-d H:i:s'),
								'mudur_onay_tarihi' => date('Y-m-d H:i:s'),
								'amir_onay_kullanici_id' => $aktif_kullanici_id,
								'mudur_onay_kullanici_id' => $aktif_kullanici_id,
								'izin_notu' => 'Kurulum sonrası otomatik izin - Sipariş: ' . $siparis->siparis_kodu
							];
							$this->db->insert('izin_talepleri', $izin_data);
						}
					}
				}
			}

			// Eğitmenlere de ertesi gün izin tipi 6 ile otomatik izin kaydı oluştur
			if(!empty($kurulum_tarihi) && !empty($siparis->egitim_ekip)){
				$egitim_ekip_array = json_decode($siparis->egitim_ekip);
				if(is_array($egitim_ekip_array) && !empty($egitim_ekip_array)){
					$kurulum_tarihi_parsed = str_replace('.', '-', $kurulum_tarihi);
					$ertesi_gun = date('Y-m-d', strtotime($kurulum_tarihi_parsed . ' +1 day'));
					$aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');
					
					foreach($egitim_ekip_array as $kullanici_id){
						if(!empty($kullanici_id)){
							// Aynı tarih ve kullanıcı için zaten izin kaydı var mı kontrol et
							$mevcut_izin = $this->db->where('izin_talep_eden_kullanici_id', $kullanici_id)
								->where('DATE(izin_baslangic_tarihi)', $ertesi_gun)
								->where('izin_neden_no', 6)
								->get('izin_talepleri')
								->row();
							
							if(!$mevcut_izin){
								// İzin kaydı oluştur
								$izin_data = [
									'izin_talep_eden_kullanici_id' => $kullanici_id,
									'izin_baslangic_tarihi' => $ertesi_gun . ' 08:00:00',
									'izin_bitis_tarihi' => $ertesi_gun . ' 17:00:00',
									'izin_neden_no' => 6,
									'amir_onay_durumu' => 1,
									'mudur_onay_durumu' => 1,
									'amir_onay_tarihi' => date('Y-m-d H:i:s'),
									'mudur_onay_tarihi' => date('Y-m-d H:i:s'),
									'amir_onay_kullanici_id' => $aktif_kullanici_id,
									'mudur_onay_kullanici_id' => $aktif_kullanici_id,
									'izin_notu' => 'Kurulum sonrası otomatik izin (Eğitmen) - Sipariş: ' . $siparis->siparis_kodu
								];
								$this->db->insert('izin_talepleri', $izin_data);
							}
						}
					}
				}
			}

			if(date("Y-m-d",strtotime($kontrolsiparisdata->kurulum_tarihi)) !=date("Y-m-d",strtotime($siparis->kurulum_tarihi))){
			
			
				sendSmsData("05468311011",$kontrolsiparisdata->musteri_ad.", ".$kontrolsiparisdata->merkez_adi." ".$kontrolsiparisdata->siparis_kodu." nolu siparişin kurulum planında değişiklik yapıldı. Eski Kurulum Tarihi : ".date("d.m.Y",strtotime($kontrolsiparisdata->kurulum_tarihi))." , Yeni Kurulum Tarihi : ".date("d.m.Y",strtotime($siparis->kurulum_tarihi)));
			sendSmsData("05468311012",$kontrolsiparisdata->musteri_ad.", ".$kontrolsiparisdata->merkez_adi." ".$kontrolsiparisdata->siparis_kodu." nolu siparişin kurulum planında değişiklik yapıldı. Eski Kurulum Tarihi : ".date("d.m.Y",strtotime($kontrolsiparisdata->kurulum_tarihi))." , Yeni Kurulum Tarihi : ".date("d.m.Y",strtotime($siparis->kurulum_tarihi)));
	//sendSmsData("05382197344",$kontrolsiparisdata->musteri_ad.", ".$kontrolsiparisdata->merkez_adi." ".$kontrolsiparisdata->siparis_kodu." nolu siparişin kurulum planında değişiklik yapıldı. Eski Kurulum Tarihi : ".date("d.m.Y",strtotime($kontrolsiparisdata->kurulum_tarihi))." , Yeni Kurulum Tarihi : ".date("d.m.Y",strtotime($siparis->kurulum_tarihi)));


			}

		






			echo "<br><br>";
			

			echo "EĞİTMEN BİLGİLERİ";
			
 $egitmeninfo = "";
			foreach($egitmenlerd as $kullanicid) :   
				if(is_array( json_decode($siparis->egitim_ekip)) && in_array($kullanicid->kullanici_id, json_decode($siparis->egitim_ekip))){
				 	$egitmeninfo = $kullanicid->kullanici_ad_soyad;
					
				} 		 
				 endforeach; 
	
				 $kuruluminfo = "";
				 foreach($kurulumd as $kullanicid2) :   
					if(is_array( json_decode($siparis->kurulum_ekip)) && in_array($kullanicid2->kullanici_id, json_decode($siparis->kurulum_ekip))){
						$kuruluminfo .= $kullanicid2->kullanici_ad_soyad." ,";
					} 		 
					 endforeach; 
	

		 	foreach($egitmenlerd as $kullanicid3) :   
			if(is_array( json_decode($siparis->egitim_ekip)) && in_array($kullanicid3->kullanici_id, json_decode($siparis->egitim_ekip))){
				 
		sendSmsData(str_replace(" ","",$kullanicid3->kullanici_bireysel_iletisim_numarasi),
				"Sn. $kullanicid3->kullanici_ad_soyad, ".date("d.m.Y",strtotime($siparis->kurulum_tarihi))." tarihinde kurulumu yapılacak olan siparişin detayları aşağıda yer almaktadır.
			<br>\nSipariş Kodu : $siparis->siparis_kodu
			<br>Eğitmen : $egitmeninfo
			<br>Kurulum : $kuruluminfo
			<br>Adres : $siparis->ilce_adi / $siparis->sehir_adi
			"
				
			);
			 
				
			} 		 
			 endforeach; 



			 
			 echo "KURULUM EKİP BİLGİLERİ";
			 foreach($kurulumd as $kullanicid4) :   
				if(is_array( json_decode($siparis->kurulum_ekip)) && in_array($kullanicid4->kullanici_id, json_decode($siparis->kurulum_ekip))){
					sendSmsData(str_replace(" ","",$kullanicid4->kullanici_bireysel_iletisim_numarasi),
					"Sn. $kullanicid4->kullanici_ad_soyad, ".date("d.m.Y",strtotime($siparis->kurulum_tarihi))." tarihinde kurulumu yapılacak olan siparişin detayları aşağıda yer almaktadır.
				<br>\nSipariş Kodu : $siparis->siparis_kodu
				<br>Eğitmen : $egitmeninfo
				<br>Kurulum : $kuruluminfo
				<br>Adres : $siparis->ilce_adi / $siparis->sehir_adi
				"
					
				);
				} 		 
				 endforeach; 
redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
		//redirect(site_url('siparis/haftalik_kurulum_plan'));
	}

	public function save_egitim_programlama_view($id){
		yetki_kontrol("egitim_surecini_duzenle");
		$siparis = $this->Siparis_model->get_by_id($id); 
		$viewData['egitmenler'] =  $this->Kullanici_model->get_egitmen(["kullanici_departman_id"=>15,"kullanici_aktif",1]);
		$viewData['siparis'] = $siparis[0]; 
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
		
		$viewData["page"] = "siparis/egitim_programlama_form";
		$this->load->view('base_view',$viewData);
	}


	public function save_egitim_programlama($id){
		yetki_kontrol("egitim_surecini_duzenle");
		$this->db->where('siparis_id',$id);
			$this->db->update('siparisler',
				[
				"belirlenen_egitim_tarihi" => date("Y.m.d",strtotime($this->input->post("egitim_tarih"))),
				"egitim_ekip" => json_encode($this->input->post("egitim_ekip"))
				]);
		
		// Eğitim ekibine ertesi gün izin tipi 6 ile otomatik izin kaydı oluştur
		$egitim_tarihi = $this->input->post("egitim_tarih");
		$egitim_ekip = $this->input->post("egitim_ekip") ?? [];
		$siparis = $this->Siparis_model->get_by_id($id)[0];
		
		if(!empty($egitim_tarihi) && !empty($egitim_ekip) && is_array($egitim_ekip)){
			// Tarihi parse et (format: Y-m-d veya Y.m.d)
			$egitim_tarihi_parsed = str_replace('.', '-', $egitim_tarihi);
			$ertesi_gun = date('Y-m-d', strtotime($egitim_tarihi_parsed . ' +1 day'));
			$aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');
			
			foreach($egitim_ekip as $kullanici_id){
				if(!empty($kullanici_id)){
					// Aynı tarih ve kullanıcı için zaten izin kaydı var mı kontrol et
					$mevcut_izin = $this->db->where('izin_talep_eden_kullanici_id', $kullanici_id)
						->where('DATE(izin_baslangic_tarihi)', $ertesi_gun)
						->where('izin_neden_no', 6)
						->get('izin_talepleri')
						->row();
					
					if(!$mevcut_izin){
						// İzin kaydı oluştur
						$izin_data = [
							'izin_talep_eden_kullanici_id' => $kullanici_id,
							'izin_baslangic_tarihi' => $ertesi_gun . ' 08:00:00',
							'izin_bitis_tarihi' => $ertesi_gun . ' 17:00:00',
							'izin_neden_no' => 6,
							'amir_onay_durumu' => 1,
							'mudur_onay_durumu' => 1,
							'amir_onay_tarihi' => date('Y-m-d H:i:s'),
							'mudur_onay_tarihi' => date('Y-m-d H:i:s'),
							'amir_onay_kullanici_id' => $aktif_kullanici_id,
							'mudur_onay_kullanici_id' => $aktif_kullanici_id,
							'izin_notu' => 'Eğitim sonrası otomatik izin - Sipariş: ' . $siparis->siparis_kodu
						];
						$this->db->insert('izin_talepleri', $izin_data);
					}
				}
			}
		}
		
		redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				 
	}

	 public function add_ara_odeme($id){
		
		$insertData["siparis_ara_odeme_siparis_no"] = $id;
		$insertData["siparis_ara_odeme_miktar"] = $this->input->post("siparis_ara_odeme_miktar");
		$insertData["siparis_ara_odeme_tarih"] = date("Y-m-d",strtotime($this->input->post("siparis_ara_odeme_tarih")));
		$this->db->insert("siparis_ara_odemeler",$insertData);
		redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				 
	}
 public function delete_ara_odeme($id,$siparis_id){
		
		 
		$this->db->where("siparis_ara_odeme_id",$id)->delete("siparis_ara_odemeler");
		redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				 
	}
	public function get_siparisler($urun_id)
    {
         
        if (empty($urun_id) )
        {
            $data = array('status' => 'error', 'message' => 'Müşteri Bilgisi Alınamadı..!');
        }
        else
        {
            $renkler = $this->Siparis_model->get_all(["musteriler.musteri_id"=>$urun_id]);
            if ( $renkler)
            {
                $renkList = array();
                foreach ($renkler as $item) {
                    $renkList[] = array('id' => $item->siparis_id, 'siparis_kodu' => "Sipariş Kodu : ".$item->siparis_kodu, 'siparis_kayit_tarihi' => "Sipariş Tarihi : ".date("d.m.Y",strtotime($item->kayit_tarihi)));
                }
                $data = array('status' => 'ok', 'message' => '', 'data' => $renkList);
            }
            else
            {
                $data = array('status' => 'error', 'message' => 'Renk Bulunamadı..!');
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }






	public function tamamlanmayanlar_view() { 
		// Yönetim veya yetkili kullanıcılar tüm siparişleri görebilir
		// Satıcılar sadece kendi siparişlerini görebilir
		$current_user_id = $this->session->userdata("aktif_kullanici_id");
		$has_tum_siparis_yetki = goruntuleme_kontrol("tum_siparisleri_goruntule");
		
		// Belirli kullanıcılar veya yetki varsa erişim ver
		if($current_user_id == 37 || $current_user_id == 8 || $current_user_id == 1 || $current_user_id == 9 || $current_user_id == 7 || $has_tum_siparis_yetki){
			// Tüm siparişleri görebilir
		}else{
			// Satıcılar da kendi siparişlerini görebilir, erişim ver
		}

		$viewData["page"] = "siparis/uyari_list";
		$this->load->view('base_view',$viewData);
	}

	
	public function tamamlanmayanlar_ajax() {
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$search = $this->input->get('search')['value'];
		$order = $this->input->get('order')[0]['column'];
		$dir = $this->input->get('order')[0]['dir'];
		$current_user_id = $this->session->userdata('aktif_kullanici_id');
		 
		$has_permission = $this->db->where(['kullanici_id' => $current_user_id, 'yetki_kodu' => "tum_siparisleri_goruntule"])
								   ->count_all_results("kullanici_yetki_tanimlari") > 0;
		
		if (!$has_permission) {
			$this->db->where("siparisi_olusturan_kullanici", aktif_kullanici()->kullanici_id);
		}
		 
		if (!empty($search)) {
			$this->db->group_start()
					 ->like('siparis_kodu', $search)
					 ->or_like('musteri_ad', $search)
					 ->or_like('musteri_iletisim_numarasi', str_replace(" ", "", $search))
					 ->or_like('merkez_adi', $search)
					 ->or_like('kullanici_ad_soyad', $search)
					 ->or_like('sehir_adi', $search)
					 ->or_like('ilce_adi', $search)
					 ->group_end();
		}
		 
		$excluded_users = [1, 12, 11, 13];
		$this->db->where_not_in("siparisi_olusturan_kullanici", $excluded_users)
				 ->where("siparis_aktif", 1);
		 
		$query = $this->db->select('siparisler.*, kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id, merkezler.merkez_adi, merkezler.merkez_adresi, 
									musteriler.musteri_id, musteriler.musteri_ad, musteriler.musteri_iletisim_numarasi, 
									sehirler.sehir_adi, ilceler.ilce_adi, siparis_onay_hareketleri.adim_no')
						  ->from('siparisler')
						  ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
						  ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
						  ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id', 'left')
						  ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id', 'left')
						  ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici', 'left')
						  ->join('(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
								 'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1')
						  ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no')
						  ->order_by($order, $dir)
						  ->order_by('siparisler.siparis_id', 'DESC')
						  ->limit($limit, $start)
						  ->get();
		 
		$data = [];
		foreach ($query->result() as $row) {
			if ($row->adim_no > 11) continue;
	





			//************** */

			$kontroluruns = $this->Siparis_model->get_all_products_by_order_id($row->siparis_id); 

			$yenilenmis_cihaz_var_mi = 0;
			foreach ($kontroluruns as $ku) {
			  if($ku->yenilenmis_cihaz_mi == 1){
				$yenilenmis_cihaz_var_mi++;
			 
			  }
			}

 

			//******* */









			$gun = gunSayisiHesapla(date("d.m.Y"), date("d.m.Y", strtotime($row->kayit_tarihi)));
			$tgun = date("d.m.Y", strtotime($row->kurulum_tarihi));
			
			$urlcustom = base_url("siparis/report/") . urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE" . $row->siparis_id . "Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
			$musteri = '<a target="_blank" href="https://ugbusiness.com.tr/musteri/profil/' . $row->musteri_id . '"><i class="fa fa-user-circle" style="color: #035ab9;"></i> ' . $row->musteri_ad . '</a>';
	
			if($yenilenmis_cihaz_var_mi>0){
				$musteri .= "<span style='margin-left: 10px; border-radius: 6px; padding: 5px; padding-bottom: 2px; padding-top: 2px;' class='bg-success '>Yenilenmiş Cihaz";
			}


			$durum = ($row->adim_no > 11) ? "<i class='fas fa-check-circle text-success'></i><span class='text-success'>Teslim Edildi</span><br>" 
					: (($gun > 0) ? '<span style="color:red;">(' . $gun . ' gün önce)</span>' . (($row->kayit_tarihi !== $row->kurulum_tarihi) ? '<span style="color:green;">(Belirlenen Kurulum Tarihi : ' . $tgun . ' )</span>' : '')
					: '<span class="text-success">(Bugün oluşturuldu)</span>');
			
			$adres = ($row->merkez_adresi == "" || $row->merkez_adresi == "." || $row->merkez_adresi == "0") 
					 ? '<span style="opacity:0.4;">BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>' 
					 : '<span title="' . $row->merkez_adresi . '">' . substr($row->merkez_adresi, 0, 90) . (strlen($row->merkez_adresi) > 90 ? "..." : "") . '</span>';
			
			$data[] = [
				"<b style='cursor: pointer;' onclick='showWindow(\"$urlcustom\");'>$row->siparis_kodu</b><br><span style='font-weight:normal'>" . date('d.m.Y H:i', strtotime($row->kayit_tarihi)) . "</span><br><a class='btn btn-dark' target='_blank' href='".base_url("kullanici/profil_new/$row->kullanici_id")."?subpage=ozluk-dosyasi'><i class='fa fa-user'></i> $row->kullanici_ad_soyad</a>",
				"<b>$musteri</b><br><span style='font-weight:normal'>İletişim : " . formatTelephoneNumber($row->musteri_iletisim_numarasi) . "</span><br>$durum".'<br><span class="text-orange" style="width: 354px; text-wrap: auto; display: block;">'.$row->siparis_gorusme_aciklama." ".($row->siparis_gorusme_aciklama_guncelleme_tarihi != null ? " <span style='color:black;font-size:11px;opacity:0.5;'>( ".date("d.m.Y H:i",strtotime($row->siparis_gorusme_aciklama_guncelleme_tarihi))." )</span>" : "").'</span>',
				"<b>$row->merkez_adi</b> / $row->sehir_adi ($row->ilce_adi)<br>$adres",
				"<a type='button' onclick='showWindow(\"$urlcustom\");' class='btn btn-warning btn-xs'><i class='fa fa-pen'></i> Düzenle</a>"
			];
		}
		 
		echo json_encode([
			"draw" => intval($this->input->get('draw')),
			"recordsTotal" => count($data),
			"recordsFiltered" => count($data),
			"data" => $data
		]);
	}























	public function siparisler_ajax() { 
		 
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order_column = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];
		
		// Column mapping
		$columns = [
			0 => 'siparisler.siparis_id',
			1 => 'musteriler.musteri_ad',
			2 => 'merkezler.merkez_adi',
			3 => 'kullanicilar.kullanici_ad_soyad'
		];
		$order = isset($columns[$order_column]) ? $columns[$order_column] : 'siparisler.siparis_id';
		
		// Filtre parametreleri
		$sehir_id = $this->input->get('sehir_id');
		$kullanici_id = $this->input->get('kullanici_id');
		$tarih_baslangic = $this->input->get('tarih_baslangic');
		$tarih_bitis = $this->input->get('tarih_bitis');
		$teslim_durumu = $this->input->get('teslim_durumu');

		
		$response = false;
		$current_user_id =  $this->session->userdata('aktif_kullanici_id');
	   
		$query = $this->db->get_where("kullanici_yetki_tanimlari",array('kullanici_id' => $current_user_id,'yetki_kodu' => "tum_siparisleri_goruntule"));
		if($query && $query->num_rows()){
		  $response = true;
		}
  
		   if(!$response){
			  $this->db->where(["siparisi_olusturan_kullanici"=>aktif_kullanici()->kullanici_id]);
		  }
       
		 if(!empty($search)) {
			$this->db->group_start();
            $this->db->like('siparis_kodu', $search); 
            $this->db->or_like('musteri_ad', $search);   
			 $this->db->or_like('musteri_iletisim_numarasi', str_replace(" ","",$search)); 
			 $this->db->or_like('merkez_adi', $search); 
			 $this->db->or_like('kullanici_ad_soyad', $search); 
			 $this->db->or_like('sehir_adi', $search); 
			 $this->db->or_like('ilce_adi', $search); 
			 $this->db->group_end();
        }

		// Filtreler
		if(!empty($sehir_id)){
			$this->db->where('merkezler.merkez_il_id', $sehir_id);
		}
		
		if(!empty($kullanici_id)){
			$this->db->where('siparisler.siparisi_olusturan_kullanici', $kullanici_id);
		}
		
		if(!empty($tarih_baslangic)){
			$this->db->where('DATE(siparisler.kayit_tarihi) >=', $tarih_baslangic);
		}
		
		if(!empty($tarih_bitis)){
			$this->db->where('DATE(siparisler.kayit_tarihi) <=', $tarih_bitis);
		}

	
     

		$this->db->where(["siparisi_olusturan_kullanici !="=>1]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>12]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>11]);

		$this->db->where(["siparisi_olusturan_kullanici !="=>13]);
		$this->db->where(["siparis_aktif"=>1]);
		
		// Teslim durumu filtresi
		if($teslim_durumu !== '' && $teslim_durumu !== null){
			if($teslim_durumu == '1'){ // Teslim edildi
				$this->db->where('siparis_onay_hareketleri.adim_no >', 11);
			} elseif($teslim_durumu == '0'){ // Teslim edilmedi
				$this->db->group_start();
				$this->db->where('siparis_onay_hareketleri.adim_no IS NULL');
				$this->db->or_where('siparis_onay_hareketleri.adim_no <=', 11);
				$this->db->group_end();
			}
		}
		
	   $query = $this->db
		   ->select('siparisler.*,kullanicilar.kullanici_ad_soyad, merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_ulke_id,ulkeler.ulke_adi, musteriler.musteri_id, musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi,musteriler.musteri_sabit_numara, sehirler.sehir_adi, ilceler.ilce_adi,siparis_onay_hareketleri.adim_no')
		   ->from('siparisler')
		   ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
		   ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
		   ->join('ulkeler', 'ulkeler.ulke_id = merkezler.merkez_ulke_id','left')
		   ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id','left')
		   ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id','left')
		   ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
		   ->join(
			'(SELECT siparis_no, adim_no, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num FROM siparis_onay_hareketleri) as siparis_onay_hareketleri ',
			 'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1', 'left'
		 )
		 ->order_by($order, $dir)
		   ->limit($limit, $start)
		   ->get();
					 
				

                      

       
		   $data = [];
		   foreach ($query->result() as $row) {
   if($current_user_id == 2 && $row->siparis_id == 2687){
continue;
   }
			   
			   $urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$row->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
			   $musteri = '<a target="_blank" style="font-weight: 500;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';     
   
			   if($row->merkez_ulke_id == 190){
				$bilgi = "<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->sehir_adi." (".$row->ilce_adi.")"."</span><br>";
			}else{
				$bilgi = "<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->ulke_adi."<br>";
			}
			   $data[] = [
				   '<a href="#"  onclick="showWindow(\''.$urlcustom.'\');">'.$row->siparis_kodu."</a><br><span style='font-weight:normal'>".date('d.m.Y H:i',strtotime($row->kayit_tarihi))."</span>",
				   "<b>".$musteri."</b>".($row->adim_no>11 ? " <i class='fas fa-check-circle text-success'></i><span class='text-success'>Teslim Edildi</span>":'<span style="margin-left:10px;opacity:0.5">Teslim Edilmedi</span>')."<br>"."<span style='font-weight:normal'>İletişim : ".formatTelephoneNumber($row->musteri_iletisim_numarasi).(($row->musteri_sabit_numara != "" ? " / Sabit No : ".$row->musteri_sabit_numara : ""))."</span>", 
				   $bilgi.(($row->merkez_adresi == "" || $row->merkez_adresi == "." || $row->merkez_adresi == "0") ? '<span style="opacity:0.4;font-weight:normal">BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>' : "<span title='".$row->merkez_adresi."' style='font-weight:normal'>".substr($row->merkez_adresi,0,90).(strlen($row->merkez_adresi)>90 ? "...":"")."...</span>"),
			   
				   $row->kullanici_ad_soyad,
			   
				   '
				   <a type="button" onclick="showWindow(\''.$urlcustom.'\');"    class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
					 '
			   
				 
			   ];
		   }
       
        // Filtered count hesapla (tüm filtrelerle)
		$this->db->reset_query();
		if(!$response){
			$this->db->where(["siparisi_olusturan_kullanici"=>aktif_kullanici()->kullanici_id]);
		}
		
		if(!empty($search)) {
			$this->db->group_start();
			$this->db->like('siparis_kodu', $search); 
			$this->db->or_like('musteri_ad', $search);   
			$this->db->or_like('musteri_iletisim_numarasi', str_replace(" ","",$search)); 
			$this->db->or_like('merkez_adi', $search); 
			$this->db->or_like('kullanici_ad_soyad', $search); 
			$this->db->or_like('sehir_adi', $search); 
			$this->db->or_like('ilce_adi', $search); 
			$this->db->group_end();
		}
		
		if(!empty($sehir_id)){
			$this->db->where('merkezler.merkez_il_id', $sehir_id);
		}
		
		if(!empty($kullanici_id)){
			$this->db->where('siparisler.siparisi_olusturan_kullanici', $kullanici_id);
		}
		
		if(!empty($tarih_baslangic)){
			$this->db->where('DATE(siparisler.kayit_tarihi) >=', $tarih_baslangic);
		}
		
		if(!empty($tarih_bitis)){
			$this->db->where('DATE(siparisler.kayit_tarihi) <=', $tarih_bitis);
		}
		
		// Teslim durumu filtresi - Sadece filtre seçildiyse uygula
		if($teslim_durumu !== '' && $teslim_durumu !== null){
			if($teslim_durumu == '1'){ // Teslim edildi
				$this->db->where('siparis_onay_hareketleri.adim_no >', 11);
			} elseif($teslim_durumu == '0'){ // Teslim edilmedi
				$this->db->group_start();
				$this->db->where('siparis_onay_hareketleri.adim_no IS NULL');
				$this->db->or_where('siparis_onay_hareketleri.adim_no <=', 11);
				$this->db->group_end();
			}
		}
		
		$this->db->where(["siparisi_olusturan_kullanici !="=>1]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>12]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>11]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>13]);
		$this->db->where(["siparis_aktif"=>1]);
		
		$filtered_count = $this->db->select('COUNT(DISTINCT siparisler.siparis_id) as total', false)
			->from('siparisler')
			->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
			->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
			->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id', 'left')
			->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id', 'left')
			->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
			->join(
				'(SELECT siparis_no, adim_no, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num FROM siparis_onay_hareketleri) as siparis_onay_hareketleri ',
				'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1', 'left'
			)
			->get()
			->row()
			->total;
		
		// Total count hesapla (join'lerle birlikte, filtreler olmadan)
		$this->db->reset_query();
		if(!$response){
			$this->db->where(["siparisi_olusturan_kullanici"=>aktif_kullanici()->kullanici_id]);
		}
		$this->db->where(["siparisi_olusturan_kullanici !="=>1]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>12]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>11]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>13]);
		$this->db->where(["siparis_aktif"=>1]);
		$totalData = $this->db->select('COUNT(DISTINCT siparisler.siparis_id) as total', false)
			->from('siparisler')
			->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
			->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
			->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id', 'left')
			->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id', 'left')
			->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
			->join(
				'(SELECT siparis_no, adim_no, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num FROM siparis_onay_hareketleri) as siparis_onay_hareketleri ',
				'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1', 'left'
			)
			->get()
			->row()
			->total;
		
        // Filtered count doğru hesaplanmış olmalı - pagination için gerekli
        $totalFiltered = $filtered_count;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
    }



	public function ikincismsat($siparis_id) { 
		
		$siparis =  $this->Siparis_model->get_by_id($siparis_id);
		if($siparis[0]->musteri_degerlendirme_sms2 == 1){
			echo "Bu sipariş için 2. SMS zaten gönderildi.";

			$this->session->set_flashdata('flashDanger', "Bu sipariş için 2. SMS zaten gönderildi.");
            redirect($_SERVER['HTTP_REFERER']);
		}else{
			 
			degerlendirme_sms2_gonder($siparis_id);
			$this->session->set_flashdata('flashSuccess', "Müşteriye 2. Değerlendirme SMS gönderilmiştir.");
            redirect($_SERVER['HTTP_REFERER']);


		}
		
		 
	}


	public function degerlendirmeistemiyor($siparis_id) { 
		
		$this->db->where("siparis_id",$siparis_id)->update("siparisler",["degerlendirme_istemiyor"=>1]);
 
		$this->session->set_flashdata('flashSuccess', "Bu müşteri değerlendirmek yapmak istemiyor olarak işaretlendi.");
        redirect($_SERVER['HTTP_REFERER']);
		 
	}

	public function sms_gonderilen_siparisler() { 
		 
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

		
		$response = true;
		 
		   
       
		 if(!empty($search)) {
			$this->db->group_start();
            $this->db->like('siparis_kodu', $search); 
            $this->db->or_like('musteri_ad', $search);   
			 $this->db->or_like('musteri_iletisim_numarasi', str_replace(" ","",$search)); 
			 $this->db->or_like('merkez_adi', $search); 
			 $this->db->or_like('kullanici_ad_soyad', $search); 
			 $this->db->or_like('sehir_adi', $search); 
			 $this->db->or_like('ilce_adi', $search); 
			 $this->db->group_end();
        }

	
      
    
 
		$this->db->where(["siparis_aktif"=>1]);
		$this->db->where(["musteri_degerlendirme_sms"=>1]);
		if($this->session->userdata('aktif_kullanici_id') == 14){
			$this->db->where(["degerlendirme_soru_1"=>0]);
			$this->db->where(["musteri_degerlendirme_sms2"=>0]);
			$this->db->where(["degerlendirme_istemiyor"=>0]);
		}
	   $query = $this->db
		   ->select('siparisler.*,kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_id, merkezler.merkez_adi,merkezler.merkez_adresi, musteriler.musteri_id, musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi, sehirler.sehir_adi, ilceler.ilce_adi')
		   ->from('siparisler')
		   ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no','left')
		   ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id','left')
		   ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id','left')
		   ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id','left')
		   ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
		   
		 ->order_by($order, $dir)
		  
		 ->order_by('siparisler.degerlendirme_sms_gonderim_tarihi', 'DESC')
		  
		   ->limit($limit, $start)
		   ->get();
					 
				

                      

        $data = [];
		$rr = $query->result();
        foreach ($rr as $row) {

			$urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$row->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
			$musteri = '<a target="_blank" style="font-weight: 500;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';     

			$ikincisms 				= base_url("siparis/ikincismsat/").$row->siparis_id;
			$degerlendirmeistemiyor = base_url("siparis/degerlendirmeistemiyor/").$row->siparis_id;
		
			$color1 = ($row->degerlendirme_soru_1 < 2)  ? "danger" : (($row->degerlendirme_soru_1 < 5)  ? "warning" : "success");
			$color2 = ($row->degerlendirme_soru_2 < 2)   ? "danger" : (($row->degerlendirme_soru_2 < 5)   ? "warning" : "success");
			$color3 = ($row->degerlendirme_soru_3 < 2)   ? "danger" : (($row->degerlendirme_soru_3 < 5)   ? "warning" : "success");
			$color4 = ($row->degerlendirme_soru_4 < 2) ? "danger" : (($row->degerlendirme_soru_4 < 5) ? "warning" : "success");

			if($row->degerlendirme_soru_1 == 1 || $row->degerlendirme_soru_2 == 1 || $row->degerlendirme_soru_3 == 1 || $row->degerlendirme_soru_4 == 1){
				$textcoloroneri = "text-danger";
			}else {
				if($row->degerlendirme_soru_1 < 5 || $row->degerlendirme_soru_2 < 5 || $row->degerlendirme_soru_3 < 5 || $row->degerlendirme_soru_4 < 5){
					$textcoloroneri = "text-orange";
				}else{
					$textcoloroneri = "text-success";
				}
			}

            $data[] = [
                '<b><a '.(($row->degerlendirme_soru_1 > 0) ? 'class="d-none"' : '').' onclick="confirm_action(\'2. SMS İşlemini Onayla\', \'Bu müşteriye 2.Sipariş Değerlendirme SMS atmak istediğinize emin misiniz? Bu işlem geri alınamaz.\', \'Onayla\', \'' . $ikincisms . '\');" class="btn btn-warning btn-xs">TEKRAR SMS GÖNDER</a><br>
				<a '.(($row->degerlendirme_soru_1 > 0) ? 'class="d-none"' : '').' onclick="confirm_action(\'İşlemi Onayla\', \'Bu müşteriyi DEĞERLENDİRME YAPMAK İSTEMİYOR şeklinde sonlandırmak istediğinize emin misiniz? Bu işlem geri alınamaz.\', \'Onayla\', \'' . $degerlendirmeistemiyor . '\');" class="btn btn-danger btn-xs">DEĞERLENDİRME İSTEMİYOR</a><br>
				<a href="" onclick="showWindow(\''.$urlcustom.'\');">'.$row->siparis_kodu.'</a></b><br><span style="font-weight:normal">1.SMS Tarihi : '.date('d.m.Y H:i',strtotime($row->degerlendirme_sms_gonderim_tarihi)).'</span>'.'<br><span style="font-weight:normal">2.SMS Tarihi : '.(($row->degerlendirme_sms2_gonderim_tarihi != $row->kayit_tarihi) ? date('d.m.Y H:i',strtotime($row->degerlendirme_sms2_gonderim_tarihi)) : "-").'</span>',
                "<b>".$musteri."</b><br>"."<span style='font-weight:normal'>".formatTelephoneNumber($row->musteri_iletisim_numarasi)."</span>", 
				"<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->sehir_adi." (".$row->ilce_adi.")",
			
				($row->kullanici_id != 1 ? $row->kullanici_ad_soyad : "<span style='opacity:0.6'>Eski Kayıt</span>"),
				($row->degerlendirme_soru_1 > 0 ? "<span class='btn btn-$color1 btn-xs' title='Teknik servis ekibimizin size karşı hitap ve davranışlarını değerlendirin.' style='display: block;margin:auto;margin-top:5px;width:25px;'>".$row->degerlendirme_soru_1."</span>" : "<span style='opacity:0.5'>Beklemede</span>"),
				($row->degerlendirme_soru_2 > 0 ? "<span class='btn btn-$color2 btn-xs' title='Eğitmenin size karşı hitap ve davranışlarını değerlendirin.' style='display: block;margin:auto;margin-top:5px;width:25px;'>".$row->degerlendirme_soru_2."</span>" : "<span style='opacity:0.5'>Beklemede</span>"),
				($row->degerlendirme_soru_3 > 0 ? "<span class='btn btn-$color3 btn-xs' title='Sorularınız net ve eksiksiz cevaplandı mı?' style='display: block;margin:auto;margin-top:5px;width:25px;'>".$row->degerlendirme_soru_3."</span>" : "<span style='opacity:0.5'>Beklemede</span>"),
				($row->degerlendirme_soru_4 > 0 ? "<span class='btn btn-$color4 btn-xs' title='Bizi tavsiye eder misiniz?' style='display: block;margin:auto;margin-top:5px;width:25px;'>".$row->degerlendirme_soru_4."</span>" : "<span style='opacity:0.5'>Beklemede</span>"),
				($row->degerlendirme_soru_4 > 0 ? "<span>".($row->degerlendirme_oneri != "" ? "<span class='".$textcoloroneri."'>".$row->degerlendirme_oneri."</span>" : "<span style='opacity:0.4'>".mb_ucwords($row->musteri_ad)." adlı müşteri tarafından öneri bilgisi girilmemiştir.</span>") ."</span>" : "<span style='opacity:0.5'>Beklemede</span>")
				 
			  
			];
        }
       
        $totalData = count($this->db->where("siparis_aktif",1)->where("musteri_degerlendirme_sms",1)->get("siparisler")->result());
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
    }






	private function siparis_bildirimi_gonder($siparis_id, $siparis_kod_format, $url, $alici_id)
    {
        // Bildirim tipini getir, yoksa oluştur ve ID'sini al
        $bildirim_tipi = $this->db
            ->where('ad', 'Satış Bildirimi')
            ->get('bildirim_tipleri')
            ->row();

        if (!$bildirim_tipi) {
            $this->db->insert('bildirim_tipleri', [
                'ad' => 'Satış Bildirimi',
                'gereken_onay_seviyesi' => 2,
                'aciklama' => 'Yeni sipariş kayıtları için müdür onayı gerekir'
            ]);
            $tip_id = $this->db->insert_id();
        } else {
            $tip_id = $bildirim_tipi->id;
        }

        // Sipariş bilgisi
        $siparis = $this->db
            ->where('siparis_id', $siparis_id)
            ->get('siparisler')
            ->row();

        // Merkez bilgisi
        $merkez_adi = '';
        if($siparis && !empty($siparis->merkez_no)){
            $merkez = $this->db->where('merkez_id', $siparis->merkez_no)->get('merkezler')->row();
            if($merkez){
                $merkez_adi = $merkez->merkez_adi;
            }
        }

        // Gönderen kullanıcı
        $gonderen_id = $this->session->userdata('aktif_kullanici_id');
        $gonderen = aktif_kullanici();

        // Mesaj
        $baslik = 'Yeni Sipariş Kaydı';
        $mesaj = ($gonderen ? $gonderen->kullanici_ad_soyad : 'Bir kullanıcı') . ' tarafından yeni bir sipariş kaydı oluşturuldu.';
        $mesaj .= "\n\nSipariş Kodu: " . $siparis_kod_format;
        if($merkez_adi && $merkez_adi != '#NULL#'){
            $mesaj .= "\nMerkez: " . $merkez_adi;
        }
        if($siparis && !empty($siparis->kayit_tarihi)){
            $mesaj .= "\nKayıt Tarihi: " . date('d.m.Y H:i', strtotime($siparis->kayit_tarihi));
        } else {
            $mesaj .= "\nTarih: " . date('d.m.Y H:i');
        }
        $mesaj .= "\n\nDetay: " . $url;

        // Bildirim oluştur
        $this->db->insert('sistem_bildirimleri', [
            'tip_id' => $tip_id,
            'gonderen_id' => $gonderen_id,
            'baslik' => $baslik,
            'mesaj' => $mesaj,
            'okundu' => 0,
            'onay_durumu' => 'pending'
        ]);
        $bildirim_id = $this->db->insert_id();

        // Alıcı ilişkisi
        $this->db->insert('sistem_bildirim_alicilar', [
            'bildirim_id' => $bildirim_id,
            'alici_id' => $alici_id,
            'okundu' => 0
        ]);

        // Hareket kaydı
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $bildirim_id,
            'kullanici_id' => $gonderen_id,
            'hareket_tipi' => 'gonderildi',
            'aciklama' => 'Sipariş bildirimi gönderildi - ' . $siparis_kod_format
        ]);
    }

    public function siparis_kisa_yollar()
    {
        // Sadece kullanıcı id 1 görebilir
        if($this->session->userdata('aktif_kullanici_id') != 1) {
            $this->session->set_flashdata('flashDanger', 'Bu sayfaya erişim yetkiniz bulunmamaktadır.');
            redirect(base_url());
        }
        
        // Aktif kullanıcının departmanını kontrol et
        $aktif_kullanici = aktif_kullanici();
        $is_yonetim = false;
        if(isset($aktif_kullanici->departman_adi)){
            $departman_adi = strtolower(trim($aktif_kullanici->departman_adi));
            if($departman_adi == 'yönetim' || strpos($departman_adi, 'yönetim') !== false){
                $is_yonetim = true;
            }
        }
        $viewData["is_yonetim"] = $is_yonetim;
        
        // Filtreler için veriler
        $viewData["sehirler"] = $this->Sehir_model->get_all();
        $viewData["kullanicilar"] = $this->db
            ->where("kullanici_aktif", 1)
            ->group_start()
                ->where_in("kullanici_departman_id", [12, 17, 18])
                ->or_where_in("kullanici_id", [2, 9])
            ->group_end()
            ->order_by("kullanici_ad_soyad", "ASC")
            ->get("kullanicilar")
            ->result();
        
        // Seçili filtreler
        $selected_sehir_id = $this->input->get('sehir_id');
        $selected_kullanici_id = $this->input->get('kullanici_id');
        $selected_tarih_baslangic = $this->input->get('tarih_baslangic');
        $selected_tarih_bitis = $this->input->get('tarih_bitis');
        $selected_teslim_durumu = $this->input->get('teslim_durumu');
        
        $viewData["selected_sehir_id"] = $selected_sehir_id;
        $viewData["selected_kullanici_id"] = $selected_kullanici_id;
        $viewData["selected_tarih_baslangic"] = $selected_tarih_baslangic;
        $viewData["selected_tarih_bitis"] = $selected_tarih_bitis;
        $viewData["selected_teslim_durumu"] = $selected_teslim_durumu;
        
        // Sipariş verilerini çek
        $response = false;
        $current_user_id = $this->session->userdata('aktif_kullanici_id');
        $query = $this->db->get_where("kullanici_yetki_tanimlari",array('kullanici_id' => $current_user_id,'yetki_kodu' => "tum_siparisleri_goruntule"));
        if($query && $query->num_rows()){
            $response = true;
        }
        
        if(!$response){
            $this->db->where(["siparisi_olusturan_kullanici"=>aktif_kullanici()->kullanici_id]);
        }
        
        // Filtreler
        if(!empty($selected_sehir_id)){
            $this->db->where('merkezler.merkez_il_id', $selected_sehir_id);
        }
        
        if(!empty($selected_kullanici_id)){
            $this->db->where('siparisler.siparisi_olusturan_kullanici', $selected_kullanici_id);
        }
        
        if(!empty($selected_tarih_baslangic)){
            $this->db->where('DATE(siparisler.kayit_tarihi) >=', $selected_tarih_baslangic);
        }
        
        if(!empty($selected_tarih_bitis)){
            $this->db->where('DATE(siparisler.kayit_tarihi) <=', $selected_tarih_bitis);
        }
        
        $this->db->where(["siparisi_olusturan_kullanici !="=>1]);
        $this->db->where(["siparisi_olusturan_kullanici !="=>12]);
        $this->db->where(["siparisi_olusturan_kullanici !="=>11]);
        $this->db->where(["siparisi_olusturan_kullanici !="=>13]);
        $this->db->where(["siparis_aktif"=>1]);
        
        // Teslim durumu filtresi
        if($selected_teslim_durumu !== '' && $selected_teslim_durumu !== null){
            if($selected_teslim_durumu == '1'){ // Teslim edildi
                $this->db->where('siparis_onay_hareketleri.adim_no >', 11);
            } elseif($selected_teslim_durumu == '0'){ // Teslim edilmedi
                $this->db->group_start();
                $this->db->where('siparis_onay_hareketleri.adim_no IS NULL');
                $this->db->or_where('siparis_onay_hareketleri.adim_no <=', 11);
                $this->db->group_end();
            }
        }
        
        $siparisler = $this->db
            ->select('siparisler.*,kullanicilar.kullanici_ad_soyad, merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_ulke_id,ulkeler.ulke_adi, musteriler.musteri_id, musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi,musteriler.musteri_sabit_numara, sehirler.sehir_adi, ilceler.ilce_adi,siparis_onay_hareketleri.adim_no')
            ->from('siparisler')
            ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
            ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
            ->join('ulkeler', 'ulkeler.ulke_id = merkezler.merkez_ulke_id','left')
            ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id','left')
            ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id','left')
            ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
            ->join(
                '(SELECT siparis_no, adim_no, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num FROM siparis_onay_hareketleri) as siparis_onay_hareketleri ',
                'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1', 'left'
            )
            ->order_by('siparisler.siparis_id', 'DESC')
            ->get()
            ->result();
        
        $viewData["siparisler"] = $siparisler;
        
        $viewData["page"] = "siparis/kisa_yollar";
        $this->load->view('base_view', $viewData);
    }

    public function demo_on_izleme()
    {
        // Sadece kullanıcı id 1 görebilir
        if($this->session->userdata('aktif_kullanici_id') != 1) {
            $this->session->set_flashdata('flashDanger', 'Bu sayfaya erişim yetkiniz bulunmamaktadır.');
            redirect(base_url());
        }
        
        $viewData["page"] = "demo/on_izleme";
        $this->load->view('base_view', $viewData);
    }


}
