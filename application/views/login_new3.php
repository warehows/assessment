<form id="form" style="font-family:Quicksand, sans-serif;background-color:#ffffff;width:320px;padding:40px;" action="<?php echo site_url('login/verifylogin'); ?>">
    <?php
    if ($this->session->flashdata('message')) {
        ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
    }
    ?>
    <div><img class="img-rounded img-responsive" src="<?php echo base_url('images/brainee.png'); ?>" id="image" style="width:auto;height:auto;" /></div>
    <h4 id="head"  style="color:rgb(0,0,0);">Learning Management System</h4>
    <div class="form-group">
        <input class="form-control" type="text" name="email" id="formum" placeholder="Email">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password" id="formum2" placeholder="Password">
    </div>
    <div class="form-group"></div>
    <button class="btn btn-default" type="submit" id="butonas" style="width:100%;height:100%;margin-bottom:10px;background-color:rgb(106,176,209);">LOGIN </button>

</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>