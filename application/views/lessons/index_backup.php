<script type="text/javascript">
    var jQuery_1_12_4 = $.noConflict(true);
</script>

<style>
    .folder_content_holder {
        border: 1px solid black;
        height: auto;
        width: 100%;
    }

    .file_content {
        border: 1px solid black;
    }
</style>

<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>

<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>
<script src="<?php echo base_url(); ?>js/jstree/dist/jstree.min.js"></script>

<div class="mdl-stepper-demo">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <!-- markup -->
            <ul class="mdl-stepper mdl-stepper--horizontal " id="demo-stepper-non-linear">
                <li class="mdl-step">
                            <span class="mdl-step__label">
                                <span class="mdl-step__title">
                                    <span class="mdl-step__title-text">Lesson Label</span>
                                </span>
                            </span>

                    <div class="mdl-step__content">

                        <div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                            <h7 id="test_title_label">Lesson Title</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <input type="text" class="mdl-textfield__input " id="lesson_name"
                                       placeholder="Lesson Title"/>
                            </div>

                            <h7>Subject</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <select class="mdl-textfield__input " id="subject_id">
                                    <?php foreach ($all_subjects as $key => $value) { ?>

                                        <option
                                            value="<?php echo $value['cid'] ?>"><?php echo $value['category_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <h7>Grade Level</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <select class="mdl-textfield__input " id="level_id">
                                    <?php foreach ($all_levels as $key => $value) { ?>

                                        <option
                                            value="<?php echo $value['lid'] ?>">
                                            Grade <?php echo $value['level_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                        </div>

                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            id="step_1_submit"
                            data-stepper-next>
                            Done
                        </button>
                    </div>
                </li>
                <li class="mdl-step">
                    <span class="mdl-step__label">
                        <span class="mdl-step__title">
                            <span class="mdl-step__title-text">Lesson Label</span>
                        </span>
                    </span>

                    <div class="mdl-step__content">

                        <div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                            <div id="data"></div>
                            <div id="folder_content_container" class="folder_content_container">
                                <div id="fileuploader" class="mdl-cell--12-col-desktop">Upload Files</div>
                                <input type="button" id="start_upload" value="Start Uploading">

                                <div class="mdl-cell--12-col-desktop">
                                    <table class="table" id="file_container">

                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            id="step_1_submit"
                            data-stepper-next>
                            Done
                        </button>
                    </div>
                    <div id="folder_content">

                    </div>
                </li>
                <li class="mdl-step">
                    <span class="mdl-step__label">
                        <span class="mdl-step__title">
                            <span class="mdl-step__title-text">Lesson Label</span>
                        </span>
                    </span>

                    <div class="mdl-step__content">

                    </div>
                    <div class="mdl-step__actions">
                        <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            id="step_1_submit"
                            data-stepper-next>
                            Done
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>

<script>
    (function () {
        // Stepper non-linear demonstration
        var demoNonLinear = function (e) {
            var element = document.querySelector('.mdl-stepper#demo-stepper-non-linear');

            if (!element) return;

            var stepper = element.MaterialStepper;
            var steps = element.querySelectorAll('.mdl-step');
            var step;
            var lesson_name = $("#lesson_name").val();
            for (var i = 0; i < steps.length; i++) {
                step = steps[i];

//                step.addEventListener('onstepnext', function (e) {
//                        stepper.next();
//                });
            }
            element.addEventListener('onsteppercomplete', function (e) {
                var toast = document.querySelector('#snackbar-stepper-complete');

                if (!toast) return false;

                toast.MaterialSnackbar.showSnackbar({
                    message: 'Stepper non-linear are completed',
                    timeout: 4000,
                    actionText: 'Ok'
                });
            });
        };
        window.addEventListener('load', demoNonLinear);
    })();


</script>

<script>
    $(document).ready(function () {

        var lesson_id;
        var folder_name;
        var folder_id_counter = 0;
        var current_selected;
        var lesson_folder_id;
        var lesson_contents_id;
        var lesson_contents;


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

                    append = "<tr><td>" + value['content'] + "</td><td><button id='" + value['id'] + "' name='" + value['content'] + "' class='delete_file_content'>Delete</button></td></tr>";
                    $("#file_container").append(append);

                });

            });
        }

        var uploadObj = $("#fileuploader").uploadFile({
            url: "<?php echo site_url('/lessons/upload_files')?>",
            showDownload: false,
            dragdropWidth: '100%',
            fileName: "myfile",
            allowedTypes: "jpg,png,gif",
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

        $(document).delegate(".delete_file_content", "click", function (event) {
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
                    console.log(values);
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
                var element = document.querySelector('.mdl-stepper#demo-stepper-non-linear');
                var stepper = element.MaterialStepper;
                var steps = element.querySelectorAll('.mdl-step');
                var step;
                for (var i = 0; i < steps.length; i++) {
                    step = steps[i];

                    step.addEventListener('onstepnext', function (e) {
                        stepper.next();
                    });
                }
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


    });
</script>