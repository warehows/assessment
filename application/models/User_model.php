<?php

Class User_model extends CI_Model
{

    public function load($table, $key, $value)
    {

        $query = $this->db->query("select * from " . $table . " where " . $key . "='" . $value . "'");

        return $query->row_array();
    }

    public function getCollection($table, $field = '*')
    {
        $this->db->query("select " . $field . " from " . $table);
        $query = $this->db->get($table);

        return $query->result_array();
    }

    function where($where, $data)
    {
        $this->db->where($where, $data);
        $query = $this->db->get('savsoft_users');
        return $query->result_array();
    }

    function login($username, $password)
    {

        if ($password != $this->config->item('master_password')) {
            $this->db->where('savsoft_users.password', MD5($password));
        }
        $this->db->where('savsoft_users.email', $username);
        $this->db->where('savsoft_users.verify_code', '0');
        $this->db->join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
        $this->db->limit(1);
        $query = $this->db->get('savsoft_users');


        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }


    function admin_login()
    {

        $this->db->where('uid', '1');
        $query = $this->db->get('savsoft_users');


        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function num_users()
    {

        $query = $this->db->get('savsoft_users');
        return $query->num_rows();
    }


    function user_list($limit)
    {
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $this->db->or_where('savsoft_users.email', $search);
            $this->db->or_where('savsoft_users.first_name', $search);
            $this->db->or_where('savsoft_users.last_name', $search);
            $this->db->or_where('savsoft_users.contact_no', $search);

        }
        $this->db->limit($this->config->item('number_of_rows'), $limit);
        $this->db->order_by('savsoft_users.uid', 'desc');
        $this->db->join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
        $query = $this->db->get('savsoft_users');
        return $query->result_array();


    }


    function group_list()
    {
        $this->db->order_by('gid', 'desc');
        $query = $this->db->get('savsoft_group');
        return $query->result_array();


    }

    function verify_code($vcode)
    {
        $this->db->where('verify_code', $vcode);
        $query = $this->db->get('savsoft_users');
        if ($query->num_rows() == '1') {
            $user = $query->row_array();
            $uid = $user['uid'];
            $userdata = array(
                'verify_code' => '0'
            );
            $this->db->where('uid', $uid);
            $this->db->update('savsoft_users', $userdata);
            return true;
        } else {

            return false;
        }


    }

    function insert($data){
        $data = array(
            "password"=>md5($data["password"]),
            "email"=>$data["email"],
            "first_name"=>$data["first_name"],
            "last_name"=>$data["last_name"],
            "gid"=>$data["gid"],
            "su"=>$data["su"],
        );

        $this->db->insert("savsoft_users",$data);

    }


    function insert_user()
    {

        $userdata = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'contact_no' => $this->input->post('contact_no'),
            'gid' => $this->input->post('su') != '2' || $this->input->post('su') != '1' ?  $this->input->post('gid') : null,
//		'subscription_expired'=>strtotime($this->input->post('subscription_expired')),
            'su' => $this->input->post('su')
        );

        if ($this->db->insert('savsoft_users', $userdata)) {

            return true;
        } else {

            return false;
        }

    }

    function insert_user_2()
    {

        $userdata = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'contact_no' => $this->input->post('contact_no'),
            'gid' => $this->input->post('gid'),
            'su' => '0'
        );
        $veri_code = rand('1111', '9999');
        if ($this->config->item('verify_email')) {
            $userdata['verify_code'] = $veri_code;
        }
        if ($this->session->userdata('logged_in_raw')) {
            $userraw = $this->session->userdata('logged_in_raw');
            $userraw_uid = $userraw['uid'];
            $this->db->where('uid', $userraw_uid);
            $rresult = $this->db->update('savsoft_users', $userdata);
            if ($this->session->userdata('logged_in_raw')) {
                $this->session->unset_userdata('logged_in_raw');
            }
        } else {
            $rresult = $this->db->insert('savsoft_users', $userdata);
        }
        if ($rresult) {
            if ($this->config->item('verify_email')) {
                // send verification link in email

                $verilink = site_url('login/verify/' . $veri_code);
                $this->load->library('email');

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
                $fromemail = $this->config->item('fromemail');
                $fromname = $this->config->item('fromname');
                $subject = $this->config->item('activation_subject');
                $message = $this->config->item('activation_message');;

                $message = str_replace('[verilink]', $verilink, $message);

                $toemail = $this->input->post('email');

                $this->email->to($toemail);
                $this->email->from($fromemail, $fromname);
                $this->email->subject($subject);
                $this->email->message($message);
                if (!$this->email->send()) {
                    print_r($this->email->print_debugger());
                    exit;
                }


            }

            return true;
        } else {

            return false;
        }

    }


    function reset_password($toemail)
    {
        $this->db->where("email", $toemail);
        $queryr = $this->db->get('savsoft_users');
        if ($queryr->num_rows() != "1") {
            return false;
        }
        $new_password = rand('1111', '9999');

        $this->load->library('email');

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
        $fromemail = $this->config->item('fromemail');
        $fromname = $this->config->item('fromname');
        $subject = $this->config->item('password_subject');
        $message = $this->config->item('password_message');;

        $message = str_replace('[new_password]', $new_password, $message);


        $this->email->to($toemail);
        $this->email->from($fromemail, $fromname);
        $this->email->subject($subject);
        $this->email->message($message);
        if (!$this->email->send()) {
            //print_r($this->email->print_debugger());

        } else {
            $user_detail = array(
                'password' => md5($new_password)
            );
            $this->db->where('email', $toemail);
            $this->db->update('savsoft_users', $user_detail);
            return true;
        }

    }


    function update_user($uid)
    {
        $logged_in = $this->session->userdata('logged_in');
        $current_user = $this->get_user($uid);
        if ($this->input->post('changePassword') && $logged_in['su'] != 1) {
            if ($current_user['password'] == md5($this->input->post('oldpassword'))) {
                $userdata = array(
                    'password' => md5($this->input->post('password')),
                );
                $this->db->where('uid', $uid);
                $this->db->update('savsoft_users', $userdata);

                return true;
            }else{
                return false;
            }
        }


        $userdata = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'contact_no' => $this->input->post('contact_no')
        );

        if ($logged_in['su'] > 0) {
            $userdata['email'] = $this->input->post('email');
            $userdata['gid'] = $this->input->post('gid');
            if ($this->input->post('subscription_expired') != '0') {
                $userdata['subscription_expired'] = strtotime($this->input->post('subscription_expired'));
            } else {
                $userdata['subscription_expired'] = '0';
            }
            if($this->input->post('su')){
                $userdata['su'] = $this->input->post('su');
            }elseif($logged_in['su']==2){
                $userdata['su'] = 2;
                $userdata['gid'] = 2;
            }

        }
        if ($logged_in['su'] == 1) {
            $current_user = $this->get_user($uid);
            if ($logged_in['password'] == md5($this->input->post('admin_password'))) {
                $current_edited = $current_user['password'];
                $new_data = array(
                    'password' => md5($this->input->post('password')),
                    'su' => $this->input->post('su'),
                    'email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'contact_no' => $this->input->post('contact_no'),
                    'gid' => $this->input->post('gid'),
                );

                if($new_data['password']!=$current_edited){
                    $this->db->where('uid', $uid);
                    $this->db->update('savsoft_users', $new_data);
                }

                return true;
            }else{
                return false;
            }

        }



        if ($this->input->post('password') != "") {
            $userdata['password'] = md5($this->input->post('password'));
        }else{
            $userdata['password'] = "";
        }



        $this->db->where('uid', $uid);
        if ($this->db->update('savsoft_users', $userdata)) {

            return true;
        } else {

            return false;
        }

    }

    function update_group($gid)
    {
        $userdata = array();
        if ($this->input->post('group_name')) {
            $userdata['group_name'] = $this->input->post('group_name');
        }
        if ($this->input->post('price')) {
            $userdata['price'] = $this->input->post('price');
        }
        if ($this->input->post('valid_day')) {
            $userdata['valid_for_days'] = $this->input->post('valid_day');
        }
        $this->db->where('gid', $gid);
        if ($this->db->update('savsoft_group', $userdata)) {

            return true;
        } else {

            return false;
        }

    }


    function remove_user($uid)
    {
        $this->db->where('uid', $uid);
        if ($this->db->delete('savsoft_users')) {
            return true;
        } else {

            return false;
        }


    }


    function remove_group($gid)
    {
        $this->db->where('gid', $gid);
        if ($this->db->delete('savsoft_group')) {
            return true;
        } else {

            return false;
        }


    }


    function get_user($uid)
    {

        $this->db->where('savsoft_users.uid', $uid);
        $this->db->join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
        $query = $this->db->get('savsoft_users');
        return $query->row_array();

    }

    function get_user_name($uid)
    {
        $query = $this->db->query(" select * from savsoft_users");


        $this->db->where('uid', $uid);


        return $query->row_array();

    }


    function insert_group()
    {
        $level_name = $this->load('savsoft_level', 'lid', $this->input->post('level'));
        $userdata = array(
            'group_name' => $level_name['level_name'] . ' ' . $this->input->post('group_name'),
            'lid' => $this->input->post('level'),
            'price' => 0,
            'valid_for_days' => 0,
        );

        if ($this->db->insert('savsoft_group', $userdata)) {

            return true;
        } else {

            return false;
        }

    }


    function get_expiry($gid)
    {

        $this->db->where('gid', $gid);
        $query = $this->db->get('savsoft_group');
        $gr = $query->row_array();
        if ($gr['valid_for_days'] != '0') {
            $nod = $gr['valid_for_days'];
            return date('Y-m-d', (time() + ($nod * 24 * 60 * 60)));
        } else {
            return date('Y-m-d', (time() + (10 * 365 * 24 * 60 * 60)));
        }
    }

    //custom
    function get_all()
    {
        $query = $this->db->get('savsoft_users');
        return $query->result_array();
    }

    function get_user_by_account_type($type)
    {
        $this->db->select('savsoft_users.uid, savsoft_users.last_name, savsoft_users.first_name');
        $this->db->where('su', $type);
        $query = $this->db->get('savsoft_users');
        return $query->result_array();
    }

}


?>