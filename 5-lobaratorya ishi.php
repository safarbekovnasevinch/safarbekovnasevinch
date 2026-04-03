<?php
$conn = new mysqli("localhost","root","");

// error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB
$conn->query("CREATE DATABASE IF NOT EXISTS klinika_db");
$conn->select_db("klinika_db");

// tables
$conn->query("CREATE TABLE IF NOT EXISTS shifokorlar (
id INT AUTO_INCREMENT PRIMARY KEY,
ism VARCHAR(100),
mutaxassislik VARCHAR(100),
tajriba INT)");

$conn->query("CREATE TABLE IF NOT EXISTS bemorlar (
id INT AUTO_INCREMENT PRIMARY KEY,
ism VARCHAR(100),
yosh INT,
tashxis VARCHAR(150),
shifokor_id INT)");

// default doctors
$conn->query("INSERT IGNORE INTO shifokorlar VALUES
(1,'Ali','Kardiolog',10),
(2,'Sardor','Nevrolog',8),
(3,'Jasur','Terapevt',6)");

// ADD
if(isset($_POST['add'])){
$ism = $_POST['ism'];
$yosh = $_POST['yosh'];
$tashxis = $_POST['tashxis'];
$shifokor = $_POST['shifokor'];

$conn->query("INSERT INTO bemorlar (ism,yosh,tashxis,shifokor_id)
VALUES ('$ism',$yosh,'$tashxis',$shifokor)");
}

// DELETE
if(isset($_GET['delete'])){
$conn->query("DELETE FROM bemorlar WHERE id=".$_GET['delete']);
}

// UPDATE
if(isset($_POST['update'])){
$conn->query("UPDATE bemorlar SET tashxis='{$_POST['tashxis']}' WHERE id=".$_POST['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Klinika Light</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background: linear-gradient(120deg,#f6f9fc,#e9f0ff);
}

.card{
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

input, select{
border-radius:10px !important;
}

.btn{
border-radius:10px;
transition:0.3s;
}

.btn:hover{
transform:scale(1.05);
}

.table{
border-radius:15px;
overflow:hidden;
}

h2{
font-weight:bold;
color:#2a5298;
}
</style>

</head>

<body>

<div class="container mt-5">

<div class="card p-4 bg-white">

<h2 class="text-center mb-4">Klinika tizimi</h2>

<!-- FORM -->
<form method="post" class="row g-3 mb-4">

<div class="col-md-3">
<input name="ism" class="form-control" placeholder="Ism" required>
</div>

<div class="col-md-2">
<input name="yosh" type="number" class="form-control" placeholder="Yosh" required>
</div>

<div class="col-md-3">
<input name="tashxis" class="form-control" placeholder="Tashxis" required>
</div>

<div class="col-md-2">
<select name="shifokor" class="form-select" required>
<option value="">Shifokor tanlang</option>
<?php
$res=$conn->query("SELECT * FROM shifokorlar");
while($d=$res->fetch_assoc()){
echo "<option value='{$d['id']}'>{$d['ism']} ({$d['mutaxassislik']})</option>";
}
?>
</select>
</div>

<div class="col-md-2">
<button name="add" class="btn btn-primary w-100">➕ Qo‘shish</button>
</div>

</form>

<!-- TABLE -->
<table class="table table-hover bg-white text-center align-middle">

<tr class="table-primary">
<th>ID</th><th>Ism</th><th>Yosh</th><th>Tashxis</th><th>Shifokor</th><th>Action</th>
</tr>

<?php
$res=$conn->query("SELECT b.*, s.ism shifokor FROM bemorlar b
JOIN shifokorlar s ON b.shifokor_id=s.id");

while($row=$res->fetch_assoc()){
echo "<tr>
<td>{$row['id']}</td>
<td>{$row['ism']}</td>
<td>{$row['yosh']}</td>

<td>
<form method='post' class='d-flex'>
<input type='hidden' name='id' value='{$row['id']}'>
<input name='tashxis' value='{$row['tashxis']}' class='form-control'>
<button name='update' class='btn btn-warning btn-sm ms-2'>✔</button>
</form>
</td>

<td>{$row['shifokor']}</td>

<td>
<a href='?delete={$row['id']}' class='btn btn-danger btn-sm'>🗑</a>
</td>

</tr>";
}
?>

</table>

</div>

</div>

</body>
</html>
