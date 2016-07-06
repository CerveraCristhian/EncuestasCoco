var app = angular.module('respuestas_contestadasclienteApp', []);
app.controller('respuestas_contestadasclienteController', function($scope, $http) {
$scope.respuesta_contestadasclienterespuesta = null;
$scope.respuestas_contestadasclienteencuestaid = null;
$scope.respuesta_contestadaclienteid = null;
$scope.respuestas_contestadascliente = [];
$http.post("../../DataAccess/Servicios/respuestas_contestadascliente/ServiceSelectAllrespuestas_contestadascliente.php")
.success(function(data) {
$scope.respuestas_contestadascliente = data;
})
.error(function(error) {})
$scope.Guardar= function ()
{
if(true)
{
		
if($scope.respuesta_contestadaclienteid ==null)
{
var parametros = {
respuesta_contestadasclienterespuesta: $scope.respuesta_contestadasclienterespuesta
,
respuestas_contestadasclienteencuestaid: $scope.respuestas_contestadasclienteencuestaid
,
respuesta_contestadaclienteid: $scope.respuesta_contestadaclienteid
}
$http.post("../../DataAccess/Servicios/respuestas_contestadascliente/ServiceInsertrespuestas_contestadascliente.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
$scope.respuesta_contestadasclienterespuesta =null;
$scope.respuestas_contestadasclienteencuestaid =null;
$scope.respuesta_contestadaclienteid =null;
$http.post("../../DataAccess/Servicios/respuestas_contestadascliente/ServiceSelectAllrespuestas_contestadascliente.php")
.success(function (data)
{
$scope.respuestas_contestadascliente = data;
})

})
.error(function (error)
{
   					
})
}
else
{
var parametros = {
respuesta_contestadasclienterespuesta: $scope.respuesta_contestadasclienterespuesta
,
respuestas_contestadasclienteencuestaid: $scope.respuestas_contestadasclienteencuestaid
,
respuesta_contestadaclienteid: $scope.respuesta_contestadaclienteid
}
$http.post("../../DataAccess/Servicios/respuestas_contestadascliente/ServiceUpdaterespuestas_contestadascliente.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
$scope.respuesta_contestadasclienterespuesta =null;
$scope.respuestas_contestadasclienteencuestaid =null;
$scope.respuesta_contestadaclienteid =null;
$http.post("../../DataAccess/Servicios/respuestas_contestadascliente/ServiceSelectAllrespuestas_contestadascliente.php")
.success(function (data)
{
$scope.respuestas_contestadascliente = data;
})

})

}
}
}
$scope.Editar = function (data)
{
$scope.respuesta_contestadasclienterespuesta = data.respuesta_contestadasclienterespuesta;
$scope.respuestas_contestadasclienteencuestaid = data.respuestas_contestadasclienteencuestaid;
$scope.respuesta_contestadaclienteid = data.respuesta_contestadaclienteid;
}
$scope.EliminarSeleccionado = function(data)
{
swal({   title: "¿Desea eliminar el elemento seleccionado?",   text: "¡El registro se eliminara permanentemente!",   
type: "warning",   showCancelButton: true,   
confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, ¡Eliminar!",   
closeOnConfirm: false }, function(){  

var parametros = {
respuesta_contestadaclienteid: data.respuesta_contestadaclienteid
}
$http.post("../../DataAccess/Servicios/respuestas_contestadascliente/ServiceDeleterespuestas_contestadascliente.php",parametros)
.success(function (data)
{
swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success"); 
ActualizarContenido();
});

})
                


      
}
function ActualizarContenido(){

$http.post("../../DataAccess/Servicios/respuestas_contestadascliente/ServiceSelectAllrespuestas_contestadascliente.php")
.success(function (data)
{
$scope.respuestas_contestadascliente = data;
})
.error(function (error)
{
})

}
});
