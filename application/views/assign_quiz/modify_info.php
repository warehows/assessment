<?php $post = $this->input->get() ?>
<?php
if (array_key_exists("quid", $post)) {
    if ($logged_in['su'] == 1) {
        $quiz_id = $post['quid'];
        $quiz_detail = $this->quiz_model->get_quiz($quiz_id);
    } elseif ($logged_in['su'] == 2) {
        $quiz_id = $post['quid'];
        $workspace_id = $post['quid'];

        $workspace_information = $this->workspace_model->where("id", $quiz_id);
        $quiz_id = $workspace_information[0]['content_id'];
        $quiz_detail = $this->quiz_model->get_quiz($quiz_id);
    }


} else {
    $quiz_id = false;
}
?>
<h3>Quiz Info</h3>
<div class="form-group">
    <input type="hidden" id="quiz_id" name="quiz_id" value="<?php if ($quiz_id) {
        echo $quiz_id;
    } ?>"/>
    <input type="hidden" id="quid" name="quid" value="<?php if ($quiz_id) {
        echo $quiz_id;
    } ?>"/>

    <input class="form-control quiz_name" id="quiz_name" required placeholder="Quiz Name" value="<?php if ($quiz_id) {
        echo $quiz_detail['quiz_name'];
    } ?>"/>
</div>
<div class="form-group">
    <input class="form-control description" id="description" required placeholder="Description"
           value="<?php if ($quiz_id) {
               echo $quiz_detail['description'];
           } ?>"/>
</div>
<?php
$semesterData = array(1 => 'First Semester', 2 => 'Second Semester', 3 => 'Third Semester', 4 => 'Fourth Semester');
$currentSem = isset($quiz_detail['semester']) ? $quiz_detail['semester'] : '';
?>
<div class="form-group">
    <label for="inputEmail" class="sr-only">Semester</label>
    <select id="semester" name="semester" class="form-control">
        <?php foreach ($semesterData as $key => $value): ?>
            <option <?php echo ($currentSem == $key) ? 'selected' : ''; ?>
                value="<?php echo $key; ?>"><?php echo $value; ?></option>
        <?php endforeach; ?>

    </select>
</div>
<div class="form-group">

    <select class="form-control grade" id="grade">
        <?php foreach ($all_grades as $grade_key => $grade_value) { ?>
            <option
                value="<?php echo $grade_value['lid'] ?>" <?php if ($quiz_id && $quiz_detail['lid'] == $grade_value['lid']) {
                echo "selected";
            } ?>><?php echo $grade_value['level_name'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <select class="form-control subject" id="subject">
        <?php foreach ($all_subjects as $subject_key => $subject_value) { ?>

            <option <?php if ($quiz_id && $quiz_detail['cid'] == $subject_value['cid']) {
                echo "selected";
            } ?>
                value="<?php echo $subject_value['cid'] ?>"><?php echo $subject_value['category_name'] ?></option>
        <?php } ?>
    </select>
</div>
<input type="hidden" id="subject_id" name="subject_id" value="<?php echo $quiz_detail['cid']?>">
<input type="hidden" id="level_id" name="level_id" value="<?php echo $quiz_detail['lid']?>">

<div class="form-group">
    <button class="form-control" type="submit">Next</button>
</div>


<script>

    $(document).ready(function () {

        <?php if($quiz_id){ ?>
        var quid = <?php echo $quiz_id?>;
        <?php }else{ ?>
        var quid;
        <?php } ?>


        function create_new_quiz() {
            var quiz_name = $("#quiz_name").val();
            var lid = $("#grade").val();
            var cid = $("#subject").val();
            var description = $("#description").val();
            var semester = $("#semester").val();
            var uid = <?php echo $logged_in['uid']?>;


            var returned_value;

            $.ajax({
                url: "<?php echo site_url('assign/insert_quiz');?>",
                type: "POST",
                async: false,
                data: {
                    quiz_name: quiz_name,
                    cid: cid,
                    uid: uid,
                    lid: lid,
                    description: description,
                    semester: semester,
                }
            }).done(function (value) {
                if (value != "Error") {
                    returned_value = value;
                } else {
                    returned_value = false;
                }

            });

            return $.trim(returned_value);
        }


        function update_quiz() {
            var quiz_name = $("#quiz_name").val();
            var lid = $("#grade").val();
            var cid = $("#subject").val();
            var description = $("#description").val();
            var semester = $("#semester").val();
            var uid = <?php echo $logged_in['uid']?>;
            <?php if (array_key_exists("quid",$post)) { ?>
            <?php if($logged_in['su']==2): ?>
            var workspace_id = <?php echo $workspace_id?>;
            <?php endif; ?>
            <?php } ?>


            var returned_value;
            $.ajax({
                url: "<?php echo site_url('assign/update_quiz');?>",
                type: "POST",
                data: {
                    quiz_name: quiz_name,
                    cid: cid,
                    uid: uid,
                    lid: lid,
                    quid: quid,
                    description: description,
                    semester: semester,
                    <?php if (array_key_exists("quid",$post)) { ?>
                    <?php if($logged_in['su']==2): ?>
                    workspace_id: workspace_id,
                    <?php endif; ?>
                    <?php } ?>
                }
            }).done(function (value) {
                console.log(value);
                if (value != "Error") {
                    returned_value = value;
                } else {
                    returned_value = false;
                }

            });


            return returned_value;
        }

        $("#quiz_name").focusout(function () {


            if (!quid) {
                if ($("#quiz_name").val() != "") {
                    quid = create_new_quiz();
                    $("#quid").val(quid);
                    $("#quiz_id").val(quid);
                } else {
                    //add error here
                }

            } else {
                update_quiz();
            }


        });

        $("#semester").focusout(function () {

            if (!quid) {
                if ($("#quiz_name").val() != "") {
                    quid = create_new_quiz();
                    $("#quid").val(quid);
                    $("#quiz_id").val(quid);
                } else {
                    //add error here
                }

            } else {
                update_quiz();
            }


        });
        $("#description").focusout(function () {

            if (!quid) {
                if ($("#quiz_name").val() != "") {
                    quid = create_new_quiz();
                    $("#quid").val(quid);
                    $("#quiz_id").val(quid);
                } else {
                    //add error here
                }

            } else {
                update_quiz();
            }


        });

        $("#grade").change(function () {

            if (!quid) {
                if ($("#quiz_name").val() != "") {
                    quid = create_new_quiz();

                } else {
                    //add error here
                }

            } else {
                update_quiz();
            }
        });
        $("#subject").change(function () {
            if (!quid) {
                if ($("#quiz_name").val() != "") {
                    quid = create_new_quiz();
                } else {
                    //add error here
                }

            } else {
                update_quiz();
            }
        });
    });

</script>


