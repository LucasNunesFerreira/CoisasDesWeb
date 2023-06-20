<?php

$acao = "";
switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
    case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
}

switch($acao){
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

function carregar($id){  
    $arquivo = file_get_contents('pessoa.json');
    $json = json_decode($arquivo);
    foreach ($json as $key) {
      if ($key->id == $id)
        return (array)$key;
    }
}
  

function alterar(){
    $novo = array(
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'peso' => $_POST['peso'],
        'altura' => $_POST['altura']
    );
    $arquivo = file_get_contents('pessoa.json');
    $json = json_decode($arquivo);
        for ($x = 0; $x < count($json); $x++){
          if ($json[$x]->id == $novo['id']){
            $json[$x]->id = $novo['id'];
            $json[$x]->nome = $novo['nome'];
            $json[$x]->peso = $novo['peso'];
            $json[$x]->altura = $novo['altura'];
          }
        }
      
        $dados_json = json_encode($json);
        $fp = fopen("pessoa.json", "w");
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

function excluir(){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $arquivo = file_get_contents('pessoa.json');
    $json = json_decode($arquivo);
    if ($json == null)
        $json = array();

    $novo = array();
    for ($x = 0; $x < count($json); $x++){
        if ($json[$x]->id != $id)
          array_push($novo,$json[$x]);
    }
    $dados_json = json_encode($novo);
    $fp = fopen("pessoa.json", "w");
    fwrite($fp, $dados_json);
    fclose($fp);
    header("location:index.php");
    
}

function salvar(){
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $peso = isset($_POST['peso']) ? $_POST['peso'] : "";
    $altura = isset($_POST['altura']) ? $_POST['altura'] : "";

    $pessoa = array(
        'id' => date("YmdHis"),
        'nome' => $nome,
        'peso' => $peso,
        'altura' => $altura
    );

    $saida = json_decode(file_get_contents('pessoa.json'),true);

    if ($saida != NULL)
        array_push($saida,$pessoa);
    else{    
        $saida = array();
        array_push($saida,$pessoa);
    }

    $saida = json_encode($saida);
    $arquivo = fopen("pessoa.json", "w");
    fwrite($arquivo, $saida);
    fclose($arquivo); 
    
    header('Location:index.php');
}

?>