$(function(){
    $('nav.mobile i').click(function(){
        var menuMobile = $('nav.mobile ul');
    // abrir Ou Fechar O menu
        //fadeIn
        /*if(menuMobile.is(":hidden") == true){
            menuMobile.fadeIn();
        }else{
            menuMobile.fadeOut();
        }*/
        //slideToggle
        //icone
        var icon = $('nav.mobile i');
        if(menuMobile.is(":hidden") == true){
            menuMobile.slideToggle();
            icon.removeClass('fa-bars');
            icon.addClass('fa-times');
        }else{
            menuMobile.slideToggle();
            icon.removeClass('fa-times');
            icon.addClass('fa-bars');
        }
    })
    //scroll da pagina sobre e serviços
    if($('target').length > 0){
        var elemento = '#'+$('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html, body').animate({'scrollTop': divScroll},2000);
    }
})