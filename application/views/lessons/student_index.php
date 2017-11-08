<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<style>
    a {
        text-decoration: none;
        color: black;
    }
</style>
<?php $logged_in = $this->session->userdata('logged_in');?>
<?php $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids",",".$logged_in['gid'].","); ?>
<?php
if(!$lesson_for_students){
    $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids",$logged_in['gid'].",");
}
if(!$lesson_for_students){
    $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids",",".$logged_in['gid']);
}
if(!$lesson_for_students){
    $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids",$logged_in['gid']);
}
?>
<div class="wrapper">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12col-sm-12">

                <form action="<?php echo site_url()?>/lessons/index_actions" method="POST">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>

                    <table id="lesson_lists" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th style="display: none"></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Date Assigned</th>
                            <th>Expiration Date</th>

                        </tr>
                        </thead>
                        <tbody>
<!--                        --><?php //print_r($lesson_for_students);?>
                        <?php if($lesson_for_students):?>
                            <?php foreach ($lesson_for_students as $lessons_key => $lessons_value) { ?>
<!--                                --><?php //$value = $this->lessons_model->lesson_by_id($lessons_value); ?>
<!--                                --><?php //$value = $value[0]; ?>

                                <tr style="cursor:pointer">
                                    <td style="display: none" class="input_row"><input type="checkbox" class="selected_lesson_class" name="selected_lesson[]" value="<?php echo $lessons_value['id']?>"/></td>
                                    <td class="lesson_row"><?php echo $lessons_value['lesson_name'] ?></td>
                                    <td class="lesson_row"><?php print_r($subject_model->where('cid',$lessons_value['subject_id'])[0]['category_name']); ?></td>
                                    <td class="lesson_row"><?php echo $lessons_value['assigned_date_start'] ?></td>
                                    <td class="lesson_row"><?php echo $lessons_value['assigned_date_end'] ?></td>
                                </tr>
                            <?php } ?>
                        <?php endif; ?>

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