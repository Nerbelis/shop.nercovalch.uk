<?php
header('Content-Type: application/json; charset=utf-8');

$datos = json_decode(file_get_contents('php://input'), true);
$mensaje = isset($datos['mensaje']) ? mb_strtolower(trim($datos['mensaje'])) : '';

$respuesta = "";

// Lógica de Nerbe para Nercovalch
if (strpos($mensaje, 'precio') !== false || strpos($mensaje, 'cuanto') !== false || strpos($mensaje, 'cuesta') !== false || strpos($mensaje, 'aumenta') !== false || strpos($mensaje, 'personalizado') !== false) {
    $respuesta = "¡Precios y Personalización en Nercovalch!\nLos precios base son accesibles, pero ten en cuenta que el costo puede variar dependiendo del tamaño y la complejidad del diseño DTF que elijas (si es grande, doble cara en franelas, o laterales en gorras).\nEscríbenos directo a nuestro WhatsApp: 0412-6526413 para cotizar tu idea exacta al momento.";
} 
elseif (strpos($mensaje, 'pago') !== false || strpos($mensaje, 'movil') !== false || strpos($mensaje, 'banco') !== false || strpos($mensaje, 'comprar') !== false) {
    $respuesta = "Métodos de Pago:\n- Pago Móvil:\n- Teléfono / Banco: 0424-6163113\nEnvíanos el comprobante y los datos de tu pedido al WhatsApp 0412-6526413 para procesarlo.";
} 
elseif (strpos($mensaje, 'gorra') !== false || strpos($mensaje, 'franela') !== false || strpos($mensaje, 'material') !== false || strpos($mensaje, 'tela') !== false || strpos($mensaje, 'algodon') !== false) {
    $respuesta = "Sobre nuestras prendas:\nTrabajamos con textiles de excelente calidad y técnica DTF perfecta para garantizar una larga duración.\nConsúltanos disponibilidad de colores y tallas al WhatsApp 0412-6526413.";
} 
elseif (strpos($mensaje, 'mercancia') !== false || strpos($mensaje, 'catalogo') !== false || strpos($mensaje, 'productos') !== false || strpos($mensaje, 'otro') !== false) {
    $respuesta = "Más mercancía disponible:\nAdemás de franelas y gorras personalizadas, en Nercovalch contamos con otros artículos especiales.\nEscríbenos al WhatsApp 0412-6526413 para enviarte fotos y detalles.";
} 
elseif (strpos($mensaje, 'hola') !== false || strpos($mensaje, 'info') !== false) {
    $respuesta = "¡Bienvenido a Nercovalch (shop.nercovalch.uk)! Soy Nerbe, tu asistente virtual. ¿Qué deseas consultar hoy? Pregúntanos por precios, diseños personalizados, nuestra mercancía o el pago móvil.";
} 
else {
    $respuesta = "Entiendo tu consulta. Para darte más detalles personalizados o concretar tu pedido en Nercovalch, escríbenos directamente a nuestro WhatsApp de empresa: 0412-6526413.";
}

echo json_encode(['respuesta' => $respuesta]);
?>