var app = angular.module('preguntaApp', []);
app.controller('preguntaController', function($scope, $http) {
$scope.id_encuesta = null;
$scope.tipo_pregunta = null;
$scope.descripcion = null;
$scope.id_pregunta = null;
$scope.pregunta = [];
$http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php")
.success(function(data) {
$scope.pregunta = data;
})
.error(function(error) {})
$scope.Guardar= function ()
{
if(true)
{
		
if($scope.id_pregunta ==null)
{
var parametros = {
id_encuesta: $scope.id_encuesta
,
tipo_pregunta: $scope.tipo_pregunta
,
descripcion: $scope.descripcion
,
id_pregunta: $scope.id_pregunta
}
$http.post("../../DataAccess/Servicios/pregunta/ServiceInsertpregunta.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
$scope.id_encuesta =null;
$scope.tipo_pregunta =null;
$scope.descripcion =null;
$scope.id_pregunta =null;
$http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php")
.success(function (data)
{
$scope.pregunta = data;
})

})
.error(function (error)
{
   					
})
}
else
{
var parametros = {
id_encuesta: $scope.id_encuesta
,
tipo_pregunta: $scope.tipo_pregunta
,
descripcion: $scope.descripcion
,
id_pregunta: $scope.id_pregunta
}
$http.post("../../DataAccess/Servicios/pregunta/ServiceUpdatepregunta.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
$scope.id_encuesta =null;
$scope.tipo_pregunta =null;
$scope.descripcion =null;
$scope.id_pregunta =null;
$http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php")
.success(function (data)
{
$scope.pregunta = data;
})

})

}
}
}
$scope.Editar = function (data)
{
$scope.id_encuesta = data.id_encuesta;
$scope.tipo_pregunta = data.tipo_pregunta;
$scope.descripcion = data.descripcion;
$scope.id_pregunta = data.id_pregunta;
}
$scope.EliminarSeleccionado = function(data)
{
swal({   title: "¿Desea eliminar el elemento seleccionado?",   text: "¡El registro se eliminara permanentemente!",   
type: "warning",   showCancelButton: true,   
confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, ¡Eliminar!",   
closeOnConfirm: false }, function(){  

var parametros = {
id_pregunta: data.id_pregunta
}
$http.post("../../DataAccess/Servicios/pregunta/ServiceDeletepregunta.php",parametros)
.success(function (data)
{
swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success"); 
ActualizarContenido();
});

})
                


      
}
function ActualizarContenido(){

$http.post("../../DataAccess/Servicios/pregunta/ServiceSelectAllpregunta.php")
.success(function (data)
{
$scope.pregunta = data;
})
.error(function (error)
{
})

}
});
