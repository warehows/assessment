<?php $post = $this->input->get() ?>
<?php
if (array_key_exists("quid",$post)) {
    $quiz_id = $post['quid'];
    $quiz_detail = $this->quiz_model->get_quiz($quiz_id);
} else {
    $quiz_id = false;
}
?>
<?php print_r($quiz_detail);?>
<h3>Quiz Info</h3>
<div class="form-group">
    <input type="hidden" id="quiz_id" name="quiz_id" value="<?php if($quiz_id){ echo $quiz_id; }?>" />
    <input type="hidden" id="quid" name="quid" value="<?php if($quiz_id){ echo $quiz_id; }?>" />

    <input class="form-control quiz_name" id="quiz_name" placeholder="Quiz Name" value="<?php if($quiz_id){ echo $quiz_detail['quiz_name'];}?>"/>
</div>
<div class="form-group">
    <input class="form-control description" id="description" placeholder="Description" value="<?php if($quiz_id){ echo $quiz_detail['description'];}?>"/>
</div>
<div class="form-group">
    <?php foreach ($all_grades as $grade_key => $grade_value) { ?>

    <?php if($quiz_id&&$quiz_detail['lid']){ echo "selected"; }?>
    <?php } ?>
    <select class="form-control grade" id="grade">
        <?php foreach ($all_grades as $grade_key => $grade_value) { ?>
            <option <?php if($quiz_id&&$quiz_detail['lid'] == $grade_value){ echo "selected"; }?> value="<?php echo $grade_value['lid'] ?>"><?php echo $grade_value['level_name'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <select class="form-control subject" id="subject">
        <?php foreach ($all_subjects as $subject_key => $subject_value) { ?>

            <option <?php if($quiz_id&&$quiz_detail['cid'] == $subject_value){ echo "selected"; }?>
                value="<?php echo $subject_value['cid'] ?>"><?php echo $subject_value['category_name'] ?></option>
        <?php } ?>
    </select>
</div>


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
                }
            }).done(function (value) {
                if (value != "Error") {
                    returned_value = value;
                } else {
                    returned_value = false;
                }

            });

            return $.trim(returned_value);;
        }

        function update_quiz() {
            var quiz_name = $("#quiz_name").val();
            var lid = $("#grade").val();
            var cid = $("#subject").val();
            var description = $("#description").val();
            var uid = <?php echo $logged_in['uid']?>;
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

        $("#description").focusout(function () {
            if (!quid) {
                if ($("#quiz_name").val() != "") {
                    quid = create_new_quiz();
                    $("#quid").val(quid);
                    $("#qui z_id").val(quid);
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


