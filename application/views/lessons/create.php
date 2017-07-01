<script type="text/javascript">
    var jQuery_1_12_4 = $.noConflict(true);
</script>

<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>

<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>
<script src="<?php echo base_url(); ?>js/jstree/dist/jstree.min.js"></script>
<script src="<?php echo base_url(); ?>js/jstree/dist/jstree.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.js"></script>

<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
            <div class="two wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" role="presentation"><a href="#step1" data-toggle="tab" aria-controls="step1"
                                                                  role="tab" title="Title"><span class="round-tab"> <i
                                        class="glyphicon glyphicon-text-color"></i></span> </a></li>
                        <li class="disabled" role="presentation"><a href="#step2" data-toggle="tab"
                                                                    aria-controls="step2" role="tab"
                                                                    title="Question Creation"><span
                                    class="round-tab"> <i class="glyphicon glyphicon-folder-open"></i></span> </a></li>
                    </ul>
                </div>

                <div class="tab-content">

                    <div id="step1" class="tab-pane active" role="tabpanel">
                        <div style="padding:10%;padding-top:0px;">
                            <h3 class="wizard_title"><strong>Lesson</strong></h3>

                            <form action="<?php echo site_url('')?>">
                                <div class="form-group">
                                    <label class="control-label" for="start_date">Lesson Title </label>
                                    <input class="form-control" type="text" name="lesson_name" required=""
                                           placeholder="Lesson Title" inputmode="email" id="lesson_name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="end_date">Subject </label>
                                    <select class="form-control" id="subject_id">
                                        <?php foreach ($all_subjects as $key => $value) { ?>

                                            <option
                                                value="<?php echo $value['cid'] ?>"><?php echo $value['category_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="duration">Grade Level </label>
                                    <select class="form-control " id="level_id">
                                        <?php foreach ($all_levels as $key => $value) { ?>

                                            <option
                                                value="<?php echo $value['lid'] ?>">
                                                Grade <?php echo $value['level_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <button class="btn btn-primary btn-info-full next-step" id="step_1_submit"
                                                type="button">Next</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div id="step2" class="tab-pane" role="tabpanel">

                    </div>
                </div>

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
    $(document).ready(function () {

        var lesson_id;
        var folder_name;
        var folder_id_counter = 0;
        var current_selected;
        var lesson_folder_id;
        var lesson_contents_id;
        var lesson_contents;
        var selected_quiz_array = new Array();

        //save lesson to database
        $("#step_1_submit").click(function (e) {

            var lesson_name = $("#lesson_name").val();
            var subject_id = $("#subject_id").val();
            var level_id = $("#level_id").val();
            var author = <?php echo $logged_in['uid']; ?>;
            var duplicated = 0;
            //if there is lesson name or not
            if (lesson_name) {
                $.ajax({
                    url: "<?php echo site_url('lessons/save_lesson_with_folder');?>",
                    type: "POST",
                    data: {lesson_name: lesson_name, subject_id: subject_id, level_id: level_id, author:author,duplicated:duplicated}
                }).done(function (values) {
                    lesson_id = values;
                    window.location.replace("<?php echo site_url()?>/lessons/create_modify_folder?lesson_id="+lesson_id+"&author=<?php echo $logged_in['uid'];?>&duplicated=0");
                });

                $("#lesson_name").prop("disabled", true)
                $("#subject_id").prop("disabled", true)
                $("#level_id").prop("disabled", true)

            } else {
                $("#lesson_name").focus();

            }
        });

    });
</script>