<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- pos  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="page-header">
            <h1>Listagem POS do PIC</h1>
        </div>
        <!-- Tabela listando pos -->
        <?php if (isset($lista)) {?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Modelo</th>
                    <th>Serial</th>
                    <th>Local</th>
                    <th>Chart</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $item) { ?>
                <tr <?php if($item->getManutencao()){echo 'class="danger"';} else{echo 'class=""';} ?> >
                    <td><?php echo $item->getNome(); ?></td>
                    <td><?php echo $item->getModelo(); ?></td>
                    <td><?php echo $item->getSerial(); ?></td>
                    <td><?php echo $local->buscaId($item->getIdlocal())->getNome(); ?></td>
                    <td><?php if($item->getManutencao()){echo "Sim";} else{echo "Não";} ?></td>
                </tr>
                <?php } //foreach lista?>   
            </tbody>
        </table>        
    </div> 
        <div class="alert alert-success" role="alert">
            Emissão: <?php echo date("d-m-Y") ?>. - Total de POS: <?php echo count($lista) ?>.
        </div>
    <?php }?>
</div>