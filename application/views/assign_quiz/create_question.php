<?php $posts['lesson_id'] = $lesson_id ?>
<?php $posts['author'] = $author ?>
<?php if ($logged_in['su'] == 1) { ?>
    <?php $posts['duplicated'] = 0 ?>
<?php } ?>
<?php if ($logged_in['su'] == 0) { ?>
    <?php $posts['duplicated'] = 1 ?>
<?php } ?>

<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
            <div class="three wizard">
                <?php $this->load->view('lessons/view_folder', $posts) ?>
            </div>
        </div>
    </div>
</div>
