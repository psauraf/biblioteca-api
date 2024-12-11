<?php
require_once __DIR__ . '/db.php';

class UsuariosController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function listarUsuarios() {
        $stmt = $this->db->query("SELECT * FROM usuarios");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function crearUsuario() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data['nombre']) || empty($data['email']) || empty($data['edad'])) {
            http_response_code(400);
            echo json_encode(["error" => "Todos los campos son obligatorios"]);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["error" => "El email no es válido"]);
            return;
        }

        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, edad) VALUES (?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['email'], $data['edad']]);
        http_response_code(201);
        echo json_encode(["message" => "Usuario creado"]);
    }

    public function eliminarUsuario($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["message" => "Usuario eliminado"]);
    }
}
?>
