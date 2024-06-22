<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	function __construct(){
        parent::__construct(); 
    }
 
	public function index()
	{ 
                  /* LOGDATA */
        log_data("Sistemden Çıkış","Sistemden çıkış yapıldı.");
        /* LOGDATA */

        $this->session->sess_destroy();
        redirect(base_url("giris-yap"));
	}

     
}
