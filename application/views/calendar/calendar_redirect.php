
<?php $data = $_GET ?>
<?php //print_r("<pre>") ?>
<?php //print_r($data) ?>
<form action="<?php echo site_url()."/calendar/save"?>" method="post" style="display: none">
    <p>date from</p><input type="text" name="dateFrom" value="<?php print_r($data["date_start"]) ?>">
    <p>date to</p><input type="text" name="dateTo" value="<?php print_r($data["date_end"]) ?>">
    <p>date section</p><input type="text" name="section" value="<?php print_r($data["sections"][0]) ?>">
    <p>date lesson</p><input type="text" name="lesson" value="<?php print_r($teacher_workspace_model) ?>">
    <p>date grades</p><input type="text" name="grades" value="<?php print_r($data["grades"][0]) ?>">
    <p>date workspace id</p><input type="text" name="workspace_id" value="<?php print_r($data["workspace_id"]) ?>">
    <p>date lesson</p><input type="text" name="lesson" value="<?php print_r($data["lesson_id"]) ?>">
    <p>date teacher id</p><input type="text" name="teacher_id" value="<?php print_r($data["uid"]) ?>">
    <p>date teacher workspace id</p><input type="text" name="teacher_workspace_id" value="<?php print_r($teacher_workspace_model) ?>">
    <p>new lesson id</p><input type="text" name="new_lesson_id" value="<?php print_r($new_lesson_id) ?>">
</form>
<script src="<?php echo base_url()."/js/jquery.js" ?>"></script>

<script>
    $("form").submit();
</script>