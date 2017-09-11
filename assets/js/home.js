/* 
 * Funções JS para parte de home
 * Autor: Dener Campos
 */

$(document).ready(function() {
    
    //Home animação
    animacaoHome();
    
});

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

//VALIDAÇÃO
//Login
$('#frmLogarMenu').validate({
    //regras de validações
    rules: {
        iptEmail: {            
            required: true,
            email: true,
            remote:baseUrl+"login/verificaEmail" 
        }
    },
    //Mensagens da validação
    messages:{
        iptEmail: {            
            required: "Necessário email.", 
            email: "Necessário email valido.",
            remote: $.validator.format("{0} não esta cadastrado no sistema. Crie uma nova conta.")
        }
    },   
    submitHandler: function (form) {     
        form.submit();    
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {
        console.log("erro");
    }
});

//Criar usuario
$('#frmCriUsuario').validate({
    //regras de validações
    rules: {
        iptCriNome: {            
            required: true,
            minlength:3,
            maxlength:50
        },
        iptCriEmail: {            
            required: true,
            email: true,
            minlength:3,
            maxlength:50,
            remote:baseUrl+"login/verificaEmailCriar" 
        },
        iptCriSenha: {            
            required: true,
            minlength:6,
            maxlength:50
        },
        iptCriRSenha: {            
            required: true,
            minlength:6,
            maxlength:50,
            equalTo: "#iptCriSenha"
        }
    },
    //Mensagens da validação
    messages:{
        iptCriNome: {            
            required: "Necessário nome.",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },
        iptCriEmail: {            
            required: "Necessário e-mail.",
            email: "Necessário e-mail valido",
            minlength:"Deve ter mais de 2 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            remote: $.validator.format("{0} já existe no sistema. <em>Entre em contato com o TI para recuperar a sua senha.</em>")
        },
        iptCriSenha: {            
            required: "Necessário senha. <em> Mínimo 6 digitos</em>",
            minlength:"Deve ter mais de 5 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres."
        },
        iptCriRSenha: {            
            required: "Necessário senha. <em> Mínimo 6 digitos</em>",
            minlength:"Deve ter mais de 5 caracteres.",
            maxlength:"Deve ter menos de 50 caracteres.",
            equalTo: "As senhas devem ser iguais."
        }
    },    
    submitHandler: function (form) {     
        form.submit();    
        carregando($(form).find(".carregando"));
    },
    invalidHandler: function (event, validator) {
        $('#erro-cria-usuario').html("Por favor, preencha \n\
                                  corretamente os <strong>campos marcados</strong>.");
        $('#erro-cria-usuario').show();
    }
});