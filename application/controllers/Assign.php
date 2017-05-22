<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("quiz_model");
        $this->load->model("user_model");
        $this->load->model("qbank_model");
        $this->lang->load('basic', $this->config->item('language'));

    }

    public function index($limit='0',$list_view='grid')
    {

        // redirect if not loggedin
        if(!$this->session->userdata('logged_in')){
            redirect('login');

        }
        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['base_url'] != base_url()){
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $logged_in=$this->session->userdata('logged_in');

        $data['list_view']=$list_view;
        $data['limit']=$limit;
        $data['title']=$this->lang->line('quiz');
        $data['su'] = $logged_in['su'];
        // fetching quiz list
        $data['result']=$this->quiz_model->quiz_list($limit);
        $this->load->view('material_part/header_material',$data);
        $this->load->view('assign_quiz/index.php', $data);
        $this->load->view('material_part/footer_material.php',$data);
    }

    public function update($quid){
            echo $quid;
//        $userdata = array(
//            'quiz_name' => $this->input->post('quiz_name'),
//            'description' => $this->input->post('description'),
//            'start_date' => strtotime($this->input->post('start_date')),
//            'end_date' => strtotime($this->input->post('end_date')),
//            'duration' => $this->input->post('duration'),
//            'maximum_attempts' => $this->input->post('maximum_attempts'),
//            'pass_percentage' => $this->input->post('pass_percentage'),
//            'correct_score' => $this->input->post('correct_score'),
//            'incorrect_score' => $this->input->post('incorrect_score'),
//            'ip_address' => $this->input->post('ip_address'),
//            'view_answer' => $this->input->post('view_answer'),
//            'camera_req' => $this->input->post('camera_req'),
//            'with_login' => $this->input->post('with_login'),
//            'gids' => implode(',', $this->input->post('gids'))
//        );
//
//        $userdata['gen_certificate'] = $this->input->post('gen_certificate');
//
//        if ($this->input->post('certificate_text')) {
//            $userdata['certificate_text'] = $this->input->post('certificate_text');
//        }
//
//        $this->db->where('quid', $quid);
//        $this->db->update('savsoft_quiz', $userdata);
//
//        $this->db->where('quid', $quid);
//        $query = $this->db->get('savsoft_quiz', $userdata);
//        $quiz = $query->row_array();
//        if ($quiz['question_selection'] == '1') {
//
//            $this->db->where('quid', $quid);
//            $this->db->delete('savsoft_qcl');
//
//            foreach ($_POST['cid'] as $ck => $val) {
//                if (isset($_POST['noq'][$ck])) {
//                    if ($_POST['noq'][$ck] >= '1') {
//                        $userdata = array(
//                            'quid' => $quid,
//                            'cid' => $val,
//                            'lid' => $_POST['lid'][$ck],
//                            'noq' => $_POST['noq'][$ck]
//                        );
//                        $this->db->insert('savsoft_qcl', $userdata);
//                    }
//                }
//            }
//            $userdata = array(
//                'noq' => array_sum($_POST['noq'])
//            );
//            $this->db->where('quid', $quid);
//            $this->db->update('savsoft_quiz', $userdata);
//        }
//        return $quid;

    }

    public function assessment_quiz_list(){
        if(!$this->session->userdata('logged_in')){
            redirect('login');

        }
        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['base_url'] != base_url()){
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $data=$this->quiz_model->quiz_list(0);
        echo json_encode($data);
    }

    public function get_all_questions(){
        $data = $this->qbank_model->get_all_question();
        echo json_encode($data);
    }









}
