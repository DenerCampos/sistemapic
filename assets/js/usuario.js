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
