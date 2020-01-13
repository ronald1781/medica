 

<ol class="breadcrumb">
    <li><a href="principal">Inicio</a></li>
    <li>Servicios</li>
    <li class="active">Cita</li>
</ol>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Lista de Citas
                <div class="pull-right">
                    <button class="btn btn-primary btn-xs" onclick="add_cita()"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body"> 
                <div class="row"> 
                 <div class="col-md-12">
                    <form class="form-inline" action="" id="formsearch" name="formsearch">

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
                          <label for="selmes">Fecha</label>
                          <input type="text" name="fechadesde" id="fechadesde" class="form-control" value="<?php echo  gmdate("Y-m-d", time() -18000);?>" placeholder="Fecha desde">          
                      </div>
                      <div class="form-group">
                          <label for="selmes">a</label>
                          <input type="text" name="fechahasta" id="fechahasta" class="form-control" value="<?php echo  gmdate("Y-m-d", time() -18000);?>" placeholder="Fecha hasta">          
                      </div>
                      <div class="form-group">
                          <label for="selmesa">Estado</label>
                          <select class="form-control" name="selesta" id="selesta" required="">  
                          <option selected="" value="">--SinDatos--</option>              
                          </select>
                      </div>
                      <button type="button" class="btn btn-info" id="btnsearch" name="btnsearch" value="cita"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
                  </form>

              </div>
              <div class="form-group gifCarga"><img id="loading_spinner" src="assest/imagen/loading8.gif" style="display: none;"></div>

          </div>   
          <hr>           
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTable_cita">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Paciente</th>
                        <th>Especialidad</th>
                        <th>Medico</th>                            
                        <th>Cita</th>
                        <th>Motivo</th>
                        <th>Estado</th>
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
<div class="modal fade" id="myModalcita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Registrar Citas</h4>
            </div>
            <form action="#" id="form_cita" class="form-horizontal" method="post"  enctype="multipart/form-data" autocomplete="">
                <div class="modal-body">
                    <input type="hidden" name="codcita" id="codcita" value="">
                    <div class="form-group">
                        <label>Especialidad</label>
                        <select class="form-control" name="selespe" id="selespe" onchange="getdatos(this.value)" required="" autofocus="">                    
                        </select>
                    </div>
                    <div class="form-group">
                       <label>Medico</label>
                       <select class="form-control" name="selmedi" id="selmedi" required="">                
                       </select>
                   </div>
                   <div class="form-group">
                       <label>Paciente</label>
                       <select class="form-control" name="selpaci" id="selpaci" required="">                  
                       </select>
                   </div>
                   <div class="form-group">
                       <label>Fecha Cita</label>
                       <input type="text" name="fechacita" id="fechacita" class="form-control" required="fechacita" placeholder="Fecha Cita">
                   </div>
                   <div class="form-group">
                       <label>Hora Cita</label>
                       <input type="text" name="horacita" id="horacita" class="form-control" required="horacita" placeholder="Hora Cita">
                   </div>
                   <div class="form-group">
                       <label>Motivo Cita</label>
                       <select class="form-control" name="selserv" id="selserv" required="selserv">
                       </select>
                   </div>
                   <div class="form-group">
                       <label>Observacion Cita</label>
                       <textarea class="form-control" rows="2" name="traobsserv" id="traobsserv" placeholder="Observacion Paciente"></textarea>
                   </div>
               </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_cita()" value="cita">Save</button>
            </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
