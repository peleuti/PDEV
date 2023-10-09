<?php require 'connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
         .page-title {
            background-color: #f0f0f0;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 24px;
        };
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header custom-title">
                <h2 class="page-title">Lista de Usuários</h2>
            </div>
        </div>
        <br>
        <a href="index.php?action=add&id=<?=null ?>" class="btn btn-primary btn-sm float-right">
            <i class="fas fa-plus"></i> Add Usuário
        </a>
        <br>
        <hr>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $key => $u) { ?>
                    <tr>
                        <td  data-user-id="<?= $u['id'] ?>" ><?= $key + 1?></td>
                        <td><?= $u['name'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $u['id'] ?>" class="btn btn-success btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="index.php?action=add_cores&id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-palette"></i> Cores
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDelete">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir este usuário?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST" action="index.php?action=delete">
                        <input type="hidden" id="userIdToDelete" name="id" value="">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Sim, Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('button[data-toggle="modal"]').click(function() {
            var userId = $(this).closest('tr').find('td[data-user-id]').data('user-id');
            $('#userIdToDelete').text(userId);
            $('#userIdToDelete').val(userId);
        });
    </script>
</body>
</html>
