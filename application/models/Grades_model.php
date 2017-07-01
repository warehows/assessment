<?php

Class Grades_model extends CI_Model
{
    //custom
    function all()
    {
        $query = $this->db->get('savsoft_level');
        return $query->result_array();
    }

    function where($where,$data)
    {
        $this->db->where($where,$data);
        $query = $this->db->get('savsoft_level');
        return $query->result_array();
    }
}

?>