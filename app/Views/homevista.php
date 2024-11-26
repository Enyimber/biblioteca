<div class="container-fluid">
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Cantidad de libros por genero:
                                <select name="generos" id="generos" class="form-control">
                                    <?php foreach ($genero as $key) {
                                        echo '<option value="' . $key->cantidad_libros . '">' . $key->genero . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div id="canGeneros" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Cantidad de prestamos activos:
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php print_r($prestamo->prestamos) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Autores mas populares:
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <ul>
                                            <?php foreach ($autores as $key) {
                                                echo "<li>$key->nombre_autor</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Libros mas antiguos:
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <ul>
                                    <?php foreach ($libros as $key) {
                                        echo "<li>$key->nombre_libro</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Libros mas prestados:
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <ul>
                                    <?php foreach ($librosMasPrestados as $key) {
                                        echo "<li>$key->nombre_libro</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Promedio de antiguedad de los libros:
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php print_r($promedioAntiguedad->promedio) ?> Años</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total de libros disponibles:
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php print_r($totalLibrosDisponibles->libros_disponibles) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow" style="height: 450PX">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Libros disponibles</h6>
                </div>
                <div class="card-body card-scrollable">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="listageneros" class="form-label">Seleccionar Género</label>
                            <select name="listageneros" id="listageneros" class="form-control form-control-sm custom-select custom-select-sm w-75">
                                <?php foreach ($genero as $key): ?>
                                    <option value="<?php echo htmlspecialchars($key->genero); ?>"><?php echo htmlspecialchars($key->genero); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <table id="lista" class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Libro</th>
                                    </tr>
                                </thead>
                                <tbody id="lisTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5 ">
            <div class="card shadow mb-4" style="height: 450PX">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Libros de cada autor</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="listaAutores">Autores:</label>
                            <select name="listaAutores" id="listaAutores" class="form-control form-control-sm custom-select custom-select-sm w-75">
                                <?php foreach ($autor as $key): ?>
                                    <option value="<?php echo htmlspecialchars($key->nombre_autor); ?>"><?php echo htmlspecialchars($key->nombre_autor); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="anoInicial">Año Inicial:</label>
                                <input type="number" name="anoInicial" id="anoInicial" class="form-control form-control-sm" value = "1880">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="anoFinal">Año Final:</label>
                                <input type="number" name="anoFinal" id="anoFinal" class="form-control form-control-sm" value = "2024" >
                            </div>
                            <div class="form-group col-md-4">
                                <label class="d-block">&nbsp;</label>
                                <button onclick="cargarLibrosPorRango();" class="btn btn-info btn-sm btn-block">Consultar</button>
                            </div>
                        </div>
                        <div>
                            <table id="lista_fun3" class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Libro</th>
                                    </tr>
                                </thead>
                                <tbody id="lisTbody_fn3">
                                    <!-- Los libros se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12  col-lg-20">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Libros pocos prestados</h6>
                </div>
                <div class="card-body card-scrollable">
                    <div class="mb-3">
                        <table id="lista_fun4" class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Libro</th>
                                    <th scope="col">Género</th>
                                    <th scope="col">Copias</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($librosMenosPrestados as $key): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($key->nombre); ?></td>
                                        <td><?php echo htmlspecialchars($key->genero); ?></td>
                                        <td><?php echo htmlspecialchars($key->copias); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const base_url = "<?= base_url() ?>";
</script>
<script src="<?= base_url('plantilla/js/dasboard.js') ?>"></script>
<?= $this->include('footer') ?>