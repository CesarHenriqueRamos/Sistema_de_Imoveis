<?php 
verificaPermissaoPagina(2);
$id = $_GET['id'];
if(isset($_GET['imagem'])){
    $idImagem = $_GET['imagem'];
    $sql = MySql::connect()->prepare("SELECT imagem FROM `tb_admin.estoque_imagens` WHERE id=?");
    $sql->execute(array($idImagem));
    $imagem = $sql->fetch()['imagem'];
    print_r($imagem);
    @unlink('uploads/'.$imagem);

    MySql::connect()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE id='$idImagem'");
    header('Location: '.INCLUDE_PATH_PAINEL.'editar-produto?id='.$id);
}
if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $altura = $_POST['altura'];
    $largura = $_POST['largura'];
    $comprimento = $_POST['comprimento'];
    $peso = $_POST['peso'];
    $quantidade = $_POST['quantidade'];
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
        //$sucesso = false;
        //Painel::alert('erro', 'Você Precisa Selecionar Pelo Menos uma Imagem');
    }
        
    if($sucesso){
        if($_FILES['imagens']['name'][0] != ''){
            for($i = 0; $i < $imagensForm; $i++){
                $imagemAtual = ['tmp_name'=> $_FILES['imagens']['tmp_name'][$i], 'name'=>$_FILES['imagens']['name'][$i]];
                $imagens[] = Painel::uploadFile($imagemAtual);
            }
        }
        $sql = MySql::connect()->prepare("UPDATE `tb_admin.estoque` SET nome=?,descricao=?,altura=?,largura=?,comprimento=?,peso=?,quantidade=? WHERE id= ?");
        $sql->execute(array($nome,$descricao,$altura,$largura,$comprimento,$peso,$quantidade,$id));
            if($_FILES['imagens']['name'][0] != ''){
                foreach($imagens as $key => $value){
                     MySql::connect()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES(null,'$id','$value')");
                 }
            }
            
            Painel::alert('sucesso','Atualizado com Sucesso');
        
        
    }
}
?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

<?php 
 $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id=?");
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
                            <a href="<?php echo INCLUDE_PATH_PAINEL?>editar-produto?id=<?php echo $id?>&imagem=<?php echo $value['id'] ?>" class="btn-delete"><div item_id=<?php echo $value['id'] ?> class="col-bt delete"><i class="fas fa-trash"></i></div><!--col--></a>
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

    <h2 class="title"><i class="fas fa-user-plus"></i> Adicionar Produto</h2>
    <hr>
    <div class="mensagem"></div>

    <form   method="post"  enctype="multipart/form-data">
    <?php 
    $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
    $sql->execute(array($id));
    $dados = $sql->fetch();   
?>
        <div class="box-form">
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" id="nome" value="<?php echo $dados['nome'];?>">
        </div>
        <div class="box-form">
            <label for="descricao">Descrição do Produto:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"><?php echo $dados['descricao'];?></textarea>
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="altura">Altura:</label>
            <input  type="number" id="altura" name="altura" min="0" max="900" step="5" value="<?php echo $dados['altura'];?>">
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="largura">Largura:</label>
            <input  type="number" id="largura" name="largura" min="0" max="900" step="5" value="<?php echo $dados['largura'];?>">
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="comprimento">Comprimento:</label>
            <input  type="number" id="comprimento" name="comprimento" min="0" max="900" step="5" value="<?php echo $dados['comprimento'];?>">
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="peso">Peso:</label>
            <input  type="number" id="peso" name="peso" min="0" max="900" step="5" value="<?php echo $dados['peso'];?>">
        </div>
        <div class="box-form" style="width:100%; float:left;">
            <label for="quantidade">Quantidade:</label>
            <input  type="number" id="quantidade" name="quantidade" min="0" max="900" step="1" value="<?php echo $dados['quantidade'];?>">
        </div>
        <div class="box-form" style="width:100%; float:left;">
            <label for="img">Imagem:</label>
            <input multiple type="file" name="imagens[]" id="img">
        </div>
        <div class="box-form" style="100%; float:left;">            
            <input type="submit" name="acao" value="Atualizar">
        </div>
        <div class="clear"></div>
    </form>
    
</div>

