<?php
  require 'incl/header.php';
  require 'incl/classes/aluno.php';
  if(!empty($_POST)){
    $dados = $_POST;
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $filename = 'fotos/' . $dados['id'] . ".$ext";
    $aluno = Aluno::createAluno(
      $dados['id'],
      $dados['nome'],
      $dados['dataNasc'],
      $dados['sexo'],
      $dados['responsavel_1'],
      $dados['responsavel_2'],
      $dados['telefone'],
      $dados['endereco'],
      ($dados['bolsaFamilia'] === 'on' ? 1 : 0),
      $dados['serie'],
      $dados['turma'],
      $dados['turno'],
      $filename,
      $dados['anoLetivo']
    );
    $query = $aluno->insertIntoDB($conn);
    move_uploaded_file($_FILES['foto']['tmp_name'], $filename);
    if($query['success']) {
      echo '<div class="success">Aluno cadastrado com sucesso.</div>';
    } else {
      echo '<div class="erro">Erro ao cadastrar aluno.<br>' . $query['message'] . '</div>';
    }

  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Adicionar Aluno</title>
    <link rel="stylesheet" href="css/adicionar.css">
  </head>
  <body>
    <div class="wrapper">
    <form action="adicionarAluno.php" enctype='multipart/form-data' method="post">
        <label for="nome">Nome Completo</label>
        <input type="text" name="nome" required>

        <label for="id">ID</label>
        <input type="text" name="id" required>

        <label for="dataNasc">Data Nascimento</label>
        <input type="date" name="dataNasc" required>

        <label for="sexo">Sexo</label>
        <select name='sexo' required>
          <option value="M">Masculino</option>
          <option value="F">Feminino</option>
        </select>

        <label for="turma">Turma</label>
        <input type="text" name="turma" required>

        <label for="serie">Serie</label>
        <select name='serie' required>
          <option value="1anofund">1º Ano Fundamental</option>
          <option value="2anofund">2º Ano Fundamental</option>
          <option value="3anofund">3º Ano Fundamental</option>
          <option value="4anofund">4º Ano Fundamental</option>
          <option value="5anofund">5º Ano Fundamental</option>
          <option value="6anofund">6º Ano Fundamental</option>
          <option value="7anofund">7º Ano Fundamental</option>
          <option value="8anofund">8º Ano Fundamental</option>
          <option value="9anofund">9º Ano Fundamental</option>
          <option value="1anomed">1º Ano Médio</option>
          <option value="2anomed">2º Ano Médio</option>
          <option value="3anomed">3º Ano Médio</option>
        </select>

        <label for="turno">Turno</label>
        <select name='turno' required>
          <option value="Manhã">Matutino</option>
          <option value="Tarde">Vespertino</option>
        </select>

        <label for="anoLetivo">Ano Letivo</label>
        <input type="text" name="anoLetivo" required>

        <label for="responsavel_1">Nome do Responsável (1)</label>
        <input type="text" name="responsavel_1" required>

        <label for="responsavel_2">Nome do Responsável (2)</label>
        <input type="text" name="responsavel_2" required>

        <label for="bolsaFamilia">Bolsa Familia</label>
        <select name='bolsaFamilia' required>
          <option value="on">Sim</option>
          <option value="off">Não</option>
        </select>

        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" required>

        <label for="endereco">Endereco</label>
        <textarea name='endereco' required></textarea>

        <label style='float:left; width: 400px' for="foto">Foto</label>
        <input type="file" id='foto' name="foto" accept='image/*' required>
        <img src="#" id='preview' alt="Pré-visualização">

        <input type="submit" value="Adicionar Aluno">

    </form>
  </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js" charset="utf-8"></script>
  <script type="text/javascript">
    function preview(input){
      input = input[0]
      console.log(input.files)
      if(input.files && input.files[0]){
        var reader = new FileReader()

        reader.onload = e => {
          $("#preview").attr('src', e.target.result)
        }

        reader.readAsDataURL(input.files[0])
      }
    }

    $("#foto").change(()=>{
      $("#preview").fadeIn(300)
      preview($("#foto"))
    })
  </script>
</html>
