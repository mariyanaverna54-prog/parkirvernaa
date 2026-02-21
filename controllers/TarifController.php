<?php
class TarifController {
    
    public function __construct() {
        if(!isset($_SESSION['user'])) {
            header("Location: index.php");
            exit;
        }
        
        // Hanya admin yang bisa akses CRUD Tarif
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Akses ditolak! Hanya Admin yang bisa mengelola Tarif Parkir.'); window.location='index.php?c=Dashboard';</script>";
            exit;
        }
    }

    public function index() {
        $model = new TarifModel();
        $data = $model->all();
        include "views/tarif/index.php";
    }

    public function create() {
        include "views/tarif/create.php";
    }

    public function store() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new TarifModel();
            $model->insert($_POST);
            header("Location: index.php?c=Tarif&m=index");
            exit;
        }
    }

    public function edit() {
        $id = $_GET['id'];
        $model = new TarifModel();
        $data = $model->getById($id);
        include "views/tarif/edit.php";
    }

    public function update() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_tarif'];
            $model = new TarifModel();
            $model->update($id, $_POST);
            header("Location: index.php?c=Tarif&m=index");
            exit;
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $model = new TarifModel();
        $model->delete($id);
        header("Location: index.php?c=Tarif&m=index");
        exit;
    }
}
