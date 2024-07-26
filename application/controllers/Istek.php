<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Istek_model'); 
        $this->load->model('Istek_birim_model'); 
        $this->load->model('Istek_kategori_model'); 
        $this->load->model('Is_tip_model'); 
        $this->load->model('Kullanici_model'); 
        $this->load->model('Istek_durum_model'); 
        $this->load->model('Istek_hareket_model'); 
        $this->load->model('Ayar_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
    public function get_ticket_actions($id)
	{
        $data = $this->Istek_hareket_model->get_all_by_ticket_id($id); 
        echo json_encode($data);
	}
	public function index()
	{  
     
        $check_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        if($check_id[0]->kullanici_id == 1){
            $data = $this->Istek_model->get_all(); 
        }else{
            $data = $this->Istek_model->get_all(["istek_sorumlu_kullanici_id" => $check_id[0]->kullanici_id],["istek_yonetici_id" => $check_id[0]->kullanici_id]); 
        }

         

		$viewData["istekler"] = $data;
		$viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);





	}
    public function get_by_categori($category_id)
	{
       // $data = $this->Istek_model->get_all(["istek_birim_no" => $category_id]); 
		//$viewData["istekler"] = $data;
		$viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);
	}
	public function add()
	{   
    
        $check_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        
        $istek_birimleri = $this->Istek_birim_model->get_all(); 
        $istek_kategorileri = $this->Istek_kategori_model->get_all(); 
        $is_tipleri = $this->Is_tip_model->get_all();
        $durum_data = $this->Istek_durum_model->get_all(); 
        $viewData["istek_durumlari"] = $durum_data;  
        $viewData["istek_birimleri"] = $istek_birimleri; 
        $viewData["istek_kategorileri"] = $istek_kategorileri;
        $viewData["is_tipleri"] = $is_tipleri;
        $viewData["departman_adi"] = $check_id[0]->departman_adi;
        $viewData["email_adresi"] = $check_id[0]->kullanici_email_adresi;
        $viewData["iletisim_numarasi"] = $check_id[0]->kullanici_bireysel_iletisim_no;
        $viewData["dahili_numarasi"] = $check_id[0]->kullanici_dahili_iletisim_no;
       
       
        $kullanici_data = $this->Kullanici_model->get_all(["rehberde_goster"=>1]);    
        $viewData["kullanicilar"] = $kullanici_data;



		$viewData["page"] = "istek/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
         

        $checkus_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
      

		$check_id = $this->Istek_model->get_by_id($id); 

          
        if($check_id[0]->istek_yonetici_id != aktif_kullanici()->kullanici_id){
            if($check_id[0]->istek_sorumlu_kullanici_id != aktif_kullanici()->kullanici_id){
                $this->session->set_flashdata('flashDanger', "Bu talebi düzenleme yetkiniz bulunmamaktadır.");
                redirect(site_url('istek'));
            }
        }

        if($check_id){  
           
                   
            $istek_birimleri = $this->Istek_birim_model->get_all(); 
            $istek_kategorileri = $this->Istek_kategori_model->get_all(); 
            $is_tipleri = $this->Is_tip_model->get_all(); 
            $kullanici_data = $this->Kullanici_model->get_all();  
            $durum_data = $this->Istek_durum_model->get_all(); 
            $viewData["istek_durumlari"] = $durum_data;  
            $viewData["kullanicilar"] = $kullanici_data;
            $viewData["istek_birimleri"] = $istek_birimleri; 
            $viewData["istek_kategorileri"] = $istek_kategorileri;
            $viewData["is_tipleri"] = $is_tipleri;
            $viewData["departman_adi"] = $check_id[0]->departman_adi;
            $viewData["email_adresi"] = $checkus_id[0]->kullanici_email_adresi;
            $viewData["iletisim_numarasi"] = $checkus_id[0]->kullanici_bireysel_iletisim_no;
            $viewData["dahili_numarasi"] = $checkus_id[0]->kullanici_dahili_iletisim_no;
            $viewData['istek'] = $check_id[0];

                


			$viewData["page"] = "istek/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('istek'));
        }
 
	}


    public function report($id){
        yetki_kontrol("istek_rapor_goruntule");
        $check_id = $this->Istek_model->get_by_id($id);
        $viewData["istek"] =$check_id[0]; 

        $data = $this->Istek_hareket_model->get_all_by_ticket_id($id); 
        $viewData["istek_hareketleri"] =$data; 

        $yonetici = $this->Kullanici_model->get_by_id($check_id[0]->istek_yonetici_id); 
        $viewData["yonetici"] =$yonetici; 


        $viewData["page"] = "istek/report"; 
        $this->load->view('base_view',$viewData); 
    }
    public function delete($id)
	{     
        $check_id = $this->Istek_model->get_by_id($id); 
        if($check_id[0]->istek_durum_no != 2){
            $this->session->set_flashdata('flashDanger', "Sadece beklemede olan kayıtları silebilirsiniz.");
            redirect(site_url('istek')); 
        }
           if($check_id[0]->istek_sorumlu_kullanici_id != aktif_kullanici()->kullanici_id){
                $this->session->set_flashdata('flashDanger', "Bu talebi silme yetkiniz bulunmamaktadır.");
                redirect(site_url('istek'));
            }
        


		$this->Istek_model->delete($id);  
        $viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);
	}

    public function update_success_ticket($id){  
        //Yetki Kontrol
        yetki_kontrol("istek_onayla");

        //İstek Durumunu Güncelle
        $data['istek_durum_no'] = 2;
        $data['istek_onay_tarihi'] = date('Y-m-d H:i:s');
        $this->Istek_model->update($id,$data);  

        //İstek Kaydını Kontrol Et
        $istek_kayit = $this->Istek_model->get_by_id($id); 

        //İstek Bildirim Sms
        sendSMS($istek_kayit[0]);

        //İstek Hareketi Kaydet
        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek durumu [Onaylandı] olarak değiştirildi.";
        $this->Istek_hareket_model->insert($action_data);
    }
    public function update_danger_ticket($id){
        //Yetki Kontrol
        yetki_kontrol("istek_reddet");

        //İstek Durumunu Güncelle
        $data['istek_durum_no'] = 5;
        $data['istek_red_tarihi'] = date('Y-m-d H:i:s');
        $this->Istek_model->update($id,$data);

        //İstek Kaydını Kontrol Et
        $istek_kayit = $this->Istek_model->get_by_id($id); 

        //İstek Bildirim Sms
        sendSMS($istek_kayit[0]);

        //İstek Hareketi Kaydet
        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek durumu [Reddedildi] olarak değiştirildi.";
        $this->Istek_hareket_model->insert($action_data);
    }

    public function update_start_ticket($id){  
        //Yetki Kontrol    
        yetki_kontrol("istek_isleme_al");
        $data['istek_durum_no'] = 3;
        $data['istek_isleme_alinma_tarihi'] = date('Y-m-d H:i:s');
        $this->Istek_model->update($id,$data);

        //İstek Kaydını Kontrol Et
        $istek_kayit = $this->Istek_model->get_by_id($id); 

        //İstek Bildirim Sms
        sendSMS($istek_kayit[0]);

        //İstek Hareketi Kaydet
        $action_data['istek_no'] = $id;
        $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
        $action_data['istek_hareket_detay'] = "İstek durumu [İşleme Alındı] olarak değiştirildi.";
        $this->Istek_hareket_model->insert($action_data);
    }

	public function save($id = '')
	{   
        if(empty($id)){
           
        }else{
            $check_id = $this->Istek_model->get_by_id($id); 

            if($check_id[0]->istek_yonetici_id != aktif_kullanici()->kullanici_id){
                if($check_id[0]->istek_sorumlu_kullanici_id != aktif_kullanici()->kullanici_id){
                    $this->session->set_flashdata('flashDanger', "Bu talebi düzenleme yetkiniz bulunmamaktadır.");
                    redirect(site_url('istek'));
                }
            }
        }

        $this->form_validation->set_rules('istek_adi',  'Istek Adı',  'required'); 
        
        $data['istek_adi']  = escape($this->input->post('istek_adi'));
     
        $data['istek_kategori_no']  = escape($this->input->post('istek_kategori_no'));
        $data['is_tip_no']  = escape($this->input->post('is_tip_no'));
        $data['istek_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $data['istek_oncelik'] = escape($this->input->post('istek_oncelik'));
        $data['istek_birim_no'] = escape($this->input->post('istek_birim_no'));
        $data['istek_yonetici_id'] = escape($this->input->post('istek_yonetici_id'));
        
            $data['istek_durum_no'] = escape($this->input->post('istek_durum_no'));
        
       
        $data['istek_notu'] = escape($this->input->post('istek_notu'));
       
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Istek_model->get_by_id($id);
            if($check_id){
                
                //İstek Güncelle
                $this->Istek_model->update($id,$data);
                
                //İstek Bildirim Sms
                $istek_kayit = $this->Istek_model->get_by_id($id);
                sendSMS($istek_kayit[0]);
                
                //İstek Hareketi Kaydet            
                $action_data['istek_no'] = $id;
                $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
                $action_data['istek_hareket_detay'] = "İstek kayıt bilgileri düzenlendi.";
                $this->Istek_hareket_model->insert($action_data);



            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            if($this->input->post("gonderen_sorumlu") == 7 || $this->input->post("gonderen_sorumlu") == 9 ){
                if($this->session->userdata('aktif_kullanici_id') == 9){
                    $data['istek_sorumlu_kullanici_id']  = escape($this->input->post("gonderen_sorumlu"));
            
                }else{
                    $data['istek_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
             
                }
               
            }else{
                $data['istek_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
            
            }
           $data['istek_aciklama']  = escape($this->input->post('istek_aciklama'));
            if(escape($this->input->post('istek_yonetici_id')) == "0"){
                $birim = $this->Istek_birim_model->get_by_id(escape($this->input->post('istek_birim_no'))); 
                $kullanici =  $this->Kullanici_model->get_by_id($birim[0]->birim_yetkili_kullanici_id); 
                $data['istek_yonetici_id'] = $kullanici[0]->kullanici_id;

            }else{
                $kullanici =  $this->Kullanici_model->get_by_id($this->input->post('istek_yonetici_id')); 
            }
            
            sendSmsData($this->Kullanici_model->get_by_id($this->input->post('istek_yonetici_id'))->kullanici_bireysel_iletisim_no, aktif_kullanici()->kullanici_ad_soyad." tarafından yeni istek bildirimi oluşturulmuştur.");



            $this->Istek_model->insert($data);
            $inserted_id = $this->db->insert_id();
            $stok_kodu = "D".date("dmY").$inserted_id;
            $this->Istek_model->update($inserted_id,["istek_kodu" => $stok_kodu]);

            //İstek Bildirim Sms
            $istek_kayit = $this->Istek_model->get_by_id($inserted_id);
            sendSMS($istek_kayit[0]);

            $action_data['istek_no'] = $inserted_id;
            $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
            $action_data['istek_hareket_detay'] = "İstek bildirimi oluşturuldu.";
            $this->Istek_hareket_model->insert($action_data);

            $action_data['istek_no'] = $inserted_id;
            $action_data['istek_hareket_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
            $action_data['istek_hareket_detay'] = "İstek onay için <b>".$kullanici[0]->kullanici_ad_soyad." / ".$kullanici[0]->departman_adi."</b> kullanıcısına yönlendirildi.";
            $this->Istek_hareket_model->insert($action_data);

        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('istek/ekle'));
        }
		redirect(site_url('istek'));
	}
}
