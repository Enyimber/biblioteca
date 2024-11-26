<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login/consultarUsuario', 'Login::consultarUsuario');
$routes->get('login/logout', 'Login::logout');

$routes->get('home', 'Home::index'); 
$routes->post('home/buscarLibrosAutor', 'Home::buscarLibrosAutor');
$routes->post('home/buscarLibro', 'Home::buscarLibro');

$routes->get('libros', 'Libros::index');
$routes->post('libros/delete', 'Libros::delete');
$routes->post('libros/create', 'Libros::create');
$routes->post('libros/edit', 'Libros::edit');

$routes->get('prestamos', 'Prestamos::index');
$routes->post('prestamos/insertSolicitud', 'Prestamos::insertSolicitud');

$routes->get('usuarios', 'Usuarios::index');
$routes->post('usuarios/eliminar', 'Usuarios::eliminar');
$routes->post('usuarios/editar', 'Usuarios::editar');
$routes->post('usuarios/crear', 'Usuarios::crear');
