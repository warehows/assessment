<h3>Quiz Info</h3>
<div class="form-group">
    <input class="form-control quiz_name" id="quiz_name" placeholder="Quiz Name"/>
</div>
<div class="form-group">
    <select class="form-control grade" id="grade">
        <?php foreach ($all_grades as $grade_key => $grade_value) { ?>

            <option value="<?php echo $grade_value['lid'] ?>"><?php echo $grade_value['level_name'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <select class="form-control subject" id="subject">
        <?php foreach ($all_subjects as $subject_key => $subject_value) { ?>

            <option
                value="<?php echo $subject_value['cid'] ?>"><?php echo $subject_value['category_name'] ?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <button class="form-control" type="submit">Next</button>
</div>
<?php $post = $this->input->get() ?>
<?php
if ($post) {
    $quiz_id = $post['quid'];
} else {
    $quiz_id = false;
}
?>

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
                }
            }).done(function (value) {
                if (value != "Error") {
                    returned_value = value;
                } else {
                    returned_value = false;
                }

            });

            return returned_value;
        }

        function update_quiz() {
            var quiz_name = $("#quiz_name").val();
            var lid = $("#grade").val();
            var cid = $("#subject").val();
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
                }
            }).done(function (value) {
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
                if ($(this).val() != "") {
                    quid = create_new_quiz();
                } else {
                    //add error here
                }

            } else {
                update_quiz();
            }


        });
        $("#grade").change(function () {
            if (!quid) {
                if ($(this).val() != "") {
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
                if ($(this).val() != "") {
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


