<?php 
verificaPermissaoPagina(2);
$id = $_GET['id'];
if(isset($_GET['imagem'])){
    $idImagem = $_GET['imagem'];
    $sql = MySql::connect()->prepare("SELECT imagem FROM `tb_admin.imovel_imagem` WHERE id_imovel=?");
    $sql->execute(array($idImagem));
    $imagem = $sql->fetch()['imagem'];
    @unlink('uploads/'.$imagem);

    MySql::connect()->exec("DELETE FROM `tb_admin.imovel_imagem` WHERE id='$idImagem'");
    header('Location: '.INCLUDE_PATH_PAINEL.'editar-imoveis?id='.$id);
}
if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $valor = str_replace('.','',$_POST['preco']);
    $valor = str_replace(',','.', $valor);
    $area = $_POST['area'];
    $tipo = $_POST['tipo'];

    $imagens = array();
    $imagensForm = count($_FILES['imagens']['name']);
    $sucesso = true;
    if($_FILES['imagens']['name'][0] != ''){
        for($i = 0; $i < $imagensForm; $i++){
            $imagemAtual = ['type'=> $_FILES['imagens']['type'][$i], 'size'=>$_FILES['imagens']['size'][$i]];
            if(Painel::imagemValida($imagemAtual) == false){
                $sucesso = false;
                Painel::alert('erro','Alguam das Imagens não é Valida');
            break;
            }
        }
    }else{
       
    }
        
    if($sucesso){
        if($_FILES['imagens']['name'][0] != ''){
            for($i = 0; $i < $imagensForm; $i++){
                $imagemAtual = ['tmp_name'=> $_FILES['imagens']['tmp_name'][$i], 'name'=>$_FILES['imagens']['name'][$i]];
                $imagens[] = Painel::uploadFile($imagemAtual);
            }
        }
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.imoveis` SET nome=?,preco=?,area=?,tipo=? WHERE id=?");
        $sql->execute(array($nome,$valor,$area,$tipo,$id));
        if($_FILES['imagens']['name'][0] != ''){    
            foreach($imagens as $key => $value){
                MySql::connect()->exec("INSERT INTO `tb_admin.imovel_imagem` VALUES(null,'$id','$value')");
            }
        }
            Painel::alert('sucesso','Atualizado com Sucesso');
        
        
    }
}
?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

<?php 
 $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imovel_imagem` WHERE id_imovel=?");
 $sql->execute(array($id));
 $imagens = $sql->fetchAll();
 
?>

<!--teste-->
<div class="nav-galeria-parent">
		<div class="arrow-left-nav"></div>
		<div class="arrow-right-nav"></div>
		<div class="nav-galeria">
			<div class="nav-galeria-wraper">
                <?php foreach($imagens as $key => $value){ ?>
               
                <div class="mini-img-wraper"><div style="background-image:url('<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['imagem'];?>');;" class="mini-img">
                    <div class="botao">                    
                            <!--botão de deletar-->                    
                            <a href="<?php echo INCLUDE_PATH_PAINEL?>editar-imoveis?id=<?php echo $id ?>&imagem=<?php echo $value['id'];?>" class="margem-botao"><div item_id=<?php echo $value['id'] ?> class="col-bt delete"><i class="fas fa-trash"></i></div><!--col--></a>
                        </div> <!--botao--> 
                    </div>                
                </div>
          
				<?php  }  ?>
			</div><!--nav-galeria-wraper-->

		</div><!--nav-galeria-->
		</div><!--nav-galeria-parent-->

        
</div>
<img src="../" alt="">
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

    <h2 class="title"><i class="fas fa-user-plus"></i> Editar Empreendimento</h2>
    <hr>
    <div class="mensagem"></div>

    <form   method="post"  enctype="multipart/form-data">
    <?php 
    $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE id = ?");
    $sql->execute(array($id));
    $dados = $sql->fetch();   
?>
        <div class="box-form">
            <label for="nome">Endereço do Imovel:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $dados['nome'];?>">
        </div>
        <div class="box-form">
            <label for="npreco">Preço do Imovel:</label>
            <input type="text" name="preco" id="preco" value="<?php echo number_format($dados['preco'],2,',','.'); ?>">
        </div>
        <div class="box-form">
            <label for="area">Area do Imovel:</label>
            <input type="text" name="area" id="area" value="<?php echo $dados['area'];?>">
        </div> 
        <div class="box-form">
            <label for="area">Tipo:</label>
            <select name="tipo" id="">
                <option <?php if($dados['tipo'] == 'Comprar'){echo 'selected';} ?> value="Comprar">Comprar</option>
                <option <?php if($dados['tipo'] == 'Alugar'){echo 'selected';} ?> value="Alugar">Alugar</option>
            </select>
        </div>       
        <div class="box-form" >
            <label for="img">Imagem:</label>
            <input multiple type="file" name="imagens[]" id="img">
        </div>
        <div class="box-form" style="100%; float:left;">            
            <input type="submit" name="acao" value="Atualizar">
        </div>
        <div class="clear"></div>
    </form>
    
</div>

