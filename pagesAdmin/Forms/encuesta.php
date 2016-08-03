<?php
session_start();
?>
<!DOCTYPE html>
<html ng-app="encuestaApp" ng-controller="encuestaController">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Encuestas | Encuesta</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Placed js at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="js/encuestaApp.js"></script>
    <script src="js/directivas.js"></script>
    <!-- This is what you need -->
    <script src="../../sweetalert-master/dist/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="../../sweetalert-master/dist/sweetalert.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular-rangy.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular-sanitize.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular.min.js'></script>
    <!--.......................-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
    <ppc-header></ppc-header>
  <ppc-aside></ppc-aside>
  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Encuestas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Configuracion</a></li>
        <li class="active">Encuestas</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <form role="form" name="formulario">
            <div class="box-body">
              <div class="form-group">
                 <label>Elegir tipo de recompensa</label> <br>
                <input type="radio" name="gender" value="rdoporcentaje" ng-model="rdorecompensa" ng-click="ValidarTipoRecompensa()"> Porcentaje<br>
                <input type="radio" name="gender" value="rdorecompensa" ng-model="rdorecompensa" ng-click="ValidarTipoRecompensa()"> Recompensa<br>
                <input type="radio" name="gender" value="rdodinero" ng-model="rdorecompensa" ng-click="ValidarTipoRecompensa()"> Dineros <br>
                <label for="fecha_activacion">Fecha de Activacion</label><input type="date" class="form-control" name="fecha_activacion"
                id="fecha_activacion" placeholder="Capturar fecha_activacion" ng-model="fecha_activacion">
                
                <label for="porcentaje">porcentaje</label><input type="text" class="form-control" name="porcentaje" id="porcentaje"
                placeholder="Capturar porcentaje" ng-model="porcentaje">
                <label for="fecha_finalizacion">Fecha de Finalzacion</label><input type="date" class="form-control" name="fecha_finalizacion"
                id="fecha_finalizacion" placeholder="Capturar fecha_finalizacion" ng-model="fecha_finalizacion">
                <label for="cmbRecompensa">Recompensa</label>
                <select id="cmbRecompensa" name="cmbRecompensa" class="form-control" ng-model="recompensaSelected" ng-options="recompensas.descripcion for recompensas in recompensas.recompensas">
                </select>
                <label for="emailenvio">Email de notificacion</label><input type="email" class="form-control" name="emailenvio"
                id="emailenvio" placeholder="Capturar email de notificacion" ng-model="emailenvio">

                <label for="topemaximo">Tope Maximo</label><input type="text" class="form-control" name="topemaximo"
                id="topemaximo" placeholder="Capturar Tope Maximo" ng-model="topemaximo">
                <label for="bienvenida">Mensaje de Bienvenida</label><input type="text" class="form-control" name="bienvenida"
                id="bienvenida" placeholder="Capturar mensaje de bienvenida" ng-model="bienvenida">
                <label for="despedida">Mensaje de Despedida</label>
                <div id="disculpa" text-angular ng-model="despedida" style="min-height: 300px;display: block; height:300px; max-height:300px"></div>
                
                <label for="disculpa">Mensaje de Disculpa</label><div text-angular id="disculpa" ng-model="disculpa" style="min-height: 300px;display: block; height:300px; max-height:300px"></div>
              </div>
              <div class="box-footer">
                <button class="btn btn-primary" ng-click="Guardar()">Guardar</button>
              </div>
            </form>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Sucursal</th>
                  <th>fecha_activacion</th>
                  <th>porcentaje</th>
                  <th>Email</th>
                  <th>fecha_finalizacion</th>
                </tr>
                <tr>
                  <form>
                    <tr ng-repeat="item in encuesta.encuesta | filter:test">
                      <td>{{item.sucursal}}</td>
                      <td>{{item.fecha_activacion}}</td>
                      <td>{{item.porcentaje}} %</td>
                      <td>{{item.emailenvio}}</td>
                      <td>{{item.fecha_finalizacion}}</td>
                      
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" ng-click=Editar(item)>Agregar Preguntas</button>
                      </td>
                      <td>
                        <button ng-click="EliminarSeleccionado(item)" class="btn btn-danger">Eliminar</button>
                      </td>
                      <td>
                        <button ng-click="ActivarEncuesta(item)" class="btn btn-success" ng-class="{'btn btn-info': item.estatus == '1'}">{{item.estatus == '0' ? '&nbsp;&nbsp;&nbsp;&nbsp;Activar&nbsp;&nbsp;&nbsp;' : 'Desactivar'}}</button>
                      </td>
                    </tr>
                  </form>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-body">
              <div class="panel-group">
                <form role="form" name="formulario">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="tipo_pregunta">Tipo de Pregunta</label>
                      <select name="tipopregunta" id="tipopregunta" ng-options="item as item.label for item in tipopregunta" ng-model="tipoSelected"
                      class="form-control"></select>
                      <label for="descripcion">Descripcion</label><input type="text" class="form-control" name="descripcion"
                      id="descripcion" placeholder="Capturar descripcion" ng-model="descripcion" required="true">
                    </div>
                    <div class="box-footer">
                      <button class="btn btn-primary" ng-click="GuardarPregunta()">Guardar</button>
                    </div>
                  </form>
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-default" ng-repeat="item in pregunta.pregunta | filter:test">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                        <div>
                          <span ng-if="item.tipo_pregunta==1" class="btn btn-success"></span>
                          <span ng-if="item.tipo_pregunta==2" class="btn btn-danger"></span>
                          <span ng-if="item.tipo_pregunta==3" class="btn btn-warning"></span>
                          <i data-toggle="collapse" href="#collapse{{item.id_pregunta}}" ng-click="PreguntaSelected(item)" class="fa fa-plus" aria-hidden="true"
                          style="color:green;" data-parent="#accordion"></i><i class="fa fa-pencil-square-o"
                          aria-hidden="true" style="color:green;" ng-click="EditarPregunta(item)"></i><i class="fa fa-trash"
                          aria-hidden="true" style="color:green;" ng-click="EliminarPregunta(item)"></i> <a>           {{item.descripcion}} </a>
                          </h4>
                        </div>
                        <div id="collapse{{item.id_pregunta}}" {{item.id_pregunta}} class="panel-collapse collapse">
                          <form role="form" name="formulario">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="tipo_pregunta">Tipo de Respuesta</label>
                                <select name="tiporespuesta" id="tiporespuesta" ng-options="item as item.label for item in tipopregunta" ng-model="tiporespuestaSelected"
                                class="form-control"></select>
                                <label for="descripcionrespuesta">Descripcion</label><input type="text" class="form-control"
                                name="descripcion" id="descripcionrespuesta{{item.id_pregunta}}" placeholder="Capturar descripcion"
                                ng-model="item.descripcionrespuesta">
                              </div>
                              <div class="box-footer">
                                <button class="btn btn-primary" ng-click="GuardarRespuesta(item)">Guardar</button>
                              </div>
                            </form>
                            <ul class="list-group">
                              <li class="list-group-item" ng-repeat="item in respuesta.respuesta"><i class="fa fa-pencil-square-o" style="color:green; " ng-click="EditarRespuesta(item)"></i>
                              <i class="fa fa-trash" aria-hidden="true" style="color:green; " ng-click="EliminarRespuesta(item)"></i>{{item.descripcion}}</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Create the tabs -->
          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
              <h3 class="control-sidebar-heading">Recent Activity</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                      <p>Will be 23 on April 24th</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-user bg-yellow"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                      <p>New phone +1(800)555-1234</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                      <p>nora@example.com</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                      <p>Execution time 5 seconds</p>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->
              <h3 class="control-sidebar-heading">Tasks Progress</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                    </h4>
                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->
            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
              <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                  <p>
                    Some information about this general settings option
                  </p>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Allow mail redirect
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                  <p>
                    Other sets of options are available
                  </p>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Expose author name in posts
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                  <p>
                    Allow the user to show his name in blog posts
                  </p>
                </div>
                <!-- /.form-group -->
                <h3 class="control-sidebar-heading">Chat Settings</h3>
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Show me as online
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Turn off notifications
                    <input type="checkbox" class="pull-right">
                  </label>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Delete chat history
                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                  </label>
                </div>
                <!-- /.form-group -->
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 2.2.0 -->
      <script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
      <!-- Bootstrap 3.3.6 -->
      <script src="../../bootstrap/js/bootstrap.min.js"></script>
      <!-- SlimScroll -->
      <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="../../plugins/fastclick/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="../../dist/js/app.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="../../dist/js/demo.js"></script>
      <link href="../../plugins/bootstrap-switch-master/css/bootstrap-switch.css" rel="stylesheet">
      <script src="../../plugins/bootstrap-switch-master/js/bootstrap-switch.js"></script>
      <style>
      .ta-editor,
      .ta-editor > .ta-bind {
      min-height: 230px;
      }
      .red {
      color: red;
      }
      .statictoolbar {
      position: fixed;
      top: 12px;
      z-index: 200;
      left: 0;
      right: 0;
      }
      </style>
    </body>
  </html>