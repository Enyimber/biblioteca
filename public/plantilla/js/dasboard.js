const selectGenero = document.getElementById("generos");
const selectCanGeneros = document.getElementById("canGeneros");
const selectListageneros = document.getElementById("listageneros");
const lisTbody = document.getElementById("lisTbody");
const lisTbodyAutores = document.getElementById("lisTbody_fn3");

document.addEventListener("DOMContentLoaded", async () => {
	selectCanGeneros.innerText = selectGenero.value;
	await cargarLibrosDisponiblesGenero();
	inicializarDataTable("lista_fun4", 0, "asc");
	await cargarLibrosPorRango();
});

selectGenero.addEventListener("change", async () => {
	selectCanGeneros.innerText = selectGenero.value;
	await cargarLibrosDisponiblesGenero();
});

selectListageneros.addEventListener("change", async () => {
	await cargarLibrosDisponiblesGenero();
});

const cargarLibrosDisponiblesGenero = async () => {
	const url = base_url + "home/buscarLibro";
	const data = new FormData();
	data.append("litagenero", selectListageneros.value);

	const respuesta = await fetchLibros(url, data);
	if (respuesta) {
		renderTablaLibros(respuesta);
	} else {
		console.error("No se pudo cargar la respuesta.");
	}
};

const cargarLibrosPorRango = async () => {
	const autor = $("#listaAutores").val();
	const anoInicial = $("#anoInicial").val();
	const anoFinal = $("#anoFinal").val();

	// Validación
	if (!autor || !anoInicial || !anoFinal) {
		console.warn("Todos los campos son obligatorios.");
		return;
	}

	const url = base_url + "home/buscarLibrosAutor";
	const data = new FormData();
	data.append("autor", autor);
	data.append("anoInicial", anoInicial);
	data.append("anoFinal", anoFinal);

	const respuesta = await fetchLibros(url, data);
	if (respuesta) {
		renderTablaAutores(respuesta);
	} else {
		console.error("No se pudo cargar la respuesta.");
	}
};

const fetchLibros = async (url, data) => {
	try {
		const response = await fetch(url, {
			method: "POST",
			headers: {
				"X-Requested-With": "XMLHttpRequest", // Encabezado personalizado
			},
			body: data,
		});
		return await response.json();
	} catch (error) {
		handleError("Ocurrió un error al procesar la solicitud.");
		console.error("Error en la solicitud:", error);
		return null;
	}
};

const renderTablaLibros = (respuesta) => {
	if ($.fn.DataTable.isDataTable("#lista")) {
		$("#lista").DataTable().clear().destroy();
	}
	lisTbody.innerHTML = respuesta.tbody || "<tr><td>No hay datos disponibles</td></tr>";
	inicializarDataTable("lista", 0, "asc");
};

const renderTablaAutores = (respuesta) => {
	if ($.fn.DataTable.isDataTable("#lista_fun3")) {
		$("#lista_fun3").DataTable().clear().destroy();
	}
	lisTbodyAutores.innerHTML = respuesta.tbody || "<tr><td>No hay datos disponibles</td></tr>";
	inicializarDataTable("lista_fun3", 0, "asc", "163px");
};

const inicializarDataTable = (idTabla, indiceColumn, orderColumn, altoTabla = "243px") => {
	new DataTable(`#${idTabla}`, {
		scrollY: altoTabla,
		scrollCollapse: true,
		paging: false,
		order: [[indiceColumn, orderColumn]],
		info: false,
		autoWidth: false,
		searching: false,
		language: {
			sProcessing: "Procesando...",
			sZeroRecords: "No se encontraron resultados",
			sEmptyTable: "Ningún dato disponible en esta tabla =(",
			sInfo: "Mostrando registros del START al END de un total de TOTAL registros",
			sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
			sInfoFiltered: "(filtrado de un total de MAX registros)",
			sLoadingRecords: "Cargando...",
			oPaginate: {
				sFirst: "Primero",
				sLast: "Último",
				sNext: "Siguiente",
				sPrevious: "Anterior",
			},
		},
	});
};

const handleError = (message) => {
	swal.fire({
		title: "Error",
		html: message,
		icon: "error",
	});
};
