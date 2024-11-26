<?php

namespace App\Controllers;

use App\Models\PrestamosModel;
use App\Models\HomeModel;

class Home extends MyController
{
    protected $prestamosModel;
    protected $homeModel;

    public function __construct()
    {
        // Cargar los modelos
        $this->prestamosModel = new PrestamosModel();
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        $session = session();

        if ($session->get('id_rol') != 1) {
            $id_usuario = $session->get('id_usuario');
            $data['prestamos'] = $this->prestamosModel->obtenerPrestamosPorUsuario($id_usuario);
            return view('header') . view('prestamosVista', $data);
        } else {
            // Obtener los datos desde el modelo
            $generos = $this->homeModel->getGeneros();
            $canPrestamos = $this->homeModel->getPrestamos();
            $autoresPopulares = $this->homeModel->getAutoresPopulares();
            $librosAntiguos = $this->homeModel->getLibrosAntiguos();
            $librosMasPrestados = $this->homeModel->getLibrosMasprestados();
            $promedioAntiguedad = $this->homeModel->getPromedioAntiguedad();
            $totalLibrosDisponibles = $this->homeModel->getTotalLibrosDisponibles();
            $autor = $this->homeModel->getAutores();
            $librosMenosPrestados = $this->homeModel->getLibrosMenosPrestados();

            $arrayData = [
                'genero' => $generos,
                'prestamo' => $canPrestamos,
                'autores' => $autoresPopulares,
                'libros' => $librosAntiguos,
                'librosMasPrestados' => $librosMasPrestados,
                'promedioAntiguedad' => $promedioAntiguedad,
                'totalLibrosDisponibles' => $totalLibrosDisponibles,
                'autor' => $autor,
                'librosMenosPrestados' => $librosMenosPrestados
            ];

            return view('header') . view('homevista', $arrayData);
        }
    }

    public function buscarLibro()
    {
        $genero = $this->request->getPost('litagenero');
        $listaGenero = $this->homeModel->getListaGenero($genero);

        $tbody = '';
        if (!empty($listaGenero)) {
            foreach ($listaGenero as $key) {
                $tbody .= '<tr>
                    <td>' . esc($key->nombre) . '</td>
                </tr>';
            }
        }
        $data=array('tbody'=>$tbody);

        return $this->response->setJSON($data);
    }

    public function buscarLibrosAutor()
    {
        $autor = $this->request->getPost('autor');
        $anoInicial = $this->request->getPost('anoInicial');
        $anoFinal = $this->request->getPost('anoFinal');

        $lista = $this->homeModel->getLibrosAutor($autor, $anoInicial, $anoFinal);

        $tbody = '';
        if (!empty($lista)) {
            foreach ($lista as $key) {
                $tbody .= '<tr>
                    <td>' . esc($key->nombre) . '</td>
                </tr>';
            }
        } else {
            $tbody = '<tr><td>No hay resultados.</td></tr>';
        }
        $data=array('tbody'=>$tbody);
        return $this->response->setJSON($data);
    }
}

