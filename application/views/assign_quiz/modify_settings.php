<h3>Quiz Settings</h3>

<div class="form-group">
    <input class="form-control quiz_name" id="quiz_name" placeholder="Quiz Name"/>
</div>
<div class="form-group">
    <select class="form-control grade" id="grade">
        <option value=""></option>
    </select>
</div>
<div class="form-group">
    <select class="form-control subject" id="subject">
        <option value=""></option>
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
                    quiz_name:quiz_name,
                    cid:cid,
                    uid:uid,
                    lid:lid,
                    quid:quid,
                }
            }).done(function (value) {
                if(value!="Error"){
                    returned_value = value;
                }else{
                    returned_value = false;
                }

            });

            return returned_value;
        }

        $("#quiz_name").focusout(function () {

            update_quiz();
        });
        $("#grade").change(function () {

            update_quiz();
        });
        $("#subject").change(function () {

            update_quiz();
        });
    });

</script>


