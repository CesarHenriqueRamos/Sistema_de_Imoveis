<?php 
verificaPermissaoPagina(2);

?>
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

<?php 
$id = $_GET['id'];
 $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.fornecedor` WHERE produto=?");
 $sql->execute(array($id));
 $fornecedor = $sql->fetchAll();
 foreach($fornecedor as $key => $value){
?>

<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

    <h2 class="title"><i class="fas fa-user-plus"></i> Fornecedor</h2>
    <hr>    

    <form   method="post"  enctype="multipart/form-data">
        <div class="box-form">
            <label for="nome">Nome da Empresa:</label>
            <input type="text" name="nome" disabled id="nome" value="<?php echo $value['nome']?>">
        </div>
        <div class="box-form">
            <label for="nome">Telefone:</label>
            <input type="text" name="nome" disabled id="nome" value="<?php echo $value['telefone'];?>">
        </div>
    </form>
    
</div>
 <?php } ?>
