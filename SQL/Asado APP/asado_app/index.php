<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>El que no pone no come</title>
    <link rel="shortcut icon" href="uwu1.png" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            /* Fondo con imagen de asado */
            background: url('fondo.png') no-repeat center center fixed;
            background-size: cover;
            color: white;
            min-height: 100vh;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            height: auto;
            filter: drop-shadow(0 0 5px #ff6b6b);
        }
        h1 {
            color: #ffff;
            text-align: center;
            text-shadow: 2px 2px 4px #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #d9534f;
            color: white;
        }
        .debe { background-color: rgba(255, 235, 238, 0.9); }
        .pago { background-color: rgba(232, 245, 233, 0.9); }
        form {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            color: #333;
        }
        input, textarea, button {
            width: 98%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }
        button:hover {
            background-color: #4cae4c;
            transform: scale(1.02);
        }
        a {
            color: #d9534f;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="fotouwu.jpg" alt="Ícono de asado">
            <h1>🐁El que no pone, no come🥩</h1>
        </div>
        
        <!-- Formulario para agregar deudores -->
        <form action="agregar.php" method="post">
            <input type="text" name="nombre" placeholder="Nombre de la rata deudora" required>
            <input type="date" name="fecha_falta" required>
            <textarea name="comentario" placeholder="¿Qué excusa puso la rata?" required></textarea>
            <button type="submit">Agregar a la lista negra ⚫</button>
        </form>

        <!-- Lista de deudores -->
        <h2 style="color: #ffcc5c; text-shadow: 1px 1px 2px #000;">📜 Lista de ratas:</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Fecha que faltó</th>
                <th>¿Debe el próximo asadito?</th>
                <th>Comentario</th>
                <th>Acciones</th>
            </tr>
            <?php
            $result = $conexion->query("SELECT * FROM deudores ORDER BY fecha_falta DESC");
            while ($fila = $result->fetch_assoc()) {
                $clase = $fila['debe_proximo'] ? 'debe' : 'pago';
                echo "<tr class='$clase'>";
                echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                echo "<td>" . $fila['fecha_falta'] . "</td>";
                echo "<td>" . ($fila['debe_proximo'] ? '✅ Sí' : '❌ No') . "</td>";
                echo "<td>" . htmlspecialchars($fila['comentario']) . "</td>";
                echo "<td><a href='marcar_pago.php?id=" . $fila['id'] . "'>📌 Por fin pago la rata</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>