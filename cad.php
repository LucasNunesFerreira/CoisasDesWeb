<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <?php
        include "acao.php";
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $dados = array();
        if ($id != 0)
            $dados = carregar($id);    
    ?>
</head>
<body>
<?php include 'menu.php'; ?>
    <form action="acao.php" method="post">
        <fieldset>
            <legend>Cadastro de Pessoas</legend>
            <label for="id">Id</label>
            <input type="text" name="id" id="id" value="<?=$id?>" readonly><br>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" 
            value="<?php  if ($id != 0) echo $dados['nome'];?>" required><br>
            <label for="peso">Peso</label>
            <input type="text" name="peso" id="peso"
            value="<?php  if ($id != 0) echo $dados['peso'];?>"><br>
            <label for="altura">altura</label>
            <input type="text" name="altura" id="altura"
            value="<?php  if ($id != 0) echo $dados['altura'];?>"><br>
            <input type="submit" name="acao" id="acao" 
            value="<?php if ($id == 0)
                            echo "Salvar";
                         else
                            echo "Alterar";
                   ?>">
        </fieldset>
    </form>
</body>
</html>