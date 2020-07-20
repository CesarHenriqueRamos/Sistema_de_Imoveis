<?php 
verificaPermissaoPagina(2);
if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $empreendimento = $_POST['empreendimento'];
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
            <label for="descricao">Empreendimento:</label>
            <select name="empreendimento" id="">
            <?php
                $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.empreendimentos`");
                $sql->execute();
                $dados = $sql->fetchAll();
                
                foreach($dados as $key => $value){
                    echo $value['id'];
            ?>
                <option value="<?php echo $value['id'];?>"><?php echo $value['nome'];?></option>
            <?php } ?>
            </select>
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

