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

const forlogin = document.getElementById("forlogin");
const button = document.getElementById("button");

button.addEventListener("click", function () {
	fnSendFormulario();
});

const fnSendFormulario = async () => {
	const url = base_url + "login/consultarUsuario";
	const data = new FormData(forlogin);
	await execute_fetch(url, data).then((respuesta) => {
		if (respuesta.status) {
			location.href = `${base_url}Home`;
		}

		swal.fire({
			title: respuesta.title,
			html: respuesta.mensaje,
			icon: respuesta.icono,
		});
	});
};
