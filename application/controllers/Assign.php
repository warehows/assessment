<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("quiz_model");
        $this->load->model("user_model");
        $this->load->model("qbank_model");
        $this->load->model("category_model");
        $this->load->model("level_model");
        $this->load->model("group_model");
        $this->load->model("subjects_model");
        $this->lang->load('basic', $this->config->item('language'));

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
        $data['title'] = $this->lang->line('quiz');
        $data['su'] = $logged_in['su'];
        // fetching quiz list
        $data['category'] = $this->category_model->get_all();
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_quiz'] = $this->quiz_model->getCollection("savsoft_quiz");

        /*        $this->load->view('material_part/header_material',$data);*/

//        $this->load->view('material_part/header_material',$data);
//        $this->load->view('assign_quiz/index.php', $data);
//        $this->load->view('material_part/footer_material',$data);

        $this->load->view('new_material/header', $data);
        $this->load->view('assign_quiz/index_new', $data);
        $this->load->view('new_material/footer', $data);

    }

    function change_share($data)
    {

        $update_data = array("shared" => $data['share']);
        $this->db->where("quid", $data['id']);
        $return_value = $this->db->update("savsoft_quiz", $update_data);

    }

    public function actions()
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
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_levels'] = $this->level_model->all();
        $data['all_sections'] = $this->group_model->get_all();
        $data['logged_in'] = $logged_in;
        $post = $_POST;
        if ($logged_in['su'] == 2) {
//            $this->load->view('new_material/teacher_header', $data);
        }
        if ($logged_in['su'] == 1) {
//            $this->load->view('new_material/header', $data);
        }

        $selected = $post['selected_quiz'];

        if ($post["submit"] == "share") {
            foreach ($selected as $key => $value) {
                $data = array(
                    "share" => "1",
                    "id" => $value,
                );
                $this->change_share($data);
            }

        } elseif ($post["submit"] == "edit") {

        }
        if ($post["submit"] == "remove") {
            foreach ($selected as $key => $value) {
                $data = array(
                    "share" => "0",
                    "id" => $value,
                );
                $this->change_share($data);
            }

        } elseif ($post["submit"] == "delete") {

        } else {

        }
        $this->load->view('new_material/footer', $data);

    }

    public function create_question()
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
        $data['title'] = $this->lang->line('quiz');
        $data['su'] = $logged_in['su'];
        // fetching quiz list
        $data['category'] = $this->category_model->get_all();
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_quiz'] = $this->quiz_model->getCollection("savsoft_quiz");

        /*        $this->load->view('material_part/header_material',$data);*/

//        $this->load->view('material_part/header_material',$data);
//        $this->load->view('assign_quiz/index.php', $data);
//        $this->load->view('material_part/footer_material',$data);

        $this->load->view('new_material/header', $data);
        $this->load->view('assign_quiz/create_question', $data);
        $this->load->view('new_material/footer', $data);

    }

    public function create()
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

        $data['title'] = $this->lang->line('quiz');
        $data['su'] = $logged_in['su'];
        // fetching quiz list
        $data['category'] = $this->category_model->get_all();
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();

        /*        $this->load->view('material_part/header_material',$data);*/

//        $this->load->view('material_part/header_material',$data);
//        $this->load->view('assign_quiz/index.php', $data);
//        $this->load->view('material_part/footer_material',$data);

        $this->load->view('material_part/header_material', $data);
        $this->load->view('assign_quiz/create', $data);
        $this->load->view('material_part/footer_material', $data);
    }

    public function update($quid)
    {
        echo $quid;
    }

    public function assessment_quiz_list()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $data = $this->quiz_model->quiz_list(0);
        echo json_encode($data);
    }

    public function get_all_questions()
    {
        $post = $this->input->post();
        $quiz_id = $post["quiz_id"];
        $data = $this->qbank_model->get_all_question($quiz_id);
        echo json_encode($data);
    }

    public function get_quiz()
    {

        $post = $this->input->post();

        $quid = $post["quid"];
        $data = $this->quiz_model->get_quiz($quid);
        $array = array(
            "start_date" => date('Y-m-d H:i:s', $data['start_date']),
            "end_date" => date('Y-m-d H:i:s', $data['end_date']),
            "duration" => $data['duration'],
            "maximum_attempts" => $data['maximum_attempts'],
            "pass_percentage" => $data['pass_percentage'],
            "view_answer" => $data['view_answer'],
        );
        echo json_encode($array);
    }

    public function update_quiz()
    {
        $post = $this->input->post();

        $settings = json_decode($post['settings']);
        $quid = $this->quiz_model->assessment_update_quiz($settings['quid'], $settings);
        print_r($quid);

//       lo $gged_in = $this->session->userdata('logged_in');
//        if ($logged_in['su'] < '1') {
//            exit($this->lang->line('permission_denied'));
//        }
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules('quiz_name', 'quiz_name', 'required');
//
//
//        if ($this->form_validation->run() == FALSE) {
//            $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . validation_errors() . " </div>");
//            redirect('quiz/edit_quiz/' . $quid);
//        } else {

//        }

    }

    public function get_all_level()
    {
        $data_level = $this->level_model->get_all();
        $data_group = $this->group_model->get_all();
//        $data_class_students = $this->classstudents_model->get_all();
        $data = array('level' => $data_level, 'group' => $data_group);
        echo json_encode($data);
    }


}
