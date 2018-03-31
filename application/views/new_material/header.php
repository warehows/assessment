<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('css/version_1/styles.min.css'); ?>">

</head>

<body>
<div>
    <nav class="navbar navbar-default navigation-clean">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand navbar-link"><img src="<?php echo base_url('images/brainee.png'); ?>" /></a>
                <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="<?php echo site_url('dashboard'); ?>">Home </a></li>
                    <li role="presentation"><a href="#">eBooks </a></li>
                    <li role="presentation"><a href="<?php echo site_url('lessonbank'); ?>">Lesson Bank</a></li>
                    <li role="presentation"><a href="<?php echo site_url('lessons'); ?>">My Lesson</a></li>
                    <li role="presentation"><a href="<?php echo site_url('assign'); ?>">My Test</a></li>
                    <li role="presentation"><a href="<?php echo site_url('result'); ?>">Result </a></li>
                    <li role="presentation"><a href="#">Partners </a></li>
                    <li role="presentation"><a href="#">Contact Us</a></li>
                    <li class="dropdown"><a data-toggle="dropdown" aria-expanded="true" href="#" class="dropdown-toggle">Settings <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li role="presentation"><a href="#">Change Password</a></li>
                            <li role="presentation"><a href="<?php echo site_url('user/logout'); ?>">Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>