<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Codigo html  -->
<div class="row">
    <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 menu-admin">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros de usuários" 
                class="<?php if (isset($ativo) && ($ativo == 'usuarios')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/usuario_admin') ?>">Usuários</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros de áreas de atendimento"
                class="<?php if (isset($ativo) && ($ativo == 'areas')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/area_admin') ?>">Áreas</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros de setores do PIC"
                class="<?php if (isset($ativo) && ($ativo == 'setores')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/setor_admin') ?>">Setores</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros de unidades do PIC"
                class="<?php if (isset($ativo) && ($ativo == 'unidades')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/unidade_admin') ?>">Unidades</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros de problemas do help-desk"
                class="<?php if (isset($ativo) && ($ativo == 'problemas')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/problema_admin') ?>">Problemas</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros de estados de um chamado do help-desk"
                class="<?php if (isset($ativo) && ($ativo == 'estado ocorrencia')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/ocorrencia_estado_admin') ?>">Estado Ocorrencia</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastro da configuração do e-mail"
                class="<?php if (isset($ativo) && ($ativo == 'email')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/email_conf_admin') ?>">Email</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros das maquinas" 
                class="<?php if (isset($ativo) && ($ativo == 'maquinas')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/maquina_admin') ?>">Maquinas</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros dos locais das maquinas" 
                class="<?php if (isset($ativo) && ($ativo == 'localmaquinas')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/local_maquina_admin') ?>">Locais de maquinas</a>
            </li>
            <li role="presentation" data-toggle="tooltip" data-placement="top" title="Cadastros dos tipos de maquinas" 
                class="<?php if (isset($ativo) && ($ativo == 'tipomaquinas')){ echo 'active';} ?>">
                <a href="<?php echo base_url('admin/tipo_maquina_admin') ?>">Tipo de maquinas</a>
            </li>
        </ul>
    </div>
<!-- row fecha em outro arquivo -->