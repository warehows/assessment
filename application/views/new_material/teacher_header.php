<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click</title>
    <link href="<?php echo base_url('css/new_material/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link href="<?php echo base_url('css/new_material/css/Contact-Form-Clean.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/new_material/css/Footer-Clean.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="<?php echo base_url('css/new_material/css/Navigation-Clean1.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/new_material/css/MUSA_form-wizard.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/new_material/css/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/Navigation-Clean1.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="<?php echo base_url('js/basic.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
</head>

<body>


<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean" style="background-color: #ff4e3b!important;">
    <div class="container">
        <div class="navbar-header"><a href="<?php echo site_url('dashboard');?>"> <img style="height: 45px!important;" class="navbar-brand image_logo" src="<?php echo base_url('css/new_material/img/brainee.png'); ?>" alt="School Logo" >
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></a>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">

                <li role="presentation"><a href="<?php echo site_url('lessonbank');?>">Lesson Bank</a></li>
                <li role="presentation"><a href="<?php echo site_url('workspace');?>">My Lesson</a></li>
                <li role="presentation"><a href="<?php echo site_url('calendar/');?>">My Task</a></li>
                <li role="presentation"><a href="<?php echo site_url('result');?>">Report</a></li>

                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Account<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" style="background-color: #ff4e3b!important;">
                        <li role="presentation"><a href="<?php echo site_url('user/edit_user');?>">Change Password</a></li>
                        <li role="presentation"><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>





