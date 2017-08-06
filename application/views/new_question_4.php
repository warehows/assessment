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
                <form method="post" action="<?php echo site_url('qbank/new_question_4/' . $nop."?back_url=".$sent_data['back_url']); ?>">

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
                                    <?php echo $this->lang->line('short_answer'); ?>

                                </div>


                                <div class="form-group" style="display: none">
                                    <label>Subject</label>
                                    <select class="form-control" name="cid">
                                        <?php
                                        foreach ($category_list as $key => $val) {
                                            ?>
                                            <?php if ($val['cid'] == $lesson_information['cid']) { ?>
                                                <option selected
                                                        value="<?php echo $val['cid']; ?>"><?php echo $val['category_name']; ?></option>
                                            <?php } else { ?>
                                                <option
                                                    value="<?php echo $val['cid']; ?>"><?php echo $val['category_name']; ?></option>
                                            <?php } ?>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="cid" value="<?php echo $lesson_information['cid'] ?>">
                                </div>


                                <div class="form-group" style="display: none">
                                    <label>Grade</label>
                                    <select class="form-control" name="lid">
                                        <?php
                                        foreach ($level_list as $key => $val) {
                                            ?>
                                            <?php if ($val['lid'] == $lesson_information['lid']) { ?>
                                                <option selected
                                                        value="<?php echo $val['lid']; ?>"><?php echo $val['level_name']; ?></option>
                                            <?php } else { ?>
                                                <option
                                                    value="<?php echo $val['lid']; ?>"><?php echo $val['level_name']; ?></option>
                                            <?php } ?>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="lid" value="<?php echo $lesson_information['lid'] ?>">
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
                                <div class="form-group">
                                    <label
                                        for="inputEmail"><?php echo $this->lang->line('answer_in_one_or_two_word'); ?> </label>
                                    <br>
                                    <input type="text" name="option[]" class="form-control" value="">
                                </div>


                                <input id="magic_quiz_id" name="quiz_id" type="hidden" value="">
                                <a href="<?php echo $sent_data['back_url'] ?>">
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