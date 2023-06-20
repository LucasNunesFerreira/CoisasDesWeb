<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem</title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</head>

<body>
    <?php include 'menu.php';
    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : "";
    ?>
    <form action="pesquisar.php" method="post">
        Pesquisar Usuário <input type="text" name="pesquisa" id="pesquisa" value="<?= $pesquisa ?>">
        <input type="submit" class="pesquisar" value="Pesquisar"><br><br>
    </form>

    <table border='1'>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Nota 1</th>
            <th>Nota 2</th>
            <th>Nota 3</th>
            <th>Nota 4</th>
            <th>Nascimento</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
        <?php
        $dados = json_decode(file_get_contents('salto.json'), true);
        foreach ($dados as $key)
            echo "<tr><td>{$key['id']}</td>
                  <td>{$key['nome']}</td>
                  <td>{$key['not1']}</td>
                  <td>{$key['not2']}</td>
                  <td>{$key['not3']}</td>
                  <td>{$key['not4']}</td>
                  <td>{$key['nascimento']}</td>                                  
                  <td align='center'><a href='cad.php?id=" . $key['id'] . "';>A</a></td>
                  <td align='center'><a href=javascript:excluirRegistro('acao.php?acao=excluir&id=" . $key['id'] . "');>E</a></td>";
        ?>
        </tr>
    </table>
</body>

</html>