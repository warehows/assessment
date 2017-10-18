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
<div class="wrapper">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12col-sm-12">
                <form action="<?php echo site_url() ?>/assign/create" method="GET">
                    <input type="hidden" value="assign_quiz/modify_info" name="next_page" />
                    <a href="" style="float:right;padding:5px;">
                        <button class="btn btn-primary" id="new_quiz">Create Quiz</button>
                    </a>
                </form>
                <form action="<?php echo site_url()?>/assign/actions" method="POST" id="quiz_form">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="share" name="submit" value="share">Share to Lesson Bank</button>
                    <button class="btn btn-primary" id="edit" name="submit" value="edit">Edit</button>
                    <button class="btn btn-primary" id="delete" name="submit" value="admin_delete">Delete</button>
                    <button class="btn btn-primary" id="assign" name="submit" value="assign">Assign</button>
                    <button class="btn btn-primary" id="duplicate" name="submit" value="duplicate">Duplicate</button>
                    <?php $subject_model = $this->subjects_model?>
                    <table id="lesson_lists" class="display responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="3px"></th>
                            <th>Quiz Name</th>
                            <th>Subject</th>
                            <th>Semester</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th width="3px"></th>
                            <th>Quiz Name</th>
                            <th>Subject</th>
                            <th>Semester</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $semesterData = array(1 => 'First Semester',2 => 'Second Semester',3 => 'Third Semester',4 => 'Fourth Semester'); ?>
                        <?php foreach ($all_quiz as $key => $value) { ?>
                            <tr>
                                <td><input type="checkbox" class="selected_lesson_class" name="selected_quiz[]" value="<?php echo $value['quid']?>"/></td>
                                <td><?php echo $value['quiz_name'] ?></td>
                                <td><?php echo $subject_model->where('cid',$value['cid'])[0]['category_name'] ?></td>
                                <td><?php if(isset($semesterData[$value['semester']])){echo $semesterData[$value['semester']];}?></td>
                                <td><a href="<?php echo base_url('index.php/quiz/preview/'.$value['quid'])?>" class="btn " id="view" name="submit" value="view">Preview</a></td>
                                <!--                                <td>--><?php //print_r($subject_model->where('cid',$value['subject_id'])[0]['category_name']); ?><!--</td>-->
                                <!--                                <td>--><?php //echo $value['level_id'] ?><!--</td>-->
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
    $("#delete").hide();
    $("#assign").hide();
    $("#duplicate").hide();
    $("form").submit(function(e){
        var txt;
        var r = confirm("Do you want to perform this action?");
        if (r == true) {
            return true;
        } else {
            e.preventDefault();
        }

    });
    $(document).on('click', ".selected_lesson_class", function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#share").show();
            $("#view").hide();
            $("#delete").show();
            $("#assign").show();
            $("#duplicate").show();
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#delete").hide();
            $("#assign").hide();
            $("#share").hide();
            $("#view").hide();
            $("#duplicate").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#delete").show();
            $("#share").show();
            $("#assign").hide();
            $("#view").hide();
            $("#duplicate").hide();
        } else {
            $("#edit").hide();
            $("#view").hide();
            $("#share").hide();
            $("#assign").show();
            $("#delete").show();
            $("#duplicate").show();
        }
    });

   /* $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#lesson_lists thead th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder=" '+title+'" />' );
        } );

        // DataTable
        var table = $('#lesson_lists').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    } );*/
</script>