<?php

declare(strict_types=1);

function buscarAlunos(): iterable
{
    $sql = 'SELECT * FROM tb_alunos';

    $alunos = abrirConexao() -> query($sql);

    return $alunos;
}

function buscarUmAluno($id): iterable
{
    $sql = "SELECT * FROM tb_alunos WHERE id = '{$id}'";

    $aluno = abrirConexao() -> query($sql);

    return $aluno -> fetch(PDO::FETCH_ASSOC);
}

function novoAluno(): void
{
    if(false === empty($_POST)){
        $nome = $_POST['nome'];
        $matricula = $_POST['matricula'];
        $cidade = $_POST['cidade'];

        $sql = "INSERT INTO tb_alunos (nome, matricula, cidade) VALUES (?,?,?)";
        $query = abrirConexao()->prepare($sql);
        $query->execute([$nome, $matricula, $cidade]);

        header('location: /listar');

    }
}

function excluirAluno(string $id): void
{
    $sql = "DELETE FROM tb_alunos WHERE id={$id}";

    abrirConexao()->query($sql);
} 