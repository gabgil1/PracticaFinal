$(document).on("click", ".btnEliminar", function () {
  let id_item = $(this).data("id");
  let modulo = $(this).data("modulo");
  let pagina;
  if (modulo === "especialidad" || modulo === "plan" || modulo === "entrenador") {
    pagina = modulo + "es"; // Plural para especialidad, plan, o entrenador
    // console.log(pagina);
  } else {
    pagina = modulo + "s"; // Plural para los demás módulos
  }
  console.log(modulo);
  console.log(pagina);
  
  let titulo = "Está seguro de eliminar el " + modulo + "?";
  let confirmar = "Si, eliminar " + modulo;

  if (modulo === "especialidad") {
    titulo = "Está seguro de eliminar la especialidad?";
    confirmar = "Si, eliminar especialidad";
  }

  Swal.fire({
    title: titulo,
    text: "Si no lo está, puede cancelar la acción",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: confirmar,
  }).then(function (result) {
    if (result.isConfirmed) {
    // Verifica si el parámetro id_${modulo} está correcto y si corresponde con la ruta de la página.
      // Redirigir a la página correspondiente con el id del módulo
      window.location = `index.php?pagina=${pagina}&id_${modulo}=${id_item}`;
    }
  });
});
