<script type="text/javascript">
    var jQuery_1_12_4 = $.noConflict(true);
</script>

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
                                            value="<?php echo $value['lid'] ?>">Grade <?php echo $value['level_name'] ?></option>
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

                            <button id="add_folder">Add Folder</button>

                            <div id="data"></div>
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

                            <button id="add_folder">Add Folder</button>

                            <div id="data" class="demo"></div>
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
    $(document).ready(function(){

        var lesson_id;
        var folder_id_counter=0;

        //JS tree initialization
        $('#data').jstree({
            'core' : {
                "check_callback": true,
                'data' : []
            }
        }).on('create_node.jstree', function(e, data) {
            console.log('Saved');
        });


        //save lesson to database
        $("#step_1_submit").click(function(e){
            var lesson_name = $("#lesson_name").val();
            var subject_id = $("#subject_id").val();
            var level_id = $("#level_id").val();
            if(lesson_name){
                $.ajax({
                    url: "<?php echo site_url('lessons/save_lesson');?>",
                    type: "POST",
                    data:{lesson_name:lesson_name,subject_id:subject_id,level_id:level_id}
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
                $("#lesson_name").prop("disabled",true)
                $("#subject_id").prop("disabled",true)
                $("#level_id").prop("disabled",true)

            }else{
                $("#lesson_name").focus();
            }

        });

        $("#add_folder").click(function(){

            folder_id_counter++;
            $('#data').jstree().create_node('#', {
                "id": folder_id_counter,
                "text": "Parent-3"
            }, "last", function() {

            });

//            $("#data").jstree("create", $("#somenode"), "inside", { "data":"new_node" }, false, true);
        });
    });
</script>