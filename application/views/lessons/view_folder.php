<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
$data = array("lesson_id" => $lesson_id);
?>
<?php $lesson_contents = $this->lessons_model->all_lesson_contents_by_id($data); ?>
<?php $lesson_information = $this->lessons_model->lesson_by_id($lesson_id); ?>
<?php $root_link = base_url('upload/lessons/') . "/"; ?>
<div class="left-container" id="right_container"
     style="margin-left: 0px; background-color: rgb(242, 207, 165); height: 690px; width: 230px; float: left; padding-top: 0px;">

    <div class="header"
         style="font-weight: bold; font-size: 14px; color: #ffffff; padding: 30px 10px;margin: 0 0px; background-color: #fe0000; background-repeat: repeat-x;">
        <div class="title" id="lesson_title"><?php echo $lesson_information[0]["lesson_name"] ?></div>
    </div>

    <label class="tree-js folder" id="engage"
           style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Engage</label>
    <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
        <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value) { ?>
            <?php print_r($lesson_contents_value) ?>
            <?php $folder_location = $lesson_id . "_" . $lesson_contents_value['folder_name'] . "/" ?>
            <?php if ($lesson_contents_value['folder_name'] == "Engage") { ?>
                <?php if ($lesson_contents_value['content_type'] == "quiz") { ?>
                    <li style="cursor:pointer" class="content" type="quiz"
                        value="<?php echo $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
                <?php } else { ?>
                    <li style="cursor:pointer" class="content" type="file"
                        value="<?php echo $root_link . $folder_location . $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
                <?php } ?>


            <?php } ?>

        <?php } ?>
    </ul>
    <label class="tree-js folder" id="explore"
           style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Explore</label>
    <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
        <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value) { ?>
            <?php $folder_location = $lesson_id . "_" . $lesson_contents_value['folder_name'] . "/" ?>
            <?php if ($lesson_contents_value['folder_name'] == "Explore") { ?>
                <li style="cursor:pointer" class="content"
                    value="<?php echo $root_link . $folder_location . $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
            <?php } ?>

        <?php } ?>
    </ul>
    <label class="tree-js folder" id="explain"
           style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Explain</label>
    <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
        <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value) { ?>
            <?php $folder_location = $lesson_id . "_" . $lesson_contents_value['folder_name'] . "/" ?>
            <?php if ($lesson_contents_value['folder_name'] == "Explain") { ?>
                <li style="cursor:pointer" class="content"
                    value="<?php echo $root_link . $folder_location . $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
            <?php } ?>

        <?php } ?>
    </ul>
    <label class="tree-js folder" id="extend"
           style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Extend</label>
    <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
        <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value) { ?>
            <?php $folder_location = $lesson_id . "_" . $lesson_contents_value['folder_name'] . "/" ?>
            <?php if ($lesson_contents_value['folder_name'] == "Extend") { ?>
                <li style="cursor:pointer" class="content"
                    value="<?php echo $root_link . $folder_location . $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
            <?php } ?>

        <?php } ?>
    </ul>
    <label class="tree-js folder" id="evaluate"
           style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Evaluate</label>
    <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
        <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value) { ?>
            <?php $folder_location = $lesson_id . "_" . $lesson_contents_value['folder_name'] . "/" ?>
            <?php if ($lesson_contents_value['folder_name'] == "Evaluate") { ?>
                <li style="cursor:pointer" class="content"
                    value="<?php echo $root_link . $folder_location . $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
            <?php } ?>

        <?php } ?>
    </ul>
    <label class="tree-js folder" id="other_resources"
           style="width: 230px; height:50px; font-size: 12px;font-weight: bold;line-height: 18px; color: #ffffff; background-color: #663332; padding: 14px 26px">Other
        Resources</label>
    <ul style="height: auto;padding: 0px 9px; margin: 0px 40px; list-style: none;">
        <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value) { ?>
            <?php $folder_location = $lesson_id . "_" . $lesson_contents_value['folder_name'] . "/" ?>
            <?php if ($lesson_contents_value['folder_name'] == "Other Resources") { ?>
                <li style="cursor:pointer" class="content"
                    value="<?php echo $root_link . $folder_location . $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
            <?php } ?>
        <?php } ?>
    </ul>


</div>
<div class="right-container" style="margin-left: 252px;">
    <div class="well"
         style="padding: 0; background-color: #eeeeee; min-height: 20px; margin-bottom: 20px; height: 690px">
        <div class="right-container-head"
             style="color: #ffffff; font-size: 14px; padding: 30px 10px; background-color: #da251e;">

        </div>
        <div id="current_iframe_container" class="right-container-body">
            <!--            <iframe id="current_iframe" width="100%" height="800px"-->
            <!--                    src="http://localhost/assessment/upload/lessons/11_Other%20Resources/20161229_063048.mp4"-->
            <!--                    frameborder="0" allowfullscreen="">-->
            <!--            </iframe>-->
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".content").click(function () {


            var url = $(this).attr("value");
            var file_type = $(this).attr("type");

            if (file_type != "quiz") {
                $("#current_iframe").remove();
                $("#current_iframe_container").append('' +
                    '<iframe id="current_iframe" style="height: 580px; width: 100%;"' +
                    'src="' + url + '"' +
                    'frameborder="0" allowfullscreen=""> ' +
                    '</iframe>');
            } else {
                var file_value = ;
                var where = "quiz_name";
                var value = $(this).attr("value");
                $.ajax({
                    url: "<?php echo site_url('lessons/where');?>",
                    type: "POST",
                    data: {where: where, value: value}
                }).done(function (values) {
                    lesson_contents = JSON.parse(values);
                    var append;
                    var link;
                    $("#file_container").empty();


                });
            }

        });
    });
</script>

