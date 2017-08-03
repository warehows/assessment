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

<?php $all_teachers = $this->user_model->where('su', 2); ?>
<?php $workspace_current_data = $this->workspace_model->where("id",$quid); ?>
<?php $workspace_current_data = $workspace_current_data[0]; ?>
<?php $quiz_current_data = $this->quiz_model->get_quiz($workspace_current_data['content_id']); ?>
<?php print_r($quiz_current_data); ?>
<form action="<?php echo site_url('workspace/teacher_assign_quiz') ?>" method="GET">
    <div class="col-lg-4 col-lg-offset-0 col-md-4">
        Select Section
        <div id="data"></div>
    </div>
    <div class="col-lg-4 col-lg-offset-0 col-md-4">
        <!--        --><?php //print_r($all_teachers);?>
        Select Teacher for monitoring
        <div id="teacher"></div>

    </div>
    <div class="col-lg-4 col-lg-offset-0 col-md-4">
<!--        --><?php //if($quiz_current_data['start_date']!=0): $start_date = date('m/d/Y', $quiz_current_data['start_date']);; else: $start_date=""; endif; ?>

        <div class="form-group">
            <h6>Date Start</h6>
            <input id="date_start" class="form-control" name="date_start" value="" placeholder="mm/dd/yyyy"/>
        </div>
        <div class="form-group">
            <h6>Date End</h6>
            <input id="date_end" class="form-control" name="date_end" placeholder="mm/dd/yyyy"/>
        </div>
        <div class="form-group">
            <label>Percentage to Pass</label>
            <select class="form-control pass_percentage" id="pass_percentage" name="pass_percentage"
                    placeholder="Percentage">
                <!--                --><?php //if ($quiz_id): ?>
                <!--                    <option value="--><?php //echo $quiz_detail['pass_percentage']; ?><!--">-->
                <?php //echo $quiz_detail['pass_percentage']; ?><!--(current)</option>-->
                <!--                --><?php //endif ?>
                <option value="50">50%</option>
                <option value="60">60%</option>
                <option value="70">70%</option>
                <option value="80">80%</option>
                <option value="90">90%</option>
                <option value="100">100%</option>

            </select>
        </div>
        <div class="form-group">
            Duration (In Minutes)
            <input type="number" class="form-control duration" id="duration" name="duration" placeholder="Duration"
                   value=""/>
        </div>
        <div class="form-group">
            Points per Question
            <input type="number" class="form-control correct_score" name="correct_score" id="correct_score"
                   placeholder="Points" value=""/>
        </div>


        <div class="form-group">
            <label>Allow to View Answers After Quiz</label>
            <select class="form-control" id="view_answer" name="view_answer">
                <!--                --><?php //if(!empty($quiz_detail['view_answer'])): ?>
                <!--                    <option value="--><?php //echo $quiz_detail['view_answer']; ?><!--">-->
                <?php //echo $quiz_detail['view_answer'] ? 'Yes' : 'No'; ?><!--(current)</option>-->
                <!--                --><?php //endif; ?>
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select>
        </div>


        <input type="hidden" id="quid" name="quid" value="<?php echo $quid ?>"/>
        <input type="hidden" id="section_checked" name="sections[]"/>
        <input type="hidden" id="grade_checked" name="grades[]"/>
        <input type="hidden" id="teacher_checked" name="teachers[]"/>

        <input type="submit" class="btn btn-primary" id="submit">

    </div>
</form>


<?php $quid = $this->workspace_model->where("id",$quid); ?>
<?php $quid = $quid[0]['content_id']; ?>
<?php $quiz_data = $this->quiz_model->get_quiz($quid); ?>

<?php $quiz_gids = explode(",", $quiz_data['gids']); ?>
<?php $quiz_teacher_ids = explode(",", $quiz_data['teacher_ids']); ?>
<?php $quiz_teacher_ids_count = count($quiz_teacher_ids); ?>

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

        var teacher = [
            <?php foreach($all_teachers as $key =>$value){
                        echo '{"id": "'.$value['uid'].'","icon": "jstree-file", "text": "'.$value['first_name'].'"},';
                    }
                    ?>
        ];

        $('#teacher').jstree({
            'core': {
                "check_callback": true,
                'data': teacher,
            },
            "plugins": ["checkbox"]

        }).on("ready.jstree", function (e, data) {
            <?php foreach($quiz_teacher_ids as $quiz_teacher_ids_key => $quiz_teacher_ids_value):?>
            $("#<?php echo $quiz_teacher_ids_value?>_anchor").click();
            <?php endforeach; ?>
        });
        ;

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
            var checked_teacher = $('#teacher').jstree("get_checked", null, true);
            var section_checked = [];
            var grade_checked = [];
            var teacher_checked = [];
            $.each(checked, function (key, value) {
                if (!value.indexOf("section_")) {

                    value = value.replace("section_", "");

                    section_checked.push(value);
                } else {
                    value = value.replace("grade_", "");
                    grade_checked.push(value);
                }
            });
            $.each(checked_teacher, function (key, value) {


                teacher_checked.push(value);

            });
            $("#section_checked").val(section_checked);
            $("#grade_checked").val(grade_checked);
            $("#teacher_checked").val(teacher_checked);

        });

    });
</script>