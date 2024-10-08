<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('homeModel');
        if (! $this->session->userdata('logged_in')) {
            header('location:' . base_url());
            exit;
        }
    }

    public function index()
    {
        $generos = $this->homeModel->getGeneros();
        $canPrestamos = $this->homeModel->getPrestamos();
        $autoresPopulares = $this->homeModel->getAutoresPopulares();
        $librosAntiguos = $this->homeModel->getLibrosAntiguos();
        $librosMasPrestados = $this->homeModel->getLibrosMasprestados();
        $promedioAntiguedad = $this->homeModel->getPromedioAntiguedad();
        $totalLibrosDisponibles = $this->homeModel->getTotalLibrosDisponibles();
        $arrayData = array(
            'genero' => $generos,
            'prestamo' => $canPrestamos,
            'autores' => $autoresPopulares,
            'libros' => $librosAntiguos,
            'librosMasPrestados' => $librosMasPrestados,
            'promedioAntiguedad' => $promedioAntiguedad,
            'totalLibrosDisponibles' => $totalLibrosDisponibles
        );
        $this->load->view('header');
        $this->load->view('homevista', $arrayData);
    }

    public function buscarLibro(){
        $genero = $this->input->post('litagenero');

        $listaGenero = $this->homeModel->getListaGenero($genero);

        $tbody = '';
        if(! empty($listaGenero)){
            foreach ($listaGenero as $key) {
            $tbody.= '<tr>
            <td>'.$key->nombre.'</td>
            </tr>';
            }
        }
        echo json_encode($tbody);
    }
}
