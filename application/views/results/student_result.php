<script src="<?php echo base_url('css/new_material/cdn/jquery.min.js') ?>"></script>
<!--<link href="--><?php //echo base_url('css/new_material/cdn/datatables_responsive.css'); ?><!--">-->
<!--<script src="--><?php //echo base_url('css/new_material/cdn/datatables_responsive.js') ?><!--"></script>-->
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.dataTables.min.css">
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
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
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="three wizard">
                <?php $logged_in = $this->session->userdata('logged_in'); ?>
<!--                                    <pre>-->
<!--                                    --><?php //print_r($result);?>

                <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Quiz Name</th>
                        <th>Quiz Score</th>
                        <th>Subject</th>
                        <th>Status</th>


                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Quiz Name</th>
                        <th>Quiz Score</th>
                        <th>Subject</th>
                        <th>Status</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($result as $result_key => $result_value): ?>
                        <?php $questions = explode(",", $result_value['r_qids']); ?>
                        <?php $quiz_score = $result_value['correct_score']; ?>
                        <?php $total_score = 0; ?>
                        <?php foreach ($questions as $questions_key => $questions_value): ?>
                            <?php $current_question = $this->result_model->load("savsoft_qbank", "qid", $questions_value); ?>

                            <?php if ($current_question['per_question_score'] != 0): ?>
                                <?php $total_score = $total_score + $current_question['per_question_score']; ?>
                            <?php else: ?>
                                <?php $total_score = $total_score + $quiz_score; ?>
                            <?php endif; ?>

                        <?php endforeach; ?>

                        <tr class='clickable-row' data-href='<?php echo site_url('result/view_result/' . $result_value['rid']) ?>'>
                            <td><?php echo $result_value['quiz_name']; ?></td>
                            <td><?php echo $result_value['score_obtained'] ?>/<?php echo $total_score ?></td>
                            <td><?php echo $this->subjects_model->where("cid", $result_value['cid'])[0]['category_name']; ?></td>
                            <td><?php echo strtoupper($result_value['result_status'])?></td>


                        </tr>
                    <?php endforeach; ?>
                    <!--                    --><?php //print_r($total_score); ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>


</div>
<script>

    $(document).ready(function () {
        $('#example tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        var table = $('#example').DataTable();
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
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>