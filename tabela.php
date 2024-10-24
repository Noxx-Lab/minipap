<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Dados</title>
    <link rel="stylesheet" href="tabela_style.css">
</head>
<body>
<form action="adicionar.html" method="post" style="display:inline;">
        <button type="submit" name="adicionar" style="background-color: green; color: white;">Adicionar</button>
    </form>
    <form action="editar.php" method="post" style="display:inline;">
        <input type="hidden" name="id_aluno" id="id_aluno_editar">
        <button type="submit" id="btn-editar" style="background-color: blue; color: white;" disabled>Editar</button>
    </form>
    <form action="eliminar.php" method="post" style="display:inline;">
        <input type="hidden" name="id_aluno" id="id_aluno_eliminar">
        <button type="submit" id="btn-eliminar" style="background-color: red; color: white;" disabled>Eliminar</button>
    </form>

    <h2 style="text-align:center;">Tabela de Dados da Base de Dados</h2>

    <table>
        <thead>
            <tr>
                <th><a href="?coluna=ano&direcao=<?php echo $nova_direcao; ?>">Ano</a></th>
                <th><a href="?coluna=turma&direcao=<?php echo $nova_direcao; ?>">Turma</a></th>
                <th><a href="?coluna=nome_aluno&direcao=<?php echo $nova_direcao; ?>">Nome</a></th>
                <th>User</th>
                <th>Email</th>
                <th>Password</th>
                <th>Selecionar</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            include("config.php");
            $coluna = isset($_GET['coluna']) ? $_GET['coluna'] : 'ano';
            $direcao = isset($_GET['direcao']) ? $_GET['direcao'] : 'ASC';
            $nova_direcao = ($direcao === 'ASC') ? 'DESC' : 'ASC';

            $page = isset($_GET['page']) ? ($_GET['page']) : 1;
            $limit = 10;  // Número de registos por página
            $offset = ($page - 1) * $limit;  // Calcular o deslocamento da tabela que vai aparecer sem isso os registos da tabela só se repetem(OFFSET)

            //Consulta para buscar os registos com o LIMIT e OFFSET
            $consulta = "SELECT * FROM tbl_aluno_ano AS tbano
            INNER JOIN tbl_alunos AS tbu ON tbano.id_aluno = tbu.id_aluno
            INNER JOIN tbl_ano_turma AS ats ON ats.idat = tbano.idat
            INNER JOIN tbl_user_aluno AS tpw ON tpw.email_aluno = tbu.email_aluno
            ORDER BY $coluna $direcao
            LIMIT $limit OFFSET $offset";

            $resultado = mysqli_query($ligaDB, $consulta);
            include("pesquisa.php");
            //Tabela de registos
            while ($registos = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $registos["ano"] . "</td>";
                echo "<td>" . $registos["turma"] . "</td>";
                echo "<td>" . $registos["nome_aluno"] . "</td>";
                echo "<td>" . $registos["user_aluno"] . "</td>";
                echo "<td>" . $registos["email_aluno"] . "</td>";
                echo "<td>" . $registos["aluno_pw"] . "</td>";
                echo "<td style='text-align: center;'>
                    <input type='radio' name='selecionar' value='" . $registos['id_aluno'] . "' 
                    onclick='document.getElementById(\"id_aluno_editar\").value=\"" . $registos['id_aluno'] . "\";
                            document.getElementById(\"id_aluno_eliminar\").value=\"" . $registos['id_aluno'] . "\";
                            document.getElementById(\"btn-editar\").disabled = false;
                            document.getElementById(\"btn-eliminar\").disabled = false;'>
                </td>";
                echo "</tr>";
                }
            echo "</tbody></table>";
            include("paginacao.php");
            echo "<h3> Foram encontrados $total_registos registos </h3>";
            echo "Número de páginas: $total_paginas";
            ?>
