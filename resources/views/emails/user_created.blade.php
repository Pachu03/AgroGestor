<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido, {{ $user->name }}</h1>
    <p>Tu correo electrónico es: {{ $user->email }}</p>
    <p>Tu contraseña es: {{ $password }}</p>
</body>
</html>
