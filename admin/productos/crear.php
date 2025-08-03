<?php 
require "../../includes/funciones.php";
incluirTemplate("header");

require "../../includes/config/database.php";
$db = conectarDB();

// Obtener las categorías
$consulta = "SELECT * FROM categorias";
$resultado = mysqli_query($db, $consulta);

// Verificar si la consulta de categorías falló
if (!$resultado) {
    echo "<p class='text-red-500 text-center mt-4'>Error al obtener categorías: " . mysqli_error($db) . "</p>";
}

// Inicializar variables
$nombre = $descripcion = $precio = $stock = $categoria_id = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $precio = floatval($_POST["precio"]);
    $stock = intval($_POST["stock"]);
    $categoria_id = intval($_POST["categoria_id"]);

    // Validación básica
    if ($nombre && $precio && $categoria_id) {
        $query = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id)
                  VALUES ('$nombre', '$descripcion', $precio, $stock, $categoria_id)";
        
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header("Location: /admin");
            exit;
        } else {
            echo "<p class='text-red-500 text-center mt-4'>Error al insertar el producto: " . mysqli_error($db) . "</p>";
        }
    } else {
        echo "<p class='text-red-500 text-center mt-4'>Por favor completa todos los campos obligatorios.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema - Panadería</title>
  <link rel="stylesheet" href="../../dist/output.css">
</head>
<body class="bg-slate-50 text-gray-800 font-sans">

  <form action="crear.php" method="POST" class="max-w-md mx-auto bg-white p-6 mt-10 rounded-lg shadow-md space-y-4">
    <h2 class="text-xl font-bold text-center text-gray-700 mb-4">Agregar Producto</h2>

    <!-- Nombre -->
    <div>
      <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
      <input type="text" name="nombre" id="nombre" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200"
        value="<?php echo htmlspecialchars($nombre); ?>">
    </div>

    <!-- Descripción -->
    <div>
      <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
      <textarea name="descripcion" id="descripcion" rows="3"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200"><?php echo htmlspecialchars($descripcion); ?></textarea>
    </div>

    <!-- Precio -->
    <div>
      <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
      <input type="number" step="0.01" name="precio" id="precio" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200"
        value="<?php echo htmlspecialchars($precio); ?>">
    </div>

    <!-- Stock -->
    <div>
      <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
      <input type="number" name="stock" id="stock" min="0"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200"
        value="<?php echo htmlspecialchars($stock); ?>">
    </div>

    <!-- Categoría -->
    <div>
      <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
      <select name="categoria_id" id="categoria_id" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
        <option value="">-- Seleccione --</option>
        <?php while($categoria = mysqli_fetch_assoc($resultado)) : ?>
          <option value="<?php echo $categoria['id']; ?>" 
            <?php echo $categoria_id == $categoria['id'] ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($categoria['nombre']); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <!-- Botón -->
    <div class="text-center">
      <input type="submit" value="Enviar"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
    </div>
  </form>

</body>
</html>
