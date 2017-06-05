<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons extends CI_Controller {

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

    }

    public function index()
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
        $data['title']=$this->lang->line('Lessons');
        $data['all_users']=$this->user_model->get_all();
        $data['all_subjects']=$this->subjects_model->all();
        $data['all_levels']=$this->level_model->all();
        $this->load->view('material_part/header_material',$data);
        $this->load->view('lessons/index.php', $data);
        $this->load->view('material_part/footer_material',$data);
    }

    public function save_lesson(){
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

        $data = $this->input->post();
        $data = $this->lessons_model->save_lesson($data);

        echo $data;

    }

    public function add_folder(){
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

        $data = $this->input->post();
        $data = $this->lessons_model->add_folder($data);

        echo $data;

    }

    public function delete_folder(){
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

        $data = $this->input->post();
        $data = $this->lessons_model->delete_folder($data);

        echo $data;
    }

    public function edit_folder(){
        // redirect if not loggedin
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['base_url'] != base_url()){
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $data = $this->input->post();
        $data = $this->lessons_model->edit_folder($data);

        echo $data;

    }

    public function open_folder(){
        // redirect if not loggedin
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['base_url'] != base_url()){
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $data = $this->input->post();
        $data = $this->lessons_model->edit_folder($data);

        echo $data;

    }

    public function step2()
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
        $data['title']=$this->lang->line('Lessons');
        $data['all_users']=$this->user_model->get_all();
        $data['all_subjects']=$this->subjects_model->all();
        $data['all_levels']=$this->level_model->all();

        $this->load->view('material_part/header_material',$data);
        $this->load->view('lessons/step2.php', $data);
        $this->load->view('material_part/footer_material',$data);

    }








}
