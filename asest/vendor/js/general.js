$(function () {

  jQuery('#fechacita').datetimepicker({
  	timepicker:false,
  	mask:true,
  	lang: 'de',
  	i18n: {
  		de: {
  			months: [
  			'Enero', 'Febrero', 'Marzo', 'Abril',
  			'Mayo', 'Junio', 'Julio', 'Agosto',
  			'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
  			],
  			dayOfWeek: [
  			"Dom", "Lun", "Mar", "Mie", "Jue",
  			"Vie", "Sab",
  			]
  		}
  	},
  	format: 'Y-m-d'
  });
   jQuery('#horacita').datetimepicker({
  	datepicker:false,
  	format:'H:i',
  	step:15
  });

jQuery('#fechadesde').datetimepicker({
  	timepicker:false,
  	mask:true,
  	lang: 'de',
  	i18n: {
  		de: {
  			months: [
  			'Enero', 'Febrero', 'Marzo', 'Abril',
  			'Mayo', 'Junio', 'Julio', 'Agosto',
  			'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
  			],
  			dayOfWeek: [
  			"Dom", "Lun", "Mar", "Mie", "Jue",
  			"Vie", "Sab",
  			]
  		}
  	},
  	format: 'Y-m-d'
  });
jQuery('#fechahasta').datetimepicker({
  	timepicker:false,
  	mask:true,
  	lang: 'de',
  	i18n: {
  		de: {
  			months: [
  			'Enero', 'Febrero', 'Marzo', 'Abril',
  			'Mayo', 'Junio', 'Julio', 'Agosto',
  			'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
  			],
  			dayOfWeek: [
  			"Dom", "Lun", "Mar", "Mie", "Jue",
  			"Vie", "Sab",
  			]
  		}
  	},
  	format: 'Y-m-d'
  }); 
ejecutar_general();


 });

function ejecutar_general(){
	getEspecialidad();
	getEspecialidadsearch();
	getPacientesearch();
	getPaciente();
	getEstadoCita();
}
function getEspecialidad() {
	var id=0;
	$.ajax({
		type: 'POST',
		url: 'general_control/getEspecialidad',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;
			if (lista != 0) {
				str = '<option selected="" value="0">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					codiesp = dat[0];
					nomesp = dat[1];
					str += '<option value="' + codiesp + '">' + nomesp + '</option>';
				}
				$('#selespe').html(str);
			} else {
				str = '<option selected="" value="0">No hay resultados</option>';
				$('#selespe').html(str);
			} 
		}
	});	
}
function getEspecialidadsearch() {
	var id=0;
	$.ajax({
		type: 'POST',
		url: 'general_control/getEspecialidad',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;
			if (lista != 0) {
				str = '<option selected="" value="0">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					codiesp = dat[0];
					nomesp = dat[1];
					str += '<option value="' + codiesp + '">' + nomesp + '</option>';
				}
				$('#selespes').html(str);
			} else {
				str = '<option selected="" value="0">No hay resultados</option>';
				$('#selespes').html(str);
			} 
		}
	});	
}
function getdatos(id){
	getMedico(id);
	getServicio(id);
}
function getMedicosearch(id) {
	$.ajax({
		type: 'POST',
		url: 'general_control/getMedico',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;             
			var strm='';
			if (lista != 0) {
				strm = '<option selected="" value="0">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					codimed = dat[0];
					medico = dat[1];
					strm += '<option value="' + codimed + '">' + medico + '</option>';
				}
				$('#selmedis').html(strm);
			} else {
				strm += '<option selected="" value="0">No hay resultados</option>';
				$('#selmedis').html(strm);
			}
		}
	});
}
function getMedico(id) {
	$.ajax({
		type: 'POST',
		url: 'general_control/getMedico',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;             
			var strm='';
			if (lista != 0) {
				strm = '<option selected="" value="0">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					codimed = dat[0];
					medico = dat[1];
					strm += '<option value="' + codimed + '">' + medico + '</option>';
				}
				$('#selmedi').html(strm);
			} else {
				strm += '<option selected="" value="0">No hay resultados</option>';
				$('#selmedi').html(strm);
			}
		}
	});
}
function getServicio(id) {
	$.ajax({
		type: 'POST',
		url: 'general_control/getServicio',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;             
			var strsv='';
			if (lista != 0) {
				strsv = '<option selected="" value="0">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					codsrv = dat[0];
					nomsrv = dat[1];
					strsv += '<option value="' + codsrv + '">' + nomsrv + '</option>';
				}
				$('#selserv').html(strsv);
			} else {
				strsv += '<option selected="" value="0">No hay resultados</option>';
				$('#selserv').html(strsv);
			}
		}
	});
}
function getPaciente() {
	var id=0;
	$.ajax({
		type: 'POST',
		url: 'general_control/getPaciente',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;
			if (lista != 0) {
				strpc = '<option selected="" value="">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					codpte = dat[0];
					paciente = dat[1];
					strpc += '<option value="' + codpte + '">' + paciente + '</option>';
				}
				$('#selpaci').html(strpc);
			} else {
				strpc = '<option selected="" value="">No hay resultados</option>';
				$('#selpaci').html(strpc);
			}
		}
	});
}
function getPacientesearch() {
	var id=0;
	$.ajax({
		type: 'POST',
		url: 'general_control/getPaciente',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;
			if (lista != 0) {
				strpc = '<option selected="" value="">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					codpte = dat[0];
					paciente = dat[1];
					strpc += '<option value="' + codpte + '">' + paciente + '</option>';
				}
				$('#selpacis').html(strpc);
			} else {
				strpc = '<option selected="" value="">No hay resultados</option>';
				$('#selpacis').html(strpc);
			}
		}
	});
}
	function getEstadoCita() {
	var id=0;
	$.ajax({
		type: 'POST',
		url: 'general_control/getEstadoCita',
		data: {id: id},
		dataType: 'json',
		success: function (json) {
			lista = json.lista;
			if (lista != 0) {
				strpc = '<option selected="" value="">--ConDatos--</option>';
				cad = lista.split("&&&");
				num = cad.length;
				for (e = 0; e < num; e++) {
					dat = cad[e].split("#$#");
					cdimlttb = dat[0];
					nommlttb = dat[1];
					strpc += '<option value="' + cdimlttb + '">' + nommlttb + '</option>';
				}
				$('#selesta').html(strpc);
			} else {
				strpc = '<option selected="" value="">No hay resultados</option>';
				$('#selesta').html(strpc);
			}
		}
	});
}

