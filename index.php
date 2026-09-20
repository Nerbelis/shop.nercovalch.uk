<?php
include 'conexion.php';

// Obtener productos de la base de datos de forma dinámica
try {
    $stmt_prod = $pdo->query("SELECT p.*, c.nombre as categoria_nombre FROM productos p LEFT JOIN categorias c ON p.categoria_id = c.id");
    $productos = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $productos = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nerco Shop | Estampados DTF y Más</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff5722;
            --dark-bg: #121212;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            padding: 90px 0;
            border-bottom: 5px solid var(--primary-color);
        }
        .hero-title {
            font-weight: 800;
            letter-spacing: -1px;
        }
        .card-producto {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }
        .card-producto:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }
        .badge-proximamente {
            background-color: #ffc107;
            color: #000;
            font-weight: 600;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('gorras.jpeg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 90px 0;
            border-bottom: 5px solid var(--primary-color);
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
    <img src="logo.jpg" alt="Logo" style="height: 40px; width: 40px; objet-fit: cover; border-radius: 50%;"> Nerco Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#catalogo">Catálogo</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="https://nercovalch.uk" class="btn btn-outline-light btn-sm px-3" target="_blank">Portal Principal</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Portada Profesional (Hero Section) -->
    <header class="hero-section text-center">
        <div class="container">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 fw-bold text-uppercase">Estampados DTF & Personalización</span>
            <h1 class="display-4 hero-title mb-3">Lleva tus ideas al siguiente nivel con <span style="color: #ff5722;">Nerco Shop</span></h1>
            <p class="lead text-muted mb-4" style="color: #ccc !important;">Calidad insuperable en franelas, gorras y artículos personalizados en Maracaibo. ¡Pronto más sorpresas con sublimación!</p>
            <a href="#catalogo" class="btn btn-lg px-5 py-3 fw-bold text-white shadow" style="background-color: #ff5722; border: none;">Ver Catálogo Disponible</a>
        </div>
    </header>

    <!-- Catálogo de Productos -->
    <main class="container my-5" id="catalogo">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Nuestros Productos</h2>
            <p class="text-muted">Explora nuestra mercancía activa y las novedades en camino.</p>
        </div>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $prod): ?>
                    <div class="col">
                        <div class="card card-producto h-100 shadow-sm">
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                                <span class="fw-bold">[ Mockup Producto ]</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-dark text-uppercase mb-2 align-self-start"><?= htmlspecialchars($prod['categoria_nombre'] ?? 'General') ?></span>
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($prod['nombre']) ?></h5>
                                <p class="card-text text-muted small"><?= htmlspecialchars($prod['descripcion']) ?></p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="fs-4 fw-bold text-success">$<?= number_format($prod['precio'], 2) ?></span>
                                        <span class="badge bg-info text-dark">Stock: <?= $prod['stock_actual'] ?></span>
                                    </div>
                                    <button class="btn btn-dark w-100 fw-bold" style="background-color: #ff5722; border: none;">Comprar / Cotizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Tarjetas de muestra si la base de datos aún no tiene registros cargados -->
                <div class="col">
                    <div class="card card-producto h-100 shadow-sm">
                        <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                            <span class="text-warning fw-bold">Franela DTF Algodón</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary mb-2 align-self-start">DTF Activo</span>
                            <h5 class="card-title fw-bold">Franela 70% Algodón</h5>
                            <p class="card-text text-muted small">Estampado DTF de alta definición, tacto suave y máxima durabilidad ante los lavados.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-success">$5.00</span>
                                    <span class="badge bg-success">Disponible</span>
                                </div>
                                <button class="btn btn-dark w-100 fw-bold" style="background-color: #ff5722; border: none;">Pedir por Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col">
                    <div class="card card-producto h-100 shadow-sm">
                        <div style="height: 220px; overflow: hidden; background-color: #000;">
                          <img src="gorras.jpeg" alt="Gorras Trucker" style="width: 100%; height: 100%; object-fit: cover;">
                      </div>
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary mb-2 align-self-start">DTF Activo</span>
                            <h5 class="card-title fw-bold">Estructura alta</h5>
                            <p class="card-text text-muted small">Ideales para marcas, eventos o uso personal. Estampado frontal vibrante.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-success">$5.00</span>
                                    <span class="badge bg-success">Disponible</span>
                                </div>
                                <button class="btn btn-dark w-100 fw-bold" style="background-color: #ff5722; border: none;">Pedir por Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-producto h-100 shadow-sm">
                         <div style="height: 220px; overflow: hidden; background-color: #000;">
                          <img src="trucker.jpeg" alt="Gorras Trucker" style="width: 100%; height: 100%; object-fit: cover;">
                      </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary mb-2 align-self-start">DTF Activo</span>
                            <h5 class="card-title fw-bold">Gorras Trucker Frontal</h5>
                            <p class="card-text text-muted small">Ideales para marcas, eventos o uso personal. Estampado frontal vibrante.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-success">$5.00</span>
                                    <span class="badge bg-success">Disponible</span>
                                </div>
                                <button class="btn btn-dark w-100 fw-bold" style="background-color: #ff5722; border: none;">Pedir por Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-producto h-100 shadow-sm">
                        <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                            <span class="text-warning fw-bold">Franela Microdurazno</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary mb-2 align-self-start">DTF Activo</span>
                            <h5 class="card-title fw-bold">Franelas Micro-durazno</h5>
                            <p class="card-text text-muted small">Ideales para marcas, eventos o uso personal. Estampado frontal vibrante.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-success">$5.00</span>
                                    <span class="badge bg-success">Disponible</span>
                                </div>
                                <button class="btn btn-dark w-100 fw-bold" style="background-color: #ff5722; border: none;">Pedir por Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-producto h-100 shadow-sm">
                        <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                            <span class="text-warning fw-bold">Franelas de Muselina</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary mb-2 align-self-start">DTF Activo</span>
                            <h5 class="card-title fw-bold">Franelas de Muselina</h5>
                            <p class="card-text text-muted small">Ideales para marcas, eventos o uso personal. Estampado frontal vibrante.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-success">$5.00</span>
                                    <span class="badge bg-success">Disponible</span>
                                </div>
                                <button class="btn btn-dark w-100 fw-bold" style="background-color: #ff5722; border: none;">Pedir por Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-producto h-100 shadow-sm">
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                            <span class="text-light">Cuadro Aluminio / Lápida</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge badge-proximamente mb-2 align-self-start">Próximamente (Crédito)</span>
                            <h5 class="card-title fw-bold">Cuadros Conmemorativos</h5>
                            <p class="card-text text-muted small">Placas de aluminio especiales para recuerdos, eventos y lápidas con acabado brillante.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-5 fw-bold text-muted">Preventa</span>
                                    <span class="badge bg-secondary">Pronto</span>
                                </div>
                                <button class="btn btn-outline-secondary w-100 fw-bold" disabled>En Espera de Equipos</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <!-- Sección de Código QR -->
<section class="text-center py-4 bg-white text-dark my-4 rounded shadow-sm">
    <div class="container">
        <h4 class="fw-bold mb-3">¡Escanea y lleva nuestra tienda contigo!</h4>
        <p class="text-muted small mb-3">Comparte nuestro código QR para acceder rápidamente al catálogo desde cualquier dispositivo móvil.</p>
        <!-- Generador de QR dinámico (puedes cambiar el enlace si lo deseas) -->
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://shop.nercovalch.uk" alt="QR Código Tienda Nerco Shop" class="img-thumbnail shadow-sm" style="width: 150px; height: 150px;">
    </div>
</section>
<!-- Sección de Pago Móvil Local (Venezuela) con múltiples bancos -->
<div class="col-md-6">
    <div class="card shadow-sm p-4 h-100 bg-white text-dark">
        <h4 class="text-primary mb-3">💳 Pago Móvil (Maracaibo)</h4>
        <p class="text-muted small mb-3">Selecciona el banco de tu preferencia para realizar el Pago Móvil:</p>
        
        <!-- Lista de Bancos Disponibles -->
        <div class="mb-3">
            <label for="bancoSelect" class="form-label fw-bold small">Banco Destino:</label>
            <select id="bancoSelect" class="form-select form-select-sm mb-2">
                <option value="mercantil">Mercantil (0105)</option>
                <option value="bfc">BFC - Fondo Común (0151)</option>
                <option value="bnc">BNC Nacional de Crédito (0191)</option>
                <option value="venezuela">Banco de Venezuela (0102)</option>
                <option value="bancaribe">Bancaribe (0114)</option>
                <option value="banesco">Banesco (0134)</option>
            </select>
        </div>

        <div class="bg-light p-3 rounded mb-3 small">
            <p class="mb-1"><strong>Teléfono:</strong> 0424-6163113</p>
            <p class="mb-0"><strong>Cédula:</strong> V-11282487</p>
        </div>
        
        <hr>
        <h5 class="text-center mb-3 fs-6">Escanea el QR para tu Pago Móvil</h5>
        <div class="text-center mb-3">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150&data=P2P|0424-6163113|V11282487|10.00" alt="QR Pago Móvil" class="img-thumbnail" style="width: 150px; height: 150px;">
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold small">Número de Referencia:</label>
            <input type="text" name="referencia_pago" class="form-control form-control-sm" placeholder="Últimos dígitos del pago">
            <small class="text-muted">Válido para delivery al día siguiente en Maracaibo.</small>
        </div>
    </div>
</div>
<!-- 2. Método de Pago Internacional (PayPal) -->
<div class="col-md-6">
    <div class="card shadow-sm p-4 h-100 bg-white text-dark">
        <h4 class="text-success mb-3">🌍 Pago Internacional (PayPal)</h4>
        <p class="text-muted small mb-4">Paga de forma rápida y segura con tu saldo de PayPal o tarjeta de crédito internacional.</p>
        
        <!-- Contenedor del Botón de PayPal -->
        <div id="paypal-button-container" class="mt-auto"></div>
    </div>
</div>

<!-- SDK Oficial de PayPal con tu Client ID completo y limpio -->


<script src="https://www.paypal.com/sdk/js?client-id=AVENvr04fvsjtCX1m9875602y2DPDMokkTrVg5yVprbUpPhrrKzozW-ekQfn_prPKCTInrZMP_cZm&currency=USD"></script>
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '10.00' // Monto de referencia
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                alert('¡Pago exitoso con PayPal! Gracias por tu compra en Nerco Shop.');
            });
        },
        onCancel: function (data) {
            alert('Has cancelado el pago.');
        }
    }).render('#paypal-button-container');
</script>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2026 Nerco Shop (shop.nercovalch.uk). Todos los derechos reservados.</p>
            <small class="text-muted">Infraestructura respaldada en DigitalOcean y optimizada con Cloudflare.</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
    <!-- Script para proteger el código fuente y evitar clic derecho -->
<script>
    // Desactivar clic derecho
    document.addEventListener('contextmenu', event => event.preventDefault());

    // Desactivar atajos de teclado comunes para inspeccionar (F12, Ctrl+U, Ctrl+Shift+I, etc.)
    document.addEventListener('keydown', function(event) {
        if (event.keyCode == 123 // F12
            || (event.ctrlKey && event.shiftKey && event.keyCode == 73) // Ctrl+Shift+I
            || (event.ctrlKey && event.shiftKey && event.keyCode == 74) // Ctrl+Shift+J
            || (event.ctrlKey && event.keyCode == 85)) { // Ctrl+U
            event.preventDefault();
            return false;
        }
    });
</script>

</body>
</html>