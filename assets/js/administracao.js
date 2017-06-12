/* 
 * Funções JS para parte de administracao
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
    //Criação de usuario - ao selecionar nivel tecnico, habilita area de atendimento
    $("#selCriNivel").change(function(){
        //console.log($("#selCriNivel").val());
        if ($("#selCriNivel").val() !== "Técnico"){
            $("#selCriArea").prop({disabled: true});
        } else {
            $("#selCriArea").prop({disabled: false})
        }        
    });
    $("#selEdtNivel").change(function(){
        //console.log($("#selCriNivel").val());
        if ($("#selEdtNivel").val() !== "Técnico"){
            $("#selEdtArea").prop({disabled: true});
        } else {
            $("#selEdtArea").prop({disabled: false})
        }        
    });
    
});

//CRUD AREAS
//Edição de area
function editarArea(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/area_admin/editarArea",
        //Dados
        data:{
            "idarea":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idarea);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtEmail").val(msg.email);
                $("#selEdtEstado").val(msg.estado);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover area
function removerArea(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/area_admin/removerArea",
        //Dados
        data:{
            "idarea":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idarea);
                $("#iptRmvNome").val(msg.nome);
                $("#iptRmvEmail").val(msg.email);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//ativar area
function ativarArea(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/area_admin/ativarArea",
        //Dados
        data:{
            "idarea":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idarea);
                $("#iptAtvNome").val(msg.nome);
                $("#iptAtvEmail").val(msg.email);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD SETORES
//Edição de setor
function editarSetor(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/setor_admin/editarSetor",
        //Dados
        data:{
            "idsetor":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idsetor);
                $("#iptEdtNome").val(msg.nome);
                $("#selEdtEstado").val(msg.estado);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover setor
function removerSetor(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/setor_admin/removerSetor",
        //Dados
        data:{
            "idsetor":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idsetor);
                $("#iptRmvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//ativar setor
function ativarSetor(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/setor_admin/ativarSetor",
        //Dados
        data:{
            "idsetor":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idsetor);
                $("#iptAtvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD UNIDADES
//Edição de unidade
function editarUnidade(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/unidade_admin/editarUnidade",
        //Dados
        data:{
            "idunidade":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idunidade);
                $("#iptEdtNome").val(msg.nome);
                $("#selEdtEstado").val(msg.estado);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover unidade
function removerUnidade(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/unidade_admin/removerUnidade",
        //Dados
        data:{
            "idunidade":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idunidade);
                $("#iptRmvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//ativar setor
function ativarUnidade(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/unidade_admin/ativarUnidade",
        //Dados
        data:{
            "idunidade":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idunidade);
                $("#iptAtvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD PROBLEMAS
//Edição de problema
function editarProblema(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/problema_admin/editarProblema",
        //Dados
        data:{
            "idproblema":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idproblema);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtDesc").val(msg.descricao);
                $("#selEdtEstado").val(msg.estado);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover problema
function removerProblema(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/problema_admin/removerProblema",
        //Dados
        data:{
            "idproblema":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idproblema);
                $("#iptRmvNome").val(msg.nome);
                $("#iptRmvDesc").val(msg.descricao);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//ativar setor
function ativarProblema(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/problema_admin/ativarProblema",
        //Dados
        data:{
            "idproblema":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idproblema);
                $("#iptAtvNome").val(msg.nome);
                $("#iptAtvDesc").val(msg.descricao);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD ESTADO OCORRENCIAS
//Edição de problema
function editarEstado(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/ocorrencia_estado_admin/editarEstado",
        //Dados
        data:{
            "idestado":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idestado);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtDesc").val(msg.descricao);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD EMAIL CONF
//Edição de email conf
function editarEmailConf(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/email_conf_admin/editarEmailConf",
        //Dados
        data:{
            "idemailconf":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idemailconf);
                $("#iptEdtUserName").val(msg.username);
                $("#selEdtProtocol").val(msg.protocol);
                $("#iptEdtHost").val(msg.host);
                $("#iptEdtUser").val(msg.user);
                $("#iptEdtPass").val(msg.pass);
                $("#iptEdtPort").val(msg.port);
                $("#selEdtCryp").val(msg.cryp);
                $("#selEdtEstado").val(msg.estado);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover email conf
function removerEmailConf(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/email_conf_admin/removerEmailConf",
        //Dados
        data:{
            "idemailconf":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idemailconf);
                $("#iptRmvUsername").val(msg.username);
                $("#iptRmvHost").val(msg.host);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Ativar email conf
function ativarEmailConf(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/email_conf_admin/ativarEmailConf",
        //Dados
        data:{
            "idemailconf":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idemailconf);
                $("#iptAtvUsername").val(msg.username);
                $("#iptAtvHost").val(msg.host);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD LOCAIS MAQUINAS
//Edição
function editarLocal(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/local_maquina_admin/editarLocal",
        //Dados
        data:{
            "idlocal":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idlocal);
                $("#iptEdtNome").val(msg.nome);
                $("#iptEdtShape").val(msg.shape);
                $("#iptEdtCoords").val(msg.coords);
                if (msg.caixa === "0"){
                    $("#chkEdtCaixa").attr("checked", "0");
                }
                $("#selEdtEstado").val(msg.estado);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerLocal(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/local_maquina_admin/removerLocal",
        //Dados
        data:{
            "idlocal":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idlocal);
                $("#iptRmvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//ativar local
function ativarLocal(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/local_maquina_admin/ativarLocal",
        //Dados
        data:{
            "idlocal":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idlocal);
                $("#iptAtvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD TIPOS MAQUINAS
//Edição
function editarTipo(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/tipo_maquina_admin/editarTipo",
        //Dados
        data:{
            "idtipo":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idtipo);
                $("#iptEdtNome").val(msg.nome);
                $("#selEdtEstado").val(msg.estado);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerTipo(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/tipo_maquina_admin/removerTipo",
        //Dados
        data:{
            "idtipo":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idtipo);
                $("#iptRmvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//ativar local
function ativarTipo(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/tipo_maquina_admin/ativarTipo",
        //Dados
        data:{
            "idtipo":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtvId").val(msg.idtipo);
                $("#iptAtvNome").val(msg.nome);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//CRUD MAQUINAS ADMIN
//Edição
function editarMaquina(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/maquina_admin/editarMaquina",
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
function removerMaquina(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"admin/maquina_admin/removerMaquina",
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

//atualizar maquinas via arquivo via ajax
function carregarArquivoMaquina(ancor){
    $(ancor).children().removeClass("hidden");
    $(ancor).children().addClass("fa-spin");
    $(ancor).addClass("disabled");
    $.ajax({
        type:"post",
        url:baseUrl+"LoadFile/loadFileIPAjax",
        dataType:"json",
        success:function(msg){
            if(!msg.erro){
                alert(msg.msg);
                $(ancor).children().removeClass("fa-spin");
                $(ancor).children().addClass("hidden");
                $(ancor).removeClass("disabled");
            }
            else {
                alert(msg.erro);
                $(ancor).children().removeClass("fa-spin");
                $(ancor).children().addClass("hidden");
                $(ancor).removeClass("disabled");
            }
        }
    });
}

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