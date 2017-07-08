<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
            <div class="two wizard">
            	<?php echo $logged_in['uid']; ?>
            	<form action="<?php echo site_url('calendar/save');?>" method="POST">

            		<div class="form-group row">
		                <label class="control-label col-sm-2" for="lesson">Lesson:</label>
		                <div class="col-sm-10">
		                    <select class="form-control" id="lesson" name="lesson">
		                        <option value="">Select lesson</option>
		                        <?php foreach ($lesson as $key => $value) {?>
		                            <option value="<?php echo $value['content_id']; ?>"><?php echo $value['content_name']; ?></option>
		                        <?php } ?>
		                    </select>
		                </div>
		            </div>

		            <div class="form-group row">
		                <label class="control-label col-sm-2" for="grade">Grade:</label>
		                <div class="col-sm-10">
		                    <select class="form-control" id="grade" name="grade">
		                        <option value="">Select grade</option>
		                    </select>
		                </div>
		            </div>

		            <div class="form-group row">
		                <label class="control-label col-sm-2" for="subject">Subject:</label>
		                <div class="col-sm-10">
		                    <select class="form-control" id="subject" name="subject">
		                        <option value="">Select subject</option>
		                    </select>
		                </div>
		            </div>

		            <div class="form-group row">
		                <label class="control-label col-sm-2" for="section">Section:</label>
		                <div class="col-sm-10">
		                    <select class="form-control" id="section" name="section">
		                        <option value="">Select section</option>
		                  		<?php foreach ($section as $key => $value) {?>
		                            <option value="<?php echo $value['gid']; ?>"><?php echo $value['group_name']; ?></option>
		                        <?php } ?>

		                    </select>
		                </div>
		            </div>

		            <div class="form-group row">
		                <label class="control-label col-sm-2" for="dateFrom">Date From:</label>
		                <div class="col-sm-10">
		                    <input type="text" id="dateFrom" class="form-control" name="dateFrom">
		                </div>
		            </div>

		            <div class="form-group row">
		                <label class="control-label col-sm-2" for="dateto">Date To:</label>
		                <div class="col-sm-10">
		                    <input type="text" id="dateTo" class="form-control" name="dateTo">
		                </div>
		            </div>

            		<input class="btn btn-primary" type="submit" name="save" value="Save" id="saveSchedule">
            	</form>
            </div>
        </div>
    </div>
</div>

<div class="footer-clean">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 item social">
                    <p class="copyright">Powered by Click Innovation © 2017</p>
                </div>
            </div>
        </div>
    </footer>
</div>


<script>
	$( "#dateFrom" ).datepicker();
	$( "#dateTo" ).datepicker();

	$('#lesson').change(function(event) {
        $.post('getGrade', {lesson: $('#lesson').val()}, function(data, textStatus, xhr) {
            $('#grade').html("<option>Select grade</option>");
            $.each(JSON.parse(data), function(index, val) {
                var option = "<option value='"+val.id+"'> Grade "+val.name+"</option>";
                $("#grade").append(option);
            });
        });
         $.post('getSubject', {lesson: $('#lesson').val()}, function(data, textStatus, xhr) {
            $('#subject').html("<option>Select subject</option>");
            $.each(JSON.parse(data), function(index, val) {
                var option = "<option value='"+val.id+"'>"+val.name+"</option>";
                $("#subject").append(option);
            });
        });


    });


	$("#saveSchedule").click(function (e) {
 
        });


</script>
