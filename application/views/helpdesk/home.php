<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--Home-->
<div class="menu-chamado col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row"> <!-- row -->
        
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarChamado" 
                    data-toggle="modal" data-target="#mdlCriarChamado" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Novo Chamado
            </button>
        </div>
        
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" id="frmBuscaChamado" method="post"
                  action="<?php echo base_url("ocorrencia/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por número, problema, descrição ou comentários...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary carregando" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
        
    </div><!-- fim row -->
    
    <!-- tab panel -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="<?php if((isset($aba)) && ($aba == "aberto")) {echo "active";} if (!isset($aba)) {echo "active";} ?>" role="presentation">                        
                        <a href="<?php echo base_url('ocorrencia/aberto'); ?>" title="Chamados em aberto">
                            <strong>Em aberto</strong>
                            <span class="badge"><?php echo $contadores[0]; ?></span>
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "atendimento")) {echo "active";} ?>" role="presentation">                        
                        <a href="<?php echo base_url('ocorrencia/atendimento'); ?>" title="Chamados em atendimento">
                            <strong>Em atendimento</strong>
                            <span class="badge"><?php echo $contadores[1]; ?></span>
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "fechado")) {echo "active";} ?>" role="presentation">                        
                        <a href="<?php echo base_url('ocorrencia/fechado'); ?>" title="Chamados fechados">
                            <strong>Fechado</strong>
                            <span class="badge"><?php echo $contadores[2]; ?></span>
                        </a>
                    </li>                    
                </ul>                