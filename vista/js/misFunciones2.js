/**
 * Funciones personales
 */
function limpiarCampos() {
    var form = document.getElementById('Form');
    form.reset();
}

$(document).ready(function()
{
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked)
		{
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

function agregarItem(idElementoOrigen, idElementoDestino){
	var option = document.createElement("option");
	option.text = document.getElementById(idElementoOrigen).value;
	document.getElementById(idElementoDestino).add(option);
	removerItem(idElementoOrigen);
	selectTodos(idElementoDestino);
}

function removerItem(IDelemento){
	var comboBox = document.getElementById(IDelemento);
    comboBox = comboBox.options[comboBox.selectedIndex];
    comboBox.remove();
	selectTodos(IDelemento);
  }

function selectTodos(IDelemento) {
    var elementos = document.getElementById(IDelemento);
    elementos = elementos.options;
    for (var i = 0; i < elementos.length; i++) {
        elementos[i].selected = "true";
    }
}


﻿/*
 *Diferents alerts windows
 */
 async function PostAlert() {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Ingresaras un nuevo PC!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
			//creando el input de Guardar
			/*<input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">
			*/
			
            //EjecutarComandos("POST");
            swalWithBootstrapButtons.fire({
                title: "Guardado!",
                text: "El nuevo PC ha sido ingresado con exito.",
                icon: "success",
            });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se ha ingresado el PC",
                icon: "error"
            });
        }
    });
}

async function PutAlert() {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Actualizaras los datos de un PC!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, actualizar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            EjecutarComandos("PUT");
            swalWithBootstrapButtons.fire({
                title: "Actualizado!",
                text: "Los datos de tu PC han sido actualizados.",
                icon: "success"
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se han actualizado los datos de ningun PC",
                icon: "error"
            });
        }
    });
}
async function DeleteAlert() {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Eliminaras un PC de tu base de datos!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {
            EjecutarComandos("DELETE");
            swalWithBootstrapButtons.fire({
                title: "Eliminado!",
                text: "El PC indicado ha sido eliminado",
                icon: "success"
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se ha eliminado ningún PC",
                icon: "error"
            });
        }
    });
}