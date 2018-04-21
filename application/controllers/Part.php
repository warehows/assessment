<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends CI_Controller
{
    public $folder_name = 'part';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("quiz_model");
        $this->load->model("qbank_model");
        $this->load->model("user_model");
        $this->load->model("category_model");
        $this->load->model("grades_model");
        $this->lang->load('basic', $this->config->item('language'));
    }

    function index($test_id=''){
//        $this->load->view('general/header');
        $this->load->view($this->folder_name.'/index');
//        $this->load->view('new_material/footer');
    }

    function create(){
        $this->load->view('new_material/header');
        $this->load->view($this->folder_name.'/create');
        $this->load->view('new_material/footer');
    }
    function read(){
        $this->load->view('new_material/header');
        $this->load->view($this->folder_name.'/read');

        $this->load->view('new_material/footer');
    }
    function update(){
        $this->load->view('new_material/header');
        $this->load->view($this->folder_name.'/update');

        $this->load->view('new_material/footer');
    }
    function delete(){
        $this->load->view('new_material/header');
        $this->load->view($this->folder_name.'/delete');
        $this->load->view('new_material/footer');
    }
}
