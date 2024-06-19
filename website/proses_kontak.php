<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_sablon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

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

$stmt->close();
$conn->close();
?>
