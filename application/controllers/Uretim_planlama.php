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
        yetki_kontrol("uretim_plan_yonetimi"); 

        $query = $this->db->order_by('uretim_tarihi', 'ASC')
        ->join('urunler', 'urunler.urun_id = uretim_planlama.urun_fg_id')
        ->join('urun_renkleri', 'urun_renkleri.renk_id = uretim_planlama.renk_fg_id')
        ->get("uretim_planlama"); 

		$viewData["uretim_planlar"] = $query->result();
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
            $query = $this->db->get("urunler"); 
            $viewData["urunler"] = $query->result();

            $query2 = $this->db->where("urun_no",$check_id->urun_fg_id)->get("urun_renkleri"); 
            $viewData["renkler2"] = $query2->result();

            $viewData['uplan'] = $check_id;
			$viewData["page"] = "uretim/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('uretim'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("uretim_plan_yonetimi"); 
       $this->db->where("uretim_planlama_id",$id)->delete("uretim_planlama");
        $viewData["page"] = "uretim/list";
		$this->load->view('base_view',$viewData);
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

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->db->where("uretim_planlama_id",$id)->get("uretim_planlama")->result()[0];
            if($check_id){


                $data['guncelleme_notu'] = $check_id->guncelleme_notu;

                if(date("Y-m-d",strtotime($check_id->uretim_tarihi)) != date("Y-m-d",strtotime($this->input->post('uretim_tarihi')))){
                $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Üretim Tarihi Güncellendi (".date("d.m.Y",strtotime($check_id->uretim_tarihi))." >>".date("d.m.Y",strtotime($this->input->post('uretim_tarihi')))." )";
                }
                if($check_id->baslik_bilgisi != $this->input->post('baslik_bilgisi')){
                    $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Başlık Bilgisi Güncellendi (".$check_id->baslik_bilgisi." >>".$this->input->post('baslik_bilgisi')." )";
                    }


                if($check_id->renk_fg_id != $this->input->post('renk_fg_id')){

                    $eskirenk = $this->db->where("renk_id",$check_id->renk_fg_id)->get("urun_renkleri")->result()[0]->renk_adi;
                    $yenirenk = $this->db->where("renk_id",$this->input->post('renk_fg_id'))->get("urun_renkleri")->result()[0]->renk_adi;


                    $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Renk Bilgisi Güncellendi (".$eskirenk." >>".$yenirenk." )";
                    }



                    if($check_id->urun_fg_id != $this->input->post('urun_fg_id')){

                        $eskicihaz = $this->db->where("urun_id",$check_id->urun_fg_id)->get("urunler")->result()[0]->urun_adi;
                        $yenicihaz = $this->db->where("urun_id",$this->input->post('urun_fg_id'))->get("urunler")->result()[0]->urun_adi;
    
    
                        $data['guncelleme_notu'] = $data['guncelleme_notu']."<br>Cihaz Bilgisi Güncellendi (".$eskicihaz." >>".$yenicihaz." )";
                        }



                unset($data['id']);
                $this->db->where("uretim_planlama_id",$id)->update("uretim_planlama",$data);


             

            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->db->insert("uretim_planlama",$data); 
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(base_url('uretim/form'));
        }
		redirect(base_url('uretim_planlama'));
	}
}
