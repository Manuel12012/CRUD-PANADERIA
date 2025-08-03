<?php
require "../includes/funciones.php";
require "../includes/config/database.php";

$db = conectarDB();

$query = "SELECT * FROM productos";

$resultadoConsulta = mysqli_query($db, $query);


if($_SERVER["REQUEST_METHOD"]==="POST"){
  $id = $_POST["id"];
  



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
  <h1 class="text-3xl font-bold text-center uppercase mt-10 mb-6">Gestión de Productos</h1>

  <!-- Contenido principal -->
  <main class="px-4 md:px-10">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-100 text-gray-900 uppercase font-semibold">
          <tr>
            <th class="px-4 py-3 border">Id</th>
            <th class="px-4 py-3 border">Nombre</th>
            <th class="px-4 py-3 border">Precio</th>
            <th class="px-4 py-3 border">Descripción</th>
            <th class="px-4 py-3 border">Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 border">1</td>
            <td class="px-4 py-2 border">Pan de Molde</td>
            <td class="px-4 py-2 border">$45.00</td>
            <td class="px-4 py-2 border">Pan de molde 500 gr</td>
            <td class="px-4 py-2 border">
              <div class="flex justify-center gap-2">
                <form method="POST">
                  <input type="hidden" name="id" value="1">
                  <input type="submit" value="Eliminar" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs cursor-pointer">
                </form>
                <a href="productos/crear.php" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">Actualizar</a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

</body>
</html>
