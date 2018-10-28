/* 
 * Funções JS para parte de checklist
 * Autor: Dener Campos
 */

$(document).ready(function() {      
    
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


//CHECKLIST
//Enviar e-mail
function emailChecklist(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"checklist/enviarEmailChecklist",
        //Dados
        data:{
            "id":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEmlId").val(msg.idchecklist);
                $("#iptEmlNumero").val(msg.idchecklist);
                $("#iptEmlData").val(msg.data);
                $("#iptEmlUsuario").val(msg.usuario);
                $("#iptEmlPara").val(msg.para);
                $("#iptEmlCopia").val(msg.copia);
                $("#iptEmlAssunto").val(msg.assunto);
                $("#iptEmlCorpo").val(msg.corpo);
            }
            else{
                $("erro-email-checklist").val(msg.erro);
                $("erro-email-checklist").show();                
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
            alert(thrownError);
      }
    });
}

//Validação novo
//Novo checklist
$('#frmCriChecklist').validate({
    //regras de validações
    rules: {
    },
    //Mensagens da validação
    messages:{
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-nova-checklist').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-nova-checklist').show();
    }
});

//Validação envio de email
$('#frmEmailChecklist').validate({
    //regras de validações
    rules: {
        iptEmlId: {            
            required: true
        },      
        iptEmlPara: {            
            required: true,
            email: true
        },      
        iptEmlAssunto: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptEmlId: {            
            required: "Erro interno, informar o TI."
        },      
        iptEmlPara: {            
            required: "Necessário e-mail.",
            email: "Necessário e-mail valido."
        },      
        iptEmlAssunto: {            
            required: "Necessário assunto do e-mail."
        }
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-email-checklist').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-email-checklist').show();
    }
});
