<?php
class AreaController {
    
    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php");
            exit;
        }
        
        // Hanya admin yang bisa akses CRUD Area
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Akses ditolak! Hanya Admin yang bisa mengelola Area Parkir.'); window.location='index.php?c=Dashboard';</script>";
            exit;
        }
    }

    public function index() {
        $model = new AreaModel();
        $data = $model->getArea();
        include "views/area/index.php";
    }

    public function create() {
        include "views/area/create.php";
    }

    public function store() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AreaModel();
            $model->insert($_POST);
            header("Location: index.php?c=Area&m=index");
            exit;
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $model = new AreaModel();
        $data = $model->getById($id);
        include "views/area/edit.php";
    }

    public function update() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_area'];
            $model = new AreaModel();
            $model->update($id, $_POST);
            header("Location: index.php?c=Area&m=index");
            exit;
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $model = new AreaModel();
        $model->delete($id);
        header("Location: index.php?c=Area&m=index");
        exit;
    }
}
