<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <title>Alterar</title>
</head>
<body style="background-color: grey;color:white;">
    <br>
    <form action="http://192.168.2.2:8080/ProjetoPHPCode/index.php/welcome/salvar" method="post">
        <div class="container">
            <input type="hidden" name="idusuario" value="<?php echo $user->idusuario ?>">
            <div class="form-group">
                <label>Nome:</label>
                <input class="form-control" type="text" name="nome" id="nome" required value="<?php echo $user->nome ?>">
            </div>
            <div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="../list" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</body>
</html>