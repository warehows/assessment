<div class="content_container">
    <div class="title_bar-container">
        <div class="title_bar">
            <span>Questions</span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/part/index">
            <div class="title_button cancel">
                <span>Cancel</span>
            </div>
        </a>

        <a href="test/create">
            <div class="title_button done">
                <span>Done</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>index.php/question/create">
            <div class="title_button">
                <span>+ Add Question</span>
            </div>
        </a>



    </div>
    <table id="example" class="display responsive nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Action</th>
            <th>Title</th>
            <th>Grade</th>
            <th>Subject</th>
            <th>Type</th>
            <th>Author</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>
                <a><button class="btn btn-success col-lg-4 col-md-4 col-sm-4 col-xs-4">Add</button></a>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <a><button class="btn btn-primary col-lg-4 col-md-4 col-sm-4 col-xs-4">Edit</button></a>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
            </td>
            <td>Bruce</td>
            <td>Javascript Developer</td>
            <td>Singapore</td>
            <td>29</td>
            <td>29</td>
        </tr>

        </tbody>


        <tfoot>
        <tr>
            <th>Action</th>
            <th>Title</th>
            <th>Grade</th>
            <th>Subject</th>
            <th>Type</th>
            <th>Author</th>
        </tr>
        </tfoot>

    </table>

</div>