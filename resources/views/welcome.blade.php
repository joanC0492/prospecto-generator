<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="https://arguz.pe/wp-content/uploads/2024/07/cropped-arguz-favicon-iPad-32x32.png"
  sizes="32x32" />
  <title>Generador de Prospectos</title>
  <style>
    /* Estilos generales */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      text-align: center;
      background-color: #ffffff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 2.5rem;
      color: #333;
      margin-bottom: 20px;
    }

    p {
      font-size: 1.2rem;
      color: #666;
      margin-bottom: 30px;
    }

    .buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .btn {
      padding: 10px 20px;
      font-size: 1rem;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .btn-register {
      background-color: #28a745;
    }

    .btn-register:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Generador de Prospectos</h1>
    <p>Crea prospectos dinámicos y conviértelos en PDF de manera fácil y rápida.</p>
    <div class="buttons">
      <!-- Enlace para iniciar sesión -->
      <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
      <!-- Enlace para registrarse -->
      <!-- <a href="{{ route('register') }}" class="btn btn-register">Registro</a> -->
    </div>
  </div>
</body>
</html>
