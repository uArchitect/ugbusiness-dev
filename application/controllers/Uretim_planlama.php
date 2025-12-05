<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uretim_planlama extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        // Üretim departmanındaki kullanıcılar da erişebilmeli
        $aktif_kullanici = aktif_kullanici();
        $is_uretim_departmani = false;
        
        // Departman adına göre kontrol (daha güvenilir - case-insensitive)
        if(isset($aktif_kullanici->departman_adi) && !empty($aktif_kullanici->departman_adi)) {
            $departman_adi = mb_strtolower(trim($aktif_kullanici->departman_adi), 'UTF-8');
            // "Üretim", "Uretim", "ÜRETİM" gibi varyasyonları kontrol et
            if(strpos($departman_adi, 'üretim') !== false || 
               strpos($departman_adi, 'uretim') !== false ||
               strpos($departman_adi, 'üret') !== false ||
               strpos($departman_adi, 'uret') !== false) {
                $is_uretim_departmani = true;
            }
        }
        
        // Departman ID kontrolü (yedek - daha geniş aralık)
        if(isset($aktif_kullanici->kullanici_departman_id)) {
            // Üretim departmanı ID'leri (37, 8 ve diğer olası ID'ler)
            if(in_array($aktif_kullanici->kullanici_departman_id, [37, 8, 7, 9])) {
                $is_uretim_departmani = true;
            }
        }
        
        // Belirli kullanıcı ID'leri
        if(in_array($aktif_kullanici->kullanici_id, [1, 9, 37, 8, 7])) {
            $is_uretim_departmani = true;
        }
        
        // Yetki kontrolü veya üretim departmanı kontrolü
        if(!goruntuleme_kontrol("uretim_plan_yonetimi") && !$is_uretim_departmani) {
            $this->session->set_flashdata('flashDanger', 'Bu sayfaya erişim yetkiniz bulunmamaktadır.');
            redirect(base_url());
        } 

        $query = $this->db->order_by('onay_durumu', 'ASC')->order_by('uretim_tarihi', 'DESC')
        ->join('urunler', 'urunler.urun_id = uretim_planlama.urun_fg_id')
        ->join('urun_renkleri', 'urun_renkleri.renk_id = uretim_planlama.renk_fg_id')
        ->get("uretim_planlama"); 


		$viewData["uretim_planlar"] = $query->result();


        $baslangicTimestamp = strtotime('monday this week');
        $sonrakiPazartesiTimestamp = strtotime('friday next week');  
    
        $baslangic = date('Y-m-d 00:00:00', $baslangicTimestamp);
        $sonrakipazartesi = date('Y-m-d 23:59:59', $sonrakiPazartesiTimestamp);
    

        $data = $this->db  
        
        ->join('urunler', 'urunler.urun_id = uretim_planlama.urun_fg_id')
        ->join('urun_renkleri', 'urun_renkleri.renk_id = uretim_planlama.renk_fg_id')
        ->where("uretim_tarihi >=", $baslangic)
        ->where("uretim_tarihi <=", $sonrakipazartesi)
      ->where("onay_durumu ", 1)
      ->where("aktif_kayit ", 1)
      
        ->get("uretim_planlama")->result();
 
        $viewData["d1"] = date("d.m.Y", $baslangicTimestamp);
        $viewData["d2"] = date("d.m.Y", strtotime("+1 day", $baslangicTimestamp));
        $viewData["d3"] = date("d.m.Y", strtotime("+2 days", $baslangicTimestamp));
        $viewData["d4"] = date("d.m.Y", strtotime("+3 days", $baslangicTimestamp));
        $viewData["d5"] = date("d.m.Y", strtotime("+4 days", $baslangicTimestamp));
        $viewData["d6"] = date("d.m.Y", strtotime("+7 days", $baslangicTimestamp));
        
        $viewData["d7"] = date("d.m.Y", strtotime("+7 days", $baslangicTimestamp));
        $viewData["d8"] = date("d.m.Y", strtotime("+8 days", $baslangicTimestamp));
        $viewData["d9"] = date("d.m.Y", strtotime("+9 days", $baslangicTimestamp));
        $viewData["d10"] = date("d.m.Y", strtotime("+10 days", $baslangicTimestamp));
        $viewData["d11"] = date("d.m.Y", strtotime("+11 days", $baslangicTimestamp)); 








        $viewData["data"] =$data;


		$viewData["page"] = "uretim/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        //yetki_kontrol("uretim_plan_ekle");
        $query = $this->db->get("urunler"); 
        $viewData["urunler"] = $query->result();


		$viewData["page"] = "uretim/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("uretim_plan_yonetimi"); 
		$check_id = $this->db->where("uretim_planlama_id",$id)->get("uretim_planlama")->result()[0]; 

        
        if($check_id){  

            if($check_id->aktif_kayit == 0){
                $this->session->set_flashdata('flashDanger', "Silinen kayıt düzenlenemez.");
                redirect(base_url('uretim_planlama'));
            }
            $query = $this->db->get("urunler"); 
            $viewData["urunler"] = $query->result();

            $query2 = $this->db->where("urun_no",$check_id->urun_fg_id)->get("urun_renkleri"); 
            $viewData["renkler2"] = $query2->result();

            $viewData['uplan'] = $check_id;
			$viewData["page"] = "uretim/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('uretim_planlama'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("uretim_plan_silme"); 
      // $this->db->where("uretim_planlama_id",$id)->delete("uretim_planlama");

        $this->db->where("uretim_planlama_id",$id)->update("uretim_planlama",["aktif_kayit"=>0]);
        $viewData["page"] = "uretim/list";
		$this->load->view('base_view',$viewData);
	}


    public function onay($id = '')
	{    

        yetki_kontrol("uretim_plan_onaylama"); 
        $data['onay_durumu']  = 1;
        $check_id = $this->db->where("uretim_planlama_id",$id)->get("uretim_planlama")->result()[0];
        if($check_id){
            $this->db->where("uretim_planlama_id",$id)->update("uretim_planlama",$data);
        }
        redirect(base_url('uretim_planlama'));

    }

    public function onay_geri($id = '')
	{    
        yetki_kontrol("uretim_plan_onaylama"); 

        $data['onay_durumu']  = 0;
        $check_id = $this->db->where("uretim_planlama_id",$id)->get("uretim_planlama")->result()[0];
        if($check_id){
            $this->db->where("uretim_planlama_id",$id)->update("uretim_planlama",$data);
        }
        redirect(base_url('uretim_planlama'));

    }



	public function save($id = '')
	{   
        yetki_kontrol("uretim_plan_yonetimi"); 
        $this->form_validation->set_rules('urun_fg_id',  'Cihaz',  'required'); 
        
        $data['urun_fg_id']  = escape($this->input->post('urun_fg_id'));
        $data['baslik_bilgisi']  = escape($this->input->post('baslik_bilgisi'));
        $data['uretim_tarihi'] = escape($this->input->post('uretim_tarihi'));
  $data['renk_fg_id'] = escape($this->input->post('renk_fg_id'));
 $data['kayit_notu'] = escape($this->input->post('kayit_notu'));
  if($this->session->userdata('aktif_kullanici_id') != 8){
                               $data['onay_durumu'] = 0;
                        }else{
                            $data['onay_durumu'] = 1;
                        }
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->db->where("uretim_planlama_id",$id)->get("uretim_planlama")->result()[0];
            if($check_id){


                $data['guncelleme_notu'] = $check_id->guncelleme_notu;

                $smsuyari = "";


                if(date("Y-m-d",strtotime($check_id->uretim_tarihi)) != date("Y-m-d",strtotime($this->input->post('uretim_tarihi')))){
                $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Üretim Tarihi Güncellendi (".date("d.m.Y",strtotime($check_id->uretim_tarihi))." >>".date("d.m.Y",strtotime($this->input->post('uretim_tarihi')))." )";

                $smsuyari .= "Üretim Tarihi\n";

               if($this->session->userdata('aktif_kullanici_id') != 8){
                               $data['onay_durumu'] = 0;
                        }
                }


                if($check_id->baslik_bilgisi != $this->input->post('baslik_bilgisi')){
                    $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Başlık Bilgisi Güncellendi (".$check_id->baslik_bilgisi." >>".$this->input->post('baslik_bilgisi')." )";


                    $smsuyari .= "Başlık Bilgisi\n";
                  if($this->session->userdata('aktif_kullanici_id') != 8){
                               $data['onay_durumu'] = 0;
                        }
                    }



                if($check_id->renk_fg_id != $this->input->post('renk_fg_id')){

                    $eskirenk = $this->db->where("renk_id",$check_id->renk_fg_id)->get("urun_renkleri")->result()[0]->renk_adi;
                    $yenirenk = $this->db->where("renk_id",$this->input->post('renk_fg_id'))->get("urun_renkleri")->result()[0]->renk_adi;


                    $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Renk Bilgisi Güncellendi (".$eskirenk." >>".$yenirenk." )";



                    $smsuyari .= "Renk\n";
                   if($this->session->userdata('aktif_kullanici_id') != 8){
                               $data['onay_durumu'] = 0;
                        }
                    }



                    if($check_id->urun_fg_id != $this->input->post('urun_fg_id')){

                        $eskicihaz = $this->db->where("urun_id",$check_id->urun_fg_id)->get("urunler")->result()[0]->urun_adi;
                        $yenicihaz = $this->db->where("urun_id",$this->input->post('urun_fg_id'))->get("urunler")->result()[0]->urun_adi;
    
    
                        $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Cihaz Bilgisi Güncellendi (".$eskicihaz." >>".$yenicihaz." )";
                        $smsuyari .= "Cihaz\n";
                        if($this->session->userdata('aktif_kullanici_id') != 8){
                               $data['onay_durumu'] = 0;
                        }
                     
                        }


                        if($smsuyari!=""){
                            if($this->session->userdata('aktif_kullanici_id') != 8){
                               sendSmsData("05413625944","ÜRETİM GÜNCELLEME ONAYI(".date("d.m.Y H:i").")\nÜretim Planlamasında onayınızı bekleyen yeni değişiklikler yapıldı. Onay vermek için : https://ugbusiness.com.tr/uretim_planlama ");
                        }
                          
                        }
                unset($data['id']);
                $this->db->where("uretim_planlama_id",$id)->update("uretim_planlama",$data);


             

            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->db->insert("uretim_planlama",$data); 

            sendSmsData("05413625944","ÜRETİM KAYIT ONAYI(".date("d.m.Y H:i").")\nÜretim Planlamasında onayınızı bekleyen yeni kayıtlar oluşturuldu. Onay vermek için : https://ugbusiness.com.tr/uretim_planlama ");

        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(base_url('uretim/form'));
        }
		redirect(base_url('uretim_planlama'));
	}
}
