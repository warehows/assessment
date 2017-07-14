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

<input type="hidden" id="quiz_name" name="quiz_name" value="<?php echo $quiz_detail['quiz_name']; ?>"/>
<input type="hidden" id="quiz_id" name="quiz_id" value="<?php echo $quiz_detail['quid']; ?>">
<input type="hidden" id="quid" name="quid" value="<?php echo $quiz_detail['quid']; ?>">
<input type="hidden" id="cid" name="cid" value="<?php echo $quiz_detail['cid']; ?>">
<input type="hidden" id="uid" name="uid" value="<?php echo $quiz_detail['uid']; ?>">
<input type="hidden" id="lid" name="lid" value="<?php echo $quiz_detail['lid']; ?>">
<input type="hidden" name="correct_score">
<input type="hidden" name="incorrect_score">
<input type="hidden" name="ip_address" value="">
<input type="hidden" name="maximum_attempts" value="10000">
<input type="hidden" name="camera_req" value="0">
<input type="hidden" name="question_selection" value="0">


<div class="form-group">
    Date Start
    <input class="form-control start_date" id="start_date" placeholder="mm/dd/yyyy" value="<?php if ($quiz_id) {
        echo $quiz_detail['start_date'];
    } ?>"/>
</div>
<div class="form-group">
    Date End
    <input class="form-control end_date" id="end_date" placeholder="mm/dd/yyyy" value="<?php if ($quiz_id) {
        echo $quiz_detail['end_date'];
    } ?>"/>
</div>
<div class="form-group">
    Duration (In Minutes)
    <input type="number" class="form-control duration" id="duration" placeholder="Duration" value="<?php if ($quiz_id) {
        echo $quiz_detail['duration'];
    } ?>"/>
</div>
<div class="form-group">
    Percentage to Pass
    <input type="number" class="form-control pass_percentage" id="pass_percentage" placeholder="Percentage"
           value="<?php if ($quiz_id) {
               echo $quiz_detail['pass_percentage'];
           } ?>"/>
</div>
<div class="form-group">
    Allow to View Answers After Quiz
    <select class="form-control" id="view_answer" name="view_answer">
        <?php if ($quiz_id) { ?>
            <option value="1" <?php if ($quiz_detail['view_answer'] == 1) {
                echo "selected";
            } ?>>Yes
            </option>
            <option value="0" <?php if ($quiz_detail['view_answer'] == 0) {
                echo "selected";
            } ?>>No
            </option>
        <?php } ?>
    </select>
</div>


<div class="form-group">
    <a href="<?php echo site_url('quiz/add_question/')."/".$quiz_id ?>"><button class="form-control" type="button">Next</button></a>
</div>


<script>
    $(function () {
        $("#start_date").datepicker();
        $("#end_date").datepicker();
    });
    $(document).ready(function () {

        <?php if($quiz_id){ ?>
        var quid = <?php echo $quiz_id?>;
        <?php }else{ ?>
        var quid;
        <?php } ?>

        function toDateTime(secs) {
            var t = new Date(1970, 0, 1); // Epoch
            t.setSeconds(secs);
            return t;
        }
        var month_names = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        function convertDate(seconds){
            var date = toDateTime(seconds);
            var month = month_names[date.getMonth()];
            var month_number = date.getMonth()+1;
            month_number = "0"+month_number;
            var day = date.getDay();
            day = "0"+day;
            var year = date.getFullYear();
            return month_number+"/"+day+"/"+year;
        }
        var to_convert_start_date = $("#start_date").val();
        var to_convert_end_date = $("#end_date").val();

        if(to_convert_start_date != 0){
            var to_convert_start_date = convertDate(to_convert_start_date);
            var to_convert_end_date = convertDate(to_convert_end_date);
            $("#start_date").val(to_convert_start_date);
            $("#end_date").val(to_convert_end_date);
        }

        console.log();


        function create_new_quiz() {
            var quiz_name = $("#quiz_name").val();
            var lid = $("#grade").val();
            var cid = $("#subject").val();
            var uid = <?php echo $logged_in['uid']?>;
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var duration = $("#duration").val();
            var pass_percentage = $("#pass_percentage").val();
            var view_answer = $("#view_answer").val();
            var correct_score = $("#correct_score").val();
            var incorrect_score = $("#incorrect_score").val();
            var ip_address = $("#ip_address").val();
            var maximum_attempts = $("#maximum_attempts").val();
            var camera_req = $("#camera_req").val();
            var question_selection = $("#question_selection").val();
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
                    start_date: start_date,
                    end_date: end_date,
                    duration: duration,
                    pass_percentage: pass_percentage,
                    view_answer: view_answer,
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
            var quid = $("#quid").val();
            var lid = $("#lid").val();
            var cid = $("#cid").val();
            var uid = <?php echo $logged_in['uid']?>;
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            var duration = $("#duration").val();
            var pass_percentage = $("#pass_percentage").val();
            var view_answer = $("#view_answer").val();
            var correct_score = $("#correct_score").val();
            var incorrect_score = $("#incorrect_score").val();
            var ip_address = $("#ip_address").val();
            var maximum_attempts = $("#maximum_attempts").val();
            var camera_req = $("#camera_req").val();
            var question_selection = $("#question_selection").val();
            var returned_value;

            $.ajax({
                url: "<?php echo site_url('assign/update_quiz');?>",
                type: "POST",
                data: {
                    quiz_name: quiz_name,
                    quid: quid,
                    cid: cid,
                    uid: uid,
                    lid: lid,
                    start_date: start_date,
                    end_date: end_date,
                    duration: duration,
                    pass_percentage: pass_percentage,
                    view_answer: view_answer,
                    correct_score: correct_score,
                    incorrect_score: incorrect_score,
                    ip_address: ip_address,
                    maximum_attempts: maximum_attempts,
                    camera_req: camera_req,
                    question_selection: question_selection
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

        $("#pass_percentage").focusout(function () {

            if (!quid) {
                if ($(this).val() != "") {
                    quid = create_new_quiz();

                } else {

                }

            } else {
                var haha = update_quiz();

            }


        });
        $("#view_answer").click(function () {
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


