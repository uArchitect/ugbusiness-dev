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

       


// Kullanım
$token = "ey_PMPjK8FnC1iVyUIFfRl:APA91bG5jni_5ik8MIEMeW5BrX7aEutHJdDias4-YmNVpElG4I-pMgAklimQqJXq1RIdOr0sE_TrCDCCpLd6jnSmAAz1Iv2ol4XLVYiQOkzzwVoF8mFMKOQ";
$title = $this->input->post("bildirim_konusu");
$body = $this->input->post("bildirim_detay");
$image = $this->input->post("bildirim_gorsel");
 








$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ugmanager.com.tr/v3/pMgAklimQqJXq1RIdOr0sETrCDCCpLd6jnSmAAz1Iv2ol4XLVYiQOkzzwVoF8.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
     $new_token,
     "Content-Type: application/json",
     "cache-control: no-cache"
  ),
));

$response2 = curl_exec($curl);
$err = curl_error($curl);
 
 
if ($response2) {
    $data = json_decode($response2, true);
    foreach ($data as $item) {
        $tokens[] = $item["token"];
    }  

    echo json_encode($tokens);
} else {
   
    echo json_encode(['error' => 'API bağlantısı hatalı veya veri alınamadı']);
}



$response = sendFirebaseNotification($tokens, $title, $body,$image);
echo $response;

$this->session->set_flashdata('flashSuccess', "Bildirim başarıyla gönderilmiştir.");
          //  redirect(site_url('bildirim/firebase'));
 
    }
    public function firebase()
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
