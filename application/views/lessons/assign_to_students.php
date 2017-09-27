<link href="<?php echo base_url('css/new_material/cdn/hayageek_file_upload.css')?>" rel="stylesheet">
<script src="<?php echo base_url('css/new_material/cdn/jquery.min.js')?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/jquery.uploadfile.min.js')?>"></script>

<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>

<script src="<?php echo base_url('css/new_material/cdn/confirm.js')?>"></script>
<script src="<?php echo base_url('js/jstree.js')?>"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="<?php echo base_url('js/jquery_ui.js')?>"></script>

<link rel="stylesheet" href="<?php echo base_url('css/confirm.css')?>">
<form action="<?php echo site_url('workspace/mass_assignation') ?>" method="GET">
    <?php $all_teachers = $this->user_model->where("su",2); ?>
<!--    <pre>-->
<!--    --><?php //print_r($all_teachers[3])?>
    <div class="col-lg-4 col-lg-offset-0 col-md-4">
        <div id="data"></div>

    </div>
    <?php $current_lesson_data = $this->lessons_model->lesson_by_id($lesson_id)?>
    <div class="col-lg-4 col-lg-offset-0 col-md-4">
        <?php if ($workspace_id == 0) { ?>

            <div class="form-group">
                <h6>Select Teacher</h6>

                <div id="teachers"></div>
                <!--                --><?php //foreach($all_teachers as $all_teachers_key=>$all_teachers_value){?>
                <!--                    <input class="form-control" name="uid[]" type="checkbox" value="--><?php //echo $all_teachers_value['uid']?><!--" />-->
                <!--                --><?php //} ?>
            </div>
        <?php }else{ ?>
            <input type="hidden" id="uid" name="uid" value="<?php echo $logged_in['uid'] ?>"/>
        <?php } ?>
    </div>
    <div class="col-lg-4 col-lg-offset-0 col-md-4">
        <div class="form-group">
            <h6>Date Start</h6>
            <input id="date_start" class="form-control" name="date_start" required placeholder="mm/dd/yyyy"/>
        </div>
        <div class="form-group">
            <h6>Date End</h6>
            <input id="date_end" class="form-control" name="date_end" required placeholder="mm/dd/yyyy"/>
        </div>

        <input type="hidden" id="section_checked" name="sections[]"/>
        <input type="hidden" id="grade_checked" name="grades[]"/>
        <input type="hidden" id="teacher_checked" name="teachers[]"/>

        <input type="hidden" id="workspace_id" name="workspace_id" value="<?php echo $workspace_id ?>"/>
        <input type="hidden" id="lesson_id" name="lesson_id" value="<?php echo $lesson_id ?>"/>
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
        var teachers = [
            <?php foreach($all_teachers as $key =>$value){
                echo '{"id": "teacher_'.$value['uid'].'", "text": "'.$value['first_name'].' '.$value['last_name'].'","children":[';

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
            .on("select_node.jstree", function (e, data) {

            });
        $('#teachers').jstree({
            'core': {
                "check_callback": true,
                'data': teachers,

            },
            "plugins": ["checkbox"]

        })
            .on('create_node.jstree', function (e, data) {

            })
            .on("select_node.jstree", function (e, data) {

            });

        $("#submit").click(function () {
            var checked = $('#data').jstree("get_checked", null, true);
            var teachers_checked = $('#teachers').jstree("get_checked", null, true);
            var current_checked_teacher = [];
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
            $.each(teachers_checked, function (key, value) {
                if (!value.indexOf("teacher_")) {

                    value = value.replace("teacher_", "");

                    current_checked_teacher.push(value);
                }
            });
            $("#section_checked").val(section_checked);
            $("#grade_checked").val(grade_checked);
            $("#teacher_checked").val(current_checked_teacher);

        });

    });
</script>