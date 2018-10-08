/* 
 * Funções JS para parte de caixa
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
    //popover bootstrap mapa
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        html: 'true',
        placement: 'left',
        container: 'map'
    });
    
    //Autocomplete Caixas
    $('#buscaMaquina').autocomplete({
        source: function(request, response){
            $.ajax({
                type:"get",
                dataType: "json",
                url: baseUrl+"caixa/buscarMaquina",
                data: {
                    termo: request.term
                },
                success: function(data){
                    response(data);
                },
                error: function(erro){
                console.log(erro);
        }
            });
        }
    });
    
    
});


//CRUD MAQUINAS
//Verificar estado
function verificarEstado(ancor){
    $(ancor).children().removeClass('fa-info-circle');
    $(ancor).children().removeClass('fa-check-circle-o');
    $(ancor).children().removeClass('fa-ban');
    $(ancor).children().addClass('fa-refresh fa-spin');
    $.ajax({
        type:"post",
        url:baseUrl+"caixa/verificarEstado",
        data:{
            "idmaquina": $(ancor).attr("data-id")
        },
         success:function(msg){
            if(msg == true){
                $(ancor).children().removeClass('fa-refresh fa-spin');
                $(ancor).children().addClass('fa-check-circle-o');
            }else {
                $(ancor).children().removeClass('fa-refresh fa-spin');
                $(ancor).children().addClass('fa-ban');
            }
        },
        error: function(erro){
            //alert (valueOf(erro));
            console.log(erro);
        }
       
    });
    //console.log($(span).attr("data-id"));
}

//Edição de caixa
function editarCaixa(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"caixa/editarCaixa",
        //Dados
        data:{
            "idmaquina":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idmaquina);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtIp").val(msg.ip);
                $("#selEdtLocal").val(msg.local);
            }
            else{
                alert(msg.erro);
            }
        }
    });
}
    
//Remover caixa
function removerCaixa(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"caixa/removerCaixa",
        //Dados
        data:{
            "idmaquina":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idmaquina);
                $("#iptRmvNome").val(msg.nome);
                $("#iptRmvIp").val(msg.ip);
                $("#selRmvLocal").val(msg.local);
            }
            else{
                alert(msg.erro);
            }
        }
    });
}