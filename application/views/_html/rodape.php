        </div><!-- Fim container-fluid -->
        <!-- Carregamento das modal adicionar item pedido -->

        <!-- Scripts -->
        <script src="<?php echo $assetsUrl; ?>/libs/js/jquery-1.12.4.min.js"></script>
        <script src="<?php echo $assetsUrl; ?>/libs/js/jquery-ui.min.js"></script>
        <script src="<?php echo $assetsUrl; ?>/libs/jqv/jquery.validade.min.js"></script>
        <script src="<?php echo $assetsUrl; ?>/libs/js/bootstrap.min.js"></script>
        <script src="<?php echo $assetsUrl; ?>/libs/jqm/jquery.mask.min.js"></script>
        <script src="<?php echo $assetsUrl; ?>/libs/lv/js/lightview/lightview.js"></script>
        <script src="<?php echo $assetsUrl; ?>/libs/lv/js/spinners/spinners.min.js"></script>
        <!--<script src="<?php echo $assetsUrl; ?>/libs/qtip/jquery.qtip.min.js"></script>-->
        
        <!-- Scripts pessoal -->
        <script src="<?php echo $assetsUrl; ?>/js/sistemapic.js"></script>
        <!-- Scripts controle -->
        <?php if (isset($arquivoJS)) {?>
        <script src="<?php echo $assetsUrl; ?>/js/<?php echo $arquivoJS;?>"></script>
        <?php }?>
    </body>
</html>
<!-- Fim sitema -->