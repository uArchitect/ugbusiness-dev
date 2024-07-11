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
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index($onay_bekleyenler = false)
	{ 
		if(goruntuleme_kontrol("tum_siparisleri_goruntule")){
			
			$data = $this->Siparis_model->get_all(); 
		}else{
		
			$data = $this->Siparis_model->get_all(["siparisi_olusturan_kullanici"=>$this->session->userdata('aktif_kullanici_id')]); 
		}
       
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
		yetki_kontrol("haftalik_kurulum_plan_goruntule");
	
			$weeklyOrders = $this->Siparis_model->get_all(["kurulum_tarihi >=" => date('Y-m-d 00:00:00', strtotime('last monday'))],["kurulum_tarihi <=" => date('Y-m-d 23:59:59', strtotime('next sunday'))]);

			foreach ($weeklyOrders as $order) {
			$dayOfWeek = date('N', strtotime($order->kurulum_tarihi)); // Günün haftadaki sırasını al
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
		$current_user_id =  $this->session->userdata('aktif_kullanici_id');
		$query = $this->db->select("yetki_kodu")->get_where("kullanici_yetki_tanimlari",array('kullanici_id' => $current_user_id));
		 $filter = array();
		for ($i=2; $i <= 12  ; $i++) { 
			if(array_search("siparis_onay_".$i, array_column($query->result(), 'yetki_kodu')) !== false){
				$filter[] = $i-1;
			}
		} 
		
		$viewData["onay_bekleyen_siparisler"] = $this->Siparis_model->get_all_waiting($filter);
		$viewData["page"] = "siparis/list";

	$islemdekiler_sayi = $this->db->query('SELECT * FROM siparisler where beklemede = 0 and siparisi_olusturan_kullanici != 12 and siparisi_olusturan_kullanici != 1');
	$viewData["islemdekiler_sayi"] = $islemdekiler_sayi->num_rows();

	$bekleyenler_sayi = $this->db->query('SELECT * FROM siparisler where beklemede = 1');
	$viewData["bekleyenler_sayi"] = $bekleyenler_sayi->num_rows();


		
		$this->load->view('base_view',$viewData);
	}
	public function add($merkez_id)
	{   




		$check_id = $this->Merkez_model->get_by_id($merkez_id); 
        if($check_id){  
            $viewData["page"] = "siparis/form";
			$viewData["urunler"] = $this->Urun_model->get_all(["harici_cihaz"=>0]);
			$viewData["merkez"] = $check_id;
			 
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
		$id = urldecode(str_replace("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE","",base64_decode($id)));
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
			$viewData['egitmenler'] =  $this->Kullanici_model->get_egitmen(["kullanici_departman_id"=>15]);
			$viewData['kurulum_kullanicilari'] =  $this->Kullanici_model->get_all(["kurulum_ekip_durumu"=>1]);
			$viewData['basliklar_data'] =  $this->Urun_model->get_basliklar();
			$viewData['guncel_adim'] = $hareketler[count($hareketler)-1]->adim_no+1;
	
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

 	public function siparis_onayla($id)
	{  
			
		$hareketler =  $this->Siparis_model->get_all_actions_by_order_id($id);
		$guncel_adim = $hareketler[count($hareketler)-1]->adim_no+1;
		$urunler =  $this->Siparis_model->get_all_products_by_order_id($id);
		$siparis =  $this->Siparis_model->get_by_id($id);
	 

		if($guncel_adim == 3){
			$currentuser = aktif_kullanici();
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
						"acilis_ekrani" => $this->input->post("urun_acilis_ekran".$urun->siparis_urun_id)
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
			
			 	// SERINO KONTROL**************************************
				// SERINO KONTROL**************************************
				// SERINO KONTROL**************************************


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
		}

		if($guncel_adim == 10){	
			$this->db->where('siparis_id',$id);
			$this->db->update('siparisler',
				[
				"belirlenen_egitim_tarihi" => date("Y.m.d",strtotime($this->input->post("egitim_tarih"))),
				"egitim_ekip" => json_encode($this->input->post("egitim_ekip")),
				"egitim_var_mi" => $this->input->post("egitim_var_mi2")
				]);
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
				sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no,"Sn. ".$kullanici_data->kullanici_ad_soyad." ".date("d.m.Y H:i")." tarihinde işlem yapılan ".$siparis[0]->siparis_kodu." no'lu sipariş ".$adim_ad." aşaması için sizden onay beklemektedir. Siparişi onaylamak için : https://ugbusiness.com.tr/onay-bekleyen-siparisler");
			}
		}
	 

		/*if($guncel_adim == 4){
			$siparis_onay_hareket["siparis_no"] =  $id;
			$siparis_onay_hareket["adim_no"] =  5;
			$siparis_onay_hareket["onay_durum"] =  1;
			$siparis_onay_hareket["onay_aciklama"] =  "Sistem tarafından otomatik onaylanmıştır.";
			$siparis_onay_hareket["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');
			$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
		}
		*/

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
			}
		}

		redirect(site_url('onay-bekleyen-siparisler'));
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
		

		sendSmsData("05382197344","SİPARİŞ BİLDİRİMİ\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından yeni sipariş kaydı oluşturulmuştur.");
		sendSmsData("05468311015","SİPARİŞ BİLDİRİMİ\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından yeni sipariş kaydı oluşturulmuştur.");
		sendSmsData("05453950049","SİPARİŞ BİLDİRİMİ\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından yeni sipariş kaydı oluşturulmuştur.");
		 

		$queryq = $this->db->where("yetki_kodu","siparis_onay_3")
		->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
		->get("kullanici_yetki_tanimlari");
		$dkul = $queryq->result();
		if($dkul){
			foreach ($dkul as $kullanici_data) {

			if(aktif_kullanici()->kullanici_yonetici_kullanici_id == $kullanici_data->kullanici_id){
				sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no,"Sn. ".$kullanici_data->kullanici_ad_soyad." ".date("d.m.Y H:i")." tarihinde işlem yapılan ".$siparis_kod_format." no'lu sipariş sizden satış onayı beklemektedir. Siparişi onaylamak için : https://ugbusiness.com.tr/onay-bekleyen-siparisler");
			}
					 
		}
		}


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
			$siparis_urun["basliklar"]		= base64_decode($data->baslik[$i]);
			
			$siparis_urun["siparis_urun_notu"] 	= $data->siparis_notu[$i];
			$this->Siparis_urun_model->insert($siparis_urun);

			
			
		}	 

		 
			redirect(site_url('siparis/report/'.$siparis_kodu));


		redirect(site_url('siparisler'));
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
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
		
		$viewData["page"] = "siparis/siparis_detay_duzenle";
		$this->load->view('base_view',$viewData);
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
		foreach ($urunler as $urun) {	
			$this->db->where('siparis_urun_id', $urun->siparis_urun_id);
			$this->db->update('siparis_urunleri',
				[
					"damla_etiket" => $this->input->post("urun_damla_etiket".$urun->siparis_urun_id),
					"acilis_ekrani" => $this->input->post("urun_acilis_ekran".$urun->siparis_urun_id),
					"basliklar"   => json_encode($this->input->post("baslik_select")),
					"renk" => $this->input->post("urun_renk".$urun->siparis_urun_id)
					
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
			
		 
			$this->db->update('siparis_urunleri',
				[
					"damla_etiket" => $this->input->post("urun_damla_etiket".$urun->siparis_urun_id),
					"acilis_ekrani" => $this->input->post("urun_acilis_ekran".$urun->siparis_urun_id),
					"satis_fiyati" 	 => str_replace(',','', str_replace('₺', '', $this->input->post("urun_satis_fiyati_".$urun->siparis_urun_id))),
					"pesinat_fiyati" => str_replace(',','', str_replace('₺', '', $this->input->post("urun_pesinat_fiyati_".$urun->siparis_urun_id))),
					"kapora_fiyati"  => str_replace(',','', str_replace('₺', '', $this->input->post("urun_kapora_fiyati_".$urun->siparis_urun_id))),
					"fatura_tutari"  => str_replace(',','', str_replace('₺', '', $this->input->post("urun_fatura_tutari_".$urun->siparis_urun_id))),
					"takas_bedeli"   => str_replace(',','', str_replace('₺', '', $this->input->post("urun_takas_bedeli_".$urun->siparis_urun_id))),
					"basliklar"   => json_encode($this->input->post("baslik_select".$c)),
					
					
					"renk" => $this->input->post("urun_renk".$urun->siparis_urun_id)
					
				]);



				



				$this->db->where('siparis_id', $id);
				$this->db->update('siparisler',
				[
					"musteri_talep_teslim_tarihi" => date("Y.m.d",strtotime($this->input->post("musteri_talep_teslim_tarihi"))),
					"egitim_var_mi" => $this->input->post("egitim_var_mi")
				]);

				log_data("Fiyat Güncelleme",json_encode($this->input->post()));

		}
		redirect(site_url('siparis/report/'.$id));
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
		redirect(site_url('siparis/report/'.$id));
	}

	public function save_kurulum_programlama_view($id){

		yetki_kontrol("kurulum_surecini_duzenle");
		$siparis = $this->Siparis_model->get_by_id($id); 
		$viewData['egitmenler'] =  $this->Kullanici_model->get_all(["kullanici_departman_id"=>15]);
		$viewData['siparis'] = $siparis[0];
		$viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id);
		$viewData['kullanicilar'] =  $this->Kullanici_model->get_all(["kurulum_ekip_durumu"=>1]);
		$viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
		
		$viewData["page"] = "siparis/kurulum_programlama_form";
		$this->load->view('base_view',$viewData);
	}
	public function save_kurulum_programlama($id){

		yetki_kontrol("kurulum_surecini_duzenle");
		$this->db->where('siparis_id', $id);
		$this->db->update('siparisler',
			[
			"kurulum_tarihi" =>date("Y.m.d",strtotime($this->input->post("kurulum_tarih"))),
			"kurulum_arac_plaka" => $this->input->post("kurulum_arac_plaka"),
			"kurulum_ekip" => json_encode($this->input->post("kurulum_ekip"))
			]);
		redirect(site_url('siparis/report/'.$id));
	}

	public function save_egitim_programlama_view($id){
		yetki_kontrol("egitim_surecini_duzenle");
		$siparis = $this->Siparis_model->get_by_id($id); 
		$viewData['egitmenler'] =  $this->Kullanici_model->get_egitmen(["kullanici_departman_id"=>15]);
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
				redirect(site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))));
				 
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













	public function siparisler_ajax() { 
		 
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

		
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

	
      
 
		$this->db->where(["siparisi_olusturan_kullanici !="=>1]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>12]);
		$this->db->where(["siparisi_olusturan_kullanici !="=>11]);

		$this->db->where(["siparisi_olusturan_kullanici !="=>13]);
		$this->db->where(["siparis_aktif"=>1]);
	   $query = $this->db
		   ->select('siparisler.*,kullanicilar.kullanici_ad_soyad, merkezler.merkez_adi,merkezler.merkez_adresi, musteriler.musteri_id, musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi, sehirler.sehir_adi, ilceler.ilce_adi,siparis_onay_hareketleri.adim_no')
		   ->from('siparisler')
		   ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
		   ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
		   ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id','left')
		   ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id','left')
		   ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici','left')
		   ->join(
			 '(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY onay_tarih DESC) as row_num
			   FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
			 'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1'
		 )
		 ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no')
		 ->order_by($order, $dir)
		  
		 ->order_by('siparisler.siparis_id', 'DESC')
		  
		   ->limit($limit, $start)
		   ->get();
					 
				

                      

        $data = [];
        foreach ($query->result() as $row) {

			$urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$row->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
			$musteri = '<a target="_blank" style="color:black;font-weight: 500;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';     

            $data[] = [
                "<b>".$row->siparis_kodu."</b><br><span style='font-weight:normal'>".date('d.m.Y H:i',strtotime($row->kayit_tarihi))."</span>",
                "<b>".$musteri."</b>".($row->adim_no>=11 ? " <i class='fas fa-check-circle text-success'></i><span class='text-success'>Teslim Edildi</span>":'<span style="margin-left:10px;opacity:0.5">Teslim Edilmedi</span>')."<br>"."<span style='font-weight:normal'>İletişim : ".formatTelephoneNumber($row->musteri_iletisim_numarasi)."</span>", 
				"<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->sehir_adi." (".$row->ilce_adi.")"."</span><br>".(($row->merkez_adresi == "" || $row->merkez_adresi == "." || $row->merkez_adresi == "0") ? '<span style="opacity:0.4;font-weight:normal">BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>' : "<span style='font-weight:normal'>".$row->merkez_adresi."</span>"),
			
				$row->kullanici_ad_soyad,
			
				'
				<a type="button" href="'.$urlcustom.'"    class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
				<a type="button" onclick="showdetail(\''.$urlcustom.'/1\');"    class="btn btn-dark btn-xs"><i class="fa fa-search" style="font-size:12px" aria-hidden="true"></i> Görüntüle</a>
				 '
			
			  
			];
        }
       
        $totalData = $this->db->count_all('siparisler');
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
    }












}
