<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $current_lesson_data = $this->lessons_model->lesson_by_id($lesson_id); ?>
<div class="form-group">
    <label class="control-label" for="start_date">Lesson Title </label>
    <input class="form-control" type="text" name="lesson_name" required="" disabled=""
           placeholder="Lesson Title" inputmode="email" id="lesson_name" value="<?php echo $current_lesson_data[0]['lesson_name'] ?>">
</div>
<div class="form-group">
    <label class="control-label" for="end_date">Subject </label>
    <select class="form-control" id="subject_id">
        <?php foreach ($all_subjects as $key => $value) { ?>

            <option value="<?php echo $value['cid'] ?>" disabled="" <?php if($value['cid']==$current_lesson_data[0]['subject_id']){echo "selected";}?>><?php echo $value['category_name'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label" for="duration">Grade Level </label>
    <select class="form-control " id="level_id">
        <?php foreach ($all_levels as $key => $value) { ?>

            <option
                value="<?php echo $value['lid'] ?>" disabled="" <?php if($value['lid']==$current_lesson_data[0]['level_id']){echo "selected";}?>>
                <?php echo $value['level_name'] ?></option>
        <?php } ?>
    </select>

</div>

