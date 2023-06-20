<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Saltos</title>
    <?php
    include "acao.php";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $dados = array();
    if ($id != 0)
        $dados = carregar($id);

    $nascimento = isset($_POST['nascimento']) ? str_replace("/", "-", $_POST['nascimento']) : "24-04-2004";
    ?>
</head>

<body>
    <?php include 'menu.php'; ?>
    <form action="acao.php" method="post">
        <fieldset>
            <legend>Competição de saltos ornamentais</legend>
            <label for="id">Id</label>
            <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php if ($id != 0) echo $dados['nome']; ?>" required><br>
            <label for="not1">Nota 1</label>
            <input type="text" name="not1" id="not1" value="<?php if ($id != 0) echo $dados['not1']; ?>" required><br>
            <label for="not2">Nota 2</label>
            <input type="text" name="not2" id="not2" value="<?php if ($id != 0) echo $dados['not2']; ?>" required><br>
            <label for="not3">Nota 3</label>
            <input type="text" name="not3" id="not3" value="<?php if ($id != 0) echo $dados['not3']; ?>" required><br>
            <label for="not4">Nota 4</label>
            <input type="text" name="not4" id="not4" value="<?php if ($id != 0) echo $dados['not4']; ?>" required><br>
            <label for="nascimento">Nascimento</label>
            <input type="date" name="nascimento" id="nascimento" value="<?php if ($id != 0) echo date('d/m/Y', strtotime($dados['nascimento'])); ?>" required><br>
            <input type="submit" name="acao" id="acao" value="<?php if ($id == 0)
                                                                    echo "Salvar";
                                                                else
                                                                    echo "Alterar";
                                                                ?>">
        </fieldset>
    </form>
</body>

</html>