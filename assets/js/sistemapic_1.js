/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    
    //função para mostrar o calendario do jquery no navegador firefox.
    $(function(){
        if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
            $('input[type=date]').datepicker({
                  dateFormat : 'yy-mm-dd'
                }
             );
        }
    });
    
    //popover bootstrap
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        html: 'true',
        placement: 'left',
        container: 'map'
    });
    
    //tooltip bootstrap
    $('[data-toggle="tooltip"]').tooltip();
       
    //Login
    $('.trigger').popover({
        html: true,
        title: function(){
            return $(this).parent().find('.head').html();
        },
        content: function(){
            return $(this).parent().find('.content').html();
        },
        placement: 'bottom',
        container: 'body'
    });
     
    //Autocomplete Caixas
    $('.buscaMaquina').autocomplete({
        source: function(request, response){
            $.ajax({
                type:"get",
                dataType: "json",
                url: baseUrl+"caixa/buscarMaquina",
                data: {
                    termo: request.term
                },
                success: function(data){
                    response(data);
                }
            });
        }
    });
    
    //Verificar estado maquina onload
    //$('span[onload]').trigger('onload');
    
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
       
    //Fotos usuario perfil
    $('#iptEdtFoto').on("change", function(){
        fotoPerfil(this);
    });
       
    //Anexar help desk
    // Criar chamado
    $('#cria-anexo0').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    $('#cria-anexo1').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    $('#cria-anexo2').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    
    // editar chamado
    $('#edita-anexo0').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    $('#edita-anexo1').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    $('#edita-anexo2').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    
    // fechar chamado
    $('#fecha-anexo0').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    $('#fecha-anexo1').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    $('#fecha-anexo2').change(function(){
        console.log("input teve mudanças");
        $elemento = $(this).parent().prev();
        //$elemento.find('.lightview').removeClass("hidden");
        anexarImagem(this, $elemento);
    });
    
    //Formularios
    $(".formulario").submit(function(){
        formulario = this;
        botao = $(formulario).find(".carregando");
        carregando(botao);
    }); 
    
    //Home animação
    animacaoHome();
    
});

//Anexar imagem
function anexarImagem(input, elemento){
    //verifica se existe realmente a imagem
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {            
            $(elemento).find('.lightview').attr("href", e.target.result);
            $(elemento).find('img').attr('src', e.target.result);
            $(elemento).find('.lightview').removeClass("hidden");
        };
        reader.readAsDataURL(input.files[0]);
    }
    else {
    }
} 

//Animação home
function animacaoHome(){
    $(".titulo-home").delay(100).slideDown(300);
    //$(".img-home").delay(450);
    $(".img-home").animate({
        left: 0,
        opacity: 1
    });
    $(".img-home").animate({
        width: 250
    });
    $(".rodape-home").delay(1000).slideDown(1000);
}

//Esconder tela login
function esconderLogin(){
    $('.trigger').popover('hide');
}

//Animação de carregando (botões)
function carregando(button){
    $html = '<i class="fa fa-spinner fa-pulse fa-fw"></i>';
    $valor = $(button).html();
    $(button).html($valor+"  "+$html);
    $(button).attr("disabled", "disabled");
}

//CRUD MAQUINAS
//Verificar estado
function verificarEstado(ancor){
    $(ancor).children().removeClass('fa-info-circle');
    $(ancor).children().removeClass('fa-check-circle-o');
    $(ancor).children().removeClass('fa-ban');
    $(ancor).children().addClass('fa-refresh fa-spin');
    $.ajax({
        type:"post",
        url:baseUrl+"caixa/verificarEstado",
        data:{
            "idmaquina": $(ancor).attr("data-id")
        },
         success:function(msg){
            if(msg == true){
                $(ancor).children().removeClass('fa-refresh fa-spin');
                $(ancor).children().addClass('fa-check-circle-o');
            }else {
                $(ancor).children().removeClass('fa-refresh fa-spin');
                $(ancor).children().addClass('fa-ban');
            }
        },
        error: function(erro){
            //alert (valueOf(erro));
            console.log(erro);
        }
       
    });
    //console.log($(span).attr("data-id"));
}

//Edição de caixa
function editarCaixa(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"caixa/editarCaixa",
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
                $("#selEdtLocal").val(msg.local);
            }
            else{
                alert(msg.erro);
            }
        }
    });
}
    
//Remover caixa
function removerCaixa(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"caixa/removerCaixa",
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
                $("#selRmvLocal").val(msg.local);
            }
            else{
                alert(msg.erro);
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

//FUNÇÔES DO HELP-DESK (CHAMADOS)
//Atender Chamado
function atenderChamado(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"ocorrencia/atenderChamado",
        //Dados
        data:{
            "idocorrencia":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptAtdId").val(msg.idocorrencia);
                $("#iptAtdNumero").val(msg.idocorrencia);
                $("#iptAtdUsuario").val(msg.nome);
                $("#iptAtdProblema").val(msg.problema);
            }
            else{
            }
        }
    });
}

//Imprimir Chamado
function imprimirChamado(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"ocorrencia/imprimirChamado",
        //Dados
        data:{
            "idocorrencia":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptImpId").val(msg.idocorrencia);
                $("#iptImpNumero").val(msg.idocorrencia);
                $("#iptImpUsuario").val(msg.nome);
                $("#iptImpProblema").val(msg.problema);
            }
            else{
            }
        }
    });
}

//Visualizar Chamado
function visualizarChamado(ancor){
    $(".carregando-modal").show();
    $(".corpo-modal").hide();
    $(".comentario").hide();
    $(".vizualiza-anexo").remove();
    //remove html dos anexos.
    $(".corpo-anexo").remove();
    $("#imagem-anexo-visualiza").remove();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"ocorrencia/visualizarChamado",
        //Dados
        data:{
            "idocorrencia":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptVslId").val(msg.idocorrencia);
                $("#selVslUnidade").val(msg.unidade);
                $("#selVslSetor").val(msg.setor);
                $("#selVslProblema").val(msg.problema);
                $("#selVslArea").val(msg.area);
                $("#iptVslUsuario").val(msg.nome);
                $("#iptVslVnc").val(msg.vnc);
                $("#iptVslRamal").val(msg.ramal);
                $("#iptVslDesc").val(msg.descricao);
                $("#iptVslComentario").text("");
                if (msg.comentarios){
                    $("#visualiza-comentario-badge").html(msg.comentarios.length);
                    for(var i = 0, len = msg.comentarios.length; i < len; ++i){
                        $html = '<p class="texto-comentario">'+msg.comentarios[i]+'</p>';
                        $("#iptVslComentario").append($html);
                    }
                    $(".comentario").show();
                } else {
                    $("#visualiza-comentario-badge").html("");
                }
                if (msg.arquivos){
                    $("#visualiza-anexo-badge").html(msg.arquivos.length);
                    $cabecalho = '<div class="col-md-12 corpo-anexo">'+
                                '<label for="" class="control-label">Anexos:</label></div>'+
                                '<div class="col-md-12" id="imagem-anexo-visualiza"></div>';
                    $("#visualiza-anexo").append($cabecalho);
                    for (var i = 0, len = msg.arquivos.length; i < len; ++i){                       
                        $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i]+'" class="lightview"><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+msg.arquivos[i]+'"></a></div>';
                        $("#imagem-anexo-visualiza").append($html);
                        //$(".anexo-grupo").removeClass("hidden");
                    } 
                } else {
                    $("#visualiza-anexo-badge").html("");
                    //$(".anexo-grupo").addClass("hidden");
                }
            }
            else{
            }
        }
    });
    $(".carregando-modal").delay(700).hide("slow");
    $(".corpo-modal").delay(1000).show("slow");
}

//Remover Chamado
function removerChamado(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"ocorrencia/removerChamado",
        //Dados
        data:{
            "idocorrencia":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idocorrencia);
                $("#iptRmvNumero").val(msg.idocorrencia);
                $("#iptRmvUsuario").val(msg.nome);
                $("#iptRmvProblema").val(msg.problema);
            }
            else{
            }
        }
    });
}

//Encaminhar Chamado
function encaminharChamado(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"ocorrencia/encaminharChamado",
        //Dados
        data:{
            "idocorrencia":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEncId").val(msg.idocorrencia);
                $("#iptEncNumero").val(msg.idocorrencia);
                $("#iptEncUsuario").val(msg.nome);
                $("#iptEncProblema").val(msg.problema);
                $("#selEncTecnico").val(msg.tecnico);
            }
            else{
            }
        }
    });
}

//Editar Chamado
function editarChamado(ancor){
    $(".carregando-modal").show();
    $(".corpo-modal").hide();
    $(".comentario").hide();
    $(".editar-anexo").remove();
    //remove html dos anexos.
    $(".corpo-anexo").remove();
    $("#imagem-anexo-edita").remove();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"ocorrencia/editarChamado",
        //Dados
        data:{
            "idocorrencia":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){            
            if(!msg.erro){
                $("#iptEdtId").val(msg.idocorrencia);
                $("#selEdtUnidade").val(msg.unidade);
                $("#selEdtSetor").val(msg.setor);
                $("#selEdtProblema").val(msg.problema);
                $("#selEdtArea").val(msg.area);
                $("#iptEdtUsuario").val(msg.nome);
                $("#iptEdtVnc").val(msg.vnc);
                $("#iptEdtRamal").val(msg.ramal);
                $("#iptEdtDesc").val(msg.descricao);
                $("#iptEdtComentario").text("");
                
                if (msg.comentarios){
                    $("#edita-comentario-badge").html(msg.comentarios.length);
                    for(var i = 0, len = msg.comentarios.length; i < len; ++i){
                        $html = '<p class="texto-comentario">'+msg.comentarios[i]+'</p>';
                        $("#iptEdtComentario").append($html);
                    }
                    $(".comentario").show();
                } else {
                    $("#edita-comentario-badge").html("");
                }
                if (msg.arquivos){
                    $("#edita-anexo-badge").html(msg.arquivos.length);
                    $cabecalho = '<div class="col-md-12 corpo-anexo">'+
                                '<label for="" class="control-label">Anexos:</label></div>'+
                                '<div class="col-md-12" id="imagem-anexo-edita"></div>';
                    $("#edita-anexo-antigo").append($cabecalho);
                    for (var i = 0, len = msg.arquivos.length; i < len; ++i){                       
                        $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i]+'" class="lightview"><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+msg.arquivos[i]+'"></a></div>';
                        $("#imagem-anexo-edita").append($html);
                        //$(".anexo-grupo").removeClass("hidden");
                    } 
                } else {
                    $("#edita-anexo-badge").html("");
                    //$(".anexo-grupo").addClass("hidden");
                }
            }
            else{
            }
        }
    });
    $(".carregando-modal").delay(700).hide("slow");
    $(".corpo-modal").delay(1000).show("slow");
}

//Fechar Chamado
function fecharChamado(ancor){
    $(".carregando-modal").show();
    $(".corpo-modal").hide();
    $(".comentario").hide();
    //remove html dos anexos.
    $(".corpo-anexo").remove();
    $("#imagem-anexo-fecha").remove();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"ocorrencia/fecharChamado",
        //Dados
        data:{
            "idocorrencia":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){            
            if(!msg.erro){
                $("#iptFchId").val(msg.idocorrencia);
                $("#selFchUnidade").val(msg.unidade);
                $("#selFchSetor").val(msg.setor);
                $("#selFchProblema").val(msg.problema);
                $("#selFchArea").val(msg.area);
                $("#iptFchUsuario").val(msg.nome);
                $("#iptFchVnc").val(msg.vnc);
                $("#iptFchRamal").val(msg.ramal);
                $("#iptFchDesc").val(msg.descricao);
                $("#iptFchComentario").text("");
                if (msg.comentarios){
                    $("#fecha-comentario-badge").html(msg.comentarios.length);
                    for(var i = 0, len = msg.comentarios.length; i < len; ++i){
                        $html = '<p class="texto-comentario">'+msg.comentarios[i]+'</p>';
                        $("#iptFchComentario").append($html);
                    }
                    $(".comentario").show();
                } else {
                    $("#fecha-comentario-badge").html("");
                }
                if (msg.arquivos){
                    $("#fecha-anexo-badge").html(msg.arquivos.length);
                    $cabecalho = '<div class="col-md-12 corpo-anexo">'+
                                '<label for="" class="control-label">Anexos:</label></div>'+
                                '<div class="col-md-12" id="imagem-anexo-fecha"></div>';
                    $("#fecha-anexo-antigo").append($cabecalho);
                    for (var i = 0, len = msg.arquivos.length; i < len; ++i){                       
                        $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i]+'" class="lightview"><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+msg.arquivos[i]+'"></a></div>';
                        $("#imagem-anexo-fecha").append($html);
                        //$(".anexo-grupo").removeClass("hidden");
                    } 
                } else {
                    $("#fecha-anexo-badge").html("");
                    //$(".anexo-grupo").addClass("hidden");
                }
            }
            else{
            }
        }
    });
    $(".carregando-modal").delay(700).hide("slow");
    $(".corpo-modal").delay(1000).show("slow");
}

//FUNÇÔES DA MANUTENÇÂO (IMPRESSORAS)
//Enviar para manutenção
function enviarManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/enviarParaManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEnvId").val(msg.idmanutencao);
                $("#iptEnvEquipamento").val(msg.equipamento);
                $("#iptEnvDataEnvio").val(msg.data);
                $("#iptEnvFornecedor").val(msg.fornecedor);
            }
            else{
            }
        }
    });
}

//Enviar para manutenção
function editarManutencao(ancor){
    //ocultar alerta e ativar botão
    $(".alerta-editar-manutencao").hide();
    $(".carregando").removeAttr("disabled", "true");
    $(".formulario").fadeIn();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/editarManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idmanutencao);
                $("#iptEdtEquipamento").val(msg.equipamento);
                $("#iptEdtDefeito").val(msg.defeito);
                $("#iptEdtFornecedor").val(msg.fornecedor);
                $("#iptEdtDataDefeito").val(msg.data);
                $("#iptEdtDescricao").val(msg.descricao);
                $("#iptEdtPatrimonio").val(msg.patrimonio);
                $("#selEdtUnidade").val(msg.unidade);
                $("#selEdtSetor").val(msg.setor);
            }
            else{
                $(".alerta-editar-manutencao").html("<strong>Não existe o equipamento pesquisado, Tentar novamente!</strong>");
                $(".alerta-editar-manutencao").fadeIn("slow");
                $(".carregando").attr("disabled", "true");
                $(".formulario").hide();
            }
        }
    });
}

//Visualizar manutenção
function visualizarManutencao(ancor){
    //Esconde a div motivo (mostra somente na visualização sem conserto)
    $(".div-vsl-motivo").hide();
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/editarManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptVslId").val(msg.idmanutencao);
                $("#iptVslEquipamento").val(msg.equipamento);
                $("#iptVslDefeito").val(msg.defeito);
                $("#iptVslDataDefeito").val(msg.data);
                $("#iptVslDescricao").val(msg.descricao);
                $("#iptVslFornecedor").val(msg.fornecedor);
                $("#iptVslPatrimonio").val(msg.patrimonio);
                $("#selVslUnidade").val(msg.unidade);
                $("#selVslSetor").val(msg.setor);
                
                //mostra motivo se for na manutenção sem conserto
                if(msg.motivo){
                    $("#iptVslmotivo").val(msg.motivo);
                    $(".div-vsl-motivo").show();
                }
            }
            else{
            }
        }
    });
}

//Enviar para manutenção
function removerManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/enviarParaManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idmanutencao);
                $("#iptRmvEquipamento").val(msg.equipamento);
                $("#iptRmvDataDefeito").val(msg.data);
            }
            else{
            }
        }
    });
}

//Retornar da manutenção
function retornoManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/retornarParaManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRtnId").val(msg.idmanutencao);
                $("#iptRtnEquipamento").val(msg.equipamento);
                $("#iptRtnDataDefeito").val(msg.data);
                $("#iptRtnDataEnvio").val(msg.dataenvio);
            }
            else{
            }
        }
    });
}

//Não obteve conserto.
function semconsertoManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/semConsManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptScmId").val(msg.idmanutencao);
                $("#iptScmEquipamento").val(msg.equipamento);
                $("#iptScmDataDefeito").val(msg.data);
            }
            else{
            }
        }
    });
}

//Apresentou defeito na garantia
function defeitoManutencao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"manutencao/apresentouDefeitoManutencao",
        //Dados
        data:{
            "idmanutencao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptDftId").val(msg.idmanutencao);
                $("#iptDftEquipamento").val(msg.equipamento);
                $("#iptDftDefeito").val(msg.defeito);
                $("#iptDftDescricao").val("Defeito anterior: "+msg.defeito+"\n"+msg.descricao);
                $("#iptDftPatrimonio").val(msg.patrimonio);
                $("#selDftUnidade").val(msg.unidade);
                $("#selDftSetor").val(msg.setor);
            }
            else{
            }
        }
    });
}

//Fotos Perfil
function fotoPerfil(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(".foto-usuario").attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
    else {
        var img = input.value;
        $(".foto-usuario").attr('src', baseUrl+'document/user/0.png');        
    }
} 

//FUNÇÔES DE RELATÓRIO DE PLANTÃO
//Enviar e-mail
function EnviarEmailPlantao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"plantao/enviarEmailPlantao",
        //Dados
        data:{
            "idplantao":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEmlId").val(msg.idrelatorio);
                $("#iptEmlNumero").val(msg.idrelatorio);
                $("#iptEmlData").val(msg.data);
                $("#iptEmlUsuario").val(msg.usuario);
                $("#iptEmlPara").val(msg.para);
                $("#iptEmlCopia").val(msg.copia);
                $("#iptEmlAssunto").val(msg.assunto);
                $("#iptEmlCorpo").val(msg.corpo);
            }
            else{
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
            alert(thrownError);
      }
    });
}
