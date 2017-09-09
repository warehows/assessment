<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessonbank extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->lang->load('basic', $this->config->item('language'));
        $this->load->model("level_model");
        $this->load->model("grades_model");
        $this->load->model("subjects_model");
        $this->load->model("quiz_model");
        $this->load->model("user_model");
        $this->load->model("lessons_model");
        $this->load->model("assign_model");
        $this->load->model("general_model");
        $this->load->model("workspace_model");
        $this->load->model("subjects_model");

    }

    public function index()
    {
        // redirect if not loggedin
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');

        $data['title'] = $this->lang->line('Lessons');
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_quizzes'] = $this->quiz_model->all_shared("savsoft_quiz","*","shared",1);
        $data['all_levels'] = $this->level_model->all();
        $data['subject_model'] = $this->subjects_model;
        $data['grade_model'] = $this->grades_model;
        $data['all_lessons'] = $this->lessons_model->all_lessons_shared();
        $data['logged_in'] = $logged_in;

        if ($logged_in["su"] == 1) {
            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
            $this->load->view('lesson_bank/index.php', $data);
        } else if ($logged_in["su"] == 2) {
            $this->load->view('new_material/teacher_header', $data);
            $this->load->view('lesson_bank/teacher_index', $data);
        }

        $this->load->view('new_material/footer', $data);


    }

    public function import_quiz($data="")
    {

        $logged_in = $this->session->userdata('logged_in');

        $selected_quizzes =  $data['selected_quiz'];
        echo "<pre>";

        foreach($selected_quizzes as $selected_quizzes_key => $selected_quizzes_value){
            $quiz_data = $this->quiz_model->get_quiz($selected_quizzes_value);
            $uid = $logged_in['uid'];
            $quiz_data_to_insert = array(
                'quiz_name' => $quiz_data['quiz_name']."-imported",
                'cid' => $quiz_data['cid'],
                'uid' => $uid,
                'description' => $quiz_data['description'],
                'start_date' => strtotime($quiz_data['start_date']),
                'end_date' => strtotime($quiz_data['end_date']),
                'duration' => $quiz_data['duration'],
                'maximum_attempts' => $quiz_data['maximum_attempts'],
                'pass_percentage' => $quiz_data['pass_percentage'],
                'correct_score' => $quiz_data['correct_score'],
                'incorrect_score' => 0,
                'noq' => count(explode(",",$quiz_data['qids'])),
                'qids' => $quiz_data['qids'],
                'ip_address' => $quiz_data['ip_address'],
                'view_answer' => $quiz_data['view_answer'],
                'camera_req' => $quiz_data['camera_req'],
                'with_login' => 1,
                'gids' => $quiz_data['gids'],
                'question_selection' => $quiz_data['question_selection'],
                'lid' => $quiz_data['lid'],
                'author' => $uid,
            );

            $added_quiz_id = $this->assign_model->insert_quiz($quiz_data_to_insert);


            $workspace_data_to_insert = array(
                "user_id"=>$uid,
                "content_id"=>$added_quiz_id,
                "content_type"=>"quiz",
                "content_name"=>$quiz_data['quiz_name']."-imported",

            );
            $this->workspace_model->insert_workspace($workspace_data_to_insert);
//            print_r($quiz_data_to_insert);
        }
        redirect(site_url("workspace"));


    }

    public function actions(){
        // redirect if not loggedin
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $data = $this->input->post();
        if($data['submit']=="import"){
            $this->import_quiz($data);
        }
    }






}
