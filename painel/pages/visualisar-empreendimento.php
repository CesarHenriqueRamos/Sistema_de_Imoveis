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
                            
                    </div>                
                </div>
          
				<?php  }  ?>
			</div><!--nav-galeria-wraper-->

		</div><!--nav-galeria-->
		</div><!--nav-galeria-parent-->

        
</div>
<img src="../" alt="">
<div class="box-container w100" <?php verificaPermissaoMenu(2);?>>

    <h2 class="title"><i class="fas fa-user-plus"></i> Empreendimento</h2>
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
            <input type="text" name="nome" id="nome" value="<?php echo $dados['nome'];?>">
        </div>
        <div class="box-form">
            <label for="descricao">Tipo:</label>
            <input type="text" name="descricao" id="descricao" value="<?php echo $dados['tipo'];?>">
        </div>
        
        <div class="clear"></div>
    </form>
    
</div>

