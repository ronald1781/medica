<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es-ES">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#">
<head>
   <meta charset=utf-8>
   <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <?php date_default_timezone_set('America/Lima');  ?> 
   <base href="<?php echo base_url(); ?>">
   <title><?php echo $titulo ?></title>
   <link rel="shortcut icon" type="image/x-icon" href="asest/imagen/servti.ico" />   
   
<!-- Core CSS - Include with every page -->
    <link href="asest/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="asest/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="asest/admin/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="asest/admin/css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Tables -->
    <link href="asest/admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="asest/admin/css/sb-admin.css" rel="stylesheet">
<link href="asest/vendor/css/datepiker/jquery.datetimepicker.css" rel="stylesheet">
<link href="asest/vendor/css/alertify/alertify.min.css" rel="stylesheet">

</head>
<body>   
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php echo $this->session->userdata('nomemp');?></a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('usuaper');?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo $this->session->userdata('prfper');?></a>
                        </li>                       
                        <li class="divider"></li>
                        <li><a href="loginin"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
        <!-- /.navbar-static-top -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">                            
                        </div>
                        <!-- /input-group -->
                    </li> 
                    <li><a href="principal"><i class="fa fa-home fa-fw"></i>Inicio</a></li>                  
                    <?php
                     $llavpfmn = $this->session->userdata('llavpfmn');
                    $menu = $this->session->userdata('menu');                   
                    foreach ($menu as $item) {                                            
                        if ($item['parentmen'] == 0 and $llavpfmn = 1) {
                            ?>          
                            <li> 
                                <a href="<?php echo $item['linkmen']; ?>"><i class="<?php echo $item['icomen']; ?>"></i> <?php echo $item['nommen'] ; ?><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                 <?php
                                 $id = $item['codidmenu'];
                                 foreach ($menu as $row) {
                                    if ($row['parentmen'] == $id and $llavpfmn = 1) {
                                        ?>
                                        <li><a href="<?php echo $row['linkmen']; ?>"> <?php echo $row['nommen']; ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php
                    }
                }
                ?>
                <li><a href="loginin"><i class="fa fa-sign-out fa-fw"></i>Salir</a></li> 
            </ul>
            <!-- /#side-menu -->
        </div>
        <!-- /.sidebar-collapse -->
    </nav>
    <!-- /.navbar-static-side -->
    <div id="page-wrapper">