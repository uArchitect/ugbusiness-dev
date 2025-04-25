<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bildirim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Banner_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
    public function gonder()
	{

        $viewData["page"] = "bildirim/firebase";
		$this->load->view('base_view',$viewData);
 
    }
	public function index()
	{
         





        




        $data = $this->db->order_by('bildirim_id', 'DESC')
        ->join('kullanicilar', 'kullanicilar.kullanici_id = bildirim_kullanici_id',"left")
        ->get("bildirimler")->result();


		$viewData["bildirimler_data"] = $data;
		$viewData["page"] = "bildirim/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
		$viewData["page"] = "bildirim/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
		$check_id = $this->db->where(["bildirim_id"=>$id])->order_by('bildirim_id', 'DESC')->get("bildirimler")->result();
        if($check_id){  
            $viewData['bildirim'] = $check_id[0];
			$viewData["page"] = "bildirim/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('bildirim'));
        }
 
	}

	public function save($id = '')
	{   

        $this->form_validation->set_rules('bildirim_konusu',  'Bildirim Konu',  'required');     
        $data['bildirim_konusu']  = escape($this->input->post('bildirim_konusu'));
        $data['bildirim_detay']  = escape($this->input->post('bildirim_detay'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->db->where(["bildirim_id"=>$id])->order_by('bildirim_id', 'DESC')->get("bildirimler")->result();
            if($check_id){ 
                $this->db->where('bildirim_id', $id);
                $this->db->update('bildirimler', $data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['bildirim_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
            $this->db->insert('bildirimler', $data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('bildirim/add'));
        }
		redirect(site_url('bildirim'));
	}
}
