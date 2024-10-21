<?php 
// Inclui o arquivo 'header.php', que normalmente contém o cabeçalho do site (HTML padrão, CSS, etc.).
include('layouts/header.php'); 
?>

<div class="container mt-5">
    <h1>Qual seu signo?</h1>

<?php
// Recebe a data de nascimento enviada via POST a partir de um formulário.
$data_nascimento = $_POST['data_nascimento'];

// Carrega o arquivo XML que contém as informações dos signos (datas de início e fim, nomes, descrições).
$signos = simplexml_load_file("signos.xml");

// Converte a data de nascimento recebida em um objeto DateTime para fácil manipulação de datas.
$data_nascimento = new DateTime($data_nascimento);

// Variável de controle para verificar se o signo foi encontrado.
$signo_encontrado = false;

// Inicia um loop para percorrer cada signo no arquivo XML.
foreach ($signos->signo as $signo) {
    
    // Converte as datas de início e fim de cada signo em objetos DateTime (formato 'dia/mês').
    $data_inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
    $data_fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
    
    // Define o ano da data de início e fim para o mesmo ano da data de nascimento.
    $data_inicio->setDate($data_nascimento->format('Y'), $data_inicio->format('m'), $data_inicio->format('d'));
    $data_fim->setDate($data_nascimento->format('Y'), $data_fim->format('m'), $data_fim->format('d'));

    // Verifica se o signo cruza o ano (se a data de fim é anterior à data de início, como no caso de Capricórnio).
    if ($data_inicio > $data_fim) {
        // Se for o caso, ajusta a data de fim para o próximo ano.
        $data_fim->modify('+1 year');

        // Verifica se a data de nascimento não está dentro do intervalo após o ajuste.
        if ($data_nascimento < $data_inicio && $data_nascimento > $data_fim) {
            // Se a data de nascimento não estiver no intervalo, pula para o próximo signo.
            continue;
        }
    }

    // Verifica se a data de nascimento está entre a data de início e a data de fim do signo atual.
    if ($data_nascimento >= $data_inicio && $data_nascimento <= $data_fim) {
        // Se estiver, exibe o nome e a descrição do signo correspondente.
        echo "<h2>{$signo->signoNome}</h2>";
        echo "<p>{$signo->descricao}</p>";
        
        // Marca que o signo foi encontrado e interrompe o loop.
        $signo_encontrado = true;
        break;
    }
}

// Se o signo não foi encontrado após o loop, exibe uma mensagem de erro.
if (!$signo_encontrado) {
    echo "<p>Não foi possível determinar seu signo. Verifique a data informada.</p>";
}
?>

<!-- Botão para voltar à página inicial -->
<a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
</div>

<?php 
// Inclui o arquivo 'footer.php', que geralmente contém o rodapé da página.
include('layouts/footer.php'); 
?>
