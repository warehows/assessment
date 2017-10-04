<?php

Class Quiz_model extends CI_Model
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

    function all_shared()
    {
        $this->db->where('shared',1);
        $query = $this->db->get('savsoft_quiz');
        return $query->result_array();
    }

    function quiz_list($limit)
    {

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['su']<'1') {
            $gid = $logged_in['gid'];
            $where = "FIND_IN_SET('" . $gid . "', gids)";
            $this->db->where($where);
        }


        if ($this->input->post('search') && $logged_in['su']>'0') {
            $search = $this->input->post('search');
            $this->db->or_where('quid', $search);
            $this->db->or_like('quiz_name', $search);
            $this->db->or_like('description', $search);

        }

        if ($this->input->post('cid')) {
            $search = $this->input->post('search');
            $this->db->or_where('cid', $this->input->post('cid'));


        }

        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->order_by('quid', 'desc');
        $query = $this->db->get('savsoft_quiz');
        return $query->result_array();


    }

    function get_user_model()
    {
        $CI =& get_instance();
        $CI->load->model('user_model');
        return $CI->user_model;
    }

    function get_all_category()
    {
        $query = $this->db->query(" select * from savsoft_category");


        return $query->result_array();

    }

    function get_category($cid)
    {
        $query = $this->db->query(" select * from savsoft_category where cid ='$cid'");



        return $query->row_array();

    }

    function get_result_model(){
        $CI =& get_instance();
        $CI->load->model('result_model');
        return $CI->result_model;
    }

    function assigned_by($uid){

        $user_model = $this->get_user_model();

        return $user_model->get_user_name($uid);

    }


    function recent_quiz($limit)
    {


        $this->db->limit($limit);
        $this->db->order_by('quid', 'desc');
        $query = $this->db->get('savsoft_quiz');
        return $query->result_array();
    }

    function hasLesson()
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $gid = $logged_in['gid'];
        $quizquery = $this->db->query("select id from lesson_assigned where gid in ($gid) ");
        $quizids = $quizquery->result_array();



        return $quizids;

    }

    function hasNewQuiz()
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];
        $gid = $logged_in['gid'];
        $quizquery = $this->db->query("select quid from savsoft_quiz where gids in ($gid) ");
        $quizids = $quizquery->result_array();

        $resultquery = $this->db->query("select quid from savsoft_result where uid = '$uid' ");
        $resultids = $resultquery->result_array();
        foreach ($quizids as $quizid) {
            if (!in_array($quizid, $resultids)) {
                $newQuiz[] = $quizid;
            }
        }

        return isset($newQuiz) ? $newQuiz : null;

    }

    function open_quiz($limit)
    {


        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->order_by('quid', 'desc');
        $query = $this->db->get('savsoft_quiz');
        return $query->result_array();
    }


    function num_quiz()
    {

        $query = $this->db->get('savsoft_quiz');
        return $query->num_rows();
    }

    function insert_quiz()
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];

        $userdata = array(
            'quiz_name' => $this->input->post('quiz_name'),
            'cid' => $this->input->post('category'),
            'uid' => $uid,
            'description' => $this->input->post('description'),
            'start_date' => strtotime($this->input->post('start_date')),
            'end_date' => strtotime($this->input->post('end_date')),
            'duration' => $this->input->post('duration'),
            'maximum_attempts' => $this->input->post('maximum_attempts'),
            'pass_percentage' => $this->input->post('pass_percentage'),
            'correct_score' => $this->input->post('correct_score'),
            'incorrect_score' => $this->input->post('incorrect_score'),
            'ip_address' => $this->input->post('ip_address'),
            'view_answer' => $this->input->post('view_answer'),
            'camera_req' => $this->input->post('camera_req'),
            'with_login' => $this->input->post('with_login'),
            'gids' => implode(',', $this->input->post('gids')),
            'question_selection' => $this->input->post('question_selection')
        );
        $userdata['gen_certificate'] = $this->input->post('gen_certificate');

        if ($this->input->post('certificate_text')) {
            $userdata['certificate_text'] = $this->input->post('certificate_text');
        }
        $this->db->insert('savsoft_quiz', $userdata);
        $quid = $this->db->insert_id();
        return $quid;

    }

    function update($data)
    {

        $this->db->where('quid', $data["quid"]);
        $this->db->update('savsoft_quiz', $data);
        return $data["id"];

    }

    function update_quiz($quid)
    {

        $userdata = array(
            'quiz_name' => $this->input->post('quiz_name'),
            'description' => $this->input->post('description'),
            'start_date' => strtotime($this->input->post('start_date')),
            'end_date' => strtotime($this->input->post('end_date')),
            'duration' => $this->input->post('duration'),
            'maximum_attempts' => $this->input->post('maximum_attempts'),
            'pass_percentage' => $this->input->post('pass_percentage'),
            'correct_score' => $this->input->post('correct_score'),
            'incorrect_score' => $this->input->post('incorrect_score'),
            'ip_address' => $this->input->post('ip_address'),
            'view_answer' => $this->input->post('view_answer'),
            'camera_req' => $this->input->post('camera_req'),
            'with_login' => $this->input->post('with_login'),
            'gids' => implode(',', $this->input->post('gids'))
        );

        $userdata['gen_certificate'] = $this->input->post('gen_certificate');

        if ($this->input->post('certificate_text')) {
            $userdata['certificate_text'] = $this->input->post('certificate_text');
        }

        $this->db->where('quid', $quid);
        $this->db->update('savsoft_quiz', $userdata);

        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz', $userdata);
        $quiz = $query->row_array();
        if ($quiz['question_selection'] == '1') {

            $this->db->where('quid', $quid);
            $this->db->delete('savsoft_qcl');

            foreach ($_POST['cid'] as $ck => $val) {
                if (isset($_POST['noq'][$ck])) {
                    if ($_POST['noq'][$ck] >= '1') {
                        $userdata = array(
                            'quid' => $quid,
                            'cid' => $val,
                            'lid' => $_POST['lid'][$ck],
                            'noq' => $_POST['noq'][$ck]
                        );
                        $this->db->insert('savsoft_qcl', $userdata);
                    }
                }
            }
            $userdata = array(
                'noq' => array_sum($_POST['noq'])
            );
            $this->db->where('quid', $quid);
            $this->db->update('savsoft_quiz', $userdata);
        }
        return $quid;

    }

    function get_questions($qids)
    {
        if ($qids == '') {
            $qids = 0;
        } else {
            $qids = $qids;
        }
        /*
             if($cid!='0'){
                 $this->db->where('savsoft_qbank.cid',$cid);
             }
             if($lid!='0'){
                 $this->db->where('savsoft_qbank.lid',$lid);
             }
        */

        $query = $this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid join savsoft_level on savsoft_level.lid=savsoft_qbank.lid
	 where savsoft_qbank.qid in ($qids) order by FIELD(savsoft_qbank.qid,$qids) 
	 ");
        return $query->result_array();


    }

    function get_options($qids)
    {


        $query = $this->db->query("select * from savsoft_options where qid in ($qids) order by FIELD(savsoft_options.qid,$qids)");
        return $query->result_array();

    }


    function up_question($quid, $qid)
    {
        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz');
        $result = $query->row_array();
        $qids = $result['qids'];
        if ($qids == "") {
            $qids = array();
        } else {
            $qids = explode(",", $qids);
        }
        $qids_new = array();
        foreach ($qids as $k => $qval) {
            if ($qval == $qid) {

                $qids_new[$k - 1] = $qval;
                $qids_new[$k] = $qids[$k - 1];

            } else {
                $qids_new[$k] = $qval;

            }
        }

        $qids = array_filter(array_unique($qids_new));
        $qids = implode(",", $qids);
        $userdata = array(
            'qids' => $qids
        );
        $this->db->where('quid', $quid);
        $this->db->update('savsoft_quiz', $userdata);

    }


    function down_question($quid, $qid)
    {
        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz');
        $result = $query->row_array();
        $qids = $result['qids'];
        if ($qids == "") {
            $qids = array();
        } else {
            $qids = explode(",", $qids);
        }
        $qids_new = array();
        foreach ($qids as $k => $qval) {
            if ($qval == $qid) {

                $qids_new[$k] = $qids[$k + 1];
                $kk = $k + 1;
                $kv = $qval;
            } else {
                $qids_new[$k] = $qval;

            }

        }
        $qids_new[$kk] = $kv;

        $qids = array_filter(array_unique($qids_new));
        $qids = implode(",", $qids);
        $userdata = array(
            'qids' => $qids
        );
        $this->db->where('quid', $quid);
        $this->db->update('savsoft_quiz', $userdata);

    }


    function get_qcl($quid)
    {

        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_qcl');
        return $query->result_array();

    }

    function remove_qid($quid, $qid)
    {

        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz');
        $quiz = $query->row_array();
        $new_qid = array();
        foreach (explode(',', $quiz['qids']) as $key => $oqid) {

            if ($oqid != $qid) {
                $new_qid[] = $oqid;

            }

        }
        $noq = count($new_qid);
        $userdata = array(
            'qids' => implode(',', $new_qid),
            'noq' => $noq

        );
        $this->db->where('quid', $quid);
        $this->db->update('savsoft_quiz', $userdata);
        return true;
    }

    function add_qid($quid, $qid)
    {

        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz');
        $quiz = $query->row_array();
        $new_qid = array();
        $new_qid[] = $qid;
        foreach (explode(',', $quiz['qids']) as $key => $oqid) {

            if ($oqid != $qid) {
                $new_qid[] = $oqid;

            }

        }
        $new_qid = array_filter(array_unique($new_qid));
        $noq = count($new_qid);
        $userdata = array(
            'qids' => implode(',', $new_qid),
            'noq' => $noq

        );
        $this->db->where('quid', $quid);
        $this->db->update('savsoft_quiz', $userdata);
        return true;
    }


    function get_quiz($quid)
    {
        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz');
        return $query->row_array();


    }

    function get_quiz_where($where,$data)
    {
        $this->db->where($where, $data);
        $query = $this->db->get('savsoft_quiz');
        return $query->row_array();


    }

    function remove_quiz($quid)
    {

        $this->db->where('quid', $quid);
        if ($this->db->delete('savsoft_quiz')) {

            return true;
        } else {

            return false;
        }


    }


    function count_result($quid, $uid)
    {

        $this->db->where('quid', $quid);
        $this->db->where('uid', $uid);
        $query = $this->db->get('savsoft_result');
        return $query->num_rows();

    }


    function insert_result($quid, $uid)
    {
        echo "<pre>";
        // get quiz info
        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz');
        $quiz = $query->row_array();

        if ($quiz['question_selection'] == '0') {

            // get questions
            $noq = $quiz['noq'];
            $qids = explode(',', $quiz['qids']);
            $categories = array();
            $category_range = array();

            $i = 0;
            $wqids = implode(',', $qids);
            if(!$wqids){
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>This quiz has no questions</div>");
                redirect(site_url('quiz/quiz_detail/'.$quid));
            }

            $noq = array("");
            $query = $this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid where qid in ($wqids) ORDER BY FIELD(qid,$wqids)");
            $questions = $query->result_array();


            foreach ($questions as $qk => $question) {

                if (!in_array($question['category_name'], $categories)) {
                    $categories[] = $question['category_name'];

                    $noq[$i] += 1;

                } else {
                    $i = $i+1;

                    $noq[$i] = 1;
                }
            }


            $categories = array();
            $category_range = array();

            $i = -1;
            foreach ($questions as $qk => $question) {
                if (!in_array($question['category_name'], $categories)) {
                    $categories[] = $question['category_name'];
                    $i += 1;
                    $category_range[] = $noq[$i];

                }
            }


        } else {
            // randomaly select qids
            $this->db->where('quid', $quid);
            $query = $this->db->get('savsoft_qcl');
            $qcl = $query->result_array();
            $qids = array();
            $categories = array();
            $category_range = array();

            foreach ($qcl as $k => $val) {
                $cid = $val['cid'];
                $lid = $val['lid'];
                $noq = $val['noq'];

                $i = 0;
                $query = $this->db->query("select * from savsoft_qbank join savsoft_category on savsoft_category.cid=savsoft_qbank.cid where savsoft_qbank.cid='$cid' and lid='$lid' ORDER BY RAND() limit $noq ");
                $questions = $query->result_array();
                foreach ($questions as $qk => $question) {
                    $qids[] = $question['qid'];
                    if (!in_array($question['category_name'], $categories)) {
                        $categories[] = $question['category_name'];
                        $category_range[] = $i + $noq;
                    }
                }
            }
        }
        $zeros = array();

        foreach ($qids as $qidval) {
            $zeros[] = 0;
        }


        $userdata = array(
            'quid' => $quid,
            'uid' => $uid,
            'r_qids' => implode(',', $qids),
            'categories' => implode(',', $categories),
            'category_range' => implode(',', $category_range),
            'start_time' => time(),
            'individual_time' => implode(',', $zeros),
            'score_individual' => implode(',', $zeros),
            'attempted_ip' => $_SERVER['REMOTE_ADDR']
        );



        if ($this->session->userdata('photoname')) {
            $photoname = $this->session->userdata('photoname');
            $userdata['photo'] = $photoname;
        }
        $logged_in = $this->session->userdata('logged_in');
        if($logged_in['su']==2){
            $this->db->insert('savsoft_result', $userdata);
            $rid = $this->db->insert_id();
        }elseif($logged_in['su']==0){
            $this->db->insert('savsoft_result', $userdata);
            $rid = $this->db->insert_id();
        }

        return $rid;
    }


    function open_result($quid, $uid)
    {
        $result_open = $this->lang->line('open');
        $query = $this->db->query("select * from savsoft_result  where savsoft_result.result_status='$result_open'  and savsoft_result.uid='$uid'  ");
        if ($query->num_rows() >= '1') {
            $result = $query->row_array();
            return $result['rid'];
        } else {
            return '0';
        }


    }

    function quiz_result($rid)
    {


        $query = $this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' ");
        return $query->row_array();

    }

    function saved_answers($rid)
    {


        $query = $this->db->query("select * from savsoft_answers  where savsoft_answers.rid='$rid' ");
        return $query->result_array();

    }


    function assign_score($rid, $qno, $score)
    {
        $qp_score = $score;
        $query = $this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' ");
        $quiz = $query->row_array();
        $score_ind = explode(',', $quiz['score_individual']);
        $score_ind[$qno] = $score;
        $r_qids = explode(',', $quiz['r_qids']);
        $correct_score = $quiz['correct_score'];
        $incorrect_score = $quiz['incorrect_score'];
        $manual_valuation = 0;
        foreach ($score_ind as $mk => $score) {

            if ($score == 1) {

                $marks += $correct_score;
            }
            if ($score == 2) {

                $marks += $incorrect_score;
            }
            if ($score == 3) {

                $manual_valuation = 1;
            }

        }
        $percentage_obtained = ($marks / $quiz['noq']) * 100;
        if ($percentage_obtained >= $quiz['pass_percentage']) {
            $qr = $this->lang->line('pass');
        } else {
            $qr = $this->lang->line('fail');

        }
        $userdata = array(
            'score_individual' => implode(',', $score_ind),
            'score_obtained' => $marks,
            'percentage_obtained' => $percentage_obtained,
            'manual_valuation' => $manual_valuation
        );
        if ($manual_valuation == 1) {
            $userdata['result_status'] = $this->lang->line('pending');
        } else {
            $userdata['result_status'] = $qr;
        }
        $this->db->where('rid', $rid);
        $this->db->update('savsoft_result', $userdata);

        // question performance
        $qp = $r_qids[$qno];
        $crin = "";
        if ($$qp_score == '1') {
            $crin = ", no_time_corrected=(no_time_corrected +1)";
        } else if ($$qp_score == '2') {
            $crin = ", no_time_incorrected=(no_time_incorrected +1)";
        }
        $query_qp = "update savsoft_qbank set  $crin  where qid='$qp'  ";
        $this->db->query($query_qp);
    }


    function submit_result()
    {
        if (!$this->session->userdata('logged_in')) {
            $logged_in = $this->session->userdata('logged_in_raw');
        } else {
            $logged_in = $this->session->userdata('logged_in');
        }
        $email = $logged_in['email'];
        $rid = $this->session->userdata('rid');
        $query = $this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' ");

        $quiz = $query->row_array();
        $score_ind = explode(',', $quiz['score_individual']);
        $r_qids = explode(',', $quiz['r_qids']);
        $qids_perf = array();
        $marks = 0;
        $correct_score_new=0;
        $correct_score = $quiz['correct_score'];
        $incorrect_score = $quiz['incorrect_score'];
        $total_time = array_sum(explode(',', $quiz['individual_time']));
        $manual_valuation = 0;
        foreach ($score_ind as $mk => $score) {
            $qids_perf[$r_qids[$mk]] = $score;
            $qBankQuery = $this->db->query("select * from savsoft_qbank where savsoft_qbank.qid='$r_qids[$mk]' ");
            $question = $qBankQuery->row_array();
            $scorePerQuestion = $question['per_question_score'];

            //correct_score
            if ($score == 1) {
                //if there is value for score per question apply it
                //else it will base it's score on the quiz setting correct_score
                if($scorePerQuestion){
                    $marks += $scorePerQuestion;
                }else {
                    $marks += $correct_score;
                }
            }

            //incorrect_score
            if ($score == 2 && $question['question_type'] != 'Match the Column') {
                die();
                //if there is value for score per question apply it
                //else it will base it's score on the quiz setting incorrect_score
                if($scorePerQuestion && $incorrect_score) {
                    $marks -= $scorePerQuestion;
                }else{
                    $marks -= $incorrect_score;
                }
            }

            //Matching type scoring customized
            if ($score == 2 && $question['question_type'] === 'Match the Column') {
                $qid = $question['qid'];
                $rid = $quiz['rid'];
                //qid && rid
                $matchQuestionResult = $this->db->query("select * from savsoft_answers where savsoft_answers.rid='$rid' AND savsoft_answers.qid ='$qid'");

                $matchingTypeResult = $matchQuestionResult->result_array();
                $optionPoints = 0;
                foreach($matchingTypeResult as $fuckYeah){
                    $optionPoints += $fuckYeah['score_u'];
                }

                //if there is value for score per question apply it
                //else it will base it's score on the quiz setting incorrect_score
                if($scorePerQuestion && $incorrect_score) {
                    $marks += $scorePerQuestion * $optionPoints;
                }else{
                    $marks += $correct_score * $optionPoints;
                }


            }

            if ($score == 3) {

                $manual_valuation = 1;
            }
            $correct_score_new += $scorePerQuestion ? $scorePerQuestion : $correct_score ;

        }
//        echo 'marks:'.$marks.'<br>';
//        echo 'noq:'.$quiz['noq'].'<br>';
//        echo 'correct possible score:'.$correct_score_new.'<br>';
//        echo '100';
//        die();
        $percentage_obtained = ($marks / $correct_score_new) * 100;
        if ($percentage_obtained >= $quiz['pass_percentage']) {
            $qr = $this->lang->line('pass');
        } else {
            $qr = $this->lang->line('fail');

        }
        $userdata = array(
            'total_time' => $total_time,
            'end_time' => time(),
            'score_obtained' => $marks,
            'percentage_obtained' => $percentage_obtained,
            'manual_valuation' => $manual_valuation
        );
        if ($manual_valuation == 1) {
            $userdata['result_status'] = $this->lang->line('pending');
        } else {
            $userdata['result_status'] = $qr;
        }
        $this->db->where('rid', $rid);
        $this->db->update('savsoft_result', $userdata);


        foreach ($qids_perf as $qp => $qpval) {
            $crin = "";
            if ($qpval == '0') {
                $crin = ", no_time_unattempted=(no_time_unattempted +1) ";
            } else if ($qpval == '1') {
                $crin = ", no_time_corrected=(no_time_corrected +1)";
            } else if ($qpval == '2') {
                $crin = ", no_time_incorrected=(no_time_incorrected +1)";
            }
            $query_qp = "update savsoft_qbank set no_time_served=(no_time_served +1)  $crin  where qid='$qp'  ";
            $this->db->query($query_qp);

        }

        if ($this->config->item('allow_result_email')) {
            $this->load->library('email');
            $query = $this->db->query("select savsoft_result.*,savsoft_users.*,savsoft_quiz.* from savsoft_result, savsoft_users, savsoft_quiz where savsoft_users.uid=savsoft_result.uid and savsoft_quiz.quid=savsoft_result.quid and savsoft_result.rid='$rid'");
            $qrr = $query->row_array();
            if ($this->config->item('protocol') == "smtp") {
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = $this->config->item('smtp_hostname');
                $config['smtp_user'] = $this->config->item('smtp_username');
                $config['smtp_pass'] = $this->config->item('smtp_password');
                $config['smtp_port'] = $this->config->item('smtp_port');
                $config['smtp_timeout'] = $this->config->item('smtp_timeout');
                $config['mailtype'] = $this->config->item('smtp_mailtype');
                $config['starttls'] = $this->config->item('starttls');
                $config['newline'] = $this->config->item('newline');

                $this->email->initialize($config);
            }
            $toemail = $qrr['email'];
            $fromemail = $this->config->item('fromemail');
            $fromname = $this->config->item('fromname');
            $subject = $this->config->item('result_subject');
            $message = $this->config->item('result_message');

            $subject = str_replace('[email]', $qrr['email'], $subject);
            $subject = str_replace('[first_name]', $qrr['first_name'], $subject);
            $subject = str_replace('[last_name]', $qrr['last_name'], $subject);
            $subject = str_replace('[quiz_name]', $qrr['quiz_name'], $subject);
            $subject = str_replace('[score_obtained]', $qrr['score_obtained'], $subject);
            $subject = str_replace('[percentage_obtained]', $qrr['percentage_obtained'], $subject);
            $subject = str_replace('[current_date]', date('Y-m-d H:i:s', time()), $subject);
            $subject = str_replace('[result_status]', $qrr['result_status'], $subject);

            $message = str_replace('[email]', $qrr['email'], $message);
            $message = str_replace('[first_name]', $qrr['first_name'], $message);
            $message = str_replace('[last_name]', $qrr['last_name'], $message);
            $message = str_replace('[quiz_name]', $qrr['quiz_name'], $message);
            $message = str_replace('[score_obtained]', $qrr['score_obtained'], $message);
            $message = str_replace('[percentage_obtained]', $qrr['percentage_obtained'], $message);
            $message = str_replace('[current_date]', date('Y-m-d H:i:s', time()), $message);
            $message = str_replace('[result_status]', $qrr['result_status'], $message);


            $this->email->to($toemail);
            $this->email->from($fromemail, $fromname);
            $this->email->subject($subject);
            $this->email->message($message);
            if (!$this->email->send()) {
                //print_r($this->email->print_debugger());

            }
        }


        return true;
    }


    function insert_answer()
    {
        $rid = $_POST['rid'];
        $srid = $this->session->userdata('rid');
        if (!$this->session->userdata('logged_in')) {
            $logged_in = $this->session->userdata('logged_in_raw');
        } else {
            $logged_in = $this->session->userdata('logged_in');
        }
        $uid = $logged_in['uid'];
        if ($srid != $rid) {

            return "Something wrong";
        }
        $query = $this->db->query("select * from savsoft_result join savsoft_quiz on savsoft_result.quid=savsoft_quiz.quid where savsoft_result.rid='$rid' ");
        $quiz = $query->row_array();
        $correct_score = $quiz['correct_score'];
        $incorrect_score = $quiz['incorrect_score'];
        $qids = explode(',', $quiz['r_qids']);
        $vqids = $quiz['r_qids'];
        $correct_incorrect = explode(',', $quiz['score_individual']);


        // remove existing answers
        $this->db->where('rid', $rid);
        $this->db->delete('savsoft_answers');

        foreach ($_POST['answer'] as $ak => $answer) {

            // multiple choice single answer
            if ($_POST['question_type'][$ak] == '1' || $_POST['question_type'][$ak] == '2') {

                $qid = $qids[$ak];
                $query = $this->db->query(" select * from savsoft_options where qid='$qid' ");
                $options_data = $query->result_array();
                $options = array();
                foreach ($options_data as $ok => $option) {
                    $options[$option['oid']] = $option['score'];
                }
                $attempted = 0;
                $marks = 0;
                foreach ($answer as $sk => $ansval) {
                    if ($options[$ansval] <= 0) {
                        $marks += -1;
                    } else {
                        $marks += $options[$ansval];
                    }
                    $userdata = array(
                        'rid' => $rid,
                        'qid' => $qid,
                        'uid' => $uid,
                        'q_option' => $ansval,
                        'score_u' => $options[$ansval]
                    );
                    $this->db->insert('savsoft_answers', $userdata);
                    $attempted = 1;
                }
                if ($attempted == 1) {
                    if ($marks >= '0.99') {
                        $correct_incorrect[$ak] = 1;
                    } else {
                        $correct_incorrect[$ak] = 2;
                    }
                } else {
                    $correct_incorrect[$ak] = 0;
                }
            }
            // short answer
            if ($_POST['question_type'][$ak] == '3') {

                $qid = $qids[$ak];
                $query = $this->db->query(" select * from savsoft_options where qid='$qid' ");
                $options_data = $query->row_array();
                $options_data = explode(',', $options_data['q_option']);
                $noptions = array();
                foreach ($options_data as $op) {
                    $noptions[] = strtoupper(trim($op));
                }

                $attempted = 0;
                $marks = 0;
                foreach ($answer as $sk => $ansval) {
                    if ($ansval != '') {
                        if (in_array(strtoupper(trim($ansval)), $noptions)) {
                            $marks = 1;
                        } else {
                            $marks = 0;
                        }

                        $attempted = 1;

                        $userdata = array(
                            'rid' => $rid,
                            'qid' => $qid,
                            'uid' => $uid,
                            'q_option' => $ansval,
                            'score_u' => $marks
                        );
                        $this->db->insert('savsoft_answers', $userdata);

                    }
                }
                if ($attempted == 1) {
                    if ($marks == 1) {
                        $correct_incorrect[$ak] = 1;
                    } else {
                        $correct_incorrect[$ak] = 2;
                    }
                } else {
                    $correct_incorrect[$ak] = 0;
                }
            }

            // long answer
            if ($_POST['question_type'][$ak] == '4') {
                $attempted = 0;
                $marks = 0;
                $qid = $qids[$ak];
                foreach ($answer as $sk => $ansval) {
                    if ($ansval != '') {
                        $userdata = array(
                            'rid' => $rid,
                            'qid' => $qid,
                            'uid' => $uid,
                            'q_option' => $ansval,
                            'score_u' => 0
                        );
                        $this->db->insert('savsoft_answers', $userdata);
                        $attempted = 1;
                    }
                }
                if ($attempted == 1) {

                    $correct_incorrect[$ak] = 3;

                } else {
                    $correct_incorrect[$ak] = 0;
                }
            }

            // match
            if ($_POST['question_type'][$ak] == '5') {
                $qid = $qids[$ak];
                $query = $this->db->query(" select * from savsoft_options where qid='$qid' ");
                $options_data = $query->result_array();
                $noptions = array();
                foreach ($options_data as $op => $option) {
                    $noptions[] = $option['q_option'] . '___' . $option['q_option_match'];
                }
                $marks = 0;
                $attempted = 0;
                foreach ($answer as $sk => $ansval) {
                    if ($ansval != '0') {
                        $mc = 0;
                        if (in_array($ansval, $noptions)) {
                            $marks += 1 / count($options_data);
                            $mc = 1 / count($options_data);
                        } else {
                            $marks += 0;
                            $mc = 0;
                        }
                        $userdata = array(
                            'rid' => $rid,
                            'qid' => $qid,
                            'uid' => $uid,
                            'q_option' => $ansval,
                            'score_u' => $mc
                        );
                        $this->db->insert('savsoft_answers', $userdata);
                        $attempted = 1;
                    }
                }
                if ($attempted == 1) {
                    if ($marks == 1) {
                        $correct_incorrect[$ak] = 1;
                    } else {
                        $correct_incorrect[$ak] = 2;
                    }
                } else {
                    $correct_incorrect[$ak] = 0;
                }
            }


        }

        $userdata = array(
            'score_individual' => implode(',', $correct_incorrect),
            'individual_time' => $_POST['individual_time'],

        );
        $this->db->where('rid', $rid);
        $this->db->update('savsoft_result', $userdata);

        return true;

    }


    function set_ind_time()
    {
        $rid = $this->session->userdata('rid');

        $userdata = array(
            'individual_time' => $_POST['individual_time'],

        );
        $this->db->where('rid', $rid);
        $this->db->update('savsoft_result', $userdata);

        return true;
    }

    //custom
    function assessment_insert_quiz($variable)
    {
        $logged_in = $this->session->userdata('logged_in');
        $uid = $logged_in['uid'];

        $userdata = array(
            'quiz_name' => $variable['quiz_name'],
            'cid' => $variable['cid'],
            'uid' => $uid
        );

        $this->db->insert('savsoft_quiz', $userdata);
        $quid = $this->db->insert_id();
        return $quid;

    }

    function assessment_update_quiz($quid,$settings)
    {
        $userdata = array(
            'quiz_name' => "",
            'description' => "",
            'start_date' => $settings->start_date,
            'end_date' => $settings->end_date,
            'duration' => $settings->duration,
            'maximum_attempts' => $settings->maximum_attempts,
            'pass_percentage' => $settings->pass_percentage,
            'correct_score' => "",
            'incorrect_score' => "",
            'ip_address' => "",
            'view_answer' => $settings->view_answer,
            'camera_req' => "",
            'with_login' => "",
            'gids' => ""
        );


        $this->db->where('quid', $quid);
        $this->db->update('savsoft_quiz', $userdata);

        $this->db->where('quid', $quid);
        $query = $this->db->get('savsoft_quiz', $userdata);
        $quiz = $query->row_array();
//        if ($quiz['question_selection'] == '1') {
//
//            $this->db->where('quid', $quid);
//            $this->db->delete('savsoft_qcl');
//
//            foreach ($_POST['cid'] as $ck => $val) {
//                if (isset($_POST['noq'][$ck])) {
//                    if ($_POST['noq'][$ck] >= '1') {
//                        $userdata = array(
//                            'quid' => $quid,
//                            'cid' => $val,
//                            'lid' => $_POST['lid'][$ck],
//                            'noq' => $_POST['noq'][$ck]
//                        );
//                        $this->db->insert('savsoft_qcl', $userdata);
//                    }
//                }
//            }
//            $userdata = array(
//                'noq' => array_sum($_POST['noq'])
//            );
//            $this->db->where('quid', $quid);
//            $this->db->update('savsoft_quiz', $userdata);
//        }
        return $quid;

    }

}

?>