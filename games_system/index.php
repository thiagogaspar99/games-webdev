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

        $ordem = $_GET['o'] ?? "n";
        $chave = $_GET['c'] ?? "";
    ?>
    
    <div id="corpo">

        <?php include_once "topo.php"; ?>
        
        <h1>Escolha seu Jogo</h1>
 
        <form action="index.php" method="get" id="busca">
            Ordenar: 
            <a href="index.php?o=n&c=<?= $chave ?>">Nome</a> | 
            <a href="index.php?o=p&c=<?= $chave ?>">Produtora</a> | 
            <a href="index.php?o=n1&c=<?= $chave ?>">Nota Alta</a> | 
            <a href="index.php?o=n2&c=<?= $chave ?>">Nota baixa</a> |
            <a href="index.php">Mostrar Todos</a> |
            Buscar: <input type="text" name="c" size="10" maxlength="40">
            <input type="submit" value="Ok">
        </form>

        <table class="listagem">
            <?php 

                $query = "SELECT j.cod_jogo, j.nome, g.genero, p.produtora, j.capa from jogos j JOIN generos g ON j.genero = g.cod_genero JOIN produtoras p ON j.produtora = p.cod_produtora ";

                if (!empty($chave)) {
                    $query .= "WHERE j.nome like '%$chave%' OR 
                    p.produtora like '%$chave%' OR g.genero like '%$chave%' ";
                }
                
                switch ($ordem) {
                    case "p":
                        $query .= "ORDER BY p.produtora";
                        break;
                    case "n1":
                        $query .= "ORDER BY j.nota DESC";
                        break;
                    case "n2":
                        $query .= "ORDER BY j.nota ASC";
                        break;
                    default:
                        $query .= "ORDER BY j.nome";
                        break;
                }

                $busca = $banco->query($query);
                
                if (! $busca) {
                    echo "<tr><td>Falha na busca!</td></tr>";
                } else {
                    if ($busca->num_rows == 0) {
                        echo "<tr><td>Nenhum registro encontrado!</td></tr>";
                    } else {
                        while ($reg = $busca->fetch_object()) {
                            # Carregar thumb
                            echo "<tr><td>";
                            $t =  thumb($reg->capa);
                            echo "<img src='$t' class='mini'>";
                            # Mostrar jogo
                            echo "<td><a href='detalhes.php?cod=$reg->cod_jogo'>$reg->nome</a>";
                            echo "<br>($reg->genero)
                            $reg->produtora";
                            if (is_admin()) {
                                echo "<td>";
                                echo" <i class='material-symbols-outlined'>
                                add_circle</i>";
                                echo " <i class='material-symbols-outlined'>
                                edit</i>";
                                echo " <i class='material-symbols-outlined'>
                                delete</i>";
                            } else if (is_editor()) {
                                echo "<td>";
                                echo "<i style='float: right'
                                class='material-symbols-outlined'>
                                edit</i>";
                            }
                        }
                    } 
                }  
            ?>
        </table>
    </div>
    <?php include_once "rodape.php"; ?>
</body>
</html>


