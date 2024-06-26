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

        $query = $this->db->order_by($order, $dir)
                          ->limit($limit, $start)
                          ->get('musteriler');

        $data = [];
        foreach ($query->result() as $row) {
            $data[] = [
                $row->musteri_kod,
                $row->musteri_ad,
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
