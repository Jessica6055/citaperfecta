<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Comercio</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <h1>Editar Comercio</h1>
    <form action="index.php?action=edit_commerce" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($commerce['id']); ?>">
        <label for="ruc">RUC:</label>
        <input type="text" name="ruc" value="<?php echo htmlspecialchars($commerce['ruc']); ?>" required><br>

        <label for="nombre_comercial">Nombre Comercial:</label>
        <input type="text" name="nombre_comercial" value="<?php echo htmlspecialchars($commerce['nombre_comercial']); ?>" required><br>

        <label for="razon_social">Razón Social:</label>
        <input type="text" name="razon_social" value="<?php echo htmlspecialchars($commerce['razon_social']); ?>" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?php echo htmlspecialchars($commerce['direccion']); ?>" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo htmlspecialchars($commerce['telefono']); ?>" required><br>

        <label for="nombre_contacto">Nombre de Contacto:</label>
        <input type="text" name="nombre_contacto" value="<?php echo htmlspecialchars($commerce['nombre_contacto']); ?>" required><br>

        <label for="tipo_establecimiento">Tipo de Establecimiento:</label>
        <input type="text" name="tipo_establecimiento" value="<?php echo htmlspecialchars($commerce['tipo_establecimiento']); ?>" required><br>

        <label for="imagen_logotipo">Imagen Logotipo:</label>
        <input type="file" name="imagen_logotipo"><br>
        <img src="uploads/<?php echo htmlspecialchars($commerce['imagen_logotipo']); ?>" alt="Logotipo" width="100"><br>

        <input type="submit" value="Actualizar">
    </form>
    <a href="index.php?action=list_commerces">Volver a la lista de comercios</a>
</body>
</html>

<?php
// Asegúrate de incluir el archivo de inicialización y el controlador
include_once './db.php';
include_once __DIR__ . '/../controller/CommerceController.php';


// Crear instancia del controlador de comercios
$commerceController = new CommerceController($conn);

// Verificar si se ha enviado una solicitud POST para actualizar un comercio
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $data = [
        'ruc' => $_POST['ruc'],
        'nombre_comercial' => $_POST['nombre_comercial'],
        'razon_social' => $_POST['razon_social'],
        'direccion' => $_POST['direccion'],
        'telefono' => $_POST['telefono'],
        'nombre_contacto' => $_POST['nombre_contacto'],
        'tipo_establecimiento' => $_POST['tipo_establecimiento'],
        'imagen_logotipo' => $_FILES['imagen_logotipo']['name']
    ];
    // Manejar la carga de archivos
    if ($_FILES['imagen_logotipo']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['imagen_logotipo']['tmp_name'], 'uploads/' . $_FILES['imagen_logotipo']['name']);
    }
    $commerceController->editCommerce($id, $data);
    header("Location: index.php?action=list_commerces");
    exit;
} else {
    // Obtener el ID del comercio a editar
    $id = $_GET['id'];
    $commerce = $commerceController->getCommerce($id);
    if (!$commerce) {
        echo "Comercio no encontrado.";
        exit;
    }
}
?>
