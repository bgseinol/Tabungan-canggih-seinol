<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Tabungan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Program Tabungan</h2>
    <?php
    // Inisialisasi tabungan
    $tabungan = isset($_POST['tabungan']) ? floatval($_POST['tabungan']) : 0;

    // Inisialisasi histori transaksi
    $history = isset($_POST['transaction_history']) ? explode("|", $_POST['transaction_history']) : array();

    // Proses form jika ada input
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST["action"];
        $amount = floatval($_POST["amount"]);

        // Proses penambahan atau penarikan
        if ($action === "deposit") {
            $tabungan += $amount;
            $history[] = "Menambahkan " . formatRupiah($amount) . " ke tabungan.";
        } elseif ($action === "withdraw") {
            if ($amount <= $tabungan) {
                $tabungan -= $amount;
                $history[] = "Menarik " . formatRupiah($amount) . " dari tabungan.";
            } else {
                $history[] = "Gagal menarik " . formatRupiah($amount) . ". Tabungan tidak mencukupi.";
            }
        }
    }

    // Fungsi untuk format Rupiah
    function formatRupiah($angka){
        $rupiah = number_format($angka, 0, ',', '.');
        return 'Rp ' . $rupiah;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="amount">Jumlah:</label>
        <input type="number" name="amount" id="amount" step="1" required>

        <label for="action">Aksi:</label>
        <select name="action" id="action" required>
            <option value="deposit">Tambah</option>
            <option value="withdraw">Tarik</option>
        </select>

        <!-- Menambahkan input hidden untuk menyimpan nilai tabungan dan histori transaksi -->
        <input type="hidden" name="tabungan" value="<?php echo $tabungan; ?>">
        <input type="hidden" name="transaction_history" value="<?php echo implode("|", $history); ?>">

        <button type="submit">Submit</button>
    </form>

    <p>Tabungan Anda: <?php echo formatRupiah($tabungan); ?></p>

    <h3>Histori Transaksi:</h3>
    <ul>
        <?php
        // Menampilkan histori transaksi
        foreach ($history as $transaction) {
            echo "<li>$transaction</li>";
        }
        ?>
    </ul>
</div>

</body>
</html>
