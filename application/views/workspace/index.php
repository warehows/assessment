<style>
    h1	{
        font-size: 100px!important;
        color: darkgrey;
    }
</style>

<div class="wrapper" align="center" style="padding-top: 280px;">
    <h1>Page Under Construction</h1>
</div>
<!--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<style>
    a {
        text-decoration: none;
        color:black;
    }
</style>
<div class="wrapper">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <a href="<?php /*echo site_url()*/?>/lessons/create"><button id="new_lesson">New Lesson</button></a>
                <button id="edit">Edit</button>
                <button id="delete">Delete</button>

                <table id="lesson_lists" class="display " cellspacing="1" width="100%">
                    <thead>
                    <tr>
                        <th> </th>
                        <th>Lesson Name</th>
                        <th>Grade</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th> </th>
                        <th>Lesson Name</th>
                        <th>Grade</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php /*foreach($all_lessons as $key=>$value){*/?>
                        <tr>
                            <td><input type="checkbox" class="selected_lesson_class" name="selected_lesson" /></td>
                            <td><?php /*echo $value['lesson_name']*/?></td>
                            <td><?php /*echo $value['level_id']*/?></td>
                        </tr>
                    <?php /*} */?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#lesson_lists").DataTable();
    $("#edit").hide();
    $("#delete").hide();
    $(".selected_lesson_class").change(function() {
        selected_count = $(document).find('input[name="selected_lesson"]:checked').length;
        if(selected_count==1) {
            $("#edit").show();
            $("#delete").show();
        }else if(selected_count>=1){
            $("#edit").hide();
            $("#delete").show();
        }else{
            $("#edit").hide();
            $("#delete").show();
        }
    });
</script>-->