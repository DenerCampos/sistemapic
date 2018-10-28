<!--Checklist-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="col-md-6">
        </div>
        
        <!-- Mensagem de erro -->
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="alert alert-danger text-center" id="erro-novo-checklist" hidden="" ></div>
        </div>
    </div>    
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <!-- Formulario novo checklist -->
            <form class="" id="frmCriChecklist" method="post" action="<?php echo base_url("checklist/criar") ?>">
                <div class="row">
                    
                    <!-- menu nav -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach ($lista as $key => $value) { ?>
                        <li class="<?php if ($key == 0) { echo "active"; } ?>">
                            <a href="<?php echo "#".str_replace(" ", "", $value["grupo"]->getNome()); ?>" id="<?php echo str_replace(" ", "", $value["grupo"]->getNome())."-tab"; ?>" data-toggle="tab"> <?php echo $value["grupo"]->getNome(); ?> </a>
                        </li>    
                        <?php } ?>                        
                    </ul> <!-- fim menu nav -->
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-dados-tab">
                            
                            <div class="tab-content">
                                <?php foreach ($lista as $key => $value) { ?>
                                <div class="tab-pane fade <?php if ($key == 0) { echo "active in"; } ?>" id="<?php echo str_replace(" ", "", $value["grupo"]->getNome()); ?>">
                                    
                                    <div class="col-md-12">
                                        <table class="table table-condensed table-hover table-responsive">
                                            <!-- cabeçalho tabela -->
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Verificado</th>
                                                    <th class="text-center"><?php echo $value["grupo"]->getNome(); ?></th>
                                                    <th class="text-center">Observações</th>
                                                </tr>
                                            </thead>
                                            <!-- corpo tabela -->
                                            <tbody>
                                                <?php foreach ($value["equipamento"] as $chave => $valor) { ?>
                                                <tr>
                                                    <td><input type="checkbox" class="chk-center" name="<?php echo "chk".$valor->getIdequipamento_checklist(); ?>" id="<?php echo "chk".$valor->getIdequipamento_checklist(); ?>" value="<?php echo "chk".$valor->getIdequipamento_checklist(); ?>" checked="true"></td>
                                                    <td class="text-center"><?php echo $valor->getNome(); ?></td>
                                                    <td><input type="text" class="form-control input-sm text-center" id="<?php echo "ipt".$valor->getIdequipamento_checklist(); ?>" name="<?php echo "ipt".$valor->getIdequipamento_checklist(); ?>" placeholder="Prováveis defeitos..."></td>
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                <?php } ?>  
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <a class="btn btn-warning" href="<?php echo base_url("checklist"); ?>" role="button">
                            <i class="fa fa-arrow-circle-o-left"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-primary carregando">
                            Salvar check-lsit
                        </button>
                    </div>
                    
                </div>
            </form>
            
        </div>
    </div>
</div>