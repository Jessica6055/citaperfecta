<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
        }

        .container a {
            display: inline-block;
            margin: 1rem;
            padding: 1rem;
            text-decoration: none;
            color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ff69b4; /* Fondo rosa fuerte */
            transition: background-color 0.3s;
            text-align: center;
        }

        .container a:hover {
            background-color: #ff1493; /* Fondo rosa profundo */
        }

        .container img {
            display: block;
            margin: 0 auto 1rem;
            max-width: 100px; /* Ajusta el tamaño máximo de la imagen según sea necesario */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido a Cita Perfecta</h2>
        <a href="index.php?action=add_commerce">
            <img src="https://cdn-icons-png.flaticon.com/512/4715/4715128.png" alt="Añadir Commerce">
            Añadir Commerce
        </a>
        <a href="index.php?action=list_commerces">
            <img src="https://cdn-icons-png.freepik.com/512/5432/5432799.png" alt="Listar Commerces">
            Listar Commerces
        </a>
        <a href="index.php?action=logout">
            <img src="https://cdn-icons-png.freepik.com/256/4998/4998821.png?semt=ais_hybrid" alt="Logout">
            Logout
        </a>
    </div>
</body>
</html>
