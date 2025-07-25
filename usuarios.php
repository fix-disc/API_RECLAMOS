<?php
include 'db/config.php';
error_reporting(1);

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['usuario']) && isset($_GET['password'])) {
            $usuario = $_GET['usuario'];
            $password = $_GET['password'];
            $result = $conn->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$password'");
            $users = [];
            if($result != ""){
                 while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }
            }
            echo json_encode($users);
            
        } else {
            $users = [];
            echo json_encode($users);
        }
        break;

    case 'POST':
        $name = $input['name'];
        $email = $input['email'];
        $age = $input['age'];
        $conn->query("INSERT INTO users (name, email, age) VALUES ('$name', '$email', $age)");
        echo json_encode(["message" => "User added successfully"]);
        break;

    case 'PUT':
        $id = $_GET['id'];
        $name = $input['name'];
        $email = $input['email'];
        $age = $input['age'];
        $conn->query("UPDATE users SET name='$name',
                     email='$email', age=$age WHERE id=$id");
        echo json_encode(["message" => "User updated successfully"]);
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $conn->query("DELETE FROM users WHERE id=$id");
        echo json_encode(["message" => "User deleted successfully"]);
        break;

    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}

$conn->close();
?>