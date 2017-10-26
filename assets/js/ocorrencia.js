/* 
 * Funções JS para parte de ocorrencia
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
    //Anexar help desk
    // Criar chamado
    $('#cria-anexo0').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    $('#cria-anexo1').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    $('#cria-anexo2').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    
    // editar chamado
    $('#edita-anexo0').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    $('#edita-anexo1').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    $('#edita-anexo2').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    
    // fechar chamado
    $('#fecha-anexo0').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    $('#fecha-anexo1').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    $('#fecha-anexo2').change(function(){
        $elemento = $(this).parent().parent();
        anexarImagem(this, $elemento);
    });
    
    //Chama a função que atualiza o chamados em aberto em 5 minutos (300000)
    var atualiza = setInterval(atualizaChamadoAberto, 300000);
    
});

//Atualiza pagina de chamados em aberto de 5 em 5 minutos se nenhuma modal estiver aberta.
function atualizaChamadoAberto(){    
    //verifica se esta na pagina de chamados abertos
    if ($("#chamado-aberto").length){
       if ($(".modal-dialog").is(":visible")){
            //console.log("modal aberta");
        } else{
            //console.log("modal fechada");
            //Atualiza pagina
            location.reload();
        } 
    }else {
        //console.log("não esta em chamados abertos");
    }
}

//Anexar imagem
function anexarImagem(input, elemento){
    //verifica se existe realmente a imagem
    if (input.files && input.files[0]) {
        //Verifica o tipo de arquivo foi feito o upload
        if (input.files[0].type === "text/plain"){
            $(elemento).find('.lightview').attr("href", baseUrl+"/assets/img/default-txt.png");
            $(elemento).find('img').attr('src', baseUrl+"/assets/img/default-txt.png");
            $(elemento).find('.nome-arquivo-anexo').html(input.files[0].name);            
        } else if ((input.files[0].type === "image/gif") || (input.files[0].type === "image/png") || (input.files[0].type === "image/jpeg") || (input.files[0].type === "image/bmp")){
            var reader = new FileReader();
            reader.onload = function (e) {            
                $(elemento).find('.lightview').attr("href", e.target.result);
                $(elemento).find('img').attr('src', e.target.result);
                $(elemento).find('.nome-arquivo-anexo').html(input.files[0].name);
            };
            //lendo arquivo
            reader.readAsDataURL(input.files[0]);
        } else if (input.files[0].type === "application/pdf"){
            var reader = new FileReader();
            reader.onload = function (e) {            
                $(elemento).find('.lightview').attr("href", e.target.result);
                $(elemento).find('img').attr('src', baseUrl+"/assets/img/default-pdf.png");
                $(elemento).find('.nome-arquivo-anexo').html(input.files[0].name);
            };
            //lendo arquivo
            reader.readAsDataURL(input.files[0]);
        } else if (input.files[0].type === "application/x-msdownload"){
            $(elemento).find('.lightview').attr("href", baseUrl+"/assets/img/default-exe.png");
            $(elemento).find('img').attr('src', baseUrl+"/assets/img/default-exe.png");
            $(elemento).find('.nome-arquivo-anexo').html(input.files[0].name);
        } else { //outros
            //application/vnd.openxmlformats-officedocument.spreadsheetml.sheet excel //application/msword word //application/x-msdownload executavel
            $(elemento).find('.lightview').attr("href", baseUrl+"/assets/img/default-xxx.png");
            $(elemento).find('img').attr('src', baseUrl+"/assets/img/default-xxx.png");
            $(elemento).find('.nome-arquivo-anexo').html(input.files[0].name);
        } 
        
    }
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
                        //verifica se é imagem ou arquivo                       
                        if (msg.arquivos[i].imagem === 1){
                            $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i].url+
                                    '" class="lightview"><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+
                                    msg.arquivos[i].url+'"></a><div class="nome-arquivo-anexo-vi">'+
                                    msg.arquivos[i].nome+'</div></div>';
                            $("#imagem-anexo-visualiza").append($html);
                        } else {
                            $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i].url+
                                    '" class="" download><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+
                                    baseUrl+'/assets/img/default-arq.png'+'"></a><div class="nome-arquivo-anexo-vi">'+
                                    msg.arquivos[i].nome+'</div></div>';
                            $("#imagem-anexo-visualiza").append($html);
                        }
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
//                    for (var i = 0, len = msg.arquivos.length; i < len; ++i){                       
//                        $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i]+'" class="lightview"><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+msg.arquivos[i]+'"></a></div>';
//                        $("#imagem-anexo-edita").append($html);
//                        //$(".anexo-grupo").removeClass("hidden");
//                    } 
//                } else {
                    for (var i = 0, len = msg.arquivos.length; i < len; ++i){ 
                        //verifica se é imagem ou arquivo                       
                        if (msg.arquivos[i].imagem === 1){
                            $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i].url+
                                    '" class="lightview"><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+
                                    msg.arquivos[i].url+'"></a><div class="nome-arquivo-anexo-vi">'+
                                    msg.arquivos[i].nome+'</div></div>';
                            $("#imagem-anexo-edita").append($html);
                        } else {
                            $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i].url+
                                    '" class="" download><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+
                                    baseUrl+'/assets/img/default-arq.png'+'"></a><div class="nome-arquivo-anexo-vi">'+
                                    msg.arquivos[i].nome+'</div></div>';
                            $("#imagem-anexo-edita").append($html);
                        }
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
                        //verifica se é imagem ou arquivo                       
                        if (msg.arquivos[i].imagem === 1){
                            $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i].url+
                                    '" class="lightview"><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+
                                    msg.arquivos[i].url+'"></a><div class="nome-arquivo-anexo-vi">'+
                                    msg.arquivos[i].nome+'</div></div>';
                            $("#imagem-anexo-fecha").append($html);
                        } else {
                            $html = '<div class="vizualiza-anexo"><a href="'+msg.arquivos[i].url+
                                    '" class="" download><img class="img-vizualiza-anexo img-thumbnail img-responsive" src="'+
                                    baseUrl+'/assets/img/default-arq.png'+'"></a><div class="nome-arquivo-anexo-vi">'+
                                    msg.arquivos[i].nome+'</div></div>';
                            $("#imagem-anexo-fecha").append($html);
                        }
                    } 
                } else {
                    $("#fecha-anexo-badge").html("");
                }
            }
            else{
            }
        }
    });
    $(".carregando-modal").delay(700).hide("slow");
    $(".corpo-modal").delay(1000).show("slow");
}

//VALIDAÇÔES
//Novo chamado
$('#frmCriChamado').validate({    
    //regras de validações
    rules: {
        iptCriUsuario: {            
            required: true,
            minlength:3,
            maxlength:50
        },      
        iptCriDesc: {            
            required: true,
            minlength:3,
            maxlength:1000
        }
    },
    //Mensagens da validação
    messages:{
        iptCriUsuario: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },      
        iptCriDesc: {            
            required: "Necessário descrição do problema.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 1000 caracteres."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-criar-chamado').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-criar-chamado').show();
    }
});

//Atender chamado
$('#frmAtdChamado').validate({    
    //regras de validações
    rules: {
        iptAtdId: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptAtdId: {            
            required: "Erro no id."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-atender-chamado').html("Erro Geral! \n\ <strong>Informar o TI</strong>.");
        $('#erro-atender-chamado').show();
    }
});

//Imprimir chamado
$('#frmImpChamado').validate({    
    //regras de validações
    rules: {
        iptImpId: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptImpId: {            
            required: "Erro no id."
        }
    },    
    submitHandler: function (form) {     
        form.submit();
    },
    invalidHandler: function (event, validator) {          
        $('#erro-imprimir-chamado').html("Erro Geral! \n\ <strong>Informar o TI</strong>.");
        $('#erro-imprimir-chamado').show();
    }
});

//Remover chamado
$('#frmRmvChamado').validate({    
    //regras de validações
    rules: {
        iptRmvId: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptRmvId: {            
            required: "Erro no id."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-remover-chamado').html("Erro Geral! \n\ <strong>Informar o TI</strong>.");
        $('#erro-remover-chamado').show();
    }
});

//Editar chamado
$('#frmEdtChamado').validate({    
    //regras de validações
    rules: {      
        iptEdtComentarioNovo: {            
            required: true,
            minlength:3,
            maxlength:1000
        }
    },
    //Mensagens da validação
    messages:{      
        iptEdtComentarioNovo: {            
            required: "Necessário um aditamento.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 1000 caracteres."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-editar-chamado').html("Por favor, preencha \n\
                                  corretamente o <strong>campo de comentário</strong>.");
        $('#erro-editar-chamado').show();
    }
});

//Fechar chamado
$('#frmFchChamado').validate({    
    //regras de validações
    rules: {      
        iptFchComentarioNovo: {            
            required: true,
            minlength:3,
            maxlength:1000
        }
    },
    //Mensagens da validação
    messages:{      
        iptFchComentarioNovo: {            
            required: "Necessário uma solução.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 1000 caracteres."
        }
    },    
    submitHandler: function (form) {     
        form.submit();   
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-fechar-chamado')
                .find('p')
                .html("Por favor, preencha corretamente o <strong>campo de solução</strong>.");
        $('#erro-fechar-chamado').show();
    }
});