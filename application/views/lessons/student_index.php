<script src="<?php echo base_url('css/new_material/cdn/jquery1_12.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.css') ?>">

<style>
    tfoot input {
        width: 100%;
        padding : 3px;
        box-sizing: border-box;
    }

    tfoot {
        display: table-header-group;
    }

    a {
        color: black;
    }

    tr {
        cursor: pointer;
    }
</style>
<?php $logged_in = $this->session->userdata('logged_in'); ?>
<?php $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids", "," . $logged_in['gid'] . ","); ?>
<?php
if (!$lesson_for_students) {
    $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids", $logged_in['gid'] . ",");
}
if (!$lesson_for_students) {
    $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids", "," . $logged_in['gid']);
}
if (!$lesson_for_students) {
    $lesson_for_students = $this->lessons_model->like("lesson_assigned_ids", $logged_in['gid']);
}
?>
<!--                    <table id="lesson_lists" class="table table-bordered table-hover">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th style="display: none"></th>-->
<!--                            <th>Lesson Name</th>-->
<!--                            <th>Subject</th>-->
<!--                            <th>Date Assigned</th>-->
<!--                            <th>Expiration Date</th>-->
<!---->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <!--                        -->--><?php ////print_r($lesson_for_students);?>
<!--                        --><?php //if ($lesson_for_students): ?>
<!--                            --><?php //foreach ($lesson_for_students as $lessons_key => $lessons_value) { ?>
<!--                                <!--                                -->--><?php ////$value = $this->lessons_model->lesson_by_id($lessons_value); ?>
<!--                                <!--                                -->--><?php ////$value = $value[0]; ?>
<!---->
<!--                                <tr style="cursor:pointer">-->
<!--                                    <td style="display: none" class="input_row"><input type="checkbox"-->
<!--                                                                                       class="selected_lesson_class"-->
<!--                                                                                       name="selected_lesson[]"-->
<!--                                                                                       value="--><?php //echo $lessons_value['id'] ?><!--"/>-->
<!--                                    </td>-->
<!--                                    <td class="lesson_row">--><?php //echo $lessons_value['lesson_name'] ?><!--</td>-->
<!--                                    <td class="lesson_row">--><?php //print_r($subject_model->where('cid', $lessons_value['subject_id'])[0]['category_name']); ?><!--</td>-->
<!--                                    <td class="lesson_row">--><?php //echo $lessons_value['assigned_date_start'] ?><!--</td>-->
<!--                                    <td class="lesson_row">--><?php //echo $lessons_value['assigned_date_end'] ?><!--</td>-->
<!--                                </tr>-->
<!--                            --><?php //} ?>
<!--                        --><?php //endif; ?>
<!---->
<!--                        </tbody>-->
<!--                    </table>-->
<div class="wrapper">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <form action="" method="POST">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <table id="lesson_lists" class="display responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Date Assigned</th>
                            <th>Expiration Date</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Date Assigned</th>
                            <th>Expiration Date</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        <?php if ($lesson_for_students): ?>
                            <?php foreach ($lesson_for_students as $lessons_key => $lessons_value) { ?>

                                <?php $data_to_pass['lesson_id'] = $lessons_value['id'];
                                $data_to_pass['author'] =$lessons_value['author'];?>
                                <tr class="quiz_result_preview" data-href='<?php echo site_url('lessons/view_lesson_folder')."?".http_build_query($data_to_pass)?>'>

                                    <td class="lesson_row"><?php echo $lessons_value['lesson_name'] ?></td>
                                    <td class="lesson_row"><?php print_r($subject_model->where('cid', $lessons_value['subject_id'])[0]['category_name']); ?></td>
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
    $(document).ready(function () {

        $(".quiz_result_preview").click(function() {


                window.location = $(this).data("href");




        });
        // Setup - add a text input to each footer cell
        $('#lesson_lists tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        var table = $('#lesson_lists').DataTable();
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {

                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

        $('#lesson_lists').on('draw.dt', function (event) {
            var abuttons = $(this).find(".abutton");
            var removed_click = $(this).find(".remove");

            $(removed_click).hide();
            $.each(abuttons, function (key, value) {
                var current_text = $(this).text();
                current_text = current_text.replace(/ /g, '');
                current_text = current_text.replace(/\n/, '');
                if (current_text == "Added") {
                    $(this).hide();
                    $("#remove-" + $(this).attr("id").replace("q", "")).show();

                }

            });

        });
    });
</script> 