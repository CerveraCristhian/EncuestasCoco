var app = angular.module('empresaApp', ['directivas']);
app.controller('empresaController', function($scope, $http) {
    $scope.nombre = null;
    $scope.id_empresa = null;
    $scope.empresa = [];
    $http.post("../../DataAccess/Servicios/empresa/ServiceSelectAllempresa.php")
        .success(function(data) {
            $scope.empresa = data;
        })
        .error(function(error) {})
    $scope.Guardar = function() {
        if (true) {

            if ($scope.id_empresa == null) {
                var parametros = {
                    nombre: $scope.nombre,
                    id_empresa: $scope.id_empresa
                }
                $http.post("../../DataAccess/Servicios/empresa/ServiceInsertempresa.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.nombre = null;
                        $scope.id_empresa = null;
                        $http.post("../../DataAccess/Servicios/empresa/ServiceSelectAllempresa.php")
                            .success(function(data) {
                                $scope.empresa = data;
                            })

                    })
                    .error(function(error) {

                    })
            } else {
                var parametros = {
                    nombre: $scope.nombre,
                    id_empresa: $scope.id_empresa
                }
                $http.post("../../DataAccess/Servicios/empresa/ServiceUpdateempresa.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.nombre = null;
                        $scope.id_empresa = null;
                        $http.post("../../DataAccess/Servicios/empresa/ServiceSelectAllempresa.php")
                            .success(function(data) {
                                $scope.empresa = data;
                            })

                    })

            }
        }
    }
    $scope.Editar = function(data) {
        $scope.nombre = data.nombre;
        $scope.id_empresa = data.id_empresa;
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
                id_empresa: data.id_empresa
            }
            $http.post("../../DataAccess/Servicios/empresa/ServiceDeleteempresa.php", parametros)
                .success(function(data) {
                    swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                    ActualizarContenido();
                });

        })




    }

    function ActualizarContenido() {

        $http.post("../../DataAccess/Servicios/empresa/ServiceSelectAllempresa.php")
            .success(function(data) {
                $scope.empresa = data;
            })
            .error(function(error) {})

    }
});