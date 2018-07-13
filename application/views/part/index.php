<?php $parts = array("a", "b", "c"); ?>
<div class="col-lg-12">
    <div class="main-title-container">
        <p class="main-title">Build Test - (Quiz 1)</p>
        <a href="create" class="main-title-link">
            <button class="main-button">Done</button>
        </a>
    </div>

    <div class="content-container">

        <div class="main-part-container">
            <p class="main-title">Parts</p>
            <a href="create" class="main-title-link">
                <button class="main-button">+Add Part</button>
            </a>
        </div>
        <?php foreach ($parts as $parts_key => $parts_value): ?>
            <div class="parts col-lg-12">
                <div class="part-container">

                    <div class="part-div part part-label-container">
                        <span>Part I.</span>
                    </div>
                    <div class="part-div part-description-container">
                        <span>The quick brown fox jumps over the lazy dog near the bank of the river.</span>
                    </div>
                    <div class="part-div part-toggle-container pull-right">
                        <span>-</span>
                    </div>
                    <div class="part-div part-button-container hidden-sm hidden-xs pull-right">
                        <a href="<?php echo base_url(); ?>index.php/question/index"><span>+Add Question</span></a>
                    </div>

                    <div class="part-div part-button-container hidden-lg hidden-md pull-right">
                        <a href="/"><span>+Q</span></a>
                    </div>

                </div>
                <div class="part-questions">

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
        <?php endforeach; ?>


    </div>
</div>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {
        $(".part-toggle-container").click(function () {
            var this_function = this;
            var index = $(this).parent().parent().index();
            index = index - 1;

            $(".part-questions").eq(index).slideToggle("fast", function () {

                if ($(this_function).find("span").text() == "-") {
                    $(this_function).find("span").text("+");
                } else {
                    $(this_function).find("span").text("-");
                }
            });
        });

    });
</script>
