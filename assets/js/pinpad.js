/* 
 * Funções JS para parte de pinpad
 * Autor: Dener Campos
 */

//CRUD PINPAD
//Edição
function editarPinpad(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"pinpad/editarPinpad",
        //Dados
        data:{
            "idpinpad":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idpinpad);
                $("#iptEdtNome").val(msg.nome);
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
function removerPinpad(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"pinpad/removerPinpad",
        //Dados
        data:{
            "idpinpad":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idpinpad);
                $("#iptRmvNome").val(msg.nome);
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

//VALIDAÇÔES
//Novo Pinpad
$('#frmCriPinpad').validate({
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
            remote:baseUrl+"pinpad/verificaSerial"
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
        $('#erro-cria-pinpad').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-pinpad').show();
    }
});

//Editar pinpad
$('#frmEdtPinpad').validate({
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
                url: baseUrl+"pinpad/verificaSerialAtualiza",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtPinpad').find('#iptEdtId').val();
                    },
                    serial: function () {
                        return $('#frmEdtPinpad').find('#iptEdtSerial').val();
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
        $('#erro-editar-pinpad').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-pinpad').show();
    }
});