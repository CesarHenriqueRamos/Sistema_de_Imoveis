$(function(){
    $('.ajax').ajaxForm({
        dataType:'json',
        beforeSend:function(){
            $('.ajax').animate({'opacity':'0.4'});
            $('.ajax').find('input[type=submit]').attr('disabled','true');
        },
        success:function(data){
            $('.ajax').animate({'opacity':'1'});
            $('.ajax').find('input[type=submit]').removeAttr('disabled');
            $('.box-alert').remove();
            if(data.sucesso){
                $('.mensagem').prepend('<div class="box-alert sucesso"><i class="fas fa-check"></i> '+data.mensagem+'</div>')
                if(('.ajax').attr('atualizar') == undefined){
                    $('.ajax')[0].reset();
                }
                
            }else{
                $('.mensagem').prepend('<div class="box-alert err"><i class="fas fa-check"></i> '+data.erros+'</div>')
            }
           
        }
    })
   /* $('.btn.delete').click(function(e){
		e.preventDefault();
		var item_id = $(this).attr('item_id');
		var el = $(this).parent().parent().parent().parent();
		$.ajax({
			url:include_path+'/ajax/forms.php',
			data:{id:item_id,tipo_acao:'deletar_cliente'},
			method:'post'
		}).done(function(){
			el.fadeOut();	
		})
	})*/
});