<?php

    include('../../constante.php');
	/**/
	$data['sucesso'] = true;
	$data['mensagem'] = "";
    $data['erros'] = "Atenção: Dados Vazio não São Permitidos";
	if(Painel::logado() == false){
		die("Você não está logado!");
	}
	
	/*Nosso código começa aqui!*/
	if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_cliente'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo'];
        $imagem = "";
        $cpf = '';
        $cnpj = '';
        if($tipo == 'fisico'){
            $dado = $_POST['cpf'];
        }else if($tipo == 'juridico'){
            $dado = $_POST['cnpj'];
        }
        if($nome == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }else if($email == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }else if($tipo == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }else if($dado == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }
    
        if(isset($_FILES['imagem'])){
            if(Painel::imagemValida($_FILES['imagem'])){
            $imagem = $_FILES['imagem']; 
            }else{
                $imagem = "";
                $data['sucesso'] = false;
            }
            
        }else{
            $data['sucesso'] = false;
            $data['erros'] = 'Imagem Invalida/Vazia';
        }
        if($data['sucesso']){
            //cadastrar
            if(is_array($imagem)){
                $imagem = Painel::uploadFile($imagem);
            }
            $arr = [$nome,$email,$tipo,$dado,$imagem];
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.clientes` VALUES (null,?,?,?,?,?)");
            $sql->execute(array($nome,$email,$tipo,$dado,$imagem));
            $data['mensagem'] = "Cliente Cadastrado Com Sucesso";
        }
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'atualizar_cliente'){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo'];
        $imagem = $_POST['imagem_original'];
        $cpf = '';
        $cnpj = '';
        if($tipo == 'fisico'){
            $dado = $_POST['cpf'];
        }else if($tipo == 'juridico'){
            $dado = $_POST['cnpj'];
        }
        if($nome == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }else if($email == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }else if($tipo == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }else if($dado == ''){
            $data['sucesso'] = false;
            $data['erros'] ;
        }
    
        if(isset($_FILES['imagem'])){
            if(Painel::imagemValida($_FILES['imagem'])){
                @unlink('../uploads/'.$imagem);
                $imagem = $_FILES['imagem']; 
            }else{
                $data['sucesso'] = false;
                $data['erros'] = 'Você está tentando realizar um upload com imagem inválida.';
            }
        }
        if($data['sucesso']){
            //cadastrar
            if(is_array($imagem)){
                $imagem = Painel::uploadFile($imagem);
            }
            $sql = MySql::connect()->prepare("UPDATE `tb_admin.clientes` SET nome=?,email=?,tipo=?,cpf_cnpj=?,imagem=? WHERE id=?");
            $sql->execute(array($nome,$email,$tipo,$dado,$imagem,$id));
            $data['mensagem'] = "Cadastrado Atualizado Com Sucesso";
        }
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'deletar_cliente'){
		$id = $_POST['id'];
        $sql = MySql::connect()->prepare("SELECT imagem FROM `tb_admin.clientes` WHERE id=?");
        $sql->execute(array($id));
        $imagem=$sql->fetch()['imagem'];
        @unlink('../uploads/'.$imagem);
        MySql::connect()->exec("DELETE FROM `tb_admin.clientes` WHERE id=$id");
        MySql::connect()->exec("DELETE FROM `tb_admin.financeiro` WHERE cliente_id=$id");
        $data['mensagem'] = "Deletado Com Sucesso";
	}

	die(json_encode($data));



?>