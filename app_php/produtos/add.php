<?php
require_once('./header.php');
require_once('../functions.php');
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><h3><b><?=$title?> <br> Adicionar</h3></b></div>
        <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6">

        <table class="table table-bordered table-responsive table-hover">    
            <form method="post" action="add.php">           
            <tr><td>Descrição</td><td><input type="text" name="descricao" autofocus></td></tr>
            <tr><td>Unidade</td><td><input type="text" name="unidade"></td></tr>
            <tr><td>Cadastro</td><td><input type="text" name="data_cadastro"></td></tr>
            <tr><td></td><td><input class="btn btn-primary" name="enviar" type="submit" value="Cadastrar">&nbsp;&nbsp;&nbsp;
            <input class="btn btn-warning" name="enviar" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
            </form>
        </table>
        </div>
    </div>
</div>

<?php
require_once('../db_connect.php');

if(isset($_POST['enviar'])){
$descricao = $_POST['descricao'];
$unidade = $_POST['unidade'];
$cadastro = $_POST['data_cadastro'];

   try{
       $stmte = $pdo->prepare("INSERT INTO produtos(descricao,unidade,data_cadastro) VALUES (?, ?, ?)");
       $stmte->bindParam(1, $descricao , PDO::PARAM_STR);
       $stmte->bindParam(2, $unidade , PDO::PARAM_STR);
       $stmte->bindParam(3, $cadastro , PDO::PARAM_STR);
       $executa = $stmte->execute();
 
       if($executa){
           echo 'Dados inseridos com sucesso';
		   header('location: index.php');
       }
       else{
           echo 'Erro ao inserir os dados';
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
}
require_once('../footer.php');
?>

