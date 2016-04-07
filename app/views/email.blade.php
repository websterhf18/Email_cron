<html>
<head>
	<title>Hola</title>
</head>
<body>
<p>Estos son los ultimos archivos de tu carrera</p>
<ul>
@foreach ($archivos as $archivo)
    <li><a href="http://duis.dev/archivo/{{$archivo->id}}">{{$archivo->nombre}}</a></li>
@endforeach
</ul>
</body>
</html>