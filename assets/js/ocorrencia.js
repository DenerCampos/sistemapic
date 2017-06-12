/* 
 * Funções JS para parte de ocorrencia
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
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