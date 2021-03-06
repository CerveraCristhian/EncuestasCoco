var app = angular.module('quizApp', ['angular.filter']);
app.controller('quizController', function($scope, $http) {
    $scope.id_encuesta = null;
    $scope.tipo_pregunta = null;
    $scope.descripcion = null;
    $scope.id_pregunta = null;
    $scope.pregunta = [];
    $scope.mesero = null;
    $http.post("../../DataAccess/Servicios/mesero/ServiceSelectAllmesero.php")
            .success(function(data) {
                $scope.mesero = data;
               
            })
            .error(function(error) {})
    $http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllEncuesta.php")
        .success(function(data) {
            $scope.pregunta = data;
            $scope.idencuesta=data.pregunta[0].id_encuesta;
            document.body.style.background = "url('"+data.sucursal+"') no-repeat center center fixed";
            document.body.style.backgroundSize = "cover";
            $("#questions").hide();
            
        })
        .error(function(error) {})
    $scope.loadPreguntas = function() {
        if (Validaciones()) {
            $("#datos").hide();
            $("#questions").show();

        }
    }
  

    function Validaciones() {
        if ($scope.mail == undefined || $scope.telefono == undefined || $scope.meseroid == undefined || $scope.codigo == undefined) {
            sweetAlert("Oops...", "Olvidaste llenar algunos datos", "error");
            return false;
        } else {
            return true;
        }

    }

   

    $scope.AsignaridMesero = function(){

        $scope.meseroid = $scope.meseroSelected.id_mesero;
    }
});
