<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php $request = $_REQUEST ?>
<?php $new_data['lesson_id'] = $request['lesson_id'] ?>
<?php $new_data['author'] = $request['author'] ?>
<?php $logged_in = $this->session->userdata('logged_in') ?>
<?php
//$data = array("lesson_id" => $lesson_id);
//?>
<?php $lesson_contents = $this->lessons_model->all_lesson_contents_by_id($new_data); ?>
<?php $lesson_information = $this->lessons_model->lesson_by_id($new_data['lesson_id']); ?>
<?php $root_link = base_url('upload/lessons/fileview'); ?>
<?php $base_url = base_url(); ?>
<?php if($logged_in['su']!=0): ?>
<?php $folders = array(
    array("engage", "star"),
    array("explore", "zoom-in"),
    array("explain", "book"),
    array("extend", "blackboard"),
    array("evaluate", "edit"),
    array("lesson plan", "briefcase"),
) ?>
    <?php else: ?>
    <?php $folders = array(
        array("engage", "star"),
        array("explore", "zoom-in"),
        array("explain", "book"),
        array("extend", "blackboard"),
        array("evaluate", "edit"),

    ) ?>
<?php endif; ?>

<?php
function echo_file_li($root_link, $lesson_contents_value, $folder_location, $base_url)
{
    ?>
    <li style="cursor:pointer;overflow-wrap: break-word;" type="file" class="content"
        value="<?php echo $root_link . "?filename=" . urlencode($lesson_contents_value['content_name']); ?>&filelocation=<?php echo urlencode($folder_location) ?>&base_url=<?php echo $base_url ?>">
        <?php echo $lesson_contents_value['content_name']; ?>
    </li>
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
                    <div class="row" style="margin-right: 0px;">
                        <div class="content_container col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                            <ul content_id="<?php echo $folders_key ?>">
                                <div class="ul_title">Contents</div>
                                <?php foreach ($lesson_contents as $lesson_contents_key => $lesson_contents_value): ?>
                                    <?php $folder_location = $new_data['lesson_id'] . "_" . $lesson_contents_value['folder_name'] . "/" ?>

                                    <?php if (strtolower($lesson_contents_value['folder_name']) == $folders_value[0]): ?>
                                        <?php if ($lesson_contents_value['content_type'] == "quiz") { ?>
                                            <li style="cursor:pointer" class="content" type="quiz" quiz_id="<?php echo $lesson_contents_value['content_id']; ?>"
                                                value="<?php echo $lesson_contents_value['content_name']; ?>"><?php echo str_replace("+"," ",$lesson_contents_value['content_name']); ?></li>
                                        <?php } else { ?>
                                            <?php echo_file_li($root_link, $lesson_contents_value, $folder_location, $base_url); ?>
                                        <?php } ?>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="file_container col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <div id="iframe_container_<?php echo $folders_key ?>"
                                 class="iframe_container col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="card-info col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="<?php if($logged_in['su']==2){echo site_url('workspace');}else{echo site_url('lessons');} ?>"><span
                class="back col-sm-1 col-xs-1"><i class="glyphicon glyphicon-arrow-left" style="font-size: 20px"></i></span></a><span
            class="card-title col-sm-offset-0 col-xs-offset-0"><?php echo $lesson_information[0]['lesson_name'] ?></span></div>


    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <?php foreach ($folders as $folders_key => $folders_value): ?>

            <div class="btn-group" role="group">
                <button type="button" id="folder_button_<?php echo $folders_key ?>"
                        class="button_for_folders btn btn-default" href="#tab<?php echo $folders_key ?>"
                        data-toggle="tab">
                    <span class="glyphicon glyphicon-<?php echo $folders_value[1] ?>" aria-hidden="true"></span>

                    <div class="hidden-sm hidden-xs"><?php echo $folders_value[0] ?></div>
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
    function checkPosition() {
        if (window.matchMedia('(max-width: 991px)').matches) {

            $(document).find(".the_iframe").attr("style", "height:80%;width: 100%;");
            $(".content_container").toggleClass("hidden-sm visible-sm-block");
            $(".content_container").toggleClass("hidden-xs visible-xs-block");

        } else {
            $(document).find(".the_iframe").attr("style", "height:91%;width: 83%;");
        }
    }

    checkPosition();
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
                $("#current_iframe_" + content_id).remove();
                var element_to_append = $('' +
                    '<iframe id="current_iframe_' + content_id + '" class="the_iframe"' +
                    'src="' + url + '"' +
                    'frameborder="0" allowfullscreen=""> ' +
                    '</iframe>');
                $("#iframe_container_" + content_id).append(element_to_append);
                checkPosition();
            } else {
                var quiz_id = $(this).attr("quiz_id");
                $("#current_iframe_" + content_id).remove();
                var element_to_append = $('' +
                    '<iframe id="current_iframe_' + content_id + '" class="the_iframe"' +
                    'src="http://localhost/brainee/index.php/quiz/view_quiz_detail/'+quiz_id+'"' +
                    'frameborder="0" allowfullscreen=""> ' +
                    '</iframe>');
                $("#iframe_container_" + content_id).append(element_to_append);
                checkPosition();
            }

        });


    });


</script>




