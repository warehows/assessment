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
                <form method="post" action="<?php echo site_url('qbank/new_question_2_bool/' . $nop."?back_url=".$sent_data['back_url']); ?>">
                    <input type="hidden" name="per_question_score" value="<?php echo $this->input->get('per_question_score'); ?>">
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

                                <?php
                                $arrayBool = array('True','False');
                                for ($i = 1; $i <= $nop; $i++) {
                                    ?>
                                    <div class="form-group">
                                        <label
                                                for="inputEmail"><?php echo $this->lang->line('options'); ?> <?php echo $i; ?>
                                            )</label> <br>
                                        <input type="radio" name="score[]"
                                               value="<?php echo $i - 1; ?>" <?php if ($i == 1) {
                                            echo 'checked';
                                        } ?> > Select Correct Option
                                        <br><input type="hidden" name="option[]" class="form-control" value="<?php echo $arrayBool[$i - 1]?>"/><h4><?php echo $arrayBool[$i - 1]?></h4>
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