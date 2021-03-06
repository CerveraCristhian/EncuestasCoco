var app = angular.module('encuestaApp', ['directivas', 'textAngular']);
app.controller('encuestaController', function($scope, $http) {
    $scope.id_sucursal = null;
    $scope.estatus = null;
    $scope.fecha_activacion = null;
    $scope.porcentaje = null;
    $scope.fecha_finalizacion = null;
    $scope.id_encuesta = null;
    $scope.encuesta = [];
    $scope.descripcionrespuesta = null;
    ObtenerRecompensas();
    InicializacionComponentes();
    $scope.recompensaSelected = undefined;
    document.getElementById("porcentaje").disabled = true;
    document.getElementById("cmbRecompensa").disabled = true;
    document.getElementById("topemaximo").disabled = true;

    function ObtenerRecompensas() {
        var parametros = {
            method: 'selectrecompensas'
        }
        $http.post("../../Commun/commun.php", parametros)
            .success(function(data) {
                $scope.recompensas = data;
            })
            .error(function(error) {})

    }

    $http.post("../../DataAccess/Servicios/encuesta/ServiceSelectAllencuesta.php")
        .success(function(data) {
            $scope.encuesta = data;

        })
        .error(function(error) {})



    $scope.ActivarEncuesta = function(data) {
        $scope.encuestaid = data.id_encuesta;
        if (data.estatus == 0) {
            var parametros = {
                id_sucursal: data.id_sucursal
            }
            $scope.sucursal = [];
            $http.post("../../DataAccess/Servicios/encuesta/ServiceValidarEncuesta.php", parametros)
                .success(function(data) {
                    if (data.estado == '1') {
                        sweetAlert("Oops...", "Ya cuentas con una encuesta activa!", "error");
                    } else {
                        var parametros = {
                            id_encuesta: $scope.encuestaid
                        }
                        $scope.sucursal = [];
                        $http.post("../../DataAccess/Servicios/encuesta/ServiceActivarEncuesta.php", parametros)
                            .success(function(data) {
                                if (data.estado == '1') {
                                    swal("¡Encuesta desactivada!", "¡Tu encuesta se activado!", "success")
                                    $http.post("../../DataAccess/Servicios/encuesta/ServiceSelectAllencuesta.php")
                                        .success(function(data) {
                                            $scope.encuesta = data;
                                        })
                                }

                            })
                            .error(function(error) {})


                    }

                })
                .error(function(error) {})
        } else {


            swal({
                title: "¿Estas seguro de desactivar la encuesta?",
                text: "¡La encuesta se desactivara!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Desactivar",
                closeOnConfirm: false
            }, function() {

                var parametros = {
                    id_encuesta: data.id_encuesta
                }
                $scope.sucursal = [];
                $http.post("../../DataAccess/Servicios/encuesta/ServiceDesactivarEncuesta.php", parametros)
                    .success(function(data) {
                        if (data.estado == '1') {
                            swal("¡Encuesta desactivada!", "¡Tu encuesta se ha desactivado!", "success")
                            $http.post("../../DataAccess/Servicios/encuesta/ServiceSelectAllencuesta.php")
                                .success(function(data) {
                                    $scope.encuesta = data;
                                })
                        }

                    })
                    .error(function(error) {})


            });




        }


    }
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
    $scope.Guardar = function() {
        if (true) {
            var recompensaid = null;
            if ($scope.recompensaSelected != undefined) {
                recompensaid = $scope.recompensaSelected.id_recompensa;
            }
            if ($scope.id_encuesta == null) {
                var parametros = {
                    estatus: 0,
                    fecha_activacion: $scope.fecha_activacion,
                    porcentaje: $scope.porcentaje,
                    fecha_finalizacion: $scope.fecha_finalizacion,
                    id_encuesta: $scope.id_encuesta,
                    id_recompensa: recompensaid,
                    emailenvio: $scope.emailenvio,
                    bienvenida: $scope.bienvenida,
                    despedida: $scope.despedida,
                    disculpa: $scope.disculpa,
                    topemaximo: $scope.topemaximo
                }
                $http.post("../../DataAccess/Servicios/encuesta/ServiceInsertencuesta.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.id_sucursal = null;
                        $scope.estatus = null;
                        $scope.fecha_activacion = null;
                        $scope.porcentaje = null;
                        $scope.fecha_finalizacion = null;
                        $scope.id_encuesta = null;
                        $scope.emailenvio = null;
                        $scope.bienvenida = null;
                        $scope.despedida = null;
                        $scope.disculpa = null;
                        $scope.topemaximo = null;
                        $http.post("../../DataAccess/Servicios/encuesta/ServiceSelectAllencuesta.php")
                            .success(function(data) {
                                $scope.encuesta = data;
                            })

                    })
                    .error(function(error) {

                    })
            } else {
                var parametros = {
                    estatus: $scope.estatus,
                    fecha_activacion: $scope.fecha_activacion,
                    porcentaje: $scope.porcentaje,
                    fecha_finalizacion: $scope.fecha_finalizacion,
                    id_encuesta: $scope.id_encuesta,
                    emailenvio: $scope.emailenvio,
                    bienvenida: $scope.bienvenida,
                    despedida: $scope.despedida,
                    disculpa: $scope.disculpa

                }
                $http.post("../../DataAccess/Servicios/encuesta/ServiceUpdateencuesta.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.id_sucursal = null;
                        $scope.estatus = null;
                        $scope.fecha_activacion = null;
                        $scope.porcentaje = null;
                        $scope.fecha_finalizacion = null;
                        $scope.id_encuesta = null;
                        $scope.emailenvio = null;
                        $scope.bienvenida = null;
                        $scope.despedida = null;
                        $scope.disculpa = null;
                        $http.post("../../DataAccess/Servicios/encuesta/ServiceSelectAllencuesta.php")
                            .success(function(data) {
                                $scope.encuesta = data;
                            })

                    })

            }
        }
    }
    $scope.Editar = function(data) {
        $scope.id_sucursal = data.id_sucursal;
        $scope.estatus = data.estatus;
        $scope.fecha_activacion = data.fecha_activacion;

        $scope.fecha_finalizacion = data.fecha_finalizacion;
        $scope.id_encuesta = data.id_encuesta;


        var parametros = {
            id_encuesta: $scope.id_encuesta
        }

        $scope.pregunta = [];
        $http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php", parametros)
            .success(function(data) {
                $scope.pregunta = data;
            })
            .error(function(error) {})

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
                id_encuesta: data.id_encuesta
            }
            $http.post("../../DataAccess/Servicios/encuesta/ServiceDeleteencuesta.php", parametros)
                .success(function(data) {
                    swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                    $http.post("../../DataAccess/Servicios/encuesta/ServiceSelectAllencuesta.php")
                        .success(function(data) {
                            $scope.encuesta = data;
                        })
                        .error(function(error) {})
                });

        })




    }
    $scope.EditarPregunta = function(data) {
        $scope.id_encuesta = data.id_encuesta;
        $scope.tipo_pregunta = data.tipo_pregunta;
        $scope.descripcion = data.descripcion;
        $scope.id_pregunta = data.id_pregunta;
    }

    function ActualizarContenido() {
        $http.post("../../DataAccess/Servicios/encuesta/ServiceSelectAllencuesta.php")
            .success(function(data) {
                $scope.encuesta = data;
            })
            .error(function(error) {})
    }

    $scope.PreguntaSelected = function(data) {
        $scope.preguntaseleccionadaid = data.id_pregunta;
        var parametros = {

            id_pregunta: data.id_pregunta
        }
        $scope.respuesta = [];
        $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php", parametros)
            .success(function(data) {
                $scope.respuesta = data;
            })
            .error(function(error) {})
    }
    $scope.GuardarPregunta = function() {
        if (true) {

            if ($scope.id_pregunta == null) {
                var parametros = {
                    id_encuesta: $scope.id_encuesta,
                    tipo_pregunta: $scope.tipoSelected.id,
                    descripcion: $scope.descripcion,
                    id_pregunta: $scope.id_pregunta
                }
                $http.post("../../DataAccess/Servicios/pregunta/ServiceInsertpregunta.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.tipo_pregunta = null;
                        $scope.descripcion = null;
                        $scope.id_pregunta = null;
                        var parametros = {
                            id_encuesta: $scope.id_encuesta
                        }

                        $scope.pregunta = [];
                        $http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php", parametros)
                            .success(function(data) {
                                $scope.pregunta = data;
                            })
                            .error(function(error) {})

                    })
                    .error(function(error) {

                    })
            } else {
                var parametros = {
                    id_encuesta: $scope.id_encuesta,
                    tipo_pregunta: $scope.tipoSelected.id,
                    descripcion: $scope.descripcion,
                    id_pregunta: $scope.id_pregunta
                }
                $http.post("../../DataAccess/Servicios/pregunta/ServiceUpdatepregunta.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.tipo_pregunta = null;
                        $scope.descripcion = null;
                        $scope.id_pregunta = null;
                        var parametros = {
                            id_encuesta: $scope.id_encuesta
                        }

                        $scope.pregunta = [];
                        $http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php", parametros)
                            .success(function(data) {
                                $scope.pregunta = data;
                            })
                            .error(function(error) {})

                    })

            }
        }
    }

    $scope.EliminarPregunta = function(data) {
        swal({
            title: "¿Desea eliminar el elemento seleccionado?",
            text: "¡El registro se eliminara permanentemente!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, ¡Eliminar!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                var parametros = {
                    id_pregunta: data.id_pregunta
                }
                $http.post("../../DataAccess/Servicios/pregunta/ServiceDeletepregunta.php", parametros)
                    .success(function(data) {
                        swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                        ActualizarContenido();
                    });
            } else {
                ActualizarContenido();

            }

        })





    }


    function ActualizarContenido() {

        var parametros = {
            id_encuesta: $scope.id_encuesta
        }

        $scope.pregunta = [];
        $http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php", parametros)
            .success(function(data) {
                $scope.pregunta = data;
            })
            .error(function(error) {})
    }
    $scope.EditarRespuesta = function(data) {

        $scope.id_respuesta = data.id_respuesta;
        $("#descripcionrespuesta" + data.id_pregunta).val(data.descripcion);

    }
    $scope.GuardarRespuesta = function(g) {
        if (true) {

            if ($scope.id_respuesta == null) {
                var parametros = {
                    id_pregunta: $scope.preguntaseleccionadaid,
                    descripcion: g.descripcionrespuesta,
                    id_respuesta: $scope.id_respuesta,
                    tipo_respuesta : $scope.tiporespuestas
                }
                $http.post("../../DataAccess/Servicios/respuesta/ServiceInsertrespuesta.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
                        $scope.descripcionr = null;
                        $scope.id_respuesta = null;
                        g.descripcionrespuesta = null;
                        var parametros = {

                            id_pregunta: $scope.preguntaseleccionadaid
                        }
                        $scope.respuesta = [];
                        $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php", parametros)
                            .success(function(data) {
                                $scope.respuesta = data;
                            })

                    })
                    .error(function(error) {

                    })
            } else {
                var parametros = {
                    id_pregunta: $scope.preguntaseleccionadaid,
                    descripcion: g.descripcionrespuesta,
                    id_respuesta: $scope.id_respuesta,
                    tipo_respuesta :$scope.tiporespuestas
                }
                $http.post("../../DataAccess/Servicios/respuesta/ServiceUpdaterespuesta.php", parametros)
                    .success(function(data) {
                        swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
                        $scope.id_pregunta = null;
                        $scope.descripcion = null;
                        $scope.id_respuesta = null;
                        g.descripcionrespuesta = null;
                        var parametros = {

                            id_pregunta: $scope.preguntaseleccionadaid
                        }
                        $scope.respuesta = [];
                        $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php", parametros)
                            .success(function(data) {
                                $scope.respuesta = data;
                            })

                    })

            }
        }
    }
    $scope.EliminarRespuesta = function(data) {
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
                id_respuesta: data.id_respuesta
            }
            $http.post("../../DataAccess/Servicios/respuesta/ServiceDeleterespuesta.php", parametros)
                .success(function(data) {
                    swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success");
                    var parametros = {

                        id_pregunta: $scope.preguntaseleccionadaid
                    }
                    $scope.respuesta = [];
                    $http.post("../../DataAccess/Servicios/respuesta/ServiceSelectAllrespuesta.php", parametros)
                        .success(function(data) {
                            $scope.respuesta = data;
                        })
                });

        })

    }

    $scope.ValidarTipoRecompensa = function() {

        if ($scope.rdorecompensa == 'rdorecompensa') {
            document.getElementById("porcentaje").disabled = true;
            document.getElementById("cmbRecompensa").disabled = false;
            document.getElementById("topemaximo").disabled = true;
            $scope.porcentaje = null;
            $scope.topemaximo = null;
        } else {
            if ($scope.rdorecompensa == 'rdoporcentaje') {
                document.getElementById("cmbRecompensa").disabled = true;
                $scope.recompensaSelected = null;
                $scope.topemaximo = null;
                document.getElementById("porcentaje").disabled = false;
                document.getElementById("topemaximo").disabled = true;
            }
            else
            {
                $scope.recompensaSelected = null;
                $scope.porcentaje = null;
                document.getElementById("topemaximo").disabled = false;
                document.getElementById("cmbRecompensa").disabled = true;
                document.getElementById("porcentaje").disabled = true;
            }
        }
    }

    function InicializacionComponentes() {
        $scope.tipopregunta = [{
            id: 1,
            label: 'Validacion'
        }, {
            id: 2,
            label: 'Negativa',

        }, {
            id: 3,
            label: 'Neutra'
        }];
    }

    $scope.TipoRespuestaSelected = function (data){
        $scope.tiporespuestas = data.id;
    }

});