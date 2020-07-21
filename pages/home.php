<section class="busca">
    <div class="container">
        <form action="" method="post">
        <div class="box-form w33">
                <label for="preco">O que você precisa?</label>
                <br>
                <input class="btn-selecionado" type="button" value="Comprar">
                <input type="button" value="Alugar">
            </div>
            <div class="box-form w33">
                <label for="preco">Qual Tipo?</label>
                <select>
                    <option value="residencial"> Residencial</option>
                    <option value="comercial"> Comercial</option>
                </select>
            </div>
            <div class="box-form w33">
                <label for="preco">Onde?</label>
                <input type="text" name="preco" id="preco">
            </div>
            <div class="box-form w33">
                <label for="preco">Faicha de Preço?</label>
                <select>
                    <option value="100.000,00"> até 100.000,00</option>
                    <option value="200.000,00"> até 200.000,00</option>
                    <option value="300.000,00"> até 300.000,00</option>
                    <option value="400.000,00"> até 400.000,00</option>
                    <option value="500.000,00"> até 500.000,00</option>
                </select>
            </div>
            <div class="box-form w33">
                <label for="preco">Área?</label>
                <select>
                    <option value="50"> até 50m²</option>
                    <option value="100"> até 100m²</option>
                </select>
            </div>
            <div class="box-form w33">
               <input type="submit" value="Pesquisar">
        </form>
        <div class="clear"></div>
    </div><!--container-->
</section>
<section class="imoveis">
    <div class="container">
        <?php
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imoveis`");
            $sql->execute();
            $dados = $sql->fetchAll();        
            foreach($dados as $key => $value){
                $id = $value['id_empreendimento'];
                $imovel = $value['id'];
                $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE id = ?");
                $sql->execute(array($id));
                $empreendimento = $sql->fetch();  
                $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.imovel_imagem` WHERE id_imovel = ?");
                $sql->execute(array($imovel));
                $imagem_imovel = $sql->fetch();  
            ?>
       <div class="imovel-single">
            <div class="imagem-imovel">
                <img src="painel/uploads/<?php echo $imagem_imovel['imagem'];?>" alt="">
            </div>
            <div class="dados-imovel">
                <div class="w50">
                    <h2><a href=""><?php echo $empreendimento['nome']; ?></a></h2>
                    <h3><?php echo $value['nome']; ?></h3>
                    <p>Valor: R$ <?php echo number_format($value['preco'],2,',','.'); ?></p>
                    <p>Área: <?php echo $value['area']; ?>m²</p>
                    <p>Tipo: <?php echo $value['tipo']; ?></p>
                </div>
                <div class="w50">
                    <h2>Contato:</h2>
                    <button>Contato</button>
                </div>
               
            </div>
       </div>
       <div class="clear"></div> 
        <?php } ?>
    </div><!--container-->
</section>