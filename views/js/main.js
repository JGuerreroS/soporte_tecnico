$(function(){

	// Elementos ocultos
	$("#my_account_save_name,#my_account_save_pass,#frmEditUser,#btn-editsave-user").hide();
	
	// Elementos bloqueados
	$('#my_a_name,#my_a_pass,#my_a_pass_confirm,#my_a_pass_actual').attr('disabled', true);

	// Ejecutar función que muestra la lista de usuarios en la vista users
	list_users();
	list_radios();

	// Cerrar sesión
	$(document).on("click", "#closesesion", function (){
		
		alertify.confirm("Cerrar sesión", "¿Estás seguro de querer cerrar la sesión?", function(){

			window.location = '../controllers/cerrarSesion.php';

		},function(){ });

		return false;

	});

	// Botón de editar usuario
	$(document).on("click", "#btn-edit-user", function(){

		$("#frmEditUser,#btn-editsave-user").show();
		$("#frmEditName").val(document.getElementById('nombre').innerHTML);
		$("#frmEditStatus").val(1);
		$(this).hide();
		return false;

	});

	// Guardar cambios editar usuario
	$(document).on("click", "#btn-editsave-user", function(){

		user = document.getElementById('usuario').innerHTML;

		$.ajax({
			type: "post",
			url: "../controllers/ajaxController.php",
			// url: "../controllers/editUserController.php",
			data: { usuario : user, name : $("#frmEditName").val(), status : $("#frmEditStatus").val() },
			success: function (r){

				switch(r){
					case "1":
						alertify.success("Actualizado con éxito!");
						$("#frmEditUser")[0].reset();
						$("#zoom-user-modal").modal('hide');
						$("#frmEditUser").hide();
						list_users();
						break;
				
					case "":
						alertify.warning("No se pudo actualizar los datos!");
						break;
				}

			}
		});
		
		return false;

	});

	// Registrar usuarios
	$(document).on("submit", "#frm-reg-user", function(){
		$.ajax({
			type: "post",
			url: "../controllers/ajaxController.php",
			data: $("#frm-reg-user").serialize(),
			success: function (r) {
				switch (r) {
					case '1':
						alertify.success("Usuario registrado correctamente");
						$("#frm-reg-user")[0].reset();
						$("#reg-user-modal").modal('hide');
						list_users();
						break;

					case '2':
							alertify.warning("Formulario incompleto");
							break;
				
					case "":
						alertify.error("No se pudo registrar!");
						$("#frm-reg-user")[0].reset();
						break;
				}
			}
		});
		return false;
	});

	// Registrar equipo
	$(document).on("submit", "#frm-reg-equipo", function(e){
		e.preventDefault();
		$.ajax({
			type: "post",
			url: "../controllers/ajaxController.php",
			data: $("#frm-reg-equipo").serialize(),
			success: function(r){
				console.log(r);
				/* switch(r){
					case '1':
						$("#frm-reg-equipo")[0].reset();
						$("#reg-equipo-modal").modal('hide');
						alertify.success("Equipo registrado correctamente");
						list_radios();
						break;
					case '2':
							alertify.warning("Formulario incompleto");
							break;
					case "":
						alertify.error("No se pudo registrar!");
						$("#frm-reg-equipo")[0].reset();
						break;
				} */
			}
		});
		// return false;
	});

	// Función de interacción de los botones en la vista myaccount
	$(document).on('click', '#my_account_name', function(){

		$("#my_account_save_name").show();
		$("#my_account_save_pass").hide();
		$("#my_a_name").attr('disabled', false);
		$("#my_a_pass,#my_a_pass_confirm,#my_a_pass_actual").attr('disabled', true);
		return false;

	});

	// Función de interacción de los botones en la vista myaccount
	$(document).on('click', '#my_account_pass', function(){

		$("#my_account_save_pass").show();
		$("#my_account_save_name").hide();
		$("#my_a_name").attr('disabled', true);
		$("#my_a_pass,#my_a_pass_confirm,#my_a_pass_actual").attr('disabled', false);
		return false;

	});

	// Función que actualiza la el nombre del usuario en la vista myaccount
	$(document).on('click', '#my_account_save_name', function(){

		name = $("#my_a_name").val();
		myaccount_update(name);
		$(this).hide();
		return false;

	});

	// Registrar marca
	$(document).on("submit", "#frm-reg-marca", function(e){
		e.preventDefault();
		let registrar_marca = $("#nombre_marca").val();
		$.ajax({
			type: "post",
			url: "../controllers/ajaxController.php",
			data: {registrar_marca},
			success: function (r){
				switch (r) {
					case '1':
						$("#frm-reg-marca")[0].reset();
						$(".reg-marca-modal").modal('hide');
						$("#reg-equipo-modal").modal('show');
						alertify.success("Marca registrada correctamente");
						// list_radios();
						seleccionarMarca();
						break;
					case '2':
							alertify.warning("Datos incompletos");
							break;
					case "":
						alertify.error("No se pudo registrar!");
						$("#frm-reg-marca")[0].reset();
						break;
				}
			}
		});
	});

	// Registrar componente
	$(document).on("submit", "#frm-reg-component", function(e){
		e.preventDefault();
		let registrar_componente = $("#nombre_componente").val();
		$.ajax({
			type: "post",
			url: "../controllers/ajaxController.php",
			data: {registrar_componente},
			success: function (r){
				console.log(r);
				switch (r) {
					case '1':
						$("#frm-reg-component")[0].reset();
						$(".reg-component-modal").modal('hide');
						$("#reg-equipo-modal").modal('show');
						alertify.success("Nuevo componente registrado correctamente");
						// list_radios();
						seleccionarComponente();
						break;
					case '2':
							alertify.warning("Datos incompletos");
							break;
					case "":
						alertify.error("No se pudo registrar!");
						$("#frm-reg-component")[0].reset();
						break;
				}
			}
		});
	});


	// Función que actualiza la contraseña del usuario en la vista myaccount
	$(document).on('click', '#my_account_save_pass', function(){

		$("#my_a_pass,#my_a_pass_actual").attr('disabled', false);
		new_pass = $("#my_a_pass").val();
		old_pass = $("#my_a_pass_actual").val();
		myaccount_update_pass(old_pass,new_pass);
		return false;

	});

	// Comparar contraseñas
	$(document).on("focusout", "#my_a_pass", function(){

		var vacio = "La contraseña no puede estar vacía";
		var longitud = "La contraseña debe estar formada entre 6-10 carácteres";

		pass1 = $('#my_a_pass').val();
		pass2 = $('#my_a_pass_confirm').val();

		if(pass1.length==0 || pass1==""){

			document.getElementById("msg_pass").innerHTML = vacio;
			$("#msg_pass").addClass("text-danger");
			$("#msg_pass").removeClass("text-success");	
	
		}else{

			if(pass1.length<6 || pass1.length>10){

				document.getElementById("msg_pass").innerHTML = longitud;
				$("#my_a_pass_confirm").attr('disabled', true);
		
			}else{

				if(pass1.length>5 || pass1.length<11){

					$("#my_a_pass_confirm").attr('disabled', false);

					$("#my_a_pass_confirm").on('keyup', function (){
						
						coincidePassword();

					});
			
				}else{
		
					$("#my_a_pass_confirm").attr('disabled', true);
		
				}

			}

		}
		
	});

	// Buscar en sigefirrhh
	$(document).on("click", "#buscar_sigef", function(){

		$.ajax({
			type: "post",
			url: "../controllers/ajaxController.php",
			data: { cedula : $("#frm_civ").val() },
			success: function (r){

				r = JSON.parse(r);

				if(r == "No"){

					alertify.alert('Error, no se encontraron datos', "Verifica que la cédula sea el número correcto e intenta de nuevo");

				}else{

					switch (r[1]){
						case "A":
							$("#frm_name").val(r[2]);
							$("#frm_cargo").val(r[3]);
							$("#frm_dependencia").val(r[4]);
							break;
							
						case "E":
							alertify.alert('No puedes registrar a esta persona', "La persona se encuentra EGRESADA en el SIGEFIRRHH");
							break;
							
						case "S":
							alertify.alert('No puedes registrar a esta persona', "La persona se encuentra SUSPENDIDA en el SIGEFIRRHH");
							break;
								
					}

				}

			}
		});

		return false;

	});

	// Seleccionar municipios y parroquiauias dinamicamente
	$("#estado").change(function () {
		//reinicia el select parroquiauia al detectar cambios de valor en estado
		$("#parroquia").find('option').remove().end().append('<option value="">parroquiauia...</option>');

		$("#estado option:selected").each(function () {
			id_estado = $(this).val();
			$.get("../controllers/ajaxController.php", { id_est : id_estado }, function(data){
				$("#municipio").html(data);
			});            
		});
	});

	$("#municipio").change(function () {
		$("#municipio option:selected").each(function () {
			id_municipio = $(this).val();
			$.get("../controllers/ajaxController.php", { id_mun : id_municipio }, function(data){
				$("#parroquia").html(data);
			});            
		});
	});
	
	// Seleccionar marcas y modelos dinamicamente
/* 	$("#tipo").change(function () {
		//reinicia el select modelo al detectar cambios de valor en tipo
		$("#modelo").find('option').remove().end().append('<option value="">Modelo...</option>');

		$("#tipo option:selected").each(function () {
			id_tipo = $(this).val();
			$.get("../controllers/ajaxController.php", { tipo : id_tipo }, function(data){
				$("#marca").html(data);
			});            
		});
	}); */

	$("#selectMarca").change(function (){
		$("#selectMarca option:selected").each(function () {
			marca_id = $(this).val();
			if (marca_id == 15) {
				$("#reg-equipo-modal").modal("hide");
				$(".reg-marca-modal").modal("show");
			} else {
				$.get("../controllers/ajaxController.php", { marca : marca_id }, function(data){
					$("#modelo").html(data);
				});         
			}
		});
	});

	// Funcíon que carga el select de marcas en el modal de registro de componentes
	seleccionarMarca();
	function seleccionarMarca(){
		$("#selectMarca").load("../controllers/ajaxController.php?selectMarca=1", function(response){
			this; // dom element
		});
	}

	// Funciíon que carga el select de componentes en el modal de registro de componentes
	seleccionarComponente();
	function seleccionarComponente(){
		$("#selectComponente").load("../controllers/ajaxController.php?selectComponente=1", function(response){
			this; // dom element
		});
	}

	$("#selectComponente").change(function (){
		$("#selectComponente option:selected").each(function () {
			componente_id = $(this).val();
			if (componente_id == 3){
				$("#reg-equipo-modal").modal("hide");
				$(".reg-component-modal").modal("show");
			}
		});
	});

}); // Cierre de la función ready

//función que comprueba las dos contraseñas
function coincidePassword(){
	var confirmacion = "Las contraseñas coinciden";
	var negacion = "No coinciden las contraseñas";
	var valor1 = $('#my_a_pass').val();
	var valor2 = $('#my_a_pass_confirm').val();
	
	//condiciones dentro de la función
	
	if(valor1 != valor2){
		document.getElementById("msg_pass").innerHTML = negacion;
		$("#msg_pass").addClass("text-danger");
		$("#msg_pass").removeClass("text-success");
	}

	if(valor1.length!=0 && valor1==valor2){
		document.getElementById("msg_pass").innerHTML = confirmacion;
		$("#msg_pass").removeClass("text-danger");
		$("#msg_pass").addClass("text-success");
		$("#my_a_pass_actual").attr('disabled', false);
		$("#my_a_name,#my_a_pass,#my_a_pass_confirm").attr('disabled', true);
	}
}

// Función que carga los datos del usuario en la vista myaccount
function myaccount(){
	$.ajax({
		type: "get",
		url: "../controllers/myAccountController.php",
		success: function (r){
			datos = JSON.parse(r);
			document.getElementById('my_a_user').innerHTML = datos[0];
			document.getElementById('my_a_name').value = datos[1];
			document.getElementById('my_a_date').innerHTML = datos[2];
			document.getElementById('my_a_rol').innerHTML = datos[3];
			document.getElementById('my_a_status').innerHTML = datos[4];
		}
	});
}

// Función que actualiza el nombre del usuario en la vista myaccount
function myaccount_update(name){
	$.ajax({
		type: "post",
		url: "../controllers/ajaxController.php",
		data: { my_a_name : name },
		success: function (r){
			switch (r) {
				case "1":
					alertify.success('Datos actualizados correctamente!');
					myaccount();
					$('#my_a_name,#my_a_pass,#my_a_pass_confirm,#my_a_pass_actual').attr('disabled', true);
					$("#my_account_save").hide();
					$("#my_account_edit").show();
					break;
			
				case "":
					alertify.warning('No se pudo actualizar el nombre!');
					break;
			}
		}
	});
}

// Función que actualiza la contraseña del usuario en la vista myaccount
function myaccount_update_pass(old_pass,new_pass){
	$.ajax({
		type: "post",
		url: "../controllers/ajaxController.php",
		data: { current_pass : old_pass, new_pass : new_pass },
		success: function (r){
			switch (r) {
				case "":
					alertify.error("No se pudo actualizar la clave");
					break;
			
				case "1":
					alertify.success('Contraseña actualizada correctamente!');
					myaccount();
					$('#my_a_name,#my_a_pass,#my_a_pass_confirm,#my_a_pass_actual').attr('disabled', true);
					$("#my_a_pass,#my_a_pass_confirm,#my_a_pass_actual").val("");
					document.getElementById("msg_pass").innerHTML = "";
					$("#my_account_save_pass").hide();
					break;
			}
		}
	});
}

// Obtener lista de usuarios
function list_users(){
	$('#userTable').DataTable({
		"destroy": true,
		"ajax":{
			"url": "../controllers/usersController.php"
		},
		"columns":[
			{"data": "nro"},
			{"data": "civ"},
			{"data": "nombre"},
			{"data": "rol"},
			{"data": "reg_date"},
			{"data": "opciones"}
		],
		"columnDefs": [
			{
			"targets": 0,
			"className": "text-center",
			"width": "4%"
		   },
		   {
			"targets": 1,
			"className": "text-center",
		   },
		   {
			"targets": 3,
			"className": "text-center",
			},
			{
			"targets": 4,
			"className": "text-center",
			},
			{
			"targets": 5,
			"className": "text-center"
		   	}
		],
		"language": spanish
	});
}

// Obtener lista de radios
function list_radios(){
	$('#radioTable').DataTable({
		"destroy": true,
		"ajax":{
			"url": "../controllers/radioController.php"
		},
		"columns":[
			{"data": "nro"},
			{"data": "serial"},
			{"data": "identificador"},
			{"data": "tipo"},
			{"data": "marca"},
			{"data": "modelo"},
			{"data": "estatus"},
			{"data": "dependencia"},
			{"data": "opciones"}
		],
		"columnDefs": [
			{
				"targets": 0,
				"className": "text-center",
				"width": "4%"
		   },
		   {
				"targets": 1,
				"className": "text-center",
				"width": "5%"
		   },
		   {
				"targets": 2,
				"className": "text-center",
				"width": "5%"
		   },
		   {
				"targets": 3,
				"className": "text-center",
				"width": "8%"
			},
			{
				"targets": 4,
				"className": "text-center",
				"width": "11%"
			},
			{
				"targets": 5,
				"className": "text-center",
				"width": "9%"
			},
			{
				"targets": 6,
				"className": "text-center"
			},
			{
				"targets": 7,
				"className": "text-center"
			},
			{
				"targets": 8,
				"className": "text-center"
			}
		],
		"language": spanish
	});
}

// Zoom usuarios
function zoom_user(id){
	$.get("../controllers/ajaxController.php", { zoom_user : id }, function (r){
		datos = JSON.parse(r);
		$("#usuario").html(datos.civ).addClass('font-weight-bold');
		$("#nombre").html(datos.nombre).addClass('font-weight-bold');
		$("#rol").html(datos.rol).addClass('font-weight-bold');
		$("#fecha").html(datos.reg_date).addClass('font-weight-bold');
	});
}

// Zoom radios
function zoom_radio(id){
	$.get("../controllers/ajaxController.php", { zoom_radio : id }, function (r){
		datos = JSON.parse(r);
		$("#mserial").html(datos[1]).addClass('font-weight-bold');
		$("#mid").html(datos[2]).addClass('font-weight-bold');
		$("#mtipo").html(datos[3]).addClass('font-weight-bold');
		$("#mmarca").html(datos[4]).addClass('font-weight-bold');
		$("#mmodelo").html(datos[5]).addClass('font-weight-bold');
		$("#mestatus").html(datos[6]).addClass('font-weight-bold');
		$("#mdependencia").html(datos[7]).addClass('font-weight-bold');
		$("#muser").html(datos[8]).addClass('font-weight-bold');
		$("#mfecha").html(datos[9]).addClass('font-weight-bold');
		$("#mobser").html(datos[10]).addClass('font-weight-bold');
		$("#mestado").html(datos[11]).addClass('font-weight-bold');
	});
}

// Borrar usuarios
function delete_user(id){
	alertify.confirm("Eliminar usuario", "¿Seguro quieres eliminar este usuario?", function(){
    	$.get("../controllers/ajaxController.php", { d_user : id }, function (r){
			alertify.success("Usuario eliminado con éxito");
			list_users();
		});
	}, function(){});
}

// Idioma español para datatables
var spanish = {
	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla",
	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "Cargando...",
	"oPaginate": {
	"sFirst":    "Primero",
	"sLast":     "Último",
	"sNext":     "Siguiente",
	"sPrevious": "Anterior"
		},
	"oAria": {
	"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	}
}

// Grafica
function crearCadenaLineal(json){
	var parsed = JSON.parse(json);
	var arr = [];
	for(var x in parsed){
	arr.push(parsed[x]);
	}
	return arr;
}

// Grafica
function graficaHome(datosX1,datosY1,datosX2,datosY2){
	var linea1 = {
        x: datosX1,
        y: datosY1,
        type: 'scatter',
        name: 'Administrador'
        };

    var linea2 = {
        x: datosX2,
        y: datosY2,
        type: 'scatter',
        name: 'Analista'
        };

	var layout = {
	title: 'Usuarios',
	xaxis: {
		title: 'Meses',
		showgrid: false,
		zeroline: false
	},
	yaxis: {
		title: 'Total',
		showline: false
	}
	};
	var data = [linea1, linea2];
	Plotly.newPlot('graficaLinea', data, layout,{}, {showSendToCloud: true});
}

// Buscar serial del equipo
function buscarSerial(serial){
	let boton = document.getElementById('reg_componente');
	if (serial == ''){
		boton.disabled = true;
		alertify.alert('Formulario incompleto', "Se requiere el serial del radio");
	} else {
		$.get("../controllers/ajaxController.php", { buscar_serial : serial }, function (r){
			if(r){
				alertify.alert('No puedes registrar este radio', r);
				boton.disabled = true;
			}
		});
	}
}

// Buscar marca
function buscarMarca(marca){
	// console.log(marca);
	/* let boton = document.getElementById('registrar_marca');
	if (marca == ''){
		boton.disabled = true;
		alertify.alert('Formulario incompleto', 'Ingresa la marca');
	} else {
		$.get("../controllers/ajaxController.php", { buscar_marca : serial }, function (r){
			if(r){
				alertify.alert('No puedes registrar esta marca', r);
				boton.disabled = true;
			}
		});
	}
	return false; */
}

// Buscar ID del radio
function buscarID(id){
	let boton = document.getElementById('reg_radio');
	if (serial == ''){
		boton.disabled = true;
		alertify.alert('Formulario incompleto', "Se requiere el ID del radio");
	} else {
		$.get("../controllers/ajaxController.php", { buscar_idradio : id }, function(r){
			if(r){
				alertify.alert('No puedes registrar este radio', r);
				boton.disabled = true;
			}
		});		
	}
}

// Estadísticas de radios
function cuadro_radios(){
	let tiempo_inicio = new Date().getTime();
	$.get("../controllers/cuadroController2.php", function (r) {
		r = JSON.parse(r);
		$("#cuadro-radios").html(r);
		let tiempo_fin = new Date().getTime()-tiempo_inicio;
		console.log(tiempo_fin/1000);
	});	
}