/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    
    //função para mostrar o calendario do jquery no navegador firefox.
    $(function(){
        if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
            $('input[type=date]').datepicker({
                  dateFormat : 'yy-mm-dd'
                }
             );
        }
    });
    
    //popover bootstrap
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        html: 'true',
        placement: 'left',
        container: 'map'
    });
    
    //tooltip bootstrap
    $('[data-toggle="tooltip"]').tooltip();
       
    //Login
    $('.trigger').popover({
        html: true,
        title: function(){
            return $(this).parent().find('.head').html();
        },
        content: function(){
            return $(this).parent().find('.content').html();
        },
        placement: 'bottom',
        container: 'body'
    });
       
    //Verificar estado maquina onload
    //$('span[onload]').trigger('onload');
          
    //Fotos usuario perfil
    $('#iptEdtFoto').on("change", function(){
        fotoPerfil(this);
    });
        
    //Formularios
    $(".formulario").submit(function(){
        formulario = this;
        botao = $(formulario).find(".carregando");
        carregando(botao);
    });  
});

//Esconder tela login
function esconderLogin(){
    $('.trigger').popover('hide');
}

//Animação de carregando (botões)
function carregando(button){
    $html = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
    $valor = $(button).html();
    $(button).html($valor+"  "+$html);
    $(button).attr("disabled", "disabled");
}

//Fotos Perfil
function fotoPerfil(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(".foto-usuario").attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
    else {
        var img = input.value;
        $(".foto-usuario").attr('src', baseUrl+'document/user/0.png');        
    }
} 
