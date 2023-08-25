<?php
include_once('../../config/sesiones.php');
if (isset($_SESSION["em_id"])) {
    $_SESSION["ruta"] = "Control Recibos";
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once('../html/head.php')  ?>
    </head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <?php require_once('../html/menu.php') ?>
            <!-- End of Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- Topbar -->
                    <?php include_once('../html/header.php')  ?>
                    <!-- End of Topbar -->
                    <div class="container-fluid position-relative  mt-5" style="margin-bottom: 90px;">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lista de Membresias Expiradas</h6>
                                <button onclick="cargaselect()" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalfactura"> Comprar Membresia</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Datos Cliente</th>
                                            <th>Fecha</th>
                                            <th>Membresia</th>
                                            <th>Monto "$"</th>
                                            <th>voucher de pago</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id='TablaFactura'></tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal fade" id="modalfactura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tituloModalFactura">Nueva <?php echo $_SESSION["ruta"] ?></h5>
                                <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="Recibo_form">
                                <div class="modal-body">
                                    <input type="hidden" name="id_recibo" id="id_recibo">
                                    <div class="form-group">
                                        <label for="cli_id" class="control-label">Cedula Cliente</label>
                                        <select name="cli_id" id="cli_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fa_fecha" class="control-label">Fecha</label>
                                        <input type="date" name="fa_fecha" id="fa_fecha" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="men_id" class="control-label">Membresia</label>
                                        <select onchange="calcularvalor(this)" name="men_id" id="men_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                <label for="men_fecha_inicio" class="control-label">Fecha Inicio</label>
                                <input type="datetime-local" name="men_fecha_inicio" id="men_fecha_inicio" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="men_fecha_fin" class="control-label">Fecha Fin</label>
                                <input type="datetime-local" name="men_fecha_fin" id="men_fecha_fin" class="form-control" required>
                            </div>
                                    <div class="form-group">
                                        <label for="fa_montol_total" class="control-label">Valor a Pagar "$"</label>
                                        <input type="text" name="fa_montol_total" id="fa_montol_total" class="form-control" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="men_estado" class="control-label">Estado</label>
                                        <select name="estado" id="estado" class="form-control" required>
                                            <option value="Activo">Activo</option>
                                            <option value="Pendiente">Pendiente</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Imagen de Categoria</label>
                                        <input type="file" name="imagen" id="imagen" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" onclick="guardarDatos()">Guardar</button>
                                    <button type="button" class="btn btn-secondary" onclick="limpiar()" data-dismiss="modal">Cerrar</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="imageModal" class="modal">
                <div class="modal-content" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                    <img id="modalImage" src="" alt="Imagen" style="max-width: 100%; max-height: 80vh;">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModal()" data-dismiss="modal">Cerrar Imagen</button>
                </div>
            </div>


        </div>
        <!-- Footer -->
        <?php include_once('../html/footer.php') ?>
        <!-- End of Footer -->
        </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>



        <!--scripts-->
        <?php include_once('../html/scripts.php')  ?>
        <script src="./recibom.js"></script>
        <script>
    function guardarDatos() {
        // Obtener los valores de los campos del formulario
        var cli_id = $("#cli_id").val();
        var men_id = $("#men_id").val();
        var men_fecha_inicio = $("#men_fecha_inicio").val();
        var men_fecha_fin = $("#men_fecha_fin").val();
        var estado = $("#estado").val();

        // Realizar una solicitud AJAX para ejecutar el archivo PHP
        $.ajax({
            type: "POST",
            url: "./recibom.membresia.php",
            data: {
                cli_id: cli_id,
                men_id: men_id,
                men_fecha_inicio: men_fecha_inicio,
                men_fecha_fin: men_fecha_fin,
                estado: estado
            },
            success: function(response) {
                // Manejar la respuesta del archivo PHP si es necesario
                console.log(response);
            }
        });

        // Luego, puedes continuar con tu lógica de JavaScript
        // ...
    }
</script>

        <script>
            function busqueda() {
                var buscar = document.getElementById("buscarInput").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("TablaMembresia").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "Membresias.busqueda.php?buscar=" + buscar, true);
                xmlhttp.send();
            }
        </script>

    </body>

    </html>

<?php
} else {
    header("Location:../../index.php");
}
?>