<div class="container mt-5">
    <h2>Lista de Préstamos</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha de Préstamo</th>
                <th>Fecha de Devolución</th>
                <?php if (session()->get('id_usuario') == 1): ?>
                    <th>Acciones</th>
                <?php else: ?>
                    <th>Estado</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamos as $prestamo): ?>
                <tr>
                    <td><?php echo $prestamo['id_prestamo']; ?></td>
                    <td><?php echo $prestamo['nombre_usuario']; ?></td>
                    <td><?php echo $prestamo['nombre_libro']; ?></td>
                    <td><?php echo $prestamo['fecha_hora']; ?></td>
                    <td><?php echo $prestamo['fecha_hora_entrega']; ?></td>
                    <?php if (session()->get('id_usuario') == 1): ?>
                        <td>
                            <a href="<?php echo base_url('prestamos/editar/'.$prestamo['id_prestamo']); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="<?php echo base_url('prestamos/eliminar/'.$prestamo['id_prestamo']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este préstamo?');">Eliminar</a>
                        </td>
                    <?php else:?>
                        <td>
                        
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?= $this->include('footer') ?>