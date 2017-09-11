<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Codigo html  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h1 class=""><strong>#Notas Versão (1.8)</strong></h1>
    <div class="">        
        <h2>-Melhorias</h2>
        <h3><u>Sistema</u></h3>
        <p>01- Validação front-end.</p>
        <h3><u>Helpdesk</u></h3>
        <p>01- Criado campo de datas de abertura, atendimento e fechamento na impressão do chamado.</p>
        <p>02- Criado campo de solução em chamados fechados na impressão de chamado.</p>
        <p>03- Na vizualização de chamados, aparece a solução em separado se chamado estiver fechado.</p>
        <p>04- Na impressão de chamados foi colocado quebra de linha nos textos dos comentários.</p>
        <p>05- Na busca, foi separado os chamados por aberto, fechados e em atendimento e com suas opções.</p>
        <p>06- Na tela de chamados abertos, será recarregada a pagina automáticamente a cada 5 minutos.</p>
        <p>07- Adicionado uma imagem padrão para a imagem do anexo quando não tiver anexo.</p>
        <h3><u>Nivel de acesso</u></h3>
        <p>01- Implementado o nivel de acesso por funções, habilitando ou desabilitando acesso à algumas funções por usuário.</p>
        <h3><u>Equipamentos (Maquinas)</u></h3>
        <p>01- Não é mais obrigado o campo IP.</p>
        <p>02- Adicionado a exibição da listagem de maquinas.</p>
        <h3><u>Relatórios</u></h3>
        <p>01- Adicionado relatório geral.</p>
        <p>02- Adicionado relatório por setor.</p>
        <p>03- Adicionado relatório por usuário.</p>
        <p>04- Adicionado relatório por técnico.</p>
        <h3><u>Equipamentos (POS)</u></h3>
        <p>01- Adicionado campo para controlar se o POS está em manutenção (CHART).</p>
        <p>02- Informando na lista de POS os POS que estão na CHART.</p>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h1 class=""><strong>#Notas Versão (1.7)</strong></h1>
    <div class="">        
        <h2>-Melhorias</h2>
        <h3><u>Sistema</u></h3>
        <p>01- Criado tabela POS, PINPAD, IMPRESSORA_FISCAL, IMPRESSORA e ACESSO.</p>
        <h3><u>Helpdesk</u></h3>
        <p>01- Todos chamados abertos, em atendimento e fechados aparece no perfil técnico.</p>
        <h3><u>IP´s Maquinas PP (Agora equipamentos)</u></h3>
        <p>01- Troca IP´s Maquinas PP por equipamentos.</p>
        <p>02- Adicionado pinpads, pos, impressoras fiscais e não fiscais.</p>
        <p>03- Criado pagina exibir, onde qualquer usuario consegue acessar as tabelas de pinpads, pos, impressoras fiscais e impressoras.</p>
        <h3><u>Relatório plantão</u></h3>
        <p>01- Criado menu relatórios.</p>
    </div>
    <div class="">
        <h2>-Bugs</h2>
        <h3><u>HelpDesk</u></h3>
        <p>01- O sistema anexo aqruivos .jpeg</p>
        <p>02- Correção da listagem dos chamados abertos no perfil do técnico.</p>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h1 class=""><strong>#Notas Versão (1.6)</strong></h1>
    <div class="">        
        <h2>-Melhorias</h2>
        <h3><u>Sistema</u></h3>
        <p>01- Separação dos arquivos js.</p>
        <h3><u>Manutenção</u></h3>
        <p>01- Criado a função de equipamentos que não teve conserto.</p>
	<p>02- Adicionado nova aba de equipamentos que não obteve conserto.</p>
	<p>03- Adicionado campo de fornecedor.</p>
	<p>04- Habilitado edição da data defeito ao mandar para o conserto.</p>
	<p>05- Validações das regras de datas.</p>
	<p>06- Adicionado campo descrição do reparo ao retorno da manutenção.</p>
	<p>07- Adicionado 0 dias de garantia.</p>
	<p>08- Buscar por fornecedor.</p>
        <h3><u>Administração</u></h3>
        <p>01- Implementado busca nas opçoes.</p>
    </div>
    <div class="">
        <h2>-Bugs</h2>
        <h3><u>Alteração de usuario (ADMIN)</u></h3>
        <p>01- Ao passar o tecnico para administrador, o sistema não atualiza a area mas aceita como administrador.</p>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h1 class=""><strong>#Notas Versão (1.5)</strong></h1>
    <div class="">        
        <h2>-Melhorias</h2>
        <h3><u>Ocorrencias</u></h3>
        <p>1- Mudança de layout para criar, editar e fechar chamado, separando os dados do chamado, comentarios e anexos em abas separadas. Adicionado contador de anexo e comentarios.</p>
        <p>2- Agora pode adicionar fotos/imagens ao editar e fechar chamados(maximo 3 por edição).</p>
        <p>3- Agora pode selecionar para mandar e-mail para area de atendimento e para o usuario que abriu o chamado para acompanhamento.</p>
        <p>4- Ao editar o chamado, pode-se marcar a opção de acomparnhar por email, sendo assim, o tecnico e o usuario que abriu o chamado irão	receber e-mail com as atualizações.</p>
        <p>5- Ao fechar o chamado, pode-se marcar a opção de Enviar e-mail para o usuário que abriu o chamado, o usuario que abriu o chamado ira receber e-mail com os dados do fechamento do chamado.</p>
    </div>
    <div class="">
        <h2>-Bugs</h2>
        <h3><u>Ocorrencias</u></h3>
        <p>1- Minutos mostrados nos comentários das ocorrencias foi consertado, antes mostrava o mês.</p>
        <h3><u>Atualizar usuario</u></h3>
        <p>1- Consertado a atualização dos usuarios técnicos.</p>
    </div>
</div>