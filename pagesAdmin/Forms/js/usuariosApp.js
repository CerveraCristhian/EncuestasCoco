var app = angular.module('usuariosApp', ['directivas']);
app.controller('usuariosController', function($scope, $http) {
$scope.usr_email = null;
$scope.usr_password = null;
$scope.usr_sucursal = null;
$scope.usr_usuarioid = null;
$scope.usuarios = [];
$http.post("../../DataAccess/Servicios/usuarios/ServiceSelectAllusuarios.php")
.success(function(data) {
$scope.usuarios = data;
})
.error(function(error) {})
$scope.Guardar= function ()
{
if(true)
{
		
if($scope.usr_usuarioid ==null)
{
var parametros = {
usr_email: $scope.usr_email
,
usr_password: $scope.usr_password
,
usr_sucursal: $scope.usr_sucursal
,
usr_usuarioid: $scope.usr_usuarioid
}
$http.post("../../DataAccess/Servicios/usuarios/ServiceInsertusuarios.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
$scope.usr_email =null;
$scope.usr_password =null;
$scope.usr_sucursal =null;
$scope.usr_usuarioid =null;
$http.post("../../DataAccess/Servicios/usuarios/ServiceSelectAllusuarios.php")
.success(function (data)
{
$scope.usuarios = data;
})

})
.error(function (error)
{
   					
})
}
else
{
var parametros = {
usr_email: $scope.usr_email
,
usr_password: $scope.usr_password
,
usr_sucursal: $scope.usr_sucursal
,
usr_usuarioid: $scope.usr_usuarioid
}
$http.post("../../DataAccess/Servicios/usuarios/ServiceUpdateusuarios.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
$scope.usr_email =null;
$scope.usr_password =null;
$scope.usr_sucursal =null;
$scope.usr_usuarioid =null;
$http.post("../../DataAccess/Servicios/usuarios/ServiceSelectAllusuarios.php")
.success(function (data)
{
$scope.usuarios = data;
})

})

}
}
}
$scope.Editar = function (data)
{
$scope.usr_email = data.usr_email;
$scope.usr_password = data.usr_password;
$scope.usr_sucursal = data.usr_sucursal;
$scope.usr_usuarioid = data.usr_usuarioid;
}
$scope.EliminarSeleccionado = function(data)
{
swal({   title: "¿Desea eliminar el elemento seleccionado?",   text: "¡El registro se eliminara permanentemente!",   
type: "warning",   showCancelButton: true,   
confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, ¡Eliminar!",   
closeOnConfirm: false }, function(){  

var parametros = {
usr_usuarioid: data.usr_usuarioid
}
$http.post("../../DataAccess/Servicios/usuarios/ServiceDeleteusuarios.php",parametros)
.success(function (data)
{
swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success"); 
ActualizarContenido();
});

})
                


      
}
function ActualizarContenido(){

$http.post("../../DataAccess/Servicios/usuarios/ServiceSelectAllusuarios.php")
.success(function (data)
{
$scope.usuarios = data;
})
.error(function (error)
{
})

}
});
