<?php

class HomeModel extends CI_Model
{

    public function getGeneros()
    {
        $this->db->select('genero, SUM(copias_libro) as cantidad_libros');
        $this->db->from('libro');
        $this->db->group_by('genero');
        $query = $this->db->get();

        return  $query->result();
    }

    public function getPrestamos()
    {
        $this->db->select('COUNT(*) as prestamos');
        $this->db->from('prestamo');
        $this->db->where('fecha_hora_entrega IS NULL');
        $query = $this->db->get();

        return $query->row();
    }

    public function getAutoresPopulares()
    {
        $this->db->select('au.nombre_autor, COUNT(l.id_libro) as libro');
        $this->db->from('prestamo pe');
        $this->db->join('libro l', 'pe.id_libro = l.id_libro');
        $this->db->join('autor_libro al', 'l.id_libro = al.id_libro');
        $this->db->join('autor au', 'al.id_autor = au.id_autor');
        $this->db->group_by('au.nombre_autor');
        $this->db->order_by('libro', 'DESC');
        $this->db->limit(2);
        $query = $this->db->get();

        return $query->result();
    }

    public function getLibrosAntiguos()
    {
        $this->db->select('nombre_libro, fecha_publicacion');
        $this->db->from('libro');
        $this->db->order_by('fecha_publicacion', 'ASC');
        $this->db->limit(2);
        $query = $this->db->get();

        return $query->result();
    }

    public function getLibrosMasprestados()
    {
        $this->db->select('l.nombre_libro, COUNT(pe.id_prestamo) as prestamos');
        $this->db->from('prestamo pe');
        $this->db->join('libro l', 'l.id_libro = pe.id_libro', 'inner');
        $this->db->group_by('l.nombre_libro');
        $this->db->order_by('prestamos', 'DESC');
        $this->db->limit(2);
        $query = $this->db->get();

        return $query->result();
    }

    public function getPromedioAntiguedad()
    {
        $query = $this->db->query('SELECT * FROM promedio()');
        return  $query->row();
    }

    public function getTotalLibrosDisponibles()
    {
        $query = $this->db->query('SELECT * FROM libros_disponibles();');
        return  $query->row();
    }
    public function getListaGenero($genero)
    {
        $query = $this->db->query('SELECT * FROM libros_disponibles_genero(\''.$genero.'\');');
        return  $query->result();
    }
}
