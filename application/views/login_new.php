<?php $this->load->helper('url'); ?>
<div>
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Logo Here</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span
                        class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1"></div>
        </div>
    </nav>
</div>
<div class="contact-clean">
    <form method="post" method="post" action="<?php echo site_url('login/verifylogin'); ?>">

        <h3 align="center">St. Therese Private School </h3>

        <div class="avatar-login" align="center"><img
                src="<?php echo base_url('css/new_material/img/263916_142079905869802_5338795_n.jpg'); ?>"
                alt="School Logo" class="avatar-img"></div>
        <?php
        if ($this->session->flashdata('message')) {
        ?>
            <div class="form-group has-feedback has-error">
                <input class="form-control" type="email" name="email" placeholder="Password"><i
                    class="form-control-feedback glyphicon glyphicon-remove" aria-hidden="true"></i>

                <p class="help-block">Please enter the correct credentials</p>
            </div>


            <?php
        }else{
        ?>
            <div class="form-group has-feedback">
                <input class="form-control" type="email" name="email" placeholder="Email" inputmode="email">
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

                <p class="help-block">Please enter the correct credentials</p>
            </div>

        <?php } ?>
        <div class="form-group" align="center">
            <button class="btn btn-primary" type="submit" align="center">Login</button>
            <button class="btn btn-primary" type="button" align="center">Forgot password</button>
        </div>
    </form>
</div>