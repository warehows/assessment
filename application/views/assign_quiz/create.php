<script src="<?php echo base_url("css/new_material/js/jquery.min.js"); ?>"></script>
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12">
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation"><a href="#step1" data-toggle="tab" aria-controls="step1"
                                                                  role="tab" title="Title"><span class="round-tab"> <i
                                        class="glyphicon glyphicon-text-color"></i></span> </a></li>
                        <li class="disabled" role="presentation"><a href="#step2" data-toggle="tab"
                                                                    aria-controls="step2" role="tab"
                                                                    title="Question Creation"><span
                                    class="round-tab"> <i class="glyphicon glyphicon-pencil"></i></span> </a></li>
                        <li class="disabled" role="presentation"><a href="#step3" data-toggle="tab"
                                                                    aria-controls="step3" role="tab"
                                                                    title="Test Settings"><span class="round-tab"> <i
                                        class="glyphicon glyphicon-cog"></i></span> </a></li>
                        <li class="disabled" role="presentation"><a href="#complete" data-toggle="tab"
                                                                    aria-controls="step1" role="tab"
                                                                    title="Assigning"><span class="round-tab"> <i
                                        class="glyphicon glyphicon-tasks"></i></span> </a></li>
                    </ul>
                </div>
                <form role="form">
                    <div class="tab-content">
                        <div id="step1" class="tab-pane active" role="tabpanel">
                            <div style="padding:10%;padding-top:0px">
                                <h3 class="wizard_title"><strong>Title</strong></h3>

                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Quiz Title"
                                           id="new_quiz_name" inputmode="email">
                                </div>

                                <div class="form-group">
                                    <select class="form-control" id="subject" inputmode="email">
                                        <?php foreach ($category as $key => $value) { ?>

                                            <option
                                                value="<?php echo $value['cid'] ?>"><?php echo $value['category_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <button class="btn btn-primary next-step" type="button" id="new_quiz_confirm">
                                            Save and continue
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="step2" class="tab-pane" role="tabpanel">
                            <div style="padding:10%;padding-top:0px;">
                                <h3 class="wizard_title"><strong>Question Creation</strong></h3>

                                <div class="table-responsive">
                                    <table id="quiz_lists" cellspacing="0" width="100%"
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
                                <p>Paragraph</p>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <button class="btn btn-primary prev-step" type="button">Previous</button>
                                    </li>
                                    <li>
                                        <button class="btn btn-primary next-step" type="button">NEXT</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="step3" class="tab-pane" role="tabpanel">
                            <div style="padding:10%;padding-top:0px;">
                                <h3 class="wizard_title"><strong>Test Settings</strong></h3>

                                <div class="form-group">
                                    <label class="control-label" for="start_date">Start Date (Quiz can be attempted
                                        after this date. YYYY-MM-DD HH:II:SS ) </label>
                                    <input class="form-control" type="text" name="start_date" required=""
                                           placeholder="Start Date (Quiz can be attempted after this date. YYYY-MM-DD HH:II:SS )"
                                           inputmode="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="end_date">End Date (Quiz can be attempted before
                                        this date. eg. 2017-12-31 23:59:00 ) </label>
                                    <input class="form-control" type="text" name="end_date" required=""
                                           placeholder="End Date (Quiz can be attempted before this date. eg. 2017-12-31 23:59:00 )"
                                           inputmode="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="duration">Duration (in min.) </label>
                                    <input class="form-control" type="text" name="duration" required=""
                                           placeholder="Duration (in min.)" inputmode="email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="view_answer">Allow to view correct answers after
                                        submitting quiz </label>

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
                                        <button class="btn btn-primary prev-step" type="button">Previous</button>
                                    </li>
                                    <li>
                                        <button class="btn btn-primary btn-info-full next-step" type="button">Save and
                                            continue
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="complete" class="tab-pane" role="tabpanel">
                            <div style="padding:10%;padding-top:0px;">
                                <h3 class="wizard_title"><strong>Assigning</strong></h3>

                                <p>Paragraph </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        var quiz_lists = $('#quiz_lists').DataTable();
        $("#new_quiz_confirm").click(function (event) {
            var subject = $("#subject").val();
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


    });
</script>

