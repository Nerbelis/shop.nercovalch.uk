<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$mensaje = strtolower(trim($input['mensaje'] ?? ''));

$respuesta = "¡Hola! Para darte más detalles personalizados o concretar tu pedido en Nercovalch, escríbenos directamente a nuestro WhatsApp de empresa: *0412-6526413* 📱.";

// 1. PRECIOS Y AUMENTO POR DTF PERSONALIZADO
if (strpos($mensaje, 'precio') !== false || strpos($mensaje, 'cuanto cuesta') !== false \vert{}\vert{} strpos($mensaje, 'aumenta') !== false || strpos($mensaje, 'personalizado') !== false) {$respuesta = "💰 *Precios y Personalización en Nercovalch:*\n" .
                 "Tenemos precios base accesibles, pero ten en cuenta que *el costo puede variar o aumentar* dependiendo del tamaño y la complejidad del diseño DTF que elijas (si es grande, doble cara en franelas, o laterales en gorras).\n" .
                 "Cuéntanos tu idea exacta y te cotizamos al momento por WhatsApp: *0412-6526413*.";
}
// 2. OTRA MERCANCÍA / CATÁLOGOS ADICIONALES
elseif (strpos($mensaje, 'mercancia') !== false || strpos($mensaje, 'otro') !== false \vert{}\vert{} strpos($mensaje, 'productos') !== false || strpos($mensaje, 'catalogo') !== false) {$respuesta = "🛍️ *Más mercancía disponible:*\n" .
                 "Además de franelas y gorras personalizadas con impresión DTF, en Nercovalch contamos con otros artículos especiales.\n" .
                 "Escríbenos al WhatsApp *0412-6526413* para enviarte fotos y detalles de todo lo que tenemos disponible.";
}
// 3. PREGUNTAS SOBRE MATERIALES / TELAS
elseif (strpos($mensaje, 'algodon') !== false \vert{}\vert{} strpos($mensaje, 'tela') !== false || strpos($mensaje, 'material') !== false \vert{}\vert{} strpos($mensaje, 'franela') !== false || strpos($mensaje, 'gorra') !== false) {$respuesta = "👕 *Sobre nuestras prendas:*\n" .
                 "Trabajamos con textiles de excelente calidad (como mezclas de algodón y microdurazno), perfectos para garantizar una larga duración con la técnica DTF.\n" .
                 "Consúltanos disponibilidad de colores y tallas al WhatsApp *0412-6526413*.";
}
// 4. PREGUNTAS SOBRE PAGOS
elseif (strpos($mensaje, 'pago') !== false \vert{}\vert{} strpos($mensaje, 'movil') !== false || strpos($mensaje, 'comprar') !== false) {$respuesta = "💳 *Métodos de Pago:*\n" .
                 "Aceptamos Pago Móvil:\n" .
                 "• *Teléfono / Banco:* 0424-6163113\n" .
                 "Envíanos el comprobante y los datos de tu pedido al WhatsApp *0412-6526413* para procesarlo.";
}
// 5. SALUDO GENERAL
elseif (strpos($mensaje, 'hola') !== false || strpos($mensaje, 'info') !== false) {$respuesta = "¡Bienvenido a *Nercovalch* (nercovalch.uk)! Soy Nerbe, tu asistente virtual. ¿Qué deseas consultar hoy? Pregúntanos por precios, diseños personalizados, nuestra mercancía o el pago móvil.";
}

echo json_encode(["respuesta" => $respuesta]);