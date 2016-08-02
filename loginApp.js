var app = angular.module('loginApp', []);
app.controller('loginController', function($scope, $http, $window) {
    $scope.id_sucursal = null;
    $scope.id_empresa = null;
    $scope.nombre = null;
    $scope.direccion = null;
    $scope.telefono = null;
    $scope.contacto = null;
    $scope.paquete = null;
    $scope.email = null;
    $scope.password = null;
    $scope.datin = null;

    $scope.Login = function () {
        var parametros = {
            email: $scope.email,
            password: $scope.password,
        }
        $http.post("DataAccess/Servicios/sucursal/ServiceLoginSurcursal.php", parametros)
            .success(function (data) {
              if(data.response == '1'){
                swal("Usuario correcto!", "", "success");
                window.location.href = 'pages/Forms/webencuesta.php';
              }else{
                swal("Usuario erroneo!", data.error_msg, "error");
              }
                //$scope.datin = data;
            }).error(function (error) {
            })
    }
});
