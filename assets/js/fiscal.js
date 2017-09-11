/* 
 * Funções JS para parte de impressora fiscal
 * Autor: Dener Campos
 */

//CRUD Impressora fiscal
//Edição
function editarFiscal(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"fiscal/editarFiscal",
        //Dados
        data:{
            "idimpressora_fiscal":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idimpressorafiscal);
                $("#iptEdtNome").val(msg.caixa);
                $("#iptEdtModelo").val(msg.modelo);
                $("#iptEdtSerial").val(msg.serial);
                $("#iptEdtDesc").val(msg.descricao);
                $("#selEdtLocal").val(msg.local);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerFiscal(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"fiscal/removerFiscal",
        //Dados
        data:{
            "idimpressora_fiscal":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idimpressorafiscal);
                $("#iptRmvNome").val(msg.caixa);
                $("#iptRmvModelo").val(msg.modelo);
                $("#iptRmvSerial").val(msg.serial);
                $("#iptRmvDesc").val(msg.descricao);
                $("#selRmvLocal").val(msg.local);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

////VALIDAÇÔES
////Mudando default
//$.validator.setDefaults({
//    errorClass: 'help-block', //classe da label erro criada pelo validador
//    highlight: function(element){ //focus na classe form-grupo do bootstrap
//        $(element)
//            .closest('.form-group')
//            .addClass('has-error');
//    },
//    unhighlight: function(element){ //defocus na classe do bootstrap
//        $(element)
//            .closest('.form-group')
//            .removeClass('has-error');
//    }
//});

//Nova impressora fiscal
$('#frmCriFiscal').validate({
    //regras de validações
    rules: {
        iptCriNome: {            
            required: true,
            minlength:3,
            maxlength:50
        },      
        iptCriModelo: {            
            required: true,
            minlength:3,
            maxlength:50
        },
        iptCriSerial: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:baseUrl+"fiscal/verificaSerial"
        }
    },
    //Mensagens da validação
    messages:{
        iptCriNome: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },      
        iptCriModelo: {            
            required: "Necessário modelo.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },
        iptCriSerial: {            
            required: "Necessário serial.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Serial {0} já existe.<br/>Tente outro e apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-cria-fiscal').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-fiscal').show();
    }
});

//Editar impressora fiscal
$('#frmEdtFiscal').validate({
    //regras de validações
    rules: {
        iptEdtNome: {            
            required: true,
            minlength:3,
            maxlength:50
        },      
        iptEdtModelo: {            
            required: true,
            minlength:3,
            maxlength:50
        },
        iptEdtSerial: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"fiscal/verificaSerialAtualiza",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtFiscal').find('#iptEdtId').val();
                    },
                    serial: function () {
                        return $('#frmEdtFiscal').find('#iptEdtSerial').val();
                    }
                }
            }
        }
    },
    //Mensagens da validação
    messages:{
        iptEdtNome: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },      
        iptEdtModelo: {            
            required: "Necessário modelo.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },
        iptEdtSerial: {            
            required: "Necessário serial.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Serial {0} já existe.<br/>Tente outro e apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit();
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-editar-fiscal').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-fiscal').show();
    }
});