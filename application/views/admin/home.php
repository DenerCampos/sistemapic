<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- home admin  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <h1>Área administrativa do Sistema PIC</h1>
        <p>Configurações do sistema.</p>
        <div class="row">
            <div class="novo-chamado col-md-6">
                <a class="btn btn-primary" href="#" role="button"
                   onclick="carregarArquivoMaquina(this)">
                    Atualizar maquinas
                    <i class="fa fa-circle-o-notch hidden"></i>
                </a>
            </div>
            <div class="pesquisar-chamado col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="buscar por logs...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Buscar!</button>
                    </span>
                </div>
            </div>
        </div>
   </div>
</div> <!--fim row-->