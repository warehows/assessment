<link href="<?php echo base_url("css/new_material/cdn/jquery-confirm.min.css") ?>" rel="stylesheet">
<div class="container">


    <h3><?php echo $title; ?></h3>
    <?php $logged_in = $this->session->userdata('logged_in'); ?>
    <?php if ($logged_in['uid'] == 1) { ?>
        <a href="<?php echo site_url('assign'); ?>"
           class="btn btn-info">Done
        </a>

    <?php } else { ?>
        <a href="<?php echo site_url('workspace'); ?>"
           class="btn btn-info">Done
        </a>
    <?php } ?>
    <a href="<?php echo site_url('qbank/pre_new_question'); ?>?back_url=<?php echo site_url('quiz/add_question') ?>/<?php echo $quid ?>"
       class="btn btn-info">Add new question</a><br><br>

    <div class="row">

        <div class="col-lg-6">
            <form method="post"
                  action="<?php echo site_url('quiz/add_question/' . $quid . '/' . $limit . '/' . $cid . '/' . $lid); ?>">
                <div class="input-group">
                    <input type="text" class="form-control" name="search"
                           placeholder="<?php echo $this->lang->line('search'); ?>...">

      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search'); ?></button>
      </span>


                </div>
                <!-- /input-group -->
            </form>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->


    <div class="row">

        <div class="col-md-12">
            <br>
            <?php
            if ($this->session->flashdata('message')) {
                echo $this->session->flashdata('message');
            }
            ?>
            <input type="hidden" id="added" value="<?php echo $this->lang->line('added'); ?>">

            <div class="form-group">
                <form method="post"
                      action="<?php echo site_url('quiz/pre_add_question/' . $quid . '/' . $limit . '/' . $cid . '/' . $lid); ?>">
                    <select name="cid">
                        <option value="0"><?php echo $this->lang->line('all_category'); ?></option>
                        <?php
                        foreach ($category_list as $key => $val) {
                            ?>

                            <option value="<?php echo $val['cid']; ?>" <?php if ($val['cid'] == $cid) {
                                echo 'selected';
                            } ?> ><?php echo $val['category_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="lid">
                        <option value="0"><?php echo $this->lang->line('all_level'); ?></option>
                        <?php
                        foreach ($level_list as $key => $val) {
                            ?>

                            <option value="<?php echo $val['lid']; ?>" <?php if ($val['lid'] == $lid) {
                                echo 'selected';
                            } ?> ><?php echo $val['level_name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <button class="btn btn-default" type="submit"><?php echo $this->lang->line('filter'); ?></button>
                </form>
            </div>


            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th><?php echo $this->lang->line('question'); ?></th>
                    <th><?php echo $this->lang->line('question_type'); ?></th>
                    <th><?php echo $this->lang->line('category_name'); ?>
                        / <?php echo $this->lang->line('level_name'); ?></th>
                    <th><?php echo $this->lang->line('percent_corrected'); ?></th>
                    <th>Add Question</th>
                    <th>Question Action</th>
                </tr>
                <?php
                if (count($result) == 0) {
                    ?>
                    <tr>
                        <td colspan="3"><?php echo $this->lang->line('no_record_found'); ?></td>
                    </tr>


                    <?php
                }
                foreach ($result as $key => $val) {
                    if($val['uid'] != $logged_in['uid']){continue;}
                    ?>
                    <?php
                    $qn=1;
                    if($val['question_type']==$this->lang->line('multiple_choice_single_answer')){
                        $qn=1;
                    }
                    if($val['question_type']==$this->lang->line('multiple_choice_multiple_answer')){
                        $qn=2;
                    }
                    if($val['question_type']==$this->lang->line('match_the_column')){
                        $qn=3;
                    }
                    if($val['question_type']==$this->lang->line('short_answer')){
                        $qn=4;
                    }
                    if($val['question_type']==$this->lang->line('long_answer')){
                        $qn=5;
                    }
                    if($val['question_type']=='True or False'){
                        $qn=8;
                    }

                    ?>
                    <tr>
                        <td>
                            <a href="javascript:show_question_stat('<?php echo $val['qid']; ?>');">+</a> <?php echo $val['qid']; ?>
                        </td>
                        <td><?php echo substr(strip_tags($val['question']), 0, 50); ?>

                            <span style="display:none;" id="stat-<?php echo $val['qid']; ?>">
                                 <table class="table table-bordered">
                                     <tr>
                                         <td><?php echo $this->lang->line('no_times_corrected'); ?></td>
                                         <td><?php echo $val['no_time_corrected']; ?></td>
                                     </tr>
                                     <tr>
                                         <td><?php echo $this->lang->line('no_times_incorrected'); ?></td>
                                         <td><?php echo $val['no_time_incorrected']; ?></td>
                                     </tr>
                                     <tr>
                                         <td><?php echo $this->lang->line('no_times_unattempted'); ?></td>
                                         <td><?php echo $val['no_time_unattempted']; ?></td>
                                     </tr>
                                 </table>
                            </span>
                        </td>
                        <td><?php echo $val['question_type']; ?></td>
                        <td><?php echo $val['category_name']; ?> / <span
                                style="font-size:12px;"><?php echo $val['level_name']; ?></span></td>

                        <td><?php if ($val['no_time_served'] != '0') {
                                $perc = ($val['no_time_corrected'] / $val['no_time_served']) * 100;
                                ?>

                                <div style="background:#eeeeee;width:100%;height:10px;">
                                <div style="background:#449d44;width:<?php echo intval($perc); ?>%;height:10px;"></div>
                                <span style="font-size:10px;"><?php echo intval($perc); ?>%</span>

                                <?php
                            } else {
                                echo $this->lang->line('not_used');
                            } ?></td>

                        <td>

                            <a href="javascript:addquestion('<?php echo $quid; ?>','<?php echo $val['qid']; ?>');"
                               class="btn btn-primary abutton" id='q<?php echo $val['qid']; ?>'>
                                <?php
                                if (in_array($val['qid'], explode(',', $quiz['qids']))) {

                                    echo $this->lang->line('added');

                                } else {

                                    echo $this->lang->line('add');
                                }
                                ?>
                            </a>
                            <button class="btn btn-danger remove" id="remove-<?php echo $val['qid']; ?>"
                                             quid="<?php echo $quid; ?>" qid="<?php echo $val['qid']; ?>">
                                Remove
                            </button>


                        </td>
                        <td>
                            <?php if($qn==8): ?>

                                <img class="edit_button" custom_link="<?php echo site_url('qbank/edit_question_2_bool/'.$val['qid']."/".$quid);?>" src="<?php echo base_url('images/edit.png');?>">

                            <?php else: ?>

                                <img class="edit_button" custom_link="<?php echo site_url('qbank/edit_question_'.$qn.'/'.$val['qid']."/".$quid);?>" src="<?php echo base_url('images/edit.png');?>">

                            <?php endif; ?>
<!--                            <a href="--><?php //echo site_url("qbank/remove_question")."/".$val['qid']."/".$quid ?><!--" class=".delete_question" >-->
                                <img class="remove_button" custom_link="<?php echo site_url("qbank/remove_question")."/".$val['qid']."/".$quid ?>" src="<?php echo base_url('images/cross.png');?>">
<!--                            </a>-->
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </table>
        </div>

    </div>


    <?php
    if (($limit - ($this->config->item('number_of_rows'))) >= 0) {
        $back = $limit - ($this->config->item('number_of_rows'));
    } else {
        $back = '0';
    } ?>

    <a href="<?php echo site_url('quiz/add_question/' . $quid . '/' . $back . '/' . $cid . '/' . $lid); ?>"
       class="btn btn-primary"><?php echo $this->lang->line('back'); ?></a>
    &nbsp;&nbsp;
    <?php
    $next = $limit + ($this->config->item('number_of_rows')); ?>

    <a href="<?php echo site_url('quiz/add_question/' . $quid . '/' . $next . '/' . $cid . '/' . $lid); ?>"
       class="btn btn-primary"><?php echo $this->lang->line('next'); ?></a>


</div>
<script src="<?php echo base_url("css/new_material/cdn/confirm.js") ?>"></script>
<script>

    //script for edit question
    $(document).ready(function(){
        //prompt edit confirmation
        $(".edit_button").click(function(){
            var custom_link = $(this).attr("custom_link");
            $.confirm({
                title: 'Edit question',
                content: 'Do you want to edit this question?',
                buttons: {
                    cancel: function () {

                    },
                    edit: {
                        text: 'Edit',
                        btnClass: 'btn-warning',
                        keys: ['enter', 'shift'],
                        action: function () {
                            window.location.replace(custom_link);
                        }
                    }
                }
            });

        });
        //end of prompt edit confirmation
        //prompt remove confirmation
        $(".remove_button").click(function(){
            var custom_link = $(this).attr("custom_link");
            $.confirm({
                title: 'Remove question',
                content: 'Do you want to delete this question?',
                buttons: {
                    cancel: function () {

                    },
                    remove: {
                        text: 'Remove',
                        btnClass: 'btn-danger',
                        keys: ['enter', 'shift'],
                        action: function () {
                            window.location.replace(custom_link);
                        }
                    }
                }
            });
        });
        //end of prompt remove confirmation
        var question_id;
        $(".edit_question").click(function(){
            question_id = $(this).attr("question_id");

        });


    });
    //end of script for edit question

    //hide added on page initialization
    $(document).ready(function () {
        var abuttons = $(".abutton");
        $.each(abuttons,function(key,value){
            var current_text = $(this).text();
            current_text = current_text.replace(/ /g,'');
            current_text = current_text.replace(/\n/,'');
            if(current_text=="Added"){
                $(this).hide();
            }

        });
    });

    //end of hide added on page initialization



    $(document).ready(function () {
        $(".remove").hide();
        <?php foreach ($result as $key => $val) { ?>
        <?php if (in_array($val['qid'], explode(',', $quiz['qids']))) {?>
        $("#remove-<?php echo $val['qid'] ?>").show();
        <?php } else { ?>
        $("#remove-<?php echo $val['qid'] ?>").hide();
        <?php } ?>
        <?php } ?>
        $(".remove").click(function () {
            var qid = $(this).attr("qid");
            var quid = $(this).attr("quid");
            var did = '#q' + qid;
            var site_url = "<?php echo site_url('quiz')?>";
            $.ajax({
                type: "POST",
                data: {quid: quid},
                url: site_url + '/remove_qid/' + quid + '/' + qid,
                success: function (data) {
                    $("#q" + qid).text("add");
                    $("#q" + qid).show();
                    $("#remove-" + qid).hide();
                },
                error: function (xhr, status, strErr) {
                    //alert(status);
                }
            });
        });
    });
    function addquestion(quid, qid) {
        var base_url = "<?php echo base_url()?>";
        var did = '#q' + qid;
        var formData = {quid: quid};
        $.ajax({
            type: "POST",
            data: formData,
            url: base_url + "index.php/quiz/add_qid/" + quid + '/' + qid,
            success: function (data) {
                $(did).html(document.getElementById('added').value);
                $("#q" + qid).hide();
                $("#remove-" + qid).show();
            },
            error: function (xhr, status, strErr) {
                //alert(status);
            }
        });

    }

</script>