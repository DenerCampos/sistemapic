/* 
 * Funções JS para parte de caixa
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
    //Clique para abrir accordion
    $('area').click(function(){
        var id = $(this).attr('id');
        //alert(id);
        $('.collapse.in').collapse('toggle');
        $("#collapse"+id).collapse('toggle');
    });
    $('[data-toggle="collapse"]').click(function(){
        var id = $(this).attr('id');
        //alert(id);
        $('.collapse.in').collapse('toggle');
        $("#collapse"+id).collapse('toggle');
    });
    
    //accordion com setas
    $('.collapse').on('show.bs.collapse', function (){
        $(this).parent().find('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-up');
    });
    $('.collapse').on('hidden.bs.collapse', function (){
        $(this).parent().find('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
    });
    
    //popover bootstrap mapa
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        html: 'true',
        placement: 'right'
    });
    
    //Voltar ao TOP da pagina
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100){
            $('#back').fadeIn();
        } else {
            $('#back').fadeOut();
        }
    });
    $('#back').click(function(){
        $('body,html').animate({
           scrollTop: 0 
        },800);
        return false;
    });  
});


//CRUD PATRIMONIO
//Validação novo
//Novo patrimonio
$('#frmCriPatrimonio').validate({
    //regras de validações
    rules: {
        iptCriEquipamento: {            
            required: true,
            minlength:3,
            maxlength:80
        },      
        iptCriPatrimonio: {            
            required: true,
            number: true,
            remote:baseUrl+"patrimonio/verificaPatrimonio"
        }
    },
    //Mensagens da validação
    messages:{
        iptCriEquipamento: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 80 caracteres."
        },      
        iptCriPatrimonio: {            
            required: "Necessário número.",
            number: "Apenas números.",
            remote: $.validator.format("Patrimônio {0} já existe.<br/>Tente outro e apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-cria-patrimonio').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-patrimonio').show();
    }
});

//Editar patrimonio
$('#frmEdtPatrimonio').validate({
    //regras de validações
    rules: {
        iptEdtEquipamento: {            
            required: true,
            minlength:3,
            maxlength:80
        },      
        iptEdtPatrimonio: {            
            required: true,
            number: true,
            remote: {
                url:baseUrl+"patrimonio/verificaEditaPatrimonio",
                type: "post",
                data: {
                    id: function(){
                        return $("#iptEdtId").val();
                    },
                    patrimonio: function(){
                        return $("#iptEdtPatrimonio").val();
                    }                        
                }
            }
        }
    },
    //Mensagens da validação
    messages:{
        iptEdtEquipamento: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 80 caracteres."
        },      
        iptEdtPatrimonio: {            
            required: "Necessário número.",
            number: "Apenas números.",
            remote: $.validator.format("Patrimônio {0} já existe.<br/>Tente outro e apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-editar-patrimonio').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-patrimonio').show();
    }
});

//Remover patrimonio
$('#frmRmvPatrimonio').validate({
    //regras de validações
    rules: {
        iptRmvId: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptRmvId: {            
            required: "Tente novamente."
        }
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-remover-patrimonio').html("Por favor, <strong>tente novamente</strong>.");
        $('#erro-remover-patrimonio').show();
    }
});

//CRUD
//Edição
function editarPatrimonio(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"patrimonio/editarPatrimonio",
        //Dados
        data:{
            "idpatrimonio":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idpatrimonio);
                $("#iptEdtEquipamento").val(msg.equipamento);
                $("#iptEdtPatrimonio").val(msg.patrimonio);
                $("#iptEdtSerial").val(msg.serial);
                $("#iptEdtModelo").val(msg.modelo);
                $("#iptEdtDesc").val(msg.descricao);
                $("#iptEdtFornecedor").val(msg.fornecedor);
                $("#selEdtLocal").val(msg.local);
            }
            else{
                alert(msg.erro);
            }
        }
    });
}
    
//Remover
function removerPatrimonio(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"patrimonio/removerPatrimonio",
        //Dados
        data:{
            "idpatrimonio":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idpatrimonio);
                $("#iptRmvEquipamento").val(msg.equipamento);
                $("#iptRmvPatrimonio").val(msg.patrimonio);
            }
            else{
                alert(msg.erro);
            }
        }
    });
}

//Visualizar manutenção
function visualizarManutencao(ancor){
    //Esconde a div motivo (mostra somente na visualização sem conserto)
    $(".div-vsl-motivo").hide();
    //Esconde a div solução (mostra somente na visuzlização de conserto)
    $(".div-vsl-solucao").hide();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"patrimonio/visualizarManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptVslId").val(msg.idmanutencao);
                $("#iptVslEquipamento").val(msg.equipamento);
                $("#iptVslDefeito").val(msg.defeito);
                $("#iptVslDataDefeito").val(msg.data);
                $("#iptVslDescricao").val(msg.descricao);
                $("#iptVslFornecedor").val(msg.fornecedor);
                $("#iptVslPatrimonio").val(msg.patrimonio);
                $("#selVslUnidade").val(msg.unidade);
                $("#selVslSetor").val(msg.setor);
                
                //mostra motivo se for na manutenção sem conserto
                if(msg.motivo){
                    $("#iptVslmotivo").val(msg.motivo);
                    $(".div-vsl-motivo").show();
                }
                
                //mostra motivo se for na manutenção sem conserto
                if(msg.solucao){
                    $("#iptVslSolucao").val(msg.solucao);
                    $(".div-vsl-solucao").show();
                }
            }
            else{
            }
        }
    });
}