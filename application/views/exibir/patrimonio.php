<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- pinpad  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="page-header">
            <h1>Listagem Patrimônial do PIC</h1>
        </div>
        <!-- Tabela listando pinpads -->
        <?php if (isset($lista)) {?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Patrimônio</th>
                    <th>Equipamento</th>                    
                    <th>Modelo</th>
                    <th>Serial</th>
                    <th>Local</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $item) { ?>
                <tr>
                    <td><?php echo $item->getPatrimonio(); ?></td>
                    <td><?php echo $item->getEquipamento(); ?></td>
                    <td><?php echo $item->getModelo(); ?></td>
                    <td><?php echo $item->getSerie(); ?></td>
                    <td><?php echo $local->buscaId($item->getIdlocal())->getNome(); ?></td>
                </tr>
                <?php } //foreach lista?>   
            </tbody>
        </table>        
    </div> 
        <div class="alert alert-success" role="alert">
            Emissão: <?php echo date("d-m-Y") ?>. - Total de equipamentos: <?php echo count($lista) ?>.
        </div>
    <?php }?>
</div>