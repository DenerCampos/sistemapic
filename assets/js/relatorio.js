/* 
 * Funções JS para parte de plantão
 * Autor: Dener Campos
 */

//Relatórios via ajax (form)
$(document).ready(function() {
    //Esconde os resultados dos relatorios
    $(".relatorio-resultado-processando").hide();
    $(".relatorio-resultado-erro").hide();
    $(".relatorio-resultado").hide();
    
    //Relatorio Geral
    $("#frmRelatorioGeral").submit(function() {
        
       $(".relatorio-resultado-erro").hide();
       $(".relatorio-resultado").hide();
       $(".relatorio-resultado-processando").show();
       
       var dados = $(this).serialize();
       
       $.ajax({
           //tipo de requisição
            type:"post",
            //URL a ser invocada
            url:baseUrl+"relatorio/relatorioGeral",
            //Dados
            data: dados,
            //tipo de formato de dados
            dataType:"json",
            //se tudo ocorrer bem
            success:function(resultado){
                if(!resultado.erro){
                    $("#chamadosAbertos").html(resultado.abertos);
                    $("#chamadosAtendimentos").html(resultado.atendimentos);
                    $("#chamadosFechados").html(resultado.fechados);
                    $("#nomeTecnico").html(resultado.tecnico);
                    $("#totalTecnico").html(resultado.totaltecnico);
                    $("#nomeArea").html(resultado.area);
                    $("#totalArea").html(resultado.totalarea);
                    $("#nomeSetor").html(resultado.setor);
                    $("#totalSetor").html(resultado.totalsetor);
                    $("#nomeProblema").html(resultado.problema);
                    $("#totalProblema").html(resultado.totalproblema);
                    $("#nomeUsuario").html(resultado.usuario);
                    $("#totalUsuario").html(resultado.totalusuario);
                    //torna visivel
                    $(".relatorio-resultado").show();
                    $(".relatorio-resultado-processando").hide();
                    $(".relatorio-resultado-erro").hide();
                }
                else{
                    $("#erro-relatorio").html(resultado.erro);
                    $(".relatorio-resultado-erro").show();
                    $(".relatorio-resultado").hide();
                    $(".relatorio-resultado-processando").hide();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);
                //alert(thrownError);
          }
       });
       //console.log(dados);
       //retorna false para naõ enviar o form
       return false;
    });
    
    //Relatorio por setro
    $("#frmRelatorioSetor").submit(function() {
        
       $(".relatorio-resultado-erro").hide();
       $(".relatorio-resultado").hide();
       $(".relatorio-resultado-processando").show();
       //apaga a tabela caso ela já existe
       $("tbody").empty();
       
       var dados = $(this).serialize();
       
       $.ajax({
           //tipo de requisição
            type:"post",
            //URL a ser invocada
            url:baseUrl+"relatorio/relatorioSetor",
            //Dados
            data: dados,
            //tipo de formato de dados
            dataType:"json",
            //se tudo ocorrer bem
            success:function(resultado){
                if(!resultado.erro){
                    var cont = 0; //verifica se tem algum zerado
                    
                    $.each(resultado,function (index, value){                     
                       
                       if (value.total > 0){ 
                            $("tbody").append('<tr>'+
                                                '<td>'+value.nome+'</td>'+
                                                '<td>'+value.total+'</td>'+
                                             '</tr>'); 
                        } else {
                            cont ++;
                        }                      
                        
                    });
                    
                    if (cont > 0){
                            $("tbody").append('<tr>'+
                                                '<td>Demais setores</td>'+
                                                '<td>0</td>'+
                                             '</tr>'); 
                        }
                    //torna visivel
                    $(".relatorio-resultado").show();
                    $(".relatorio-resultado-processando").hide();
                    $(".relatorio-resultado-erro").hide();
                }
                else{
                    $("#erro-relatorio").html(resultado.erro);
                    $(".relatorio-resultado-erro").show();
                    $(".relatorio-resultado").hide();
                    $(".relatorio-resultado-processando").hide();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);
                //alert(thrownError);
          }
       });
       //console.log(dados);
       //retorna false para naõ enviar o form
       return false;
    });
    
    //Relatorio por usuario
    $("#frmRelatorioUsuario").submit(function() {
        
       $(".relatorio-resultado-erro").hide();
       $(".relatorio-resultado").hide();
       $(".relatorio-resultado-processando").show();
       //apaga a tabela caso ela já existe
       $("tbody").empty();
       
       var dados = $(this).serialize();
       
       $.ajax({
           //tipo de requisição
            type:"post",
            //URL a ser invocada
            url:baseUrl+"relatorio/relatorioUsuario",
            //Dados
            data: dados,
            //tipo de formato de dados
            dataType:"json",
            //se tudo ocorrer bem
            success:function(resultado){
                if(!resultado.erro){
                    var cont = 0; //verifica se tem algum zerado
                    
                    $.each(resultado,function (index, value){                     
                       
                       if (value.total > 0){ 
                            $("tbody").append('<tr>'+
                                                '<td>'+value.nome+'</td>'+
                                                '<td>'+value.total+'</td>'+
                                             '</tr>'); 
                        } else {
                            cont ++;
                        }                      
                        
                    });
                    
                    if (cont > 0){
                            $("tbody").append('<tr>'+
                                                '<td>Demais usuários</td>'+
                                                '<td>0</td>'+
                                             '</tr>'); 
                        }
                    //torna visivel
                    $(".relatorio-resultado").show();
                    $(".relatorio-resultado-processando").hide();
                    $(".relatorio-resultado-erro").hide();
                }
                else{
                    $("#erro-relatorio").html(resultado.erro);
                    $(".relatorio-resultado-erro").show();
                    $(".relatorio-resultado").hide();
                    $(".relatorio-resultado-processando").hide();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);
                //alert(thrownError);
          }
       });
       //console.log(dados);
       //retorna false para naõ enviar o form
       return false;
    });
    
    //Relatorio por tecnico
    $("#frmRelatorioTecnico").submit(function() {
        
       $(".relatorio-resultado-erro").hide();
       $(".relatorio-resultado").hide();
       $(".relatorio-resultado-processando").show();
       //apaga a tabela caso ela já existe
       $("tbody").empty();
       
       var dados = $(this).serialize();
       
       $.ajax({
           //tipo de requisição
            type:"post",
            //URL a ser invocada
            url:baseUrl+"relatorio/relatorioTecnico",
            //Dados
            data: dados,
            //tipo de formato de dados
            dataType:"json",
            //se tudo ocorrer bem
            success:function(resultado){
                if(!resultado.erro){
                    var cont = 0; //verifica se tem algum zerado
                    
                    $.each(resultado,function (index, value){                     
                       
                       if (value.total > 0){ 
                            $("tbody").append('<tr>'+
                                                '<td>'+value.nome+'</td>'+
                                                '<td>'+value.total+'</td>'+
                                             '</tr>'); 
                        } else {
                            cont ++;
                        }                      
                        
                    });
                    
                    if (cont > 0){
                            $("tbody").append('<tr>'+
                                                '<td>Demais técnicos</td>'+
                                                '<td>0</td>'+
                                             '</tr>'); 
                        }
                    //torna visivel
                    $(".relatorio-resultado").show();
                    $(".relatorio-resultado-processando").hide();
                    $(".relatorio-resultado-erro").hide();
                }
                else{
                    $("#erro-relatorio").html(resultado.erro);
                    $(".relatorio-resultado-erro").show();
                    $(".relatorio-resultado").hide();
                    $(".relatorio-resultado-processando").hide();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.responseText);
                //alert(thrownError);
          }
       });
       //console.log(dados);
       //retorna false para naõ enviar o form
       return false;
    });
});   

//VALIDAÇÔES


//$(document).ready(function() {   
//    var ctx = document.getElementById("graficoTotalChamado");
//    var myChart = new Chart(ctx, {
//        type: 'bar',
//        data: {
//            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//            datasets: [{
//                label: '# of Votes',
//                data: [12, 19, 3, 5, 2, 3],
//                backgroundColor: [
//                    'rgba(255, 99, 132, 0.2)',
//                    'rgba(54, 162, 235, 0.2)',
//                    'rgba(255, 206, 86, 0.2)',
//                    'rgba(75, 192, 192, 0.2)',
//                    'rgba(153, 102, 255, 0.2)',
//                    'rgba(255, 159, 64, 0.2)'
//                ],
//                borderColor: [
//                    'rgba(255,99,132,1)',
//                    'rgba(54, 162, 235, 1)',
//                    'rgba(255, 206, 86, 1)',
//                    'rgba(75, 192, 192, 1)',
//                    'rgba(153, 102, 255, 1)',
//                    'rgba(255, 159, 64, 1)'
//                ],
//                borderWidth: 1
//            }]
//        },
//        options: {
//            scales: {
//                yAxes: [{
//                    ticks: {
//                        beginAtZero:true
//                    }
//                }]
//            }
//        }
//    });
//});