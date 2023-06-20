<?php

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
        break;
    case 'POST':
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        break;
}

switch ($acao) {
    case 'Salvar':
        salvar();
        break;
    case 'Alterar':
        alterar();
        break;
    case 'excluir':
        excluir();
        break;
}

function carregar($id)
{
    $arquivo = file_get_contents('salto.json');
    $json = json_decode($arquivo);
    foreach ($json as $key) {
        if ($key->id == $id)
            return (array)$key;
    }
}


function alterar()
{
    $novo = array(
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'not1' => $_POST['not1'],
        'not2' => $_POST['not2'],
        'not3' => $_POST['not3'],
        'not4' => $_POST['not4'],
        'nascimento' => date('Y-m-d', strtotime($_POST['nascimento']))

    );
    $arquivo = file_get_contents('salto.json');
    $json = json_decode($arquivo);
    for ($x = 0; $x < count($json); $x++) {
        if ($json[$x]->id == $novo['id']) {
            $json[$x]->id = $novo['id'];
            $json[$x]->nome = $novo['nome'];
            $json[$x]->not1 = $novo['not1'];
            $json[$x]->not2 = $novo['not2'];
            $json[$x]->not3 = $novo['not3'];
            $json[$x]->not4 = $novo['not4'];
            $json[$x]->nascimento = $novo['nascimento'];
        }
    }

    $dados_json = json_encode($json);
    $fp = fopen("salto.json", "w");
    fwrite($fp, $dados_json);
    fclose($fp);
    header("location:index.php");
}


/*
1 - abrir json em formato php;
2 - percorrer e achar o item pelo ID;
3 - estratégia de deletar;
4 - gravar em json novamente, sem o item;
5 - redirecionar para a página index.php
*/

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $arquivo = file_get_contents('salto.json');
    $json = json_decode($arquivo);
    if ($json == null)
        $json = array();

    $novo = array();
    for ($x = 0; $x < count($json); $x++) {
        if ($json[$x]->id != $id)
            array_push($novo, $json[$x]);
    }
    $dados_json = json_encode($novo);
    $fp = fopen("salto.json", "w");
    fwrite($fp, $dados_json);
    fclose($fp);
    header("location:index.php");
}

function salvar()
{
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $not1 = isset($_POST['not1']) ? $_POST['not1'] : "";
    $not2 = isset($_POST['not2']) ? $_POST['not2'] : "";
    $not3 = isset($_POST['not3']) ? $_POST['not3'] : "";
    $not4 = isset($_POST['not4']) ? $_POST['not4'] : "";
    $nascimento = isset($_POST['nascimento']) ? $_POST['nascimento'] : "";

    $nascimento = date('d/m/Y', strtotime($nascimento));

    $pessoa = array(
        'id' => date("YmdHis"),
        'nome' => $nome,
        'not1' => $not1,
        'not2' => $not2,
        'not3' => $not3,
        'not4' => $not4,
        'nascimento' => $nascimento,
    );

    $saida = json_decode(file_get_contents('salto.json'), true);

    if ($saida != NULL)
        array_push($saida, $pessoa);
    else {
        $saida = array();
        array_push($saida, $pessoa);
    }

    $saida = json_encode($saida);
    $arquivo = fopen("salto.json", "w");
    fwrite($arquivo, $saida);
    fclose($arquivo);

    header('Location:index.php');
}
