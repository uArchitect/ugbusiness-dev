<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Izin_model'); 
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



	public function onay_bekleyenler()
	{   $check_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
               $s_yetki = goruntuleme_kontrol("izinleri_onayla_sorumlu");
       $ik_yetki = goruntuleme_kontrol("izinleri_onayla_ik");
        if($check_id[0]->kullanici_grup_no == 1){
             $data = $this->Izin_model->get_all();
             
        }else{
    
       
        if($s_yetki){
            $data = $this->Izin_model->get_all(["izin_onaylayacak_sorumlu_id" => $check_id[0]->kullanici_id]);  
        }elseif($ik_yetki){
            $data = $this->Izin_model->get_all();
        }else{
            $data = $this->Izin_model->get_all(["izin_talep_eden_kullanici_id" => $check_id[0]->kullanici_id]);
        }
        }
       
       

		$viewData["istekler"] = $data;
		$viewData["page"] = "izin/list";
        $viewData["sorumlu_onay_yetki"] = $s_yetki;
        $viewData["ik_onay_yetki"] = $ik_yetki;
		$this->load->view('base_view',$viewData);





	}




	public function index()
	{  
        yetki_kontrol("istek_goruntule");
        $check_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        

        switch ($check_id[0]->kullanici_grup_no) {
            case 1:
                $data = $this->Izin_model->get_all(); 
                break;
            case 2:
                $data = $this->Izin_model->get_all(["istek_sorumlu_kullanici_id" => $check_id[0]->kullanici_id]); 
                break;
            case 3:
                $data = $this->Izin_model->get_all(["istek_yonetici_id = ". $check_id[0]->kullanici_id],["istek_sorumlu_kullanici_id = ". $check_id[0]->kullanici_id]); 
                break;
            default:
                # code...
                break;
        }

		$viewData["istekler"] = $data;
		$viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);





	}
    public function get_by_categori($category_id)
	{
        $data = $this->Izin_model->get_all(["istek_birim_no" => $category_id]); 
		$viewData["istekler"] = $data;
		$viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);
	}
	public function add()
	{   
 

        $check_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        
        $istek_birimleri = $this->db->get("izin_nedenleri")->result();
        $durum_data = $this->Istek_durum_model->get_all(); 
        $viewData["istek_durumlari"] = $durum_data;  
        $viewData["istek_birimleri"] = $istek_birimleri; 
        $viewData["departman_adi"] = $check_id[0]->departman_adi;
        $viewData["email_adresi"] = $check_id[0]->kullanici_email_adresi;
        $viewData["iletisim_numarasi"] = $check_id[0]->kullanici_bireysel_iletisim_no;
        $viewData["dahili_numarasi"] = $check_id[0]->kullanici_dahili_iletisim_no;
       
       
        $kullanici_data = $this->Kullanici_model->get_all();    
        $viewData["kullanicilar"] = $kullanici_data;
        
        $kullanici_ik_data =   $this->Kullanici_model->get_all(["kullanici_id"=>39]);   
        $viewData["insan_kaynaklari"] = $kullanici_ik_data;



		$viewData["page"] = "izin/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("izin_duzenle");
       

        $checkus_id = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        
		$check_id = $this->Izin_model->get_by_id($id); 
		
		//güvenlik
		 if($check_id[0]->izin_talep_eden_kullanici_id != $this->session->userdata('aktif_kullanici_id')){
		       $this->session->set_flashdata('flashDanger', "Erişim engellendi. Sadece kendi kaydınızı düzenleyebilirsiniz.");
           
		       redirect(site_url('izin/onay_bekleyenler'));
            
        }
		 if($check_id[0]->sorumlu_onay_durumu != 0 || $check_id[0]->insan_kaynaklari_onay_durumu != 0){
		      $this->session->set_flashdata('flashDanger', "Farklı birim tarafından onaylandığı için düzenlemez. Sistem yöneticiniz ile iletişime geçiniz.");
		       redirect(site_url('izin/onay_bekleyenler'));
            
        }
		
		
        if($check_id){  
           
                   
            $istek_birimleri = $this->db->get("izin_nedenleri")->result();
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

            $kullanici_ik_data =   $this->Kullanici_model->get_all(["kullanici_id"=>39]);   
            $viewData["insan_kaynaklari"] = $kullanici_ik_data;
    
    


			$viewData["page"] = "izin/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('istek'));
        }
 
	}


    public function report($id){
        yetki_kontrol("istek_rapor_goruntule");
        $check_id = $this->Izin_model->get_by_id($id);
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
        yetki_kontrol("istek_sil");
		$this->Izin_model->delete($id);  
        $viewData["page"] = "istek/list";
		$this->load->view('base_view',$viewData);
	}


    public function izin_iptal($id){  
        
        $check_id   = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
        $izin_kayit = $this->Izin_model->get_by_id($id); 
		
        if($check_id[0]->kullanici_grup_no != 1){
            if($izin_kayit->izin_talep_eden_kullanici_id != $this->session->userdata('aktif_kullanici_id')){
                $this->session->set_flashdata('flashDanger', "Sadece kendi tanımladığınız izin talebini iptal edebilirsiniz. Sistem yöneticiniz ile iletişime geçiniz.");
                redirect(site_url('izin/onay_bekleyenler'));
              
            }else{
                if($izin_kayit->insan_kaynaklari_onay_durumu != 0){
                    $this->session->set_flashdata('flashDanger', "Farklı birim tarafından onaylandığı için iptal edilemez. Sistem yöneticiniz ile iletişime geçiniz.");
                    redirect(site_url('izin/onay_bekleyenler'));
                }
            }
        }

        $data['izin_durumu'] = 0;
        $this->Izin_model->update($id,$data);  
        $this->session->set_flashdata('flashSuccess', "Seçilen izin talebi başarıyla iptal edilmiştir.");
        redirect(site_url('izin/onay_bekleyenler'));
    }

    public function sorumlu_onayla($id){  
        yetki_kontrol("izinleri_onayla_sorumlu");
        $data['sorumlu_onay_durumu'] = 1;
        $data['sorumlu_onay_tarihi'] = date('Y-m-d H:i:s');
        $this->Izin_model->update($id,$data);  

 
        $istek = $this->Izin_model->get_by_id($id); 
        $mail_sorumlu = $this->Kullanici_model->get_by_id($this->input->post('bilgilendirme_kullanici_id')); 
        
        $viewData=[];
        $viewData["istek"]=$istek;
        $mail_data = $this->load->view("izin/mail_report/main_content",$viewData,TRUE);
        sendEmail($mail_sorumlu[0]->kullanici_email_adresi,"İZİN TALEBİ",$mail_data);



    }

    public function sorumlu_reddet($id){  
        yetki_kontrol("izinleri_onayla_sorumlu");
        $data['sorumlu_onay_durumu'] = 2;
        $data['sorumlu_onay_tarihi'] = date('Y-m-d H:i:s');
        $data['insan_kaynaklari_onay_durumu'] = 2;
        $data['insan_kaynaklari_onay_tarihi'] = date('Y-m-d H:i:s');
        $this->Izin_model->update($id,$data);  
    }
    public function ik_onayla($id){ 
        yetki_kontrol("izinleri_onayla_ik"); 
        $data['insan_kaynaklari_onay_durumu'] = 1;
        $data['insan_kaynaklari_onay_tarihi'] = date('Y-m-d H:i:s');
        $this->Izin_model->update($id,$data);  
    }

    public function ik_reddet($id){  
        yetki_kontrol("izinleri_onayla_ik"); 
        $data['insan_kaynaklari_onay_durumu'] = 2;
        $data['insan_kaynaklari_onay_tarihi'] = date('Y-m-d H:i:s');
        $this->Izin_model->update($id,$data);  
    }




    public function update_success_ticket($id){  
        //Yetki Kontrol
        yetki_kontrol("istek_onayla");

        //İstek Durumunu Güncelle
        $data['istek_durum_no'] = 2;
        $data['istek_onay_tarihi'] = date('Y-m-d H:i:s');
        $this->Izin_model->update($id,$data);  

        //İstek Kaydını Kontrol Et
        $istek_kayit = $this->Izin_model->get_by_id($id); 

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
        $this->Izin_model->update($id,$data);

        //İstek Kaydını Kontrol Et
        $istek_kayit = $this->Izin_model->get_by_id($id); 

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
        $this->Izin_model->update($id,$data);

        //İstek Kaydını Kontrol Et
        $istek_kayit = $this->Izin_model->get_by_id($id); 

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
        $baslangic_date = date("Y.m.d",strtotime($this->input->post('izin_baslangic_tarihi')));
        $bitis_date = date("Y.m.d",strtotime($this->input->post('izin_bitis_tarihi')));
        


        $this->form_validation->set_rules('izin_adi',  'İzin Adı',  'required'); 
        $data['izin_talep_eden_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
        $data['izin_onaylayacak_sorumlu_id']  = escape($this->input->post('izin_onaylayacak_sorumlu_id'));
        $data['vekalet_edecek_kullanici_id']  = escape($this->input->post('vekalet_edecek_kullanici_id'));
        $data['izin_neden_no']  = escape($this->input->post('izin_neden_no'));
        $data['izin_baslangic_tarihi']  = escape(date("Y.m.d",strtotime($this->input->post('izin_baslangic_tarihi'))));
        $data['izin_bitis_tarihi']  =  escape(date("Y.m.d",strtotime($this->input->post('izin_bitis_tarihi'))));
        $data['acil_durum_tel_no']  = escape($this->input->post('acil_durum_tel_no'));
        $data['izin_notu']  = escape($this->input->post('izin_notu'));
 $data['bilgilendirme_kullanici_id']  = escape($this->input->post('bilgilendirme_kullanici_id'));

       
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            if($bitis_date<$baslangic_date){
                $this->session->set_flashdata('flashDanger', "İzin bitiş tarihi, izin başlangıç tarihi ile aynı veya daha ileri bir tarih olarak seçilmelidir. Tarih bilgilerini kontrol edip tekrar deneyiniz.");
                redirect(site_url('izin/edit/'.$id));
             
            }


            $check_id = $this->Izin_model->get_by_id($id);
            if($check_id){
                
                //izin Güncelle
                $this->Izin_model->update($id,$data);
                
 

            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){

            if($bitis_date<$baslangic_date){
                $this->session->set_flashdata('flashDanger', "İzin bitiş tarihi, izin başlangıç tarihi ile aynı veya daha ileri bir tarih olarak seçilmelidir. Tarih bilgilerini kontrol edip tekrar deneyiniz.");
                redirect(site_url('izin/add'));
             
            }










        $this->Izin_model->insert($data);
        $inserted_id = $this->db->insert_id();
        $istek = $this->Izin_model->get_by_id($inserted_id); 
        $mail_sorumlu = $this->Kullanici_model->get_by_id($this->input->post('izin_onaylayacak_sorumlu_id')); 
        
        $viewData=[];
        $viewData["istek"]=$istek;
        $mail_data = $this->load->view("izin/mail_report/main_content",$viewData,TRUE);
        sendEmail($mail_sorumlu[0]->kullanici_email_adresi,"İZİN TALEBİ",$mail_data);







        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('izin/add'));
        }
		redirect(site_url('izin/onay_bekleyenler'));
	}
}
