<?php

$conn = mysqli_connect('localhost', 'Bruno', '1234', 'guia_sinnoh');

if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('Por favor preencha todos os campos.'); window.location.href = 'pag1_Bruno.html';</script>";
    } else {
        
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        
        $result = mysqli_query($conn, $query);

        if ($result) {
            
            echo "<script>alert('Você foi registrado com sucesso!'); window.location.href = 'pag1_Bruno.html';</script>";
        } else {
            
            echo "Erro ao registrar usuário: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: pag1_Bruno.html");
    exit();
}

mysqli_close($conn);

?>