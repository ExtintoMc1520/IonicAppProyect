<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Registro</title>
</head>

<body>
    <h1>Actualizar Registro</h1>

    <form id="updateForm">
        <label for="id">ID del Registro a Actualizar:</label>
        <input type="text" id="id" name="id" required><br>

        <label for="nombre">Nuevo nombre:</label>
        <input type="text" id="nombre" name="nombre"><br>

        <label for="genero">Nuevos genero:</label>
        <input type="text" id="genero" name="genero"><br>

        <label for="temporada">Nuevas temporada:</label>
        <input type="text" id="temporada" name="temporada"><br>

        <label for="capitulos">capitulos:</label>
        <input type="text" id="capitulos" name="capitulos"><br>

        <button type="button" id="putButton">Actualizar con PUT</button>
        <button type="button" id="patchButton">Actualizar con PATCH</button>
    </form>

    <div id="response"></div>

    <script>
        document.getElementById('putButton').addEventListener('click', function () {
            actualizarRegistro('PUT');
        });

        document.getElementById('patchButton').addEventListener('click', function () {
            actualizarRegistro('PATCH');
        });

        function actualizarRegistro(metodo) {
            var id = document.getElementById('id').value;
            var nombre = document.getElementById('nombre').value;
            var genero = document.getElementById('genero').value;
            var temporada = document.getElementById('temporada').value;
            var capitulos = document.getElementById('capitulos').value;

            var data = new URLSearchParams();
            data.append('id', id);
            data.append('nombre', nombre);
            data.append('genero', genero);
            data.append('temporada', temporada);
            data.append('capitulos', capitulos);

            fetch('method.php', {
                method: metodo,
                body: data
            })
                .then(function (response) {
                    return response.text();
                })
                .then(function (data) {
                    document.getElementById('response').textContent = data;
                })
                .catch(function (error) {
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>