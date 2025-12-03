<?php
// Lokasi file JSON
$jsonFile = __DIR__ . '/../backend/data/history.json';

// Baca JSON
$data = [];
if (file_exists($jsonFile)) {
    $jsonText = file_get_contents($jsonFile);
    $data = json_decode($jsonText, true);
}
if (!is_array($data)) $data = [];

// Hitung STATISTIK
$totalOrders = count($data);

$completed = 0;
$pending = 0;
$totalIncome = 0;

foreach ($data as $order) {
    if ($order["status"] === "completed") {
        $completed++;

        // Total harga = sum semua item
        foreach ($order["items"] as $item) {
            $totalIncome += $item["price"];
        }
    }
    if ($order["status"] === "pending") {
        $pending++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
body { background: #111; color: #eee; }
.table thead th { background: #222; color: #bbb; }
.table tbody tr { background: #181818; }
.badge { font-size: 12px; }
.card-stat { background:#181818; border:1px solid #333; padding:20px; border-radius:10px; }
</style>
</head>

<body class="p-4">

<h2 class="mb-4">Admin — Manage Orders</h2>

<!-- ===========================
      STATISTIK (BARU)
=========================== -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card-stat">
            <div class="text-main">Total Pesanan</div>
            <h3><?= $totalOrders ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat">
            <div class="text-main">Pesanan Completed</div>
            <h3 class="text-success"><?= $completed ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat">
            <div class="text-main">Pesanan Pending</div>
            <h3 class="text-warning"><?= $pending ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stat">
            <div class="text-main">Total Penghasilan</div>
            <h3 class="text-info">Rp <?= number_format($totalIncome, 0, ',', '.') ?></h3>
        </div>
    </div>
</div>

<!-- ===========================
           TABLE PESANAN
=========================== -->
<div class="table-responsive">
<table class="table table-dark table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>Date</th>
            <th>User</th>
            <th>Item</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach (array_reverse($data) as $order): ?>

        <?php
            $badge = "bg-secondary";
            if ($order["status"] === "pending")   $badge = "bg-warning text-dark";
            if ($order["status"] === "completed") $badge = "bg-success";
            if ($order["status"] === "canceled")  $badge = "bg-danger";
        ?>

        <tr>
            <td><?= $order["date"] ?></td>

            <td>
                <strong><?= $order["userId"] ?></strong><br>
                <small><?= $order["method"] ?></small>
            </td>

            <td>
                <?= $order["items"][0]["game"] ?><br>
                <small><?= $order["items"][0]["amount"] ?> Qty</small>
            </td>

            <td>
                Rp <?= number_format($order["items"][0]["price"], 0, ',', '.') ?>
            </td>

            <td>
                <span class="badge <?= $badge ?>">
                    <?= ucfirst($order["status"]) ?>
                </span>
            </td>

            <td>
                <div class="btn-group btn-group-sm">
                    <a href="update_json.php?id=<?= $order['id'] ?>&status=pending"
                        class="btn btn-warning text-dark">Pending</a>

                    <a href="update_json.php?id=<?= $order['id'] ?>&status=completed"
                        class="btn btn-success">Completed</a>

                    <a href="update_json.php?id=<?= $order['id'] ?>&status=canceled"
                        class="btn btn-danger">Canceled</a>
                </div>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>
</div>

</body>
</html>
