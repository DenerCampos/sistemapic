/* 
 * Funções JS para parte de caixa
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
    //Autocomplete nome do aluno em nova avaliação
    $('#iptCriNomeAluno').autocomplete({
        source: function(request, response){
            $.ajax({
                type:"get",
                dataType: "json",
                url: baseUrl+"avaliacao/buscarAluno",
                data: {
                    termo: request.term
                },
                success: function(data){
                    response(data);
                },
                error: function(erro){
                console.log(erro);
                }
            });
        }
    });
    
    //CALCULOS NOVA AVALIAÇÃO
    //calcular o imc 
    $('#iptCriPeso').blur(function() {
        var peso = parseFloat($('#iptCriPeso').val());
        var altura = parseFloat($('#iptCriAltura').val());
        var imc = peso / (Math.pow(altura, 2));
        if (isNaN(imc)){
            $('#iptCriImc').val(0);
        } else {
            $('#iptCriImc').val(imc.toFixed(2));
        }
        
    });
    $('#iptCriAltura').blur(function() {
        var peso = parseFloat($('#iptCriPeso').val());
        var altura = parseFloat($('#iptCriAltura').val());
        var imc = peso / (Math.pow(altura, 2));
        if (isNaN(imc)){
            $('#iptCriImc').val(0);
        } else {
            $('#iptCriImc').val(imc.toFixed(2));
        }
    });
    
    //calcular agua liquida
    $('#iptCriPorAgua').blur(function() {
        var peso = parseFloat($('#iptCriPeso').val());
        var agua = parseFloat($('#iptCriPorAgua').val());
        var agual = ((peso * agua)/100);
        if (isNaN(agual)){
            $('#iptCriAgua').val(0);
        } else {
            $('#iptCriAgua').val(agual.toFixed(2));
        }
    });
    
    //calcular gordura kg
    $('#iptCriGorCor').blur(function() {
        var peso = parseFloat($('#iptCriPeso').val());
        var gordura = parseFloat($('#iptCriGorCor').val());
        var gordurakg = ((peso * gordura)/100);
        if (isNaN(gordurakg)){
            $('#iptCriPesGor').val(0);
        } else {
            $('#iptCriPesGor').val(gordurakg.toFixed(2));
        }
    });
    
    //calcular massa magra kg
    $('#iptCriPesGor').blur(function() {
        var peso = parseFloat($('#iptCriPeso').val());
        var gordura = parseFloat($('#iptCriGorCor').val());
        var massamagra = (peso - gordura);
        if (isNaN(massamagra)){
            $('#iptCriMasMag').val(0);
        } else {
            $('#iptCriMasMag').val(massamagra.toFixed(2));
        }
    });
    
    //calcular massa magra %
    $('#iptCriGorCor').blur(function() {
        var gordura = parseFloat($('#iptCriGorCor').val());
        var massamagra = (100 - gordura);
        if (isNaN(massamagra)){
            $('#iptCriPorMasMag').val(0);
        } else {
            $('#iptCriPorMasMag').val(massamagra.toFixed(2));
        }
    });
    
    //calcular BMP da zona de treinamento
    $('#iptCriFreCarMax').blur(function() {
        var freqcardmax = parseFloat($('#iptCriFreCarMax').val());
        var zt1 = (freqcardmax - parseFloat($('#iptCriPorZT0').val()));
        var zt2 = (freqcardmax - parseFloat($('#iptCriPorZT1').val()));
        var zt3 = (freqcardmax - parseFloat($('#iptCriPorZT2').val()));
        var zt4 = (freqcardmax - parseFloat($('#iptCriPorZT3').val()));
        
        $('#iptCriBpmZT0').val(zt1.toFixed(0));
        $('#iptCriBpmZT1').val(zt2.toFixed(0));
        $('#iptCriBpmZT2').val(zt3.toFixed(0));
        $('#iptCriBpmZT3').val(zt4.toFixed(0));
    });
    
    //CALCULOS EDITAR AVALIAÇÃO
    //calcular o imc 
    $('#iptEdtPeso').blur(function() {
        var peso = parseFloat($('#iptEdtPeso').val());
        var altura = parseFloat($('#iptEdtAltura').val());
        var imc = peso / (Math.pow(altura, 2));
        if (isNaN(imc)){
            $('#iptEdtImc').val(0);
        } else {
            $('#iptEdtImc').val(imc.toFixed(2));
        }
        
    });
    $('#iptEdtAltura').blur(function() {
        var peso = parseFloat($('#iptEdtPeso').val());
        var altura = parseFloat($('#iptEdtAltura').val());
        var imc = peso / (Math.pow(altura, 2));
        if (isNaN(imc)){
            $('#iptEdtImc').val(0);
        } else {
            $('#iptEdtImc').val(imc.toFixed(2));
        }
    });
    
    //calcular agua liquida
    $('#iptEdtPorAgua').blur(function() {
        var peso = parseFloat($('#iptEdtPeso').val());
        var agua = parseFloat($('#iptEdtPorAgua').val());
        var agual = ((peso * agua)/100);
        if (isNaN(agual)){
            $('#iptEdtAgua').val(0);
        } else {
            $('#iptEdtAgua').val(agual.toFixed(2));
        }
    });
    
    //calcular gordura kg
    $('#iptEdtGorCor').blur(function() {
        var peso = parseFloat($('#iptEdtPeso').val());
        var gordura = parseFloat($('#iptEdtGorCor').val());
        var gordurakg = ((peso * gordura)/100);
        if (isNaN(gordurakg)){
            $('#iptEdtPesGor').val(0);
        } else {
            $('#iptEdtPesGor').val(gordurakg.toFixed(2));
        }
    });
    
    //calcular massa magra kg
    $('#iptEdtPesGor').blur(function() {
        var peso = parseFloat($('#iptEdtPeso').val());
        var gordura = parseFloat($('#iptEdtGorCor').val());
        var massamagra = (peso - gordura);
        if (isNaN(massamagra)){
            $('#iptEdtMasMag').val(0);
        } else {
            $('#iptEdtMasMag').val(massamagra.toFixed(2));
        }
    });
    
    //calcular massa magra %
    $('#iptEdtGorCor').blur(function() {
        var gordura = parseFloat($('#iptEdtGorCor').val());
        var massamagra = (100 - gordura);
        if (isNaN(massamagra)){
            $('#iptEdtPorMasMag').val(0);
        } else {
            $('#iptEdtPorMasMag').val(massamagra.toFixed(2));
        }
    });
    
    //calcular BMP da zona de treinamento
    $('#iptEdtFreCarMax').blur(function() {
        var freqcardmax = parseFloat($('#iptEdtFreCarMax').val());
        var zt1 = (freqcardmax - parseFloat($('#iptEdtPorZT0').val()));
        var zt2 = (freqcardmax - parseFloat($('#iptEdtPorZT1').val()));
        var zt3 = (freqcardmax - parseFloat($('#iptEdtPorZT2').val()));
        var zt4 = (freqcardmax - parseFloat($('#iptEdtPorZT3').val()));
        
        $('#iptEdtBpmZT0').val(zt1.toFixed(0));
        $('#iptEdtBpmZT1').val(zt2.toFixed(0));
        $('#iptEdtBpmZT2').val(zt3.toFixed(0));
        $('#iptEdtBpmZT3').val(zt4.toFixed(0));
    });
    
    //Aparece mensagem se aluno é novo ou se ja existe o aluno, caso existe aparece um botão para buscar os dados
    // da ultima avaliação
    $('#iptCriNomeAluno').blur(function () {
        $("#buscar-dados-avaliacao").hide();
        $("#erro-nova-avaliacao").hide();
        $.ajax({
            type:"get",
            dataType: "json",
            url: baseUrl+"avaliacao/verificaNomeAluno",
            data: {
                nome: $('#iptCriNomeAluno').val()
            },
            success: function(msg){
                if(!msg.erro){
                    $("#buscar-dados-avaliacao").find("span").html(msg.nome);
                    $("#buscar-dados-avaliacao").show();
                    
                } else {
                    $("#erro-nova-avaliacao").html(msg.erro).show();
                }
            },
            error: function(erro){
            console.log(erro);
            }
        });   
    });
    
    //accordion com setas
    $('.collapse').on('show.bs.collapse', function (){
        $(this).parent().find('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-up');
    });
    $('.collapse').on('hidden.bs.collapse', function (){
        $(this).parent().find('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down');
    });
    
    //Voltar ao TOP da pagina
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100){
            $('#back').fadeIn();
        } else {
            $('#back').fadeOut();
        }
    });
    $('#back').click(function(){
        $('body,html').animate({
           scrollTop: 0 
        },800);
        return false;
    }); 
    
    //Desabilitar enviar email e gerar pdf para ser permitido apenas se existir imagem no servidor. (EM vizualizar)
    desabilitaOpcoes();
    
    //Graficos (CHART)
    var ctx = $(".bioChart");
    for (i = 0; i < ctx.length; i++){
        var myChart = new Chart(ctx[i], {
            type: 'bar',
            data: {
                labels: ["Massa magra", "Peso da gordura"],
                datasets: [{
                    label: 'Bioimpedância',
                    data: [$(ctx[i]).parent().data("massa"), $(ctx[i]).parent().data("peso")],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                animation : {
                    onComplete : function(){
                        //Salva imagem do grafico no servidor
                        //Pegar id da abar ativa
                        var id = $(".tab-pane.fade.active.in").attr("id");
                        //pegar data da imagem gerada pelo canvas
                        var chart = $('[data-chart="'+id+'"]');
                        var img = chart[0].toDataURL("image/png");
                        salvaGrafico(img, id);
                    }
                }
            }            
        });
    }
});


//Desativa dos botoes de enviar email e gerar pdf para não ser clicados 
function desabilitaOpcoes (){
    //busca id da tab ativa
    var id = $(".tab-pane.fade.active.in").attr("id");
    //busca botões
    var btnemail = $('[id="btnemail'+id+'"]');
    var btnvisualizar = $('[id="btnvisualizar'+id+'"]');
    //desabilita os botoes para serem habilitados na função salvaGrafico
    $(btnemail).attr("disabled", "disabled");
    $(btnvisualizar).attr("disabled", "disabled");
}

//Desativa dos botoes de enviar email e gerar pdf para não ser clicados 
function habilitaOpcoes (){
    //busca id da tab ativa
    var id = $(".tab-pane.fade.active.in").attr("id");
    //busca botões
    var btnemail = $('[id="btnemail'+id+'"]');
    var btnvisualizar = $('[id="btnvisualizar'+id+'"]');
    //desabilita os botoes para serem habilitados na função salvaGrafico
    $(btnemail).removeAttr("disabled");
    $(btnvisualizar).removeAttr("disabled");
}

//Salva imagem do grafico no servidor.
function salvaGrafico(imgdata, id){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"avaliacao/salvaGrafico",
        //Dados
        data:{
            "grafico":imgdata, 
            "id":id
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                //alert(msg.id);
                habilitaOpcoes();
            }
            else{
               alert("Erro ao salvar imagem do grafico. Informe ao TI");
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
            alert(thrownError);
      }
    });
}

//Completar campos do aluno se existir quando apertar o botão
function buscaDadosAluno() {
    $.ajax({
        type:"get",
        dataType: "json",
        url: baseUrl+"avaliacao/buscarDadosAluno",
        data: {
            nome: $('#iptCriNomeAluno').val()
        },
        success: function(msg){
            if(!msg.erro){
                $("#iptCriNomeAluno").val(msg.nome);
                $("#iptCriCota").val(msg.cota);
                $("#iptCriIdade").val(msg.idade);
                $("#iptCriEmailAluno").val(msg.email);
                $("#iptCriSexo").val(msg.sexo);
                $("#iptCriCivil").val(msg.estadocivil);
                $("#iptCriProfissao").val(msg.profissao);
                $("#iptCriPosicao").val(msg.posicaotrabalho);

                $("#iptCriTanagista").val(msg.tabagista);
                $("#iptCriEtilista").val(msg.etilista);
                $("#iptCriAtividade").val(msg.atividadefisica);

                $("#iptCriLeArt").val(msg.lesaoarticular);
                $("#iptCriTraCar").val(msg.cardiologico);
                $("#iptCriColuna").val(msg.coluna);
                $("#iptCriVarizes").val(msg.varizes);
                $("#iptCriCirurgias").val(msg.cirurgias);
                $("#iptCriHernia").val(msg.hernia);
                $("#iptCriPulso").val(msg.pulso);
                $("#iptCriPa").val(msg.pa);
                $("#iptCriMedicamentos").val(msg.medicamentos);
                $("#iptCriHisFam").val(msg.historiafamiliar);
                $("#iptCriOutInf").val(msg.informacoes);

                $("#iptCriPostura").val(msg.postura);
                $("#iptCriColVer").val(msg.colunavertebral);
                $("#iptCriForca").val(msg.forcamuscular);
                $("#iptCriAdm").val(msg.adm);
                $("#iptCriAtFiPro").val(msg.atividadeproposta);
                $("#iptCriObjAtFi").val(msg.objetivoatividade);
                $("#iptCriExConInd").val(msg.exerciciocontraindicado);
                $("#iptCriConduta").val(msg.conduta);

                $("#iptCriPescoco").val(msg.pescoco);
                $("#iptCriOmbros").val(msg.ombros);
                $("#iptCriTorax").val(msg.torax);
                $("#iptCriCintura").val(msg.cintura);
                $("#iptCriAbdomem").val(msg.abdomem);
                $("#iptCriQuadril").val(msg.quadril);
                $("#iptCriCoxaDir").val(msg.coxadireita);
                $("#iptCriCoxaEsq").val(msg.coxaesquerda);
                $("#iptCriPanDir").val(msg.panturilhadireita);
                $("#iptCriPanEsq").val(msg.panturilhaesquerda);
                $("#iptCriBraDir").val(msg.bracodireito);
                $("#iptCriBraEsq").val(msg.bracoesquerdo);
                $("#iptCriAntBraDir").val(msg.antebracodireito);
                $("#iptCriAntBraEsq").val(msg.antebracoesquerdo);

                $("#iptCriPeso").val(msg.peso);
                $("#iptCriAltura").val(msg.altura);
                $("#iptCriImc").val(msg.imc);
                $("#iptCriPorAgua").val(msg.agua);
                $("#iptCriAgua").val(msg.agual);
                $("#iptCriGorCor").val(msg.gorduracorporal);
                $("#iptCriPesGor").val(msg.pesogordura);
                $("#iptCriPorGorAlv").val(msg.gorduraalvo);
                $("#iptCriPorMasMag").val(msg.massamagra);
                $("#iptCriMasMag").val(msg.massamagrakg);
                $("#iptCriIndCorporal").val(msg.indicemuscular);

                $("#iptCriFreCarMax").val(msg.freqcardiacamax);
                $("#iptCriFreRep").val(msg.freqrep);
                $("#iptCriFreRepCarMax").val(msg.freqcardiacatreino);

                $("#iptCriTVel0").val(msg.velocidade0);
                $("#iptCriTTemp0").val(msg.tempo0);
                $("#iptCriFreCard0").val(msg.freqcardiaca0);
                $("#iptCriPse0").val(msg.pse0);
                $("#iptCriMonCor0").val(msg.momentocorrida0);
                $("#iptCriTVel1").val(msg.velocidade1);
                $("#iptCriTTemp1").val(msg.tempo1);
                $("#iptCriFreCard1").val(msg.freqcardiaca1);
                $("#iptCriPse1").val(msg.pse1);
                $("#iptCriMonCor1").val(msg.momentocorrida1);
                $("#iptCriTVel2").val(msg.velocidade2);
                $("#iptCriTTemp2").val(msg.tempo2);
                $("#iptCriFreCard2").val(msg.freqcardiaca2);
                $("#iptCriPse2").val(msg.pse2);
                $("#iptCriMonCor2").val(msg.momentocorrida2);
                $("#iptCriTVel3").val(msg.velocidade3);
                $("#iptCriTTemp3").val(msg.tempo3);
                $("#iptCriFreCard3").val(msg.freqcardiaca3);
                $("#iptCriPse3").val(msg.pse3);
                $("#iptCriMonCor3").val(msg.momentocorrida3);
                $("#iptCriTVel4").val(msg.velocidade4);
                $("#iptCriTTemp4").val(msg.tempo4);
                $("#iptCriFreCard4").val(msg.freqcardiaca4);
                $("#iptCriPse4").val(msg.pse4);
                $("#iptCriMonCor4").val(msg.momentocorrida4);
                $("#iptCriTVel5").val(msg.velocidade5);
                $("#iptCriTTemp5").val(msg.tempo5);
                $("#iptCriFreCard5").val(msg.freqcardiaca5);
                $("#iptCriPse5").val(msg.pse5);
                $("#iptCriMonCor5").val(msg.momentocorrida5);
                $("#iptCriTVel6").val(msg.velocidade6);
                $("#iptCriTTemp6").val(msg.tempo6);
                $("#iptCriFreCard6").val(msg.freqcardiaca6);
                $("#iptCriPse6").val(msg.pse6);
                $("#iptCriMonCor6").val(msg.momentocorrida6);
                $("#iptCriTVel7").val(msg.velocidade7);
                $("#iptCriTTemp7").val(msg.tempo7);
                $("#iptCriFreCard7").val(msg.freqcardiaca7);
                $("#iptCriPse7").val(msg.pse7);
                $("#iptCriMonCor7").val(msg.momentocorrida7);
                $("#iptCriTVel8").val(msg.velocidade8);
                $("#iptCriTTemp8").val(msg.tempo8);
                $("#iptCriFreCard8").val(msg.freqcardiaca8);
                $("#iptCriPse8").val(msg.pse8);
                $("#iptCriMonCor8").val(msg.momentocorrida8);
                $("#iptCriTVel9").val(msg.velocidade9);
                $("#iptCriTTemp9").val(msg.tempo9);
                $("#iptCriFreCard9").val(msg.freqcardiaca9);
                $("#iptCriPse9").val(msg.pse9);
                $("#iptCriMonCor9").val(msg.momentocorrida9);
                $("#iptCriTVel10").val(msg.velocidade10);
                $("#iptCriTTemp10").val(msg.tempo10);
                $("#iptCriFreCard10").val(msg.freqcardiaca10);
                $("#iptCriPse10").val(msg.pse10);
                $("#iptCriMonCor10").val(msg.momentocorrida10);
                $("#iptCriTVel11").val(msg.velocidade11);
                $("#iptCriTTemp11").val(msg.tempo11);
                $("#iptCriFreCard11").val(msg.freqcardiaca11);
                $("#iptCriPse11").val(msg.pse11);
                $("#iptCriMonCor11").val(msg.momentocorrida11);
                $("#iptCriTVel12").val(msg.velocidade12);
                $("#iptCriTTemp12").val(msg.tempo12);
                $("#iptCriFreCard12").val(msg.freqcardiaca12);
                $("#iptCriPse12").val(msg.pse12);
                $("#iptCriMonCor12").val(msg.momentocorrida12);
                $("#iptCriTVel13").val(msg.velocidade13);
                $("#iptCriTTemp13").val(msg.tempo13);
                $("#iptCriFreCard13").val(msg.freqcardiaca13);
                $("#iptCriPse13").val(msg.pse13);
                $("#iptCriMonCor13").val(msg.momentocorrida13);
                $("#iptCriTVel14").val(msg.velocidade14);
                $("#iptCriTTemp14").val(msg.tempo14);
                $("#iptCriFreCard14").val(msg.freqcardiaca14);
                $("#iptCriPse14").val(msg.pse14);
                $("#iptCriMonCor14").val(msg.momentocorrida14);
                $("#iptCriTVel15").val(msg.velocidade15);
                $("#iptCriTTemp15").val(msg.tempo15);
                $("#iptCriFreCard15").val(msg.freqcardiaca15);
                $("#iptCriPse15").val(msg.pse15);
                $("#iptCriMonCor15").val(msg.momentocorrida15);
                $("#iptCriTVel16").val(msg.velocidade16);
                $("#iptCriTTemp16").val(msg.tempo16);
                $("#iptCriFreCard16").val(msg.freqcardiaca16);
                $("#iptCriPse16").val(msg.pse16);
                $("#iptCriMonCor16").val(msg.momentocorrida16);
                $("#iptCriTVel17").val(msg.velocidade17);
                $("#iptCriTTemp17").val(msg.tempo17);
                $("#iptCriFreCard17").val(msg.freqcardiaca17);
                $("#iptCriPse17").val(msg.pse17);
                $("#iptCriMonCor17").val(msg.momentocorrida17);
                $("#iptCriTVel18").val(msg.velocidade18);
                $("#iptCriTTemp18").val(msg.tempo18);
                $("#iptCriFreCard18").val(msg.freqcardiaca18);
                $("#iptCriPse18").val(msg.pse18);
                $("#iptCriMonCor18").val(msg.momentocorrida18);
                $("#iptCriTVel19").val(msg.velocidade19);
                $("#iptCriTTemp19").val(msg.tempo19);
                $("#iptCriFreCard19").val(msg.freqcardiaca19);
                $("#iptCriPse19").val(msg.pse19);
                $("#iptCriMonCor19").val(msg.momentocorrida19);
                $("#iptCriTVel20").val(msg.velocidade20);
                $("#iptCriTTemp20").val(msg.tempo20);
                $("#iptCriFreCard20").val(msg.freqcardiaca20);
                $("#iptCriPse20").val(msg.pse20);
                $("#iptCriMonCor20").val(msg.momentocorrida20);
                $("#iptCriTVel21").val(msg.velocidade21);
                $("#iptCriTTemp21").val(msg.tempo21);
                $("#iptCriFreCard21").val(msg.freqcardiaca21);
                $("#iptCriPse21").val(msg.pse21);
                $("#iptCriMonCor21").val(msg.momentocorrida21);

                $("#iptCriRec0").val(msg.recuperacao0);
                $("#iptCriVel0").val(msg.velocidadear0);
                $("#iptCriBpm0").val(msg.bpm0);
                $("#iptCriRec1").val(msg.recuperacao1);
                $("#iptCriVel1").val(msg.velocidadear1);
                $("#iptCriBpm1").val(msg.bpm1);

                $("#iptCriZT0").val(msg.zonatreinamento0);
                $("#iptCriPorZT0").val(msg.porcentagem0);
                $("#iptCriBpmZT0").val(msg.bpmazt0);
                $("#iptCriZT1").val(msg.zonatreinamento1);
                $("#iptCriPorZT1").val(msg.porcentagem1);
                $("#iptCriBpmZT1").val(msg.bpmazt1);
                $("#iptCriZT2").val(msg.zonatreinamento2);
                $("#iptCriPorZT2").val(msg.porcentagem2);
                $("#iptCriBpmZT2").val(msg.bpmazt2);
                $("#iptCriZT3").val(msg.zonatreinamento3);
                $("#iptCriPorZT3").val(msg.porcentagem3);
                $("#iptCriBpmZT3").val(msg.bpmazt3);
                
                $("#buscar-dados-avaliacao").hide();

            } else {
                $("#erro-nova-avaliacao").html(msg.erro).show();
            }
        },
        error: function(erro){
        console.log(erro);
        }
    }); 
}

//AVALIACAO
//Enviar e-mail
function emailAvaliacao(ancor){
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"avaliacao/enviarEmailAvaliacao",
        //Dados
        data:{
            "id":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEmlId").val(msg.idavaliacao);
                $("#iptEmlNumero").val(msg.idavaliacao);
                $("#iptEmlData").val(msg.data);
                $("#iptEmlUsuario").val(msg.usuario);
                $("#iptEmlPara").val(msg.para);
                $("#iptEmlCopia").val(msg.copia);
                $("#iptEmlAssunto").val(msg.assunto);
                $("#iptEmlCorpo").val(msg.corpo);
            }
            else{
                $("erro-email-avaliacao").val(msg.erro);
                $("erro-email-avaliacao").show();                
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
            alert(thrownError);
      }
    });
}

//Validação novo
//Nova avaliacao
$('#frmCriAvaliacao').validate({
    //regras de validações
    rules: {
        iptCriNomeAluno: {            
            required: true,
            minlength:3
        },      
        iptCriData: {            
            required: true,
            date: true
        },      
        iptCriEmailAluno: {            
            required: true,
            email: true
        }
    },
    //Mensagens da validação
    messages:{
        iptCriNomeAluno: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres."
        },      
        iptCriData: {            
            required: "Necessário.",
            date: "Data inválida."
        },      
        iptCriEmailAluno: {            
            required: "Necessário e-mail.",
            email: "E-mail inválido."
        }
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-nova-avaliacao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-nova-avaliacao').show();
    }
});

//Validação envio de email
$('#frmEmailAvaliacao').validate({
    //regras de validações
    rules: {
        iptEmlId: {            
            required: true
        },      
        iptEmlPara: {            
            required: true,
            email: true
        },      
        iptEmlAssunto: {            
            required: true
        }
    },
    //Mensagens da validação
    messages:{
        iptEmlId: {            
            required: "Erro interno, informar o TI."
        },      
        iptEmlPara: {            
            required: "Necessário e-mail.",
            email: "Necessário e-mail valido."
        },      
        iptEmlAssunto: {            
            required: "Necessário assunto do e-mail."
        }
    },    
    submitHandler: function (form) {     
        form.submit(); 
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {          
        $('#erro-email-avaliacao').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-email-avaliacao').show();
    }
});

////Editar patrimonio
//$('#frmEdtPatrimonio').validate({
//    //regras de validações
//    rules: {
//        iptEdtEquipamento: {            
//            required: true,
//            minlength:3,
//            maxlength:80
//        },      
//        iptEdtPatrimonio: {            
//            required: true,
//            number: true,
//            remote: {
//                url:baseUrl+"patrimonio/verificaEditaPatrimonio",
//                type: "post",
//                data: {
//                    id: function(){
//                        return $("#iptEdtId").val();
//                    },
//                    patrimonio: function(){
//                        return $("#iptEdtPatrimonio").val();
//                    }                        
//                }
//            }
//        }
//    },
//    //Mensagens da validação
//    messages:{
//        iptEdtEquipamento: {            
//            required: "Necessário nome.",
//            minlength:"Deve ter mais de 2 caracteres.",
//            maxlength:"Deve ter menos de 80 caracteres."
//        },      
//        iptEdtPatrimonio: {            
//            required: "Necessário número.",
//            number: "Apenas números.",
//            remote: $.validator.format("Patrimônio {0} já existe.<br/>Tente outro e apague o antigo.")
//        }
//    },    
//    submitHandler: function (form) {     
//        form.submit(); 
//        carregando($(form).find(".carregando"));
//    },
//    invalidHandler: function (event, validator) {          
//        $('#erro-editar-patrimonio').html("Por favor, preencha \n\
//                                  corretamente os <strong>campos marcados</strong>.");
//        $('#erro-editar-patrimonio').show();
//    }
//});
//
////Remover patrimonio
//$('#frmRmvPatrimonio').validate({
//    //regras de validações
//    rules: {
//        iptRmvId: {            
//            required: true
//        }
//    },
//    //Mensagens da validação
//    messages:{
//        iptRmvId: {            
//            required: "Tente novamente."
//        }
//    },    
//    submitHandler: function (form) {     
//        form.submit(); 
//        carregando($(form).find(".carregando"));
//    },
//    invalidHandler: function (event, validator) {          
//        $('#erro-remover-patrimonio').html("Por favor, <strong>tente novamente</strong>.");
//        $('#erro-remover-patrimonio').show();
//    }
//});
//
////CRUD
////Edição
//function editarPatrimonio(ancor){
//    
//    $.ajax({
//        //tipo de requisição
//        type:"post",
//        //URL a ser invocada
//        url:baseUrl+"patrimonio/editarPatrimonio",
//        //Dados
//        data:{
//            "idpatrimonio":$(ancor).attr("data-id")
//        },
//        //tipo de formato de dados
//        dataType:"json",
//        //se tudo ocorrer bem
//        success:function(msg){
//            if(!msg.erro){
//                $("#iptEdtId").val(msg.idpatrimonio);
//                $("#iptEdtEquipamento").val(msg.equipamento);
//                $("#iptEdtPatrimonio").val(msg.patrimonio);
//                $("#iptEdtSerial").val(msg.serial);
//                $("#iptEdtModelo").val(msg.modelo);
//                $("#iptEdtDesc").val(msg.descricao);
//                $("#iptEdtFornecedor").val(msg.fornecedor);
//                $("#selEdtLocal").val(msg.local);
//            }
//            else{
//                alert(msg.erro);
//            }
//        }
//    });
//}
//    
////Remover
//function removerPatrimonio(ancor){
//    
//    $.ajax({
//        //tipo de requisição
//        type:"post",
//        //URL a ser invocada
//        url:baseUrl+"patrimonio/removerPatrimonio",
//        //Dados
//        data:{
//            "idpatrimonio":$(ancor).attr("data-id")
//        },
//        //tipo de formato de dados
//        dataType:"json",
//        //se tudo ocorrer bem
//        success:function(msg){
//            if(!msg.erro){
//                $("#iptRmvId").val(msg.idpatrimonio);
//                $("#iptRmvEquipamento").val(msg.equipamento);
//                $("#iptRmvPatrimonio").val(msg.patrimonio);
//            }
//            else{
//                alert(msg.erro);
//            }
//        }
//    });
//}
//
////Visualizar manutenção
//function visualizarManutencao(ancor){
//    //Esconde a div motivo (mostra somente na visualização sem conserto)
//    $(".div-vsl-motivo").hide();
//    //Esconde a div solução (mostra somente na visuzlização de conserto)
//    $(".div-vsl-solucao").hide();
//    $.ajax({
//        //tipo de requisição
//        type:"post",
//        //URL a ser invocada
//        url:baseUrl+"patrimonio/visualizarManutencao",
//        //Dados
//        data:{
//            "idmanutencao":$(ancor).attr("data-id")
//        },
//        //tipo de formato de dados
//        dataType:"json",
//        //se tudo ocorrer bem
//        success:function(msg){
//            if(!msg.erro){
//                $("#iptVslId").val(msg.idmanutencao);
//                $("#iptVslEquipamento").val(msg.equipamento);
//                $("#iptVslDefeito").val(msg.defeito);
//                $("#iptVslDataDefeito").val(msg.data);
//                $("#iptVslDescricao").val(msg.descricao);
//                $("#iptVslFornecedor").val(msg.fornecedor);
//                $("#iptVslPatrimonio").val(msg.patrimonio);
//                $("#selVslUnidade").val(msg.unidade);
//                $("#selVslSetor").val(msg.setor);
//                
//                //mostra motivo se for na manutenção sem conserto
//                if(msg.motivo){
//                    $("#iptVslmotivo").val(msg.motivo);
//                    $(".div-vsl-motivo").show();
//                }
//                
//                //mostra motivo se for na manutenção sem conserto
//                if(msg.solucao){
//                    $("#iptVslSolucao").val(msg.solucao);
//                    $(".div-vsl-solucao").show();
//                }
//            }
//            else{
//            }
//        }
//    });
//}