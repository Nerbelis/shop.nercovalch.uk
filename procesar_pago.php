<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Recoger los datos del formulario de pago
    $nombre = $_POST['nombre'] ?? 'Cliente';
    $telefono = $_POST['telefono'] ?? 'No indicado';
    $direccion = $_POST['direccion'] ?? 'No indicada';
    $monto = $_POST['monto'] ?? '10.00';
    $referencia = $_POST['referencia_pago'] ?? '';

    // Credenciales de Telegram (Tus datos reales extraídos de las capturas)
    $token = "8811814444:AAEooul5pfDgQ9m8HTiLEchMwwGQcFJsCMs"; 
    $chat_id = "1526051706";

    // 2. Verificar si el usuario subió el capture del Pago Móvil
    if (isset($_FILES['capture']) && $_FILES['capture']['error'] == 0) {
        $rutaTemporal = $_FILES['capture']['tmp_name'];
        $nombreArchivo = $_FILES['capture']['name'];
        
        // Crear carpeta de captures si no existe
        $rutaCarpeta = "captures/";
        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0755, true);
        }
        $rutaDestino = $rutaCarpeta . time() . "_" . basename($nombreArchivo);
        move_uploaded_file($rutaTemporal, $rutaDestino);

        // 3. Mensaje detallado que llegará a tu Telegram
        $mensajeTelegram = "🚨 ¡Nuevo Pago Móvil Recibido - Nerco Shop! 🚨\n\n" .
                           "👤 Cliente: $nombre\n" .
                           "📱 Teléfono: $telefono\n" .
                           "📍 Dirección: $direccion\n" .
                           "💰 Monto: $$monto\n" .
                           "🔢 Referencia: $referencia";

        // 4. Enviar la foto y el mensaje a través de la API de Telegram con cURL
        $url = "https://api.telegram.org/bot{$token}/sendPhoto";
        
        $postData = [
            'chat_id' => $chat_id,
            'photo' => new CURLFile(realpath($rutaDestino)),
            'caption' => $mensajeTelegram,
            'parse_mode' => 'Markdown'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuestaServer = curl_exec($ch);
        curl_close($ch);
    }

    // Respuesta visual para el cliente en la web
    echo "<script>alert('¡Comprobante enviado con éxito! Verificaremos tu pago móvil y procesaremos tu pedido en Maracaibo.'); window.location.href='index.php';</script>";
}
?>