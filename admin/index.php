<?php
require "../includes/funciones.php";
require "../includes/config/database.php";

$db = conectarDB();

$query = "SELECT * FROM productos";

$resultadoConsulta = mysqli_query($db, $query);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];

  //


  // ELiminar producto segun su id
  $query = "DELETE FROM productos WHERE id=$id";
  $resultado = mysqli_query($db, $query);
  $producto = mysqli_fetch_assoc($resultadoConsulta);
  if ($resultado) {
    header("location: /admin");
  }
}



incluirTemplate("header");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema - Panadería</title>
  <link rel="stylesheet" href="/dist/output.css">
</head>

<body class="bg-slate-50 text-gray-800 font-sans">
  <!-- Título -->
  <h1 class="text-2xl font-bold text-center uppercase mt-10 mb-6">Gestión de Productos</h1>

  <!-- Contenido principal -->
  <main class="px-2 sm:px-4 md:px-10 py-4">
    <div class="overflow-x-auto w-full bg-white shadow-md rounded-lg">
      <table class="w-full table-auto text-xs sm:text-sm text-left text-gray-700">

        <thead class="bg-gray-100 text-gray-900 uppercase font-semibold">
          <tr>
            <th class="px-4 py-3 border">Id</th>
            <th class="px-4 py-3 border">Nombre</th>
            <th class="px-4 py-3 border">Precio</th>
            <th class="px-4 py-3 border">Descripción</th>
            <th class="px-4 py-3 border">Fecha de Registro</th>
            <th class="px-4 py-3 border text-center min-w-[150px]">Acciones</th>



          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php while ($producto = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border"><?php echo $producto["id"]; ?></td>
              <td class="px-4 py-2 border"><?php echo $producto["nombre"]; ?></td>
              <td class="px-4 py-2 border">$ <?php echo $producto["precio"]; ?></td>
              <td class="px-4 py-2 border"><?php echo $producto["descripcion"]; ?></td>
              <td class="px-4 py-2 border"><?php echo $producto["fecha_registro"]; ?></td>

              <td class="px-4 py-2 border">
                <div class="flex flex-col sm:flex-row justify-center items-center gap-2">
                  <form method="POST" class="w-auto">
                    <input type="hidden" name="id" value="<?php echo $producto["id"]; ?>">
                    <input
                      type="submit"
                      value="Eliminar"
                      class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs cursor-pointer w-auto">
                  </form>
                  <a
                    href="/admin/productos/crear.php"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs w-auto inline-block text-center">
                    Actualizar
                  </a>
                </div>
              </td>

            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>

</body>

</html>