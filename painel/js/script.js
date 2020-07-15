$(function() {
    var open = true;
    var windowSize = $(window)[0].innerWidth;
    var targetSizeMenu = (windowSize <= 400) ? 200 : 250;
    if(windowSize <= 760){
        $('.menu').css('width','0').css('padding', '0');
        open = false;
    }
    $('.menu-btn').click(function(){
        if(open){
            $('.menu').animate({'width':0, 'padding':0},function(){
                open = false;
            });
             $('.conteudo, header').css({'width': '100%'});  
            $('.conteudo, header').animate({'left':0},function(){
                open = false;
            });
        }else{
            //menu fechado
            $('.menu').css('display', 'block');
            //
            $('.menu').animate({'width': targetSizeMenu+'px','padding':'10px 0'},function () {
                open = true;
            });
            if(windowSize > 768)
                $('.conteudo, header').css('width','calc(100% - 250px');
            
            $('.conteudo, header').animate({'left': targetSizeMenu+'px'},function(){
                open = true;
            });
        }
    });
    //função do professor
    $(window).resize(function(){
		windowSize = $(window)[0].innerWidth;
		targetSizeMenu = (windowSize <= 400) ? 200 : 250;
		if(windowSize <= 768){
			$('.menu').css('width','0').css('padding','0');
            $('.conteudo, header').css('width','100%').css('left','0');
			open = false;
		}else{
			$('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
			});

            $('.conteudo, header').css('width','calc(100% - 250px)');
            $('.conteudo, header').animate({'left':targetSizeMenu+'px'},function(){
			open = true;
			});
		}

    });
    $('[actionBtn = delete]').click(function(){
        var txt;
        var r = confirm('Deseja Excluir o Registro?');
        if(r == true)
            return true;
        else
            return false;
    })
})
