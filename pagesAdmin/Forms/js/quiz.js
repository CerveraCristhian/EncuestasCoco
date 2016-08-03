var app = angular.module('quizApp', ['angular.filter']);
app.controller('quizController', function($scope, $http) {
    $scope.id_encuesta = null;
    $scope.tipo_pregunta = null;
    $scope.descripcion = null;
    $scope.id_pregunta = null;
    $scope.pregunta = [];
    $http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllEncuesta.php")
        .success(function(data) {
            $scope.pregunta = data;
            $scope.idencuesta=data.pregunta[0].id_encuesta;
            $("#questions").hide();
            document.body.style.background = "";
        })
        .error(function(error) {})
    $scope.loadPreguntas = function() {
        if (Validaciones()) {
            $("#datos").hide();
            $("#questions").show();

        }
    }

    function Validaciones() {
        if ($scope.mail == undefined && $scope.telefono == undefined) {
            sweetAlert("Oops...", "Olvidaste llenar algunos datos", "error");
            return false;
        } else {
            return true;
        }

    }
});
