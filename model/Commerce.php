<?php
class Commerce {
    private $conn;
    private $table_name = "commerces";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (ruc, nombre_comercial, razon_social, direccion, telefono, nombre_contacto, tipo_establecimiento, imagen_logotipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssss", $data['ruc'], $data['nombre_comercial'], $data['razon_social'], $data['direccion'], $data['telefono'], $data['nombre_contacto'], $data['tipo_establecimiento'], $data['imagen_logotipo']);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET ruc = ?, nombre_comercial = ?, razon_social = ?, direccion = ?, telefono = ?, nombre_contacto = ?, tipo_establecimiento = ?, imagen_logotipo = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssssi", $data['ruc'], $data['nombre_comercial'], $data['razon_social'], $data['direccion'], $data['telefono'], $data['nombre_contacto'], $data['tipo_establecimiento'], $data['imagen_logotipo'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
