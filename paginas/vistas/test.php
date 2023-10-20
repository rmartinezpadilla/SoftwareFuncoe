
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 

$sql = "SELECT E.Nombre as 'Empleado', D.Nombre as 'Departamento' FROM Empleados E JOIN Departamentos D ON E.DepartamentoId = D.Id"



?>
<body>
  <a href=""><?php 
  if ($sql->num_rows > 0) {
    while ($sql = $sqls->fetch_assoc()) {
      echo ( $sql['E.Nombre'] );
    }
  }
  ?></a>  
</body>
</html>
