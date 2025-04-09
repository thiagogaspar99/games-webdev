<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script</title>
</head>
<body>
    <pre>
        <?php
        //  $banco = new mysqli("host", "usuario", "senha", "banco de dados");
            $banco =  new mysqli("localhost", "root", "", "bd_games");

            // Testando erros

            if($banco->connect_errno) {
                echo "<p>Encontrei um erro $banco->errno --> $banco->connect_error</p>";
                die(); // Interrompe a execução do script.
            } else {
                echo "<p>Banco de dados conectado com sucesso!</p>";
            }

            //$banco->query("SET NAMES 'utf8'");
            //$banco->query("SET character set connection=utf8");
            //$banco->query("SET character set client=utf8");
            //$banco->query("SET character set results=utf8");
        
            // Busca no Banco de Dados
            $busca = $banco->query("select * from jogos");

            // Testando a query
            if(!$busca) {
                echo "<p>Falha na busca: $banco->error</p>";
            } else {
                while($registro = $busca->fetch_object()) {
                    print_r($registro); // Visualiza a estrutura de dados complexos, como arrays e objetos.
                }
            }

            // fetch_object() serve para transformar cada linha resultante de uma consulta em um objeto. 
        ?>
    </pre>
</body>
</html>