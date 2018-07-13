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
                                <input type="text" class="mdl-textfield__input " id="new_quiz_name"
                                       placeholder="Lesson Title"/>
                            </div>

                            <h7>Subject</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <select class="mdl-textfield__input " id="subject">
                                    <?php foreach ($all_subjects as $key => $value) { ?>

                                        <option
                                            value="<?php echo $value['cid'] ?>"><?php echo $value['category_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <h7>Section</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <select class="mdl-textfield__input " id="subject">
                                    <?php foreach ($all_levels as $key => $value) { ?>

                                        <option
                                            value="<?php echo $value['lid'] ?>">Grade <?php echo $value['level_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                        </div>

                    </div>
                    <div class="mdl-step__actions">
<!--                        <a href="--><?php //echo site_url('lessons/step2')?><!--">-->
                            <button
                            class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                            id="submit"
                            data-stepper-next>
                            Done
                        </button>
<!--                        </a>-->
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
                            <h7 id="test_title_label">Lesson Title</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <input type="text" class="mdl-textfield__input " id="new_quiz_name"
                                       placeholder="Lesson Title"/>
                            </div>

                            <h7>Subject</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <select class="mdl-textfield__input " id="subject">
                                    <?php foreach ($all_subjects as $key => $value) { ?>

                                        <option
                                            value="<?php echo $value['cid'] ?>"><?php echo $value['category_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <h7>Section</h7>
                            <div class="mdl-textfield mdl-js-textfield  extrawide is-upgraded is-dirty">
                                <label for="input_text" class="mdl-textfield__label"></label>
                                <select class="mdl-textfield__input " id="subject">
                                    <?php foreach ($all_levels as $key => $value) { ?>

                                        <option
                                            value="<?php echo $value['lid'] ?>">Grade <?php echo $value['level_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                        </div>

                    </div>
                    <div class="mdl-step__actions">
<!--                        <a href="--><?php //echo site_url('lessons/step2')?><!--">-->
                            <button
                                class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored mdl-button--raised"
                                id="submit"
                                data-stepper-next>
                                Done
                            </button>
<!--                        </a>-->
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>
<script>
    $(document).ready(function(){
        $("span:contains('1')" ).css( "border", "20px solid black" );

    });
</script>
