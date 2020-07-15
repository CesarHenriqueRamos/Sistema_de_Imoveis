<?php 
verificaPermissaoPagina(2);
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
        $sucesso = false;
        Painel::alert('erro', 'Você Precisa Selecionar Pelo Menos uma Imagem');
    }
        
    if($sucesso){
        for($i = 0; $i < $imagensForm; $i++){
            $imagemAtual = ['tmp_name'=> $_FILES['imagens']['tmp_name'][$i], 'name'=>$_FILES['imagens']['name'][$i]];
            $imagens[] = Painel::uploadFile($imagemAtual);
        }
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.estoque` VALUES(null,?,?,?,?,?,?,?)");
        $sql->execute(array($nome,$descricao,$altura,$largura,$comprimento,$peso,$quantidade));
            $lastId = MySql::connect()->lastInsertId();
            foreach($imagens as $key => $value){
                MySql::connect()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES(null,'$lastId','$value')");
            }
            Painel::alert('sucesso','Cadastrado com Sucesso');
        
        
    }
}
?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>
    <h2 class="title"><i class="fas fa-user-plus"></i> Adicionar Produto</h2>
    <hr>
    <div class="mensagem"></div>

    <form   method="post"  enctype="multipart/form-data">
        <div class="box-form">
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" id="nome">
        </div>
        <div class="box-form">
            <label for="descricao">Descrição do Produto:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="altura">Altura:</label>
            <input  type="number" id="altura" name="altura" min="0" max="900" step="5" value="0">
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="largura">Largura:</label>
            <input  type="number" id="largura" name="largura" min="0" max="900" step="5" value="0">
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="comprimento">Comprimento:</label>
            <input  type="number" id="comprimento" name="comprimento" min="0" max="900" step="5" value="0">
        </div>
        <div class="box-form" style="width:200px; float:left;">
            <label for="peso">Peso:</label>
            <input  type="number" id="peso" name="peso" min="0" max="900" step="5" value="0">
        </div>
        <div class="box-form" style="width:100%; float:left;">
            <label for="quantidade">Quantidade:</label>
            <input  type="number" id="quantidade" name="quantidade" min="0" max="900" step="1" value="0">
        </div>
        <div class="box-form" style="width:100%; float:left;">
            <label for="img">Imagem:</label>
            <input multiple type="file" name="imagens[]" id="img">
        </div>
        <div class="box-form" style="100%; float:left;">            
            <input type="submit" name="acao" value="Cadastrar">
        </div>
        <div class="clear"></div>
    </form>
    
</div>

