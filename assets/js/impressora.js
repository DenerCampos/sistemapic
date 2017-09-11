/* 
 * Funções JS para parte de impressora
 * Autor: Dener Campos
 */

//CRUD IMPRESSORA
//Edição
function editarImpressora(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"impressora/editarImpressora",
        //Dados
        data:{
            "idimpressora":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idimpressora);
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
function removerImpressora(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"impressora/removerImpressora",
        //Dados
        data:{
            "idimpressora":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idimpressora);
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
//Novo impressora
$('#frmCriImpressora').validate({
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
            remote:baseUrl+"impressora/verificaSerial"
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
        $('#erro-cria-impressora').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-impressora').show();
    }
});

//Editar impressora
$('#frmEdtImpressora').validate({
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
                url: baseUrl+"impressora/verificaSerialAtualiza",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtImpressora').find('#iptEdtId').val();
                    },
                    serial: function () {
                        return $('#frmEdtImpressora').find('#iptEdtSerial').val();
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
        $('#erro-editar-impressora').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-impressora').show();
    }
});