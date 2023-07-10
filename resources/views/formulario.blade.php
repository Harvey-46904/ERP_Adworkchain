

<!DOCTYPE html>
<html>
<head>
    <title>Formulario</title>
</head>
<body>
    <h1>Formulario</h1>

    <form action="{{ route('tablero.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nombre">id usuario:</label>
            <input type="text" id="nombre" name="User">
        </div>

        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="Nombre">
        </div>

        <div>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="Imagen">
        </div>

        <div>
            <button type="submit">Enviar Imagen</button>
        </div>
    </form>
</body>
</html>