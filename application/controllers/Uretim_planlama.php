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


		$viewData["page"] = "uretim/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
       // yetki_kontrol("uretim_plan_duzenle");
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
       // yetki_kontrol("uretim_plan_sil");
       $this->db->where("uretim_planlama_id",$id)->delete("uretim_planlama");
        $viewData["page"] = "uretim/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
          //  yetki_kontrol("uretim_plan_ekle");
        }else{
      //      yetki_kontrol("uretim_plan_duzenle");
        }
        $this->form_validation->set_rules('urun_fg_id',  'Cihaz',  'required'); 
        
        $data['urun_fg_id']  = escape($this->input->post('urun_fg_id'));
        $data['baslik_bilgisi']  = escape($this->input->post('baslik_bilgisi'));
        $data['uretim_tarihi'] = escape($this->input->post('uretim_tarihi'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->db->where("uretim_planlama_id",$id)->get("uretim_planlama")->result()[0];
            if($check_id){
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
