<?php

Class Workspace_model extends CI_Model
{
    //custom
    function all()
    {
        $query = $this->db->get('workspace');
        return $query->result_array();
    }


    function where($where,$data)
    {
        $this->db->where($where,$data);
        $query = $this->db->get('workspace');
        return $query->result_array();
    }



}

?>