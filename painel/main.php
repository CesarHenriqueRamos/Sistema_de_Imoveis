<?php
    if(isset($_GET['logout'])){
        Painel::logout();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
    <meta name="author" content="Cesar Henrique Ramos">

    <link  rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon" />
    <title>Painel de Controle</title>
</head>
<body>
<base base="<?php echo INCLUDE_PATH_PAINEL; ?>"></base>
<header>
		<div class="container">
			<div class="menu-btn">
                <i class="fa fa-bars" ></i>
            </div>
            <div class="logout">
            <div  class="btn-home" >
                <a <?php if(@$_GET['url'] == ''){ ?>class="home"<?php } ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fas fa-home"></i> Home</a>
            </div>
            <a  href="<?php echo INCLUDE_PATH_PAINEL; ?>?logout"><i class="fas fa-sign-out-alt"></i> LogOut</a>
            </div>
		<div class="clear"></div><!--clear-->
		</div><!--container-->
    </header>
    <div class="conteudo">
        <div class="container">
            <?php Painel::carregarPagine();?>
        </div>        
    </div>
    <div class="menu">
        <div class="menu-wraper">
            <div class="box-usuario">
                <?php if($_SESSION['img'] == ''){?>
                <div class="avata-user"><i class="fa fa-user"></i></div>
                <?php } else{?>
                    <div class="img-user"><img src="<?php INCLUDE_PATH_PAINEL?>uploads/<?php echo $_SESSION['img'];?>" alt="">
                <?php }?>    
                    <p id="bem-vindo"><?php echo $_SESSION['nome'] ?></p>
                    <p id="cargo"><?php echo pegaCargo($_SESSION['cargo']);?></p>
                    <hr>
               
            </div><!--boo-usuario-->
            <div class="items-menu">
                    <h2>Controle Estoque</h2>
                    <a <?php selecionadoMenu('cadastrar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-produtos">Cadastrar Produtos</a>
                    <a <?php selecionadoMenu('cadastrar-fornecedor'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-fornecedor">Cadastrar Fornecedor</a>
                    <a <?php selecionadoMenu('visualisar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>visualisar-produtos">Visualizar Produtos</a>
                    <a <?php selecionadoMenu('produtos-em-falta'); ?> href="<?php echo INCLUDE_PATH_PAINEL?>produtos-em-falta">Produtos em Falta</a>
                    
        </div>     
        <div class="clear"></div>
    </div>
    
    

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/script.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.ajaxForm.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/ajax.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/helperMask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/slider.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/carrocelImagem.js"></script>
<?php Painel::loadJS(array('clientes.js'),'gerenciar-cliente');?>
<!--novos Plugus-->
<script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.maskMoney.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
<?php Painel::loadJS(array('controleFinanceiro.js'),'cliente-pagamento');?>
</body>
</html>