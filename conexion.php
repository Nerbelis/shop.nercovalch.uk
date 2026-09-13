<?php
$host = '127.0.0.1';
$port = '3308';
$dbname = 'shop_nercovalch_uk';
$username = 'root'; // Usuario por defecto de XAMPP
$password = '';     // Contraseña por defecto (en blanco)

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Configurar manejo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "¡Conectado con éxito a Nerco Shop!";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>