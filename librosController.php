<?php
require_once __DIR__ . '/db.php';

class LibrosController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function listarLibros() {
        $stmt = $this->db->query("SELECT * FROM libros");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function crearLibro() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['titulo']) || empty($data['autor']) || empty($data['genero']) || empty($data['anio_publicacion'])) {
            http_response_code(400);
            echo json_encode(["error" => "Todos los campos son obligatorios"]);
            return;
        }

        $stmt = $this->db->prepare("INSERT INTO libros (titulo, autor, genero, anio_publicacion) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['titulo'], $data['autor'], $data['genero'], $data['anio_publicacion']]);
        http_response_code(201);
        echo json_encode(["message" => "Libro creado"]);
    }

    public function actualizarLibro($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['titulo']) || empty($data['autor']) || empty($data['genero']) || empty($data['anio_publicacion'])) {
            http_response_code(400);
            echo json_encode(["error" => "Todos los campos son obligatorios"]);
            return;
        }

        $stmt = $this->db->prepare("UPDATE libros SET titulo = ?, autor = ?, genero = ?, anio_publicacion = ? WHERE id = ?");
        $stmt->execute([$data['titulo'], $data['autor'], $data['genero'], $data['anio_publicacion'], $id]);
        echo json_encode(["message" => "Libro actualizado"]);
    }

    public function eliminarLibro($id) {
        $stmt = $this->db->prepare("DELETE FROM libros WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["message" => "Libro eliminado"]);
    }
}
?>
