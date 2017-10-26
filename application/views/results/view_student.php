<script src="<?php echo base_url('css/new_material/cdn/jquery1_12.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.css') ?>">

<style>
    tfoot input {
        width: 100%;
        padding : 3px;
        box-sizing: border-box;
    }

    tfoot {
        display: table-header-group;
    }

    a {
        color: black;
    }

    tr {
        cursor: pointer;
    }
</style>

<input type="hidden" id="added" value="<?php echo $this->lang->line('added'); ?>">
<div class="wrapper">
    <div class="wrapper">
        <div class="row">

            <!--            <select>-->
            <!--                --><?php //foreach($this->grades_model->all() as $grades_key=>$grades_value): ?>
            <!--                    <option value="--><?php //echo $grades_value['lid']?><!--">--><?php //echo $grades_value['level_name']?><!--</option>-->
            <!--                --><?php //endforeach;?>
            <!--            </select>-->
            <!---->
            <!---->
            <!--            <select>-->
            <!--                --><?php //foreach($this->group_model->get_all() as $group_key=>$group_value): ?>
            <!--                    <option value="--><?php //echo $group_value['gid']?><!--">--><?php //echo $group_value['group_name']?><!--</option>-->
            <!--                --><?php //endforeach;?>
            <!--            </select>-->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>Results</h2>
<!--                <pre>-->
<!--                    --><?php //print_r($users); ?>
                <table id="list" class="display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Grade</th>
                        <th>Section</th>
                        <th>Score</th>
                        <th>Total Score</th>
                        <th>Percentage</th>
                        <th>Attempted</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Grade</th>
                        <th>Section</th>
                        <th>Score</th>
                        <th>Total Score</th>
                        <th>Percentage</th>
                        <th>Attempted</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <?php foreach($users as $user_key=>$user_value): ?>
                        <?php if($user_value['score_obtained']){$total_score = ($user_value['score_obtained']/$user_value['percentage_obtained'])*100; }else{$total_score = ""; } ?>
                        <?php if($user_value['percentage_obtained']){$total_percentage = $user_value['percentage_obtained']; }else{ $total_percentage = 0; } ?>
                        <?php if($user_value['maximum_attempts']){$attempted = "Yes"; }else{ $attempted = "No"; } ?>
                        <?php if($user_value['score_obtained']!==null){$score_obtained = $user_value['score_obtained']; }else{ $score_obtained = " "; } ?>

                        <tr class="quiz_result_preview" data-href='<?php echo site_url('result/view_students/'.$quiz_value['quid'])?>'>

                                <td><?php print_r($user_value['email']); ?></td>
                                <td><?php print_r($user_value['first_name']); ?></td>
                                <td><?php print_r($user_value['last_name']); ?></td>
                                <td><?php print_r($user_value['lid']); ?></td>
                                <td><?php print_r($user_value['gid']); ?></td>
                                <td><?php echo $score_obtained ?></td>
                                <td><?php echo $total_score ?></td>
                                <td><?php echo $total_percentage ?>%</td>
                                <td><?php echo $attempted ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $(".quiz_result_preview").click(function() {
            window.location = $(this).data("href");
        });
        // Setup - add a text input to each footer cell
        $('#list tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        var table = $('#list').DataTable();
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {

                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

        $('#list').on('draw.dt', function (event) {
            var abuttons = $(this).find(".abutton");
            var removed_click = $(this).find(".remove");

            $(removed_click).hide();
            $.each(abuttons, function (key, value) {
                var current_text = $(this).text();
                current_text = current_text.replace(/ /g, '');
                current_text = current_text.replace(/\n/, '');
                if (current_text == "Added") {
                    $(this).hide();
                    $("#remove-" + $(this).attr("id").replace("q", "")).show();

                }

            });

        });
    });





</script>