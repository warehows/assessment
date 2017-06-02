<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    <!-- bootstrap css -->
    <link href="<?php echo base_url('css/material/fonts/material-icons.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="<?php echo base_url('css/material/css/material.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/material/css/material2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/material/css/stepper.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('css/material/css/styles.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/material/css/cust_stepper.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/material/css/material-datetime-picker.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/material/css/mdl_dp_modal.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/material/css/dataTables.material.min.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('css/material/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/bs-animation.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/material.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/material.min.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/navigation.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/stepper.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/dataTables.material.min.js'); ?>"></script>
    <script src="<?php echo base_url('css/material/js/jquery-1.12.4.js'); ?>"></script>
    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>
    <!--    <script src="--><?php //echo base_url('css/material/js/stepper.min.js'); ?><!--"></script>-->



    <style>
        .drawer-header{
            box-sizing:border-box;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            padding:16px;
            height:151px;
            background:url(<?php echo base_url('css/material/img/nav_header.jpg'); ?>);
            background-size:cover;
        }

    </style>
</head>
<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <div class="brand_logo"><img src="<?php echo base_url('css/material/img/main_logo.png'); ?>" alt="Brand Logo" width="100%" height="100%"
                                         class="brand_logo_img"></div>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <header class="drawer-header"><img src="<?php echo base_url('css/material/img/user-placeholder.png'); ?>" class="avatar">

            <div class="avatar-dropdown"><span>admin@example.com </span>

                <div class="mdl-layout-spacer"></div>
                <button class="btn btn-default mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"
                        type="button" id="accbtn"><i class="material-icons">settings</i></button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                    <li class="mdl-menu__item">Item 1</li>
                </ul>
            </div>
            <span>Teacher </span></header>

        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="<?php echo site_url('dashboard');?>">Dashboard</a>
            <a id="users" class="mdl-navigation__link">Users
                <i class="material-icons" >keyboard_arrow_down</i>
            </a>
            <nav id="users_submenu" class="sub-navigation " style="display: none;">
                <a class="mdl-navigation__link" href="<?php echo site_url('user/new_user');?>">Add new</a>

                <a class="mdl-navigation__link" href="<?php echo site_url('user');?>">Users List</a>
            </nav>

            <a id="qbank" class="mdl-navigation__link" >Question Bank
                <i class="material-icons" >keyboard_arrow_down</i>
            </a>

            <nav id="qbank_submenu" class="sub-navigation " style="display: none;">
                <a class="mdl-navigation__link" href="<?php echo site_url('qbank/pre_new_question');?>">Add new</a>
                <a class="mdl-navigation__link" href="<?php echo site_url('qbank');?>">Question List</a>
            </nav>

            <a id="quiz" class="mdl-navigation__link" >Quiz
                <i class="material-icons" >keyboard_arrow_down</i>
            </a>
            <nav id="quiz_submenu" class="sub-navigation " style="display: none;">
                <a class="mdl-navigation__link" href="<?php echo site_url('quiz/add_new');?>">Add new</a>
                <a class="mdl-navigation__link" href="<?php echo site_url('quiz');?>">Quiz List</a>
            </nav>
            <a class="mdl-navigation__link" href="<?php echo site_url('result');?>">Result</a>
            <a id="class" class="mdl-navigation__link" >Class
                <i class="material-icons" >keyboard_arrow_down</i>
            </a>
            <nav id="class_submenu" class="sub-navigation " style="display: none;">
                <a class="mdl-navigation__link" href="<?php echo site_url('class_controller/new_class');?>">Add Class</a>
                <a class="mdl-navigation__link" href="<?php echo site_url('class_controller/');?>">Class List</a>
            </nav>
            <a class="mdl-navigation__link" href="<?php echo site_url('assign');?>">Assign Quiz</a>
            <a class="mdl-navigation__link" href="<?php echo site_url('lessons');?>">Create Lessons</a>
            <a  id="settings" class="mdl-navigation__link" >Settings
                <i class="material-icons" >keyboard_arrow_down</i>
            </a>
            <nav id="settings_submenu" class="sub-navigation " style="display: none;">
                <a class="mdl-navigation__link" href="<?php echo site_url('user/group_list');?>">Section</a>
                <a class="mdl-navigation__link" href="<?php echo site_url('qbank/category_list');?>">Subjects</a>
                <a class="mdl-navigation__link" href="<?php echo site_url('qbank/level_list');?>">Year/Level</a>
            </nav>
            <a class="mdl-navigation__link" href="">Logout</a>
        </nav>

    </div>
    <main class="mdl-layout__content">










