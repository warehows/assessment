<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workspace extends CI_Controller
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
        $this->load->model("workspace_model");

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
        $data['all_levels'] = $this->level_model->all();
        $data['all_lessons'] = $this->workspace_model->where("user_id",$logged_in['uid']);
        $this->load->view('new_material/header', $data);
        $this->load->view('workspace/index.php', $data);
        $this->load->view('new_material/footer', $data);
    }

}
