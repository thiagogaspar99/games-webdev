<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script</title>
</head>
<body>
        <?php
        //  $banco = new mysqli("host", "usuario", "senha", "banco de dados");
            $banco =  new mysqli("localhost", "root", "", "bd_games");

            // Testando erros

            if($banco->connect_errno) {
                echo "<p>Encontrei um erro $banco->errno --> $banco->connect_error</p>";
                die(); // Interrompe a execução do script.
            }

            //$banco->query("SET NAMES 'utf8'");
            //$banco->query("SET character set connection=utf8");
            //$banco->query("SET character set client=utf8");
            //$banco->query("SET character set results=utf8");
        ?>
</body>
</html>