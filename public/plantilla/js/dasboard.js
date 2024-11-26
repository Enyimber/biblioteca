const selectGenero = document.getElementById("generos");
const selectCanGeneros = document.getElementById("canGeneros");
const selectListageneros = document.getElementById("listageneros");
const lisTbody = document.getElementById("lisTbody");
const lisTbodyAutores = document.getElementById("lisTbody_fn3");

document.addEventListener("DOMContentLoaded", () => {
	selectCanGeneros.innerText = selectGenero.value;
	cargarLibrosDisponiblesGenero();
	loadDataTable("lista_fun4", 0, "asc");
	cargarLibrosPorRango();
});

selectGenero.addEventListener("change", () => {
	selectCanGeneros.innerText = selectGenero.value;
});

selectListageneros.addEventListener("change", () => {
	cargarLibrosDisponiblesGenero();
});

const cargarLibrosDisponiblesGenero = async () => {
	const url = base_url + "home/buscarLibro";
	const data = new FormData();
	data.append("litagenero", selectListageneros.value);

	try {
		// Espera a que la solicitud se complete y obtén la respuesta
		const respuesta = await execute_fetch(url, data);
		console.log(respuesta);
		// Verifica si la respuesta no es null antes de continuar
		if (respuesta.tbody != '') {
			// Actualiza el contenido de la tabla

			//loadDataTable("lista", 0, "asc");
			if ($.fn.DataTable.isDataTable("#lista")) {
				$("#lista").DataTable().clear().destroy();
			}

			lisTbody.innerHTML = respuesta.tbody;

			// Inicializa o reinicializa el DataTable
			// Verifica si la tabla ya tiene la propiedad 'DataTable'

			// Verifica si $.fn.dataTable está disponible

			prueba("lista", 0, "asc");
		} else {
			// Manejo si no se recibió respuesta o ocurrió un error
			console.error("No se pudo cargar la respuesta.");
		}
	} catch (error) {
		console.error("Error al cargar los libros disponibles por género:", error);
	}
};

const cargarLibrosPorRango = async () => {
	const url = base_url + "home/buscarLibrosAutor";
	const data = new FormData();
	data.append("autor", $("#listaAutores").val());
	data.append("anoInicial", $("#anoInicial").val());
	data.append("anoFinal", $("#anoFinal").val());

	try {
		const respuesta = await execute_fetch(url, data);
		console.log(respuesta);

		if (respuesta.tbody != "") {
			if ($.fn.DataTable.isDataTable("#lista_fun3")) {
				$("#lista_fun3").DataTable().clear().destroy();
			}

			lisTbodyAutores.innerHTML = respuesta.tbody;

			prueba("lista_fun3", 0, "asc", "163px");
		} else {
			console.error("No se pudo cargar la respuesta.");
		}
	} catch (error) {
		console.error("Error al cargar los libros disponibles por género:", error);
	}
};

const execute_fetch = async (url, data) => {
	try {
		const response = await fetch(url, {
			method: "POST",
			headers: {
				"X-Requested-With": "XMLHttpRequest", // Encabezado personalizado
			},
			body: data,
		});
		const json = await response.json();
		return json;
	} catch (error) {
		swal.fire({
			title: "Error",
			html: "Ha ocurrido un error en la aplicación, recargue la aplicación e intente nuevanmete<br>Si el error persiste reportelo al area de sistemas!",
			icon: "error",
		});
		return null;
	}
};

function prueba(idTabla, indiceColumn, orderColumn, altoTabla = "243px") {
	/* $('#equictntbl').DataTable().clear().destroy(); */
	let table = new DataTable(`#${idTabla}`, {
		scrollY: altoTabla,
		scrollCollapse: true,
		paging: false,
		pageLength: -1,
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "Todos"],
		],
		scrollX: true,
		lengthChange: false,
		searching: false,
		ordering: true,
		order: [[indiceColumn, orderColumn]],
		info: false,
		autoWidth: false,
		language: {
			sProcessing: "Procesando...",
			sLengthMenu: "Mostrar MENU registros",
			sZeroRecords: "No se encontraron resultados",
			sEmptyTable: "Ningún dato disponible en esta tabla =(",
			sInfo:
				"Mostrando registros del START al END de un total de TOTAL registros",
			sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
			sInfoFiltered: "(filtrado de un total de MAX registros)",
			sInfoPostFix: "",
			sSearch: "Buscar:",
			sUrl: "",
			sInfoThousands: ",",
			sLoadingRecords: "Cargando...",
			oPaginate: {
				sFirst: "Primero",
				sLast: "Último",
				sNext: "Siguiente",
				sPrevious: "Anterior",
			},
			oAria: {
				sSortAscending:
					": Activar para ordenar la columna de manera ascendente",
				sSortDescending:
					": Activar para ordenar la columna de manera descendente",
			},
			buttons: {
				copy: "Copiar",
				colvis: "Visibilidad",
			},
		},
	});
}
const loadDataTable = (idTabla, indiceColumn, orderColumn) => {
	let table = new DataTable(`#${idTabla}`, {
		scrollY: "400px",
		scrollCollapse: true,
		paging: false,
		pageLength: -1,
		lengthMenu: [
			[10, 25, 50, -1],
			[10, 25, 50, "Todos"],
		],
		scrollX: true,
		lengthChange: false,
		searching: false,
		ordering: true,
		order: [[indiceColumn, orderColumn]],
		info: false,
		autoWidth: false,
		language: {
			sProcessing: "Procesando...",
			sLengthMenu: "Mostrar MENU registros",
			sZeroRecords: "No se encontraron resultados",
			sEmptyTable: "Ningún dato disponible en esta tabla =(",
			sInfo:
				"Mostrando registros del START al END de un total de TOTAL registros",
			sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
			sInfoFiltered: "(filtrado de un total de MAX registros)",
			sInfoPostFix: "",
			sSearch: "Buscar:",
			sUrl: "",
			sInfoThousands: ",",
			sLoadingRecords: "Cargando...",
			oPaginate: {
				sFirst: "Primero",
				sLast: "Último",
				sNext: "Siguiente",
				sPrevious: "Anterior",
			},
			oAria: {
				sSortAscending:
					": Activar para ordenar la columna de manera ascendente",
				sSortDescending:
					": Activar para ordenar la columna de manera descendente",
			},
			buttons: {
				copy: "Copiar",
				colvis: "Visibilidad",
			},
		},
		initComplete: function () {
			this.api().columns.adjust();
		},
	});
};
