<ol class="breadcrumb">
    <li><a href="principal">Inicio</a></li>
    <li class="active">Paciente</li>
</ol>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
       <form role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                Registrar Pacientes  

                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="paciente" role="button">Regresar</a> 
                    <button type="submit" class="btn btn-success btn-xs">Grabar</button>
                    <button type="reset" class="btn btn-danger btn-xs">Resetear</button>
                </div>

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">

                      <div class="form-group">
                        <label>Tipo Documento</label>
                        <select class="form-control">
                            <option>DNI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Numero Documento</label>
                        <input type="text" class="form-control" name="txtnum">
                    </div>
                    <div class="form-group">
                        <label>Primer apellidos</label>
                        <input type="text" name="txtapepat" class="form-control" placeholder="Apellido Paterno">
                    </div>
                    <div class="form-group">
                        <label>Segundo apellidos</label>
                        <input type="text" name="txtapemat" class="form-control" placeholder="Apellido Materno">
                    </div>
                    <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" name="txtnompt" class="form-control" placeholder="Nombres">
                    </div>
                    <div class="form-group">
                        <label>Fecha Nacimiento</label>
                        <input type="date" name="txtfechanac" class="form-control" placeholder="Fecha Nacimiento">
                    </div>
                      <div class="form-group">
                    <label>Sexo</label>
                    <label class="radio-inline">
                        <input type="radio" name="chem" id="chem" value="M">Masculino
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="chef" id="chef" value="F">Femenino
                    </label>

                </div>
                </div>
                <!-- /.col-lg-6 (nested) -->
                <div class="col-lg-6">

                    <div class="form-group">
                        <label>Departamento</label>
                        <select class="form-control">
                            <option>Lima</option>
                        </select>
                    </div>                
                    <div class="form-group">
                        <label>Provincia</label>
                        <select class="form-control">
                            <option>Lima</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Distrito</label>
                        <select class="form-control">
                            <option>Lima</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="address" name="txtdirec" class="form-control" placeholder="Direccion">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="txtemail" class="form-control" placeholder="Correo">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="telf" name="txttelf" class="form-control" placeholder="Telefono">
                    </div>
                    <div class="form-group">
                      <label>Tiene Seguro</label>
                      <label class="checkbox-inline">
                        <input type="checkbox" name="optionsRadios" id="optionsRadios1" value="S">Si
                    </label>                                           
                </div>


            </div>
            <!-- /.col-lg-6 (nested) -->
        </div>

    </div>
    <!-- /.panel-body -->
</div>
</form>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>

