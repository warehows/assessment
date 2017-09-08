<style>
    h1 {
        font-size: 100px !important;
        color: darkgrey;
    }
</style>
<?php $sent_data = $_GET; ?>
<div class="wrapper">


    <h3><?php /*echo $title;*/ ?></h3>


    <div class="row">
        <form method="post" action="<?php echo site_url('qbank/pre_new_question/'); ?>">
            <input type="hidden" name="back_url" value="<?php echo $sent_data['back_url']?>"/>
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
                            <label><?php echo $this->lang->line('select_question_type'); ?></label>
                            <select class="form-control" name="question_type" onChange="hidenop(this.value);">
                                <option
                                    value="1"><?php echo $this->lang->line('multiple_choice_single_answer'); ?></option>
                                <option
                                    value="2"><?php echo $this->lang->line('multiple_choice_multiple_answer'); ?></option>
                                <option value="3"><?php echo $this->lang->line('match_the_column'); ?></option>
                                <option value="4"><?php echo $this->lang->line('short_answer'); ?></option>
                                <option value="5">Open-ended Questions</option>
                                <option value="8">True or False</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Question specific score</label>
<!--                            <p style="font-size: x-small">Use Quiz Score Value</p>-->
<!--                            <input type="checkbox" name="use_quiz_score_value" class="use_quiz_score">-->
                            <input type="number" min="1" name="per_question_score" class="form-control per_question_score" placeholder="Leave blank to use default quiz score settings.">
                        </div>

                        <div class="form-group" id="nop">
                            <label for="inputEmail"><?php echo $this->lang->line('nop'); ?></label>
                            <input type="text" name="nop" class="form-control" value="4">
                        </div>


                        <a href="<?php echo $sent_data['back_url'] ?>">
                            <button class="btn btn-default" type="button">Go Back To Quiz</button>
                        </a>
                        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('next'); ?></button>

                    </div>
                </div>


            </div>
        </form>
    </div>


</div>
<!--<script>-->
<!--    // A $( document ).ready() block.-->
<!--    $( document ).ready(function() {-->
<!--        $( ".use_quiz_score" ).click(function() {-->
<!--            if ($('.use_quiz_score').is(':checked')) {-->
<!--                $('.per_question_score').removeAttr('required');;-->
<!--                $('.per_question_score').hide();-->
<!--            }else{-->
<!--                $('.per_question_score').show();-->
<!--                $('.per_question_score').prop('required',true);-->
<!--            }-->
<!--        });-->
<!---->
<!--    });-->
<!--</script>-->