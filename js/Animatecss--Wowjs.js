$(document).ready(function(){
  
    function loop() {
        $('#clouds').css({left:0});
        $('#clouds').animate ({
            left: '+=700',
        }, 5000, 'linear', function() {
            loop();
        });
    }
        
    loop();
    
    new WOW().init();   
});

