<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
            <div class="three wizard">
                <form action="assign/create">
                    <?php if ($page == "assign_quiz/modify_info") { ?>

                        <?php $this->load->view($page, $all_data) ?>
                        <input type="hidden" id="next_page" value="assign_quiz/modify_settings">
                        <input type="hidden" id="previous_page" value="">

                    <?php } ?>

                    <?php if ($page == "assign_quiz/modify_settings") { ?>

                        <?php $this->load->view($page, $all_data) ?>
                        <input type="hidden" id="next_page" value="">
                        <input type="hidden" id="previous_page" value="">

                    <?php } ?>

                </form>
            </div>
        </div>
    </div>
</div>


