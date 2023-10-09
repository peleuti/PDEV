<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .custom-title {
            background-color: #f0f0f0;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header custom-title">
                Editar Usuário
            </div>
            <div class="card-body">
                <form method="POST" action="index.php">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="action" value="update">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="index.php" class="btn btn-secondary btn-sm mr-2">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
