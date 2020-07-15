<?php include('config.php'); ?>
<?php// Site::updateUsuarioOnline(); ?>
<?php// Site::contador();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
    <meta name="author" content="Cesar Henrique Ramos">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>estilo/style.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon" />
    <title>Site Dinamico</title>
</head>
<body>

<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'sobre':
				echo '<target target="sobre" />';
				break;

			case 'servicos':
				echo '<target target="servicos" />';
				break;
		}
    ?>
    <!--componentes de mensagem e load-->
    <div class="sucesso">Formulário Enviado com Sucesso!</div>
    <div class="erro">Erro ao Enviar o Formulário</div>
	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH ?>images/ajax-loader.gif" />
	</div><!--overlay-loading-->
	<header>
		<div class="container">
			<div class="logo left"><a href="/">RamosTecnolog</a></div><!--logo-->
			<nav class="desktop right">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
			 <nav class="mobile right">
			 	<div class="botao-menu-mobile">
			 		<i class="fa fa-bars" aria-hidden="true"></i>
			 	</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
		<div class="clear"></div><!--clear-->
		</div><!--center-->
	</header>

	<div class="container-principal">
	<?php

		if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}else{
			//Podemos fazer o que quiser, pois a página não existe.
			if($url != 'sobre' && $url != 'servicos'){
				$pagina404 = true;
				include('pages/404.php');
			}else{
				include('pages/home.php');
			}
		}

	?>

	</div><!--container-principal-->

	<footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'; ?>>
		<div class="container">
			<p>Todos os direitos reservados</p>
		</div><!--center-->
	</footer>
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/google_maps.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

	<?php
		if($url == 'contato'){
	?>
	<?php } ?>
	<!--<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>-->
	<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>

</body>
</html>