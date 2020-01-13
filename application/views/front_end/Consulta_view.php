 

<ol class="breadcrumb">
  <li><a href="principal">Inicio</a></li>
  <li>Servicios</li>
  <li class="active">Consulta</li>
</ol>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Lista de Consulta
        <div class="pull-right">
          <a class="btn btn-primary btn-xs" href="cita" role="button"><i class="glyphicon glyphicon-plus"></i> Agregar Cita</a>

        </div>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
       <div class="row"> 
         <div class="col-md-12">
           <form class="form-inline" action="">
            <div class="form-group">
              <label for="selanioa">Especialidad</label>
              <select class="form-control" name="selespes" id="selespes" onchange="getMedicosearch(this.value)" required="" autofocus="">                    
              </select>
            </div>
            <div class="form-group">
              <label for="selmesa">Medico</label>
              <select class="form-control" name="selmedis" id="selmedis" required=""> 
                <option selected="" value="0">--SinDatos--</option>                
              </select>
            </div>
            <div class="form-group">
              <label for="selanioa">Paciente</label>
              <select class="form-control" name="selpacis" id="selpacis" required="">                    
              </select>
            </div>
            <div class="form-group">
              <label for="selmes">Fecha</label>
              <input type="text" name="fechadesde" id="fechadesde" class="form-control" value="<?php echo  gmdate("Y-m-d", time() -18000);?>" placeholder="Fecha desde">          
            </div>
            <div class="form-group">
              <label for="selmes">a</label>
              <input type="text" name="fechahasta" id="fechahasta" class="form-control" value="<?php echo  gmdate("Y-m-d", time() -18000);?>" placeholder="Fecha hasta">          
            </div>
            <button type="button" class="btn btn-info" id="btnsearch" name="btnsearch" value="consulta"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
          </form>

        </div>
        <div class="form-group gifCarga"><img id="loading_spinner" src="assest/imagen/loading8.gif" style="display: none;"></div>

      </div>                
      <div class="table-responsive">
       <table class="table table-striped table-bordered table-hover" id="dataTable_consulta">
        <thead>
          <tr>
            <th>Nro</th>
            <th>Atencion</th>
            <th>Paciente</th>
            <th>Especialidad</th>
            <th>Medico</th>                            
            <th>Motivo</th>
            <th>Importe</th>
            <th>Pago</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>                                     

        </tbody>
      </table>
    </div>               
  </div>
  <!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModalconsulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Registrar Consulta</h4>
      </div>
      <form action="#" id="form_consulta" class="form-horizontal" method="post"  enctype="multipart/form-data" autocomplete="">
        <div class="modal-body">
         <input type="hidden" name="codclta" id="codclta" value="">
         <div class="form-group">
          <label>Especialidad:</label>
           <p class="form-control" name="selespe" id="selespe">                    
           </p>
         </div>
         <div class="form-group">
          <label>Medico:</label>
          <p class="form-control" name="selmedi" id="selmedi">                
          </p>
        </div>
        <div class="form-group">
         <label >Paciente:</label>
         <p class="form-control" name="selpaci" id="selpaci">
         </p>
       </div>
       <div class="form-group">
         <label >Fecha Consulta:</label>
         <p  class="form-control" name="fechacitaa" id="fechacitaa" >
         </div>
         <div class="form-group">
          <label >Motivo Consulta:</label>
          <p class="form-control" name="selser" id="selser">
          </p>
        </div>
        <div class="form-group">
         <label>Observacion Consulta</label>
         <textarea class="form-control" rows="2" name="traobsser" id="traobsser" placeholder="Observacion Paciente" autofocus="" required=""></textarea>
       </div>
       <div class="form-group">
         <label >Confirmar fin de atencion?:</label>
         <label class="radio-inline"><input type="radio" name="desci" id="desci" value="1" checked>Si</label>
         <label class="radio-inline"><input type="radio" name="desci" id="desci" value="0">no</label>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="save_consulta()" value="cita">Save</button>
    </div>
  </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="myModalconsultavista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Registrar Consulta</h4>
      </div>
      <form action="#" id="form_consultav" class="form-inline" method="post"  enctype="multipart/form-data" autocomplete="">
        <div class="modal-body">
         <input type="hidden" name="codcltav" id="codcltav" value="">
         <div class="form-group">
          <label>Especialidad</label>
          <label class="sr-only" for="selespe">Especialidad:</label>
          <p class="form-control-static" name="selespev" id="selespev">                    
          </p>
        </div>
        <div class="form-group">
          <label class="sr-only" for="selmedi">Medico:</label>
          <p class="form-control-static" name="selmediv" id="selmediv" >                
          </p>
        </div>
        <div class="form-group">
          <label class="sr-only" for="selpaci">Paciente:</label>
          <p class="form-control-static" name="selpaciv" id="selpaciv">
          </p>
        </div>
        <div class="form-group">
          <label class="sr-only" for="fechacita">Fecha Consulta:</label>
          <p name="fechacitav" id="fechacitav" class="form-control-static" >
          </div>
          <div class="form-group">
            <label class="sr-only" for="selserv">Motivo Consulta:</label>
            <p class="form-control-static" name="selserv" id="selserv">
            </p>
          </div>
          <div class="form-group">
            <label class="sr-only" for="traobsserv">Observacion Consulta:</label>
            <textarea class="form-control" rows="2" name="traobsserv" id="traobsserv" placeholder="Observacion Paciente" ></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->