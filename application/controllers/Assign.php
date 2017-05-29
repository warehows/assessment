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
        $this->load->model("category_model");
        $this->load->model("level_model");
        $this->load->model("group_model");
        $this->load->model("subjects_model");
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
        $data['category']=$this->category_model->get_all();
        $data['all_users']=$this->user_model->get_all();
        $data['all_subjects']=$this->subjects_model->all();

        $this->load->view('material_part/header_material',$data);
        $this->load->view('assign_quiz/index.php', $data);
        $this->load->view('material_part/footer_material',$data);
    }

    public function update($quid){
            echo $quid;
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

    public function get_quiz(){

        $post = $this->input->post();

        $quid = $post["quid"];
        $data = $this->quiz_model->get_quiz($quid);
        $array = array(
            "start_date"=>date('Y-m-d H:i:s', $data['start_date']),
            "end_date"=>date('Y-m-d H:i:s', $data['end_date']),
            "duration"=>$data['duration'],
            "maximum_attempts"=>$data['maximum_attempts'],
            "pass_percentage"=>$data['pass_percentage'],
            "view_answer"=>$data['view_answer'],
        );
        echo json_encode($array);
    }

    public function update_quiz()
    {
        $post = $this->input->post();

        $settings = json_decode($post['settings']);
        $quid = $this->quiz_model->assessment_update_quiz($settings['quid'],$settings);
        print_r($quid);

//       lo $gged_in = $this->session->userdata('logged_in');
//        if ($logged_in['su'] < '1') {
//            exit($this->lang->line('permission_denied'));
//        }
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules('quiz_name', 'quiz_name', 'required');
//
//
//        if ($this->form_validation->run() == FALSE) {
//            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . validation_errors() . " </div>");
//            redirect('quiz/edit_quiz/' . $quid);
//        } else {

//        }

    }

    public function get_all_level()
    {
        $data_level = $this->level_model->get_all();
        $data_group = $this->group_model->get_all();
//        $data_class_students = $this->classstudents_model->get_all();
        $data = array('level'=>$data_level,'group'=>$data_group);
        echo json_encode($data);
    }





}
