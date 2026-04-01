<?php
$conn = new mysqli("localhost", "root", "", "db_avtosalon");

if ($conn->connect_error) {
    die("Xatolik: " . $conn->connect_error);
}

$sql = "SELECT 
            mijozlar.ism,
            avtomobillar.model,
            avtomobillar.rang,
            sotuvlar.narx
        FROM sotuvlar
        INNER JOIN mijozlar 
            ON sotuvlar.mijoz_id = mijozlar.id
        INNER JOIN avtomobillar 
            ON sotuvlar.avto_id = avtomobillar.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Avtosalon</title>
</head>

<body>

<h2>Avtosalon savdolari</h2>

<table border="1">
<tr>
    <th>Mijoz</th>
    <th>Model</th>
    <th>Rang</th>
    <th>Narx</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['ism']; ?></td>
    <td><?php echo $row['model']; ?></td>
    <td><?php echo $row['rang']; ?></td>
    <td><?php echo $row['narx']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>

<?php
$conn->close();
?>