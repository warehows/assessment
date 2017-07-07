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
        $data['subject_model'] = $this->subjects_model;
        $data['grade_model'] = $this->grades_model;
        $data['all_lessons'] = $this->lessons_model->all_lessons_non_duplicated();
        $data['logged_in'] = $logged_in;

        if ($logged_in["su"] == 1) {
            $this->load->view('new_material/header', $data);
            $this->load->view('lessons/index.php', $data);
        } else if ($logged_in["su"] == 2) {
            $this->load->view('new_material/teacher_header', $data);
            $this->load->view('lessons/teacher_index.php', $data);
        }

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
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['title'] = $this->lang->line('Lessons');
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_levels'] = $this->level_model->all();

        $this->load->view('new_material/header', $data);
        $this->load->view('lessons/create', $data);
        $this->load->view('new_material/footer', $data);
    }

    public function index_actions()
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
        $data['logged_in'] = $logged_in;
        $post = $_POST;
        $this->load->view('new_material/header',$data);
        if($post["submit"]=="import") {
            $data = array(
                "lesson_ids"=>$post['selected_lesson'],
                "user_id"=>$logged_in['uid'],
                "content_type"=>"lesson",
                "all_users"=>$this->user_model->get_all(),
                "all_subjects"=>$this->subjects_model->get_all(),
                "all_levels"=>$this->level_model->get_all(),
            );
            $imported = $this->lessons_model->import_to_workspace($data);

//            print_r($post['selected_lesson']);
        }elseif($post["submit"]=="edit"){
            $data['lesson_id'] = $post['selected_lesson'][0];
            $author = $this->lessons_model->lesson_by_id($data['lesson_id']);
            $data['author'] = $author[0]['author'];
            $this->load->view('lessons/edit',$data);
        }elseif($post["submit"]=="view"){
            $data['lesson_id'] = $post['selected_lesson'][0];
            $author = $this->lessons_model->lesson_by_id($data['lesson_id']);
            $data['author'] = $author[0]['author'];
            $this->load->view('lessons/view',$data);
        }elseif($post["submit"]=="remove"){
            $data['lesson_id'] = $post['selected_lesson'][0];
            foreach($post['selected_lesson'] as $key=>$value){
                $data['id'] = $value;
                $data['share'] = 0;
                $return_value = $this->lessons_model->change_share($data);
            }
            redirect(site_url()."/lessonbank");
        }
        elseif($post["submit"]=="delete"){
            $data['lesson_id'] = $post['selected_lesson'][0];
            foreach($post['selected_lesson'] as $key=>$value){
                $this->lessons_model->delete_by_id($value);
                $this->lessons_model->delete_where("lesson_id",$value);
            }
            redirect(site_url()."/lessons");

        }
        elseif($post["submit"]=="share"){
            $data['lesson_id'] = $post['selected_lesson'][0];
            foreach($post['selected_lesson'] as $key=>$value){
                $data['id'] = $value;
                $data['share'] = 1;
                $return_value = $this->lessons_model->change_share($data);
            }
            redirect(site_url()."/lessons");
        }
        else{
            print_r($post);
//            redirect(site_url()."/lessons");
        }
        $this->load->view('new_material/footer',$data);

    }

    public function update_lesson_info(){
        $data = $this->input->post();

        $update_data = array(
            "lesson_name"=>$data["lesson_name"],
            "subject_id"=>$data["subject_id"],
            "level_id"=>$data["level_id"],
        );

        $this->db->where("id",$data["id"]);
        $this->db->update("lessons",$update_data);
    }

    public function create_modify_folder()
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
        $data['lesson_id'] = $this->input->get('lesson_id');
        $data['author'] = $this->input->get('author');
        $data['duplicated'] = $this->input->get('duplicated');
        $this->load->view('new_material/header', $data);
        $this->load->view('lessons/create_modify_folder.php', $data);
        $this->load->view('new_material/footer', $data);
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

    public function checkIfLessonNameExist(){
        $post = $this->input->post();

        $data = $this->lessons_model->checkIfLessonNameExist($post['lesson_name']);

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
        $data = array("lesson_id" => $_POST['lesson_id'], "folder_name" => $_POST['folder_name'], "author" => $_POST['author']);
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
//
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
        $data = array("folder_name" => $_POST['folder_name'], "lesson_id" => $_POST['lesson_id']);
        $data = $this->lessons_model->all_lesson_contents_where($data);
        $data = $data[0];
        $data = $this->lessons_model->delete_file_by_id($data);
//        print_r($folder . $filename);
        print_r(json_encode($data));

        unlink($folder . $filename);


    }

    public function modify_folders()
    {
        // redirect if not logged in
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
//        $this->load->view('new_material/header', $data);
        $this->load->view('lessons/modify_folder.php', $data);
//        $this->load->view('new_material/footer', $data);

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
            "lesson_id" => $data['lesson_id'],
            "author" => $data['author'],
            "content_type" => $data['content_type'],
            "content_name" => $data['content'][0],
            "folder_name" => $data['folder_name'],
            "duplicated" => $data['duplicated'],
        );


        $data = $this->lessons_model->save_files_to_database($data);

        print_r(json_encode($data));

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

        $data = $this->lessons_model->all_lesson_contents_where($data);

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

    public function display_all_quizzes()
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

        $data = $this->quiz_model->getCollection("savsoft_quiz", "quiz_name,quid");

        print_r(json_encode($data));

    }

    public function add_quizzes_to_lessons()
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
        $data_selected_quizzes = $data['selected_quizzes'];
//        print_r($data);
        foreach ($data_selected_quizzes as $key => $value) {
            $lesson = $this->quiz_model->get_quiz($value);
            $lesson_name = $lesson["quiz_name"];
//            print_r($lesson_name);
            $data = array(
                "lesson_id" => $data['lesson_id'],
                "author" => "",
                "folder_name" => $data['folder_name'],
                "content_type" => $data['content_type'],
                "content_name" => $lesson_name,
            );
            print_r($this->lessons_model->save_files_to_database($data));
        }

    }

    public function get_quiz()
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

        $data = $this->quiz_model->get_quiz($data['quid']);

        print_r(json_encode($data));

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
