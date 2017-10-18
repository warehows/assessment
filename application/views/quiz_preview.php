<style>
    td {
        font-size: 14px;
        padding: 4px;
    }
    .navbar.navbar-default{
        display: none;
    }
    .footer_buttons_preview {
        position: fixed;
        bottom: 0px;
        background: #ffffff;
        width: 100%;
        border-top: 1px solid #dddddd;
    }


</style>

<div class="container">


    <div class="save_answer_signal" id="save_answer_signal2"></div>
    <div class="save_answer_signal" id="save_answer_signal1"></div>


    <div style="float:left;width:auto; ">
        <h3><?php echo $title; ?></h3>
    </div>

    <div style="clear:both;"></div>

    <!-- Category button -->
    <!---->


    <div class="row" style="margin-top:5px;">
        <div class="col-md-8">
            <form method="post" action="<?php echo site_url('quiz/submit_quiz/' . $quiz['rid']); ?>" id="quiz_form">
                <input type="hidden" name="rid" value="<?php echo $quiz['rid']; ?>">
                <input type="hidden" name="noq" value="<?php echo $quiz['noq']; ?>">
                <input type="hidden" name="individual_time" id="individual_time"
                       value="<?php echo $quiz['individual_time']; ?>">

                <?php
                $abc = array(
                    '0' => 'A',
                    '1' => 'B',
                    '2' => 'C',
                    '3' => 'D',
                    '4' => 'E',
                    '6' => 'F',
                    '7' => 'G',
                    '8' => 'H',
                    '9' => 'I',
                    '10' => 'J',
                    '11' => 'K'
                );
                foreach ($questions as $qk => $question) {
                    ?>

                    <div id="preview-q<?php echo $qk; ?>" class="question_preview">

                        <div class="question_container_preview">
                            <h4><?php echo $this->lang->line('question'); ?> <?php echo $qk + 1; ?>)</strong></h4>
                            <?php echo $question['question']; ?>
                        </div>
                        <div class="option_container_preview">
                            <?php
                            // multiple single choice
                            if ($question['question_type'] == $this->lang->line('multiple_choice_single_answer')) {

                                $save_ans = array();
                                foreach ($saved_answers as $svk => $saved_answer) {
                                    if ($question['qid'] == $saved_answer['qid']) {
                                        $save_ans[] = $saved_answer['q_option'];
                                    }
                                }


                                ?>
                                <input type="hidden" name="question_type[]" id="q_type<?php echo $qk; ?>" value="1">
                                <?php
                                $i = 0;
                                foreach ($options as $ok => $option) {
                                    if ($option['qid'] == $question['qid']) {
                                        ?>

                                        <div class="op"><?php echo $abc[$i]; ?>) <input type="radio"
                                                                                        name="answer[<?php echo $qk; ?>][]"
                                                                                        id="answer_value<?php echo $qk . '-' . $i; ?>"
                                                                                        value="<?php echo $option['oid']; ?>" <?php if (in_array($option['oid'], $save_ans)) {
                                                echo 'checked';
                                            } ?> >
                                            <?php echo $option['q_option']; ?> </div>


                                        <?php
                                        $i += 1;
                                    } else {
                                        $i = 0;

                                    }
                                }
                            }

                            // multiple_choice_multiple_answer

                            if ($question['question_type'] == $this->lang->line('multiple_choice_multiple_answer')) {
                                $save_ans = array();
                                foreach ($saved_answers as $svk => $saved_answer) {
                                    if ($question['qid'] == $saved_answer['qid']) {
                                        $save_ans[] = $saved_answer['q_option'];
                                    }
                                }

                                ?>
                                <input type="hidden" name="question_type[]" id="q_type<?php echo $qk; ?>" value="2">
                                <?php
                                $i = 0;
                                foreach ($options as $ok => $option) {
                                    if ($option['qid'] == $question['qid']) {
                                        ?>

                                        <div class="op"><?php echo $abc[$i]; ?>) <input type="checkbox"
                                                                                        name="answer[<?php echo $qk; ?>][]"
                                                                                        id="answer_value<?php echo $qk . '-' . $i; ?>"
                                                                                        value="<?php echo $option['oid']; ?>" <?php if (in_array($option['oid'], $save_ans)) {
                                                echo 'checked';
                                            } ?> > <?php echo $option['q_option']; ?> </div>


                                        <?php
                                        $i += 1;
                                    } else {
                                        $i = 0;

                                    }
                                }
                            }

                            if ($question['question_type'] == 'True or False') {
                                $save_ans = array();
                                foreach ($saved_answers as $svk => $saved_answer) {
                                    if ($question['qid'] == $saved_answer['qid']) {
                                        $save_ans[] = $saved_answer['q_option'];
                                    }
                                }

                                ?>
                                <input type="hidden" name="question_type[]" id="q_type<?php echo $qk; ?>" value="2">
                                <?php
                                $i = 0;
                                foreach ($options as $ok => $option) {
                                    if ($option['qid'] == $question['qid']) {
                                        ?>

                                        <div class="op"><?php echo $abc[$i]; ?>) <input type="radio"
                                                                                        name="answer[<?php echo $qk; ?>][]"
                                                                                        id="answer_value<?php echo $qk . '-' . $i; ?>"
                                                                                        value="<?php echo $option['oid']; ?>" <?php if (in_array($option['oid'], $save_ans)) {
                                                echo 'checked';
                                            } ?> > <?php echo $option['q_option']; ?> </div>


                                        <?php
                                        $i += 1;
                                    } else {
                                        $i = 0;

                                    }
                                }
                            }

                            // short answer

                            if ($question['question_type'] == $this->lang->line('short_answer')) {
                                $save_ans = "";
                                foreach ($saved_answers as $svk => $saved_answer) {
                                    if ($question['qid'] == $saved_answer['qid']) {
                                        $save_ans = $saved_answer['q_option'];
                                    }
                                }
                                ?>
                                <input type="hidden" name="question_type[]" id="q_type<?php echo $qk; ?>" value="3">
                                <?php
                                ?>

                                <div class="op">
                                    <?php echo $this->lang->line('answer'); ?>
                                    <input type="text" name="answer[<?php echo $qk; ?>][]"
                                           value="<?php echo $save_ans; ?>" id="answer_value<?php echo $qk; ?>">
                                </div>


                                <?php


                            }


                            // long answer

                            if ($question['question_type'] == $this->lang->line('long_answer')) {
                                $save_ans = "";
                                foreach ($saved_answers as $svk => $saved_answer) {
                                    if ($question['qid'] == $saved_answer['qid']) {
                                        $save_ans = $saved_answer['q_option'];
                                    }
                                }
                                ?>
                                <input type="hidden" name="question_type[]" id="q_type<?php echo $qk; ?>" value="4">
                                <?php
                                ?>

                                <div class="op">
                                    <?php echo $this->lang->line('answer'); ?> <br>
                                    <?php echo $this->lang->line('word_counts'); ?> <span
                                        id="char_count<?php echo $qk; ?>">0</span>
                                    <textarea name="answer[<?php echo $qk; ?>][]" id="answer_value<?php echo $qk; ?>"
                                              style="width:100%;height:100%;"
                                              onKeyup="count_char(this.value,'char_count<?php echo $qk; ?>');"><?php echo $save_ans; ?></textarea>
                                </div>


                                <?php


                            }


                            // matching

                            if ($question['question_type'] == $this->lang->line('match_the_column')) {
                                $save_ans = array();
                                foreach ($saved_answers as $svk => $saved_answer) {
                                    if ($question['qid'] == $saved_answer['qid']) {
                                        // $exp_match=explode('__',$saved_answer['q_option_match']);
                                        $save_ans[] = $saved_answer['q_option'];
                                    }
                                }


                                ?>
                                <input type="hidden" name="question_type[]" id="q_type<?php echo $qk; ?>" value="5">
                                <?php
                                $i = 0;
                                $match_1 = array();
                                $match_2 = array();
                                foreach ($options as $ok => $option) {
                                    if ($option['qid'] == $question['qid']) {
                                        $match_1[] = $option['q_option'];
                                        $match_2[] = $option['q_option_match'];
                                        ?>


                                        <?php
                                        $i += 1;
                                    } else {
                                        $i = 0;

                                    }
                                }
                                ?>
                                <div class="op">
                                    <table>

                                        <?php
                                        shuffle($match_1);
                                        shuffle($match_2);
                                        foreach ($match_1 as $mk1 => $mval) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $abc[$mk1]; ?>) <?php echo $mval; ?>
                                                </td>
                                                <td>

                                                    <select name="answer[<?php echo $qk; ?>][]"
                                                            id="answer_value<?php echo $qk . '-' . $mk1; ?>">
                                                        <option
                                                            value="0"><?php echo $this->lang->line('select'); ?></option>
                                                        <?php
                                                        foreach ($match_2 as $mk2 => $mval2) {
                                                            ?>
                                                            <option
                                                                value="<?php echo $mval . '___' . $mval2; ?>" <?php $m1 = $mval . '___' . $mval2;
                                                            if (in_array($m1, $save_ans)) {
                                                                echo 'selected';
                                                            } ?> ><?php echo $mval2; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </td>
                                            </tr>


                                            <?php
                                        }


                                        ?>
                                    </table>
                                </div>
                                <?php

                            }

                            ?>

                        </div>
                    </div>


                    <?php
                }
                ?>
            </form>
        </div>


    </div>


</div>


<div class="footer_buttons_preview">


    <button class="btn btn-danger" onclick="window.history.go(-1); return false;"
            style="margin-top:2px;">Back</button>
</div>

<script>
    var ctime = 0;
    var ind_time = new Array();
    <?php
    $ind_time=explode(',',$quiz['individual_time']);
    for($ct=0; $ct < $quiz['noq']; $ct++){
        ?>
    ind_time[<?php echo $ct;?>] =<?php echo $ind_time[$ct];?>;
    <?php
}
?>
    noq = "<?php echo $quiz['noq'];?>";
    show_question('0');


    function increasectime() {

        ctime += 1;

    }
    setInterval(increasectime, 1000);
    setInterval(setIndividual_time, 30000);

</script>


<div id="warning_div"
     style="padding:10px; position:fixed;z-index:100;display:none;width:100%;border-radius:5px;height:200px; border:1px solid #dddddd;left:4px;top:70px;background:#ffffff;">
    <center><b> <?php echo $this->lang->line('really_Want_to_submit'); ?></b> <br><br>
        <span id="processing"></span>

        <a href="javascript:cancelmove();" class="btn btn-danger"
           style="cursor:pointer;"><?php echo $this->lang->line('cancel'); ?></a> &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="javascript:submit_quiz();" class="btn btn-info"
           style="cursor:pointer;"><?php echo $this->lang->line('submit_quiz'); ?></a>

    </center>
</div>