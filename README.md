# Biblioteca API

Este proyecto es una API REST para gestionar un sistema de biblioteca. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los recursos de libros y usuarios.

## Características

- **Libros**:
  - `GET /libros`: Devuelve una lista de todos los libros.
  - `POST /libros`: Añade un nuevo libro (campos: `titulo`, `autor`, `genero`, `anio_publicacion`).
  - `PUT /libros/:id`: Actualiza la información de un libro existente.
  - `DELETE /libros/:id`: Elimina un libro.

- **Usuarios**:
  - `GET /usuarios`: Devuelve una lista de todos los usuarios.
  - `POST /usuarios`: Añade un nuevo usuario (campos: `nombre`, `email`, `edad`).
  - `DELETE /usuarios/:id`: Elimina un usuario.

- **Autenticación**:
  - Las rutas protegidas (`PUT` y `DELETE`) requieren un token JWT.

## Requisitos previos

- PHP 7.4+.
- Servidor web (Apache o similar).
- MySQL y phpMyAdmin para gestionar la base de datos.
- Composer (para dependencias, si es necesario).

## Configuración

### 1. Configurar la base de datos
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
    edad INT NOT NULL
);
