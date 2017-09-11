/* 
 * Funções JS para parte de pinpad
 * Autor: Dener Campos
 */

//CRUD POS
//Edição
function editarPos(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"pos/editarPos",
        //Dados
        data:{
            "idpos":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idpos);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtModelo").val(msg.modelo);
                $("#iptEdtSerial").val(msg.serial);
                $("#iptEdtDesc").val(msg.descricao);
                $("#selEdtLocal").val(msg.local);
                
                if(msg.manutencao === "1"){
                    $("#iptEdtManutencao").prop('checked',true);
                } else {
                    $("#iptEdtManutencao").prop('checked',false);
                }
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerPos(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"pos/removerPos",
        //Dados
        data:{
            "idpos":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idpos);
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
//Novo pos
$('#frmCriPos').validate({
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
            remote:baseUrl+"pos/verificaSerial"
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
        $('#erro-cria-pos').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-pos').show();
    }
});

//Editar pos
$('#frmEdtPos').validate({
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
                url: baseUrl+"pos/verificaSerialAtualiza",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtPos').find('#iptEdtId').val();
                    },
                    serial: function () {
                        return $('#frmEdtPos').find('#iptEdtSerial').val();
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
        $('#erro-editar-pos').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-pos').show();
    }
});