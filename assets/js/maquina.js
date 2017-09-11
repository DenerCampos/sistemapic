/* 
 * Funções JS para parte de maquina
 * Autor: Dener Campos
 */

//CRUD MAQUINAS IP
//Edição
function editarMaquinaIp(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"maquina/editarMaquina",
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
                $("#iptEdtUser").val(msg.login);
                $("#iptEdtDesc").val(msg.descricao);
                $("#selEdtLocal").val(msg.local);
                $("#selEdtTipo").val(msg.tipo);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerMaquinaIp(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"maquina/removerMaquina",
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
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//VALIDAÇÔES
//Nova maquina
$('#frmCriMaquina').validate({    
    //regras de validações
    rules: {
        iptCriNome: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote: baseUrl+"maquina/verificaNome"
        }
    },
    //Mensagens da validação
    messages:{
        iptCriNome: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Nome {0} já existe.<br/>Tente outro e apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-criar-maquina').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-criar-maquina').show();
    }
});

//Editar maquina
$('#frmEdtMaquina').validate({    
    //regras de validações
    rules: {
        iptEdtNome: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"maquina/verificaNomeEditar",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtMaquina').find('#iptEdtId').val();
                    },
                    nome: function () {
                        return $('#frmEdtMaquina').find('#iptEdtNome').val();
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
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Nome {0} já existe.<br/>Tente outro e apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-editar-maquina').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-maquina').show();
    }
});