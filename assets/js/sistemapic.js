/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Project: Dener Junio Campos
 * Sistema PIC
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
    
//    //popover bootstrap mapa
//    $('[data-toggle="popover"]').popover({
//        trigger: 'hover',
//        html: 'true',
//        placement: 'left',
//        container: 'map'
//    });
        
    //tooltip bootstrap
    $('[data-toggle="tooltip"]').tooltip();
    
     //Fotos usuario perfil
    $('#iptEdtFoto').on("change", function(){
        fotoPerfil(this);
    });
    
    //Notificações
    notificacao();
    //Chama a função que atualiza o chamados em aberto em 5 minutos (300000) 2 minutos (120000)
    var atualizaNotificacao = setInterval(notificacao, 60000);
    
    //Clique na notificação (notificação lida)
    $(document).on("click", "#notificacao-link", function(){
        //console.log("cliquei");
        //remove o numero de notificações
        $("#notif-qtd").html("");
        $("#notificacao-link").removeClass("notificacao-link-novo");
        $("#notificacao-link").addClass("notificacao-link");
        //exibir notificações        
        notificacaoExibir();          
    });
    
    //Hover na notificação (notificação lida)
    $(document).on("mouseleave", ".notificacao-novo", function(){
        console.log("hover");
        //remove as classes de layout
        $(this).removeClass('notificacao-novo');
        //marca como lida todas as mensagem
        notificacaoLida();        
    });
    
    
         
    //Login
//    $('.trigger').popover({
//        trigger: 'click',
//        html: true,
//        title: function(){
//            return $(this).parent().find('.head').html();
//        },
//        content: function(){
//            return $(this).parent().find('.content').html();
//        },
//        placement: 'bottom',
//        container: 'body'
//    });
       
    //Verificar estado maquina onload
    //$('span[onload]').trigger('onload');
          
   
        
    //Formularios -- chamado na validação --esta sendo chamado na validação
//    $(".formulario").submit(function(){
//        formulario = this;
//        botao = $(formulario).find(".carregando");
//        carregando(botao);
//    }); 
});

////Esconder tela login
//function esconderLogin(){
//    $('.trigger').popover('hide');
//}

//Animação de carregando (botões) esta sendo chamado na validação
function carregando(button){
    $html = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
    //$valor = $(button).html();
    //$(button).html($valor+"  "+$html);
    $(button).html("Aguarde... "+$html);
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

//VALIDAÇÔES
//Mudando default
$.validator.setDefaults({
    ignore : [], //não ignorar os campos hiden
    errorClass: 'help-block', //classe da label erro criada pelo validador
    highlight: function(element){ //focus na classe form-grupo do bootstrap
        $(element)
            .closest('.form-group')
            .addClass('has-error');
    },
    unhighlight: function(element){ //defocus na classe do bootstrap
        $(element)
            .closest('.form-group')
            .removeClass('has-error');
    }
});

//estilo de feedback (bootstrap) - teste
//    validClass: 'has-success',
//    errorClass: 'help-block', //classe da label erro criada pelo validador
//    highlight: function(element){ //focus na classe form-grupo do bootstrap
//        $(element)
//            .closest('.form-group')
//            .addClass('has-error has-feedback')
//            .find('span')
//            .remove();
//        $(element)
//            .closest('.form-group')
//            .append('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
//    },
//    unhighlight: function(element){ //defocus na classe do bootstrap
//        $(element)
//            .closest('.form-group')
//            .removeClass('has-error has-feedback')
//            .addClass('has-success has-feedback')
//            .find('span')
//            .remove();
//        $(element)
//            .closest('.form-group')
//            .append('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
//    },

//NOTIFICAÇOES DO SISTEMAPIC
//notificação
function notificacao(){    
    //buscar quantidade de notificação o usuario tem e atualizar o numero    
    //Busca quantidade
    buscaQuantidadeNotif();    
}

//busca quantidade de notificações de cada usuario
function buscaQuantidadeNotif(){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"notificacao/notifQtdChamado",
        //Dados
        //data:{
        //    "idpinpad":$(ancor).attr("data-id")
        //},
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                if (msg.quantidade === 0){
                    $("#notificacao-link").removeClass('notificacao-link-novo');
                    $("#notificacao-link").addClass('notificacao-link');
                    $("#notif-qtd").html();
                }else{
                    $("#notificacao-link").removeClass('notificacao-link');
                    $("#notificacao-link").addClass('notificacao-link-novo');
                    $("#notif-qtd").html(msg.quantidade);
                    
                }                
            }
            else{
                $("#notif-qtd").html(msg.erro);
            }
        }
    });
}

//Notificação lida (Marca as notificações como lida)
function notificacaoLida(){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"notificacao/notifLida",
        //Dados
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                notificacao();               
            }
            else{
                $("#notif-qtd").html(msg.erro);
            }
        }
    });
}

//Exibir as notificação
function notificacaoExibir(){
    //exibir carregamento
    $(".carregamento-notificacao").show();    
    //limpa notificações anteriores
    $("#notificacao").empty();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"notificacao/buscaNotificacao",
        //Dados
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                //desabilita carregamento
                $(".carregamento-notificacao").hide();
                //verifica se tem novas notificações
                if (msg.novos !== null && msg.novos !== undefined){
                    $html = '<li class="notificacao-indicador"><div>Novas</div></li><li class="divider divider-notificacao"></li>';
                    $("#notificacao").append($html);
                    for(var i = 0, len = msg.novos.length; i < len; ++i){
                        data = formataData(msg.novos[i].data_envio);
                        $html = '<li class="notificacao notificacao-novo">'+
                                '<div><div class="titulo-notificacao">'+
                                '<strong>'+msg.novos[i].titulo+'</strong></div>'+
                                '<div class="texto-notificacao">'+
                                msg.novos[i].mensagem+
                                '</div><div class="rodape-notificacao"> Data: '+
                                data+
                                '</div></div></li><li class="divider divider-notificacao"></li>';
                        $("#notificacao").append($html);
                    }                    
                }
                //verifica e exibe notificações já lidas
                if (msg.anteriores !== null && msg.anteriores !== undefined){
                    $html = '<li class="notificacao-indicador"><div>Anteriores</div></li><li class="divider divider-notificacao"></li>';
                    $("#notificacao").append($html);
                    for(var i = 0, len = msg.anteriores.length; i < len; ++i){
                        data = formataData(msg.anteriores[i].data_envio);
                        $html = '<li class="notificacao">'+
                                '<div><div class="titulo-notificacao">'+
                                '<strong>'+msg.anteriores[i].titulo+'</strong></div>'+
                                '<div class="texto-notificacao">'+
                                msg.anteriores[i].mensagem+
                               '</div><div class="rodape-notificacao"> Data: '+
                                data+
                                '</div></div></li><li class="divider divider-notificacao"></li>';
                        $("#notificacao").append($html);
                    }
                }
            }
            else{
                
            }
        }
    });
}

//Fortmata data para notificações
function formataData(data){
//    var dt = new Date(data);
//    //console.log(dt);
//    var dia = dt.getUTCDate();
//    var mes = dt.getUTCMonth();
//    var ano = dt.getFullYear();
//    var hora = dt.getUTCHours();
//    var minuto = dt.getUTCMinutes();    
//    //data formatada
//    var formatada = dia+'/'+mes+'/'+ano+' as '+hora+':'+minuto;

    var dte = data.split(" ");
    var dt = dte[0].split("-");
    var hr = dte[1].split(":");
    
    var formatada = dt[2]+"/"+dt[1]+"/"+dt[0]+" às "+hr[0]+":"+hr[1];
    return formatada;
}

