<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id=?");
$sql->execute(array($id));
$imagem = $sql->fetchAll();
foreach($imagem as $key =>$value){
    @unlink('uploads/'.$value['imagem']);
}


MySql::connect()->exec("DELETE FROM `tb_admin.estoque` WHERE id=$id");
MySql::connect()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE produto_id=$id");
}

?>
<div class="box-container w100">
    <div class="busca">
        <h4><i class="fa fa-search"></i> Buscar Cliente</h4>
        <form action="" method="post">
            <input type="text" name="busca" id="" placeholder="Procure pelo Nome do Produto">
            <input type="submit"name="pesquisa" value="Buscar">
        </form>
        <div class="clear"></div>
    </div>

</div>
<div class="box-container w100">
    <h2 class="title"><i class="far fa-list-alt"></i> Clientes Cadastrados</h2>
    <hr>
    
    <div class="boxes">
    <?php
       $query = ""; 
       if(isset($_POST['pesquisa'])){        
        $busca = $_POST['busca'];
        $query = " WHERE nome LIKE '%$busca%'";
       // $clientes = MySql::connect()->prepare("SELECT * FROM `$tabela` $query");
        }  
      $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.estoque` $query");
       $sql->execute();     
       $produtos = $sql->fetchAll();        
        if(isset($_POST['pesquisa'])){
            echo '<div class="busca-result"><p>Foram Encontrados '.count($produtos).' Resultado</p></div>';   
        }
        foreach($produtos as $key => $value){
        $sql = MySql::connect()->prepare("SELECT imagem FROM `tb_admin.estoque_imagens` WHERE produto_id = ?");
        $sql->execute(array($value['id']));
        $imagem = $sql->fetch();
    ?>
        <div class="box-single-wraper">
            <div class="box-single">
                <div class="box-top">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagem['imagem'] ?>" alt="">
                </div><!--box-top-->
                <div class="box-body">
                    <p><b><i class="fa fa-box-open"></i> Nome:</b> <?php echo $value['nome'] ?></p>
                    <!--<p><b><i class="fa fa-box-open"></i> Descrição:</b> <?php echo $value['descricao'] ?></p>-->
                    <p><b><i class="fa fa-box-open"></i> Altura:</b> <?php echo $value['altura'] ?> cm</p>
                    <p><b><i class="fa fa-box-open"></i> Largura:</b> <?php echo $value['largura'] ?> cm</p>
                    <p><b><i class="fa fa-box-open"></i> Comprimento:</b> <?php echo $value['comprimento'] ?> cm</p>
                    <p><b><i class="fa fa-box-open"></i> Peso:</b> <?php echo $value['peso'] ?> g</p>
                    <p><b><i class="fa fa-box-open"></i> Quntidade:</b> <?php echo $value['quantidade'] ?></p>
                    <div class="botao">                    
                        <!--botão de editar-->
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>editar-produto?id=<?php echo $value['id'];?>" class="margem-botao"><div class="col-bt editar"><i class="fas fa-pencil-alt"></i></div><!--col--></a> 
                        <!--botão de deletar-->                    
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>visualisar-produtos?id=<?php echo $value['id'] ?>" class="margem-botao"><div item_id=<?php echo $value['id'] ?> class="col-bt delete"><i class="fas fa-trash"></i></div><!--col--></a>
                    </div> <!--botao--> 
                    <!--fim dos botoes-->
                </div><!--box-body-->                
            </div><!--box-single-->
        </div><!--box-single-wraper-->
       <?php } ?>
   </div><!--boxes-->
   <div class="clear"></div>
</div><!--tabela-responciva-->
 