
<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12">
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation"> <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Title"><span class="round-tab"> <i class="glyphicon glyphicon-text-color"></i></span> </a></li>
                        <li class="disabled" role="presentation"> <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Question Creation"><span class="round-tab"> <i class="glyphicon glyphicon-pencil"></i></span> </a></li>
                        <li class="disabled" role="presentation"> <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Test Settings"><span class="round-tab"> <i class="glyphicon glyphicon-cog"></i></span> </a></li>
                        <li class="disabled" role="presentation"> <a href="#complete" data-toggle="tab" aria-controls="step1" role="tab" title="Assigning"><span class="round-tab"> <i class="glyphicon glyphicon-tasks"></i></span> </a></li>
                    </ul>
                </div>
                <form role="form">
                    <div class="tab-content">
                        <div id="step1" class="tab-pane active" role="tabpanel">
                            <div style="padding:10%;padding-top:0px">
                                <h3 class="wizard_title"><strong>Title</strong> </h3>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Quiz Title" inputmode="email">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="subject_id">
                                        <?php foreach ($all_subjects as $key => $value) { ?>
                                            <option
                                                value="<?php echo $value['cid'] ?>"><?php echo $value['category_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                </div>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <button class="btn btn-primary next-step" type="button">Save and continue </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="step2" class="tab-pane active" role="tabpanel">
                            <div style="padding:10%;padding-top:0px;">
                                <h3 class="wizard_title"><strong>Question Creation</strong> </h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Column 1</th>
                                            <th>Column 2</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Cell 1</td>
                                            <td>Cell 2</td>
                                        </tr>
                                        <tr>
                                            <td>Cell 3</td>
                                            <td>Cell 4</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>Paragraph</p>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <button class="btn btn-primary prev-step" type="button">Previous </button>
                                    </li>
                                    <li>
                                        <button class="btn btn-primary next-step" type="button">NEXT </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="step3" class="tab-pane" role="tabpanel">
                            <div style="padding:10%;padding-top:0px;">
                                <h3 class="wizard_title"><strong>Test Settings</strong> </h3>
                                <div class="form-group">
                                    <label class="control-label" for="start_date">Start Date (Quiz can be attempted after this date. YYYY-MM-DD HH:II:SS ) </label>
                                    <input class="form-control" type="text" name="start_date" required="" placeholder="Start Date (Quiz can be attempted after this date. YYYY-MM-DD HH:II:SS )"
                                           inputmode="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="end_date">End Date (Quiz can be attempted before this date. eg. 2017-12-31 23:59:00 ) </label>
                                    <input class="form-control" type="text" name="end_date" required="" placeholder="End Date (Quiz can be attempted before this date. eg. 2017-12-31 23:59:00 )"
                                           inputmode="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="duration">Duration (in min.) </label>
                                    <input class="form-control" type="text" name="duration" required="" placeholder="Duration (in min.)" inputmode="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="view_answer">Allow to view correct answers after submitting quiz </label>
                                    <div class="radio">
                                        <label class="control-label">
                                            <input type="radio" name="view_answer">Yes</label>
                                    </div>
                                    <div class="radio">
                                        <label class="control-label">
                                            <input type="radio" name="view_answer" checked="">No</label>
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <button class="btn btn-primary prev-step" type="button">Previous </button>
                                    </li>
                                    <li>
                                        <button class="btn btn-primary btn-info-full next-step" type="button">Save and continue </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="complete" class="tab-pane" role="tabpanel">
                            <div style="padding:10%;padding-top:0px;">
                                <h3 class="wizard_title"><strong>Assigning</strong> </h3>
                                <p>Paragraph </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--
<script type="text/javascript">
    var jQuery_1_12_4 = $.noConflict(true);
</script>

<?php /*$this->load->helper('url'); */?>
<link rel="stylesheet" href="<?php /*echo base_url(); */?>js/jstree/dist/themes/default/style.min.css"/>
<script src="<?php /*echo base_url(); */?>js/jstree/dist/jstree.min.js"></script>

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
<!--<script src="--><?php /*//echo base_url('css/material/js/material-datetime-picker.js'); */?><!--"></script>-->
<script src="https://unpkg.com/babel-polyfill@6.2.0/dist/polyfill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rome/2.1.22/rome.standalone.js"></script>


<script>
    $(document).ready(function () {
        var all_users = <?php /*echo json_encode($all_users);*/?>;
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
            url: "<?php /*echo site_url('assign/assessment_quiz_list/'); */?>",
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
                        url: "<?php /*echo site_url('quiz/assessment_insert_quiz/');*/?>",
                        type: "POST",
                        data: {quiz_name: quiz_name, cid: subject}
                    }).done(function (values) {
                        latest_id = values;
                        $.ajax({
                            url: "<?php /*echo site_url('assign/assessment_quiz_list/'); */?>",
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
                            url: "<?php /*echo site_url('assign/get_all_questions');*/?>",
                            type: "POST",
                        }).done(function (values) {
                            var all_quizzes = JSON.parse(values);
                            $("#second_table").show();
                            quiz_selected = latest_id;
                            $(".mdl-step").removeClass("is-active");
                            $(".mdl-step").eq(1).addClass("is-active");
                            $.each(all_quizzes, function (key, value) {
                                question_lists.row.add(['<input type="checkbox" name="' + value["qid"] + '" class="question_checkbox" />', value["cid"], value["question_type"], value["question"]]).draw();
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
                    url: "<?php /*echo site_url('assign/get_all_questions');*/?>",
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

            var selected_questions = $(".question_checkbox:checkbox:checked");
            var selected_questions_array = new Array();
            $.each(selected_questions, function (key, value) {
                selected_questions_array.push($(value).attr("name"));
            });
            $(".mdl-step").removeClass("is-active");
            $(".mdl-step").eq(2).addClass("is-active");

            $.ajax({
                url: "<?php /*echo site_url('assign/get_quiz');*/?>",
                type: "POST",
                data: {quid: quiz_selected}
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
                start_date: start_date,
                end_date: end_date,
                duration: duration,
                maximum_attempts: maximum_attempts,
                pass_percentage: pass_percentage,
                view_answer: view_answer
            };
            $.ajax({
                url: "<?php /*echo site_url('assign/get_all_level');*/?>",
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


    });
</script>