 <?php
session_start();

// Set timezone ke WIB (Asia/Jakarta)
date_default_timezone_set('Asia/Jakarta');

// ANTI-BACK: Cegah cache browser
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once 'config/database.php';
require_once "models/AreaModel.php";
require_once "controllers/AreaController.php";

// Autoload Classes
spl_autoload_register(function($class){
    if(file_exists("controllers/$class.php")) require "controllers/$class.php";
    if(file_exists("models/$class.php")) require "models/$class.php";
});

// 1. Ambil nama controller dan method dari URL
// Jika tidak ada parameter 'c', cek apakah sudah login. 
// Jika sudah login arahkan ke Dashboard/Kendaraan, jika belum ke Auth.
$c = isset($_GET['c']) ? $_GET['c'] : (isset($_SESSION['user']) ? 'Kendaraan' : 'Auth');
$m = isset($_GET['m']) ? $_GET['m'] : (isset($_SESSION['user']) ? 'index' : 'login');

// PROTEKSI: Jika bukan halaman login/register dan tidak ada session, paksa ke login
if ($c !== 'Auth' && !isset($_SESSION['user'])) {
    header("Location: index.php?c=Auth&m=login");
    exit();
}

$controllerName = $c . 'Controller';

// 2. Cek apakah Class Controller-nya ada
if (class_exists($controllerName)) {
    $obj = new $controllerName();
    
    // 3. Cek apakah fungsi/method ($m) ada di dalam controller tersebut
    if (method_exists($obj, $m)) {
        $obj->$m();
    } else {
        // Pesan error lebih rapi agar kamu tahu persis apa yang salah
        echo "<div style='padding:20px; border:2px dashed red; background:#fff5f5; font-family:sans-serif;'>";
        echo "<h3 style='color:red;'>Method Error!</h3>";
        echo "Lupa membuat fungsi <b>public function {$m}()</b> di dalam file <b>controllers/{$controllerName}.php</b>";
        echo "</div>";
        die();
    }
} else {
    echo "<div style='padding:20px; border:2px dashed orange; background:#fffdf5; font-family:sans-serif;'>";
    echo "<h3 style='color:orange;'>Controller Tidak Ditemukan!</h3>";
    echo "Pastikan file <b>controllers/{$controllerName}.php</b> sudah ada dan nama Class-nya benar.";
    echo "</div>";
    die();
}