/* 
 * Funções JS para parte de home
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
    //Home animação
    animacaoHome();
    
});

//Animação home
function animacaoHome(){
    $(".titulo-home").delay(100).slideDown(300);
    //$(".img-home").delay(450);
    $(".img-home").animate({
        left: 0,
        opacity: 1
    });
    $(".img-home").animate({
        width: 250
    });
    $(".rodape-home").delay(1000).slideDown(1000);
}