<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <?= csrf_meta() ?>
    <meta name="csrf_token_name" content="<?= csrf_token() ?>">
    <meta name="csrf_token_value" content="<?= csrf_hash() ?>">

    <style>
        .sidebar-options {
            height: 85%;
        }

        .sidebar-exit {
            height: 15%;
        }

        .nav-pills .nav-link {
            color: white;
        }

        .nav-pills .nav-link:hover {
            color: gray;
        }

        .table td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .table-responsive {
            max-height: 75vh;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
</head>

<body>
    <div class="d-flex flex-column">
        <div class="d-flex flex-md-row flex-column w-100 vh-100">
            <div class="d-flex flex-column col-md-3 p-3 bg-dark text-light shadow">
                <div class="sidebar-options">
                    <div>
                        <h3 class="text-center mb-3">Dashboard</h3>
                    </div>
                    <br>
                    <ul class="nav nav-pills d-flex flex-column">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active p-3" data-bs-toggle="pill" data-bs-target="#tab1" type="button" role="tab">Lista de equipos</a>
                        </li>
                        <li>
                            <a class="nav-link p-3" data-bs-toggle="pill" data-bs-target="#tab2">Gestión de incidencias</a>
                        </li>
                        <li>
                            <a class="nav-link p-3" data-bs-toggle="pill" data-bs-target="#tab3">Agenda de mantenimiento</a>
                        </li>
                        <li>
                            <a class="nav-link p-3" data-bs-toggle="pill" data-bs-target="#tab4">Registro de traslados</a>
                        </li>
                        <li>
                            <a class="nav-link p-3" data-bs-toggle="pill" data-bs-target="#tab5">Auditoria</a>
                        </li>
                    </ul>
                </div>
                <br>
                <div class="sidebar-exit d-flex justify-content-center align-items-center">
                    <button type="button" id="btnCerrarSesion" class="btn btn-danger">Cerrar sesión</button>
                </div>
            </div>
            <div class="d-flex flex-column col-md-9 p-3 vh-100">
                <div class="d-flex justify-content-center align-items-center">
                    <h3>Contenido</h3>
                </div>
                <div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Identificador serial</th>
                                            <th scope="col">Nombre del dispositivo</th>
                                            <th scope="col">Ubicacion</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>1289371289371892</td>
                                            <td>PC-01-EMP</td>
                                            <td>Desconocida</td>
                                            <td>
                                                <button class="btn btn-primary"> Detalles</button>
                                                <button class="btn btn-secondary">Editar</button>
                                                <button class="btn btn-danger">Eliminar</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>432442432423423</td>
                                            <td>PC-02-EMP</td>
                                            <td>Desconocida</td>
                                            <td>
                                                <button class="btn btn-primary"> Detalles</button>
                                                <button class="btn btn-secondary">Editar</button>
                                                <button class="btn btn-danger">Eliminar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel">
                            <p>Contenido 2</p>
                        </div>
                        <div class="tab-pane fade" id="tab3" role="tabpanel">
                            <p>Contenido 3</p>
                        </div>
                        <div class="tab-pane fade" id="tab4" role="tabpanel">
                            <p>Contenido 4</p>
                        </div>
                        <div class="tab-pane fade" id="tab5" role="tabpanel">
                            <div class="d-flex flex-column align-items-center">
                                <div class="table-responsive w-100 flex-grow-1 overflow-auto">
                                    <table class="table table-striped text-center" id="tablaAuditoria">
                                        <thead>
                                            <tr>
                                                <th scope="col">Autor</th>
                                                <th scope="col">Mensaje</th>
                                                <th scope="col">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>None</td>
                                                <td>None</td>
                                                <td>None</td>
                                                <td>None</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <button class="btn btn-success" id="btnExportar">Exportar datos</button>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row p-3 text-light justify-content-center" style="background-color: black;">2025 Derechos reservados - Basthian Developer</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"
        defer></script>

    <script src="<?= base_url('js/Csrf.js') ?>" defer></script>
    <script src="<?= base_url('js/Refresh.js') ?>" defer></script>
    <script src="<?= base_url('js/Dashboard.js') ?>" defer></script>
    <script src="<?= base_url('js/Table.js') ?>" defer></script>
</body>

</html>