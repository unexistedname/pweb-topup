<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Jika request adalah preflight OPTIONS → hentikan di sini
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}



// Ambil input JSON dari React
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Input tidak valid"]);
    exit;
}

// Lokasi file JSON histori
$file = "./../data/history.json";

// Jika file belum ada, buat array kosong
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// Baca histori lama
$histori = json_decode(file_get_contents($file), true);

// Tambahkan transaksi baru
$histori[] = $data;

// Simpan kembali ke file JSON
file_put_contents($file, json_encode($histori, JSON_PRETTY_PRINT));

// Response untuk React
echo json_encode(["status" => "success", "transaksi" => $data]);
?>
