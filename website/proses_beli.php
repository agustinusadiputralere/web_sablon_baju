<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_sablon";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari formulir pembelian
$product_id = $_POST['product_id'];
$name = $_POST['name'];
$address = $_POST['address'];
$quantity = $_POST['quantity'];

// Mengambil data produk untuk memeriksa stok
$sql = "SELECT stock FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($product && $product['stock'] >= $quantity) {
    // Memproses pembelian
    $new_stock = $product['stock'] - $quantity;
    $sql = "UPDATE products SET stock = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_stock, $product_id);
    $stmt->execute();

    // Menyimpan data pembelian
    $sql = "INSERT INTO orders (product_id, customer_name, customer_address, quantity) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $product_id, $name, $address, $quantity);
    $stmt->execute();

    echo "<h2>Pembelian Berhasil!</h2>";
    echo "<p>Terima kasih, $name! Pesanan Anda akan segera diproses.</p>";
    echo "<p><a href='produk.php'>Kembali ke Produk</a></p>";
} else {
    echo "<h2>Pembelian Gagal!</h2>";
    echo "<p>Maaf, stok tidak mencukupi.</p>";
    echo "<p><a href='beli.php?product_id=$product_id'>Kembali</a></p>";
}

// Menutup koneksi
$conn->close();
?>
