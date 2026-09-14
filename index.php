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

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2026 Nerco Shop (shop.nercovalch.uk). Todos los derechos reservados.</p>
            <small class="text-muted">Infraestructura respaldada en DigitalOcean y optimizada con Cloudflare.</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>