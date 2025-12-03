<?php
$jsonFile = __DIR__ . '/../backend/data/history.json';

if (!file_exists($jsonFile)) die("File JSON tidak ditemukan");

$data = json_decode(file_get_contents($jsonFile), true);

$id = $_GET["id"] ?? null;
$status = $_GET["status"] ?? null;

if (!$id || !$status) die("ID atau status tidak valid");

foreach ($data as &$order) {
    if ($order["id"] == $id) {
        $order["status"] = $status;
        break;
    }
}

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

header("Location: admin.php");
exit;
