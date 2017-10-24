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

                <table id="list" class="display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Quiz Name</th>
                        <th>Quiz Name</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>Assign Date</th>
                        <th>Expiration Date</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Quiz Name</th>
                        <th>Quiz Name</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>Assign Date</th>
                        <th>Expiration Date</th>
                    </tr>
                    </tfoot>

                    <tbody>
                        <?php foreach($quiz as $quiz_key=>$quiz_value): ?>
                            <?php if($quiz_value['start_date']!=0):?>
                                <?php $start_date = date('M d, Y', $quiz_value['start_date']) ?>
                            <?php endif; ?>
                            <?php if($quiz_value['end_date']!=0):?>
                                <?php $end_date = date('M d, Y', $quiz_value['end_date']) ?>
                            <?php endif; ?>
                            <tr class="quiz_result_preview" data-value="<?php echo $quiz_value['gids']?>" data-href='<?php echo site_url('result/view_students/?section='.urlencode($quiz_value['gids'])."&grade=".$quiz_value['lid'])?>'>

                                <td><?php print_r($quiz_value['quiz_name'])?></td>
                                <td><?php print_r($quiz_value['gids'])?></td>
                                <td><?php print_r($this->grades_model->where("lid",$quiz_value['lid'])[0]['level_name'])?></td>
                                <td><?php print_r($this->subjects_model->where("cid",$quiz_value['cid'])[0]['category_name'])?></td>
                                <td><?php print_r($start_date)?></td>
                                <td><?php print_r($end_date)?></td>
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

            if($(this).data("value")){
                window.location = $(this).data("href");
            }else{
                alert("This quiz has no assigned sections please try again.");
            }

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