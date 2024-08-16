<?php
session_start();
include_once 'db.php';

// Autoload classes
spl_autoload_register(function ($class_name) {
    include 'controller/' . $class_name . '.php';
});

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Verificar si el usuario está autenticado
$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userController = new UserController($conn);
    $userController->login($username, $password);
    exit;
}

if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userController = new UserController($conn);
    $userController->register($username, $password);
    exit;
}

if ($action === 'logout') {
    session_destroy();
    header("Location: index.php?action=login");
    exit;
}

if (!$loggedin && !in_array($action, ['login', 'register'])) {
    header("Location: index.php?action=login");
    exit;
}

// Crear instancia de controlador
$commerceController = new CommerceController($conn);
$userController = new UserController($conn);

switch ($action) {
    case 'home':
        include 'view/home.php';
        break;
    
    case 'add_commerce':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            move_uploaded_file($_FILES['imagen_logotipo']['tmp_name'], 'uploads/' . $_FILES['imagen_logotipo']['name']);
            $commerceController->addCommerce($data);
        } else {
            include 'view/add_commerce.php';
        }
        break;

    case 'list_commerces':
        $commerceController->listCommerces();
        break;
    
        case 'edit_commerce':
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
                move_uploaded_file($_FILES['imagen_logotipo']['tmp_name'], 'uploads/' . $_FILES['imagen_logotipo']['name']);
                $commerceController->editCommerce($id, $data);
                header("Location: index.php?action=list_commerces");
                exit;
            } else {
                $id = $_GET['id'];
                $commerce = $commerceController->getCommerce($id);
                include_once __DIR__ . '/view/edit_commerce.php';
            }
            break;
        
    
            case 'delete_commerce':
                $id = $_GET['id'];
                $commerceController->deleteCommerce($id);
                header("Location: index.php?action=list_commerces");
                exit;
            
    
    case 'register':
        include 'view/register.php';
        break;

    default:
        include 'view/login.php';
        break;
}
?>
