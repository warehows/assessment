<html>
    <head>
        <style>
        </style>
    </head>
    <body>
        <?php print_r($questions); ?>
        <?php foreach($questions as $queestion_key=>$question_value): ?>
            <div class="question_container"><?php echo $question_value['question']; ?></div>
            <div class="option_container"></div>
        <?php endforeach; ?>
    </body>
</html>