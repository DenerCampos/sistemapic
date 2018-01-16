/* 
 * Funções JS para parte de plantão
 * Autor: Dener Campos
 */

//FUNÇÔES DE RELATÓRIO DE PLANTÃO
//Enviar e-mail
function EnviarEmailPlantao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"plantao/enviarEmailPlantao",
        //Dados
        data:{
            "idplantao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEmlId").val(msg.idrelatorio);
                $("#iptEmlNumero").val(msg.idrelatorio);
                $("#iptEmlData").val(msg.data);
                $("#iptEmlUsuario").val(msg.usuario);
                $("#iptEmlPara").val(msg.para);
                $("#iptEmlCopia").val(msg.copia);
                $("#iptEmlAssunto").val(msg.assunto);
                $("#iptEmlCorpo").val(msg.corpo);
            }
            else{
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
            alert(thrownError);
      }
    });
}

//VALIDAÇÔES
//Novo relatório
$('#frmGeraPlantao').validate({    
    //regras de validações
    rules: {
        iptCriDataInicio: {            
            required: true
        },      
        iptCriDataFim: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptCriDataInicio: {            
            required: "Informe uma data valida."
        },      
        iptCriDataFim: {            
            required: "nforme uma data valida."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-gerar-plantao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-gerar-plantao').show();
    }
});

$('#frmEmailPlantao').validate({    
    //regras de validações
    rules: {
        iptEmlPara: {            
            required: true,
            email: true
        },      
        iptEmlCopia: {
            email: true
        }
    },
    //Mensagens da validação
    messages:{
        iptEmlPara: {            
            required: "Informe email valido.",
            email: "Informe email valido."
        },      
        iptEmlCopia: {            
            email: "Informe email valido."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-email-plantao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-email-plantao').show();
    }
});
