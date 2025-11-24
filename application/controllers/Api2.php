<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_setHeaders();
        date_default_timezone_set('Europe/Istanbul');
    }

    /** Genel response çıktısı için yardımcı fonksiyon */
    private function jsonResponse($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    /** CORS ve header ayarları */
    private function _setHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    /** Test endpoint */
    public function test()
    {
        $method = $this->input->method(true);
        $input_data = in_array($method, ['POST', 'PUT'])
            ? json_decode(file_get_contents('php://input'), true) ?? []
            : $this->input->get();

        $response = [
            'status'      => 'success',
            'message'     => 'API2 test endpoint çalışıyor!',
            'timestamp'   => date('Y-m-d H:i:s'),
            'method'      => $method,
            'input_data'  => $input_data,
            'server_info' => [
                'php_version'  => phpversion(),
                'server_time'  => date('Y-m-d H:i:s'),
                'timezone'     => date_default_timezone_get()
            ]
        ];

        $this->jsonResponse($response);
    }

    /** 1. Yemek Listesi */
    public function yemek_listesi()
    {
        $this->load->model('Yemek_model');
        $bugun_no = date("d");
        $data = [
            'status'       => 'success',
            'bugun_yemek'  => ($yemek = $this->Yemek_model->get_by_id($bugun_no)) ? $yemek[0] : null,
            'tum_yemekler' => $this->Yemek_model->get_all(),
            'tarih'        => date('Y-m-d'),
            'gun_no'       => $bugun_no
        ];
        $this->jsonResponse($data);
    }

    /** 2. Trendyol Siparişleri & Ürünler & Sorular */
    public function trendyol()
    {
        $creds = [
            'username' => 'KRgGB8YfCyHNgTp1vu5N',
            'password' => 'leVtgjJK3JE6Upeu8oEO',
            'auth'     => function($u,$p){return 'Authorization: Basic '.base64_encode("$u:$p");}
        ];
        $base_url = 'https://api.trendyol.com/sapigw/suppliers/534419/';

        $fetch = function($endpoint) use ($creds, $base_url) {
            $ch = curl_init($base_url.$endpoint);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    $creds['auth']($creds['username'],$creds['password']),
                    'Content-Type: application/json'
                ]
            ]);
            $out = curl_exec($ch);
            curl_close($ch);
            return json_decode($out, true);
        };

        $data = [
            'status'       => 'success',
            'siparis_data' => $fetch('orders'),
            'urun_data'    => $fetch('products'),
            'soru_data'    => $fetch('questions/filter'),
            'timestamp'    => date('Y-m-d H:i:s')
        ];
        $this->jsonResponse($data);
    }

    /** 3. İzin Listesi */
    public function izin()
    {
        $this->load->model('Izin_model');
        
        $izinler = $this->db
            ->select('izin_talepleri.*, kullanicilar.kullanici_ad_soyad as talep_eden_ad_soyad, izin_nedenleri.izin_neden_detay')
            ->from('izin_talepleri')
            ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talepleri.izin_talep_eden_kullanici_id', 'left')
            ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no', 'left')
            ->order_by('izin_talepleri.izin_talep_id', 'DESC')
            ->get()->result();

        $nedenler = $this->db->get("izin_nedenleri")->result();

        $data = [
            'status'        => 'success',
            'izinler'       => $izinler,
            'nedenler'      => $nedenler,
            'toplam_kayit'  => count($izinler),
            'timestamp'     => date('Y-m-d H:i:s')
        ];
        $this->jsonResponse($data);
    }

    /** 4. Önemli Günler */
    public function onemli_gun()
    {
        $bugun           = date("Y-m-d");
        $sonra           = date("Y-m-d", strtotime("+45 days"));
        $gunlerTable     = $this->db->order_by("onemli_gun_tarih", "asc")->get("onemli_gunler");
        $tum_gunler      = $gunlerTable->result();
        $yaklasan_gunler = $this->db
            ->where("onemli_gun_tarih >=", $bugun)
            ->where("onemli_gun_tarih <=", $sonra)
            ->order_by("onemli_gun_tarih", "asc")
            ->get("onemli_gunler")->result();
        $etkinlikler     = $this->db
            ->where("etkinlik_mi", 1)
            ->order_by("onemli_gun_tarih", "asc")
            ->get("onemli_gunler")->result();

        $data = [
            'status'          => 'success',
            'tum_gunler'      => $tum_gunler,
            'yaklasan_gunler' => $yaklasan_gunler,
            'etkinlikler'     => $etkinlikler,
            'bugun'           => $bugun,
            'toplam_kayit'    => count($tum_gunler),
            'timestamp'       => date('Y-m-d H:i:s')
        ];
        $this->jsonResponse($data);
    }
}
