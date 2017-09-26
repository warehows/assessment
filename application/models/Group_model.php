<?php

Class Group_model extends CI_Model
{
    //custom
    function get_all()
    {
        $query = $this->db->get('savsoft_group');
        return $query->result_array();
    }

    function where($where,$data)
    {
        $this->db->where($where,$data);
        $query = $this->db->get('savsoft_group');
        return $query->result_array();
    }

    public function load($table,$key,$value){

        $query = $this->db->query("select * from ".$table." where ".$key."='".$value."'");

        return $query->row_array();
    }

}

?>