<?php $post = $this->input->get() ?>
<?php
if (array_key_exists("quid", $post)) {
    $quiz_id = $post['quid'];
    $quiz_detail = $this->quiz_model->get_quiz($quiz_id);
} else {
    $quiz_id = false;
}
?>

<h3>Quiz Settings</h3>

<div class="form-group">
    Date Start
    <input class="form-control date_start" id="date_start" placeholder="mm/dd/yyyy" value="<?php if ($quiz_id) {
        echo $quiz_detail['quiz_name'];
    } ?>"/>
</div>
<div class="form-group">
    Date End
    <input class="form-control date_end" id="date_end" placeholder="mm/dd/yyyy" value="<?php if ($quiz_id) {
        echo $quiz_detail['quiz_name'];
    } ?>"/>
</div>
<div class="form-group">
    Duration (In Minutes)
    <input type="number" class="form-control duration" id="duration" placeholder="Duration" value="<?php if ($quiz_id) {
        echo $quiz_detail['quiz_name'];
    } ?>"/>
</div>
<div class="form-group">
    Percentage to Pass
    <input type="number" class="form-control pass_percentage" id="pass_percentage" placeholder="Percentage"
           value="<?php if ($quiz_id) {
               echo $quiz_detail['quiz_name'];
           } ?>"/>
</div>
<div class="form-group">
    Allow to View Answers After Quiz
    <select class="form-control" name="view_answer">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
</div>


<div class="form-group">
    <button class="form-control" type="submit">Next</button>
</div>


<script>
    $(function () {
        $("#date_start").datepicker();
        $("#date_end").datepicker();
    });
    $(function () {
        $("#date_start").datepicker();
        $("#date_end").datepicker();
    });
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


