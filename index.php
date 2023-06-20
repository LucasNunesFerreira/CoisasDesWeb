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
<?php include 'menu.php'; ?>
<table border = '1'>
<tr>
    <th>Id</th>
    <th>Nome</th>
    <th>Altura</th>
    <th>Peso</th>
    <th>Alterar</th>
    <th>Excluir</th>
</tr>
<?php
    $dados = json_decode(file_get_contents('pessoa.json'),true);
    foreach($dados as $key)
        echo "<tr><td>{$key['id']}</td>
                  <td>{$key['nome']}</td>
                  <td>{$key['altura']}</td>
                  <td>{$key['peso']}</td>
                  <td align='center'><a href='cad.php?id=".$key['id']."';>A</a></td>
                  <td align='center'><a href=javascript:excluirRegistro('acao.php?acao=excluir&id=".$key['id']."');>E</a></td>
              </tr>";
?>
</table>
</body>
</html>


