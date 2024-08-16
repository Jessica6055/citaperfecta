<?php

class CommerceController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addCommerce($data) {
        $query = "INSERT INTO commerces (ruc, nombre_comercial, razon_social, direccion, telefono, nombre_contacto, tipo_establecimiento, imagen_logotipo) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssss", $data['ruc'], $data['nombre_comercial'], $data['razon_social'], $data['direccion'], $data['telefono'], $data['nombre_contacto'], $data['tipo_establecimiento'], $data['imagen_logotipo']);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllCommerces() {
        $query = "SELECT * FROM commerces";
        $result = $this->conn->query($query);
        return $result;
    }

    public function getCommerce($id) {
        $query = "SELECT * FROM commerces WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function editCommerce($id, $data) {
        $query = "UPDATE commerces SET ruc = ?, nombre_comercial = ?, razon_social = ?, direccion = ?, telefono = ?, nombre_contacto = ?, tipo_establecimiento = ?, imagen_logotipo = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssssi", $data['ruc'], $data['nombre_comercial'], $data['razon_social'], $data['direccion'], $data['telefono'], $data['nombre_contacto'], $data['tipo_establecimiento'], $data['imagen_logotipo'], $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteCommerce($id) {
        $query = "DELETE FROM commerces WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function listCommerces() {
        $query = "SELECT * FROM commerces";
        $result = $this->conn->query($query);
    
        echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            /* Estilos generales para la tabla */
            .commerce-table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 16px;
                text-align: center;
                background-color: #f9f9f9;
                font-family: 'Lucida Sans';
            }
            /* Estilos para el encabezado de la tabla */
            .commerce-table thead tr {
                background-color: #333;
                color: #fff;
            }
            /* Estilos para las celdas de encabezado */
            .commerce-table th {
                padding: 12px;
                border: 1px solid #ddd;
            }
            /* Estilos para las celdas de datos */
            .commerce-table td {
                padding: 12px;
                border: 1px solid #ddd;
            }
            /* Alternancia de color en las filas */
            .commerce-table tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            .commerce-table tr:hover {
                background-color: #E2D1C3;
            }
            /* Estilos para las imágenes en la tabla */
            .commerce-table .logo {
                width: 150px;        
                height: 150px;
                object-fit: cover;   
                border-radius: 0;  
            }
            /* Estilos para los botones de acción */
            .button {
                text-decoration: none;
                padding: 8px 12px;
                border-radius: 4px;
                color: #fff;
                background-color: #007bff;
                transition: background-color 0.2s;
                margin: 2px;
                display: inline-block;
            }
            .button.delete {
                background: linear-gradient(to right, #F5A6B3 50%, #F68D6E 40%);
            }
            .button:hover {
                background-color: #0056b3;
            }
            .button.delete:hover {
                background-color: #c82333;
            }
        </style>
        <title>Lista de Comercios</title>
    </head>
    <body>
        <a href='index.php?action=home' class='button'>Back</a> <!-- Enlace para regresar a la página de inicio -->
    ";
    
        if ($result->num_rows > 0) {
            echo "<table class='commerce-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Imagen</th>";
            echo "<th>Nombre Comercial</th>";
            echo "<th>RUC</th>";
            echo "<th>Razón Social</th>";
            echo "<th>Dirección</th>";
            echo "<th>Teléfono</th>";
            echo "<th>Nombre de Contacto</th>";
            echo "<th>Tipo de Establecimiento</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='uploads/" . htmlspecialchars($row['imagen_logotipo']) . "' alt='Logotipo' class='logo' width='100'></td>";
                echo "<td>" . htmlspecialchars($row['nombre_comercial']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ruc']) . "</td>";
                echo "<td>" . htmlspecialchars($row['razon_social']) . "</td>";
                echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nombre_contacto']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tipo_establecimiento']) . "</td>";
                echo "<td>
                        <a href='index.php?action=edit_commerce&id=" . $row['id'] . "' class='button'>Actualizar</a>
                        <a href='index.php?action=delete_commerce&id=" . $row['id'] . "' class='button delete'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No hay comercios registrados.</p>";
        }
    
        echo "</body>
    </html>";
    }
    
}
?>
