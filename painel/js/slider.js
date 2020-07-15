//estudar o codigo
$(function(){
 // Sistema de slide da página individual de cada carro.
  var imgShow = 3;
        var maxIndex = Math.ceil($('.mini-img-wraper').length/3) - 1;
        var curIndex = 0;

        initSlider();
        navigateSlider();
        clickSlider();
        function initSlider(){
           var amt = $('.mini-img-wraper').length * 33.3;
           var elScroll = $('.nav-galeria-wraper');
           var elSingle = $('.mini-img-wraper');
           elScroll.css('width',amt+'%');
           elSingle.css('width',32.6*(100/amt)+'%');
        }

        function navigateSlider(){
             $('.arrow-right-nav').click(function(){
                  if(curIndex < maxIndex){
                      curIndex++;
                      var elOff = $('.mini-img-wraper').eq(curIndex*3).offset().left - $('.nav-galeria-wraper').offset().left;
                      $('.nav-galeria').animate({'scrollLeft':elOff+'px'});
                  }else{
                     //console.log("Chegamos até o final!");
                  }
              });

             $('.arrow-left-nav').click(function(){
                 if(curIndex > 0){
                      curIndex--;
                      var elOff = $('.mini-img-wraper').eq(curIndex*3).offset().left - $('.nav-galeria-wraper').offset().left;
                      $('.nav-galeria').animate({'scrollLeft':elOff+'px'});
                  }else{
                      //console.log("Chegamos até o final!");
                  }
             })
        }


        function clickSlider(){
                $('.mini-img-wraper').click(function(){
                   $('.mini-img-wraper').css('background-color','transparent');
                  
                   var img = $(this).children().css('background-image');
                   $('.foto-destaque').css('background-image',img);
                })

                $('.mini-img-wraper').eq(0).click();

        }


        
 
})