<?php 
verificaPermissaoPagina(2);
if(isset($_POST['acao'])){
    $endereco = $_POST['endereco'];
    $quartos = (int)$_POST['quartos'];
    $vagas = (int)$_POST['vagas'];
    $valor = str_replace('.','',$_POST['valor']);
    $valor = str_replace(',','.', $valor);
    $area = $_POST['area'];
    $alugar_vender = $_POST['alugar_vender'];
    $cidade = $_POST['cidade'];
    $comercial_residencial = $_POST['comercial_residencial'];

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
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.imoveis` VALUES(null,?,?,?,?,?,?,?,?)");
        $sql->execute(array($endereco,$quartos,$vagas,$valor,$area,$alugar_vender,$cidade,$comercial_residencial));
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
            <label for="endereco">Endereço do imovel:</label>
            <input type="text" name="endereco" id="endereco">
        </div>
        <div class="box-form">
            <label for="quartos">Quantidade de Quartos:</label>
            <select name="quartos" id="">
            <?php
               for($i = 0; $i <= 10; $i++){
            ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php } ?>
            </select>
        </div>
        <div class="box-form">
            <label for="quartos">Quantidade de Vagas:</label>
            <select name="vagas" id="">
            <?php
               for($i = 0; $i <= 10; $i++){
            ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php } ?>
            </select>
        </div>
        <div class="box-form">
            <label for="valor">Valor do Imovel:</label>
            <input type="text" name="valor" id="valor">
        </div>
        <div class="box-form">
            <label for="area">Área:</label>
            <input type="number" name="area" id="area">
        </div>
        <div class="box-form">
            <label for="alugar_vender">Alugar ou Vender? </label>
            <select name="alugar_vender" id="alugar_vender">
                <option value="Comprar">Comprar</option>
                <option value="Alugar">Alugar</option>
            </select>
        </div>
        <div class="box-form">
            <label for="comercial_residencial">Alugar ou Vender? </label>
            <select name="comercial_residencial" id="comercial_residencial">
                <option value="Comercial">Comercial</option>
                <option value="Residencial">Residencial</option>
            </select>
        </div>
        <div class="box-form">
            <label for="cidade">Cidade:</label>
            <select name="cidade" id="cidade">
            <?php 
                $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin_cidade`");
                $sql->execute();
                $dados = $sql->fetchAll();
                foreach($dados as $key => $value){
            ?>
                <option value="<?php echo $value['nome'];?>"><?php echo $value['nome'];?></option>
            <?php } ?>
            </select>
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

