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
        $this->load->model("subjects_model");
        $this->load->model("class_model");
        $this->load->model("user_model");
        $this->load->model("group_model");
    }

    public function index(){
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

        $data['teachers'] = $this->user_model->get_user_by_account_type(2);
        $data['grades'] = $this->grades_model->all();
        $data['section'] = $this->group_model->get_all();
        $data['subject'] = $this->subjects_model->all();

        if ($logged_in["su"] == 1 || $logged_in["su"] == 2) {
            $this->load->view('new_material/header', $data);
            $this->load->view('calendar/calendar', $data);
            $this->load->view('new_material/footer', $data);
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

        if ($logged_in["su"] == 2) {
            $this->load->view('new_material/header', $data);
            $this->load->view('calendar/calendar_create', $data);
            $this->load->view('new_material/footer', $data);
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
        $filter = $this->input->post('filter');
        $teacher = $this->input->post('teacher');
        $logged_in = $this->session->userdata('logged_in')['uid'];
        $user = $filter === "true" ? $teacher : $logged_in;
        $grade = $this->input->post('grade') == "" ? "" : $this->input->post('grade');
        $section = $this->input->post('section') == "" ? "" : $this->input->post('section');
        $subject = $this->input->post('subject') == "" ? "" : $this->input->post('subject');

        $data['calendar'] = $this->calendar_model->get_all($user, $grade, $section, $subject, $filter);
        $result = [];
        if ($data['calendar']) {
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
        }

        echo json_encode($result);
    }

    public function getSection() {
        $grade = $this->input->post('grade');
        $data = $this->calendar_model->get_section($grade);
        $result = [];
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

    public function filterCalendar() {

    }

}