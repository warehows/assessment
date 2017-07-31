<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessonbank extends CI_Controller
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
        $data['all_quizzes'] = $this->quiz_model->all_shared("savsoft_quiz","*","shared",1);
        $data['all_levels'] = $this->level_model->all();
        $data['subject_model'] = $this->subjects_model;
        $data['grade_model'] = $this->grades_model;
        $data['all_lessons'] = $this->lessons_model->all_lessons_shared();
        $data['logged_in'] = $logged_in;

        if ($logged_in["su"] == 1) {
            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
            $this->load->view('lesson_bank/index.php', $data);
        } else if ($logged_in["su"] == 2) {
            $this->load->view('new_material/teacher_header', $data);
            $this->load->view('lesson_bank/teacher_index', $data);
        }

        $this->load->view('new_material/footer', $data);


    }



}
