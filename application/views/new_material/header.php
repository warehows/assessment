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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>

<body>


<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Logo Here</a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation"><a href="<?php echo site_url('user');?>">Account </a></li>
                <li role="presentation"><a href="<?php echo site_url('lessons/');?>">Create Lesson</a></li>
                <li role="presentation"><a href="<?php echo site_url('user/new_user');?>">New User</a></li>
                <li role="presentation"><a href="<?php echo site_url('qbank/pre_new_question');?>">New Question</a></li>
                <li role="presentation"><a href="<?php echo site_url('quiz');?>">Quiz List</a></li>
                <li role="presentation"><a href="<?php echo site_url('quiz/add_new');?>">New Quiz</a></li>
                <li role="presentation"><a href="<?php echo site_url('result');?>">Result</a></li>
                <li role="presentation"><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

