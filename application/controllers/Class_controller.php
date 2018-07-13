<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("class_model");
        $this->load->model("user_model");
        $this->lang->load('basic', $this->config->item('language'));
        if (!$this->session->userdata('logged_in')) {
            redirect('login');

        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

    }

    public function index($limit = '0')
    {

        $logged_in = $this->session->userdata('logged_in');

        if ($logged_in['su'] < '1') {
            exit($this->lang->line('permission_denied'));
        }


        $data['limit'] = $limit;
        $data['title'] = "Class List";
        // fetching user list
        $data['result'] = $this->class_model->class_list($limit);
        $this->load->view('header', $data);
        $data['user_model'] = $this->user_model;
        $this->load->view('header', $data);
        $this->load->view('class_list', $data);
        $this->load->view('footer', $data);

    }


    public function new_class()
    {

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] < '1') {
            exit($this->lang->line('permission_denied'));
        }

        $data['title'] = 'Add New Class';
        $data['class_model'] = $this->class_model;
        $data['level'] = $this->class_model->getCollection('savsoft_level');
        $data['groups'] = $this->class_model->getCollection('savsoft_group');
        $data['subject'] = $this->class_model->getCollection('savsoft_category');
        $data['teacher'] = $this->class_model->getCollection('savsoft_users');
        $this->load->view('header', $data);
        $this->load->view('new_class', $data);
        $this->load->view('footer', $data);
    }

    public function insert_class()
    {

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] < '1') {
            exit($this->lang->line('permission_denied'));
        }
        $this->load->library('form_validation');

            if ($this->class_model->insert_class()) {
                $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('data_added_successfully') . " </div>");
            } else {
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('error_to_add_data') . " </div>");

            }
            redirect('class_controller/new_class/');

    }

    public function remove_user($uid)
    {

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] < '1') {
            exit($this->lang->line('permission_denied'));
        }
        if ($uid == '1') {
            exit($this->lang->line('permission_denied'));
        }

        if ($this->user_model->remove_user($uid)) {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('removed_successfully') . " </div>");
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('error_to_remove') . " </div>");

        }
        redirect('user');


    }

    public function edit_user($uid)
    {

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] < '1') {
            $uid = $logged_in['uid'];
        }

        $data['uid'] = $uid;
        $data['title'] = $this->lang->line('edit') . ' ' . $this->lang->line('user');
        // fetching user
        $data['result'] = $this->user_model->get_user($uid);
        $this->load->model("payment_model");
        $data['payment_history'] = $this->payment_model->get_payment_history($uid);
        // fetching group list
        $data['group_list'] = $this->user_model->group_list();
        $this->load->view('header', $data);
        if ($logged_in['su']>'0') {
            $this->load->view('edit_user', $data);
        } else {
            $this->load->view('myaccount', $data);

        }
        $this->load->view('footer', $data);
    }

    public function update_user($uid)
    {


        $logged_in = $this->session->userdata('logged_in');

        if ($logged_in['su'] < '1') {
            $uid = $logged_in['uid'];
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . validation_errors() . " </div>");
            redirect('user/edit_user/' . $uid);
        } else {
            if ($this->user_model->update_user($uid)) {
                $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('data_updated_successfully') . " </div>");
            } else {
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('error_to_update_data') . " </div>");

            }
            redirect('user/edit_user/' . $uid);
        }

    }


    public function group_list()
    {

        // fetching group list
        $data['group_list'] = $this->user_model->group_list();
        $data['title'] = $this->lang->line('group_list');
        $this->load->view('header', $data);
        $this->load->view('group_list', $data);
        $this->load->view('footer', $data);


    }


    public function insert_group()
    {


        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] < '1') {
            exit($this->lang->line('permission_denied'));
        }

        if ($this->user_model->insert_group()) {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('data_added_successfully') . " </div>");
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('error_to_add_data') . " </div>");

        }
        redirect('user/group_list/');

    }

    public function update_group($gid)
    {


        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] < '1') {
            exit($this->lang->line('permission_denied'));
        }

        if ($this->user_model->update_group($gid)) {
            echo "<div class='alert alert-success'>" . $this->lang->line('data_updated_successfully') . " </div>";
        } else {
            echo "<div class='alert alert-danger'>" . $this->lang->line('error_to_update_data') . " </div>";

        }


    }


    function get_expiry($gid)
    {

        echo $this->user_model->get_expiry($gid);

    }


    public function remove_group($gid)
    {

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su'] < '1') {
            exit($this->lang->line('permission_denied'));
        }

        if ($this->user_model->remove_group($gid)) {
            $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('removed_successfully') . " </div>");
        } else {
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('error_to_remove') . " </div>");

        }
        redirect('user/group_list');


    }

    function logout()
    {

        $this->session->unset_userdata('logged_in');
        if ($this->session->userdata('logged_in_raw')) {
            $this->session->unset_userdata('logged_in_raw');
        }
        redirect('login');

    }
}