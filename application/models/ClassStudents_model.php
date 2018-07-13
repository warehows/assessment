<?php

Class ClassStudents_model extends CI_Model
{
    //custom
    function get_all()
    {
        $query = $this->db->get('class_students');
        return $query->result_array();
    }

}

?>