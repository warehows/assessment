<?php
Class Calendar_model extends CI_Model
{
    function get_all($user, $grade, $section, $subject, $filter)
    {
        $logged_in = $this->session->userdata('logged_in');

        $this->db->select('c.id as calendar_id, c.workspace_id,c.lesson_id,c.cid,c.gid,c.lid,c.date_from,c.date_to,c.uid,csc.color,l.lesson_name,s.group_name,u.first_name,u.last_name');
        $this->db->from('calendar AS c');
        $this->db->join('lessons as l', 'l.id = c.lesson_id')
            ->join('savsoft_users as u','u.uid = c.uid')
            ->join('savsoft_group as s','s.gid = c.gid')
            ->join('calendar_subject_color as csc', 'csc.cid = c.cid');

        if ($logged_in['su'] == '2') {
            $this->db->where('c.uid',$user);
        }

        if($filter === "true") {
            $whereArray = array();
            if($user != "") {
                $whereArray['c.uid'] = $user;
            }
            if($grade != "") {
                $whereArray['c.lid'] = $grade;
            }
            if($section != "") {
                $whereArray['c.gid'] = $section;
            }
            if($subject != "") {
                $whereArray['c.cid'] = $subject;
            }

            $this->db->where($whereArray);
        }
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
        if (is_array($data['section'])) {
            foreach ($data['section'] as $row) {
                foreach (explode( ",", $row ) as $sectionID) {
                    print $sectionID."<br>";
                    $this->db->where('id',$data['lesson']);
                    $sec = $this->db->get('lessons');
                    $newSchedule = array(
                        'lesson_id' => $data['lesson'],
                        'gid' => $sectionID,
                        'cid' => $sec->row('subject_id'),
                        'date_from' => $dateFrom->format('Y-m-d'),
                        'date_to' => $dateTo->format('Y-m-d'),
                        'uid' => $logged_in['uid'],
                        'workspace_id' => $query->row('id')
                    );

                    $this->db->insert('calendar', $newSchedule);
                }
            }
            return true;
        } else {
            $newSchedule = array(
                'lesson_id' => $data['lesson'],
                'cid' => $data['subject'],
                'gid' => $data['section'],
                'lid' => $data['grade'],
                'date_from' => $dateFrom->format('Y-m-d'),
                'date_to' => $dateTo->format('Y-m-d'),
                'uid' => $logged_in['uid'],
                'workspace_id' => $query->row('id')
            );
            if ($this->db->insert('calendar', $newSchedule)) {
                return true;
            } else {
                return false;
            }
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