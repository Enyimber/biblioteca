<div class="container mt-5">
    <h2>Lista de Libros</h2>

    <!-- Botón para Crear Nuevo Libro -->
    <?php if (session()->get('id_usuario') == 1) : ?>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalLibros">
        Crear Nuevo Libro
    </button>
    <?php endif;?>
    <!-- Tabla de libros -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Género</th>
                <th>Año de Publicación</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($libros)) : ?>
                <?php foreach ($libros as $libro) : ?>
                    <tr>
                        <td><?php echo $libro['id_libro']; ?></td>
                        <td><?php echo $libro['nombre_libro']; ?></td>
                        <td><?php echo $libro['genero']; ?></td>
                        <td><?php echo $libro['fecha_publicacion']; ?></td>
                        <td><?php echo $libro['copias_libro']; ?></td>
                        <?php if (session()->get('id_usuario') == 1) : ?>
                            <td>
                                <!-- Botón para Editar -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditarLibro"
                                    onclick="cargarDatosLibro('<?php echo $libro['id_libro']; ?>', '<?php echo $libro['nombre_libro']; ?>', '<?php echo $libro['genero']; ?>', '<?php echo $libro['fecha_publicacion']; ?>', '<?php echo $libro['copias_libro']; ?>')">
                                    Editar
                                </button>

                                <!-- Botón para Eliminar (opcional) -->
                                <form action="<?php echo base_url('libros/delete'); ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="id_libro" value="<?php echo $libro['id_libro']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        <?php else : ?>
                            <td>
                                <form action="<?php echo base_url('prestamos/insertSolicitud'); ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="insertSolicitud"
                                        value="<?php echo session()->get('id_usuario'); ?>|<?php echo $libro['id_libro']; ?>|">
                                    <button type="submit" class="btn btn-warning btn-sm">solicitar</button>
                                </form>
                                </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">No hay libros disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- Modal Crear Libro -->
<div class="modal fade" id="modalLibros" tabindex="-1" role="dialog" aria-labelledby="modalLibrosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLibrosLabel">Gestión de Libros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="librosTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="crear-tab" data-toggle="tab" href="#crear" role="tab" aria-controls="crear" aria-selected="true">Crear Libro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="masiva-tab" data-toggle="tab" href="#masiva" role="tab" aria-controls="masiva" aria-selected="false">Carga Masiva</a>
                    </li>
                </ul>
                <div class="tab-content" id="librosTabContent">
                    <!-- Pestaña Crear Libro -->
                    <div class="tab-pane fade show active" id="crear" role="tabpanel" aria-labelledby="crear-tab">
                        <form action="<?php echo base_url('libros/create'); ?>" method="post">
                            <div class="form-group mt-3">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" name="titulo" placeholder="Ingresa el título del libro" required>
                            </div>
                            <div class="form-group">
                                <label for="autor">Autor</label>
                                <input type="text" class="form-control" name="autor" placeholder="Ingresa el autor" required>
                            </div>
                            <div class="form-group">
                                <label for="genero">Género</label>
                                <input type="text" class="form-control" name="genero" placeholder="Ingresa el género" required>
                            </div>
                            <div class="form-group">
                                <label for="anio">Año de Publicación</label>
                                <input type="date" class="form-control" name="anio" placeholder="Ingresa el año de publicación" required>
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" placeholder="Cantidad disponible" required>
                            </div>
                            <button type="submit" class="btn btn-success">Crear Libro</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                    <!-- Pestaña Carga Masiva -->
                    <div class="tab-pane fade" id="masiva" role="tabpanel" aria-labelledby="masiva-tab">
                        <form action="<?php echo base_url('libros/cargar_masiva'); ?>" method="post" enctype="multipart/form-data" class="mt-3">
                            <div class="form-group">
                                <label for="archivo">Subir Archivo Excel</label>
                                <input type="file" class="form-control" name="archivo" accept=".xlsx, .xls, .csv" required>
                                <small class="form-text text-muted">Sube un archivo con los libros. Formatos permitidos: .xlsx, .xls, .csv</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Cargar Libros</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar Libro -->
<div class="modal fade" id="modalEditarLibro" tabindex="-1" role="dialog" aria-labelledby="modalEditarLibroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLibroLabel">Editar Libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('libros/edit'); ?>" method="post">
                    <!-- Campo oculto para el ID del libro -->
                    <input type="hidden" id="id_libro" name="id_libro">

                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresa el título del libro" required>
                    </div>

                    <div class="form-group">
                        <label for="genero">Género</label>
                        <input type="text" class="form-control" id="genero" name="genero" placeholder="Ingresa el género" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_publicacion">Año de Publicación</label>
                        <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" placeholder="Año de publicación" required>
                    </div>

                    <div class="form-group">
                        <label for="copias_libro">Cantidad</label>
                        <input type="number" class="form-control" id="copias_libro" name="copias_libro" placeholder="Cantidad disponible" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Función para cargar datos en el modal
    function cargarDatosLibro(id, titulo, genero, fecha, cantidad) {
        document.getElementById('id_libro').value = id;
        document.getElementById('titulo').value = titulo;
        document.getElementById('genero').value = genero;
        document.getElementById('fecha_publicacion').value = fecha;
        document.getElementById('copias_libro').value = cantidad;
    }
</script>
<?= $this->include('footer') ?>