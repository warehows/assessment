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
                <form action="<?php echo site_url() ?>/lessons/create">
                    <a href="" style="float:right;padding:5px;">
                        <button class="btn btn-primary" id="new_lesson">New Lesson</button>
                    </a>
                </form>
                <form action="<?php echo site_url()?>/lessons/index_actions" method="POST">

                    <button class="btn btn-primary" id="view" name="submit" value="view">View</button>
                    <button class="btn btn-primary" id="import" name="submit" value="import">Share to Lesson Bank</button>
                    <button class="btn btn-primary" id="edit" name="submit" value="edit">Edit</button>
                    <button class="btn btn-primary" id="delete" name="submit" value="delete">Delete</button>
                    <button class="btn btn-primary" id="assign" name="submit" value="assign">Assign</button>

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

                        <?php foreach ($all as $key => $value) { ?>
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
    $("#import").hide();
    $("#delete").hide();
    $("#assign").hide();
    $(".selected_lesson_class").change(function () {
        selected_count = $(document).find('.selected_lesson_class:checked').length;
        if (selected_count == 1) {
            $("#edit").show();
            $("#import").show();
            $("#view").show();
            $("#delete").show();
            $("#assign").show();
        } else if (selected_count == 0) {
            $("#edit").hide();
            $("#delete").hide();
            $("#assign").hide();
            $("#import").hide();
            $("#view").hide();
        }
        else if (selected_count >= 1) {
            $("#edit").hide();
            $("#delete").show();
            $("#import").show();
            $("#assign").show();
            $("#view").hide();
        } else {
            $("#edit").hide();
            $("#view").hide();
            $("#import").hide();
            $("#assign").show();
            $("#delete").show();
        }
    });

    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#lesson_lists thead th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
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
    } );
</script>