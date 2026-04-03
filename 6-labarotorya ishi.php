<?php
$conn = new mysqli("localhost", "root", "", "hotel_reservation_db");

if ($conn->connect_error) {
    die("Xatolik: " . $conn->connect_error);
}

// DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM guest_bookings WHERE booking_id=$id");
}

// ADD
if(isset($_POST['add'])){
    $conn->query("INSERT INTO guest_bookings 
    (guest_identity, passport_reference, room_code, arrival_date, departure_date, payment_mode, booking_status)
    VALUES 
    ('{$_POST['guest_identity']}', '{$_POST['passport_reference']}', '{$_POST['room_code']}', '{$_POST['arrival_date']}', '{$_POST['departure_date']}', '{$_POST['payment_mode']}', '{$_POST['booking_status']}')");
}

// UPDATE
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $conn->query("UPDATE guest_bookings SET
        guest_identity='{$_POST['guest_identity']}',
        passport_reference='{$_POST['passport_reference']}',
        room_code='{$_POST['room_code']}',
        arrival_date='{$_POST['arrival_date']}',
        departure_date='{$_POST['departure_date']}',
        payment_mode='{$_POST['payment_mode']}',
        booking_status='{$_POST['booking_status']}'
        WHERE booking_id=$id");
}

// EDIT DATA
$editData = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM guest_bookings WHERE booking_id=$id");
    $editData = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel CRUD</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #74ebd5, #9face6);
        }
        .card {
            border-radius: 15px;
        }
        h2 {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">🏨 Mehmonxona rezervatsiya</h2>

        <form method="POST" class="row g-3">
            <input type="hidden" name="id" value="<?= $editData['booking_id'] ?? '' ?>">

            <div class="col-md-6">
                <input type="text" name="guest_identity" class="form-control" placeholder="Ism" value="<?= $editData['guest_identity'] ?? '' ?>" required>
            </div>

            <div class="col-md-6">
                <input type="text" name="passport_reference" class="form-control" placeholder="Passport" value="<?= $editData['passport_reference'] ?? '' ?>" required>
            </div>

            <div class="col-md-4">
                <input type="text" name="room_code" class="form-control" placeholder="Xona" value="<?= $editData['room_code'] ?? '' ?>" required>
            </div>

            <div class="col-md-4">
                <input type="date" name="arrival_date" class="form-control" value="<?= $editData['arrival_date'] ?? '' ?>" required>
            </div>

            <div class="col-md-4">
                <input type="date" name="departure_date" class="form-control" value="<?= $editData['departure_date'] ?? '' ?>" required>
            </div>

            <div class="col-md-6">
                <input type="text" name="payment_mode" class="form-control" placeholder="To‘lov turi" value="<?= $editData['payment_mode'] ?? '' ?>">
            </div>

            <div class="col-md-6">
                <input type="text" name="booking_status" class="form-control" placeholder="Status" value="<?= $editData['booking_status'] ?? '' ?>">
            </div>

            <div class="col-12 text-center">
                <?php if($editData): ?>
                    <button class="btn btn-warning px-4" name="update">Yangilash</button>
                <?php else: ?>
                    <button class="btn btn-success px-4" name="add">Saqlash</button>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card shadow p-4 mt-4">
        <h4 class="mb-3">📋 Bronlar ro‘yxati</h4>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ism</th>
                    <th>Passport</th>
                    <th>Xona</th>
                    <th>Kelish</th>
                    <th>Ketish</th>
                    <th>To‘lov</th>
                    <th>Status</th>
                    <th>Amallar</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $result = $conn->query("SELECT * FROM guest_bookings");

            while($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>{$row['booking_id']}</td>
                    <td>{$row['guest_identity']}</td>
                    <td>{$row['passport_reference']}</td>
                    <td>{$row['room_code']}</td>
                    <td>{$row['arrival_date']}</td>
                    <td>{$row['departure_date']}</td>
                    <td>{$row['payment_mode']}</td>
                    <td>{$row['booking_status']}</td>
                    <td>
                        <a href='?edit={$row['booking_id']}' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='?delete={$row['booking_id']}' class='btn btn-sm btn-danger'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
