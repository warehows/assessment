<script type="text/javascript">
    var jQuery_1_12_4 = $.noConflict(true);
</script>

<style>
    .checked_tr {
        background-color: rgb(230, 230, 230);
    }
</style>

<link href="<?php echo base_url().$css_directory."hayageek_file_upload.css" ?>" rel="stylesheet">
<script src="<?php echo base_url().$css_directory."jquery.min.js" ?>"></script>
<script src="<?php echo base_url().$css_directory."jquery.uploadfile.min.js" ?>"></script>

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
                        <li class="disabled" role="presentation"><a href="#step1" data-toggle="tab"
                                                                    aria-controls="step1"
                                                                    role="tab" title="Title"><span class="round-tab"> <i
                                        class="glyphicon glyphicon-text-color"></i></span> </a></li>
                        <li class="active" role="presentation"><a href="#step2" data-toggle="tab"
                                                                  aria-controls="step2" role="tab"
                                                                  title="Lesson Creation"><span
                                    class="round-tab"> <i class="glyphicon glyphicon-folder-open"></i></span> </a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div id="step1" class="tab-pane" role="tabpanel">

                    </div>
                    <div id="step2" class="tab-pane active" role="tabpanel">
                        <form>
                            <div class="col-lg-6 col-lg-offset-0 col-md-6">
                                <div id="data"></div>
                                <div id="folder_content_container" class="folder_content_container">
                                    <div id="fileuploader" class="mdl-cell--12-col-desktop">Upload Files</div>
                                    <input type="button" id="start_upload" value="Start Uploading">
                                    <input type="button" id="add_quiz" value="Add Quiz">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <table class="table" id="file_container">

                                </table>
                                <ul class="list-inline pull-right">
                                    <li>
                                        <?php $logged_in = $this->session->userdata('logged_in'); ?>
                                        <?php if($logged_in['su']==1): ?>
                                            <a href="<?php echo site_url('lessons/')?>?notif=yes"><button class="btn btn-primary btn-info-full next-step" id="Done"
                                                                                                            type="button">Done</button></a>
                                        <?php else: ?>
                                            <a href="<?php echo site_url('workspace/')?>?notif=yes"><button class="btn btn-primary btn-info-full next-step" id="Done"
                                                                                                          type="button">Done</button></a>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>

                        </form>

                    </div>
                    <div id="step3" class="tab-pane" role="tabpanel"></div>
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
                    <p class="copyright">Powered by Click Innovation � 2017</p>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
    $(document).ready(function () {

        var lesson_id = <?php echo $lesson_id ?>;
        var author = <?php echo $author ?>;
        var duplicated = <?php echo $duplicated ?>;
        var folder_name;
        var folder_id_counter = 0;
        var current_selected;
        var lesson_folder_id;
        var lesson_contents_id;
        var lesson_contents;
        var selected_quiz_array = new Array();

        var to_update_folder;
        var to_update_id;


        function update_file_table(to_update_folder, to_update_id) {
            $.ajax({
                url: "<?php echo site_url('lessons/update_files');?>",
                type: "POST",
                data: {folder_name: to_update_folder, lesson_id: to_update_id}
            }).done(function (values) {
                lesson_contents = JSON.parse(values);
                var append;
                var link;
                $("#file_container").empty();
                $.each(lesson_contents, function (key, value) {
                    if (value['content_type'] == "quiz") {
                        console.log("quiz");
                        append = "<tr><td>" + value['content_name'] + "</td><td>quiz</td><td><button id='" + value['id'] + "' name='" + value['content_name'] + "' class='delete_file_content_haha'>Delete</button></td></tr>";
                        $("#file_container").append(append);
//                        var quiz_id = value['content'];
//                        $.ajax({
//                                url: "<?php //echo site_url('lessons/get_quiz');?>//",
//                            type: "POST",
//                            data: {quid: quiz_id}
//                        }).done(function (value) {
//                            value = JSON.parse(value);
//                            value['content'] = value.quiz_name;
//
//
//
//                        });
                    } else {
                        link = "<?php echo base_url('upload/lessons/')?>/" + lesson_id + "_" + folder_name + "/" + value['content_name'];
                        append = "<tr><td style='cursor:pointer'><a href='" + link + "' target='_blank'>" + value['content_name'] + "</a></td>" +
                            "<td>" + value['content_type'] + "</td><td><button id='" + value['id'] + "' name='" + value['content_name'] + "' type='button' class='delete_file_content_haha'>Delete</button></td></tr>";
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
            allowedTypes: "jpg,png,gif,pptx,ppt,mp4,pdf,docx,doc,odp",
            uploadStr: "Upload Files",
            sequential: true,
            sequentialCount: 1,
            autoSubmit: false,
            showDelete: true,
            formData: {key1: 'value1', key2: 'value2'},
            dynamicFormData: function () {
                var data = {lesson_id: lesson_id, folder_name: folder_name, author: author};
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
                    data: {
                        content: files,
                        content_type: "file",
                        lesson_id: lesson_id,
                        author: author,
                        folder_name: folder_name,
                        duplicated: duplicated
                    }
                }).done(function (values) {
                    values = JSON.parse(values);

                    to_update_folder = values['folder_name'];
                    to_update_id = values['lesson_id'];

                    update_file_table(to_update_folder, to_update_id);
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
                        resp = JSON.parse(resp);
                        update_file_table(folder_name, lesson_id);

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
                    update_file_table(folder_name, lesson_id);
                    uploadObj.reset();

                });
        });

        $("#folder_name_container").hide();

        //JS tree initialization
        $('#data').jstree({
            'core': {
                "check_callback": true,
                'data': [
                    {"id": "1", "text": "Engage"},
                    {"id": "2", "text": "Explore"},
                    {"id": "3", "text": "Explain"},
                    {"id": "4", "text": "Extend"},
                    {"id": "5", "text": "Evaluate"},
                    {"id": "6", "text": "Lesson Plan"},
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
//                $(this).find("#" + data.selected[0]).find("a").after('<input type="button" class="open_folder folder_action_button" id="open_folder_' + data.selected[0] + '" value="Open Folder" />');
                $("#folder_content_container").hide();
                if (data.selected[0] == 1) {
                    folder_name = "Engage";
                } else if (data.selected[0] == 2) {
                    folder_name = "Explore";
                } else if (data.selected[0] == 3) {
                    folder_name = "Explain";
                } else if (data.selected[0] == 4) {
                    folder_name = "Extend";
                } else if (data.selected[0] == 5) {
                    folder_name = "Evaluate";
                } else if (data.selected[0] == 6) {
                    folder_name = "Lesson Plan";
                }
                uploadObj.reset();
                $("#folder_content_container").show();
                update_file_table(folder_name, lesson_id);

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
                        $.each(checked_values, function (key, value) {
                            var values = $(value).attr("value");
                            selected_quiz_array.push(values);
                        });
                        $.ajax({
                            url: "<?php echo site_url('lessons/add_quizzes_to_lessons');?>",
                            type: "POST",
                            data: {
                                selected_quizzes: selected_quiz_array,
                                lesson_id: lesson_id,
                                folder_name: folder_name,
                                content_type: "quiz"
                            },
                        }).done(function (values) {
                            update_file_table(folder_name,lesson_id);
                        });
                    },
                    create: function () {
                        //jquery
                        var current_url = $(location).attr('href');
                        window.location.replace("<?php echo site_url()?>/assign?redirect="+current_url);
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
            var selected_quiz = $(event.currentTarget).attr("joeven");

            if ($(event.currentTarget).is(":checked")) {
                $(".selected_quiz_tr_" + selected_quiz).css("background-color", "rgb(230,230,230)");
            } else {
                $(".selected_quiz_tr_" + selected_quiz).css("background-color", "");
            }

        });

    });
</script>