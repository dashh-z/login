<?php
$host = "localhost";
$dbname = "seu_banco_de_dados";
$username = "seu_usuario";
$password = "sua_senha";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login bem-sucedido!";
    } else {
        echo "E-mail ou senha incorretos!";
    }

    $stmt->close();
    $conn->close();
}
?>
