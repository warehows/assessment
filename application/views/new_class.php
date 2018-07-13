<div class="container">
    <h3><?php echo $title;?></h3>
    <div class="row">
        <form method="post" action="<?php echo site_url('class_controller/insert_class/');?>">

            <div class="col-md-8">
                <br>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <?php
                        if($this->session->flashdata('message')){
                            echo $this->session->flashdata('message');
                        }
                        ?>
                        <div id="section" class="form-group">
                            <label><?php echo "Section";?></label>
                            <select class="form-control" name="group">
                                <option value="0">Select Section</option>
                                <?php foreach ($groups as $group): ?>
                                    <option value="<?php echo $group['gid']; ?>"><?php echo $group['group_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="subject" class="form-group">
                            <label><?php echo "Subject";?></label>
                            <select class="form-control" name="subject">
                                <option value="0">Select Subject</option>
                                <?php foreach ($subject as $subj): ?>
                                    <option value="<?php echo $subj['cid']; ?>"><?php echo $subj['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="teacher" class="form-group">
                            <label><?php echo "Teacher";?></label>
                            <select class="form-control" name="teacher">
                                <option value="0">Select Teacher</option>
                                <?php foreach ($teacher as $teach): ?>
                                    <option value="<?php echo $teach['uid']; ?>"><?php echo $teach['last_name'].', '.$teach['first_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
