<?php

Class Level_model extends CI_Model
{
    //custom
    function get_all()
    {
        $query = $this->db->get('savsoft_level');
        return $query->result_array();
    }

}

?>