<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
     <base href="<?php echo base_url(); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo $titulo ?></title>
	<link rel="stylesheet" type="text/css" href="asest/admin/css/bootstrap.css"> 
</head>
<body>
     <div class="container mt-4 col-lg-4">
        </div>
 <div class="container mt-4 col-lg-4">
            <div class="card col-sm-10">
                <div class="car-body">
                    <form class="form-sign" action="valida/login" method="post">
                        <div class="form-group text-center">
                            <h3>Login</h3>
                            <img src="asest/imagen/imgemp.png" height="90" width="170">
                            <br>
                            <label>Bienvenidos al sistema</label>
                        </div>                        
                        <div class="form-group">
                            <label>Usuario:</label>
                            <input type="text" name="txtuser" class="form-control">
                        </div>                         
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="txtpass" class="form-control">
                        </div> 
                        <input type="submit" name="accion" value="ingresar" class="btn btn-primary btn-block">
                        <br>
                    </form>
                </div>
                 <?php echo $this->session->flashdata('message_name');?>
                          
            </div>
         </div>
          <div class="container mt-4 col-lg-4">
             </div>
         
<script type="text/javascript" src="asest/admin/js/jquery-v3.2.1.js"></script>
<script type="text/javascript" src="asest/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="asest/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script type="text/javascript" src="asest/admin/js/sb-admin.js"></script>
</body>
</html>