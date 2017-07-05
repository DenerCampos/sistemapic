/* 
 * Funções JS para parte de impressora fiscal
 * Autor: Dener Campos
 */

//CRUD Impressora fiscal
//Edição
function editarFiscal(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"fiscal/editarFiscal",
        //Dados
        data:{
            "idimpressora_fiscal":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptEdtId").val(msg.idimpressorafiscal);
                $("#iptEdtNome").val(msg.caixa);
                $("#iptEdtModelo").val(msg.modelo);
                $("#iptEdtSerial").val(msg.serial);
                $("#iptEdtDesc").val(msg.descricao);
                $("#selEdtLocal").val(msg.local);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}

//Remover
function removerFiscal(ancor){
    
    $.ajax({
        //tipo de requisição
        type:"post",
        //URL a ser invocada
        url:baseUrl+"fiscal/removerFiscal",
        //Dados
        data:{
            "idimpressora_fiscal":$(ancor).attr("data-id")
        },
        //tipo de formato de dados
        dataType:"json",
        //se tudo ocorrer bem
        success:function(msg){
            if(!msg.erro){
                $("#iptRmvId").val(msg.idimpressorafiscal);
                $("#iptRmvNome").val(msg.caixa);
                $("#iptRmvModelo").val(msg.modelo);
                $("#iptRmvSerial").val(msg.serial);
                $("#iptRmvDesc").val(msg.descricao);
                $("#selRmvLocal").val(msg.local);
            }
            else{
                $("#alert").val(msg.erro).show;
            }
        }
    });
}