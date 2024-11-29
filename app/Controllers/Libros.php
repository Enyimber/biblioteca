<?php

namespace App\Controllers;

use App\Models\LibroModel;

class Libros extends MyController
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
        $data['libros'] = $this->libroModel->getAllLibros();
        return view('header') . view('libros', $data);
    }

    public function create()
    {
        // Validaciones
        $validation = \Config\Services::validation();
        $validation->setRules([
            'titulo' => 'required',
            'autor' => 'required',
            'genero' => 'required',
            'anio' => 'required|valid_date[Y-m-d]',
            'cantidad' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Validación fallida
            $this->session->setFlashdata('error', implode('<br>', $validation->getErrors()));
            return redirect()->to(base_url('libros'))->withInput();
        }

        // Insertar datos
        $data = [
            'nombre_libro' => $this->request->getPost('titulo'),
            'genero' => $this->request->getPost('genero'),
            'fecha_publicacion' => $this->request->getPost('anio'),
            'copias_libro' => $this->request->getPost('cantidad')
        ];

        if ($this->libroModel->insert($data)) {
            $this->session->setFlashdata('success', 'Libro creado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'Error al crear el libro.');
        }

        return redirect()->to(base_url('libros'));
    }

    public function edit()
    {
        $id = $this->request->getPost('id_libro');
        if (!$id) {
            $this->session->setFlashdata('error', 'No se proporcionó un ID válido para actualizar.');
            return redirect()->to(base_url('libros'));
        }

        // Validaciones
        $validation = \Config\Services::validation();
        $validation->setRules([
            'titulo' => 'required',
            'genero' => 'required',
            'fecha_publicacion' => 'required|valid_date[Y-m-d]',
            'copias_libro' => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('error', implode('<br>', $validation->getErrors()));
            return redirect()->to(base_url('libros'))->withInput();
        }

        // Actualizar datos
        $data = [
            'nombre_libro' => $this->request->getPost('titulo'),
            'genero' => $this->request->getPost('genero'),
            'fecha_publicacion' => $this->request->getPost('fecha_publicacion'),
            'copias_libro' => $this->request->getPost('copias_libro'),
        ];

        if ($this->libroModel->update($id, $data)) {
            $this->session->setFlashdata('success', 'Libro actualizado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'Error al actualizar el libro.');
        }

        return redirect()->to(base_url('libros'));
    }
    public function delete()
    {
        $id = $this->request->getPost('id_libro');
        if ($this->libroModel->delete($id)) {
            $this->session->setFlashdata('success', 'Libro eliminado con éxito.');
        } else {
            $this->session->setFlashdata('error', 'Hubo un problema al eliminar el libro.');
        }

        return redirect()->to('libros');
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

        return redirect()->to('libros');
    }
}
