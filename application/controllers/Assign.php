<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller
{
    public $data;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("quiz_model");
        $this->load->model("user_model");
        $this->load->model("qbank_model");
        $this->load->model("category_model");
        $this->load->model("level_model");
        $this->load->model("group_model");
        $this->load->model("subjects_model");
        $this->load->model("assign_model");
        $this->load->model("workspace_model");
        $this->lang->load('basic', $this->config->item('language'));

        if (!$this->session->userdata('logged_in')) {
            redirect('login');

        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $data['title'] = $this->lang->line('quiz');
        $data['su'] = $logged_in['su'];
        $data['category'] = $this->category_model->get_all();
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_grades'] = $this->level_model->all();
        $data['logged_in'] = $logged_in;

        $this->data = $data;

    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');

        $logged_in = $this->session->userdata('logged_in');
        $data['title'] = $this->lang->line('quiz');
        $data['su'] = $logged_in['su'];
        $data['category'] = $this->category_model->get_all();
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_quiz'] = $this->assign_model->where("assigned","");

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('assign_quiz/index_new', $data);
        $this->load->view('new_material/footer', $data);

    }

    function change_share($data)
    {

        $update_data = array("shared" => $data['share']);
        $this->db->where("quid", $data['id']);
        $return_value = $this->db->update("savsoft_quiz", $update_data);

    }

    public function actions()
    {
        // redirect if not logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_levels'] = $this->level_model->all();
        $data['all_sections'] = $this->group_model->get_all();
        $data['logged_in'] = $logged_in;
        $post = $_POST;
        if ($logged_in['su'] == 2) {
//            $this->load->view('new_material/teacher_header', $data);
        }
        if ($logged_in['su'] == 1) {
//            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        }

        $selected = $post['selected_quiz'];

        if ($post["submit"] == "share") {
            foreach ($selected as $key => $value) {
                $data = array(
                    "share" => "1",
                    "id" => $value,
                );
                $this->change_share($data);
            }

        } elseif ($post["submit"] == "edit") {

        }
        if ($post["submit"] == "remove") {
            foreach ($selected as $key => $value) {
                $data = array(
                    "share" => "0",
                    "id" => $value,
                );
                $this->change_share($data);
            }

        }elseif ($post["submit"] == "edit") {
            $quid = $this->input->post();
            $quid = $quid['selected_quiz'][0];
            redirect(site_url('assign/edit')."?next_page=assign_quiz%2Fmodify_info&quid=".$quid);
        }
        elseif ($post["submit"] == "assign") {
            $data["data"] = $data;
            $quid = $this->input->post();
            $quid = $quid['selected_quiz'][0];
            $data["posts"] = $this->input->post();
            $data['quid'] = $quid;
            $data['logged_in'] = $logged_in;

            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
            $this->load->view('assign_quiz/assign', $data);
            $this->load->view('new_material/footer', $data);

        }elseif ($post["submit"] == "teacher_assign") {
            $data["data"] = $data;
            $quid = $this->input->post();
            $quid = $quid['selected_quiz'][0];
            $data["posts"] = $this->input->post();
            $data['quid'] = $quid;
            $data['logged_in'] = $logged_in;

            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
            $this->load->view('assign_quiz/assign', $data);
            $this->load->view('new_material/footer', $data);

        }
        else {

        }
        $this->load->view('new_material/footer', $data);

    }

    public function create_question()
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
        $data['title'] = $this->lang->line('quiz');
        $data['su'] = $logged_in['su'];
        // fetching quiz list
        $data['category'] = $this->category_model->get_all();
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_quiz'] = $this->quiz_model->getCollection("savsoft_quiz");


        $this->load->view('assign_quiz/create_question', $data);
        $this->load->view('new_material/footer', $data);

    }

    public function create()
    {
        $data = $this->data;

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] == 1) {
            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        } elseif ($logged_in['su'] == 2) {
            $this->load->view('new_material/teacher_header', $data);
        } elseif ($logged_in['su'] == 0) {
            $this->load->view('new_material/student_header', $data);
        }
        $post = $this->input->get();
        $data['next_page'] = $post['next_page'];
        $data['all_data'] = $data;

        $this->load->view('assign_quiz/create', $data);
        $this->load->view('new_material/footer', $data);
    }

    public function edit()
    {
        $data = $this->data;

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] == 1) {
            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        } elseif ($logged_in['su'] == 2) {
            $this->load->view('new_material/teacher_header', $data);
        } elseif ($logged_in['su'] == 0) {
            $this->load->view('new_material/student_header', $data);
        }
        $post = $this->input->get();
        $data['next_page'] = $post['next_page'];
        $data['all_data'] = $data;

        $this->load->view('assign_quiz/create', $data);
        $this->load->view('new_material/footer', $data);
    }

    public function insert_quiz()
    {
        $post = $this->input->post();

        $filter_data = array(
            'quiz_name',
            'cid',
            'uid',
            'description',
            'start_date',
            'end_date',
            'duration',
            'maximum_attempts',
            'pass_percentage',
            'correct_score',
            'incorrect_score',
            'ip_address',
            'view_answer',
            'camera_req',
            'with_login',
            'gids',
            'question_selection',
            'lid',
        );
        foreach($filter_data as $key => $value){
            if(array_key_exists($value,$post)){
                $data[$value] = $post[$value];
            }else{

                if($value == "gids"){
                    $data[$value] = array();
                }else{
                    $data[$value] = "";
                }
            }
        }
        $logged_in = $this->session->userdata('logged_in');
        $data = array(
            'quiz_name' => $data['quiz_name'],
            'cid' => $data['cid'],
            'uid' => $data['uid'],
            'description' => $data['description'],
            'start_date' => strtotime($data['start_date']),
            'end_date' => strtotime($data['end_date']),
            'duration' => $data['duration'],
            'maximum_attempts' => $data['maximum_attempts'],
            'pass_percentage' => $data['pass_percentage'],
            'correct_score' => $data['correct_score'],
            'incorrect_score' => $data['incorrect_score'],
            'ip_address' => $data['ip_address'],
            'view_answer' => $data['view_answer'],
            'camera_req' => $data['camera_req'],
            'with_login' => $data['with_login'],
            'gids' => implode(',', $data['gids']),
            'question_selection' => $data['question_selection'],
            'lid' => $data['lid'],
            'author' => $logged_in['uid'],
        );

        $quid = $this->assign_model->insert_quiz($data);
        if($quid){
            echo trim($quid);
        }else{
            echo "Error";
        }
    }

    public function update_quiz()
    {
        $post = $this->input->post();
        $logged_in = $this->session->userdata('logged_in');
        $filter_data = array(
            'quid',
            'quiz_name',
            'cid',
            'uid',
            'description',
            'start_date',
            'end_date',
            'duration',
            'maximum_attempts',
            'pass_percentage',
            'correct_score',
            'incorrect_score',
            'ip_address',
            'view_answer',
            'camera_req',
            'with_login',
            'gids',
            'question_selection',
            'lid',
            'author',
            'assigned_by',
            'assigned',
        );
        foreach($filter_data as $key => $value){
            if(array_key_exists($value,$post)){
                $data[$value] = $post[$value];
            }else{

                if($value == "gids"){
                    $data[$value] = array();
                }else{
                    $data[$value] = "";
                }
            }
        }

        $data = array(
            'quid' => $data['quid'],
            'quiz_name' => $data['quiz_name'],
            'cid' => $data['cid'],
            'uid' => $data['uid'],
            'description' => $data['description'],
            'start_date' => strtotime($data['start_date']),
            'end_date' => strtotime($data['end_date']),
            'duration' => $data['duration'],
            'maximum_attempts' => $data['maximum_attempts'],
            'pass_percentage' => $data['pass_percentage'],
            'correct_score' => $data['correct_score'],
            'incorrect_score' => $data['incorrect_score'],
            'ip_address' => $data['ip_address'],
            'view_answer' => $data['view_answer'],
            'camera_req' => $data['camera_req'],
            'with_login' => $data['with_login'],
            'gids' => implode(',', $data['gids']),
            'question_selection' => $data['question_selection'],
            'lid' => $data['lid'],
            'author' => $logged_in['uid'],
        );

        $quid = $this->assign_model->update_quiz($data);
        if($quid){
//            echo $quid;
            print_r($data);
        }else{
            echo "Error";
        }

    }

    public function modify_settings()
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

        $data = $this->data;

        $this->load->view('assign_quiz/modify_settings', $data);
        $this->load->view('new_material/footer', $data);
    }

    public function test_part()
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

        $data = $this->data;

        $this->load->view('assign_quiz/modify_test_part', $data);
        $this->load->view('new_material/footer', $data);
    }

    public function update($quid)
    {
        echo $quid;
    }

    public function assessment_quiz_list()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $data = $this->quiz_model->quiz_list(0);
        echo json_encode($data);
    }

    public function get_all_questions()
    {
        $post = $this->input->post();
        $quiz_id = $post["quiz_id"];
        $data = $this->qbank_model->get_all_question($quiz_id);
        echo json_encode($data);
    }

    public function get_quiz()
    {

        $post = $this->input->post();

        $quid = $post["quid"];
        $data = $this->quiz_model->get_quiz($quid);
        $array = array(
            "start_date" => date('Y-m-d H:i:s', $data['start_date']),
            "end_date" => date('Y-m-d H:i:s', $data['end_date']),
            "duration" => $data['duration'],
            "maximum_attempts" => $data['maximum_attempts'],
            "pass_percentage" => $data['pass_percentage'],
            "view_answer" => $data['view_answer'],
        );
        echo json_encode($array);
    }

    public function get_all_level()
    {
        $data_level = $this->level_model->get_all();
        $data_group = $this->group_model->get_all();
//        $data_class_students = $this->classstudents_model->get_all();
        $data = array('level' => $data_level, 'group' => $data_group);
        echo json_encode($data);
    }



//    public function create()
//    {
//        // redirect if not loggedin
//        if (!$this->session->userdata('logged_in')) {
//            redirect('login');
//
//        }
//        $logged_in = $this->session->userdata('logged_in');
//        if ($logged_in['base_url'] != base_url()) {
//            $this->session->unset_userdata('logged_in');
//            redirect('login');
//        }
//
//        $logged_in = $this->session->userdata('logged_in');
//
//        $data['title'] = $this->lang->line('quiz');
//        $data['su'] = $logged_in['su'];
//        // fetching quiz list
//        $data['category'] = $this->category_model->get_all();
//        $data['all_users'] = $this->user_model->get_all();
//        $data['all_subjects'] = $this->subjects_model->all();
//
//
//        $this->load->view('material_part/header_material', $data);
//        $this->load->view('assign_quiz/create', $data);
//        $this->load->view('material_part/footer_material', $data);
//    }

}
