<?php
    /*$usuariosOnline = Site::listarUsuaruosOnline();
    //visitas totais
    $visitasTotais = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas`");
    $visitasTotais->execute();
    $visitasTotais = $visitasTotais->rowCount();
    //visitas hoje
    $visitasHoje = MySql::connect()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
    $visitasHoje->execute(array(date('Y-m-d')));
    $visitasHoje = $visitasHoje->rowCount();
    //usuarios do painel
    $usuariosPainel = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios`");
    $usuariosPainel->execute();
    $usuariosPainel =  $usuariosPainel->fetchAll();*/
?>

            
            <div class="box-container w100">
            <h2 class="title"><i class="fas fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>
                <div class="w33 user marge-right">
                    <h3>Usuarios Online</h3>
                    <p>3</p>
                </div>
                <div class="w33 visita marge-right">
                    <h3>Total de Visitas</h3>
                    <p>3</p>
                </div>
                <div class="w33 visita-hoje">
                    <h3>Visitas Hoje</h3>
                    <p>3</p>
                </div>
            </div>
            
            <div class="box-container w100">
            <h2 class="title"><i class="fas fa-rocket"></i></i> Usuarios Online</h2>
            
            <div class="tabela-responciva">
                <div class="row">
                    <div class="col">
                        <span>IP:</span>
                    </div><!--col-->
                    <div class="col">
                        <span>Última Ação:</span>
                    </div><!--col-->
                    <div class="clear"></div>
                </div><!--row-->
                <?php //foreach($usuariosOnline as $key =>$value){?>
                
                <div class="row">
                    <div class="col">
                        <span><?php //echo $value['ip'];?></span>
                    </div><!--col-->
                    <div class="col">
                        <span><?php //echo date('d/m/Y H:i:s',strtotime($value['ultima_acao']));?></span>
                    </div><!--col-->
                    <div class="clear"></div>
                </div><!--row-->
                <?php// } ?>
            </div><!--tabela-responciva-->
            </div><!--fim da tabela-->
            <?php
            
            if($_SESSION['cargo'] == 2){?>
            <div class="box-container w100">
            <h2 class="title"><i class="fas fa-rocket"></i></i> Usuarios do Painel</h2>
            
            <div class="tabela-responciva">
                <div class="row">
                    <div class="col">
                        <span>User:</span>
                    </div><!--col-->
                    <div class="col">
                        <span>Nome:</span>
                    </div><!--col-->
                    <div class="clear"></div>
                </div><!--row-->
                <?php //foreach($usuariosPainel as $key =>$value){?>
                
                <div class="row">
                    <div class="col">
                        <span><?php //echo $value['user'];?></span>
                    </div><!--col-->
                    <div class="col">
                        <span><?php //echo pegaCargo($value['cargo']);?></span>
                    </div><!--col-->
                    <div class="clear"></div>
                </div><!--row-->
                <?php //} ?>
            </div><!--tabela-responciva-->
            </div>
         <?php }?>
            
            
