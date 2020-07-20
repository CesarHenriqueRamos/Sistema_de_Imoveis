<?php 
verificaPermissaoPagina(2);
$id = $_GET['id'];
?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

<?php 
 $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.empreendimentos_imagens` WHERE id_empreendimento=?");
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

<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

    <h2 class="title"><i class="fas fa-home"></i> Empreendimento</h2>
    <hr>
    <div class="mensagem"></div>

    <form   method="post"  enctype="multipart/form-data">
    <?php 
    $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE id = ?");
    $sql->execute(array($id));
    $dados = $sql->fetch();   
?>
        <div class="box-form">
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" id="nome" disabled value="<?php echo $dados['nome'];?>">
        </div>
        <div class="box-form">
            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" id="tipo" disabled value="<?php echo $dados['tipo'];?>">
        </div>
        
        <div class="clear"></div>
    </form>
    
</div>
<?php 
verificaPermissaoPagina(2);
if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $empreendimento = $id;
    $valor = $_POST['preco'];
    $area = $_POST['area'];

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
        $sucesso = false;
        Painel::alert('erro', 'Você Precisa Selecionar Pelo Menos uma Imagem');
    }
        
    if($sucesso){
        for($i = 0; $i < $imagensForm; $i++){
            $imagemAtual = ['tmp_name'=> $_FILES['imagens']['tmp_name'][$i], 'name'=>$_FILES['imagens']['name'][$i]];
            $imagens[] = Painel::uploadFile($imagemAtual);
        }
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.imoveis` VALUES(null,?,?,?,?)");
        $sql->execute(array($empreendimento,$nome,$valor,$area));
            $lastId = MySql::connect()->lastInsertId();
            foreach($imagens as $key => $value){
                MySql::connect()->exec("INSERT INTO `tb_admin.imovel_imagem` VALUES(null,'$lastId','$value')");
            }
            Painel::alert('sucesso','Cadastrado com Sucesso');
        
        
    }
}
?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>
    <h2 class="title"><i class="fas fa-home"></i> Cadastar Imóvel</h2>
    <hr>
    <div class="mensagem"></div>

    <form   method="post"  enctype="multipart/form-data">
        <div class="box-form">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
        </div>

        <div class="box-form">
            <label for="preco">Preço:</label>
            <input type="text" name="preco" id="preco">
        </div>
        <div class="box-form">
            <label for="area">Área:</label>
            <input type="number" name="area" id="area">
        </div>
        <div class="box-form" >
            <label for="img">Imagem:</label>
            <input multiple type="file" name="imagens[]" id="img">
        </div>
        <div class="box-form">            
            <input type="submit" name="acao" value="Cadastrar">
        </div>
        <div class="clear"></div>
    </form>
    
</div>


