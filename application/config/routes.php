<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'anasayfa';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['giris-yap'] = 'Login';

$route['kullanici'] = 'Kullanici';
$route['kullanici/ekle'] = 'Kullanici/add';
$route['kullanici/duzenle/(:any)'] = 'Kullanici/edit/$1';
$route['kullanici/sil/(:any)'] = 'Kullanici/delete/$1';

$route['kullanici-yetkileri'] = 'Kullanici_yetkileri';
$route['kullanici-yetkileri/ekle'] = 'Kullanici_yetkileri/add';
$route['kullanici-yetkileri/duzenle/(:any)'] = 'Kullanici_yetkileri/edit/$1';
$route['kullanici-yetkileri/sil/(:any)'] = 'Kullanici_yetkileri/delete/$1';

$route['departman'] = 'Departman';
$route['departman/ekle'] = 'Departman/add';
$route['departman/duzenle/(:any)'] = 'Departman/edit/$1';
$route['departman/sil/(:any)'] = 'Departman/delete/$1';


$route['talep'] = 'Talep';
$route['talep/ekle'] = 'Talep/add';
$route['talep/duzenle/(:any)'] = 'Talep/edit/$1';
$route['talep/yonlendirme-duzenle/(:any)'] = 'Talep/edit/0/$1';
$route['talep/sil/(:any)'] = 'Talep/delete/$1';
$route['talep/satis'] = 'Talep/index_boxed';
$route['talep/tum-kayitlar'] = 'Talep/index/1';
$route['talep/rapor'] = 'Talep/report';
 
$route['egitim'] = 'Egitim';
$route['egitim/ekle'] = 'Egitim/add';
$route['egitim/duzenle/(:any)'] = 'Egitim/edit/$1';

  
$route['bekleyen-talepler']             = 'Talep/index_boxed/1';
$route['satis-talepler']                = 'Talep/index_boxed/2';
$route['bilgi-verildi-talepler']        = 'Talep/index_boxed/3';
$route['musteri-memnuniyeti-talepler']  = 'Talep/index_boxed/4';
$route['donus-yapilacak-talepler']      = 'Talep/index_boxed/5';
$route['olumsuz-talepler']              = 'Talep/index_boxed/6';
$route['numara-hatali-talepler']        = 'Talep/index_boxed/7';
$route['tekrar-aranacak-talepler']      = 'Talep/index_boxed/8';
$route['tum-taleplerim']                = 'Talep/index_boxed/999';

$route['tum-bekleyen-talepler']             = 'Talep/index_boxed/1/1';
$route['tum-satis-talepler']                = 'Talep/index_boxed/2/1';
$route['tum-bilgi-verildi-talepler']        = 'Talep/index_boxed/3/1';
$route['tum-musteri-memnuniyeti-talepler']  = 'Talep/index_boxed/4/1';
$route['tum-donus-yapilacak-talepler']      = 'Talep/index_boxed/5/1';
$route['tum-olumsuz-talepler']              = 'Talep/index_boxed/6/1';
$route['tum-numara-hatali-talepler']        = 'Talep/index_boxed/7/1';
$route['tum-tekrar-aranacak-talepler']      = 'Talep/index_boxed/8/1';


$route['onay-bekleyen-sertifikalar']      = 'Egitim/onay_bekleyenler_sertifikalar';


$route['urun'] = 'Urun';
$route['urun/ekle'] = 'Urun/add';
$route['urun/duzenle/(:any)'] = 'Urun/edit/$1';
$route['urun/sil/(:any)'] = 'Urun/delete/$1';

$route['kullanici_grup'] = 'kullanici_grup';
$route['kullanici_grup/ekle'] = 'kullanici_grup/add';
$route['kullanici_grup/duzenle/(:any)'] = 'kullanici_grup/edit/$1';
$route['kullanici_grup/sil/(:any)'] = 'kullanici_grup/delete/$1';

$route['sehir'] = 'sehir';
$route['sehir/ekle'] = 'sehir/add';
$route['sehir/duzenle/(:any)'] = 'sehir/edit/$1';
$route['sehir/sil/(:any)'] = 'sehir/delete/$1';

$route['ilce/ekle'] = 'ilce/add';
$route['ilce/duzenle/(:any)'] = 'ilce/edit/$1';
$route['ilce/sil/(:any)'] = 'ilce/delete/$1';

$route['dokuman_kategori'] = 'dokuman_kategori';
$route['dokuman_kategori/ekle'] = 'dokuman_kategori/add';
$route['dokuman_kategori/duzenle/(:any)'] = 'dokuman_kategori/edit/$1';
$route['dokuman_kategori/sil/(:any)'] = 'dokuman_kategori/delete/$1';

$route['dokuman/kategori/(:any)'] = 'dokuman/index/$1';

$route['dokuman'] = 'dokuman';
$route['dokuman/ekle'] = 'dokuman/add';
$route['dokuman/duzenle/(:any)'] = 'dokuman/edit/$1';
$route['dokuman/sil/(:any)'] = 'dokuman/delete/$1';
$route['dokuman/inceleme/ekle/(:any)'] = 'dokuman/inceleme_ekle/$1';

 

$route['istek-kategori'] = 'istek_kategori';
$route['istek-kategori/ekle'] = 'istek_kategori/add';
$route['istek-kategori/duzenle/(:any)'] = 'istek_kategori/edit/$1';
$route['istek-kategori/sil/(:any)'] = 'istek_kategori/delete/$1';

$route['duyuru-kategori'] = 'duyuru_kategori';
$route['duyuru-kategori/ekle'] = 'duyuru_kategori/add';
$route['duyuru-kategori/duzenle/(:any)'] = 'duyuru_kategori/edit/$1';
$route['duyuru-kategori/sil/(:any)'] = 'duyuru_kategori/delete/$1';


$route['istek'] = 'istek';
$route['istek/ekle'] = 'istek/add';
$route['istek/duzenle/(:any)'] = 'istek/edit/$1';
$route['istek/sil/(:any)'] = 'istek/delete/$1';
$route['istek/kategori/(:any)'] = 'istek/get_by_categori/$1';
$route['istek/onayla/(:any)'] = 'istek/update_success_ticket/$1';
$route['istek/reddet/(:any)'] = 'istek/update_danger_ticket/$1';
$route['istek/islem/(:any)'] = 'istek/update_start_ticket/$1';
$route['istek/get_ticket_actions/(:any)'] = 'istek/get_ticket_actions/$1';
$route['istek/rapor/(:any)'] = 'istek/report/$1';


$route['is_tip'] = 'is_tip';
$route['is_tip/ekle'] = 'is_tip/add';
$route['is_tip/duzenle/(:any)'] = 'is_tip/edit/$1';
$route['is_tip/sil/(:any)'] = 'is_tip/delete/$1';

$route['duyuru'] = 'duyuru';
$route['duyuru/ekle'] = 'duyuru/add';
$route['duyuru/duzenle/(:any)'] = 'duyuru/edit/$1';
$route['duyuru/sil/(:any)'] = 'duyuru/delete/$1';
$route['duyuru/tum-duyurular'] = 'duyuru/boxed';

$route['banner'] = 'banner';
$route['banner/ekle'] = 'banner/add';
$route['banner/duzenle/(:any)'] = 'banner/edit/$1';
$route['banner/sil/(:any)'] = 'banner/delete/$1'; 

$route['istek_birim'] = 'istek_birim';
$route['istek_birim/ekle'] = 'istek_birim/add';
$route['istek_birim/duzenle/(:any)'] = 'istek_birim/edit/$1';
$route['istek_birim/sil/(:any)'] = 'istek_birim/delete/$1';

$route['demirbas_birim'] = 'demirbas_birim';
$route['demirbas_birim/ekle'] = 'demirbas_birim/add';
$route['demirbas_birim/duzenle/(:any)'] = 'demirbas_birim/edit/$1';
$route['demirbas_birim/sil/(:any)'] = 'demirbas_birim/delete/$1';


$route['demirbas_kategori'] = 'demirbas_kategori';
$route['demirbas_kategori/ekle'] = 'demirbas_kategori/add';
$route['demirbas_kategori/duzenle/(:any)'] = 'demirbas_kategori/edit/$1';
$route['demirbas_kategori/sil/(:any)'] = 'demirbas_kategori/delete/$1';

$route['demirbas'] = 'demirbas';
$route['demirbas/ekle/(:any)'] = 'demirbas/add/$1';
$route['demirbas/duzenle/(:any)'] = 'demirbas/edit/$1';
$route['demirbas/sil/(:any)'] = 'demirbas/delete/$1';
$route['demirbas/birim/(:any)'] = 'demirbas/index/$1';
$route['demirbas/islem/sil/(:any)/(:any)'] = 'demirbas/delete_action/$1/$2';


$route['istek_durum'] = 'istek_durum';
$route['istek_durum/ekle'] = 'istek_durum/add';
$route['istek_durum/duzenle/(:any)'] = 'istek_durum/edit/$1';
$route['istek_durum/sil/(:any)'] = 'istek_durum/delete/$1';


$route['netgsm/santral'] = 'netgsm/santral';


$route['musteri'] = 'musteri';
$route['musteri/ekle'] = 'musteri/add';
$route['musteri/duzenle/(:any)'] = 'musteri/edit/$1';
$route['musteri/sil/(:any)'] = 'musteri/delete/$1'; 
$route['musteri/profil/(:any)'] = 'musteri/profile/$1'; 


$route['siparisler'] = 'siparis';
$route['tum-siparisler'] = 'siparis';
$route['onay-bekleyen-siparisler'] = 'siparis/onay_bekleyenler';
$route['onay-bekleyen-siparisler-copy'] = 'siparis/onay_bekleyenler_copy';


$route['siparis/report/(:any)'] = 'siparis/report/$1';
$route['siparis/ekle/(:any)'] = 'siparis/add/$1';

$route['merkez'] = 'merkez';
$route['merkez/ekle'] = 'merkez/add';
$route['merkez/duzenle/(:any)'] = 'merkez/edit/$1';
$route['merkez/sil/(:any)'] = 'merkez/delete/$1'; 
$route['merkez/profil/(:any)'] = 'merkez/profile/$1'; 

$route['siparis/onayla/(:any)'] = 'siparis/siparis_onayla/$1'; 
$route['siparis/merkez'] = 'merkez/index/1'; 

$route['egitim/ekle/(:any)'] = 'egitim/add/$1'; 

$route['sertifika/onay-bekleyen-sertifikalar']  = 'egitim/onay_bekleyenler_sertifikalar'; 
$route['sertifika/uretilecek-sertifikalar']     = 'egitim/uretilecek_sertifikalar'; 
$route['sertifika/kargo-bekleyen-sertifikalar'] = 'egitim/kargo_bekleyen_sertifikalar'; 
$route['sertifika/uretilecek-kalemler']         = 'egitim/uretilecek_kalemler'; 

$route['cihaz/tum-cihazlar']         = 'cihaz/index'; 
$route['cihaz/garanti-suresi-biten-cihazlar']  = 'cihaz/index/garanti'; 
$route['cihaz/rapor']  = 'cihaz/report'; 
$route['cihaz/duzenle/(:any)']  = 'cihaz/edit/$1'; 

$route['cihaz/tum-basliklar']         = 'baslik/index'; 
$route['baslik/sil/(:any)'] = 'baslik/delete/$1';

$route['baslik/duzenle/(:any)'] = 'baslik/edit/$1';