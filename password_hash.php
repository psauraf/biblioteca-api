<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$database = new Database();
$db = $database->getConnection();

$usuarios = [
    'juan@example.com' => 'usuario1',
    'pedro@example.com' => 'usuario2',
    'andres@example.com' => 'usuario3'
];

foreach ($usuarios as $email => $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $updateStmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
        $updateStmt->execute([$hashed_password, $user['id']]);

        echo "Contraseña actualizada para el usuario con email: $email<br>";
    } else {
        echo "Usuario no encontrado con email: $email<br>";
    }
}

echo "Proceso completado.";
?>
