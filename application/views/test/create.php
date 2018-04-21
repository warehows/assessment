<script src="<?php echo base_url('css/new_material/cdn/jquery1_12.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/cdn/datatables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/joeven.css') ?>">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.css') ?>">
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

<div class="container">
    <div class="main-title-container">
        <p class="main-title">Create Test</p>
        <a href="<?php echo site_url('part/index')?>" class="main-title-link">
            <button class="main-button">Done</button>
        </a>
    </div>

    <div class="content-container">

        <div class="col-lg-12">
            <div class="form-group">
                <label for="test_name">Test Name</label>
                <input type="text" class="form-control" id="test_name" placeholder="Test Name">
            </div>
            <div class="form-group">
                <label for="test_name">Semester</label>
                <select type="text" class="form-control" id="semester">
                    <option>1st Semester</option>
                    <option>2nd Semester</option>
                    <option>3rd Semester</option>
                    <option>4th Semester</option>
                </select>
            </div>
            <div class="form-group">
                <label for="grade">Grade</label>
                <select type="text" class="form-control" id="grade">
                    <option>Grade 1</option>
                    <option>Grade 2</option>
                    <option>Grade 3</option>
                    <option>Grade 4</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <select type="text" class="form-control" id="subject">
                    <option>English</option>
                    <option>Math</option>
                    <option>Filipino</option>
                    <option>Science</option>
                </select>
            </div>
        </div>

    </div>

</div>

<script>

</script>