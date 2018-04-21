<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{

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

    function index(){
        $this->load->view('general/header');
        $this->load->view('test/index');
        $this->load->view('general/footer');
    }
    function create(){
        $this->load->view('new_material/header');
        $this->load->view('test/create');

        $this->load->view('new_material/footer');
    }
    function read(){
        $this->load->view('new_material/header');
        $this->load->view('test/read');

        $this->load->view('new_material/footer');
    }
    function update(){
        $this->load->view('new_material/header');
        $this->load->view('test/update');

        $this->load->view('new_material/footer');
    }
    function delete(){
        $this->load->view('new_material/header');
        $this->load->view('test/delete');
        $this->load->view('new_material/footer');
    }
}
