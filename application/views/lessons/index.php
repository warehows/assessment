<script src="<?php echo base_url('css/new_material/cdn/jquery1_12.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.css')?>">
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
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

<div class="container">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

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
                <form action="<?php echo site_url() ?>/lessons/index_actions" method="POST" id="form_submit">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="share" name="submit" value="share">Share to Lesson Bank</button>
                    <button class="btn btn-primary" id="edit" name="submit" value="edit">Edit</button>
                    <button class="btn btn-primary" id="delete" name="submit" value="delete">Delete</button>
                    <button class="btn btn-primary" id="assign" name="submit" value="assign">Assign</button>
                    <table id="lesson_lists" class="display responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="3px"></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Grade Level</th>
                            <!--                            <th>Assigned To</th>-->
                            <th>Assigned Date</th>
                            <th>Expiry Date</th>


                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th width="3px"></th>
                            <th>Lesson Name</th>
                            <th>Subject</th>
                            <th>Grade Level</th>
                            <!--                            <th>Assigned To</th>-->
                            <th>Assigned Date</th>
                            <th>Expiry Date</th>

                        </tr>
                        </tfoot>
                        <tbody>

                        <?php foreach ($all_lessons as $key => $value) { ?>

                            <?php if ($value['uid'] == $logged_in['uid']): ?>
                                <tr style="cursor:pointer">
                                    <input type="hidden" name="workspace_id" value="0"/>
                                    <td class="input_row"><input type="checkbox" class="selected_lesson_class"
                                                                 name="selected_lesson[]"
                                                                 value="<?php echo $value['id'] ?>"/></td>
                                    <td class="lesson_row"><?php echo $value['lesson_name'] ?></td>
                                    <td class="lesson_row"><?php echo $value['category_name']?></td>
                                    <td class="lesson_row"><?php echo $value['level_name'] ?></td>

                                    <?php if ($value['assigned_date_start']) {
                                        $current_date_start = date("F d, Y", strtotime($value['assigned_date_start']));
                                    } else {
                                        $current_date_start = "";
                                    } ?>
                                    <td class="lesson_row"><?php echo $current_date_start ?></td>
                                    <?php if ($value['assigned_date_end']) {
                                        $current_date_end = date("F d, Y", strtotime($value['assigned_date_end']));
                                    } else {
                                        $current_date_end = "";
                                    } ?>
                                    <td class="lesson_row"><?php echo $current_date_end ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php } ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
    $("#edit").hide();
    $("#view").hide();
    $("#share").hide();
    $("#import").hide();
    $("#delete").hide();
    $("#assign").hide();
    $(document).on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
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