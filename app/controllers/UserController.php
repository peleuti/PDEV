<?php
require 'EncryptionController.php';

class UserController {
    public function index() {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        foreach ($users as &$user) {
            $user['id'] = EncryptionController::encrypt($user['id']);
        }
        
        include 'app/views/home.php';
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $userModel = new UserModel();
            if ($userModel->createUser($name, $email)) {
                header("Location: index.php");
            } else {
                echo "Erro ao criar usuário.";
            }
        } else {
            include 'app/views/user/create.php';
        }
    }

    public function edit() {
        
        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $userModel = new UserModel();
            $id = EncryptionController::decrypt($_GET['id']);
            $user = $userModel->getUserById($id);

            if (!empty($user['id'])) {
                $user['id'] = EncryptionController::encrypt($user['id']);
                include 'app/views/edit.php';
            }

        }
    }
    
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = EncryptionController::decrypt($_POST['id']);
            $name = $_POST['name'];
            $email = $_POST['email'];
    
            $userModel = new UserModel();
    
            if ($userModel->updateUser($id, $name, $email)) {
                header("Location: index.php");
                exit();
            } else {
                echo "Erro ao atualizar usuário.";
            }
        } else {
            // Se não for uma solicitação POST, redirecione para a página inicial
            header("Location: index.php");
            exit();
        }
    }

    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = EncryptionController::decrypt($_POST['id']);
            
            $userModel = new UserModel();
            if ($userModel->deleteUser($id)) {
                header("Location: index.php");
            } else {
                echo "Erro ao excluir usuário.";
            }
        }
    }

    public function add() {
        include 'app/views/create.php';
    }

    public function add_cores() {
        $userModel = new UserModel();
        $id_cliente = EncryptionController::decrypt($_GET['id']);
        $cores = $userModel->getUserColor($id_cliente);
        $id_cli = EncryptionController::encrypt($id_cliente);

        foreach ($cores as &$cor) {
            $cor['id'] = EncryptionController::encrypt($cor['id']);
        }

        include 'app/views/color.php';
    }

    public function add_cor() {
        try {
            $userModel = new UserModel();
            $user_id = EncryptionController::decrypt($_POST['id_client']);
            $color_id = EncryptionController::decrypt($_POST['addcor']);
            $in_status = $_POST['in_status'];

            if ($in_status == 1) {
                $userModel->addColor($user_id, $color_id);
            }else{
                $userModel->deleteColor($user_id, $color_id);
            }
    
            $response = array(
                'status' => 'success',
                'message' => 'Cor adicionada com sucesso.'
            );
        } catch (Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => 'Ocorreu um erro ao adicionar a cor: ' . $e->getMessage()
            );
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}
?>
