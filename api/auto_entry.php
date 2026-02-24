<?php
/**
 * API untuk Entry Kendaraan Otomatis via Kamera/CCTV
 * 
 * Endpoint: api/auto_entry.php
 * Method: POST
 * 
 * Parameter:
 * - plat_nomor (required): Plat nomor kendaraan dari OCR
 * - jenis_kendaraan (optional): Motor/Mobil/Truk/Elf (default: auto-detect)
 * - warna (optional): Warna kendaraan (default: -)
 * - id_area (optional): ID area parkir (default: auto-assign)
 * - api_key (required): API key untuk keamanan
 * 
 * Response: JSON
 */

header('Content-Type: application/json');
require_once '../config/database.php';

// API Key sederhana (ganti dengan yang lebih aman di production)
define('API_KEY', 'parkir2024secret');

// Validasi method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Ambil data dari request
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {