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

    function select_by_gid($id)
    {
        $this->db->where('gid',$id);
        $query = $this->db->get('lesson_assigned');
        return $query->result_array();
    }

    function where($where,$data)
    {
        $this->db->where($where,$data);
        $query = $this->db->get('workspace');
        return $query->result_array();
    }
    function where_where($where,$data,$where2,$data2)
    {
        $this->db->where($where,$data)->where($where2,$data2);
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

    function insert_workspace($data)
    {
        $this->db->insert('workspace', $data);
        $quid = $this->db->insert_id();
    }

    function delete_workspace($data)
    {
        $this->db->where('id', $data["id"]);
        $quid = $this->db->delete("workspace");
        return true;
    }

    function insert_to($where,$data)
    {
        $this->db->update($where, $data);
        $quid = $this->db->insert_id();
    }

    function update_workspace($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('workspace', $data);
        return $data['id'];

    }



}

?>