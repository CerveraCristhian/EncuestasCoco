var app = angular.module('encuesta_contestadaApp', []);
app.controller('encuesta_contestadaController', function($scope, $http) {
$scope.id_cliente = null;
$scope.id_ecuesta = null;
$scope.id_mesero = null;
$scope.codigo = null;
$scope.fecha = null;
$scope.hora = null;
$scope.estatus = null;
$scope.numero_orden = null;
$scope.id_encuesta_contestada = null;
$scope.encuesta_contestada = [];
$http.post("../../DataAccess/Servicios/encuesta_contestada/ServiceSelectAllencuesta_contestada.php")
.success(function(data) {
$scope.encuesta_contestada = data;
})
.error(function(error) {})
$scope.Guardar= function ()
{
if(true)
{
		
if($scope.id_encuesta_contestada ==null)
{
var parametros = {
id_cliente: $scope.id_cliente
,
id_ecuesta: $scope.id_ecuesta
,
id_mesero: $scope.id_mesero
,
codigo: $scope.codigo
,
fecha: $scope.fecha
,
hora: $scope.hora
,
estatus: $scope.estatus
,
numero_orden: $scope.numero_orden
,
id_encuesta_contestada: $scope.id_encuesta_contestada
}
$http.post("../../DataAccess/Servicios/encuesta_contestada/ServiceInsertencuesta_contestada.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
$scope.id_cliente =null;
$scope.id_ecuesta =null;
$scope.id_mesero =null;
$scope.codigo =null;
$scope.fecha =null;
$scope.hora =null;
$scope.estatus =null;
$scope.numero_orden =null;
$scope.id_encuesta_contestada =null;
$http.post("../../DataAccess/Servicios/encuesta_contestada/ServiceSelectAllencuesta_contestada.php")
.success(function (data)
{
$scope.encuesta_contestada = data;
})

})
.error(function (error)
{
   					
})
}
else
{
var parametros = {
id_cliente: $scope.id_cliente
,
id_ecuesta: $scope.id_ecuesta
,
id_mesero: $scope.id_mesero
,
codigo: $scope.codigo
,
fecha: $scope.fecha
,
hora: $scope.hora
,
estatus: $scope.estatus
,
numero_orden: $scope.numero_orden
,
id_encuesta_contestada: $scope.id_encuesta_contestada
}
$http.post("../../DataAccess/Servicios/encuesta_contestada/ServiceUpdateencuesta_contestada.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
$scope.id_cliente =null;
$scope.id_ecuesta =null;
$scope.id_mesero =null;
$scope.codigo =null;
$scope.fecha =null;
$scope.hora =null;
$scope.estatus =null;
$scope.numero_orden =null;
$scope.id_encuesta_contestada =null;
$http.post("../../DataAccess/Servicios/encuesta_contestada/ServiceSelectAllencuesta_contestada.php")
.success(function (data)
{
$scope.encuesta_contestada = data;
})

})

}
}
}
$scope.Editar = function (data)
{
$scope.id_cliente = data.id_cliente;
$scope.id_ecuesta = data.id_ecuesta;
$scope.id_mesero = data.id_mesero;
$scope.codigo = data.codigo;
$scope.fecha = data.fecha;
$scope.hora = data.hora;
$scope.estatus = data.estatus;
$scope.numero_orden = data.numero_orden;
$scope.id_encuesta_contestada = data.id_encuesta_contestada;
}
$scope.EliminarSeleccionado = function(data)
{
swal({   title: "¿Desea eliminar el elemento seleccionado?",   text: "¡El registro se eliminara permanentemente!",   
type: "warning",   showCancelButton: true,   
confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, ¡Eliminar!",   
closeOnConfirm: false }, function(){  

var parametros = {
id_encuesta_contestada: data.id_encuesta_contestada
}
$http.post("../../DataAccess/Servicios/encuesta_contestada/ServiceDeleteencuesta_contestada.php",parametros)
.success(function (data)
{
swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success"); 
ActualizarContenido();
});

})
                


      
}
function ActualizarContenido(){

$http.post("../../DataAccess/Servicios/encuesta_contestada/ServiceSelectAllencuesta_contestada.php")
.success(function (data)
{
$scope.encuesta_contestada = data;
})
.error(function (error)
{
})

}
});
