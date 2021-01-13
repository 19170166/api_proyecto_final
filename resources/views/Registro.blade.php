<!DOCTYPE html>
<html>
<head>
	<title>Regristro</title>
</head>
<body>
    <h1>Hola, <b>{{$user->nombre}} {{$user->apellido}}</b>.</h1>
    <p>Se ha registrado en la aplicacion con exito.</b></p>
    <p>Para habilitar su cuenta de click en el siguiente enlace: </p>
    <b>http://192.168.1.105:8000/api/actualizar/cuenta/{{$user->id}}</b>
</body>
</html>