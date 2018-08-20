/* 
 * Funções JS para parte de contato
 * Autor: Dener Campos
 */

//CRUD CONTATO
//Edição
function editarContato(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"contato/editarContato",
        //Dados
        data:{
            "idcontato":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idcontato);
                $("#iptEdtEmpresa").val(msg.empresa);
                $("#iptEdtTel").val(msg.tel);
                $("#iptEdtContato").val(msg.contato);
                $("#iptEdtObs").val(msg.obs);                
            }
            else{
                $("#erro-editar-contato").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerContato(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"contato/removerContato",
        //Dados
        data:{
            "idcontato":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idcontato);
                $("#iptRmvEmpresa").val(msg.empresa);
                $("#iptRmvTel").val(msg.tel);             
            }
            else{
                $(".alert-danger").val(msg.erro).show;
            }
        }
    });
}

//VALIDAÇÔES
//Novo contato
$('#frmCriContato').validate({
    //regras de validações
    rules: {
        iptCriEmpresa: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"contato/verificaExisteContato",
                type: 'POST',
                data: {
                    nome: function (){
                        return $('#frmCriContato').find('#iptCriEmpresa').val();
                    }
                }
            }
        },      
        iptCriTel: {            
            required: true,
            minlength:3,
            maxlength:50
        }
    },
    //Mensagens da validação
    messages:{
        iptCriEmpresa: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Empresa {0} já existe.<br/>Tente outro ou editar/apague o antigo.")
        },      
        iptCriTel: {            
            required: "Necessário telefone.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        }
    },    
    submitHandler: function (form) {     
        form.submit();    
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-cria-contato').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-contato').show();
    }
});

//Editar contato
$('#frmEdtContato').validate({
    //regras de validações
    rules: {
        iptEdtEmpresa: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"contato/verificaExisteContatoAtualiza",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtContato').find('#iptEdtId').val();
                    },
                    nome: function (){
                        return $('#frmEdtContato').find('#iptEdtEmpresa').val();
                    }
                }
            }
        },      
        iptEdtTel: {            
            required: true,
            minlength:3,
            maxlength:50
        }
    },
    //Mensagens da validação
    messages:{
        iptEdtEmpresa: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Empresa {0} já existe.<br/>Tente outro ou editar/apague o antigo.")
        },      
        iptEdtTel: {            
            required: "Necessário telefone.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        }
    },    
    submitHandler: function (form) {     
        form.submit();
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-editar-contato').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-contato').show();
    }
});