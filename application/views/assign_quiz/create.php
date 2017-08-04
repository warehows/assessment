<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
            <div class="three wizard">
                <form action="<?php echo site_url('assign/create') ?>" method="GET">
                    <?php if ($next_page == "assign_quiz/modify_info") { ?>

                        <?php $this->load->view($next_page, $all_data) ?>
                        <input type="hidden" id="next_page" name="next_page" value="assign_quiz/redirect">
                        <input type="hidden" id="previous_page" name="previous_page" value="">


                    <?php } ?>


                    <?php if ($next_page == "assign_quiz/redirect") { ?>
                        <?php $redirect = $this->input->get();
                        $quid = $redirect["quid"]; ?>
                        <?php redirect(site_url('quiz/add_question/') . "/" . $quid) ?>
                        <?php $this->load->view($next_page, $all_data) ?>

                        <input type="hidden" id="next_page" value="assign_quiz/add_questions">
                        <input type="hidden" id="previous_page" value="">

                    <?php } ?>

                </form>
            </div>
        </div>
    </div>
</div>


