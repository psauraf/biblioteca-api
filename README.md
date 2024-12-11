# Biblioteca API

Este proyecto es una API REST para gestionar un sistema de biblioteca. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los recursos de libros y usuarios.

---

## Características

### **Libros**:

- `GET /libros`: Devuelve una lista de todos los libros.
- `POST /libros`: Añade un nuevo libro.
  - **Campos requeridos**: `titulo`, `autor`, `genero`, `anio_publicacion`.
- `PUT /libros/:id`: Actualiza la información de un libro existente.
  - **Campos opcionales**: `titulo`, `autor`, `genero`, `anio_publicacion`.
- `DELETE /libros/:id`: Elimina un libro.

### **Usuarios**:

- `GET /usuarios`: Devuelve una lista de todos los usuarios.
- `POST /usuarios`: Añade un nuevo usuario.
  - **Campos requeridos**: `nombre`, `email`, `edad`, `password` (encriptada).
- `DELETE /usuarios/:id`: Elimina un usuario.

### **Autenticación**:

- **Login**:
  - `POST /login`: Permite a los usuarios autenticarse proporcionando un `email` y `password`.
- **Protección de rutas**:
  - Las rutas protegidas (`PUT` y `DELETE`) solo están accesibles tras iniciar sesión.

---

## Requisitos previos

- **PHP 7.4+**.
- **Servidor web**: Apache o similar.
- **Base de datos**: MySQL y phpMyAdmin para gestionar la base de datos.
- **Composer**: Para dependencias, si es necesario.
- **Herramientas para probar la API**: Postman o cURL.

---

## Configuración

### **1. Configurar la base de datos**

1. Crea una base de datos llamada `biblioteca` en phpMyAdmin.
2. Ejecuta el siguiente script SQL para crear las tablas:

```sql
CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    anio_publicacion YEAR NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    edad INT NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

3. Inserta datos de prueba en las tablas:

```sql
INSERT INTO usuarios (nombre, email, edad, password) VALUES
('Juan Perez', 'juan@example.com', 30, '$2y$10$...'),
('Pedro Gomez', 'pedro@example.com', 25, '$2y$10$...'),
('Andres Martinez', 'andres@example.com', 28, '$2y$10$...');

INSERT INTO libros (titulo, autor, genero, anio_publicacion) VALUES
('1984', 'George Orwell', 'Ficción', 1949),
('El Principito', 'Antoine de Saint-Exupéry', 'Ficción', 1943),
('Cien Años de Soledad', 'Gabriel García Márquez', 'Realismo Mágico', 1967);
```

### **2. Configurar el proyecto**

1. Coloca los archivos del proyecto en el directorio `htdocs` de tu servidor web.
2. Configura el archivo `db.php` con las credenciales de tu base de datos:

```php
<?php
class Database {
    private $host = "localhost";
    private $db_name = "biblioteca";
    private $username = "root";
    private $password = ""; // Ajusta según tu configuración
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error en la conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
```

### **3. Probar el proyecto**

1. Abre Postman y prueba los endpoints descritos en la sección de **Características**.
2. Accede al formulario de login a través de `http://localhost/login.php`.
3. Una vez autenticado, accede al dashboard (`biblioteca.php`) para ver los libros.

---

## Endpoints de la API

### **Libros**

| Método | Endpoint     | Descripción                  |
| ------ | ------------ | ---------------------------- |
| GET    | /libros      | Devuelve todos los libros    |
| POST   | /libros      | Crea un nuevo libro          |
| PUT    | /libros/{id} | Actualiza un libro existente |
| DELETE | /libros/{id} | Elimina un libro por su ID   |

#### **Ejemplo de respuesta para ****`GET /libros`**:

```json
[
  {
    "id": 1,
    "titulo": "1984",
    "autor": "George Orwell",
    "genero": "Ficción",
    "anio_publicacion": 1949
  }
]
```

### **Usuarios**

| Método | Endpoint       | Descripción                  |
| ------ | -------------- | ---------------------------- |
| GET    | /usuarios      | Devuelve todos los usuarios  |
| POST   | /usuarios      | Crea un nuevo usuario        |
| DELETE | /usuarios/{id} | Elimina un usuario por su ID |

---

## Futuras mejoras

1. Implementar un sistema de autenticación con JWT para proteger mejor las rutas.
2. Añadir filtros avanzados para las búsquedas en los endpoints de libros.
3. Crear validaciones avanzadas para los datos enviados a la API.
4. Implementar un frontend visual con frameworks modernos (por ejemplo, React o Vue.js).

---

## Créditos

Desarrollado por Pedro Saura. Inspirado en el entorno de desarrollo para la empresa Cuatroochenta.

