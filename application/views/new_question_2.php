<?php $sent_data = $_GET; ?>
<?php
$current_lesson_id = $sent_data['back_url'];
$current_lesson_id = str_replace(site_url('quiz/add_question') . "/", "", $current_lesson_id);
$lesson_information = $this->quiz_model->get_quiz($current_lesson_id);

?>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12 col-lg-offset-2 col-md-12col-sm-12">

            <h3><?php echo $title; ?></h3>


            <div class="row">
                <form method="post" action="<?php echo site_url('qbank/new_question_2/' . $nop); ?>">

                    <div class="col-md-8">
                        <br>

                        <div class="login-panel panel panel-default">
                            <div class="panel-body">


                                <?php
                                if ($this->session->flashdata('message')) {
                                    echo $this->session->flashdata('message');
                                }
                                ?>


                                <div class="form-group">

                                    <?php echo $this->lang->line('multiple_choice_multiple_answer'); ?>
                                </div>


                                <div class="form-group">
                                    <label><?php echo $this->lang->line('select_category'); ?></label>
                                    <select class="form-control" name="cid">
                                        <?php
                                        foreach ($category_list as $key => $val) {
                                            ?>

                                            <option
                                                value="<?php echo $val['cid']; ?>"><?php echo $val['category_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label><?php echo $this->lang->line('select_level'); ?></label>
                                    <select class="form-control" name="lid">
                                        <?php
                                        foreach ($level_list as $key => $val) {
                                            ?>

                                            <option
                                                value="<?php echo $val['lid']; ?>"><?php echo $val['level_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="inputEmail"><?php echo $this->lang->line('question'); ?></label>
                                    <textarea name="question" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="description" />
<!--                                <div class="form-group">-->
<!--                                    <label for="inputEmail">--><?php //echo $this->lang->line('description'); ?><!--</label>-->
<!--                                    <textarea name="description" class="form-control"></textarea>-->
<!--                                </div>-->
                                <?php
                                for ($i = 1; $i <= $nop; $i++) {
                                    ?>
                                    <div class="form-group">
                                        <label
                                            for="inputEmail"><?php echo $this->lang->line('options'); ?> <?php echo $i; ?>
                                            )</label> <br>
                                        <input type="checkbox" name="score[]"
                                               value="<?php echo $i - 1; ?>" <?php if ($i == 1) {
                                            echo 'checked';
                                        } ?> > Select Correct Option
                                        <br><textarea name="option[]" class="form-control"></textarea>
                                    </div>
                                    <?php
                                }
                                ?>
                                <input id="magic_quiz_id" name="quiz_id" type="hidden" value="">
                                <button class="btn btn-default"
                                        type="submit"><?php echo $this->lang->line('submit'); ?></button>

                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        jQuery('#magic_quiz_id').val(localStorage.getItem('latest_id'));
    });
</script>