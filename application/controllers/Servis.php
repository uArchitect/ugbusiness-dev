<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servis extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        $this->load->model('Servis_model');
		$this->load->model('Cihaz_model');	$this->load->model('Siparis_urun_model');	$this->load->model('Siparis_model'); $this->load->model('Siparis_onay_hareket_model');
		$this->load->model('Kullanici_model');		
		$this->load->model('Musteri_model');
		$this->load->model('Merkez_model');
		$this->load->model('Stok_model');
        date_default_timezone_set('Europe/Istanbul');
    }
	public function pre_up($str){
        $str = str_replace('i', 'İ', $str);
        $str = str_replace('ı', 'I', $str);
        return $str;
    }
	public function eski_servis_musteri_cihaz_tanimla($eski_kayit_id)
	{
		$sql = "SELECT eski_servisler.*, siparis_urunleri.*, siparisler.*, merkezler.*, musteriler.* 
        FROM `eski_servisler`
        LEFT JOIN siparis_urunleri ON siparis_urunleri.seri_numarasi = eski_servisler.eski_servis_seri_numarasi
        LEFT JOIN siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
        LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
        LEFT JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id  
        WHERE eski_servis_id = ".$eski_kayit_id."
        ORDER BY `eski_servisler`.`eski_servis_id` ASC";

		$query_result = $this->db->query($sql)->result();  

		$musteri_kontrol = $this->db->where([
			"musteri_iletisim_numarasi" => $query_result[0]->eski_servis_iletisim_numarasi
		])->get("musteriler")->result();
		if(count($musteri_kontrol)==0){
			$musdata['musteri_ad']                 = mb_strtoupper($this->pre_up(escape($query_result[0]->eski_servis_merkez_adi)), 'UTF-8');
			$musdata['musteri_iletisim_numarasi']  = escape(str_replace(" ","",$query_result[0]->eski_servis_iletisim_numarasi));
			$this->Musteri_model->insert($musdata);
            $insert_musteri_id = $this->db->insert_id();
			
			$musteridata['musteri_kod']   = "M1".str_pad($insert_musteri_id,5,"0",STR_PAD_LEFT);;
            $this->Musteri_model->update($insert_musteri_id,$musteridata);
			
			$merkez_data["merkez_yetkili_id"] = $insert_musteri_id;
            $merkez_data["merkez_adi"] = mb_strtoupper($this->pre_up(escape($query_result[0]->eski_servis_merkez_adi)), 'UTF-8');
            $merkez_data["merkez_ulke_id"] = 190;
            $merkez_data["merkez_il_id"] = 82;
            $merkez_data["merkez_ilce_id"] = 976;
            $merkez_data["merkez_adresi"] = escape($query_result[0]->eski_servis_adres);
            $this->Merkez_model->insert($merkez_data);
            $insert_merkez_id = $this->db->insert_id();
           redirect(site_url('servis/eski_servisler'));
             
			//redirect(site_url('cihaz/cihaz_tanimlama_view/'.$insert_merkez_id)."?filter=servis");
             


		}	

	//	echo json_encode($musteri_kontrol);
	}

	public function eski_servisler()
	{
		/*
		$sql = "SELECT eski_servisler.*,ekleme_durum,siparis_urunleri.siparis_urun_id,merkez_adi,musteri_ad,musteriler.musteri_iletisim_numarasi FROM `eski_servisler`
		LEFT JOIN siparis_urunleri ON siparis_urunleri.seri_numarasi = eski_servisler.eski_servis_seri_numarasi
		LEFT JOIN siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
		LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
		LEFT JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id  
		ORDER BY `eski_servisler`.`eski_servis_id` ASC
        ";*/
		$sql = "SELECT eski_servisler.*,siparis_urunleri.siparis_urun_id,siparisler.siparis_kodu,merkezler.*,ekleme_durum,musteriler.musteri_ad, musteriler.musteri_iletisim_numarasi,musteriler.musteri_id FROM `eski_servisler`
		LEFT JOIN siparis_urunleri ON siparis_urunleri.seri_numarasi = eski_servisler.eski_servis_seri_numarasi
		LEFT JOIN siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
		
		LEFT JOIN musteriler ON musteriler.musteri_iletisim_numarasi = eski_servisler.eski_servis_iletisim_numarasi  
		LEFT JOIN merkezler ON merkezler.merkez_yetkili_id = musteriler.musteri_id  
		
		ORDER BY `eski_servisler`.`eski_servis_id` ASC
        ";
        $query = $this->db->query($sql)->result();  
		$viewData["servisler"] = $query;
		$viewData["page"] = "servis/eskiservis";
		$this->load->view('base_view',$viewData);
	}
	public function servis_cihaz_tanimla_eski($eski_kayit_id = 0,$merkez_id = 0)
	{

		if($merkez_id == 0){
			echo "MÜŞTERİ BULUNAMADI";return;
					}

		
		$sql = "SELECT eski_servisler.*, merkezler.*, musteriler.* 
        FROM `eski_servisler`
     
		LEFT JOIN musteriler ON musteriler.musteri_iletisim_numarasi = eski_servisler.eski_servis_iletisim_numarasi  
		LEFT JOIN merkezler ON merkezler.merkez_yetkili_id = musteriler.musteri_id  
		
        WHERE eski_servis_id = ".$eski_kayit_id."
        ORDER BY `eski_servisler`.`eski_servis_id` ASC";

		$query_result = $this->db->query($sql)->result();  

		
		$cihazid = 1;	$renk = 1;
		switch ($query_result[0]->eski_servis_urun_adi) {
			case 'UMEX LAZER':
				$cihazid = 1;
				$renk = 1;
				break;
			case 'UMEX SLİM':
				$cihazid = 5;
				$renk = 5;
				break;		
				case 'UMEX Q':
					$cihazid = 7;
					$renk = 7;
					break;		
					case 'UMEX EMS':
						$cihazid = 3;
						$renk = 3;
						break;	
						case 'UMEX GOLD':
							$cihazid = 4;
							$renk = 4;
							break;	
								case 'ELSA SMART':
							$cihazid = 9;
							$renk = 18;
							break;	
			default:
				# code...
				break;
		}


		// Seri numarasından tarihi çıkar
$gun = substr($query_result[0]->eski_servis_seri_numarasi, 2, 2);
$ay = substr($query_result[0]->eski_servis_seri_numarasi, 4, 2);
$yil = "20" . substr($query_result[0]->eski_servis_seri_numarasi, 6, 2); // Yıl kısmını "20" ile başlatarak 4 haneli bir yıl elde ediyoruz.

 


		$siparis_id        = 0; 
        $cihaz_id          = $cihazid; 
        $seri_numarasi     = $query_result[0]->eski_servis_seri_numarasi; 
        $renk              = $renk; 
        $garanti_baslangic = "$yil-$ay-$gun"; 
        $garanti_bitis     = ($yil+2)."-$ay-$gun"; 
       

        $check_data = $this->db
        ->select("*")
        ->where(['seri_numarasi'=> $seri_numarasi])
        ->get("siparis_urunleri");

        if($check_data && $check_data->num_rows()){
            $this->session->set_flashdata('flashDanger','Girilen seri numarası başka bir cihaza tanımlanmıştır. Bilgileri kontrol edip tekrar deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
          }





        if($siparis_id == 0){

            $yeni_siparis["merkez_no"] =  $merkez_id;
            $yeni_siparis["siparisi_olusturan_kullanici"] = 1;
            $this->Siparis_model->insert($yeni_siparis);
            $siparis_id = $this->db->insert_id();
            $siparis_kod_format = "SPR".date("dmY").str_pad($siparis_id, 5, '0', STR_PAD_LEFT);
            $this->db->where('siparis_id', $siparis_id);
            $this->db->update('siparisler', ["siparis_kodu"=>$siparis_kod_format]);
               
			$siparis_onay_hareket_adim["siparis_no"] =  $siparis_id;
                $siparis_onay_hareket_adim["adim_no"] = 12;
                $siparis_onay_hareket_adim["onay_durum"] =  1;
                $siparis_onay_hareket_adim["onay_aciklama"] =   "Hızlı Sipariş Tanımlama - Otomatik Onay - Servis";
                $siparis_onay_hareket_adim["onay_kullanici_id"] =    1;   
                $this->Siparis_onay_hareket_model->insert($siparis_onay_hareket_adim);
             
		
        }

            $siparis_urun["siparis_kodu"] 		= $siparis_id;
			$siparis_urun["urun_no"] 			=  $cihaz_id;
            $siparis_urun["garanti_baslangic_tarihi"] 			=  $garanti_baslangic;
            $siparis_urun["garanti_bitis_tarihi"] 			=  $garanti_bitis;
            $siparis_urun["seri_numarasi"] 		=  $seri_numarasi;
			$siparis_urun["satis_fiyati"] 		= "0";
			$siparis_urun["pesinat_fiyati"] 	= "0";
			$siparis_urun["kapora_fiyati"] 		= "0";
			$siparis_urun["renk"] 				= $renk;
			$siparis_urun["odeme_secenek"]		= 1;
			$siparis_urun["vade_sayisi"]		= 0;
			$siparis_urun["damla_etiket"]		= 0;
			$siparis_urun["acilis_ekrani"]		= 0;
			$siparis_urun["basliklar"]		    = null;	
			$siparis_urun["siparis_urun_notu"] 	= "Hızlı Sipariş Tanımlama - Otomatik Onay";
			$this->Siparis_urun_model->insert($siparis_urun);
            $inserted_id = $this->db->insert_id();


redirect(base_url("servis/servis_cihaz_sorgula/".$inserted_id."/".$eski_kayit_id));


	}
	public function atis_form($atis_id = 0)
	{
		if(goruntuleme_kontrol("atis_duzenle")){
			if($atis_id != 0){
				$atis = $this->db->where("servis_atis_yukleme_id",$atis_id)->select("*")->from("servis_atis_yuklemeleri")->get()->result();
				$viewData["atis"] = $atis[0];
				$viewData["page"] = "servis/atis_duzenle";
				
				$this->load->view("base_view",$viewData);
			}
		}
		
	}
	public function update_atis_kayit($atis_id = 0)
	{
		if($atis_id != 0){
			$atis = $this->db->where("servis_atis_yukleme_id",$atis_id)->
			update("servis_atis_yuklemeleri",[
				"atis_yukleme_sayisi"=>$this->input->post("atis_yukleme_sayisi"),
				"servis_atis_yukleme_tarihi"=>$this->input->post("servis_atis_yukleme_tarihi"),
				"servis_atis_kategori_no"=>$this->input->post("servis_atis_kategori_no")
			]);

			$atiskayit = $this->db->where("servis_atis_yukleme_id",$atis_id)->select("*")->from("servis_atis_yuklemeleri")->get()->result();
			
			$urunkayit = $this->db->where("siparis_urun_id",$atiskayit[0]->servis_atis_siparis_urun_id)->select("*")
			->from("siparis_urunleri")->get()->result();
			


			redirect(base_url("servis/servis_cihaz_sorgula_view?data=".$urunkayit[0]->seri_numarasi));
			
		}
	}
	public function eski_servis_kayit_tanimla($eski_kayit_id)
	{
		
		$sql = "SELECT eski_servisler.*, siparis_urunleri.*, siparisler.*, merkezler.*, musteriler.* 
        FROM `eski_servisler`
        LEFT JOIN siparis_urunleri ON siparis_urunleri.seri_numarasi = eski_servisler.eski_servis_seri_numarasi
        LEFT JOIN siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
        LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
        LEFT JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id  
        WHERE eski_servis_id = ".$eski_kayit_id."
        ORDER BY `eski_servisler`.`eski_servis_id` ASC";

$query_result = $this->db->query($sql)->result();  
$viewData["query_result"] = $query_result;
$viewData["page"] = "servis/eskiservisform";
$this->load->view('base_view',$viewData);
return;





if (!empty($query_result)) {
    $output = ""; // Tüm verileri tutacak bir çıktı dizesi oluşturalım
    foreach ($query_result as $row) {
        $output .= "Eski Servis ID: " . $row->eski_servis_id . "<br>";
        $output .= "Eski Servis Seri Numarası: " . $row->eski_servis_seri_numarasi . "<br>";
        $output .= "Eski Servis Merkez Adı: " . $row->eski_servis_merkez_adi . "<br>";
        $output .= "Eski Servis İletişim: " . $row->eski_servis_iletisim_numarasi . "<br>";
		$output .= "Eski Servis Sorun Bildirimi: " . $row->eski_servis_sorun . "<br>";
		$output .= "Eski Servis İşlemler: " . $row->eski_servis_islem . "<br>";
		$output .= "Eski Servis Görevler: " . $row->eski_servis_gorev . "<br>";
		$output .= "Eski Servis Tip: " . $row->eski_servis_tip . "<br>";
		$output .= "Eski Servis Garanti: " . $row->eski_garanti_durumu . "<br>";
        $output .= "Eski Servis Durum: " . $row->eski_servis_durum . "<br>";
		$output .= "Eski Servis Kayıt Tarihi: " . $row->eski_servis_kayit_tarihi . "<br>";
		$output .= "Eski Servis Kapatma Tarihi: " . $row->eski_servis_kapatma_tarihi . "<br><br>";
      
		
		$output .= "Güncel Merkez: " . $row->merkez_adi . "<br>";
        $output .= "Güncel Müşteri: " . $row->musteri_ad . "<br>"; 
        $output .= "\n"; // Her kayıt arasına bir boş satır ekleyelim
    }
    echo $output; // Tüm verileri ekrana yazdır
} else {
    echo "Veri bulunamadı.";
}
return;
	}





	public function index()
	{
		yetki_kontrol("servis_goruntule");
       
		$viewData["page"] = "servis/list";
		$this->load->view('base_view',$viewData);
	}
	public function servis_cihaz_sorgula_view()
	{
		yetki_kontrol("servis_ekle");
		$viewData["page"] = "servis/form";
		$this->load->view('base_view',$viewData);
	}
	public function servis_cihaz_sorgula($siparis_urun_id = 0,$eski_kayit_id = 0)
	{
		yetki_kontrol("servis_ekle");
		if($siparis_urun_id == 0){
			$data = $this->Cihaz_model->get_all(["seri_numarasi"=>$this->input->post("cihaz_seri_numarasi")]); 
		}else{
			$data = $this->Cihaz_model->get_all(["siparis_urun_id"=>$siparis_urun_id]); 
		}
		if(count($data)>0){



					//***************** */
if($eski_kayit_id != 0){


					$sql22 = "SELECT eski_servisler.*, siparis_urunleri.*, siparisler.*, merkezler.*, musteriler.* 
					FROM `eski_servisler`
					LEFT JOIN siparis_urunleri ON siparis_urunleri.seri_numarasi = eski_servisler.eski_servis_seri_numarasi
					LEFT JOIN siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
					LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
					LEFT JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id  
					WHERE eski_servis_id = ".$eski_kayit_id."
					ORDER BY `eski_servisler`.`eski_servis_id` ASC";
			
			$query_result22 = $this->db->query($sql22)->result();  
			$viewData["query_result"] = $query_result22;
		}
					//***************** */




			$viewData["cihaz"] = $data[0];
			$viewData["bildirimler"] = $this->Servis_model->get_servis_bildirim_kategorileri();
			$viewData["sorunlar"] = $this->Servis_model->get_servis_sorun_kategorileri(); 
			$viewData["atis_yuklemeleri"] = $this->Servis_model->get_atis_yuklemeleri(["servis_atis_siparis_urun_id"=>$data[0]->siparis_urun_id]);
			$viewData["kullanicilar"] = $this->Kullanici_model->get_all(["servis_elemani"=>1]);   
			$viewData["atis_yukleme_sayisi"] = $this->Servis_model->get_atis_yuklemesayisi(["servis_atis_siparis_urun_id"=>$data[0]->siparis_urun_id]);
			$viewData["buzlanan_atis_yukleme_sayisi"] = $this->Servis_model->get_atis_yuklemesayisi(["servis_atis_siparis_urun_id"=>$data[0]->siparis_urun_id,"servis_atis_kategori_no"=>1]);
			$viewData["soguk_atis_yukleme_sayisi"] = $this->Servis_model->get_atis_yuklemesayisi(["servis_atis_siparis_urun_id"=>$data[0]->siparis_urun_id,"servis_atis_kategori_no"=>2]);
			
			$viewData["servis_tipleri"] = $this->Servis_model->get_servis_tipleri();
			$viewData["odeme_durumlari"] = $this->Servis_model->get_servis_odeme_durumlari();
			
			
			$viewData["gecmis_servisler"] = $this->Servis_model->get_all(["siparis_urun_id"=>$data[0]->siparis_urun_id]); 
			$viewData["page"] = "servis/servis_kayit_form";
			$this->load->view('base_view',$viewData);
			return;
		}else{
			redirect(base_url("cihaz/cihaz_tanimlama_view")."?filter=servis");
		}
		$viewData["page"] = "servis/form";
		$this->load->view('base_view',$viewData);
	}


	public function servis_detay($servis_id = 0,$guncellenecek_islem = 0,$guncellenecek_gorev = 0,$guncellenecek_bildirim = 0,$modal_format = 0)
	{
		yetki_kontrol("servis_duzenle");
	 	$data = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		 $filter = "";
		 if(!empty($_GET["filter"])){
			$filter = "?filter=duzenle";
		 }
		if(count($data)>0){
			if($guncellenecek_islem != 0 && empty($_GET["filter"])){
				$viewData["guncellenecek_islem"] = $this->Servis_model->get_servis_islemleri(["servis_islem_id"=>$guncellenecek_islem])[0];
			}
			if($guncellenecek_gorev != 0 && !empty($_GET["filter"])){
				$viewData["guncellenecek_gorev"] = $this->Servis_model->get_servis_gorevleri(["servis_gorev_id"=>$guncellenecek_gorev])[0];
				$filter = "?filter=duzenle";
			}
			if($guncellenecek_bildirim != 0 && !empty($_GET["filter"])){
				$viewData["guncellenecek_bildirim"] = $this->Servis_model->get_servis_bildirimleri(["servis_bildirim_id"=>$guncellenecek_bildirim])[0];
				$filter = "?filter=duzenle";
			}
			
			$dcihaz = $this->Cihaz_model->get_all(["siparis_urun_id"=>$data[0]->servis_cihaz_id])[0];
			$viewData["cihaz"] = $dcihaz;
			$viewData["servis"] = $data[0];
			$viewData["bildirimler"] = $this->Servis_model->get_servis_bildirim_kategorileri();
			$viewData["servis_gorevleri"] = $this->Servis_model->get_servis_gorevleri(["servis_gorev_servis_kayit_id"=>$servis_id]);
			$viewData["servis_islemleri"] = $this->Servis_model->get_servis_islemleri(["servis_tanim_id"=>$servis_id]);
			$viewData["servis_bildirimleri"] = $this->Servis_model->get_servis_bildirimleri(["servis_tanim_id"=>$servis_id]);
			
			$viewData["servis_islem_kategorileri"] = $this->Servis_model->get_servis_islem_kategorileri();
			$viewData["atis_yuklemeleri"] = $this->Servis_model->get_atis_yuklemeleri(["servis_atis_siparis_urun_id"=>$data[0]->siparis_urun_id]);
			$viewData["atis_yukleme_sayisi"] = $this->Servis_model->get_atis_yuklemesayisi(["servis_atis_siparis_urun_id"=>$data[0]->siparis_urun_id]);
			
			$viewData["servis_tipleri"] = $this->Servis_model->get_servis_tipleri();
			$viewData["odeme_durumlari"] = $this->Servis_model->get_servis_odeme_durumlari();
			
			$viewData["sorunlar"] = $this->Servis_model->get_servis_sorun_kategorileri(); 
			 $viewData["kullanicilar"] = $this->Kullanici_model->get_all(["servis_elemani"=>1]);   
			$viewData["gecmis_servisler"] = $this->Servis_model->get_all(["siparis_urun_id"=>$data[0]->siparis_urun_id]); 
			
            $this->db->order_by("cihaz_tanimlama_tarihi","DESC");
            $viewData["cstoklar"] = $this->Stok_model->stok_kayitlari_all(["tanimlanan_cihaz_seri_numarasi"=>$data[0]->seri_numarasi]); 

			
			
			
			$sql = "SELECT eski_servisler.*, siparis_urunleri.*, siparisler.*, merkezler.*, musteriler.* 
			FROM `eski_servisler`
			LEFT JOIN siparis_urunleri ON siparis_urunleri.seri_numarasi = eski_servisler.eski_servis_seri_numarasi
			LEFT JOIN siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
			LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
			LEFT JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id  
			WHERE eski_servis_seri_numarasi = '".$dcihaz->seri_numarasi."' and eski_servis_kayit_tarihi = '".date("Y-m-d H:i:s",strtotime($data[0]->servis_kayit_tarihi))."'
			ORDER BY `eski_servisler`.`eski_servis_id` ASC";
	
			$query_result = $this->db->query($sql)->result();  
			$viewData["query_result"] = $query_result;
			
			
			
			
			
			
			
			$viewData["page"] = "servis/detay";

			if($filter){
				$viewData["filter"] = $filter;
			}

			if($modal_format == 1){
				$viewData["pageformat"] = "1";
				$this->load->view('base_view_modal',$viewData);
			}else{
				$viewData["pageformat"] = "0";
				$this->load->view('base_view',$viewData);
			}


		
			return;
		}
		$viewData["page"] = "servis/detay";
		$this->load->view('base_view',$viewData);
	}




	public function servis_kayit_olustur()
	{
		yetki_kontrol("servis_ekle");
		$viewData["page"] = "servis/form";
		$this->load->view('base_view',$viewData);
	}
	




	public function servis_atis_yukle($siparis_urun_id = 0)
	{
		yetki_kontrol("servis_atis_yukleme");
		if($siparis_urun_id != 0){
			$data["servis_atis_kategori_no"] = $this->input->post("servis_atis_kategori_no");
			$data["atis_yukleme_sayisi"] = $this->input->post("servis_atis_yukleme_adet");
			$data["servis_atis_siparis_urun_id"] = $siparis_urun_id;
			$data["servis_atis_yukleme_tarihi"] = date("Y-m-d",strtotime($this->input->post("servis_atis_yukleme_tarihi")));
			$data["servis_atis_yukleme_kullanici_id"] = aktif_kullanici()->kullanici_id;
		
			
			$this->db->insert("servis_atis_yuklemeleri",$data);
			$inserted_id = $this->db->insert_id();  
			$servisdata['servis_atis_kod']   = "ATY".str_pad($inserted_id,6,"0",STR_PAD_LEFT);
			$this->db->where('servis_atis_yukleme_id', $inserted_id);
			$this->db->update('servis_atis_yuklemeleri', $servisdata);
		}
		redirect(base_url("servis/servis_cihaz_sorgula/".$siparis_urun_id));
		
	}


	public function servis_bildirim_tanimla($servis_id = 0)
	{
		
		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için bildirim tanımlama işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}


		yetki_kontrol("servis_duzenle");
		if($servis_id != 0){
			$data["servis_tanim_id"] = $servis_id;
			$data["servis_bildirim_kategori_id"] =  $this->input->post("servis_bildirim_kategori_id");
			$data["servis_bildirim_aciklama"] = $this->input->post("servis_bildirim_aciklama");
			$this->db->insert("servis_bildirimleri",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id)."?filter=duzenle");
		
	}







	public function servis_gorev_tanimla($servis_id = 0)
	{
		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için teknisyen tanımlama işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}


		yetki_kontrol("servis_duzenle");
		if($servis_id != 0){
			$data["servis_gorev_servis_kayit_id"] = $servis_id;
			$data["servis_gorev_kullanici_id"] =  $this->input->post("servis_gorev_kullanici_id");
			$data["servis_gorev_aciklama"] = $this->input->post("servis_gorev_aciklama");
			$this->db->insert("servis_gorevleri",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id)."?filter=duzenle");
		
	}
	public function servis_rapor($servis_id = 0)
	{
		yetki_kontrol("servis_duzenle");
		$data = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		
		if($servis_id != 0){  
			$viewData["servis_islemleri"] = $this->Servis_model->get_servis_islemleri(["servis_tanim_id"=>$servis_id]);
			$viewData["bildirimler"] = $this->Servis_model->get_servis_bildirimleri(["servis_tanim_id"=>$servis_id]);
			$viewData["gorevler"] = $this->Servis_model->get_servis_gorevleri(["servis_gorev_servis_kayit_id"=>$servis_id]);
			
			//echo json_encode($this->Servis_model->get_servis_bildirimleri(["servis_tanim_id"=>$servis_id]));return;
			$viewData["cihaz"] = $this->Cihaz_model->get_all(["siparis_urun_id"=>$data[0]->servis_cihaz_id])[0];
			$viewData["servis"] = $data[0];
			$this->load->view("servis/servis_sonu_rapor/main_content",$viewData);
		}else{

			redirect(base_url("servis/servis_detay/".$servis_id));
		}
		
	}


	public function servis_sonlandir($servis_id = 0)
	{
		yetki_kontrol("servis_duzenle");



		$islem_kontrol = $this->Servis_model->get_servis_islemleri(["servis_tanim_id"=>$servis_id]);
		$gorev_kontrol = $this->Servis_model->get_servis_gorevleri(["servis_gorev_servis_kayit_id"=>$servis_id]);

		if(count($islem_kontrol) <= 0){
			$this->session->set_flashdata('flashDanger','Servis işlemi tanımlanmadığı için bu servis kaydını sonlandıramazsınız.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}
		
		if(count($gorev_kontrol) <= 0){
			$this->session->set_flashdata('flashDanger','Servis teknisyeni tanımlanmadığı için bu servis kaydını sonlandıramazsınız.');
			redirect(base_url("servis/servis_detay/".$servis_id));	
		}




		if($servis_id != 0){
			$data["servis_durum_tanim_id"] = 2;
			$data["servis_durum_guncelleme_tarihi"] = date("Y-m-d H:i:s");
			$data["servis_durum_guncelleyen_kullanici_id"] = aktif_kullanici()->kullanici_id;
			$this->db->where(["servis_id" => $servis_id]);
			$this->db->update("servisler",$data);
		}
		redirect(base_url("servis"));
		
	}

	public function servis_iptal_et($servis_id = 0)
	{
		yetki_kontrol("servis_duzenle");
		if($servis_id != 0){
			$data["servis_durum_tanim_id"] = 3;
			$data["servis_durum_guncelleme_tarihi"] = date("Y-m-d H:i:s");
			$this->db->where(["servis_id" => $servis_id]);
			$this->db->update("servisler",$data);
		}
		redirect(base_url("servis"));
		
	}
	

	public function servis_devam_ettir($servis_id = 0)
	{
		yetki_kontrol("servis_duzenle");
		if($servis_id != 0){
			$data["servis_durum_tanim_id"] = 1;
			$data["servis_durum_guncelleme_tarihi"] = date("Y-m-d H:i:s");
			$this->db->where(["servis_id" => $servis_id]);
			$this->db->update("servisler",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id));
		
	}
	
	public function servis_gorev_sil($servis_id = 0,$gorev_id = 0)
	{

		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için teknisyen silme işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}


		yetki_kontrol("servis_duzenle");
		if($gorev_id != 0){
			$this->db->where(["servis_gorev_id"=>$gorev_id]);
			$this->db->delete("servis_gorevleri");
		}
		redirect(base_url("servis/servis_detay/".$servis_id)."?filter=duzenle");
		
	}

	public function servis_bildirim_sil($servis_id = 0,$bildirim_id = 0)
	{
		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için bildirim silme işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}

		yetki_kontrol("servis_duzenle");
		if($bildirim_id != 0){
			$this->db->where(["servis_bildirim_id "=>$bildirim_id]);
			$this->db->delete("servis_bildirimleri");
		}
		redirect(base_url("servis/servis_detay/".$servis_id)."?filter=duzenle");
		
	}

public function servis_gorev_guncelle($servis_id = 0,$guncellenecek_gorev = 0)
	{

		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için teknisyen güncelleme işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}


		yetki_kontrol("servis_duzenle");
		if($servis_id != 0 && $guncellenecek_gorev != 0){
			$data["servis_gorev_kullanici_id"] =  $this->input->post("servis_gorev_kullanici_id");
			$data["servis_gorev_aciklama"] = $this->input->post("servis_gorev_aciklama");
			$this->db->where(["servis_gorev_id"=>$guncellenecek_gorev]);
			$this->db->update("servis_gorevleri",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id)."?filter=duzenle");
		
		
	}

public function servis_bildirim_guncelle($servis_id = 0,$guncellenecek_bildirim = 0)
	{

		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için bildirim güncelleme işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}

		yetki_kontrol("servis_duzenle");
		if($servis_id != 0 && $guncellenecek_bildirim != 0){
			$data["servis_bildirim_kategori_id"] =  $this->input->post("servis_bildirim_kategori_id");
			$data["servis_bildirim_aciklama"] = $this->input->post("servis_bildirim_aciklama");
			$this->db->where(["servis_bildirim_id"=>$guncellenecek_bildirim]);
			$this->db->update("servis_bildirimleri",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id)."?filter=duzenle");
		
		
	}

	public function servis_bilgi_guncelle($servis_id = 0)
	{

		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için bilgi tanımlama işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}


		yetki_kontrol("servis_duzenle");
		if($servis_id != 0){

			$servis_tip = $this->input->post("servis_tip_tanim_no");
			$odeme_durum = $this->input->post("servis_odeme_tanim_no");
			$servis_bildirim_tanim_no = $this->input->post("servis_bildirim_tanim_no");

			$servis_data["servis_bildirim_tanim_no"] = $servis_bildirim_tanim_no;
			$servis_data["servis_tip_tanim_no"] = $servis_tip;
			$servis_data["servis_odeme_tanim_no"] = $odeme_durum;
			$this->db->where(["servis_id"=>$servis_id]);
			$this->db->update("servisler",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id)."?filter=duzenle");
		
		
	}




	public function servis_islem_tanimla($servis_id = 0)
	{
		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için işlem tanımlama işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}


		yetki_kontrol("servis_duzenle");
		if($servis_id != 0){

			
			if($this->input->post("servis_parca_seri_no")){
				$stok_kontrol = $this->db->where(["stok_cikis_yapildi"=>1,"stok_tanimlanma_durum"=>0,"stok_seri_kod" => str_replace(" ","",$this->input->post("servis_parca_seri_no"))])->select('*')->from('stoklar sh')->get()->result();
				
				if(count($stok_kontrol) <= 0){
					//$stok_kontrol = $this->db->where(["stok_seri_kod" => str_replace(" ","",$this->input->post("servis_parca_seri_no"))])->select('*')->from('stoklar sh')->get()->result();
				}
				
				
				if(count($stok_kontrol) <= 0){
					$this->session->set_flashdata('flashDanger','Girilen seri numarası ile tanımlanmış ve stok çıkışı yapılmış parça kaydı bulunamadı.Parça başka bir cihaza tanımlanmış olabilir. Stok yetkiliniz ile iletişime geçiniz.');
					redirect(base_url("servis/servis_detay/".$servis_id));
				}else{
					$this->db->where(["stok_id"=>$stok_kontrol[0]->stok_id]);
					$this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>$datac[0]->seri_numarasi,"stok_tanimlanma_durum"=>1,"cihaz_tanimlama_tarihi"=>date("Y-m-d H:i")]);
		
				}
				
			}
			
		


			$data["servis_tanim_id"] = $servis_id;
			$data["servis_parca_seri_no"] = $this->input->post("servis_parca_seri_no");
			$data["servis_islem_tanim_id"] =  $this->input->post("servis_islem_tanim_id");
			$data["servis_islem_aciklama"] = $this->input->post("servis_islem_aciklama");
			$data["servis_islem_kullanici_id"] =  aktif_kullanici()->kullanici_id;
			$this->db->insert("servis_islemleri",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id));
		
	}
	

	public function servis_islem_guncelle($servis_id = 0,$guncellenecek_islem = 0)
	{
		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için işlem güncelleme işlemi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}


		yetki_kontrol("servis_duzenle");
		if($servis_id != 0 && $guncellenecek_islem != 0){
			$data["servis_islem_tanim_id"] =  $this->input->post("servis_islem_tanim_id");
			$data["servis_islem_aciklama"] = $this->input->post("servis_islem_aciklama");
			$this->db->where(["servis_islem_id"=>$guncellenecek_islem]);
			$this->db->update("servis_islemleri",$data);
		}
		redirect(base_url("servis/servis_detay/".$servis_id));
		
	}
	


	public function servis_islem_sil($servis_id = 0,$islem_id = 0)
	{
		$datac = $this->Servis_model->get_all(["servis_id"=>$servis_id]); 
		if($datac[0]->servis_durum_tanim_id == 2){
			$this->session->set_flashdata('flashDanger','Sonlandırılan servis kayıtları için işlem silme hareketi yapılamaz. Servis durumunu aktif hale getirip tekrar deneyiniz.');
			redirect(base_url("servis/servis_detay/".$servis_id));
		}

		yetki_kontrol("servis_duzenle");
		if($islem_id != 0){
			$this->db->where(["servis_islem_id"=>$islem_id]);
			$this->db->delete("servis_islemleri");
		}
		redirect(base_url("servis/servis_detay/".$servis_id));
		
	}





	public function servis_kaydet($siparis_urun_id = 0,$eski_servis_id = 0)
	{
		yetki_kontrol("servis_ekle");
		 if($siparis_urun_id != 0){
			 

			$gorevler = json_decode(json_encode($this->input->post()))->gorevler;
		//	$bildirim_tipleri = json_decode(json_encode($this->input->post()))->bildirim_tip;
			$sorun_kategori = json_decode(json_encode($this->input->post()))->sorun_kategori;
			$sorun_aciklama = json_decode(json_encode($this->input->post()))->sorun_aciklama;
			$servis_tip = $this->input->post("servis_tip_tanim_no");
			$odeme_durum = $this->input->post("servis_odeme_tanim_no");
			$servis_bildirim_tanim_no = $this->input->post("servis_bildirim_tanim_no");
			$servis_data["servis_bildirim_tanim_no"] = $servis_bildirim_tanim_no;
			$servis_data["servis_tip_tanim_no"] = $servis_tip;
			$servis_data["servis_odeme_tanim_no"] = $odeme_durum;
			$servis_data["servis_cihaz_id"] = $siparis_urun_id;
			$servis_data["servis_kayit_olusturan_kullanici_id"] = aktif_kullanici()->kullanici_id;
			//************ */
			if($eski_servis_id != 0){

		
			$sql435 = "SELECT eski_servisler.*, siparis_urunleri.*, siparisler.*, merkezler.*, musteriler.* 
			FROM `eski_servisler`
			LEFT JOIN siparis_urunleri ON siparis_urunleri.seri_numarasi = eski_servisler.eski_servis_seri_numarasi
			LEFT JOIN siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
			LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
			LEFT JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id  
			WHERE eski_servis_id = ".$eski_servis_id."
			ORDER BY `eski_servisler`.`eski_servis_id` ASC";
			
			$query_result435 = $this->db->query($sql435)->result();
			$servis_data["servis_kayit_tarihi"] = date("Y-m-d H:i:s",strtotime($query_result435[0]->eski_servis_kayit_tarihi));  
			$servis_data["servis_durum_guncelleme_tarihi"] = date("Y-m-d H:i:s",strtotime($query_result435[0]->eski_servis_kapatma_tarihi));  
			$servis_data["servis_durum_tanim_id"] =  2;  
			$servis_data["servis_durum_guncelleyen_kullanici_id"] = 1;  
			
			$this->db->where('eski_servis_id', $eski_servis_id);
			$this->db->update('eski_servisler', ["ekleme_durum"=>1]);
			
			}
			//************ */


			$this->db->insert("servisler",$servis_data);
			$servis_id = $this->db->insert_id();
			$koddata['servis_kod']   = "SRV".str_pad($servis_id,6,"0",STR_PAD_LEFT);
			$this->db->where('servis_id', $servis_id);
			$this->db->update('servisler', $koddata);
			 
			foreach ($gorevler as $gorev) {
				$gorev_data["servis_gorev_servis_kayit_id"] = $servis_id;
				$gorev_data["servis_gorev_kullanici_id"] = $gorev;
				$this->db->insert("servis_gorevleri",$gorev_data);
			}
			for ($i=0; $i < count($sorun_kategori) ; $i++) { 
				$bildirim_data["servis_bildirim_kategori_id"] = $sorun_kategori[$i];
				$bildirim_data["servis_bildirim_aciklama"] = $sorun_aciklama[$i];
				$bildirim_data["servis_tanim_id"] = $servis_id;
				$this->db->insert("servis_bildirimleri",$bildirim_data);
			}

			if($eski_servis_id != 0){
				
				redirect(base_url("servis/eski_servisler"));

			}






 sendSmsData("05468311015","SERVİS KAYDI AÇILDI ".date("d.m.Y H:i")."\n".base_url("servis/servis_detay/".$servis_id));
sendSmsData("05382197344","SERVİS KAYDI AÇILDI ".date("d.m.Y H:i")."\n".base_url("servis/servis_detay/".$servis_id));

sendSmsData("05453950049","SERVİS KAYDI AÇILDI ".date("d.m.Y H:i")."\n".base_url("servis/servis_detay/".$servis_id));


			redirect(base_url("servis/servis_detay/".$servis_id));


		 }
	 
	}
 



	public function servisler_ajax() { 
		yetki_kontrol("servis_goruntule");
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

        if(!empty($search)) {
            

			//------------------------------------------

 
			if(!empty($search)) {
				$this->db->like('servis_kod', $search); 
				$this->db->or_like('seri_numarasi', $search);   
				 $this->db->or_like('musteri_iletisim_numarasi', str_replace(" ","",$search)); 
				 $this->db->or_like('musteri_ad', $search); 
				 $this->db->or_like('merkez_adi', $search); 
				 $this->db->or_like('sehir_adi', $search); 
				 $this->db->or_like('ilce_adi', $search); 
				 $this->db->or_like('urun_adi', $search); 
			}
	
		 
			if(!empty($this->input->get('page'))){
					 $this->db->where('servis_durum_tanim_id', $this->input->get('page'));  
			
				 
				
			}
			   
	
	
			$query = $this->db 
			->order_by($order, $dir)
		->order_by('servis_kayit_tarihi', 'DESC')
	
		->limit($limit, $start)
			->select("servisler.servis_kod,servisler.servis_id,servisler.servis_kayit_tarihi,servisler.servis_durum_guncelleme_tarihi,servisler.servis_durum_tanim_id,urun_renkleri.renk_adi,kullanicilar.kullanici_ad_soyad,   borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,siparis_urunleri.siparis_urun_id,urunler.urun_adi,servis_durum_kategorileri.servis_durum_kategori_adi,sehirler.sehir_adi,ilceler.ilce_adi,siparis_urunleri.seri_numarasi,siparis_urunleri.garanti_baslangic_tarihi,siparis_urunleri.garanti_bitis_tarihi,merkezler.merkez_adi,merkezler.merkez_adresi,musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi,musteriler.yetkili_adi_2,musteriler.yetkili_iletisim_2,musteriler.musteri_id")
			->from('servisler')
			->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id = servisler.servis_cihaz_id')
			->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
			->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
			->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
			->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
			->join('servis_durum_kategorileri', 'servis_durum_kategorileri.servis_durum_kategori_id = servisler.servis_durum_tanim_id')
			->join('sehirler', 'sehirler.sehir_id = merkezler.merkez_il_id')
			->join('ilceler', 'ilceler.ilce_id = merkezler.merkez_ilce_id')
			->join('kullanicilar', 'kullanicilar.kullanici_id = servisler.servis_kayit_olusturan_kullanici_id')
			->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
			->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
				
			->get();
						 
					
	
						  
	
			$data = [];
			foreach ($query->result() as $row) {
	
				$icon = "";
				if($row->servis_durum_tanim_id == 1){
					$icon = '<div > <svg aria-label="currently running: " width="17px" height="17px" fill="none" viewBox="0 0 16 16" class="anim-rotate" xmlns="http://www.w3.org/2000/svg"> <path fill="none" stroke="#DBAB0A" stroke-width="2" d="M3.05 3.05a7 7 0 1 1 9.9 9.9 7 7 0 0 1-9.9-9.9Z" opacity=".5"></path> <path fill="#eda705" fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"></path> <path fill="#eda705" d="M14 8a6 6 0 0 0-6-6V0a8 8 0 0 1 8 8h-2Z"></path> </svg> </div>';
				}else if(($row->servis_durum_tanim_id == 2)){
					$icon = '<span><i class="fas fa-check-circle text-green pt-2 pb-2" style="    font-size: 16px;"></i></span>';
				}else{
					$icon = '<span><i class="fas fa-ban text-danger pt-2 pb-2" style="    font-size: 16px;"></i> </span>';
				}
	
				$date_close = "";
				if(($row->servis_durum_tanim_id == 2)){
					$date_close = '<span style="color:#cf0706;"><b>Kapanış : </b>'.date("d.m.Y H:i",strtotime($row->servis_durum_guncelleme_tarihi)).'</span>';
				}else if(($row->servis_durum_tanim_id == 1)){
					$date_close = '<span style="opacity:0.5;color:green;">Devam Ediyor...</span>';
				} 
	
				$borc_uyarisi = "";
				if($row->cihaz_borc_uyarisi == 1){
					 
					$borc_uyarisi = '<a style="padding-top:3px;font-size: 12px!important;color:white!important;" class="btn btn-danger yanipsonenyazifast btn-xs">Borç Uyarısı</a>';
					 
				  }
	
	
				  $islem_button = "";
						  if(($row->servis_durum_tanim_id == 3)){
							 
							$islem_button = '<span class="text-danger">İptal Edildi ('.date("d.m.Y H:i",strtotime($row->servis_durum_guncelleme_tarihi)).')</span>';
							
						  }else{
							
							
							
							if(($row->servis_durum_tanim_id == 1)){
	 
								$islem_button = '<a type="button" onclick="confirm_action(\'İptal İşlemini Onayla\', \'Seçilen bu kaydı iptal etmek istediğinize emin misiniz ? Bu işlem geri alınamaz.\', \'Onayla\', \'' . base_url('servis/servis_iptal_et/'.$row->servis_id) . '\');" class="text-danger"><i class="fas fa-times-circle"></i> Servisi İptal Et</a>';
			 
	 
							}else{
							
						 
	 
							}
					   
						   
					  
						  }
						 
	
	
	
	
				$data[] = [
					$icon,
					'<a style="   color:#000000;" class="custom-href" href="'.base_url("servis/servis_detay/".$row->servis_id).'"><b>'.$row->servis_kod.'</b></a>'.($islem_button ? "<br>".$islem_button : ""), 
				  '<span style="color:green"><b>S. Açılış : </b>'.date("d.m.Y H:i",strtotime($row->servis_kayit_tarihi)).'</span><br>'. $date_close,
				 
				  $borc_uyarisi."<a  class='custom-href' target='_blank' style='color:#00346d;' href='".base_url("musteri/profil/".$row->musteri_id)."'><b><i class='fa fa-user-circle' style='color: #035ab9;'></i> ".$row->musteri_ad."</b></a> "."<br>İletişim : ".formatTelephoneNumber($row->musteri_iletisim_numarasi),
				  "<b>".strtoupper($row->urun_adi)." (".$row->renk_adi.")</b><br>".$row->seri_numarasi,
				  "<b><i class='fa fa-building' style='color: #ff6c00;'></i> ".$row->merkez_adi."</b> / ".$row->sehir_adi." (".$row->ilce_adi.")"."<br>".($row->merkez_adresi != "" ? $row->merkez_adresi : "<span style='opacity:0.4'>BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>")
				 
				
				  
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
			return;


			//-------------------------------------------




        }

	 
		if(!empty($this->input->get('page'))){
			 	$this->db->where('servis_durum_tanim_id', $this->input->get('page'));  
        
			 
			
		}
		   


		$query = $this->db 
		 
	->order_by('servis_kayit_tarihi', 'DESC')

	->limit($limit, $start)
		->select("servisler.servis_kod,servisler.servis_id,siparisler.merkez_no,servisler.servis_kayit_tarihi,servisler.servis_durum_guncelleme_tarihi,servisler.servis_durum_tanim_id,urun_renkleri.renk_adi,    borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,siparis_urunleri.siparis_urun_id,urunler.urun_adi,servis_durum_kategorileri.servis_durum_kategori_adi,siparis_urunleri.seri_numarasi,siparis_urunleri.garanti_baslangic_tarihi,siparis_urunleri.garanti_bitis_tarihi")
		->from('servisler')
		->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id = servisler.servis_cihaz_id')
		->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
		->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
		 
		->join('servis_durum_kategorileri', 'servis_durum_kategorileri.servis_durum_kategori_id = servisler.servis_durum_tanim_id')
		  
		->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
		->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
      	  
		->get();
					 
				

                      

        $data = [];
        foreach ($query->result() as $row) {


			

			$icon = "";
			if($row->servis_durum_tanim_id == 1){
				$icon = '<div > <svg aria-label="currently running: " width="17px" height="17px" fill="none" viewBox="0 0 16 16" class="anim-rotate" xmlns="http://www.w3.org/2000/svg"> <path fill="none" stroke="#DBAB0A" stroke-width="2" d="M3.05 3.05a7 7 0 1 1 9.9 9.9 7 7 0 0 1-9.9-9.9Z" opacity=".5"></path> <path fill="#eda705" fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"></path> <path fill="#eda705" d="M14 8a6 6 0 0 0-6-6V0a8 8 0 0 1 8 8h-2Z"></path> </svg> </div>';
			}else if(($row->servis_durum_tanim_id == 2)){
				$icon = '<span><i class="fas fa-check-circle text-green pt-2 pb-2" style="    font-size: 16px;"></i></span>';
			}else{
				$icon = '<span><i class="fas fa-ban text-danger pt-2 pb-2" style="    font-size: 16px;"></i> </span>';
			}

			$date_close = "";
			if(($row->servis_durum_tanim_id == 2)){
				$date_close = '<span style="color:#cf0706;"><b>Kapanış : </b>'.date("d.m.Y H:i",strtotime($row->servis_durum_guncelleme_tarihi)).'</span>';
			}else if(($row->servis_durum_tanim_id == 1)){
				$date_close = '<span style="opacity:0.5;color:green;">Devam Ediyor...</span>';
			} 

			$borc_uyarisi = "";
			if($row->cihaz_borc_uyarisi == 1){
				 
				$borc_uyarisi = '<a style="padding-top:3px;font-size: 12px!important;color:white!important;" class="btn btn-danger yanipsonenyazifast btn-xs">Borç Uyarısı</a>';
				 
			  }


			  $islem_button = "";
                      if(($row->servis_durum_tanim_id == 3)){
                         
						$islem_button = '<span class="text-danger">İptal Edildi</span>';
                        
                      }else{
                        
                        
                        
                        if(($row->servis_durum_tanim_id == 1)){
 
							$islem_button = '<a type="button" onclick="confirm_action(\'İptal İşlemini Onayla\', \'Seçilen bu kaydı iptal etmek istediğinize emin misiniz ? Bu işlem geri alınamaz.\', \'Onayla\', \'' . base_url('servis/servis_iptal_et/'.$row->servis_id) . '\');" class="text-danger"><i class="fas fa-times-circle"></i> Servisi İptal Et</a>';
         
 
                        }else{
                        
                     
 
                        }
                   
                       
                  
                      }
                     


					  $musterimerkezdata =  $this->db
					  ->where("merkez_id",$row->merkez_no)
					  ->join('musteriler', 'musteriler.musteri_id = merkez_yetkili_id')
					   ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
					   ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
					  ->order_by('merkez_id', 'ASC')->get("merkezler")->result()[0];
		  

            $data[] = [
                $icon,
                '<a style="   color:#000000;" class="custom-href" href="'.base_url("servis/servis_detay/".$row->servis_id).'"><b>'.$row->servis_kod.'</b></a>'.($islem_button ? "<br>".$islem_button : ""), 
			  '<span style="color:green"><b>S. Açılış : </b>'.date("d.m.Y H:i",strtotime($row->servis_kayit_tarihi)).'</span><br>'. $date_close,
			 
			  $borc_uyarisi."<a  class='custom-href' target='_blank' style='color:#00346d;' href='".base_url("musteri/profil/".$musterimerkezdata->musteri_id)."'><b><i class='fa fa-user-circle' style='color: #035ab9;'></i> ".$musterimerkezdata->musteri_ad."</b></a> "."<br>İletişim : ".formatTelephoneNumber($musterimerkezdata->musteri_iletisim_numarasi),
			  "<b>".strtoupper($row->urun_adi)." (".$row->renk_adi.")</b><br>".$row->seri_numarasi,
			  "<b><i class='fa fa-building' style='color: #ff6c00;'></i> ".$musterimerkezdata->merkez_adi."</b> / ".$musterimerkezdata->sehir_adi." (".$musterimerkezdata->ilce_adi.")"."<br>".($musterimerkezdata->merkez_adresi != "" ? $musterimerkezdata->merkez_adresi : "<span style='opacity:0.4'>BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>")
			 
			
			  
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
