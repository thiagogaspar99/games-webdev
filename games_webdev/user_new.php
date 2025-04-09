<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Cadastrar novo usuário</title>
</head>
<body>
    <?php 
        require_once "includes/banco.php";
        require_once "includes/login.php";
        require_once "includes/funcoes.php";
    ?>
    <div id="corpo" >
        <?php 
            if (!is_admin()) {
                echo msg_erro('Área Restrita / Você não é administrador!');
            } else {
                if (! isset($_POST['usuario'])) {
                    require "user_new_form.php";
                } else {
                    $usuario = $_POST['usuario'] ?? null;
                    $nome = $_POST['nome'] ?? null;
                    $senha1 = $_POST['senha1'] ?? null;
                    $senha2 = $_POST['senha2'] ?? null;
                    $tipo = $_POST['tipo'] ?? null;

                    if ($senha1 === $senha2) {
                        if (empty($usuario) || empty($nome) || empty($senha1) || empty($senha2) || empty($tipo)) {
                            echo msg_erro("Todos os dados são obrigatórios!");
                        } else {
                            $senha = gerarHash($senha1);
                            $query = "INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$usuario', '$nome', '$senha', '$tipo')";
                            
                            $consulta = $banco->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
                            if ($consulta->num_rows > 0) { 
                                echo msg_erro("Não foi possivel criar o usuário $usuario.");
                            } else if($banco->query($query)) {
                                echo msg_sucesso("Usuário $nome cadastrado com sucesso!");
                            
                    } else {
                        echo msg_erro("Senhas não conferem. Repita o procedimento.");
                    }
                }
            }
        }
    }
            echo "<br>" .  voltar();
        ?>
    </div>
</body>
</html>
