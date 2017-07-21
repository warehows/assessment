<?php $posts['lesson_id'] = $lesson_id ?>
<?php $posts['author'] = $author ?>
<?php if ($logged_in['su'] == 1) { ?>
    <?php $posts['duplicated'] = 0 ?>
<?php } ?>
<?php if ($logged_in['su'] == 2) { ?>
    <?php $posts['duplicated'] = 1 ?>
<?php } ?>
<?php if ($logged_in['su'] == 0) { ?>
    <?php $posts['duplicated'] = 1 ?>
<?php } ?>

<div class="wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="three wizard">
                <div class="left-container" id="right_container"
                     style="margin-left: 0px; background-color: rgb(242, 207, 165); height: 690px; width: 230px; float: left; padding-top: 0px;">
                    <div>
                        <div class="header"
                             style="font-weight: bold; font-size: 14px; color: #ffffff; padding: 30px 10px;margin: 0 0px; background-color: #fe0000; background-repeat: repeat-x;">
                            <div class="title" id="lesson_title">Test Title</div>
                        </div>
                        <label class="tree-js folder" id="engage"
                               style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Engage</label>
                        <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
                            <li id="kaka">Lesson 1</li>
                            <li id="2"><a href="#"> Lesson 2</a></li>
                        </ul>
                        <label class="tree-js folder" id="explore"
                               style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Explore</label>
                        <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
                            <li id="1"><a href="#"> Lesson 1</a></li>
                            <li id="2"><a href="#"> Lesson 2</a></li>
                        </ul>
                        <label class="tree-js folder" id="explore"
                               style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Explain</label>
                        <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
                            <li id="1"><a href="#"> Lesson 1</a></li>
                            <li id="2"><a href="#"> Lesson 2</a></li>
                        </ul>
                        <label class="tree-js folder"
                               style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Extend</label>
                        <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
                            <li id="1"><a href="#"> Lesson 1</a></li>
                            <li id="2"><a href="#"> Lesson 2</a></li>
                            <li id="2"><a href="#"> Lesson 3</a></li>
                            <li id="2"><a href="#"> Lesson 4</a></li>
                        </ul>
                        <label class="tree-js folder"
                               style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Evaluate</label>
                        <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
                            <li id="1"><a href="#"> Lesson 1</a></li>
                            <li id="2"><a href="#"> Lesson 2</a></li>
                        </ul>
                        <label class="tree-js folder"
                               style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Other Resources</label>
                        <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
                            <li id="1"><a href="#"> Lesson 1</a></li>
                            <li id="2"><a href="#"> Lesson 2</a></li>
                        </ul>
                    </div>
                </div>
                <div class="right-container" style="margin-left: 252px;">
                    <div class="well"
                         style="padding: 0; background-color: #eeeeee; min-height: 20px; margin-bottom: 20px; height: 690px">
                        <div class="right-container-head"
                             style="color: #ffffff; font-size: 14px; padding: 30px 10px; background-color: #da251e;">

                        </div>
                        <div id="current_iframe_container" class="right-container-body">
                            <iframe id="current_iframe" width="100%" height="800px"
                                    src="http://localhost/assessment/upload/lessons/11_Other%20Resources/20161229_063048.mp4"
                                    frameborder="0" allowfullscreen="">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#kaka").click(function () {

            $("#current_iframe").remove();
            $("#current_iframe_container").append('' +
                '<iframe id="current_iframe" style="height: 580px; width: 100%;"' +
                'src="http://localhost/assessment/upload/lessons/2_Engage/PMDynaform.pdf"' +
                'frameborder="0" allowfullscreen=""> ' +
                '</iframe>');
        });
    });
</script>
