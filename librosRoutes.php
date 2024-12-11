<?php
require_once __DIR__ . '/librosController.php';

$librosController = new LibrosController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $librosController->listarLibros();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $librosController->crearLibro();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])) {
    $librosController->actualizarLibro($_GET['id']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $librosController->eliminarLibro($_GET['id']);
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>
