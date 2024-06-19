<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_sablon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT product_id, name, description, price, stock, image_url FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Sablon Baju</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .products {
            text-align: center;
        }

        .products ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .products li {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 1em;
            padding: 1em;
            width: 220px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            box-sizing: border-box; 
        }

        .products li img {
            max-width: 100%;
            height: 150px; 
            object-fit: cover; 
            border-bottom: 1px solid #ddd;
            margin-bottom: 1em;
        }

        .products li p {
            margin: 0.5em 0;
        }

        .products li .buy-now {
            display: inline-block;
            padding: 0.5em 1em;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 0.5em;
            transition: background-color 0.3s;
        }

        .products li .buy-now:hover {
            background-color: #000;
        }
    </style>
</head>
<body>
    <header>
        <h1>Jasa Sablon Baju</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="layanan.html">Layanan</a></li>
                <li><a href="tentang.html">Tentang Kami</a></li>
                <li><a href="kontak.html">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <section class="products">
            <h2>Produk Kami</h2>
            <p>Kami menawarkan berbagai macam desain sablon untuk baju Anda. Dari desain sederhana hingga kompleks, kami siap melayani kebutuhan Anda.</p>
            <ul>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<li>';
                        if ($row["image_url"]) {
                            echo '<img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                        } else {
                            echo '<img src="images/no_image_available.jpg" alt="No Image Available">';
                        }
                        echo '<p>' . htmlspecialchars($row["name"]) . '</p>';
                        echo '<p>' . htmlspecialchars($row["description"]) . '</p>';
                        echo '<p>Harga: Rp ' . number_format($row["price"], 2, ',', '.') . '</p>';
                        echo '<p>Stok: ' . htmlspecialchars($row["stock"]) . '</p>';
                        echo '<a href="beli.php?product_id=' . htmlspecialchars($row["product_id"]) . '" class="buy-now">Beli Sekarang</a>';
                        echo '</li>';
                    }
                } else {
                    echo "<p>Tidak ada produk yang tersedia.</p>";
                }
                ?>
            </ul>
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
