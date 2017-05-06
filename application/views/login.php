<?php $this->load->helper('url'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/material/mdl/material.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/material/mdl/material.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/material/css/user.css">

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">Login</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>

        </div>
    </header>

    <main class="mdl-layout__content">
        <div class="page-content">


            <div class="avatar-login" align="center">
                <img src="<?php echo base_url(); ?>css/material/img/user-placeholder.png" alt="School Logo" class="avatar-img">
            </div>


            <form method="post" method="post" action="<?php echo site_url('login/verifylogin'); ?>">
                <?php
                if ($this->session->flashdata('message')) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php
                }
                ?>
                <div class="mdl-cell mdl-cell--12-col" align="center">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="email" id="inputEmail" name="email" />
                        <label class="mdl-textfield__label" for="inputEmail">Email Address</label>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--12-col" align="center">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" name="password" id="userpass" />
                        <label class="mdl-textfield__label" for="userpass">Password</label>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--12-col send-button" align="center">

                    <button type="submit"  class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--raised mdl-button--colored mdl-color--primary">Login</button>
                    <button type="submit"  class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--raised mdl-button--colored mdl-color--primary">Forgot password</button>
                </div>
            </form>





        </div>
    </main>
</div>

<script type='text/javascript' src="<?php echo base_url(); ?>css/material/mdl/material.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>css/material/mdl/material.min.js"></script>

<!--<div class="row" style="border-bottom:1px solid #dddddd;">-->
<!--    <div class="container">-->
<!--        <div class="col-md-1">-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-1">-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!--</div>-->

<!--<div class="row" style="margin-top:20px;">-->
<!--    <div class="container">-->
<!---->
<!--        <div class="col-md-4 col-md-offset-4">-->
<!---->
<!--            <div class="login-panel panel panel-default">-->
<!--                <div class="panel-body">-->
<!---->
<!---->
<!--                    <form class="form-signin" method="post" action="--><?php //echo site_url('login/verifylogin'); ?><!--">-->
<!--                        <h3 class="form-signin-heading">--><?php //echo "Assessment Login" ?><!--</h3>-->
<!--                        --><?php
//                        if ($this->session->flashdata('message')) {
//                            ?>
<!--                            <div class="alert alert-danger">-->
<!--                                --><?php //echo $this->session->flashdata('message'); ?>
<!--                            </div>-->
<!--                            --><?php
//                        }
//                        ?>
<!--                        <div class="form-group">-->
<!--                            <label for="inputEmail"-->
<!--                                   class="sr-only">--><?php //echo $this->lang->line('email_address'); ?><!--</label>-->
<!--                            <input type="email" id="inputEmail" name="email" class="form-control"-->
<!--                                   placeholder="--><?php //echo $this->lang->line('email_address'); ?><!--" required autofocus>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="inputPassword"-->
<!--                                   class="sr-only">--><?php //echo $this->lang->line('password'); ?><!--</label>-->
<!--                            <input type="password" id="inputPassword" name="password" class="form-control"-->
<!--                                   placeholder="--><?php //echo $this->lang->line('password'); ?><!--" required>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!---->
<!--                            <button class="btn btn-lg btn-primary btn-block"-->
<!--                                    type="submit">--><?php //echo $this->lang->line('login'); ?><!--</button>-->
<!--                        </div>-->
<!---->
<!---->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!---->
<!--    </div>-->
<!---->
<!--</div>-->