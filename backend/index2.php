<!DOCTYPE html>
<html>
<head>
    <title>API de Ejemplo (GET, POST, PUT, DELETE)</title>
    <script src="min.js"></script>

</head>
<body>
<h1>Eliminar Registro por ID</h1>
    
    <form id="deleteForm">
        <label for="id">ID del Registro a Eliminar:</label>
        <input type="text" id="id" name="id" required>
        <button type="button" id="deleteButton">Eliminar</button>
    </form>

    <div id="response"></div>

    <script>
        // Agregar un evento al botón para enviar la solicitud DELETE
        document.getElementById('deleteButton').addEventListener('click', function () {
            var id = document.getElementById('id').value;

            fetch('method.php?id=' + id, {
                method: 'DELETE'
            })
            .then(function(response) {
                return response.text();
            })
            .then(function(data) {
                document.getElementById('response').textContent = data;
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    </script>
    
</body>
</html>
