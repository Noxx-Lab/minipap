<?php
include("config.php");

// Verificar se o ID do aluno foi recebido via POST
if (isset($_POST['id_aluno'])) {
    $id_aluno = $_POST['id_aluno'];

    // Buscar os dados do aluno no banco de dados
    $consulta = "SELECT * FROM tbl_aluno_ano AS tbano
        INNER JOIN tbl_alunos AS tbu ON tbano.id_aluno = tbu.id_aluno
        INNER JOIN tbl_ano_turma AS ats ON ats.idat = tbano.idat
        INNER JOIN tbl_user_aluno AS tpw ON tpw.email_aluno = tbu.email_aluno
        WHERE tbu.id_aluno = $id_aluno";
    $resultado = mysqli_query($ligaDB, $consulta);


    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $aluno = $resultado->fetch_assoc();
        $nome = $aluno['nome_aluno'];
        $email = $aluno['email_aluno'];
        $user = $aluno['user_aluno'];
        $turma = $aluno['turma'];
        $ano = $aluno['ano'];
        $aluno_pw = $aluno['aluno_pw']; 
    } 

    if (!$resultado) {
    echo "Erro na consulta: " . mysqli_error($ligaDB);
    exit();
    }
}

// Atualizar os dados do aluno se o formulário for submetido
if (isset($_POST['ano'])) {
    $id_aluno = $_POST['id_aluno'];
    $ano = $_POST['ano'];
    $nome = $_POST['nome'];
    $turma = $_POST['turma'];
    $user = $_POST['user'];
    $email = $_POST['email'];
    $aluno_pw = $_POST['password'];}

    $editar = "UPDATE tbl_alunos SET
    nome_aluno = '$nome'
    ";

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR ALUNO</title>
    <link rel="stylesheet" href="form_style.css">
</head>
<body>
    <a href="tabela.php" class="voltar-btn">Voltar</a>
    <div class="form-container">
        <h2>Editar Cliente</h2>
        <form action="" method="post">
            <label for="ano">Ano</label>
            <input type="number" id="ano" name="ano" placeholder="Ano" required min="1" max="12" value="<?php echo $ano; ?>">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required value="<?php echo $nome; ?>">

            <label for="turma">Turma</label>
            <input type="text" id="turma" name="turma" placeholder="Turma" required maxlength="1" style="text-transform: uppercase;" value="<?php echo $turma; ?>">

            <label for="user">User</label>
            <input type="text" id="user" name="user" placeholder="User" maxlength="10" required value="<?php echo $user; ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required value="<?php echo $email; ?>">

            <label for="password">Password</label>
            <input type="text" id="password" name="password" placeholder="Password" required value="<?php echo $aluno_pw; ?>">

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
    