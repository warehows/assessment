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

    function where($where,$data)
    {
        $this->db->where($where,$data);
        $query = $this->db->get('savsoft_quiz');
        return $query->result_array();
    }

    function admin_quizzes($where,$data)
    {
        $this->db->where("",$data);
        $query = $this->db->get('savsoft_quiz');
        return $query->result_array();
    }

    function delete_quiz($data)
    {
        $this->db->where("quid",$data['quid']);
        $query = $this->db->delete('savsoft_quiz');
        return true;
    }

    /* copy_quiz()
     * id = quiz_id
     *
     *
    */
    public function copy_quiz($data)
    {
        
    }
}

?>