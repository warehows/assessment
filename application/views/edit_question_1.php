<link href="<?php echo base_url("css/new_material/cdn/jquery-confirm.min.css") ?>" rel="stylesheet">

<div class="wrapper">
    <div class="row">


        <h3><?php echo $title; ?></h3>


        <div class="row">
            <form method="post"
                  action="<?php echo site_url('qbank/edit_question_1')."/". $question['qid']. "/" . $quid; ?>">

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

                                <?php echo $this->lang->line('multiple_choice_single_answer'); ?>
                            </div>


                            <div class="form-group">
                                <label><?php echo $this->lang->line('select_category'); ?></label>
                                <select class="form-control" name="cid">
                                    <?php
                                    foreach ($category_list as $key => $val) {
                                        ?>

                                        <option
                                            value="<?php echo $val['cid']; ?>" <?php if ($question['cid'] == $val['cid']) {
                                            echo 'selected';
                                        } ?> ><?php echo $val['category_name']; ?></option>
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
                                            value="<?php echo $val['lid']; ?>" <?php if ($question['lid'] == $val['lid']) {
                                            echo 'selected';
                                        } ?> ><?php echo $val['level_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="inputEmail"><?php echo $this->lang->line('question'); ?></label>
                                <textarea name="question"
                                          class="form-control"><?php echo $question['question']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail"><?php echo $this->lang->line('description'); ?></label>
                                <textarea name="description"
                                          class="form-control"><?php echo $question['description']; ?></textarea>
                            </div>
                            <?php
                            foreach ($options as $key => $val) {
                                ?>
                                <div class="form-group">
                                    <label
                                        for="inputEmail"><?php echo $this->lang->line('options'); ?> <?php echo($key + 1); ?>
                                        )</label> <br>
                                    <input type="radio" name="score"
                                           value="<?php echo $key; ?>" <?php if ($val['score'] == 1) {
                                        echo 'checked';
                                    } ?> > Select Correct Option
                                    <br><textarea name="option[]"
                                                  class="form-control"><?php echo $val['q_option']; ?></textarea>
                                </div>
                                <?php
                            }
                            ?>
                            <a href="<?php echo site_url("quiz/add_question") . "/" . $quid ?>">
                                <button class="btn btn-default"
                                        type="button">Go Back to Quiz
                                </button>
                            </a>
                            <button class="btn btn-default"
                                    type="submit"><?php echo $this->lang->line('submit'); ?></button>
                        </div>
                    </div>


                </div>
            </form>


            <div class="col-md-3">


                <div class="form-group">
                    <table class="table table-bordered">
                        <tr>
                            <td><?php echo $this->lang->line('no_times_corrected'); ?></td>
                            <td><?php echo $question['no_time_corrected']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $this->lang->line('no_times_incorrected'); ?></td>
                            <td><?php echo $question['no_time_incorrected']; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $this->lang->line('no_times_unattempted'); ?></td>
                            <td><?php echo $question['no_time_unattempted']; ?></td>
                        </tr>

                    </table>

                </div>


            </div>
        </div>
    </div>

</div>

<script src="<?php echo base_url("css/new_material/cdn/confirm.js") ?>"></script>
<script>
    jQuery(document).ready(function () {
        jQuery('#magic_quiz_id').val(localStorage.getItem('latest_id'));
    });
    $(document).ready(function () {
        var after_id;


        $(".add_option_main").click(function () {

            var option_div = $(".option_div");
            var option_array = "";
            $.each(option_div, function (key, value) {
                var current_id = $(this).attr("id");
                var question_count = key + 1;
                option_array += '<option value="' + current_id + '">Question ' + question_count + '</option>';
            });

            $.confirm({
                title: 'Add Option',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>After:</label>' +
                '<select class="name form-control" required >' +
                option_array +
                '</select>' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name = this.$content.find('.name').val();
                            if (!name) {
                                $.alert('provide a valid name');
                                return false;
                            }
                            $.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });

        $(".remove_option").click(function () {
            $.confirm({
                title: 'Remove Option',
                content: 'Do you want to delete this option?',
                buttons: {
                    cancel: function () {

                    },
                    remove: {
                        text: 'remove',
                        btnClass: 'btn-red',
                        keys: ['enter', 'shift'],
                        action: function () {

                        }
                    }
                }
            });
        });
    });
</script>