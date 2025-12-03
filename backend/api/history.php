<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // supaya React bisa fetch
header("Access-Control-Allow-Methods: GET");

// lokasi file JSON
$path = __DIR__ . '/../data/history.json';
    

// cek apakah file ada
if (!file_exists($path)) {
    echo json_encode(["error" => "History not found"]);
    exit;
}

// baca isi file JSON
$data = file_get_contents($path);

// ubah JSON jadi array PHP
$history = json_decode($data, true);

// jika JSON rusak
if ($history === null) {
    echo json_encode(["error" => "Invalid JSON format"]);
    exit;
}

// kirim kembali ke React
echo json_encode($history, JSON_PRETTY_PRINT);
