<?php
require_once __DIR__ . '/usuariosController.php';

$usuariosController = new UsuariosController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $usuariosController->listarUsuarios();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuariosController->crearUsuario();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $usuariosController->eliminarUsuario($_GET['id']);
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>
