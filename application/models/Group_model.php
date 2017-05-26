<?php

Class Group_model extends CI_Model
{
    //custom
    function get_all()
    {
        $query = $this->db->get('savsoft_group');
        return $query->result_array();
    }

}

?>