var app = angular.module('directivas', []);
app.directive('ppcHeader', function() {
  return {
    templateUrl: 'Directivas/header.html'
  };});
app.directive('ppcAside', function() {
  return {
    templateUrl: 'Directivas/aside.html'
  };});
app.directive('ppcLibrerias', function() {
  return {
    templateUrl: 'Directivas/librerias.html'
  };});

