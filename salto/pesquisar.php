<?php
include 'menu.php';

$pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : "";
pesquisa($pesquisa);

function pesquisa($pesq)
{
    $dados = json_decode(file_get_contents('salto.json'), true);
?>
    <style>
        .menorNota {
            background-color: red;
        }

        .maiorNota {
            background-color: blue;
        }
    </style>
    
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Nota 1</th>
            <th>Nota 2</th>
            <th>Nota 3</th>
            <th>Nota 4</th>
            <th>Nascimento</th>
            <th>Idade</th>
        </tr>
        <?php

        function calcularIdade($dataNascimento)
        {
            $hoje = new DateTime();
            $dataNascimento = DateTime::createFromFormat('d/m/Y', $dataNascimento);
            $idade = $hoje->diff($dataNascimento);
            return $idade->format('%Y');
        }

        function calcularMediaSalto($notas)
        {
            // Verifica se há notas suficientes para calcular a média
            if (count($notas) < 3) {
                return 0;
            }
            // Encontra a maior e a menor nota
            $maiorNota = max($notas);
            $menorNota = min($notas);
            // Remove a maior e a menor nota do array
            $notasSemExtremos = array_diff($notas, [$maiorNota, $menorNota]);
            // Calcula a média das notas restantes
            $media = array_sum($notasSemExtremos) / count($notasSemExtremos);

            return $media;
        }

        foreach ($dados as $key) {
            if ($pesq == $key['nome'] || $pesq == $key['id']) {
                $idade = calcularIdade($key['nascimento']);
                echo "<tr>
                        <td>{$key['id']}</td>
                        <td>{$key['nome']}</td>
                        <td>{$key['not1']}</td>
                        <td>{$key['not2']}</td>
                        <td>{$key['not3']}</td>
                        <td>{$key['not4']}</td>
                        <td>{$key['nascimento']}</td>
                        <td>{$idade} anos</td>
                      </tr>";
            }
        }

        $notasSalto = [];
        foreach ($dados as $key) {
            $notasSalto[] = $key['not1'];
            $notasSalto[] = $key['not2'];
            $notasSalto[] = $key['not3'];
            $notasSalto[] = $key['not4'];
        }

        $mediaSalto = calcularMediaSalto($notasSalto);
        $menorNota = min($notasSalto);
        $maiorNota = max($notasSalto);
        ?>
    </table>
    <h2>Média das notas: <?php echo $mediaSalto; ?></h2>
    <h2>Menor nota: <?php echo $menorNota; ?></h2>
    <h2>Maior nota: <?php echo $maiorNota; ?></h2>
<?php } ?>