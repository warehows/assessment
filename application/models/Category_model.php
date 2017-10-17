<?php

Class Category_model extends CI_Model
{
    public function load($table,$key,$value){

        $query = $this->db->query("select * from ".$table." where ".$key."='".$value."'");

        return $query->row_array();
    }

    public function getCollection($table,$field = '*')
    {
        $this->db->query("select ".$field." from ".$table);
        $query = $this->db->get($table);

        return $query->result_array();
    }

    //custom
    function get_all()
    {
        $query = $this->db->get('savsoft_category');
        return $query->result_array();

    }

    function get($id)
    {
        $this->db->where('cid', $id);
        $query = $this->db->get('savsoft_category');
        return $query->row_array();


    }

}

?>