<?php
// Configuração do banco de dados
$host = "localhost"; // ou o IP do seu servidor de banco de dados
$dbname = "seu_banco_de_dados";
$username = "seu_usuario";
$password = "sua_senha";

// Conexão com o banco de dados
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados para verificar as credenciais
    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha); // 'ss' para dois parâmetros do tipo string
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se as credenciais são válidas
    if ($result->num_rows > 0) {
        // Login bem-sucedido
        echo "Login bem-sucedido!";
        // Redirecionar ou iniciar uma sessão aqui
    } else {
        // Login falhou
        echo "E-mail ou senha incorretos!";
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>
