<!-- Erro -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1
                 col-sm-6 col-sm-offset-3 
                 col-md-4 col-md-offset-4 
                 col-lg-3 col-lg-offset-4
                 mensagem">
                <div class="text-primary text-center">
                    <h3><img src="<?php echo $assetsUrl."/img/logo-pic.png"; ?>" alt="logo pic" class="logo-mensagem">
                            <strong>Sistema PIC</strong>
                    </h3>
                </div>
                <br/>
                <div>
                    <p class="text-center text-danger">
                        <?php echo $msgerro ?>
                        <br/>
                    </p>
                    <br/>
                    <p class="text-center">
                        <a class="btn btn-primary" href="JavaScript: window.history.back();" role="button">Voltar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>