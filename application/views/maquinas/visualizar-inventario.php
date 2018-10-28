<!-- Modal de visusalizar inventario maquina -->
<div id="mdlVisualizaInventario"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlVisualizaInventario" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Visualização inventário de software</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-visusalizar-inventario" hidden=""></div>
            
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nome-maquina-inventario" id="nomeMaquinaInventario">
                                Nome da maquina
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nome-sistema-inventario" id="nomeSistemaInventario">
                                Nome do sistema
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="lista-programas-inventario" id="listaProgramasInventario">
                                <u>Lista de programas instalados</u>
                            </div>                            
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Versão</th>
                                        </tr>
                                    </thead>
                                    <tbody class="" id="corpoTabelaListaProgramas">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Sair
                    </button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>