<?php
include_once('../../config/sesiones.php');
$rol_id = $_SESSION['rol_id'];
if (isset($_SESSION["em_id"])) {
    $_SESSION["ruta"] = "Cliente";

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

                    <div class="container-fluid">

                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-4">

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Clientes Registrados</h6>
                                        <button id="botonNuevoCliente" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalCliente">Nuevo Cliente</button>
                                    </div>
                                    <div class="card-body">
                                        <!-- BUSCADOR -->

                                        <div class="form-group">

                                            <div class="input-group">
                                                <input type="text" name="buscarInput" id="buscarInput" placeholder="Busqueda por Cedula o Apellido" class="form-control" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" onclick="busqueda()">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END BUSCADOR -->

                                        <table class="table table-bordered table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cédula</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Fecha nacimiento</th>
                                                    <th>Genero</th>
                                                    <th>Altura (Metros)</th>
                                                    <th>Peso (KG)</th>
                                                    <th>Teléfono</th>
                                                    <th>Direccion</th>
                                                    <th>Correo</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id='TablaCliente'></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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



        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloModalCliente">Nuevo Cliente</h5>
                        <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <form id="Clientes_form">
                        <div class="modal-body">
                            <input type="hidden" name="cliente_id" id="cliente_id">

                            <div class="form-group">
                                <label for="cli_cedula" class="control-label">Cedula</label>
                                <input type="text" name="cli_cedula" id="cli_cedula" class="form-control" required>
                                <small id="cedulaError" class="text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label for="cli_nombre" class="control-label">Nombres</label>
                                <input type="text" name="cli_nombre" id="cli_nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="cli_apellido" class="control-label">Apellidos</label>
                                <input type="text" name="cli_apellido" id="cli_apellido" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="cli_fecha_nacimiento" class="control-label">Fecha nacimiento</label>
                                <input type="date" name="cli_fecha_nacimiento" id="cli_fecha_nacimiento" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="cli_genero" class="control-label">Género</label>
                                <select name="cli_genero" id="cli_genero" class="form-control" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="cli_altura" class="control-label">Altura (Metros)</label>
                                <input type="text" name="cli_altura" id="cli_altura" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="cli_peso" class="control-label">Peso (KG)</label>
                                <input type="text" name="cli_peso" id="cli_peso" class="form-control" pattern="[0-9]+(\.[0-9]+)?" minlength="1" maxlength="10" required>
                            </div>

                            <div class="form-group">
                                <label for="cli_telefono" class="control-label">Telefono</label>
                                <input type="text" name="cli_telefono" id="cli_telefono" class="form-control" numeros: pattern="[0-9]+" minlength="10" maxlength="10" required>
                            </div>

                            <div class="form-group">
                                <label for="cli_direccion" class="control-label">Direccion</label>
                                <input type="text" name="cli_direccion" id="cli_direccion" class="form-control" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                            </div>
                            <div class="form-group">
                                <label for="cli_correo" class="control-label">Correo</label>
                                <input type="mail" name="cli_correo" id="cli_correo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cli_contrasena" class="control-label">Contraseña</label>
                                <div class="password-container">
                                    <input type="password" name="cli_contrasena" id="cli_contrasena" class="form-control" required>
                                    <img src="https://static.vecteezy.com/system/resources/previews/002/101/686/large_2x/eye-icon-look-and-vision-symbol-eye-logo-design-inspiration-free-vector.jpg" alt="Imagen de contraseña" id="togglePassword">
                                </div>
                                <div id="mensaje_contrasena"></div>
                            </div>
                            <input type="hidden" name="id_empleado" id="id_empleado" value="">
                        </div>
                        <div class="modal-footer">

                           
                            <button id="guardarbtn" class='btn btn-success'>guardar</button>
                          

                            <button type="button" class="btn btn-secondary" onclick="limpiar()" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!--scripts-->
        <?php include_once('../html/scripts.php')  ?>
        <script src="./cliente.js"></script>
        




        <script>
            function busqueda() {
                var buscar = document.getElementById("buscarInput").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("TablaCliente").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "cliente.busqueda.php?buscar=" + buscar, true);
                xmlhttp.send();
            }
        </script>
        <script>
            const passwordInput2 = document.getElementById('cli_contrasena');
            const togglePassword = document.getElementById('togglePassword');
            const messageElement2 = document.getElementById('mensaje_contrasena');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePassword.textContent = type === 'password' ? 'Mostrar contraseña' : 'Ocultar contraseña';
            });


            passwordInput.addEventListener('input', function() {
                // Código de validación de contraseña (como se mostró en la respuesta anterior)
            });
        </script>

        <script>
            const passwordInput = document.getElementById('cli_contrasena');
            const messageElement = document.getElementById('mensaje_contrasena');

            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const regexLowerCase = /[a-z]/;
                const regexUpperCase = /[A-Z]/;
                const regexNumbers = /[0-9]/;
                const regexSpecialChars = /[!@#$%^&*()_+[\]{};':"\\|,.<>/?-]/;

                let message = '';
                if (password.length > 1) {
                    if (!regexLowerCase.test(password) || !regexUpperCase.test(password) || !regexNumbers.test(password) ||
                        !regexSpecialChars.test(password) || password.length < 8) {
                        message += 'La contraseña debe tener minimo 8 caracteres, un caracter especial y una letra mayúscula.<br>';
                    }
                } else if (password.length < 1) {
                    message += '';
                }



                messageElement.innerHTML = message === '' ? '' : '<div style="color:red">' + message + '</div>';
            });
        </script>
        <script>
            // Obtén el valor de $_SESSION['em_id'] y asígnalo a la variable idEmpleado
            var idEmpleado = "<?php echo isset($_SESSION['em_id']) ? $_SESSION['em_id'] : ''; ?>";

            // Asigna el valor de idEmpleado al input oculto
            document.getElementById('id_empleado').value = idEmpleado;
        </script>

        <script>
            /*-------------------------------------------------------------solo letras------------------------------------*/
            // Función para bloquear la entrada de números en un campo de texto
            function blockNumbersInput(inputElement) {
                inputElement.addEventListener('keydown', (event) => {
                    // Obtener el código de la tecla pulsada
                    const keyCode = event.which || event.keyCode;

                    // Permitir las teclas de control (por ejemplo, las teclas de flecha, retroceso, etc.)
                    if (event.ctrlKey || event.altKey || event.metaKey || keyCode === 8 || keyCode === 9) {
                        return;
                    }

                    // Bloquear la entrada si la tecla es un número (códigos de teclas del 0 al 9 y teclado numérico)
                    if ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105)) {
                        event.preventDefault();
                    }
                });
            }

            // Obtener la referencia a los elementos de entrada de nombres y apellidos
            const nombreInputElement = document.getElementById('cli_nombre');
            const apellidoInputElement = document.getElementById('cli_apellido');

            // Aplicar la restricción de no permitir números en ambos campos
            blockNumbersInput(nombreInputElement);
            blockNumbersInput(apellidoInputElement);


            /*-------------------------------------------------------------solo numeross------------------------------------*/

            // Función para bloquear la entrada que no sea números en un campo de texto
            function blockNonNumbersInput(inputElement) {
                inputElement.addEventListener('keydown', (event) => {
                    // Obtener el código de la tecla pulsada
                    const keyCode = event.which || event.keyCode;

                    // Permitir las teclas de control (por ejemplo, las teclas de flecha, retroceso, etc.)
                    if (event.ctrlKey || event.altKey || event.metaKey || keyCode === 8 || keyCode === 9) {
                        return;
                    }

                    // Bloquear la entrada si la tecla no es un número (códigos de teclas del 0 al 9 y teclado numérico)
                    if (!((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105))) {
                        event.preventDefault();
                    }
                });
            }

            // Obtener la referencia a los elementos de entrada de nombres y apellidos
            const telefonoInputElement = document.getElementById('cli_telefono');
            const pesoInputElement = document.getElementById('cli_peso');


            // Aplicar la restricción de solo permitir números en ambos campos
            blockNonNumbersInput(telefonoInputElement);
            blockNonNumbersInput(pesoInputElement);



            /*-------------------------------------------------------------solo numeros y Punto------------------------------------*/

            // Función para bloquear la entrada que no sean números y puntos en un campo de texto
            function blockNonNumbersAndDecimalInput(inputElement) {
                inputElement.addEventListener('keydown', (event) => {
                    // Obtener el código de la tecla pulsada
                    const keyCode = event.which || event.keyCode;

                    // Permitir las teclas de control (por ejemplo, las teclas de flecha, retroceso, etc.)
                    if (event.ctrlKey || event.altKey || event.metaKey || keyCode === 8 || keyCode === 9) {
                        return;
                    }

                    // Permitir números y el punto decimal (códigos de teclas del 0 al 9, teclado numérico y el punto)
                    if (
                        (keyCode >= 48 && keyCode <= 57) || // Números desde el teclado principal
                        (keyCode >= 96 && keyCode <= 105) || // Números desde el teclado numérico
                        keyCode === 110 || keyCode === 190 // Punto decimal (tanto el punto como el numpad decimal)
                    ) {
                        // Verificar que no haya más de un punto decimal en el campo
                        if ((keyCode === 110 || keyCode === 190) && inputElement.value.includes('.')) {
                            event.preventDefault();
                        }
                    } else {
                        event.preventDefault();
                    }
                });
            }

            // Obtener la referencia a los elementos de entrada de nombres y apellidos
            const alturaInputElement = document.getElementById('cli_altura');

            // Aplicar la restricción de solo permitir números y puntos en ambos campos
            blockNonNumbersAndDecimalInput(alturaInputElement);


            /*-------------------------------------------------------------FIN------------------------------------*/



            var cedulaInput = document.getElementById("cli_cedula");
            var cedulaError = document.getElementById("cedulaError");
            var btnGuardar = document.getElementById("btnGuardar");

            cedulaInput.addEventListener("blur", validarCedula);

            function validarCedula() {
                var cedula = cedulaInput.value;

                if (esCedulaValida(cedula) && esCedulaProvinciaEcuador(cedula) && validarAlgoritmoCedula(cedula)) {
                    cedulaError.textContent = "";
                    btnGuardar.disabled = false;
                } else {
                    cedulaError.textContent = "La cédula no es válida";
                    btnGuardar.disabled = true;
                }
            }

            function esCedulaValida(cedula) {
                // Validación básica de longitud y formato numérico
                if (cedula.length !== 10 || !/^\d{10}$/.test(cedula)) {
                    return false;
                }
                return true;
            }

            function esCedulaProvinciaEcuador(cedula) {
                // Obtener el código de provincia
                var provincia = parseInt(cedula.substr(0, 2));

                // Verificar si la provincia está en el rango de provincias de Ecuador
                if (provincia >= 1 && provincia <= 24) {
                    return true;
                } else {
                    return false;
                }
            }

            function validarAlgoritmoCedula(cedula) {
                var total = 0;
                var coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
                var digitoVerificador = parseInt(cedula.substring(9, 10));

                for (var i = 0; i < 9; i++) {
                    var digito = parseInt(cedula.substring(i, i + 1));
                    var resultado = digito * coeficientes[i];
                    if (resultado > 9) {
                        resultado -= 9;
                    }
                    total += resultado;
                }

                var residuo = total % 10;
                var resultadoFinal = residuo === 0 ? 0 : 10 - residuo;

                return resultadoFinal === digitoVerificador;
            }
        </script>




    </body>

    </html>

<?php
} else {
    header("Location:../../index.php");
}
?>