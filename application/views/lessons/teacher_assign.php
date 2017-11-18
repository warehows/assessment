<link href="<?php echo base_url('css/new_material/cdn/hayageek_file_upload.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('css/new_material/cdn/jquery.uploadfile.min.js'); ?>"></script>
<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>

<script src="<?php echo base_url('js/confirm.js'); ?>"></script>
<script src="<?php echo base_url('js/jstree.js'); ?>"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo base_url('js/jquery_ui.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('css/confirm.css'); ?>">
<?php $current_lesson_data = $this->lessons_model->lesson_by_id($lesson_id)[0]?>



<form action="<?php echo site_url('workspace/teacher_assign_lesson') ?>" method="GET">
    <div class="col-lg-6 col-lg-offset-0 col-md-6">
        <div id="data"></div>
    </div>
    <div class="col-lg-6 col-lg-offset-0 col-md-6">
        <div class="form-group">
            <h6>Date Start</h6>
            <input id="date_start" class="form-control" name="date_start" value="<?php echo $current_lesson_data['assigned_date_start']?>" required placeholder="mm/dd/yyyy"/>
        </div>
        <div class="form-group">
            <h6>Date End</h6>
            <input id="date_end" class="form-control" name="date_end" value="<?php echo $current_lesson_data['assigned_date_end']?>" required placeholder="mm/dd/yyyy"/>
        </div>

        <h3>For Quizzes</h3>
        <div class="form-group">

            <div class="form-group">
                <h6>Duration in (min)</h6>
                <input id="duration" type="number" min="1" class="form-control" name="duration" required placeholder="Duration"/>
            </div>
            <div class="form-group">
                <h6>Maximum Attempts</h6>
                <input id="maximum_attempts" type="number" min="1" class="form-control" name="maximum_attempts" required placeholder="Maximum Attempts"/>
            </div>
            <div class="form-group">
                <h6>Pass Percentage</h6>
                <input id="pass_percentage" type="number" min="1" class="form-control" name="pass_percentage" max="100" required placeholder="Pass Percentage"/>
            </div>
            <div class="form-group">
                <h6>Score per Question</h6>
                <input id="correct_score" type="number" min="1" class="form-control" name="correct_score" required placeholder="Score per Question"/>
            </div>

        </div>

        <input type="hidden" id="section_checked" name="sections[]"/>
        <input type="hidden" id="grade_checked" name="grades[]"/>

        <input type="hidden" id="workspace_id" name="workspace_id" required value="<?php echo $workspace_id ?>"/>
        <input type="hidden" id="lesson_id" name="lesson_id" required value="<?php echo $lesson_id ?>"/>
        <input type="submit" class="btn btn-primary" id="submit">

    </div>
</form>
<?php $sections = explode(",",$current_lesson_data["lesson_assigned_ids"]);?>

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
            "plugins": ["checkbox"],

        })
            .on('create_node.jstree', function (e, data) {

            })
            .on('ready.jstree', function (e, data) {
                <?php for($x=1;$x<=6;$x++): ?>
                    $("#grade_<?php echo $x?>").find("i").click();
                <?php endfor; ?>
                <?php foreach($sections as $keys=>$values){ ?>
                    $("#section_<?php echo $values?>_anchor").click();
                <?php } ?>

                <?php for($x=1;$x<=6;$x++): ?>
                    if($("#grade_<?php echo $x?>_anchor").hasClass("jstree-clicked")){



                    }else{
//                        alert($("#grade_1_anchor").find("i").eq(0).css("border","20px solid black"));

                        setTimeout(function(){
//                            console.log($("#grade_1_anchor").find("i").eq(0).attr("class"));
                            console.log($("#grade_1_anchor").find("i").eq(0).hasClass("jstree-undetermined"));
                            if(!$("#grade_1_anchor").find("i").eq(0).hasClass("jstree-undetermined")){

                                $("#grade_<?php echo $x?>_anchor").siblings("i").eq(0).click();
                            }else{
                                $("#grade_<?php echo $x?>_anchor").siblings("i").eq(0).click();
                            }
                        }, 50);


                    }
                <?php endfor; ?>

            })
            .on("select_node.jstree", function (e, data) {

            });
        $("form").submit(function () {
            $(this).attr("disabled","");
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