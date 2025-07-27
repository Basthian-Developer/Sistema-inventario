<!DOCTYPE html>
<html lang="es" data-bs-theme="auto" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= csrf_meta()?>
    <meta name="csrf_token_name" content="<?= csrf_token()?>">
    <meta name="csrf_token_value" content="<?= csrf_hash()?>">
    <title>Inicio de sesión</title>

    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url('css/login.css')?>">
    </link>
</head>

<body class="h-100">
    <main class="h-100 d-flex flex-column">
        <div class="dashboard-wrapper container-fluid flex-grow-1 px-0">
            <div class="row flex-lg-row flex-column g-0 h-100">
                <!-- Contenido main -->
                <div
                    class="col-lg-6 d-flex flex-column justify-content-center align-items-center bg-dark text-white p-4 flex-grow-1">
                    <h3 class="h3 fw-bold lh-base">Sistema de inventario</h3>
                    <p class="mt-3 text-center">Gestiona tu inventario de manera eficiente y precisa con nuestro sistema
                        inteligente,
                        diseñado para optimizar el control de tus productos, reducir pérdidas y mejorar la toma de
                        decisiones en tiempo real. Simplifica tus procesos y mantén tu negocio siempre al día.</p>
                </div>

                <!-- Contenido login -->
                <div
                    class="col-lg-5 d-flex justify-content-center align-items-center bg-light p-4 shadow-sm rounded flex-grow-1">
                    <div>
                        <form>
                            <h1 class="h3 mb-3 fw-normal text-center fw-bold">Porfavor inicia sesión</h1>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="input_nombre"
                                    placeholder="Nombre de usuario">
                                <label for="input_nombre">Nombre de usuario</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="input_pass" placeholder="Contraseña">
                                <label for="input_pass">Contraseña</label>
                            </div>

                            <button class="btn btn-primary w-100 py-2" type="button" id="miboton">Iniciar</button>
                            <p class="mt-4 mb-3 text-body-secondary text-center">&copy; 2025</p>
                            <div id="mensaje-respuesta" class="text-center"></div>
                        </form>
                    </div>
                </div>
                <!-- final space -->
                <div class="col-lg-1 bg-dark p-4 flex-grow-1"></div>
            </div>
        </div>
    </main>
    <footer class="d-flex p-3 justify-content-center align-items-center text-white w-100 px-0">
        <p>© 2025 Derechos reservados - Basthian-Developer</p>
    </footer>

    <!-- Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"
        defer></script>
    <script src="<?= base_url('js/Csrf.js')?>" defer></script>
    <script src="<?= base_url('js/Auth.js') ?>" defer></script>
</body>

</html>