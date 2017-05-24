<div class="container">
    <h3><?php echo $title; ?></h3>

    <div class="row">

        <div class="col-lg-6">
            <form method="post" action="<?php echo site_url('class_controller/index/'); ?>">
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
    </div>
    <!-- /.row -->


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
                    <th>Class Code</th>
                    <th>Teacher</th>
                    <th>Action</th>
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

                    <tr>
                        <td><?php echo $val['class_code']; ?></td>
                        <td>
                            <?php if($teacher = $user_model->load('savsoft_users','uid',$val['teacher_id'])): ?>
                                <?php echo $teacher['first_name'].' '.$teacher['last_name']; ?>
                            <?php else: ?>
                                <?php echo "N/A"; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('user/edit_user/'.$val['teacher_id']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
                        </td>
                    </tr>


                    <?php
                }
                ?>
            </table>
        </div>

    </div>


    <?php
    if (($limit - ($this->config->item('number_of_rows'))) >= 0) {
        $back = $limit - ($this->config->item('number_of_rows'));
    } else {
        $back = '0';
    } ?>

    <a href="<?php echo site_url('user/index/' . $back); ?>"
       class="btn btn-primary"><?php echo $this->lang->line('back'); ?></a>
    &nbsp;&nbsp;
    <?php
    $next = $limit + ($this->config->item('number_of_rows')); ?>

    <a href="<?php echo site_url('user/index/' . $next); ?>"
       class="btn btn-primary"><?php echo $this->lang->line('next'); ?></a>


</div>