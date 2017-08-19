<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js"></script>
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

                    <table id="lesson_lists" class="table table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th></th>
                            <th>Quiz Name</th>
                            <th>Semester</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $semesterData = array(1 => 'First Semester',2 => 'Second Semester',3 => 'Third Semester',4 => 'Fourth Semester'); ?>
                        <?php foreach ($all_quiz as $key => $value) { ?>
                            <tr>
                                <td><input type="checkbox" class="selected_lesson_class" name="selected_quiz[]" value="<?php echo $value['quid']?>"/></td>
                                <td><?php echo $value['quiz_name'] ?></td>
                                <td><?php if(isset($semesterData[$value['semester']])){echo $semesterData[$value['semester']];}?></td>
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
    $("#lesson_lists").DataTable();
    $("#edit").hide();
    $("#view").hide();
    $("#share").hide();
    $("#delete").hide();
    $("#assign").hide();
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
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#delete").hide();
            $("#assign").hide();
            $("#share").hide();
            $("#view").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#delete").show();
            $("#share").show();
            $("#assign").hide();
            $("#view").hide();
        } else {
            $("#edit").hide();
            $("#view").hide();
            $("#share").hide();
            $("#assign").show();
            $("#delete").show();
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