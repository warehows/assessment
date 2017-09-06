<!--1. Add and Remove option-->
<link href="<?php echo base_url("css/new_material/cdn/jquery-confirm.min.css") ?>" rel="stylesheet">
<?php $option_values = @$_REQUEST['option']?>
<?php $option_values2 = @$_REQUEST['option2']?>
<?php $question = @$_REQUEST['question']?>
<!--1. Add and Remove option-->

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
                <form method="post" action="<?php echo site_url('qbank/new_question_3/' . $nop."?back_url=".$sent_data['back_url']); ?>">

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
                                    <?php echo $this->lang->line('match_the_column'); ?>

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
                                    <textarea name="question" class="form-control"><?php echo $question?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn-success pull-left add_option_main">Add Option</button>
                                    <br>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                                <?php
                                for ($i = 1; $i <= $nop; $i++) {
                                    ?>
                                    <div class="form-group option_div" id="option_div_<?php echo $i ?>">
                                        <label
                                            for="inputEmail"><?php echo $this->lang->line('options'); ?> <?php echo $i; ?>
                                            )</label>
                                        <button type="button" class="btn-danger remove_option" button_id="<?php echo $i?>">Remove Option</button>

                                        <input type="text" name="option[]" class="option" value=""> = <input type="text" name="option2[]" value="">
                                    </div>
                                    <?php
                                }
                                ?>

                                <input id="magic_quiz_id" name="quiz_id" type="hidden" value="">
                                <button class="btn btn-default"
                                        type="submit"><?php echo $this->lang->line('submit'); ?></button>
                                <input type="hidden" id="for_option" name="for_option" value="" />
                                <input type="hidden" id="option_action" name="option_action" value=""/>
                                <input type="hidden" id="question_type" name="question_type" value="question_3"/>

                            </div>
                        </div>


                    </div>
                </form>
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
        var total_questions = $("#total_questions").val();

        $("form").on("click",".add_option_main",function () {

            var option_div = $(".option_div");
            var option_array = "";
            $.each(option_div,function(key,value){
                var current_id = $(this).attr("id");
                var current_id = current_id.replace("option_div_","");
                var question_count = key+1;
                option_array += '<option value="'+current_id+'">Question '+question_count+'</option>';
            });

            $.confirm({
                title: 'Add Option',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>After:</label>' +
                '<select class="question_after_id form-control" required >' +
                option_array +
                '</select>' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var jcontent = this.$content;
                            var question_after_id = jcontent.find('.question_after_id').val();
                            $("#for_option").val(question_after_id);
                            $("#option_action").val("add_option");
                            $("form").submit();
                        }
                    },
                    cancel: function () {

                    },
                },
                onContentReady: function () {

                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });
        $("form").on("click",".remove_option",function (event) {
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
                            var question_id = $(event.target).attr("button_id");
                            var question_id_count = $(document).find(".remove_option").length;

                            if(question_id_count<=1){
                                $.alert("Cannot remove last question.");
                            }
                            else{
                                $("#for_option").val(question_id);
                                $("#option_action").val("delete_option");
                                $("form").submit();
                            }

                        }
                    }
                }
            });
        });
    });
</script>