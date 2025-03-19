<?php
$host = "localhost";
$user = "root";
$pass = "agung";
$db   = "kampus";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM mahasiswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Animasi Background RGB */
        body {
            animation: changeColor 5s infinite alternate;
            transition: background 1s ease-in-out;
        }

        @keyframes changeColor {
            0%   { background: rgb(255, 0, 0); }
            25%  { background: rgb(0, 255, 0); }
            50%  { background: rgb(0, 0, 255); }
            75%  { background: rgb(255, 255, 0); }
            100% { background: rgb(255, 0, 255); }
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        /* Animasi warna pada teks judul */
        .title {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            animation: textColor 5s infinite alternate;
        }

        @keyframes textColor {
            0%   { color: cyan; }
            25%  { color: lime; }
            50%  { color: yellow; }
            75%  { color: orange; }
            100% { color: pink; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="title">Daftar Biodata Mahasiswa</h2>
    <div class="row justify-content-center">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4 d-flex justify-content-center">
            <div class="card text-center p-3 mb-4" style="width: 18rem;">
                <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
                <p class="card-text"><strong>NIM:</strong> <?= htmlspecialchars($row['nim']) ?></p>
                <p class="card-text"><strong>Jurusan:</strong> <?= htmlspecialchars($row['jurusan']) ?></p>
                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
