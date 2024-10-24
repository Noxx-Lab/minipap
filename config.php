<?php
// definição das constantes com os valores do servidor, utilizador, senha e DB
define("SERVER","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","bd_alunos_06");

//Ligação ao servirdor MYSQL
$ligaDB=mysqli_connect(SERVER,USERNAME,PASSWORD);
if(!$ligaDB){
    echo"ERRO!!! Falha na ligação ao SERVIDOR";
    exit;
}
//Ligação à base de dados
$escolhaDB=mysqli_select_db($ligaDB,DATABASE);
if(!$escolhaDB){
    echo "ERROR!!! Falha na ligação à base de dados!";
    exit; 
}
// Função para adicionar índice, se ainda não existir
function criar_indices($db) {
    $db->query("CREATE INDEX IF NOT EXISTS idx_ano ON tbl_ano_turma(ano)");
    $db->query("CREATE INDEX IF NOT EXISTS idx_turma ON tbl_ano_turma(turma)");
    $db->query("CREATE INDEX IF NOT EXISTS idx_nome_aluno ON tbl_alunos(nome_aluno)");
}
