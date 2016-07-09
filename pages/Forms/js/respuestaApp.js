var app = angular.module('respuestaApp', []);
app.controller('respuestaController', function ($scope, $http) {
    $scope.id_pregunta = null;
    $scope.descripcion = null;
    $scope.id_respuesta = null;
    $scope.respuesta = [];
    $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php")
        .success(function (data) {
            $scope.respuesta = data;
        })
        .error(function (error) { })
    $scope.Guardar = function () {
        if (true) {

            if ($scope.id_respuesta == null) {
                var parametros = {
                    id_pregunta: $scope.id_pregunta
                    ,
                    descripcion: $scope.descripcion
                    ,
                    id_respuesta: $scope.id_respuesta
                }
                $http.post("../../DataAccess/Servicios/respuesta/ServiceInsertrespuesta.php", parametros)
                    .success(function (data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.id_pregunta = null;
                        $scope.descripcion = null;
                        $scope.id_respuesta = null;
                        $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php")
                            .success(function (data) {
                                $scope.respuesta = data;
                            })

                    })
                    .error(function (error) {

                    })
            }
            else {
                var parametros = {
                    id_pregunta: $scope.id_pregunta
                    ,
                    descripcion: $scope.descripcion
                    ,
                    id_respuesta: $scope.id_respuesta
                }
                $http.post("../../DataAccess/Servicios/respuesta/ServiceUpdaterespuesta.php", parametros)
                    .success(function (data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.id_pregunta = null;
                        $scope.descripcion = null;
                        $scope.id_respuesta = null;
                        $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php")
                            .success(function (data) {
                                $scope.respuesta = data;
                            })

                    })

            }
        }
    }
    $scope.Editar = function (data) {
        $scope.id_pregunta = data.id_pregunta;
        $scope.descripcion = data.descripcion;
        $scope.id_respuesta = data.id_respuesta;
    }
    $scope.EliminarSeleccionado = function (data) {
        swal({
            title: "¿Desea eliminar el elemento seleccionado?", text: "¡El registro se eliminara permanentemente!",
            type: "warning", showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "Si, ¡Eliminar!",
            closeOnConfirm: false
        }, function () {

            var parametros = {
                id_respuesta: data.id_respuesta
            }
            $http.post("../../DataAccess/Servicios/respuesta/ServiceDeleterespuesta.php", parametros)
                .success(function (data) {
                    swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                    ActualizarContenido();
                });

        })




    }
    function ActualizarContenido() {

        $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php")
            .success(function (data) {
                $scope.respuesta = data;
            })
            .error(function (error) {
            })

    }
});
