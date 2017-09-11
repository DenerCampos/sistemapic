/* 
 * Funções JS para parte de usuario
 * Autor: Dener Campos
 */

//CRUD USUARIO
//Edição de usuario
function editarUsuario(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/usuario_admin/editarUsuario",
        //Dados
        data:{
            "idusuario":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idusuario);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtEmail").val(msg.login);
                $("#selEdtNivel").val(msg.nivel);
                $("#selEdtEstado").val(msg.estado);
                $("#selEdtArea").val(msg.area);
                
                //verifica area se tecnico para habilitar
                if (msg.nivel === "Técnico"){
                    $("#selEdtArea").prop({disabled: false});
                } else {
                    $("#selEdtArea").prop({disabled: true});
                }
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover usuario
function removerUsuario(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/usuario_admin/removerUsuario",
        //Dados
        data:{
            "idusuario":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idusuario);
                $("#iptRmvNome").val(msg.nome);
                $("#iptRmvEmail").val(msg.login);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Ativar usuario
function ativarUsuario(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/usuario_admin/ativarUsuario",
        //Dados
        data:{
            "idusuario":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idusuario);
                $("#iptAtvNome").val(msg.nome);
                $("#iptAtvEmail").val(msg.login);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//VALIDAÇÃO
//Criar usuario
$('#frmEdtUsuario').validate({
    //regras de validações
    rules: {
        iptEdtNome: {            
            required: true,
            minlength:3,
            maxlength:50
        },
        iptEdtEmail: {            
            required: true,
            email: true,
            minlength:3,
            maxlength:50,
            remote:baseUrl+"usuario/verificaEmail" 
        },
        iptEdtRSenha: {
            equalTo: "#iptEdtSenha"
        }
    },
    //Mensagens da validação
    messages:{
        iptEdtNome: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },
        iptEdtEmail: {            
            required: "Necessário e-mail.",
            email: "Necessário e-mail valido",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("{0} já existe no sistema. Tente outro email")
        },
        iptEdtRSenha: {
            equalTo: "As senhas devem ser iguais."
        }
    },    
    submitHandler: function (form) {     
        form.submit();    
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {
        $('#erro-editar-usuario').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-editar-usuario').show();
    }
});