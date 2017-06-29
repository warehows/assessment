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
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <a href="<?php echo site_url() ?>/lessons/create" style="float:right;padding:5px;">
                    <button id="new_lesson">New Lesson</button>
                </a>
                <form action="<?php echo site_url()?>/lessons/index_actions" method="POST">

                    <button id="edit" name="submit" value="edit">Edit</button>
                    <button id="delete" name="submit" value="delete">Delete</button>

                    <table id="lesson_lists" class="display " cellspacing="1" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Lesson Name</th>
                            <th>Grade</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>Lesson Name</th>
                            <th>Grade</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        <?php foreach ($all_lessons as $key => $value) { ?>
                            <tr>
                                <td><input type="checkbox" class="selected_lesson_class" name="selected_lesson[]" value="<?php echo $value['id']?>"/></td>
                                <td><?php echo $value['lesson_name'] ?></td>
                                <td><?php echo $value['level_id'] ?></td>
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
    $("#delete").hide();
    $(".selected_lesson_class").change(function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#delete").show();
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#delete").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#delete").show();
        } else {
            $("#edit").hide();
            $("#delete").show();
        }
    });
</script>