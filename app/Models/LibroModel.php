<?php

namespace App\Models;

use CodeIgniter\Model;

class LibroModel extends Model
{
    protected $table = 'libro';
    protected $primaryKey = 'id_libro';
    protected $allowedFields = ['nombre_libro', 'genero', 'fecha_publicacion', 'copias_libro']; // Actualiza según tus columnas
    protected $useTimestamps = false; // Si usas timestamps (created_at, updated_at), cambia a true

    // Obtener todos los libros
    public function getAllLibros()
    {
        return $this->orderBy('id_libro', 'DESC')->findAll();
    }

    // Obtener un libro específico
    public function getLibro($id)
    {
        return $this->find($id);
    }

    // Insertar un nuevo libro
    public function insertLibro($data)
    {
        return $this->insert($data);
    }

    // Actualizar un libro existente
    public function updateLibro($id, $data)
    {
        return $this->update($id, $data);
    }

    // Eliminar un libro
    public function deleteLibro($id)
    {
        return $this->delete($id);
    }

    // Obtener libros disponibles
    public function getLibrosDisponibles()
    {
        return $this->where('disponible', 1)->findAll();
    }
}
