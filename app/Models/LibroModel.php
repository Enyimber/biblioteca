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
        $builder = $this->db->table($this->table);
        $builder->select('libro.id_libro, libro.nombre_libro,libro.genero,libro.fecha_publicacion,libro.copias_libro,autor.nombre_autor');
        $builder->join('autor_libro', 'autor_libro.id_libro = libro.id_libro');
        $builder->join('autor', 'autor.id_autor = autor_libro.id_autor');
        $query = $builder->get();

        return $query->getResultArray();
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
