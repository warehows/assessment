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
                <?php
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                }
                ?>
                <form action="<?php echo site_url() ?>/lessons/create">
                    <a href="" style="float:right;padding:5px;">
                        <button class="btn btn-primary" id="new_lesson">New Lesson</button>
                    </a>
                </form>
                <form action="<?php echo site_url()?>/lessons/index_actions" method="POST" id="form_submit">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="share" name="submit" value="share">Share to Lesson Bank</button>
                    <button class="btn btn-primary" id="edit" name="submit" value="edit">Edit</button>
                    <button class="btn btn-primary" id="delete" name="submit" value="delete">Delete</button>
                    <button class="btn btn-primary" id="assign" name="submit" value="assign">Assign</button>

                    <table id="lesson_lists" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th width="3px"></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Grade</th>

                        </tr>
                        </thead>
                       <!-- <tfoot>
                            <th width="3px"></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Grade</th>
                        </tfoot>-->
                        <tbody>

                        <?php foreach ($all_lessons as $key => $value) { ?>
                            <tr style="cursor:pointer" >
                                <input type="hidden" name="workspace_id" value="0" />
                                <td class="input_row"><input type="checkbox" class="selected_lesson_class" name="selected_lesson[]" value="<?php echo $value['id']?>"/></td>
                                <td class="lesson_row"><?php echo $value['lesson_name'] ?></td>
                                <td class="lesson_row"><?php print_r($subject_model->where('cid',$value['subject_id'])[0]['category_name']); ?></td>
                                <td class="lesson_row"><?php echo $value['level_id'] ?></td>
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
    $("#edit").hide();
    $("#view").hide();
    $("#share").hide();
    $("#import").hide();
    $("#delete").hide();
    $("#assign").hide();
    $(".lesson_row").click(function(){
        $(this).siblings(".input_row").eq(0).find(".selected_lesson_class").prop('checked',true);
        $("#view").click();
    });
    $(document).on('click', ".selected_lesson_class", function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#share").show();
            $("#import").show();
            $("#view").hide();
            $("#delete").show();
            $("#assign").show();
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#delete").hide();
            $("#assign").hide();
            $("#import").hide();
            $("#share").hide();
            $("#view").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#delete").show();
            $("#share").show();
            $("#import").show();
            $("#assign").hide();
            $("#view").hide();
        } else {
            $("#edit").hide();
            $("#view").hide();
            $("#share").hide();
            $("#import").hide();
            $("#assign").show();
            $("#delete").show();
        }
    });

</script>