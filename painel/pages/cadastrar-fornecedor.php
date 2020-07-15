<?php 
verificaPermissaoPagina(2);
if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $produto = $_POST['produto'];
    if($nome != '' || $telefone != ''){       
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.fornecedor` VALUES(null,?,?,?)");
        $sql->execute(array($nome,$telefone,$produto));
        Painel::alert('sucesso','Cadastrado com Sucesso');
        
    }
}
?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>
    <h2 class="title"><i class="fas fa-user-plus"></i> Adicionar Fornecedor</h2>
    <hr>
    <div class="mensagem"></div>

    <form   method="post"  enctype="multipart/form-data">
        <div class="box-form">
            <label for="nome">Nome do Fornecedor:</label>
            <input type="text" name="nome" id="nome">
        </div>
        <div class="box-form">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone">
        </div>
        
        <div class="box-form">
            <label for="produto">Produto:</label>
            <select name="produto" id="produto">
            <?php
                $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.estoque`");
                $sql->execute();
                $produto = $sql->fetchAll();
                foreach($produto as $key => $value){
            ?>
                <option value="<?php echo $value['id'];?>"><?php echo $value['nome'];?></option>
            <?php } ?>
            </select>
        </div>
        <div class="box-form" >            
            <input type="submit" name="acao" value="Cadastrar">
        </div>
        <div class="clear"></div>
    </form>
    
</div>

