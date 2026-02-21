<?php
class UserController {
    
    public function __construct() {
        if(!isset($_SESSION['user'])) {
            header("Location: index.php");
            exit;
        }
        
        // Hanya admin yang bisa akses CRUD User
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Akses ditolak! Hanya Admin yang bisa mengelola User.'); window.location='index.php?c=Dashboard';</script>";
            exit;
        }
    }

    public function index() {
        $model = new UserModel();
        $data = $model->all();
        include "views/user/index.php";
    }

    public function create() {
        include "views/user/create.php";
    }

    public function store() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel();
            $model->insert($_POST);
            header("Location: index.php?c=User&m=index");
            exit;
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $model = new UserModel();
        $data = $model->getById($id);
        include "views/user/edit.php";
    }

    public function update() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_user'];
            $model = new UserModel();
            $model->update($id, $_POST);
            header("Location: index.php?c=User&m=index");
            exit;
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $model = new UserModel();
        $model->delete($id);
        header("Location: index.php?c=User&m=index");
        exit;
    }
}
