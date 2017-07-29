<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>

<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.css">

<?php $workspace_id = $posts['selected_quiz'][0]; ?>
<?php $workspace_information = $this->workspace_model->where("id", $workspace_id); ?>
<?php //print_r($workspace_information);?>
<?php $quid = $workspace_information[0]['content_id'] ?>

<?php $quiz_information = $this->quiz_model->get_quiz($quid); ?>
<?php $quiz_gids = $quiz_information['gids']; ?>
<?php $quiz_gids = explode(",", $quiz_gids); ?>
<?php $logged_in = $this->session->userdata('logged_in');?>
<?php $pass_percentage = $quiz_information['pass_percentage'];?>
<?php $duration = $quiz_information['duration'];?>
<?php $correct_score = $quiz_information['correct_score'];?>
<?php $pass_percentage = $quiz_information['pass_percentage'];?>
<?php $view_answer = $quiz_information['view_answer'];?>




<form action="<?php echo site_url('workspace/teacher_assign_quiz') ?>" method="GET">
    <div class="col-lg-6 col-lg-offset-0 col-md-6">
        <div id="data"></div>

    </div>
    <div class="col-lg-6 col-lg-offset-0 col-md-6">
        <?php $start_date = $quiz_information['start_date'] ?>
        <?php $start_date = date('m/d/Y', $start_date); ?>

            <div class="form-group">
            <h6>Date Start</h6>
            <input id="date_start" class="form-control" name="date_start" placeholder="mm/dd/yyyy" value="<?php echo $start_date?>"/>
        </div>
        <?php $end_date = $quiz_information['end_date'] ?>
        <?php $end_date = date('m/d/Y', $end_date); ?>

        <div class="form-group">
            <h6>Date End</h6>
            <input id="date_end" class="form-control" name="date_end" placeholder="mm/dd/yyyy" value="<?php echo $end_date?>"/>
        </div>

        <div class="form-group">
            <label>Percentage to Pass</label>
            <select class="form-control pass_percentage" id="pass_percentage" name="pass_percentage" placeholder="Percentage">
                <!--                --><?php //if ($quiz_id): ?>
                <!--                    <option value="--><?php //echo $quiz_detail['pass_percentage']; ?><!--">-->
                <?php //echo $quiz_detail['pass_percentage']; ?><!--(current)</option>-->
                <!--                --><?php //endif ?>
                <option value="50" <?php if(50 == $pass_percentage){ echo "selected"; }?>>50%</option>
                <option value="60" <?php if(60 == $pass_percentage){ echo "selected"; }?>>60%</option>
                <option value="70" <?php if(70 == $pass_percentage){ echo "selected"; }?>>70%</option>
                <option value="80" <?php if(80 == $pass_percentage){ echo "selected"; }?>>80%</option>
                <option value="90" <?php if(90 == $pass_percentage){ echo "selected"; }?>>90%</option>
                <option value="100" <?php if(100 == $pass_percentage){ echo "selected"; }?>>100%</option>

            </select>
        </div>
        <div class="form-group">
            Duration (In Minutes)
            <input type="number" class="form-control duration" id="duration" name="duration" placeholder="Duration" value="<?php echo $duration?>"/>
        </div>
        <div class="form-group">
            Points per Question
            <input type="number" class="form-control correct_score" name="correct_score" id="correct_score" placeholder="Points" value="<?php echo $correct_score?>"/>
        </div>
        <div class="form-group">
            <label>Allow to View Answers After Quiz</label>
            <select class="form-control" id="view_answer" name="view_answer">

                <option value="0" <?php if(0 == $view_answer){ echo "selected"; }?>>Yes</option>
                <option value="1" <?php if(1 == $view_answer){ echo "selected"; }?>>No</option>
            </select>
        </div>
        <input type="hidden" id="section_checked" name="sections[]"/>
        <input type="hidden" id="grade_checked" name="grades[]"/>

        <input type="hidden" id="workspace_id" name="workspace_id" value="<?php echo $workspace_id ?>"/>
        <input type="hidden" id="quid" name="quiz_id" value="<?php echo $quid ?>"/>
        <input type="hidden" id="teachers" name="teachers[]" value="<?php echo $logged_in['uid']?>"/>
        <input type="submit" class="btn btn-primary" id="submit">

    </div>
</form>

<script>

    $(function () {
        $("#date_start").datepicker();
        $("#date_end").datepicker();
    });
    $(document).ready(function () {
        var grade = [
            <?php foreach($all_levels as $key =>$value){
                echo '{"id": "grade_'.$value['lid'].'", "text": "'.$value['level_name'].'","children":[';
                    foreach($all_sections as $section_key => $section_value){
                        if($section_value['lid'] == $value['lid']){


                            echo "{'id' : 'section_".$section_value['gid']."', 'text' : '".$section_value['group_name']."' },";
                        }
                    }
                echo ']},';
            }
            ?>
        ];

        $('#data').jstree({
            'core': {
                "check_callback": true,
                'data': grade,

            },
            "plugins": ["checkbox"]

        })
            .on('create_node.jstree', function (e, data) {

            })
            .on("ready.jstree", function (e, data) {

                <?php $number_of_folders = 6; ?>
                <?php for($x=1;$x<=$number_of_folders;$x++):?>
                var grade_<?php echo $x;?>_parent_status = false;
                <?php endfor;?>

                <?php for($x=1;$x<=$number_of_folders;$x++):?>
                var grade_<?php echo $x;?>_aria_status = false;
                <?php endfor;?>


                $("#grade_1").find("i").eq(0).click();
                $("#grade_2").find("i").eq(0).click();
                $("#grade_3").find("i").eq(0).click();
                $("#grade_4").find("i").eq(0).click();
                $("#grade_5").find("i").eq(0).click();
                $("#grade_6").find("i").eq(0).click();

                <?php foreach($quiz_gids as $quiz_gids_key => $quiz_gids_value):?>
                $("#section_<?php echo $quiz_gids_value?>_anchor").click();
                <?php endforeach; ?>


                <?php for($x=1;$x<=$number_of_folders;$x++):?>
                setTimeout(
                    function () {
                        //true and false
                        grade_<?php echo $x?>_aria_status = $("#grade_<?php echo $x?>").attr("aria-selected");
                        grade_<?php echo $x?>_parent_status = $("#grade_<?php echo $x?>").find("a").eq(0).find("i").eq(0).hasClass("jstree-undetermined");
                        if (grade_<?php echo $x?>_aria_status == "false" && !grade_<?php echo $x?>_parent_status) {
                            $("#grade_<?php echo $x?>").find("i").eq(0).click();
                        }
                    }, 100
                );
                <?php endfor;?>


            });


        $("#submit").click(function () {
            var checked = $('#data').jstree("get_checked", null, true);
            var section_checked = [];
            var grade_checked = [];
            $.each(checked, function (key, value) {
                if (!value.indexOf("section_")) {

                    value = value.replace("section_", "");

                    section_checked.push(value);
                } else {
                    value = value.replace("grade_", "");
                    grade_checked.push(value);
                }
            });
            $("#section_checked").val(section_checked);
            $("#grade_checked").val(grade_checked);

        });

    });
</script>