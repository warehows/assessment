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
                <h2>My Lesson</h2>
                <div class="form-container">
                    <select id="list_type" class="form-control">
                        <option value="lesson_type" id="lesson_type">Lessons</option>
                        <option value="quiz_type" id="quiz_type">Quiz</option>
                    </select>
                </div>
                <form action="<?php echo site_url() ?>/lessons/create" id="new_lesson">
                    <a href="" style="float:right;padding:5px;">
                        <button class="btn btn-primary">New Lesson</button>
                    </a>
                </form>
                <form action="<?php echo site_url()?>/lessons/index_actions" id="lesson_form" method="POST">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="edit" name="submit" value="edit">Edit</button>
<!--                    <button class="btn btn-primary" id="assign" name="submit" value="teacher_assign">Assign</button>-->
                    <button class="btn btn-primary" id="duplicate" name="submit" value="duplicate">Duplicate</button>
                    <button class="btn btn-primary" id="delete" name="submit" value="delete">Delete</button>
                    <table id="lesson_lists" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th width="3px"></th>
                            <th>Content Name</th>
                            <th>Content Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_lessons as $key => $value) { ?>

                            <tr style="cursor:pointer" >
                                <input type="hidden" name="workspace_id" value="<?php echo $value['id']; ?>" />
                                <td class="input_row"><input type="checkbox" class="selected_lesson_class" name="selected_lesson[]" value="<?php echo $value['content_id']?>"/></td>
                                <td class="lesson_row"><?php echo $value['content_name'] ?></td>
                                <td class="lesson_row"><?php echo $value['content_type'] ?></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </form>

                <form action="<?php echo site_url() ?>/assign/create" id="new_quiz">
                    <a href="" style="float:right;padding:5px;">
                        <button class="btn btn-primary" >New Quiz</button>
                    </a>
                    <input type="hidden" value="assign_quiz/modify_info" name="next_page" />
                </form>
                <form action="<?php echo site_url()?>/assign/actions" id="quiz_form" method="POST">

                    <button class="btn btn-primary" id="quiz_view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="quiz_edit" name="submit" value="edit">Edit</button>
                    <button class="btn btn-primary" id="quiz_assign" name="submit" value="teacher_assign">Assign</button>
                    <button class="btn btn-primary" id="quiz_duplicate" name="submit" value="duplicate">Duplicate</button>
                    <button class="btn btn-primary" id="quiz_delete" name="submit" value="delete">Delete</button>

<!--                    <input class="btn btn-primary" id="quid" name="quid" type="hidden" value=""/>-->


                    <table id="quiz_lists" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th width="3px"></th>
                            <th>Quiz Name</th>
                            <th>Content Type</th>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Author</th>
                            <th>Assigned</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($all_quizzes as $quiz_key => $quiz_value) { ?>
                            <?php $get_current_quiz = $this->quiz_model->get_quiz($quiz_value['content_id']);?>
                            <tr style="cursor:pointer" >
                                <td class="quiz_input_row">
                                    <input type="checkbox" class="selected_quiz_class" name="selected_quiz[]"
                                           value="<?php echo $quiz_value['id']?>"/>
                                </td>
                                <td class="quiz_row"><?php echo $quiz_value['content_name'] ?></td>
                                <td class="quiz_row">quiz</td>
                                <td class="quiz_row"><?php echo $get_current_quiz['start_date'] ?></td>
                                <td class="quiz_row"><?php echo $get_current_quiz['end_date'] ?></td>
                                <?php $author = $this->user_model->get_user($get_current_quiz['author']) ?>
                                <td class="quiz_row"><?php echo $author['first_name'] ?> <?php echo $author['last_name'] ?></td>
                                <?php if($get_current_quiz['assigned']=="1"): $assigned="Yes"; else: $assigned="No"; endif; ?>
                                <td class="quiz_row"><?php echo $assigned ?></td>
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

    $("#lesson_form").show();
    $("#quiz_form").hide();

    $("#edit").hide();
    $("#assign").hide();
    $("#view").hide();
    $("#delete").hide();
    $("#import").hide();
    $("#duplicate").hide();

    //quiz
    $("#quiz_edit").hide();
    $("#quiz_assign").hide();
    $("#quiz_view").hide();
    $("#quiz_delete").hide();
    $("#quiz_import").hide();
    $("#quiz_duplicate").hide();
    //quiz

    $(".lesson_row").click(function(){
        $(this).siblings(".input_row").eq(0).find(".selected_lesson_class").prop('checked',true);
        $("#view").click();
    });
    //quiz
    $(".quiz_row").click(function(){
//        $(this).siblings(".quiz_input_row").eq(0).find(".selected_lesson_class").prop('checked',true);
//        $("#view").click();
    });
    //quiz
    $(".selected_lesson_class").change(function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#duplicate").show();
            $("#assign").show();
            $("#view").hide();
            $("#delete").show();
            $("#import").show();
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#duplicate").hide();
            $("#assign").hide();
            $("#delete").hide();
            $("#view").hide();
            $("#import").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#duplicate").hide();
            $("#assign").show();
            $("#delete").show();
            $("#view").hide();
            $("#import").hide();
        } else {
            $("#edit").hide();
            $("#duplicate").hide();
            $("#assign").hide();
            $("#view").hide();
            $("#delete").show();
            $("#import").show();

        }
    });

    //quiz
    $(".selected_quiz_class").change(function () {
        selected_count = $(document).find('.selected_quiz_class:checked').length;
        if (selected_count == 1) {
            $("#quiz_edit").show();
            $("#quiz_duplicate").show();
            $("#quiz_assign").show();
            $("#quiz_view").hide();
            $("#quiz_delete").show();

            $("#import").show();
            console.log($(document).find('.selected_quiz_class:checked').val());
            $("#quid").val();
        } else if (selected_count == 0) {
            $("#quiz_edit").hide();
            $("#quiz_duplicate").hide();
            $("#quiz_assign").hide();
            $("#quiz_delete").hide();
            $("#quiz_view").hide();
            $("#quiz_import").hide();
        }
        else if (selected_count >= 1) {
            $("#quiz_edit").hide();
            $("#quiz_duplicate").hide();
            $("#quiz_assign").hide();
            $("#quiz_delete").show();
            $("#quiz_view").hide();
            $("#quiz_import").hide();
        } else {
            $("#quiz_edit").hide();
            $("#quiz_duplicate").hide();
            $("#quiz_assign").hide();
            $("#quiz_view").hide();
            $("#quiz_delete").show();
            $("#quiz_import").show();

        }
    });
    //quiz
    $("#new_quiz").hide();
    $("#list_type").on('change',function(){
        var url = "";
        if($(this).val() == "lesson_type"){
            $("#lesson_form").show();
            $("#quiz_form").hide();
            $("#new_quiz").hide();
            $("#new_lesson").show();
            url = "<?php echo site_url()?>/assign/actions";

        }else{
            $("#lesson_form").hide();
            $("#quiz_form").show();
            $("#new_quiz").show();
            $("#new_lesson").hide();
            url = "<?php echo site_url()?>/assign/actions";
        }
        $("#form_type").attr("form_type",url);

    });
</script>