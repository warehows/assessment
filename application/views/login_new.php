<style>
.register-photo {
  background:#ffe8c3 repeat-x;
  padding:20px 0;
}

.register-photo .image-holder {
  display:table-cell;
  width:auto;
  background-image: url("http://[::1]/brainee2/css/new_material/img/brainee_home2.jpg");
  background-size:cover;
}

.register-photo .form-container {
  display:table;
  max-width:900px;
  width:90%;
  margin:0 auto;
  box-shadow:1px 1px 5px rgba(0,0,0,0.1);
}

.register-photo form {
  display:table-cell;
  width:400px;
  background-color:#ffffff;
  padding:40px 60px;
  color:#505e6c;
}

@media (max-width:991px) {
  .register-photo form {
    padding:40px;
  }
}

.register-photo form h2 {
  font-size:24px;
  line-height:1.5;
  margin-bottom:30px;
}

.register-photo form .form-control {
  background:#f7f9fc;
  border:none;
  border-bottom:1px solid #dfe7f1;
  border-radius:0;
  box-shadow:none;
  outline:none;
  color:inherit;
  text-indent:6px;
  height:40px;
}

.register-photo form .checkbox {
  font-size:13px;
  line-height:20px;
}

.register-photo form .btn-primary {
  background:#f4476b;
  border:none;
  border-radius:4px;
  padding:11px;
  box-shadow:none;
  margin-top:35px;
  text-shadow:none;
  outline:none !important;
}

.register-photo form .btn-primary:hover, .register-photo form .btn-primary:active {
  background:#eb3b60;
}

.register-photo form .btn-primary:active {
  transform:translateY(1px);
}

.register-photo form .already {
  display:block;
  text-align:center;
  font-size:12px;
  color:#6f7a85;
  opacity:0.9;
  text-decoration:none;
}

.register-photo .illustration {
  text-align:center;
}


</style>


<div class="register-photo">
<div>

</div>
<div class="form-container">
    <div class="image-holder"></div>
    <form method="post" method="post" action="<?php echo site_url('login/verifylogin'); ?>">

        <h2 align="center" style="  margin-top:-25px!important;
">St. Therese Private School</h2>
        <p align="center" style="  margin-top:-30px!important;
">Learning Management System</p>

        <!--<div class="avatar-login" align="center"><img style=" margin-top:-15px!important; height: 200px!important; width: 200px!important;"  class="img-responsive avatar-img" src="<?php echo base_url('css/new_material/img/steps.png'); ?>" alt="School Logo"/></div>-->
        <div class="illustration" style="margin-top:-20px!important;"><img style="align: center!important; height: 190px!important;" class="navbar-brand image_logo" src="<?php echo base_url('css/new_material/img/steps.png'); ?>" alt="School Logo" align="center"></div>
        <!--<div class="illustration" style="margin-top:-20px!important;"><img style="height: 190px!important;" class="navbar-brand image_logo" src="<?php /*echo base_url('css/new_material/img/steps.png'); */?>" alt="School Logo" ></div>-->

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
</div>