<script src="<?php echo base_url('css/new_material/cdn/jquery.min.js') ?>"></script>
<!--<link href="--><?php //echo base_url('css/new_material/cdn/datatables_responsive.css'); ?><!--">-->
<!--<script src="--><?php //echo base_url('css/new_material/cdn/datatables_responsive.js') ?><!--"></script>-->
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.dataTables.min.css">
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="three wizard">
                <?php $logged_in = $this->session->userdata('logged_in'); ?>
<!--                    <pre>-->
<!--                    --><?php //print_r($result);?>

                <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Quiz Name</th>
                        <th>Quiz Score</th>
                        <th>Quiz Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($result as $result_key=>$result_value):?>
                        <tr>
                            <td><?php echo $result_value['quiz_name']; ?></td>
                            <td>8/10</td>
                            <td>Status</td>
                            <td><button>View</button></td>

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

        $('#example').DataTable();
    });
</script>