<!-- Inicio -->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema PIC</title>

        <!-- METAS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="">
        <meta name="description" content="">        

        <!-- ESTILOS --> 
        <link rel="shortcut icon" href="<?php echo $assetsUrl; ?>/img/favicon.ico" />
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/libs/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/libs/css/jquery-ui.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/libs/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/libs/lv/css/lightview/lightview.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/sistemapic.css" />
        
        <!-- Variavel global da url do projeto-->  
        <script type="text/javascript">            
            var baseUrl = "<?php echo base_url(); ?>" ; 
            //Se navegador IE, não compativel
            if (isIE()) {
                // is IE
                window.location.href = baseUrl+"home/invalido";
            }   

            //Verifica se navegador é o IE, se sim, retorna a versão
            function isIE () {
                var myNav = navigator.userAgent.toLowerCase();
                return (myNav.indexOf('msie') !== -1) ? parseInt(myNav.split('msie')[1]) : false;
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">