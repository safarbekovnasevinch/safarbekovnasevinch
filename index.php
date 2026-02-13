<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ism = $_POST['ism'];
    $familiya = $_POST['familiya'];
    $jins = $_POST['jins'];
    $viloyat = $_POST['viloyat'];
    $telefon = $_POST['telefon'];

    echo "<h3>Kiritilgan ma'lumotlar:</h3>";
    echo "Ism: " . $ism . "<br>";
    echo "Familiya: " . $familiya . "<br>";
    echo "Jins: " . $jins . "<br>";
    echo "Viloyat: " . $viloyat . "<br>";
    echo "Telefon: " . $telefon . "<br><hr>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Talaba ma'lumotlari</title>
</head>
<body>

<h2>Talaba ma’lumotlarini kiriting</h2>

<form method="post" action="">
    
    Ism: <input type="text" name="ism" required><br><br>

    Familiya: <input type="text" name="familiya" required><br><br>

    Jins:
    <input type="radio" name="jins" value="Erkak" required> Erkak
    <input type="radio" name="jins" value="Ayol"> Ayol
    <br><br>

    Viloyat:
    <select name="viloyat" required>
        <option value="">-- Viloyatni tanlang --</option>
        <option value="Toshkent shahri">Toshkent shahri</option>
        <option value="Toshkent viloyati">Toshkent viloyati</option>
        <option value="Andijon">Andijon</option>
        <option value="Buxoro">Buxoro</option>
        <option value="Farg'ona">Farg'ona</option>
        <option value="Jizzax">Jizzax</option>
        <option value="Namangan">Namangan</option>
        <option value="Navoiy">Navoiy</option>
        <option value="Qashqadaryo">Qashqadaryo</option>
        <option value="Samarqand">Samarqand</option>
        <option value="Sirdaryo">Sirdaryo</option>
        <option value="Surxondaryo">Surxondaryo</option>
        <option value="Xorazm">Xorazm</option>
        <option value="Qoraqalpog'iston Respublikasi">Qoraqalpog'iston Respublikasi</option>
    </select>
    <br><br>

    Telefon: <input type="tel" name="telefon" required><br><br>

    <input type="submit" value="Yuborish">

</form>

</body>
</html>
