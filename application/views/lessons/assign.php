<?php $posts['lesson_id'] = $lesson_id ?>
<?php $posts['author'] = $author ?>
<?php $posts['all_subjects'] = $all_subjects ?>
<?php $posts['all_sections'] = $all_sections ?>
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
                <h2>Assigning</h2>
                <?php $this->load->view('lessons/assign_to_students', $posts) ?>

            </div>
        </div>
    </div>
</div>
