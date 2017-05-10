<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("quiz_model");
        $this->load->model("user_model");
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







}
