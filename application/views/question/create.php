<form action="">
    <div class="container">
        <div class="main-title-container">
            <p class="main-title">Create Question</p>
            <a href="<?php echo site_url('part/index') ?>" class="main-title-link">
                <button class="main-button">Done</button>
            </a>
        </div>

        <div class="content-container">

            <div class="col-lg-12">
                <?php if(@$_REQUEST['question_type']):?>

                <?php elseif(@$_REQUEST['question_type']=="1"): ?>
                    test
                <?php else: ?>
                    <div class="form-group">
                        <label for="test_name">Question Type</label>
                        <select type="text" name="question_type" class="form-control" id="semester">
                            <option value="1">Identification</option>
                            <option value="2">Multiple Choice</option>
                            <option value="3">Long Answer</option>
                            <option value="4">Multiple Choice</option>
                            <option value="5">Match the Column</option>
                            <option value="6">True or False</option>
                            <option value="7">Fill in the blanks</option>
                        </select>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>
</form>
<script>

</script>