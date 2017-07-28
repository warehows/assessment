<?php $this->load->helper('url'); ?>
<div>
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean" style="background-color: #ff4e3b!important;">
         <div class="container">
            <div class="navbar-header"><img style="height: 45px!important;" class="navbar-brand image_logo" src="<?php echo base_url('css/new_material/img/brainee.png'); ?>" alt="School Logo" >

            </div>

        </div>
    </nav>
</div>
<div class="contact-clean">
    <form method="post" method="post" action="<?php echo site_url('login/verifylogin'); ?>">

        <h2 align="center" style="margin-top:-10px!important;">St. Therese Private School</h2>
        <p align="center" style="margin-top:-30px!important;">Learning Management System</p>

        <div class="illustration" style="margin-top:-20px!important;"><img style="height: 190px!important;" class="navbar-brand image_logo" src="<?php echo base_url('css/new_material/img/steps.png'); ?>" alt="School Logo" ></div>

        <?php
        if ($this->session->flashdata('message')) {
        ?>
            <div class="form-group has-feedback has-error">
                <input class="form-control" type="text" name="email" placeholder="ID Number"><i
                    class="form-control-feedback glyphicon glyphicon-remove" aria-hidden="true"></i>

                <p class="help-block">Please enter the correct credentials</p>
            </div>


            <?php
        }else{
        ?>
            <div class="form-group has-feedback">
                <input class="form-control" type="text" name="email" placeholder="User ID" inputmode="email">
            </div>

        <?php } ?>
        <?php
        if ($this->session->flashdata('message')) {
        ?>
        <div class="form-group has-feedback has-error">
            <input class="form-control" type="password" name="password" placeholder="Password"><i
                class="form-control-feedback glyphicon glyphicon-remove" aria-hidden="true"></i>

            <p class="help-block">Please enter the correct credentials</p>
        </div>
            <?php
        }else{
        ?>
            <div class="form-group has-feedback">
                <input class="form-control" type="password" name="password" placeholder="Password">

                <p class="help-block" align="center">Please enter the correct credentials</p>
            </div>

        <?php } ?>
        <div class="form-group" align="center">

            <button class="btn btn-primary btn-block" type="submit">Log In</button>
            <a href="#" class="forgot">Forgot your email or password?</a>
        </div>
    </form>
</div>