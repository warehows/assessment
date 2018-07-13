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