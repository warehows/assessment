<style>
    a:hover {
        text-decoration: none;
    }

    .mypanel {
        margin-bottom: 0 !important;
        width: 100% !important;
        border: 0;
        background-color: #f5f5f5;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        position: relative;
        height: 333px;
    }
</style>
<div class="col-lg-12 carousel-nopadding">
    <div class="row pad equal">
        <div class="col-md-8">
            <div data-ride="carousel" class="carousel slide" id="carousel-1">
                <div role="listbox" class="carousel-inner">
                    <div class="item active"><img src="<?php echo base_url('images/banner/banner1.jpg'); ?>"
                                                  alt="Slide Image"/></div>
                    <div class="item"><img src="<?php echo base_url('images/banner/banner2.jpg'); ?>"
                                           alt="Slide Image"/></div>
                    <div class="item"><img src="<?php echo base_url('images/banner/banner3.jpg'); ?>"
                                           alt="Slide Image"/></div>
                </div>
                <div><a href="#carousel-1" role="button" data-slide="prev" class="left carousel-control"><i
                            class="glyphicon glyphicon-chevron-left"></i><span class="sr-only">Previous</span></a>
                    <a href="#carousel-1" role="button" data-slide="next" class="right carousel-control"><i
                            class="glyphicon glyphicon-chevron-right"></i><span class="sr-only">Next</span></a>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-1" data-slide-to="1"></li>
                    <li data-target="#carousel-1" data-slide-to="2"></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel mypanel">
                <div class="panel-heading panel-heading-new">
                    <img class="school-logo" src="<?php echo base_url('images/cura copy.png'); ?>">

                    <h3 class="panel-title-home new-title"> Announcements</h3>
                </div>
                <div class="panel-body panel-body-browse seen-announcements">
                    <a href="#">
                        <div class="panel-body-general">
                            <h3 class="panel-lr-title side-title">No class: Holy Thursday</h3>

                            <p class="panel-lr-body">
                                <small>Brainee Superadmin(admin@brainee.com)</small>
                                <br>
                                <small> April 3, 2018</small>
                            </p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="panel-body-general">
                            <h3 class="panel-lr-title side-title">Enrollment schedule</h3>

                            <p class="panel-lr-body">
                                <small>Brainee Superadmin(admin@brainee.com)</small>
                                <br>
                                <small> April 27, 2018</small>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="panel-footer panel-footer-home">
                    <div class="pull-right">
                            <span>
                                <a class="seeAll" href="   ">See All</a>
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="features-boxed">
    <div class="container">
        <div class="row features">
            <div class="col-md-3 col-sm-6 item">
                <div class="box"><i class="glyphicon glyphicon-user icon"></i>

                    <h3 class="name">About Us </h3>

                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent
                        aliquam in tellus eu.</p><a href="<?php echo site_url('dashboard/about_us'); ?>"
                                                    class="learn-more">Learn more »</a></div>
            </div>
            <div class="col-md-3 col-sm-6 item">
                <div class="box"><i class="glyphicon glyphicon-calendar icon"></i>

                    <h3 class="name">Calendar </h3>

                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus.
                        Praesent aliquam in tellus eu.</p><a href="<?php echo site_url('dashboard/calendar'); ?>"
                                                             class="learn-more">Learn more »</a></div>
            </div>
            <div class="col-md-3 col-sm-6 item">
                <div class="box"><i class="glyphicon glyphicon-bell icon"></i>

                    <h3 class="name">Notifications </h3>

                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent
                        aliquam in tellus eu.</p><a href="<?php echo site_url('dashboard/notifications'); ?>" class="learn-more">Learn more »</a></div>
            </div>
            <div class="col-md-3 col-sm-6 item">
                <div class="box"><i class="glyphicon glyphicon-time icon"></i>

                    <h3 class="name">School Events</h3>

                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent
                        aliquam in tellus eu.</p><a href="<?php echo site_url('dashboard/events'); ?>"
                                                    class="learn-more">Learn more »</a></div>
            </div>
        </div>
    </div>
</div>