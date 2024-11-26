<div class="container-fluid">
    <div class="container">
        <h2>Usuarios</h2>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalUsuarios">
            Crear Usuario
        </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>usuario</th>
                    <th>clave</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?php echo $usuario['id_usuario']; ?></td>
                        <td><?php echo $usuario['nombre_usuario']; ?></td>
                        <td><?php echo $usuario['usuario_login']; ?></td>
                        <td><?php echo $usuario['clave']; ?></td>
                        <td><?php echo $usuario['id_rol']; ?></td>
                        <td>
                            <button
                                class="btn btn-warning btn-sm btn-editar"
                                data-id="<?php echo $usuario['id_usuario']; ?>"
                                data-clave="<?php echo $usuario['clave']; ?>"
                                data-rol="<?php echo $usuario['id_rol']; ?>"
                                data-toggle="modal"
                                data-target="#modalEditarUsuario">
                                Editar
                            </button>

                            <form action="<?php echo base_url('usuarios/eliminar'); ?>" method="post" style="display:inline;">
                                <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal crear-->
<div class="modal fade" id="modalUsuarios" tabindex="-1" role="dialog" aria-labelledby="modalUsuariosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUsuariosLabel">Gestión de Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="usuariosTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="crear-tab" data-toggle="tab" href="#crear" role="tab" aria-controls="crear" aria-selected="true">Crear Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="masiva-tab" data-toggle="tab" href="#masiva" role="tab" aria-controls="masiva" aria-selected="false">Cargar Masiva</a>
                    </li>
                </ul>
                <div class="tab-content" id="usuariosTabContent">
                    <!-- Pestaña Crear Usuario -->
                    <div class="tab-pane fade show active" id="crear" role="tabpanel" aria-labelledby="crear-tab">
                        <form action="<?php echo base_url('usuarios/crear'); ?>" method="post">
                            <div class="form-group mt-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Ingresa el usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="clave">Clave</label>
                                <input type="password" class="form-control" name="clave" placeholder="Ingresa el clave" required>
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select name="rol" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="3">Estudiante</option>
                                    <option value="2">Profesor</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Crear Usuario</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                    <!-- Pestaña Carga Masiva -->
                    <div class="tab-pane fade" id="masiva" role="tabpanel" aria-labelledby="masiva-tab">
                        <form action="<?php echo base_url('usuarios/cargar_masiva'); ?>" method="post" enctype="multipart/form-data" class="mt-3">
                            <div class="form-group">
                                <label for="archivo">Subir Archivo Excel</label>
                                <input type="file" class="form-control" name="archivo" accept=".xlsx, .xls, .csv" required>
                                <small class="form-text text-muted">Sube un archivo con los usuarios. Formatos permitidos: .xlsx, .xls, .csv</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Cargar Usuarios</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditarUsuario" method="post" action="<?php echo base_url('usuarios/editar'); ?>">
                <div class="modal-body">
                    <!-- Campo oculto para ID del usuario -->
                    <input type="hidden" name="id_usuario" id="editar-id-usuario">

                    <!-- Campo para editar clave -->
                    <div class="form-group">
                        <label for="editar-clave">Clave</label>
                        <input type="password" class="form-control" name="clave" id="editar-clave" placeholder="Nueva clave" required>
                    </div>

                    <!-- Campo para editar rol -->
                    <div class="form-group">
                        <label for="editar-rol">Rol</label>
                        <select class="form-control" name="rol" id="editar-rol" required>
                            <option value="1">Admin</option>
                            <option value="2">Profesor</option>
                            <option value="3">Estudiante</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Escuchar clics en los botones "Editar"
    document.querySelectorAll('.btn-editar').forEach(function (button) {
        button.addEventListener('click', function () {
            // Obtener datos del usuario desde los atributos del botón
            const userId = this.getAttribute('data-id');
            const userClave = this.getAttribute('data-clave');
            const userRol = this.getAttribute('data-rol');

            // Rellenar los campos del modal con los datos del usuario
            document.getElementById('editar-id-usuario').value = userId;
            document.getElementById('editar-clave').value = userClave;
            document.getElementById('editar-rol').value = userRol;
        });
    });
});
</script>
<?= $this->include('footer') ?>