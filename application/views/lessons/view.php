<?php $posts['lesson_id'] = $lesson_id ?>
<?php $posts['author'] = $author ?>
<?php if ($logged_in['su'] == 1) { ?>
    <?php $posts['duplicated'] = 0 ?>
<?php } ?>
<?php if ($logged_in['su'] == 2) { ?>
    <?php $posts['duplicated'] = 1 ?>
<?php } ?>
<?php if ($logged_in['su'] == 0) { ?>
    <?php $posts['duplicated'] = 1 ?>
<?php } ?>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="three wizard">
                <h2>Lesson Information</h2>
                <?php $this->load->view('lessons/view_folder', $posts) ?>
            </div>
        </div>
    </div>
</div>

