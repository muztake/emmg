<?php require 'incl/header.php'; require 'incl/classes/aluno.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <title>Controle de Alunos</title>
    <link rel="stylesheet" href="css/home.css">
  </head>
  <body>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Série</th>
        <th>Turma</th>
        <th>Turno</th>
      </tr>
  <?php $alunos = Aluno::getAllAlunos($conn);
        foreach ($alunos as $aluno):?>
      <tr>
        <td><?= $aluno['id'] ?></td>
        <td><?= $aluno['nome'] ?></td>
        <td><?= $aluno['serie'] ?></td>
        <td><?= $aluno['turma'] ?></td>
        <td><?= $aluno['turno'] ?></td>
        <td><a href="verAluno.php?id=<?= $aluno['id'] ?>">Ver Aluno</a></td>
      </tr>
  <?php endforeach; ?>
    </table>


  </body>
</html>
