<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exampledata extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
 
		$this->load->view('example/list/main_content.php'); 
    }

    public function get_users() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

        $query = $this->db->order_by($order, $dir)
                          ->limit($limit, $start)
                          ->get('users');

        $data = [];
        foreach ($query->result() as $row) {
            $data[] = [
                $row->id,
                $row->name,
                $row->email,
                $row->created_at
            ];
        }

        $totalData = $this->db->count_all('users');
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
