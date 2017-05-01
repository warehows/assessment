<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jstree/dist/jstree.min.js"></script>
<style>
    #data{
        border:1px solid black;
        padding:10px;
    }
</style>

<div class="container">
    <?php
    $logged_in = $this->session->userdata('logged_in');
    ?>
    <h1>Assign Quiz</h1>
    <div id="data" class="demo"></div>
    <script>
        $(document).ready(function(){
//            Variable initiation
            var grade_array_count = 6;
            var grade_array = new Array();
            var grade_array_value = new Array();
            var text = "text";
            for(var x =1;x<=grade_array_count;x++){
                grade_array_value = {text:"Grade "+x,id:x,children:Array(
                    {text:"Diamond",children:Array(
                        {text:"Resty Morancil",icon:"jstree-file"},
                        {text:"Jan Ray Monteros",icon:"jstree-file"},
                        {text:"Joeven Cerveza",icon:"jstree-file"}
                    )},
                    {text:"Gold",children:Array(
                        {text:"Resty Morancil",icon:"jstree-file"},
                        {text:"Jan Ray Monteros",icon:"jstree-file"},
                        {text:"Joeven Cerveza",icon:"jstree-file"}
                    )},
                    {text:"Silver",children:Array(
                        {text:"Resty Morancil",icon:"jstree-file"},
                        {text:"Jan Ray Monteros",icon:"jstree-file"},
                        {text:"Joeven Cerveza",icon:"jstree-file"}
                    )},
                    {text:"Bronze",children:Array(
                        {text:"Resty Morancil",icon:"jstree-file"},
                        {text:"Jan Ray Monteros",icon:"jstree-file"},
                        {text:"Joeven Cerveza",icon:"jstree-file"}
                    )})};
                grade_array.push(grade_array_value) ;
            }
            console.log(grade_array);
//            Tree
            $('#html').jstree();
            $('#data').jstree({
                "plugins" : [ "checkbox" ],
                'core' : {
                    'data' : grade_array
                }
            });
        });
    </script>


</div>



