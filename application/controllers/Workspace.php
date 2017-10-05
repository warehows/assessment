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
        $this->load->model("group_model");
        $this->load->model("assign_model");
        $this->load->model("calendar_model");

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
        $data['all_lessons'] = $this->workspace_model->where_where("user_id", $logged_in['uid'],"content_type","lesson");
        $data['all_quizzes'] = $this->workspace_model->where_where("user_id", $logged_in['uid'],"content_type","quiz");
        $data['lessons_model'] = $this->lessons_model;
        $data['quiz_model'] = $this->quiz_model;
        $data['logged_in'] = $logged_in;
//        $data['all_quizzes'] = $this->assign_model->where("", $logged_in['uid']);

        if ($logged_in["su"] == 1) {
            if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        } elseif ($logged_in["su"] == 2) {
            $this->load->view('new_material/teacher_header', $data);
        }

        $this->load->view('workspace/index.php', $data);
        $this->load->view('new_material/footer', $data);
    }

    public function teacher_assign_lesson(){
        $requests = $_REQUEST;
        $logged_in = $this->session->userdata('logged_in');
        $date_start = $requests['date_start'];
        $date_end = $requests['date_end'];
        $sections = explode(",",$requests['sections'][0]);
        $workspace_id = $requests['workspace_id'];
        $lesson_id = $requests['lesson_id'];
        $grades = explode(",",$requests['grades'][0]);
        $lesson_assigned_ids = array();

        if($this->lessons_model->check_if_assigned($lesson_id)){
            $clear_data = array(
                "field"=>"lesson_id",
                "value"=>$lesson_id,
            );
            $this->workspace_model->delete_lesson_assigned_by_field($clear_data);
        }


        foreach ($sections as $key => $value) {

            $data = array(
                'lesson_id' => $lesson_id,
                'workspace_id' => $workspace_id,
                'uid' => $logged_in['uid'],
                'gid' => $requests['sections'][0],
                'date_start' => $date_start,
                'date_end' => $date_end,
            );

            if($teacher_workspace_model = $this->workspace_model->insert($data)){
//                print_r($teacher_workspace_model);
                array_push($lesson_assigned_ids,$teacher_workspace_model);
            }else{
                print_r("Error in lesson_assigned database");
                exit;
            }

        }
        $all_lesson_contents_by_id = array("lesson_id"=>$lesson_id);

        $current_lesson_contents = $this->lessons_model->all_lesson_contents_by_id($all_lesson_contents_by_id);



        foreach ($current_lesson_contents as $current_lesson_contents_key => $current_lesson_contents_value) {

            if ($current_lesson_contents_value['content_type'] == "quiz") {
                $quiz_data_to_copy = $this->quiz_model->get_quiz($current_lesson_contents_value['content_id']);

                $new_quiz_data = $this->quiz_model->get_quiz($current_lesson_contents_value['content_id']);
//                $get_current_workspace = $this->workspace_model->where_where("content_id",$current_lesson_contents_value['content_id'],"user_id",$logged_in['uid']);
                $update_quiz_data = array(
                    "quid"=>$current_lesson_contents_value['content_id'],
                    "start_date"=>strtotime($date_start),
                    "end_date"=>strtotime($date_end),
                    "gids"=>$requests['sections'][0],
                );
                $updated_quiz = $this->quiz_model->update($update_quiz_data);

            }
        }



        $lesson_assigned_ids_insert = implode(",",$lesson_assigned_ids);

        $lesson_update_data = array(
            "id"=>$lesson_id,
            "assigned"=>1,
            "assigned_date_start"=>date($date_start),
            "assigned_date_end"=>$date_end,
            "lesson_assigned_ids"=>$requests['sections'][0],
        );
        $lesson_update = $this->lessons_model->update($lesson_update_data);
        redirect(site_url('workspace'));

    }

    public function mass_assignation()
    {
        ini_set('max_execution_time', 1000);
        // redirect if not loggedin
        $logged_in = $this->session->userdata('logged_in');
        echo "<pre>";
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }

        $requests = $_REQUEST;

        $data['title'] = "Workspace";
        $data['all_users'] = $this->user_model->get_all();
        $data['all_subjects'] = $this->subjects_model->all();
        $data['all_levels'] = $this->level_model->all();
        $data['all_lessons'] = $this->workspace_model->where("user_id", $logged_in['uid']);

        $post['date_start'] = $requests['date_start'];
        $post['date_end'] = $requests['date_end'];
        $post['duration'] = $requests['duration'];
        $post['maximum_attempts'] = $requests['maximum_attempts'];
        $sections = $requests['sections'][0];
        $teachers = $requests['teachers'][0];
        $post['sections'] = explode(",",$sections);
        $post['teachers'] = explode(",",$teachers);
        $post['lesson_id'] = $requests['lesson_id'];


        foreach($post['teachers'] as $teacher_key => $teacher_value){
            $current_user = $this->user_model->get_user($teacher_value);

            $import_to_workspace = array(
                "lesson_ids" => array($post['lesson_id']),
                "user_id" => $teacher_value,
                "content_type" => "lesson",
                "all_users" => $this->user_model->get_all(),
                "all_subjects" => $this->subjects_model->all(),
                "all_levels" => $this->level_model->all(),
                "all_sections" => $this->group_model->get_all(),
            );

            $workspace_id = $this->lessons_model->import_to_workspace($import_to_workspace);

            $current_workspace = $this->workspace_model->where("id",$workspace_id);
            $current_lesson = $this->lessons_model->where("id",$current_workspace[0]['content_id'])[0];
            $lessons_data = array(
                "id"=>$current_workspace[0]['content_id'],
                "assigned_date_start"=>$post['date_start'],
                "assigned_date_end"=>$post['date_end'],
                "assigned"=>1,
                "lesson_assigned_ids"=>$requests['sections'][0],
            );

            $this->lessons_model->update($lessons_data);
            $lesson_id_for_content['lesson_id'] = $current_workspace[0]['content_id'];



            $current_lesson_contents = $this->lessons_model->all_lesson_contents_by_id($lesson_id_for_content);

            foreach ($current_lesson_contents as $current_lesson_contents_key => $current_lesson_contents_value) {
                if ($current_lesson_contents_value['content_type'] == "quiz") {
                    $quiz_data_to_copy = $this->quiz_model->get_quiz($current_lesson_contents_value['content_id']);
                    if($quiz_data_to_copy['maximum_attempts']){
                        $maximum_attempts = $quiz_data_to_copy['maximum_attempts'];
                    }else{
                        $maximum_attempts = 1;
                    }
                    $copied_quiz = array(
                        "quiz_name"=>$quiz_data_to_copy['quiz_name'],
                        "description"=>$quiz_data_to_copy['description'],
                        "start_date"=>strtotime($post['date_start']),
                        "end_date"=>strtotime($post['date_end']),
                        "gids"=>$requests['sections'][0],
                        "qids"=>$quiz_data_to_copy['qids'],
                        "noq"=>$quiz_data_to_copy['noq'],
                        "correct_score"=>$post['correct_score'],
                        "incorrect_score"=>$post['correct_score'],
                        "duration"=>$post['duration'],
                        "maximum_attempts"=>$post['maximum_attempts'],
                        "pass_percentage"=>$post['pass_percentage'],
                        "view_answer"=>$quiz_data_to_copy['view_answer'],
                        "question_selection"=>$quiz_data_to_copy['question_selection'],
                        "camera_req"=>0,
                        "cid"=>$quiz_data_to_copy['cid'],
                        "uid"=>$teacher_value,
                        "lid"=>$quiz_data_to_copy['lid'],
                        "author"=>$teacher_value,
                        "assigned_by"=>$logged_in['uid'],
                        "assigned"=>1,
                        "teacher_ids"=>$teacher_value,
                        "semester"=>$quiz_data_to_copy['semester'],

                    );

                    $new_quid = $this->assign_model->insert_quiz($copied_quiz);
                    $new_quiz_data = $this->quiz_model->get_quiz($new_quid);
                    $lesson_update = array(
                        "id"=>$current_lesson_contents_value['id'],
                        "lesson_id"=>$current_lesson_contents_value['lesson_id'],
                        "author"=>$teacher_value,
                        "content_id"=>$new_quid,
                        "content_name"=>$new_quiz_data['quiz_name'],
                        "content_type"=>"quiz",
                        "folder_name"=>$current_lesson_contents_value['folder_name'],
                        "duplicated"=>1,
                    );
                    $this->workspace_model->update_lesson_content($lesson_update);
                    if($logged_in['su']==1) {
                        $insert_to_workspace = array(
                            "user_id" => $teacher_value,
                            "content_id" => $new_quid,
                            "content_type" => "quiz",
                            "content_name" => $new_quiz_data['quiz_name'],
                        );
                        $this->workspace_model->insert_workspace($insert_to_workspace);
                    }
                }
            }


            foreach($post['sections'] as $gid_key=>$gid_value){
                $data_for_calendar = array(
                    "workspace_id"=>$workspace_id,
                    "cid"=>$current_lesson['subject_id'],
                    "gid"=>$gid_value,
                    "lid"=>$current_lesson['level_id'],
                    "lesson_id"=>$current_lesson['level_id'],
                    "date_from"=>$post['date_start'],
                    "date_to"=>$post['date_end'],
                    "uid"=>$teacher_value,
                );
                $this->calendar_model->create($data_for_calendar);
            }

        }
        redirect(site_url('calendar'));
    }

    public function assign_quiz()
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
        echo "<pre>";

        $posts = $this->input->get();

        $quiz_data = $this->quiz_model->get_quiz($posts['quid']);


        $update_quiz = array(
            "quid"=>$quiz_data['quid'],
            "start_date"=>strtotime($posts['date_start']),
            "end_date"=>strtotime($posts['date_end']),
            "pass_percentage"=>$posts['pass_percentage'],
            "duration"=>$posts['duration'],
            "correct_score"=>$posts['correct_score'],
            "maximum_attempts"=>$posts['maximum_attempts'],
            "view_answer"=>$posts['view_answer'],
            "gids"=>$posts['sections'][0],
            "teacher_ids"=>$posts['teachers'][0],
            "assigned"=>1,
            "assigned_by"=>$logged_in['uid'],
        );

        $this->assign_model->update_quiz($update_quiz);
        redirect("assign");
    }

    public function teacher_assign_quiz()
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


        $posts = $this->input->get();

        $workspace_id = $posts['quid'];
        $sections = implode(",",$posts['sections']);
        $teachers = implode(",",$posts['teachers']);
        $workspace_data = $this->workspace_model->where("id",$workspace_id);
        $quiz_data = $this->quiz_model->get_quiz($workspace_data[0]['content_id']);


        $update_quiz = array(
            "quid"=>$quiz_data['quid'],
            "start_date"=>strtotime($posts['date_start']),
            "end_date"=>strtotime($posts['date_end']),
            "pass_percentage"=>$posts['pass_percentage'],
            "duration"=>$posts['duration'],
            "correct_score"=>$posts['correct_score'],
            "view_answer"=>$posts['view_answer'],
            "gids"=>$sections,
            "teacher_ids"=>$teachers,
            "maximum_attempts"=>$posts['maximum_attempts'],
            "assigned"=>1,
            "assigned_by"=>$logged_in['uid'],
        );

        $this->assign_model->update_quiz($update_quiz);
        redirect("workspace");
    }



    public function assign_quiz_only()
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

        $posts = $this->input->get();
        echo "<pre/>";


        $current_quiz = $this->quiz_model->get_quiz($posts['quid']);

        $teachers = $posts['teachers'][0];
        $teachers = explode(",",$teachers);
//        print_r($current_quiz);

        $current_quiz_data = array(
            'quid' => $current_quiz['quid'],
            'teacher_ids'=>$posts['teachers'][0],
            'gids'=>$posts['sections'][0],
        );

        $current_quiz_id = $this->assign_model->update_quiz($current_quiz_data);


        //replicate quiz foreach teacher
        //save to workspace
        $implode_inserted_quid = array();
        foreach($teachers as $teacher_key => $teacher_value){

            $assigned_quiz_data = array(
                'quiz_name' => $current_quiz['quiz_name'],
                'cid' => $current_quiz['cid'],
                'uid' => $teacher_value,
                'description' => $current_quiz['description'],
                'start_date' => strtotime($posts['date_start']),
                'end_date' => strtotime($posts['date_end']),
                'duration' => $posts['duration'],
                'maximum_attempts' => 10000,
                'pass_percentage' => $posts['pass_percentage'],
                'correct_score' => $posts['correct_score'],
                'incorrect_score' => 0,
                'noq' => count(explode(",",$current_quiz['qids'])),
                'qids' => $current_quiz['qids'],
                'ip_address' => $current_quiz['ip_address'],
                'view_answer' => $posts['view_answer'],
                'camera_req' => $current_quiz['camera_req'],
                'with_login' => 1,
                'gids' => $posts['sections'][0],
                'question_selection' => $current_quiz['question_selection'],
                'lid' => $current_quiz['lid'],
                'author' => $current_quiz['author'],
                'assigned_by' => $logged_in['uid'],
                'assigned' => 1,
            );


            $recently_inserted_quid = $this->assign_model->insert_quiz($assigned_quiz_data);

            $current_workspace_data = array(
                "user_id"=>$teacher_value,
                "content_id"=>$recently_inserted_quid,
                "content_type"=>"quiz",
                "content_name"=>$current_quiz["quiz_name"],

            );
            $recently_inserted_workspace_id = $this->workspace_model->insert_workspace($current_workspace_data);

            $implode_inserted_quid[] = $recently_inserted_quid;
        }

        $current_quiz_data = array(
            'quid' => $current_quiz['quid'],
            'quiz_ids'=>implode(",",$implode_inserted_quid),
        );
        print_r($current_quiz_data);

//        redirect('assign');
    }

}
