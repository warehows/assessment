<?php

Class Lessons_model extends CI_Model
{
    //custom

    function get_model()
    {
       return $this;

    }
    function all_lessons()
    {
        $query = $this->db->get('lessons');
        return $query->result_array();
    }

    function where($where, $data)
    {
        $this->db->where($where, $data);
        $query = $this->db->get('lessons');
        return $query->result_array();
    }

    function all_lessons_non_duplicated()
    {
        $this->db->where('duplicated', 0);
        $query = $this->db->get('lessons');
        return $query->result_array();
    }

    function all_lessons_shared()
    {
        $this->db->where('shared', 1);
        $query = $this->db->get('lessons');
        return $query->result_array();
    }

    function lesson_by_id($data)
    {
        $this->db->where('id', $data);
        $query = $this->db->get('lessons');
        return $query->result_array();
    }

    function check_if_assigned($data)
    {
        $this->db->where('id', $data);
        $query = $this->db->get('lessons');
        $query = $query->result_array()[0];

        if($query['assigned']==1){
            return true;
        }else{
            return false;
        }

    }

    function delete_by_id($data)
    {
        $this->db->where('id', $data);
        $this->db->delete('lessons');
//        return $query->result_array();
    }

    function delete_where($where, $data)
    {
        $this->db->where($where, $data);
        $this->db->delete('lesson_contents');
//        return $query->result_array();
    }

    function all_lesson_folder()
    {
        $query = $this->db->get('lesson_folder');
        return $query->result_array();
    }

    function checkIfLessonNameExist($lessonName)
    {
        $this->db->where('lesson_name', $lessonName);
        $query = $this->db->get('lessons');

        $result = count($query->result_array());
        return ($result > 0) ? 1 : 0;
    }

    function all_lesson_contents()
    {
        $query = $this->db->get('lessons');
        return $query->result_array();
    }

    function all_lesson_contents_by_id($data)
    {
        $this->db->where('lesson_id', $data['lesson_id']);
        $query = $this->db->get('lesson_contents');
        return $query->result_array();
    }

    function all_lesson_contents_where($data)
    {
        $this->db->where('lesson_id', $data['lesson_id'])
            ->where('folder_name', $data['folder_name']);
        $query = $this->db->get('lesson_contents');
        return $query->result_array();
    }

    function save_lesson($data)
    {
        $data = array(
            'lesson_name' => $data['lesson_name'],
            'subject_id' => $data['subject_id'],
            'level_id' => $data['level_id'],
        );

        $this->db->insert('lessons', $data);
        $quid = $this->db->insert_id();


        return $quid;
    }

    function save_lesson_with_folder($data)
    {
        $logged_in = $this->session->userdata('logged_in');

        if ($logged_in['su'] == 1) {
            $this->db->insert('lessons', $data);
            $quid = $this->db->insert_id();
        } else if ($logged_in['su'] == 2) {
            $this->db->insert('lessons', $data);
            $quid = $this->db->insert_id();
            $insert_to_workspace = array(
                "user_id" => $logged_in['uid'],
                "content_id" => $quid,
                "content_type" => "lesson",
                "content_name" => $this->lesson_by_id($quid)[0]['lesson_name'],
            );
            $this->workspace_model->insert_workspace($insert_to_workspace);
        }


        return $quid;
    }

    function add_folder($data)
    {
        $this->db->insert('lesson_folder', $data);
        $quid = $this->db->insert_id();
        return $data['folder_name'];
    }

    function join_tables($data)
    {
        $this->db->select('*');
        $this->db->from('lesson_folder');
        $this->db->join('lesson_contents', 'lesson_contents.lesson_folder_id = lesson_folder.id');
        $data = $this->db->where('content', $data['content'])->where('folder_name', $data['folder_name']);
        $data = $this->db->get();
        return $data->result_array();
//        return $data;
    }

    function delete_file_by_id($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('lesson_contents');
        return $data;
    }

    function save_files_to_database($data)
    {

        $this->db
            ->where('lesson_id', $data['lesson_id'])
            ->where('author', $data['author'])
            ->where('folder_name', $data['folder_name'])
            ->where('content_id', $data['content_id'])
            ->where('content_name', $data['content_name'])
            ->where('content_type', $data['content_type']);

        $query = $this->db->get('lesson_contents');

        $count_row = $query->num_rows();

        if ($count_row > 0) {
            return false;
        } else {
            if($data['content_type']=="quiz"){
                $this->db
                    ->where('lesson_id', $data['lesson_id'])
                    ->where('content_id', $data['content_id'])
                ;
                $query2 = $this->db->get('lesson_contents');
                $count_row2 = $query2->num_rows();
                if ($count_row2 > 0) {
                    return false;
                } else {
                    $this->db->insert('lesson_contents', $data);
                    $id = $this->db->insert_id($data);
                    return $data;
                }
            }else{
                $this->db->insert('lesson_contents', $data);
                $id = $this->db->insert_id($data);
                return $data;
            }

        }



    }

    function duplicate($data)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $data['logged_in'] = $logged_in;

        $user_id_real = $data["user_id"];

        foreach ($data['lesson_ids'] as $key => $value) {
            $loop_data = $this->lesson_by_id($value);
            $lesson_id = array("lesson_id" => $value);
            $lesson_contents = $this->all_lesson_contents_by_id($lesson_id);
            $existed = $this->where("lesson_name", $loop_data[0]['lesson_name']);
            echo "<pre>";

            foreach ($existed as $existed_key => $existed_value):
                $existed_lesson_name = $existed_value['lesson_name'];
                if ($existed_lesson_name) {
                    $this->db->like("lesson_name", $loop_data[0]['lesson_name'] . "(");
                    $existed_with_numbering = $this->db->get("lessons");
                    $existed_with_numbering = $existed_with_numbering->result_array();
                    $substr_array = array();
                    foreach ($existed_with_numbering as $existed_with_numbering_key => $existed_with_numbering_value):
//                        print_r($existed_with_numbering_value['lesson_name']);
                        $existed_with_numbering_lesson_name = $existed_with_numbering_value['lesson_name'];
                        $substr = substr($existed_with_numbering_lesson_name, strpos($existed_with_numbering_lesson_name,  "(") + 1);
                        $substr = substr($substr,0,1);
                        if(!in_array($substr,$substr_array)){
                            array_push($substr_array,$substr);
                        }


                    endforeach;

                    if($substr_array){
                        $existed_with_numbering_count = count($substr_array);
                        $new_lesson_name = $loop_data[0]['lesson_name']."(".($existed_with_numbering_count+1).")";
                    }else{
                        $new_lesson_name = $loop_data[0]['lesson_name']."(1)";
                    }
                    print_r($new_lesson_name);
                }
//                exit;
            endforeach;

            $data = array(
                'lesson_name' => $new_lesson_name,
                'subject_id' => $loop_data[0]['subject_id'],
                'level_id' => $loop_data[0]['level_id'],
                'author' => $user_id_real,
                'duplicated' => 1,
            );

            $this->db->insert('lessons', $data);
            $new_lesson_id = $this->db->insert_id();

            $workspace_data = array(
                'user_id' => $user_id_real,
                'content_id' => $new_lesson_id,
                'content_type' => "lesson",
                'content_name' => $new_lesson_name,
            );
            $this->db->insert('workspace', $workspace_data);
            $new_workspace_id = $this->db->insert_id();
            foreach ($lesson_contents as $lesson_content_key => $lesson_content_value) {
                $lesson_data = array(
                    'lesson_id' => $new_lesson_id,
                    'content_name' => $lesson_content_value['content_name'],
                    'author' => 1,
                    'content_type' => $lesson_content_value['content_type'],
                    'folder_name' => $lesson_content_value['folder_name'],
                    'duplicated' => 1,
                );
                $this->save_files_to_database($lesson_data);

                $output_dir = $_SERVER['DOCUMENT_ROOT'] . "/brainee/upload/lessons/";
                $folder_to_create = $new_lesson_id . "_" . $lesson_content_value['folder_name'];
                $folder = $output_dir . $folder_to_create;
                if (!file_exists($folder)) {
                    $old = umask(0);
                    mkdir($folder, 0777);
                    umask($old);
                }
                $document_root = $_SERVER['DOCUMENT_ROOT'] . "/assessment";
                $file = $document_root . "/upload/lessons/" . $value . "_" . $lesson_content_value['folder_name'] . "/" . $lesson_content_value['content_name'];
                $newfile = $document_root . "/upload/lessons/" . $new_lesson_id . "_" . $lesson_content_value['folder_name'] . "/" . $lesson_content_value['content_name'];
                copy($file, $newfile);

            }
        }

        return $new_workspace_id;
    }

    function get_current_folder($data)
    {
        $data = $this->db->where('lesson_id', $data['lesson_id'])->where('folder_name', $data['folder_name'])->where('author', $data['author']);
        $data = $this->db->get('lesson_contents');

        return $data->result_array();
    }

    public $get_latest_lesson_id_imported_to_workspace;

    function import_to_workspace($data)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['base_url'] != base_url()) {
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
        $data['logged_in'] = $logged_in;
        $user_id = $data['user_id'];

        foreach ($data['lesson_ids'] as $key => $value) {
            $loop_data = $this->lesson_by_id($value);

            $lesson_id = array("lesson_id" => $value);
            $lesson_contents = $this->all_lesson_contents_by_id($lesson_id);

            $data = array(
                'lesson_name' => $loop_data[0]['lesson_name'] . "-copy",
                'subject_id' => $loop_data[0]['subject_id'],
                'level_id' => $loop_data[0]['level_id'],
                'author' => $data['user_id'],
                'duplicated' => 1,
            );

            $this->db->insert('lessons', $data);
            $new_lesson_id = $this->db->insert_id();

            $workspace_data = array(
                'user_id' => $user_id,
                'content_id' => $new_lesson_id,
                'content_type' => "lesson",
                'content_name' => $loop_data[0]['lesson_name'] . "-copy",
            );



            $this->db->insert('workspace', $workspace_data);

            $this->get_latest_lesson_id_imported_to_workspace = $new_lesson_id;
            $return_workspace_value = $this->db->insert_id();

            foreach ($lesson_contents as $lesson_content_key => $lesson_content_value) {
                $lesson_data = array(
                    'lesson_id' => $new_lesson_id,
                    'content_name' => $lesson_content_value['content_name'],
                    'content_id' => $lesson_content_value['content_id'],
                    'author' => $user_id,
                    'content_type' => $lesson_content_value['content_type'],
                    'folder_name' => $lesson_content_value['folder_name'],
                    'duplicated' => 1,
                );


                $this->save_files_to_database($lesson_data);

                if($lesson_content_value['content_type']=="file"){
                    $output_dir = $_SERVER['DOCUMENT_ROOT'] . "/brainee/upload/lessons/";
                    $folder_to_create = $new_lesson_id . "_" . $lesson_content_value['folder_name'];
                    $folder = $output_dir . $folder_to_create;
                    if (!file_exists($folder)) {
                        $old = umask(0);
                        mkdir($folder, 0777);
                        umask($old);
                    }
                    $document_root = $_SERVER['DOCUMENT_ROOT'] . "/brainee";
                    $file = $document_root . "/upload/lessons/" . $value . "_" . $lesson_content_value['folder_name'] . "/" . $lesson_content_value['content_name'];
                    $newfile = $document_root . "/upload/lessons/" . $new_lesson_id . "_" . $lesson_content_value['folder_name'] . "/" . $lesson_content_value['content_name'];
                    copy($file, $newfile);
                }
            }

        }
        return $return_workspace_value;
    }

    function delete_folder($data)
    {
        $this->db->where('lesson_id', $data['lesson_id'])->where('folder_name', $data['folder_name']);
        $this->db->delete('lesson_folder');
        return $data['folder_name'];
    }

    function delete_upload_files_by_id($data)
    {
        $this->db->where('id', $data['lesson_folder_id']);
        $query = $this->db->delete('lesson_contents');
        return $data['lesson_folder_id'];
    }
    function update($data){
        $this->db->where("id", $data['id']);
        $return_value = $this->db->update("lessons", $data);
        return $return_value;
    }

    function change_share($data)
    {

        $update_data = array("shared" => $data['share']);

        $this->db->where("id", $data['id']);
        $return_value = $this->db->update("lessons", $update_data);
        return $return_value;
    }

    function edit_folder($data)
    {

        $this->db->set('lesson_id', $data['lesson_id']);
        $this->db->set('folder_name', $data['folder_name']);
        $this->db->where('lesson_id', $data['lesson_id'])->where('folder_name', $data['folder_name']);
        $this->db->update('lesson_folder');
        return $data['folder_name'];
    }

}

?>