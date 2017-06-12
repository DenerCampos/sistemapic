/* 
 * Funções JS para parte de plantão
 * Autor: Dener Campos
 */

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
