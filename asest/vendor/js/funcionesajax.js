

 var save_method; //for save method string
 var table;
 var tablaconsulta;
 var tablacita;
 $(function () {
// formatTime:'h:mm a',
  //formatDate:'DD.MM.YYYY'


  //Botones clic
  $("#btncita1").click(function (e) {
  	e.preventDefault();
  	var selespe = $("#selespe").val();
  	var selmedi = $("#selmedi").val();
  	var selpaci = $("#selpaci").val();
  	var fechacita = $("#fechacita").val();
  	var horacita = $("#horacita").val();
  	var selserv= $("#selserv").val();
  	var traobsserv= $("#traobsserv").val();
  	if (selespe == '') {
  		$("#selespe").focus();
  		alertify.alert("Falta Datos", function () {
  			alertify.error('Seleccione una especialidad');
  		});
  		return false;
  	}

  });
  $("#btnsearch").click(function (e) {
  	e.preventDefault();

  	var btnsearch=$('#btnsearch').val();
  	switch(btnsearch){
  		case 'cita':
  		$('#dataTable_cita').DataTable().clear().draw();
  		tbcita();
  		break;
  		case 'consulta':
  		$('#dataTable_consulta').DataTable().clear().draw();
  		tbconsulta();
  		break;
  	}

  	
  });
//Tablas
$('#dataTable_paciente').DataTable();

tbcita();
tbconsulta();
});

 function tbcita(){ 

 	var tablacita = $("#dataTable_cita").DataTable({    	
 		"processing": true, 
 		"serverSide": true, 
 		"destroy": true,
 		"searching": false,            
 		"ajax": {
 			"url": "citas_control/ajax_list_citas",
 			"type": "POST",
 			"async": false,			
 			"data"   : function( d ) {
 				d.selespe= $("#selespes").val();
 				d.selmedi= $("#selmedis").val();
 				d.fechadesde= $("#fechadesde").val();      
 				d.fechahasta= $("#fechahasta").val();
 				d.selesta=$("#selesta").val();
 			}, 
 		},
 		"error": function(jqXHR, textStatus, errorThrown){ 
 			var mej=jqXHR+' '+textStatus+' '+errorThrown;
 			alertify.alert('Se presenta Error en la Cita!', mej,function(){ alertify.error('Error en la Cita'); });
 		},
 		"order": [],         
 		"columnDefs": [
 		{
 			"targets": 'no-sort', 
 			"orderable": false, 
 		}
 		],

 	});
 }



 function add_cita()
 {
 	save_method = 'add';
        $('#form_cita')[0].reset(); // reset form on modals
        $('#myModalcita').modal('show'); // show bootstrap modal
        $('.modal-title').text('Agregar Cita'); // Set Title to Bootstrap modal title
    }
    function edit_cita(id)
    {
    	save_method = 'update';
    	$('#form_cita')[0].reset(); 
    	$.ajax({
    		url: "citas_control/ajax_edit_cita/" + id,
    		type: "GET",
    		dataType: "JSON",
    		success: function (data)
    		{
    			getdatos(data.codepac);    			
    			$('[name="codcita"]').val(data.codecit);
    			$('[name="selespe"]').val(data.codepac);
    			$("#selmedi option[value='"+data.codmed+"']").attr("selected","selected");
    			$('[name="selpaci"]').val(data.codepac);
    			$('[name="fechacita"]').val(data.fechcit);
    			$('[name="horacita"]').val(data.horacit);
    			$('[name="selserv"]').val(data.motcit);
    			$('#selserv').change();
    			$('[name="traobsserv"]').val(data.odbscit);
    			$('#myModalcita').modal('show'); 
    			$('.modal-title').text('Editar Cita nro '+id); 
    		},
    		error: function (jqXHR, textStatus, errorThrown)
    		{            	
    			var mej=jqXHR+' '+textStatus+' '+errorThrown;
    			alertify.alert('Se presenta Error en la Cita!', mej,function(){ alertify.error('Error en la Cita'); });
    		}
    	});
    }

    function atender_cita(id)
    {
    	alertify.confirm("Cita","Esta seguro de Atender ", function (e) {
    		if (e) { 
    			$.ajax({
    				url: "citas_control/atender_cita/" + id,
    				type: "GET",
    				dataType: "JSON",
    				success: function (data)
    				{
    					datas=data.status;
    					$.notify('"'+data.status+'"', "success");
    				},
    				error: function (jqXHR, textStatus, errorThrown)
    				{            	
    					var mej=jqXHR+' '+textStatus+' '+errorThrown;
    					alertify.alert('Se presenta Error en la Atencion!', mej,function(){ alertify.error('Error en la atencion'); });
    				}
    			});
    			alertify.success("Se guardar la atencion."+datas);
    		} else {
    			alertify.error("Se cancelo la atencion");
    		}
    	}, function () {
    		alertify.error("Se cancelo la atencion")
    	});
    	return false;
    }

    function reload_tablecita()
    {
    	tablacita.ajax.reload(null, false);
    	tablacita(); 
    }

    function save_cita()
    {
    	var datas='';
    	var url;
    	if (save_method == 'add')
    	{
    		url = "citas_control/ajax_add_cita";
    	}
    	else
    	{
    		url = "citas_control/ajax_update";
    	}
    	//'Alert Title', 'Alert Message!',
    	alertify.confirm("Cita","Esta seguro de Guardar ", function (e) {
    		if (e) {     
    			$.ajax({
    				url: url,
    				type: "POST",
    				data: $('#form_cita').serialize(),
    				dataType: "JSON",
    				success: function (data)
    				{
    					datas=data.status;
    					$.notify('"'+data.status+'"', "success");        		
    					$('#form_cita')[0].reset();
    					$('#myModalcita').modal('hide');
    					reload_tablecita();
    				},
    				error: function (jqXHR, textStatus, errorThrown)
    				{
    					$.notify("Warning:" +jqXHR+' '+ textStatus+' '+ errorThrown, "warn ");
    				}
    			});
    			alertify.success("Se guardar la cita."+datas);
    		} else {
    			alertify.error("Se cancelo la cita");
    		}
    	}, function () {
    		alertify.error("Se cancelo la cita")
    	});
    	return false;    	
    }

    function delete_cita(id)
    {
    	var datas='';
    	alertify.confirm("Cita","Esta seguro de Anular la cita? ", function (e) {
    		if (e) { 
    			$.ajax({
    				url: "citas_control/ajax_delete_cita/" + id,
    				type: "POST",
    				dataType: "JSON",
    				success: function (data)
    				{
    					$('#myModalcita').modal('hide');    					
    					datas=data.status;
    					$.notify('"'+data.status+'"', "success");
    					reload_tablecita();
    				},
    				error: function (jqXHR, textStatus, errorThrown)
    				{
    					$.notify("Warning: " +jqXHR+' '+ textStatus+' '+ errorThrown, "warn ");
    				}
    			});
    			alertify.success("Se Anulo la cita."+datas);
    		} else {
    			alertify.error("Se cancelo la anulacion de cita");
    		}
    	}, function () {
    		alertify.error("Se cancelo la anulacion de cita")
    	});
    	return false;    	
    }
//consulta
function tbconsulta(){ 

	var tablaconsulta = $("#dataTable_consulta").DataTable({    	
		"processing": true, 
		"serverSide": true, 
		"destroy": true,
		"searching": false,            
		"ajax": {
			"url": "consulta_control/ajax_list_consulta",
			"type": "POST",
			"async": false,			
			"data"   : function( d ) {
				d.selespe= $("#selespes").val();
				d.selmedi= $("#selmedis").val();
				d.fechadesde= $("#fechadesde").val();      
				d.fechahasta= $("#fechahasta").val();
				d.selesta=$("#selesta").val();
			}, 
		},
		"error": function(jqXHR, textStatus, errorThrown){ 
			var mej=jqXHR+' '+textStatus+' '+errorThrown;
			alertify.alert('Se presenta Error en la Consulta!', mej,function(){ alertify.error('Error en la Consulta'); });
		},
		"order": [],         
		"columnDefs": [
		{
			"targets": 'no-sort', 
			"orderable": false, 
		}
		],

	});
}



function add_consulta()
{
	save_method = 'add';
        $('#form_consulta')[0].reset(); // reset form on modals
        $('#myModalconsulta').modal('show'); // show bootstrap modal
        $('.modal-title').text('Agregar Consulta'); // Set Title to Bootstrap modal title
    }

    function edit_consulta(id)
    {
    	save_method = 'update';
    	$('#form_consulta')[0].reset(); 
    	$.ajax({
    		url: "consulta_control/ajax_edit_consulta/" + id,
    		type: "GET",
    		dataType: "JSON",
    		success: function (data)
    		{    			   			
    			$('#codclta').val(data.codclt);
    			$('#selespe').text(data.nomesp);
    			$('#selmedi').text(data.medico);
    			$('#selpaci').text(data.paciente);
    			$('#fechacitaa').text(data.iniateclt);
    			$('#selser').text(data.nomsrv);
    			$('[name="traobsserv"]').val(data.descclt).focus();
    			$('#myModalconsulta').modal('show'); 
    			$('.modal-title').text('Editar Consulta nro '+id); 
    		},
    		error: function (jqXHR, textStatus, errorThrown)
    		{            	
    			var mej=jqXHR+' '+textStatus+' '+errorThrown;
    			alertify.alert('Se presenta Error en la Consulta!', mej,function(){ alertify.error('Error en la Consulta'); });
    		}
    	});
    }

    function atender_consulta(id)
    {
    	alertify.confirm("Consulta","Esta seguro de Atender ", function (e) {
    		if (e) { 
    			$.ajax({
    				url: "consulta_control/atender_consulta/" + id,
    				type: "GET",
    				dataType: "JSON",
    				success: function (data)
    				{
    					datas=data.status;
    					$.notify('"'+data.status+'"', "success");
    				},
    				error: function (jqXHR, textStatus, errorThrown)
    				{            	
    					var mej=jqXHR+' '+textStatus+' '+errorThrown;
    					alertify.alert('Se presenta Error en la Atencion!', mej,function(){ alertify.error('Error en la atencion'); });
    				}
    			});
    			alertify.success("Se guardar la atencion."+datas);
    		} else {
    			alertify.error("Se cancelo la atencion");
    		}
    	}, function () {
    		alertify.error("Se cancelo la atencion")
    	});
    	return false;
    }

    function reload_tablecita()
    {
    	tablacita.ajax.reload(null, false);
    	tablacita(); 
    }

    function save_consulta()
    {
    	var datas='';
    	var url;
    	if (save_method == 'add')
    	{
    		url = "consulta_control/ajax_add_consulta";
    	}
    	else
    	{
    		url = "consulta_control/ajax_update_consulta";
    	}
    	//'Alert Title', 'Alert Message!',
    	alertify.confirm("Consulta","Esta seguro de Guardar ", function (e) {
    		if (e) {     
    			$.ajax({
    				url: url,
    				type: "POST",
    				data: $('#form_consulta').serialize(),
    				dataType: "JSON",
    				success: function (data)
    				{
    					datas=data.status;
    					$.notify('"'+data.status+'"', "success");        		
    					$('#form_consulta')[0].reset();
    					$('#myModalconsulta').modal('hide');
    					reload_tablecita();
    				},
    				error: function (jqXHR, textStatus, errorThrown)
    				{
    					$.notify("Warning:" +jqXHR+' '+ textStatus+' '+ errorThrown, "warn ");
    				}
    			});
    			alertify.success("Se guardar la consulta. "+datas);
    		} else {
    			alertify.error("Se cancelo la consulta");
    		}
    	}, function () {
    		alertify.error("Se cancelo la consulta")
    	});
    	return false;    	
    }

    function delete_consulta(id)
    {
    	var datas='';
    	alertify.confirm("Consulta","Esta seguro de Anular la Consulta? ", function (e) {
    		if (e) { 
    			$.ajax({
    				url: "consulta_control/ajax_delete_consulta/" + id,
    				type: "POST",
    				dataType: "JSON",
    				success: function (data)
    				{
    					$('#myModalconsulta').modal('hide');    					
    					datas=data.status;
    					$.notify('"'+data.status+'"', "success");
    					reload_tablecita();
    				},
    				error: function (jqXHR, textStatus, errorThrown)
    				{
    					$.notify("Warning: " +jqXHR+' '+ textStatus+' '+ errorThrown, "warn ");
    				}
    			});
    			alertify.success("Se Anulo la consulta."+datas);
    		} else {
    			alertify.error("Se cancelo la anulacion de consulta");
    		}
    	}, function () {
    		alertify.error("Se cancelo la anulacion de consulta")
    	});
    	return false;    	
    }

