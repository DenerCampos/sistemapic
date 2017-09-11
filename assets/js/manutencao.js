/* 
 * Funções JS para parte de manutenção
 * Autor: Dener Campos
 */

//FUNÇÔES DA MANUTENÇÂO (IMPRESSORAS)
//Enviar para manutenção
function enviarManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/enviarParaManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEnvId").val(msg.idmanutencao);
                $("#iptEnvEquipamento").val(msg.equipamento);
                $("#iptEnvDataEnvio").val(msg.data);
                $("#iptEnvFornecedor").val(msg.fornecedor);
            }
            else{
            }
        }
    });
}

//Editar manutenção
function editarManutencao(ancor){
    //ocultar alerta e ativar botão
    $(".alerta-editar-manutencao").hide();
    $(".carregando").removeAttr("disabled", "true");
    $(".formulario").fadeIn();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/editarManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idmanutencao);
                $("#iptEdtEquipamento").val(msg.equipamento);
                $("#iptEdtDefeito").val(msg.defeito);
                $("#iptEdtFornecedor").val(msg.fornecedor);
                $("#iptEdtDataDefeito").val(msg.data);
                $("#iptEdtDescricao").val(msg.descricao);
                $("#iptEdtPatrimonio").val(msg.patrimonio);
                $("#selEdtUnidade").val(msg.unidade);
                $("#selEdtSetor").val(msg.setor);
            }
            else{
                $(".alerta-editar-manutencao").html("<strong>Não existe o equipamento pesquisado, Tentar novamente!</strong>");
                $(".alerta-editar-manutencao").fadeIn("slow");
                $(".carregando").attr("disabled", "true");
                $(".formulario").hide();
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
        url:baseUrl+"manutencao/editarManutencao",
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

//Remover manutenção
function removerManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/enviarParaManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idmanutencao);
                $("#iptRmvEquipamento").val(msg.equipamento);
                $("#iptRmvDataDefeito").val(msg.data);
            }
            else{
            }
        }
    });
}

//Retornar da manutenção
function retornoManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/retornarParaManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRtnId").val(msg.idmanutencao);
                $("#iptRtnEquipamento").val(msg.equipamento);
                $("#iptRtnDataDefeito").val(msg.data);
                $("#iptRtnDataEnvio").val(msg.dataenvio);
            }
            else{
            }
        }
    });
}

//Não obteve conserto.
function semconsertoManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/semConsManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptScmId").val(msg.idmanutencao);
                $("#iptScmEquipamento").val(msg.equipamento);
                $("#iptScmDataDefeito").val(msg.data);
            }
            else{
            }
        }
    });
}

//Apresentou defeito na garantia
function defeitoManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/apresentouDefeitoManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptDftId").val(msg.idmanutencao);
                $("#iptDftEquipamento").val(msg.equipamento);
                $("#iptDftDefeito").val(msg.defeito);
                $("#iptDftDescricao").val("Defeito anterior: "+msg.defeito+"\n"+msg.descricao);
                $("#iptDftPatrimonio").val(msg.patrimonio);
                $("#selDftUnidade").val(msg.unidade);
                $("#selDftSetor").val(msg.setor);
            }
            else{
            }
        }
    });
}

//VALIDAÇÔES
//Nova manutenção
$('#frmCriManutencao').validate({    
    //regras de validações
    rules: {
        iptCriEquipamento: {            
            required: true,
            minlength:3,
            maxlength:100
        },      
        iptCriDataDefeito: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptCriEquipamento: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 100 caracteres."
        },      
        iptCriDataDefeito: {            
            required: "Informe uma data valida."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-nova-manutencao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-nova-manutencao').show();
    }
});

//Enviar manutenção
$('#frmEnvManutencao').validate({    
    //regras de validações
    rules: {
        iptEnvDataEnvio: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptEnvDataEnvio: {            
            required: "Informe uma data valida."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-enviar-manutencao').html("Por favor, preencha \n\
                                  corretamente a <strong>data</strong>.");
        $('#erro-enviar-manutencao').show();
    }
});

//Nova manutenção
$('#frmEdtManutencao').validate({    
    //regras de validações
    rules: {
        iptEdtEquipamento: {            
            required: true,
            minlength:3,
            maxlength:100
        }
    },
    //Mensagens da validação
    messages:{
        iptEdtEquipamento: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 100 caracteres."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-editar-manutencao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-manutencao').show();
    }
});

//Sem conserto manutenção
$('#frmScmManutencao').validate({    
    //regras de validações
    rules: {
        iptScmMotivo: {            
            required: true,
            minlength:3,
            maxlength:200
        }
    },
    //Mensagens da validação
    messages:{
        iptScmMotivo: {            
            required: "Necessário um motivo.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 200 caracteres."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-sem-conserto-manutencao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-sem-conserto-manutencao').show();
    }
});

//Apresentou defeito manutenção
$('#frmDftManutencao').validate({    
    //regras de validações
    rules: {
        iptDftEquipamento: {            
            required: true,
            minlength:3,
            maxlength:100
        },      
        iptDftDataDefeito: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptDftEquipamento: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 100 caracteres."
        },      
        iptDftDataDefeito: {            
            required: "Informe uma data valida."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-defeito-manutencao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-defeito-manutencao').show();
    }
});