<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- home admin  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <h1>Área administrativa do Sistema PIC<small> Configurações do sistema PIC.</small></h1>
        <br/>
        <br/>
        <div class="row">
            
            <!-- botão de atualizar as maquinas (caixas)-->
            <div class="novo-chamado col-md-6">
                <a class="btn btn-warning" href="#" role="button" title="Atualiza as maquinas dos caixas pelo arquivo TXT em \\JAGUAR\Parametros_ECF\IpSistemaPic\IP.TXT"
                   onclick="carregarArquivoMaquina(this)">
                    Atualizar maquinas
                    <i class="fa fa-circle-o-notch hidden"></i>
                </a>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("administracao/busca") ?>">
                    <div class="input-group">
                        <input type="text" class="form-control" id="iptBusca" name="iptBusca" 
                               placeholder="buscar por logs...">
                        <span class="input-group-btn">
                            <button class="btn btn-warning" type="submit">Buscar!</button>
                        </span>
                    </div>
                </form>            
            </div>
        </div>
        <div class="row">
            <!--Todos logs-->
            <?php if (isset($logs)) {?>
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Últimos logs do sistema</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Data</th>
                                        <th>IP</th>
                                        <th>Usuário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach ($logs as $log) { ?>
                                    <tr>
                                        <td><?php echo $log->getIdlog(); ?></td>
                                        <td><?php echo $log->getNome(); ?></td>
                                        <td><?php echo $log->getDescricao(); ?></td>
                                        <td><?php echo $log->getData(); ?></td>
                                        <td><?php echo $log->getIp(); ?></td>
                                        <?php if ($log->getIdusuario() == 0) { ?>
                                        <td><?php echo "Sistema"; ?></td>
                                        <?php } else { ?>
                                        <td><?php echo $usuario->buscaId($log->getIdusuario())->getNome(); ?></td>
                                        <?php }?>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div><!--Fim table-responsive-->
                    </div><!--Fim panel-body-->
                </div><!--Fim panel-->
            </div><!--Fim col-md-12-->
            <?php }?> <!--Fim todos logs-->
            
            <!--Busca-->
            <?php if (isset($resultados)) {?>
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Resultado da busca: <strong><?php echo $palavra; ?></strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Data</th>
                                        <th>IP</th>
                                        <th>Usuário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resultados as $resultado) { ?>
                                    <tr>
                                        <td><?php echo $resultado->getIdlog(); ?></td>
                                        <td><?php echo $resultado->getNome(); ?></td>
                                        <td><?php echo $resultado->getDescricao(); ?></td>
                                        <td><?php echo $resultado->getData(); ?></td>
                                        <td><?php echo $resultado->getIp(); ?></td>
                                        <?php if ($resultado->getIdusuario() == 0) { ?>
                                        <td><?php echo "Sistema"; ?></td>
                                        <?php } else { ?>
                                        <td><?php echo $usuario->buscaId($resultado->getIdusuario())->getNome(); ?></td>
                                        <?php }?>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div><!--Fim table-responsive-->
                    </div><!--Fim panel-body-->
                </div><!--Fim panel-->
            </div><!--Fim col-md-12-->
            <?php }?> <!--Fim todos logs-->
        </div> <!-- fim row do painel -->
   </div>
</div> <!--fim row-->