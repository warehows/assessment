<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<style>
    a {
        text-decoration: none;
        color: black;
    }
</style>

<div class="wrapper">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <?php
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                ?>

                <div class="form-group">
                    <div class="form-label">Content Type</div>
                    <select id="content_type" class="form-control">
                        <option value="lesson">Lesson</option>
                        <option value="quiz">Quiz</option>
                    </select>
                </div>

                <form action="<?php echo site_url() ?>/lessons/index_actions" method="POST" id="lesson_type">
                    <h2>Lesson Bank</h2>
                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="import" name="submit" value="import">Import to My Lessons
                    </button>

                    <table id="lesson_lists" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="3px"></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Grade</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($all_lessons as $key => $value) { ?>
                            <tr style="cursor:pointer">
                                <td class="input_row"><input type="checkbox" class="selected_lesson_class"
                                                             name="selected_lesson[]"
                                                             value="<?php echo $value['id'] ?>"/></td>
                                <td class="lesson_row"><?php echo $value['lesson_name'] ?></td>
                                <td class="lesson_row"><?php print_r($subject_model->where('cid', $value['subject_id'])[0]['category_name']); ?></td>
                                <td class="lesson_row"><?php echo $value['level_id'] ?></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </form>
                <?php $shared_quizzes = $this->assign_model->where("shared",1); ?>
<!--                --><?php //print_r($shared_quizzes); ?>
                <form action="<?php echo site_url() ?>/lessonbank/actions" method="POST" id="quiz_type">
                    <h2>Lesson Bank</h2>
                    <button class="btn btn-primary" id="quiz_import" name="submit" value="import">Import to My Lessons
                    </button>


                    <table id="quiz_lists" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="3px"></th>
                            <th>Quiz Name</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Author</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($shared_quizzes as $quiz_key => $quiz_value) { ?>
                            <?php $user_information = $this->user_model->get_user($quiz_value['author']); ?>
                            <?php $subject_information = $this->subjects_model->where("cid",$quiz_value['cid']); ?>
                            <?php $grade_information = $this->grades_model->where("lid",$quiz_value['lid']); ?>
                            <tr style="cursor:pointer">
                                <td class="input_row"><input type="checkbox" class="selected_quiz"
                                                             name="selected_quiz[]"
                                                             value="<?php echo $quiz_value['quid'] ?>"/></td>
                                <td class="quiz_row" data-href='<?php echo base_url('index.php/quiz/preview/'.$quiz_value['quid'])?>'><?php echo $quiz_value['quiz_name'] ?></td>
                                <td class="quiz_row" data-href='<?php echo base_url('index.php/quiz/preview/'.$quiz_value['quid'])?>'><?php echo $subject_information[0]['category_name'] ?></td>
                                <td class="quiz_row" data-href='<?php echo base_url('index.php/quiz/preview/'.$quiz_value['quid'])?>'><?php echo $grade_information[0]['level_name'] ?></td>
                                <td class="quiz_row" data-href='<?php echo base_url('index.php/quiz/preview/'.$quiz_value['quid'])?>'><?php echo $user_information['first_name'] ?> <?php echo $user_information['last_name'] ?></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#lesson_lists").DataTable();
    $("#quiz_lists").DataTable();
    $("#edit").hide();
    $("#view").hide();
    $("#import").hide();
    $("#remove").hide();
    $("#delete").hide();
    $("#assign").hide();
    $("#quiz_import").hide();

    $("#quiz_type").hide();
    $(document).on('click', ".quiz_row", function () {
        window.location = $(this).data("href");
    });
    $("#content_type").change(function () {
        var content_value = $(this).val();
        if (content_value == "quiz") {
            $("#quiz_type").show();
            $("#lesson_type").hide();
        } else {
            $("#quiz_type").hide();
            $("#lesson_type").show();
        }
    });
    $(document).on('click', ".selected_quiz", function () {
        selected_count = $(document).find('.selected_quiz:checked').length;
        if (selected_count == 1) {
            $("#quiz_import").show();
        } else if (selected_count == 0) {
            $("#quiz_import").hide();
        }
        else if (selected_count >= 1) {
            $("#quiz_import").show();
        } else {
            $("#quiz_import").hide();
        }
    });

    $(document).on('click', ".lesson_row", function () {
        $(this).siblings(".input_row").eq(0).find(".selected_lesson_class").prop('checked', true);
        $("#view").click();
    });
    $(document).on('click', ".selected_lesson_class", function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#import").show();
            $("#remove").show();
            $("#view").show();
            $("#delete").show();
            $("#assign").show();
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#delete").hide();
            $("#assign").hide();
            $("#import").hide();
            $("#remove").hide();
            $("#view").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#delete").show();
            $("#import").show();
            $("#remove").show();
            $("#assign").show();
            $("#view").hide();
        } else {
            $("#edit").hide();
            $("#view").hide();
            $("#import").hide();
            $("#remove").hide();
            $("#assign").show();
            $("#delete").show();
        }
    });
</script>