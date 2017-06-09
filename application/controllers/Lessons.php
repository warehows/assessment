<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lessons extends CI_Controller
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
        $data['all_levels'] = $this->level_model->all();
        $this->load->view('material_part/header_material', $data);
        $this->load->view('lessons/index.php', $data);
        $this->load->view('material_part/footer_material', $data);
    }

    public function save_lesson()
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

        $data = $this->input->post();
        $data = $this->lessons_model->save_lesson($data);

        echo $data;

    }

    public function save_lesson_with_folder()
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

        $data = $this->input->post();
        $data = $this->lessons_model->save_lesson_with_folder($data);

        echo $data;

    }

    public function upload_files()
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
        $output_dir = $_SERVER['DOCUMENT_ROOT'] . "/assessment/upload/lessons/";
        $folder_to_create = $_POST['lesson_id'] . "_" . $_POST['folder_name'];
        $folder = $output_dir . $folder_to_create;
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $ret = array();

        $error = $_FILES["myfile"]["error"];

        if (!is_array($_FILES["myfile"]["name"])) //single file
        {
            $fileName = $_FILES["myfile"]["name"];
            move_uploaded_file($_FILES["myfile"]["tmp_name"], $folder . "/" . $fileName);
            $ret[] = $fileName;
        } else  //Multiple files, file[]
        {
            $fileCount = count($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES["myfile"]["name"][$i];
                move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $folder . "/" . $fileName);
                $ret[] = $fileName;
            }

        }
        $data = array("lesson_id" => $_POST['lesson_id'], "folder_name" => $_POST['folder_name']);
        $data = $this->lessons_model->get_current_folder($data);
        print_r(json_encode($data[0]['id']));


    }

    public function get_current_folder()
    {
        $data = $this->input->post();
        $data = $this->lessons_model->get_current_folder($data);
        print_r(json_encode($data));
    }


    public function delete_upload_files_by_id()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $output_dir = $_SERVER['DOCUMENT_ROOT'] . "/assessment/upload/lessons/";

        $folder_to_create = $_POST['lesson_id'] . "_" . $_POST['folder_name'];
        $folder = $output_dir . $folder_to_create . "/";

        $filename = $_POST['filename'];

        $data = array("id" => $_POST['lesson_contents_id']);

        $data = $this->lessons_model->delete_file_by_id($data);
        unlink($folder . $filename);
        print_r($folder . $filename);

    }

    public function delete_upload_files()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $output_dir = $_SERVER['DOCUMENT_ROOT'] . "/assessment/upload/lessons/";

        $folder_to_create = $_POST['lesson_id'] . "_" . $_POST['folder_name'];
        $folder = $output_dir . $folder_to_create . "/";

        $filename = $_POST['filename'];
        $filename = explode(" ", $filename);
        $filename_count = count($filename) - 1;
        $filename_count_minus_one = $filename_count - 1;
        unset($filename[$filename_count]);
        unset($filename[$filename_count_minus_one]);
        unset($filename[0]);
        $filename = implode(" ", $filename);
        $data = array("content" => $filename, "folder_name" => $_POST['folder_name'], "lesson_id" => $_POST['lesson_id']);
        $data = $this->lessons_model->join_tables($data);
        $data = $data[0];
        $data = $this->lessons_model->delete_file_by_id($data);
        print_r($data);

        unlink($folder . $filename);


    }

    public function save_files_to_database()
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

        $data = $this->input->post();

        $data = array(
            "lesson_folder_id" => $data['lesson_folder_id'],
            "content_type" => "file",
            "content" => $data['content'][0],
        );

        $data = $this->lessons_model->save_files_to_database($data);

        print_r($data);

    }

    public function update_files()
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

        $data = $this->input->post();

        $data = $this->lessons_model->all_lesson_contents_by_id($data);

        echo json_encode($data);

    }

    public function add_folder()
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

        $data = $this->input->post();
        $data = $this->lessons_model->add_folder($data);

        echo $data;

    }

    public function delete_folder()
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

        $data = $this->input->post();
        $data = $this->lessons_model->delete_folder($data);

        echo $data;
    }

    public function edit_folder()
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

        $data = $this->input->post();
        $data = $this->lessons_model->edit_folder($data);

        echo $data;

    }

    public function open_folder()
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

        $data = $this->input->post();
        $data = $this->lessons_model->edit_folder($data);

        echo $data;

    }

    public function step2()
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

        $this->load->view('material_part/header_material', $data);
        $this->load->view('lessons/step2.php', $data);
        $this->load->view('material_part/footer_material', $data);

    }


}
