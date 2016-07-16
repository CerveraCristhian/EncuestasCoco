var app = angular.module('sucursalApp', ['directivas']);
app.controller('sucursalController', function ($scope, $http) {
    $scope.id_empresa = null;
    $scope.nombre = null;
    $scope.direccion = null;
    $scope.telefono = null;
    $scope.contacto = null;
    $scope.paquete = null;
    $scope.email = null;
    $scope.id_sucursal = null;
    $scope.sucursal = [];

    $scope.paquetes = [{
        id: 1,
        label: 'Paquete 1'
    }, {
            id: 2,
            label: 'Paquete 2',

        }];

    $http.post("../../DataAccess/Servicios/sucursal/ServiceSelectAllsucursal.php")
        .success(function (data) {
            $scope.sucursal = data;
        })
        .error(function (error) { })

    $scope.empresa = [];
    $http.post("../../DataAccess/Servicios/empresa/ServiceSelectAllempresa.php")
        .success(function (data) {
            $scope.empresa = data;
        })
        .error(function (error) { })


    $scope.Guardar = function () {
        if (true) {

            if ($scope.id_sucursal == null) {
                var parametros = {
                    id_empresa: $scope.empresaSelected.id_empresa,
                    nombre: $scope.nombre,
                    direccion: $scope.direccion,
                    telefono: $scope.telefono,
                    contacto: $scope.contacto,
                    paquete: $scope.paquete.id,
                    email: $scope.email,
                    id_sucursal: $scope.id_sucursal,
                    password: $scope.password
                }
                $http.post("../../DataAccess/Servicios/sucursal/ServiceInsertsucursal.php", parametros)
                    .success(function (data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.id_empresa = null;
                        $scope.nombre = null;
                        $scope.direccion = null;
                        $scope.telefono = null;
                        $scope.contacto = null;
                        $scope.paquete = null;
                        $scope.email = null;
                        $scope.id_sucursal = null;
                        $http.post("../../DataAccess/Servicios/sucursal/ServiceSelectAllsucursal.php")
                            .success(function (data) {
                                $scope.sucursal = data;
                            })

                    })
                    .error(function (error) {

                    })
            } else {
                var parametros = {
                    id_empresa: $scope.id_empresa,
                    nombre: $scope.nombre,
                    direccion: $scope.direccion,
                    telefono: $scope.telefono,
                    contacto: $scope.contacto,
                    paquete: $scope.paquete.id,
                    email: $scope.email,
                    id_sucursal: $scope.id_sucursal,
                    password : $scope.password
                }
                $http.post("../../DataAccess/Servicios/sucursal/ServiceUpdatesucursal.php", parametros)
                    .success(function (data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.id_empresa = null;
                        $scope.nombre = null;
                        $scope.direccion = null;
                        $scope.telefono = null;
                        $scope.contacto = null;
                        $scope.paquete = null;
                        $scope.email = null;
                        $scope.id_sucursal = null;
                        $http.post("../../DataAccess/Servicios/sucursal/ServiceSelectAllsucursal.php")
                            .success(function (data) {
                                $scope.sucursal = data;
                            })

                    })

            }
        }
    }
    $scope.Editar = function (data) {
        $scope.id_empresa = data.id_empresa;
        $scope.nombre = data.nombre;
        $scope.direccion = data.direccion;
        $scope.telefono = data.telefono;
        $scope.contacto = data.contacto;
        $scope.paquete = data.paquete;
        $scope.email = data.email;
        $scope.id_sucursal = data.id_sucursal;
    }
    $scope.EliminarSeleccionado = function (data) {
        swal({
            title: "¿Desea eliminar el elemento seleccionado?",
            text: "¡El registro se eliminara permanentemente!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, ¡Eliminar!",
            closeOnConfirm: false
        }, function () {

            var parametros = {
                id_sucursal: data.id_sucursal
            }
            $http.post("../../DataAccess/Servicios/sucursal/ServiceDeletesucursal.php", parametros)
                .success(function (data) {
                    swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                    ActualizarContenido();
                });

        })




    }

    function ActualizarContenido() {

        $http.post("../../DataAccess/Servicios/sucursal/ServiceSelectAllsucursal.php")
            .success(function (data) {
                $scope.sucursal = data;
            })
            .error(function (error) { })

    }
});