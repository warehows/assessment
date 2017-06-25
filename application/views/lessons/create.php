<script type="text/javascript">
    var jQuery_1_12_4 = $.noConflict(true);
</script>

<style>
    .checked_tr {
        background-color: rgb(230, 230, 230);
    }
</style>

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
            <div class="three wizard">
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
                        <li class="disabled" role="presentation">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"
                               title="Test Settings"><span class="round-tab"> <i
                                        class="glyphicon glyphicon-ok"></i></span> </a></li>
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
                    <div id="step3" class="tab-pane active" role="tabpanel"></div>
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


            function update_file_table(lesson_folder_id) {
                $.ajax({
                    url: "<?php echo site_url('lessons/update_files');?>",
                    type: "POST",
                    data: {lesson_folder_id: lesson_folder_id}
                }).done(function (values) {
                    lesson_contents = JSON.parse(values);
                    var append;
                    $("#file_container").empty();
                    $.each(lesson_contents, function (key, value) {
                        i f( value[' content_type']=="quiz"){
                            var quiz_id = value['content'];
                            $.ajax({
                                url: "<?php echo site_url('lessons/get_quiz');?>",
                                type: "POST",
                                data: {quid: quiz_id}
                            }).done(function(value){
                                value = JSON.parse(value);
                                value['content'] = value.quiz_name;
                                append = "<tr><td>" + value['content'] + "</td><td>quiz</td><td><button id='" + value['id'] + "' name='" + value['content'] + "' class='delete_file_content_haha'>Delete</button></td></tr>";
                                $("#file_container").append(append);
                            }) ;
                        }else{
                            append = "<tr><td>" + value['content'] + "</td><td>" + value['content_type'] + "</td><td><button id='" + value['id'] + "' name='" + value['content'] + "' class='delete_file_content_haha'>Delete</button></td></tr>";
                            $("#file_container").append(append);
                        }



                    });

                });
            }

            var uploadObj = $("#fileuploader").uploadFile({
                url: "<?php echo site_url('/lessons/upload_files')?>",
                showDownload: false,
                dragdropWidth: '100%',
                fileName: "myfile",
                allowedTypes: "jpg,png,gif,pptx,ppt",
                uploadStr: "Upload Files",
                sequential: true,
                sequentialCount: 1,
                autoSubmit: false,
                showDelete: true,
                formData: {key1: 'value1', key2: 'value2'},
                dynamicFormData: function () {
                    var data = {lesson_id: lesson_id, folder_name: folder_name};
                    return data;
                },
                downloadCallback: function (files, pd) {
                    location.href = "<?php echo site_url('/lessons/upload_files')?>?myfile=" + files;
                },
                onSuccess: function (files, data, xhr, pd) {
                    lesson_folder_id = data;
                    lesson_folder_id = lesson_folder_id.replace('"', "");
                    lesson_folder_id = lesson_folder_id.replace('"', "");

                    $.ajax({
                        url: "<?php echo site_url('lessons/save_files_to_database');?>",
                        type: "POST",
                        data: {content: files, lesson_folder_id: lesson_folder_id}
                    }).done(function (values) {
                        lesson_contents_id = values;
                        update_file_table(lesson_folder_id);
                    });


                },
                deleteCallback: function (data, pd) {
                    var filename = pd.filename[0].childNodes[0].wholeText;

                    $.post("<?php echo site_url('/lessons/delete_upload_files')?>", {
                            op: "delete",
                            filename: filename,
                            lesson_id: lesson_id,
                            folder_name: folder_name,
                        },
                        function (resp, textStatus, jqXHR) {

                            update_file_table(lesson_folder_id);

                        });
                }

            });


            $("#start_upload").click(function () {
                uploadObj.startUpload();
            });
            $("#download").click(function () {
                uploadObj.getResponses();
            });

            $(document).delegate(".delete_file_content_haha", "click", function (event) {
                var lesson_content_id_delete = $(event.currentTarget).attr('id');
                var filename = $(event.currentTarget).attr('name');

                $.ajax({
                        url: "<?php echo site_url('lessons/delete_upload_files_by_id');?>",
                        type: "POST",
                        data: {
                            lesson_contents_id: lesson_content_id_delete,
                            filename: filename,
                            lesson_id: lesson_id,
                            folder_name: folder_name
                        }
                    }
                ).done(function (values) {
                        update_file_table(lesson_folder_id);
                        uploadObj.reset();

                    });
            });

            $("#folder_name_container").hide();

            //JS tree initialization
            $('#data').jstree({
                'core': {
                    "check_callback": true,
                    'data': [
                        {"id": "1", "text": "E_1"},
                        {"id": "2", "text": "E_2"},
                        {"id": "3", "text": "E_3"},
                        {"id": "4", "text": "E_4"},
                        {"id": "5", "text": "E_5"}
                    ]
                },

            })
                .on('create_node.jstree', function (e, data) {
                })
                .on("select_node.jstree", function (e, data) {

                    $(this).find("li").find("a");
                    $(document).delegate($(this).find("#" + data.selected[0]), 'action_buttons', function (event) {
                        $(event.currentTarget).find("#" + data.selected[0]).find(".folder_action_button").remove();
                    });
                    $(document).trigger("action_buttons");
                    $(this).find("#" + data.selected[0]).find("a").after('<input type="button" class="open_folder folder_action_button" id="open_folder_' + data.selected[0] + '" value="Open Folder" />');
                    $("#folder_content_container").hide();
                    uploadObj.reset();
                    folder_name = "E_" + data.selected[0];
                    $.ajax({
                        url: "<?php echo site_url('lessons/get_current_folder');?>",
                        type: "POST",
                        data: {lesson_id: lesson_id, folder_name: folder_name}
                    }).done(function (values) {
                        lesson_folder_id = JSON.parse(values);
                        lesson_folder_id = lesson_folder_id[0];
                        lesson_folder_id = lesson_folder_id.id;
                        update_file_table(lesson_folder_id);
                    });

                });

            //save lesson to database
            $("#step_1_submit").click(function (e) {

                var lesson_name = $("#lesson_name").val();
                var subject_id = $("#subject_id").val();
                var level_id = $("#level_id").val();

                //if there is lesson name or not
                if (lesson_name) {
                    $.ajax({
                        url: "<?php echo site_url('lessons/save_lesson_with_folder');?>",
                        type: "POST",
                        data: {lesson_name: lesson_name, subject_id: subject_id, level_id: level_id}
                    }).done(function (values) {
                        lesson_id = values;

                    });

                    $("#lesson_name").prop("disabled", true)
                    $("#subject_id").prop("disabled", true)
                    $("#level_id").prop("disabled", true)

                } else {
                    $("#lesson_name").focus();

                }
                //if there is lesson name or not
            });

            $("#add_folder_toggle").click(function () {
                $("#folder_name_container").toggle();
            });
            $("#folder_content_container").hide();

            $(document).delegate('.open_folder', 'click', function (event) {

                $("#folder_content_container").show();
                var current_folder_id = $(event.currentTarget).attr("id");
                current_folder_id = current_folder_id.replace("open_folder_", "");
                folder_name = $(event.currentTarget).siblings().eq(1).text();

            });

            $("#add_quiz").click(function () {
                    $.confirm({
                        columnClass: 'col-md-6 col-md-offset-3',
                        containerFluid: true, // this will add 'container-fluid' instead of 'container'
                        draggable: true,
                        buttons: {
                            confirm: function () {
                                var checked_values = $('.select_quiz:checkbox:checked');
                                $.each( check ed_val ues,function(key,value){
                                    var values = $(value).attr("value");
                                    selected_quiz_array.push(values);
                                });
                                $.ajax({
                                    url: "<?php echo site_url('lessons/add_quizzes_to_lessons');?>",
                                    type: "POST",

                                    data: {selected_quizze
                                        s: selected_quiz_ array,lesson_fold
                                er_id:less on_folder_
                                id,lesson_id: lesson
                                _id,content_type:"quiz"},
                        } ).done(function(values){
                        update_file_table(lesson_folder_id);
                    });
                },
                cancel: function () {
                $.alert('Canceled!');
            }
        },
        content: function () {
        var self = this;
        return $.ajax({
            url: "<?php echo site_url('lessons/display_all_quizzes');?>",
            method: 'POST'
        }).done(function (response) {
            self.setTitle("Quizzes List");
            response = JSON.parse(response);

            self.setContentAppend('<table class="table-striped" width="100%"><tr><th>Quiz Name</th><th>Select</th></tr>');
            $.each(response, function (key, value) {
                self.setContentAppend('<tr class="selected_quiz_tr_' + key + '"><td id="select_quiz_' + key + '">' + value.quiz_name + '</td>' +
                    '<td><input type="checkbox" name="quiz_selected[]" joeven="' + key + '" class="select_quiz" name="select_quiz" value="' + value.quid + '"></td>' +
                    '</tr>');
            });
            self.setContentAppend('</table>');

        }).fail(function () {
            self.setContent('Something went wrong.');
        });
    }

    });
    });

    $(document).delegate('.select_quiz', 'click', function (event) {
        var selected_quiz = $(event.currentTarget).attr("jo even");

        if($(event.current Target).is(":checked")){
            $(".selected_quiz_tr_"+selected_quiz). css("background-color","rgb(230,23 0,23 0)");
        }else{
            $(".selected_quiz_tr_"+selected_quiz). css("background-color","");
        }

    });

    });
</script>