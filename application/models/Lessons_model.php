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

}

?>