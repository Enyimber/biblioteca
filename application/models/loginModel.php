<?php

class LoginModel extends CI_Model{

    public function validarUsuario($usuario, $clave) {
        $this->db->where('usuario_login', $usuario);
        $this->db->where('clave', $clave);
        $query = $this->db->get('usuario');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

}
