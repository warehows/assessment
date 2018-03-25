<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brainee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="<?php echo base_url('css/version_1/styles.min.css'); ?>">
    <style>
        body{
            background-image:url('<?php echo base_url('images/bg_new.jpg'); ?>');
        }
    </style>
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
                <?php $logged_in = $this->session->userdata('logged_in') ?>
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="<?php echo site_url('dashboard'); ?>">Home </a></li>
                    <li role="presentation"><a href="<?php echo site_url('quiz');?>"><?php echo $this->lang->line('quiz');?> <?php echo $this->lang->line('list');?></a></li>
                    <li role="presentation"><a href="<?php echo site_url('lessons');?>">Lessons</a></li>
                    <li role="presentation"><a href="<?php echo site_url('result/student_index');?>">Report</a></li>
                    <li role="presentation"><a href="<?php echo site_url('user/edit_user/'.$logged_in['uid']);?>">Account</a></li>
                    <li role="presentation"><a href="<?php echo site_url('user/logout');?>">Logout</a></li>

                </ul>
            </div>
        </div>
    </nav>
</div>