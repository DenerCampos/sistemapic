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

//CRUD Tutorial
//Edição
function editarTutorial(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"tutorial/editarTutorial",
        //Dados
        data:{
            "idtutorial":$(ancor).attr("data-id")
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
                $("#erro-editar-tutorial").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerTutorial(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"tutorial/removerTutorial",
        //Dados
        data:{
            "idtutorial":$(ancor).attr("data-id")
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
//Novo tutorial
$('#frmCriTutorial').validate({
    //regras de validações
    rules: {
        iptCriNome: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"tutorial/verificaExisteTutorial",
                type: 'POST',
                data: {
                    nome: function (){
                        return $('#frmCriTutorial').find('#iptCriNome').val();
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
        $('#erro-cria-tutorial').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-tutorial').show();
    }
});

//Editar contato
$('#frmEdtTutorial').validate({
    //regras de validações
    rules: {
        iptEdtNome: {            
            required: true,
            minlength:3,
            maxlength:50,
            remote:{
                url: baseUrl+"tutorial/verificaExisteContatoAtualiza",
                type: 'POST',
                data: {
                    id: function (){
                        return $('#frmEdtTutorial').find('#iptEdtId').val();
                    },
                    nome: function (){
                        return $('#frmEdtTutorial').find('#iptEdtNome').val();
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
        $('#erro-editar-tutorial').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-tutorial').show();
    }
});