<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Commerce</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
        /* Estilos para el mensaje de éxito y error */
        .message {
            font-weight: bold;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        .success-message {
            color: green;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            color: red;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <h1>Add Commerce</h1>
    <!-- Aquí es donde agregas la clase -->
    <div id="message" class="message"></div> <!-- Contenedor para el mensaje en la parte superior -->
    
    <form id="add-commerce-form" class="add-commerce-form" enctype="multipart/form-data">
        <label>RUC:</label>
        <input type="text" name="ruc" required><br>
        <label>Nombre Comercial:</label>
        <input type="text" name="nombre_comercial" required><br>
        <label>Razón Social:</label>
        <input type="text" name="razon_social" required><br>
        <label>Dirección:</label>
        <input type="text" name="direccion" required><br>
        <label>Teléfono:</label>
        <input type="text" name="telefono" required><br>
        <label>Nombre Contacto:</label>
        <input type="text" name="nombre_contacto" required><br>
        <label>Tipo de Establecimiento:</label>
        <input type="text" name="tipo_establecimiento" required><br>
        <label>Imagen Logotipo:</label>
        <input type="file" name="imagen_logotipo" required><br>
        <input type="submit" id="viewAlerta" value="Enviar">
    </form>
    <a href="index.php?action=home">Back</a>
    
    <script>
        document.getElementById('add-commerce-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario de manera tradicional
            
            let formData = new FormData(this);
            
            fetch('index.php?action=add_commerce', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                // Aquí asumes que el servidor devuelve un mensaje de éxito
                document.getElementById('message').innerHTML = "<p class='success-message'>Comercio agregado correctamente.</p>";
            })
            .catch(error => {
                document.getElementById('message').innerHTML = "<p class='error-message'>Hubo un error al agregar el comercio. Inténtalo de nuevo.</p>";
            });
        });
    </script>
</body>
</html>
