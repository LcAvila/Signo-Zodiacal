<?php 
// Inclui o arquivo 'header.php', que geralmente contém o cabeçalho da página, como o HTML inicial, links para CSS, scripts etc.
include('layouts/header.php'); 
?>

<div class="container mt-5">
    <!-- Título da página -->
    <h1>Descubra Seu Signo</h1>

    <!-- Formulário para enviar a data de nascimento -->
    <form id="signo-form" method="POST" action="show_zodiac_sign.php">
        
        <!-- Campo para a data de nascimento -->
        <div class="mb-3">
            <!-- Rótulo para o campo de data -->
            <label for="data_nascimento" class="form-label">Data de Nascimento</label> <br>
            <!-- Campo de entrada de data. O tipo 'date' permite escolher uma data em um calendário (em navegadores modernos) -->
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        
        <!-- Botão para enviar o formulário -->
        <button type="submit" class="btn btn-primary">Descobrir Signo</button>
    </form>
</div>

<?php 
// Inclui o arquivo 'footer.php', que geralmente contém o rodapé da página, scripts JavaScript, e o fechamento das tags HTML.
include('layouts/footer.php'); 
?>
