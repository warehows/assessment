<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $current_lesson_data = $this->lessons_model->lesson_by_id($lesson_id); ?>
<div class="form-group">
    <label class="control-label" for="start_date">Lesson Title </label>
    <input class="form-control" type="text" name="lesson_name" required=""
           placeholder="Lesson Title" inputmode="email" id="lesson_name" value="<?php echo $current_lesson_data[0]['lesson_name'] ?>">
</div>
<div class="form-group">
    <label class="control-label" for="end_date">Subject </label>
    <select class="form-control" id="subject_id">
        <?php foreach ($all_subjects as $key => $value) { ?>

            <option value="<?php echo $value['cid'] ?>" <?php if($value['cid']==$current_lesson_data[0]['subject_id']){echo "selected";}?>><?php echo $value['category_name'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label" for="duration">Grade Level </label>
    <select class="form-control " id="level_id">
        <?php foreach ($all_levels as $key => $value) { ?>

            <option
                value="<?php echo $value['lid'] ?>" <?php if($value['lid']==$current_lesson_data[0]['level_id']){echo "selected";}?>>
                Grade <?php echo $value['level_name'] ?></option>
        <?php } ?>
    </select>

</div>

<script>
    $(document).ready(function(){
        var lesson_id = <?php echo $lesson_id; ?>;
        var lesson_name = "";
        var subject_id = "";
        var level_id = "";
        $("#lesson_name").focusout(function(){
            lesson_name = $("#lesson_name").val();
            subject_id = $("#subject_id").val();
            level_id = $("#level_id").val();
            $.ajax({
                url: "<?php echo site_url('lessons/update_lesson_info'); ?>",
                type: "POST",
                data: {id: lesson_id, lesson_name:lesson_name, subject_id:subject_id, level_id:level_id,}
            }).done(function (values) {

            });
        });

        $("#subject_id").change(function(){
            lesson_name = $("#lesson_name").val();
            subject_id = $("#subject_id").val();
            level_id = $("#level_id").val();
            $.ajax({
                url: "<?php echo site_url('lessons/update_lesson_info'); ?>",
                type: "POST",
                data: {id: lesson_id, lesson_name:lesson_name, subject_id:subject_id, level_id:level_id,}
            }).done(function (values) {

            });
        });
        $("#level_id").change(function(){
            lesson_name = $("#lesson_name").val();
            subject_id = $("#subject_id").val();
            level_id = $("#level_id").val();
            $.ajax({
                url: "<?php echo site_url('lessons/update_lesson_info'); ?>",
                type: "POST",
                data: {id: lesson_id, lesson_name:lesson_name, subject_id:subject_id, level_id:level_id,}
            }).done(function (values) {

            });
        });
    });
</script>