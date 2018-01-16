/* 
 * Funções JS para parte de maquina
 * Autor: Dener Campos
 */

//Ativa quando a modal for aberta
$('#mdlCriarMaquina').on('show.bs.modal', function (e) {
    //localiza qual é a unidade
    
    novoIp();
});

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
                $("#selEdtUnidade").val(msg.unidade);
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

//Liberar
function livreMaquinaIp(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"maquina/liberarMaquina",
        //Dados
        data:{
            "idmaquina":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptLvrId").val(msg.idmaquina);
                $("#iptLvrNome").val(msg.nome);
                $("#iptLvrIp").val(msg.ip);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Pegar novo ip
function novoIp(){
    $("#btnCriar").removeClass("disabled");
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"maquina/novoIp",        
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptCriIp").val(msg.ip);
            }
            else{
                $("#erro-criar-maquina").html(msg.erro).show();
                $("#btnCriar").addClass("disabled");
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
        },
        iptCriIp:{
            required: true,
            remote: baseUrl+"maquina/verificaIP"
        }
    },
    //Mensagens da validação
    messages:{
        iptCriNome: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Nome {0} já existe.<br/>Tente outro ou apague o antigo.")
        },
        iptCriIp:{
            required: "Necessário IP.",
            remote: $.validator.format("IP {0} não esta livre.<br/>Tente outro ou libere o antigo.")
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

//Liberar maquina
$('#frmLvrMaquina').validate({    
    //regras de validações
    rules: {
        iptLvrId: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptLvrId: {            
            required: "Necessário ID."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-livre-maquina').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-livre-maquina').show();
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