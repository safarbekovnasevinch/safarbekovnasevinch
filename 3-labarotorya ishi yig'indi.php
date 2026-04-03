<?php
function yigindi($a, $b){
    return $a + $b;
}

$natija = "";

if(isset($_POST['hisobla'])){
    $son1 = $_POST['son1'];
    $son2 = $_POST['son2'];
    $natija = yigindi($son1, $son2);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Ikki son yig'indisi</title>

<style>
body{
    font-family: Arial;
    background:#4facfe;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    padding:30px;
    border-radius:10px;
    width:300px;
    text-align:center;
}

input{
    width:90%;
    padding:10px;
    margin:8px;
}

button{
    padding:10px 20px;
    background:#0077ff;
    color:white;
    border:none;
}

.result{
    margin-top:15px;
    font-size:18px;
    color:green;
}
</style>

<script>
function clearResult(){
    document.getElementById("result").style.display="none";
}
</script>

</head>

<body>

<div class="box">

<h2>Ikki son kiriting</h2>

<form method="post">

<input type="number" name="son1" placeholder="1-son" oninput="clearResult()" required>

<input type="number" name="son2" placeholder="2-son" oninput="clearResult()" required>

<br><br>

<button type="submit" name="hisobla">Hisoblash</button>

</form>

<div id="result" class="result">
<?php
if($natija !== ""){
echo "Yig'indi: ".$natija;
}
?>
</div>

</div>

</body>
</html>
