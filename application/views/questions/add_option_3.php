<form action="<?php echo $question_back_url?>" method="GET" style="display: none">
    <?php foreach ($option as $option_key => $option_value): ?>
        <textarea name="option[]" class="form-control option"><?php print_r($option_value)?></textarea>
    <?php endforeach; ?>
    <input type="hidden" name="back_url" value="<?php echo $back_url ?>"/>
    <input type="hidden" name="question" value="<?php echo $question ?>"/>
</form>
<script src="<?php echo base_url('css/material/js/jquery-1.12.4.js')?>"></script>
<script>
//    $("form").submit();
</script>