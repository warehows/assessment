<script src="<?php echo base_url("css/new_material/js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("css/new_material/bootstrap/js/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("css/new_material/js/bs-animation.js"); ?>"></script>
<script src="<?php echo base_url("css/new_material/js/MUSA_form-wizard.js"); ?>"></script>
<script src="<?php echo base_url("css/new_material/js/custom.js"); ?>"></script>

<?php
if($this->config->item('tinymce')){
    if($this->uri->segment(2)!='attempt'){
        if($this->uri->segment(2)!='view_result'){

            if($this->uri->segment(2)!='config'){
                if($this->uri->segment(2)!='css'){


                    ?>
                    <script type="text/javascript" src="<?php echo base_url();?>editor/tiny_mce.js"></script>
                    <script type="text/javascript">
                        <?php
                        if($this->uri->segment(2)=='edit_quiz' || $this->uri->segment(2)=='add_new' ){
                       ?>
                        tinyMCE.init({

                            mode : "textareas",
                            editor_selector : "tinymce_textarea",
                            theme : "advanced",
                            relative_urls:"false",
                            plugins: "jbimages",


                            // ===========================================
                            // PUT PLUGIN'S BUTTON on the toolbar
                            // ===========================================



                            theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                            theme_advanced_buttons4 : "jbimages,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",


                        });

                        <?php
                         }else{
                        ?>

                        tinyMCE.init({

                            mode : "textareas",
                            theme : "advanced",
                            relative_urls:"false",
                            plugins: "jbimages",


                            // ===========================================
                            // PUT PLUGIN'S BUTTON on the toolbar
                            // ===========================================



                            theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                            theme_advanced_buttons4 : "jbimages,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",


                        });

                        <?php
                         }
                         ?>

                    </script>


                    <?php
                }
            }
        }
    }
}
?>

</main>
</div>

<div class="footer-basic">
    <footer>
        <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
        <ul class="list-inline">
            <li><a href="#">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">Click Innovation© 2018</p>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
<script src="<?php echo base_url('js/version_1/script.min.js'); ?>"></script>
</body>

</html>

</body>
</html>