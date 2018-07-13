<?php

Class Subjects_model extends CI_Model
{
    //custom
    function all()
    {
        $query = $this->db->get('savsoft_category');
        return $query->result_array();
    }

    function where($where,$data)
    {
        $this->db->where($where,$data);
        $query = $this->db->get('savsoft_category');
        return $query->result_array();
    }
}

?>