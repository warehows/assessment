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
                <form action="<?php echo site_url() ?>/lessons/create">
                    <a href="" style="float:right;padding:5px;">
                        <button class="btn btn-primary" id="new_lesson">New Lesson</button>
                    </a>
                </form>
                <form action="<?php echo site_url()?>/lessons/index_actions" method="POST">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="edit" name="submit" value="edit">Edit</button>
                    <button class="btn btn-primary" id="assign" name="submit" value="assign">Assign</button>
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
            </div>
        </div>
    </div>
</div>

<script>
    $("#lesson_lists").DataTable();
    $("#edit").hide();
    $("#assign").hide();
    $("#view").hide();
    $("#delete").hide();
    $("#import").hide();
    $("#duplicate").hide();
    $(".lesson_row").click(function(){
        $(this).siblings(".input_row").eq(0).find(".selected_lesson_class").prop('checked',true);
        $("#view").click();
    });
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
            $("#assign").hide();
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
</script>