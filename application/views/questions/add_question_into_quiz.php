<script src="<?php echo base_url('css/new_material/cdn/jquery1_12.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.css') ?>">

<style>
    tfoot input {
        width: 100%;
        padding : 3px;
        box-sizing: border-box;
    }

    tfoot {
        display: table-header-group;
    }

    a {
        color: black;
    }

    tr {
        cursor: pointer;
    }
</style>
<?php //print_r($result)?>
<input type="hidden" id="added" value="<?php echo $this->lang->line('added'); ?>">
<div class="wrapper">
    <div class="wrapper">
        <div class="row">
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
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>Add Questions</h2>
                <?php
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                ?>
                    <table id="lesson_lists" class="display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Question</th>
                        <th>Subject</th>
                        <th>Grade Level</th>
                        <th>Question Type</th>
                        <th>Question Status</th>
                        <th>Actions</th>


                    </tr>
                    </thead>
                    <tfoot>
                    <tr>

                        <th>Question</th>
                        <th>Subject</th>
                        <th>Grade Level</th>
                        <th>Question Type</th>
                        <th>Question Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach($result as $result_key=>$val): ?>
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
                            <td><?php print_r($val['question'])?></td>
                            <td><?php echo $this->category_model->get($val['cid'])['category_name']; ?></td>
                            <td><?php print_r($this->grades_model->where("lid",$val['lid'])[0]['level_name']);?></td>
                            <td><?php print_r($val['question_type'])?></td>
                            <td><a href="javascript:addquestion('<?php echo $quid; ?>','<?php echo $val['qid']; ?>');"
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
                                </button></td>
                            <td><?php if($qn==8): ?>

                                    <img class="edit_button" custom_link="<?php echo site_url('qbank/edit_question_2_bool/'.$val['qid']."/".$quid);?>" src="<?php echo base_url('images/edit.png');?>">

                                <?php else: ?>

                                    <img class="edit_button" custom_link="<?php echo site_url('qbank/edit_question_'.$qn.'/'.$val['qid']."/".$quid);?>" src="<?php echo base_url('images/edit.png');?>">

                                <?php endif; ?>
                                <!--                            <a href="--><?php //echo site_url("qbank/remove_question")."/".$val['qid']."/".$quid ?><!--" class=".delete_question" >-->
                                <img class="remove_button" custom_link="<?php echo site_url("qbank/remove_question")."/".$val['qid']."/".$quid ?>" src="<?php echo base_url('images/cross.png');?>">
                                <!--                            </a>--></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#lesson_lists tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        var table = $('#lesson_lists').DataTable();
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {

                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

        $('#lesson_lists').on( 'draw.dt', function (event) {
            var abuttons = $(this).find(".abutton");
            var removed_click = $(this).find(".remove");

            $(removed_click).hide();
            $.each(abuttons,function(key,value){
                var current_text = $(this).text();
                current_text = current_text.replace(/ /g,'');
                current_text = current_text.replace(/\n/,'');
                if(current_text=="Added"){
                    $(this).hide();
                    $("#remove-"+$(this).attr("id").replace("q","")).show();

                }

            });

        } );

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
        $(document).on('click', ".remove_button", function () {

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
        $(".remove").hide();
        <?php foreach ($result as $key => $val) { ?>
        <?php if (in_array($val['qid'], explode(',', $quiz['qids']))) {?>
        $("#remove-<?php echo $val['qid'] ?>").show();
        <?php } else { ?>
        $("#remove-<?php echo $val['qid'] ?>").hide();
        <?php } ?>
        <?php } ?>
        $(document).on('click', ".remove", function () {

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
        //end of prompt remove confirmation
        var question_id;
        $(".edit_question").click(function(){
            question_id = $(this).attr("question_id");

        });

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