$(document).on("click", ".btnEliminar", function () {
  let id_item = $(this).data("id");
  let modulo = $(this).data("modulo");

  console.log("ID Item: ", id_item); // Para comprobar el id del item
  console.log("Módulo: ", modulo); // Para comprobar el módulo (habitacion)

  let pagina;
  if (modulo === "habitacion") {
    pagina = modulo + "es"; // Plural para especialidad, plan, o entrenador
  } else {
    pagina = modulo + "s"; // Plural para los demás módulos
  }
  // console.log(modulo);
  // console.log("este es la pagina " + pagina);

  let titulo = "Está seguro de eliminar el " + modulo + "?";
  let confirmar = "Si, eliminar " + modulo;

  if (modulo === "habitacion") {
    titulo = "Está seguro de eliminar la habitación?";
    confirmar = "Si, eliminar habitación";
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
      window.location = `index.php?pagina=${pagina}&habitacion=${id_item}`;

    }
  });
});

// $(document).on("click", ".btnEliminar", function () {
//   let id_habitacion = $(this).attr("id_habitaciones");

//   Swal.fire({
//     title: "Está seguro de eliminar el habitacion?",
//     text: "Sino lo está puede cancelar la acción",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#3085d6",
//     cancelButtonColor: "#d33",
//     cancelButtonText: "Cancelar",
//     confirmButtonText: "Si, eliminar producto",
//   }).then(function (result) {
//     if (result.value) {
//       window.location =
//         "index.php?pagina=habitaciones&habitacion_id=" + id_habitacion;
//     }
//   });
// });
