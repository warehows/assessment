<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qbank extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("qbank_model");
        $this->load->model("lessons_model");
        $this->load->model("quiz_model");
        $this->lang->load('basic', $this->config->item('language'));
        // redirect if not loggedin
        if(!$this->session->userdata('logged_in')){
            redirect('login');

        }
        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['base_url'] != base_url()){
            $this->session->unset_userdata('logged_in');
            redirect('login');
        }
    }

    public function index($limit='0',$cid='0',$lid='0')
    {
        $this->load->helper('form');
        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }

        $data['category_list']=$this->qbank_model->category_list();
        $data['level_list']=$this->qbank_model->level_list();

        $data['limit']=$limit;
        $data['cid']=$cid;
        $data['lid']=$lid;


        $data['title']=$this->lang->line('qbank');
        // fetching user list
        $data['result']=$this->qbank_model->question_list($limit,$cid,$lid);
        /*		$this->load->view('header',$data);
                $this->load->view('question_list',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('question_list',$data);
        $this->load->view('material_part/footer_material',$data);
    }

    public function remove_question($qid,$quid){

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }

        if($this->qbank_model->remove_question($qid)){
            $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
        }else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

        }

        redirect(site_url("quiz/add_question/")."/".$quid);


    }



    function pre_question_list($limit='0',$cid='0',$lid='0'){
        $cid=$this->input->post('cid');
        $lid=$this->input->post('lid');
        redirect('qbank/index/'.$limit.'/'.$cid.'/'.$lid);
    }


    public function pre_new_question()
    {



        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }

        if($this->input->post('question_type')){
            if($this->input->post('question_type')=='1'){
                $nop=$this->input->post('nop');
                $back_url=$this->input->post('back_url');
                if(!is_numeric($this->input->post('nop'))){
                    $nop=4;
                }
                redirect('qbank/new_question_1/'.$nop."?back_url=".$back_url);
            }
            if($this->input->post('question_type')=='2'){
                $nop=$this->input->post('nop');
                $back_url=$this->input->post('back_url');
                if(!is_numeric($this->input->post('nop'))){
                    $nop=4;
                }
                redirect('qbank/new_question_2/'.$nop."?back_url=".$back_url);
            }
            if($this->input->post('question_type')=='3'){
                $nop=$this->input->post('nop');
                $back_url=$this->input->post('back_url');
                if(!is_numeric($this->input->post('nop'))){
                    $nop=4;
                }
                redirect('qbank/new_question_3/'.$nop."?back_url=".$back_url);
            }
            if($this->input->post('question_type')=='4'){
                $nop=$this->input->post('nop');
                $back_url=$this->input->post('back_url');
                if(!is_numeric($this->input->post('nop'))){
                    $nop=4;
                }
                redirect('qbank/new_question_4/'.$nop."?back_url=".$back_url);
            }
            if($this->input->post('question_type')=='5'){
                $nop=$this->input->post('nop');
                $back_url=$this->input->post('back_url');
                if(!is_numeric($this->input->post('nop'))){
                    $nop=4;
                }
                redirect('qbank/new_question_5/'.$nop."?back_url=".$back_url);
            }
            if($this->input->post('question_type')=='8'){
                $nop=2;
                $back_url=$this->input->post('back_url');
                redirect('qbank/new_question_2_bool/'."?back_url=".$back_url);
            }

        }

        $data['title']=$this->lang->line('add_new').' '.$this->lang->line('question');
        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('pre_new_question',$data);
        $this->load->view('material_part/footer_material',$data);
    }

    public function check_if_for_option($function_value){
        $post = $_REQUEST;
        $post["function_value"] = $function_value;
        if(@$post['for_option']){
            $parameters = http_build_query($post) . "\n";
            redirect(site_url('qbank/option_renderer')."?".$parameters);
        }

    }

    public function option_renderer(){
        $post = $_REQUEST;
        $function_value = $post["function_value"];
        if($post['for_option']){
            $total_options = count($post['option']);
            $option_value = $post['for_option'];
            $option = $post['option'];
            $site_url = site_url();
            $question = $post['question'];

            if($post["option_action"]=="add_option"){
                array_splice($option,$option_value,0,'');
                $total_option = $total_options+1;
                $question_back_url = $site_url."/qbank/".$function_value."/".$total_option;
                $data = array(
                    "back_url"=>$post['back_url'],
                    "option_value"=>$option_value,
                    "option"=>$option,
                    "question"=>$question,
                    "question_back_url"=>$question_back_url,
                );

            }else{

//                array_splice($option,$option_value,0,'');
                $total_option = $total_options-1;

                $question_back_url = $site_url."/qbank/".$function_value."/".$total_option;
                unset($option[$option_value-1]);

                $data = array(
                    "back_url"=>$post['back_url'],
                    "option_value"=>$option_value,
                    "option"=>$option,
                    "question"=>$question,
                    "question_back_url"=>$question_back_url,
                );

            }

            $this->load->view('questions/add_option',$data);

        }

    }

    public function new_question_1($nop='4')
    {

        $logged_in=$this->session->userdata('logged_in');

        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        $function_value = __FUNCTION__ ;
        $this->check_if_for_option($function_value);
        if($this->input->post('question')){

            $back_url = $this->input->get('back_url');
            if($this->qbank_model->insert_question_1()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
            }
            redirect($back_url);
        }

        $data['nop']=$nop;
        $data['title']=$this->lang->line('add_new');
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        /*		 $this->load->view('header',$data);
                $this->load->view('new_question_1',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('new_question_1',$data);
        $this->load->view('new_material/footer',$data);
    }


    public function new_question_2($nop='4')
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            $back_url = $this->input->get('back_url');
            if($this->qbank_model->insert_question_2()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
            }
            redirect($back_url);
        }

        $data['nop']=$nop;
        $data['title']=$this->lang->line('add_new');
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        /*	 $this->load->view('header',$data);
            $this->load->view('new_question_2',$data);
            $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('new_question_2',$data);
        $this->load->view('new_material/footer',$data);
    }

    //true or false
    public function new_question_2_bool($nop='2')
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            $back_url = $this->input->get('back_url');
            if($this->qbank_model->insert_question_2_bool()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
            }
            redirect($back_url);
        }

        $data['nop']=$nop;
        $data['title']=$this->lang->line('add_new');
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        /*	 $this->load->view('header',$data);
            $this->load->view('new_question_2',$data);
            $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('new_question_2_bool',$data);
        $this->load->view('new_material/footer',$data);
    }


    public function new_question_3($nop='4')
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            $back_url = $this->input->get('back_url');
            if($this->qbank_model->insert_question_3()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
            }
            redirect($back_url);
        }

        $data['nop']=$nop;
        $data['title']=$this->lang->line('add_new');
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        /*	 $this->load->view('header',$data);
            $this->load->view('new_question_3',$data);
            $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('new_question_3',$data);
        $this->load->view('new_material/footer',$data);
    }


    public function new_question_4($nop='4')
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            $back_url = $this->input->get('back_url');
            if($this->qbank_model->insert_question_4()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
            }
            redirect($back_url);
        }

        $data['nop']=$nop;
        $data['title']=$this->lang->line('add_new');
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        /*		 $this->load->view('header',$data);
                $this->load->view('new_question_4',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('new_question_4',$data);
        $this->load->view('new_material/footer',$data);
    }


    public function new_question_5($nop='4')
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            $back_url = $this->input->get('back_url');
            if($this->qbank_model->insert_question_5()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
            }
            redirect($back_url);
        }

        $data['nop']=$nop;
        $data['title']=$this->lang->line('add_new');
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        /*		 $this->load->view('header',$data);
                $this->load->view('new_question_5',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('new_question_5',$data);
        $this->load->view('new_material/footer',$data);
    }







    public function edit_question_1($qid,$quid)
    {


        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            if($this->qbank_model->update_question_1($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
            }
            redirect('qbank/edit_question_1/'.$qid."/".$quid);
        }


        $data['title']=$this->lang->line('edit');
        // fetching question
        $data['question']=$this->qbank_model->get_question($qid);
        $data['options']=$this->qbank_model->get_option($qid);
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        $data['quid'] = $quid;
        /*		 $this->load->view('header',$data);
                $this->load->view('edit_question_1',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){
            if ($logged_in['su']== 1){
                $this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('edit_question_1',$data);
        $this->load->view('new_material/footer',$data);

    }


    public function edit_question_2($qid,$quid)
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            if($this->qbank_model->update_question_2($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
            }
            redirect('qbank/edit_question_2/'.$qid."/".$quid);
        }


        $data['title']=$this->lang->line('edit');
        // fetching question
        $data['question']=$this->qbank_model->get_question($qid);
        $data['options']=$this->qbank_model->get_option($qid);
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        $data['quid'] = $quid;
        /*		 $this->load->view('header',$data);
                $this->load->view('edit_question_2',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('edit_question_2',$data);
        $this->load->view('new_material/footer',$data);
    }

    public function edit_question_2_bool($qid,$quid)
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            if($this->qbank_model->update_question_2($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
            }
            redirect('qbank/edit_question_2_bool/'.$qid."/".$quid);
        }


        $data['title']=$this->lang->line('edit');
        // fetching question
        $data['question']=$this->qbank_model->get_question($qid);
        $data['options']=$this->qbank_model->get_option($qid);
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        $data['quid'] = $quid;
        /*		 $this->load->view('header',$data);
                $this->load->view('edit_question_2',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('edit_question_2_bool',$data);
        $this->load->view('new_material/footer',$data);
    }


    public function edit_question_3($qid,$quid)
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            if($this->qbank_model->update_question_3($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
            }
            redirect('qbank/edit_question_3/'.$qid."/".$quid);
        }


        $data['title']=$this->lang->line('edit');
        // fetching question
        $data['question']=$this->qbank_model->get_question($qid);
        $data['options']=$this->qbank_model->get_option($qid);
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        $data['quid'] = $quid;
        /*		 $this->load->view('header',$data);
                $this->load->view('edit_question_3',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('edit_question_3',$data);
        $this->load->view('new_material/footer',$data);
    }


    public function edit_question_4($qid,$quid)
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            if($this->qbank_model->update_question_4($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
            }
            redirect('qbank/edit_question_4/'.$qid."/".$quid);
        }


        $data['title']=$this->lang->line('edit');
        // fetching question
        $data['question']=$this->qbank_model->get_question($qid);
        $data['options']=$this->qbank_model->get_option($qid);
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        $data['quid'] = $quid;
        /*		 $this->load->view('header',$data);
                $this->load->view('edit_question_4',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('edit_question_4',$data);
        $this->load->view('new_material/footer',$data);
    }


    public function edit_question_5($qid,$quid)
    {

        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']<'1'){
            exit($this->lang->line('permission_denied'));
        }
        if($this->input->post('question')){
            if($this->qbank_model->update_question_5($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
            }else{
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
            }
            redirect('qbank/edit_question_5/'.$qid."/".$quid);
        }


        $data['title']=$this->lang->line('edit');
        // fetching question
        $data['question']=$this->qbank_model->get_question($qid);
        $data['options']=$this->qbank_model->get_option($qid);
        // fetching category list
        $data['category_list']=$this->qbank_model->category_list();
        // fetching level list
        $data['level_list']=$this->qbank_model->level_list();
        $data['quid'] = $quid;
        /*		 $this->load->view('header',$data);
                $this->load->view('edit_question_5',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('edit_question_5',$data);
        $this->load->view('new_material/footer',$data);
    }


    // category functions start
    public function category_list(){
        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }

        // fetching group list
        $data['category_list']=$this->qbank_model->category_list();
        $data['title']=$this->lang->line('category_list');
        /*		$this->load->view('header',$data);
                $this->load->view('category_list',$data);
                $this->load->view('material_part/footer_material',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('category_list',$data);
        $this->load->view('material_part/footer_material',$data);




    }


    public function insert_category()
    {


        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }

        if($this->qbank_model->insert_category()){
            $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
        }else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

        }
        redirect('qbank/category_list/');

    }

    public function update_category($cid)
    {


        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }

        if($this->qbank_model->update_category($cid)){
            echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
        }else{
            echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";

        }


    }




    public function remove_category($cid){

        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }

        if($this->qbank_model->remove_category($cid)){
            $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
        }else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

        }
        redirect('qbank/category_list');


    }
    // category functions end



















    // level functions start
    public function level_list(){

        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }
        // fetching group list
        $data['level_list']=$this->qbank_model->level_list();
        $data['title']=$this->lang->line('level_list');
        /*		$this->load->view('header',$data);
                $this->load->view('level_list',$data);
                $this->load->view('material_part/footer_material.php',$data);*/

        if ($logged_in['su']== 1){if ($logged_in['su']== 1){$this->load->view('new_material/header', $data);}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}}elseif($logged_in['su']== 2){$this->load->view('new_material/teacher_header', $data);        }else{$this->load->view('new_material/student_header', $data);}
        $this->load->view('level_list',$data);
        $this->load->view('material_part/footer_material',$data);




    }


    public function insert_level()
    {

        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }

        if($this->qbank_model->insert_level()){
            $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
        }else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

        }
        redirect('qbank/level_list/');

    }

    public function update_level($lid)
    {


        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }

        if($this->qbank_model->update_level($lid)){
            echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
        }else{
            echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";

        }


    }




    public function remove_level($lid){

        $logged_in=$this->session->userdata('logged_in');
        if ($logged_in['su'] != '1') {
            redirect('/');
        }

        if($this->qbank_model->remove_level($lid)){
            $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
        }else{
            $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

        }
        redirect('qbank/level_list');


    }
    // level functions end











    function import()
    {
        $logged_in=$this->session->userdata('logged_in');
        if($logged_in['su']!="1"){
            exit('Permission denied');
            return;
        }

        $this->load->helper('xlsimport/php-excel-reader/excel_reader2');
        $this->load->helper('xlsimport/spreadsheetreader.php');



        if(isset($_FILES['xlsfile'])){
            $targets = 'xls/';
            $targets = $targets . basename( $_FILES['xlsfile']['name']);
            $docadd=($_FILES['xlsfile']['name']);
            if(move_uploaded_file($_FILES['xlsfile']['tmp_name'], $targets)){
                $Filepath = $targets;
                $allxlsdata = array();
                date_default_timezone_set('UTC');

                $StartMem = memory_get_usage();
                //echo '---------------------------------'.PHP_EOL;
                //echo 'Starting memory: '.$StartMem.PHP_EOL;
                //echo '---------------------------------'.PHP_EOL;

                try
                {
                    $Spreadsheet = new SpreadsheetReader($Filepath);
                    $BaseMem = memory_get_usage();

                    $Sheets = $Spreadsheet -> Sheets();

                    //echo '---------------------------------'.PHP_EOL;
                    //echo 'Spreadsheets:'.PHP_EOL;
                    //print_r($Sheets);
                    //echo '---------------------------------'.PHP_EOL;
                    //echo '---------------------------------'.PHP_EOL;

                    foreach ($Sheets as $Index => $Name)
                    {
                        //echo '---------------------------------'.PHP_EOL;
                        //echo '*** Sheet '.$Name.' ***'.PHP_EOL;
                        //echo '---------------------------------'.PHP_EOL;

                        $Time = microtime(true);

                        $Spreadsheet -> ChangeSheet($Index);

                        foreach ($Spreadsheet as $Key => $Row)
                        {
                            //echo $Key.': ';
                            if ($Row)
                            {
                                //print_r($Row);
                                $allxlsdata[] = $Row;
                            }
                            else
                            {
                                var_dump($Row);
                            }
                            $CurrentMem = memory_get_usage();

                            //echo 'Memory: '.($CurrentMem - $BaseMem).' current, '.$CurrentMem.' base'.PHP_EOL;
                            //echo '---------------------------------'.PHP_EOL;

                            if ($Key && ($Key % 500 == 0))
                            {
                                //echo '---------------------------------'.PHP_EOL;
                                //echo 'Time: '.(microtime(true) - $Time);
                                //echo '---------------------------------'.PHP_EOL;
                            }
                        }

                        //	echo PHP_EOL.'---------------------------------'.PHP_EOL;
                        //echo 'Time: '.(microtime(true) - $Time);
                        //echo PHP_EOL;

                        //echo '---------------------------------'.PHP_EOL;
                        //echo '*** End of sheet '.$Name.' ***'.PHP_EOL;
                        //echo '---------------------------------'.PHP_EOL;
                    }

                }
                catch (Exception $E)
                {
                    echo $E -> getMessage();
                }


                $this->qbank_model->import_question($allxlsdata);

            }

        }

        else{
            echo "Error: " . $_FILES["file"]["error"];
        }
        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_imported_successfully')." </div>");
        redirect('qbank');
    }












}
