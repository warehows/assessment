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
                                <h7>Test Title</h7>
                                <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="text" class="mdl-textfield__input " id="new_quiz_name" placeholder="Test Title"/>
                                </div>
                            </form>
                            <button class="mdl-button mdl-js-ripple-effect mdl-js-button" id="select_quiz">Select Quiz</button>
                            <button class="mdl-button mdl-js-ripple-effect mdl-js-button" id="new_quiz_confirm">Next</button>

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
                                    <input type="text" class="mdl-textfield__input " id="startDate"/>
                                    <!--     <input class="c-datepicker-input" /> -->
                                </div>
                                <h7>End Date (Quiz can be attempted before this date)</h7>
                                <div class="mdl-textfield mdl-js-textfield  extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="text" class="mdl-textfield__input" id="endDate"/>
                                </div>
                                <h7>Duration (in min.)</h7>
                                <div class="mdl-textfield mdl-js-textfield   extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="number" class="mdl-textfield__input" id="input_text"/>
                                </div>
                                <h7>Duration (in sec.)</h7>
                                <div class="mdl-textfield mdl-js-textfield   extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="number" class="mdl-textfield__input" id="input_text"/>
                                </div>
                                <h7>Allow Maximum Attempts</h7>
                                <div class="mdl-textfield mdl-js-textfield   extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="number" class="mdl-textfield__input" id="input_text"/>
                                </div>
                                <h7>Minimum Percentage Required to Pass</h7>
                                <div class="mdl-textfield mdl-js-textfield   extrawide">
                                    <label for="input_text" class="mdl-textfield__label"></label>
                                    <input type="number" class="mdl-textfield__input" id="input_text"/>
                                </div>
                                <h7>Allow to view contact answers after submiting quiz</h7>
                                <div class="mdl-layout-spacer"></div>

                                <label for="option-1" class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
                                    <label for="option-1" class="mdl-textfield__label"></label>
                                    <input type="radio" class="mdl-radio__button" id="option-1" name="options"
                                           value="1" checked/>
                                    <span class="mdl-radio__label">Yes</span>
                                </label>

                                <label for="option-2" class="mdl-radio mdl-js-radio mdl-js-ripple-effect">
                                    <input type="radio" class="mdl-radio__button" id="option-2" name="options"
                                           value="2"/>
                                    <span class="mdl-radio__label">No</span>
                                </label>


                            </form>
                        </div>
                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            data-stepper-next>
                            Save & Next
                        </button>
                    </div>
                </li>
                <li class="mdl-step">
            <span class="mdl-step__label">
              <span class="mdl-step__title">
                <span class="mdl-step__title-text">Assigning</span>
            </span>
            </span>

                    <div class="mdl-step__content"></div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            data-stepper-next>
                            Save & Next
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
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
                    targets: [0, 1,2,3],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ]
        });
        var current_step = 0;
        var quiz_lists = $('#quiz_lists').DataTable();
        var question_lists = $('#question_lists').DataTable();
        var latest_id = "";
        $("#last_tr").hide();
        $("#second_table").hide();
        var quiz_selected = "";

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
                console.log(quiz_selected);
            });

        });
        $("#select_quiz").click(function(){
            $("#hide_quiz_lists").toggle();
            $("#selected_quiz_confirm").toggle();
        });
        $("#new_quiz_confirm").click(function (event) {

            var quiz_name = $("#new_quiz_name").val();
            var r = confirm("Are you sure to create " + quiz_name + "?");
            if (r == true) {
                $.ajax({
                    url: "<?php echo site_url('quiz/assessment_insert_quiz/');?>",
                    type: "POST",
                    data: {quiz_name: quiz_name}
                }).done(function (values) {
                    latest_id = values;
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
                            question_lists.row.add(['<input type="checkbox" name="' + value["qid"] + '" class="question_checkbox" />', value["cid"],value["question_type"],value["question"]]).draw();
                        });
                    });

                });

            } else {
                event.preventDefault();
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

//                        $("#last_question_tr").before('<tr class="question_name_tr"><td><input type="checkbox" name="' + value["qid"] + '" class="question_checkbox" /></td><td>' + value["cid"] + '</td><td>' + value["question_type"] + '</td><td>' + value["question"] + '</td></tr>');
                        question_lists.row.add(['<input type="checkbox" name="' + value["qid"] + '" class="question_checkbox" />', value["cid"],value["question_type"],value["question"]]).draw();
                    });
                });
            } else {
                alert("Please Select Quiz");
            }

        });

        $("#questions_selected_confirmed").click(function () {

            var selected_questions = $(".question_checkbox:checkbox:checked");
            var selected_questions_array = new Array();
            $.each(selected_questions, function (key, value) {
                selected_questions_array.push($(value).attr("name"));
            });
            $(".mdl-step").removeClass("is-active");
            $(".mdl-step").eq(2).addClass("is-active");
        });


    });
</script>