<?php
include('../config.php');
$sql = MySql::connect();
?>
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
h2{
    background-color: #333;
    color: white;
    padding: 8px;
    margin-top: 15px;
}
.box{
    width: 900px;
    margin: 0 auto;
}
table{
    width: 900px;
    margin-top: 15px;
    border-collapse: collapse;
}
table td{
    border: 1px solid #ccc;
    font-size: 14px;
    padding: 8px;
}
</style>
<div class="box">
<?php
    $nome = (isset($_GET['pagamento']) && $_GET['pagamento'] == 'concluidos') ? 'Concluido':'Pendente';
?>
    <h2 class="title"><i class="fas fa-dollar-sign"></i> Pagamentos <?php echo $nome;?></h2>
        <table>
        <tr>
            <td style="font-weight: bold;">Dado Pagamento:</td>
            <td style="font-weight: bold;">Cliente:</td>
            <td style="font-weight: bold;">Valor</td>
            <td style="font-weight: bold;">Vencimento</td>
        </tr>
            <?php
            if($nome == 'Concluido'){
                $status = 1;
            }else{
                $status = 0;
            }
                $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status=? ORDER BY vencimento ASC ");
                $sql->execute(array($status));
                $dados = $sql->fetchAll();
                foreach($dados as $values){
                
                $sql = MySql::connect()->prepare("SELECT nome FROM `tb_admin.clientes` WHERE id=?");
                $sql->execute(array($values['cliente_id']));
                $nomeCliente = $sql->fetch()['nome'];
        ?>
        <tr>

            <td><?php echo $values['nome']; ?></td>
            <td><?php echo $nomeCliente; ?></td>
            <td><?php echo number_format($values['valor'],2,',','.'); ?></td>
            <td><?php echo $values['vencimento']; ?></td>
    
        </tr>
        <?php } ?>
        </table>
    </div>