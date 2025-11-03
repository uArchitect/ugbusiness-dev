<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anket extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
    public function index() {
        $data["page"] = "anket/olustur";
        $this->load->view('base_view', $data);
    }
    public function report($survey_id) {
        $this->db->where('survey_id', $survey_id);
        $questions = $this->db->get('questions')->result();
        $report_data = [];
        foreach ($questions as $question) {
            if ($question->question_type === 'option') { 
                $this->db->where('question_id', $question->id);
                $answers = $this->db->get('survey_answers')->result();
                $answer_counts = [];
                foreach ($answers as $answer) {
                    $answer_text = $answer->answer;
                    if (!isset($answer_counts[$answer_text])) {
                        $answer_counts[$answer_text] = 0;
                    }
                    $answer_counts[$answer_text]++;
                }
                $report_data[$question->id] = [
                    'question' => $question->question,
                    'type' => $question->question_type,
                    'answers' => $answer_counts
                ];
            } elseif ($question->question_type === 'rating') {
                $this->db->where('question_id', $question->id);
                $answers = $this->db->get('survey_answers')->result();
                $total_score = 0;
                $total_count = 0;
                foreach ($answers as $answer) {
                    $total_score += (int)$answer->answer;
                    $total_count++;
                }
                $average = $total_count > 0 ? $total_score / $total_count : 0;
                $report_data[$question->id] = [
                    'question' => $question->question,
                    'type' => $question->question_type,
                    'average' => $average
                ];
            } elseif ($question->question_type === 'text') {
               
                $this->db->where('question_id', $question->id);
                $answers = $this->db->get('survey_answers')->result();
                $answer_texts = [];
                foreach ($answers as $answer) {
                    $answer_texts[] = $answer->answer;
                }
                $report_data[$question->id] = [
                    'question' => $question->question,
                    'type' => $question->question_type,
                    'answers' => $answer_texts
                ];
            }
        }
        $data['report_data'] = $report_data;
        $data["page"] = "anket/rapor";
        $this->load->view('base_view', $data);
    }
    
    public function submit_answers() {  
        $survey_id = $this->input->post('survey_id');
        $answers = $this->input->post('answers'); 
        foreach ($answers as $question_id => $answer) {
            $data = array(
                'survey_id' => $survey_id,
                'question_id' => $question_id,
                'answer' => $answer,
            );
            $this->db->insert('survey_answers', $data);
        }  
        $this->session->set_flashdata('success', 'Cevaplar başarıyla kaydedildi.');
        echo "Başarılı.";
    }

    public function success() {
        $this->load->view('success_view'); 
    }

    public function view_survey($survey_id) {
        $data['survey'] = $this->db->where('id', $survey_id)->get('surveys')->row();
        $this->db->where('survey_id', $survey_id);
        $data['questions'] = $this->db->get('questions')->result();
        $data["page"] = "anket/katil";
        $this->load->view('base_view', $data);
    }

	public function olustur($secilen_arac_id = 0)
	{
		$viewData["page"] = "anket/olustur";
		$this->load->view('base_view',$viewData);
	}

	public function save_survey() {
        $input = json_decode(file_get_contents('php://input'), true); 
        $surveyTitle = $input['title'];
        $questions = json_decode($input['questions'], true);
        $this->db->insert('surveys', ['title' => $surveyTitle]);
        $surveyId = $this->db->insert_id();
        foreach ($questions as $question) {
            $data = [
                'survey_id' => $surveyId,
                'question_type' => $question['type'],
                'question' => $question['question'],
                'max_stars' => isset($question['maxStars']) ? $question['maxStars'] : null,
                'selected_stars' => isset($question['selectedStars']) ? $question['selectedStars'] : null,
                'options' => isset($question['options']) ? json_encode($question['options']) : null
            ];
            $this->db->insert('questions', $data);
        }
        echo json_encode(['status' => 'success', 'message' =>   $surveyTitle ]);
    }
}
