<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
    public $folder_name;
    public $layout = 'general';

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
        $this->folder_name = strtolower(get_class());
    }

    function index($test_id=''){
        $this->load->view($this->layout.'/header');
        $this->load->view($this->folder_name.'/'.__FUNCTION__);
        $this->load->view($this->layout.'/footer');
    }

    function create(){
        $this->load->view($this->layout.'/header');
        $this->load->view($this->folder_name.'/'.__FUNCTION__);
        $this->load->view($this->layout.'/footer');
    }
    function read(){
        $this->load->view($this->layout.'/header');
        $this->load->view($this->folder_name.'/'.__FUNCTION__);
        $this->load->view($this->layout.'/footer');
    }
    function update(){
        $this->load->view($this->layout.'/header');
        $this->load->view($this->folder_name.'/'.__FUNCTION__);
        $this->load->view($this->layout.'/footer');
    }
    function delete(){
        $this->load->view($this->layout.'/header');
        $this->load->view($this->folder_name.'/'.__FUNCTION__);
        $this->load->view($this->layout.'/footer');
    }
}
