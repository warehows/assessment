<style>
    #image_view {
        height: 97%;
        width: 100%;
    }

    object {
        height: 97%;
        width: 100%;
    }

    video::-internal-media-controls-download-button {
        display: none;
    }

    video::-webkit-media-controls-enclosure {
        overflow: hidden;
    }

    video::-webkit-media-controls-panel {
        width: calc(100% + 30px); /* Adjust as needed */
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php


$input = $_GET;

$exploded_filename = explode(".", $input['filename']);
$filename = $exploded_filename[0];
$file_extension = $exploded_filename[1];
$filelocation = $input['filelocation'];

$base_url = $input['base_url'] . "upload/lessons/";
if (
    $file_extension == "png" ||
    $file_extension == "jpg"
) {

    echo '<img id="image_view" src="' . $base_url . $filelocation . $input['filename'] . '"/>';
} elseif (
    $file_extension == "mp4"
) {
    ?>
    <video width="100%" height="97%" controls>
        <source src="<?php echo $base_url . $filelocation . $input['filename'] ?>" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
        Your browser does not support the video tag.
    </video>


<?php } elseif (
$file_extension == "pdf"
) { ?>
    <object data="<?php echo $base_url . $filelocation . $input['filename']?>" disabled=""></object>
<?php } ?>

<script>

    $(document).ready(function() {
        $("video").bind("contextmenu",function(){
            return false;
        });
        $("img").bind("contextmenu",function(){
            return false;
        });
    } );
</script>
