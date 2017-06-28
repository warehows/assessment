<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
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
                <button id="duplicate">Duplicate</button>
                <button id="view">View</button>
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
                    <?php foreach($all_lessons as $key=>$value){?>
                        <tr>
                            <td><input type="checkbox" class="selected_lesson_class" name="selected_lesson" /></td>
                            <td><?php echo $value['lesson_name']?></td>
                            <td><?php echo $value['level_id']?></td>
                        </tr>
                    <?php } ?>


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
    $("#view").hide();
    $("#duplicate").hide();
    $(".selected_lesson_class").change(function() {
        selected_count = $(document).find('input[name="selected_lesson"]:checked').length;
        if(selected_count==1) {
            $("#edit").show();
            $("#delete").show();
            $("#duplicate").show();
            $("#view").show();
        }else if(selected_count==0){
            $("#view").hide();
            $("#edit").hide();
            $("#delete").hide();
            $("#duplicate").hide();
        }
        else if(selected_count>=1){
            $("#edit").hide();
            $("#view").hide();
            $("#delete").show();
            $("#duplicate").show();
        }else{
            $("#edit").hide();
            $("#view").hide();
            $("#delete").show();
            $("#duplicate").show();
        }
    });
</script>