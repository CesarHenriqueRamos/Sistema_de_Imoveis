//efeito de carregamento da div com animação
$(function(){
    var atual = -1;
    //a box-especial é a box que emcapsula todo o conteudo
    var maximo = $('.especialidade-single').length -1;
    var time;
    var animacaoDelay = 3;
    executarAnimacao();
    function executarAnimacao(){
        $('.box-especial').hide();
        time = setInterval(logicaAnimacao,animacaoDelay * 1000);

        function logicaAnimacao(){
            atual++;
            if(atual > maximo){
                clearInterval(time);
                return false;
            }
            $('.especialidade-single').eq(atual).fadeIn();
        }
    }
});

