<?php
include 'db/config.php';
error_reporting(1);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Content-Type, Authorization');


$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
//var_dump("INPUT: " + file_get_contents('php://input')) ;

switch ($method) {
    case 'GET':
        if (isset($_GET['reclamo'])) {
            $reclamo = $_GET['reclamo'];
            $result = $conn->query("SELECT * FROM reclamos WHERE id='$reclamo'");
            $reclamo = [];
            if($result != ""){
                 while ($row = $result->fetch_assoc()) {
                    $reclamo[] = $row;
                }
            }
            echo json_encode($reclamo);
            
        } else {
            $reclamos = [];
            echo json_encode($reclamos);
        }
        break;

    case 'POST':
        $reclamo = $input["reclamo"];
        $conn->query("INSERT INTO reclamos (texto) VALUES ('$reclamo')");
        echo json_encode(["message" => "Reclamo agregado"]);
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