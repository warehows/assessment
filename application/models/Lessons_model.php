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

    function add_folder($data)
    {
        $this->db->insert('lesson_folder', $data);
        $quid = $this->db->insert_id();
        return $data['folder_name'];
    }

    function delete_folder($data)
    {
        $this->db->where('lesson_id', $data['lesson_id'])->where('folder_name', $data['folder_name']);
        $this->db->delete('lesson_folder');
        return $data['folder_name'];
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