<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musteri extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Musteri_model'); 
        $this->load->model('Merkez_model'); 
        $this->load->model('Sehir_model'); 
        $this->load->model('Ilce_model');         
        $this->load->model('Servis_model'); 
        $this->load->model('Cihaz_model');        $this->load->model('Kullanici_model');  
        $this->load->model('Egitim_model'); 
        $this->load->model('Talep_model');    $this->load->model('Talep_yonlendirme_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{ 
        yetki_kontrol("musterileri_goruntule"); 
        // Filtreler için veriler
        $viewData["sehirler"] = $this->Sehir_model->get_all();
        $viewData["ilceler"] = $this->Ilce_model->get_all();
		$viewData["page"] = "musteri/list";
		$this->load->view('base_view',$viewData);
	}

	public function indextest()
	{ 
        yetki_kontrol("musterileri_goruntule");
        $data = $this->Musteri_model->get_all(); 
		$viewData["musteriler"] = $data;
		$viewData["page"] = "musteri/list3";
		$this->load->view('base_view',$viewData);
	}

	public function excel_export()
	{
		// Output buffer'ı en başta temizle
		while (ob_get_level() > 0) {
			ob_end_clean();
		}
		

		yetki_kontrol("musterileri_goruntule");
		
		
       
		// Filtre parametreleri
		$sehir_id = $this->input->get('sehir_id');
		$ilce_id = $this->input->get('ilce_id');
		$musteri_durum = $this->input->get('musteri_durum');
		
		// Base query
		$this->db->where(["musteri_aktif" => 1]);
		
		// Şehir filtresi
		if (!empty($sehir_id) && $sehir_id != '') {
			$this->db->where('merkez_il_id', $sehir_id);
		}
		
		// İlçe filtresi
		if (!empty($ilce_id) && $ilce_id != '') {
			$this->db->where('merkez_ilce_id', $ilce_id);
		}
		
		// Müşteri durum filtresi
		if (!empty($musteri_durum) && $musteri_durum != '') {
			if ($musteri_durum == 'aktif') {
				$this->db->where('musteriler.musteri_aktif', 1);
			} elseif ($musteri_durum == 'pasif') {
				$this->db->where('musteriler.musteri_aktif', 0);
			}
		}
		
		// İlk 20 müşteriyi getir (test için limit)
		$query = $this->db->select('musteriler.musteri_id, musteriler.musteri_ad, musteriler.musteri_cinsiyet, musteriler.musteri_kod, 
		                          musteriler.musteri_iletisim_numarasi, musteriler.musteri_sabit_numara, musteriler.musteri_email,
		                          merkezler.merkez_adi, merkezler.merkez_id, merkezler.merkez_adresi,
		                          sehirler.sehir_adi, ilceler.ilce_adi')
		                  ->from('musteriler')
		                  ->join('merkezler', 'merkezler.merkez_yetkili_id = musteriler.musteri_id', 'left')
		                  ->join('sehirler', 'sehirler.sehir_id = merkezler.merkez_il_id', 'left')
		                  ->join('ilceler', 'ilceler.ilce_id = merkezler.merkez_ilce_id', 'left')
		                  ->order_by("musteriler.musteri_id", "desc")
		                  ->group_by('musteriler.musteri_id')
		                  ->limit(20)
		                  ->get();
		

		// CSV içeriği oluştur
		$output = chr(0xEF) . chr(0xBB) . chr(0xBF); // UTF-8 BOM
		
		// Başlıklar
		$headers = ['Müşteri ID', 'Müşteri Kodu', 'Müşteri Adı', 'Cinsiyet', 'Merkez Adı', 'Şehir', 'İlçe', 'Adres', 'İletişim Numarası', 'Sabit Numara', 'E-posta'];
		$output .= implode(';', $headers) . "\n";
		

        
       
		// Veriler
		foreach ($query->result() as $row) {
			$line = [
				$row->musteri_id,
				$row->musteri_kod ?? '',
				$row->musteri_ad ?? '',
				($row->musteri_cinsiyet == 1) ? 'Erkek' : (($row->musteri_cinsiyet == 0) ? 'Kadın' : ''),
				($row->merkez_adi == "#NULL#") ? '' : ($row->merkez_adi ?? ''),
				$row->sehir_adi ?? '',
				$row->ilce_adi ?? '',
				str_replace(';', ',', $row->merkez_adresi ?? ''),
				$row->musteri_iletisim_numarasi ?? '',
				$row->musteri_sabit_numara ?? '',
				$row->musteri_email ?? ''
			];
			$output .= implode(';', $line) . "\n";
		}
		


        echo 6;
        die();

		$filename = 'musteriler_' . date('Y-m-d_His') . '.xls';
		
		// Direkt header gönder (force_download yerine)
		header('Content-Type: application/vnd.ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . strlen($output));
		
		echo $output;
		exit;
	}
	public function add($talep_id = 0,$eski_kayit = 0,$servis_kayit = 0)
	{   
        yetki_kontrol("musteri_ekle");
		$viewData["page"] = "musteri/form";

        $ulke_data = $this->Sehir_model->get_all_ulkeler();    
		$viewData["ulkeler"] = $ulke_data;


        $il_data = $this->Sehir_model->get_all();    
		$viewData["sehirler"] = $il_data;

        $ilce_data = $this->Ilce_model->get_all();    
		$viewData["ilceler"] = $ilce_data;
        if($talep_id != 0){

            $talep_data = $this->Talep_model->get_by_id($talep_id);    
            $viewData["talep"] = $talep_data;
        }

        if($eski_kayit != 0){
        
          $eski_data = $this->db->get_where("t_cihaz",["Logicalref"=>$eski_kayit])->result();  
          $viewData["eski_data"] = $eski_data;
      }


        if($servis_kayit != 0){
        
          $viewData["servis_kayit"] = 1;
      }else{
        $viewData["servis_kayit"] = 0;
      }


		$this->load->view('base_view',$viewData);
	}




    public function add_clear()
	{   
        yetki_kontrol("musteri_ekle");
		$viewData["page"]     = "musteri/form";
        $ulke_data            = $this->Sehir_model->get_all_ulkeler();    
		$viewData["ulkeler"]  = $ulke_data;
        $il_data              = $this->Sehir_model->get_all();    
		$viewData["sehirler"] = $il_data;
        $ilce_data            = $this->Ilce_model->get_all();    
		$viewData["ilceler"]  = $ilce_data;
		return view('musteri/form/main_content.php');
	}

	public function edit($id = '')
	{  
        yetki_kontrol("musteri_duzenle");
		$check_id = $this->Musteri_model->get_by_id($id); 
        if($check_id){  
            $viewData['musteri'] = $check_id[0];
			$viewData["page"]    = "musteri/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('musteri'));
        }
 
	}

    public function profile($id = '')
	{  
        yetki_kontrol("musteri_duzenle");
		$check_id = $this->Musteri_model->get_by_id($id); 
        if($check_id){  
            $viewData['musteri'] = $check_id[0];
          
            $merkezler = $this->Merkez_model->get_all(["merkez_yetkili_id"=>$id]);    
            $viewData["merkezler"]        = $merkezler;
            $viewData["urunler"]          = $this->Cihaz_model->get_all(["merkez_yetkili_id"=>$id]); 
            $viewData["egitimler"]        = $this->Egitim_model->get_all(["merkez_yetkili_id"=>$id]); 
            $viewData["atis_yuklemeleri"] = $this->Servis_model->get_atis_yuklemeleri(["merkez_yetkili_id"=>$id]); 
            $viewData["servisler"]        = $this->Servis_model->get_all(["merkez_yetkili_id"=>$id]);    
          
            $viewData["page"] = "musteri/profil"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('musteri'));
        }
 
	}



    public function musteri_gizle($id)
	{     
         yetki_kontrol("musteri_gizle");
        $data['musteri_aktif'] = 0;
        $data['musteri_gizlenme_tarihi'] = date("Y-m-d H:i:s");
        $this->Musteri_model->update($id,$data);
        $this->session->set_flashdata('flashSuccess',"Seçilen müşteri başarıyla gizlenmiştir. Gizlenen müşteri kaydını tekrar aktif etmek için destek talebi oluşturabilirsiniz.");
                
        redirect(site_url('musteri'));
	}



    public function delete($id)
	{     
        yetki_kontrol("musteri_sil");
		$this->Musteri_model->delete($id);  
        $viewData["page"] = "musteri/list";
		$this->load->view('base_view',$viewData);
	}

    public function pre_up($str){
        $str = str_replace('i', 'İ', $str);
        $str = str_replace('ı', 'I', $str);
        return $str;
    }

	public function save($id = '',$siparis_olustur = '',$servis_kayit = 0)
	{   

        if($id == "0"){
            $id = '';
        }
        if($siparis_olustur == "0"){
            $siparis_olustur = '';
        }


        if(empty($id)){
            yetki_kontrol("musteri_ekle");
        }else{
            yetki_kontrol("musteri_duzenle");
        }
        $this->form_validation->set_rules('musteri_ad',   'Müşteri Adı',  'required'); 
        $this->form_validation->set_rules('musteri_iletisim_numarasi','Müşteri Soyad','required');
        

        $data['musteri_ad']                 = mb_strtoupper($this->pre_up(escape($this->input->post('musteri_ad'))), 'UTF-8');
        $data['musteri_iletisim_numarasi']  = escape(str_replace(" ","",$this->input->post('musteri_iletisim_numarasi')));
        $data['musteri_sabit_numara']       = escape($this->input->post('musteri_sabit_numara'));
        $data['musteri_email_adresi']       = escape($this->input->post('musteri_email_adresi'));
        $data['musteri_cinsiyet']           = escape($this->input->post('musteri_cinsiyet'));
        $data['yetkili_adi_2']              = escape($this->input->post('yetkili_adi_2'));
        $data['yetkili_iletisim_2']         = escape(str_replace(" ","",$this->input->post('yetkili_iletisim_2')));
       
        $data['instagram_url']              = escape($this->input->post('instagram_url'));
        $data['instagram_takipci_sayisi']   = escape($this->input->post('instagram_takipci_sayisi'));
        $data['facebook_url']               = escape($this->input->post('facebook_url'));
        $data['facebook_takipci_sayisi']    = escape($this->input->post('facebook_takipci_sayisi'));
        $data['musteri_doktor_mu']          = escape($this->input->post('musteri_doktor_mu'));
        $data['musteri_tckn']               = escape($this->input->post('musteri_tckn'));
       
     
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Musteri_model->get_by_id($id);
            if($check_id){
                unset($data['id']);

                $query = $this->db->where([
                    "musteri_iletisim_numarasi" => $this->input->post('musteri_iletisim_numarasi'),
                    "musteri_id !=" => $id
                ])->get("musteriler");
    
                if(count($query->result()) > 0){
                    $this->session->set_flashdata('flashDanger', escape($this->input->post('musteri_iletisim_numarasi'))." nolu iletişim bilgisiyle daha önce müşteri kaydı oluşturulmuştur. Tekrar müşteri kaydı oluşturulamaz.");
                    redirect($_SERVER['HTTP_REFERER']);
                }
    
                $kulcheck_id = $this->Kullanici_model->get_all(["kullanici_id"=>aktif_kullanici()->kullanici_id]); 
                $data['musteri_kayit_guncelleme_notu'] = $kulcheck_id[0]->kullanici_ad_soyad." - ".date("d.m.Y H:i"); 
               

                $data['musteri_guncelleme_tarihi'] = date('Y-m-d H:i:s');
                $this->Musteri_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){

            
           
            $query = $this->db->where([
                "musteri_iletisim_numarasi" => str_replace(" ","",$this->input->post('musteri_iletisim_numarasi'))
            ])->get("musteriler");

            if(count($query->result()) > 0){
                $this->session->set_flashdata('flashDanger', escape($this->input->post('musteri_iletisim_numarasi'))." nolu iletişim bilgisiyle daha önce müşteri kaydı oluşturulmuştur. Tekrar müşteri kaydı oluşturulamaz.");
                redirect($_SERVER['HTTP_REFERER']);
            }



            $data['musteri_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
           
            $this->Musteri_model->insert($data);
            $insert_musteri_id = $this->db->insert_id();
                            
            $musteridata['musteri_kod']   = "M1".str_pad($insert_musteri_id,5,"0",STR_PAD_LEFT);;
            $this->Musteri_model->update($insert_musteri_id,$musteridata);



            $merkez_data["merkez_yetkili_id"] = $insert_musteri_id;
            $merkez_data["merkez_adi"] = mb_strtoupper($this->pre_up(escape($this->input->post('merkez_adi'))), 'UTF-8');
            $merkez_data["merkez_ulke_id"] = escape($this->input->post('ulke_id'));
            
            $merkez_data["merkez_il_id"] = escape($this->input->post('merkez_il_id'));
            $merkez_data["merkez_ilce_id"] = escape($this->input->post('merkez_ilce_id'));
            $merkez_data["merkez_adresi"] = escape($this->input->post('merkez_adresi'));
            $this->Merkez_model->insert($merkez_data);
            $insert_merkez_id = $this->db->insert_id();
            

            if($servis_kayit == 1){
                redirect(site_url('cihaz/cihaz_tanimlama_view/'.$insert_merkez_id)."?filter=servis");
            }
            

        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('musteri/ekle'));
        }

         if($this->input->post('sipariskod') != ""){
  $data['redirect_url'] = site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$this->input->post('sipariskod')."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")));
        }else{
  $data['redirect_url'] = $_SERVER['HTTP_REFERER'];
        }
        $this->load->view('musteri/updatewindow.php', $data);
         
	}







    public function musteriler_ajax() {
        yetki_kontrol("musterileri_goruntule");
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

        // Filtre parametreleri
        $sehir_id = $this->input->get('sehir_id');
        $ilce_id = $this->input->get('ilce_id');
        $musteri_durum = $this->input->get('musteri_durum'); // aktif/pasif

        // Base query
        $this->db->where(["musteri_aktif"=>1]);

        // Şehir filtresi
        if(!empty($sehir_id) && $sehir_id != '') {
            $this->db->where('merkez_il_id', $sehir_id);
        }

        // İlçe filtresi
        if(!empty($ilce_id) && $ilce_id != '') {
            $this->db->where('merkez_ilce_id', $ilce_id);
        }

        // Müşteri durum filtresi
        if(!empty($musteri_durum) && $musteri_durum != '') {
            if($musteri_durum == 'aktif') {
                $this->db->where('musteriler.musteri_aktif', 1);
            } elseif($musteri_durum == 'pasif') {
                $this->db->where('musteriler.musteri_aktif', 0);
            }
        }

        // Arama (DataTable search) - Minimum 2 karakter kontrolü
        if(!empty($search) && strlen(trim($search)) >= 2) {
            $search = trim($search);
            $this->db->group_start();
            $this->db->like('musteriler.musteri_ad', $search, 'after'); // 'after' daha hızlı (index kullanır)
            $this->db->or_like('merkezler.merkez_adi', $search, 'after');
            $this->db->or_like('musteriler.musteri_iletisim_numarasi', $search, 'after');
            $this->db->group_end();
        } elseif(!empty($search) && strlen(trim($search)) < 2) {
            // 2 karakterden az ise arama yapma - çok yavaş olur
            $search = '';
        }

        // Sütun mapping
        $columns = [
            0 => 'musteriler.musteri_id',
            1 => 'musteriler.musteri_ad',
            2 => 'merkezler.merkez_adi',
            3 => 'sehirler.sehir_adi',
            4 => 'musteriler.musteri_iletisim_numarasi',
            5 => 'musteriler.musteri_id'
        ];
        
        $order_column = isset($columns[$order]) ? $columns[$order] : 'musteriler.musteri_id';
        
        // Optimize edilmiş sorgu
        $query = $this->db->select('musteriler.musteri_id, musteriler.musteri_ad, musteriler.musteri_cinsiyet, musteriler.musteri_kod, musteriler.musteri_iletisim_numarasi, 
                      merkezler.merkez_adi, merkezler.merkez_id, sehirler.sehir_adi, ilceler.ilce_adi')
                      ->from('musteriler')
                      ->join('merkezler', 'merkezler.merkez_yetkili_id = musteriler.musteri_id', 'left')
                      ->join('sehirler', 'sehirler.sehir_id = merkezler.merkez_il_id', 'left')
                      ->join('ilceler', 'ilceler.ilce_id = merkezler.merkez_ilce_id', 'left')
                      ->order_by($order_column, $dir)
                      ->order_by("musteriler.musteri_id", "desc")
                      ->limit($limit, $start)
                      ->group_by('musteriler.musteri_id')
                      ->get();
 
        // Cihaz sayılarını LAZY LOAD - sadece gerektiğinde çek (performans için)
        // Bu sorguları kaldırdık çünkü her sayfa yüklemesinde çok yavaşlatıyor
        // İhtiyaç halinde ayrı bir endpoint'ten çekilebilir
        $cihaz_sayilari = [];
        $urun_bilgileri = [];
        
        $data = [];
        foreach ($query->result() as $row) {
            // Cihaz sayısı kontrolü kaldırıldı - performans için
            // Her zaman "Müşteri Profili" butonu göster
            $data[] = [
                 "<span style='opacity:0.5'>#".$row->musteri_kod."</span>",
                '<a style="color:black;font-weight: 500;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>',
                ($row->merkez_adi == "#NULL#") ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;'><i class='nav-icon 	fas fa-exclamation-circle'></i> Merkez Adı Girilmedi</span>":'<i class="far fa-building" style="color: green;"></i> '.$row->merkez_adi,
                
                '<i class="fa fa-map-marker" style="color: green;"></i> <span style="    font-weight: 500;">'.$row->sehir_adi."</span>",
                '<i class="fa fa-phone" style="color:#813a3a;"></i> '.formatTelephoneNumber($row->musteri_iletisim_numarasi), 
                '<a style="border-color: #000000;background-color: #ddecff !important;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'" class="btn btn-xs btn-warning"><i class="fa fa-user-circle"></i> Müşteri Profili</a>'
                .' 

                <a style="border-color: #000000;color: #000000;background-color:#d7fed0!important;" href="https://ugbusiness.com.tr/musteri/duzenle/'.$row->musteri_id.'" class="btn btn-xs btn-dark"><i class="fa fa-pen"></i> Düzenle</a>',
            ];
        }
       
        // Toplam kayıt sayısı (filtreleme öncesi - sadece aktif) - Cache için
        $totalData = $this->db->where(["musteri_aktif"=>1])->count_all_results('musteriler');
        
        // Filtrelenmiş kayıt sayısı - ÇOK OPTİMİZE EDİLMİŞ VERSİYON
        // Arama varsa ve 2 karakterden fazlaysa say, yoksa toplam sayıyı kullan
        if(!empty($search) && strlen(trim($search)) >= 2) {
            $search = trim($search);
            // Sadece müşteriler tablosundan say - JOIN'ler çok yavaş
            $this->db->select('COUNT(musteriler.musteri_id) as total', FALSE)
                      ->from('musteriler')
                      ->where('musteriler.musteri_aktif', 1);
            
            if(!empty($musteri_durum) && $musteri_durum != '') {
                if($musteri_durum == 'aktif') {
                    $this->db->where('musteriler.musteri_aktif', 1);
                } elseif($musteri_durum == 'pasif') {
                    $this->db->where('musteriler.musteri_aktif', 0);
                }
            }
            
            $this->db->group_start();
            $this->db->like('musteriler.musteri_ad', $search, 'after');
            $this->db->or_like('musteriler.musteri_iletisim_numarasi', $search, 'after');
            $this->db->group_end();
            
            $count_result = $this->db->get()->row();
            $totalFiltered = $count_result ? intval($count_result->total) : $totalData;
        } else {
            // Arama yoksa veya 2 karakterden azsa, toplam sayıyı kullan
            $totalFiltered = $totalData;
        }

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
    }







    public function karaliste_view(){
        $k = aktif_kullanici();
        if($_POST){  
            $karaListeData["kara_liste_iletisim_numarasi"] = $this->input->post("kara_liste_iletisim_numarasi");
            $karaListeData["kara_liste_kullanici_id"] = $k->kullanici_id;
            $this->db->insert("kara_liste",$karaListeData);
        }

       
        $viewData["numaralar"] = $this->db->where("kara_liste_kullanici_id",$k->kullanici_id)
        ->join("kullanicilar","kullanici_id = kara_liste_kullanici_id")
        ->select("kullanicilar.kullanici_ad_soyad,kara_liste.*")
        ->from("kara_liste")->get()->result();
        $viewData["page"] = "musteri/karaliste";
        $this->load->view("base_view",$viewData);
    }





}
