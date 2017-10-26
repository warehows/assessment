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
            <div class="col-lg-12 col-md-12col-sm-12">
                <h2>Lesson Bank</h2>
                <div class="form-container">
                    <select id="list_type" class="form-control">
                        <option value="lesson_type" id="lesson_type">Lessons</option>
                        <option value="quiz_type" id="quiz_type">Quiz</option>
                    </select>
                </div>

                <form action="<?php echo site_url() ?>/lessons/index_actions" method="POST" id="lesson_form">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="remove" name="submit" value="remove">Unshare</button>

                    <table id="lesson_lists" class="display responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Grade</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($all_lessons as $key => $value) { ?>
<!--                            --><?php //print_r($value)?>
                            <tr style="cursor:pointer">
                                <td class="input_row"><input type="checkbox" class="selected_lesson_class" name="selected_lesson[]"
                                           value="<?php echo $value['id'] ?>"/></td>
                                <td class="lesson_row" data-href='<?php echo base_url('index.php/quiz/preview/'.$value['id'])?>'><?php echo $value['lesson_name'] ?></td>
                                <td class="lesson_row" data-href='<?php echo base_url('index.php/quiz/preview/'.$value['id'])?>'><?php print_r($subject_model->where('cid', $value['subject_id'])[0]['category_name']); ?></td>
                                <td class="lesson_row" data-href='<?php echo base_url('index.php/quiz/preview/'.$value['id'])?>'><?php echo $value['level_id'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </form>
                <form action="<?php echo site_url() ?>/assign/actions" method="POST" id="quiz_form">
<!--                    <button class="btn btn-primary" id="quiz_view" name="submit" value="view">View</button>-->
                    <button class="btn btn-primary" id="quiz_remove" name="submit" value="remove">Unshare</button>
                    <table id="quiz_lists" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Quiz Name</th>
                            <th>Type</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_quizzes as $key => $value) { ?>
                            <tr>
                                <td class="input_row"><input type="checkbox" class="selected_quiz_class"
                                                             name="selected_quiz[]"
                                                             value="<?php echo $value['quid'] ?>"/></td>
                                <td class="lesson_row"><?php echo $value['quiz_name'] ?></td>
                                <td class="lesson_row">Quiz</td>
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
    $("#quiz_form").hide();
    $("#edit").hide();
    $("#view").hide();
    $("#import").hide();
    $("#remove").hide();
    $("#delete").hide();
    $("#assign").hide();

    $(document).on('click', ".lesson_row", function () {
        window.location = $(this).data("href");
    });

    $(document).on('click', ".selected_lesson_class", function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#import").show();
            $("#remove").show();
            $("#view").hide();
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

    $("#list_type").change(function () {
        if ($(this).val() == "lesson_type") {
            $("#lesson_form").show();
            $("#quiz_form").hide();
        } else {
            $("#lesson_form").hide();
            $("#quiz_form").show();
        }
    });

    $("#quiz_view").hide();
    $("#quiz_remove").hide();
    $("#import").hide();
    $("#delete").hide();
    $("#assign").hide();

    $(".selected_quiz_class").change(function () {
        selected_count = $(document).find('.selected_quiz_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#import").show();
            $("#quiz_remove").show();
            $("#quiz_view").show();
            $("#delete").show();
            $("#assign").show();
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#delete").hide();
            $("#assign").hide();
            $("#import").hide();
            $("#quiz_remove").hide();
            $("#quiz_view").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#delete").show();
            $("#import").show();
            $("#quiz_remove").show();
            $("#assign").show();
            $("#quiz_view").hide();
        } else {
            $("#edit").hide();
            $("#quiz_view").hide();
            $("#import").hide();
            $("#quiz_remove").hide();
            $("#assign").show();
            $("#delete").show();
        }
    });

</script>