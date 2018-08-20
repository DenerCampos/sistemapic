/* 
 * Funções JS para parte de contato
 * Autor: Dener Campos
 */

//Anexo - Apresentar nome do programa escolhido.
$("#iptCriAnexo").change(function () {
   var nome = "Não há arquivo selecionado.";
   if($("#iptCriAnexo")[0].files.length > 0) nome = $("#iptCriAnexo")[0].files[0].name;
   $("#nomeAnexo").html(nome);
});

//Anexo - Apresentar nome do programa escolhido.
$("#iptEdtAnexo").change(function () {
   var nome = "Não há arquivo selecionado.";
   if($("#iptEdtAnexo")[0].files.length > 0) nome = $("#iptEdtAnexo")[0].files[0].name;
   $("#nomeEdtAnexo").html(nome);
});

//CRUD Utilitario
//Edição
function editarUtilitario(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"utilitario/editarUtilitario",
        //Dados
        data:{
            "idutilitario":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idcontato);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtDescricao").val(msg.descricao);
                $("#iptEdtLink").val(msg.link);               
            }
            else{
                $("#erro-editar-utilitario").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerUtilitario(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"utilitario/removerUtilitario",
        //Dados
        data:{
            "idutilitario":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idcontato);
                $("#iptRmvNome").val(msg.nome);
                $("#iptRmvDescricao").val(msg.descricao);           
            }
            else{
                $(".alert-danger").val(msg.erro).show;
            }
        }
    });
}

//VALIDAÇÔES
//Novo utilitario
$('#frmCriUtilitario').validate({
    //regras de validações
    rules: {
        iptCriNome: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"utilitario/verificaExisteUtilitario",
                type: 'POST',
                data: {
                    nome: function (){
                        return $('#frmCriUtilitario').find('#iptCriNome').val();
                    }
                }
            }
        }
    },
    //Mensagens da validação
    messages:{
        iptCriNome: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("Nome {0} já existe.<br/>Tente outro ou editar/apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit();    
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-cria-utilitario').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-utilitario').show();
    }
});

//Editar contato
$('#frmEdtUtilitario').validate({
    //regras de validações
    rules: {
        iptEdtNome: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"utilitario/verificaExisteContatoAtualiza",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtUtilitario').find('#iptEdtId').val();
                    },
                    nome: function (){
                        return $('#frmEdtUtilitario').find('#iptEdtNome').val();
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
            remote: $.validator.format("Nome {0} já existe.<br/>Tente outro ou editar/apague o antigo.")
        }
    },    
    submitHandler: function (form) {     
        form.submit();
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-editar-utilitario').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-utilitario').show();
    }
});