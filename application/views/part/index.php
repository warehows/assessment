<!--<link rel="stylesheet" type="text/css" href="--><?php //echo base_url('css/new_material/joeven.css') ?><!--">-->
<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
<!--      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
<!---->
<!--<div class="container">-->
<!---->
<!--</div>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"-->
<!--        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"-->
<!--        crossorigin="anonymous"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/new_material/joeven.css') ?>">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url('css/new_material/cdn/datatables_responsive.min.css') ?>">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
        <p class="main-title">Build Test - (Quiz 1)</p>
        <a href="create" class="main-title-link">
            <button class="main-button">Done</button>
        </a>
    </div>

    <div class="content-container">
        <div class="col-lg-12">
            <div class="main-part-container">
                <p class="main-title">Parts</p>
                <a href="create" class="main-title-link">
                    <button class="main-button">+Add Part</button>
                </a>
            </div>
            <div class="col-lg-12">
                <div class="part-container col-lg-12">

                    <div class="part-label-container col-lg-1">
                        <span>Part I.</span>
                    </div>
                    <div class="part-description-container col-lg-9">
                        <span>The quick brown fox jumps over the lazy dog near the bank of the river.</span>
                    </div>
                    <div class="part-button-container col-lg-1">
                        <a href=""><span>+Add Question</span></a>
                    </div>
                    <div class="part-toggle-container col-lg-1">
                        <span>+</span>
                    </div>
                </div>
                <div class="col-lg-12">

                    <!--                    IDENTIFICATION-->
                    <div class="question-container">
                        <div class="question-content-container">
                            <p class="question-content_numbering">1.)</p>

                            <p class="question-content">Question 1 Identification?</p>
                        </div>
                    </div>
                    <div class="option-container">
                        <div class="question-content-container">
                            <input type="text" class="form-control" placeholder="Answers: a,b,c"/>
                        </div>
                    </div>
                    <!--                    IDENTIFICATION-->

                    <!--                    Multiple Choice Single-->
                    <div class="question-container">
                        <div class="question-content-container">
                            <p class="question-content_numbering">2.)</p>

                            <p class="question-content">Question 2 Multiple Choice Single?</p>
                        </div>
                    </div>
                    <div class="option-container">
                        <div class="question-content-container">
                            <div class="option"><input type="radio" name="option_id"/>option_1</div>
                            <div class="option"><input type="radio" name="option_id"/>option_2</div>
                            <div class="option"><input type="radio" name="option_id"/>option_3</div>
                            <div class="option"><input type="radio" name="option_id"/>option_4</div>
                        </div>
                    </div>
                    <!--                    Multiple Choice Single-->

                    <!--                    Multiple Choice Multiple-->
                    <div class="question-container">
                        <div class="question-content-container">
                            <p class="question-content_numbering">3.)</p>

                            <p class="question-content">Question 3 Multiple Choice Multiple?</p>
                        </div>
                    </div>
                    <div class="option-container">
                        <div class="question-content-container">
                            <div class="option"><input type="checkbox" name="option_id[]"/>option_1</div>
                            <div class="option"><input type="checkbox" name="option_id[]"/>option_2</div>
                            <div class="option"><input type="checkbox" name="option_id[]"/>option_3</div>
                            <div class="option"><input type="checkbox" name="option_id[]"/>option_4</div>
                        </div>
                    </div>
                    <!--                    Multiple Choice Multiple-->
                    <!--                    True or False-->
                    <div class="question-container">
                        <div class="question-content-container">
                            <p class="question-content_numbering">4.)</p>

                            <p class="question-content">Question 4 True or False?</p>
                        </div>
                    </div>
                    <div class="option-container">
                        <div class="question-content-container">
                            <div class="option"><input type="radio" name="option_id"/>True</div>
                            <div class="option"><input type="radio" name="option_id"/>False</div>
                        </div>
                    </div>
                    <!--                    True or False-->

                    <!--                    Match the Column -->
                    <div class="question-container">
                        <div class="question-content-container">
                            <p class="question-content_numbering">5.)</p>

                            <p class="question-content">Question 5 Match the column?</p>
                        </div>
                    </div>
                    <div class="option-container">
                        <div class="question-content-container">
                            <div class="option"><input type="text" name="option_id"/> = <input type="text"
                                                                                               name="option_id"/></div>
                            <div class="option"><input type="text" name="option_id"/> = <input type="text"
                                                                                               name="option_id"/></div>
                            <div class="option"><input type="text" name="option_id"/> = <input type="text"
                                                                                               name="option_id"/></div>
                            <div class="option"><input type="text" name="option_id"/> = <input type="text"
                                                                                               name="option_id"/></div>
                        </div>
                    </div>
                    <!--                    Match the Column -->

                    <!--                    Fill in the Blanks -->
                    <div class="question-container">
                        <div class="question-content-container">
                            <p class="question-content_numbering">6.)</p>

                            <p class="question-content">Question 6 Fill in the Blanks?</p>
                        </div>
                    </div>
                    <div class="option-container">
                        <div class="question-content-container">
                            <div class="option"><input type="text" name="option_id"/></div>
                            <div class="option"><input type="text" name="option_id"/></div>
                            <div class="option"><input type="text" name="option_id"/></div>
                            <div class="option"><input type="text" name="option_id"/></div>
                        </div>
                    </div>
                    <!--                    Fill in the Blanks

                    <!--                    Open Ended -->
                    <div class="question-container">
                        <div class="question-content-container">
                            <p class="question-content_numbering">7.)</p>

                            <p class="question-content">Question 7 Open Ended?</p>
                        </div>
                    </div>
                    <div class="option-container">
                        <div class="question-content-container">
                            <div class="option"><textarea></textarea></div>
                        </div>
                    </div>
                    <!--                    Open Ended -->

                </div>
            </div>


        </div>
    </div>

</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

