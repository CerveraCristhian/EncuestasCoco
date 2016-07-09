var app = angular.module('recompensasApp', ['directivas']);
app.controller('recompensasController', function($scope, $http) {
$scope.descripcion = null;
$scope.id_recompensa = null;
$scope.recompensas = [];
ActualizarContenido();
$scope.Guardar= function ()
{
if(true)
{
		
if($scope.id_recompensa ==null)
{
var parametros = { method: 'insertrecompensas',
descripcion: $scope.descripcion
,
id_recompensa: $scope.id_recompensa
}
$http.post("../../Commun/commun.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro guardado correctamente!", "success")
$scope.descripcion =null;
$scope.id_recompensa =null;
ActualizarContenido();
})}
else
{
var parametros = {method: 'updaterecompensas',
descripcion: $scope.descripcion
,
id_recompensa: $scope.id_recompensa
}
$http.post("../../Commun/commun.php",parametros)
.success(function (data)
{
swal("¡Registro Guardado!", "¡Registro actualizado correctamente!", "success")
$scope.descripcion =null;
$scope.id_recompensa =null;
ActualizarContenido();
})
}


}
}
$scope.Editar = function (data)
{
$scope.descripcion = data.descripcion;
$scope.id_recompensa = data.id_recompensa;
}
$scope.EliminarSeleccionado = function(data)
{
swal({   title: "¿Desea eliminar el elemento seleccionado?",   text: "¡El registro se eliminara permanentemente!",   
type: "warning",   showCancelButton: true,   
confirmButtonColor: "#DD6B11",   confirmButtonText: "Si, ¡Eliminar!",   
closeOnConfirm: false }, function(){  

var parametros = { method: 'deleterecompensas',
id_recompensa: data.id_recompensa
}
$http.post("../../Commun/commun.php",parametros)
.success(function (data)
{
swal("¡Eliminado!", "¡Registro eliminado correctamente!", "success"); 
ActualizarContenido();
});

})
                


      
}
function ActualizarContenido(){
var parametros = {method: 'selectrecompensas'}
$http.post("../../Commun/commun.php",parametros)
.success(function (data)
{
$scope.recompensas = data;
})
.error(function (error)
{
})

}
});
