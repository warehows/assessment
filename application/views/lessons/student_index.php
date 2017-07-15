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
                <?php print_r($lessons_array); ?>
                <form action="<?php echo site_url()?>/lessons/index_actions" method="POST">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>

                    <table id="lesson_lists" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Grade</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($lessons_array as $key => $lesson_value) { ?>
                            <?php $value = $this->lessons_model->lesson_by_id($lesson_value); ?>
                            <?php $value = $value[0]; ?>

                            <tr>
                                <td><input type="checkbox" class="selected_lesson_class" name="selected_lesson[]" value="<?php echo $value['id']?>"/></td>
                                <td><?php echo $value['lesson_name'] ?></td>
                                <td><?php print_r($subject_model->where('cid',$value['subject_id'])[0]['category_name']); ?></td>
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
    $("#view").hide();
    $("#share").hide();
    $("#import").hide();
    $("#delete").hide();
    $("#assign").hide();
    $(".selected_lesson_class").change(function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#share").show();
            $("#import").show();
            $("#view").show();
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
            $("#assign").show();
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