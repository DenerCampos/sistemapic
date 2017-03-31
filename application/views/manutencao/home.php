<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- manutencaos  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarManutencao" 
                    data-toggle="modal" data-target="#mdlCriarManutencao" role="button">
                Nova manutenção
            </button>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("manutencao/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por equipamento...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
    </div>
    <!-- tab panel -->
    <div class="row">
        <div class="col-md-12">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="<?php if((isset($aba)) && ($aba == "defeito")) {echo "active";} if (!isset($aba)) {echo "active";} ?>" role="presentation">                        
                        <a href="<?php echo base_url('manutencao/defeito'); ?>">
                            Com defeito
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "manutencao")) {echo "active";} ?>" role="presentation">
                        <a href="<?php echo base_url('manutencao/manutencao'); ?>">
                            Em manutenção
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "conserto")) {echo "active";} ?>" role="presentation">
                        <a href="<?php echo base_url('manutencao/conserto'); ?>">
                            Consertadas
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "garantia")) {echo "active";} ?>" role="presentation">
                        <a href="<?php echo base_url('manutencao/garantia'); ?>">
                            Em garantia
                        </a>
                    </li>
                </ul>
                <!-- view dos equipamentos -->
                