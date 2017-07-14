<?php

Class Workspace_model extends CI_Model
{
    //custom
    function all()
    {
        $query = $this->db->get('workspace');
        return $query->result_array();
    }

    function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('workspace');
    }
    function delete_by_content($id)
    {
        $this->db->where('content_id', $id)->where('content_type','lesson');
        $this->db->delete('workspace');
    }

    function where($where,$data)
    {
        $this->db->where($where,$data);
        $query = $this->db->get('workspace');
        return $query->result_array();
    }
    function where_is_lesson($id)
    {
        $this->db->where("content_id",$id)->where("content_type","lesson");
        $query = $this->db->get('workspace');
        return $query->result_array();
    }

    function insert($data)
    {
        $this->db->insert('lesson_assigned', $data);
        $quid = $this->db->insert_id();
    }



}

?>