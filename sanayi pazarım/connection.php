<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bilge";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// bağlantıyı test et
if ($conn->connect_error) {
     die("Veritabanına bağlanılamadı, Connection failed: " . $conn->connect_error);
}
 ?>
