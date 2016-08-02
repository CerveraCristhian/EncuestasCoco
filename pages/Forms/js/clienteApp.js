var app = angular.module('clienteApp', []);
app.controller('clienteController', function($scope, $http) {
    $scope.email = null;
    $scope.pass = null;
    $scope.nombre = null;
    $scope.apellido_paterno = null;
    $scope.apellido_materno = null;
    $scope.fecha_nacimiento = null;
    $scope.sucursalid = null;
    $scope.monedero = null;
    $scope.id_cliente = null;
    $scope.cliente = [];
    $http.post("../../DataAccess/Servicios/cliente/ServiceSelectAllcliente.php")
        .success(function(data) {
            $scope.cliente = data;
        })
        .error(function(error) {})
    $scope.Guardar = function() {
        if (true) {

            if ($scope.id_cliente == null) {
                var parametros = {
                    email: $scope.email,
                    pass: $scope.pass,
                    nombre: $scope.nombre,
                    apellido_paterno: $scope.apellido_paterno,
                    apellido_materno: $scope.apellido_materno,
                    fecha_nacimiento: $scope.fecha_nacimiento,
                    sucursalid: $scope.sucursalid,
                    monedero: $scope.monedero,
                    id_cliente: $scope.id_cliente
                }
                $http.post("../../DataAccess/Servicios/cliente/ServiceInsertcliente.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.email = null;
                        $scope.pass = null;
                        $scope.nombre = null;
                        $scope.apellido_paterno = null;
                        $scope.apellido_materno = null;
                        $scope.fecha_nacimiento = null;
                        $scope.sucursalid = null;
                        $scope.monedero = null;
                        $scope.id_cliente = null;
                        $http.post("../../DataAccess/Servicios/cliente/ServiceSelectAllcliente.php")
                            .success(function(data) {
                                $scope.cliente = data;
                            })

                    })
                    .error(function(error) {

                    })
            } else {
                var parametros = {
                    email: $scope.email,
                    pass: $scope.pass,
                    nombre: $scope.nombre,
                    apellido_paterno: $scope.apellido_paterno,
                    apellido_materno: $scope.apellido_materno,
                    fecha_nacimiento: $scope.fecha_nacimiento,
                    sucursalid: $scope.sucursalid,
                    monedero: $scope.monedero,
                    id_cliente: $scope.id_cliente
                }
                $http.post("../../DataAccess/Servicios/cliente/ServiceUpdatecliente.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.email = null;
                        $scope.pass = null;
                        $scope.nombre = null;
                        $scope.apellido_paterno = null;
                        $scope.apellido_materno = null;
                        $scope.fecha_nacimiento = null;
                        $scope.sucursalid = null;
                        $scope.monedero = null;
                        $scope.id_cliente = null;
                        $http.post("../../DataAccess/Servicios/cliente/ServiceSelectAllcliente.php")
                            .success(function(data) {
                                $scope.cliente = data;
                            })

                    })

            }
        }
    }
    $scope.Editar = function(data) {
        $scope.email = data.email;
        $scope.pass = data.pass;
        $scope.nombre = data.nombre;
        $scope.apellido_paterno = data.apellido_paterno;
        $scope.apellido_materno = data.apellido_materno;
        $scope.fecha_nacimiento = data.fecha_nacimiento;
        $scope.sucursalid = data.sucursalid;
        $scope.monedero = data.monedero;
        $scope.id_cliente = data.id_cliente;
    }
    $scope.EliminarSeleccionado = function(data) {
        swal({
            title: "¿Desea eliminar el elemento seleccionado?",
            text: "¡El registro se eliminara permanentemente!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, ¡Eliminar!",
            closeOnConfirm: false
        }, function() {

            var parametros = {
                id_cliente: data.id_cliente
            }
            $http.post("../../DataAccess/Servicios/cliente/ServiceDeletecliente.php", parametros)
                .success(function(data) {
                    swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                    ActualizarContenido();
                });

        })




    }

    function ActualizarContenido() {

        $http.post("../../DataAccess/Servicios/cliente/ServiceSelectAllcliente.php")
            .success(function(data) {
                $scope.cliente = data;
            })
            .error(function(error) {})

    }
});