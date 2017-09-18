<div class="container">
    <h1>Students Quiz List</h1>
    <?php
    $logged_in = $this->session->userdata('logged_in');
    $result_model = $quiz_model->get_result_model();
    ?>

    <h3><?php echo $title; ?></h3>
    <?php
    if ($logged_in['su'] > '0') {
        ?>
        <div class="row">

            <div class="col-lg-6">
                <form method="post" action="<?php echo site_url('quiz/index/0/' . $list_view); ?>">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search"
                               placeholder="<?php echo $this->lang->line('search'); ?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search'); ?></button>
      </span>


                    </div>
                    <!-- /input-group -->
                </form>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <p style="float:right;">
                    <?php
                    if ($list_view == 'grid') {
                        ?>
                        <a href="<?php echo site_url('quiz/index/' . $limit . '/table'); ?>"><?php echo $this->lang->line('table_view'); ?></a>
                        <?php
                    } else {
                        ?>
                        <a href="<?php echo site_url('quiz/index/' . $limit . '/grid'); ?>"><?php echo $this->lang->line('grid_view'); ?></a>

                        <?php
                    }
                    ?>
                </p>

            </div>
        </div><!-- /.row -->

        <?php
    }
    ?>

    <div class="row">

        <div class="col-md-12">
            <br>
            <?php
            if ($this->session->flashdata('message')) {
                echo $this->session->flashdata('message');
            }
            ?>

            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th><?php echo 'Title'; ?></th>
                    <th><?php echo 'Subject'; ?></th>
                    <th><?php echo 'Assigned By'; ?></th>
                    <th><?php echo $this->lang->line('noq'); ?></th>
                    <th><?php echo $this->lang->line('quiz_status'); ?></th>
                    <th><?php echo 'Start Date'; ?></th>
                    <th><?php echo 'Expiration'; ?></th>
                    <th>Attempts</th>
                    <th><?php echo $this->lang->line('action'); ?> </th>
                </tr>
                <?php
                if (count($result) == 0) {
                    ?>
                    <tr>
                        <td colspan="3"><?php echo $this->lang->line('no_record_found'); ?></td>
                    </tr>


                    <?php
                }
                foreach ($result as $key => $val) {
                    ?>
                    <?php $name = array(); ?>
                    <?php $name['first'] = $quiz_model->assigned_by($val['with_login'])['first_name']; ?>
                    <?php $name['last'] = $quiz_model->assigned_by($val['with_login'])['last_name']; ?>
                    <?php $start_date = null;
                    $end_date = null;
                    $days_left = 'N/A' ?>
                    <?php
                    $timestamp = date('Y-m-d H:i:s');
                    if ($val['start_date'] && $val['end_date']) {
                        $start_date = date('Y-m-d H:i:s', $val['start_date']);

                        $end_date = date('Y-m-d H:i:s', $val['end_date']);
                        $expires = strtotime('+0 days', strtotime(date($end_date)));
                        $date_diff = ($expires - strtotime($timestamp)) / 86400;
                        $days_left = round($date_diff, 0);
                    }
                    $no_of_attempts = count($result_model->get_student_result($logged_in['uid'], $val['quid']));
                    ?>

                    <?php if ($days_left > 0): ?>
                    <tr>
                        <td><?php echo $val['quid']; ?></td>
                        <td><?php echo substr(strip_tags($val['quiz_name']), 0, 50); ?></td>
                        <td><?php echo !empty($val['cid']) ? $quiz_model->get_category($val['cid'])['category_name'] : 'N/A' ?></td>
                        <td><?php echo $name['first'] . ' ' . $name['last']; ?></td>
                        <td><?php echo $val['noq']; ?></td>
                        <?php $status = $result_model->getStatus($logged_in['uid'], $val['quid']); ?>
                        <td>
                            <?php if (!$status) { ?>
                                <?php echo 'Pending'; ?>
                            <?php } else {
                                ; ?>
                                <?php echo $status;
                            }; ?>
                        </td>
                        <td><?php echo $start_date; ?></td>
                        <td><?php echo $end_date; ?>
                            <?php echo $days_left > 0 ? ' (' . $days_left . ' days left)' : 'Expired'; ?></td>
                        <td><?php echo $no_of_attempts . '/' . $val['maximum_attempts']; ?></td>



                            <td>
                                <a href="<?php echo site_url('quiz/quiz_detail/' . $val['quid']); ?>"
                                   class="<?php echo $no_of_attempts >= $val['maximum_attempts'] ? 'disabled' : ''; ?> btn btn-success"><?php echo $no_of_attempts >= $val['maximum_attempts'] ? 'Finished' : ''; ?> </a>

                                <?php
                                if ($logged_in['su'] > '0') {
                                    ?>

                                    <a href="<?php echo site_url('quiz/edit_quiz/' . $val['quid']); ?>"><img
                                            src="<?php echo base_url('images/edit.png'); ?>"></a>
                                    <a href="javascript:remove_entry('quiz/remove_quiz/<?php echo $val['quid']; ?>');"><img
                                            src="<?php echo base_url('images/cross.png'); ?>"></a>
                                    <?php
                                }
                                ?>
                            </td>
                        <?php endif; ?>

                    </tr>

                    <?php
                }
                ?>
            </table>


        </div>

    </div>
    <br><br>

    <?php
    if (($limit - ($this->config->item('number_of_rows'))) >= 0) {
        $back = $limit - ($this->config->item('number_of_rows'));
    } else {
        $back = '0';
    } ?>

    <a href="<?php echo site_url('quiz/index/' . $back . '/' . $list_view); ?>"
       class="btn btn-primary"><?php echo $this->lang->line('back'); ?></a>
    &nbsp;&nbsp;
    <?php
    $next = $limit + ($this->config->item('number_of_rows')); ?>

    <a href="<?php echo site_url('quiz/index/' . $next . '/' . $list_view); ?>"
       class="btn btn-primary"><?php echo $this->lang->line('next'); ?></a>

</div>