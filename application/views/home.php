<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Codigo html  -->
<div class="home-pic col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="text-center">
        <h1 class="titulo-home"><strong>Sistema PIC</strong></h1>
        <img src="<?php echo $assetsUrl;?>/img/logo-pic.png"
             class="img-home img-thumbnail img-responsive" alt="PIC HOME">
        <?php if ($this->session->has_userdata("id")){ ?>
        <h2 class="rodape-home">Seja bem-vindo <strong><?php echo $this->session->userdata("nome"); ?></strong></h2>
        <?php }?>
    </div>
</div>
<div class="versao">
    <a href="<?php echo base_url('home/versao'); ?>">Versão: 1.8 - Dener Campos.</a>
</div>