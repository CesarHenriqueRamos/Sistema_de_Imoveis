$(function(){
    var curSlider = 0;
    var delay = 3;
    //var maxSlider = 2;
    var maxSlider = $('.slider-sigle').length - 1;
    changesSlide();
    //criar as bolinhas
    for(var i = 0; i < maxSlider+1; i++){
        var content = $('.bullets').html();
        if(i == 0){
            content += '<span class="active-slider"></span>'; 
        }else{
            content += '<span></span>';
        }
        
        $('.bullets').html(content);
    }
    //função de colorir os bullet
    function colorBullet(){
        $('.bullets span').removeClass(); 
        $('.bullets span').eq(curSlider).addClass('active-slider');         
            
    }
    function changesSlide(){
        
        setInterval(function(){            
            $('div.slider-sigle').hide();
            $('div.slider-sigle').eq(curSlider).show();  
            colorBullet(); 
            curSlider++;
            if(curSlider > maxSlider){
                curSlider = 0;
            }
        }, delay * 1000);
    }
    $('body').on('click','.bullets span', function(){
        var currentBullet = $(this);
        $('div.slider-sigle').eq(curSlider).fadeOut();
        curSlider = currentBullet.index();
        $('div.slider-sigle').eq(curSlider).fadeIn();
        colorBullet(); 
    });
    
})