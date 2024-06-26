<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exampledata extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
 

		$this->load->view('base_view',["page"=>"example/list"]); 
    }

    public function get_users() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

        if(!empty($search)) {
            $this->db->like('musteri_ad', $search); 
        }

        $query = $this->db
                      ->select('musteriler.musteri_ad,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi, merkezler.merkez_adi,merkezler.merkez_adi,sehirler.sehir_adi,ilceler.ilce_adi')
                      ->from('musteriler')
                      ->join('(SELECT * FROM merkezler ORDER BY merkez_id DESC) as merkezler', 'merkezler.merkez_yetkili_id = musteri_id', 'left')
                      ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
                      ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
                      ->order_by($order, $dir)
                      ->limit($limit, $start)
                      ->group_by('musteriler.musteri_id')
                      ->get();

        $data = [];
        foreach ($query->result() as $row) {
            $data[] = [
                $row->musteri_kod,
                $row->musteri_ad,
                $row->merkez_adi,
                $row->ilce_adi."/".$row->sehir_adi,
                $row->musteri_iletisim_numarasi,
                '<button class="edit-btn" data-id="'.$row->musteri_id.'">Düzenle</button>'

            ];
        }

        $totalData = $this->db->count_all('musteriler');
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
    }
}
