<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Whisky</title>
</head>

<body>
    <div class="container">
        <!-- Formulário de cadastro -->
        <form id="formWhisky">
            <h2>Cadastrar Novo Whisky</h2>
            <label for="nome">Nome do Whisky:</label>
            <input type="text" id="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" required></textarea>

            <label for="promo">Promoção (opcional):</label>
            <input type="text" id="promo">

            <button type="submit">Adicionar Whisky</button>
        </form>
</body>

</html>