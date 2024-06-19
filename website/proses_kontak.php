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

// Mendapatkan data dari formulir
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Menyimpan data ke database
$sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "<h2>Pesan Terkirim!</h2>";
    echo "<p>Terima kasih atas pesan Anda. Kami akan segera merespons.</p>";
} else {
    echo "<h2>Gagal Mengirim Pesan!</h2>";
    echo "<p>Mohon maaf, terjadi kesalahan dalam pengiriman pesan.</p>";
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
