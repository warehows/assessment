<script type="text/javascript">
    var jQuery_1_12_4 = $.noConflict(true);
</script>

<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>
<script src="<?php echo base_url(); ?>js/jstree/dist/jstree.min.js"></script>
<div class="mdl-stepper-demo">

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <!-- markup -->
            <ul class="mdl-stepper mdl-stepper--horizontal " id="demo-stepper-non-linear">
                <li class="mdl-step">
                            <span class="mdl-step__label">
                                <span class="mdl-step__title">
                                    <span class="mdl-step__title-text">Title</span>
                                </span>
                            </span>

                    <div class="mdl-step__content">

                        <div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                            <form>
                                <h7 id="test_title_label">Test Title</h7>
                                <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="text" class="mdl-textfield__input " id="new_quiz_name"
                                           placeholder="Test Title"/>
                                </div>
                                <h7>Subject</h7>
                                <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <select class="mdl-textfield__input " id="subject">
                                        <?php foreach ($category as $key => $value) { ?>

                                            <option
                                                value="<?php echo $value['cid'] ?>"><?php echo $value['category_name'] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </form>
                            <button class="mdl-button mdl-js-ripple-effect mdl-js-button" id="select_quiz">Select Quiz
                            </button>
                            <button class="mdl-button mdl-js-ripple-effect mdl-js-button" id="new_quiz_confirm">Next
                            </button>

                            <!-- datatable -->
                            <table id="quiz_lists" class="mdl-data-table" cellspacing="0" width="100%"
                                   align="center">
                                <thead>
                                <tr>
                                    <th>Quiz Name</th>
                                    <th>Select</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr id="last_tr">
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Quiz Name</th>
                                    <th>Select</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            id="selected_quiz_confirm"
                            data-stepper-next>
                            Done
                        </button>
                    </div>
                </li>
                <li class="mdl-step">
                    <span class="mdl-step__label">
                        <span class="mdl-step__title">
                            <span class="mdl-step__title-text">Question Creation</span>
                        </span>
                    </span>

                    <div class="mdl-step__content">
                        <!-- datatable -->
                        <table id="question_lists" class="mdl-data-table" cellspacing="0" width="100%"
                               align="center">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>Subject</th>
                                <th>Question Type</th>
                                <th>Question</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr id="last_question_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Select</th>
                                <th>Subject</th>
                                <th>Question Type</th>
                                <th>Question</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            data-stepper-next
                            id="questions_selected_confirmed"
                            >
                            Done
                        </button>
                    </div>
                </li>
                <li class="mdl-step">
                    <span class="mdl-step__label">
                        <span class="mdl-step__title">
                            <span class="mdl-step__title-text">Test Settings</span>
                        </span>
                    </span>

                    <div class="mdl-step__content">
                        <div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">

                            <form>

                                <h7>Start Date (Quiz can be attempted after this date)</h7>
                                <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="text" class="mdl-textfield__input" value="" id="start_date"/>
                                    <!--     <input class="c-datepicker-input" /> -->
                                </div>
                                <h7>End Date (Quiz can be attempted before this date)</h7>
                                <div class="mdl-textfield mdl-js-textfield  extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="text" class="mdl-textfield__input" id="end_date"/>
                                </div>
                                <h7>Duration (in min.)</h7>
                                <div class="mdl-textfield mdl-js-textfield   extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="number" class="mdl-textfield__input" id="duration"/>
                                </div>
                                <h7>Allow Maximum Attempts</h7>
                                <div class="mdl-textfield mdl-js-textfield   extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="number" class="mdl-textfield__input" id="maximum_attempts"/>
                                </div>
                                <h7>Minimum Percentage Required to Pass</h7>
                                <div class="mdl-textfield mdl-js-textfield   extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="number" class="mdl-textfield__input" id="pass_percentage"/>
                                </div>
                                <h7>Allow to view contact answers after submiting quiz</h7>
                                <div class="mdl-layout-spacer"></div>

                                <label for="option-1" class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
                                    <input type="radio" class="mdl-radio__button" id="option-1" name="view_answer"
                                           value="0"/>
                                    <span class="mdl-radio__label">No</span>
                                </label>
                                <label for="option-2" class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
                                    <label for="option-1" class="mdl-textfield__label"></label>
                                    <input type="radio" class="mdl-radio__button" id="option-2" name="view_answer"
                                           value="1"/>
                                    <span class="mdl-radio__label">Yes</span>
                                </label>


                            </form>
                        </div>
                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            data-stepper-next
                            id="settings_confirmed">
                            Save & Next
                        </button>
                    </div>
                </li>
                <li class="mdl-step">
                    <span class="mdl-step__label">
                        <span class="mdl-step__title"><span class="mdl-step__title-text">Assigning</span></span>
                    </span>

                    <div class="mdl-step__content">
                        <?php $group = $this->user_model->group_list(); ?>
                        <div class="form-group">
                            <label>Assign</label> <br>
                            <?php
                            foreach ($group as $key => $val) {
                                ?>

                                <input class="gids" type="checkbox" name="gids[]"
                                       value="<?php echo $val['gid']; ?>" <?php if ($key == 0) {
                                    echo 'checked';
                                } ?> > <?php echo $val['group_name']; ?> &nbsp;&nbsp;&nbsp;
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="mdl-step__actions">
                        <button id="quiz_assign_group"
                                class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                                data-stepper-next>
                            Save & Next
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <input type="hidden" id="latest-id">
</div>
<script>
    $(document).ready(function () {
//            Variable initiation

    });
</script>
<script>
    (function () {
        // Stepper non-linear demonstration
        var demoNonLinear = function (e) {
            var element = document.querySelector('.mdl-stepper#demo-stepper-non-linear');

            if (!element) return;

            var stepper = element.MaterialStepper;
            var steps = element.querySelectorAll('.mdl-step');
            var step;

            for (var i = 0; i < steps.length; i++) {
                step = steps[i];
                step.addEventListener('onstepnext', function (e) {
                    stepper.next();
                });
            }
            element.addEventListener('onsteppercomplete', function (e) {
                var toast = document.querySelector('#snackbar-stepper-complete');

                if (!toast) return false;

                toast.MaterialSnackbar.showSnackbar({
                    message: 'Stepper non-linear are completed',
                    timeout: 4000,
                    actionText: 'Ok'
                });
            });
        };
        window.addEventListener('load', demoNonLinear);
    })();


</script>
<!--<script src="--><?php //echo base_url('css/material/js/material-datetime-picker.js'); ?><!--"></script>-->
<script src="https://unpkg.com/babel-polyfill@6.2.0/dist/polyfill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rome/2.1.22/rome.standalone.js"></script>


<script>
    $(document).ready(function () {
        var all_users = <?php echo json_encode($all_users);?>;
        var all_users_array = new Array();
        var all_users_value = new Array();
        $.each(all_users,function(all_user_key,all_user_value){
            all_users_value = {};
            all_users_value[all_user_value.uid] = new Array();
        });
        console.log(all_users_array);
        var subject = $("#subject").val();
        $('#last_question_tr').hide();
        $('#quiz_lists').wrap('<div id="hide_quiz_lists" style="display:none"/>');
        $("#selected_quiz_confirm").hide();
        $('#quiz_lists').DataTable({
            columnDefs: [
                {
                    targets: [0, 1],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ]
        });
        $('#question_lists').DataTable({
            columnDefs: [
                {
                    targets: [0, 1, 2, 3],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ]
        });
        var quiz_lists = $('#quiz_lists').DataTable();
        var question_lists = $('#question_lists').DataTable();
        var latest_id = "";
        $("#last_tr").hide();
        $("#second_table").hide();
        var quiz_selected = "";
        $("#subject").change(function () {
            subject = $(this).val();
        });
        $.ajax({
            url: "<?php echo site_url('assign/assessment_quiz_list/'); ?>",
        }).done(function (value) {
            var quiz_value = JSON.parse(value);
            $.each(quiz_value, function (key, key_value) {
                quiz_lists.row.add([key_value["quiz_name"], '<input type="button" id="selected_' + key_value["quid"] + '" value="Select" class="selected_quiz">']).draw();
            });

            $(".selected_quiz").click(function () {
                quiz_selected = $(this).attr("id");
                quiz_selected = quiz_selected.replace("selected_", "");
            });

        });
        quiz_lists.on('draw.dt', function () {
            $(".selected_quiz").click(function () {
                quiz_selected = $(this).attr("id");
                quiz_selected = quiz_selected.replace("selected_", "");
                $("tr[role='row']").css("background-color", "");
                $(this).parent().parent().css("background-color", "rgb(240,240,240)");
            });

        });
        $("#select_quiz").click(function () {
            $("#hide_quiz_lists").toggle();
            $("#selected_quiz_confirm").toggle();
            $("#new_quiz_confirm").toggle();
            $("#new_quiz_name").toggle();
            $("#test_title_label").toggle();
        });
        $("#new_quiz_confirm").click(function (event) {

            var quiz_name = $("#new_quiz_name").val();
            if (quiz_name != "") {
                var r = confirm("Are you sure to create " + quiz_name + "?");
                if (r == true) {
                    $.ajax({
                        url: "<?php echo site_url('quiz/assessment_insert_quiz/');?>",
                        type: "POST",
                        data: {quiz_name: quiz_name, cid: subject}
                    }).done(function (values) {
                        latest_id = values;
                        $('#latest-id').val(latest_id);
                        $.ajax({
                            url: "<?php echo site_url('assign/assessment_quiz_list/'); ?>",
                        }).done(function (value) {
                            var quiz_value = JSON.parse(value);
                            quiz_lists.clear().draw();
                            $.each(quiz_value, function (key, key_value) {
                                quiz_lists.row.add([key_value["quiz_name"], '<input type="button" id="selected_' + key_value["quid"] + '" class="selected_quiz" value="Select">']).draw();
                            });
                            $("#cancel_new_quiz").hide();

                            $(".selected_quiz").click(function () {
                                quiz_selected = $(this).attr("id");
                                quiz_selected = quiz_selected.replace("selected_", "");
                            });

                        });

                        $.ajax({
                            url: "<?php echo site_url('assign/get_all_questions');?>",
                            type: "POST",
                        }).done(function (values) {
                            var all_quizzes = JSON.parse(values);
                            $("#second_table").show();
                            quiz_selected = latest_id;
                            $(".mdl-step").removeClass("is-active");
                            $(".mdl-step").eq(1).addClass("is-active");
                            $.each(all_quizzes, function (key, value) {
                                question_lists.row.add(['<input type="checkbox" name="' + value["qid"] + '" value="' + value["qid"] + '" class="question_checkbox" />', value["cid"], value["question_type"], value["question"]]).draw();
                            });
                        });

                    });

                } else {
                    event.preventDefault();
                }
            }
            else {
                alert("Test tile is required");
                $("#new_quiz_name").focus();
            }

        });

        $("#cancel_new_quiz").click(function () {
            $("#new_quiz_confirm").hide();
            $("#new_quiz_name").hide();
            $("#cancel_new_quiz").hide();
        });

        $("#selected_quiz_confirm").click(function () {
            if (quiz_selected) {
                $.ajax({
                    url: "<?php echo site_url('assign/get_all_questions');?>",
                    type: "POST",
                }).done(function (values) {
                    var all_quizzes = JSON.parse(values);
                    $("#second_table").show();
                    $.each(all_quizzes, function (key, value) {
                        $(".mdl-step").removeClass("is-active");
                        $(".mdl-step").eq(1).addClass("is-active");
                        question_lists.row.add(['<input type="checkbox" name="' + value["qid"] + '" class="question_checkbox" />', value["cid"], value["question_type"], value["question"]]).draw();
                    });
                });
            } else {
                alert("Please Select Quiz");
            }

        });

        $("#questions_selected_confirmed").click(function () {


            var question_id = $('.question_checkbox:checked').serialize();

            var quid = $('#latest-id').val();
            $.ajax({
                url: "<?php echo site_url('quiz/addQuestionsToQuiz');?>",
                type: "POST",
                data: {quid:quid,question_id:question_id},
            }).done(function (values) {

            });



            var selected_questions = $(".question_checkbox:checkbox:checked");
            var selected_questions_array = new Array();
            $.each(selected_questions, function (key, value) {
                selected_questions_array.push($(value).attr("name"));
            });
            $(".mdl-step").removeClass("is-active");
            $(".mdl-step").eq(2).addClass("is-active");

            $.ajax({
                url: "<?php echo site_url('assign/get_quiz');?>",
                type: "POST",
                data: {quid: quid,}
            }).done(function (values) {
                values = JSON.parse(values);
                $("#start_date").val(values['start_date']);
                $("#end_date").val(values['start_date']);
                $("#duration").val(values['duration']);
                $("#maximum_attempts").val(values['maximum_attempts']);
                $("#pass_percentage").val(values['pass_percentage']);
                $("input[name='view_answer']").eq(values['view_answer']).attr("checked", "");
                $("input[name='view_answer']").eq(values['view_answer']).parents("label").addClass("is-checked");
            });

        });
        $("#settings_confirmed").click(function () {
            var settings_array = new Array();

            var start_date;
            var end_date;
            var duration;
            var maximum_attempts;
            var pass_percentage;
            var question_id = $('.question_checkbox:checked').serialize();
            start_date = $("#start_date").val();
            end_date = $("#end_date").val();
            duration = $("#duration").val();
            maximum_attempts = $("#maximum_attempts").val();
            pass_percentage = $("#pass_percentage").val();
            var view_answer = "";
            $.each($("input[name='view_answer']"), function (key, value) {
                if ($(value).is(":checked")) {
                    view_answer = $(value).attr("value");
                }
            });
            settings_array = {
                quid: quiz_selected,
                question_id: question_id,
                start_date: start_date,
                end_date: end_date,
                duration: duration,
                maximum_attempts: maximum_attempts,
                pass_percentage: pass_percentage,
                view_answer: view_answer
            };
            $.ajax({
                url: "<?php echo site_url('quiz/addSettingsToQuiz');?>",
                type: "POST",
                data: settings_array,
            }).done(function (values) {
                console.log(values);
            });


            $.ajax({
                url: "<?php echo site_url('assign/get_all_level');?>",
                type: "POST",
            }).done(function (values) {
                var all_data = JSON.parse(values);
                var all_level = all_data['level'];
                var all_group = all_data['group'];
                var all_class_students = all_data['class_students'];
                var grade_array = new Array();
                var grade_array_value = new Array();
                console.log(all_class_students);
                var text = "text";

                $.each(all_level,function(x_key,x){
                    x = x['level_name'];
                    var grade_group_value = new Array();
                    grade_array_value = {
                        text: "Grade " + x, id: x, children: Array()
                    };
                    $.each(all_group,function(group_key,group_value){
                        var grade_class_students_value = new Array();
                        grade_group_value = {
                            text: group_value['group_name'], children: Array()
                        };

                        $.each(all_class_students,function(student_key,student_value){

                            grade_class_students_value = {
                                text:student_value['uid'],icon:"jstree-file"
                            };
                            grade_group_value['children'].push(grade_class_students_value);
                        });
                        grade_array_value['children'].push(grade_group_value);


                    });

                    grade_array.push(grade_array_value);
                });

//            Tree
                $('#html').jstree();
                $('#data').jstree({
                    "plugins": ["checkbox"],
                    'core': {
                        'data': grade_array
                    }
                });
            });
        });

        //add group id to quiz
        $("#quiz_assign_group").click(function () {
            var gids = $('.gids:checked').serialize();
            var quid = $('#latest-id').val();
            $.ajax({
                url: "<?php echo site_url('quiz/addGroupToQuiz');?>",
                type: "POST",
                data: {gids:gids,quid:quid},
            }).done(function (values) {

            });

        });



    });
</script>