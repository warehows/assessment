<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jstree/dist/jstree.min.js"></script>
<style>
    #data {
        border: 1px solid black;
        padding: 10px;
    }

    .mdl-step__content {
        display: block;
    }
</style>

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

                        <div
                            class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">

                            <table>
                                <tr>
                                    <th>

                                    </th>
                                    <th>

                                    </th>
                                </tr>

                                <tr id="last_tr">
                                    <td>
                                        <button id="add_new_quiz" type="button">Add New Quiz</button>
                                    </td>
                                    <td>
                                        <input id="new_quiz_name" name="quiz_name" placeholder="Quiz Name"/>
                                        <input type="button" id="new_quiz_confirm" value="Confirm"/>
                                        <input type="button" id="cancel_new_quiz" value="Cancel"/>
                                    </td>
                                </tr>

                            </table>
                            <input type="button" id="selected_quiz_confirm" value="Done"/>

                            <table id="second_table">
                                <tr>
                                    <th>
                                        Select
                                    </th>
                                    <th>
                                        Subject
                                    </th>
                                    <th>
                                        Question Type
                                    </th>
                                    <th>
                                        Question
                                    </th>
                                </tr>

                                <tr id="last_question_tr">
                                    <td>
                                        <input type="button" value="Done" id="questions_selected_confirmed"/>
                                    </td>
                                </tr>

                            </table>

                        </div>

                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            data-stepper-next>
                            Next
                        </button>
                    </div>
                </li>

                <li class="mdl-step">
                            <span class="mdl-step__label">
                              <span class="mdl-step__title">
                                <span class="mdl-step__title-text">Section and Test Creation</span>
                            </span>
                            </span>

                    <div class="mdl-step__content">
                        <button class="mdl-button mdl-js-ripple-effect mdl-js-button ">Create Section</button>


                    </div>
                    <div class="mdl-step__actions">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                                data-stepper-next>
                            Save & Next
                        </button>
                    </div>
                </li>

            </ul>
        </div>
    </div>

</div>

<?php
$logged_in = $this->session->userdata('logged_in');
?>
<!--    <h1>Assign Quiz</h1>-->
<!---->
<!--    <div id="data" class="demo"></div>-->

<script>
    $(document).ready(function () {
//            Variable initiation
        var grade_array_count = 6;
        var grade_array = new Array();
        var grade_array_value = new Array();
        var text = "text";
        for (var x = 1; x <= grade_array_count; x++) {
            grade_array_value = {
                text: "Grade " + x, id: x, children: Array(
                    {
                        text: "Diamond", children: Array(
                        {text: "Resty Morancil", icon: "jstree-file"},
                        {text: "Jan Ray Monteros", icon: "jstree-file"},
                        {text: "Joeven Cerveza", icon: "jstree-file"}
                    )
                    },
                    {
                        text: "Gold", children: Array(
                        {text: "Resty Morancil", icon: "jstree-file"},
                        {text: "Jan Ray Monteros", icon: "jstree-file"},
                        {text: "Joeven Cerveza", icon: "jstree-file"}
                    )
                    },
                    {
                        text: "Silver", children: Array(
                        {text: "Resty Morancil", icon: "jstree-file"},
                        {text: "Jan Ray Monteros", icon: "jstree-file"},
                        {text: "Joeven Cerveza", icon: "jstree-file"}
                    )
                    },
                    {
                        text: "Bronze", children: Array(
                        {text: "Resty Morancil", icon: "jstree-file"},
                        {text: "Jan Ray Monteros", icon: "jstree-file"},
                        {text: "Joeven Cerveza", icon: "jstree-file"}
                    )
                    })
            };
            grade_array.push(grade_array_value);
        }

//            Tree
        $('#html').jstree();
        $('#data').jstree({
            "plugins": ["checkbox"],
            'core': {
                'data': grade_array
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#second_table").hide();
        var quiz_selected = "";

        $.ajax({
            url: "<?php echo site_url('assign/assessment_quiz_list/'); ?>",
        }).done(function (value) {
            var quiz_value = JSON.parse(value);
            $.each(quiz_value, function (key, key_value) {
//                console.log(key_value["quid"]);
                $("#last_tr").before('<tr class="quiz_name_tr"><td>' + key_value["quiz_name"] + '</td><td><input type="button" id="selected_' + key_value["quid"] + '" value="Select" class="selected_quiz"></td></tr>');
            });


            $(".selected_quiz").click(function () {
                quiz_selected = $(this).attr("id");
                quiz_selected = quiz_selected.replace("selected_", "");

            });
        });
        $("#new_quiz_name").hide();
        $("#new_quiz_confirm").hide();
        $("#cancel_new_quiz").hide();
        $("#add_new_quiz").click(function () {
            $("#new_quiz_confirm").show();
            $("#new_quiz_name").show();
            $("#cancel_new_quiz").show();
        });
        $("#new_quiz_confirm").click(function (event) {

            var quiz_name = $("#new_quiz_name").val();
            var r = confirm("Are you sure to create " + quiz_name + "?");
            if (r == true) {
                alert(quiz_selected);
                $.ajax({
                    url: "<?php echo site_url('quiz/assessment_insert_quiz/');?>",
                    type: "POST",
                    data: {quiz_name: quiz_name}
                }).done(function (values) {
                    $.ajax({
                        url: "<?php echo site_url('assign/assessment_quiz_list/'); ?>",
                    }).done(function (value) {
                        quiz_selected = quiz_selected;

                        var quiz_value = JSON.parse(value);
                        $(".quiz_name_tr").remove();
                        $.each(quiz_value, function (key, key_value) {
                            $("#last_tr").before('<tr class="quiz_name_tr"><td>' + key_value["quiz_name"] + '</td><td><input type="button" id="selected_' + key_value["quid"] + '" class="selected_quiz" value="Select"></td></tr>');
                        });
                        $("#new_quiz_confirm").hide();
                        $("#new_quiz_name").hide();
                        $("#cancel_new_quiz").hide();

                        $(".selected_quiz").click(function () {
                            quiz_selected = $(this).attr("id");
                            quiz_selected = quiz_selected.replace("selected_", "");

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
            $.ajax({
                url: "<?php echo site_url('assign/get_all_questions');?>",
                type: "POST",
            }).done(function (values) {
                var all_quizzes = JSON.parse(values);
                $("#second_table").show();
                $.each(all_quizzes, function (key, value) {
                    $("#last_question_tr").before('<tr class="question_name_tr"><td><input type="checkbox" name="' + value["qid"] + '" class="question_checkbox" /></td><td>' + value["cid"] + '</td><td>' + value["question_type"] + '</td><td>' + value["question"] + '</td></tr>');
                });
            });
        });

        $("#questions_selected_confirmed").click(function () {

            var selected_questions = $(".question_checkbox:checkbox:checked");
            var selected_questions_array = new Array();
            $.each(selected_questions, function (key, value) {
                selected_questions_array.push($(value).attr("name"));
            });

        });


    });
</script>