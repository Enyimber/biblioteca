<?php
class LoginModel extends CI_Model {

    public function validarUsuario($usuario, $clave) {
        // Consulta en la base de datos para verificar el usuario y la contraseña
        $this->db->where('usuario', $usuario);
        $this->db->where('clave', md5($clave)); // md5 o alguna función de encriptación que uses
        $query = $this->db->get('usuarios');

        if ($query->num_rows() == 1) {
            return $query->row(); // Usuario encontrado
        } else {
            return false; // Usuario no encontrado
        }
    }
}
