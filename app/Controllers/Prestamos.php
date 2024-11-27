<?php

namespace App\Controllers;

use App\Models\PrestamosModel;
use App\Models\UsuarioModel;
use App\Models\LibroModel;
use App\Models\NotificacionesModel;

class Prestamos extends MyController
{
    protected $prestamosModel;
    protected $usuarioModel;
    protected $libroModel;
    protected $session;
    protected $notificacionesModel;

    public function __construct()
    {
        $this->prestamosModel = new PrestamosModel();
        $this->notificacionesModel = new NotificacionesModel();
        $this->usuarioModel = new UsuarioModel();
        $this->libroModel = new LibroModel();
        $this->session = session();
        helper(['form', 'url']);
    }

    // Mostrar lista de préstamos
    public function index()
    {
        $data['prestamos'] = $this->prestamosModel->getPrestamos();
        return view('header') . view('prestamosVista', $data);
    }

    // Mostrar formulario para crear préstamo
    public function crear()
    {
        $data['usuarios'] = $this->usuarioModel->getUsuarios();
        $data['libros'] = $this->libroModel->getLibrosDisponibles();
        return view('prestamos/crear', $data);
    }

    // Procesar la creación del préstamo
    public function registrar()
    {
        if (!$this->validate([
            'usuario' => 'required',
            'libro' => 'required',
            'fecha_prestamo' => 'required',
            'fecha_devolucion' => 'required',
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = [
            'id_usuario' => $this->request->getPost('usuario'),
            'id_libro' => $this->request->getPost('libro'),
            'fecha_prestamo' => $this->request->getPost('fecha_prestamo'),
            'fecha_devolucion' => $this->request->getPost('fecha_devolucion'),
        ];

        $this->prestamosModel->save($data);
        return redirect()->to('prestamos')->with('success', 'Préstamo registrado con éxito.');
    }

    // Mostrar formulario para editar un préstamo
    public function editar($id)
    {
        $prestamo = $this->prestamosModel->find($id);

        if (!$prestamo) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Préstamo no encontrado.");
        }

        $data = [
            'usuarios' => $this->usuarioModel->getUsuarios(),
            'libros' => $this->libroModel->getLibrosDisponibles(),
            'prestamo' => $prestamo,
        ];

        return view('prestamos/editar', $data);
    }

    // Procesar la actualización de un préstamo
    public function actualizar($id)
    {
        if (!$this->validate([
            'usuario' => 'required',
            'libro' => 'required',
            'fecha_prestamo' => 'required',
            'fecha_devolucion' => 'required',
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = [
            'id' => $id,
            'id_usuario' => $this->request->getPost('usuario'),
            'id_libro' => $this->request->getPost('libro'),
            'fecha_prestamo' => $this->request->getPost('fecha_prestamo'),
            'fecha_devolucion' => $this->request->getPost('fecha_devolucion'),
        ];

        $this->prestamosModel->save($data);
        return redirect()->to('/prestamos')->with('success', 'Préstamo actualizado con éxito.');
    }

    // Eliminar un préstamo
    public function eliminar($id)
    {
        $this->prestamosModel->delete($id);
        return redirect()->to('/prestamos')->with('success', 'Préstamo eliminado con éxito.');
    }

    // Insertar solicitud
    public function insertSolicitud()
    {
        // Obtenemos los datos del formulario
        $data = $this->request->getPost('insertSolicitud'); // Suponiendo que la información viene en un solo campo

        // Dividimos los datos usando un delimitador
        list($id_usuario, $id_libro) = explode('|', $data); // Asumimos que $data contiene "id_usuario|id_libro"

        // Creamos el array para insertar
        $solicitud = [
            'id_usuario' => $id_usuario,
            'id_libro' => $id_libro,
            // La columna fecha_solicitud ya tiene un valor predeterminado, no es necesario incluirla
        ];

        // Inserta la solicitud en la base de datos
        $this->prestamosModel->insertSolicitud($solicitud);

        // Verificamos si la inserción fue exitosa
        if ($this->prestamosModel->db->affectedRows() > 0) {
            return redirect()->to('/libros')->with('success', 'Solicitud registrada correctamente.');
        } else {
            return redirect()->to('/libros')->with('error', 'Hubo un problema al registrar la solicitud.');
        }
    }

    // Método para enviar notificación a los administradores por WebSocket
    public function enviarNotificacionWebSocket($id_usuario, $id_libro)
    {
        // Lógica para enviar la notificación a través de WebSocket
        // Aquí llamamos al método que enviará el mensaje a los administradores
        $this->notificacionesModel->enviarNotificacion($id_usuario, $id_libro);
    }
}
