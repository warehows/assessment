<div class="container">
    <h1>Student Dashboard</h1>
    <div id="update_notice"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Tests: <?php echo count($result); ?></div>
                            <div>New Test: <?php echo count($has_new_quiz); ?></div>
                            <div>Unfinished Test: <?php echo $unfinished_test; ?></div>
                            <div>Finished Test: <?php echo count($result_model)?></div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('quiz'); ?>">
                    <div class="panel-footer">
                        <span
                            class="pull-left"><?php echo $this->lang->line('quiz'); ?><?php echo $this->lang->line('list'); ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>



        <div class="row"></div>



    </div>
