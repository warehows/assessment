<div class="row" style="border-bottom:1px solid #dddddd;">
    <div class="container">
        <div class="col-md-1">
        </div>

        <div class="col-md-1">

        </div>

    </div>

</div>

<div class="row" style="margin-top:20px;">
    <div class="container">

        <div class="col-md-4 col-md-offset-4">

            <div class="login-panel panel panel-default">
                <div class="panel-body">


                    <form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin'); ?>">
                        <h3 class="form-signin-heading"><?php echo "Assessment Login" ?></h3>
                        <?php
                        if ($this->session->flashdata('message')) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <label for="inputEmail"
                                   class="sr-only"><?php echo $this->lang->line('email_address'); ?></label>
                            <input type="email" id="inputEmail" name="email" class="form-control"
                                   placeholder="<?php echo $this->lang->line('email_address'); ?>" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword"
                                   class="sr-only"><?php echo $this->lang->line('password'); ?></label>
                            <input type="password" id="inputPassword" name="password" class="form-control"
                                   placeholder="<?php echo $this->lang->line('password'); ?>" required>
                        </div>
                        <div class="form-group">

                            <button class="btn btn-lg btn-primary btn-block"
                                    type="submit"><?php echo $this->lang->line('login'); ?></button>
                        </div>


                    </form>
                </div>
            </div>

        </div>


    </div>

</div>