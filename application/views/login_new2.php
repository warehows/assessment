<style>
    body {
        background: #ffe8c3;
    }

    .image-holder {
        display: table-cell;
        width: auto;
        background-image: url("http://[::1]/brainee/css/new_material/img/brainee_home2.jpg");
        background-size: cover;
    }

    .school_title {
        text-align: center;
    }

    .system_title {
        text-align: center;
    }
    .school_logo_container{

    }
    .school_logo_container .large{
        height: 270px;
        width: 100%;
    }
    .school_logo_container .small{
        height: 500px;
        width: 100%;
    }
    .form_container{

        background-color: #ffffff;
        color: #505e6c;
    }
    .row{
        padding-top: 3%;
    }
    .modified_separator{
        height: 100%;
        padding: 0;
    }
    .modified_separator img{
        height: 100%;
        width: 100%;

    }


</style>

<div class="container">
    <div class="row">
        <div class="modified_separator col-lg-7 col-md-6 hidden-sm hidden-xs">
            <div class="system_logo_container">
                <img src="<?php echo base_url('css/new_material/img/brainee_home2.jpg')?>"/>
            </div>
        </div>
        <div class="form_container col-lg-5 col-md-6 col-sm-12 col-xs-12">
            <h2 class="school_title">St. Therese Private School</h2>

            <p class="system_title">Learning Management System</p>
            <div class="school_logo_container">
                <img class="large visible-lg visible-md hidden-sm hidden-xs" src="<?php echo base_url('css/new_material/img/steps.png')?>"/>
                <img class="small hidden-lg hidden-md visible-sm visible-xs" src="<?php echo base_url('css/new_material/img/steps.png')?>"/>
            </div>

            <form method="post" method="post" action="<?php echo site_url('login/verifylogin'); ?>">


                <?php
                if ($this->session->flashdata('wrong_credz')) {
                    ?>
                    <div class="form-group has-feedback has-error">
                        <input class="form-control" type="text" name="email" placeholder="ID Number"><i
                            class="form-control-feedback glyphicon glyphicon-remove" aria-hidden="true"></i>

                        <p class="help-block">Please enter the correct credentials</p>
                    </div>


                    <?php
                } else {
                    ?>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="email" placeholder="User ID" inputmode="email">
                    </div>

                <?php } ?>
                <?php
                if ($this->session->flashdata('wrong_credz')) {
                    ?>
                    <div class="form-group has-feedback has-error">
                        <input class="form-control" type="password" name="password" placeholder="Password"><i
                            class="form-control-feedback glyphicon glyphicon-remove" aria-hidden="true"></i>

                        <p class="help-block">Please enter the correct credentials</p>
                    </div>
                    <?php
                } else {
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
    </div>
</div>