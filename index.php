<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Tabungan Canggih</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="number"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Program Tabungan Canggih</h2>

    <?php
    // Fungsi untuk menghitung total tabungan
    function hitungTotalTabungan($tabunganAwal, $bulan, $bunga)
    {
        $total = $tabunganAwal * pow((1 + $bunga / 100), $bulan);
        return $total;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tabunganAwal = isset($_POST["tabungan_awal"]) ? floatval($_POST["tabungan_awal"]) : 0;
        $bulan = isset($_POST["bulan"]) ? intval($_POST["bulan"]) : 0;
        $bunga = isset($_POST["bunga"]) ? floatval($_POST["bunga"]) : 0;

        if ($tabunganAwal > 0 && $bulan > 0 && $bunga >= 0) {
            $totalTabungan = hitungTotalTabungan($tabunganAwal, $bulan, $bunga);
            echo "<p>Total tabungan setelah $bulan bulan dengan bunga $bunga% adalah: <strong>Rp " . number_format($totalTabungan, 0, ',', '.') . "</strong></p>";
        } else {
            echo "<p style='color: red;'>Masukkan nilai yang valid untuk tabungan awal, jumlah bulan, dan persentase bunga.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="tabungan_awal">Tabungan Awal (Rp):</label>
        <input type="number" name="tabungan_awal" required>

        <label for="bulan">Jumlah Bulan:</label>
        <input type="number" name="bulan" required>

        <label for="bunga">Persentase Bunga (%):</label>
        <input type="number" name="bunga" required>

        <input type="submit" value="Hitung Total Tabungan">
    </form>
</div>

</body>
</html>
