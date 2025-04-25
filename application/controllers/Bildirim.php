<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use Google\Auth\OAuth2;

class Bildirim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Banner_model'); 
        date_default_timezone_set('Europe/Istanbul');


        
    }







   public function sendFirebaseNotification($deviceToken, $title, $body)
    {
        $projectId = 'umexcomtr'; // Firebase projenin ID'si
        $credentialsPath = __DIR__ . '/service-account.json'; // İndirdiğin hizmet hesabı JSON dosyası
    echo  $credentialsPath;
        // Access Token al
        $oauth = new OAuth2([
            'audience' => 'https://oauth2.googleapis.com/token',
            'issuer' => json_decode(file_get_contents($credentialsPath))->client_email,
            'signingAlgorithm' => 'RS256',
            'signingKey' => json_decode(file_get_contents($credentialsPath))->private_key,
            'tokenCredentialUri' => 'https://oauth2.googleapis.com/token',
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        ]);
    
        $authToken = $oauth->fetchAuthToken();
        $accessToken = $authToken['access_token'];
    
        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";
    
        $message = [
            "message" => [
                "token" => $deviceToken,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                ],
                "android" => [
                    "priority" => "high"
                ],
                "apns" => [
                    "headers" => [
                        "apns-priority" => "10"
                    ]
                ]
            ]
        ];
    
        $headers = [
            "Authorization: Bearer " . $accessToken,
            "Content-Type: application/json"
        ];
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $result = curl_exec($ch);
        curl_close($ch);
    
        return $result;
    }


    public function gonder()
	{

       


// Kullanım
$token = "ey_PMPjK8FnC1iVyUIFfRl:APA91bG5jni_5ik8MIEMeW5BrX7aEutHJdDias4-YmNVpElG4I-pMgAklimQqJXq1RIdOr0sE_TrCDCCpLd6jnSmAAz1Iv2ol4XLVYiQOkzzwVoF8mFMKOQ";
$title = $this->input->post("bildirim_konusu");
$body = $this->input->post("bildirim_detay");

$response = sendFirebaseNotification($token, $title, $body);
echo $response;
 
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
