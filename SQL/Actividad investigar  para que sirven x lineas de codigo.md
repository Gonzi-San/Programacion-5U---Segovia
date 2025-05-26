
Deben averiguar para que sirve los siguientes fragmentos de código.   
86 - 119  
120 - 146

## Fragmento linea 86-119


```php
 $sql = "SELECT id, nombre, mail FROM names ORDER BY id DESC";

    $result = $conn->query($sql);

  

    if ($result->num_rows > 0) {

        echo "<table>

                <tr>

                    <th>Nombre</th>

                    <th>Email</th>

                    <th>Acciones</th>

                </tr>";

  

        while($row = $result->fetch_assoc()) {

            echo "<tr>

                    <td>{$row['nombre']}</td>

                    <td>{$row['mail']}</td>

                    <td class='actions'>

                        <form method='post' action='index.php' style='display:inline;'>

                            <input type='hidden' name='action' value='edit'>

                            <input type='hidden' name='id' value='{$row['id']}'>

                            <button type='submit'>Editar</button>

                        </form>

                        <form method='post' action='index.php' style='display:inline;'>

                            <input type='hidden' name='action' value='delete'>

                            <input type='hidden' name='id' value='{$row['id']}'>

                            <button type='submit'>Eliminar</button>

                        </form>

                    </td>

                </tr>";

        }

        echo "</table>";

    } else {

        echo "<p>No hay usuarios registrados.</p>";

    }
```


### 📌 Contexto general
Este fragmento de código PHP:
- Muestra una tabla con los usuarios registrados en la base de datos (`names`).
- Permite **editar** o **eliminar** cada registro desde la misma página (`index.php`).

---

### 🧱 Consulta SQL
```php
$sql = "SELECT id, nombre, mail FROM names ORDER BY id DESC";
```
- Selecciona las columnas `id`, `nombre` y `mail` de la tabla `names`.
- Ordena los resultados por `id` en **orden descendente** (los más recientes primero).

---

### 🔄 Ejecutar la consulta
```php
$result = $conn->query($sql);
```
- Ejecuta la consulta usando `$conn` (la conexión a la base de datos).
- Guarda el resultado en `$result`.

---

### ✅ Verificar si hay resultados
```php
if ($result->num_rows > 0) {
```
- Si hay al menos un resultado, se muestra la tabla.

---

### 📋 Encabezado de la tabla
```php
echo "<table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>";
```
- Crea una tabla HTML con tres columnas: Nombre, Email y Acciones.

---

### 🔁 Recorrer cada fila
```php
while($row = $result->fetch_assoc()) {
```
- Itera sobre cada fila de resultados.
- `$row` es un arreglo con claves: `id`, `nombre`, `mail`.

---

### 🧱 Mostrar cada usuario
```php
echo "<tr>
        <td>{$row['nombre']}</td>
        <td>{$row['mail']}</td>
        <td class='actions'>
```
- Imprime una fila en la tabla con los datos del usuario.

---

### ✏️ Botón "Editar"
```php
<form method='post' action='index.php' style='display:inline;'>
    <input type='hidden' name='action' value='edit'>
    <input type='hidden' name='id' value='{$row['id']}'>
    <button type='submit'>Editar</button>
</form>
```
- Formulario que envía una acción POST para **editar** al usuario con ese `id`.

---

### 🗑️ Botón "Eliminar"
```php
<form method='post' action='index.php' style='display:inline;'>
    <input type='hidden' name='action' value='delete'>
    <input type='hidden' name='id' value='{$row['id']}'>
    <button type='submit'>Eliminar</button>
</form>
```
- Formulario que envía una acción POST para **eliminar** al usuario con ese `id`.

---

### 🚫 Si no hay resultados
```php
} else {
    echo "<p>No hay usuarios registrados.</p>";
}
```
- Muestra un mensaje si no hay usuarios en la base de datos.

---

### 🎯 ¿Para qué sirve todo esto?

Este código:
- Muestra todos los registros de una tabla llamada `names`.
- Ofrece botones para **editar** o **eliminar** cada usuario.
- Es una base útil para construir un panel de administración simple en PHP.

## Fragmento linea 120-146

```php
 if (isset($_POST['action']) && $_POST['action'] == 'edit') {

        $id = $conn->real_escape_string($_POST['id']);

        $sql = "SELECT * FROM names WHERE id=$id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            echo "<h2>Editar Usuario</h2>

                <form method='post' action='index.php'>

                    <input type='hidden' name='action' value='update'>

                    <input type='hidden' name='id' value='{$user['id']}'>

                    <label for='nombre'>Nombre:</label>

                    <input type='text' id='nombre' name='nombre' value='{$user['nombre']}' required><br><br>

                    <label for='contrasena'>Contraseña:</label>

                    <input type='password' id='pass' name='pass' value='{$user['password']}' required><br><br>

                    <label for='email'>Email:</label>

                    <input type='email' id='email' name='email' value='{$user['mail']}' required><br><br>

                    <button type='submit'>Actualizar</button>

                    <a href='index.php'>Cancelar</a>

                </form>";

        }

    }

```


### 🔍 Verifica si se pidió editar
```php
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
```
- Revisa si se ha enviado un formulario con `action='edit'`.
- `isset()` verifica que exista el valor en `$_POST`.

---

### 🆔 Escapar el ID recibido
```php
$id = $conn->real_escape_string($_POST['id']);
```
- Toma el ID del usuario recibido por POST.
- Usa `real_escape_string()` para evitar **inyecciones SQL**.

---

### 📄 Buscar al usuario en la base de datos
```php
$sql = "SELECT * FROM names WHERE id=$id";
$result = $conn->query($sql);
```
- Se arma una consulta SQL para obtener todos los datos del usuario con ese ID.
- Se ejecuta la consulta.

---

### ✅ Verifica si encontró al usuario
```php
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
```
- Si se encontró un usuario, se guarda en `$user` como arreglo asociativo.

---

### ✏️ Formulario para editar al usuario
```php
echo "<h2>Editar Usuario</h2>
    <form method='post' action='index.php'>
        <input type='hidden' name='action' value='update'>
        <input type='hidden' name='id' value='{$user['id']}'>
```
- Se muestra un formulario HTML con método POST.
- Se envía la acción `update` al hacer submit, y se incluye el `id` del usuario como campo oculto.

---

### 🧾 Campo: Nombre
```php
<label for='nombre'>Nombre:</label>
<input type='text' id='nombre' name='nombre' value='{$user['nombre']}' required><br><br>
```
- Campo de texto para editar el nombre del usuario.
- El valor se rellena automáticamente con el nombre actual.

---

### 🔐 Campo: Contraseña
```php
<label for='contrasena'>Contraseña:</label>
<input type='password' id='pass' name='pass' value='{$user['password']}' required><br><br>
```
- Campo para la contraseña del usuario.
- Se carga el valor actual desde la base de datos (aunque **no es buena práctica mostrar contraseñas** en texto plano).

---

### 📧 Campo: Email
```php
<label for='email'>Email:</label>
<input type='email' id='email' name='email' value='{$user['mail']}' required><br><br>
```
- Campo de email, también rellenado con el valor actual.

---

### 🧮 Botón para actualizar
```php
<button type='submit'>Actualizar</button>
<a href='index.php'>Cancelar</a>
```
- Botón para enviar el formulario y realizar la actualización.
- Enlace para volver sin hacer cambios.

---

### 🎯 ¿Para qué sirve todo esto?

Este código permite al usuario:
- Ver un formulario con los datos actuales de un usuario de la base.
- Cambiar su nombre, contraseña y correo electrónico.
- Enviar esos cambios para actualizarlos en la base de datos.

---
