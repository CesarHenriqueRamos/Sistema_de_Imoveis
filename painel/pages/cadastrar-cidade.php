<?php 
verificaPermissaoPagina(2);
if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $estado = $_POST['estado'];
    

        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin_cidade` VALUES(null,?,?)");
        $sql->execute(array($nome,$estado));
            
            Painel::alert('sucesso','Cadastrado com Sucesso');
        
        
   
}
?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>
    <h2 class="title"><i class="fas fa-home"></i> Cadastar Cidade</h2>
    <hr>
    <div class="mensagem"></div>

    <form   method="post"  enctype="multipart/form-data">
        <div class="box-form">
            <label for="nome">Nome da Cidade:</label>
            <input type="text" name="nome" id="nome">
        </div>
        

        <div class="box-form">
            <label for="estado">Estado: </label>
            <select name="estado" id="estado">
                <option value="Santa Catarina"> Santa Catarina</option>
                <option value="Rondonia"> Rondônia</option>
            </select>
        </div>
        
        <div class="box-form">            
            <input type="submit" name="acao" value="Cadastrar">
        </div>
        <div class="clear"></div>
    </form>
    
</div>

