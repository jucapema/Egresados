<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>Hola! Se ha reportado un nuevo caso de emergencia a las .</p>
    <p>Estos son los datos del usuario que ha realizado la denuncia:</p>
    <ul>
        <li>Nombre: {{ $user->name }}</li>
        <li>Apellido: {{ $user->apellido }}</li>
        <li>DNI: {{ $user->dni }}</li>
    </ul>
    <p>Y esta es la posición reportada:</p>
    <ul>
            Ver en Google Maps
            </a>
        </li>
        </ul>
</body>
</html>
