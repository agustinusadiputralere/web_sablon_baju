<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_sablon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$product_id = $_GET['product_id'];

$sql = "SELECT product_id, name, description, price, stock, image_url FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli Produk - Sablon Baju</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .product-details {
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        .product-details img {
            max-width: 100%;
            height: auto;
        }

        .buy-form {
            margin-top: 20px;
        }

        .buy-form input, .buy-form button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .buy-form button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        .buy-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Jasa Sablon Baju</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="produk.html">Produk</a></li>
                <li><a href="layanan.html">Layanan</a></li>
                <li><a href="tentang.html">Tentang Kami</a></li>
                <li><a href="kontak.html">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <section class="product-details">
            <h2>Beli Produk</h2>
            <?php if ($product): ?>
                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Harga: Rp <?= number_format($product['price'], 2, ',', '.') ?></p>
                <p>Stok: <?= htmlspecialchars($product['stock']) ?></p>

                <form class="buy-form" action="proses_beli.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                    <label for="name">Nama Lengkap:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="address">Alamat Pengiriman:</label>
                    <input type="text" id="address" name="address" required>
                    <label for="quantity">Jumlah:</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="<?= htmlspecialchars($product['stock']) ?>" required>
                    <button type="submit">Beli Sekarang</button>
                </form>
            <?php else: ?>
                <p>Produk tidak ditemukan.</p>
            <?php endif; ?>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 Jasa Sablon Baju. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
