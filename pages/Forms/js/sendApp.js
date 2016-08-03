var app = angular.module('sendApp', []);
app.controller('sendController', function($scope, $http) {
    $scope.id_sucursal = null;
    $scope.datin = null;

    $scope.Enviar = function () {
        var parametros = {
            id_sucursal: $scope.id_sucursal
        }
        $http.post("../../DataAccess/Servicios/encuesta/ServiceReporte.php", parametros)
            .success(function (data) {
              if(data.estado == 1){
                swal("Email Enviado!", "", "success");
                $scope.datin = data;
                EnviarResultados(data);
              }else{
                swal("Algo malo sucedio :S!", "Hubo un error en el envio del reporte", "error");
              }
            }).error(function (error) {
            })
    }

    function EnviarResultados($datos){
      var parametros = {
          encuesta: $datos.encuesta
      }
      $http.post("../../MailPDF/SendMailPDF.php", parametros)
          .success(function (data) {
            $scope.datin = data;
          }).error(function (error) {
          })
    }





});
