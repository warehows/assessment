<?php $posts['lesson_id'] = $lesson_id ?>
<?php $posts['author'] = $author ?>
<?php $posts['all_subjects'] = $all_subjects ?>
<?php $posts['all_levels'] = $all_levels ?>
<?php $posts['author'] = $author ?>
<?php $posts['logged_in'] = $logged_in ?>
<?php if ($logged_in['su'] == 1) { ?>
    <?php $posts['duplicated'] = 0 ?>
<?php } ?>
<?php if ($logged_in['su'] == 0) { ?>
    <?php $posts['duplicated'] = 1 ?>
<?php } ?>
<?php if ($logged_in['su'] == 2) { ?>
    <?php $posts['duplicated'] = 1 ?>
<?php } ?>

<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
            <div class="three wizard">
                <h2>Lesson Information Edit</h2>
                <?php $this->load->view('lessons/modify_lesson_info', $posts) ?>
                <?php $this->load->view('lessons/modify_folder', $posts) ?>
                <div class="col-lg-6 col-md-6">
                    <table class="table" id="file_container">

                    </table>
                    <ul class="list-inline pull-right">
                        <li>
                            <?php if ($logged_in['su'] == 2) { ?>
                                <a href="<?php echo site_url('workspace/')?>"><button class="btn btn-primary btn-info-full next-step" id="Done"
                                                                                              type="button">Done</button></a>
                            <?php } ?>

                            <?php if ($logged_in['su'] == 1) { ?>
                                <a href="<?php echo site_url('lessons/')?>"><button class="btn btn-primary btn-info-full next-step" id="Done"
                                                                                      type="button">Done</button></a>
                            <?php } ?>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
