<?php
header("Content-Type: application/json");

$uri = str_replace('/index.php', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/libros' && $method === 'GET') {
    require_once __DIR__ . '/librosRoutes.php';
} elseif ($uri === '/libros' && $method === 'POST') {
    require_once __DIR__ . '/librosRoutes.php';
} elseif (preg_match('/^\/libros\/(\d+)$/', $uri, $matches) && $method === 'PUT') {
    $_GET['id'] = $matches[1];
    require_once __DIR__ . '/librosRoutes.php';
} elseif (preg_match('/^\/libros\/(\d+)$/', $uri, $matches) && $method === 'DELETE') {
    $_GET['id'] = $matches[1];
    require_once __DIR__ . '/librosRoutes.php';
} else {
    http_response_code(404);
    echo json_encode(["error" => "Recurso no encontrado"]);
}
?>
