<!DOCTYPE html>
<html>
<head>
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Excluir Usuário</h2>
        <p>Tem certeza de que deseja excluir este usuário?</p>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <button type="submit" class="btn btn-danger">Sim, Excluir</button>
            <a href="index.php" class="btn btn-primary">Cancelar</a>
        </form>
    </div>
</body>
</html>
