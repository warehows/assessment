<?php

Class Subjects_model extends CI_Model
{
    //custom
    function all()
    {
        $query = $this->db->get('savsoft_category');
        return $query->result_array();
    }
}

?>