<?php
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
            $sql->execute(array($user,$password));
            $info = $sql->fetch();
            if($sql->rowCount() == 1){
                 //logado com sucesso
                 $_SESSION['login'] = true;
                 $_SESSION['user'] = $user;
                 $_SESSION['password'] = $password;
                 $_SESSION['cargo'] = $info['cargo'];
                 $_SESSION['nome'] = $info['nome'];
                 $_SESSION['img'] = $info['img'];
                 header('Location: '.INCLUDE_PATH_PAINEL);
                 die();
            }
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon" />
    <title>Login</title>
</head>
<body class="log">

    <section class="login">
    <?php
        if(isset($_POST['acao'])){
            $user = $_POST['user'];
            $password = $_POST['password'];
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
            $sql->execute(array($user,$password));
            $info = $sql->fetch();
            if($sql->rowCount() == 1){
                
                //logado com sucesso
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['img'] = $info['img'];
                if(isset($_POST['lembrar'])){
                    setcookie('lembrar',true,time()+(60*60*24*30),'/');
                    setcookie('user',$user,time()+(60*60*24*30),'/');
                    setcookie('lpassword',$password,time()+(60*60*24*30),'/');
                }
                header('Location: '.INCLUDE_PATH_PAINEL);
                die();
            }else{
                //falha ao logar
                echo '<div class="erro"><i class="fas fa-times"></i> Usuário ou Senha Incorreta</div>';
            }
        }
        
    ?>
        <div class="container">
            <form action="" method="post">
                <h2>Login</h2>
                <hr>
                <input type="text" name="user" id="" placeholder="Login..." require>
                <input type="password" name="password" id="" placeholder="Senha..." require>
                <input type="submit" name="acao" value="Logar">
                <div class="lembrar">
                    <label for="lembrar">Lembrar-me</label>
                    <input type="checkbox" name="lembrar" id="lembrar">
                </div>
            </form>
            <div class="clear"></div>
        </div>
    </section>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>