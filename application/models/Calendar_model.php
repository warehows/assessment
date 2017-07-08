<?php
Class Calendar_model extends CI_Model
{
    function get_all()
    {	
    	$logged_in = $this->session->userdata('logged_in');
    	
    	$this->db->select('c.id as calendar_id, c.workspace_id,c.lesson_id,c.cid,c.gid,c.lid,c.date_from,c.date_to,c.uid,csc.color,l.lesson_name');
		$this->db->from('calendar AS c');
		$this->db->join('lessons as l', 'l.id = c.lesson_id')
				->join('calendar_subject_color as csc', 'csc.cid = c.cid');
		$this->db->where('c.uid',$logged_in['uid']);
		$this->db->group_by('c.id');
		$query = $this->db->get('calendar');
		return $query->result_array();

    }

    function get_lessons(/*$user*/) {
    	$this->db->where('content_type',"lesson");
    	// $this->db->where('user_id',$user);
    	$query = $this->db->get('workspace');

        return $query->result_array();
    }

    function get_grade($lesson) {
    	$this->db->where('lessons.id',$lesson);
    	$this -> db -> join('savsoft_level', 'lessons.level_id=savsoft_level.lid');
    	$query = $this -> db -> get('lessons');
    	return $query->result_array();
    }

    function get_subject($lesson) {
    	$this->db->where('lessons.id',$lesson);
    	$this -> db -> join('savsoft_category', 'lessons.subject_id=savsoft_category.cid');
    	$query = $this -> db -> get('lessons');
    	return $query->result_array();
    }

    function create_schedule($data)
    {

    	$logged_in = $this->session->userdata('logged_in');
    	$dateFrom = new DateTime($data['dateFrom']);
    	$dateTo = new DateTime($data['dateTo']);

    	$this->db->where('user_id',$logged_in['uid'])
            ->where('content_id', $data['lesson']);
    	$query = $this->db->get('workspace');

        $workspace = $query->result_array();


        $newSchedule = array(
          	
            'lesson_id' => $data['lesson'],
            'cid' => $data['subject'],
            'gid' => $data['section'],
            'lid' => $data['grade'],
            'date_from' => $dateFrom->format('Y-m-d'),
            'date_to' => $dateTo->format('Y-m-d'),
            'uid' => $logged_in['uid'],
            'workspace_id' => $workspace[0]['id']

        );

        if ($this->db->insert('calendar', $newSchedule)) {

            return true;
        } else {

            return false;
        }

    }


    function update_schedule($data)
    {
    	$this->db->where('id', $data['calendar_id']);
		$this->db->update('calendar',  array('date_from' => $data['dateFrom'], 'date_to' => $data['dateTo'])); 	
    }

    function delete_schedule($data)
    {
    	$this->db->where('id', $data['id']);
		$this->db->delete('calendar'); 	
    }


}