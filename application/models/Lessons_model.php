<?php

Class Lessons_model extends CI_Model
{
    //custom
    function all_lessons()
    {
        $query = $this->db->get('lessons');
        return $query->result_array();
    }

    function all_lesson_folder()
    {
        $query = $this->db->get('lesson_folder');
        return $query->result_array();
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
        $data = array(
            'lesson_name' => $data['lesson_name'],
            'subject_id' => $data['subject_id'],
            'level_id' => $data['level_id'],
        );

        $this->db->insert('lessons', $data);
        $quid = $this->db->insert_id();
        $count = 5;
        for($counter = 1;$counter<=$count;$counter++){
            $data = array(
                'lesson_id' => $quid,
                'folder_name' => "E_".$counter,
            );

            $this->db->insert('lesson_folder', $data);
        }

        return $quid;
    }

    function add_folder($data)
    {
        $this->db->insert('lesson_folder', $data);
        $quid = $this->db->insert_id();
        return $data['folder_name'];
    }

    function join_tables($data){
        $this->db->select('*');
        $this->db->from('lesson_folder');
        $this->db->join('lesson_contents', 'lesson_contents.lesson_folder_id = lesson_folder.id');
        $data = $this->db->where('content', $data['content'])->where('folder_name', $data['folder_name']);
        $data = $this->db->get();
        return $data->result_array();
//        return $data;
    }
    function delete_file_by_id($data){
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
            ->where('content_name', $data['content_name'])
            ->where('content_type', $data['content_type']);

        $query = $this->db->get('lesson_contents');

        $count_row = $query->num_rows();

        if ($count_row > 0) {
//            return "Data already exists";
        } else {
            $this->db->insert('lesson_contents', $data);
            $id = $this->db->insert_id($data);
        }
        return $data;


    }

    function get_current_folder($data)
    {
        $data = $this->db->where('lesson_id', $data['lesson_id'])->where('folder_name', $data['folder_name'])->where('author', $data['author']);
        $data = $this->db->get('lesson_contents');

        return $data->result_array();
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