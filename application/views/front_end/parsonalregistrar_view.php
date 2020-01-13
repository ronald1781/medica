<ol class="breadcrumb">
    <li><a href="principal">Inicio</a></li>
    <li class="active">Personal</li>
</ol>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
       <form role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                Registrar Personal  

                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="pesonal" role="button">Regresar</a> 
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
                        <label>Fecha Ingreso</label>
                        <input type="date" name="txtfechaing" class="form-control" placeholder="Fecha Ingreso">
                    </div>
                     <div class="form-group">
                        <label>Cargo</label>
                        <select class="form-control">
                            <option>Jefe</option>
                        </select>
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
                        <select class="form-control" name="selecdep">
                            <option>Lima</option>
                        </select>
                    </div>                
                    <div class="form-group">
                        <label>Provincia</label>
                        <select class="form-control" name="selecprov">
                            <option>Lima</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Distrito</label>
                        <select class="form-control" name="selecdist">
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
                        <label>Local</label>
                        <select class="form-control" name="seleclocal">
                            <option>Centro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Area</label>
                        <select class="form-control" name="selecarea">
                            <option>Administracion</option>
                        </select>
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

