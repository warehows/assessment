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
                    $copied_quiz = array(
                        "quiz_name"=>$quiz_data_to_copy['quiz_name'],
                        "description"=>$quiz_data_to_copy['description'],
                        "start_date"=>strtotime($post['date_start']),
                        "end_date"=>strtotime($post['date_end']),
                        "gids"=>$requests['sections'][0],
                        "qids"=>$quiz_data_to_copy['qids'],
                        "noq"=>$quiz_data_to_copy['noq'],
                        "correct_score"=>$quiz_data_to_copy['correct_score'],
                        "incorrect_score"=>$quiz_data_to_copy['incorrect_score'],
                        "duration"=>$quiz_data_to_copy['duration'],
                        "maximum_attempts"=>$quiz_data_to_copy['maximum_attempts'],
                        "pass_percentage"=>$quiz_data_to_copy['pass_percentage'],
                        "view_answer"=>$quiz_data_to_copy['view_answer'],
                        "question_selection"=>$quiz_data_to_copy['question_selection'],
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