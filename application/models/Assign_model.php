<?php

Class Assign_model extends CI_Model
{
    function insert_quiz($data)
    {
        $this->db->insert('savsoft_quiz', $data);
        $quid = $this->db->insert_id();
        return $quid;

    }
    function update_quiz($data)
    {
        $this->db->where('quid', $data['quid']);
        $this->db->update('savsoft_quiz', $data);
        return $data['quid'];

    }

}

?>