<?php

namespace App\Controllers;

use App\Models\LibroModel;

class Libros extends Mycontroller
{
    protected $session;
    protected $libroModel;

    public function __construct()
    {
        $this->session = session();
        $this->libroModel = new LibroModel();
    }

    public function index()
    {
        $data['libros'] = $this->libroModel->findAll();
        return view('header') . view('libros', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRule('titulo', 'Título', 'required');
        $validation->setRule('autor', 'Autor', 'required');
        $validation->setRule('genero', 'Género', 'required');
        $validation->setRule('anio', 'Año', 'required|valid_date');
        $validation->setRule('cantidad', 'Cantidad', 'required|numeric');

        if (!$validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('error', 'Error en la validación. Verifica los campos.');
            return redirect()->to('/libros');
        }

        $data = [
            'nombre_libro' => $this->request->getPost('titulo'),
            'genero' => $this->request->getPost('genero'),
            'fecha_publicacion' => $this->request->getPost('anio'),
            'copias_libro' => $this->request->getPost('cantidad'),
        ];

        if ($this->libroModel->insert($data)) {
            $this->session->setFlashdata('success', 'Libro creado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'Hubo un problema al crear el libro.');
        }

        return redirect()->to('/libros');
    }

    public function edit()
    {
        $id = $this->request->getPost('id_libro');
        $data = [
            'nombre_libro' => $this->request->getPost('titulo'),
            'genero' => $this->request->getPost('genero'),
            'fecha_publicacion' => $this->request->getPost('fecha_publicacion'),
            'copias_libro' => $this->request->getPost('copias_libro'),
        ];

        if ($this->libroModel->update($id, $data)) {
            $this->session->setFlashdata('success', 'Libro actualizado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'Hubo un problema al actualizar el libro.');
        }

        return redirect()->to('/libros');
    }

    public function delete()
    {
        $id = $this->request->getPost('id_libro');
        if ($this->libroModel->delete($id)) {
            $this->session->setFlashdata('success', 'Libro eliminado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'Hubo un problema al eliminar el libro.');
        }

        return redirect()->to('/libros');
    }

    public function cargaMasiva()
    {
        if ($this->request->getFile('excel_file')) {
            $file = $this->request->getFile('excel_file');
            $filePath = $file->getTempName();

            if ($xlsx = SimpleXLSX::parse($filePath)) {
                $rows = $xlsx->rows();

                foreach ($rows as $row) {
                    $this->libroModel->insert([
                        'nombre_libro' => $row[0],
                        'genero' => $row[1],
                        'fecha_publicacion' => $row[2],
                        'copias_libro' => $row[3],
                    ]);
                }
                $this->session->setFlashdata('success', 'Carga masiva completada con éxito.');
            } else {
                $this->session->setFlashdata('error', 'No se pudo procesar el archivo.');
            }
        } else {
            $this->session->setFlashdata('error', 'No se subió ningún archivo.');
        }

        return redirect()->to('/libros');
    }
}
