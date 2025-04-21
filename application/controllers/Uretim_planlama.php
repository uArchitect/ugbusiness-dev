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
        //yetki_kontrol("uretim_plan_goruntuleme"); 

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


		$viewData["page"] = "departman/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
       // yetki_kontrol("uretim_plan_duzenle");
		$check_id = $this->Departman_model->get_by_id($id); 
        if($check_id){  
            $viewData['departman'] = $check_id[0];
			$viewData["page"] = "departman/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('departman'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("departman_sil");
		$this->Departman_model->delete($id);  
        $viewData["page"] = "departman/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("departman_ekle");
        }else{
            yetki_kontrol("departman_duzenle");
        }
        $this->form_validation->set_rules('departman_adi',  'Departman Adı',  'required'); 
        
        $data['departman_adi']  = escape($this->input->post('departman_adi'));
        $data['departman_aciklama']  = escape($this->input->post('departman_aciklama'));
        $data['departman_guncelleme_tarihi'] = date('Y-m-d H:i:s');

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Departman_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Departman_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['departman_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
       
            $this->Departman_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('departman/ekle'));
        }
		redirect(site_url('departman'));
	}
}
