<?php
    session_start();

    if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    if (isset($_SESSION['data_penjualan'][$index])) {
        unset($_SESSION['data_penjualan'][$index]);
        $_SESSION['data_penjualan'] = array_values($_SESSION['data_penjualan']); // Re-index array
    }
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to remove GET parameter
    exit();
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Penjualan</title>
    <style>
        body {
        font-family: sans-serif;
        margin: 0;
        padding: 20px;
        }

        h1 {
        color: #333;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }

        th, td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
        }

        th {
        background-color: #f2f2f2;
        }

        .form-group {
        margin-bottom: 15px;
        }

        .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        }

        .form-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }

        .form-button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        }

        .form-button:hover {
        background-color: #45a049;
        }
        .action-button {
        padding: 5px 10px;
        margin: 2px;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        }
        
        .edit-button {
        background-color: #4CAF50;
        }
        
        .delete-button {
        background-color: #f44336;
        }
    
    </style>
    </head>
    <body>
    <h1>Data Penjualan</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <div class="form-group">
        <label class="form-label" for="tanggal_penjualan">Tanggal Penjualan:</label>
        <input class="form-input" type="date" id="tanggal_penjualan" name="tanggal_penjualan" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="nama_produk">Nama Produk:</label>
        <input class="form-input" type="text" id="nama_produk" name="nama_produk" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="jumlah">Jumlah:</label>
        <input class="form-input" type="number" id="jumlah" name="jumlah" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="harga">Harga:</label>
        <input class="form-input" type="number" id="harga" name="harga" required>
    </div>

    <button class="form-button" type="submit">Simpan Data</button>
    </form>



    <?php

    $data_penjualan = array();


    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tanggal = $_POST['tanggal_penjualan'];
    $produk = $_POST['nama_produk'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    $harga = floatval($_POST['harga']);  
     $total = $jumlah * $harga;

   
    $_SESSION['data_penjualan'][] = array(
        'tanggal' => $tanggal,
        'produk' => $produk,
        'jumlah' => $jumlah,
        'harga' => $harga,
        'total' => $total
    );
    }

   
    if (!empty($_SESSION['data_penjualan']))  {
    echo "<h2>Tabel Data Penjualan</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Tanggal</th><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Total</th><th>Aksi</th></tr>";

    foreach ($_SESSION['data_penjualan'] as $index => $data) {
        echo "<tr>";
        echo "<td>" . ($index + 1) . "</td>"; 
        echo "<td>" . $data['tanggal'] . "</td>";
        echo "<td>" . $data['produk'] . "</td>";
        echo "<td>" . $data['jumlah'] . "</td>";
        echo "<td>Rp " . number_format($data['harga'], 3, ',', '.') . "</td>";
        echo "<td>Rp " . number_format($data['total'], 3, ',', '.') . "</td>";
        echo "<td>
                <button class='action-button edit-button' onclick='editData($index)'>Edit</button>
                <button class='action-button delete-button' onclick='deleteData($index)'>Hapus</button>
            </td>";
        echo "</tr>";
    }

    echo "</table>";
    }
    ?>
    <script>
        function editData(index) {
        // Implementasi fungsi edit
        alert('Edit data dengan index: ' + index);
        }

        function deleteData(index) {
        // Implementasi fungsi hapus
        if (confirm('hapus nih?')) {
            window.location.href = '<?php echo $_SERVER["PHP_SELF"]; ?>?delete=' + index;
        }
        }
    </script>
    

    </body>
    </html>