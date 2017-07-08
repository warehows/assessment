<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->lang->load('basic', $this->config->item('language'));
        $this->load->model("calendar_model");
        $this->load->model("grades_model");
        $this->load->model("lessons_model");
        $this->load->model("class_model");
    }

    public function index(){
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
        $data['logged_in'] = $logged_in;
        $data['grade'] = $this->grades_model->all();
        $data['lesson'] = $this->lessons_model->all_lessons_non_duplicated();
        
        if ($logged_in["su"] == 1) {
            $this->load->view('new_material/header', $data);
            $this->load->view('calendar/calendar', $data);
        }
    }

    public function create() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        $data['logged_in'] = $logged_in;

        $data['lesson'] = $this->calendar_model->get_lessons();
        $data['section'] = $this->class_model->getCollection('savsoft_group');

        if ($logged_in["su"] == 1) {
            $this->load->view('new_material/header', $data);
            $this->load->view('calendar/calendar_create', $data);
        }
    }

    public function save() {
        $data = $this->input->post();
        $this->calendar_model->create_schedule($data); 
        redirect(site_url()."/calendar");
    }

    public function update() {
        $data = $this->input->post();
        $this->calendar_model->update_schedule($data); 
    }

    public function delete() {
        $data = $this->input->post();
        $this->calendar_model->delete_schedule($data);
    }

    public function getEvents(){
        $logged_in = $this->session->userdata('logged_in');
        $data['calendar'] = $this->calendar_model->get_all($logged_in);
        foreach ($data['calendar'] as &$row) {
            $start = new DateTime($row['date_from']);
            $end = new DateTime($row['date_to']);

            $result[] = array(    
                'id' => $row['calendar_id'],
                'title' => $row['lesson_name'],
                'section' => $row['gid'],
                'grade' => $row['lid'],
                'lesson' => $row['lesson_id'],
                'start' => $row['date_from']."T00:00:00",
                'end' => $row['date_to']."T24:00:00",
                'color' => $row['color'],
                'allDay' => true,
                'editable' => true
            );
        }

        echo json_encode($result);
    }

    public function getSection() {
        $grade = $this->input->post('grade');
        $data = $this->calendar_model->get_section($grade);
        foreach ($data as &$row) {
            $result[] = array(
                    'gid' => $row['gid'],
                    'group_name' => $row['group_name']
                );
        }
        echo json_encode($result);
    }

    public function getGrade() {
        $lesson = $this->input->post('lesson');
        $data = $this->calendar_model->get_grade($lesson);
        $result = [];
        foreach ($data as &$row) {
            $result[] = array(
                    'id' => $row['lid'],
                    'name' => $row['level_name']
                );
        }
        echo json_encode($result);
    }

    public function getSubject() {
        $lesson = $this->input->post('lesson');
        $data = $this->calendar_model->get_subject($lesson);
        $result = [];
        foreach ($data as &$row) {
            $result[] = array(
                    'id' => $row['cid'],
                    'name' => $row['category_name']
                );
        }
        echo json_encode($result);
    }



}