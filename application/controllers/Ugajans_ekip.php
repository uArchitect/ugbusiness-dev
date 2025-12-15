<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_ekip extends CI_Controller {

	function __construct(){
        parent::__construct();
        ugajans_sess_control();
        date_default_timezone_set('Europe/Istanbul');
    }

	public function index()
	{
		$viewData["kullanicilar_data"] = get_kullanicilar();
		$viewData["is_planlamasi_data"] = get_is_planlamasi();
		$viewData["musteriler_data"] = get_musteriler();
		$viewData["page"] = "ugajansviews/ekip_is_planlamasi";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function is_planlamasi_ekle()
	{
		// Tabloda hangi alanların olduğunu kontrol et
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_musteri_no = in_array('musteri_no', $columns);
		$has_yapilacak_is = in_array('yapilacak_is', $columns);
		$has_baslangic_saati = in_array('baslangic_saati', $columns);
		$has_bitis_saati = in_array('bitis_saati', $columns);
		$has_oncelik = in_array('oncelik', $columns);
		
		$kullanici_no = $this->input->post("kullanici_no");
		
		// Explicit validation: check if value exists and is not empty string
		// Use isset() check - CodeIgniter input->post() returns FALSE if key doesn't exist
		// Then check if it's not an empty string
		// This ensures person_id "1" is properly handled (empty("1") returns false, so it passes)
		if ($kullanici_no === false || $kullanici_no === '' || $kullanici_no === null) {
			$this->session->set_flashdata('flashDanger', "Personel seçimi zorunludur.");
			redirect(base_url("ugajans_ekip"));
			return;
		}
		
		// Convert to integer and validate it's a positive number
		// intval() will convert "1" to 1, "0" to 0, etc.
		$kullanici_no_int = intval($kullanici_no);
		
		// Validate: must be a positive integer (greater than 0)
		// This ensures we have a valid user ID
		if ($kullanici_no_int <= 0) {
			$this->session->set_flashdata('flashDanger', "Geçersiz personel seçimi.");
			redirect(base_url("ugajans_ekip"));
			return;
		}
		
		$insertData["kullanici_no"] = $kullanici_no_int;
		$insertData["planlama_tarihi"] = $this->input->post("planlama_tarihi");
		$insertData["is_notu"] = $this->input->post("is_notu");
		
		if($has_planlama_tipi) {
			$insertData["planlama_tipi"] = $this->input->post("planlama_tipi") ? $this->input->post("planlama_tipi") : 'Haftalık';
		}
		
		if($has_musteri_no) {
			$insertData["musteri_no"] = $this->input->post("musteri_no") ? $this->input->post("musteri_no") : null;
		}
		
		if($has_yapilacak_is) {
			$insertData["yapilacak_is"] = $this->input->post("yapilacak_is") ? $this->input->post("yapilacak_is") : null;
		}
		
		if($has_baslangic_saati) {
			$insertData["baslangic_saati"] = $this->input->post("baslangic_saati") ? $this->input->post("baslangic_saati") : '09:00';
		}
		
		if($has_bitis_saati) {
			$insertData["bitis_saati"] = $this->input->post("bitis_saati") ? $this->input->post("bitis_saati") : '17:00';
		}
		
		if($has_oncelik) {
			$insertData["oncelik"] = $this->input->post("oncelik") ? $this->input->post("oncelik") : 'normal';
		}
		
		$insertData["planlama_durumu"] = 0;
		$insertData["olusturan_kullanici_no"] = $this->session->userdata('ugajans_aktif_kullanici_id');
		$insertData["olusturma_tarihi"] = date('Y-m-d H:i:s');
		
		// Check for conflicts before inserting
		$conflicts = $this->check_time_conflicts(
			$insertData["kullanici_no"],
			$insertData["planlama_tarihi"],
			$has_baslangic_saati ? $insertData["baslangic_saati"] : '09:00',
			$has_bitis_saati ? $insertData["bitis_saati"] : '17:00'
		);
		
		if ($conflicts['has_conflict']) {
			$this->session->set_flashdata('flashDanger', $conflicts['message']);
			redirect(base_url("ugajans_ekip"));
			return;
		}
		
		$this->db->insert("ugajans_is_planlamasi", $insertData);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla eklendi.");
		redirect(base_url("ugajans_ekip"));
	}

	public function is_planlamasi_guncelle($is_planlamasi_id)
	{
		// Tabloda hangi alanların olduğunu kontrol et
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_musteri_no = in_array('musteri_no', $columns);
		$has_yapilacak_is = in_array('yapilacak_is', $columns);
		$has_baslangic_saati = in_array('baslangic_saati', $columns);
		$has_bitis_saati = in_array('bitis_saati', $columns);
		$has_oncelik = in_array('oncelik', $columns);
		$has_planlama_tipi = in_array('planlama_tipi', $columns);
		
		$kullanici_no = $this->input->post("kullanici_no");
		
		// Explicit validation: check if value exists and is not empty string
		// Use isset() check - CodeIgniter input->post() returns FALSE if key doesn't exist
		// Then check if it's not an empty string
		// This ensures person_id "1" is properly handled (empty("1") returns false, so it passes)
		if ($kullanici_no === false || $kullanici_no === '' || $kullanici_no === null) {
			$this->session->set_flashdata('flashDanger', "Personel seçimi zorunludur.");
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		// Convert to integer and validate it's a positive number
		// intval() will convert "1" to 1, "0" to 0, etc.
		$kullanici_no_int = intval($kullanici_no);
		
		// Validate: must be a positive integer (greater than 0)
		// This ensures we have a valid user ID
		if ($kullanici_no_int <= 0) {
			$this->session->set_flashdata('flashDanger', "Geçersiz personel seçimi.");
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		$updateData["planlama_tarihi"] = $this->input->post("planlama_tarihi");
		$updateData["is_notu"] = $this->input->post("is_notu");
		$updateData["kullanici_no"] = $kullanici_no_int;
		
		if($has_planlama_tipi) {
			$updateData["planlama_tipi"] = $this->input->post("planlama_tipi") ? $this->input->post("planlama_tipi") : 'Haftalık';
		}
		
		if($has_musteri_no) {
			$updateData["musteri_no"] = $this->input->post("musteri_no") ? $this->input->post("musteri_no") : null;
		}
		
		if($has_yapilacak_is) {
			$updateData["yapilacak_is"] = $this->input->post("yapilacak_is") ? $this->input->post("yapilacak_is") : null;
		}
		
		if($has_baslangic_saati) {
			$updateData["baslangic_saati"] = $this->input->post("baslangic_saati") ? $this->input->post("baslangic_saati") : '09:00';
		}
		
		if($has_bitis_saati) {
			$updateData["bitis_saati"] = $this->input->post("bitis_saati") ? $this->input->post("bitis_saati") : '17:00';
		}
		
		if($has_oncelik) {
			$updateData["oncelik"] = $this->input->post("oncelik") ? $this->input->post("oncelik") : 'normal';
		}
		
		$updateData["planlama_durumu"] = $this->input->post("planlama_durumu");
		$updateData["guncelleme_tarihi"] = date('Y-m-d H:i:s');
		
		// Check for conflicts before updating
		$conflicts = $this->check_time_conflicts(
			$updateData["kullanici_no"],
			$updateData["planlama_tarihi"],
			$has_baslangic_saati ? $updateData["baslangic_saati"] : '09:00',
			$has_bitis_saati ? $updateData["bitis_saati"] : '17:00',
			$is_planlamasi_id
		);
		
		if ($conflicts['has_conflict']) {
			$this->session->set_flashdata('flashDanger', $conflicts['message']);
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		$this->db->where("is_planlamasi_id", $is_planlamasi_id)->update("ugajans_is_planlamasi", $updateData);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla güncellendi.");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function is_planlamasi_sil($is_planlamasi_id)
	{
		$this->db->where("is_planlamasi_id", $is_planlamasi_id)->update("ugajans_is_planlamasi", ["aktif" => 0]);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla silindi.");
		redirect($_SERVER['HTTP_REFERER']);
	}

	// AJAX: Event position update (drag and drop)
	public function ajax_event_move()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$event_id = $this->input->post('event_id');
		$person_id = $this->input->post('person_id');
		$date = $this->input->post('date');

		// Validate parameters - check for null/empty explicitly
		// This ensures person_id "1" is not treated as empty
		if ($event_id === null || $event_id === '' || 
		    $person_id === null || $person_id === '' || 
		    $date === null || $date === '') {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error', 
					'message' => 'Eksik parametreler: event_id=' . $event_id . ', person_id=' . $person_id . ', date=' . $date
				]));
			return;
		}

		// Convert to integers after validation
		$event_id = intval($event_id);
		$person_id = intval($person_id);
		
		// Additional validation: ensure IDs are positive integers
		if ($event_id <= 0 || $person_id <= 0) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error', 
					'message' => 'Geçersiz ID değerleri: event_id=' . $event_id . ', person_id=' . $person_id
				]));
			return;
		}

		// Verify event exists
		$event = $this->db->where("is_planlamasi_id", $event_id)->get("ugajans_is_planlamasi")->row();
		if (!$event) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Etkinlik bulunamadı']));
			return;
		}

		// Get event's time fields for conflict check
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_time_fields = in_array('baslangic_saati', $columns) && in_array('bitis_saati', $columns);
		
		$check_start_time = null;
		$check_end_time = null;
		
		if ($has_time_fields && isset($event->baslangic_saati) && isset($event->bitis_saati)) {
			$check_start_time = $event->baslangic_saati;
			$check_end_time = $event->bitis_saati;
		}

		// Check for conflicts using time-based check if times are available
		if ($check_start_time && $check_end_time) {
			$conflicts = $this->check_time_conflicts($person_id, $date, $check_start_time, $check_end_time, $event_id);
		} else {
			// Fallback to event-based check if no time fields
			$conflicts = $this->check_event_conflicts($person_id, $date, $event_id);
		}
		
		if ($conflicts['has_conflict']) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error',
					'message' => $conflicts['message']
				]));
			return;
		}

		// Update event
		$updateData = [
			'kullanici_no' => $person_id,
			'planlama_tarihi' => $date
		];

		$this->db->where("is_planlamasi_id", $event_id)->update("ugajans_is_planlamasi", $updateData);

		if ($this->db->affected_rows() > 0) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'success', 'message' => 'Görev başarıyla taşındı']));
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Güncelleme yapılamadı']));
		}
	}

	// AJAX: Get events for calendar refresh
	public function ajax_get_events()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$events = get_is_planlamasi();
		
		// Format events for JavaScript
		$formattedEvents = [];
		foreach ($events as $event) {
			$formattedEvents[] = [
				'is_planlamasi_id' => $event->is_planlamasi_id,
				'kullanici_no' => $event->kullanici_no,
				'planlama_tarihi' => $event->planlama_tarihi,
				'baslangic_saati' => isset($event->baslangic_saati) && !empty($event->baslangic_saati) ? $event->baslangic_saati : '09:00',
				'bitis_saati' => isset($event->bitis_saati) && !empty($event->bitis_saati) ? $event->bitis_saati : '17:00',
				'planlama_tipi' => isset($event->planlama_tipi) && !empty($event->planlama_tipi) ? $event->planlama_tipi : '',
				'oncelik' => isset($event->oncelik) && !empty($event->oncelik) ? $event->oncelik : 'Normal',
				'planlama_durumu' => $event->planlama_durumu,
				'is_notu' => isset($event->is_notu) ? $event->is_notu : '',
				'yapilacak_is' => isset($event->yapilacak_is) ? $event->yapilacak_is : '',
				'musteri_no' => isset($event->musteri_no) && !empty($event->musteri_no) ? $event->musteri_no : null
			];
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode([
				'status' => 'success',
				'events' => $formattedEvents
			], JSON_UNESCAPED_UNICODE));
	}

	// AJAX: Event resize (time change)
	public function ajax_event_resize()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$event_id = $this->input->post('event_id');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');

		if (empty($event_id) || empty($start_time) || empty($end_time)) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Eksik parametreler']));
			return;
		}

		// Get current event to check conflicts
		$event = $this->db->where("is_planlamasi_id", $event_id)->get("ugajans_is_planlamasi")->row();
		if (!$event) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'Etkinlik bulunamadı']));
			return;
		}

		// Check for conflicts with new time
		$conflicts = $this->check_time_conflicts($event->kullanici_no, $event->planlama_tarihi, $start_time, $end_time, $event_id);
		if ($conflicts['has_conflict']) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'error',
					'message' => $conflicts['message']
				]));
			return;
		}

		// Check if baslangic_saati and bitis_saati columns exist
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$updateData = [];

		if (in_array('baslangic_saati', $columns)) {
			$updateData['baslangic_saati'] = $start_time;
		}
		if (in_array('bitis_saati', $columns)) {
			$updateData['bitis_saati'] = $end_time;
		}

		if (!empty($updateData)) {
			$this->db->where("is_planlamasi_id", $event_id)->update("ugajans_is_planlamasi", $updateData);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['status' => 'success', 'message' => 'Güncelleme başarılı']));
	}

	// AJAX: Check for conflicts
	public function ajax_check_conflict()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$person_id = $this->input->post('person_id');
		$date = $this->input->post('date');
		$exclude_event_id = $this->input->post('exclude_event_id');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');

		// If time fields are provided, use time-based conflict check
		if ($start_time && $end_time) {
			$conflicts = $this->check_time_conflicts($person_id, $date, $start_time, $end_time, $exclude_event_id);
		} else {
			// Otherwise use event-based check
			$conflicts = $this->check_event_conflicts($person_id, $date, $exclude_event_id);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($conflicts));
	}

	// Helper: Check for event conflicts
	private function check_event_conflicts($person_id, $date, $exclude_event_id = null, $check_start_time = null, $check_end_time = null)
	{
		$this->db->select('*');
		$this->db->from('ugajans_is_planlamasi');
		$this->db->where('kullanici_no', $person_id);
		$this->db->where('planlama_tarihi', $date);
		$this->db->where('aktif', 1);

		if ($exclude_event_id) {
			$this->db->where('is_planlamasi_id !=', $exclude_event_id);
		}

		$events = $this->db->get()->result();

		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_time_fields = in_array('baslangic_saati', $columns) && in_array('bitis_saati', $columns);

		// If time fields are provided, check for time overlaps
		if ($has_time_fields && $check_start_time && $check_end_time) {
			$newStart = strtotime($check_start_time);
			$newEnd = strtotime($check_end_time);

			foreach ($events as $event) {
				if ($event->baslangic_saati && $event->bitis_saati) {
					$eventStart = strtotime($event->baslangic_saati);
					$eventEnd = strtotime($event->bitis_saati);

					// Check for overlap
					if (($newStart < $eventEnd && $newEnd > $eventStart)) {
						return [
							'has_conflict' => true,
							'message' => 'Seçilen zaman dilimi başka bir iş planı ile çakışıyor.'
						];
					}
				}
			}
		}

		// Check workload limit (max 8 hours per day)
		$totalHours = 0;
		foreach ($events as $event) {
			if ($has_time_fields && $event->baslangic_saati && $event->bitis_saati) {
				$start = strtotime($event->baslangic_saati);
				$end = strtotime($event->bitis_saati);
				$hours = ($end - $start) / 3600;
				$totalHours += $hours;
			} else {
				// Default 8 hours if no time specified
				$totalHours += 8;
			}
		}

		// Add the new event's hours if provided
		if ($has_time_fields && $check_start_time && $check_end_time) {
			$newStart = strtotime($check_start_time);
			$newEnd = strtotime($check_end_time);
			$newHours = ($newEnd - $newStart) / 3600;
			$totalHours += $newHours;
		} else if (!$has_time_fields || !$check_start_time || !$check_end_time) {
			// Default 8 hours if no time specified
			$totalHours += 8;
		}

		if ($totalHours > 8) {
			return [
				'has_conflict' => true,
				'message' => 'Bu personel için günlük iş yükü limiti (8 saat) aşıldı.'
			];
		}

		return [
			'has_conflict' => false,
			'message' => ''
		];
	}

	// Helper: Check for time conflicts
	private function check_time_conflicts($person_id, $date, $start_time, $end_time, $exclude_event_id = null)
	{
		$this->db->select('*');
		$this->db->from('ugajans_is_planlamasi');
		$this->db->where('kullanici_no', $person_id);
		$this->db->where('planlama_tarihi', $date);
		$this->db->where('aktif', 1);

		if ($exclude_event_id) {
			$this->db->where('is_planlamasi_id !=', $exclude_event_id);
		}

		$events = $this->db->get()->result();
		$columns = $this->db->list_fields('ugajans_is_planlamasi');
		$has_time_fields = in_array('baslangic_saati', $columns) && in_array('bitis_saati', $columns);

		if (!$has_time_fields) {
			return ['has_conflict' => false, 'message' => ''];
		}

		$newStart = strtotime($start_time);
		$newEnd = strtotime($end_time);

		foreach ($events as $event) {
			if ($event->baslangic_saati && $event->bitis_saati) {
				$eventStart = strtotime($event->baslangic_saati);
				$eventEnd = strtotime($event->bitis_saati);

				// Check for overlap
				if (($newStart < $eventEnd && $newEnd > $eventStart)) {
					return [
						'has_conflict' => true,
						'message' => 'Seçilen zaman dilimi başka bir iş planı ile çakışıyor.'
					];
				}
			}
		}

		return ['has_conflict' => false, 'message' => ''];
	}
}

