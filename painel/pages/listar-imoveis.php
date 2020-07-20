<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imovel_imagem` WHERE id_imovel=?");
$sql->execute(array($id));
$imagem = $sql->fetchAll();
foreach($imagem as $key =>$value){
    @unlink('uploads/'.$value['imagem']);
}


MySql::connect()->exec("DELETE FROM `tb_admin.imoveis` WHERE id=$id");
MySql::connect()->exec("DELETE FROM `tb_admin.imovel_imagem` WHERE id_imovel=$id");
}

?>
<div class="box-container w100">
    <div class="busca">
        <h4><i class="fa fa-search"></i> Buscar por Empreendimentos</h4>
        <form action="" method="post">
            <input type="text" name="busca" id="" placeholder="Procure pelo Nome do Imovel">
            <input type="submit"name="pesquisa" value="Buscar">
        </form>
        <div class="clear"></div>
    </div>

</div>
<div class="box-container w100">
    <h2 class="title"><i class="far fa-list-alt"></i> Empreendimentos</h2>
    <hr>
    
    <div class="boxes">
    <?php
       $query = ""; 
       if(isset($_POST['pesquisa'])){        
        $busca = $_POST['busca'];
        $query = " WHERE nome LIKE '%$busca%' OR tipo LIKE '%$busca%'";
       // $clientes = MySql::connect()->prepare("SELECT * FROM `$tabela` $query");
        }  
      $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imoveis` $query ORDER BY id DESC");
       $sql->execute();     
       $produtos = $sql->fetchAll();        
        if(isset($_POST['pesquisa'])){
            echo '<div class="busca-result"><p>Foram Encontrados '.count($produtos).' Resultado</p></div>';   
        }
        foreach($produtos as $key => $value){
        $sql = MySql::connect()->prepare("SELECT imagem FROM `tb_admin.imovel_imagem` WHERE id_imovel = ?");
        $sql->execute(array($value['id']));
        $imagem = $sql->fetch();
    ?>
        <div class="box-single-wraper">
            <div class="box-single">
                <div class="box-top">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagem['imagem'] ?>" alt="">
                </div><!--box-top-->
                <div class="box-body">
                    <p><b><i class="fa fa-box-open"></i> Endereço:</b> <?php echo $value['nome'] ?></p>
                    <p><b><i class="fa fa-box-open"></i> Valor:</b> <?php echo $value['preco']; ?></p>
                    <p><b><i class="fa fa-box-open"></i> Area:</b> <?php echo $value['area']; ?></p>
                    <div class="botao">                    
                        <!--botão de editar-->
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>editar-imoveis?id=<?php echo $value['id'];?>" class="margem-botao"><div class="col-bt editar"><i class="fas fa-pencil-alt"></i></div><!--col--></a> 
                        <!--botão de deletar-->                    
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>listar-imoveis?id=<?php echo $value['id'] ?>" class="margem-botao"><div item_id=<?php echo $value['id'] ?> class="col-bt delete"><i class="fas fa-trash"></i></div><!--col--></a>
                    </div> <!--botao--> 
                    <!--fim dos botoes-->
                </div><!--box-body-->                
            </div><!--box-single-->
        </div><!--box-single-wraper-->
       <?php } ?>
   </div><!--boxes-->
   <div class="clear"></div>
</div><!--tabela-responciva-->
 