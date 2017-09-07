
<?php $data = $_GET ?>
<?php print_r("<pre>") ?>
<?php print_r($data) ?>
<form action="<?php echo site_url()."/calendar/save"?>" method="post">
    <input type="text" name="dateFrom" value="<?php print_r($data["date_start"]) ?>">
    <input type="text" name="dateTo" value="<?php print_r($data["date_end"]) ?>">
    <input type="text" name="section" value="<?php print_r($data["sections"][0]) ?>">
    <input type="text" name="lesson" value="<?php print_r($teacher_workspace_model) ?>">
    <input type="text" name="grades" value="<?php print_r($data["grades"][0]) ?>">
    <input type="text" name="workspace_id" value="<?php print_r($data["workspace_id"]) ?>">
    <input type="text" name="lesson" value="<?php print_r($data["lesson_id"]) ?>">
    <input type="text" name="teacher_id" value="<?php print_r($data["uid"]) ?>">
    <input type="text" name="teacher_workspace_id" value="<?php print_r($teacher_workspace_model) ?>">
</form>
<script src="<?php echo base_url()."/js/jquery.js" ?>"></script>
<?php exit;?>
<script>
    $("form").submit();
</script>