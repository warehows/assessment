<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $request = $_REQUEST ?>
<?php $new_data['lesson_id'] = $request['lesson_id'] ?>
<?php $new_data['author'] = $request['author'] ?>
<?php
//$data = array("lesson_id" => $lesson_id);
//?>
<?php $lesson_contents = $this->lessons_model->all_lesson_contents_by_id($new_data); ?>
<?php $lesson_information = $this->lessons_model->lesson_by_id($new_data['lesson_id']); ?>
<?php $root_link = base_url('upload/lessons/fileview'); ?>
<?php $base_url = base_url(); ?>
<?php $folders = array(
    array("engage", "star"),
    array("explain", "heart"),
    array("extend", "user"),
    array("evaluate", "alert"),
    array("lesson plan", "search"),
) ?>

<?php
function echo_file_li($root_link,$lesson_contents_value,$folder_location,$base_url){?>
    <li style="cursor:pointer" type="file" class="content"
        value="<?php echo $root_link . "?filename=" . urlencode($lesson_contents_value['content_name']); ?>&filelocation=<?php echo urlencode($folder_location) ?>&base_url=<?php echo $base_url ?>"><?php echo urlencode($lesson_contents_value['content_name']); ?></li>
    <?php
}
?>

<link href="<?php echo base_url('css/new_material/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('css/new_material/tabs.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('css/new_material/view_folder.css') ?>" rel="stylesheet">

<meta name="viewport" content="width=device-width"/>


<div class="viewer_container col-lg-12 col-sm-12">
    <div class="well">
        <div class="tab-content">
            <?php foreach ($folders as $folders_key => $folders_value): ?>
                <div class="tab-pane fade in" id="tab<?php echo $folders_key ?>">
                    <div class="row">
                        <div class="content_container col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                            <ul content_id="<?php echo $folders_key ?>">
                                <div class="ul_title">Contents</div>
                                <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value): ?>
                                    <?php $folder_location = $new_data['lesson_id'] . "_" . $lesson_contents_value['folder_name'] . "/" ?>
                                    <?php if (strtolower($lesson_contents_value['folder_name'])==$folders_value[0]): ?>
                                        <?php if ($lesson_contents_value['content_type'] == "quiz") { ?>
                                            <li style="cursor:pointer" class="contentx" type="quiz"
                                                value="<?php echo $lesson_contents_value['content_name']; ?>"><?php echo $lesson_contents_value['content_name']; ?></li>
                                        <?php } else { ?>
                                            <?php echo_file_li($root_link,$lesson_contents_value,$folder_location,$base_url); ?>
                                        <?php } ?>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="file_container col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                            <div id="iframe_container_<?php echo $folders_key ?>"
                                 class="iframe_container col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="card-info col-lg-12 col-md-12 col-sm-12 col-xs-12"><span class="card-title">Lesson Title</span></div>


    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <?php foreach ($folders as $folders_key => $folders_value): ?>

            <div class="btn-group" role="group">
                <button type="button" id="folder_button_<?php echo $folders_key ?>"
                        class="button_for_folders btn btn-default" href="#tab<?php echo $folders_key ?>"
                        data-toggle="tab">
                    <span class="glyphicon glyphicon-<?php echo $folders_value[1] ?>" aria-hidden="true"></span>

                    <div class=""><?php echo $folders_value[0] ?></div>
                </button>
            </div>
        <?php endforeach; ?>

    </div>


</div>

<div class="toggle_button col-sm-12 col-xs-12 hidden-lg hidden-md visible-sm-block visible-xs-block">
    <button class="toggle_navigation btn btn-primary form-control">TOGGLE NAVIGATION</button>
</div>

<script src="<?php echo base_url('js/jquery.js') ?>"></script>
<script src="<?php echo base_url('js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('css/new_material/bootstrap/js/bootstrap.min.js') ?>"></script>

<script>
    $(document).ready(function () {
        $(".btn-pref .btn").click(function () {
            $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
            // $(".tab").addClass("active"); // instead of this do the below
            $(this).removeClass("btn-default").addClass("btn-primary");
        });
        $(".tab-pane").eq(0).addClass("active");
        $(".button_for_folders").eq(0).removeClass("btn-default");
        $(".button_for_folders").eq(0).addClass("btn-primary");
        $(".toggle_button").click(function () {

            $(".content_container").toggleClass("hidden-sm visible-sm-block");
            $(".content_container").toggleClass("hidden-xs visible-xs-block");
            $(".content_container").addClass("visible-lg-block");
            $(".content_container").addClass("visible-md-block");

        });

        $(".content").click(function () {


            var url = $(this).attr("value");
            var file_type = $(this).attr("type");
            var content_id = $(this).parent().attr("content_id");


            if (file_type != "quiz") {
                $("#current_iframe_"+content_id).remove();
                $("#iframe_container_"+content_id).append('' +
                    '<iframe id="current_iframe_'+content_id+'" style="height: 580px; width: 100%;"' +
                    'src="' + url + '"' +
                    'frameborder="0" allowfullscreen=""> ' +
                    '</iframe>');
            } else {
//                var file_value = ;

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




