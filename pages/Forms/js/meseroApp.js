var app = angular.module('meseroApp', ['directivas']);
app.controller('meseroController', function($scope, $http) {
    $scope.id_sucursal = null;
    $scope.nombre = null;
    $scope.id_mesero = null;
    $scope.mesero = [];


 $scope.empresa = [];
    $http.post("../../DataAccess/Servicios/empresa/ServiceSelectAllempresa.php")
        .success(function(data) {
            $scope.empresa = data;
        })
        .error(function(error) {})


    $scope.OnChangeEmpresa = function(data) {
        $scope.id_empresa = data.id_empresa;
        var parametros = {
            id_empresa: data.id_empresa
        }
        $scope.sucursal = [];
        $http.post("../../DataAccess/Servicios/sucursal/ServiceSelectsucursalbyempresa.php", parametros)
            .success(function(data) {
                $scope.sucursal = data;
            })
            .error(function(error) {})

    }



    $http.post("../../DataAccess/Servicios/mesero/ServiceSelectAllmesero.php")
        .success(function(data) {
            $scope.mesero = data;
        })
        .error(function(error) {})
    $scope.Guardar = function() {
        if (true) {

            if ($scope.id_mesero == null) {
                var parametros = {
                    id_sucursal: $scope.id_sucursal.id_sucursal,
                    nombre: $scope.nombre,
                    id_mesero: $scope.id_mesero
                }
                $http.post("../../DataAccess/Servicios/mesero/ServiceInsertmesero.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.id_sucursal = null;
                        $scope.nombre = null;
                        $scope.id_mesero = null;
                        $http.post("../../DataAccess/Servicios/mesero/ServiceSelectAllmesero.php")
                            .success(function(data) {
                                $scope.mesero = data;
                            })

                    })
                    .error(function(error) {

                    })
            } else {
                var parametros = {
                    id_sucursal: $scope.id_sucursal,
                    nombre: $scope.nombre,
                    id_mesero: $scope.id_mesero
                }
                $http.post("../../DataAccess/Servicios/mesero/ServiceUpdatemesero.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.id_sucursal = null;
                        $scope.nombre = null;
                        $scope.id_mesero = null;
                        $http.post("../../DataAccess/Servicios/mesero/ServiceSelectAllmesero.php")
                            .success(function(data) {
                                $scope.mesero = data;
                            })

                    })

            }
        }
    }
    $scope.Editar = function(data) {
        $scope.id_sucursal = data.id_sucursal;
        $scope.nombre = data.nombre;
        $scope.id_mesero = data.id_mesero;
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
                id_mesero: data.id_mesero
            }
            $http.post("../../DataAccess/Servicios/mesero/ServiceDeletemesero.php", parametros)
                .success(function(data) {
                    swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                    ActualizarContenido();
                });

        })




    }

    function ActualizarContenido() {

        $http.post("../../DataAccess/Servicios/mesero/ServiceSelectAllmesero.php")
            .success(function(data) {
                $scope.mesero = data;
            })
            .error(function(error) {})

    }
});