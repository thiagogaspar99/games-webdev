<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Jogos</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <?php 
        require_once "includes/banco.php";
        require_once "includes/login.php";
        require_once "includes/funcoes.php";
    ?>
    <div id="corpo" >
        <?php 
            include_once "topo.php";
            
            $cod = $_GET['cod'] ?? 0;
            $busca = $banco->query("SELECT * from jogos where cod_jogo = '$cod'");
        ?>
        <h1>Detalhes do Jogo</h1>
        <table class="detalhes">
            <?php
                if (!$busca) {
                    echo "Falha na busca!";
                } else {
                    if ($busca->num_rows == 1) {
                        $reg = $busca->fetch_object();
                        $t = thumb($reg->capa);
                        echo "<tr><td rowspan='4'><img src='$t' class='full'></img>
                        </td></tr>";
                        echo "<tr><td><h2>$reg->nome</h2>";
                        echo "Nota: " . number_format($reg->nota, 1) . " / 10.0";
                        if (is_admin()) {
                            echo" <i style='float: right;' class='material-symbols-outlined' >
                            delete</i>";
                            echo " <i style='float: right;' class='material-symbols-outlined'>
                            edit</i>";
                            echo " <i style='float: right;' class='material-symbols-outlined'>
                            add_circle</i>";
                        } else if (is_editor()) {
                            echo "<i style='float: right'
                            class='material-symbols-outlined'>
                            edit</i>";
                        }
                        echo "<tr><td>$reg->descricao</td></tr>";
                        echo "<tr><td>Adm</td></tr>";
                    } else {
                        echo "Nenhum registro encontrado!";
                    }
                }               
            ?>
        </table>
       <?php echo voltar() ?>
    </div>
    <?php include_once "rodape.php"; ?>
</body>
</html>