<style>
   #hidden_tr{
       display: none;
   }
</style>
<?php $this->load->helper('url'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>js/jstree/dist/themes/default/style.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jstree/dist/jstree.min.js"></script>
<style>
    #data {
        border: 1px solid black;
        padding: 10px;
    }
</style>

<div class="container">
    <!--    <pre>-->
    <!--    --><?php //print_r($result); ?>
<!--    <form method="post" action="--><?php //echo site_url('quiz/assessment_insert_quiz/'); ?><!--">-->
        <table>
            <tr id="header_quiz_list">
                <th>
                    Quiz Name
                </th>
                <th>
                    Select
                </th>
            </tr>
<!--            --><?php //foreach ($result as $key => $value) { ?>
<!--                <tr>-->
<!--                    <td>-->
<!--                        --><?php //echo $result[$key]['quiz_name'] ?>
<!--                    </td>-->
<!--                    <td>-->
<!--                        <button id="quiz_--><?php //echo $result[$key]['quid'] ?><!--">Select</button>-->
<!--                    </td>-->
<!--                </tr>-->
<!--            --><?php //} ?>
            <tr id="last_tr">
                <td>
                    <button id="add_new_quiz" type="button">Add New Quiz</button>
                </td>
                <td>
                    <input id="new_quiz_name" name="quiz_name" placeholder="Quiz Name"/>
                    <input type="button" id="new_quiz_confirm" value="Confirm"/>
                </td>
            </tr>

        </table>
<!--    </form>-->
    <?php
    $logged_in = $this->session->userdata('logged_in');
    ?>
    <h1>Assign Quiz</h1>

    <div id="data" class="demo"></div>
    <script>
        $(document).ready(function () {
//            Variable initiation
            var grade_array_count = 6;
            var grade_array = new Array();
            var grade_array_value = new Array();
            var text = "text";
            for (var x = 1; x <= grade_array_count; x++) {
                grade_array_value = {
                    text: "Grade " + x, id: x, children: Array(
                        {
                            text: "Diamond", children: Array(
                            {text: "Resty Morancil", icon: "jstree-file"},
                            {text: "Jan Ray Monteros", icon: "jstree-file"},
                            {text: "Joeven Cerveza", icon: "jstree-file"}
                        )
                        },
                        {
                            text: "Gold", children: Array(
                            {text: "Resty Morancil", icon: "jstree-file"},
                            {text: "Jan Ray Monteros", icon: "jstree-file"},
                            {text: "Joeven Cerveza", icon: "jstree-file"}
                        )
                        },
                        {
                            text: "Silver", children: Array(
                            {text: "Resty Morancil", icon: "jstree-file"},
                            {text: "Jan Ray Monteros", icon: "jstree-file"},
                            {text: "Joeven Cerveza", icon: "jstree-file"}
                        )
                        },
                        {
                            text: "Bronze", children: Array(
                            {text: "Resty Morancil", icon: "jstree-file"},
                            {text: "Jan Ray Monteros", icon: "jstree-file"},
                            {text: "Joeven Cerveza", icon: "jstree-file"}
                        )
                        })
                };
                grade_array.push(grade_array_value);
            }
            console.log(grade_array);
//            Tree
            $('#html').jstree();
            $('#data').jstree({
                "plugins": ["checkbox"],
                'core': {
                    'data': grade_array
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $.ajax({
                url: "<?php echo site_url('assign/assessment_quiz_list/'); ?>",
            }).done(function(value) {
                var quiz_value = JSON.parse(value);
                console.log(quiz_value);
                $.each(quiz_value,function(key,key_value){
                    $("#last_tr").before('<tr class="quiz_name"><td>'+key_value["quiz_name"]+'</td><td><input type="button" value="Select"></td></tr>');
                });

            });
            $("#new_quiz_name").hide();
            $("#new_quiz_confirm").hide();
            $("#add_new_quiz").click(function () {
                $("#new_quiz_confirm").show();
                $("#new_quiz_name").show();
            });
            $("#new_quiz_confirm").click(function (event) {
                var val_array = {quiz_name:"ninja"};
                var quiz_name = $("#new_quiz_name").val();
                var r = confirm("Are you sure to create " + quiz_name + "?");
                if (r == true) {
                    $.ajax({
                        url: "<?php echo site_url('quiz/assessment_insert_quiz/');?>?quiz_name=llo",
                        type:"POST",
                    }).done(function(values) {
                        alert(values);
//                        $.ajax({
//                            url: "<?php //echo site_url('assign/assessment_quiz_list/'); ?>//",
//                        }).done(function(value) {
//                            var quiz_value = JSON.parse(value);
//                            $(".quiz_name").remove();
//                            $.each(quiz_value,function(key,key_value){
//                                $("#last_tr").before('<tr class="quiz_name"><td>'+key_value["quiz_name"]+'</td><td><input type="button" value="Select"></td></tr>');
//                            });
//
//                        });


                    });

                } else {
                    event.preventDefault();
                }
            });
        });
    </script>


</div>



