<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $DBGroup = 'default'; // Asegúrate de que esté configurado correctamente en `app/config/Database.php`
    
    // Obtener géneros y la cantidad de libros por género
    public function getGeneros()
    {
        return $this->db->table('libro')
            ->select('genero, SUM(copias_libro) as cantidad_libros')
            ->groupBy('genero')
            ->get()
            ->getResult();
    }

    // Obtener la cantidad de préstamos pendientes (no entregados)
    public function getPrestamos()
    {
        return $this->db->table('prestamo')
            ->select('COUNT(*) as prestamos')
            ->where('fecha_hora_entrega IS NULL')
            ->get()
            ->getRow();
    }

    // Obtener los autores más populares
    public function getAutoresPopulares()
    {
        return $this->db->table('prestamo pe')
            ->select('au.nombre_autor, COUNT(l.id_libro) as libro')
            ->join('libro l', 'pe.id_libro = l.id_libro')
            ->join('autor_libro al', 'l.id_libro = al.id_libro')
            ->join('autor au', 'al.id_autor = au.id_autor')
            ->groupBy('au.nombre_autor')
            ->orderBy('libro', 'DESC')
            ->limit(2)
            ->get()
            ->getResult();
    }

    // Obtener los libros más antiguos
    public function getLibrosAntiguos()
    {
        return $this->db->table('libro')
            ->select('nombre_libro, fecha_publicacion')
            ->orderBy('fecha_publicacion', 'ASC')
            ->limit(2)
            ->get()
            ->getResult();
    }

    // Obtener los libros más prestados
    public function getLibrosMasprestados()
    {
        return $this->db->table('prestamo pe')
            ->select('l.nombre_libro, COUNT(pe.id_prestamo) as prestamos')
            ->join('libro l', 'l.id_libro = pe.id_libro', 'inner')
            ->groupBy('l.nombre_libro')
            ->orderBy('prestamos', 'DESC')
            ->limit(2)
            ->get()
            ->getResult();
    }

    // Obtener el promedio de antigüedad
    public function getPromedioAntiguedad()
    {
        return $this->db->query('SELECT * FROM promedio()')
            ->getRow();
    }

    // Obtener el total de libros disponibles
    public function getTotalLibrosDisponibles()
    {
        return $this->db->query('SELECT * FROM libros_disponibles();')
            ->getRow();
    }

    // Obtener libros disponibles por género
    public function getListaGenero($genero)
    {
        return $this->db->query("SELECT * FROM libros_disponibles_genero('$genero');")
            ->getResult();
    }

    // Obtener todos los autores
    public function getAutores()
    {
        return $this->db->table('autor')
            ->get()
            ->getResult();
    }

    // Obtener libros por autor y rango de años
    public function getLibrosAutor($autor, $anInicial, $anFinal)
    {
        return $this->db->query("SELECT * FROM libros_autor('$autor', $anInicial, $anFinal);")
            ->getResult();
    }

    // Obtener los libros menos prestados
    public function getLibrosMenosPrestados()
    {
        return $this->db->query('SELECT * FROM libros_menos_prestados();')
            ->getResult();
    }
}
