<?php $posts['data'] = $data; ?>
<?php $posts['quid'] = $quid; ?>
<?php $posts['logged_in'] = $logged_in; ?>



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
                <h2>Assign Quiz</h2>
                <?php $this->load->view('assign_quiz/assign_to_students', $posts) ?>
            </div>
        </div>
    </div>
</div>
