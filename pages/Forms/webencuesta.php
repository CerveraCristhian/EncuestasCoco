<?php 
session_start();
 ?>
<!DOCTYPE html>

<html ng-app="quizApp" ng-controller="quizController">

<head>
    <link rel="stylesheet" href="css/quiz.css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <title>Encuesta</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="js/quiz.js"></script>
    <script src="../../sweetalert-master/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="../../sweetalert-master/dist/sweetalert.css">
    <style type="text/css">
        body {

            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .bg-info {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .titulin {
            color: #fff;
        }
    </style>
</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-filter/0.5.8/angular-filter.js"></script>
    <div id="divsito" class="bg-info">
        <form id="userForm">
            <div class="container-fluid bg-info" id="datos">
                <center>
                    <h1 class="titulin">
                      <?php
                       
                        echo $_SESSION["nombre"];
                      ?>
                    </h1>
                    <h3 class="titulin">Bienvenido a nuestro sistema de encuestas 
                    
                        
                    </h3>
                   
                </center>
                <div class="modal-dialog">
                    <div class="modal-content" role="form">
                        <div class="modal-header">
                            <h2>Registrar tus datos</h2>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" ng-model="idencuesta" name="idencuesta" value="{{idencuesta}}"></input>
                            <input type="hidden" ng-model="meseroid" name="meseroid" value="{{meseroid}}"></input>
                            <div class="form-group ">
                                <input id="mail" name="mail" type="email" class="form-control" placeholder="Email" ng-model="mail">
                             
                            </div>
                            <div class="form-group">
                                <input id="phone" name="phone" type="tel" class="form-control" placeholder="Telefono" ng-model="telefono">
                               
                            </div>
                             <div class="form-group">
                                <select id="cmbEmpresa" class="form-control"   ng-model="meseroSelected" ng-change="AsignaridMesero()" ng-options="mesero.nombre for mesero in mesero.mesero">
                               
                </select>
                            </div>
                             <div class="form-group">
                                <input id="codigo" name="codigo" type="text" class="form-control" placeholder="No. Ticket" ng-model="codigo">
                                
                            </div>
                            <div class="form-group">
                                <textarea id="message" name="message" type="text" class="form-control" placeholder="Mensaje"></textarea>
                            </div>
                            <div class="form-group">
                                <span class="btn btn-primary" ng-click="loadPreguntas()">Realizar Encuesta</span>
                            </div>
                        </div>
                        <div class="modal-footer text-muted">
                            <span></span>
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>

            <div class="container-fluid bg-info" id="questions">
                <div class="modal-dialog" ng-repeat="(key, value) in pregunta.pregunta | groupBy: 'descripcionpregunta'">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>{{key}}</h3>
                        </div>
                        <div class="modal-body">
                            <div ng-repeat="report in value">
                                <label>
                                    <input type="radio" name="plolo[{{report.id_pregunta}}]" value="{{report.id_respuesta}}">{{report.descripcionrespuesta}}</input>
                                </label>
                                <br>
                            </div>
                        </div>
                        <div class="modal-footer text-muted">
                            <span id="answer"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <center>
                        <input type="submit" value="Enviar Respuestas" class="btn btn-primary btn-lg">
                    </center>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script src="js/quiz.js"></script>
<script>
    $(document).ready(function() {
        $('#userForm').submit(function() {
            // show that something is loading
            $.post('../../DataAccess/Servicios/ResponderEncuesta/InsertarEncuesta.php', $(this).serialize(), function(data) {
                // show the response
                $('#questions').html(data);
                sweetAlert("Gracias!", "Tus respuestas han sido enviadas correctamente!", "success");
            }).fail(function() {
                // just in case posting your form failed
                sweetAlert("Oops...", "Ocurrio un error en el servidor :(", "error");
            });
            // to prevent refreshing the whole page page
            return false;
        });
    });
</script>

</html>
