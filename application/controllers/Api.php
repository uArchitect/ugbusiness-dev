<?php

class Api extends CI_Controller {
	function __construct(){
        parent::__construct();
		
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
        date_default_timezone_set('Europe/Istanbul');
		$this->load->model('Stok_model');
    }
public function tv_api()
{
    $today = date("Y-m-d");

     
    $mesai_query = $this->db->query("
        SELECT 
            k.kullanici_id,
            k.mesai_pos_x,
            k.mesai_pos_y,
            k.kullanici_bireysel_iletisim_no,
            k.kullanici_ad_soyad,   
            k.mesai_baslangic_saati,
            DATE_FORMAT(MIN(m.mesai_takip_okutma_tarihi), '%H:%i') AS mesai_baslama_saati
        FROM kullanicilar k
        LEFT JOIN mesai_takip m 
            ON k.kullanici_id = m.mesai_takip_kullanici_id
            AND m.mesai_takip_okutma_tarihi BETWEEN '{$today} 00:00:00' AND '{$today} 23:59:59'
        WHERE k.kullanici_aktif = 1 
          AND k.mesai_takip_kontrolü = 1
        GROUP BY k.kullanici_id
    ");

    $mesai_data = [];
    foreach ($mesai_query->result_array() as $r) {
        $saat = $r['mesai_baslama_saati'];
        $kullanici_mesai_baslangic = $r['mesai_baslangic_saati'] ?: "08:30";  
        $durum_text = $saat ?: 'Kart Okutmadı';
        $renk = "gray";
        $sirala = 0;  

        if ($saat) {

		
            if ($saat > date("H:i", strtotime($kullanici_mesai_baslangic))) {
                $durum_text .= " <br> Geç Kaldı";
                $renk = "orange";
                $sirala = 2;
            } else {
                $renk = "green";
                $sirala = 3;
            }
        }
else{
	if(servis_var_mi($r['kullanici_id'],date("Y-m-d")) == 1){
				$durum_text = " Serviste";
                $renk = "blue";
                $sirala = 1;
			}
			else if(egitim_var_mi($r['kullanici_id'],date("Y-m-d")) == 1){
				$durum_text = "Eğitimde";
                $renk = "blue";
                $sirala = 1;
			}
			else if(kurulum_var_mi($r['kullanici_id'],date("Y-m-d")) == 1){
				$durum_text = " Kurulumda";
                $renk = "blue";
                $sirala = 1;
			}
}
        $mesai_data[] = [
            'kullanici_ad_soyad'     => $r['kullanici_ad_soyad'],
            'mesai_baslama_saati'    => $durum_text,
            'durum_renk'             => $renk,
            'sirala'                 => $sirala
        ];
    }

    
    usort($mesai_data, function($a, $b) {
        return $a['sirala'] <=> $b['sirala'];
    });

     
    $this->db->where(['talep_yonlendirildi_mi' => 0]);
    $this->db->select('talepler.*, talep_kaynaklari.*, GROUP_CONCAT(urunler.urun_adi) as urun_adlari', false);
    $this->db->from('talepler');
    $this->db->join('urunler', 'FIND_IN_SET(urunler.urun_id, REPLACE(REPLACE(REPLACE(talepler.talep_urun_id, \'["\', \'\'),\'"]\', \'\'),\'"\', \'\'))', 'left');
    $this->db->join('talep_kaynaklari', 'talep_kaynaklari.talep_kaynak_id = talep_kaynak_no');
    $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = talep_sorumlu_kullanici_id');
    $this->db->group_by('talepler.talep_id');
    $this->db->order_by('talepler.talep_id', 'DESC');
    $bekleyen_talepler = $this->db->get()->result();

     
    $dokumanlar = $this->db
        ->select("dokuman_adi, dokuman_yururluk_tarihi")
        ->join('kullanicilar', 'kullanicilar.kullanici_id = dokuman_sorumlu_kullanici_id')
        ->where('dokuman_yururluk_tarihi <=', date('Y-m-d', strtotime('+30 days')))
        ->where('dokuman_yururluk_tarihi >=', date('Y-m-d'))
        ->order_by('dokuman_id', 'ASC')
        ->get("dokumanlar")
        ->result();

     
    $yemek = null;
    $yemek_query = $this->db->select("yemek_detay")->get_where("yemekler", ['yemek_id' => date("d")]);
    if ($yemek_query->num_rows()) {
        $yemek = $yemek_query->row();
    }

    $bugun = date("Y-m-d");
    $otuz_gun_sonra = date("Y-m-d", strtotime("+45 days"));
    $etkinlikler = $this->db->select("onemli_gun_adi,onemli_gun_tarih")
        ->where("onemli_gun_tarih >=", $bugun)
        ->where("onemli_gun_tarih <=", $otuz_gun_sonra)
        ->order_by("onemli_gun_tarih", "asc")
        ->get("onemli_gunler")
        ->result();

     
    echo json_encode([
        'status'            => 'success',
        'count'             => count($mesai_data),
        'data'              => $mesai_data,
        'bekleyen_talepler' => $bekleyen_talepler,
        'dokumanlar'        => $dokumanlar,
        'yemek'             => $yemek,
        'etkinlikler'       => $etkinlikler
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}












	
    public function cihaz_test_check_password()
    {
        $password = $this->input->post('password');

        if (!$password) {
            echo json_encode(['success' => false, 'message' => 'Şifre eksik']);
            return;
        }

     
        if ($password === '0007845758' || $password === '123' || $password === '1234') {
            echo json_encode(['success' => true, 'message' => 'Şifre doğru']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Şifre hatalı']);
        }
    }

   
    public function cihaz_test_check_serial()
    {
        $serial = $this->input->post('serial');

        if (!$serial) {
            echo json_encode(['success' => false, 'message' => 'Seri numarası eksik']);
            return;
        }
 
        if ($serial === 'ABC123') {
            echo json_encode(['success' => true, 'message' => 'Seri numarası doğru']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Seri numarası hatalı']);
        }
    }
 public function cihaz_test_kaydet() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!is_array($data)) {
            echo json_encode(['success' => false, 'message' => 'Geçersiz veri']);
            return;
        }
		
		if ($data['api_key'] != "30052025umexugteknolojicihaztestapi01") {
            echo json_encode([
                'status' => 'error',
                'message' => 'Güvenlik kodu hatalı.'
            ]);
            return;
        }

         
            $this->db->insert('testtemp', [
                'data' => $json 
            ]);
      

        echo json_encode(['success' => true, 'message' => 'Veriler başarıyla kaydedildi']);
    }

	public function mesai_kaydet()
    {
		
        // Gelen ham JSON veriyi al
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Zorunlu alanları kontrol et
        if (!isset($data['mesai_takip_kullanici_id']) || !isset($data['mesai_takip_kapi_id']) || !isset($data['mesai_takip_okutma_tarihi'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Eksik veri gönderildi.'
            ]);
            return;
        }

		if ($data['api_key'] != "27022025umexugteknolojiapi01") {
            echo json_encode([
                'status' => 'error',
                'message' => 'Güvenlik kodu hatalı.'
            ]);
            return;
        }


        // Kaydedilecek veriyi hazırla
        $veri = [
            'mesai_takip_kullanici_id'    => $data['mesai_takip_kullanici_id'],
            'mesai_takip_kapi_id'         => $data['mesai_takip_kapi_id'],
            'mesai_takip_okutma_tarihi'   => $data['mesai_takip_okutma_tarihi'],
			'ddee' => $json
        ];




        // Kaydet
        $insert_id = $this->db->insert('mesai_takip', $veri) ? $this->db->insert_id() : false;

        if ($insert_id) {
            echo json_encode([
                'status' => 'success',
                'insert_id' => $insert_id
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kayıt sırasında bir hata oluştu.'
            ]);
        }
    }


public function kart_okutmayan_personeller() {
    $today = date("Y-m-d");

    $data = $this->db->select("kullanicilar.kullanici_id,kullanicilar.mesai_pos_x,kullanicilar.mesai_pos_y,
                               kullanicilar.kullanici_ad_soyad,
                               kullanicilar.kullanici_bireysel_iletisim_no,
                               mesai_takip.mesai_takip_okutma_tarihi")
        ->from("kullanicilar")
        ->join("mesai_takip",
            "kullanicilar.kullanici_id = mesai_takip.mesai_takip_kullanici_id
             AND mesai_takip.mesai_takip_okutma_tarihi >= '{$today} 00:00:00'
             AND mesai_takip.mesai_takip_okutma_tarihi <= '{$today} 23:59:59'",
            "left")
        ->where("kullanicilar.kullanici_aktif", 1) ->where("mesai_takip_kontrolü", 1)
        ->get()
        ->result();

header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
public function save_position() {
        // JSON olarak gelen veriyi oku
        $input = json_decode(file_get_contents('php://input'), true);

        if(!$input || !isset($input['id'], $input['x'], $input['y'])){
            echo json_encode(['status' => 'error', 'message' => 'Eksik veri']);
            return;
        }

        $id = $input['id'];
        $x = (int)$input['x'];
        $y = (int)$input['y'];

        // Önce kartın var olup olmadığını kontrol et
        $exists = $this->db->get_where('kullanicilar', ['kullanici_id' => $id])->row();

        if($exists){
            // Var ise güncelle
            $this->db->where('kullanici_id', $id);
            $this->db->update('kullanicilar', ['mesai_pos_x' => $x, 'mesai_pos_y' => $y]);
        }  

        echo json_encode(['status' => 'success']);
    }


	public function save_position2() {
        // JSON olarak gelen veriyi oku
        $input = json_decode(file_get_contents('php://input'), true);

        if(!$input || !isset($input['id'], $input['x'], $input['y'])){
            echo json_encode(['status' => 'error', 'message' => 'Eksik veri']);
            return;
        }

        $id = $input['id'];
        $x = (int)$input['x'];
        $y = (int)$input['y'];

        // Önce kartın var olup olmadığını kontrol et
        $exists = $this->db->get_where('mesai_takip_elementler', ['mesai_takip_element_id ' => $id])->row();

        if($exists){
            // Var ise güncelle
            $this->db->where('mesai_takip_element_id', $id);
            $this->db->update('mesai_takip_elementler', ['mesai_takip_x' => $x, 'mesai_takip_y' => $y]);
        }  

        echo json_encode(['status' => 'success']);
    }

public function kart_okutmayan_personeller_view() {


	 



	if($this->session->userdata('aktif_kullanici_id') == 1 ||   $this->session->userdata('aktif_kullanici_id') == 9||   $this->session->userdata('aktif_kullanici_id') == 7||   $this->session->userdata('aktif_kullanici_id') == 8){



    $today = date("Y-m-d");

    $data = $this->db->select("kullanicilar.kullanici_id,kullanicilar.mesai_pos_x,kullanicilar.mesai_pos_y,
                           kullanicilar.kullanici_ad_soyad,kullanicilar.mesai_baslangic_saati,
                           kullanicilar.kullanici_bireysel_iletisim_no,
                           MIN(mesai_takip.mesai_takip_okutma_tarihi) as mesai_takip_okutma_tarihi")
    ->from("kullanicilar")
    ->join("mesai_takip",
        "kullanicilar.kullanici_id = mesai_takip.mesai_takip_kullanici_id
         AND mesai_takip.mesai_takip_okutma_tarihi >= '{$today} 00:00:00'
         AND mesai_takip.mesai_takip_okutma_tarihi <= '{$today} 23:59:59'",
        "left")
    ->where("kullanicilar.kullanici_aktif", 1)
    ->where("mesai_takip_kontrolü", 1)
    ->group_by("kullanicilar.kullanici_id")
    ->order_by("kullanicilar.kullanici_ad_soyad","asc")
    ->get()
    ->result();


	foreach ($data as &$d) {
		  $kullanici_id = $d->kullanici_id;  
        $kontrol_tarihi = date("Y-m-d"); 
		$kk = egitim_var_mi($kullanici_id, $kontrol_tarihi);
        if ($kk) {
            $d->egitim_var_mi = 1;
        } else {
          $d->egitim_var_mi = 0;
        }


		$kurulumm = kurulum_var_mi($kullanici_id, $kontrol_tarihi);
        if ($kurulumm) {
            $d->kurulum_var_mi = 1;
        } else {
          $d->kurulum_var_mi = 0;
        }

		$servis = servis_var_mi($kullanici_id, $kontrol_tarihi);
        if ($servis) {
            $d->servis_var_mi = 1;
        } else {
          $d->servis_var_mi = 0;
        }

	}

	
   //return;

$this->load->view("kullanici/mesai_genel_bakis/main_content.php",["data"=>$data,"materyaller"=>$this->db->get("mesai_takip_elementler")->result()]);
	//header('Content-Type: application/json; charset=utf-8');
	//	echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
else{
	echo "YETKİSİZ ERİŞİM";

}
}


	public function cihaz_atis_genel_mudur_onay($cihaz_seri_no,$update_data=0){
		
		if($_GET["securitykey"] != "9cdd1a22ab314caa8515393cb6b93938"){
			echo "Erişim Engellendi";
			return;
		}
		if($update_data == 1){
			$this->db->where("borclu_seri_numarasi",$cihaz_seri_no)->update("borclu_cihazlar",["gecici_onay_durum"=>1]);
			$viewData["onaylandi"] = true;
		}else if($update_data == 2){
			$this->db->where("borclu_seri_numarasi",$cihaz_seri_no)->update("borclu_cihazlar",["gecici_onay_durum"=>0]);
			$viewData["onaylandi"] = false;
		}else{
			$viewData["onaylandi"] = false;
		}
	 
		
		$jsonData = [];
		$borclulistedata = $this->db->where("borclu_seri_numarasi",$cihaz_seri_no)->get("borclu_cihazlar")->result()[0];
	 
		$data = $this->db->where(["siparis_urun_aktif"=>1,"seri_numarasi"=>$cihaz_seri_no])
        ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
        merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                  urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
                  siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                  siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
                  siparis_urunleri.garanti_baslangic_tarihi,borclu_cihazlar.borclu_aciklama,
                  siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
                  siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,
                  sehirler.sehir_adi, sehirler.sehir_id,urunler.urun_png_gorsel,
                  ilceler.ilce_adi,urun_renkleri.renk_adi")
        ->order_by('siparis_urun_id', 'DESC')
        ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
        ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
        ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
        ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
        ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
        ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
        ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
        ->join("kullanicilar","kullanicilar.kullanici_id = musteriler.musteri_sorumlu_kullanici_id","left")
        ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
        
        ->get("siparis_urunleri")->result()[0];



		$viewData["serino"] = $cihaz_seri_no;
		$viewData["cihaz"] = $data;
		$viewData["page"] = "cihaz/cihaz_atis_onay";
		$this->load->view("base_view_modal",$viewData);
 
	}



	public function cihaz_atis_kontrol_onay($cihaz_seri_no,$cihaz_sol,$cihaz_sag,$basarilimi=0,$ozelgeciskodu=0,$uretilenkod=0,$dataid=0,$tabletno=0){
		if($dataid != 0){
			$this->db->where("atis_log_id",$dataid)->update("atis_log",["ozel_gecis_kodu"=>$ozelgeciskodu,"atis_yukleme_basarili_mi"=>$basarilimi,"uretilen_kod"=>$uretilenkod]);
		}else{
				$insertData["seri_no"] = $cihaz_seri_no;
				$insertData["sol_kod"] = $cihaz_sol;
				$insertData["sag_kod"] = $cihaz_sag;
				$insertData["uretilen_kod"] = $uretilenkod;
				$insertData["ozel_gecis_kodu"] = $ozelgeciskodu;
				$insertData["atis_yukleme_basarili_mi"] = $basarilimi;
				$insertData["uyari"] = "-";	
				$insertData["tablet_no"] = $tabletno;	
				$controldata = $this->db->where("seri_no",$cihaz_seri_no)->where("sol_kod",$cihaz_sol)->where("sag_kod",$cihaz_sag)->get("atis_log")->result();
				$this->db->insert("atis_log",$insertData);
				
		}
			echo "true";
	}




	public function cihaz_atis_kontrol($cihaz_seri_no,$cihaz_sol,$cihaz_sag,$tabletno=0){
		$jsonData = [];
		$datas = $this->db->where("borclu_seri_numarasi",$cihaz_seri_no)->get("borclu_cihazlar")->result()[0];
		$datauretim = $this->db->where("cihaz_havuz_seri_numarasi",$cihaz_seri_no)->get("cihaz_havuzu")->result()[0];


		$data = $this->db->where(["siparis_urun_aktif"=>1,"seri_numarasi"=>$cihaz_seri_no])
        ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
        merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                  urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
                  siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                  siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
                  siparis_urunleri.garanti_baslangic_tarihi,
                  siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
                  siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,
                  sehirler.sehir_adi, sehirler.sehir_id,
                  ilceler.ilce_adi,urun_renkleri.renk_adi")
        ->order_by('siparis_urun_id', 'DESC')
        ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
        ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
        ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
        ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
        ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
        ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
        ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
        ->join("kullanicilar","kullanicilar.kullanici_id = musteriler.musteri_sorumlu_kullanici_id","left")
        ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
        
        ->get("siparis_urunleri")->result()[0];



		if($data != null){	
			if($data->cihaz_borc_uyarisi == 1){

				$insertData["seri_no"] = $cihaz_seri_no;
				$insertData["sol_kod"] = $cihaz_sol;
				$insertData["sag_kod"] = $cihaz_sag;
				$insertData["uretilen_kod"] = "0";
				$insertData["atis_yukleme_basarili_mi"] = "0";
				$insertData["uyari"] = "Borç Uyarısı / Yükleme Engellendi";	
				$insertData["tablet_no"] = $tabletno;	
				$controldata = $this->db->where("seri_no",$cihaz_seri_no)->where("sol_kod",$cihaz_sol)->where("sag_kod",$cihaz_sag)->get("atis_log")->result();
				if(count($controldata) <= 0){
					$this->db->insert("atis_log",$insertData);
					$insert_id = $this->db->insert_id();
				}else{
						 
					$insert_id = $controldata[0]->atis_log_id;
				}

			
				$jsonData["dataid"] = $insert_id;
				$jsonData["status"] = 1;
				$jsonData["message"] = "Müşterinin borcu bulunmaktadır.Atış yüklemesi için uygun değildir.";
				$jsonData["customer"] = $data->musteri_ad;
				$guvenlik = atiskodUret($cihaz_seri_no,$cihaz_sol,$cihaz_sag);
				sendSmsData("05468311015","ATIŞ ONAYI BEKLENİYOR\n".$cihaz_seri_no." seri numaralı cihazın borcu olduğundan dolayı  atış kodu üretimi engellenmiştir. Geçici onay vermek için :\n https://ugbusiness.com.tr/api/cihaz_atis_genel_mudur_onay/".$cihaz_seri_no."?securitykey=9cdd1a22ab314caa8515393cb6b93938\n\nGÜVENLİK KODU : ".$guvenlik."\n\n");
    
			}else{

				$insertData["seri_no"] = $cihaz_seri_no;
				$insertData["sol_kod"] = $cihaz_sol;
				$insertData["sag_kod"] = $cihaz_sag;
				$insertData["uretilen_kod"] = "0";
				$insertData["atis_yukleme_basarili_mi"] = "0";
				$insertData["uyari"] = "-";
				$insertData["tablet_no"] = $tabletno;	
			$controldata = $this->db->where("seri_no",$cihaz_seri_no)->where("sol_kod",$cihaz_sol)->where("sag_kod",$cihaz_sag)->get("atis_log")->result();
				if(count($controldata) <= 0){
					$this->db->insert("atis_log",$insertData);
					$insert_id = $this->db->insert_id();
				}else{
						 
					$insert_id = $controldata[0]->atis_log_id;
				}
				$jsonData["dataid"] = $insert_id;
				$jsonData["status"] = 2;
				$jsonData["message"] = "Müşteri borcu yoktur. Atış Kodu Üretiliyor...";
				$jsonData["customer"] = $data->musteri_ad;
			}

		} 
		else{
			if($datas != null){

						
				
				 

		 	if($datas->borc_durum == 1){

				$insertData["seri_no"] = $cihaz_seri_no;
				$insertData["sol_kod"] = $cihaz_sol;
				$insertData["sag_kod"] = $cihaz_sag;
				$insertData["uretilen_kod"] = "0";
				$insertData["atis_yukleme_basarili_mi"] = "0";
				$insertData["uyari"] = "Borç Uyarısı / Yükleme Engellendi";
				$insertData["tablet_no"] = $tabletno;	
				$controldata = $this->db->where("seri_no",$cihaz_seri_no)->where("sol_kod",$cihaz_sol)->where("sag_kod",$cihaz_sag)->get("atis_log")->result();
				if(count($controldata) <= 0){
					$this->db->insert("atis_log",$insertData);
					$insert_id = $this->db->insert_id();
				}else{
						 
					$insert_id = $controldata[0]->atis_log_id;
				}
				$jsonData["dataid"] = $insert_id;
				$jsonData["status"] = 1;
				$jsonData["message"] = "Müşterinin borcu bulunmaktadır.Atış yüklemesi için uygun değildir.";
				$jsonData["customer"] = "";
				}
				
				
				if($datas->gecici_onay_durum==1 || $datas->borc_durum == 0){
					$insertData["seri_no"] = $cihaz_seri_no;
					$insertData["sol_kod"] = $cihaz_sol;
					$insertData["sag_kod"] = $cihaz_sag;
					$insertData["uretilen_kod"] = "0";
					$insertData["atis_yukleme_basarili_mi"] = "0";
					$insertData["uyari"] = "Cihaz Bulunamadı / Yükleme Engellendi";
					$insertData["tablet_no"] = $tabletno;	
					$controldata = $this->db->where("seri_no",$cihaz_seri_no)->where("sol_kod",$cihaz_sol)->where("sag_kod",$cihaz_sag)->get("atis_log")->result();
				if(count($controldata) <= 0){
					$this->db->insert("atis_log",$insertData);
					$insert_id = $this->db->insert_id();
				}else{
						 
					$insert_id = $controldata[0]->atis_log_id;
				}
					$jsonData["dataid"] = $insert_id;
					$jsonData["status"] = 0;
					$jsonData["message"] = $cihaz_seri_no." seri numaralı cihaz sistemde kayıtlı değildir. Cihaz kaydı oluşturunuz.";
					$jsonData["customer"] = "";
					$guvenlik = atiskodUret($cihaz_seri_no,$cihaz_sol,$cihaz_sag);
								
						sendSmsData("05468311015","ATIŞ ONAYI BEKLENİYOR\n".$cihaz_seri_no." seri numaralı cihaz sistemde kayıtlı olmadığı için atış kodu üretimi engellenmiştir. GÜVENLİK KODU : ".$guvenlik."\n\n");
    


						$this->db->where("borclu_seri_numarasi",$cihaz_seri_no)->update("borclu_cihazlar",["gecici_onay_durum"=>0]);
			 
						/*
					$jsonData["status"] = 2;
					$jsonData["message"] = "Müşteri borcu yoktur. Atış Kodu Üretiliyor...";
					$jsonData["customer"] = "";*/
				} 

			}else{
				

				

				if($datauretim != null){
 

				$insertData["seri_no"] = $cihaz_seri_no;
				$insertData["sol_kod"] = $cihaz_sol;
				$insertData["sag_kod"] = $cihaz_sag;
				$insertData["uretilen_kod"] = "0";
				$insertData["atis_yukleme_basarili_mi"] = "0";
				$insertData["uyari"] = "Üretimdeki Cihaz";
				$insertData["tablet_no"] = 1;	
				$controldata = $this->db->where("seri_no",$cihaz_seri_no)->where("sol_kod",$cihaz_sol)->where("sag_kod",$cihaz_sag)->get("atis_log")->result();
				if(count($controldata) <= 0){
					$this->db->insert("atis_log",$insertData);
					$insert_id = $this->db->insert_id();
				}else{
						 
					$insert_id = $controldata[0]->atis_log_id;
				}
				$jsonData["dataid"] = $insert_id;


						$jsonData["status"] = 2;
						$jsonData["message"] = "Üretimdeki Cihaz İçin Kod Üretiliyor...";
						$jsonData["customer"] = "";
				 

				}else{
					

						$insertData["seri_no"] = $cihaz_seri_no;
				$insertData["sol_kod"] = $cihaz_sol;
				$insertData["sag_kod"] = $cihaz_sag;
				$insertData["uretilen_kod"] = "0";
				$insertData["atis_yukleme_basarili_mi"] = "0";
				$insertData["uyari"] = "Cihaz Bulunamadı / Yükleme Engellendi";
				$insertData["tablet_no"] = $tabletno;	
		$controldata = $this->db->where("seri_no",$cihaz_seri_no)->where("sol_kod",$cihaz_sol)->where("sag_kod",$cihaz_sag)->get("atis_log")->result();
				if(count($controldata) <= 0){
					$this->db->insert("atis_log",$insertData);
					$insert_id = $this->db->insert_id();
				}else{
						 
					$insert_id = $controldata[0]->atis_log_id;
				}
				$jsonData["dataid"] = $insert_id;

				$jsonData["status"] = 0;
				$jsonData["message"] = $cihaz_seri_no." seri numaralı cihaz bilgisi bulunamamıştır.";
				$jsonData["customer"] = "";

				$guvenlik = atiskodUret($cihaz_seri_no,$cihaz_sol,$cihaz_sag);
								
						sendSmsData("05468311015","ATIŞ ONAYI BEKLENİYOR\n".$cihaz_seri_no." seri numaralı cihaz sistemde kayıtlı olmadığı için atış kodu üretimi engellenmiştir.\n\nGÜVENLİK KODU : ".$guvenlik."\n\n");
    
						
				}



		
			}
		
		}
		echo json_encode($jsonData);
	}


public function sipariswebhook() {

 
$json_data = file_get_contents('php://input');
 
$data = json_decode($json_data, true);
 
$status = $data['status'];  

$siparis = $data['lines'][0]["quantity"]." Adet ".$data['lines'][0]["productName"];
 


$ctrendyoldata = $this->db->where("trendyolhook_siparis_id",$data['id'])->get("trendyolhooks")->result();

if(count($ctrendyoldata) <= 0){
if($status == "Created"){
	sendSmsData("05382197344","Sn. Ergül Kızılkaya, yeni TRENDYOL siparişi oluşturulmuştur.\n\nSipariş Kodu : ".$data['id']."\n\nSipariş Detayları\n".$siparis."\n\n");
         //     sendSmsData("05468311015","Sn. İbrahim Bircan, yeni TRENDYOL siparişi oluşturulmuştur.\n\nSipariş Kodu : ".$data['id']."\n\nSipariş Detayları\n".$siparis."\n\n");
                sendSmsData("05461393309","Sn. Harun Kısa, yeni TRENDYOL siparişi oluşturulmuştur.\n\nSipariş Kodu : ".$data['id']."\n\nSipariş Detayları\n".$siparis."\n\n");
                sendSmsData("05415312275","Sn. Oğuzhan Uçan, yeni TRENDYOL siparişi oluşturulmuştur.\n\nSipariş Kodu : ".$data['id']."\n\nSipariş Detayları\n".$siparis."\n\n");
                
 }
}

 


$this->db->insert("trendyolhooks",["trendyolhook_siparis_id"=>$data['id']]);

	            
}
	private function validate_user($username, $password) {
     
        $this->db->where('kullanici_adi', $username);
        $query = $this->db->get('kullanicilar'); 

        if ($query->num_rows() == 1) {
            $user = $query->row();

               return $user;
            
        }
        return false; 
    }
	public function login() {
        $input = json_decode(file_get_contents('php://input'), true);
        $username = $input['username'];
        $password = $input['password'];

        // Kullanıcıyı doğrula
        $user = $this->validate_user($username, $password);

        if ($user) {
            // Giriş başarılı
            $response = [
                'status' => 'success',
                'message' => 'Giriş başarılı!',
                'data' => $user // Kullanıcı bilgilerini döndürebilirsiniz
            ];
            http_response_code(200);
        } else {
            // Giriş başarısız
            $response = [
                'status' => 'error',
                'message' => 'Kullanıcı adı veya şifre hatalı!'
            ];
            http_response_code(401);
        }

        echo json_encode($response);
    }
	public function api_garantisi_biten_cihazlar()
	{
				$query = $this->db
				->where(["siparis_aktif"=>1])
				->where(["siparis_urunleri.garanti_bitis_tarihi <"=>date("Y-m-d")])
				->where(["seri_numarasi !="=>null])
			
			->select("seri_numarasi,musteri_ad,musteri_iletisim_numarasi,garanti_baslangic_tarihi,garanti_bitis_tarihi,merkezler.merkez_adi,merkezler.merkez_adresi,sehirler.sehir_adi,ilceler.ilce_adi")
			->order_by('siparis_urunleri.siparis_urun_id', 'desc')
			->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
			->join("siparisler","siparisler.siparis_id = siparis_urunleri.siparis_kodu")
			->join("merkezler","merkezler.merkez_id = siparisler.merkez_no")
			->join("musteriler","musteriler.musteri_id = merkezler.merkez_yetkili_id")
			->join("sehirler","sehirler.sehir_id = merkezler.merkez_il_id","left")
			->join("ilceler","ilceler.ilce_id = merkezler.merkez_ilce_id","left")
 
			->get("siparis_urunleri");

			   
			  $data = $query->result_array();
		
		 
		
	//	echo json_encode($data , JSON_UNESCAPED_UNICODE); // JSON_UNESCAPED_UNICODE ile Türkçe karakterleri bozulmadan gönderir
	}

	public function stok_genel_bakis()
{
	$sql = "WITH stok_hareketleri_toplam AS (
		SELECT 
			s.stok_tanim_kayit_id,
			COALESCE(SUM(sh.giris_miktar), 0) AS toplam_giris_miktar,
			COALESCE(SUM(sh.cikis_miktar), 0) AS toplam_cikis_miktar
		FROM 
			stoklar s
		INNER JOIN 
			stok_hareketleri sh ON s.stok_id = sh.stok_fg_id
		GROUP BY 
			s.stok_tanim_kayit_id
	)
	SELECT 
		sk.*, 
		sb.*,
		COALESCE(th.toplam_giris_miktar, 0) AS giris_stok,
		COALESCE(th.toplam_cikis_miktar, 0) AS cikis_stok,
		COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) AS toplam_stok,
		CASE
			WHEN COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) < sk.stok_kritik_sayi 
				 AND sk.stok_kritik_uyari = 1 THEN 'stok_uyarisi'
			ELSE ''
		END AS uyari_ver
	FROM 
		stok_tanimlari sk
	LEFT JOIN 
		stok_hareketleri_toplam th ON sk.stok_tanim_id = th.stok_tanim_kayit_id
	LEFT JOIN 
		stok_birimleri sb ON sk.stok_birim_fg_id = sb.stok_birim_id;
	
		  ";
	
	
		  
	
		  $query = $this->db->query($sql);
		  $data = $query->result_array();
    
     
    
    echo json_encode($data , JSON_UNESCAPED_UNICODE);  
}

	public function door_control($user_id,$door_id)
	{
		$control = $this->db->where("kullanici_id",$user_id)->where("kapi".$door_id."_giris",1)
		->select('kullanicilar.*')->from('kullanicilar')
		->get()->result();
		if($control){
			echo "true";
		}else{
			echo "false";
		} 
	}
// **************************

	public function expo_users()
    {
        
        $users = $this->db->get("siparis_urunleri")->result();

       
        echo json_encode($users);
    }
  
 private function generate_random_users($count)
 {
	 $users = [];

	 for ($i = 1; $i <= $count; $i++) {
		 $users[] = [
			 'id' => $i,
			 'name' => 'User' . $i,
			 'email' => 'user' . $i . '@example.com',
			 'age' => rand(18, 60),  
			 'city' => $this->get_random_city()
		 ];
	 }

	 return $users;
 }

 
 private function get_random_city()
 {
	 $cities = ['Istanbul', 'Ankara', 'Izmir', 'Antalya', 'Bursa', 'Adana', 'Konya', 'Kayseri', 'Samsun', 'Eskişehir'];
	 return $cities[array_rand($cities)];
 }

 // **************************

	public function sms_id_guncelle()
	{
	/*	
		$siparisler = $this->db->get("siparisler")->result();
		foreach ($siparisler as $siparis) {
			$id = substr(str_shuffle("012abcdefgh3456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
	 
			$this->db->where("siparis_id",$siparis->siparis_id)->update("siparisler",["musteri_degerlendirme_id"=>$id]);
		}*/
	}


	

	public function stok_genel_bakis_sms()
	{
        $sql = "WITH stok_hareketleri_toplam AS (
            SELECT 
                s.stok_tanim_kayit_id,
                COALESCE(SUM(sh.giris_miktar), 0) AS toplam_giris_miktar,
                COALESCE(SUM(sh.cikis_miktar), 0) AS toplam_cikis_miktar
            FROM 
                stoklar s
            INNER JOIN 
                stok_hareketleri sh ON s.stok_id = sh.stok_fg_id    
            GROUP BY 
                s.stok_tanim_kayit_id
        )
        SELECT 
            sk.*, 
            sb.*,
            COALESCE(th.toplam_giris_miktar, 0) AS giris_stok,
            COALESCE(th.toplam_cikis_miktar, 0) AS cikis_stok,
            COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) AS toplam_stok,
            CASE
                WHEN COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) < sk.stok_kritik_sayi 
                     AND sk.stok_kritik_uyari = 1 THEN 'stok_uyarisi'
                ELSE ''
            END AS uyari_ver
        FROM 
            stok_tanimlari sk
        LEFT JOIN 
            stok_hareketleri_toplam th ON sk.stok_tanim_id = th.stok_tanim_kayit_id
        LEFT JOIN 
            stok_birimleri sb ON sk.stok_birim_fg_id = sb.stok_birim_id
        where sk.stok_kritik_uyari = 1 and sk.stok_kritik_sayi > COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) and stok_kritik_sms_bildirim = 1  
              ";
        
        
              
        
              $query = $this->db->query($sql);
              echo json_encode($query->result());
              $list = $query->result();
              if(count($list)>0){
                $datastokad = "";
                foreach ($list as $l) {
                  $datastokad .= $l->stok_tanim_ad."\n(Stok : $l->toplam_stok Adet, Alt Sınır : $l->stok_kritik_sayi Adet )"."\n\n";
                }
                sendSmsData("05382197344","KRİTİK STOK UYARISI\n\nAşağıdaki belirtilen stoklar kritik seviyeye ulaşmıştır.\n\n".$datastokad);
                sendSmsData("05468311015","KRİTİK STOK UYARISI\n\nAşağıdaki belirtilen stoklar kritik seviyeye ulaşmıştır.\n\n".$datastokad);
                sendSmsData("05421770100","KRİTİK STOK UYARISI\n\nAşağıdaki belirtilen stoklar kritik seviyeye ulaşmıştır.\n\n".$datastokad);
                sendSmsData("05413625944","KRİTİK STOK UYARISI\n\nAşağıdaki belirtilen stoklar kritik seviyeye ulaşmıştır.\n\n".$datastokad);
                
            }
              
	}





	public function kritik_stoklar()
	{
        $sql = "WITH stok_hareketleri_toplam AS (
            SELECT 
                s.stok_tanim_kayit_id,
                COALESCE(SUM(sh.giris_miktar), 0) AS toplam_giris_miktar,
                COALESCE(SUM(sh.cikis_miktar), 0) AS toplam_cikis_miktar
            FROM 
                stoklar s
            INNER JOIN 
                stok_hareketleri sh ON s.stok_id = sh.stok_fg_id    
            GROUP BY 
                s.stok_tanim_kayit_id
        )
        SELECT 
            sk.*, 
            sb.*,
            COALESCE(th.toplam_giris_miktar, 0) AS giris_stok,
            COALESCE(th.toplam_cikis_miktar, 0) AS cikis_stok,
            COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) AS toplam_stok,
            CASE
                WHEN COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) < sk.stok_kritik_sayi 
                     AND sk.stok_kritik_uyari = 1 THEN 'stok_uyarisi'
                ELSE ''
            END AS uyari_ver
        FROM 
            stok_tanimlari sk
        LEFT JOIN 
            stok_hareketleri_toplam th ON sk.stok_tanim_id = th.stok_tanim_kayit_id
        LEFT JOIN 
            stok_birimleri sb ON sk.stok_birim_fg_id = sb.stok_birim_id
        where sk.stok_kritik_uyari = 1 and sk.stok_kritik_sayi > COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) 
              ";
        
        
              
        
              $query = $this->db->query($sql);
            //  echo json_encode($query->result());
              $list = $query->result();
              $viewData["kritik_stoklar"] =  $list;
			  $viewData["page"] =  "stok/kritik_stoklar";
			  $this->load->view("base_view",$viewData);
	}







	public function gecikme_uyari_sms()
	{
		$query = $this->db->query("
        SELECT siparis_id,siparis_kodu, kayit_tarihi, otuz_gun_uyari_sms, kirk_bes_gun_uyari_sms
        FROM siparisler 
        INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
        INNER JOIN (
            SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num 
            FROM siparis_onay_hareketleri
        ) as siparis_onay_hareketleri 
        ON siparis_onay_hareketleri.siparis_no = siparisler.siparis_id 
        AND siparis_onay_hareketleri.row_num = 1
        WHERE kayit_tarihi < DATE_SUB(CURDATE(), INTERVAL 45 DAY)
        AND siparis_aktif = 1
		AND kirk_bes_gun_uyari_sms = 0
        AND siparis_onay_hareketleri.adim_no < 12
    ");
	$smsdata = ""; 
	$d = $query->result();
	if(count($d)>0){




		foreach ($d as $row) {
			$data = array(
				'kirk_bes_gun_uyari_sms' => 1,
				'otuz_gun_uyari_sms' => 1
			);
			 
			$smsdata .= $row->siparis_kodu."\n";
			$this->db->where('siparis_id', $row->siparis_id);
			$this->db->update('siparisler', $data);
		}
		sendSmsData("05382197344","GECİKME UYARISI\nAşağıda listelenen siparişlerin sipariş tarihinin üstünden 45 gün geçmiştir. \n\n".$smsdata);
		sendSmsData("05468311015","GECİKME UYARISI\nAşağıda listelenen siparişlerin sipariş tarihinin üstünden 45 gün geçmiştir. \n\n".$smsdata);
		sendSmsData("05453950049","GECİKME UYARISI\nAşağıda listelenen siparişlerin sipariş tarihinin üstünden 45 gün geçmiştir. \n\n".$smsdata);
		
	

	}
    


	
		$querynew = $this->db->query("
		SELECT siparis_id,siparis_kodu, kayit_tarihi, otuz_gun_uyari_sms, kirk_bes_gun_uyari_sms
		FROM siparisler 
		INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
		INNER JOIN (
			SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num 
			FROM siparis_onay_hareketleri
		) as siparis_onay_hareketleri 
		ON siparis_onay_hareketleri.siparis_no = siparisler.siparis_id 
		AND siparis_onay_hareketleri.row_num = 1
		WHERE kayit_tarihi < DATE_SUB(CURDATE(), INTERVAL 30 DAY)
		AND siparis_aktif = 1
		AND otuz_gun_uyari_sms = 0
		AND siparis_onay_hareketleri.adim_no < 12
	");
	
		$smsdata = ""; 
		$d2 = $querynew->result();
	if(count($d2)>0){

		foreach ($d2 as $row) {
			$data = array(
				'otuz_gun_uyari_sms' => 1
			);
			 
			$smsdata .= $row->siparis_kodu."\n";
			$this->db->where('siparis_id', $row->siparis_id);
			$this->db->update('siparisler', $data);
		}
		sendSmsData("05382197344","GECİKME UYARISI\nAşağıda listelenen siparişlerin sipariş tarihinin üstünden 30 gün geçmiştir. \n\n".$smsdata);
		sendSmsData("05468311015","GECİKME UYARISI\nAşağıda listelenen siparişlerin sipariş tarihinin üstünden 30 gün geçmiştir. \n\n".$smsdata);
		sendSmsData("05453950049","GECİKME UYARISI\nAşağıda listelenen siparişlerin sipariş tarihinin üstünden 30 gün geçmiştir. \n\n".$smsdata);
		
	
	

	}




		$this->db->select('*');
		$this->db->from('arac_kaskolar');
		$this->db->join('araclar', 'araclar.arac_id = arac_kaskolar.arac_tanim_id');
		$this->db->where('arac_kasko_bitis_tarihi <=', date('Y-m-d', strtotime('+1 month')));
		$this->db->where('arac_kasko_bitis_tarihi >=', date('Y-m-d'));
		$query = $this->db->get();
		$result = $query->result();
		if(count($result)>0){
			$smsd = "";
			foreach ($result as $r) {
				$smsd .= $r->arac_plaka." , Kasko Bitiş Tarihi : ".date("d.m.Y",strtotime($r->arac_kasko_bitis_tarihi))."\n\n";
				}

		sendSmsData("05382197344","KASKO UYARISI\n".$smsd);
		sendSmsData("05468311015","KASKO UYARISI\n".$smsd);
		sendSmsData("05413625944","KASKO UYARISI\n".$smsd);
	
		}
	



			$this->db->select('*');
		$this->db->from('arac_muayeneler');
		$this->db->join('araclar', 'araclar.arac_id = arac_muayeneler.arac_tanim_id');
		$this->db->where('arac_muayene_bitis_tarihi <=', date('Y-m-d', strtotime('+1 month')));
		$this->db->where('arac_muayene_bitis_tarihi >=', date('Y-m-d'));
		$query = $this->db->get();
		$result = $query->result();
		if(count($result)>0){
			$smsd = "";
			foreach ($result as $r) {
				$smsd .= $r->arac_plaka." , Muayene Yapılması Gereken Tarih : ".date("d.m.Y",strtotime($r->arac_muayene_bitis_tarihi))."\n\n";
				}

		sendSmsData("05382197344","MUAYENE UYARISI\n".$smsd);
		sendSmsData("05468311015","MUAYENE UYARISI\n".$smsd);
		sendSmsData("05413625944","MUAYENE UYARISI\n".$smsd);
	
		}


	$this->db->select('*');
		$this->db->from('arac_sigortalar');
		$this->db->join('araclar', 'araclar.arac_id = arac_sigortalar.arac_tanim_id');
		$this->db->where('arac_sigorta_bitis_tarihi <=', date('Y-m-d', strtotime('+1 month')));
		$this->db->where('arac_sigorta_bitis_tarihi >=', date('Y-m-d'));
		$query = $this->db->get();
		$result = $query->result();
		if(count($result)>0){
			$smsd = "";
			foreach ($result as $r) {
				$smsd .= $r->arac_plaka." , Sigorta Yapılması Gereken Tarih : ".date("d.m.Y",strtotime($r->arac_sigorta_bitis_tarihi))."\n\n";
				}

		sendSmsData("05382197344","SİGORTA UYARISI\n".$smsd);
		sendSmsData("05468311015","SİGORTA UYARISI\n".$smsd);
		sendSmsData("05413625944","SİGORTA UYARISI\n".$smsd);
	
		}








	}

	public function talep_yonlendirmeler_api($apikey = "")
	{
		if ($apikey == "27022025umexugteknolojiapi01") {
			 
				 
				$bugun = date('Y-m-d');
		
				 
				$bir_hafta_onceki_pazartesi = date('Y-m-d', strtotime('last monday -1 week', strtotime($bugun)));
		
				$query = $this->db->query("
				SELECT *
				FROM talep_yonlendirmeler  
				INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
				LEFT JOIN sehirler ON sehirler.sehir_id = talepler.talep_sehir_no
				WHERE talep_yonlendirmeler.talep_yonlendirme_id IN (
					SELECT MAX(talep_yonlendirmeler.talep_yonlendirme_id)
					FROM talep_yonlendirmeler
					GROUP BY talep_yonlendirmeler.talep_no )
				");
		
				$data = $query->result(); 
				$filtered_data = [];
		
				 
				foreach ($data as $row) {
					if ($row->yonlendirme_tarihi >= $bir_hafta_onceki_pazartesi) {  
						switch ($row->gorusme_sonuc_no) {
							case '1':
								$durum = "Beklemede";
								break;
							case '2':
								$durum = "Satış";
								break;
							case '3':
								$durum = "Bilgi Verildi";
								break;
							case '4':
								$durum = "Müşteri Memnuniyeti";
								break;
							case '5':
								$durum = "Dönüş Yapılacak";
								break;
							case '6':
								$durum = "Olumsuz";
								break;
							case '7':
								$durum = "Numara Hatalı";
								break;
							case '8':
								$durum = "Ulaşılmadı / Tekrar Aranacak";
								break;
							default:
								$durum = "";
								break;
						}
		
						$filtered_data[] = [
							'ad'     => $row->talep_musteri_ad_soyad,
							'tel'    => $row->talep_cep_telefon,
							'detay'  => $row->gorusme_detay,
							'tarih'  => $row->yonlendirme_tarihi,
							'sonuc'  => $durum,
							'sehir'  => $row->sehir_adi
						];
					}
				}
		
				echo json_encode($filtered_data);
			}
	}

	public function beklemeye_al($apikey = "",$istek_id = 0)
	{/*
		if($apikey != "" && $istek_id != 0){
			$kullanici = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();

			$istek = $this->db->where("istek_id",$istek_id)
			->select('istekler.*')->from('istekler')
			->get()->result();
			
			if(count($kullanici) > 0 && count($istek) > 0){
				if(count($kullanici) > 0 && count($istek) > 0){
					if($istek[0]->istek_durum_no==3)
					if($istek[0]->istek_yonetici_id == $kullanici[0]->kullanici_id){
						$this->db->where("istek_id",$istek_id)->update("istekler",["istek_durum_no"=>2]);
					}
				}
				}
			}
		}
		*/
	}
	public function isleme_al($apikey = "",$istek_id = 0)
	{
		if($apikey != "" && $istek_id != 0){
			$kullanici = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();

			$istek = $this->db->where("istek_id",$istek_id)
			->select('istekler.*')->from('istekler')
			->get()->result();
			
			if(count($kullanici) > 0 && count($istek) > 0){
				if(count($kullanici) > 0 && count($istek) > 0){

					if($istek[0]->istek_yonetici_id == $kullanici[0]->kullanici_id){
						$this->db->where("istek_id",$istek_id)->update("istekler",["istek_durum_no"=>3,"istek_isleme_alinma_tarihi"=>date("Y-m-d H:i")]);
					}
					 
				}
			}
		}
		
	}

	public function tamamla($apikey = "",$istek_id = 0)
	{
		if($apikey != "" && $istek_id != 0){
			$kullanici = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();

			$istek = $this->db->where("istek_id",$istek_id)
			->select('istekler.*')->from('istekler')
			->get()->result();
			
			if(count($kullanici) > 0 && count($istek) > 0){
				if(count($kullanici) > 0 && count($istek) > 0){

					if($istek[0]->istek_yonetici_id == $kullanici[0]->kullanici_id){
						$this->db->where("istek_id",$istek_id)->update("istekler",["istek_durum_no"=>4,"istek_tamamlanma_tarihi"=>date("Y-m-d H:i")]);
					}
					 
				}
			}
		}
		
	}
public function umexbeslenme()
	{   
		sendSmsData("05382197344","UMEX BESLENME SAATİ");

		sendSmsData("05468311015","UMEX BESLENME SAATİ");
		
		sendSmsData("05413625944","UMEX BESLENME SAATİ");
		
		sendSmsData("05411580100","UMEX BESLENME SAATİ");


	}
 public function ugurayazbeslenme()
	{   
		sendSmsData("05435089848","Uğur ayazın D vitamini / demir ilacı verilecek");

		sendSmsData("05382197344","Uğur ayazın D vitamini / demir ilacı verilecek");
		
	 


	}
 
	
public function jenerator_sms()
	{   
  	sendSmsData("05468311015","DİKKAT, JENERATOR ÇALIŞTIRILACAK, ÇİÇEK SULANACAK");
	sendSmsData("05382197344","DİKKAT, JENERATOR ÇALIŞTIRILACAK, ÇİÇEK SULANACAK");
	sendSmsData("05413625944","DİKKAT, JENERATOR ÇALIŞTIRILACAK, ÇİÇEK SULANACAK");
	sendSmsData("05357648100","DİKKAT, JENERATOR ÇALIŞTIRILACAK");


	}


	public function wc_sms()
	{   
  	sendSmsData("05423507131","WC GENEL TEMİZLİK GÜNÜ");
	 sendSmsData("05382197344","05423507131 numaralı kullanıcıya WC GENEL TEMİZLİK GÜNÜ şeklinde sms gönderilmiştir.");
	 

	}
	
    public function bekleyen_talep_uyarisi()
	{   

 
         
            
        $sql = "SELECT kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_bireysel_iletisim_no, COUNT(*) AS toplam_satir_sayisi
        FROM talep_yonlendirmeler
        INNER JOIN kullanicilar ON talep_yonlendirmeler.yonlenen_kullanici_id = kullanicilar.kullanici_id
        INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
        WHERE talep_yonlendirmeler.gorusme_sonuc_no = 1 AND talep_yonlendirmeler.yonlenen_kullanici_id <> 60
        GROUP BY kullanicilar.kullanici_ad_soyad;
        ";

        $query = $this->db->query($sql)->result();

      
       $hour = date('H');

if ($hour >= 7 && $hour < 20) { // 07:00 - 19:59 arası
    foreach ($query as $d) {
		if($d->kullanici_bireysel_iletisim_no == "0546 831 10 15"){
			continue;
		}
        sendSmsData(
            $d->kullanici_bireysel_iletisim_no,
            "TALEP UYARI \nSn. " . $d->kullanici_ad_soyad . 
            ", UG Business sisteminde toplam " . $d->toplam_satir_sayisi . 
            " adet bekleyen talebiniz bulunmaktadır. Belirli bir süre işlem yapılmayan talepler geri çekilerek talep havuzuna aktarılır. Bekleyen taleplerinizi görüntülemek için : https://ugbusiness.com.tr/bekleyen-talepler adresini ziyaret edebilirsiniz."
        );
    }
	sendSmsData("05382197344","CRON JOB Çalıştı. Satış temsilcilerine uyari smsleri gönderildi.");
 

  



  $this->db->select('ak.*, araclar.*, kullanicilar.*');
$this->db->from('arac_kmler ak');
$this->db->join(
    '(SELECT arac_tanim_id, MAX(arac_km_kayit_tarihi) AS son_tarih 
      FROM arac_kmler 
      GROUP BY arac_tanim_id) son_kayit',
    'ak.arac_tanim_id = son_kayit.arac_tanim_id AND ak.arac_km_kayit_tarihi = son_kayit.son_tarih',
    'inner'
);
$this->db->join('araclar', 'araclar.arac_id = ak.arac_tanim_id', 'inner');
$this->db->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'inner');
$this->db->where('son_kayit.son_tarih <=', date('Y-m-d', strtotime('-7 days')));
$this->db->where_not_in('araclar.arac_id', [9, 15]);

$query = $this->db->get();
$result = $query->result();
 foreach ($result as $d) { 
            sendSmsData($d->kullanici_bireysel_iletisim_no,"KM \n Sn. ".$d->kullanici_ad_soyad.", aracınız km bilgisini ugbusiness üzerinden güncelleyiniz.");

        }
        }
    }


	

	public function index($apikey = "",$filter = "0")
	{
		$json_data = [
			"userName" => "error",
			"userTitle" => "error", 
			"waitCount" => "0", 
			"processCount" => "0",
			"completedCount" => "0",  
			"userImage" => "", 
			"data" => null
		];
		if($apikey != "200670632902742" && $apikey != "HC16317401" && $apikey != "140425105902036" && $apikey != "BSS-0123456789"){
		//	sendSmsData("05382197344", " YENİ API ISTEK : ".$apikey);

		}
		
		if($apikey != "" && $apikey != null){
			
			$kquery = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();
			if(count($kquery)>=0){
				if($filter == 2 || $filter == 3 || $filter == 4){
					$this->db
					->where("istek_durum_no",$filter)
					->where("istek_sorumlu_kullanici_id",$kquery[0]->kullanici_id);
					
				}else{
					$this->db
					->where("istek_sorumlu_kullanici_id",$kquery[0]->kullanici_id)
					->or_where("istek_yonetici_id",$kquery[0]->kullanici_id);
				}
				$query = $this->db
				->select('istekler.*, kullanicilar.kullanici_ad_soyad as kullanici_ad_soyad, yonetici_kullanicilar.kullanici_ad_soyad as gorevlendirilen_kullanici_ad_soyad')
				->join('kullanicilar', 'kullanicilar.kullanici_id = istekler.istek_sorumlu_kullanici_id', 'left')
				->join('kullanicilar as yonetici_kullanicilar', 'yonetici_kullanicilar.kullanici_id = istekler.istek_yonetici_id', 'left')
				->order_by("istek_id","desc")
				->from('istekler')
				->get()->result();
				if(count($query)>=0){
					$json_data = [
						"userName" => $kquery[0]->kullanici_ad_soyad,
						"userTitle" => $kquery[0]->kullanici_unvan, 
						"userImage" => "https://ugbusiness.com.tr/uploads/".$kquery[0]->kullanici_resim, 
						"waitCount" => count($this->db->query('SELECT * FROM ugbusine_erpdatabase.istekler where (istek_yonetici_id = '.$kquery[0]->kullanici_id.' or istek_sorumlu_kullanici_id = '.$kquery[0]->kullanici_id.') and istek_durum_no = 2')->result()),  
						
						 "processCount" => count($this->db->query('SELECT * FROM ugbusine_erpdatabase.istekler where (istek_yonetici_id = '.$kquery[0]->kullanici_id.' or istek_sorumlu_kullanici_id = '.$kquery[0]->kullanici_id.') and istek_durum_no = 3')->result()),
						"completedCount" => count($this->db->query('SELECT * FROM ugbusine_erpdatabase.istekler where (istek_yonetici_id = '.$kquery[0]->kullanici_id.' or istek_sorumlu_kullanici_id = '.$kquery[0]->kullanici_id.') and istek_durum_no = 4')->result()),  
						"data" => $query
					];
			
				
				}else{
					$json_data = [
						"userName" => $kquery[0]->kullanici_ad_soyad,
						"userTitle" => $kquery[0]->kullanici_unvan, 
						"userImage" => "https://ugbusiness.com.tr/uploads/".$kquery[0]->kullanici_resim, 
						"waitCount" => "0", 
						"processCount" => "0",
						"completedCount" => "0", 
						"data" => null
					];
			
			
				}
			}
		}
		echo base64_encode(json_encode($json_data));		
		}





	
	}
 