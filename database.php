<?php
    $name=$_POST["name"];
    $image=$_POST["image"];
    $use=$_POST["use"];
    $time=$_POST["time"];
    $Quin=$_POST["Quin"];
    
    $server = 'localhost';
    $user = "username";
    $pass = '';
    $dbname = 'medical';
                        
    $conn = mysqli_connect($server,$user,$pass,$dbname);

    $sql = "INSERT INTO `sanvi medical` (`photo`, `Name`, `Quantity`, `Use`, `Eating Time`) VALUES ('$image', '$name', '$Quin', '$use', '$time');";

    $result = mysqli_query($conn,"SELECT * FROM `sanvi medical` WHERE 1");

    $data = $result->fetch_all(MYSQLI_ASSOC);

    mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Username</th>
            <th>Address</th>
            <th>Quantity</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['photo']) ?></td>
            <td><?= htmlspecialchars($row['Name']) ?></td>
            <td><?= htmlspecialchars($row['Use']) ?></td>
            <td><?= htmlspecialchars($row['Eating Time']) ?></td>
            <td><?= htmlspecialchars($row['Quantity']) ?></td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>